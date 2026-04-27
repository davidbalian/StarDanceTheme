<?php
/**
 * Star Dance Studio Theme Functions
 */

// Reusable component render functions
require get_template_directory() . '/inc/components.php';
require get_template_directory() . '/inc/class-detail-card.php';
require get_template_directory() . '/inc/class-stardance-nav-menu-registrar.php';
require get_template_directory() . '/inc/coaches.php';

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

    return '3.0.0';
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

define( 'STARDANCE_REWRITE_VERSION', '2026-04-single-sd-event' );

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
        wp_enqueue_script('stardance-events', get_template_directory_uri() . '/assets/js/events.js', array(), stardance_asset_version('assets/js/events.js'), true);
        wp_localize_script('stardance-events', 'stardanceEvents', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('stardance_events_nonce'),
        ));
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
    if ( is_page_template('page-contact.php') ) {
        wp_enqueue_style('stardance-page-contact', $pages_css_dir . 'contact.css', array('stardance-responsive'), stardance_asset_version('assets/css/pages/contact.css'));
    }
    if ( is_singular('dance_class') ) {
        wp_enqueue_style('stardance-single-class', $pages_css_dir . 'single-class.css', array('stardance-responsive'), stardance_asset_version('assets/css/pages/single-class.css'));
        wp_enqueue_style('stardance-single-class-sections', $pages_css_dir . 'single-class-sections.css', array('stardance-single-class'), stardance_asset_version('assets/css/pages/single-class-sections.css'));
    }
    if ( is_singular( 'sd_event' ) ) {
        wp_enqueue_style( 'stardance-single-event', $pages_css_dir . 'single-event.css', array( 'stardance-responsive' ), stardance_asset_version( 'assets/css/pages/single-event.css' ) );
    }

    // Theme Scripts
    wp_enqueue_script('stardance-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), stardance_asset_version('assets/js/navigation.js'), true);
    wp_enqueue_script('stardance-animations', get_template_directory_uri() . '/assets/js/animations.js', array(), stardance_asset_version('assets/js/animations.js'), true);
    wp_enqueue_script('stardance-faq', get_template_directory_uri() . '/assets/js/faq.js', array(), stardance_asset_version('assets/js/faq.js'), true);
    wp_enqueue_script('stardance-gallery', get_template_directory_uri() . '/assets/js/gallery.js', array(), stardance_asset_version('assets/js/gallery.js'), true);
    wp_enqueue_script('stardance-contact-form', get_template_directory_uri() . '/assets/js/contact-form.js', array(), stardance_asset_version('assets/js/contact-form.js'), true);

    $uploads = wp_get_upload_dir();
    $gallery_arrow = '';
    if ( empty( $uploads['error'] ) && ! empty( $uploads['baseurl'] ) ) {
        $gallery_arrow = trailingslashit( $uploads['baseurl'] ) . '2026/03/left-arrow.svg';
    }

    wp_localize_script(
        'stardance-gallery',
        'stardanceGallery',
        array(
            'ajaxurl'          => admin_url( 'admin-ajax.php' ),
            'nonce'            => wp_create_nonce( 'stardance_gallery_nonce' ),
            'lightboxArrowUrl' => $gallery_arrow ? esc_url_raw( $gallery_arrow ) : '',
        )
    );

    // Localize script for AJAX
    wp_localize_script('stardance-contact-form', 'stardanceAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('stardance_contact_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'stardance_enqueue_assets');

// Register dance_class Custom Post Type
function stardance_register_post_types() {
    // Listing uses the Page with slug "classes"; singles use /classes/{post_name}/ (has_archive false).
    // WordPress serves the page at /classes/ and class singles under the same base segment.
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

    // Listing uses the Page with slug "events"; singles use /events/{post_name}/ (has_archive false).
    register_post_type('sd_event', array(
        'labels' => array(
            'name'               => __('Events', 'stardance'),
            'singular_name'      => __('Event', 'stardance'),
            'add_new'            => __('Add New Event', 'stardance'),
            'add_new_item'       => __('Add New Event', 'stardance'),
            'edit_item'          => __('Edit Event', 'stardance'),
            'new_item'           => __('New Event', 'stardance'),
            'view_item'          => __('View Event', 'stardance'),
            'search_items'       => __('Search Events', 'stardance'),
            'not_found'          => __('No events found', 'stardance'),
            'not_found_in_trash' => __('No events found in trash', 'stardance'),
            'menu_name'          => __('Events', 'stardance'),
        ),
        'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => true,
        'has_archive'         => false,
        'rewrite'             => array( 'slug' => 'events' ),
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'menu_icon'           => 'dashicons-calendar-alt',
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 23,
        'show_in_rest'        => true,
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

    register_taxonomy('event_year', array('sd_event'), array(
        'labels' => array(
            'name'          => __('Event Years', 'stardance'),
            'singular_name' => __('Event Year', 'stardance'),
            'menu_name'     => __('Event Years', 'stardance'),
        ),
        'public'            => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'hierarchical'      => true,
    ));

    register_taxonomy('event_category', array('sd_event'), array(
        'labels' => array(
            'name'          => __('Event Categories', 'stardance'),
            'singular_name' => __('Event Category', 'stardance'),
            'menu_name'     => __('Event Categories', 'stardance'),
        ),
        'public'            => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'hierarchical'      => true,
    ));

    register_taxonomy('event_type', array('sd_event'), array(
        'labels' => array(
            'name'          => __('Event Types', 'stardance'),
            'singular_name' => __('Event Type', 'stardance'),
            'menu_name'     => __('Event Types', 'stardance'),
        ),
        'public'            => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'hierarchical'      => true,
    ));

    register_taxonomy('event_style', array('sd_event'), array(
        'labels' => array(
            'name'          => __('Event Styles', 'stardance'),
            'singular_name' => __('Event Style', 'stardance'),
            'menu_name'     => __('Event Styles', 'stardance'),
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

/**
 * Permalink for a published page by slug, or a home_url path fallback if the page is missing.
 *
 * @param string $slug Page post_name (no slashes).
 * @return string
 */
function stardance_page_or_path_url( string $slug ): string {
    $page = get_page_by_path( $slug, OBJECT, 'page' );
    if ( $page instanceof WP_Post ) {
        return get_permalink( $page );
    }

    return home_url( '/' . trim( $slug, '/' ) . '/' );
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
        array(
            'title'    => 'Contact',
            'template' => 'page-contact.php',
            'slug'     => 'contact',
        ),
        array(
            'title'    => 'Privacy Policy',
            'template' => '',
            'slug'     => 'privacy-policy',
        ),
        array(
            'title'    => 'Cookie Policy',
            'template' => '',
            'slug'     => 'cookie-policy',
        ),
    );

    foreach ( $pages as $page_data ) {
        $existing = get_page_by_path( $page_data['slug'], OBJECT, 'page' );
        if ( $existing ) {
            if ( ! empty( $page_data['template'] ) ) {
                update_post_meta( $existing->ID, '_wp_page_template', $page_data['template'] );
            }
            continue;
        }
        $page_id = wp_insert_post(
            array(
                'post_title'   => $page_data['title'],
                'post_name'    => $page_data['slug'],
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_author'  => 1,
                'post_content' => '',
            )
        );
        if ( $page_id && ! is_wp_error( $page_id ) && ! empty( $page_data['template'] ) ) {
            update_post_meta( $page_id, '_wp_page_template', $page_data['template'] );
        }
    }

    stardance_seed_coaches();

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

    // Seed event taxonomy terms
    $event_years      = array( '2026' );
    $event_categories = array( 'Cyprus National Competitions', 'WDSF International Competitions', 'Performances', 'Cyprus Cup' );
    $event_types      = array( 'Championships', 'Cyprus Cup', 'Classification Tournaments' );
    $event_styles     = array( 'Solo', 'Couples', 'Show Dances' );

    foreach ( $event_years as $term ) {
        if ( ! term_exists( $term, 'event_year' ) ) {
            wp_insert_term( $term, 'event_year' );
        }
    }
    foreach ( $event_categories as $term ) {
        if ( ! term_exists( $term, 'event_category' ) ) {
            wp_insert_term( $term, 'event_category' );
        }
    }
    foreach ( $event_types as $term ) {
        if ( ! term_exists( $term, 'event_type' ) ) {
            wp_insert_term( $term, 'event_type' );
        }
    }
    foreach ( $event_styles as $term ) {
        if ( ! term_exists( $term, 'event_style' ) ) {
            wp_insert_term( $term, 'event_style' );
        }
    }

    // Seed sample events
    $seed_events = array();
    for ( $i = 1; $i <= 6; $i++ ) {
        $seed_events[] = array(
            'title'       => 'Cyprus National Dance Championship',
            'slug'        => 'cyprus-national-dance-championship-' . $i,
            'excerpt'     => 'Annual national championship organized by the Cyprus Federation of Social & Sport Dance. Open to all age categories and levels.',
            'image_url'   => 'https://stardance.com.cy/wp-content/uploads/2026/03/seed-events-' . $i . '.webp',
            'event_date'  => 'March 15, 2026',
            'event_location' => 'Nicosia, Cyprus',
            'event_link'  => '',
            'year'        => array( '2026' ),
            'category'    => array( 'Cyprus National Competitions' ),
            'type'        => array( 'Championships' ),
            'style'       => array( 'Solo', 'Couples', 'Show Dances' ),
            'menu_order'  => $i,
        );
    }

    foreach ( $seed_events as $event_data ) {
        $existing = get_page_by_path( $event_data['slug'], OBJECT, 'sd_event' );
        $post_args = array(
            'post_title'   => $event_data['title'],
            'post_name'    => $event_data['slug'],
            'post_excerpt' => $event_data['excerpt'],
            'post_content' => $event_data['excerpt'],
            'post_status'  => 'publish',
            'post_type'    => 'sd_event',
            'post_author'  => 1,
            'menu_order'   => $event_data['menu_order'],
        );

        if ( $existing ) {
            $post_args['ID'] = $existing->ID;
            $post_id = wp_update_post( $post_args, true );
        } else {
            $post_id = wp_insert_post( $post_args, true );
        }

        if ( $post_id && ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, 'event_date', $event_data['event_date'] );
            update_post_meta( $post_id, 'event_location', $event_data['event_location'] );
            update_post_meta( $post_id, 'event_link', $event_data['event_link'] );
            wp_set_object_terms( $post_id, $event_data['year'], 'event_year', false );
            wp_set_object_terms( $post_id, $event_data['category'], 'event_category', false );
            wp_set_object_terms( $post_id, $event_data['type'], 'event_type', false );
            wp_set_object_terms( $post_id, $event_data['style'], 'event_style', false );
            stardance_sync_remote_featured_image( $post_id, $event_data['image_url'] );
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
    $nav_registrar = new Stardance_Nav_Menu_Registrar();
    $nav_registrar->ensure_default_menus();
    flush_rewrite_rules();
    update_option('stardance_pages_created', true);
    update_option('stardance_rewrite_version', STARDANCE_REWRITE_VERSION );
}
add_action('after_switch_theme', 'stardance_activate_theme_setup');
add_action('admin_init', 'stardance_create_pages');

/**
 * Assign preset nav menus when locations are empty.
 *
 * Runs on admin_init because wp_update_nav_menu_item() requires edit_theme_options;
 * unauthenticated front-end requests cannot provision menus. Theme activation also
 * calls Stardance_Nav_Menu_Registrar::ensure_default_menus() while an admin is switching themes.
 *
 * After deploy, confirm under Settings → Reading that a static front page is set (for /contact
 * and section anchors on the home template), and under Appearance → Menus that Primary/Footer
 * URLs match intent. For events, validate `event_link` meta on sd_event posts when used.
 *
 * @return void
 */
function stardance_ensure_default_nav_menus() {
    $nav_registrar = new Stardance_Nav_Menu_Registrar();
    $nav_registrar->ensure_default_menus();
}
add_action( 'admin_init', 'stardance_ensure_default_nav_menus', 15 );

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
 * Add event details meta box.
 *
 * @return void
 */
function stardance_add_event_meta_box() {
    add_meta_box(
        'stardance_event_details',
        __('Event Details', 'stardance'),
        'stardance_render_event_meta_box',
        'sd_event',
        'side',
        'default'
    );
    add_meta_box(
        'stardance_event_content',
        __('Event description, schedule & gallery', 'stardance'),
        'stardance_render_event_content_meta_box',
        'sd_event',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'stardance_add_event_meta_box');

/**
 * Enqueue admin scripts for sd_event gallery picker.
 *
 * @param string $hook_suffix Current admin screen hook.
 * @return void
 */
function stardance_event_admin_enqueue( $hook_suffix ) {
    if ( ! in_array( $hook_suffix, array( 'post.php', 'post-new.php' ), true ) ) {
        return;
    }
    $screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
    if ( ! $screen || 'sd_event' !== $screen->post_type ) {
        return;
    }

    wp_enqueue_media();
    wp_enqueue_script(
        'stardance-admin-event-gallery',
        get_template_directory_uri() . '/assets/js/admin-sd-event-gallery.js',
        array( 'jquery' ),
        stardance_asset_version( 'assets/js/admin-sd-event-gallery.js' ),
        true
    );
    wp_localize_script(
        'stardance-admin-event-gallery',
        'stardanceEventAdmin',
        array(
            'galleryTitle'  => __( 'Event gallery images', 'stardance' ),
            'galleryButton' => __( 'Use images', 'stardance' ),
        )
    );
}
add_action( 'admin_enqueue_scripts', 'stardance_event_admin_enqueue' );

/**
 * Parsed attachment IDs for event gallery meta.
 *
 * @param int $post_id Event post ID.
 * @return int[]
 */
function stardance_get_event_gallery_ids( $post_id ) {
    $post_id = absint( $post_id );
    if ( ! $post_id ) {
        return array();
    }
    $raw = get_post_meta( $post_id, 'event_gallery_ids', true );
    if ( ! is_string( $raw ) || '' === $raw ) {
        return array();
    }
    $parts = preg_split( '/\s*,\s*/', $raw, -1, PREG_SPLIT_NO_EMPTY );
    $ids   = array();
    foreach ( $parts as $p ) {
        $n = absint( $p );
        if ( $n ) {
            $ids[] = $n;
        }
    }
    return array_values( array_unique( $ids ) );
}

/**
 * Render event details meta box.
 *
 * @param WP_Post $post Post object.
 * @return void
 */
function stardance_render_event_meta_box( $post ) {
    wp_nonce_field( 'stardance_save_event_meta', 'stardance_event_meta_nonce' );
    $event_date     = get_post_meta( $post->ID, 'event_date', true );
    $event_location = get_post_meta( $post->ID, 'event_location', true );
    $event_link     = get_post_meta( $post->ID, 'event_link', true );
    ?>
    <p>
        <label for="stardance_event_date"><strong><?php esc_html_e( 'Event Date', 'stardance' ); ?></strong></label>
    </p>
    <p>
        <input type="text" id="stardance_event_date" name="stardance_event_date" value="<?php echo esc_attr( $event_date ); ?>" class="widefat" placeholder="March 15, 2026">
    </p>
    <p>
        <label for="stardance_event_location"><strong><?php esc_html_e( 'Location', 'stardance' ); ?></strong></label>
    </p>
    <p>
        <input type="text" id="stardance_event_location" name="stardance_event_location" value="<?php echo esc_attr( $event_location ); ?>" class="widefat" placeholder="Nicosia, Cyprus">
    </p>
    <p>
        <label for="stardance_event_link"><strong><?php esc_html_e( 'Learn More URL', 'stardance' ); ?></strong></label>
    </p>
    <p>
        <input type="url" id="stardance_event_link" name="stardance_event_link" value="<?php echo esc_attr( $event_link ); ?>" class="widefat" placeholder="https://">
    </p>
    <?php
}

/**
 * Render event content / schedule / gallery meta box.
 *
 * @param WP_Post $post Post object.
 * @return void
 */
function stardance_render_event_content_meta_box( $post ) {
    $gallery_ids = stardance_get_event_gallery_ids( $post->ID );
    $ids_string  = implode( ',', $gallery_ids );
    $schedule    = get_post_meta( $post->ID, 'event_schedule', true );
    if ( ! is_string( $schedule ) ) {
        $schedule = '';
    }
    ?>
    <p>
        <label for="stardance_event_short_description"><strong><?php esc_html_e( 'Short description', 'stardance' ); ?></strong></label>
    </p>
    <p class="description"><?php esc_html_e( 'Shown in the hero and on event cards. The main editor below is the full “about” text.', 'stardance' ); ?></p>
    <p>
        <textarea id="stardance_event_short_description" name="stardance_event_short_description" class="widefat" rows="3"><?php echo esc_textarea( $post->post_excerpt ); ?></textarea>
    </p>
    <p>
        <label for="stardance_event_schedule"><strong><?php esc_html_e( 'Event schedule', 'stardance' ); ?></strong></label>
    </p>
    <?php
    wp_editor(
        $schedule,
        'stardance_event_schedule',
        array(
            'textarea_name' => 'stardance_event_schedule',
            'media_buttons' => false,
            'teeny'         => true,
            'quicktags'     => true,
            'textarea_rows' => 8,
        )
    );
    ?>
    <p style="margin-top:1em;">
        <strong><?php esc_html_e( 'Event gallery', 'stardance' ); ?></strong>
    </p>
    <p class="description"><?php esc_html_e( 'Optional images for the single event page (opens in the site lightbox).', 'stardance' ); ?></p>
    <input type="hidden" id="stardance_event_gallery_ids" name="stardance_event_gallery_ids" value="<?php echo esc_attr( $ids_string ); ?>">
    <p>
        <button type="button" class="button" id="stardance-event-gallery-add"><?php esc_html_e( 'Add images', 'stardance' ); ?></button>
        <button type="button" class="button" id="stardance-event-gallery-clear"><?php esc_html_e( 'Clear all', 'stardance' ); ?></button>
    </p>
    <div id="stardance-event-gallery-preview" class="stardance-event-gallery-preview">
        <?php
        foreach ( $gallery_ids as $att_id ) {
            echo wp_get_attachment_image(
                $att_id,
                'thumbnail',
                false,
                array(
                    'class' => 'stardance-event-gallery-preview__img',
                    'style' => 'width:72px;height:72px;object-fit:cover;border-radius:4px;margin:0 6px 6px 0;',
                )
            );
        }
        ?>
    </div>
    <?php
}

/**
 * Save event meta.
 *
 * @param int $post_id Post ID.
 * @return void
 */
function stardance_save_event_meta( $post_id ) {
    if ( empty( $_POST['stardance_event_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['stardance_event_meta_nonce'] ) ), 'stardance_save_event_meta' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['stardance_event_short_description'] ) ) {
        $excerpt = sanitize_textarea_field( wp_unslash( $_POST['stardance_event_short_description'] ) );
        $current = (string) get_post_field( 'post_excerpt', $post_id, 'raw' );
        if ( $current !== $excerpt ) {
            remove_action( 'save_post_sd_event', 'stardance_save_event_meta' );
            wp_update_post(
                array(
                    'ID'           => $post_id,
                    'post_excerpt' => $excerpt,
                )
            );
            add_action( 'save_post_sd_event', 'stardance_save_event_meta' );
        }
    }

    if ( isset( $_POST['stardance_event_date'] ) ) {
        update_post_meta( $post_id, 'event_date', sanitize_text_field( wp_unslash( $_POST['stardance_event_date'] ) ) );
    }
    if ( isset( $_POST['stardance_event_location'] ) ) {
        update_post_meta( $post_id, 'event_location', sanitize_text_field( wp_unslash( $_POST['stardance_event_location'] ) ) );
    }
    if ( isset( $_POST['stardance_event_link'] ) ) {
        update_post_meta( $post_id, 'event_link', esc_url_raw( wp_unslash( $_POST['stardance_event_link'] ) ) );
    }

    if ( isset( $_POST['stardance_event_schedule'] ) ) {
        update_post_meta( $post_id, 'event_schedule', wp_kses_post( wp_unslash( $_POST['stardance_event_schedule'] ) ) );
    }

    if ( isset( $_POST['stardance_event_gallery_ids'] ) ) {
        $raw = wp_unslash( $_POST['stardance_event_gallery_ids'] );
        $raw = is_string( $raw ) ? $raw : '';
        $parts = preg_split( '/\s*,\s*/', $raw, -1, PREG_SPLIT_NO_EMPTY );
        $ids   = array();
        foreach ( $parts as $p ) {
            $n = absint( $p );
            if ( $n ) {
                $ids[] = $n;
            }
        }
        $ids = array_values( array_unique( $ids ) );
        update_post_meta( $post_id, 'event_gallery_ids', implode( ',', $ids ) );
    }
}
add_action('save_post_sd_event', 'stardance_save_event_meta');

/**
 * Return event query args from filter input.
 *
 * @param array $filters Optional filters.
 * @return array
 */
function stardance_get_events_query_args( $filters = array() ) {
    $filters = wp_parse_args($filters, array(
        'event_year'     => '',
        'event_category' => '',
        'event_type'     => '',
        'event_style'    => '',
        'posts_per_page' => -1,
        'paged'          => 1,
    ));

    $tax_query = array();

    if ( '' !== $filters['event_year'] && 'all' !== $filters['event_year'] ) {
        $tax_query[] = array(
            'taxonomy' => 'event_year',
            'field'    => 'slug',
            'terms'    => sanitize_title( $filters['event_year'] ),
        );
    }

    if ( '' !== $filters['event_category'] && 'all' !== $filters['event_category'] ) {
        $tax_query[] = array(
            'taxonomy' => 'event_category',
            'field'    => 'slug',
            'terms'    => sanitize_title( $filters['event_category'] ),
        );
    }

    if ( '' !== $filters['event_type'] && 'all' !== $filters['event_type'] ) {
        $tax_query[] = array(
            'taxonomy' => 'event_type',
            'field'    => 'slug',
            'terms'    => sanitize_title( $filters['event_type'] ),
        );
    }

    if ( '' !== $filters['event_style'] && 'all' !== $filters['event_style'] ) {
        $tax_query[] = array(
            'taxonomy' => 'event_style',
            'field'    => 'slug',
            'terms'    => sanitize_title( $filters['event_style'] ),
        );
    }

    if ( count( $tax_query ) > 1 ) {
        $tax_query['relation'] = 'AND';
    }

    $query_args = array(
        'post_type'      => 'sd_event',
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
 * Return events filter options from existing terms.
 *
 * @return array
 */
function stardance_get_events_filter_options() {
    return array(
        'years'      => get_terms(array(
            'taxonomy'   => 'event_year',
            'hide_empty' => true,
            'orderby'    => 'name',
            'order'      => 'DESC',
        )),
        'categories' => get_terms(array(
            'taxonomy'   => 'event_category',
            'hide_empty' => true,
            'orderby'    => 'name',
            'order'      => 'ASC',
        )),
        'types'      => get_terms(array(
            'taxonomy'   => 'event_type',
            'hide_empty' => true,
            'orderby'    => 'name',
            'order'      => 'ASC',
        )),
        'styles'     => get_terms(array(
            'taxonomy'   => 'event_style',
            'hide_empty' => true,
            'orderby'    => 'name',
            'order'      => 'ASC',
        )),
    );
}

/**
 * Return events query payload for templates and AJAX.
 *
 * @param array $filters Optional filters.
 * @return array
 */
function stardance_get_events_query_payload( $filters = array() ) {
    $filters = wp_parse_args($filters, array(
        'event_year'     => '',
        'event_category' => '',
        'event_type'     => '',
        'event_style'    => '',
        'posts_per_page' => 12,
        'paged'          => 1,
        'animate'        => true,
    ));

    $query = new WP_Query( stardance_get_events_query_args( $filters ) );

    ob_start();

    if ( $query->have_posts() ) {
        $delay = 0;

        while ( $query->have_posts() ) {
            $query->the_post();
            stardance_render_event_item( get_the_ID(), min( $delay, 10 ), (bool) $filters['animate'] );
            $delay++;
        }
    } else {
        if ( (int) $filters['paged'] <= 1 ) {
            ?>
            <div class="sd-events-page__empty">
                <p class="sd-text">No events match those filters yet.</p>
            </div>
            <?php
        }
    }

    $markup = trim( ob_get_clean() );
    $current_page = max( 1, (int) $filters['paged'] );
    $has_more = $query->max_num_pages > $current_page;

    wp_reset_postdata();

    return array(
        'markup'      => $markup,
        'has_more'    => $has_more,
        'max_pages'   => (int) $query->max_num_pages,
        'found_posts' => (int) $query->found_posts,
    );
}

/**
 * AJAX callback for Events page filtering.
 *
 * @return void
 */
function stardance_filter_events() {
    check_ajax_referer( 'stardance_events_nonce', 'nonce' );

    $filters = array(
        'event_year'     => sanitize_text_field( $_POST['event_year'] ?? '' ),
        'event_category' => sanitize_text_field( $_POST['event_category'] ?? '' ),
        'event_type'     => sanitize_text_field( $_POST['event_type'] ?? '' ),
        'event_style'    => sanitize_text_field( $_POST['event_style'] ?? '' ),
        'posts_per_page' => max( 1, (int) ( $_POST['posts_per_page'] ?? 12 ) ),
        'paged'          => max( 1, (int) ( $_POST['paged'] ?? 1 ) ),
        'animate'        => false,
    );

    $payload = stardance_get_events_query_payload( $filters );

    wp_send_json_success(array(
        'markup'      => $payload['markup'],
        'has_more'    => $payload['has_more'],
        'max_pages'   => $payload['max_pages'],
        'found_posts' => $payload['found_posts'],
    ));
}
add_action('wp_ajax_stardance_filter_events', 'stardance_filter_events');
add_action('wp_ajax_nopriv_stardance_filter_events', 'stardance_filter_events');

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
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'stardance' ); ?></a></li>
        <li><a href="<?php echo esc_url( stardance_page_or_path_url( 'about' ) ); ?>"><?php esc_html_e( 'About', 'stardance' ); ?></a></li>
        <li><a href="<?php echo esc_url( stardance_page_or_path_url( 'classes' ) ); ?>"><?php esc_html_e( 'Classes', 'stardance' ); ?></a></li>
        <li><a href="<?php echo esc_url( stardance_page_or_path_url( 'events' ) ); ?>"><?php esc_html_e( 'Events', 'stardance' ); ?></a></li>
        <li><a href="<?php echo esc_url( stardance_page_or_path_url( 'schedule' ) ); ?>"><?php esc_html_e( 'Schedule', 'stardance' ); ?></a></li>
        <li><a href="<?php echo esc_url( stardance_page_or_path_url( 'gallery' ) ); ?>"><?php esc_html_e( 'Gallery', 'stardance' ); ?></a></li>
        <li><a href="<?php echo esc_url( stardance_page_or_path_url( 'contact' ) ); ?>"><?php esc_html_e( 'Contact', 'stardance' ); ?></a></li>
    </ul>
    <?php
}

function stardance_fallback_footer_menu() {
    ?>
    <ul class="sd-footer__menu">
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'stardance' ); ?></a></li>
        <li><a href="<?php echo esc_url( stardance_page_or_path_url( 'about' ) ); ?>"><?php esc_html_e( 'About Us', 'stardance' ); ?></a></li>
        <li><a href="<?php echo esc_url( home_url( '/#coaches' ) ); ?>"><?php esc_html_e( 'Meet the Coaches', 'stardance' ); ?></a></li>
        <li><a href="<?php echo esc_url( stardance_page_or_path_url( 'classes' ) ); ?>"><?php esc_html_e( 'Dance Classes', 'stardance' ); ?></a></li>
        <li><a href="<?php echo esc_url( stardance_page_or_path_url( 'schedule' ) ); ?>"><?php esc_html_e( 'Timetable', 'stardance' ); ?></a></li>
        <li><a href="<?php echo esc_url( stardance_page_or_path_url( 'contact' ) ); ?>"><?php esc_html_e( 'Contact', 'stardance' ); ?></a></li>
    </ul>
    <?php
}
