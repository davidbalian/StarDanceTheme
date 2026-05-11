<?php
/**
 * XML Sitemap — sitemap_index.xml + per-type sub-sitemaps with image extension.
 *
 * Endpoints:
 *   /sitemap_index.xml         — index of all sub-sitemaps
 *   /sitemap-pages.xml         — static pages
 *   /sitemap-dance_class.xml   — individual dance class pages
 *   /sitemap-sd_event.xml      — individual event pages
 *
 * Delivery: virtual (template_redirect) with optional physical file writer.
 * WP's built-in /wp-sitemap.xml is disabled to avoid duplication.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Disable WP's built-in sitemap — we replace it entirely
add_filter( 'wp_sitemaps_enabled', '__return_false' );

// Append our sitemap to the virtual robots.txt
add_filter( 'robots_txt', function ( string $output ): string {
	return $output . "\nSitemap: " . home_url( '/sitemap_index.xml' ) . "\n";
} );

// ---------------------------------------------------------------------------
// Helpers
// ---------------------------------------------------------------------------

function stardance_sitemap_xsl_url(): string {
	return get_template_directory_uri() . '/assets/sitemap.xsl';
}

function stardance_sitemap_esc( string $str ): string {
	return htmlspecialchars( $str, ENT_XML1 | ENT_QUOTES, 'UTF-8' );
}

function stardance_sitemap_xml_pi(): string {
	$xsl = stardance_sitemap_xsl_url();
	return '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
		. '<?xml-stylesheet type="text/xsl" href="' . $xsl . '"?>' . "\n";
}

/**
 * Returns the most-recent post_modified date across a CPT (Y-m-d).
 */
function stardance_sitemap_cpt_lastmod( string $post_type ): string {
	$posts = get_posts( [
		'post_type'      => $post_type,
		'posts_per_page' => 1,
		'orderby'        => 'modified',
		'order'          => 'DESC',
		'post_status'    => 'publish',
	] );
	return $posts ? date( 'Y-m-d', strtotime( $posts[0]->post_modified ) ) : date( 'Y-m-d' );
}

/**
 * Builds a single <url> block with optional <image:image> children.
 *
 * @param string   $loc
 * @param string   $lastmod   Y-m-d
 * @param string   $changefreq
 * @param float    $priority
 * @param array[]  $images    Each: ['loc' => string, 'title' => string]
 */
function stardance_sitemap_url_entry(
	string $loc,
	string $lastmod,
	string $changefreq,
	float $priority,
	array $images = []
): string {
	$xml  = "  <url>\n";
	$xml .= '    <loc>' . stardance_sitemap_esc( $loc ) . "</loc>\n";
	$xml .= '    <lastmod>' . stardance_sitemap_esc( $lastmod ) . "</lastmod>\n";
	$xml .= '    <changefreq>' . stardance_sitemap_esc( $changefreq ) . "</changefreq>\n";
	$xml .= '    <priority>' . number_format( $priority, 1 ) . "</priority>\n";
	foreach ( $images as $img ) {
		$xml .= "    <image:image>\n";
		$xml .= '      <image:loc>' . stardance_sitemap_esc( $img['loc'] ) . "</image:loc>\n";
		if ( ! empty( $img['title'] ) ) {
			$xml .= '      <image:title>' . stardance_sitemap_esc( $img['title'] ) . "</image:title>\n";
		}
		$xml .= "    </image:image>\n";
	}
	$xml .= "  </url>\n";
	return $xml;
}

// ---------------------------------------------------------------------------
// Sitemap index
// ---------------------------------------------------------------------------

function stardance_sitemap_index_xml(): string {
	$home = home_url( '/' );

	$sub_sitemaps = [
		[ 'file' => 'sitemap-pages.xml',      'lastmod' => stardance_sitemap_pages_lastmod() ],
		[ 'file' => 'sitemap-dance_class.xml', 'lastmod' => stardance_sitemap_cpt_lastmod( 'dance_class' ) ],
		[ 'file' => 'sitemap-sd_event.xml',   'lastmod' => stardance_sitemap_cpt_lastmod( 'sd_event' ) ],
	];

	$xml  = stardance_sitemap_xml_pi();
	$xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
	foreach ( $sub_sitemaps as $s ) {
		$xml .= "  <sitemap>\n";
		$xml .= '    <loc>' . stardance_sitemap_esc( $home . $s['file'] ) . "</loc>\n";
		$xml .= '    <lastmod>' . stardance_sitemap_esc( $s['lastmod'] ) . "</lastmod>\n";
		$xml .= "  </sitemap>\n";
	}
	$xml .= '</sitemapindex>';
	return $xml;
}

// ---------------------------------------------------------------------------
// Pages sitemap
// ---------------------------------------------------------------------------

function stardance_sitemap_pages_lastmod(): string {
	// Use the most recently modified WP page among the ones we list
	$pages = get_posts( [
		'post_type'      => 'page',
		'posts_per_page' => 1,
		'orderby'        => 'modified',
		'order'          => 'DESC',
		'post_status'    => 'publish',
	] );
	return $pages ? date( 'Y-m-d', strtotime( $pages[0]->post_modified ) ) : date( 'Y-m-d' );
}

function stardance_sitemap_pages_xml(): string {
	$biz = stardance_business_info();

	$page_configs = [
		[
			'url'        => home_url( '/' ),
			'slug'       => null,
			'priority'   => 1.0,
			'changefreq' => 'weekly',
			'images'     => [ [ 'loc' => $biz['image'], 'title' => 'Star Dance Studio — Latin & Ballroom Dance in Limassol' ] ],
		],
		[ 'url' => home_url( '/about/' ),    'slug' => 'about',    'priority' => 0.7, 'changefreq' => 'monthly' ],
		[ 'url' => home_url( '/classes/' ),  'slug' => 'classes',  'priority' => 0.9, 'changefreq' => 'weekly' ],
		[ 'url' => home_url( '/schedule/' ), 'slug' => 'schedule', 'priority' => 0.9, 'changefreq' => 'weekly' ],
		[ 'url' => home_url( '/events/' ),   'slug' => 'events',   'priority' => 0.9, 'changefreq' => 'weekly' ],
		[ 'url' => home_url( '/gallery/' ),  'slug' => 'gallery',  'priority' => 0.6, 'changefreq' => 'monthly' ],
		[ 'url' => home_url( '/contact/' ),  'slug' => 'contact',  'priority' => 0.7, 'changefreq' => 'monthly' ],
	];

	$xml  = stardance_sitemap_xml_pi();
	$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
	$xml .= '        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

	foreach ( $page_configs as $cfg ) {
		$page_obj = null;
		if ( $cfg['slug'] ) {
			$page_obj = get_page_by_path( $cfg['slug'] );
		}

		$lastmod = $page_obj
			? date( 'Y-m-d', strtotime( $page_obj->post_modified ) )
			: date( 'Y-m-d' );

		// Build images list
		$images = $cfg['images'] ?? [];

		if ( empty( $images ) && $cfg['slug'] === 'gallery' ) {
			// Gallery: pull every gallery_item's featured image
			$items = get_posts( [
				'post_type'      => 'gallery_item',
				'posts_per_page' => 100,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'post_status'    => 'publish',
			] );
			foreach ( $items as $item ) {
				$img = get_the_post_thumbnail_url( $item, 'full' );
				if ( $img ) {
					$images[] = [ 'loc' => $img, 'title' => $item->post_title ];
				}
			}
		} elseif ( empty( $images ) && $page_obj ) {
			$thumb = get_the_post_thumbnail_url( $page_obj, 'full' );
			if ( $thumb ) {
				$images[] = [ 'loc' => $thumb, 'title' => $page_obj->post_title ];
			}
		}

		$xml .= stardance_sitemap_url_entry( $cfg['url'], $lastmod, $cfg['changefreq'], $cfg['priority'], $images );
	}

	$xml .= '</urlset>';
	return $xml;
}

// ---------------------------------------------------------------------------
// CPT sitemaps (dance_class, sd_event)
// ---------------------------------------------------------------------------

function stardance_sitemap_cpt_xml( string $post_type ): string {
	$configs = [
		'dance_class' => [ 'priority' => 0.8, 'changefreq' => 'monthly' ],
		'sd_event'    => [ 'priority' => 0.7, 'changefreq' => 'monthly' ],
	];
	$cfg = $configs[ $post_type ] ?? [ 'priority' => 0.6, 'changefreq' => 'monthly' ];

	$posts = get_posts( [
		'post_type'      => $post_type,
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	] );

	$xml  = stardance_sitemap_xml_pi();
	$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
	$xml .= '        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

	foreach ( $posts as $post ) {
		$images = [];
		$thumb  = get_the_post_thumbnail_url( $post, 'full' );
		if ( $thumb ) {
			$images[] = [ 'loc' => $thumb, 'title' => $post->post_title ];
		}
		$xml .= stardance_sitemap_url_entry(
			get_permalink( $post ),
			date( 'Y-m-d', strtotime( $post->post_modified ) ),
			$cfg['changefreq'],
			$cfg['priority'],
			$images
		);
	}

	$xml .= '</urlset>';
	return $xml;
}

// ---------------------------------------------------------------------------
// Virtual endpoint router
// ---------------------------------------------------------------------------

add_action( 'template_redirect', function () {
	$uri = strtok( $_SERVER['REQUEST_URI'] ?? '', '?' );

	$routes = [
		'/sitemap_index.xml'       => 'index',
		'/sitemap-pages.xml'       => 'pages',
		'/sitemap-dance_class.xml' => 'dance_class',
		'/sitemap-sd_event.xml'    => 'sd_event',
	];

	if ( ! array_key_exists( $uri, $routes ) ) {
		return;
	}

	// Physical file present? Let the web server serve it
	if ( file_exists( ABSPATH . ltrim( $uri, '/' ) ) ) {
		return;
	}

	header( 'Content-Type: application/xml; charset=UTF-8' );
	header( 'Cache-Control: public, max-age=3600' );

	switch ( $routes[ $uri ] ) {
		case 'index':
			echo stardance_sitemap_index_xml();
			break;
		case 'pages':
			echo stardance_sitemap_pages_xml();
			break;
		default:
			echo stardance_sitemap_cpt_xml( $routes[ $uri ] );
			break;
	}
	exit;
}, 1 );

// ---------------------------------------------------------------------------
// Physical file writer
// ---------------------------------------------------------------------------

function stardance_write_sitemap_files(): bool {
	$files = [
		'sitemap_index.xml'       => stardance_sitemap_index_xml(),
		'sitemap-pages.xml'       => stardance_sitemap_pages_xml(),
		'sitemap-dance_class.xml' => stardance_sitemap_cpt_xml( 'dance_class' ),
		'sitemap-sd_event.xml'    => stardance_sitemap_cpt_xml( 'sd_event' ),
	];
	$ok = true;
	foreach ( $files as $filename => $content ) {
		// phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_file_put_contents
		if ( file_put_contents( ABSPATH . $filename, $content ) === false ) {
			$ok = false;
		}
	}
	return $ok;
}

// Write physical files on theme activation
add_action( 'after_switch_theme', 'stardance_write_sitemap_files' );

// ---------------------------------------------------------------------------
// Admin: manual regeneration action
// ---------------------------------------------------------------------------

add_action( 'admin_post_stardance_regen_sitemap', function () {
	check_admin_referer( 'stardance_regen_sitemap' );
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Insufficient permissions.' );
	}
	$ok = stardance_write_sitemap_files();
	$redirect = add_query_arg(
		'stardance_sitemap_status',
		$ok ? 'success' : 'error',
		wp_get_referer() ?: admin_url()
	);
	wp_safe_redirect( $redirect );
	exit;
} );

add_action( 'admin_notices', function () {
	if ( ! isset( $_GET['stardance_sitemap_status'] ) ) {
		return;
	}
	if ( $_GET['stardance_sitemap_status'] === 'success' ) {
		echo '<div class="notice notice-success is-dismissible"><p><strong>Sitemap files</strong> regenerated successfully.</p></div>';
	} else {
		echo '<div class="notice notice-error is-dismissible"><p><strong>Sitemap files</strong> could not be written — check filesystem permissions on the WordPress root.</p></div>';
	}
} );
