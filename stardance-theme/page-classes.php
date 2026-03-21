<?php
/**
 * Template Name: Classes
 *
 * @package stardance
 */

get_header();
?>

<main class="sd-page sd-page--classes" id="main-content">

    <!-- Hero -->
    <section class="sd-page-hero sd-page-hero--classes sd-section">
        <div class="sd-container">
            <h1 class="sd-heading sd-page-hero__title fade-in fade-in-delay-0">Find Your Perfect Dance Class</h1>
            <p class="sd-text sd-page-hero__desc fade-in fade-in-delay-1">
                Our Dance Classes offer a comprehensive and structured curriculum tailored for dancers of all ages and levels. Whether you're a beginner or an experienced dancer, we have the right class for you.
            </p>
        </div>
    </section>

    <!-- Class Card Grid -->
    <section class="sd-section sd-classes-page" id="classes-grid">
        <div class="sd-container">
            <h2 class="sd-heading sd-classes-page__title fade-in fade-in-delay-0">List of Classes</h2>
            <div class="sd-classes-page__grid sd-grid">

                <div class="sd-card fade-in fade-in-delay-1" style="background-image: url('http://stardance.com.cy/wp-content/uploads/2026/02/European-Ballroom.png');">
                    <div class="sd-card__content">
                        <h3 class="sd-card__title">European Ballroom</h3>
                        <p class="sd-card__desc">Slow Waltz, Tango, Viennese Waltz, Foxtrot, Quickstep.</p>
                        <a href="<?php echo esc_url(home_url('/classes/european-ballroom/')); ?>" class="sd-btn sd-btn--outline">Learn More</a>
                    </div>
                </div>

                <div class="sd-card fade-in fade-in-delay-2" style="background-image: url('http://stardance.com.cy/wp-content/uploads/2026/02/Latin-American.png');">
                    <div class="sd-card__content">
                        <h3 class="sd-card__title">Latin American</h3>
                        <p class="sd-card__desc">Samba, Cha-Cha-Cha, Rumba, Pasodoble, Jive.</p>
                        <a href="<?php echo esc_url(home_url('/classes/latin-american/')); ?>" class="sd-btn sd-btn--outline">Learn More</a>
                    </div>
                </div>

                <div class="sd-card fade-in fade-in-delay-3" style="background-image: url('http://stardance.com.cy/wp-content/uploads/2026/02/Latin-Fusion-Ladies.png');">
                    <div class="sd-card__content">
                        <h3 class="sd-card__title">Latin Fusion Ladies</h3>
                        <p class="sd-card__desc">A dynamic fusion of Latin styles designed exclusively for women.</p>
                        <a href="<?php echo esc_url(home_url('/classes/latin-fusion-ladies/')); ?>" class="sd-btn sd-btn--outline">Learn More</a>
                    </div>
                </div>

                <div class="sd-card fade-in fade-in-delay-4" style="background-image: url('http://stardance.com.cy/wp-content/uploads/2026/02/Kids-Programs.png');">
                    <div class="sd-card__content">
                        <h3 class="sd-card__title">Kids Program</h3>
                        <p class="sd-card__desc">Fun, structured dance education for children of all ages.</p>
                        <a href="<?php echo esc_url(home_url('/classes/kids-program/')); ?>" class="sd-btn sd-btn--outline">Learn More</a>
                    </div>
                </div>

                <div class="sd-card fade-in fade-in-delay-5" style="background-image: url('http://stardance.com.cy/wp-content/uploads/2026/02/Wedding-Choreography.png');">
                    <div class="sd-card__content">
                        <h3 class="sd-card__title">Wedding Choreography</h3>
                        <p class="sd-card__desc">Custom choreography for a first dance you'll never forget.</p>
                        <a href="<?php echo esc_url(home_url('/classes/wedding-choreography/')); ?>" class="sd-btn sd-btn--outline">Learn More</a>
                    </div>
                </div>

                <div class="sd-card fade-in fade-in-delay-6" style="background-image: url('http://stardance.com.cy/wp-content/uploads/2026/02/Individual-Lessons.png');">
                    <div class="sd-card__content">
                        <h3 class="sd-card__title">Individual Lessons</h3>
                        <p class="sd-card__desc">One-on-one coaching tailored to your pace and goals.</p>
                        <a href="<?php echo esc_url(home_url('/classes/individual-lessons/')); ?>" class="sd-btn sd-btn--outline">Learn More</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FAQ Accordion -->
    <section class="sd-section sd-faq" id="faq">
        <div class="sd-container">
            <h2 class="sd-heading sd-faq__title fade-in fade-in-delay-0">Frequently Asked Questions</h2>

            <div class="sd-faq__list">

                <div class="sd-faq__item fade-in fade-in-delay-1">
                    <button class="sd-faq__question" aria-expanded="false">
                        What age can my child start dancing?
                        <span class="sd-faq__icon" aria-hidden="true"></span>
                    </button>
                    <div class="sd-faq__answer" hidden>
                        <p>We welcome children from age 4. Our Kids Programs are fun and engaging, building dance skills appropriate for each age group.</p>
                    </div>
                </div>

                <div class="sd-faq__item fade-in fade-in-delay-2">
                    <button class="sd-faq__question" aria-expanded="false">
                        Do I need a partner to join?
                        <span class="sd-faq__icon" aria-hidden="true"></span>
                    </button>
                    <div class="sd-faq__answer" hidden>
                        <p>Not at all. Many of our students join solo. We rotate partners in group classes and always ensure everyone gets equal floor time.</p>
                    </div>
                </div>

                <div class="sd-faq__item fade-in fade-in-delay-3">
                    <button class="sd-faq__question" aria-expanded="false">
                        I've never danced before. Which class should I start with?
                        <span class="sd-faq__icon" aria-hidden="true"></span>
                    </button>
                    <div class="sd-faq__answer" hidden>
                        <p>We recommend starting with a beginner European Ballroom or Latin American group class. Both offer a solid technical foundation. Contact us and we'll help you choose the best starting point.</p>
                    </div>
                </div>

                <div class="sd-faq__item fade-in fade-in-delay-4">
                    <button class="sd-faq__question" aria-expanded="false">
                        Can I try a class before committing?
                        <span class="sd-faq__icon" aria-hidden="true"></span>
                    </button>
                    <div class="sd-faq__answer" hidden>
                        <p>Absolutely. We offer trial classes with no obligation. It's the best way to experience the teaching style and see if the class is the right fit for you.</p>
                    </div>
                </div>

                <div class="sd-faq__item fade-in fade-in-delay-5">
                    <button class="sd-faq__question" aria-expanded="false">
                        Do you offer classes for competitive dancers?
                        <span class="sd-faq__icon" aria-hidden="true"></span>
                    </button>
                    <div class="sd-faq__answer" hidden>
                        <p>Yes. Star Dance Studio has a strong competition programme. Students who wish to compete receive focused coaching, choreography support, and guidance on selecting appropriate events and attire.</p>
                    </div>
                </div>

                <div class="sd-faq__item fade-in fade-in-delay-6">
                    <button class="sd-faq__question" aria-expanded="false">
                        What should I wear to class?
                        <span class="sd-faq__icon" aria-hidden="true"></span>
                    </button>
                    <div class="sd-faq__answer" hidden>
                        <p>Comfortable, flexible clothing is ideal. For footwear, dance shoes are preferred but not required for your first session — any clean, flat-soled shoe will do.</p>
                    </div>
                </div>

                <div class="sd-faq__item fade-in fade-in-delay-7">
                    <button class="sd-faq__question" aria-expanded="false">
                        How do I know which level I am?
                        <span class="sd-faq__icon" aria-hidden="true"></span>
                    </button>
                    <div class="sd-faq__answer" hidden>
                        <p>Don't worry about labelling yourself. Come in for a trial class and our coaches will assess where you are and place you in the right group. Everyone is welcome regardless of prior experience.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="sd-section sd-cta" id="cta">
        <div class="sd-container sd-cta__inner">
            <h2 class="sd-heading sd-cta__title fade-in fade-in-delay-0">Ready to Start Dancing?</h2>
            <p class="sd-text sd-cta__desc fade-in fade-in-delay-1">Book a trial lesson and take the first step toward the dance floor.</p>
            <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="sd-btn fade-in fade-in-delay-2">Get in Touch</a>
        </div>
    </section>

</main>

<?php get_footer(); ?>
