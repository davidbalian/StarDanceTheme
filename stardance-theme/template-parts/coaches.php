<section class="sd-section sd-coaches" id="coaches">
    <div class="sd-container">
        <h2 class="sd-heading sd-coaches__title fade-in fade-in-delay-0">Meet The Coaches</h2>

        <div class="sd-coaches__viewport fade-in fade-in-delay-1" data-sd-coach-carousel aria-live="polite">
            <div class="sd-coaches__track">
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

                if ( $coaches_query->have_posts() ) :
                    $coach_index = 0;
                    while ( $coaches_query->have_posts() ) :
                        $coaches_query->the_post();
                        $coach_index++;
                        $wave_index = ( ( $coach_index - 1 ) % 3 ) + 1;
                        $coach_name_classes = 'sd-coaches__name';
                        if ( 0 === $coach_index % 3 ) {
                            $coach_name_classes .= ' sd-coaches__name--light';
                        }
                        $coach_slug = get_post_field( 'post_name' );
                        $coach_link = add_query_arg( 'coach', $coach_slug, stardance_page_or_path_url( 'about' ) ) . '#coach';
                        ?>
                        <div class="sd-coaches__slide">
                            <a class="sd-coaches__link" href="<?php echo esc_url( $coach_link ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'View %s profile', 'stardance' ), get_the_title() ) ); ?>">
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
                            </a>
                        </div>
                        <?php
                    endwhile;
                    $total_coaches = $coach_index;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>

        <?php if ( isset( $total_coaches ) && $total_coaches > 1 ) : ?>
        <ol class="sd-coaches__dots" role="tablist" aria-label="Coach slides">
            <?php for ( $i = 0; $i < $total_coaches; $i++ ) : ?>
            <li role="presentation">
                <button
                    class="sd-coaches__dot<?php echo 0 === $i ? ' sd-coaches__dot--active' : ''; ?>"
                    role="tab"
                    aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>"
                    aria-label="<?php echo esc_attr( sprintf( __( 'Slide %d of %d', 'stardance' ), $i + 1, $total_coaches ) ); ?>"
                    data-dot-index="<?php echo esc_attr( $i ); ?>"
                ></button>
            </li>
            <?php endfor; ?>
        </ol>
        <?php endif; ?>
    </div>
</section>
