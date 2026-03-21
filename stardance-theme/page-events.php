<?php
/**
 * Template Name: Events
 *
 * @package stardance
 */

get_header();
?>

<main class="sd-page sd-page--events" id="main-content">

    <!-- Hero -->
    <section class="sd-page-hero sd-page-hero--events sd-section">
        <div class="sd-container">
            <h1 class="sd-heading sd-page-hero__title fade-in fade-in-delay-0">Events &amp; Competitions</h1>
            <p class="sd-text sd-page-hero__desc fade-in fade-in-delay-1">
                Follow our students and coaches on the competition circuit — local, national, and international events throughout the year.
            </p>
        </div>
    </section>

    <!-- Events Layout: Sidebar + Grid -->
    <section class="sd-section sd-events-page" id="events-list">
        <div class="sd-container">
            <div class="sd-events-page__layout">

                <!-- Sidebar Filters -->
                <aside class="sd-events-page__sidebar" aria-label="Filter events">
                    <div class="sd-events-filter">

                        <div class="sd-events-filter__group">
                            <h3 class="sd-events-filter__label">Year</h3>
                            <ul class="sd-events-filter__options">
                                <li><button class="sd-events-filter__btn is-active" data-filter="year" data-value="all">All Years</button></li>
                                <li><button class="sd-events-filter__btn" data-filter="year" data-value="2026">2026</button></li>
                                <li><button class="sd-events-filter__btn" data-filter="year" data-value="2025">2025</button></li>
                                <li><button class="sd-events-filter__btn" data-filter="year" data-value="2024">2024</button></li>
                            </ul>
                        </div>

                        <div class="sd-events-filter__group">
                            <h3 class="sd-events-filter__label">Category</h3>
                            <ul class="sd-events-filter__options">
                                <li><button class="sd-events-filter__btn is-active" data-filter="category" data-value="all">All Categories</button></li>
                                <li><button class="sd-events-filter__btn" data-filter="category" data-value="ballroom">Ballroom</button></li>
                                <li><button class="sd-events-filter__btn" data-filter="category" data-value="latin">Latin</button></li>
                                <li><button class="sd-events-filter__btn" data-filter="category" data-value="kids">Kids</button></li>
                            </ul>
                        </div>

                        <div class="sd-events-filter__group">
                            <h3 class="sd-events-filter__label">Type</h3>
                            <ul class="sd-events-filter__options">
                                <li><button class="sd-events-filter__btn is-active" data-filter="type" data-value="all">All Types</button></li>
                                <li><button class="sd-events-filter__btn" data-filter="type" data-value="competition">Competition</button></li>
                                <li><button class="sd-events-filter__btn" data-filter="type" data-value="showcase">Showcase</button></li>
                                <li><button class="sd-events-filter__btn" data-filter="type" data-value="workshop">Workshop</button></li>
                            </ul>
                        </div>

                        <div class="sd-events-filter__group">
                            <h3 class="sd-events-filter__label">Body</h3>
                            <ul class="sd-events-filter__options">
                                <li><button class="sd-events-filter__btn is-active" data-filter="body" data-value="all">All Bodies</button></li>
                                <li><button class="sd-events-filter__btn" data-filter="body" data-value="wdsf">WDSF</button></li>
                                <li><button class="sd-events-filter__btn" data-filter="body" data-value="national">National</button></li>
                                <li><button class="sd-events-filter__btn" data-filter="body" data-value="local">Local</button></li>
                            </ul>
                        </div>

                    </div>
                </aside>

                <!-- Event Card Grid -->
                <div class="sd-events-page__grid" id="events-grid">

                    <article class="sd-event-card fade-in fade-in-delay-1" data-year="2026" data-category="ballroom" data-type="competition" data-body="wdsf">
                        <div class="sd-event-card__image">
                            <img src="http://stardance.com.cy/wp-content/uploads/2026/02/European-Ballroom.png" alt="Cyprus Open Ballroom Championship" width="400" height="280" loading="lazy">
                        </div>
                        <div class="sd-event-card__content">
                            <span class="sd-event-card__date">15 March 2026</span>
                            <span class="sd-event-card__tag">Competition</span>
                            <h3 class="sd-event-card__title">Cyprus Open Ballroom Championship</h3>
                            <p class="sd-event-card__location">Limassol, Cyprus</p>
                            <a href="#" class="sd-btn sd-btn--outline">View Details</a>
                        </div>
                    </article>

                    <article class="sd-event-card fade-in fade-in-delay-2" data-year="2026" data-category="latin" data-type="competition" data-body="national">
                        <div class="sd-event-card__image">
                            <img src="http://stardance.com.cy/wp-content/uploads/2026/02/Latin-American.png" alt="National Latin Championship" width="400" height="280" loading="lazy">
                        </div>
                        <div class="sd-event-card__content">
                            <span class="sd-event-card__date">22 April 2026</span>
                            <span class="sd-event-card__tag">Competition</span>
                            <h3 class="sd-event-card__title">National Latin Championship</h3>
                            <p class="sd-event-card__location">Nicosia, Cyprus</p>
                            <a href="#" class="sd-btn sd-btn--outline">View Details</a>
                        </div>
                    </article>

                    <article class="sd-event-card fade-in fade-in-delay-3" data-year="2026" data-category="kids" data-type="showcase" data-body="local">
                        <div class="sd-event-card__image">
                            <img src="http://stardance.com.cy/wp-content/uploads/2026/02/Kids-Programs.png" alt="Kids Spring Showcase" width="400" height="280" loading="lazy">
                        </div>
                        <div class="sd-event-card__content">
                            <span class="sd-event-card__date">10 May 2026</span>
                            <span class="sd-event-card__tag">Showcase</span>
                            <h3 class="sd-event-card__title">Kids Spring Showcase</h3>
                            <p class="sd-event-card__location">Star Dance Studio, Limassol</p>
                            <a href="#" class="sd-btn sd-btn--outline">View Details</a>
                        </div>
                    </article>

                    <article class="sd-event-card fade-in fade-in-delay-4" data-year="2025" data-category="ballroom" data-type="competition" data-body="wdsf">
                        <div class="sd-event-card__image">
                            <img src="http://stardance.com.cy/wp-content/uploads/2026/02/European-Ballroom.png" alt="WDSF Open Standard — Athens" width="400" height="280" loading="lazy">
                        </div>
                        <div class="sd-event-card__content">
                            <span class="sd-event-card__date">8 November 2025</span>
                            <span class="sd-event-card__tag">Competition</span>
                            <h3 class="sd-event-card__title">WDSF Open Standard &mdash; Athens</h3>
                            <p class="sd-event-card__location">Athens, Greece</p>
                            <a href="#" class="sd-btn sd-btn--outline">View Details</a>
                        </div>
                    </article>

                    <article class="sd-event-card fade-in fade-in-delay-5" data-year="2025" data-category="latin" data-type="workshop" data-body="local">
                        <div class="sd-event-card__image">
                            <img src="http://stardance.com.cy/wp-content/uploads/2026/02/Latin-Fusion-Ladies.png" alt="Latin Fusion Workshop" width="400" height="280" loading="lazy">
                        </div>
                        <div class="sd-event-card__content">
                            <span class="sd-event-card__date">3 October 2025</span>
                            <span class="sd-event-card__tag">Workshop</span>
                            <h3 class="sd-event-card__title">Latin Fusion Masterclass</h3>
                            <p class="sd-event-card__location">Star Dance Studio, Limassol</p>
                            <a href="#" class="sd-btn sd-btn--outline">View Details</a>
                        </div>
                    </article>

                    <article class="sd-event-card fade-in fade-in-delay-6" data-year="2025" data-category="ballroom" data-type="showcase" data-body="local">
                        <div class="sd-event-card__image">
                            <img src="http://stardance.com.cy/wp-content/uploads/2026/02/Wedding-Choreography.png" alt="Year-End Gala" width="400" height="280" loading="lazy">
                        </div>
                        <div class="sd-event-card__content">
                            <span class="sd-event-card__date">20 December 2025</span>
                            <span class="sd-event-card__tag">Showcase</span>
                            <h3 class="sd-event-card__title">Year-End Gala &amp; Showcase</h3>
                            <p class="sd-event-card__location">Limassol Municipal Theatre</p>
                            <a href="#" class="sd-btn sd-btn--outline">View Details</a>
                        </div>
                    </article>

                </div><!-- /.sd-events-page__grid -->

            </div><!-- /.sd-events-page__layout -->
        </div>
    </section>

    <!-- CTA -->
    <section class="sd-section sd-cta" id="cta">
        <div class="sd-container sd-cta__inner">
            <h2 class="sd-heading sd-cta__title fade-in fade-in-delay-0">Want to Compete?</h2>
            <p class="sd-text sd-cta__desc fade-in fade-in-delay-1">We guide students of all levels through their first competition and beyond.</p>
            <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="sd-btn fade-in fade-in-delay-2">Talk to Us</a>
        </div>
    </section>

</main>

<?php get_footer(); ?>
