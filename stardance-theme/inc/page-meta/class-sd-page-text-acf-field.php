<?php
/**
 * ACF field group registration for per-page editable text (EN + RU tabs).
 * Location: page_template matches each page template file.
 */

if ( ! defined( 'ABSPATH' ) || ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
}

add_action( 'acf/init', 'sd_register_page_text_acf_fields' );

function sd_register_page_text_acf_fields(): void {
    $page_map = array(
        'home'     => array( 'template' => 'front-page.php',    'title' => 'Homepage Text' ),
        'about'    => array( 'template' => 'page-about.php',    'title' => 'About Page Text' ),
        'classes'  => array( 'template' => 'page-classes.php',  'title' => 'Classes Page Text' ),
        'events'   => array( 'template' => 'page-events.php',   'title' => 'Events Page Text' ),
        'schedule' => array( 'template' => 'page-schedule.php', 'title' => 'Schedule Page Text' ),
        'gallery'  => array( 'template' => 'page-gallery.php',  'title' => 'Gallery Page Text' ),
        'contact'  => array( 'template' => 'page-contact.php',  'title' => 'Contact Page Text' ),
    );

    $langs = array( 'en', 'ru' );

    foreach ( $page_map as $context => $info ) {
        $fields     = SD_Page_Meta_Schema::get_fields( $context );
        $acf_fields = array();
        $key_prefix = "sd_{$context}";

        // Tab: EN
        $acf_fields[] = array(
            'key'   => "field_{$key_prefix}_tab_en",
            'label' => 'English',
            'name'  => '',
            'type'  => 'tab',
        );

        foreach ( $fields as $field_key => $field_def ) {
            $acf_fields[] = array(
                'key'   => "field_{$key_prefix}_{$field_key}_en",
                'label' => $field_def['label'] . ' (EN)',
                'name'  => "sd_{$context}_{$field_key}_en",
                'type'  => $field_def['type'] === 'textarea' ? 'textarea' : 'text',
                'placeholder' => $field_def['default'],
            );
        }

        // Tab: RU
        $acf_fields[] = array(
            'key'   => "field_{$key_prefix}_tab_ru",
            'label' => 'Russian',
            'name'  => '',
            'type'  => 'tab',
        );

        foreach ( $fields as $field_key => $field_def ) {
            $acf_fields[] = array(
                'key'   => "field_{$key_prefix}_{$field_key}_ru",
                'label' => $field_def['label'] . ' (RU)',
                'name'  => "sd_{$context}_{$field_key}_ru",
                'type'  => $field_def['type'] === 'textarea' ? 'textarea' : 'text',
                'placeholder' => SD_Ru_Page_Defaults::get( $context, $field_key ) ?? '',
                'instructions' => 'Leave blank to use the built-in Russian default.',
            );
        }

        // Location rule — match by page template file name.
        $location = array(
            array(
                array(
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => $info['template'],
                ),
            ),
        );

        // front-page.php doesn't appear as "page_template" — match the front page directly.
        if ( $context === 'home' ) {
            $location = array(
                array(
                    array(
                        'param'    => 'page_type',
                        'operator' => '==',
                        'value'    => 'front_page',
                    ),
                ),
            );
        }

        acf_add_local_field_group( array(
            'key'      => "group_sd_{$context}_text",
            'title'    => $info['title'],
            'fields'   => $acf_fields,
            'location' => $location,
            'style'    => 'seamless',
            'position' => 'normal',
        ) );
    }
}
