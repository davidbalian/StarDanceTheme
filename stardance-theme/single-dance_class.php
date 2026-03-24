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
    <?php stardance_render_page_hero(array(
        'title'       => get_the_title(),
        'description' => get_the_excerpt(),
        'modifier'    => 'single-class',
        'buttons'     => array(
            array( 'text' => 'View Schedule', 'url' => '#class-times' ),
            array( 'text' => 'Contact Us',    'url' => home_url( '/#contact' ) ),
        ),
    )); ?>

    <!-- Detail Cards -->
    <section class="sd-section sd-class-details" id="class-details">
        <div class="sd-container">
            <h2 class="sd-heading sd-class-details__title fade-in fade-in-delay-0">Class Details</h2>
            <div class="sd-class-details__grid sd-grid sd-grid--3">

                <?php stardance_render_icon_card(array(
                    'icon_url' => get_template_directory_uri() . '/assets/images/icon-star.svg',
                    'title'    => 'Individual Training',
                    'text'     => 'One-on-one sessions with Svetlana, tailored entirely to your technique, progress, and goals. Ideal for accelerating development at any level.',
                    'delay'    => 1,
                )); ?>

                <?php stardance_render_icon_card(array(
                    'icon_url' => get_template_directory_uri() . '/assets/images/icon-star.svg',
                    'title'    => 'Partner Training',
                    'text'     => 'Train as a couple with structured coaching on partnership, synchronisation, and the dynamics that separate good dancers from great ones.',
                    'delay'    => 2,
                )); ?>

                <?php stardance_render_icon_card(array(
                    'icon_url' => get_template_directory_uri() . '/assets/images/icon-star.svg',
                    'title'    => 'Performance Groups',
                    'text'     => 'Join a group rehearsing for showcases or competitions. Build ensemble skills, stage presence, and the energy that only group performance can deliver.',
                    'delay'    => 3,
                )); ?>

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

                <?php stardance_render_faq_item(array(
                    'question' => 'What level do I need to be to join this class?',
                    'answer'   => 'This class is open to all levels. Whether you\'re a complete beginner or a more experienced dancer, we\'ll work with you at the right pace and in the right group.',
                    'delay'    => 1,
                )); ?>

                <?php stardance_render_faq_item(array(
                    'question' => 'Do I need a partner?',
                    'answer'   => 'No. Many students join solo. We rotate partners in group classes and can always find you someone to train with.',
                    'delay'    => 2,
                )); ?>

                <?php stardance_render_faq_item(array(
                    'question' => 'What age groups are these classes for?',
                    'answer'   => 'We run separate sessions for children and adults. Check the timetable or contact us for the age-specific schedule for this class.',
                    'delay'    => 3,
                )); ?>

                <?php stardance_render_faq_item(array(
                    'question' => 'How often should I attend?',
                    'answer'   => 'We recommend at least two sessions per week for steady progress. Even one session a week will produce results over time. Private lessons alongside group classes accelerate development significantly.',
                    'delay'    => 4,
                )); ?>

            </div>
        </div>
    </section>

    <!-- Dancer Gallery -->
    <section class="sd-section sd-class-gallery" id="class-gallery">
        <div class="sd-container">
            <h2 class="sd-heading sd-class-gallery__title fade-in fade-in-delay-0">See Our Dancers in Action</h2>
            <div class="sd-class-gallery__grid"
                 data-gallery-lightbox
                 itemscope
                 itemtype="http://schema.org/ImageGallery">

                <a href="http://stardance.com.cy/wp-content/uploads/2026/02/European-Ballroom.png"
                   class="sd-class-gallery__item fade-in fade-in-delay-1"
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

    <?php stardance_render_cta(array(
        'title'       => 'Ready to Start?',
        'description' => 'Book a trial class today — no experience or commitment needed.',
        'button_text' => 'Book a Trial Class',
        'button_url'  => home_url('/#contact'),
    )); ?>

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
