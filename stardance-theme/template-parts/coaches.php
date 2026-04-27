<section class="sd-section sd-coaches" id="coaches">
    <div class="sd-container">
        <h2 class="sd-heading sd-coaches__title fade-in fade-in-delay-0">Meet The Coach</h2>

        <div class="sd-coaches__grid sd-grid">
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
                    $delay = min( $coach_index, 10 );
                    $wave_index = ( ( $coach_index - 1 ) % 3 ) + 1;
                    $coach_name_classes = 'sd-coaches__name';
                    if ( 0 === $coach_index % 3 ) {
                        $coach_name_classes .= ' sd-coaches__name--light';
                    }
                    ?>
                    <div class="sd-coaches__item fade-in <?php echo esc_attr( 'fade-in-delay-' . $delay ); ?>">
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
                        <?php if ( get_the_content() ) : ?>
                            <div class="sd-coaches__desc"><?php echo wp_kses_post( wpautop( get_the_content() ) ); ?></div>
                        <?php endif; ?>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>
