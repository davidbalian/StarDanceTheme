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

/** Default map when no ACF embed: KIDDOM, Limassol. */
$sd_map_embed_allowed = array(
    'iframe' => array(
        'src'             => true,
        'width'           => true,
        'height'          => true,
        'style'           => true,
        'allowfullscreen' => true,
        'loading'         => true,
        'referrerpolicy'  => true,
        'title'           => true,
        'class'           => true,
    ),
);

$sd_map_html = $sd_map_embed;
if ( '' === $sd_map_html ) {
    $sd_map_src  = 'https://maps.google.com/maps?q=' . rawurlencode( 'KIDDOM, Limassol, Cyprus' ) . '&z=16&output=embed';
    $sd_map_html = sprintf(
        '<iframe class="sd-class-location__iframe" title="%s" src="%s" width="600" height="450" style="border:0;width:100%%;min-height:420px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
        esc_attr__( 'Map: KIDDOM, Limassol', 'stardance' ),
        esc_url( $sd_map_src )
    );
}

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
            <div class="sd-schedule-page__grid sd-class-times__schedule-grid">
                <?php
                $sd_time_rows = array(
                    array( 'Mon', 'monday_time', 'monday_closed', '17:00 - 20:00', 1 ),
                    array( 'Tue', 'tuesday_time', 'tuesday_closed', '17:00 - 20:00', 2 ),
                    array( 'Wed', 'wednesday_time', 'wednesday_closed', '17:00 - 20:00', 3 ),
                    array( 'Thu', 'thursday_time', 'thursday_closed', '17:00 - 20:00', 4 ),
                    array( 'Fri', 'friday_time', 'friday_closed', '17:00 - 20:00', 5 ),
                    array( 'Sat', 'saturday_time', 'saturday_closed', '10:00 - 14:00', 6 ),
                    array( 'Sun', 'sunday_time', 'sunday_closed', 'Closed', 7 ),
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
                    $day_class   = $is_closed ? ' sd-schedule-page__day--closed' : '';
                    ?>
                    <article class="sd-schedule-page__day sd-class-times__schedule-day<?php echo esc_attr( $day_class ); ?> fade-in fade-in-delay-<?php echo absint( $delay ); ?>">
                        <h3 class="sd-schedule-page__day-title"><?php echo esc_html( $day_label ); ?></h3>
                        <?php if ( $is_closed ) : ?>
                            <p class="sd-schedule-page__closed"><?php esc_html_e( 'Closed', 'stardance' ); ?></p>
                        <?php else : ?>
                            <div class="sd-schedule-page__sessions">
                                <div class="sd-schedule-page__session">
                                    <span class="sd-schedule-page__time"><?php echo esc_html( $time_text ); ?></span>
                                    <span class="sd-schedule-page__class-name"><?php echo esc_html( get_the_title() ); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </article>
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
            <h2 class="sd-heading sd-faq__title fade-in fade-in-delay-0">FAQs</h2>
            <div class="sd-classes-faq__layout sd-classes-faq__layout--single">
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
                <div class="sd-classes-faq__image-wrap sd-classes-faq__image-wrap--single fade-in fade-in-delay-2" aria-hidden="true">
                    <img src="https://stardance.com.cy/wp-content/uploads/2026/03/single-class-faq.webp" alt="" class="sd-classes-faq__image sd-classes-faq__image--single" loading="lazy">
                    <img src="https://stardance.com.cy/wp-content/uploads/2026/03/large-overlay.svg" alt="" class="sd-classes-faq__image-decoration sd-classes-faq__image-decoration--single" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <!-- Dancers in action (video poster) -->
    <section class="sd-section sd-class-video" id="class-gallery">
        <div class="sd-container">
            <h2 class="sd-heading sd-class-video__title fade-in fade-in-delay-0">See Our Dancers in Action</h2>
            <div class="sd-class-video__frame fade-in fade-in-delay-1">
                <?php
                $acf_feature_image = $sd_has_acf ? get_field( 'gallery_image_1', $sd_class_id ) : null;
                $video_poster_url    = ( is_array( $acf_feature_image ) && ! empty( $acf_feature_image['url'] ) )
                    ? $acf_feature_image['url']
                    : 'https://stardance.com.cy/wp-content/uploads/2026/03/single-class-video.webp';
                $video_poster_alt = ( is_array( $acf_feature_image ) && ! empty( $acf_feature_image['alt'] ) )
                    ? $acf_feature_image['alt']
                    : get_the_title() . ' — ' . __( 'dancers in action', 'stardance' );
                ?>
                <img
                    src="<?php echo esc_url( $video_poster_url ); ?>"
                    alt="<?php echo esc_attr( $video_poster_alt ); ?>"
                    class="sd-class-video__poster"
                    loading="lazy"
                    width="1200"
                    height="675">
                <img
                    src="https://stardance.com.cy/wp-content/uploads/2026/03/large-overlay.svg"
                    alt=""
                    class="sd-class-video__overlay"
                    aria-hidden="true"
                    loading="lazy">
                <button type="button" class="sd-class-video__play" aria-label="<?php echo esc_attr__( 'Play video', 'stardance' ); ?>">
                    <img
                        src="https://stardance.com.cy/wp-content/uploads/2026/03/play-button-blue.svg"
                        alt=""
                        width="80"
                        height="80"
                        decoding="async">
                </button>
            </div>
        </div>
    </section>

    <?php stardance_render_cta(array(
        'title'       => 'Ready to Start?',
        'description' => 'Contact us to book a trial class or ask any questions about this program.',
        'button_text' => 'Contact Us',
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
                <?php echo wp_kses( $sd_map_html, $sd_map_embed_allowed ); ?>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
