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
        'description' => 'We are a professional dance school in Limassol offering Latin American and Ballroom instruction for all ages and levels. From young beginners to competitive dancers, we help each student reach their full potential on the dance floor.',
        'modifier'    => 'about',
    )); ?>

    <!-- Training Overview -->
    <section class="sd-section sd-about-overview" id="overview">
        <div class="sd-container">
            <h2 class="sd-heading sd-about-overview__title fade-in fade-in-delay-0">Professional Training in Limassol</h2>
            <div class="sd-about-overview__layout">

                <div class="sd-about-overview__text fade-in fade-in-delay-1">
                    <p class="sd-text">
                        Star Dance Studio is an official member of the Cyprus Federation of Social &amp; Sport Dance. Our studio provides certified instruction following international standards for both Latin American and European Ballroom programs.
                    </p>
                    <p class="sd-text">
                        We welcome students from age 3 through adults, offering group classes, private lessons, and competition training. Whether you want to dance for fun, fitness, or to compete at the highest level, we have a program for you.
                    </p>
                </div>

                <div class="sd-about-overview__image fade-in fade-in-delay-1">
                    <div class="sd-about-overview__video">
                        <img src="https://stardance.com.cy/wp-content/uploads/2026/03/about-page-video-cover.webp" alt="Training at Star Dance Studio" width="600" height="450" loading="lazy">
                        <img src="https://stardance.com.cy/wp-content/uploads/2026/03/play-button.svg" alt="" class="sd-about-overview__play-btn" aria-hidden="true" width="72" height="72">
                        <img src="https://stardance.com.cy/wp-content/uploads/2026/02/coach-bottom-svg-1.svg" alt="" class="sd-about-overview__corner-svg" aria-hidden="true">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Values Grid -->
    <section class="sd-section sd-about-values" id="values">
        <div class="sd-container">
            <h2 class="sd-heading sd-about-values__title fade-in fade-in-delay-0">What We Stand For</h2>
            <div class="sd-about-values__grid">

                <div class="sd-about-values__col">
                    <div class="sd-about-values__card fade-in fade-in-delay-1">
                        <h3 class="sd-about-values__card-title">Passion for Dance</h3>
                        <p class="sd-text">We believe dance is more than movement. It's expression, connection, and joy. We bring that energy to every class.</p>
                    </div>
                    <div class="sd-about-values__card fade-in fade-in-delay-2">
                        <h3 class="sd-about-values__card-title">Individual Growth</h3>
                        <p class="sd-text">Every student has different goals. We tailor our approach to help each dancer progress at their own pace, whether they're dancing for fun or preparing for competition.</p>
                    </div>
                </div>

                <div class="sd-about-values__trophy fade-in fade-in-delay-1" aria-hidden="true">
                    <img src="https://stardance.com.cy/wp-content/uploads/2026/03/what-we-stand-for-trophy.webp" alt="" width="220" height="300" loading="lazy">
                </div>

                <div class="sd-about-values__col">
                    <div class="sd-about-values__card fade-in fade-in-delay-1">
                        <h3 class="sd-about-values__card-title">Excellence in Training</h3>
                        <p class="sd-text">Our instruction follows international standards. We focus on proper technique, musicality, and performance quality from day one.</p>
                    </div>
                    <div class="sd-about-values__card fade-in fade-in-delay-2">
                        <h3 class="sd-about-values__card-title">Supportive Community</h3>
                        <p class="sd-text">Our studio is a welcoming space for all ages and backgrounds. We celebrate each other's progress and create lasting friendships through dance.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Champions Section -->
    <section class="sd-section sd-about-champions" id="champions">
        <div class="sd-container">
            <h2 class="sd-heading sd-about-champions__title fade-in fade-in-delay-0">We Grow Champions</h2>
            <div class="sd-about-champions__grid">

                <div class="sd-about-champions__item fade-in fade-in-delay-1">
                    <h3 class="sd-about-champions__item-title">Experience</h3>
                    <p class="sd-text">Over 18 years of professional coaching experience. Our training methods are proven at the highest levels of international competition.</p>
                </div>

                <div class="sd-about-champions__item fade-in fade-in-delay-2">
                    <h3 class="sd-about-champions__item-title">Results</h3>
                    <p class="sd-text">Our students have competed at finals level in major international competitions including Stuttgart, Blackpool, and Boston. We've trained champions from Cyprus, Israel, Italy, Greece, Estonia, Poland, Macedonia, and Ireland.</p>
                </div>

                <div class="sd-about-champions__image fade-in fade-in-delay-3">
                    <img src="https://stardance.com.cy/wp-content/uploads/2026/03/about-page-we-grow-champions-top-right.webp" alt="Star Dance Studio champions" loading="lazy">
                </div>

                <div class="sd-about-champions__image fade-in fade-in-delay-3">
                    <img src="https://stardance.com.cy/wp-content/uploads/2026/03/about-page-we-grow-champions-bottom-left.webp" alt="Star Dance Studio students competing" loading="lazy">
                </div>

                <div class="sd-about-champions__item fade-in fade-in-delay-4">
                    <h3 class="sd-about-champions__item-title">Approach</h3>
                    <p class="sd-text">We combine technical excellence with a supportive learning environment. Our coaches give personal attention to each student, focusing on both skill development and confidence building.</p>
                </div>

                <div class="sd-about-champions__item fade-in fade-in-delay-5">
                    <h3 class="sd-about-champions__item-title">Credentials</h3>
                    <p class="sd-text">Official member of the Cyprus Federation of Social &amp; Sport Dance. International-level coaching and judging qualifications.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Coach Profile: Slider -->
    <section class="sd-section sd-about-coach" id="coach">
        <div class="sd-container">
            <h2 class="sd-heading sd-about-coach__section-title fade-in fade-in-delay-0">Head Coach &amp; International Adjudicator</h2>

            <div class="sd-about-coach__wrapper">
            <div class="sd-about-coach__slider" aria-live="polite">
                <div class="sd-about-coach__track">

                    <!-- Slide 1 -->
                    <div class="sd-about-coach__slide">
                        <div class="sd-about-coach__bio">
                            <h3 class="sd-heading sd-about-coach__name">Svetlana Grincevschi</h3>
                            <div class="sd-about-coach__subsection">
                                <h4 class="sd-about-coach__subsection-title">Qualifications</h4>
                                <p class="sd-text">International Adjudicator (License &ldquo;A&rdquo;) with the World Dance Sport Federation, qualified to judge Latin American and European Standard dance competitions.</p>
                            </div>
                            <div class="sd-about-coach__subsection">
                                <h4 class="sd-about-coach__subsection-title">Experience</h4>
                                <p class="sd-text">Since 2007, Svetlana has coached competitive dancers at the international level. Her expertise spans both Latin American and European Ballroom programs, with a focus on developing champions from the ground up.</p>
                            </div>
                            <div class="sd-about-coach__subsection">
                                <h4 class="sd-about-coach__subsection-title">Student Achievements</h4>
                                <p class="sd-text">Svetlana's students have represented Cyprus, Israel, Italy, Greece, Estonia, Poland, Macedonia, and Ireland at international competitions. They regularly compete at finals level in prestigious events including:</p>
                                <ul class="sd-about-coach__list">
                                    <li>Blackpool Dance Festival (England)</li>
                                    <li>German Open Championships (Stuttgart)</li>
                                    <li>International competitions in Boston</li>
                                </ul>
                            </div>
                            <div class="sd-about-coach__subsection">
                                <h4 class="sd-about-coach__subsection-title">Coaching Philosophy</h4>
                                <p class="sd-text">Svetlana combines rigorous technical training with individual attention to each dancer's strengths and goals. Her approach builds not just skilled dancers, but confident performers who excel under pressure.</p>
                            </div>
                            <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="sd-btn">Train with Svetlana</a>
                        </div>
                        <div class="sd-about-coach__image">
                            <div class="sd-coaches__card">
                                <img src="http://stardance.com.cy/wp-content/uploads/2026/02/coach.jpg" alt="Svetlana Grincevschi — Head Coach" loading="lazy">
                                <div class="sd-coaches__overlay sd-coaches__overlay--top">
                                    <img class="sd-coaches__wave" src="http://stardance.com.cy/wp-content/uploads/2026/02/coach-top-svg-1.svg" alt="" aria-hidden="true">
                                </div>
                                <div class="sd-coaches__overlay">
                                    <img class="sd-coaches__wave" src="http://stardance.com.cy/wp-content/uploads/2026/02/coach-bottom-svg-1.svg" alt="" aria-hidden="true">
                                </div>
                                <h3 class="sd-coaches__name">Svetlana Grincevschi</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="sd-about-coach__slide">
                        <div class="sd-about-coach__bio">
                            <h3 class="sd-heading sd-about-coach__name">Svetlana Grincevschi</h3>
                            <div class="sd-about-coach__subsection">
                                <h4 class="sd-about-coach__subsection-title">Qualifications</h4>
                                <p class="sd-text">International Adjudicator (License &ldquo;A&rdquo;) with the World Dance Sport Federation, qualified to judge Latin American and European Standard dance competitions.</p>
                            </div>
                            <div class="sd-about-coach__subsection">
                                <h4 class="sd-about-coach__subsection-title">Experience</h4>
                                <p class="sd-text">Since 2007, Svetlana has coached competitive dancers at the international level. Her expertise spans both Latin American and European Ballroom programs, with a focus on developing champions from the ground up.</p>
                            </div>
                            <div class="sd-about-coach__subsection">
                                <h4 class="sd-about-coach__subsection-title">Student Achievements</h4>
                                <p class="sd-text">Svetlana's students have represented Cyprus, Israel, Italy, Greece, Estonia, Poland, Macedonia, and Ireland at international competitions. They regularly compete at finals level in prestigious events including:</p>
                                <ul class="sd-about-coach__list">
                                    <li>Blackpool Dance Festival (England)</li>
                                    <li>German Open Championships (Stuttgart)</li>
                                    <li>International competitions in Boston</li>
                                </ul>
                            </div>
                            <div class="sd-about-coach__subsection">
                                <h4 class="sd-about-coach__subsection-title">Coaching Philosophy</h4>
                                <p class="sd-text">Svetlana combines rigorous technical training with individual attention to each dancer's strengths and goals. Her approach builds not just skilled dancers, but confident performers who excel under pressure.</p>
                            </div>
                            <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="sd-btn">Train with Svetlana</a>
                        </div>
                        <div class="sd-about-coach__image">
                            <div class="sd-coaches__card">
                                <img src="http://stardance.com.cy/wp-content/uploads/2026/02/coach.jpg" alt="Svetlana Grincevschi — Head Coach" loading="lazy">
                                <div class="sd-coaches__overlay sd-coaches__overlay--top">
                                    <img class="sd-coaches__wave" src="http://stardance.com.cy/wp-content/uploads/2026/02/coach-top-svg-2.svg" alt="" aria-hidden="true">
                                </div>
                                <div class="sd-coaches__overlay">
                                    <img class="sd-coaches__wave" src="http://stardance.com.cy/wp-content/uploads/2026/02/coach-bottom-svg-2.svg" alt="" aria-hidden="true">
                                </div>
                                <h3 class="sd-coaches__name">Svetlana Grincevschi</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="sd-about-coach__slide">
                        <div class="sd-about-coach__bio">
                            <h3 class="sd-heading sd-about-coach__name">Svetlana Grincevschi</h3>
                            <div class="sd-about-coach__subsection">
                                <h4 class="sd-about-coach__subsection-title">Qualifications</h4>
                                <p class="sd-text">International Adjudicator (License &ldquo;A&rdquo;) with the World Dance Sport Federation, qualified to judge Latin American and European Standard dance competitions.</p>
                            </div>
                            <div class="sd-about-coach__subsection">
                                <h4 class="sd-about-coach__subsection-title">Experience</h4>
                                <p class="sd-text">Since 2007, Svetlana has coached competitive dancers at the international level. Her expertise spans both Latin American and European Ballroom programs, with a focus on developing champions from the ground up.</p>
                            </div>
                            <div class="sd-about-coach__subsection">
                                <h4 class="sd-about-coach__subsection-title">Student Achievements</h4>
                                <p class="sd-text">Svetlana's students have represented Cyprus, Israel, Italy, Greece, Estonia, Poland, Macedonia, and Ireland at international competitions. They regularly compete at finals level in prestigious events including:</p>
                                <ul class="sd-about-coach__list">
                                    <li>Blackpool Dance Festival (England)</li>
                                    <li>German Open Championships (Stuttgart)</li>
                                    <li>International competitions in Boston</li>
                                </ul>
                            </div>
                            <div class="sd-about-coach__subsection">
                                <h4 class="sd-about-coach__subsection-title">Coaching Philosophy</h4>
                                <p class="sd-text">Svetlana combines rigorous technical training with individual attention to each dancer's strengths and goals. Her approach builds not just skilled dancers, but confident performers who excel under pressure.</p>
                            </div>
                            <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="sd-btn">Train with Svetlana</a>
                        </div>
                        <div class="sd-about-coach__image">
                            <div class="sd-coaches__card">
                                <img src="http://stardance.com.cy/wp-content/uploads/2026/02/coach.jpg" alt="Svetlana Grincevschi — Head Coach" loading="lazy">
                                <div class="sd-coaches__overlay sd-coaches__overlay--top">
                                    <img class="sd-coaches__wave" src="http://stardance.com.cy/wp-content/uploads/2026/02/coach-top-svg-3.svg" alt="" aria-hidden="true">
                                </div>
                                <div class="sd-coaches__overlay">
                                    <img class="sd-coaches__wave" src="http://stardance.com.cy/wp-content/uploads/2026/02/coach-bottom-svg-3.svg" alt="" aria-hidden="true">
                                </div>
                                <h3 class="sd-coaches__name sd-coaches__name--light">Svetlana Grincevschi</h3>
                            </div>
                        </div>
                    </div>

                </div><!-- /.sd-about-coach__track -->
            </div><!-- /.sd-about-coach__slider -->

            <button class="sd-about-coach__arrow sd-about-coach__arrow--prev" aria-label="Previous coach">
                <img src="https://stardance.com.cy/wp-content/uploads/2026/03/left-arrow.svg" alt="" aria-hidden="true">
            </button>
            <button class="sd-about-coach__arrow sd-about-coach__arrow--next" aria-label="Next coach">
                <img src="https://stardance.com.cy/wp-content/uploads/2026/03/left-arrow.svg" alt="" aria-hidden="true">
            </button>

            </div><!-- /.sd-about-coach__wrapper -->

        </div>
    </section>

    <?php stardance_render_cta(array(
        'title'       => 'Ready to Join Us?',
        'description' => 'Contact us to learn more about our classes, schedule a trial session, or discuss your dance goals',
        'button_text' => 'Contact Us',
        'button_url'  => home_url('/#contact'),
        'top_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/red-and-orange-lines.svg',
        'bottom_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/red-and-orange-lines.svg',
    )); ?>

</main>

<?php get_footer(); ?>
