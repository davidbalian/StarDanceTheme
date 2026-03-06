<?php
/**
 * Homepage Template
 */
get_header();
?>

<main id="main-content">
    <?php get_template_part('template-parts/hero'); ?>
    <?php get_template_part('template-parts/classes'); ?>
    <?php get_template_part('template-parts/gallery'); ?>
    <?php get_template_part('template-parts/about'); ?>
    <?php get_template_part('template-parts/timetable'); ?>
    <?php get_template_part('template-parts/competitions'); ?>
    <?php get_template_part('template-parts/coaches'); ?>
    <?php get_template_part('template-parts/contact-form'); ?>
</main>

<?php get_footer(); ?>
