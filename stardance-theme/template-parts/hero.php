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
    <div class="sd-hero__content sd-container">
        <span class="sd-hero__tagline fade-in fade-in-delay-0">We grow Champions!</span>
        <h1 class="sd-hero__title fade-in fade-in-delay-1">Latin American &amp; European Ballroom Dance Classes in Limassol</h1>
        <p class="sd-hero__desc fade-in fade-in-delay-2">Official member of the Cyprus Federation of Social &amp; Sport Dance, providing professional instruction for all ages and skill levels.</p>
        <div class="sd-hero__actions fade-in fade-in-delay-3">
            <a href="<?php echo esc_url( stardance_page_or_path_url( 'contact' ) ); ?>" class="sd-btn">Register Now</a>
            <a href="#timetable" class="sd-btn">View Timetable</a>
        </div>
    </div>
</section>
