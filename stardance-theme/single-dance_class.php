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

                <?php
                $sd_class_details_lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
                ?>

                <?php stardance_render_class_detail_card(array(
                    'bg_url'        => 'https://stardance.com.cy/wp-content/uploads/2026/03/class-details-card-bg-navy-turqoise.webp',
                    'title'         => 'Individual Training',
                    'paragraphs'    => array(
                        'Description of solo classes, technique focus, who this is for, and benefits of solo training.',
                        $sd_class_details_lorem,
                    ),
                    'pills'         => array(
                        'All skill levels',
                        'Those without a partner',
                        'Dancers wanting to strengthen individual technique',
                    ),
                    'tone'          => 'dark',
                    'pills_style'   => 'gold',
                    'pills_layout'  => 'stagger',
                    'delay'         => 1,
                )); ?>

                <?php stardance_render_class_detail_card(array(
                    'bg_url'      => 'https://stardance.com.cy/wp-content/uploads/2026/03/class-details-card-bg-turqiose-navy.webp',
                    'title'       => 'Partner Dancing',
                    'paragraphs'  => array(
                        'Description of couples training, what\'s covered, skill levels available, and what students can expect.',
                        $sd_class_details_lorem,
                    ),
                    'pills'       => array(
                        'Beginners',
                        'Intermediate',
                        'Competition level',
                        'Advanced',
                    ),
                    'tone'        => 'light',
                    'pills_style' => 'gold',
                    'delay'       => 2,
                )); ?>

                <?php stardance_render_class_detail_card(array(
                    'bg_url'      => 'https://stardance.com.cy/wp-content/uploads/2026/03/class-details-card-bg-navy-gold.webp',
                    'title'       => 'Performance Groups',
                    'paragraphs'  => array(
                        'Description of show group training, performance opportunities, and what students will work towards.',
                        $sd_class_details_lorem,
                    ),
                    'pills'       => array(
                        'Dancers interested in performances',
                        'Group choreography experience',
                        'Studio showcases and events',
                    ),
                    'tone'        => 'dark',
                    'pills_style' => 'gradient',
                    'delay'       => 3,
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

            <div class="sd-classes-faq__layout">
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

            <div class="sd-classes-faq__image-wrap fade-in fade-in-delay-2" aria-hidden="true">
                <img src="https://stardance.com.cy/wp-content/uploads/2026/03/single-class-faq.webp" alt="" class="sd-classes-faq__image" loading="lazy">
                <img src="https://stardance.com.cy/wp-content/uploads/2026/03/large-overlay.svg" alt="" class="sd-classes-faq__image-decoration" loading="lazy">
            </div>
            </div>
        </div>
    </section>

    <!-- Dancers in action (video poster) -->
    <section class="sd-section sd-class-video" id="class-gallery">
        <div class="sd-container">
            <h2 class="sd-heading sd-class-video__title fade-in fade-in-delay-0">See Our Dancers in Action</h2>
            <div class="sd-class-video__frame fade-in fade-in-delay-1">
                <img
                    src="https://stardance.com.cy/wp-content/uploads/2026/03/single-class-video.webp"
                    alt="<?php echo esc_attr(get_the_title() . ' — ' . __('dancers in action', 'stardance')); ?>"
                    class="sd-class-video__poster"
                    loading="lazy"
                    width="1200"
                    height="675">
                <img
                    src="https://stardance.com.cy/wp-content/uploads/2026/03/large-overlay.svg"
                    alt=""
                    class="sd-class-video__overlay"
                    aria-hidden="true"
                    loading="lazy">
                <button type="button" class="sd-class-video__play" aria-label="<?php echo esc_attr__('Play video', 'stardance'); ?>">
                    <img
                        src="https://stardance.com.cy/wp-content/uploads/2026/03/play-button-blue.svg"
                        alt=""
                        width="80"
                        height="80"
                        decoding="async">
                </button>
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
