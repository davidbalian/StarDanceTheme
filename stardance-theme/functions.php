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

    // Page-specific CSS
    $pages_css_dir = get_template_directory_uri() . '/assets/css/pages/';
    if ( is_page_template('page-classes.php') ) {
        wp_enqueue_style('stardance-page-classes', $pages_css_dir . 'classes.css', array('stardance-responsive'), '1.0.0');
    }
    if ( is_page_template('page-events.php') ) {
        wp_enqueue_style('stardance-page-events', $pages_css_dir . 'events.css', array('stardance-responsive'), '1.0.0');
    }
    if ( is_page_template('page-about.php') ) {
        wp_enqueue_style('stardance-page-about', $pages_css_dir . 'about.css', array('stardance-responsive'), '1.0.0');
    }
    if ( is_page_template('page-schedule.php') ) {
        wp_enqueue_style('stardance-page-schedule', $pages_css_dir . 'schedule.css', array('stardance-responsive'), '1.0.0');
    }
    if ( is_page_template('page-gallery.php') ) {
        wp_enqueue_style('stardance-page-gallery', $pages_css_dir . 'gallery.css', array('stardance-responsive'), '1.0.0');
    }
    if ( is_singular('dance_class') ) {
        wp_enqueue_style('stardance-single-class', $pages_css_dir . 'single-class.css', array('stardance-responsive'), '1.0.0');
    }

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

// Register dance_class Custom Post Type
function stardance_register_post_types() {
    register_post_type('dance_class', array(
        'labels' => array(
            'name'               => __('Dance Classes', 'stardance'),
            'singular_name'      => __('Dance Class', 'stardance'),
            'add_new'            => __('Add New Class', 'stardance'),
            'add_new_item'       => __('Add New Dance Class', 'stardance'),
            'edit_item'          => __('Edit Dance Class', 'stardance'),
            'new_item'           => __('New Dance Class', 'stardance'),
            'view_item'          => __('View Dance Class', 'stardance'),
            'search_items'       => __('Search Dance Classes', 'stardance'),
            'not_found'          => __('No dance classes found', 'stardance'),
            'not_found_in_trash' => __('No dance classes found in trash', 'stardance'),
            'menu_name'          => __('Dance Classes', 'stardance'),
        ),
        'public'      => true,
        'has_archive' => true,
        'supports'    => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite'     => array('slug' => 'classes'),
        'menu_icon'   => 'dashicons-format-video',
        'show_in_rest' => true,
    ));
}
add_action('init', 'stardance_register_post_types');

// Auto-create pages and sample posts on theme activation
function stardance_create_pages() {
    if ( get_option('stardance_pages_created') ) {
        return;
    }

    $pages = array(
        array(
            'title'    => 'Classes',
            'template' => 'page-classes.php',
            'slug'     => 'classes',
        ),
        array(
            'title'    => 'Events',
            'template' => 'page-events.php',
            'slug'     => 'events',
        ),
        array(
            'title'    => 'About',
            'template' => 'page-about.php',
            'slug'     => 'about',
        ),
        array(
            'title'    => 'Schedule',
            'template' => 'page-schedule.php',
            'slug'     => 'schedule',
        ),
        array(
            'title'    => 'Gallery',
            'template' => 'page-gallery.php',
            'slug'     => 'gallery',
        ),
    );

    foreach ( $pages as $page_data ) {
        $existing = get_page_by_path($page_data['slug'], OBJECT, 'page');
        if ( $existing ) {
            update_post_meta($existing->ID, '_wp_page_template', $page_data['template']);
            continue;
        }
        $page_id = wp_insert_post(array(
            'post_title'   => $page_data['title'],
            'post_name'    => $page_data['slug'],
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_author'  => 1,
            'post_content' => '',
        ));
        if ( $page_id && ! is_wp_error($page_id) ) {
            update_post_meta($page_id, '_wp_page_template', $page_data['template']);
        }
    }

    // Create sample dance_class posts
    $classes = array(
        array(
            'title'   => 'European Ballroom',
            'excerpt' => 'The international Ballroom dances consist of: Slow Waltz, Tango, Viennese Waltz, Foxtrot, Quickstep.',
            'slug'    => 'european-ballroom',
        ),
        array(
            'title'   => 'Latin American',
            'excerpt' => 'The international Latin-American dances consist of: Samba, Cha-Cha-Cha, Rumba, Pasodoble, Jive.',
            'slug'    => 'latin-american',
        ),
        array(
            'title'   => 'Latin Fusion Ladies',
            'excerpt' => 'A dynamic fusion of Latin dance styles tailored exclusively for women.',
            'slug'    => 'latin-fusion-ladies',
        ),
        array(
            'title'   => 'Kids Program',
            'excerpt' => 'A fun and structured dance program designed for children of all ages.',
            'slug'    => 'kids-program',
        ),
        array(
            'title'   => 'Wedding Choreography',
            'excerpt' => 'Custom choreography designed to make your first dance unforgettable.',
            'slug'    => 'wedding-choreography',
        ),
        array(
            'title'   => 'Individual Lessons',
            'excerpt' => 'One-on-one coaching tailored to your pace, goals, and dance style.',
            'slug'    => 'individual-lessons',
        ),
    );

    foreach ( $classes as $class_data ) {
        $existing = get_page_by_path($class_data['slug'], OBJECT, 'dance_class');
        if ( $existing ) {
            continue;
        }
        wp_insert_post(array(
            'post_title'   => $class_data['title'],
            'post_name'    => $class_data['slug'],
            'post_excerpt' => $class_data['excerpt'],
            'post_status'  => 'publish',
            'post_type'    => 'dance_class',
            'post_author'  => 1,
            'post_content' => '',
        ));
    }

    flush_rewrite_rules();
    update_option('stardance_pages_created', true);
}
add_action('after_switch_theme', 'stardance_create_pages');
add_action('admin_init', 'stardance_create_pages');

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
