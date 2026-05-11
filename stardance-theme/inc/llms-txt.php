<?php
/**
 * llms.txt — structured plain-text summary for AI language models.
 *
 * Spec: https://llmstxt.org
 *
 * Two delivery mechanisms:
 *   1. Physical file written to ABSPATH on theme activation (served directly
 *      by the web server — fast, cache-friendly).
 *   2. Virtual endpoint via template_redirect as a fallback when the file
 *      cannot be written (e.g. restricted filesystem permissions).
 *
 * To manually regenerate the file after content changes, visit:
 *   /wp-admin/admin-post.php?action=stardance_regen_llms_txt&_wpnonce=…
 * or just re-activate the theme.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ---------------------------------------------------------------------------
// Content generator
// ---------------------------------------------------------------------------

function stardance_llms_txt_content(): string {
	$home = rtrim( home_url( '/' ), '/' );

	return <<<TXT
# Star Dance Studio

> Professional Latin American and European Ballroom dance studio in Limassol, Cyprus.
> Founded in 2007 (as Olga Dance Academy) and rebranded as Star Dance Studio in 2026.
> Championship-level coaching for all ages — from young beginners to competitive athletes.

Star Dance Studio is a serious competitive dance training centre affiliated with the
Cyprus Federation of Social & Sport Dance. The studio has produced dancers who compete
at national and international level. Coaching specialisms include Latin American dances
(Cha-Cha, Samba, Rumba, Paso Doble, Jive), European Ballroom / Standard dances
(Waltz, Tango, Viennese Waltz, Foxtrot, Quickstep), Classical Choreography, Body Ballet,
Latin Fusion, and Physical Conditioning.

Classes are held Monday–Saturday at the studio premises in Limassol (Spyrou Kyprianou
Ave 48, Limassol 4043, Cyprus). Private lessons, group classes, and competition
preparation are all available.

## Studio

- [Home]($home/): Studio overview, featured classes, timetable, and contact details.
- [About]($home/about/): Studio history, coaching team, championship background, and the Cyprus Federation of Social & Sport Dance affiliation.
- [Contact]($home/contact/): Location map, phone numbers (+357 99 288 918 / +357 99 301 181), email (svetlana@stardance.com.cy), and enquiry form.

## Classes & Schedule

- [Dance Classes]($home/classes/): Full catalogue of disciplines — Latin American, European Ballroom, Classical Choreography, Body Ballet, Latin Fusion, Physical Conditioning, Baby Dance (age 4–5), Kids Dance (age 6–7), Individual Lessons.
- [Class Timetable]($home/schedule/): Weekly schedule — group classes run Mon–Fri from 16:30; individual lessons on Saturday 09:00–19:00.

## Competitions & Events

- [Events & Competitions]($home/events/): Upcoming and past dance competitions, showcases, and championship events in which the studio participates.

## Optional

- [Gallery]($home/gallery/): Photos from competitions, championship performances, studio classes, and showcases.

TXT;
}

// ---------------------------------------------------------------------------
// File writer — places llms.txt at the WordPress installation root
// ---------------------------------------------------------------------------

function stardance_write_llms_txt(): bool {
	$path    = ABSPATH . 'llms.txt';
	$content = stardance_llms_txt_content();
	// phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_file_put_contents
	$result  = file_put_contents( $path, $content );
	return $result !== false;
}

// Write on theme activation
add_action( 'after_switch_theme', 'stardance_write_llms_txt' );

// ---------------------------------------------------------------------------
// Admin: manual regeneration action (admin-only, nonce-protected)
// ---------------------------------------------------------------------------

add_action( 'admin_post_stardance_regen_llms_txt', function () {
	check_admin_referer( 'stardance_regen_llms_txt' );
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Insufficient permissions.' );
	}
	$ok = stardance_write_llms_txt();
	$redirect = add_query_arg(
		'stardance_llms_status',
		$ok ? 'success' : 'error',
		wp_get_referer() ?: admin_url()
	);
	wp_safe_redirect( $redirect );
	exit;
} );

// Show result notice in admin
add_action( 'admin_notices', function () {
	if ( ! isset( $_GET['stardance_llms_status'] ) ) return;
	if ( $_GET['stardance_llms_status'] === 'success' ) {
		echo '<div class="notice notice-success is-dismissible"><p><strong>llms.txt</strong> regenerated successfully.</p></div>';
	} else {
		echo '<div class="notice notice-error is-dismissible"><p><strong>llms.txt</strong> could not be written — check filesystem permissions on the WordPress root.</p></div>';
	}
} );

// ---------------------------------------------------------------------------
// Virtual fallback — serves llms.txt dynamically if the physical file is absent
// ---------------------------------------------------------------------------

add_action( 'template_redirect', function () {
	// Normalise the URI (strip query string)
	$uri = strtok( $_SERVER['REQUEST_URI'] ?? '', '?' );
	if ( $uri !== '/llms.txt' ) {
		return;
	}
	// Physical file already exists — web server handles it; no need to intervene
	if ( file_exists( ABSPATH . 'llms.txt' ) ) {
		return;
	}
	header( 'Content-Type: text/plain; charset=UTF-8' );
	header( 'Cache-Control: public, max-age=86400' );
	echo stardance_llms_txt_content();
	exit;
} );
