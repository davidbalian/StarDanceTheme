<?php
/**
 * Template Name: Contact
 *
 * @package stardance
 */

get_header();
?>

<main class="sd-page sd-page--contact" id="main-content">

    <?php
    stardance_render_page_hero(
        array(
            'title'       => 'Get In Touch',
            'description' => 'Have questions about our classes or want to book a trial session? We\'d love to hear from you.',
            'modifier'    => 'contact',
        )
    );
    ?>

</main>

<?php
get_footer();
