<?php
/**
 * Single template for the dance_class custom post type.
 *
 * @package stardance
 */

get_header();

the_post();

$sd_class_id = get_the_ID();
$sd_has_acf  = function_exists( 'get_field' );
$sd_excerpt  = get_the_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_the_content() ), 34 );
$sd_map_embed = $sd_has_acf ? trim( (string) get_field( 'map_embed_code', $sd_class_id ) ) : '';

$sd_class_details_lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
?>

<main class="sd-page sd-page--single-class" id="main-content">

    <!-- Hero -->
    <?php stardance_render_page_hero(array(
        'title'       => get_the_title(),
        'description' => $sd_excerpt,
        'modifier'    => 'single-class',
        'buttons'     => array(
            array( 'text' => 'View Schedule', 'url' => '#class-times' ),
            array( 'text' => 'Contact Us',    'url' => home_url( '/#contact' ) ),
        ),
    )); ?>

    <!-- Detail Cards -->
    <section class="sd-section sd-class-details" id="class-details">
        <div class="sd-container">
            <h2 class="sd-heading sd-class-details__title fade-in fade-in-delay-0">Class Details</h2>
            <div class="sd-class-details__grid sd-grid sd-grid--3">

                <?php
                $card_1_pills = array();
                for ( $i = 1; $i <= 5; $i++ ) {
                    $pill = $sd_has_acf ? trim( (string) get_field( "card_1_pill_{$i}", $sd_class_id ) ) : '';
                    if ( '' !== $pill ) {
                        $card_1_pills[] = $pill;
                    }
                }
                stardance_render_class_detail_card(array(
                    'bg_url'      => 'https://stardance.com.cy/wp-content/uploads/2026/03/class-details-card-bg-navy-turqoise.webp',
                    'title'       => $sd_has_acf && get_field( 'card_1_title', $sd_class_id ) ? get_field( 'card_1_title', $sd_class_id ) : 'Individual Training',
                    'paragraphs'  => array(
                        $sd_has_acf && get_field( 'card_1_paragraph_1', $sd_class_id ) ? get_field( 'card_1_paragraph_1', $sd_class_id ) : 'Description of solo classes, technique focus, who this is for, and benefits of solo training.',
                        $sd_has_acf && get_field( 'card_1_paragraph_2', $sd_class_id ) ? get_field( 'card_1_paragraph_2', $sd_class_id ) : $sd_class_details_lorem,
                    ),
                    'pills'       => ! empty( $card_1_pills ) ? $card_1_pills : array(
                        'All skill levels',
                        'Those without a partner',
                        'Dancers wanting to strengthen individual technique',
                    ),
                    'tone'        => 'dark',
                    'pills_style' => 'gold',
                    'pills_layout'=> 'stagger',
                    'delay'       => 1,
                ));

                $card_2_pills = array();
                for ( $i = 1; $i <= 5; $i++ ) {
                    $pill = $sd_has_acf ? trim( (string) get_field( "card_2_pill_{$i}", $sd_class_id ) ) : '';
                    if ( '' !== $pill ) {
                        $card_2_pills[] = $pill;
                    }
                }
                stardance_render_class_detail_card(array(
                    'bg_url'      => 'https://stardance.com.cy/wp-content/uploads/2026/03/class-details-card-bg-turqiose-navy.webp',
                    'title'       => $sd_has_acf && get_field( 'card_2_title', $sd_class_id ) ? get_field( 'card_2_title', $sd_class_id ) : 'Partner Dancing',
                    'paragraphs'  => array(
                        $sd_has_acf && get_field( 'card_2_paragraph_1', $sd_class_id ) ? get_field( 'card_2_paragraph_1', $sd_class_id ) : 'Description of couples training, what\'s covered, skill levels available, and what students can expect.',
                        $sd_has_acf && get_field( 'card_2_paragraph_2', $sd_class_id ) ? get_field( 'card_2_paragraph_2', $sd_class_id ) : $sd_class_details_lorem,
                    ),
                    'pills'       => ! empty( $card_2_pills ) ? $card_2_pills : array(
                        'Beginners',
                        'Intermediate',
                        'Competition level',
                        'Advanced',
                    ),
                    'tone'        => 'light',
                    'pills_style' => 'gold',
                    'delay'       => 2,
                ));

                $card_3_pills = array();
                for ( $i = 1; $i <= 5; $i++ ) {
                    $pill = $sd_has_acf ? trim( (string) get_field( "card_3_pill_{$i}", $sd_class_id ) ) : '';
                    if ( '' !== $pill ) {
                        $card_3_pills[] = $pill;
                    }
                }
                stardance_render_class_detail_card(array(
                    'bg_url'      => 'https://stardance.com.cy/wp-content/uploads/2026/03/class-details-card-bg-navy-gold.webp',
                    'title'       => $sd_has_acf && get_field( 'card_3_title', $sd_class_id ) ? get_field( 'card_3_title', $sd_class_id ) : 'Performance Groups',
                    'paragraphs'  => array(
                        $sd_has_acf && get_field( 'card_3_paragraph_1', $sd_class_id ) ? get_field( 'card_3_paragraph_1', $sd_class_id ) : 'Description of show group training, performance opportunities, and what students will work towards.',
                        $sd_has_acf && get_field( 'card_3_paragraph_2', $sd_class_id ) ? get_field( 'card_3_paragraph_2', $sd_class_id ) : $sd_class_details_lorem,
                    ),
                    'pills'       => ! empty( $card_3_pills ) ? $card_3_pills : array(
                        'Dancers interested in performances',
                        'Group choreography experience',
                        'Studio showcases and events',
                    ),
                    'tone'        => 'dark',
                    'pills_style' => 'gradient',
                    'delay'       => 3,
                ));
                ?>

            </div>
        </div>
    </section>

    <!-- Class Times -->
    <section class="sd-section sd-class-times" id="class-times">
        <div class="sd-container">
            <h2 class="sd-heading sd-class-times__title fade-in fade-in-delay-0">When We Train</h2>
            <div class="sd-class-times__grid">
                <?php
                $sd_time_rows = array(
                    array( 'Monday', 'monday_time', 'monday_closed', '17:00 – 20:00', 1 ),
                    array( 'Tuesday', 'tuesday_time', 'tuesday_closed', '17:00 – 20:00', 2 ),
                    array( 'Wednesday', 'wednesday_time', 'wednesday_closed', '17:00 – 20:00', 3 ),
                    array( 'Thursday', 'thursday_time', 'thursday_closed', '17:00 – 20:00', 4 ),
                    array( 'Friday', 'friday_time', 'friday_closed', '17:00 – 20:00', 5 ),
                    array( 'Saturday', 'saturday_time', 'saturday_closed', '10:00 – 14:00', 6 ),
                    array( 'Sunday', 'sunday_time', 'sunday_closed', 'Closed', 7 ),
                );
                foreach ( $sd_time_rows as $row ) :
                    $day_label   = $row[0];
                    $time_key    = $row[1];
                    $closed_key  = $row[2];
                    $fallback    = $row[3];
                    $delay       = $row[4];
                    $acf_time    = $sd_has_acf ? trim( (string) get_field( $time_key, $sd_class_id ) ) : '';
                    $acf_closed  = $sd_has_acf ? (bool) get_field( $closed_key, $sd_class_id ) : false;
                    $is_closed   = $acf_closed || ( '' === $acf_time && 'Closed' === $fallback );
                    $time_text   = $is_closed ? 'Closed' : ( '' !== $acf_time ? $acf_time : $fallback );
                    $day_class   = $is_closed ? ' sd-class-times__day--closed' : '';
                    ?>
                    <div class="sd-class-times__day<?php echo esc_attr( $day_class ); ?> fade-in fade-in-delay-<?php echo absint( $delay ); ?>">
                        <span class="sd-class-times__day-name"><?php echo esc_html( $day_label ); ?></span>
                        <span class="sd-class-times__day-time"><?php echo esc_html( $time_text ); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <p class="sd-text sd-class-times__note">
                Times shown are indicative. <a href="<?php echo esc_url(home_url('/schedule/')); ?>">View the full timetable</a> or contact us to check current availability.
            </p>
        </div>
    </section>

    <!-- FAQ Accordion -->
    <section class="sd-section sd-faq sd-faq--single-class" id="faq">
        <div class="sd-container">
            <h2 class="sd-heading sd-faq__title fade-in fade-in-delay-0">Common Questions</h2>

            <div class="sd-faq__list">

                <?php stardance_render_faq_item(array(
                    'question' => 'What level do I need to be to join this class?',
                    'answer'   => 'This class is open to all levels. Whether you\'re a complete beginner or a more experienced dancer, we\'ll work with you at the right pace and in the right group.',
                    'delay'    => 1,
                )); ?>

                <?php stardance_render_faq_item(array(
                    'question' => 'Do I need a partner?',
                    'answer'   => 'No. Many students join solo. We rotate partners in group classes and can always find you someone to train with.',
                    'delay'    => 2,
                )); ?>

                <?php stardance_render_faq_item(array(
                    'question' => 'What age groups are these classes for?',
                    'answer'   => 'We run separate sessions for children and adults. Check the timetable or contact us for the age-specific schedule for this class.',
                    'delay'    => 3,
                )); ?>

                <?php stardance_render_faq_item(array(
                    'question' => 'How often should I attend?',
                    'answer'   => 'We recommend at least two sessions per week for steady progress. Even one session a week will produce results over time. Private lessons alongside group classes accelerate development significantly.',
                    'delay'    => 4,
                )); ?>

            </div>
        </div>
    </section>

    <!-- Dancer Gallery -->
    <section class="sd-section sd-class-gallery" id="class-gallery">
        <div class="sd-container">
            <h2 class="sd-heading sd-class-gallery__title fade-in fade-in-delay-0">See Our Dancers in Action</h2>
            <div class="sd-class-gallery__grid"
                 data-gallery-lightbox
                 itemscope
                 itemtype="https://schema.org/ImageGallery">
                <?php
                $sd_fallback_gallery = array(
                    array(
                        'url'   => 'http://stardance.com.cy/wp-content/uploads/2026/02/European-Ballroom.png',
                        'alt'   => get_the_title() . ' class',
                        'delay' => 1,
                    ),
                    array(
                        'url'   => 'http://stardance.com.cy/wp-content/uploads/2026/02/Latin-American.png',
                        'alt'   => get_the_title() . ' performance',
                        'delay' => 2,
                    ),
                    array(
                        'url'   => 'http://stardance.com.cy/wp-content/uploads/2026/02/Latin-Fusion-Ladies.png',
                        'alt'   => get_the_title() . ' showcase',
                        'delay' => 3,
                    ),
                );

                for ( $g = 1; $g <= 3; $g++ ) :
                    $acf_image = $sd_has_acf ? get_field( "gallery_image_{$g}", $sd_class_id ) : null;
                    $image_url = ( is_array( $acf_image ) && ! empty( $acf_image['url'] ) ) ? $acf_image['url'] : $sd_fallback_gallery[ $g - 1 ]['url'];
                    $thumb_url = ( is_array( $acf_image ) && ! empty( $acf_image['sizes']['large'] ) ) ? $acf_image['sizes']['large'] : $image_url;
                    $thumb_w   = ( is_array( $acf_image ) && ! empty( $acf_image['sizes']['large-width'] ) ) ? (int) $acf_image['sizes']['large-width'] : 400;
                    $thumb_h   = ( is_array( $acf_image ) && ! empty( $acf_image['sizes']['large-height'] ) ) ? (int) $acf_image['sizes']['large-height'] : 300;
                    $image_alt = ( is_array( $acf_image ) && ! empty( $acf_image['alt'] ) ) ? $acf_image['alt'] : $sd_fallback_gallery[ $g - 1 ]['alt'];
                    ?>
                    <a href="<?php echo esc_url( $image_url ); ?>"
                       class="sd-class-gallery__item fade-in fade-in-delay-<?php echo absint( $sd_fallback_gallery[ $g - 1 ]['delay'] ); ?>"
                       itemprop="associatedMedia"
                       itemscope
                       itemtype="https://schema.org/ImageObject">
                        <img src="<?php echo esc_url( $thumb_url ); ?>"
                             alt="<?php echo esc_attr( $image_alt ); ?>"
                             width="<?php echo esc_attr( (string) $thumb_w ); ?>"
                             height="<?php echo esc_attr( (string) $thumb_h ); ?>"
                             loading="lazy"
                             itemprop="thumbnail">
                    </a>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <?php stardance_render_cta(array(
        'title'       => 'Ready to Start?',
        'description' => 'Book a trial class today — no experience or commitment needed.',
        'button_text' => 'Book a Trial Class',
        'button_url'  => home_url('/#contact'),
    )); ?>

    <!-- Location / Map -->
    <section class="sd-section sd-class-location" id="location">
        <div class="sd-container">
            <h2 class="sd-heading sd-class-location__title fade-in fade-in-delay-0">Find Us</h2>
            <p class="sd-text sd-class-location__address fade-in fade-in-delay-1">
                Masterland/KIDDOM, Spyrou Kyprianou Ave 48, Limassol 4043, Cyprus
            </p>
            <div class="sd-class-location__map fade-in fade-in-delay-2">
                <?php if ( $sd_map_embed ) : ?>
                    <?php
                    echo wp_kses(
                        $sd_map_embed,
                        array(
                            'iframe' => array(
                                'src'             => true,
                                'width'           => true,
                                'height'          => true,
                                'style'           => true,
                                'allowfullscreen' => true,
                                'loading'         => true,
                                'referrerpolicy'  => true,
                                'title'           => true,
                            ),
                        )
                    );
                    ?>
                <?php else : ?>
                    <div class="sd-class-location__map-placeholder" aria-label="<?php esc_attr_e( 'Map unavailable', 'stardance' ); ?>">
                        <p><?php esc_html_e( 'Map will be added soon.', 'stardance' ); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
