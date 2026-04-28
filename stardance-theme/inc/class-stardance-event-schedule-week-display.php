<?php
/**
 * Event schedule dateline + homepage-style timetable grid for single events.
 *
 * @package stardance
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Formats event_date and maps schedule rows to the same Mon–Sun shape as the homepage timetable.
 */
final class Stardance_Event_Schedule_Week_Display {

	private const WEEKDAY_LABELS = array( 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun' );

	/**
	 * Format event_date meta for display under the schedule heading (e.g. "May 10-14", "May 10").
	 *
	 * @param string $raw event_date meta.
	 * @return string Empty when unparseable or blank.
	 */
	public static function format_event_dateline( string $raw ): string {
		$raw = trim( $raw );
		if ( '' === $raw ) {
			return '';
		}
		if ( ! preg_match( '/^([A-Za-z]+)\s+(\d{1,2})\s*(?:-\s*(\d{1,2}))?\s*(?:,\s*\d{4})?\s*$/', $raw, $m ) ) {
			return '';
		}
		$month = ucfirst( strtolower( $m[1] ) );
		$d1    = (int) $m[2];
		$d2    = isset( $m[3] ) && '' !== $m[3] ? (int) $m[3] : null;
		if ( null !== $d2 && $d2 !== $d1 ) {
			return $month . ' ' . $d1 . '-' . $d2;
		}
		return $month . ' ' . $d1;
	}

	/**
	 * Map a day label to 0 = Monday … 6 = Sunday.
	 *
	 * @param string $day Day string from admin (e.g. Wed, Monday).
	 * @return int|null
	 */
	public static function parse_weekday_index( string $day ): ?int {
		$day = trim( $day );
		if ( '' === $day ) {
			return null;
		}
		$lower  = strtolower( $day );
		$prefix = substr( $lower, 0, 3 );
		$map    = array(
			'mon'       => 0,
			'monday'    => 0,
			'tue'       => 1,
			'tues'      => 1,
			'tuesday'   => 1,
			'wed'       => 2,
			'wednesday' => 2,
			'thu'       => 3,
			'thurs'     => 3,
			'thursday'  => 3,
			'fri'       => 4,
			'friday'    => 4,
			'sat'       => 5,
			'saturday'  => 5,
			'sun'       => 6,
			'sunday'    => 6,
		);
		if ( isset( $map[ $lower ] ) ) {
			return $map[ $lower ];
		}
		if ( isset( $map[ $prefix ] ) ) {
			return $map[ $prefix ];
		}
		return null;
	}

	/**
	 * Build weekday + weekend arrays matching template-parts/timetable.php shape.
	 *
	 * @param array<int, array<string, string>> $entries Schedule rows.
	 * @return array{
	 *   weekdays: array<int, array{label: string, closed: bool, sessions: array<int, array{time: string, title: string, meta: string}>}>,
	 *   weekend: array<int, array{label: string, closed: bool, sessions: array<int, array{time: string, title: string, meta: string}>}>,
	 *   orphans: array<int, array<string, string>>,
	 *   has_any_parsed_day: bool
	 * }
	 */
	public static function build_timetable_grid_from_entries( array $entries ): array {
		$by_day  = array( array(), array(), array(), array(), array(), array(), array() );
		$orphans = array();

		foreach ( $entries as $row ) {
			if ( ! is_array( $row ) || ! self::row_has_displayable_content( $row ) ) {
				continue;
			}
			$idx = self::parse_weekday_index( (string) ( $row['day'] ?? '' ) );
			if ( null === $idx ) {
				$orphans[] = $row;
				continue;
			}
			$by_day[ $idx ][] = $row;
		}

		$make_sessions = static function ( array $rows ): array {
			$sessions = array();
			foreach ( $rows as $r ) {
				$time  = trim( (string) ( $r['time'] ?? '' ) );
				$title = trim( (string) ( $r['title'] ?? '' ) );
				$meta  = trim( (string) ( $r['location'] ?? '' ) );
				if ( '' === $time && '' === $title && '' === $meta ) {
					continue;
				}
				$sessions[] = array(
					'time'  => $time,
					'title' => $title,
					'meta'  => $meta,
				);
			}
			return $sessions;
		};

		$make_day = static function ( int $i ) use ( $by_day, $make_sessions ): array {
			$sessions = $make_sessions( $by_day[ $i ] );
			return array(
				'label'    => self::WEEKDAY_LABELS[ $i ],
				'closed'   => array() === $sessions,
				'sessions' => $sessions,
			);
		};

		$weekdays = array();
		for ( $i = 0; $i < 5; $i++ ) {
			$weekdays[] = $make_day( $i );
		}
		$weekend = array( $make_day( 5 ), $make_day( 6 ) );

		$has_any = false;
		for ( $i = 0; $i < 7; $i++ ) {
			if ( array() !== $by_day[ $i ] ) {
				$has_any = true;
				break;
			}
		}

		return array(
			'weekdays'           => $weekdays,
			'weekend'            => $weekend,
			'orphans'            => $orphans,
			'has_any_parsed_day' => $has_any,
		);
	}

	/**
	 * @param array<string, string> $row Schedule row.
	 */
	private static function row_has_displayable_content( array $row ): bool {
		$day      = trim( (string) ( $row['day'] ?? '' ) );
		$title    = trim( (string) ( $row['title'] ?? '' ) );
		$time     = trim( (string) ( $row['time'] ?? '' ) );
		$location = trim( (string) ( $row['location'] ?? '' ) );
		return '' !== $day || '' !== $title || '' !== $time || '' !== $location;
	}
}
