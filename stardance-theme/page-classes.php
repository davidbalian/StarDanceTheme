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
        'title'       => SD_Page_Content::get_text( $sd_page_id, 'classes', 'hero_title' ),
        'description' => SD_Page_Content::get_text( $sd_page_id, 'classes', 'hero_description' ),
        'modifier'    => 'classes',
        'bg_image_urls' => stardance_get_responsive_hero_images( $sd_page_id, 'classes' ),
    )); ?>

    <!-- Class Card Grid -->
    <section class="sd-section sd-classes-page" id="classes-grid">
        <div class="sd-container">
            <h2 class="sd-heading sd-classes-page__title fade-in fade-in-delay-0"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'classes', 'list_heading' ) ); ?></h2>
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
            <h2 class="sd-heading sd-faq__title fade-in fade-in-delay-0"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'classes', 'faq_heading' ) ); ?></h2>

            <div class="sd-classes-faq__layout">
            <div class="sd-faq__list">

                <?php stardance_render_faq_item(array(
                    'question' => SD_Page_Content::get_text( $sd_page_id, 'classes', 'faq1_q' ),
                    'answer'   => SD_Page_Content::get_text( $sd_page_id, 'classes', 'faq1_a' ),
                    'delay'    => 1,
                )); ?>

                <?php stardance_render_faq_item(array(
                    'question' => SD_Page_Content::get_text( $sd_page_id, 'classes', 'faq2_q' ),
                    'answer'   => SD_Page_Content::get_text( $sd_page_id, 'classes', 'faq2_a' ),
                    'delay'    => 2,
                )); ?>

                <?php stardance_render_faq_item(array(
                    'question' => SD_Page_Content::get_text( $sd_page_id, 'classes', 'faq3_q' ),
                    'answer'   => SD_Page_Content::get_text( $sd_page_id, 'classes', 'faq3_a' ),
                    'delay'    => 3,
                )); ?>

                <?php stardance_render_faq_item(array(
                    'question' => SD_Page_Content::get_text( $sd_page_id, 'classes', 'faq4_q' ),
                    'answer'   => SD_Page_Content::get_text( $sd_page_id, 'classes', 'faq4_a' ),
                    'delay'    => 4,
                )); ?>

                <?php stardance_render_faq_item(array(
                    'question' => SD_Page_Content::get_text( $sd_page_id, 'classes', 'faq5_q' ),
                    'answer'   => SD_Page_Content::get_text( $sd_page_id, 'classes', 'faq5_a' ),
                    'delay'    => 5,
                )); ?>

                <?php stardance_render_faq_item(array(
                    'question' => SD_Page_Content::get_text( $sd_page_id, 'classes', 'faq6_q' ),
                    'answer'   => SD_Page_Content::get_text( $sd_page_id, 'classes', 'faq6_a' ),
                    'delay'    => 6,
                )); ?>

                <?php stardance_render_faq_item(array(
                    'question' => SD_Page_Content::get_text( $sd_page_id, 'classes', 'faq7_q' ),
                    'answer'   => SD_Page_Content::get_text( $sd_page_id, 'classes', 'faq7_a' ),
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
        'title'       => SD_Page_Content::get_text( $sd_page_id, 'classes', 'cta_title' ),
        'description' => SD_Page_Content::get_text( $sd_page_id, 'classes', 'cta_description' ),
        'button_text' => SD_Page_Content::get_text( $sd_page_id, 'classes', 'cta_btn' ),
        'button_url'  => sd_localized_url( '/contact/' ),
        'top_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/flipped-red-and-orange-lines.svg',
        'bottom_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/red-and-orange-lines.svg',
        'bg_image_urls' => stardance_get_responsive_bottom_cta_images( $sd_page_id, 'classes' ),
    )); ?>

</main>

<?php get_footer(); ?>
