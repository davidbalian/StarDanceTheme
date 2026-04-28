<?php
/**
 * Template Name: Classes
 *
 * @package stardance
 */

get_header();
$sd_page_id = get_queried_object_id();
?>

<main class="sd-page sd-page--classes" id="main-content">

    <?php stardance_render_page_hero(array(
        'title'       => 'Find Your Perfect Dance Class',
        'description' => 'Star Dance Studio offers professional instruction tailored to your goals, from first steps to competition level. As an official member of the Cyprus Federation of Social &amp; Sport Dance, we provide certified training for all ages starting from 3 years old.',
        'modifier'    => 'classes',
        'bg_image_urls' => stardance_get_responsive_hero_images( $sd_page_id, 'classes' ),
    )); ?>

    <!-- Class Card Grid -->
    <section class="sd-section sd-classes-page" id="classes-grid">
        <div class="sd-container">
            <h2 class="sd-heading sd-classes-page__title fade-in fade-in-delay-0">List of Classes</h2>
            <div class="sd-classes-page__grid sd-grid sd-grid--3">
                <?php
                stardance_render_dance_class_overlay_cards(
                    array(
                        'show_description' => true,
                    )
                );
                ?>
            </div>
        </div>
    </section>

    <!-- FAQ Accordion -->
    <section class="sd-section sd-faq" id="faq">
        <div class="sd-container">
            <h2 class="sd-heading sd-faq__title fade-in fade-in-delay-0">FAQs</h2>

            <div class="sd-classes-faq__layout">
            <div class="sd-faq__list">

                <?php stardance_render_faq_item(array(
                    'question' => 'What age can my child start dancing?',
                    'answer'   => 'We welcome dancers from age 3 and up. Our kids programs are fun and engaging, building dance skills appropriate for each age group.',
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

            <div class="sd-classes-faq__image-wrap fade-in fade-in-delay-2" aria-hidden="true">
                <img src="https://stardance.com.cy/wp-content/uploads/2026/02/coach.jpg" alt="" class="sd-classes-faq__image" loading="lazy">
                <img src="https://stardance.com.cy/wp-content/uploads/2026/03/card-overlay-tall-gold.svg" alt="" class="sd-classes-faq__image-decoration" loading="lazy">
            </div>
            </div>
        </div>
    </section>

    <?php stardance_render_cta(array(
        'title'       => 'Ready to Start Dancing?',
        'description' => 'Have questions about which class is right for you? Get in touch and we&rsquo;ll help you find your perfect fit.',
        'button_text' => 'Contact Us',
        'button_url'  => stardance_page_or_path_url( 'contact' ),
        'top_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/flipped-red-and-orange-lines.svg',
        'bottom_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/red-and-orange-lines.svg',
        'bg_image_urls' => stardance_get_responsive_bottom_cta_images( $sd_page_id, 'classes' ),
    )); ?>

</main>

<?php get_footer(); ?>
