<?php
/**
 * Page-meta bootstrap — requires schema, resolver, and ACF field-group classes.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once get_template_directory() . '/inc/translations/ru/class-sd-ru-page-defaults.php';
require_once get_template_directory() . '/inc/page-meta/class-sd-page-meta-schema.php';
require_once get_template_directory() . '/inc/page-meta/class-sd-page-content.php';

// ACF field groups — only load when ACF is active.
add_action( 'acf/init', function (): void {
    require_once get_template_directory() . '/inc/page-meta/class-sd-page-text-acf-field.php';
    require_once get_template_directory() . '/inc/page-meta/class-sd-coach-text-acf-field.php';
}, 5 );
