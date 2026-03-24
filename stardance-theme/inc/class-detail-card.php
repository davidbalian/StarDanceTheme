<?php
/**
 * Class detail card render function (single class template).
 *
 * @package stardance
 */

/**
 * Render a class detail card (background image + title, copy, suitable-for pills).
 *
 * @param array $args {
 *     @type string $bg_url         Required. Decorative background image URL.
 *     @type string $title          Required. Card heading.
 *     @type array  $paragraphs     Required. Plain-text body paragraphs.
 *     @type array  $pills          Required. List of pill label strings.
 *     @type string $tone           Optional. 'dark' | 'light'. Default 'dark'.
 *     @type string $pills_style    Optional. 'gold' | 'gradient'. Default 'gold'.
 *     @type string $pills_layout   Optional. '' | 'stagger' for uneven pill rows.
 *     @type int    $delay          Optional. Fade-in delay index (0–10). Default 0.
 * }
 */
function stardance_render_class_detail_card( $args = array() ) {
    $args = wp_parse_args(
        $args,
        array(
            'bg_url'       => '',
            'title'        => '',
            'paragraphs'   => array(),
            'pills'        => array(),
            'tone'         => 'dark',
            'pills_style'  => 'gold',
            'pills_layout' => '',
            'delay'        => 0,
        )
    );

    $tone        = in_array( $args['tone'], array( 'dark', 'light' ), true ) ? $args['tone'] : 'dark';
    $pills_style = 'gradient' === $args['pills_style'] ? 'gradient' : 'gold';
    $layout_mod  = 'stagger' === $args['pills_layout'] ? ' sd-class-detail-card--pills-stagger' : '';
    $card_classes = 'sd-class-detail-card sd-class-detail-card--tone-' . $tone
        . ' sd-class-detail-card--pills-' . $pills_style
        . $layout_mod
        . ' fade-in fade-in-delay-' . absint( $args['delay'] );
    ?>
    <article class="<?php echo esc_attr( $card_classes ); ?>">
        <?php if ( $args['bg_url'] ) : ?>
            <img class="sd-class-detail-card__media"
                 src="<?php echo esc_url( $args['bg_url'] ); ?>"
                 alt=""
                 loading="lazy"
                 decoding="async">
        <?php endif; ?>
        <div class="sd-class-detail-card__inner">
            <h3 class="sd-class-detail-card__title"><?php echo esc_html( $args['title'] ); ?></h3>
            <div class="sd-class-detail-card__text">
                <?php foreach ( (array) $args['paragraphs'] as $para ) : ?>
                    <?php if ( '' !== trim( (string) $para ) ) : ?>
                        <p><?php echo esc_html( $para ); ?></p>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <p class="sd-class-detail-card__suitable"><?php esc_html_e( 'Suitable for:', 'stardance' ); ?></p>
            <?php if ( ! empty( $args['pills'] ) ) : ?>
                <ul class="sd-class-detail-card__pills" role="list">
                    <?php foreach ( (array) $args['pills'] as $pill ) : ?>
                        <li class="sd-class-detail-card__pills-item">
                            <span class="sd-class-detail-card__pill"><?php echo esc_html( $pill ); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </article>
    <?php
}
