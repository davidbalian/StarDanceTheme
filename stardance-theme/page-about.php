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
        'title'       => 'About Star Dance Studio',
        'description' => 'We are a professional dance school in Limassol offering Latin American and Ballroom instruction for all ages and levels. From young beginners to competitive dancers, we help each student reach their full potential on the dance floor.',
        'modifier'    => 'about',
        'bg_image_urls' => stardance_get_responsive_hero_images( $sd_page_id, 'about' ),
    )); ?>

    <!-- Training Overview -->
    <section class="sd-section sd-about-overview" id="overview">
        <div class="sd-container">
            <h2 class="sd-heading sd-about-overview__title fade-in fade-in-delay-0">Professional Training in Limassol</h2>
            <div class="sd-about-overview__layout">

                <div class="sd-about-overview__text fade-in fade-in-delay-1">
                    <p class="sd-text">
                        Star Dance Studio is an official member of the Cyprus Federation of Social &amp; Sport Dance. Our studio provides certified instruction following international standards for both Latin American and European Ballroom programs.
                    </p>
                    <p class="sd-text">
                        We welcome students from age 3 through adults, offering group classes, private lessons, and competition training. Whether you want to dance for fun, fitness, or to compete at the highest level, we have a program for you.
                    </p>
                </div>

                <div class="sd-about-overview__image fade-in fade-in-delay-1">
                    <div class="sd-about-overview__video">
                        <img src="https://stardance.com.cy/wp-content/uploads/2026/03/about-page-video-cover.webp" alt="Training at Star Dance Studio" width="600" height="450" loading="lazy">
                        <img src="https://stardance.com.cy/wp-content/uploads/2026/03/play-button.svg" alt="" class="sd-about-overview__play-btn" aria-hidden="true" width="72" height="72">
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
                <h2 class="sd-heading sd-about-legacy__title fade-in fade-in-delay-0">Formerly Olga Dance Academy</h2>
                <h3 class="sd-heading sd-about-legacy__subtitle fade-in fade-in-delay-0">Dancing Since 2007</h3>
                <p class="sd-text fade-in fade-in-delay-1">Star Dance Studio was founded in 2007 under the name Olga Dance Academy. For nearly two decades, Olga Dance Academy built a reputation as one of Limassol's most trusted dance schools — nurturing students from their very first steps all the way to championship-level performance on international stages.</p>
                <p class="sd-text fade-in fade-in-delay-2">In 2026, Olga Dance Academy was rebranded as Star Dance Studio, marking a new chapter and a broader vision for the future of dance in Cyprus. The same team, the same teaching philosophy, and the same passion that made Olga Dance Academy a Limassol institution continue to drive Star Dance Studio every day.</p>
            </div>
        </div>
    </section>

    <!-- Values Grid -->
    <section class="sd-section sd-about-values" id="values">
        <div class="sd-container">
            <h2 class="sd-heading sd-about-values__title fade-in fade-in-delay-0">What We Stand For</h2>
            <div class="sd-about-values__grid">

                <div class="sd-about-values__col">
                    <div class="sd-about-values__card fade-in fade-in-delay-1">
                        <h3 class="sd-about-values__card-title">Passion for Dance</h3>
                        <p class="sd-text">We believe dance is more than movement. It's expression, connection, and joy. We bring that energy to every class.</p>
                    </div>
                    <div class="sd-about-values__card fade-in fade-in-delay-2">
                        <h3 class="sd-about-values__card-title">Individual Growth</h3>
                        <p class="sd-text">Every student has different goals. We tailor our approach to help each dancer progress at their own pace, whether they're dancing for fun or preparing for competition.</p>
                    </div>
                </div>

                <div class="sd-about-values__trophy fade-in fade-in-delay-1" aria-hidden="true">
                    <img src="https://stardance.com.cy/wp-content/uploads/2026/03/what-we-stand-for-trophy.webp" alt="" width="220" height="300" loading="lazy">
                </div>

                <div class="sd-about-values__col">
                    <div class="sd-about-values__card fade-in fade-in-delay-1">
                        <h3 class="sd-about-values__card-title">Excellence in Training</h3>
                        <p class="sd-text">Our instruction follows international standards. We focus on proper technique, musicality, and performance quality from day one.</p>
                    </div>
                    <div class="sd-about-values__card fade-in fade-in-delay-2">
                        <h3 class="sd-about-values__card-title">Supportive Community</h3>
                        <p class="sd-text">Our studio is a welcoming space for all ages and backgrounds. We celebrate each other's progress and create lasting friendships through dance.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Champions Section -->
    <section class="sd-section sd-about-champions" id="champions">
        <div class="sd-container">
            <h2 class="sd-heading sd-about-champions__title fade-in fade-in-delay-0">We Grow Champions</h2>
            <div class="sd-about-champions__grid">

                <div class="sd-about-champions__item fade-in fade-in-delay-1">
                    <h3 class="sd-about-champions__item-title">Experience</h3>
                    <p class="sd-text">Over 18 years of professional coaching experience. Our training methods are proven at the highest levels of international competition.</p>
                </div>

                <div class="sd-about-champions__item fade-in fade-in-delay-2">
                    <h3 class="sd-about-champions__item-title">Results</h3>
                    <p class="sd-text">Our students have competed at finals level in major international competitions including Stuttgart, Blackpool, and Boston. We've trained champions from Cyprus, Israel, Italy, Greece, Estonia, Poland, Macedonia, and Ireland.</p>
                </div>

                <div class="sd-about-champions__image fade-in fade-in-delay-3">
                    <img src="https://stardance.com.cy/wp-content/uploads/2026/03/about-page-we-grow-champions-top-right.webp" alt="Star Dance Studio champions" loading="lazy">
                </div>

                <div class="sd-about-champions__image fade-in fade-in-delay-3">
                    <img src="https://stardance.com.cy/wp-content/uploads/2026/03/about-page-we-grow-champions-bottom-left.webp" alt="Star Dance Studio students competing" loading="lazy">
                </div>

                <div class="sd-about-champions__item fade-in fade-in-delay-4">
                    <h3 class="sd-about-champions__item-title">Approach</h3>
                    <p class="sd-text">We combine technical excellence with a supportive learning environment. Our coaches give personal attention to each student, focusing on both skill development and confidence building.</p>
                </div>

                <div class="sd-about-champions__item fade-in fade-in-delay-5">
                    <h3 class="sd-about-champions__item-title">Credentials</h3>
                    <p class="sd-text">Official member of the Cyprus Federation of Social &amp; Sport Dance. International-level coaching and judging qualifications.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Coach Profile: Slider -->
    <section class="sd-section sd-about-coach" id="coach">
        <div class="sd-container">
            <h2 class="sd-heading sd-about-coach__section-title fade-in fade-in-delay-0">Our Coaches</h2>

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
                                $title_parts = preg_split( '/\s+/', trim( wp_strip_all_tags( $coach_title ) ) );
                                $first_name = ! empty( $title_parts[0] ) ? $title_parts[0] : $coach_title;
                                if ( 0 === $coach_index % 3 ) {
                                    $coach_name_classes .= ' sd-coaches__name--light';
                                }
                                ?>
                                <div class="swiper-slide sd-about-coach__slide" data-coach-slug="<?php echo esc_attr( get_post_field( 'post_name' ) ); ?>">
                                    <div class="sd-about-coach__bio">
                                        <h3 class="sd-heading sd-about-coach__name"><?php the_title(); ?></h3>
                                        <?php if ( get_the_content() ) : ?>
                                            <div class="sd-about-coach__subsection">
                                                <?php echo wp_kses_post( apply_filters( 'the_content', get_the_content() ) ); ?>
                                            </div>
                                        <?php endif; ?>
                                        <a href="<?php echo esc_url( stardance_page_or_path_url( 'contact' ) ); ?>" class="sd-btn"><?php echo esc_html( sprintf( __( 'Train with %s', 'stardance' ), $first_name ) ); ?></a>
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
                                            <h3 class="<?php echo esc_attr( $coach_name_classes ); ?>"><?php the_title(); ?></h3>
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
        'title'       => 'Ready to Join Us?',
        'description' => 'Contact us to learn more about our classes, schedule a trial session, or discuss your dance goals',
        'button_text' => 'Contact Us',
        'button_url'  => stardance_page_or_path_url( 'contact' ),
        'top_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/flipped-red-and-orange-lines.svg',
        'bottom_decoration_url' => 'https://stardance.com.cy/wp-content/uploads/2026/03/red-and-orange-lines.svg',
        'bg_image_urls' => stardance_get_responsive_bottom_cta_images( $sd_page_id, 'about' ),
    )); ?>

</main>

<?php get_footer(); ?>
