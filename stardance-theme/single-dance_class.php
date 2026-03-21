<?php
/**
 * Single template for the dance_class custom post type.
 *
 * @package stardance
 */

get_header();

the_post();
?>

<main class="sd-page sd-page--single-class" id="main-content">

    <!-- Hero -->
    <section class="sd-page-hero sd-page-hero--single-class sd-section">
        <div class="sd-container">
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="sd-page-hero__thumbnail">
                    <?php the_post_thumbnail('large', array('class' => 'sd-page-hero__bg-image', 'alt' => get_the_title())); ?>
                </div>
            <?php endif; ?>
            <div class="sd-page-hero__content">
                <h1 class="sd-heading sd-page-hero__title fade-in fade-in-delay-0"><?php the_title(); ?></h1>
                <?php if ( get_the_excerpt() ) : ?>
                    <p class="sd-text sd-page-hero__desc fade-in fade-in-delay-1"><?php the_excerpt(); ?></p>
                <?php endif; ?>
                <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="sd-btn fade-in fade-in-delay-2">Book a Trial Class</a>
            </div>
        </div>
    </section>

    <!-- Detail Cards -->
    <section class="sd-section sd-class-details" id="class-details">
        <div class="sd-container">
            <h2 class="sd-heading sd-class-details__title fade-in fade-in-delay-0">Training Options</h2>
            <div class="sd-class-details__grid sd-grid">

                <div class="sd-class-details__card fade-in fade-in-delay-1">
                    <div class="sd-class-details__card-icon" aria-hidden="true">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-star.svg" alt="" width="48" height="48">
                    </div>
                    <h3 class="sd-class-details__card-title">Individual Training</h3>
                    <p class="sd-text">One-on-one sessions with Svetlana, tailored entirely to your technique, progress, and goals. Ideal for accelerating development at any level.</p>
                </div>

                <div class="sd-class-details__card fade-in fade-in-delay-2">
                    <div class="sd-class-details__card-icon" aria-hidden="true">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-star.svg" alt="" width="48" height="48">
                    </div>
                    <h3 class="sd-class-details__card-title">Partner Training</h3>
                    <p class="sd-text">Train as a couple with structured coaching on partnership, synchronisation, and the dynamics that separate good dancers from great ones.</p>
                </div>

                <div class="sd-class-details__card fade-in fade-in-delay-3">
                    <div class="sd-class-details__card-icon" aria-hidden="true">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-star.svg" alt="" width="48" height="48">
                    </div>
                    <h3 class="sd-class-details__card-title">Performance Groups</h3>
                    <p class="sd-text">Join a group rehearsing for showcases or competitions. Build ensemble skills, stage presence, and the energy that only group performance can deliver.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Class Times -->
    <section class="sd-section sd-class-times" id="class-times">
        <div class="sd-container">
            <h2 class="sd-heading sd-class-times__title fade-in fade-in-delay-0">When We Train</h2>
            <div class="sd-class-times__grid">

                <div class="sd-class-times__day fade-in fade-in-delay-1">
                    <span class="sd-class-times__day-name">Monday</span>
                    <span class="sd-class-times__day-time">17:00 – 20:00</span>
                </div>

                <div class="sd-class-times__day fade-in fade-in-delay-2">
                    <span class="sd-class-times__day-name">Tuesday</span>
                    <span class="sd-class-times__day-time">17:00 – 20:00</span>
                </div>

                <div class="sd-class-times__day fade-in fade-in-delay-3">
                    <span class="sd-class-times__day-name">Wednesday</span>
                    <span class="sd-class-times__day-time">17:00 – 20:00</span>
                </div>

                <div class="sd-class-times__day fade-in fade-in-delay-4">
                    <span class="sd-class-times__day-name">Thursday</span>
                    <span class="sd-class-times__day-time">17:00 – 20:00</span>
                </div>

                <div class="sd-class-times__day fade-in fade-in-delay-5">
                    <span class="sd-class-times__day-name">Friday</span>
                    <span class="sd-class-times__day-time">17:00 – 20:00</span>
                </div>

                <div class="sd-class-times__day fade-in fade-in-delay-6">
                    <span class="sd-class-times__day-name">Saturday</span>
                    <span class="sd-class-times__day-time">10:00 – 14:00</span>
                </div>

                <div class="sd-class-times__day sd-class-times__day--closed fade-in fade-in-delay-7">
                    <span class="sd-class-times__day-name">Sunday</span>
                    <span class="sd-class-times__day-time">Closed</span>
                </div>

            </div>
            <p class="sd-text sd-class-times__note">
                Times shown are indicative. <a href="<?php echo esc_url(home_url('/schedule/')); ?>">View the full timetable</a> or contact us to check current availability.
            </p>
        </div>
    </section>

    <!-- FAQ Accordion -->
    <section class="sd-section sd-faq sd-faq--single-class" id="faq">
        <div class="sd-container">
            <h2 class="sd-heading sd-faq__title fade-in fade-in-delay-0">Common Questions</h2>

            <div class="sd-faq__list">

                <div class="sd-faq__item fade-in fade-in-delay-1">
                    <button class="sd-faq__question" aria-expanded="false">
                        Is this class suitable for complete beginners?
                        <span class="sd-faq__icon" aria-hidden="true"></span>
                    </button>
                    <div class="sd-faq__answer" hidden>
                        <p>Yes. We welcome dancers at every level. Beginners start with foundational technique, rhythm, and posture before progressing to more advanced elements.</p>
                    </div>
                </div>

                <div class="sd-faq__item fade-in fade-in-delay-2">
                    <button class="sd-faq__question" aria-expanded="false">
                        Do I need special shoes or clothing?
                        <span class="sd-faq__icon" aria-hidden="true"></span>
                    </button>
                    <div class="sd-faq__answer" hidden>
                        <p>For your first session, comfortable clothes and clean flat-soled shoes are fine. As you progress, we'll recommend appropriate dance shoes for this style.</p>
                    </div>
                </div>

                <div class="sd-faq__item fade-in fade-in-delay-3">
                    <button class="sd-faq__question" aria-expanded="false">
                        Can I try a single session before committing?
                        <span class="sd-faq__icon" aria-hidden="true"></span>
                    </button>
                    <div class="sd-faq__answer" hidden>
                        <p>Absolutely. We offer trial classes with no obligation. It's the best way to experience the teaching style and see if the class is the right fit for you.</p>
                    </div>
                </div>

                <div class="sd-faq__item fade-in fade-in-delay-4">
                    <button class="sd-faq__question" aria-expanded="false">
                        How quickly will I see progress?
                        <span class="sd-faq__icon" aria-hidden="true"></span>
                    </button>
                    <div class="sd-faq__answer" hidden>
                        <p>Most students notice visible improvement within 4–6 weeks of consistent attendance. Progress accelerates significantly when group classes are combined with individual lessons.</p>
                    </div>
                </div>

                <div class="sd-faq__item fade-in fade-in-delay-5">
                    <button class="sd-faq__question" aria-expanded="false">
                        Is there an opportunity to compete?
                        <span class="sd-faq__icon" aria-hidden="true"></span>
                    </button>
                    <div class="sd-faq__answer" hidden>
                        <p>Competition is encouraged but never mandatory. Students who wish to compete receive additional coaching, choreography, and full guidance through the competition process.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Dancer Gallery -->
    <section class="sd-section sd-class-gallery" id="class-gallery">
        <div class="sd-container">
            <h2 class="sd-heading sd-class-gallery__title fade-in fade-in-delay-0">In the Studio</h2>
            <div class="sd-class-gallery__grid"
                 data-photoswipe-gallery
                 itemscope
                 itemtype="http://schema.org/ImageGallery">

                <a href="http://stardance.com.cy/wp-content/uploads/2026/02/European-Ballroom.png"
                   class="sd-class-gallery__item fade-in fade-in-delay-1"
                   data-pswp-width="1200"
                   data-pswp-height="900"
                   itemprop="associatedMedia"
                   itemscope
                   itemtype="http://schema.org/ImageObject">
                    <img src="http://stardance.com.cy/wp-content/uploads/2026/02/European-Ballroom.png"
                         alt="<?php echo esc_attr(get_the_title()); ?> class"
                         width="400" height="300"
                         loading="lazy"
                         itemprop="thumbnail">
                </a>

                <a href="http://stardance.com.cy/wp-content/uploads/2026/02/Latin-American.png"
                   class="sd-class-gallery__item fade-in fade-in-delay-2"
                   data-pswp-width="1200"
                   data-pswp-height="900"
                   itemprop="associatedMedia"
                   itemscope
                   itemtype="http://schema.org/ImageObject">
                    <img src="http://stardance.com.cy/wp-content/uploads/2026/02/Latin-American.png"
                         alt="<?php echo esc_attr(get_the_title()); ?> performance"
                         width="400" height="300"
                         loading="lazy"
                         itemprop="thumbnail">
                </a>

                <a href="http://stardance.com.cy/wp-content/uploads/2026/02/Latin-Fusion-Ladies.png"
                   class="sd-class-gallery__item fade-in fade-in-delay-3"
                   data-pswp-width="1200"
                   data-pswp-height="900"
                   itemprop="associatedMedia"
                   itemscope
                   itemtype="http://schema.org/ImageObject">
                    <img src="http://stardance.com.cy/wp-content/uploads/2026/02/Latin-Fusion-Ladies.png"
                         alt="<?php echo esc_attr(get_the_title()); ?> showcase"
                         width="400" height="300"
                         loading="lazy"
                         itemprop="thumbnail">
                </a>

            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="sd-section sd-cta" id="cta">
        <div class="sd-container sd-cta__inner">
            <h2 class="sd-heading sd-cta__title fade-in fade-in-delay-0">Ready to Try <?php the_title(); ?>?</h2>
            <p class="sd-text sd-cta__desc fade-in fade-in-delay-1">Book a trial class today — no experience or commitment needed.</p>
            <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="sd-btn fade-in fade-in-delay-2">Book a Trial Class</a>
        </div>
    </section>

    <!-- Location / Map -->
    <section class="sd-section sd-class-location" id="location">
        <div class="sd-container">
            <h2 class="sd-heading sd-class-location__title fade-in fade-in-delay-0">Find Us</h2>
            <p class="sd-text sd-class-location__address fade-in fade-in-delay-1">
                Masterland/KIDDOM, Spyrou Kyprianou Ave 48, Limassol 4043, Cyprus
            </p>
            <div class="sd-class-location__map fade-in fade-in-delay-2">
                <!-- Map embed placeholder — replace with actual embed in production -->
                <div class="sd-class-location__map-placeholder" aria-label="Map placeholder">
                    <p>Map embed goes here</p>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
