<?php
/**
 * Dance class overlay card grid (shared by home and Classes page).
 *
 * @package stardance
 */

/**
 * Output overlay cards for all published dance_class posts.
 *
 * The same markup is rendered everywhere this function is used (home and
 * Classes page) so the cards stay visually identical. Whether the description
 * is visible is controlled by CSS scoped to the parent section, not by markup,
 * which keeps the title position consistent across grids.
 */
function stardance_render_dance_class_overlay_cards() {
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

        $raw         = get_post_field( 'post_excerpt', get_the_ID() );
        $description = '' !== $raw ? wp_strip_all_tags( $raw ) : '';

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
