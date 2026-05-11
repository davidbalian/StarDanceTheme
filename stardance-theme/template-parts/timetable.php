<?php
require get_template_directory() . '/inc/schedule-data.php';
?>

<section class="sd-section sd-timetable" id="timetable">
    <div class="sd-container">
        <h2 class="sd-heading sd-timetable__title fade-in fade-in-delay-0">Class Timetable</h2>
        <p class="sd-text sd-timetable__desc fade-in fade-in-delay-1">View our weekly class schedule below. Classes run Monday through Friday at our Limassol studio. Contact us if you have questions about specific classes or to arrange a trial session.</p>

        <div class="sd-timetable__grid fade-in fade-in-delay-2">
            <?php
            $weekend_days = array_slice( $schedule_days, -2 );
            $weekday_days = array_slice( $schedule_days, 0, 5 );
            ?>
            <?php foreach ( $weekday_days as $day ) : ?>
                <article class="sd-timetable__day">
                    <h3 class="sd-timetable__day-title"><?php echo esc_html( $day['label'] ); ?></h3>

                    <?php if ( ! empty( $day['closed'] ) ) : ?>
                        <p class="sd-timetable__closed">Closed</p>
                    <?php else : ?>
                        <div class="sd-timetable__sessions">
                            <?php foreach ( $day['sessions'] as $session ) : ?>
                                <div class="sd-timetable__session">
                                    <span class="sd-timetable__time"><?php echo esc_html( $session['time'] ); ?></span>
                                    <span class="sd-timetable__class-name"><?php echo esc_html( $session['title'] ); ?></span>
                                    <?php if ( ! empty( $session['meta'] ) ) : ?>
                                        <span class="sd-timetable__class-level"><?php echo esc_html( $session['meta'] ); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>

            <div class="sd-timetable__weekend-column">
                <?php foreach ( $weekend_days as $day ) : ?>
                    <article class="sd-timetable__day">
                        <h3 class="sd-timetable__day-title"><?php echo esc_html( $day['label'] ); ?></h3>

                        <?php if ( ! empty( $day['closed'] ) ) : ?>
                            <p class="sd-timetable__closed">Closed</p>
                        <?php else : ?>
                            <div class="sd-timetable__sessions">
                                <?php foreach ( $day['sessions'] as $session ) : ?>
                                    <div class="sd-timetable__session">
                                        <span class="sd-timetable__time"><?php echo esc_html( $session['time'] ); ?></span>
                                        <span class="sd-timetable__class-name"><?php echo esc_html( $session['title'] ); ?></span>
                                        <?php if ( ! empty( $session['meta'] ) ) : ?>
                                            <span class="sd-timetable__class-level"><?php echo esc_html( $session['meta'] ); ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="sd-section__cta fade-in fade-in-delay-3">
            <a href="<?php echo esc_url(home_url('/schedule/')); ?>" class="sd-btn">Full Schedule</a>
        </div>
    </div>
</section>
