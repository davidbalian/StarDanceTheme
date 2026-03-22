<?php
/**
 * Template Name: Schedule
 *
 * @package stardance
 */

get_header();

$schedule_days = array(
    array(
        'label'    => 'Mon',
        'sessions' => array(
            array(
                'time'  => '9:00 - 16:30',
                'title' => 'Individual Lessons',
            ),
            array(
                'time'  => '16:30 - 18:00',
                'title' => 'Latin American Dances',
                'meta'  => '(Age 8-10)',
            ),
            array(
                'time'  => '18:00 - 19:30',
                'title' => 'Latin American Dances',
                'meta'  => '(Age 11-15)',
            ),
        ),
    ),
    array(
        'label'    => 'Tue',
        'sessions' => array(
            array(
                'time'  => '9:30 - 11:00',
                'title' => 'Ladies Latin Fusion',
                'meta'  => '(Age 18+)',
            ),
            array(
                'time'  => '11:00 - 16:30',
                'title' => 'Individual Lessons',
            ),
            array(
                'time'  => '16:30 - 17:00',
                'title' => 'Baby Dance',
                'meta'  => '(Age 3-4)',
            ),
            array(
                'time'  => '17:00 - 18:00',
                'title' => 'Stretching',
            ),
        ),
    ),
    array(
        'label'    => 'Wed',
        'sessions' => array(
            array(
                'time'  => '9:00 - 16:30',
                'title' => 'Individual Lessons',
            ),
            array(
                'time'  => '16:30 - 18:00',
                'title' => 'European Ballroom Dances',
                'meta'  => '(Age 8-10)',
            ),
            array(
                'time'  => '18:00 - 19:30',
                'title' => 'European Ballroom Dances',
                'meta'  => '(Age 11-15)',
            ),
        ),
    ),
    array(
        'label'    => 'Thu',
        'sessions' => array(
            array(
                'time'  => '9:00 - 16:30',
                'title' => 'Individual Lessons',
            ),
            array(
                'time'  => '16:30 - 17:00',
                'title' => 'Baby Dance',
                'meta'  => '(Age 3-4)',
            ),
            array(
                'time'  => '17:00 - 17:45',
                'title' => 'Kids Dance',
                'meta'  => '(Age 5-7)',
            ),
            array(
                'time'  => '18:00 - 19:30',
                'title' => 'Show Latin Fusion',
                'meta'  => '(Age 11-15)',
            ),
        ),
    ),
    array(
        'label'    => 'Fri',
        'sessions' => array(
            array(
                'time'  => '9:30 - 11:00',
                'title' => 'Ladies Latin Fusion',
                'meta'  => '(Age 18+)',
            ),
            array(
                'time'  => '11:00 - 17:00',
                'title' => 'Individual Lessons',
            ),
            array(
                'time'  => '17:00 - 17:45',
                'title' => 'Kids Dance',
                'meta'  => '(Age 5-7)',
            ),
            array(
                'time'  => '18:00 - 19:30',
                'title' => 'Ballroom & Latin American Dances',
                'meta'  => '(All Ages Practice)',
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
    )); ?>

    <section class="sd-section sd-schedule-page" id="timetable">
        <div class="sd-container">
            <div class="sd-schedule-page__grid">
                <?php foreach ( $schedule_days as $day_index => $day ) : ?>
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
            </div>
        </div>
    </section>

    <?php stardance_render_cta(array(
        'title'       => 'Questions About Our Schedule?',
        'description' => 'Looking for a specific class time or want to book a private lesson? Get in touch and we\'ll help you find the best option.',
        'button_text' => 'Contact Us',
        'button_url'  => home_url('/#contact'),
        'top_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/flipped-red-and-orange-lines.svg',
        'bottom_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/red-and-orange-lines.svg',
    )); ?>

</main>

<?php get_footer(); ?>
