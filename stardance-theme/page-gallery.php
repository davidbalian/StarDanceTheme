<?php
/**
 * Template Name: Gallery
 *
 * @package stardance
 */

$gallery_filters = stardance_get_gallery_filter_options();
$gallery_payload = stardance_get_gallery_query_payload(array(
    'posts_per_page' => 12,
    'paged'          => 1,
));

get_header();
$sd_page_id = get_queried_object_id();
?>

<main class="sd-page sd-page--gallery" id="main-content">

    <?php stardance_render_page_hero(array(
        'title'       => SD_Page_Content::get_text( $sd_page_id, 'gallery', 'hero_title' ),
        'description' => SD_Page_Content::get_text( $sd_page_id, 'gallery', 'hero_description' ),
        'modifier'    => 'gallery',
        'bg_image_urls' => stardance_get_responsive_hero_images( $sd_page_id, 'gallery' ),
    )); ?>

    <section class="sd-section sd-gallery-page" id="gallery">
        <div class="sd-container">
            <div class="sd-gallery-page__filters fade-in fade-in-delay-0">
                <div class="sd-gallery-page__filter-group" role="group" aria-label="<?php echo esc_attr( t('Filter gallery by year') ); ?>">
                    <span class="sd-gallery-page__filter-label"><?php te('Year'); ?></span>
                    <div class="sd-gallery-page__filter-tabs">
                        <button class="sd-gallery-page__tab is-active" type="button" data-filter-group="gallery_year" data-filter-value="all" aria-pressed="true"><?php te('All'); ?></button>
                        <?php foreach ( $gallery_filters['years'] as $year_term ) : ?>
                            <button class="sd-gallery-page__tab" type="button" data-filter-group="gallery_year" data-filter-value="<?php echo esc_attr( $year_term->slug ); ?>" aria-pressed="false"><?php echo esc_html( $year_term->name ); ?></button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="sd-gallery-page__filter-group" role="group" aria-label="<?php echo esc_attr( t('Filter gallery by type') ); ?>">
                    <span class="sd-gallery-page__filter-label"><?php te('Type'); ?></span>
                    <div class="sd-gallery-page__filter-tabs">
                        <button class="sd-gallery-page__tab is-active" type="button" data-filter-group="gallery_type" data-filter-value="all" aria-pressed="true"><?php te('All'); ?></button>
                        <?php foreach ( $gallery_filters['types'] as $type_term ) : ?>
                            <button class="sd-gallery-page__tab" type="button" data-filter-group="gallery_type" data-filter-value="<?php echo esc_attr( $type_term->slug ); ?>" aria-pressed="false"><?php echo esc_html( $type_term->name ); ?></button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div
                class="sd-gallery-page__grid"
                id="gallery-grid"
                data-gallery-grid
                itemscope
                itemtype="https://schema.org/ImageGallery"
            >
                <?php echo $gallery_payload['markup']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </div>

            <div class="sd-gallery-page__actions">
                <button
                    class="sd-btn"
                    type="button"
                    data-gallery-show-more
                    <?php echo $gallery_payload['has_more'] ? '' : 'hidden'; ?>
                >
                    <?php te('Show More'); ?>
                </button>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
