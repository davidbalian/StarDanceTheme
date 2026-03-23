<?php
/**
 * Reusable component render functions for Star Dance Studio theme.
 *
 * @package stardance
 */

/**
 * Render an inner-page hero section.
 *
 * @param array $args {
 *     @type string $title         Required. Heading text.
 *     @type string $description   Optional. Paragraph text below heading.
 *     @type string $modifier      Optional. BEM modifier (e.g. 'classes', 'events').
 *     @type string $tag           Optional. Heading tag — 'h1' or 'h2'. Default 'h1'.
 *     @type string $thumbnail_url Optional. Image URL for a thumbnail above content.
 *     @type string $button_text   Optional. CTA button label.
 *     @type string $button_url    Optional. CTA button URL.
 * }
 */
function stardance_render_page_hero( $args = array() ) {
    $args = wp_parse_args( $args, array(
        'title'         => '',
        'description'   => '',
        'modifier'      => '',
        'tag'           => 'h1',
        'thumbnail_url' => '',
        'button_text'   => '',
        'button_url'    => '',
    ) );

    $modifier_class = $args['modifier'] ? ' sd-page-hero--' . sanitize_html_class( $args['modifier'] ) : '';
    $tag            = in_array( $args['tag'], array( 'h1', 'h2', 'h3' ), true ) ? $args['tag'] : 'h1';
    $has_content_wrap = $args['thumbnail_url'] || $args['button_text'];
    ?>
    <section class="sd-page-hero<?php echo esc_attr( $modifier_class ); ?> sd-section">
        <div class="sd-container">
            <?php if ( $args['thumbnail_url'] ) : ?>
                <div class="sd-page-hero__thumbnail">
                    <img src="<?php echo esc_url( $args['thumbnail_url'] ); ?>" alt="<?php echo esc_attr( $args['title'] ); ?>" class="sd-page-hero__bg-image">
                </div>
            <?php endif; ?>
            <?php if ( $has_content_wrap ) : ?><div class="sd-page-hero__content"><?php endif; ?>
            <<?php echo $tag; ?> class="sd-heading sd-page-hero__title fade-in fade-in-delay-0"><?php echo wp_kses_post( $args['title'] ); ?></<?php echo $tag; ?>>
            <?php if ( $args['description'] ) : ?>
                <p class="sd-text sd-page-hero__desc fade-in fade-in-delay-1"><?php echo wp_kses_post( $args['description'] ); ?></p>
            <?php endif; ?>
            <?php if ( $args['button_text'] && $args['button_url'] ) : ?>
                <a href="<?php echo esc_url( $args['button_url'] ); ?>" class="sd-btn fade-in fade-in-delay-2"><?php echo esc_html( $args['button_text'] ); ?></a>
            <?php endif; ?>
            <?php if ( $has_content_wrap ) : ?></div><?php endif; ?>
        </div>
    </section>
    <?php
}

/**
 * Render a CTA section.
 *
 * @param array $args {
 *     @type string $title       Required. Heading text.
 *     @type string $description Optional. Description text.
 *     @type string $button_text Optional. Button label. Default 'Get in Touch'.
 *     @type string $button_url  Optional. Button URL.
 *     @type string $id          Optional. Section id attribute. Default 'cta'.
 *     @type string $top_decoration_url Optional. Decorative image shown at the top edge.
 *     @type string $bottom_decoration_url Optional. Decorative image shown at the bottom edge.
 * }
 */
function stardance_render_cta( $args = array() ) {
    $args = wp_parse_args( $args, array(
        'title'       => '',
        'description' => '',
        'button_text' => 'Get in Touch',
        'button_url'  => '',
        'id'          => 'cta',
        'top_decoration_url' => '',
        'bottom_decoration_url' => '',
    ) );
    ?>
    <section class="sd-section sd-cta" id="<?php echo esc_attr( $args['id'] ); ?>">
        <?php if ( $args['top_decoration_url'] ) : ?>
            <img
                src="<?php echo esc_url( $args['top_decoration_url'] ); ?>"
                alt=""
                class="sd-cta__decoration sd-cta__decoration--top"
                aria-hidden="true"
            >
        <?php endif; ?>
        <?php if ( $args['bottom_decoration_url'] ) : ?>
            <img
                src="<?php echo esc_url( $args['bottom_decoration_url'] ); ?>"
                alt=""
                class="sd-cta__decoration sd-cta__decoration--bottom"
                aria-hidden="true"
            >
        <?php endif; ?>
        <div class="sd-container sd-cta__inner">
            <h2 class="sd-heading sd-cta__title fade-in fade-in-delay-0"><?php echo wp_kses_post( $args['title'] ); ?></h2>
            <?php if ( $args['description'] ) : ?>
                <p class="sd-text sd-cta__desc fade-in fade-in-delay-1"><?php echo wp_kses_post( $args['description'] ); ?></p>
            <?php endif; ?>
            <?php if ( $args['button_url'] ) : ?>
                <a href="<?php echo esc_url( $args['button_url'] ); ?>" class="sd-btn fade-in fade-in-delay-2"><?php echo esc_html( $args['button_text'] ); ?></a>
            <?php endif; ?>
        </div>
    </section>
    <?php
}

/**
 * Render an overlay card (background-image card with bottom-aligned content).
 *
 * @param array $args {
 *     @type string $image_url   Required. Background image URL.
 *     @type string $decoration_url Optional. Decorative overlay image shown above the background.
 *     @type string $title       Required. Card heading text.
 *     @type string $description Optional. Description text.
 *     @type string $meta        Optional. Meta text displayed above title (e.g. date).
 *     @type string $link_url    Optional. Button URL.
 *     @type string $link_text   Optional. Button label. Default 'Learn More'.
 *     @type string $variant     Optional. 'tall' (class card) or 'portrait' (competition card). Default 'tall'.
 *     @type string $modifier    Optional. Additional modifier class suffix.
 *     @type int    $delay       Optional. Fade-in delay index (0–10). Default 0.
 * }
 */
function stardance_render_overlay_card( $args = array() ) {
    $args = wp_parse_args( $args, array(
        'image_url'   => '',
        'decoration_url' => '',
        'title'       => '',
        'description' => '',
        'meta'        => '',
        'link_url'    => '',
        'link_text'   => 'Learn More',
        'variant'     => 'tall',
        'modifier'    => '',
        'delay'       => 0,
    ) );

    $variant_class = 'sd-overlay-card--' . sanitize_html_class( $args['variant'] );
    $modifier_class = $args['modifier'] ? ' sd-overlay-card--' . sanitize_html_class( $args['modifier'] ) : '';
    ?>
    <div class="sd-overlay-card <?php echo esc_attr( $variant_class . $modifier_class ); ?> fade-in fade-in-delay-<?php echo absint( $args['delay'] ); ?>"
         style="background-image: url('<?php echo esc_url( $args['image_url'] ); ?>');">
        <?php if ( $args['decoration_url'] ) : ?>
            <img
                src="<?php echo esc_url( $args['decoration_url'] ); ?>"
                alt=""
                class="sd-overlay-card__decoration"
                aria-hidden="true"
            >
        <?php endif; ?>
        <div class="sd-overlay-card__content">
            <?php if ( $args['meta'] ) : ?>
                <span class="sd-overlay-card__meta"><?php echo esc_html( $args['meta'] ); ?></span>
            <?php endif; ?>
            <h3 class="sd-overlay-card__title"><?php echo esc_html( $args['title'] ); ?></h3>
            <?php if ( $args['description'] ) : ?>
                <p class="sd-overlay-card__desc"><?php echo esc_html( $args['description'] ); ?></p>
            <?php endif; ?>
            <?php if ( $args['link_url'] ) : ?>
                <a href="<?php echo esc_url( $args['link_url'] ); ?>" class="sd-btn sd-btn--outline"><?php echo esc_html( $args['link_text'] ); ?></a>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

/**
 * Render an icon card (icon + title + text, centered layout).
 *
 * @param array $args {
 *     @type string $icon_url  Required. Icon image URL.
 *     @type string $title     Required. Card heading text.
 *     @type string $text      Required. Card body text.
 *     @type int    $icon_size Optional. Icon width and height in px. Default 48.
 *     @type int    $delay     Optional. Fade-in delay index (0–10). Default 0.
 * }
 */
function stardance_render_icon_card( $args = array() ) {
    $args = wp_parse_args( $args, array(
        'icon_url'  => '',
        'title'     => '',
        'text'      => '',
        'icon_size' => 48,
        'delay'     => 0,
    ) );
    ?>
    <div class="sd-icon-card fade-in fade-in-delay-<?php echo absint( $args['delay'] ); ?>">
        <?php if ( $args['icon_url'] ) : ?>
            <div class="sd-icon-card__icon" aria-hidden="true">
                <img src="<?php echo esc_url( $args['icon_url'] ); ?>" alt="" width="<?php echo absint( $args['icon_size'] ); ?>" height="<?php echo absint( $args['icon_size'] ); ?>">
            </div>
        <?php endif; ?>
        <h3 class="sd-icon-card__title"><?php echo wp_kses_post( $args['title'] ); ?></h3>
        <p class="sd-icon-card__text"><?php echo wp_kses_post( $args['text'] ); ?></p>
    </div>
    <?php
}

/**
 * Render an event card (image + content with date, tag, title, location).
 *
 * @param array $args {
 *     @type string $image_url  Required. Card image URL.
 *     @type string $image_alt  Required. Image alt text.
 *     @type string $date       Optional. Display date string.
 *     @type string $tag        Optional. Tag label (e.g. 'Competition', 'Workshop').
 *     @type string $title      Required. Card heading.
 *     @type string $location   Optional. Location text.
 *     @type string $link_url   Optional. Button URL.
 *     @type string $link_text  Optional. Button label. Default 'View Details'.
 *     @type array  $data_attrs Optional. Associative array of data-* attributes for filtering.
 *     @type int    $delay      Optional. Fade-in delay index (0–10). Default 0.
 * }
 */
function stardance_render_event_card( $args = array() ) {
    $args = wp_parse_args( $args, array(
        'image_url'   => '',
        'image_alt'   => '',
        'category'    => '',
        'type'        => '',
        'date'        => '',
        'location'    => '',
        'title'       => '',
        'description' => '',
        'styles'      => array(),
        'link_url'    => '',
        'link_text'   => 'Learn More',
        'data_attrs'  => array(),
        'delay'       => 0,
        'animate'     => true,
    ) );

    $animation_class = $args['animate'] ? ' fade-in fade-in-delay-' . absint( $args['delay'] ) : '';

    $data_attr_string = '';
    foreach ( $args['data_attrs'] as $key => $value ) {
        $data_attr_string .= ' data-' . esc_attr( $key ) . '="' . esc_attr( $value ) . '"';
    }
    ?>
    <article class="sd-event-card<?php echo esc_attr( $animation_class ); ?>"<?php echo $data_attr_string; ?>>
        <?php if ( $args['image_url'] ) : ?>
            <img class="sd-event-card__bg" src="<?php echo esc_url( $args['image_url'] ); ?>" alt="<?php echo esc_attr( $args['image_alt'] ); ?>" loading="lazy">
        <?php endif; ?>

        <img class="sd-event-card__lines" src="https://stardance.com.cy/wp-content/uploads/2026/03/event-card-lines.svg" alt="" aria-hidden="true">

        <?php if ( $args['category'] || $args['type'] ) : ?>
        <div class="sd-event-card__tags">
            <?php if ( $args['category'] ) : ?>
                <span class="sd-event-card__tag"><?php echo esc_html( $args['category'] ); ?></span>
            <?php endif; ?>
            <?php if ( $args['type'] ) : ?>
                <span class="sd-event-card__tag"><?php echo esc_html( $args['type'] ); ?></span>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="sd-event-card__content">
            <?php if ( $args['date'] || $args['location'] ) : ?>
            <div class="sd-event-card__meta">
                <?php if ( $args['date'] ) : ?>
                    <span class="sd-event-card__date">
                        <img src="https://stardance.com.cy/wp-content/uploads/2026/03/calendar.svg" alt="" aria-hidden="true" width="16" height="16">
                        <?php echo esc_html( $args['date'] ); ?>
                    </span>
                <?php endif; ?>
                <?php if ( $args['location'] ) : ?>
                    <span class="sd-event-card__location">
                        <img src="https://stardance.com.cy/wp-content/uploads/2026/03/location-pin.svg" alt="" aria-hidden="true" width="14" height="16">
                        <?php echo esc_html( $args['location'] ); ?>
                    </span>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <h3 class="sd-event-card__title"><?php echo esc_html( $args['title'] ); ?></h3>
            <?php if ( $args['description'] ) : ?>
                <p class="sd-event-card__desc"><?php echo esc_html( $args['description'] ); ?></p>
            <?php endif; ?>
            <?php if ( $args['link_url'] ) : ?>
                <a href="<?php echo esc_url( $args['link_url'] ); ?>" class="sd-event-card__btn"><?php echo esc_html( $args['link_text'] ); ?></a>
            <?php else : ?>
                <span class="sd-event-card__btn sd-event-card__btn--no-link"><?php echo esc_html( $args['link_text'] ); ?></span>
            <?php endif; ?>
        </div>
    </article>
    <?php
}

/**
 * Render a single event card from a CPT post.
 *
 * @param int  $post_id  Event post ID.
 * @param int  $delay    Optional fade-in delay index.
 * @param bool $animate  Whether to include fade-in animation classes.
 * @return void
 */
function stardance_render_event_item( $post_id, $delay = 0, $animate = true ) {
    $post_id = absint( $post_id );
    if ( ! $post_id ) {
        return;
    }

    $image_id    = get_post_thumbnail_id( $post_id );
    $image_large = $image_id ? wp_get_attachment_image_src( $image_id, 'large' ) : false;
    $image_url   = $image_large ? $image_large[0] : '';
    $image_alt   = $image_id ? get_post_meta( $image_id, '_wp_attachment_image_alt', true ) : '';

    $cat_terms  = get_the_terms( $post_id, 'event_category' );
    $type_terms = get_the_terms( $post_id, 'event_type' );
    $year_terms = get_the_terms( $post_id, 'event_year' );

    $category = ( ! is_wp_error( $cat_terms ) && ! empty( $cat_terms ) ) ? $cat_terms[0]->name : '';
    $type     = ( ! is_wp_error( $type_terms ) && ! empty( $type_terms ) ) ? $type_terms[0]->name : '';
    $year     = ( ! is_wp_error( $year_terms ) && ! empty( $year_terms ) ) ? $year_terms[0]->slug : '';

    $data_attrs = array(
        'event-year'     => $year,
        'event-category' => ( ! is_wp_error( $cat_terms ) && ! empty( $cat_terms ) ) ? $cat_terms[0]->slug : '',
        'event-type'     => ( ! is_wp_error( $type_terms ) && ! empty( $type_terms ) ) ? $type_terms[0]->slug : '',
    );

    stardance_render_event_card( array(
        'image_url'   => $image_url,
        'image_alt'   => $image_alt ? $image_alt : get_the_title( $post_id ),
        'category'    => $category,
        'type'        => $type,
        'date'        => get_post_meta( $post_id, 'event_date', true ),
        'location'    => get_post_meta( $post_id, 'event_location', true ),
        'title'       => get_the_title( $post_id ),
        'description' => get_the_excerpt( $post_id ),
        'link_url'    => get_post_meta( $post_id, 'event_link', true ) ?: '#',
        'data_attrs'  => $data_attrs,
        'delay'       => $delay,
        'animate'     => $animate,
    ) );
}

/**
 * Render a gallery item card for the Gallery page and AJAX responses.
 *
 * @param int  $post_id  Gallery item post ID.
 * @param int  $delay    Optional fade-in delay index.
 * @param bool $animate  Whether to include fade-in animation classes.
 * @return void
 */
function stardance_render_gallery_item( $post_id, $delay = 0, $animate = true ) {
    $post_id = absint( $post_id );

    if ( ! $post_id ) {
        return;
    }

    $image_id = get_post_thumbnail_id( $post_id );

    if ( ! $image_id ) {
        return;
    }

    $image_full = wp_get_attachment_image_src( $image_id, 'full' );
    $image_large = wp_get_attachment_image_src( $image_id, 'large' );
    $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
    $year_terms = get_the_terms( $post_id, 'gallery_year' );
    $type_terms = get_the_terms( $post_id, 'gallery_type' );
    $year_label = ( ! is_wp_error( $year_terms ) && ! empty( $year_terms ) ) ? $year_terms[0]->name : '';
    $type_label = ( ! is_wp_error( $type_terms ) && ! empty( $type_terms ) ) ? $type_terms[0]->name : '';
    $caption_bits = array_filter(
        array(
            get_the_title( $post_id ),
            $year_label,
            $type_label,
        )
    );

    if ( ! $image_full || ! $image_large ) {
        return;
    }
    $animation_class = $animate ? ' fade-in fade-in-delay-' . absint( $delay ) : '';
    ?>
    <a
        href="<?php echo esc_url( $image_full[0] ); ?>"
        class="sd-gallery-page__item<?php echo esc_attr( $animation_class ); ?>"
        itemprop="associatedMedia"
        itemscope
        itemtype="https://schema.org/ImageObject"
    >
        <img
            src="<?php echo esc_url( $image_large[0] ); ?>"
            alt="<?php echo esc_attr( $image_alt ? $image_alt : get_the_title( $post_id ) ); ?>"
            width="<?php echo esc_attr( (string) absint( $image_large[1] ) ); ?>"
            height="<?php echo esc_attr( (string) absint( $image_large[2] ) ); ?>"
            loading="lazy"
            itemprop="thumbnail"
        >
        <span class="sd-gallery-page__overlay">
            <span class="sd-gallery-page__caption"><?php echo esc_html( implode( ' — ', $caption_bits ) ); ?></span>
        </span>
    </a>
    <?php
}

/**
 * Render a single FAQ accordion item.
 *
 * @param array $args {
 *     @type string $question Required. Question text.
 *     @type string $answer   Required. Answer text (supports basic HTML).
 *     @type int    $delay    Optional. Fade-in delay index (0–10). Default 0.
 * }
 */
function stardance_render_faq_item( $args = array() ) {
    $args = wp_parse_args( $args, array(
        'question' => '',
        'answer'   => '',
        'delay'    => 0,
    ) );
    ?>
    <div class="sd-faq__item fade-in fade-in-delay-<?php echo absint( $args['delay'] ); ?>">
        <button class="sd-faq__question" aria-expanded="false">
            <?php echo wp_kses_post( $args['question'] ); ?>
            <span class="sd-faq__icon" aria-hidden="true"></span>
        </button>
        <div class="sd-faq__answer" hidden>
            <p><?php echo wp_kses_post( $args['answer'] ); ?></p>
        </div>
    </div>
    <?php
}
