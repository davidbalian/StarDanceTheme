<?php
/**
 * Template Name: Classes
 *
 * @package stardance
 */

get_header();
?>

<main class="sd-page sd-page--classes" id="main-content">

    <?php stardance_render_page_hero(array(
        'title'       => 'Find Your Perfect Dance Class',
        'description' => 'Our Dance Classes offer a comprehensive and structured curriculum tailored for dancers of all ages and levels. Whether you&rsquo;re a beginner or an experienced dancer, we have the right class for you.',
        'modifier'    => 'classes',
    )); ?>

    <!-- Class Card Grid -->
    <section class="sd-section sd-classes-page" id="classes-grid">
        <div class="sd-container">
            <h2 class="sd-heading sd-classes-page__title fade-in fade-in-delay-0">List of Classes</h2>
            <div class="sd-classes-page__grid sd-grid sd-grid--3">

                <?php stardance_render_overlay_card(array(
                    'image_url'   => 'http://stardance.com.cy/wp-content/uploads/2026/02/European-Ballroom.png',
                    'title'       => 'European Ballroom',
                    'description' => 'Slow Waltz, Tango, Viennese Waltz, Foxtrot, Quickstep.',
                    'link_url'    => home_url('/classes/european-ballroom/'),
                    'link_text'   => 'Learn More',
                    'variant'     => 'tall',
                    'delay'       => 1,
                )); ?>

                <?php stardance_render_overlay_card(array(
                    'image_url'   => 'http://stardance.com.cy/wp-content/uploads/2026/02/Latin-American.png',
                    'title'       => 'Latin American',
                    'description' => 'Samba, Cha-Cha-Cha, Rumba, Pasodoble, Jive.',
                    'link_url'    => home_url('/classes/latin-american/'),
                    'link_text'   => 'Learn More',
                    'variant'     => 'tall',
                    'delay'       => 2,
                )); ?>

                <?php stardance_render_overlay_card(array(
                    'image_url'   => 'http://stardance.com.cy/wp-content/uploads/2026/02/Latin-Fusion-Ladies.png',
                    'title'       => 'Latin Fusion Ladies',
                    'description' => 'A dynamic fusion of Latin styles designed exclusively for women.',
                    'link_url'    => home_url('/classes/latin-fusion-ladies/'),
                    'link_text'   => 'Learn More',
                    'variant'     => 'tall',
                    'delay'       => 3,
                )); ?>

                <?php stardance_render_overlay_card(array(
                    'image_url'   => 'http://stardance.com.cy/wp-content/uploads/2026/02/Kids-Programs.png',
                    'title'       => 'Kids Program',
                    'description' => 'Fun, structured dance education for children of all ages.',
                    'link_url'    => home_url('/classes/kids-program/'),
                    'link_text'   => 'Learn More',
                    'variant'     => 'tall',
                    'delay'       => 4,
                )); ?>

                <?php stardance_render_overlay_card(array(
                    'image_url'   => 'http://stardance.com.cy/wp-content/uploads/2026/02/Wedding-Choreography.png',
                    'title'       => 'Wedding Choreography',
                    'description' => 'Custom choreography for a first dance you&rsquo;ll never forget.',
                    'link_url'    => home_url('/classes/wedding-choreography/'),
                    'link_text'   => 'Learn More',
                    'variant'     => 'tall',
                    'delay'       => 5,
                )); ?>

                <?php stardance_render_overlay_card(array(
                    'image_url'   => 'http://stardance.com.cy/wp-content/uploads/2026/02/Individual-Lessons.png',
                    'title'       => 'Individual Lessons',
                    'description' => 'One-on-one coaching tailored to your pace and goals.',
                    'link_url'    => home_url('/classes/individual-lessons/'),
                    'link_text'   => 'Learn More',
                    'variant'     => 'tall',
                    'delay'       => 6,
                )); ?>

            </div>
        </div>
    </section>

    <!-- FAQ Accordion -->
    <section class="sd-section sd-faq" id="faq">
        <div class="sd-container">
            <h2 class="sd-heading sd-faq__title fade-in fade-in-delay-0">Frequently Asked Questions</h2>

            <div class="sd-faq__list">

                <?php stardance_render_faq_item(array(
                    'question' => 'What age can my child start dancing?',
                    'answer'   => 'We welcome children from age 4. Our Kids Programs are fun and engaging, building dance skills appropriate for each age group.',
                    'delay'    => 1,
                )); ?>

                <?php stardance_render_faq_item(array(
                    'question' => 'Do I need a partner to join?',
                    'answer'   => 'Not at all. Many of our students join solo. We rotate partners in group classes and always ensure everyone gets equal floor time.',
                    'delay'    => 2,
                )); ?>

                <?php stardance_render_faq_item(array(
                    'question' => 'I\'ve never danced before. Which class should I start with?',
                    'answer'   => 'We recommend starting with a beginner European Ballroom or Latin American group class. Both offer a solid technical foundation. Contact us and we\'ll help you choose the best starting point.',
                    'delay'    => 3,
                )); ?>

                <?php stardance_render_faq_item(array(
                    'question' => 'Can I try a class before committing?',
                    'answer'   => 'Absolutely. We offer trial classes with no obligation. It\'s the best way to experience the teaching style and see if the class is the right fit for you.',
                    'delay'    => 4,
                )); ?>

                <?php stardance_render_faq_item(array(
                    'question' => 'Do you offer classes for competitive dancers?',
                    'answer'   => 'Yes. Star Dance Studio has a strong competition programme. Students who wish to compete receive focused coaching, choreography support, and guidance on selecting appropriate events and attire.',
                    'delay'    => 5,
                )); ?>

                <?php stardance_render_faq_item(array(
                    'question' => 'What should I wear to class?',
                    'answer'   => 'Comfortable, flexible clothing is ideal. For footwear, dance shoes are preferred but not required for your first session — any clean, flat-soled shoe will do.',
                    'delay'    => 6,
                )); ?>

                <?php stardance_render_faq_item(array(
                    'question' => 'How do I know which level I am?',
                    'answer'   => 'Don\'t worry about labelling yourself. Come in for a trial class and our coaches will assess where you are and place you in the right group. Everyone is welcome regardless of prior experience.',
                    'delay'    => 7,
                )); ?>

            </div>
        </div>
    </section>

    <?php stardance_render_cta(array(
        'title'       => 'Ready to Start Dancing?',
        'description' => 'Book a trial lesson and take the first step toward the dance floor.',
        'button_text' => 'Get in Touch',
        'button_url'  => home_url('/#contact'),
    )); ?>

</main>

<?php get_footer(); ?>
