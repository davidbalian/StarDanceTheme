<?php
/**
 * Schema registry — loads per-context schema files and provides field-level access.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class SD_Page_Meta_Schema {

    private static array $registry = array();
    private static bool  $loaded   = false;

    private static function load(): void {
        if ( self::$loaded ) {
            return;
        }
        $schema_dir = get_template_directory() . '/inc/page-meta/schema/';
        foreach ( glob( $schema_dir . 'schema-*.php' ) as $file ) {
            $schema = include $file;
            if ( ! empty( $schema['context'] ) && ! empty( $schema['fields'] ) ) {
                self::$registry[ $schema['context'] ] = $schema['fields'];
            }
        }
        self::$loaded = true;
    }

    /**
     * Returns all fields for a context, or empty array if unknown.
     */
    public static function get_fields( string $context ): array {
        self::load();
        return self::$registry[ $context ] ?? array();
    }

    /**
     * Returns the default value for a single field, or null if not defined.
     */
    public static function get_default( string $context, string $key ): ?string {
        $fields = self::get_fields( $context );
        return $fields[ $key ]['default'] ?? null;
    }

    /**
     * Returns the type for a field.
     */
    public static function get_type( string $context, string $key ): string {
        $fields = self::get_fields( $context );
        return $fields[ $key ]['type'] ?? 'text';
    }
}
