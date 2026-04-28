<?php
/**
 * Event gallery preview layout for single event template.
 *
 * @package stardance
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Computes preview grid placement and lightbox link order for event galleries.
 */
final class Stardance_Event_Gallery_Preview {

	/**
	 * @param int[] $gallery_ids Attachment IDs in gallery order.
	 * @return int[] Valid image attachment IDs only.
	 */
	public static function filter_valid_ids( array $gallery_ids ): array {
		$out = array();
		foreach ( $gallery_ids as $id ) {
			$id = absint( $id );
			if ( ! $id || ! wp_attachment_is_image( $id ) ) {
				continue;
			}
			$src = wp_get_attachment_image_src( $id, 'full' );
			if ( $src && ! empty( $src[0] ) ) {
				$out[] = $id;
			}
		}
		return $out;
	}

	/**
	 * @param int $attachment_id Attachment ID.
	 * @return string 'landscape' or 'portrait' (width >= height => landscape).
	 */
	public static function orientation( int $attachment_id ): string {
		$src = wp_get_attachment_image_src( $attachment_id, 'full' );
		if ( ! $src || empty( $src[1] ) || empty( $src[2] ) ) {
			return 'landscape';
		}
		$w = (int) $src[1];
		$h = (int) $src[2];
		return ( $w >= $h ) ? 'landscape' : 'portrait';
	}

	/**
	 * Build preview config: BEM modifier + one entry per gallery image (gallery order) for markup.
	 *
	 * @param int[] $gallery_ids Valid ordered attachment IDs.
	 * @return array{ modifier: string, rows: array<int, array{ attachment_id: int, sr_only: bool, grid_style: string }> }|null
	 */
	public static function build_preview_rows( array $gallery_ids ): ?array {
		$ids = self::filter_valid_ids( $gallery_ids );
		if ( array() === $ids ) {
			return null;
		}

		$n = count( $ids );
		if ( 1 === $n ) {
			return array(
				'modifier' => 'single',
				'rows'     => array(
					array(
						'attachment_id' => $ids[0],
						'sr_only'       => false,
						'grid_style'    => 'grid-column: 1 / -1; grid-row: 1;',
					),
				),
			);
		}

		$o0 = self::orientation( $ids[0] );
		$o1 = self::orientation( $ids[1] );
		$both_portrait  = ( 'portrait' === $o0 && 'portrait' === $o1 );
		$both_landscape = ( 'landscape' === $o0 && 'landscape' === $o1 );

		if ( $both_portrait ) {
			return self::rows_pair_portrait( $ids );
		}
		if ( $both_landscape ) {
			return self::rows_pair_landscape( $ids );
		}

		return self::rows_mixed( $ids );
	}

	/**
	 * @param int[] $ids Valid IDs.
	 * @return array{ modifier: string, rows: array<int, array<string, mixed>> }
	 */
	private static function rows_pair_portrait( array $ids ): array {
		$placements = array(
			$ids[0] => 'grid-column: 1; grid-row: 1;',
			$ids[1] => 'grid-column: 2; grid-row: 1;',
		);
		return array(
			'modifier' => 'pair-portrait',
			'rows'     => self::apply_placements( $ids, $placements ),
		);
	}

	/**
	 * @param int[] $ids Valid IDs.
	 * @return array{ modifier: string, rows: array<int, array<string, mixed>> }
	 */
	private static function rows_pair_landscape( array $ids ): array {
		$placements = array(
			$ids[0] => 'grid-column: 1; grid-row: 1;',
			$ids[1] => 'grid-column: 1; grid-row: 2;',
		);
		return array(
			'modifier' => 'pair-landscape',
			'rows'     => self::apply_placements( $ids, $placements ),
		);
	}

	/**
	 * @param int[] $ids Valid IDs.
	 * @return array{ modifier: string, rows: array<int, array<string, mixed>> }
	 */
	private static function rows_mixed( array $ids ): array {
		$slice       = array_slice( $ids, 0, min( 3, count( $ids ) ) );
		$portrait_id = null;
		foreach ( $slice as $sid ) {
			if ( 'portrait' === self::orientation( $sid ) ) {
				$portrait_id = $sid;
				break;
			}
		}
		if ( null === $portrait_id ) {
			$portrait_id = $slice[0];
		}

		$stack = array();
		foreach ( $slice as $sid ) {
			if ( $sid === $portrait_id ) {
				continue;
			}
			if ( 'landscape' === self::orientation( $sid ) && count( $stack ) < 2 ) {
				$stack[] = $sid;
			}
		}

		if ( array() === $stack ) {
			foreach ( $slice as $sid ) {
				if ( $sid !== $portrait_id ) {
					$stack[] = $sid;
					break;
				}
			}
		}

		$placements = array(
			$portrait_id => 'grid-column: 1; grid-row: 1 / span 2;',
		);
		$row = 1;
		foreach ( $stack as $lid ) {
			$placements[ $lid ] = 'grid-column: 2; grid-row: ' . $row . ';';
			++$row;
		}

		return array(
			'modifier' => 'mixed',
			'rows'     => self::apply_placements( $ids, $placements ),
		);
	}

	/**
	 * @param int[]                $ids         Full valid gallery order.
	 * @param array<int, string>   $placements attachment_id => grid inline style.
	 * @return array<int, array{ attachment_id: int, sr_only: bool, grid_style: string }>
	 */
	private static function apply_placements( array $ids, array $placements ): array {
		$rows = array();
		foreach ( $ids as $id ) {
			if ( isset( $placements[ $id ] ) ) {
				$rows[] = array(
					'attachment_id' => $id,
					'sr_only'       => false,
					'grid_style'    => $placements[ $id ],
				);
			} else {
				$rows[] = array(
					'attachment_id' => $id,
					'sr_only'       => true,
					'grid_style'    => '',
				);
			}
		}
		return $rows;
	}
}
