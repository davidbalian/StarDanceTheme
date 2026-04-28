<?php
/**
 * ACF responsive image field registration and resolvers.
 *
 * @package stardance
 */

/**
 * Register responsive hero/CTA image fields for pages and singles.
 *
 * @return void
 */
function stardance_register_responsive_image_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    $responsive_fields = array(
        array(
            'key'          => 'field_stardance_hero_image_large',
            'label'        => __( 'Hero Image (Large screens)', 'stardance' ),
            'name'         => 'stardance_hero_image_large',
            'type'         => 'image',
            'return_format'=> 'array',
            'preview_size' => 'medium',
            'library'      => 'all',
            'mime_types'   => 'jpg,jpeg,png,webp,avif,svg',
        ),
        array(
            'key'          => 'field_stardance_hero_image_tablet',
            'label'        => __( 'Hero Image (Laptop/Tablet)', 'stardance' ),
            'name'         => 'stardance_hero_image_tablet',
            'type'         => 'image',
            'return_format'=> 'array',
            'preview_size' => 'medium',
            'library'      => 'all',
            'mime_types'   => 'jpg,jpeg,png,webp,avif,svg',
        ),
        array(
            'key'          => 'field_stardance_hero_image_mobile',
            'label'        => __( 'Hero Image (Mobile)', 'stardance' ),
            'name'         => 'stardance_hero_image_mobile',
            'type'         => 'image',
            'return_format'=> 'array',
            'preview_size' => 'medium',
            'library'      => 'all',
            'mime_types'   => 'jpg,jpeg,png,webp,avif,svg',
        ),
        array(
            'key'          => 'field_stardance_bottom_cta_image_large',
            'label'        => __( 'Bottom CTA Image (Large screens)', 'stardance' ),
            'name'         => 'stardance_bottom_cta_image_large',
            'type'         => 'image',
            'return_format'=> 'array',
            'preview_size' => 'medium',
            'library'      => 'all',
            'mime_types'   => 'jpg,jpeg,png,webp,avif,svg',
        ),
        array(
            'key'          => 'field_stardance_bottom_cta_image_tablet',
            'label'        => __( 'Bottom CTA Image (Laptop/Tablet)', 'stardance' ),
            'name'         => 'stardance_bottom_cta_image_tablet',
            'type'         => 'image',
            'return_format'=> 'array',
            'preview_size' => 'medium',
            'library'      => 'all',
            'mime_types'   => 'jpg,jpeg,png,webp,avif,svg',
        ),
        array(
            'key'          => 'field_stardance_bottom_cta_image_mobile',
            'label'        => __( 'Bottom CTA Image (Mobile)', 'stardance' ),
            'name'         => 'stardance_bottom_cta_image_mobile',
            'type'         => 'image',
            'return_format'=> 'array',
            'preview_size' => 'medium',
            'library'      => 'all',
            'mime_types'   => 'jpg,jpeg,png,webp,avif,svg',
        ),
    );

    acf_add_local_field_group(
        array(
            'key' => 'group_stardance_responsive_images_pages',
            'title' => __( 'Responsive Hero / Bottom CTA Images', 'stardance' ),
            'fields' => array_merge(
                array(
                    array(
                        'key'   => 'field_stardance_responsive_images_pages_note',
                        'label' => __( 'Usage', 'stardance' ),
                        'name'  => '',
                        'type'  => 'message',
                        'message' => __( 'Provide large/tablet/mobile image variants. Bottom CTA fields are used only where a bottom CTA exists (including home contact section).', 'stardance' ),
                        'new_lines' => 'wpautop',
                        'esc_html' => 0,
                    ),
                ),
                $responsive_fields
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'page_type',
                        'operator' => '==',
                        'value' => 'front_page',
                    ),
                ),
                array(
                    array(
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'page-about.php',
                    ),
                ),
                array(
                    array(
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'page-classes.php',
                    ),
                ),
                array(
                    array(
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'page-events.php',
                    ),
                ),
                array(
                    array(
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'page-schedule.php',
                    ),
                ),
                array(
                    array(
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'page-contact.php',
                    ),
                ),
                array(
                    array(
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'page-gallery.php',
                    ),
                ),
            ),
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'active' => true,
        )
    );

    acf_add_local_field_group(
        array(
            'key' => 'group_stardance_responsive_images_sd_event',
            'title' => __( 'Responsive Hero / Bottom CTA Images', 'stardance' ),
            'fields' => array_merge(
                array(
                    array(
                        'key'   => 'field_stardance_responsive_images_event_note',
                        'label' => __( 'Usage', 'stardance' ),
                        'name'  => '',
                        'type'  => 'message',
                        'message' => __( 'Provide large/tablet/mobile image variants for this event hero and bottom CTA backgrounds.', 'stardance' ),
                        'new_lines' => 'wpautop',
                        'esc_html' => 0,
                    ),
                ),
                $responsive_fields
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'sd_event',
                    ),
                ),
            ),
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'active' => true,
        )
    );

    acf_add_local_field_group(
        array(
            'key' => 'group_stardance_responsive_images_dance_class',
            'title' => __( 'Responsive Hero / Bottom CTA Images', 'stardance' ),
            'fields' => array_merge(
                array(
                    array(
                        'key'   => 'field_stardance_responsive_images_class_note',
                        'label' => __( 'Usage', 'stardance' ),
                        'name'  => '',
                        'type'  => 'message',
                        'message' => __( 'Provide large/tablet/mobile image variants for this class hero and bottom CTA backgrounds.', 'stardance' ),
                        'new_lines' => 'wpautop',
                        'esc_html' => 0,
                    ),
                ),
                $responsive_fields
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'dance_class',
                    ),
                ),
            ),
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'active' => true,
        )
    );
}
add_action( 'acf/init', 'stardance_register_responsive_image_fields' );

/**
 * Resolve image field value to URL.
 *
 * @param mixed $field_value ACF field value.
 * @return string
 */
function stardance_acf_image_value_to_url( $field_value ) {
    if ( is_array( $field_value ) && ! empty( $field_value['url'] ) ) {
        return (string) $field_value['url'];
    }

    if ( is_numeric( $field_value ) ) {
        $attachment_url = wp_get_attachment_image_url( (int) $field_value, 'full' );
        return $attachment_url ? (string) $attachment_url : '';
    }

    if ( is_string( $field_value ) ) {
        return trim( $field_value );
    }

    return '';
}

/**
 * Get responsive image URLs from ACF with fallback values.
 *
 * @param int    $post_id   Target post/page ID.
 * @param string $field_key Field key prefix (hero|bottom_cta).
 * @param array  $fallbacks Optional fallback URLs keyed by size.
 * @return array{large:string,tablet:string,mobile:string}
 */
function stardance_get_responsive_acf_images( $post_id, $field_key, $fallbacks = array() ) {
    $fallbacks = wp_parse_args(
        $fallbacks,
        array(
            'large' => '',
            'tablet' => '',
            'mobile' => '',
        )
    );

    $images = array(
        'large' => '',
        'tablet' => '',
        'mobile' => '',
    );

    if ( function_exists( 'get_field' ) && $post_id > 0 ) {
        $images['large']  = stardance_acf_image_value_to_url( get_field( 'stardance_' . $field_key . '_image_large', $post_id ) );
        $images['tablet'] = stardance_acf_image_value_to_url( get_field( 'stardance_' . $field_key . '_image_tablet', $post_id ) );
        $images['mobile'] = stardance_acf_image_value_to_url( get_field( 'stardance_' . $field_key . '_image_mobile', $post_id ) );
    }

    $images['tablet'] = $images['tablet'] ? $images['tablet'] : $fallbacks['tablet'];
    $images['large']  = $images['large'] ? $images['large'] : $fallbacks['large'];
    $images['mobile'] = $images['mobile'] ? $images['mobile'] : $fallbacks['mobile'];

    if ( ! $images['tablet'] ) {
        $images['tablet'] = $images['large'] ? $images['large'] : $images['mobile'];
    }
    if ( ! $images['large'] ) {
        $images['large'] = $images['tablet'] ? $images['tablet'] : $images['mobile'];
    }
    if ( ! $images['mobile'] ) {
        $images['mobile'] = $images['tablet'] ? $images['tablet'] : $images['large'];
    }

    return $images;
}

/**
 * Default responsive images for known slots.
 *
 * @param string $slot Slot identifier.
 * @return array{large:string,tablet:string,mobile:string}
 */
function stardance_get_default_responsive_images( $slot ) {
    $slots = array(
        'hero_about' => array(
            'large'  => 'https://stardance.com.cy/wp-content/uploads/2026/03/about-page-hero-bg.webp',
            'tablet' => 'https://stardance.com.cy/wp-content/uploads/2026/03/about-page-hero-bg.webp',
            'mobile' => 'https://stardance.com.cy/wp-content/uploads/2026/03/about-page-hero-bg.webp',
        ),
        'hero_classes' => array(
            'large'  => 'https://stardance.com.cy/wp-content/uploads/2026/03/classes-page-hero-bg.webp',
            'tablet' => 'https://stardance.com.cy/wp-content/uploads/2026/03/classes-page-hero-bg.webp',
            'mobile' => 'https://stardance.com.cy/wp-content/uploads/2026/03/classes-page-hero-bg.webp',
        ),
        'hero_events' => array(
            'large'  => 'https://stardance.com.cy/wp-content/uploads/2026/03/events-page-her-bg.webp',
            'tablet' => 'https://stardance.com.cy/wp-content/uploads/2026/03/events-page-her-bg.webp',
            'mobile' => 'https://stardance.com.cy/wp-content/uploads/2026/03/events-page-her-bg.webp',
        ),
        'hero_schedule' => array(
            'large'  => 'https://stardance.com.cy/wp-content/uploads/2026/03/european-ballroom-class.webp',
            'tablet' => 'https://stardance.com.cy/wp-content/uploads/2026/03/european-ballroom-class.webp',
            'mobile' => 'https://stardance.com.cy/wp-content/uploads/2026/03/european-ballroom-class.webp',
        ),
        'hero_contact' => array(
            'large'  => 'https://stardance.com.cy/wp-content/uploads/2026/04/contact-page-hero-bg-e1777296288202.webp',
            'tablet' => 'https://stardance.com.cy/wp-content/uploads/2026/04/contact-page-hero-bg-e1777296288202.webp',
            'mobile' => 'https://stardance.com.cy/wp-content/uploads/2026/04/contact-page-hero-bg-e1777296288202.webp',
        ),
        'hero_gallery' => array(
            'large'  => 'https://stardance.com.cy/wp-content/uploads/2026/03/gallery-page-hero-bg.webp',
            'tablet' => 'https://stardance.com.cy/wp-content/uploads/2026/03/gallery-page-hero-bg.webp',
            'mobile' => 'https://stardance.com.cy/wp-content/uploads/2026/03/gallery-page-hero-bg.webp',
        ),
        'hero_single_class' => array(
            'large'  => 'https://stardance.com.cy/wp-content/uploads/2026/03/individual-class-template-hero-bg.webp',
            'tablet' => 'https://stardance.com.cy/wp-content/uploads/2026/03/individual-class-template-hero-bg.webp',
            'mobile' => 'https://stardance.com.cy/wp-content/uploads/2026/03/individual-class-template-hero-bg.webp',
        ),
        'hero_single_event' => array(
            'large'  => 'https://stardance.com.cy/wp-content/uploads/2026/03/classes-page-hero-bg.webp',
            'tablet' => 'https://stardance.com.cy/wp-content/uploads/2026/03/classes-page-hero-bg.webp',
            'mobile' => 'https://stardance.com.cy/wp-content/uploads/2026/03/classes-page-hero-bg.webp',
        ),
        'hero_home' => array(
            'large'  => 'http://stardance.com.cy/wp-content/uploads/2026/02/Mask-group.jpg',
            'tablet' => 'http://stardance.com.cy/wp-content/uploads/2026/02/Mask-group.jpg',
            'mobile' => 'http://stardance.com.cy/wp-content/uploads/2026/02/Mask-group.jpg',
        ),
        'cta_about' => array(
            'large'  => 'https://stardance.com.cy/wp-content/uploads/2026/04/about-page-cta-bg-large.jpg',
            'tablet' => 'https://stardance.com.cy/wp-content/uploads/2026/04/about-page-cta-bg-normal.jpg',
            'mobile' => 'https://stardance.com.cy/wp-content/uploads/2026/04/about-page-cta-bg-mobile.jpg',
        ),
        'cta_classes' => array(
            'large'  => 'https://stardance.com.cy/wp-content/uploads/2026/03/classes-page-cta-bg.webp',
            'tablet' => 'https://stardance.com.cy/wp-content/uploads/2026/03/classes-page-cta-bg.webp',
            'mobile' => 'https://stardance.com.cy/wp-content/uploads/2026/03/classes-page-cta-bg.webp',
        ),
        'cta_events' => array(
            'large'  => 'https://stardance.com.cy/wp-content/uploads/2026/03/events-page-cta-bg.webp',
            'tablet' => 'https://stardance.com.cy/wp-content/uploads/2026/03/events-page-cta-bg.webp',
            'mobile' => 'https://stardance.com.cy/wp-content/uploads/2026/03/events-page-cta-bg.webp',
        ),
        'cta_schedule' => array(
            'large'  => 'https://stardance.com.cy/wp-content/uploads/2026/03/schedule-cta-bg.webp',
            'tablet' => 'https://stardance.com.cy/wp-content/uploads/2026/03/schedule-cta-bg.webp',
            'mobile' => 'https://stardance.com.cy/wp-content/uploads/2026/03/schedule-cta-bg.webp',
        ),
        'cta_single_class' => array(
            'large'  => 'https://stardance.com.cy/wp-content/uploads/2026/03/single-class-bottom-cta.webp',
            'tablet' => 'https://stardance.com.cy/wp-content/uploads/2026/03/single-class-bottom-cta.webp',
            'mobile' => 'https://stardance.com.cy/wp-content/uploads/2026/03/single-class-bottom-cta.webp',
        ),
        'cta_single_event' => array(
            'large'  => 'https://stardance.com.cy/wp-content/uploads/2026/04/single-event-page-bottom-cta-e1777353407671.webp',
            'tablet' => 'https://stardance.com.cy/wp-content/uploads/2026/04/single-event-page-bottom-cta-e1777353407671.webp',
            'mobile' => 'https://stardance.com.cy/wp-content/uploads/2026/04/single-event-page-bottom-cta-e1777353407671.webp',
        ),
        'cta_home' => array(
            'large'  => 'https://stardance.com.cy/wp-content/uploads/2026/04/bottom-cta-background.webp',
            'tablet' => 'https://stardance.com.cy/wp-content/uploads/2026/04/bottom-cta-background.webp',
            'mobile' => 'https://stardance.com.cy/wp-content/uploads/2026/04/bottom-cta-background.webp',
        ),
    );

    if ( isset( $slots[ $slot ] ) ) {
        return $slots[ $slot ];
    }

    return array(
        'large'  => '',
        'tablet' => '',
        'mobile' => '',
    );
}

/**
 * Resolve hero images for current post/page.
 *
 * @param int    $post_id Post ID.
 * @param string $slot    Slot key.
 * @param array  $fallbacks Optional explicit fallback values.
 * @return array{large:string,tablet:string,mobile:string}
 */
function stardance_get_responsive_hero_images( $post_id, $slot, $fallbacks = array() ) {
    $resolved_fallbacks = wp_parse_args( $fallbacks, stardance_get_default_responsive_images( 'hero_' . $slot ) );
    return stardance_get_responsive_acf_images( $post_id, 'hero', $resolved_fallbacks );
}

/**
 * Resolve bottom CTA images for current post/page.
 *
 * @param int    $post_id Post ID.
 * @param string $slot    Slot key.
 * @param array  $fallbacks Optional explicit fallback values.
 * @return array{large:string,tablet:string,mobile:string}
 */
function stardance_get_responsive_bottom_cta_images( $post_id, $slot, $fallbacks = array() ) {
    $resolved_fallbacks = wp_parse_args( $fallbacks, stardance_get_default_responsive_images( 'cta_' . $slot ) );
    return stardance_get_responsive_acf_images( $post_id, 'bottom_cta', $resolved_fallbacks );
}

/**
 * Resolve hero/CTA slot key for a given post.
 *
 * @param int    $post_id   Post ID.
 * @param string $field_key hero|bottom_cta.
 * @return string
 */
function stardance_get_responsive_image_slot_for_post( $post_id, $field_key ) {
    $post_id = absint( $post_id );
    if ( ! $post_id ) {
        return '';
    }

    $post_type = get_post_type( $post_id );
    if ( 'sd_event' === $post_type ) {
        return 'hero' === $field_key ? 'hero_single_event' : 'cta_single_event';
    }
    if ( 'dance_class' === $post_type ) {
        return 'hero' === $field_key ? 'hero_single_class' : 'cta_single_class';
    }
    if ( 'page' !== $post_type ) {
        return '';
    }

    if ( (int) get_option( 'page_on_front' ) === $post_id ) {
        return 'hero' === $field_key ? 'hero_home' : 'cta_home';
    }

    $template = get_page_template_slug( $post_id );
    $hero_map = array(
        'page-about.php'    => 'hero_about',
        'page-classes.php'  => 'hero_classes',
        'page-events.php'   => 'hero_events',
        'page-schedule.php' => 'hero_schedule',
        'page-contact.php'  => 'hero_contact',
        'page-gallery.php'  => 'hero_gallery',
    );
    $cta_map  = array(
        'page-about.php'    => 'cta_about',
        'page-classes.php'  => 'cta_classes',
        'page-events.php'   => 'cta_events',
        'page-schedule.php' => 'cta_schedule',
    );

    if ( 'hero' === $field_key && isset( $hero_map[ $template ] ) ) {
        return $hero_map[ $template ];
    }
    if ( 'bottom_cta' === $field_key && isset( $cta_map[ $template ] ) ) {
        return $cta_map[ $template ];
    }

    return '';
}

/**
 * Provide legacy image IDs as default ACF values when fields are empty.
 *
 * @param mixed  $value   Existing stored value.
 * @param int    $post_id Current post ID.
 * @param array  $field   Field config.
 * @param string $field_key hero|bottom_cta.
 * @return mixed
 */
function stardance_get_responsive_image_default_field_value( $value, $post_id, $field, $field_key ) {
    if ( ! empty( $value ) ) {
        return $value;
    }

    $slot = stardance_get_responsive_image_slot_for_post( $post_id, $field_key );
    if ( '' === $slot ) {
        return $value;
    }

    $size = '';
    if ( false !== strpos( $field['name'], '_large' ) ) {
        $size = 'large';
    } elseif ( false !== strpos( $field['name'], '_tablet' ) ) {
        $size = 'tablet';
    } elseif ( false !== strpos( $field['name'], '_mobile' ) ) {
        $size = 'mobile';
    }
    if ( '' === $size ) {
        return $value;
    }

    $fallbacks = stardance_get_default_responsive_images( $slot );
    if ( empty( $fallbacks[ $size ] ) ) {
        return $value;
    }

    $attachment_id = attachment_url_to_postid( $fallbacks[ $size ] );
    return $attachment_id ? $attachment_id : $value;
}

/**
 * Default value for hero large image field.
 */
function stardance_acf_default_hero_large( $value, $post_id, $field ) {
    return stardance_get_responsive_image_default_field_value( $value, $post_id, $field, 'hero' );
}
add_filter( 'acf/load_value/name=stardance_hero_image_large', 'stardance_acf_default_hero_large', 10, 3 );

/**
 * Default value for hero tablet image field.
 */
function stardance_acf_default_hero_tablet( $value, $post_id, $field ) {
    return stardance_get_responsive_image_default_field_value( $value, $post_id, $field, 'hero' );
}
add_filter( 'acf/load_value/name=stardance_hero_image_tablet', 'stardance_acf_default_hero_tablet', 10, 3 );

/**
 * Default value for hero mobile image field.
 */
function stardance_acf_default_hero_mobile( $value, $post_id, $field ) {
    return stardance_get_responsive_image_default_field_value( $value, $post_id, $field, 'hero' );
}
add_filter( 'acf/load_value/name=stardance_hero_image_mobile', 'stardance_acf_default_hero_mobile', 10, 3 );

/**
 * Default value for bottom CTA large image field.
 */
function stardance_acf_default_bottom_cta_large( $value, $post_id, $field ) {
    return stardance_get_responsive_image_default_field_value( $value, $post_id, $field, 'bottom_cta' );
}
add_filter( 'acf/load_value/name=stardance_bottom_cta_image_large', 'stardance_acf_default_bottom_cta_large', 10, 3 );

/**
 * Default value for bottom CTA tablet image field.
 */
function stardance_acf_default_bottom_cta_tablet( $value, $post_id, $field ) {
    return stardance_get_responsive_image_default_field_value( $value, $post_id, $field, 'bottom_cta' );
}
add_filter( 'acf/load_value/name=stardance_bottom_cta_image_tablet', 'stardance_acf_default_bottom_cta_tablet', 10, 3 );

/**
 * Default value for bottom CTA mobile image field.
 */
function stardance_acf_default_bottom_cta_mobile( $value, $post_id, $field ) {
    return stardance_get_responsive_image_default_field_value( $value, $post_id, $field, 'bottom_cta' );
}
add_filter( 'acf/load_value/name=stardance_bottom_cta_image_mobile', 'stardance_acf_default_bottom_cta_mobile', 10, 3 );
