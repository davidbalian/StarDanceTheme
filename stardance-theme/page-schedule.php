<?php
/**
 * Template Name: Schedule
 *
 * @package stardance
 */

get_header();
$sd_page_id = get_queried_object_id();

$schedule_days = array(
    array(
        'label'    => 'Mon',
        'sessions' => array(
            array(
                'time'  => '16:30 - 17:45',
                'title' => 'Classical Choreography',
            ),
            array(
                'time'  => '18:00 - 19:30',
                'title' => 'Latin American Dances',
                'meta'  => 'Couples & Solo (Age 8+)',
            ),
        ),
    ),
    array(
        'label'    => 'Tue',
        'sessions' => array(
            array(
                'time'  => '16:30 - 17:00',
                'title' => 'Baby Dance',
                'meta'  => '(Age 4-5)',
            ),
            array(
                'time'  => '17:00 - 17:45',
                'title' => 'Kids Dance',
                'meta'  => '(Age 6-7)',
            ),
            array(
                'time'  => '18:00 - 19:30',
                'title' => 'Latin Fusion',
                'meta'  => 'Ladies Solo',
            ),
        ),
    ),
    array(
        'label'    => 'Wed',
        'sessions' => array(
            array(
                'time'  => '16:30 - 17:45',
                'title' => 'Physical Conditioning',
            ),
            array(
                'time'  => '18:00 - 19:30',
                'title' => 'European Ballroom',
                'meta'  => 'Couples & Solo (Age 8+)',
            ),
        ),
    ),
    array(
        'label'    => 'Thu',
        'sessions' => array(
            array(
                'time'  => '16:30 - 17:00',
                'title' => 'Baby Dance',
                'meta'  => '(Age 4-5)',
            ),
            array(
                'time'  => '17:00 - 17:45',
                'title' => 'Kids Dance',
                'meta'  => '(Age 6-7)',
            ),
            array(
                'time'  => '18:00 - 19:30',
                'title' => 'Latin Fusion',
                'meta'  => 'Ladies Solo',
            ),
        ),
    ),
    array(
        'label'    => 'Fri',
        'sessions' => array(
            array(
                'time'  => '16:30 - 17:45',
                'title' => 'Body Ballet',
                'meta'  => 'Stretching',
            ),
            array(
                'time'  => '18:00 - 19:30',
                'title' => 'Competition Practice',
                'meta'  => 'Standard & Latin American',
            ),
        ),
    ),
    array(
        'label'    => 'Sat',
        'sessions' => array(
            array(
                'time'  => '9:00 - 19:00',
                'title' => 'Individual Lessons',
            ),
        ),
    ),
    array(
        'label'  => 'Sun',
        'closed' => true,
    ),
);
?>

<main class="sd-page sd-page--schedule" id="main-content">

    <?php stardance_render_page_hero(array(
        'title'       => 'Class Timetable',
        'description' => 'View our weekly class schedule below. Classes run Monday through Friday at our Limassol studio. Contact us if you have questions about specific classes or to arrange a trial session.',
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
                            <p class="sd-schedule-page__closed">Closed</p>
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
                                <p class="sd-schedule-page__closed">Closed</p>
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
        'title'       => 'Questions About Our Schedule?',
        'description' => 'Looking for a specific class time or want to book a private lesson? Get in touch and we\'ll help you find the best option.',
        'button_text' => 'Contact Us',
        'button_url'  => stardance_page_or_path_url( 'contact' ),
        'top_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/flipped-red-and-orange-lines.svg',
        'bottom_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/red-and-orange-lines.svg',
        'bg_image_urls' => stardance_get_responsive_bottom_cta_images( $sd_page_id, 'schedule' ),
    )); ?>

</main>

<?php get_footer(); ?>
