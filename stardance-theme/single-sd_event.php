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
$sd_schedule_notes = get_post_meta( $sd_event_id, 'event_schedule', true );
$sd_schedule_notes = is_string( $sd_schedule_notes ) ? $sd_schedule_notes : '';
$sd_schedule_rows  = Stardance_Event_Schedule::get_entries( $sd_event_id );
$sd_has_schedule_cards = Stardance_Event_Schedule::has_displayable_entries( $sd_schedule_rows );
$sd_has_schedule_notes = '' !== trim( wp_strip_all_tags( $sd_schedule_notes ) );
$sd_gallery    = stardance_get_event_gallery_ids( $sd_event_id );

$sd_thumb_id = get_post_thumbnail_id( $sd_event_id );
$sd_hero_bg  = '';
if ( $sd_thumb_id ) {
    $sd_full = wp_get_attachment_image_src( $sd_thumb_id, 'full' );
    if ( $sd_full && ! empty( $sd_full[0] ) ) {
        $sd_hero_bg = $sd_full[0];
    }
}

$sd_hero_meta_rows = array();
if ( $sd_event_date ) {
    $sd_hero_meta_rows[] = array(
        'label' => __( 'Date', 'stardance' ) . ':',
        'value' => $sd_event_date,
    );
}
if ( $sd_location ) {
    $sd_hero_meta_rows[] = array(
        'label' => __( 'Location', 'stardance' ) . ':',
        'value' => $sd_location,
    );
}

$sd_hero_buttons = array();
if ( $sd_event_link ) {
    $sd_hero_buttons[] = array(
        'text' => __( 'Event Website', 'stardance' ),
        'url'  => $sd_event_link,
    );
}
$sd_hero_buttons[] = array(
    'text' => __( 'Contact Us', 'stardance' ),
    'url'  => stardance_page_or_path_url( 'contact' ),
);

$sd_raw_content      = get_post()->post_content;
$sd_has_about        = '' !== trim( (string) $sd_raw_content );
$sd_gallery_valid    = Stardance_Event_Gallery_Preview::filter_valid_ids( $sd_gallery );
$sd_has_gallery      = array() !== $sd_gallery_valid;
$sd_preview_config   = $sd_has_gallery ? Stardance_Event_Gallery_Preview::build_preview_rows( $sd_gallery ) : null;
$sd_show_intro       = $sd_has_about || $sd_has_gallery;
$sd_intro_layout_mod = 'sd-single-event__intro-layout--split';
if ( $sd_has_about xor $sd_has_gallery ) {
	$sd_intro_layout_mod = $sd_has_about ? 'sd-single-event__intro-layout--about-only' : 'sd-single-event__intro-layout--gallery-only';
}
?>

<main class="sd-page sd-page--single-event" id="main-content">

    <?php
    $sd_hero_args = array(
        'title'       => get_the_title(),
        'description' => $sd_excerpt,
        'modifier'    => 'single-event',
        'meta_rows'   => $sd_hero_meta_rows,
        'buttons'     => $sd_hero_buttons,
        'bg_image_urls' => stardance_get_responsive_hero_images(
            $sd_event_id,
            'single_event',
            $sd_hero_bg ? array(
                'large'  => $sd_hero_bg,
                'tablet' => $sd_hero_bg,
                'mobile' => $sd_hero_bg,
            ) : array()
        ),
    );
    stardance_render_page_hero( $sd_hero_args );
    ?>

    <?php if ( $sd_show_intro ) : ?>
        <section class="sd-section sd-single-event__intro" id="event-intro">
            <div class="sd-container">
                <?php if ( $sd_has_gallery && $sd_preview_config ) : ?>
                    <div class="sd-single-event__intro-layout <?php echo esc_attr( $sd_intro_layout_mod ); ?> fade-in fade-in-delay-0" data-gallery-lightbox>
                        <?php if ( $sd_has_about ) : ?>
                            <div class="sd-single-event__intro-about">
                                <h2 class="sd-heading sd-single-event__intro-title"><?php esc_html_e( 'About This Event', 'stardance' ); ?></h2>
                                <div class="sd-single-event__about-prose sd-text entry-content">
                                    <?php the_content(); ?>
                                </div>
                                <button type="button" class="sd-btn sd-single-event__gallery-open" data-gallery-lightbox-open>
                                    <?php esc_html_e( 'View Full Gallery', 'stardance' ); ?>
                                </button>
                            </div>
                        <?php endif; ?>

                        <div class="sd-single-event__intro-preview">
                            <div class="sd-single-event__preview sd-single-event__preview--<?php echo esc_attr( $sd_preview_config['modifier'] ); ?>">
                                <?php
                                foreach ( $sd_preview_config['rows'] as $sd_pr ) {
                                    $sd_att_id = (int) $sd_pr['attachment_id'];
                                    $sd_full   = wp_get_attachment_image_src( $sd_att_id, 'full' );
                                    $sd_lg     = wp_get_attachment_image_src( $sd_att_id, 'large' );
                                    if ( ! $sd_full || ! $sd_lg ) {
                                        continue;
                                    }
                                    $sd_alt = get_post_meta( $sd_att_id, '_wp_attachment_image_alt', true );
                                    $sd_alt = $sd_alt ? $sd_alt : get_the_title();
                                    $sd_lc  = 'sd-single-event__preview-link';
                                    if ( ! empty( $sd_pr['sr_only'] ) ) {
                                        $sd_lc .= ' sd-sr-only';
                                    }
                                    ?>
                                    <a class="<?php echo esc_attr( $sd_lc ); ?>" href="<?php echo esc_url( $sd_full[0] ); ?>"
                                        <?php
                                        if ( ! empty( $sd_pr['grid_style'] ) ) {
                                            printf( ' style="%s"', esc_attr( $sd_pr['grid_style'] ) );
                                        }
                                        ?>
                                    >
                                        <?php
                                        echo wp_get_attachment_image(
                                            $sd_att_id,
                                            'large',
                                            false,
                                            array(
                                                'alt'     => $sd_alt,
                                                'loading' => 'lazy',
                                                'class'   => 'sd-single-event__preview-img',
                                            )
                                        );
                                        ?>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <?php if ( ! $sd_has_about ) : ?>
                            <button type="button" class="sd-btn sd-single-event__gallery-open sd-single-event__gallery-open--solo" data-gallery-lightbox-open>
                                <?php esc_html_e( 'View Full Gallery', 'stardance' ); ?>
                            </button>
                        <?php endif; ?>
                    </div>
                <?php elseif ( $sd_has_about ) : ?>
                    <div class="sd-single-event__intro-layout sd-single-event__intro-layout--about-only fade-in fade-in-delay-0">
                        <div class="sd-single-event__intro-about">
                            <h2 class="sd-heading sd-single-event__intro-title"><?php esc_html_e( 'About This Event', 'stardance' ); ?></h2>
                            <div class="sd-single-event__about-prose sd-text entry-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <section class="sd-section sd-single-event" id="event-details">
        <div class="sd-container">
            <?php if ( $sd_has_schedule_cards || $sd_has_schedule_notes ) : ?>
                <h2 class="sd-heading sd-single-event__section-title fade-in fade-in-delay-2"><?php esc_html_e( 'Schedule', 'stardance' ); ?></h2>
                <?php
                $sd_schedule_dateline = Stardance_Event_Schedule_Week_Display::format_event_dateline( is_string( $sd_event_date ) ? $sd_event_date : '' );
                if ( '' !== $sd_schedule_dateline ) :
                    ?>
                    <p class="sd-single-event__schedule-dateline fade-in fade-in-delay-2"><?php echo esc_html( $sd_schedule_dateline ); ?></p>
                    <?php
                endif;
                ?>
                <?php if ( $sd_has_schedule_cards ) : ?>
                    <?php
                    $sd_timetable = Stardance_Event_Schedule_Week_Display::build_timetable_grid_from_entries( $sd_schedule_rows );
                    ?>
                    <?php if ( ! empty( $sd_timetable['has_any_parsed_day'] ) ) : ?>
                        <div class="sd-timetable__grid sd-single-event__timetable-grid fade-in fade-in-delay-2">
                            <?php foreach ( $sd_timetable['weekdays'] as $sd_day ) : ?>
                                <article class="sd-timetable__day">
                                    <h3 class="sd-timetable__day-title"><?php echo esc_html( $sd_day['label'] ); ?></h3>
                                    <?php if ( ! empty( $sd_day['closed'] ) ) : ?>
                                        <p class="sd-timetable__closed"><?php esc_html_e( 'No event', 'stardance' ); ?></p>
                                    <?php else : ?>
                                        <div class="sd-timetable__sessions">
                                            <?php foreach ( $sd_day['sessions'] as $sd_session ) : ?>
                                                <div class="sd-timetable__session">
                                                    <?php if ( '' !== $sd_session['time'] ) : ?>
                                                        <span class="sd-timetable__time"><?php echo esc_html( $sd_session['time'] ); ?></span>
                                                    <?php endif; ?>
                                                    <?php if ( '' !== $sd_session['title'] ) : ?>
                                                        <span class="sd-timetable__class-name"><?php echo esc_html( $sd_session['title'] ); ?></span>
                                                    <?php endif; ?>
                                                    <?php if ( '' !== $sd_session['meta'] ) : ?>
                                                        <span class="sd-timetable__class-level"><?php echo esc_html( $sd_session['meta'] ); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </article>
                            <?php endforeach; ?>

                            <div class="sd-timetable__weekend-column">
                                <?php foreach ( $sd_timetable['weekend'] as $sd_day ) : ?>
                                    <article class="sd-timetable__day">
                                        <h3 class="sd-timetable__day-title"><?php echo esc_html( $sd_day['label'] ); ?></h3>
                                        <?php if ( ! empty( $sd_day['closed'] ) ) : ?>
                                            <p class="sd-timetable__closed"><?php esc_html_e( 'No event', 'stardance' ); ?></p>
                                        <?php else : ?>
                                            <div class="sd-timetable__sessions">
                                                <?php foreach ( $sd_day['sessions'] as $sd_session ) : ?>
                                                    <div class="sd-timetable__session">
                                                        <?php if ( '' !== $sd_session['time'] ) : ?>
                                                            <span class="sd-timetable__time"><?php echo esc_html( $sd_session['time'] ); ?></span>
                                                        <?php endif; ?>
                                                        <?php if ( '' !== $sd_session['title'] ) : ?>
                                                            <span class="sd-timetable__class-name"><?php echo esc_html( $sd_session['title'] ); ?></span>
                                                        <?php endif; ?>
                                                        <?php if ( '' !== $sd_session['meta'] ) : ?>
                                                            <span class="sd-timetable__class-level"><?php echo esc_html( $sd_session['meta'] ); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </article>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $sd_timetable['orphans'] ) ) : ?>
                        <div class="sd-single-event__schedule-orphans sd-grid sd-grid--3 fade-in fade-in-delay-2">
                            <?php
                            $sd_card_delay = 7;
                            foreach ( $sd_timetable['orphans'] as $sd_row ) {
                                $sd_day      = isset( $sd_row['day'] ) ? trim( (string) $sd_row['day'] ) : '';
                                $sd_title    = isset( $sd_row['title'] ) ? trim( (string) $sd_row['title'] ) : '';
                                $sd_time     = isset( $sd_row['time'] ) ? trim( (string) $sd_row['time'] ) : '';
                                $sd_loc      = isset( $sd_row['location'] ) ? trim( (string) $sd_row['location'] ) : '';
                                $sd_d        = min( $sd_card_delay, 10 );
                                ++$sd_card_delay;
                                $sd_day_display = '' !== $sd_day ? $sd_day : __( 'TBA', 'stardance' );
                                ?>
                                <article class="sd-schedule-page__day sd-single-event__schedule-card fade-in fade-in-delay-<?php echo absint( $sd_d ); ?>">
                                    <h3 class="sd-schedule-page__day-title"><?php echo esc_html( $sd_day_display ); ?></h3>
                                    <div class="sd-schedule-page__sessions">
                                        <div class="sd-schedule-page__session sd-single-event__schedule-session">
                                            <?php if ( '' !== $sd_title ) : ?>
                                                <span class="sd-schedule-page__class-name"><?php echo esc_html( $sd_title ); ?></span>
                                            <?php endif; ?>
                                            <?php if ( '' !== $sd_time ) : ?>
                                                <span class="sd-schedule-page__time"><?php echo esc_html( $sd_time ); ?></span>
                                            <?php endif; ?>
                                            <?php if ( '' !== $sd_loc ) : ?>
                                                <span class="sd-schedule-page__class-level"><?php echo esc_html( $sd_loc ); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </article>
                                <?php
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if ( $sd_has_schedule_notes ) : ?>
                    <div class="sd-single-event__schedule sd-single-event__schedule--notes sd-text fade-in fade-in-delay-2">
                        <?php echo wp_kses_post( $sd_schedule_notes ); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>

    <?php
    stardance_render_cta(
        array(
            'title'                 => __( 'Questions About This Event?', 'stardance' ),
            'description'           => __( 'Contact us for more information about attending or competing.', 'stardance' ),
            'button_text'           => __( 'Contact Us', 'stardance' ),
            'button_url'            => stardance_page_or_path_url( 'contact' ),
            'top_decoration_url'    => 'https://stardance.com.cy/wp-content/uploads/2026/03/flipped-red-and-orange-lines.svg',
            'bottom_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/red-and-orange-lines.svg',
            'bg_image_urls'         => stardance_get_responsive_bottom_cta_images( $sd_event_id, 'single_event' ),
        )
    );
    ?>

</main>

<?php get_footer(); ?>
