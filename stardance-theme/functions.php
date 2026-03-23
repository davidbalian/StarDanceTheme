<?php
/**
 * Star Dance Studio Theme Functions
 */

// Reusable component render functions
require get_template_directory() . '/inc/components.php';

/**
 * Return a filemtime-based asset version for cache busting.
 *
 * @param string $relative_path Relative path from the theme directory.
 * @return string
 */
function stardance_asset_version( $relative_path ) {
    $full_path = get_template_directory() . '/' . ltrim( $relative_path, '/' );

    if ( file_exists( $full_path ) ) {
        return (string) filemtime( $full_path );
    }

    return '1.0.0';
}

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

define( 'STARDANCE_REWRITE_VERSION', '2026-03-gallery-filters' );

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
    wp_enqueue_style('stardance-style', get_stylesheet_uri(), array(), stardance_asset_version('style.css'));
    wp_enqueue_style('stardance-components', get_template_directory_uri() . '/assets/css/components.css', array('stardance-style'), stardance_asset_version('assets/css/components.css'));
    wp_enqueue_style('stardance-sections', get_template_directory_uri() . '/assets/css/sections.css', array('stardance-components'), stardance_asset_version('assets/css/sections.css'));
    wp_enqueue_style('stardance-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array('stardance-sections'), stardance_asset_version('assets/css/responsive.css'));

    // Page-specific CSS
    $pages_css_dir = get_template_directory_uri() . '/assets/css/pages/';
    if ( is_page_template('page-classes.php') ) {
        wp_enqueue_style('stardance-page-classes', $pages_css_dir . 'classes.css', array('stardance-responsive'), stardance_asset_version('assets/css/pages/classes.css'));
    }
    if ( is_page_template('page-events.php') ) {
        wp_enqueue_style('stardance-page-events', $pages_css_dir . 'events.css', array('stardance-responsive'), stardance_asset_version('assets/css/pages/events.css'));
    }
    if ( is_page_template('page-about.php') ) {
        wp_enqueue_style('stardance-page-about', $pages_css_dir . 'about.css', array('stardance-responsive'), stardance_asset_version('assets/css/pages/about.css'));
        wp_enqueue_script('stardance-about', get_template_directory_uri() . '/assets/js/about.js', array(), stardance_asset_version('assets/js/about.js'), true);
    }
    if ( is_page_template('page-schedule.php') ) {
        wp_enqueue_style('stardance-page-schedule', $pages_css_dir . 'schedule.css', array('stardance-responsive'), stardance_asset_version('assets/css/pages/schedule.css'));
    }
    if ( is_page_template('page-gallery.php') ) {
        wp_enqueue_style('stardance-page-gallery', $pages_css_dir . 'gallery.css', array('stardance-responsive'), stardance_asset_version('assets/css/pages/gallery.css'));
    }
    if ( is_singular('dance_class') ) {
        wp_enqueue_style('stardance-single-class', $pages_css_dir . 'single-class.css', array('stardance-responsive'), stardance_asset_version('assets/css/pages/single-class.css'));
    }

    // Theme Scripts
    wp_enqueue_script('stardance-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), stardance_asset_version('assets/js/navigation.js'), true);
    wp_enqueue_script('stardance-animations', get_template_directory_uri() . '/assets/js/animations.js', array(), stardance_asset_version('assets/js/animations.js'), true);
    wp_enqueue_script('stardance-faq', get_template_directory_uri() . '/assets/js/faq.js', array(), stardance_asset_version('assets/js/faq.js'), true);
    wp_enqueue_script('stardance-gallery', get_template_directory_uri() . '/assets/js/gallery.js', array(), stardance_asset_version('assets/js/gallery.js'), true);
    wp_enqueue_script('stardance-contact-form', get_template_directory_uri() . '/assets/js/contact-form.js', array(), stardance_asset_version('assets/js/contact-form.js'), true);

    wp_localize_script('stardance-gallery', 'stardanceGallery', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('stardance_gallery_nonce'),
    ));

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
        'has_archive' => false,
        'supports'    => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'rewrite'     => array('slug' => 'classes'),
        'menu_icon'   => 'dashicons-format-video',
        'show_ui'     => true,
        'show_in_menu' => true,
        'menu_position' => 21,
        'show_in_rest' => true,
    ));

    register_post_type('gallery_item', array(
        'labels' => array(
            'name'               => __('Gallery Images', 'stardance'),
            'singular_name'      => __('Gallery Image', 'stardance'),
            'add_new'            => __('Add New Image', 'stardance'),
            'add_new_item'       => __('Add New Gallery Image', 'stardance'),
            'edit_item'          => __('Edit Gallery Image', 'stardance'),
            'new_item'           => __('New Gallery Image', 'stardance'),
            'view_item'          => __('View Gallery Image', 'stardance'),
            'search_items'       => __('Search Gallery Images', 'stardance'),
            'not_found'          => __('No gallery images found', 'stardance'),
            'not_found_in_trash' => __('No gallery images found in trash', 'stardance'),
            'menu_name'          => __('Gallery Images', 'stardance'),
        ),
        'public'             => true,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'has_archive'        => false,
        'rewrite'            => false,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'menu_icon'          => 'dashicons-format-gallery',
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 22,
        'show_in_rest'       => true,
    ));
}
add_action('init', 'stardance_register_post_types');

/**
 * Register gallery taxonomies.
 *
 * @return void
 */
function stardance_register_taxonomies() {
    register_taxonomy('gallery_type', array('gallery_item'), array(
        'labels' => array(
            'name'          => __('Gallery Types', 'stardance'),
            'singular_name' => __('Gallery Type', 'stardance'),
            'menu_name'     => __('Gallery Types', 'stardance'),
        ),
        'public'            => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'hierarchical'      => true,
    ));

    register_taxonomy('gallery_year', array('gallery_item'), array(
        'labels' => array(
            'name'          => __('Gallery Years', 'stardance'),
            'singular_name' => __('Gallery Year', 'stardance'),
            'menu_name'     => __('Gallery Years', 'stardance'),
        ),
        'public'            => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'hierarchical'      => true,
    ));
}
add_action('init', 'stardance_register_taxonomies');

/**
 * Download a remote image into the media library and set it as the featured image.
 *
 * @param int    $post_id   Post ID.
 * @param string $image_url Remote image URL.
 * @return void
 */
function stardance_sync_remote_featured_image( $post_id, $image_url ) {
    if ( empty( $post_id ) || empty( $image_url ) ) {
        return;
    }

    $current_source = get_post_meta( $post_id, '_stardance_remote_featured_image', true );
    if ( $current_source === $image_url && has_post_thumbnail( $post_id ) ) {
        return;
    }

    if ( ! function_exists( 'media_sideload_image' ) ) {
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
    }

    $attachment_id = media_sideload_image( $image_url, $post_id, get_the_title( $post_id ), 'id' );

    if ( is_wp_error( $attachment_id ) ) {
        return;
    }

    set_post_thumbnail( $post_id, $attachment_id );
    update_post_meta( $post_id, '_stardance_remote_featured_image', esc_url_raw( $image_url ) );
}

/**
 * Return starter gallery item data.
 *
 * @return array<int, array<string, mixed>>
 */
function stardance_get_gallery_seed_items() {
    $items = array();

    for ( $index = 1; $index <= 16; $index++ ) {
        $items[] = array(
            'title'         => sprintf( 'Gallery Image %02d', $index ),
            'slug'          => sprintf( 'gallery-image-%02d', $index ),
            'image_url'     => sprintf( 'https://stardance.com.cy/wp-content/uploads/2026/03/gallery-%d.png', $index ),
            'gallery_year'  => array( '2026' ),
            'gallery_type'  => array( 'Competition' ),
            'menu_order'    => $index,
        );
    }

    return $items;
}

/**
 * Return gallery query args from filter input.
 *
 * @param array $filters Optional filters.
 * @return array
 */
function stardance_get_gallery_query_args( $filters = array() ) {
    $filters = wp_parse_args($filters, array(
        'gallery_year' => '',
        'gallery_type' => '',
        'posts_per_page' => -1,
        'paged' => 1,
    ));

    $tax_query = array();

    if ( '' !== $filters['gallery_year'] && 'all' !== $filters['gallery_year'] ) {
        $tax_query[] = array(
            'taxonomy' => 'gallery_year',
            'field'    => 'slug',
            'terms'    => sanitize_title( $filters['gallery_year'] ),
        );
    }

    if ( '' !== $filters['gallery_type'] && 'all' !== $filters['gallery_type'] ) {
        $tax_query[] = array(
            'taxonomy' => 'gallery_type',
            'field'    => 'slug',
            'terms'    => sanitize_title( $filters['gallery_type'] ),
        );
    }

    if ( count( $tax_query ) > 1 ) {
        $tax_query['relation'] = 'AND';
    }

    $query_args = array(
        'post_type'      => 'gallery_item',
        'post_status'    => 'publish',
        'posts_per_page' => (int) $filters['posts_per_page'],
        'paged'          => max( 1, (int) $filters['paged'] ),
        'orderby'        => array(
            'menu_order' => 'ASC',
            'date'       => 'DESC',
        ),
    );

    if ( ! empty( $tax_query ) ) {
        $query_args['tax_query'] = $tax_query;
    }

    return $query_args;
}

/**
 * Return gallery filter options from existing gallery items.
 *
 * @return array
 */
function stardance_get_gallery_filter_options() {
    return array(
        'years' => get_terms(array(
            'taxonomy'   => 'gallery_year',
            'hide_empty' => true,
            'orderby'    => 'name',
            'order'      => 'DESC',
        )),
        'types' => get_terms(array(
            'taxonomy'   => 'gallery_type',
            'hide_empty' => true,
            'orderby'    => 'name',
            'order'      => 'ASC',
        )),
    );
}

/**
 * Render Gallery page grid items.
 *
 * @param array $filters Optional filters.
 * @return string
 */
function stardance_get_gallery_grid_markup( $filters = array() ) {
    $query = new WP_Query( stardance_get_gallery_query_args( $filters ) );

    ob_start();

    if ( $query->have_posts() ) {
        $delay = 0;

        while ( $query->have_posts() ) {
            $query->the_post();
            stardance_render_gallery_item( get_the_ID(), min( $delay, 10 ) );
            $delay++;
        }
    } else {
        ?>
        <div class="sd-gallery-page__empty">
            <p class="sd-text">No gallery images match those filters yet.</p>
        </div>
        <?php
    }

    wp_reset_postdata();

    return trim( ob_get_clean() );
}

/**
 * Return gallery query payload for templates and AJAX.
 *
 * @param array $filters Optional filters.
 * @return array
 */
function stardance_get_gallery_query_payload( $filters = array() ) {
    $filters = wp_parse_args($filters, array(
        'gallery_year' => '',
        'gallery_type' => '',
        'posts_per_page' => 12,
        'paged' => 1,
        'animate' => true,
    ));

    $query = new WP_Query( stardance_get_gallery_query_args( $filters ) );

    ob_start();

    if ( $query->have_posts() ) {
        $delay = 0;

        while ( $query->have_posts() ) {
            $query->the_post();
            stardance_render_gallery_item( get_the_ID(), min( $delay, 10 ), (bool) $filters['animate'] );
            $delay++;
        }
    } else {
        if ( (int) $filters['paged'] <= 1 ) {
            ?>
            <div class="sd-gallery-page__empty">
                <p class="sd-text">No gallery images match those filters yet.</p>
            </div>
            <?php
        }
    }

    $markup = trim( ob_get_clean() );
    $current_page = max( 1, (int) $filters['paged'] );
    $has_more = $query->max_num_pages > $current_page;

    wp_reset_postdata();

    return array(
        'markup' => $markup,
        'has_more' => $has_more,
        'max_pages' => (int) $query->max_num_pages,
        'found_posts' => (int) $query->found_posts,
    );
}

// Auto-create pages and sync sample posts.
function stardance_create_pages() {
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
            'excerpt' => 'Master the elegance of international Ballroom dancing. Our program covers all five classic dances: Slow Waltz, Tango, Viennese Waltz, Foxtrot, and Quickstep. Perfect for couples seeking grace, poise, and timeless dance skills.',
            'slug'    => 'european-ballroom',
            'image_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/european-ballroom-class.webp',
            'overlay_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/card-overlay-tall-gold.svg',
            'menu_order' => 1,
        ),
        array(
            'title'   => 'Latin American',
            'excerpt' => 'The international Latin-American dances consist of: Samba, Cha-Cha-Cha, Rumba, Pasodoble, Jive.',
            'slug'    => 'latin-american',
            'image_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/latin-american-class.webp',
            'overlay_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/card-overlay-tall-dark-blue.svg',
            'menu_order' => 2,
        ),
        array(
            'title'   => 'Latin Fusion Ladies',
            'excerpt' => 'A high-energy class designed exclusively for women. Blend Latin dance techniques with fitness and feminine styling. Build confidence, improve coordination, and have fun-no partner required.',
            'slug'    => 'latin-fusion-ladies',
            'image_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/latin-fusion-ladies-class.webp',
            'overlay_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/card-overlay-tall-dark-blue.svg',
            'menu_order' => 3,
        ),
        array(
            'title'   => 'Kids Programs',
            'excerpt' => 'Introduce your child to the joy of dance from age 3 and up. Our kids programs develop coordination, musicality, discipline, and social skills through age-appropriate instruction in both Ballroom and Latin styles.',
            'slug'    => 'kids-program',
            'image_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/kids-programs-class.webp',
            'overlay_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/card-overlay-tall-turquise.svg',
            'menu_order' => 4,
        ),
        array(
            'title'   => 'Wedding Choreography',
            'excerpt' => 'Make your first dance unforgettable. We create custom choreography tailored to your song, skill level, and vision. Private sessions ensure you feel confident and camera-ready on your special day.',
            'slug'    => 'wedding-choreography',
            'image_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/wedding-choreography-class.webp',
            'overlay_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/card-overlay-tall-turquise.svg',
            'menu_order' => 5,
        ),
        array(
            'title'   => 'Individual Lessons',
            'excerpt' => 'Accelerate your progress with one-on-one instruction. Private lessons are ideal for competition preparation, perfecting specific techniques, or learning at your own pace with personalized attention from our coaches.',
            'slug'    => 'individual-lessons',
            'image_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/individual-lessons-class.webp',
            'overlay_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/card-overlay-tall-gold.svg',
            'menu_order' => 6,
        ),
    );

    foreach ( $classes as $class_data ) {
        $existing = get_page_by_path($class_data['slug'], OBJECT, 'dance_class');
        $post_args = array(
            'post_title'   => $class_data['title'],
            'post_name'    => $class_data['slug'],
            'post_excerpt' => $class_data['excerpt'],
            'post_content' => $class_data['excerpt'],
            'post_status'  => 'publish',
            'post_type'    => 'dance_class',
            'post_author'  => 1,
            'menu_order'   => $class_data['menu_order'],
        );

        if ( $existing ) {
            $post_args['ID'] = $existing->ID;
            $post_id = wp_update_post( $post_args, true );
        } else {
            $post_id = wp_insert_post( $post_args, true );
        }

        if ( $post_id && ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, '_stardance_overlay_url', esc_url_raw( $class_data['overlay_url'] ) );
            stardance_sync_remote_featured_image( $post_id, $class_data['image_url'] );
        }
    }

    $gallery_types = array( 'Competition' );
    $gallery_years = array( '2026' );

    foreach ( $gallery_types as $gallery_type ) {
        if ( ! term_exists( $gallery_type, 'gallery_type' ) ) {
            wp_insert_term( $gallery_type, 'gallery_type' );
        }
    }

    foreach ( $gallery_years as $gallery_year ) {
        if ( ! term_exists( $gallery_year, 'gallery_year' ) ) {
            wp_insert_term( $gallery_year, 'gallery_year' );
        }
    }

    foreach ( stardance_get_gallery_seed_items() as $gallery_item ) {
        $existing = get_page_by_path( $gallery_item['slug'], OBJECT, 'gallery_item' );
        $post_args = array(
            'post_title'   => $gallery_item['title'],
            'post_name'    => $gallery_item['slug'],
            'post_excerpt' => $gallery_item['title'],
            'post_content' => $gallery_item['title'],
            'post_status'  => 'publish',
            'post_type'    => 'gallery_item',
            'post_author'  => 1,
            'menu_order'   => $gallery_item['menu_order'],
        );

        if ( $existing ) {
            $post_args['ID'] = $existing->ID;
            $post_id = wp_update_post( $post_args, true );
        } else {
            $post_id = wp_insert_post( $post_args, true );
        }

        if ( $post_id && ! is_wp_error( $post_id ) ) {
            wp_set_object_terms( $post_id, $gallery_item['gallery_year'], 'gallery_year', false );
            wp_set_object_terms( $post_id, $gallery_item['gallery_type'], 'gallery_type', false );
            stardance_sync_remote_featured_image( $post_id, $gallery_item['image_url'] );
        }
    }
}

/**
 * Run initial setup tasks that require a rewrite flush.
 *
 * @return void
 */
function stardance_activate_theme_setup() {
    stardance_create_pages();
    flush_rewrite_rules();
    update_option('stardance_pages_created', true);
    update_option('stardance_rewrite_version', STARDANCE_REWRITE_VERSION );
}
add_action('after_switch_theme', 'stardance_activate_theme_setup');
add_action('admin_init', 'stardance_create_pages');

/**
 * Flush rewrite rules once after routing changes.
 *
 * @return void
 */
function stardance_maybe_flush_rewrite_rules() {
    if ( get_option( 'stardance_rewrite_version' ) === STARDANCE_REWRITE_VERSION ) {
        return;
    }

    flush_rewrite_rules();
    update_option( 'stardance_rewrite_version', STARDANCE_REWRITE_VERSION );
}
add_action( 'admin_init', 'stardance_maybe_flush_rewrite_rules', 20 );

/**
 * AJAX callback for Gallery page filtering.
 *
 * @return void
 */
function stardance_filter_gallery() {
    check_ajax_referer( 'stardance_gallery_nonce', 'nonce' );

    $filters = array(
        'gallery_year'   => sanitize_text_field( $_POST['gallery_year'] ?? '' ),
        'gallery_type'   => sanitize_text_field( $_POST['gallery_type'] ?? '' ),
        'posts_per_page' => max( 1, (int) ( $_POST['posts_per_page'] ?? 12 ) ),
        'paged'          => max( 1, (int) ( $_POST['paged'] ?? 1 ) ),
        'animate'        => false,
    );

    $payload = stardance_get_gallery_query_payload( $filters );

    wp_send_json_success(array(
        'markup'   => $payload['markup'],
        'has_more' => $payload['has_more'],
        'max_pages' => $payload['max_pages'],
        'found_posts' => $payload['found_posts'],
    ));
}
add_action('wp_ajax_stardance_filter_gallery', 'stardance_filter_gallery');
add_action('wp_ajax_nopriv_stardance_filter_gallery', 'stardance_filter_gallery');

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
