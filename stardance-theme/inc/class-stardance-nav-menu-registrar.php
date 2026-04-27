<?php
/**
 * Creates and assigns default nav menus when theme locations are empty.
 *
 * @package StarDance
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Registers preset Primary and Footer menus (idempotent per location).
 */
class Stardance_Nav_Menu_Registrar {

    private const PRIMARY_MENU_NAME = 'Star Dance Primary';

    private const FOOTER_MENU_NAME = 'Star Dance Footer';

    /**
     * Ensure default menus exist and are assigned where locations are unset.
     *
     * @return void
     */
    public function ensure_default_menus(): void {
        if ( ! current_user_can( 'edit_theme_options' ) ) {
            return;
        }

        if ( $this->primary_location_needs_preset_menu() ) {
            $this->ensure_menu_for_location(
                'primary',
                self::PRIMARY_MENU_NAME,
                array( $this, 'populate_primary_items' )
            );
        }

        if ( ! has_nav_menu( 'footer' ) ) {
            $this->ensure_menu_for_location(
                'footer',
                self::FOOTER_MENU_NAME,
                array( $this, 'populate_footer_items' )
            );
        }
    }

    /**
     * True when primary is unset, has no visible items, or is tied to a placeholder-style menu (# links).
     *
     * @return bool
     */
    private function primary_location_needs_preset_menu(): bool {
        if ( ! has_nav_menu( 'primary' ) ) {
            return true;
        }
        if ( ! $this->location_has_visible_nav_items( 'primary' ) ) {
            return true;
        }
        $locations = get_nav_menu_locations();
        $menu_id   = isset( $locations['primary'] ) ? (int) $locations['primary'] : 0;
        if ( $menu_id <= 0 ) {
            return true;
        }
        $preset = wp_get_nav_menu_object( self::PRIMARY_MENU_NAME );
        if ( $preset && (int) $preset->term_id === $menu_id ) {
            return false;
        }
        return $this->menu_looks_like_placeholder_nav( $menu_id );
    }

    /**
     * @param string $location Registered theme location slug.
     * @return bool
     */
    private function location_has_visible_nav_items( string $location ): bool {
        $locations = get_nav_menu_locations();
        if ( empty( $locations[ $location ] ) ) {
            return false;
        }
        $items = wp_get_nav_menu_items( (int) $locations[ $location ] );
        return ! empty( $items );
    }

    /**
     * Detects imported / builder menus where custom links are "#", hash-only, or trailing "/#".
     *
     * @param int $menu_id Nav menu term ID.
     * @return bool
     */
    private function menu_looks_like_placeholder_nav( int $menu_id ): bool {
        $items = wp_get_nav_menu_items( $menu_id );
        if ( empty( $items ) ) {
            return true;
        }

        $bad_custom    = 0;
        $total_custom  = 0;
        $non_custom    = 0;

        foreach ( $items as $item ) {
            if ( (int) $item->menu_item_parent !== 0 ) {
                continue;
            }
            if ( 'custom' === $item->type ) {
                ++$total_custom;
                if ( $this->is_placeholder_custom_menu_url( (string) $item->url ) ) {
                    ++$bad_custom;
                }
            } else {
                ++$non_custom;
            }
        }

        if ( $non_custom > 0 ) {
            return false;
        }
        if ( $total_custom < 2 ) {
            return $bad_custom === $total_custom && $total_custom > 0;
        }
        return $bad_custom === $total_custom;
    }

    /**
     * @param string $url Menu item URL from a custom link.
     * @return bool
     */
    private function is_placeholder_custom_menu_url( string $url ): bool {
        $url = trim( $url );
        if ( $url === '' || $url === '#' ) {
            return true;
        }
        if ( preg_match( '/^#[A-Za-z0-9_-]+$/', $url ) ) {
            return true;
        }
        // Builder-style links: full URL ending with "/#" and no real fragment after it.
        if ( preg_match( '#^https?://#', $url ) && strlen( $url ) >= 2 && substr( $url, -2 ) === '/#' ) {
            return true;
        }
        return false;
    }

    /**
     * @param string   $location Theme location slug.
     * @param string   $menu_name Human-readable menu name (unique).
     * @param callable $populate Callback( int $menu_id ): void.
     * @return void
     */
    private function ensure_menu_for_location( string $location, string $menu_name, callable $populate ): void {
        $menu_obj = wp_get_nav_menu_object( $menu_name );
        if ( $menu_obj ) {
            $menu_id = (int) $menu_obj->term_id;
        } else {
            $menu_id = wp_create_nav_menu( $menu_name );
            if ( is_wp_error( $menu_id ) ) {
                return;
            }
            $menu_id = (int) $menu_id;
        }

        $items = wp_get_nav_menu_items( $menu_id );
        if ( empty( $items ) ) {
            $populate( $menu_id );
        }

        $locations = get_theme_mod( 'nav_menu_locations', array() );
        if ( ! is_array( $locations ) ) {
            $locations = array();
        }
        $locations[ $location ] = $menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }

    /**
     * @param int $menu_id Nav menu term ID.
     * @return void
     */
    private function populate_primary_items( int $menu_id ): void {
        $this->add_home_item( $menu_id );
        $this->add_page_or_custom_url( $menu_id, __( 'About', 'stardance' ), 'about' );
        $this->add_page_or_custom_url( $menu_id, __( 'Classes', 'stardance' ), 'classes' );
        $this->add_page_or_custom_url( $menu_id, __( 'Events', 'stardance' ), 'events' );
        $this->add_page_or_custom_url( $menu_id, __( 'Schedule', 'stardance' ), 'schedule' );
        $this->add_page_or_custom_url( $menu_id, __( 'Gallery', 'stardance' ), 'gallery' );
        $this->add_custom_nav_item( $menu_id, __( 'Contact', 'stardance' ), home_url( '/#contact' ) );
    }

    /**
     * @param int $menu_id Nav menu term ID.
     * @return void
     */
    private function populate_footer_items( int $menu_id ): void {
        $this->add_home_item( $menu_id );
        $this->add_page_or_custom_url( $menu_id, __( 'About Us', 'stardance' ), 'about' );
        $this->add_custom_nav_item( $menu_id, __( 'Meet the Coaches', 'stardance' ), home_url( '/#coaches' ) );
        $this->add_page_or_custom_url( $menu_id, __( 'Dance Classes', 'stardance' ), 'classes' );
        $this->add_page_or_custom_url( $menu_id, __( 'Timetable', 'stardance' ), 'schedule' );
        $this->add_custom_nav_item( $menu_id, __( 'Contact', 'stardance' ), home_url( '/#contact' ) );
    }

    /**
     * @param int $menu_id Nav menu term ID.
     * @return void
     */
    private function add_home_item( int $menu_id ): void {
        $front_id = (int) get_option( 'page_on_front' );
        if ( $front_id > 0 ) {
            $this->add_post_type_nav_item( $menu_id, __( 'Home', 'stardance' ), 'page', $front_id );
            return;
        }
        $this->add_custom_nav_item( $menu_id, __( 'Home', 'stardance' ), home_url( '/' ) );
    }

    /**
     * @param int    $menu_id Nav menu term ID.
     * @param string $title   Menu label.
     * @param string $slug    Page post_name.
     * @return void
     */
    private function add_page_or_custom_url( int $menu_id, string $title, string $slug ): void {
        $page = get_page_by_path( $slug, OBJECT, 'page' );
        if ( $page instanceof WP_Post ) {
            $this->add_post_type_nav_item( $menu_id, $title, 'page', (int) $page->ID );
            return;
        }
        $this->add_custom_nav_item( $menu_id, $title, home_url( '/' . $slug . '/' ) );
    }

    /**
     * @param int    $menu_id   Nav menu term ID.
     * @param string $title     Menu label.
     * @param string $post_type Object type.
     * @param int    $object_id Post ID.
     * @return void
     */
    private function add_post_type_nav_item( int $menu_id, string $title, string $post_type, int $object_id ): void {
        wp_update_nav_menu_item(
            $menu_id,
            0,
            array(
                'menu-item-title'     => $title,
                'menu-item-object'    => $post_type,
                'menu-item-object-id' => $object_id,
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
            )
        );
    }

    /**
     * @param int    $menu_id Nav menu term ID.
     * @param string $title   Menu label.
     * @param string $url     Absolute URL.
     * @return void
     */
    private function add_custom_nav_item( int $menu_id, string $title, string $url ): void {
        wp_update_nav_menu_item(
            $menu_id,
            0,
            array(
                'menu-item-title'  => $title,
                'menu-item-url'    => esc_url_raw( $url ),
                'menu-item-type'   => 'custom',
                'menu-item-status' => 'publish',
            )
        );
    }
}
