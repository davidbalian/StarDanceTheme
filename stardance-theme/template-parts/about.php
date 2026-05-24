<section class="sd-section sd-about" id="about">
    <div class="sd-about__flourish sd-about__flourish--top">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/flourish-top.svg" alt="" aria-hidden="true" loading="lazy">
    </div>

    <?php $sd_about_home_pid = get_queried_object_id(); ?>
    <div class="sd-container">
        <h2 class="sd-heading sd-about__title fade-in fade-in-delay-0"><?php echo esc_html( SD_Page_Content::get_text( $sd_about_home_pid, 'home', 'about_heading' ) ); ?></h2>

        <div class="sd-about__features">
            <?php stardance_render_icon_card(array(
                'icon_url'  => 'https://stardance.com.cy/wp-content/uploads/2026/02/004-leaderboard.svg',
                'title'     => SD_Page_Content::get_text( $sd_about_home_pid, 'home', 'about_card1_title' ),
                'text'      => SD_Page_Content::get_text( $sd_about_home_pid, 'home', 'about_card1_text' ),
                'icon_size' => 60,
                'delay'     => 1,
            )); ?>

            <?php stardance_render_icon_card(array(
                'icon_url'  => 'https://stardance.com.cy/wp-content/uploads/2026/02/002-trophy.svg',
                'title'     => SD_Page_Content::get_text( $sd_about_home_pid, 'home', 'about_card2_title' ),
                'text'      => SD_Page_Content::get_text( $sd_about_home_pid, 'home', 'about_card2_text' ),
                'icon_size' => 60,
                'delay'     => 2,
            )); ?>

            <?php stardance_render_icon_card(array(
                'icon_url'  => 'https://stardance.com.cy/wp-content/uploads/2026/02/010-leadership.svg',
                'title'     => SD_Page_Content::get_text( $sd_about_home_pid, 'home', 'about_card3_title' ),
                'text'      => SD_Page_Content::get_text( $sd_about_home_pid, 'home', 'about_card3_text' ),
                'icon_size' => 60,
                'delay'     => 3,
            )); ?>

            <?php stardance_render_icon_card(array(
                'icon_url'  => 'https://stardance.com.cy/wp-content/uploads/2026/02/011-agreement.svg',
                'title'     => SD_Page_Content::get_text( $sd_about_home_pid, 'home', 'about_card4_title' ),
                'text'      => SD_Page_Content::get_text( $sd_about_home_pid, 'home', 'about_card4_text' ),
                'icon_size' => 60,
                'delay'     => 4,
            )); ?>

            <?php stardance_render_icon_card(array(
                'icon_url'  => 'https://stardance.com.cy/wp-content/uploads/2026/02/005-dance.svg',
                'title'     => SD_Page_Content::get_text( $sd_about_home_pid, 'home', 'about_card5_title' ),
                'text'      => SD_Page_Content::get_text( $sd_about_home_pid, 'home', 'about_card5_text' ),
                'icon_size' => 60,
                'delay'     => 5,
            )); ?>
        </div>

        <div class="sd-section__cta fade-in fade-in-delay-6">
            <a href="<?php echo esc_url( sd_localized_url( '/about/' ) ); ?>" class="sd-btn"><?php echo esc_html( SD_Page_Content::get_text( $sd_about_home_pid, 'home', 'about_cta_btn' ) ); ?></a>
        </div>
    </div>

    <div class="sd-about__flourish sd-about__flourish--bottom">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/flourish-bottom.svg" alt="" aria-hidden="true" loading="lazy">
    </div>
</section>
