<?php
/**
 * Content resolver — Layer B (page copy) and Layer C (CPT content).
 *
 * Resolution order for get_text():
 *   1. ACF saved value for sd_{context}_{key}_{lang}  (if ACF active and non-empty)
 *   2. RU page defaults map                            (when lang = ru)
 *   3. Schema default (EN)
 *
 * Resolution order for get_post_text():
 *   1. ACF saved value for {meta_key}_{lang}           (if ACF active and non-empty)
 *   2. WP post meta {meta_key}_{lang}
 *   3. WP post content / title (EN fallback)
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class SD_Page_Content {

    /**
     * Resolve a page-level text field.
     *
     * @param int    $post_id WP post ID of the page.
     * @param string $context Schema context slug (home, about, …).
     * @param string $key     Field key within the schema.
     * @return string
     */
    public static function get_text( int $post_id, string $context, string $key ): string {
        $lang      = sd_get_current_lang();
        $acf_key   = "sd_{$context}_{$key}_{$lang}";

        // 1. ACF override.
        if ( function_exists( 'get_field' ) ) {
            $acf_val = get_field( $acf_key, $post_id );
            if ( $acf_val !== null && $acf_val !== '' ) {
                return (string) $acf_val;
            }
        }

        // 2. RU defaults map.
        if ( $lang === 'ru' ) {
            $ru_val = SD_Ru_Page_Defaults::get( $context, $key );
            if ( $ru_val !== null ) {
                return $ru_val;
            }
        }

        // 3. Schema EN default.
        $default = SD_Page_Meta_Schema::get_default( $context, $key );
        return $default !== null ? $default : '';
    }

    /**
     * Resolve a CPT-level text field (coaches, dance_class, etc.).
     *
     * @param int    $post_id  WP post ID.
     * @param string $meta_key Base meta key (e.g. 'coach_bio', 'coach_name').
     * @return string Empty string when nothing found.
     */
    public static function get_post_text( int $post_id, string $meta_key ): string {
        $lang       = sd_get_current_lang();
        $lang_key   = $meta_key . '_' . $lang;

        if ( $lang !== SD_DEFAULT_LANG ) {
            // 1. ACF override.
            if ( function_exists( 'get_field' ) ) {
                $acf_val = get_field( $lang_key, $post_id );
                if ( $acf_val !== null && $acf_val !== '' ) {
                    return (string) $acf_val;
                }
            }

            // 2. Raw post meta.
            $meta_val = get_post_meta( $post_id, $lang_key, true );
            if ( $meta_val !== '' && $meta_val !== false ) {
                return (string) $meta_val;
            }
        }

        return ''; // Caller falls back to post_title / get_the_content().
    }
}
