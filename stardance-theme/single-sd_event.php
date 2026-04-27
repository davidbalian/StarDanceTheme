<?php
/**
 * Single template for the sd_event custom post type.
 *
 * @package stardance
 */

get_header();

the_post();

$sd_event_id   = get_the_ID();
$sd_excerpt    = get_the_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_the_content() ), 34 );
$sd_event_date = get_post_meta( $sd_event_id, 'event_date', true );
$sd_location   = get_post_meta( $sd_event_id, 'event_location', true );
$sd_event_link = get_post_meta( $sd_event_id, 'event_link', true );

$sd_thumb_id = get_post_thumbnail_id( $sd_event_id );
$sd_hero_bg  = '';
if ( $sd_thumb_id ) {
    $sd_full = wp_get_attachment_image_src( $sd_thumb_id, 'full' );
    if ( $sd_full && ! empty( $sd_full[0] ) ) {
        $sd_hero_bg = $sd_full[0];
    }
}

$sd_hero_buttons = array(
    array(
        'text' => __( 'All events', 'stardance' ),
        'url'  => stardance_page_or_path_url( 'events' ),
    ),
);
if ( $sd_event_link ) {
    $sd_hero_buttons[] = array(
        'text' => __( 'Register / Learn more', 'stardance' ),
        'url'  => $sd_event_link,
    );
}
?>

<main class="sd-page sd-page--single-event" id="main-content">

    <?php
    $sd_hero_args = array(
        'title'       => get_the_title(),
        'description' => $sd_excerpt,
        'modifier'    => 'single-event',
        'buttons'     => $sd_hero_buttons,
    );
    if ( $sd_hero_bg ) {
        $sd_hero_args['bg_image_url'] = $sd_hero_bg;
    }
    stardance_render_page_hero( $sd_hero_args );
    ?>

    <section class="sd-section sd-single-event" id="event-details">
        <div class="sd-container">
            <?php if ( $sd_event_date || $sd_location ) : ?>
                <div class="sd-single-event__meta fade-in fade-in-delay-0">
                    <?php if ( $sd_event_date ) : ?>
                        <p class="sd-single-event__meta-item">
                            <span class="sd-single-event__meta-label"><?php esc_html_e( 'Date', 'stardance' ); ?></span>
                            <?php echo esc_html( $sd_event_date ); ?>
                        </p>
                    <?php endif; ?>
                    <?php if ( $sd_location ) : ?>
                        <p class="sd-single-event__meta-item">
                            <span class="sd-single-event__meta-label"><?php esc_html_e( 'Location', 'stardance' ); ?></span>
                            <?php echo esc_html( $sd_location ); ?>
                        </p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="sd-single-event__content sd-text fade-in fade-in-delay-1">
                <?php the_content(); ?>
            </div>
        </div>
    </section>

    <?php
    stardance_render_cta(
        array(
            'title'       => __( 'Questions about this event?', 'stardance' ),
            'description' => __( 'Get in touch and we will be happy to help.', 'stardance' ),
            'button_text' => __( 'Contact Us', 'stardance' ),
            'button_url'  => stardance_page_or_path_url( 'contact' ),
        )
    );
    ?>

</main>

<?php get_footer(); ?>
