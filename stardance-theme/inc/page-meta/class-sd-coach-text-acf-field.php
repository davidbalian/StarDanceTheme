<?php
/**
 * ACF field group for coach CPT — adds Russian name + bio fields.
 */

if ( ! defined( 'ABSPATH' ) || ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
}

add_action( 'acf/init', 'sd_register_coach_text_acf_fields' );

function sd_register_coach_text_acf_fields(): void {
    acf_add_local_field_group( array(
        'key'   => 'group_sd_coach_text',
        'title' => 'Coach Translations',
        'fields' => array(
            array(
                'key'          => 'field_sd_coach_name_ru',
                'label'        => 'Name (RU)',
                'name'         => 'coach_name_ru',
                'type'         => 'text',
                'instructions' => 'Russian transliteration or full name. Leave blank to use English name.',
            ),
            array(
                'key'          => 'field_sd_coach_bio_ru',
                'label'        => 'Bio (RU)',
                'name'         => 'coach_bio_ru',
                'type'         => 'wysiwyg',
                'toolbar'      => 'basic',
                'media_upload' => 0,
                'instructions' => 'Russian biography. Leave blank to show English bio.',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'coach',
                ),
            ),
        ),
        'style'    => 'seamless',
        'position' => 'normal',
    ) );
}
