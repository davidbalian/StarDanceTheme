<?php
/**
 * Centered 7-day week strip for single event schedules.
 *
 * @package stardance
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Groups schedule rows by weekday and orders columns so active days sit near the center.
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
			'mon'     => 0,
			'monday'  => 0,
			'tue'     => 1,
			'tues'    => 1,
			'tuesday' => 1,
			'wed'     => 2,
			'wednesday' => 2,
			'thu'     => 3,
			'thurs'   => 3,
			'thursday' => 3,
			'fri'     => 4,
			'friday'  => 4,
			'sat'     => 5,
			'saturday' => 5,
			'sun'     => 6,
			'sunday'  => 6,
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
	 * @param array<int, array<string, string>> $entries Schedule rows.
	 * @return array{columns: array<int, array{weekday_index: int, label: string, rows: array}>, orphans: array, has_parsed_days: bool}
	 */
	public static function build_week_columns( array $entries ): array {
		$by_day  = array();
		$orphans = array();
		foreach ( $entries as $row ) {
			if ( ! is_array( $row ) ) {
				continue;
			}
			if ( ! self::row_has_displayable_content( $row ) ) {
				continue;
			}
			$idx = self::parse_weekday_index( (string) ( $row['day'] ?? '' ) );
			if ( null === $idx ) {
				$orphans[] = $row;
				continue;
			}
			if ( ! isset( $by_day[ $idx ] ) ) {
				$by_day[ $idx ] = array();
			}
			$by_day[ $idx ][] = $row;
		}

		$active = array_keys( $by_day );
		sort( $active );
		$start = self::choose_week_start( $active );

		$columns = array();
		for ( $k = 0; $k < 7; $k++ ) {
			$d = ( $start + $k ) % 7;
			$columns[] = array(
				'weekday_index' => $d,
				'label'         => self::WEEKDAY_LABELS[ $d ],
				'rows'          => isset( $by_day[ $d ] ) ? $by_day[ $d ] : array(),
			);
		}

		return array(
			'columns'         => $columns,
			'orphans'         => $orphans,
			'has_parsed_days' => array() !== $by_day,
		);
	}

	/**
	 * @param array<int> $active Sorted weekday indices that have sessions.
	 * @return int Start weekday index (0–6) for the first column.
	 */
	private static function choose_week_start( array $active ): int {
		if ( array() === $active ) {
			return 0;
		}

		$best_start = 0;
		$best_score = PHP_FLOAT_MAX;

		for ( $s = 0; $s < 7; $s++ ) {
			$positions = array();
			foreach ( $active as $a ) {
				$positions[] = ( $a - $s + 7 ) % 7;
			}
			$mean  = array_sum( $positions ) / count( $positions );
			$score = abs( $mean - 3 );
			if ( $score < $best_score ) {
				$best_score = $score;
				$best_start = $s;
			}
		}

		return $best_start;
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
