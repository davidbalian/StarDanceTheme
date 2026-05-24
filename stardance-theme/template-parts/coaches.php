<?php $sd_coaches_home_pid = get_queried_object_id(); ?>
<section class="sd-section sd-coaches" id="coaches">
    <div class="sd-container">
        <h2 class="sd-heading sd-coaches__title fade-in fade-in-delay-0"><?php echo esc_html( SD_Page_Content::get_text( $sd_coaches_home_pid, 'home', 'coaches_heading' ) ); ?></h2>

        <div class="swiper sd-coaches__viewport js-sd-home-coaches fade-in fade-in-delay-1">
            <div class="swiper-wrapper">
                <?php
                $coaches_data  = array();
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

                if ( $coaches_query->have_posts() ) :
                    while ( $coaches_query->have_posts() ) :
                        $coaches_query->the_post();
                        $sd_coach_id       = get_the_ID();
                        $sd_coach_name_ru  = SD_Page_Content::get_post_text( $sd_coach_id, 'coach_name' );
                        $coaches_data[] = array(
                            'title'     => $sd_coach_name_ru ?: get_the_title(),
                            'slug'      => get_post_field( 'post_name' ),
                            'has_thumb' => has_post_thumbnail(),
                            'thumb_id'  => get_post_thumbnail_id(),
                        );
                    endwhile;
                    wp_reset_postdata();
                endif;

                $coach_count = count( $coaches_data );
                // Render each coach twice so Swiper 12's loop has enough real DOM nodes
                // (Swiper 12 reorders slides instead of cloning; < 6 nodes causes snap on backwards swipe)
                $all_slides = array_merge( $coaches_data, $coaches_data );

                foreach ( $all_slides as $i => $coach ) :
                    $is_dup      = $i >= $coach_count;
                    $slot        = ( $i % $coach_count ) + 1;
                    $wave_index  = ( ( $slot - 1 ) % 3 ) + 1;
                    $name_class  = 'sd-coaches__name' . ( 0 === $slot % 3 ? ' sd-coaches__name--light' : '' );
                    $slide_class = 'swiper-slide sd-coaches__slide' . ( $is_dup ? ' sd-coaches__slide--dup' : '' );
                    $coach_link  = add_query_arg( 'coach', $coach['slug'], sd_localized_url( '/about/' ) ) . '#coach';
                    ?>
                    <div class="<?php echo esc_attr( $slide_class ); ?>"<?php echo $is_dup ? ' aria-hidden="true"' : ''; ?>>
                        <a class="sd-coaches__link" href="<?php echo esc_url( $coach_link ); ?>"<?php echo $is_dup ? ' tabindex="-1"' : ''; ?> aria-label="<?php echo esc_attr( sprintf( __( 'View %s profile', 'stardance' ), $coach['title'] ) ); ?>">
                        <div class="sd-coaches__card">
                            <?php if ( $coach['has_thumb'] ) : ?>
                                <?php echo wp_get_attachment_image( $coach['thumb_id'], 'large', false, array( 'alt' => $coach['title'], 'loading' => 'lazy' ) ); ?>
                            <?php else : ?>
                                <img src="http://stardance.com.cy/wp-content/uploads/2026/02/coach.jpg" alt="<?php echo esc_attr( $coach['title'] ); ?>" loading="lazy">
                            <?php endif; ?>
                            <div class="sd-coaches__overlay sd-coaches__overlay--top">
                                <img class="sd-coaches__wave" src="<?php echo esc_url( 'http://stardance.com.cy/wp-content/uploads/2026/02/coach-top-svg-' . $wave_index . '.svg' ); ?>" alt="" aria-hidden="true">
                            </div>
                            <div class="sd-coaches__overlay">
                                <img class="sd-coaches__wave" src="<?php echo esc_url( 'http://stardance.com.cy/wp-content/uploads/2026/02/coach-bottom-svg-' . $wave_index . '.svg' ); ?>" alt="" aria-hidden="true">
                            </div>
                            <h3 class="<?php echo esc_attr( $name_class ); ?>"><?php echo esc_html( $coach['title'] ); ?></h3>
                        </div>
                        </a>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
        </div>

        <div class="sd-coaches__pagination" aria-label="<?php esc_attr_e( 'Coach slides', 'stardance' ); ?>"></div>
    </div>
</section>
