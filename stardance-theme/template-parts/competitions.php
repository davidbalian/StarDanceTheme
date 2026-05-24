<?php $sd_comp_pid = get_queried_object_id(); ?>
<section class="sd-section sd-competitions" id="competitions">
    <div class="sd-container">
        <h2 class="sd-heading sd-competitions__title fade-in fade-in-delay-0"><?php echo esc_html( SD_Page_Content::get_text( $sd_comp_pid, 'home', 'competitions_heading' ) ); ?></h2>
        <p class="sd-text sd-competitions__desc fade-in fade-in-delay-1"><?php echo esc_html( SD_Page_Content::get_text( $sd_comp_pid, 'home', 'competitions_desc' ) ); ?></p>

        <?php $sd_comp_btn = SD_Page_Content::get_text( $sd_comp_pid, 'home', 'competitions_card_btn' ); ?>
        <div class="sd-competitions__grid sd-grid sd-grid--4">
            <?php stardance_render_overlay_card(array(
                'image_url' => 'http://stardance.com.cy/wp-content/uploads/2026/02/competition1.png',
                'title'     => 'Lorem Ipsum Dolor',
                'meta'      => '21.01.2026',
                'link_url'  => '#',
                'link_text' => $sd_comp_btn,
                'variant'   => 'portrait',
                'delay'     => 2,
            )); ?>

            <?php stardance_render_overlay_card(array(
                'image_url' => 'http://stardance.com.cy/wp-content/uploads/2026/02/competition2.png',
                'title'     => 'Lorem Ipsum Dolor',
                'meta'      => '21.01.2026',
                'link_url'  => '#',
                'link_text' => $sd_comp_btn,
                'variant'   => 'portrait',
                'delay'     => 3,
            )); ?>

            <?php stardance_render_overlay_card(array(
                'image_url' => 'http://stardance.com.cy/wp-content/uploads/2026/02/competition3.png',
                'title'     => 'Lorem Ipsum Dolor',
                'meta'      => '21.01.2026',
                'link_url'  => '#',
                'link_text' => $sd_comp_btn,
                'variant'   => 'portrait',
                'delay'     => 4,
            )); ?>

            <?php stardance_render_overlay_card(array(
                'image_url' => 'http://stardance.com.cy/wp-content/uploads/2026/02/competition4.png',
                'title'     => 'Lorem Ipsum Dolor',
                'meta'      => '21.01.2026',
                'link_url'  => '#',
                'link_text' => $sd_comp_btn,
                'variant'   => 'portrait',
                'delay'     => 5,
            )); ?>
        </div>

        <div class="sd-section__cta fade-in fade-in-delay-6">
            <a href="<?php echo esc_url( sd_localized_url( '/events/' ) ); ?>" class="sd-btn"><?php echo esc_html( SD_Page_Content::get_text( $sd_comp_pid, 'home', 'competitions_cta_btn' ) ); ?></a>
        </div>
    </div>
</section>
