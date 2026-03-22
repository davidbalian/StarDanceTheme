<?php
/**
 * Template Name: Gallery
 *
 * @package stardance
 */

$gallery_filters = stardance_get_gallery_filter_options();

get_header();
?>

<main class="sd-page sd-page--gallery" id="main-content">

    <?php stardance_render_page_hero(array(
        'title'       => 'Gallery',
        'description' => 'Browse photos and videos from competitions, studio events, and performances. See our students in action on dance floors around the world.',
        'modifier'    => 'gallery',
    )); ?>

    <section class="sd-section sd-gallery-page" id="gallery">
        <div class="sd-container">
            <div class="sd-gallery-page__filters fade-in fade-in-delay-0">
                <div class="sd-gallery-page__filter-group" role="group" aria-label="Filter gallery by year">
                    <span class="sd-gallery-page__filter-label">Year</span>
                    <div class="sd-gallery-page__filter-tabs">
                        <button class="sd-gallery-page__tab is-active" type="button" data-filter-group="photo_year" data-filter-value="all" aria-pressed="true">All</button>
                        <?php foreach ( $gallery_filters['years'] as $year ) : ?>
                            <button class="sd-gallery-page__tab" type="button" data-filter-group="photo_year" data-filter-value="<?php echo esc_attr( $year ); ?>" aria-pressed="false"><?php echo esc_html( $year ); ?></button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="sd-gallery-page__filter-group" role="group" aria-label="Filter gallery by type">
                    <span class="sd-gallery-page__filter-label">Type</span>
                    <div class="sd-gallery-page__filter-tabs">
                        <button class="sd-gallery-page__tab is-active" type="button" data-filter-group="gallery_type" data-filter-value="all" aria-pressed="true">All</button>
                        <?php foreach ( $gallery_filters['types'] as $type_term ) : ?>
                            <button class="sd-gallery-page__tab" type="button" data-filter-group="gallery_type" data-filter-value="<?php echo esc_attr( $type_term->slug ); ?>" aria-pressed="false"><?php echo esc_html( $type_term->name ); ?></button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="sd-gallery-page__filter-group" role="group" aria-label="Filter gallery by occasion">
                    <span class="sd-gallery-page__filter-label">Occasion</span>
                    <div class="sd-gallery-page__filter-tabs">
                        <button class="sd-gallery-page__tab is-active" type="button" data-filter-group="gallery_occasion" data-filter-value="all" aria-pressed="true">All</button>
                        <?php foreach ( $gallery_filters['occasions'] as $occasion_term ) : ?>
                            <button class="sd-gallery-page__tab" type="button" data-filter-group="gallery_occasion" data-filter-value="<?php echo esc_attr( $occasion_term->slug ); ?>" aria-pressed="false"><?php echo esc_html( $occasion_term->name ); ?></button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div
                class="sd-gallery-page__grid"
                id="gallery-grid"
                data-gallery-grid
                data-photoswipe-gallery
                itemscope
                itemtype="https://schema.org/ImageGallery"
            >
                <?php echo stardance_get_gallery_grid_markup(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
