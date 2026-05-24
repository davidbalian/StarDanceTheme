<?php
$sd_home_page_id = get_queried_object_id();
$sd_home_hero_images = stardance_get_responsive_hero_images( $sd_home_page_id, 'home' );
$sd_home_hero_style = sprintf(
    '--sd-home-hero-bg-image-large: url(%1$s); --sd-home-hero-bg-image-tablet: url(%2$s); --sd-home-hero-bg-image-mobile: url(%3$s);',
    esc_url( $sd_home_hero_images['large'] ),
    esc_url( $sd_home_hero_images['tablet'] ),
    esc_url( $sd_home_hero_images['mobile'] )
);
?>
<section class="sd-hero" id="hero" style="<?php echo esc_attr( $sd_home_hero_style ); ?>">
    <div class="sd-hero__overlay"></div>
    <?php
    $sd_hero_pid = get_queried_object_id();
    ?>
    <div class="sd-hero__content sd-container">
        <span class="sd-hero__tagline fade-in fade-in-delay-0"><?php echo esc_html( SD_Page_Content::get_text( $sd_hero_pid, 'home', 'hero_tagline' ) ); ?></span>
        <h1 class="sd-hero__title fade-in fade-in-delay-1"><?php echo esc_html( SD_Page_Content::get_text( $sd_hero_pid, 'home', 'hero_title' ) ); ?></h1>
        <p class="sd-hero__desc fade-in fade-in-delay-2"><?php echo esc_html( SD_Page_Content::get_text( $sd_hero_pid, 'home', 'hero_description' ) ); ?></p>
        <div class="sd-hero__actions fade-in fade-in-delay-3">
            <a href="<?php echo esc_url( sd_localized_url( '/contact/' ) ); ?>" class="sd-btn"><?php echo esc_html( SD_Page_Content::get_text( $sd_hero_pid, 'home', 'hero_btn_register' ) ); ?></a>
            <a href="#timetable" class="sd-btn"><?php echo esc_html( SD_Page_Content::get_text( $sd_hero_pid, 'home', 'hero_btn_schedule' ) ); ?></a>
        </div>
    </div>
</section>
