<?php
/**
 * Template Name: Events
 *
 * @package stardance
 */

$event_filters  = stardance_get_events_filter_options();
$event_payload  = stardance_get_events_query_payload(array(
    'posts_per_page' => 12,
    'paged'          => 1,
));

get_header();
$sd_page_id = get_queried_object_id();
?>

<main class="sd-page sd-page--events" id="main-content">

    <?php stardance_render_page_hero(array(
        'title'       => SD_Page_Content::get_text( $sd_page_id, 'events', 'hero_title' ),
        'description' => SD_Page_Content::get_text( $sd_page_id, 'events', 'hero_description' ),
        'modifier'    => 'events',
        'bg_image_urls' => stardance_get_responsive_hero_images( $sd_page_id, 'events' ),
    )); ?>

    <section class="sd-section sd-events-page" id="events-list">
        <div class="sd-container">
            <h2 class="sd-heading sd-events-page__title fade-in fade-in-delay-0"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'events', 'list_heading' ) ); ?></h2>

            <div class="sd-events-page__layout">

                <!-- Sidebar Filters -->
                <aside class="sd-events-page__sidebar fade-in fade-in-delay-1" aria-label="<?php echo esc_attr( t('Filters') ); ?>">
                    <div class="sd-events-filter-mobile">
                        <button class="sd-events-filter-mobile__toggle" type="button" aria-expanded="false" aria-controls="events-filter-panel">
                            <span class="sd-events-filter-mobile__title"><?php te('Filters'); ?></span>
                            <span class="sd-events-filter-mobile__icon" aria-hidden="true"></span>
                        </button>
                        <div class="sd-events-filter-mobile__panel" id="events-filter-panel" hidden>
                            <div class="sd-events-filter">

                                <div class="sd-events-filter__group">
                                    <h3 class="sd-events-filter__label"><?php te('Filter by Year'); ?></h3>
                                    <ul class="sd-events-filter__options">
                                        <li><button class="sd-events-filter__btn is-active" type="button" data-filter-group="event_year" data-filter-value="all" aria-pressed="true"><?php te('All'); ?></button></li>
                                        <?php foreach ( $event_filters['years'] as $term ) : ?>
                                            <li><button class="sd-events-filter__btn" type="button" data-filter-group="event_year" data-filter-value="<?php echo esc_attr( $term->slug ); ?>" aria-pressed="false"><?php echo esc_html( $term->name ); ?></button></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>

                                <div class="sd-events-filter__group">
                                    <h3 class="sd-events-filter__label"><?php te('Filter by Category'); ?></h3>
                                    <ul class="sd-events-filter__options">
                                        <li><button class="sd-events-filter__btn is-active" type="button" data-filter-group="event_category" data-filter-value="all" aria-pressed="true"><?php te('All'); ?></button></li>
                                        <?php foreach ( $event_filters['categories'] as $term ) : ?>
                                            <li><button class="sd-events-filter__btn" type="button" data-filter-group="event_category" data-filter-value="<?php echo esc_attr( $term->slug ); ?>" aria-pressed="false"><?php echo esc_html( $term->name ); ?></button></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>

                                <div class="sd-events-filter__group">
                                    <h3 class="sd-events-filter__label"><?php te('Filter by Type'); ?></h3>
                                    <ul class="sd-events-filter__options">
                                        <li><button class="sd-events-filter__btn is-active" type="button" data-filter-group="event_type" data-filter-value="all" aria-pressed="true"><?php te('All'); ?></button></li>
                                        <?php foreach ( $event_filters['types'] as $term ) : ?>
                                            <li><button class="sd-events-filter__btn" type="button" data-filter-group="event_type" data-filter-value="<?php echo esc_attr( $term->slug ); ?>" aria-pressed="false"><?php echo esc_html( $term->name ); ?></button></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>

                                <div class="sd-events-filter__group">
                                    <h3 class="sd-events-filter__label"><?php te('Filter by Style'); ?></h3>
                                    <ul class="sd-events-filter__options">
                                        <li><button class="sd-events-filter__btn is-active" type="button" data-filter-group="event_style" data-filter-value="all" aria-pressed="true"><?php te('All'); ?></button></li>
                                        <?php foreach ( $event_filters['styles'] as $term ) : ?>
                                            <li><button class="sd-events-filter__btn" type="button" data-filter-group="event_style" data-filter-value="<?php echo esc_attr( $term->slug ); ?>" aria-pressed="false"><?php echo esc_html( $term->name ); ?></button></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Event Card Grid -->
                <div class="sd-events-page__grid-wrap">
                    <div
                        class="sd-events-page__grid"
                        id="events-grid"
                        data-events-grid
                    >
                        <?php echo $event_payload['markup']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </div>

                    <div class="sd-events-page__actions">
                        <button
                            class="sd-btn"
                            type="button"
                            data-events-show-more
                            <?php echo $event_payload['has_more'] ? '' : 'hidden'; ?>
                        >
                            <?php te('Show More'); ?>
                        </button>
                    </div>
                </div>

            </div><!-- /.sd-events-page__layout -->
        </div>
    </section>

    <?php stardance_render_cta(array(
        'title'                => SD_Page_Content::get_text( $sd_page_id, 'events', 'cta_title' ),
        'description'          => SD_Page_Content::get_text( $sd_page_id, 'events', 'cta_description' ),
        'button_text'          => SD_Page_Content::get_text( $sd_page_id, 'events', 'cta_btn' ),
        'button_url'           => sd_localized_url( '/contact/' ),
        'top_decoration_url'   => 'https://stardance.com.cy/wp-content/uploads/2026/03/flipped-red-and-orange-lines.svg',
        'bottom_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/red-and-orange-lines.svg',
        'bg_image_urls' => stardance_get_responsive_bottom_cta_images( $sd_page_id, 'events' ),
    )); ?>

</main>

<?php get_footer(); ?>
