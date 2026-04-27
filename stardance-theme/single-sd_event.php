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
$sd_schedule   = get_post_meta( $sd_event_id, 'event_schedule', true );
$sd_schedule   = is_string( $sd_schedule ) ? $sd_schedule : '';
$sd_gallery    = stardance_get_event_gallery_ids( $sd_event_id );

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

$sd_raw_content = get_post()->post_content;
$sd_has_about   = '' !== trim( (string) $sd_raw_content );
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

            <?php if ( $sd_has_about ) : ?>
                <h2 class="sd-heading sd-single-event__section-title fade-in fade-in-delay-1"><?php esc_html_e( 'About this event', 'stardance' ); ?></h2>
                <div class="sd-single-event__content sd-text entry-content fade-in fade-in-delay-1">
                    <?php the_content(); ?>
                </div>
            <?php endif; ?>

            <?php if ( '' !== trim( wp_strip_all_tags( $sd_schedule ) ) ) : ?>
                <h2 class="sd-heading sd-single-event__section-title fade-in fade-in-delay-2"><?php esc_html_e( 'Schedule', 'stardance' ); ?></h2>
                <div class="sd-single-event__schedule sd-text fade-in fade-in-delay-2">
                    <?php echo wp_kses_post( $sd_schedule ); ?>
                </div>
            <?php endif; ?>

            <?php if ( ! empty( $sd_gallery ) ) : ?>
                <h2 class="sd-heading sd-single-event__section-title fade-in fade-in-delay-3"><?php esc_html_e( 'Gallery', 'stardance' ); ?></h2>
                <div class="sd-single-event__gallery sd-grid sd-grid--3 fade-in fade-in-delay-3" data-gallery-lightbox>
                    <?php
                    foreach ( $sd_gallery as $sd_att_id ) {
                        $sd_full = wp_get_attachment_image_src( $sd_att_id, 'full' );
                        $sd_lg   = wp_get_attachment_image_src( $sd_att_id, 'large' );
                        if ( ! $sd_full || ! $sd_lg ) {
                            continue;
                        }
                        $sd_alt = get_post_meta( $sd_att_id, '_wp_attachment_image_alt', true );
                        $sd_alt = $sd_alt ? $sd_alt : get_the_title();
                        ?>
                        <a class="sd-single-event__gallery-item" href="<?php echo esc_url( $sd_full[0] ); ?>">
                            <?php
                            echo wp_get_attachment_image(
                                $sd_att_id,
                                'large',
                                false,
                                array(
                                    'alt'     => $sd_alt,
                                    'loading' => 'lazy',
                                    'class'   => 'sd-single-event__gallery-img',
                                )
                            );
                            ?>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            <?php endif; ?>
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
