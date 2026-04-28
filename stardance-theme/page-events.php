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
?>

<main class="sd-page sd-page--events" id="main-content">

    <?php stardance_render_page_hero(array(
        'title'       => 'Competition Calendar &amp; Events',
        'description' => 'Stay up to date with upcoming dance competitions, studio events, and special performances. Our students regularly compete in local and international championships throughout the year.',
        'modifier'    => 'events',
    )); ?>

    <img
        src="https://stardance.com.cy/wp-content/uploads/2026/03/long-lines.svg"
        alt=""
        class="sd-events-page__long-lines"
        aria-hidden="true"
    />

    <section class="sd-section sd-events-page" id="events-list">
        <div class="sd-container">
            <h2 class="sd-heading sd-events-page__title fade-in fade-in-delay-0">List of Events</h2>

            <div class="sd-events-page__layout">

                <!-- Sidebar Filters -->
                <aside class="sd-events-page__sidebar fade-in fade-in-delay-1" aria-label="Filter events">
                    <div class="sd-events-filter">

                        <div class="sd-events-filter__group">
                            <h3 class="sd-events-filter__label">Filter by Year</h3>
                            <ul class="sd-events-filter__options">
                                <li><button class="sd-events-filter__btn is-active" type="button" data-filter-group="event_year" data-filter-value="all" aria-pressed="true">All</button></li>
                                <?php foreach ( $event_filters['years'] as $term ) : ?>
                                    <li><button class="sd-events-filter__btn" type="button" data-filter-group="event_year" data-filter-value="<?php echo esc_attr( $term->slug ); ?>" aria-pressed="false"><?php echo esc_html( $term->name ); ?></button></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="sd-events-filter__group">
                            <h3 class="sd-events-filter__label">Filter by Category</h3>
                            <ul class="sd-events-filter__options">
                                <li><button class="sd-events-filter__btn is-active" type="button" data-filter-group="event_category" data-filter-value="all" aria-pressed="true">All</button></li>
                                <?php foreach ( $event_filters['categories'] as $term ) : ?>
                                    <li><button class="sd-events-filter__btn" type="button" data-filter-group="event_category" data-filter-value="<?php echo esc_attr( $term->slug ); ?>" aria-pressed="false"><?php echo esc_html( $term->name ); ?></button></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="sd-events-filter__group">
                            <h3 class="sd-events-filter__label">Filter by Type</h3>
                            <ul class="sd-events-filter__options">
                                <li><button class="sd-events-filter__btn is-active" type="button" data-filter-group="event_type" data-filter-value="all" aria-pressed="true">All</button></li>
                                <?php foreach ( $event_filters['types'] as $term ) : ?>
                                    <li><button class="sd-events-filter__btn" type="button" data-filter-group="event_type" data-filter-value="<?php echo esc_attr( $term->slug ); ?>" aria-pressed="false"><?php echo esc_html( $term->name ); ?></button></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="sd-events-filter__group">
                            <h3 class="sd-events-filter__label">Filter by Style</h3>
                            <ul class="sd-events-filter__options">
                                <li><button class="sd-events-filter__btn is-active" type="button" data-filter-group="event_style" data-filter-value="all" aria-pressed="true">All</button></li>
                                <?php foreach ( $event_filters['styles'] as $term ) : ?>
                                    <li><button class="sd-events-filter__btn" type="button" data-filter-group="event_style" data-filter-value="<?php echo esc_attr( $term->slug ); ?>" aria-pressed="false"><?php echo esc_html( $term->name ); ?></button></li>
                                <?php endforeach; ?>
                            </ul>
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
                            Show More
                        </button>
                    </div>
                </div>

            </div><!-- /.sd-events-page__layout -->
        </div>
    </section>

    <?php stardance_render_cta(array(
        'title'                => 'Want to Compete or Attend an Event?',
        'description'          => 'Contact us to learn more about competition preparation, registration, or upcoming studio events.',
        'button_text'          => 'Contact Us',
        'button_url'           => stardance_page_or_path_url( 'contact' ),
        'top_decoration_url'   => 'https://stardance.com.cy/wp-content/uploads/2026/03/flipped-red-and-orange-lines.svg',
        'bottom_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/red-and-orange-lines.svg',
    )); ?>

</main>

<?php get_footer(); ?>
