<?php
/**
 * SEO meta tags — title, description, canonical, Open Graph, Twitter Card.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Returns ['title' => string, 'description' => string] for the current page.
 */
function stardance_get_meta(): array {
	$fallback_title = 'Star Dance Studio | Ballroom & Latin Dance in Limassol';
	$fallback_desc  = 'Latin American & European Ballroom dance classes in Limassol with championship-level coaches.';

	if ( is_front_page() ) {
		return [
			'title'       => 'Latin & Ballroom Dance Classes in Limassol | Star Dance Studio',
			'description' => 'Latin American & European Ballroom dance classes in Limassol. Train with championship-level coaches at Star Dance Studio — all levels welcome.',
		];
	}

	if ( is_page( 'about' ) ) {
		return [
			'title'       => 'About Star Dance Studio | Ballroom & Latin Dance in Limassol',
			'description' => 'Meet the championship-trained coaches behind Star Dance Studio Limassol — international competition experience in Latin American & European Ballroom dance.',
		];
	}

	if ( is_page( 'classes' ) ) {
		return [
			'title'       => 'Dance Classes in Limassol | Latin & Ballroom | Star Dance Studio',
			'description' => 'Explore Star Dance Studio\'s Latin American & European Ballroom classes in Limassol — Salsa, Cha-Cha, Waltz, Tango and more. All levels, group and private.',
		];
	}

	if ( is_page( 'schedule' ) ) {
		return [
			'title'       => 'Class Schedule | Star Dance Studio Limassol',
			'description' => 'Weekly timetable for Latin & Ballroom dance classes at Star Dance Studio Limassol. Find a session that fits — all levels, group and private lessons.',
		];
	}

	if ( is_page( 'gallery' ) ) {
		return [
			'title'       => 'Gallery | Star Dance Studio Limassol',
			'description' => 'Photos from Star Dance Studio Limassol — competition performances, championship wins, classes, and showcases in Latin & European Ballroom dance.',
		];
	}

	if ( is_page( 'events' ) ) {
		return [
			'title'       => 'Events & Competitions | Star Dance Studio Limassol',
			'description' => 'Upcoming dance competitions, showcases, and events from Star Dance Studio Limassol — Latin American & European Ballroom championships and performances.',
		];
	}

	if ( is_page( 'contact' ) ) {
		return [
			'title'       => 'Contact Star Dance Studio | Limassol Dance Classes',
			'description' => 'Get in touch with Star Dance Studio in Limassol. Book a trial, ask about Latin & Ballroom classes, or schedule a private lesson — we\'d love to hear from you.',
		];
	}

	if ( is_singular( 'dance_class' ) ) {
		$class_name = get_the_title();
		$excerpt    = get_the_excerpt();
		return [
			'title'       => $class_name . ' Classes in Limassol | Star Dance Studio',
			'description' => $excerpt ?: 'Learn ' . $class_name . ' at Star Dance Studio in Limassol — Latin & Ballroom dance lessons with championship-level coaches.',
		];
	}

	if ( is_singular( 'sd_event' ) ) {
		$event_title = get_the_title();
		$excerpt     = get_the_excerpt();
		return [
			'title'       => $event_title . ' | Star Dance Studio Limassol',
			'description' => $excerpt ?: $event_title . ' — dance competition or showcase from Star Dance Studio Limassol.',
		];
	}

	return [
		'title'       => $fallback_title,
		'description' => $fallback_desc,
	];
}

/**
 * Override the <title> tag.
 */
add_filter( 'pre_get_document_title', function () {
	return stardance_get_meta()['title'];
} );

/**
 * Emit description, canonical, Open Graph, and Twitter Card tags.
 */
add_action( 'wp_head', function () {
	$meta        = stardance_get_meta();
	$title       = esc_attr( $meta['title'] );
	$description = esc_attr( $meta['description'] );

	$canonical = esc_url( ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );

	// OG image: featured image → fallback brand image
	$og_image = '';
	if ( is_singular() && has_post_thumbnail() ) {
		$og_image = esc_url( get_the_post_thumbnail_url( null, 'large' ) );
	}
	if ( ! $og_image ) {
		$og_image = 'http://stardance.com.cy/wp-content/uploads/2026/02/Mask-group.jpg';
	}

	$og_type = is_singular() ? 'article' : 'website';

	echo "\n";
	echo '<meta name="description" content="' . $description . '">' . "\n";
	echo '<link rel="canonical" href="' . $canonical . '">' . "\n";
	echo '<meta property="og:type" content="' . esc_attr( $og_type ) . '">' . "\n";
	echo '<meta property="og:title" content="' . $title . '">' . "\n";
	echo '<meta property="og:description" content="' . $description . '">' . "\n";
	echo '<meta property="og:url" content="' . $canonical . '">' . "\n";
	echo '<meta property="og:image" content="' . $og_image . '">' . "\n";
	echo '<meta property="og:site_name" content="Star Dance Studio">' . "\n";
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	echo '<meta name="twitter:title" content="' . $title . '">' . "\n";
	echo '<meta name="twitter:description" content="' . $description . '">' . "\n";
	echo '<meta name="twitter:image" content="' . $og_image . '">' . "\n";
	echo "\n";
}, 1 );

/**
 * Google Analytics 4 — async, with preconnect hint to avoid connection overhead.
 * Priority 2 keeps it just after the meta block but well before wp_head closes.
 */
add_action( 'wp_head', function () {
	echo '<link rel="preconnect" href="https://www.googletagmanager.com">' . "\n";
	echo '<script async src="https://www.googletagmanager.com/gtag/js?id=G-0BQYPLVBTL"></script>' . "\n";
	echo '<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag("js",new Date());gtag("config","G-0BQYPLVBTL");</script>' . "\n";
}, 2 );
