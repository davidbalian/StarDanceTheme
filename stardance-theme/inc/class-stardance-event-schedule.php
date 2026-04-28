<?php
/**
 * Structured schedule rows for sd_event (day, session title, time, location).
 *
 * @package stardance
 */

/**
 * Stores and retrieves JSON schedule entry rows on event posts.
 */
class Stardance_Event_Schedule {

    public const META_KEY = 'event_schedule_entries';

    /**
     * @param int $post_id Event post ID.
     * @return array<int, array{day:string,title:string,time:string,location:string}>
     */
    public static function get_entries( int $post_id ): array {
        $post_id = absint( $post_id );
        if ( ! $post_id ) {
            return array();
        }
        $raw = get_post_meta( $post_id, self::META_KEY, true );
        if ( ! is_string( $raw ) || '' === $raw ) {
            return array();
        }
        $decoded = json_decode( $raw, true );
        if ( ! is_array( $decoded ) ) {
            return array();
        }
        $out = array();
        foreach ( $decoded as $row ) {
            if ( ! is_array( $row ) ) {
                continue;
            }
            $out[] = array(
                'day'      => isset( $row['day'] ) ? (string) $row['day'] : '',
                'title'    => isset( $row['title'] ) ? (string) $row['title'] : '',
                'time'     => isset( $row['time'] ) ? (string) $row['time'] : '',
                'location' => isset( $row['location'] ) ? (string) $row['location'] : '',
            );
        }
        return $out;
    }

    /**
     * @param array<mixed> $raw_rows Rows from $_POST.
     * @return void
     */
    public static function persist_from_post( int $post_id, array $raw_rows ): void {
        $post_id = absint( $post_id );
        if ( ! $post_id ) {
            return;
        }
        $clean = array();
        foreach ( $raw_rows as $row ) {
            if ( ! is_array( $row ) ) {
                continue;
            }
            $day      = isset( $row['day'] ) ? sanitize_text_field( $row['day'] ) : '';
            $title    = isset( $row['title'] ) ? sanitize_text_field( $row['title'] ) : '';
            $time     = isset( $row['time'] ) ? sanitize_text_field( $row['time'] ) : '';
            $location = isset( $row['location'] ) ? sanitize_text_field( $row['location'] ) : '';
            if ( '' === $day && '' === $title && '' === $time && '' === $location ) {
                continue;
            }
            $clean[] = compact( 'day', 'title', 'time', 'location' );
        }
        if ( array() === $clean ) {
            delete_post_meta( $post_id, self::META_KEY );
            return;
        }
        update_post_meta( $post_id, self::META_KEY, wp_json_encode( $clean ) );
    }

    /**
     * @param array<int, array{day:string,title:string,time:string,location:string}> $entries Entries.
     */
    public static function has_displayable_entries( array $entries ): bool {
        foreach ( $entries as $row ) {
            if ( ! is_array( $row ) ) {
                continue;
            }
            $day      = trim( (string) ( $row['day'] ?? '' ) );
            $title    = trim( (string) ( $row['title'] ?? '' ) );
            $time     = trim( (string) ( $row['time'] ?? '' ) );
            $location = trim( (string) ( $row['location'] ?? '' ) );
            if ( '' !== $day || '' !== $title || '' !== $time || '' !== $location ) {
                return true;
            }
        }
        return false;
    }
}
