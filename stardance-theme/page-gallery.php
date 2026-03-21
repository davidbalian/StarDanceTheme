<?php
/**
 * Template Name: Gallery
 *
 * @package stardance
 */

get_header();
?>

<main class="sd-page sd-page--gallery" id="main-content">

    <!-- Hero -->
    <section class="sd-page-hero sd-page-hero--gallery sd-section">
        <div class="sd-container">
            <h1 class="sd-heading sd-page-hero__title fade-in fade-in-delay-0">Gallery</h1>
            <p class="sd-text sd-page-hero__desc fade-in fade-in-delay-1">
                Moments from our classes, performances, and competitions — captured on and off the dance floor.
            </p>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="sd-section sd-gallery-page" id="gallery">
        <div class="sd-container">

            <!-- Filter Bar -->
            <div class="sd-gallery-page__filters fade-in fade-in-delay-0" role="group" aria-label="Filter gallery">

                <div class="sd-gallery-page__filter-group">
                    <span class="sd-gallery-page__filter-label">Year:</span>
                    <div class="sd-gallery-page__filter-tabs" role="tablist">
                        <button class="sd-gallery-page__tab is-active" role="tab" aria-selected="true" data-filter="year" data-value="all">All</button>
                        <button class="sd-gallery-page__tab" role="tab" aria-selected="false" data-filter="year" data-value="2026">2026</button>
                        <button class="sd-gallery-page__tab" role="tab" aria-selected="false" data-filter="year" data-value="2025">2025</button>
                        <button class="sd-gallery-page__tab" role="tab" aria-selected="false" data-filter="year" data-value="2024">2024</button>
                    </div>
                </div>

                <div class="sd-gallery-page__filter-group">
                    <span class="sd-gallery-page__filter-label">Type:</span>
                    <div class="sd-gallery-page__filter-tabs" role="tablist">
                        <button class="sd-gallery-page__tab is-active" role="tab" aria-selected="true" data-filter="type" data-value="all">All</button>
                        <button class="sd-gallery-page__tab" role="tab" aria-selected="false" data-filter="type" data-value="competition">Competition</button>
                        <button class="sd-gallery-page__tab" role="tab" aria-selected="false" data-filter="type" data-value="showcase">Showcase</button>
                        <button class="sd-gallery-page__tab" role="tab" aria-selected="false" data-filter="type" data-value="studio">Studio</button>
                    </div>
                </div>

            </div><!-- /.sd-gallery-page__filters -->

            <!-- Photo Grid -->
            <div class="sd-gallery-page__grid" id="gallery-grid"
                 data-photoswipe-gallery
                 itemscope
                 itemtype="http://schema.org/ImageGallery">

                <a href="http://stardance.com.cy/wp-content/uploads/2026/02/European-Ballroom.png"
                   class="sd-gallery-page__item fade-in fade-in-delay-1"
                   data-pswp-width="1200"
                   data-pswp-height="900"
                   data-year="2026"
                   data-type="competition"
                   itemprop="associatedMedia"
                   itemscope
                   itemtype="http://schema.org/ImageObject">
                    <img src="http://stardance.com.cy/wp-content/uploads/2026/02/European-Ballroom.png"
                         alt="European Ballroom Competition 2026"
                         width="400" height="300"
                         loading="lazy"
                         itemprop="thumbnail">
                    <span class="sd-gallery-page__overlay">
                        <span class="sd-gallery-page__caption">European Ballroom — 2026</span>
                    </span>
                </a>

                <a href="http://stardance.com.cy/wp-content/uploads/2026/02/Latin-American.png"
                   class="sd-gallery-page__item fade-in fade-in-delay-2"
                   data-pswp-width="1200"
                   data-pswp-height="900"
                   data-year="2026"
                   data-type="competition"
                   itemprop="associatedMedia"
                   itemscope
                   itemtype="http://schema.org/ImageObject">
                    <img src="http://stardance.com.cy/wp-content/uploads/2026/02/Latin-American.png"
                         alt="Latin American Competition 2026"
                         width="400" height="300"
                         loading="lazy"
                         itemprop="thumbnail">
                    <span class="sd-gallery-page__overlay">
                        <span class="sd-gallery-page__caption">Latin American — 2026</span>
                    </span>
                </a>

                <a href="http://stardance.com.cy/wp-content/uploads/2026/02/Latin-Fusion-Ladies.png"
                   class="sd-gallery-page__item fade-in fade-in-delay-3"
                   data-pswp-width="1200"
                   data-pswp-height="900"
                   data-year="2025"
                   data-type="showcase"
                   itemprop="associatedMedia"
                   itemscope
                   itemtype="http://schema.org/ImageObject">
                    <img src="http://stardance.com.cy/wp-content/uploads/2026/02/Latin-Fusion-Ladies.png"
                         alt="Latin Fusion Ladies Showcase 2025"
                         width="400" height="300"
                         loading="lazy"
                         itemprop="thumbnail">
                    <span class="sd-gallery-page__overlay">
                        <span class="sd-gallery-page__caption">Latin Fusion Ladies — 2025</span>
                    </span>
                </a>

                <a href="http://stardance.com.cy/wp-content/uploads/2026/02/Kids-Programs.png"
                   class="sd-gallery-page__item fade-in fade-in-delay-4"
                   data-pswp-width="1200"
                   data-pswp-height="900"
                   data-year="2025"
                   data-type="showcase"
                   itemprop="associatedMedia"
                   itemscope
                   itemtype="http://schema.org/ImageObject">
                    <img src="http://stardance.com.cy/wp-content/uploads/2026/02/Kids-Programs.png"
                         alt="Kids Program Showcase 2025"
                         width="400" height="300"
                         loading="lazy"
                         itemprop="thumbnail">
                    <span class="sd-gallery-page__overlay">
                        <span class="sd-gallery-page__caption">Kids Program — 2025</span>
                    </span>
                </a>

                <a href="http://stardance.com.cy/wp-content/uploads/2026/02/Wedding-Choreography.png"
                   class="sd-gallery-page__item fade-in fade-in-delay-5"
                   data-pswp-width="1200"
                   data-pswp-height="900"
                   data-year="2025"
                   data-type="studio"
                   itemprop="associatedMedia"
                   itemscope
                   itemtype="http://schema.org/ImageObject">
                    <img src="http://stardance.com.cy/wp-content/uploads/2026/02/Wedding-Choreography.png"
                         alt="Wedding Choreography Studio Session 2025"
                         width="400" height="300"
                         loading="lazy"
                         itemprop="thumbnail">
                    <span class="sd-gallery-page__overlay">
                        <span class="sd-gallery-page__caption">Wedding Choreography — 2025</span>
                    </span>
                </a>

                <a href="http://stardance.com.cy/wp-content/uploads/2026/02/Individual-Lessons.png"
                   class="sd-gallery-page__item fade-in fade-in-delay-6"
                   data-pswp-width="1200"
                   data-pswp-height="900"
                   data-year="2024"
                   data-type="studio"
                   itemprop="associatedMedia"
                   itemscope
                   itemtype="http://schema.org/ImageObject">
                    <img src="http://stardance.com.cy/wp-content/uploads/2026/02/Individual-Lessons.png"
                         alt="Individual Lessons Studio Session 2024"
                         width="400" height="300"
                         loading="lazy"
                         itemprop="thumbnail">
                    <span class="sd-gallery-page__overlay">
                        <span class="sd-gallery-page__caption">Individual Lessons — 2024</span>
                    </span>
                </a>

                <a href="http://stardance.com.cy/wp-content/uploads/2026/02/European-Ballroom.png"
                   class="sd-gallery-page__item fade-in fade-in-delay-7"
                   data-pswp-width="1200"
                   data-pswp-height="900"
                   data-year="2024"
                   data-type="competition"
                   itemprop="associatedMedia"
                   itemscope
                   itemtype="http://schema.org/ImageObject">
                    <img src="http://stardance.com.cy/wp-content/uploads/2026/02/European-Ballroom.png"
                         alt="European Ballroom Championship 2024"
                         width="400" height="300"
                         loading="lazy"
                         itemprop="thumbnail">
                    <span class="sd-gallery-page__overlay">
                        <span class="sd-gallery-page__caption">European Ballroom — 2024</span>
                    </span>
                </a>

                <a href="http://stardance.com.cy/wp-content/uploads/2026/02/Latin-American.png"
                   class="sd-gallery-page__item fade-in fade-in-delay-8"
                   data-pswp-width="1200"
                   data-pswp-height="900"
                   data-year="2024"
                   data-type="showcase"
                   itemprop="associatedMedia"
                   itemscope
                   itemtype="http://schema.org/ImageObject">
                    <img src="http://stardance.com.cy/wp-content/uploads/2026/02/Latin-American.png"
                         alt="Latin American End-of-Year Showcase 2024"
                         width="400" height="300"
                         loading="lazy"
                         itemprop="thumbnail">
                    <span class="sd-gallery-page__overlay">
                        <span class="sd-gallery-page__caption">Latin American — 2024</span>
                    </span>
                </a>

            </div><!-- /#gallery-grid -->

            <!-- Show More -->
            <div class="sd-gallery-page__more fade-in fade-in-delay-0">
                <button class="sd-btn sd-btn--outline" id="gallery-show-more" type="button">Show More</button>
            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>
