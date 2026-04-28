<section class="sd-section sd-classes sd-classes-page" id="classes">
    <div class="sd-container">
        <h2 class="sd-heading sd-classes-page__title fade-in fade-in-delay-0">Our Classes</h2>

        <div class="sd-classes-page__grid sd-grid sd-grid--3">
            <?php stardance_render_overlay_card(array(
                'image_url' => 'http://stardance.com.cy/wp-content/uploads/2026/02/European-Ballroom.png',
                'title'     => 'European Ballroom',
                'description' => 'The international Ballroom dances consist of: Slow Waltz, Tango, Viennese Waltz, Foxtrot, Quickstep.',
                'variant'   => 'tall',
                'delay'     => 1,
            )); ?>

            <?php stardance_render_overlay_card(array(
                'image_url' => 'http://stardance.com.cy/wp-content/uploads/2026/02/Latin-American.png',
                'title'     => 'Latin American',
                'description' => 'The international Latin-American dances consist of: Samba, Cha-Cha-Cha, Rumba, Pasodoble, Jive.',
                'variant'   => 'tall',
                'delay'     => 2,
            )); ?>

            <?php stardance_render_overlay_card(array(
                'image_url' => 'http://stardance.com.cy/wp-content/uploads/2026/02/Latin-Fusion-Ladies.png',
                'title'     => 'Latin Fusion Ladies',
                'variant'   => 'tall',
                'delay'     => 3,
            )); ?>

            <?php stardance_render_overlay_card(array(
                'image_url' => 'http://stardance.com.cy/wp-content/uploads/2026/02/Kids-Programs.png',
                'title'     => 'Kids Programs',
                'variant'   => 'tall',
                'delay'     => 4,
            )); ?>

            <?php stardance_render_overlay_card(array(
                'image_url' => 'http://stardance.com.cy/wp-content/uploads/2026/02/Wedding-Choreography.png',
                'title'     => 'Wedding Choreography',
                'variant'   => 'tall',
                'delay'     => 5,
            )); ?>

            <?php stardance_render_overlay_card(array(
                'image_url' => 'http://stardance.com.cy/wp-content/uploads/2026/02/Individual-Lessons.png',
                'title'     => 'Individual Lessons',
                'variant'   => 'tall',
                'delay'     => 6,
            )); ?>
        </div>

        <div class="sd-section__cta fade-in fade-in-delay-7">
            <a href="<?php echo esc_url(home_url('/classes/')); ?>" class="sd-btn">View All Classes</a>
        </div>
    </div>
</section>
