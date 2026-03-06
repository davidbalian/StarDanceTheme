<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="sd-header" id="site-header">
    <div class="sd-header__inner sd-container">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="sd-header__logo" aria-label="<?php bloginfo('name'); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Logo.svg" alt="<?php bloginfo('name'); ?>" width="50" height="56">
        </a>

        <nav class="sd-header__nav" id="site-nav" aria-label="<?php esc_attr_e('Primary Navigation', 'stardance'); ?>">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'sd-header__menu',
                'fallback_cb'    => 'stardance_fallback_menu',
            ));
            ?>
        </nav>

        <button class="sd-header__toggle" id="menu-toggle" aria-label="<?php esc_attr_e('Toggle Menu', 'stardance'); ?>" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>
<?php
// Fallback menu if no menu is assigned
function stardance_fallback_menu() {
    ?>
    <ul class="sd-header__menu">
        <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
        <li><a href="#classes">Classes</a></li>
        <li><a href="#competitions">Events</a></li>
        <li><a href="#timetable">Schedule</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#gallery">Gallery</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>
    <?php
}
?>
