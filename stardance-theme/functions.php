<?php
/**
 * Star Dance Studio Theme Functions
 */

// Theme Setup
function stardance_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'stardance'),
        'footer'  => __('Footer Menu', 'stardance'),
    ));
}
add_action('after_setup_theme', 'stardance_setup');

// Enqueue Styles and Scripts
function stardance_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style(
        'stardance-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300..700;1,300..700&family=Libertinus+Sans:wght@400;700&display=swap',
        array(),
        null
    );

    // Theme Styles
    wp_enqueue_style('stardance-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_style('stardance-components', get_template_directory_uri() . '/assets/css/components.css', array('stardance-style'), '1.0.0');
    wp_enqueue_style('stardance-sections', get_template_directory_uri() . '/assets/css/sections.css', array('stardance-components'), '1.0.0');
    wp_enqueue_style('stardance-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array('stardance-sections'), '1.0.0');

    // PhotoSwipe Vendor
    wp_enqueue_style('photoswipe', get_template_directory_uri() . '/assets/vendor/photoswipe.min.css', array(), '5.4.4');
    wp_enqueue_script('photoswipe', get_template_directory_uri() . '/assets/vendor/photoswipe.umd.min.js', array(), '5.4.4', true);
    wp_enqueue_script('photoswipe-lightbox', get_template_directory_uri() . '/assets/vendor/photoswipe-lightbox.umd.min.js', array(), '5.4.4', true);

    // Theme Scripts
    wp_enqueue_script('stardance-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '1.0.0', true);
    wp_enqueue_script('stardance-animations', get_template_directory_uri() . '/assets/js/animations.js', array(), '1.0.0', true);
    wp_enqueue_script('stardance-gallery', get_template_directory_uri() . '/assets/js/gallery.js', array('photoswipe', 'photoswipe-lightbox'), '1.0.0', true);
    wp_enqueue_script('stardance-contact-form', get_template_directory_uri() . '/assets/js/contact-form.js', array(), '1.0.0', true);

    // Localize script for AJAX
    wp_localize_script('stardance-contact-form', 'stardanceAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('stardance_contact_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'stardance_enqueue_assets');

// Contact Form AJAX Handler
function stardance_handle_contact_form() {
    check_ajax_referer('stardance_contact_nonce', 'nonce');

    $name    = sanitize_text_field($_POST['name'] ?? '');
    $email   = sanitize_email($_POST['email'] ?? '');
    $phone   = sanitize_text_field($_POST['phone'] ?? '');
    $interest = sanitize_text_field($_POST['interest'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error(array('message' => 'Please fill in all required fields.'));
    }

    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Please enter a valid email address.'));
    }

    $to = get_option('admin_email');
    $subject = sprintf('New Contact Form Submission from %s', $name);

    $body  = "Name: {$name}\n";
    $body .= "Email: {$email}\n";
    $body .= "Phone: {$phone}\n";
    $body .= "Interest: {$interest}\n\n";
    $body .= "Message:\n{$message}\n";

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        "Reply-To: {$name} <{$email}>",
    );

    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        wp_send_json_success(array('message' => 'Thank you! Your message has been sent successfully.'));
    } else {
        wp_send_json_error(array('message' => 'Sorry, there was an error sending your message. Please try again.'));
    }
}
add_action('wp_ajax_stardance_contact', 'stardance_handle_contact_form');
add_action('wp_ajax_nopriv_stardance_contact', 'stardance_handle_contact_form');

// Fallback Menus (when no menu is assigned in admin)
function stardance_fallback_menu() {
    ?>
    <ul class="sd-header__menu">
        <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
        <li><a href="#classes">Classes</a></li>
        <li><a href="#competitions">Events</a></li>
        <li><a href="#timetable">Schedule</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#gallery">Gallery</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>
    <?php
}

function stardance_fallback_footer_menu() {
    ?>
    <ul class="sd-footer__menu">
        <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
        <li><a href="#about">About Us</a></li>
        <li><a href="#coaches">Meet the Coach</a></li>
        <li><a href="#classes">Dance Classes</a></li>
        <li><a href="#timetable">Timetable</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>
    <?php
}
