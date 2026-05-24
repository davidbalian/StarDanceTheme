<?php
/**
 * Template Name: Schedule
 *
 * @package stardance
 */

get_header();
$sd_page_id    = get_queried_object_id();
$schedule_days = sd_get_schedule_days();
?>

<main class="sd-page sd-page--schedule" id="main-content">

    <?php stardance_render_page_hero(array(
        'title'       => SD_Page_Content::get_text( $sd_page_id, 'schedule', 'hero_title' ),
        'description' => SD_Page_Content::get_text( $sd_page_id, 'schedule', 'hero_description' ),
        'modifier'    => 'schedule',
        'bg_image_urls' => stardance_get_responsive_hero_images( $sd_page_id, 'schedule' ),
    )); ?>

    <section class="sd-section sd-schedule-page" id="timetable">
        <div class="sd-container">
            <div class="sd-schedule-page__grid">
                <?php
                $weekend_days = array_slice( $schedule_days, -2 );
                $weekday_days = array_slice( $schedule_days, 0, 5 );
                ?>
                <?php foreach ( $weekday_days as $day_index => $day ) : ?>
                    <article class="sd-schedule-page__day fade-in fade-in-delay-<?php echo esc_attr( min( $day_index, 6 ) ); ?>">
                        <h2 class="sd-schedule-page__day-title"><?php echo esc_html( $day['label'] ); ?></h2>

                        <?php if ( ! empty( $day['closed'] ) ) : ?>
                            <p class="sd-schedule-page__closed"><?php te('Closed'); ?></p>
                        <?php else : ?>
                            <div class="sd-schedule-page__sessions">
                                <?php foreach ( $day['sessions'] as $session ) : ?>
                                    <div class="sd-schedule-page__session">
                                        <span class="sd-schedule-page__time"><?php echo esc_html( $session['time'] ); ?></span>
                                        <span class="sd-schedule-page__class-name"><?php echo esc_html( $session['title'] ); ?></span>
                                        <?php if ( ! empty( $session['meta'] ) ) : ?>
                                            <span class="sd-schedule-page__class-level"><?php echo esc_html( $session['meta'] ); ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>

                <div class="sd-schedule-page__weekend-column fade-in fade-in-delay-6">
                    <?php foreach ( $weekend_days as $day ) : ?>
                        <article class="sd-schedule-page__day">
                            <h2 class="sd-schedule-page__day-title"><?php echo esc_html( $day['label'] ); ?></h2>

                            <?php if ( ! empty( $day['closed'] ) ) : ?>
                                <p class="sd-schedule-page__closed"><?php te('Closed'); ?></p>
                            <?php else : ?>
                                <div class="sd-schedule-page__sessions">
                                    <?php foreach ( $day['sessions'] as $session ) : ?>
                                        <div class="sd-schedule-page__session">
                                            <span class="sd-schedule-page__time"><?php echo esc_html( $session['time'] ); ?></span>
                                            <span class="sd-schedule-page__class-name"><?php echo esc_html( $session['title'] ); ?></span>
                                            <?php if ( ! empty( $session['meta'] ) ) : ?>
                                                <span class="sd-schedule-page__class-level"><?php echo esc_html( $session['meta'] ); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <?php stardance_render_cta(array(
        'title'       => SD_Page_Content::get_text( $sd_page_id, 'schedule', 'cta_title' ),
        'description' => SD_Page_Content::get_text( $sd_page_id, 'schedule', 'cta_description' ),
        'button_text' => SD_Page_Content::get_text( $sd_page_id, 'schedule', 'cta_btn' ),
        'button_url'  => sd_localized_url( '/contact/' ),
        'top_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/flipped-red-and-orange-lines.svg',
        'bottom_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/red-and-orange-lines.svg',
        'bg_image_urls' => stardance_get_responsive_bottom_cta_images( $sd_page_id, 'schedule' ),
    )); ?>

</main>

<?php get_footer(); ?>
