<?php
/**
 * Dance class overlay card grid (shared by home and Classes page).
 *
 * @package stardance
 */

/**
 * Output overlay cards for all published dance_class posts.
 *
 * @param array $args {
 *     @type bool $show_description When true, card uses the post excerpt as description text. Default false.
 * }
 */
function stardance_render_dance_class_overlay_cards( $args = array() ) {
    $args = wp_parse_args(
        $args,
        array(
            'show_description' => false,
        )
    );

    $classes_query = new WP_Query(
        array(
            'post_type'      => 'dance_class',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => array(
                'menu_order' => 'ASC',
                'title'      => 'ASC',
            ),
            'order'          => 'ASC',
        )
    );

    if ( ! $classes_query->have_posts() ) {
        wp_reset_postdata();
        return;
    }

    $delay = 1;
    while ( $classes_query->have_posts() ) {
        $classes_query->the_post();

        $image_url   = get_the_post_thumbnail_url( get_the_ID(), 'large' );
        $overlay_url = get_post_meta( get_the_ID(), '_stardance_overlay_url', true );
        $modifier    = 'navy';

        if ( false !== strpos( $overlay_url, 'gold' ) ) {
            $modifier = 'gold';
        } elseif ( false !== strpos( $overlay_url, 'turquise' ) || false !== strpos( $overlay_url, 'turquoise' ) ) {
            $modifier = 'turquoise';
        }

        $description = '';
        if ( $args['show_description'] ) {
            $raw = get_post_field( 'post_excerpt', get_the_ID() );
            if ( '' !== $raw ) {
                $description = wp_strip_all_tags( $raw );
            }
        }

        stardance_render_overlay_card(
            array(
                'image_url'      => $image_url,
                'decoration_url' => $overlay_url,
                'title'          => get_the_title(),
                'description'    => $description,
                'link_url'       => get_permalink(),
                'card_wrap_link' => true,
                'variant'        => 'tall',
                'modifier'       => $modifier,
                'delay'          => min( $delay, 10 ),
            )
        );

        $delay++;
    }

    wp_reset_postdata();
}
