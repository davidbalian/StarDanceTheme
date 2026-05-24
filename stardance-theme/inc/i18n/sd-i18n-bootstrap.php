<?php
/**
 * i18n bootstrap — language detection, rewrite rules, URL helpers, language switcher.
 * Path-prefix model: EN is default (no prefix), RU at /ru/.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'SD_DEFAULT_LANG', 'en' );
define( 'SD_SUPPORTED_LANGS', array( 'en', 'ru' ) );

// ---------------------------------------------------------------------------
// Language detection
// ---------------------------------------------------------------------------

function sd_get_current_lang(): string {
    static $lang = null;
    if ( $lang !== null ) {
        return $lang;
    }
    $qv = get_query_var( 'lang', '' );
    if ( $qv && in_array( $qv, SD_SUPPORTED_LANGS, true ) ) {
        $lang = $qv;
        return $lang;
    }
    $path     = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH ), '/' );
    $segments = explode( '/', $path );
    if ( ! empty( $segments[0] ) && in_array( $segments[0], array( 'ru' ), true ) ) {
        $lang = $segments[0];
        return $lang;
    }
    $lang = SD_DEFAULT_LANG;
    return $lang;
}

// ---------------------------------------------------------------------------
// Register query var and rewrite rules
// ---------------------------------------------------------------------------

add_filter( 'query_vars', function ( array $vars ): array {
    $vars[] = 'lang';
    return $vars;
} );

add_action( 'init', function (): void {
    add_rewrite_rule( '^ru/?$', 'index.php?lang=ru', 'top' );
    add_rewrite_rule( '^ru/(.+?)/?$', 'index.php?lang=ru&pagename=$matches[1]', 'top' );
}, 1 );

// When /ru/ is the front page root, force static front page.
add_action( 'pre_get_posts', function ( WP_Query $query ): void {
    if ( ! $query->is_main_query() ) {
        return;
    }
    if ( $query->get( 'lang' ) === 'ru' && ! $query->get( 'pagename' ) ) {
        $front = (int) get_option( 'page_on_front' );
        if ( $front > 0 ) {
            $query->set( 'page_id', $front );
            $query->is_page       = true;
            $query->is_singular   = true;
            $query->is_front_page = true;
            $query->is_home       = false;
        }
    }
} );

// Prevent WordPress from stripping the /ru/ prefix via canonical redirect.
add_filter( 'redirect_canonical', function ( $redirect_url ) {
    $path = parse_url( $_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH );
    if ( preg_match( '#^/ru(/|$)#', $path ) ) {
        return false;
    }
    return $redirect_url;
} );

// Flush rewrites on theme activation; bump version option to allow re-flush.
add_action( 'after_switch_theme', function (): void {
    add_rewrite_rule( '^ru/?$', 'index.php?lang=ru', 'top' );
    add_rewrite_rule( '^ru/(.+?)/?$', 'index.php?lang=ru&pagename=$matches[1]', 'top' );
    flush_rewrite_rules();
} );

// ---------------------------------------------------------------------------
// Translation helpers
// ---------------------------------------------------------------------------

function sd_get_translations( string $lang ): array {
    static $cache = array();
    if ( isset( $cache[ $lang ] ) ) {
        return $cache[ $lang ];
    }
    if ( $lang === SD_DEFAULT_LANG ) {
        $cache[ $lang ] = array();
        return $cache[ $lang ];
    }
    $file           = get_template_directory() . "/translations/{$lang}.php";
    $cache[ $lang ] = file_exists( $file ) ? include $file : array();
    return $cache[ $lang ];
}

function t( string $key ): string {
    $lang = sd_get_current_lang();
    if ( $lang === SD_DEFAULT_LANG ) {
        return $key;
    }
    $map = sd_get_translations( $lang );
    return $map[ $key ] ?? $key;
}

function te( string $key ): void {
    echo esc_html( t( $key ) );
}

// ---------------------------------------------------------------------------
// Localized URL builder
// ---------------------------------------------------------------------------

function sd_localized_url( string $path = '/' ): string {
    $lang = sd_get_current_lang();
    $path = '/' . ltrim( $path, '/' );
    if ( $lang === SD_DEFAULT_LANG ) {
        return home_url( $path );
    }
    return home_url( '/' . $lang . $path );
}

// ---------------------------------------------------------------------------
// Language switcher
// ---------------------------------------------------------------------------

function sd_render_language_switcher(): void {
    $current_lang = sd_get_current_lang();
    $path         = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH ), '/' );

    // Strip any leading lang segment.
    $clean_path = preg_replace( '#^ru(/|$)#', '', $path );
    $clean_path = trim( $clean_path, '/' );

    $urls = array(
        'en' => home_url( '/' . ( $clean_path ? $clean_path . '/' : '' ) ),
        'ru' => home_url( '/ru/' . ( $clean_path ? $clean_path . '/' : '' ) ),
    );

    echo '<div class="sd-lang-switcher" aria-label="Language switcher">';
    echo '<a href="' . esc_url( $urls['en'] ) . '" class="sd-lang-switcher__btn' . ( $current_lang === 'en' ? ' is-active' : '' ) . '" lang="en" hreflang="en">EN</a>';
    echo '<span class="sd-lang-switcher__sep" aria-hidden="true">|</span>';
    echo '<a href="' . esc_url( $urls['ru'] ) . '" class="sd-lang-switcher__btn' . ( $current_lang === 'ru' ? ' is-active' : '' ) . '" lang="ru" hreflang="ru">RU</a>';
    echo '</div>';
}

// ---------------------------------------------------------------------------
// HTML lang attribute
// ---------------------------------------------------------------------------

add_filter( 'language_attributes', function ( string $output ): string {
    $lang = sd_get_current_lang();
    $map  = array( 'en' => 'en-US', 'ru' => 'ru' );
    $bcp  = $map[ $lang ] ?? 'en-US';
    // Replace lang="..." in the output or prepend it.
    if ( preg_match( '/lang="[^"]*"/', $output ) ) {
        return preg_replace( '/lang="[^"]*"/', 'lang="' . esc_attr( $bcp ) . '"', $output );
    }
    return 'lang="' . esc_attr( $bcp ) . '" ' . $output;
} );

// ---------------------------------------------------------------------------
// Menu link auto-prefixer (Strategy A)
// Prefixes unprefixed internal links with /ru when RU is active.
// ---------------------------------------------------------------------------

add_filter( 'wp_nav_menu_objects', function ( array $items ): array {
    $lang = sd_get_current_lang();
    if ( $lang === SD_DEFAULT_LANG ) {
        return $items;
    }
    $home = home_url();
    foreach ( $items as $item ) {
        $url = $item->url;
        if ( strpos( $url, $home ) !== 0 ) {
            continue; // external link — skip
        }
        $rel_path = substr( $url, strlen( $home ) );
        // Already prefixed.
        if ( preg_match( '#^/ru(/|$)#', $rel_path ) ) {
            continue;
        }
        // Anchor-only links: keep as-is.
        if ( strpos( $rel_path, '#' ) === 0 ) {
            continue;
        }
        $item->url = home_url( '/ru' . '/' . ltrim( $rel_path, '/' ) );
    }
    return $items;
} );

// Footer and header menu selection: pick per-locale menu when available.
// This is done in header.php / footer.php directly.

// ---------------------------------------------------------------------------
// Browser-language redirect (first visit at /)
// ---------------------------------------------------------------------------

add_action( 'template_redirect', function (): void {
    // Only redirect on bare site root, no prefix.
    $path = parse_url( $_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH );
    if ( rtrim( $path, '/' ) !== '' ) {
        return;
    }

    // Cookie already set — respect user's previous choice.
    if ( isset( $_COOKIE['sd_lang'] ) ) {
        return;
    }

    // Skip crawlers.
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    if ( preg_match( '/bot|crawl|slurp|spider|mediapartners|google|bing|yandex/i', $ua ) ) {
        return;
    }

    $accept = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '';
    if ( ! $accept ) {
        setcookie( 'sd_lang', 'en', time() + 30 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
        return;
    }

    // Parse Accept-Language.
    $detected = SD_DEFAULT_LANG;
    $parts    = explode( ',', $accept );
    $best_q   = 0;
    foreach ( $parts as $part ) {
        $part = trim( $part );
        if ( preg_match( '/^([a-z]{2,3})(?:-[a-z]{2,3})?(?:;q=([\d.]+))?/i', $part, $m ) ) {
            $code = strtolower( $m[1] );
            $q    = isset( $m[2] ) ? (float) $m[2] : 1.0;
            if ( $q > $best_q && in_array( $code, array( 'ru' ), true ) ) {
                $best_q   = $q;
                $detected = $code;
            }
        }
    }

    setcookie( 'sd_lang', $detected, time() + 30 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );

    if ( $detected !== SD_DEFAULT_LANG ) {
        wp_safe_redirect( home_url( '/' . $detected . '/' ) );
        exit;
    }
}, 1 );

// Sync cookie when user navigates to a prefixed URL without a cookie.
add_action( 'template_redirect', function (): void {
    $lang = sd_get_current_lang();
    if ( ! isset( $_COOKIE['sd_lang'] ) || $_COOKIE['sd_lang'] !== $lang ) {
        setcookie( 'sd_lang', $lang, time() + 30 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
    }
}, 20 );

// ---------------------------------------------------------------------------
// hreflang + canonical in <head>
// ---------------------------------------------------------------------------

add_action( 'wp_head', function (): void {
    $path = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH ), '/' );

    // Strip leading lang prefix to get the clean path.
    $clean = preg_replace( '#^ru(/|$)#', '', $path );
    $clean = trim( $clean, '/' );
    $clean = $clean ? $clean . '/' : '';

    $urls = array(
        'en' => home_url( '/' . $clean ),
        'ru' => home_url( '/ru/' . $clean ),
    );

    echo '<link rel="alternate" hreflang="en" href="' . esc_url( $urls['en'] ) . '">' . "\n";
    echo '<link rel="alternate" hreflang="ru" href="' . esc_url( $urls['ru'] ) . '">' . "\n";
    echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( $urls['en'] ) . '">' . "\n";
}, 2 );
