<?php
/**
 * Coaches custom post type and seed data.
 *
 * @package stardance
 */

/**
 * Register coach custom post type.
 *
 * @return void
 */
function stardance_register_coach_post_type() {
    register_post_type(
        'coach',
        array(
            'labels' => array(
                'name'               => __( 'Coaches', 'stardance' ),
                'singular_name'      => __( 'Coach', 'stardance' ),
                'add_new'            => __( 'Add New Coach', 'stardance' ),
                'add_new_item'       => __( 'Add New Coach', 'stardance' ),
                'edit_item'          => __( 'Edit Coach', 'stardance' ),
                'new_item'           => __( 'New Coach', 'stardance' ),
                'view_item'          => __( 'View Coach', 'stardance' ),
                'search_items'       => __( 'Search Coaches', 'stardance' ),
                'not_found'          => __( 'No coaches found', 'stardance' ),
                'not_found_in_trash' => __( 'No coaches found in trash', 'stardance' ),
                'menu_name'          => __( 'Coaches', 'stardance' ),
            ),
            'public'              => true,
            'publicly_queryable'  => false,
            'exclude_from_search' => true,
            'has_archive'         => false,
            'rewrite'             => false,
            'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
            'menu_icon'           => 'dashicons-groups',
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 24,
            'show_in_rest'        => true,
        )
    );
}
add_action( 'init', 'stardance_register_coach_post_type' );

/**
 * Seed default coaches.
 *
 * @return void
 */
function stardance_seed_coaches() {
    $coaches = array(
        array(
            'title'      => 'Svetlana Grincevschi',
            'slug'       => 'svetlana-grincevschi',
            'content'    => 'International Adjudicator (License "A") with the World Dance Sport Federation, qualified to judge Latin American and European Standard dance competitions.' . "\n\n" . 'Since 2007, Svetlana has coached champions from Cyprus, Israel, Italy, Greece, Estonia, Poland, Macedonia, and Ireland. Her students compete at the finals level in major international competitions, including events in Stuttgart, Blackpool, and Boston.',
            'menu_order' => 1,
        ),
        array(
            'title'      => 'Olga Turbin',
            'slug'       => 'olga-turbin',
            'content'    => '',
            'menu_order' => 2,
        ),
        array(
            'title'      => 'Vladimir Merinov',
            'slug'       => 'vladimir-merinov',
            'content'    => '',
            'menu_order' => 3,
        ),
    );

    foreach ( $coaches as $coach_data ) {
        $existing = get_page_by_path( $coach_data['slug'], OBJECT, 'coach' );
        $post_args = array(
            'post_title'   => $coach_data['title'],
            'post_name'    => $coach_data['slug'],
            'post_content' => $coach_data['content'],
            'post_status'  => 'publish',
            'post_type'    => 'coach',
            'post_author'  => 1,
            'menu_order'   => $coach_data['menu_order'],
        );

        if ( $existing ) {
            $post_args['ID'] = $existing->ID;
            wp_update_post( $post_args, true );
        } else {
            wp_insert_post( $post_args, true );
        }
    }
}
