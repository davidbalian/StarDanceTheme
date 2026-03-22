<?php
/**
 * Template Name: Events
 *
 * @package stardance
 */

get_header();
?>

<main class="sd-page sd-page--events" id="main-content">

    <?php stardance_render_page_hero(array(
        'title'       => 'Competition Calendar &amp; Events',
        'description' => 'Stay up to date with upcoming dance competitions, showcases, and tournaments. From local Cyprus events to international championships, follow our students and coaches on the circuit.',
        'modifier'    => 'events',
    )); ?>

    <!-- Events Layout: Sidebar + Grid -->
    <section class="sd-section sd-events-page" id="events-list">
        <div class="sd-container">
            <h2 class="sd-heading sd-events-page__title fade-in fade-in-delay-0">List of Events</h2>
            <div class="sd-events-page__layout">

                <!-- Sidebar Filters -->
                <aside class="sd-events-page__sidebar" aria-label="Filter events">
                    <div class="sd-events-filter">

                        <div class="sd-events-filter__group">
                            <h3 class="sd-events-filter__label">Filter by Year</h3>
                            <ul class="sd-events-filter__options">
                                <li><button class="sd-btn sd-btn--ghost sd-events-filter__btn is-active" data-filter="year" data-value="all">2026</button></li>
                            </ul>
                        </div>

                        <div class="sd-events-filter__group">
                            <h3 class="sd-events-filter__label">Filter by Category</h3>
                            <ul class="sd-events-filter__options">
                                <li><button class="sd-btn sd-btn--ghost sd-events-filter__btn is-active" data-filter="category" data-value="all">Latin American/Standard Competitions</button></li>
                                <li><button class="sd-btn sd-btn--ghost sd-events-filter__btn" data-filter="category" data-value="wdsf-international">WDSF International Competitions</button></li>
                                <li><button class="sd-btn sd-btn--ghost sd-events-filter__btn" data-filter="category" data-value="cyprus-cup">Cyprus Cup</button></li>
                                <li><button class="sd-btn sd-btn--ghost sd-events-filter__btn" data-filter="category" data-value="other">Other</button></li>
                            </ul>
                        </div>

                        <div class="sd-events-filter__group">
                            <h3 class="sd-events-filter__label">Filter by Type</h3>
                            <ul class="sd-events-filter__options">
                                <li><button class="sd-btn sd-btn--ghost sd-events-filter__btn is-active" data-filter="type" data-value="all">Championship</button></li>
                                <li><button class="sd-btn sd-btn--ghost sd-events-filter__btn" data-filter="type" data-value="tournament">Tournament</button></li>
                            </ul>
                        </div>

                        <div class="sd-events-filter__group">
                            <h3 class="sd-events-filter__label">Filter by Body</h3>
                            <ul class="sd-events-filter__options">
                                <li><button class="sd-btn sd-btn--ghost sd-events-filter__btn is-active" data-filter="body" data-value="all">Jury</button></li>
                                <li><button class="sd-btn sd-btn--ghost sd-events-filter__btn" data-filter="body" data-value="locality">Locality</button></li>
                                <li><button class="sd-btn sd-btn--ghost sd-events-filter__btn" data-filter="body" data-value="show-teams">Show Teams</button></li>
                            </ul>
                        </div>

                    </div>
                </aside>

                <!-- Event Card Grid -->
                <div class="sd-events-page__grid" id="events-grid">

                    <?php stardance_render_event_card(array(
                        'image_url'  => 'http://stardance.com.cy/wp-content/uploads/2026/02/European-Ballroom.png',
                        'image_alt'  => 'Cyprus Open Ballroom Championship',
                        'date'       => '15 March 2026',
                        'tag'        => 'Competition',
                        'title'      => 'Cyprus Open Ballroom Championship',
                        'location'   => 'Limassol, Cyprus',
                        'link_url'   => '#',
                        'data_attrs' => array('year' => '2026', 'category' => 'ballroom', 'type' => 'competition', 'body' => 'wdsf'),
                        'delay'      => 1,
                    )); ?>

                    <?php stardance_render_event_card(array(
                        'image_url'  => 'http://stardance.com.cy/wp-content/uploads/2026/02/Latin-American.png',
                        'image_alt'  => 'National Latin Championship',
                        'date'       => '22 April 2026',
                        'tag'        => 'Competition',
                        'title'      => 'National Latin Championship',
                        'location'   => 'Nicosia, Cyprus',
                        'link_url'   => '#',
                        'data_attrs' => array('year' => '2026', 'category' => 'latin', 'type' => 'competition', 'body' => 'national'),
                        'delay'      => 2,
                    )); ?>

                    <?php stardance_render_event_card(array(
                        'image_url'  => 'http://stardance.com.cy/wp-content/uploads/2026/02/Kids-Programs.png',
                        'image_alt'  => 'Kids Spring Showcase',
                        'date'       => '10 May 2026',
                        'tag'        => 'Showcase',
                        'title'      => 'Kids Spring Showcase',
                        'location'   => 'Star Dance Studio, Limassol',
                        'link_url'   => '#',
                        'data_attrs' => array('year' => '2026', 'category' => 'kids', 'type' => 'showcase', 'body' => 'local'),
                        'delay'      => 3,
                    )); ?>

                    <?php stardance_render_event_card(array(
                        'image_url'  => 'http://stardance.com.cy/wp-content/uploads/2026/02/European-Ballroom.png',
                        'image_alt'  => 'WDSF Open Standard — Athens',
                        'date'       => '8 November 2025',
                        'tag'        => 'Competition',
                        'title'      => 'WDSF Open Standard &mdash; Athens',
                        'location'   => 'Athens, Greece',
                        'link_url'   => '#',
                        'data_attrs' => array('year' => '2025', 'category' => 'ballroom', 'type' => 'competition', 'body' => 'wdsf'),
                        'delay'      => 4,
                    )); ?>

                    <?php stardance_render_event_card(array(
                        'image_url'  => 'http://stardance.com.cy/wp-content/uploads/2026/02/Latin-Fusion-Ladies.png',
                        'image_alt'  => 'Latin Fusion Workshop',
                        'date'       => '3 October 2025',
                        'tag'        => 'Workshop',
                        'title'      => 'Latin Fusion Masterclass',
                        'location'   => 'Star Dance Studio, Limassol',
                        'link_url'   => '#',
                        'data_attrs' => array('year' => '2025', 'category' => 'latin', 'type' => 'workshop', 'body' => 'local'),
                        'delay'      => 5,
                    )); ?>

                    <?php stardance_render_event_card(array(
                        'image_url'  => 'http://stardance.com.cy/wp-content/uploads/2026/02/Wedding-Choreography.png',
                        'image_alt'  => 'Year-End Gala',
                        'date'       => '20 December 2025',
                        'tag'        => 'Showcase',
                        'title'      => 'Year-End Gala &amp; Showcase',
                        'location'   => 'Limassol Municipal Theatre',
                        'link_url'   => '#',
                        'data_attrs' => array('year' => '2025', 'category' => 'ballroom', 'type' => 'showcase', 'body' => 'local'),
                        'delay'      => 6,
                    )); ?>

                </div><!-- /.sd-events-page__grid -->

            </div><!-- /.sd-events-page__layout -->
        </div>
    </section>

    <?php stardance_render_cta(array(
        'title'       => 'Want to Compete or Attend an Event?',
        'description' => 'Contact us to learn more about competition opportunities, event schedules, and how to get involved.',
        'button_text' => 'Contact Us',
        'button_url'  => home_url('/#contact'),
    )); ?>

</main>

<?php get_footer(); ?>
