<?php
/**
 * Template Name: About
 *
 * @package stardance
 */

get_header();
$sd_page_id = get_queried_object_id();
?>

<main class="sd-page sd-page--about" id="main-content">

    <?php stardance_render_page_hero(array(
        'title'       => SD_Page_Content::get_text( $sd_page_id, 'about', 'hero_title' ),
        'description' => SD_Page_Content::get_text( $sd_page_id, 'about', 'hero_description' ),
        'modifier'    => 'about',
        'bg_image_urls' => stardance_get_responsive_hero_images( $sd_page_id, 'about' ),
    )); ?>

    <!-- Training Overview -->
    <section class="sd-section sd-about-overview" id="overview">
        <div class="sd-container">
            <h2 class="sd-heading sd-about-overview__title fade-in fade-in-delay-0"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'overview_heading' ) ); ?></h2>
            <div class="sd-about-overview__layout">

                <div class="sd-about-overview__text fade-in fade-in-delay-1">
                    <p class="sd-text">
                        <?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'overview_p1' ) ); ?>
                    </p>
                    <p class="sd-text">
                        <?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'overview_p2' ) ); ?>
                    </p>
                </div>

                <div class="sd-about-overview__image fade-in fade-in-delay-1">
                    <div class="sd-about-overview__video">
                        <video
                            src="https://stardance.com.cy/wp-content/uploads/2026/06/Star-Dance-Cyprus-website-video-compressed.mp4"
                            poster="https://stardance.com.cy/wp-content/uploads/2026/03/about-page-video-cover.webp"
                            controls
                            playsinline
                            width="600"
                            height="450">
                        </video>
                        <img src="https://stardance.com.cy/wp-content/uploads/2026/02/coach-bottom-svg-1.svg" alt="" class="sd-about-overview__corner-svg" aria-hidden="true">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Legacy / Rebrand -->
    <section class="sd-section sd-about-legacy" id="legacy">
        <div class="sd-container">
            <div class="sd-about-legacy__content">
                <h2 class="sd-heading sd-about-legacy__title fade-in fade-in-delay-0"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'legacy_heading' ) ); ?></h2>
                <h3 class="sd-heading sd-about-legacy__subtitle fade-in fade-in-delay-0"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'legacy_subtitle' ) ); ?></h3>
                <p class="sd-text fade-in fade-in-delay-1"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'legacy_p1' ) ); ?></p>
                <p class="sd-text fade-in fade-in-delay-2"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'legacy_p2' ) ); ?></p>
            </div>
        </div>
    </section>

    <!-- Values Grid -->
    <section class="sd-section sd-about-values" id="values">
        <div class="sd-container">
            <h2 class="sd-heading sd-about-values__title fade-in fade-in-delay-0"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'values_heading' ) ); ?></h2>
            <div class="sd-about-values__grid">

                <div class="sd-about-values__col">
                    <div class="sd-about-values__card fade-in fade-in-delay-1">
                        <h3 class="sd-about-values__card-title"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'values_v1_title' ) ); ?></h3>
                        <p class="sd-text"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'values_v1_text' ) ); ?></p>
                    </div>
                    <div class="sd-about-values__card fade-in fade-in-delay-2">
                        <h3 class="sd-about-values__card-title"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'values_v2_title' ) ); ?></h3>
                        <p class="sd-text"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'values_v2_text' ) ); ?></p>
                    </div>
                </div>

                <div class="sd-about-values__trophy fade-in fade-in-delay-1" aria-hidden="true">
                    <img src="https://stardance.com.cy/wp-content/uploads/2026/03/what-we-stand-for-trophy.webp" alt="" width="220" height="300" loading="lazy">
                </div>

                <div class="sd-about-values__col">
                    <div class="sd-about-values__card fade-in fade-in-delay-1">
                        <h3 class="sd-about-values__card-title"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'values_v3_title' ) ); ?></h3>
                        <p class="sd-text"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'values_v3_text' ) ); ?></p>
                    </div>
                    <div class="sd-about-values__card fade-in fade-in-delay-2">
                        <h3 class="sd-about-values__card-title"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'values_v4_title' ) ); ?></h3>
                        <p class="sd-text"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'values_v4_text' ) ); ?></p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Champions Section -->
    <section class="sd-section sd-about-champions" id="champions">
        <div class="sd-container">
            <h2 class="sd-heading sd-about-champions__title fade-in fade-in-delay-0"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'champ_heading' ) ); ?></h2>
            <div class="sd-about-champions__grid">

                <div class="sd-about-champions__item fade-in fade-in-delay-1">
                    <h3 class="sd-about-champions__item-title"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'champ_exp_title' ) ); ?></h3>
                    <p class="sd-text"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'champ_exp_text' ) ); ?></p>
                </div>

                <div class="sd-about-champions__item fade-in fade-in-delay-2">
                    <h3 class="sd-about-champions__item-title"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'champ_res_title' ) ); ?></h3>
                    <p class="sd-text"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'champ_res_text' ) ); ?></p>
                </div>

                <div class="sd-about-champions__image fade-in fade-in-delay-3">
                    <img src="https://stardance.com.cy/wp-content/uploads/2026/03/about-page-we-grow-champions-top-right.webp" alt="Star Dance Cyprus champions" loading="lazy">
                </div>

                <div class="sd-about-champions__image fade-in fade-in-delay-3">
                    <img src="https://stardance.com.cy/wp-content/uploads/2026/03/about-page-we-grow-champions-bottom-left.webp" alt="Star Dance Cyprus students competing" loading="lazy">
                </div>

                <div class="sd-about-champions__item fade-in fade-in-delay-4">
                    <h3 class="sd-about-champions__item-title"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'champ_app_title' ) ); ?></h3>
                    <p class="sd-text"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'champ_app_text' ) ); ?></p>
                </div>

                <div class="sd-about-champions__item fade-in fade-in-delay-5">
                    <h3 class="sd-about-champions__item-title"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'champ_cred_title' ) ); ?></h3>
                    <p class="sd-text"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'champ_cred_text' ) ); ?></p>
                </div>

            </div>
        </div>
    </section>

    <!-- Coach Profile: Slider -->
    <section class="sd-section sd-about-coach" id="coach">
        <div class="sd-container">
            <h2 class="sd-heading sd-about-coach__section-title fade-in fade-in-delay-0"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'about', 'coaches_heading' ) ); ?></h2>

            <?php
            $coaches_query = new WP_Query(
                array(
                    'post_type'      => 'coach',
                    'post_status'    => 'publish',
                    'posts_per_page' => -1,
                    'orderby'        => array(
                        'menu_order' => 'ASC',
                        'date'       => 'ASC',
                    ),
                )
            );
            ?>

            <?php if ( $coaches_query->have_posts() ) : ?>
                <div class="sd-about-coach__wrapper">
                    <div class="swiper sd-about-coach__slider js-sd-about-coaches" aria-live="polite">
                        <div class="swiper-wrapper">
                            <?php
                            $coach_index = 0;
                            while ( $coaches_query->have_posts() ) :
                                $coaches_query->the_post();
                                $coach_index++;
                                $wave_index = ( ( $coach_index - 1 ) % 3 ) + 1;
                                $coach_name_classes = 'sd-coaches__name';
                                $coach_title = get_the_title();
                                if ( 0 === $coach_index % 3 ) {
                                    $coach_name_classes .= ' sd-coaches__name--light';
                                }
                                ?>
                                <?php
                                $sd_about_coach_id   = get_the_ID();
                                $sd_coach_name_disp  = SD_Page_Content::get_post_text( $sd_about_coach_id, 'coach_name' ) ?: get_the_title();
                                $sd_coach_bio_ru     = SD_Page_Content::get_post_text( $sd_about_coach_id, 'coach_bio' );
                                ?>
                                <div class="swiper-slide sd-about-coach__slide" data-coach-slug="<?php echo esc_attr( get_post_field( 'post_name' ) ); ?>">
                                    <div class="sd-about-coach__bio">
                                        <h3 class="sd-heading sd-about-coach__name"><?php echo esc_html( $sd_coach_name_disp ); ?></h3>
                                        <?php if ( $sd_coach_bio_ru ) : ?>
                                            <div class="sd-about-coach__subsection">
                                                <?php echo wp_kses_post( wpautop( $sd_coach_bio_ru ) ); ?>
                                            </div>
                                        <?php elseif ( get_the_content() ) : ?>
                                            <div class="sd-about-coach__subsection">
                                                <?php echo wp_kses_post( apply_filters( 'the_content', get_the_content() ) ); ?>
                                            </div>
                                        <?php endif; ?>
                                        <a href="<?php echo esc_url( sd_localized_url( '/contact/' ) ); ?>" class="sd-btn"><?php
                                            $sd_train_first = preg_split( '/\s+/', trim( $sd_coach_name_disp ) );
                                            echo esc_html( sprintf( t('Train with %s'), $sd_train_first[0] ?? $sd_coach_name_disp ) );
                                        ?></a>
                                    </div>
                                    <div class="sd-about-coach__image">
                                        <div class="sd-coaches__card">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <?php the_post_thumbnail( 'large', array( 'alt' => get_the_title(), 'loading' => 'lazy' ) ); ?>
                                            <?php else : ?>
                                                <img src="http://stardance.com.cy/wp-content/uploads/2026/02/coach.jpg" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy">
                                            <?php endif; ?>
                                            <div class="sd-coaches__overlay sd-coaches__overlay--top">
                                                <img class="sd-coaches__wave" src="<?php echo esc_url( 'http://stardance.com.cy/wp-content/uploads/2026/02/coach-top-svg-' . $wave_index . '.svg' ); ?>" alt="" aria-hidden="true">
                                            </div>
                                            <div class="sd-coaches__overlay">
                                                <img class="sd-coaches__wave" src="<?php echo esc_url( 'http://stardance.com.cy/wp-content/uploads/2026/02/coach-bottom-svg-' . $wave_index . '.svg' ); ?>" alt="" aria-hidden="true">
                                            </div>
                                            <h3 class="<?php echo esc_attr( $coach_name_classes ); ?>"><?php echo esc_html( $sd_coach_name_disp ); ?></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div><!-- /.swiper-wrapper -->
                    </div><!-- /.sd-about-coach__slider -->

                    <div class="sd-about-coach__nav" role="group" aria-label="<?php esc_attr_e( 'Coach profile slider', 'stardance' ); ?>">
                        <button type="button" class="sd-about-coach__arrow sd-about-coach__arrow--prev" aria-label="<?php esc_attr_e( 'Previous coach', 'stardance' ); ?>">
                            <img src="https://stardance.com.cy/wp-content/uploads/2026/03/left-arrow.svg" alt="" aria-hidden="true" width="40" height="40">
                        </button>
                        <button type="button" class="sd-about-coach__arrow sd-about-coach__arrow--next" aria-label="<?php esc_attr_e( 'Next coach', 'stardance' ); ?>">
                            <img src="https://stardance.com.cy/wp-content/uploads/2026/03/left-arrow.svg" alt="" aria-hidden="true" width="40" height="40">
                        </button>
                    </div>
                </div><!-- /.sd-about-coach__wrapper -->
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
    </section>

    <?php stardance_render_cta(array(
        'title'       => SD_Page_Content::get_text( $sd_page_id, 'about', 'cta_title' ),
        'description' => SD_Page_Content::get_text( $sd_page_id, 'about', 'cta_description' ),
        'button_text' => SD_Page_Content::get_text( $sd_page_id, 'about', 'cta_btn' ),
        'button_url'  => sd_localized_url( '/contact/' ),
        'top_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/flipped-red-and-orange-lines.svg',
        'bottom_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/red-and-orange-lines.svg',
        'bg_image_urls' => stardance_get_responsive_bottom_cta_images( $sd_page_id, 'about' ),
    )); ?>

</main>

<?php get_footer(); ?>
