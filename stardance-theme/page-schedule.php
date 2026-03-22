<?php
/**
 * Template Name: Schedule
 *
 * @package stardance
 */

get_header();
?>

<main class="sd-page sd-page--schedule" id="main-content">

    <?php stardance_render_page_hero(array(
        'title'       => 'Class Timetable',
        'description' => 'View our weekly class schedule below. Classes run Monday through Friday at the Limassol studio. Contact us if you have questions about specific classes or to arrange a trial session.',
        'modifier'    => 'schedule',
    )); ?>

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

    <?php stardance_render_cta(array(
        'title'       => 'Questions About Our Schedule?',
        'description' => 'Looking for a specific class or want to book a trial session? Get in touch and we\'ll help find the right fit.',
        'button_text' => 'Contact Us',
        'button_url'  => home_url('/#contact'),
    )); ?>

</main>

<?php get_footer(); ?>
