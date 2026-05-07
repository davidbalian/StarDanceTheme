<section class="sd-section sd-about" id="about">
    <div class="sd-about__flourish sd-about__flourish--top">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/flourish-top.svg" alt="" aria-hidden="true" loading="lazy">
    </div>

    <div class="sd-container">
        <h2 class="sd-heading sd-about__title fade-in fade-in-delay-0">About Us</h2>

        <div class="sd-about__features">
            <?php stardance_render_icon_card(array(
                'icon_url'  => 'https://stardance.com.cy/wp-content/uploads/2026/02/004-leaderboard.svg',
                'title'     => 'Ages &amp; Levels:',
                'text'      => 'All ages welcome, starting from 3+ years old through adults. We offer classes for all levels, from absolute beginners to competitive dancers.',
                'icon_size' => 60,
                'delay'     => 1,
            )); ?>

            <?php stardance_render_icon_card(array(
                'icon_url'  => 'https://stardance.com.cy/wp-content/uploads/2026/02/002-trophy.svg',
                'title'     => 'Professional Training &amp; Winning Coaches:',
                'text'      => 'Learn from professionals who have coached winning competitive dancers. We bring a champion&rsquo;s mindset to every class.',
                'icon_size' => 60,
                'delay'     => 2,
            )); ?>

            <?php stardance_render_icon_card(array(
                'icon_url'  => 'https://stardance.com.cy/wp-content/uploads/2026/02/010-leadership.svg',
                'title'     => 'Your Goal, Your Class:',
                'text'      => 'Whether you want to compete professionally or simply want to dance for fun, fitness, or a new hobby, we have the right program for you.',
                'icon_size' => 60,
                'delay'     => 3,
            )); ?>

            <?php stardance_render_icon_card(array(
                'icon_url'  => 'https://stardance.com.cy/wp-content/uploads/2026/02/011-agreement.svg',
                'title'     => 'Official Member:',
                'text'      => 'Proud member of the Cyprus Federation of Social &amp; Sport Dance.',
                'icon_size' => 60,
                'delay'     => 4,
            )); ?>

            <?php stardance_render_icon_card(array(
                'icon_url'  => 'https://stardance.com.cy/wp-content/uploads/2026/02/005-dance.svg',
                'title'     => 'Flexible Programs:',
                'text'      => 'Choose from couples, solo, and specialized group classes to fit your needs.',
                'icon_size' => 60,
                'delay'     => 5,
            )); ?>
        </div>

        <div class="sd-section__cta fade-in fade-in-delay-6">
            <a href="<?php echo esc_url(home_url('/about/')); ?>" class="sd-btn">Learn More About Us</a>
        </div>
    </div>

    <div class="sd-about__flourish sd-about__flourish--bottom">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/flourish-bottom.svg" alt="" aria-hidden="true" loading="lazy">
    </div>
</section>
