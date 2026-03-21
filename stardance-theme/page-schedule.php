<?php
/**
 * Template Name: Schedule
 *
 * @package stardance
 */

get_header();
?>

<main class="sd-page sd-page--schedule" id="main-content">

    <!-- Hero -->
    <section class="sd-page-hero sd-page-hero--schedule sd-section">
        <div class="sd-container">
            <h1 class="sd-heading sd-page-hero__title fade-in fade-in-delay-0">Class Schedule</h1>
            <p class="sd-text sd-page-hero__desc fade-in fade-in-delay-1">
                Find the right class at the right time. Our weekly timetable covers all disciplines and levels, Monday through Saturday.
            </p>
        </div>
    </section>

    <!-- 7-Day Timetable Grid -->
    <section class="sd-section sd-schedule-page" id="timetable">
        <div class="sd-container">

            <div class="sd-schedule-page__table-wrap">
                <table class="sd-schedule-page__table" role="grid" aria-label="Weekly class schedule">
                    <thead>
                        <tr>
                            <th class="sd-schedule-page__time-col" scope="col">Time</th>
                            <th scope="col">Monday</th>
                            <th scope="col">Tuesday</th>
                            <th scope="col">Wednesday</th>
                            <th scope="col">Thursday</th>
                            <th scope="col">Friday</th>
                            <th scope="col">Saturday</th>
                            <th scope="col">Sunday</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td class="sd-schedule-page__time">09:00</td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Individual Lessons</span>
                                    <span class="sd-schedule-page__class-level">All Levels</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Individual Lessons</span>
                                    <span class="sd-schedule-page__class-level">All Levels</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Individual Lessons</span>
                                    <span class="sd-schedule-page__class-level">All Levels</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--closed">Closed</td>
                        </tr>

                        <tr>
                            <td class="sd-schedule-page__time">10:00</td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">European Ballroom</span>
                                    <span class="sd-schedule-page__class-level">Beginners</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--closed">Closed</td>
                        </tr>

                        <tr>
                            <td class="sd-schedule-page__time">11:00</td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Latin American</span>
                                    <span class="sd-schedule-page__class-level">Intermediate</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--closed">Closed</td>
                        </tr>

                        <tr>
                            <td class="sd-schedule-page__time">15:00</td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Kids Program</span>
                                    <span class="sd-schedule-page__class-level">Ages 4–8</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Kids Program</span>
                                    <span class="sd-schedule-page__class-level">Ages 4–8</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Kids Program</span>
                                    <span class="sd-schedule-page__class-level">Ages 4–8</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--closed">Closed</td>
                        </tr>

                        <tr>
                            <td class="sd-schedule-page__time">16:00</td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Kids Program</span>
                                    <span class="sd-schedule-page__class-level">Ages 9–14</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Kids Program</span>
                                    <span class="sd-schedule-page__class-level">Ages 9–14</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Kids Program</span>
                                    <span class="sd-schedule-page__class-level">Ages 9–14</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--closed">Closed</td>
                        </tr>

                        <tr>
                            <td class="sd-schedule-page__time">17:00</td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Latin American</span>
                                    <span class="sd-schedule-page__class-level">Beginners</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">European Ballroom</span>
                                    <span class="sd-schedule-page__class-level">Advanced</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Latin Fusion Ladies</span>
                                    <span class="sd-schedule-page__class-level">All Levels</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Latin American</span>
                                    <span class="sd-schedule-page__class-level">Intermediate</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">European Ballroom</span>
                                    <span class="sd-schedule-page__class-level">Beginners</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--closed">Closed</td>
                        </tr>

                        <tr>
                            <td class="sd-schedule-page__time">18:00</td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">European Ballroom</span>
                                    <span class="sd-schedule-page__class-level">Intermediate</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Latin American</span>
                                    <span class="sd-schedule-page__class-level">Advanced</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">European Ballroom</span>
                                    <span class="sd-schedule-page__class-level">Beginners</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Latin Fusion Ladies</span>
                                    <span class="sd-schedule-page__class-level">All Levels</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Latin American</span>
                                    <span class="sd-schedule-page__class-level">Beginners</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--closed">Closed</td>
                        </tr>

                        <tr>
                            <td class="sd-schedule-page__time">19:00</td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Individual Lessons</span>
                                    <span class="sd-schedule-page__class-level">All Levels</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Individual Lessons</span>
                                    <span class="sd-schedule-page__class-level">All Levels</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Individual Lessons</span>
                                    <span class="sd-schedule-page__class-level">All Levels</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Individual Lessons</span>
                                    <span class="sd-schedule-page__class-level">All Levels</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot">
                                <div class="sd-schedule-page__class">
                                    <span class="sd-schedule-page__class-name">Individual Lessons</span>
                                    <span class="sd-schedule-page__class-level">All Levels</span>
                                </div>
                            </td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--empty"></td>
                            <td class="sd-schedule-page__slot sd-schedule-page__slot--closed">Closed</td>
                        </tr>

                    </tbody>
                </table>
            </div><!-- /.sd-schedule-page__table-wrap -->

            <p class="sd-text sd-schedule-page__note">
                Schedules are subject to change. Contact us to confirm availability or to arrange a trial class.
            </p>

        </div>
    </section>

    <!-- CTA -->
    <section class="sd-section sd-cta" id="cta">
        <div class="sd-container sd-cta__inner">
            <h2 class="sd-heading sd-cta__title fade-in fade-in-delay-0">Not Sure Which Class to Join?</h2>
            <p class="sd-text sd-cta__desc fade-in fade-in-delay-1">We'll help you find the right fit. Get in touch and we'll recommend the best starting point for you.</p>
            <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="sd-btn fade-in fade-in-delay-2">Contact Us</a>
        </div>
    </section>

</main>

<?php get_footer(); ?>
