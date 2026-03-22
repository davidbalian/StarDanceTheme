<?php
/**
 * Template Name: Classes
 *
 * @package stardance
 */

get_header();

$classes_query = new WP_Query(array(
    'post_type'      => 'dance_class',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => array(
        'menu_order' => 'ASC',
        'title'      => 'ASC',
    ),
    'order'          => 'ASC',
));
?>

<main class="sd-page sd-page--classes" id="main-content">

    <?php stardance_render_page_hero(array(
        'title'       => 'Find Your Perfect Dance Class',
        'description' => 'Star Dance Studio offers professional instruction tailored to your goals, from first steps to competition level. As an official member of the Cyprus Federation of Social &amp; Sport Dance, we provide certified training for all ages starting from 3 years old.',
        'modifier'    => 'classes',
    )); ?>

    <!-- Class Card Grid -->
    <section class="sd-section sd-classes-page" id="classes-grid">
        <div class="sd-container">
            <h2 class="sd-heading sd-classes-page__title fade-in fade-in-delay-0">List of Classes</h2>
            <div class="sd-classes-page__grid sd-grid sd-grid--3">
                <?php if ( $classes_query->have_posts() ) : ?>
                    <?php
                    $delay = 1;
                    while ( $classes_query->have_posts() ) :
                        $classes_query->the_post();

                        $image_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                        $description = get_the_excerpt();
                        $overlay_url = get_post_meta( get_the_ID(), '_stardance_overlay_url', true );
                        $card_modifier = 'navy';

                        if ( ! $description ) {
                            $description = wp_strip_all_tags( get_the_content() );
                        }

                        if ( false !== strpos( $overlay_url, 'gold' ) ) {
                            $card_modifier = 'gold';
                        } elseif ( false !== strpos( $overlay_url, 'turquise' ) || false !== strpos( $overlay_url, 'turquoise' ) ) {
                            $card_modifier = 'turquoise';
                        }

                        stardance_render_overlay_card(array(
                            'image_url'      => $image_url,
                            'decoration_url' => $overlay_url,
                            'title'          => get_the_title(),
                            'description'    => $description,
                            'link_url'       => get_permalink(),
                            'link_text'      => 'Learn More>>',
                            'variant'        => 'tall',
                            'modifier'       => $card_modifier,
                            'delay'          => min( $delay, 10 ),
                        ));

                        $delay++;
                    endwhile;
                    wp_reset_postdata();
                    ?>
                <?php endif; ?>

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
        'button_url'  => home_url('/#contact'),
        'top_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/flipped-red-and-orange-lines.svg',
        'bottom_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/red-and-orange-lines.svg',
    )); ?>

</main>

<?php get_footer(); ?>
