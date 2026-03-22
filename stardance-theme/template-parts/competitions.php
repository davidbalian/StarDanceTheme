<section class="sd-section sd-competitions" id="competitions">
    <div class="sd-container">
        <h2 class="sd-heading sd-competitions__title fade-in fade-in-delay-0">Competition Calendar</h2>
        <p class="sd-text sd-competitions__desc fade-in fade-in-delay-1">Browse upcoming competitions and studio events throughout the year.</p>

        <div class="sd-competitions__grid sd-grid sd-grid--4">
            <?php stardance_render_overlay_card(array(
                'image_url' => 'http://stardance.com.cy/wp-content/uploads/2026/02/competition1.png',
                'title'     => 'Lorem Ipsum Dolor',
                'meta'      => '21.01.2026',
                'link_url'  => '#',
                'link_text' => 'Learn More',
                'variant'   => 'portrait',
                'delay'     => 2,
            )); ?>

            <?php stardance_render_overlay_card(array(
                'image_url' => 'http://stardance.com.cy/wp-content/uploads/2026/02/competition2.png',
                'title'     => 'Lorem Ipsum Dolor',
                'meta'      => '21.01.2026',
                'link_url'  => '#',
                'link_text' => 'Learn More',
                'variant'   => 'portrait',
                'delay'     => 3,
            )); ?>

            <?php stardance_render_overlay_card(array(
                'image_url' => 'http://stardance.com.cy/wp-content/uploads/2026/02/competition3.png',
                'title'     => 'Lorem Ipsum Dolor',
                'meta'      => '21.01.2026',
                'link_url'  => '#',
                'link_text' => 'Learn More',
                'variant'   => 'portrait',
                'delay'     => 4,
            )); ?>

            <?php stardance_render_overlay_card(array(
                'image_url' => 'http://stardance.com.cy/wp-content/uploads/2026/02/competition4.png',
                'title'     => 'Lorem Ipsum Dolor',
                'meta'      => '21.01.2026',
                'link_url'  => '#',
                'link_text' => 'Learn More',
                'variant'   => 'portrait',
                'delay'     => 5,
            )); ?>
        </div>

        <div class="sd-section__cta fade-in fade-in-delay-6">
            <a href="<?php echo esc_url(home_url('/events/')); ?>" class="sd-btn">View All Events</a>
        </div>
    </div>
</section>
