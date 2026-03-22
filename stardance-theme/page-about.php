<?php
/**
 * Template Name: About
 *
 * @package stardance
 */

get_header();
?>

<main class="sd-page sd-page--about" id="main-content">

    <?php stardance_render_page_hero(array(
        'title'       => 'About Star Dance Studio',
        'description' => 'A professional dance academy in the heart of Limassol, dedicated to the art and discipline of competitive ballroom and Latin dance.',
        'modifier'    => 'about',
    )); ?>

    <!-- Training Overview -->
    <section class="sd-section sd-about-overview" id="overview">
        <div class="sd-container">
            <div class="sd-about-overview__layout">

                <div class="sd-about-overview__text fade-in fade-in-delay-0">
                    <h2 class="sd-heading">Professional Training in Limassol</h2>
                    <p class="sd-text">
                        Founded and led by World and European championship medallist Svetlana Panova, Star Dance Studio has been shaping champions since its inception. Our approach combines rigorous technique, expressive artistry, and a supportive training environment that brings out the best in every dancer.
                    </p>
                    <p class="sd-text">
                        We train dancers of all ages and levels — from children taking their first steps in rhythm to adults preparing for the international competition circuit. Every student receives personalised attention, structured progression, and access to the same methodology used by our podium finishers.
                    </p>
                </div>

                <div class="sd-about-overview__image fade-in fade-in-delay-1">
                    <img src="http://stardance.com.cy/wp-content/uploads/2026/02/European-Ballroom.png" alt="Training at Star Dance Studio" width="600" height="450" loading="lazy">
                </div>

            </div>
        </div>
    </section>

    <!-- Values Grid -->
    <section class="sd-section sd-about-values" id="values">
        <div class="sd-container">
            <h2 class="sd-heading sd-about-values__title fade-in fade-in-delay-0">What We Stand For</h2>
            <div class="sd-about-values__grid sd-grid sd-grid--2">

                <?php stardance_render_icon_card(array(
                    'icon_url' => get_template_directory_uri() . '/assets/images/icon-star.svg',
                    'title'    => 'Passion for Dance',
                    'text'     => 'We believe dance is more than movement — it\'s a lifelong discipline that builds character, confidence, and connection.',
                    'delay'    => 1,
                )); ?>

                <?php stardance_render_icon_card(array(
                    'icon_url' => get_template_directory_uri() . '/assets/images/icon-star.svg',
                    'title'    => 'Excellence in Training',
                    'text'     => 'The studio is committed to delivering internationally competitive standards of teaching to every student who walks through the door.',
                    'delay'    => 2,
                )); ?>

                <?php stardance_render_icon_card(array(
                    'icon_url' => get_template_directory_uri() . '/assets/images/icon-star.svg',
                    'title'    => 'Individual Growth',
                    'text'     => 'Every dancer progresses at their own pace, with personalised guidance to help them reach their full potential on and off the floor.',
                    'delay'    => 3,
                )); ?>

                <?php stardance_render_icon_card(array(
                    'icon_url' => get_template_directory_uri() . '/assets/images/icon-star.svg',
                    'title'    => 'Supportive Community',
                    'text'     => 'Our studio is open to all ages and welcomes everyone from beginners to elite competitors. Dance here is for life.',
                    'delay'    => 4,
                )); ?>

            </div>
        </div>
    </section>

    <!-- Champions Section -->
    <section class="sd-section sd-about-champions" id="champions">
        <div class="sd-container">
            <h2 class="sd-heading sd-about-champions__title fade-in fade-in-delay-0">We Grow Champions</h2>
            <div class="sd-about-champions__grid sd-grid sd-grid--2">

                <div class="sd-about-champions__item fade-in fade-in-delay-1">
                    <h3 class="sd-about-champions__item-title">Experience</h3>
                    <p class="sd-text">Over two decades of training competitive dancers at the highest levels of ballroom and Latin dance.</p>
                </div>

                <div class="sd-about-champions__item fade-in fade-in-delay-2">
                    <h3 class="sd-about-champions__item-title">Results</h3>
                    <p class="sd-text">Numerous Cypriot National Champions, European finalists, and World Championship representatives.</p>
                </div>

                <div class="sd-about-champions__item fade-in fade-in-delay-3">
                    <h3 class="sd-about-champions__item-title">Approach</h3>
                    <p class="sd-text">Each student receives a personalised development plan combining group classes, private lessons, and competition coaching.</p>
                </div>

                <div class="sd-about-champions__item fade-in fade-in-delay-4">
                    <h3 class="sd-about-champions__item-title">Credentials</h3>
                    <p class="sd-text">WDSF-certified coaching. Our head coach is a decorated international competitor and certified adjudicator.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Coach Profile: Svetlana -->
    <section class="sd-section sd-about-coach" id="coach">
        <div class="sd-container">
            <h2 class="sd-heading sd-about-coach__section-title fade-in fade-in-delay-0">Head Coach &amp; International Adjudicator</h2>
            <div class="sd-about-coach__layout">

                <div class="sd-about-coach__bio fade-in fade-in-delay-0">
                    <h3 class="sd-heading sd-about-coach__name">Svetlana Grimcevski</h3>

                    <div class="sd-about-coach__subsection">
                        <h4 class="sd-about-coach__subsection-title">Qualifications</h4>
                        <p class="sd-text">10 years of My Star Dance Studio — qualified to judge Latin American and Standard European dances at international tournaments.</p>
                    </div>

                    <div class="sd-about-coach__subsection">
                        <h4 class="sd-about-coach__subsection-title">Experience</h4>
                        <p class="sd-text">From 2005&ndash;2015, Svetlana competed at the highest levels of international ballroom dance, achieving podium finishes across Europe and representing Cyprus on the world stage. She has since dedicated herself fully to developing the next generation of champions.</p>
                    </div>

                    <div class="sd-about-coach__subsection">
                        <h4 class="sd-about-coach__subsection-title">Coaching Philosophy</h4>
                        <p class="sd-text">Svetlana approaches coaching with individual attention to each student, combining technical precision with artistic expression. She believes every dancer has unique potential — her role is to find it and develop it.</p>
                    </div>

                    <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="sd-btn">Train with Svetlana</a>
                </div>

                <div class="sd-about-coach__image fade-in fade-in-delay-1">
                    <img src="http://stardance.com.cy/wp-content/uploads/2026/02/Latin-American.png" alt="Svetlana Grimcevski — Head Coach" width="540" height="680" loading="lazy">
                </div>

            </div>
        </div>
    </section>

    <?php stardance_render_cta(array(
        'title'       => 'Ready to Join Us?',
        'description' => 'Take the first step. Book a trial class or simply come in and see what Star Dance Studio is all about.',
        'button_text' => 'Get in Touch',
        'button_url'  => home_url('/#contact'),
    )); ?>

</main>

<?php get_footer(); ?>
