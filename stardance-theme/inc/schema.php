<?php
/**
 * JSON-LD structured data — Organization, WebSite, WebPage, Person, Course, Event, Schedule.
 * Emits a single <script type="application/ld+json"> @graph block per page.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ---------------------------------------------------------------------------
// Business constants — single source of truth for all schema entities
// ---------------------------------------------------------------------------

function stardance_business_info(): array {
	return [
		'name'          => 'Star Dance Studio',
		'alternateName' => 'Olga Dance Academy',
		'url'           => home_url( '/' ),
		'description'   => 'Latin American and European Ballroom dance studio in Limassol, Cyprus. Founded in 2007 as Olga Dance Academy — championship-level coaching for all ages, from beginners to competitive dancers.',
		'foundingDate'  => '2007',
		'telephone'     => [ '+35799288918', '+35799301181' ],
		'email'         => 'svetlana@stardance.com.cy',
		'address'       => [
			'@type'           => 'PostalAddress',
			'streetAddress'   => 'Spyrou Kyprianou Ave 48',
			'addressLocality' => 'Limassol',
			'postalCode'      => '4043',
			'addressCountry'  => 'CY',
		],
		'geo'           => [
			'@type'     => 'GeoCoordinates',
			'latitude'  => 34.68755996711985,
			'longitude' => 33.025638825775694,
		],
		'openingHoursSpecification' => [
			[
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => [ 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' ],
				'opens'     => '09:00',
				'closes'    => '20:00',
			],
		],
		'logo'          => [
			'@type' => 'ImageObject',
			'url'   => get_template_directory_uri() . '/assets/images/Logo.svg',
		],
		'image'         => 'http://stardance.com.cy/wp-content/uploads/2026/02/Mask-group.jpg',
		'areaServed'    => [
			[ '@type' => 'City', 'name' => 'Limassol' ],
			[ '@type' => 'Country', 'name' => 'Cyprus' ],
		],
		'sameAs'        => [],
	];
}

// ---------------------------------------------------------------------------
// Core entities (emitted on every page)
// ---------------------------------------------------------------------------

function stardance_schema_organization(): array {
	return array_merge(
		[
			'@type' => [ 'LocalBusiness', 'SportsActivityLocation' ],
			'@id'   => home_url( '/#organization' ),
		],
		stardance_business_info()
	);
}

function stardance_schema_website(): array {
	return [
		'@type'     => 'WebSite',
		'@id'       => home_url( '/#website' ),
		'url'       => home_url( '/' ),
		'name'      => 'Star Dance Studio',
		'publisher' => [ '@id' => home_url( '/#organization' ) ],
		'inLanguage' => [ 'en', 'el', 'ru' ],
	];
}

// ---------------------------------------------------------------------------
// Per-page entities
// ---------------------------------------------------------------------------

/**
 * @param string $type  WebPage | AboutPage | ContactPage | CollectionPage
 * @param string $name  Page title
 * @param string $desc  Page description (optional)
 */
function stardance_schema_webpage( string $type, string $name, string $desc = '' ): array {
	$page = [
		'@type'      => $type,
		'@id'        => get_permalink() . '#webpage',
		'url'        => get_permalink(),
		'name'       => $name,
		'isPartOf'   => [ '@id' => home_url( '/#website' ) ],
		'about'      => [ '@id' => home_url( '/#organization' ) ],
		'inLanguage' => 'en',
	];
	if ( $desc ) {
		$page['description'] = $desc;
	}
	return $page;
}

/**
 * @param array $inner_pages  Array of [name, url] pairs beyond Home
 */
function stardance_schema_breadcrumbs( array $inner_pages ): array {
	$items = [
		[
			'@type'    => 'ListItem',
			'position' => 1,
			'name'     => 'Home',
			'item'     => home_url( '/' ),
		],
	];
	$pos = 2;
	foreach ( $inner_pages as [ $name, $url ] ) {
		$items[] = [
			'@type'    => 'ListItem',
			'position' => $pos++,
			'name'     => $name,
			'item'     => $url,
		];
	}
	return [
		'@type'           => 'BreadcrumbList',
		'itemListElement' => $items,
	];
}

// ---------------------------------------------------------------------------
// Coach → Person
// ---------------------------------------------------------------------------

function stardance_schema_coach( WP_Post $post ): array {
	$person = [
		'@type'    => 'Person',
		'@id'      => home_url( '/about/#coach-' . $post->ID ),
		'name'     => $post->post_title,
		'jobTitle' => 'Dance Instructor',
		'worksFor' => [ '@id' => home_url( '/#organization' ) ],
		'url'      => home_url( '/about/?coach=' . $post->post_name ),
	];

	$bio = wp_strip_all_tags( $post->post_content );
	if ( $bio ) {
		$person['description'] = wp_trim_words( $bio, 60 );
	}

	$img = get_the_post_thumbnail_url( $post, 'large' );
	if ( $img ) {
		$person['image'] = $img;
	}

	return $person;
}

// ---------------------------------------------------------------------------
// Dance class → Course
// ---------------------------------------------------------------------------

function stardance_schema_course( WP_Post $post ): array {
	$course = [
		'@type'       => 'Course',
		'@id'         => get_permalink( $post ) . '#course',
		'name'        => $post->post_title,
		'description' => $post->post_excerpt
			?: wp_trim_words( wp_strip_all_tags( $post->post_content ), 50 ),
		'provider'    => [ '@id' => home_url( '/#organization' ) ],
		'url'         => get_permalink( $post ),
		'courseMode'  => 'onsite',
	];

	$img = get_the_post_thumbnail_url( $post, 'large' );
	if ( $img ) {
		$course['image'] = $img;
	}

	// Build CourseInstance schedule from ACF weekly time fields (if ACF active)
	if ( function_exists( 'get_field' ) ) {
		$day_map = [
			'monday'    => 'Monday',
			'tuesday'   => 'Tuesday',
			'wednesday' => 'Wednesday',
			'thursday'  => 'Thursday',
			'friday'    => 'Friday',
			'saturday'  => 'Saturday',
			'sunday'    => 'Sunday',
		];
		$instances = [];
		foreach ( $day_map as $key => $schema_day ) {
			if ( get_field( $key . '_closed', $post->ID ) ) {
				continue;
			}
			$time_str = get_field( $key . '_time', $post->ID );
			if ( ! $time_str ) {
				continue;
			}
			if ( ! preg_match( '/(\d{1,2}:\d{2})\s*-\s*(\d{1,2}:\d{2})/', $time_str, $tm ) ) {
				continue;
			}
			$instances[] = [
				'@type'      => 'CourseInstance',
				'courseMode' => 'onsite',
				'location'   => [ '@id' => home_url( '/#organization' ) ],
				'schedule'   => [
					'@type'     => 'Schedule',
					'byDay'     => 'https://schema.org/' . $schema_day,
					'startTime' => $tm[1],
					'endTime'   => $tm[2],
					'scheduleTimezone' => 'Asia/Nicosia',
				],
			];
		}
		if ( $instances ) {
			$course['hasCourseInstance'] = $instances;
		}
	}

	return $course;
}

// ---------------------------------------------------------------------------
// Event → Event
// ---------------------------------------------------------------------------

function stardance_schema_parse_event_date( string $raw ): string {
	$raw = trim( $raw );
	if ( '' === $raw ) {
		return '';
	}
	// Accepts: "March 15, 2026" | "May 10-14, 2026" | "May 10, 2026"
	if ( ! preg_match( '/^([A-Za-z]+)\s+(\d{1,2})(?:\s*-\s*\d{1,2})?,?\s*(\d{4})$/', $raw, $m ) ) {
		return '';
	}
	$ts = strtotime( $m[1] . ' ' . $m[2] . ', ' . $m[3] );
	return $ts ? date( 'Y-m-d', $ts ) : '';
}

function stardance_schema_event_post( WP_Post $post ): array {
	$biz = stardance_business_info();

	$location_name = get_post_meta( $post->ID, 'event_location', true ) ?: 'Star Dance Studio';
	$location = [ '@type' => 'Place', 'name' => $location_name ];
	// Attach full address only when the event is at the studio itself
	if ( ! get_post_meta( $post->ID, 'event_location', true ) ) {
		$location['address'] = $biz['address'];
		$location['geo']     = $biz['geo'];
	}

	$event = [
		'@type'                  => 'Event',
		'@id'                    => get_permalink( $post ) . '#event',
		'name'                   => $post->post_title,
		'description'            => $post->post_excerpt
			?: wp_trim_words( wp_strip_all_tags( $post->post_content ), 50 ),
		'url'                    => get_permalink( $post ),
		'organizer'              => [ '@id' => home_url( '/#organization' ) ],
		'location'               => $location,
		'eventStatus'            => 'https://schema.org/EventScheduled',
		'eventAttendanceMode'    => 'https://schema.org/OfflineEventAttendanceMode',
	];

	$iso_date = stardance_schema_parse_event_date(
		get_post_meta( $post->ID, 'event_date', true )
	);
	if ( $iso_date ) {
		$event['startDate'] = $iso_date;
	}

	$img = get_the_post_thumbnail_url( $post, 'large' );
	if ( $img ) {
		$event['image'] = $img;
	}

	return $event;
}

// ---------------------------------------------------------------------------
// Gallery → ImageGallery
// ---------------------------------------------------------------------------

function stardance_schema_gallery(): array {
	$items = get_posts( [
		'post_type'      => 'gallery_item',
		'posts_per_page' => 50,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	] );

	$images = [];
	foreach ( $items as $item ) {
		$src = get_the_post_thumbnail_url( $item, 'large' );
		if ( ! $src ) {
			continue;
		}
		$image_obj = [
			'@type'       => 'ImageObject',
			'url'         => $src,
			'name'        => $item->post_title ?: '',
		];
		if ( $item->post_excerpt ) {
			$image_obj['description'] = $item->post_excerpt;
		}
		$images[] = $image_obj;
	}

	return [
		'@type'           => 'ImageGallery',
		'@id'             => get_permalink() . '#gallery',
		'name'            => 'Star Dance Studio Photo Gallery',
		'url'             => get_permalink(),
		'associatedMedia' => $images,
		'author'          => [ '@id' => home_url( '/#organization' ) ],
	];
}

// ---------------------------------------------------------------------------
// Schedule page → recurring Event entities
// ---------------------------------------------------------------------------

function stardance_schema_schedule_events(): array {
	require get_template_directory() . '/inc/schedule-data.php';

	$day_schema_map = [
		'Mon' => 'Monday',
		'Tue' => 'Tuesday',
		'Wed' => 'Wednesday',
		'Thu' => 'Thursday',
		'Fri' => 'Friday',
		'Sat' => 'Saturday',
		'Sun' => 'Sunday',
	];

	$events = [];
	foreach ( $schedule_days as $day_data ) {
		if ( ! empty( $day_data['closed'] ) || empty( $day_data['sessions'] ) ) {
			continue;
		}
		$schema_day = $day_schema_map[ $day_data['label'] ] ?? null;
		if ( ! $schema_day ) {
			continue;
		}
		foreach ( $day_data['sessions'] as $session ) {
			$entry = [
				'@type'               => 'Event',
				'name'                => $session['title'],
				'eventStatus'         => 'https://schema.org/EventScheduled',
				'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
				'organizer'           => [ '@id' => home_url( '/#organization' ) ],
				'location'            => [ '@id' => home_url( '/#organization' ) ],
			];
			if ( ! empty( $session['meta'] ) ) {
				$entry['description'] = $session['meta'];
			}
			if ( ! empty( $session['time'] ) &&
				preg_match( '/(\d{1,2}:\d{2})\s*-\s*(\d{1,2}:\d{2})/', $session['time'], $tm ) ) {
				$entry['eventSchedule'] = [
					'@type'            => 'Schedule',
					'byDay'            => 'https://schema.org/' . $schema_day,
					'startTime'        => $tm[1],
					'endTime'          => $tm[2],
					'scheduleTimezone' => 'Asia/Nicosia',
					'repeatFrequency'  => 'P1W',
				];
			}
			$events[] = $entry;
		}
	}

	return $events;
}

// ---------------------------------------------------------------------------
// Main renderer — builds @graph and outputs the script block
// ---------------------------------------------------------------------------

function stardance_render_schema(): void {
	$org   = stardance_schema_organization();
	$web   = stardance_schema_website();
	$graph = [ $org, $web ];

	if ( is_front_page() ) {

		$graph[] = stardance_schema_webpage(
			'WebPage',
			'Latin & Ballroom Dance Classes in Limassol | Star Dance Studio',
			'Latin American & European Ballroom dance classes in Limassol. Train with championship-level coaches at Star Dance Studio — all levels welcome.'
		);

	} elseif ( is_page( 'about' ) ) {

		$graph[] = stardance_schema_breadcrumbs( [
			[ 'About', get_permalink() ],
		] );
		$graph[] = stardance_schema_webpage(
			'AboutPage',
			'About Star Dance Studio | Ballroom & Latin Dance in Limassol',
			'Meet the championship-trained coaches behind Star Dance Studio Limassol.'
		);
		$coaches = get_posts( [
			'post_type'      => 'coach',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		] );
		foreach ( $coaches as $coach ) {
			$graph[] = stardance_schema_coach( $coach );
		}

	} elseif ( is_page( 'classes' ) ) {

		$graph[] = stardance_schema_breadcrumbs( [
			[ 'Classes', get_permalink() ],
		] );
		$graph[] = stardance_schema_webpage(
			'CollectionPage',
			'Dance Classes in Limassol | Latin & Ballroom | Star Dance Studio',
			'Explore Star Dance Studio\'s Latin American & European Ballroom classes in Limassol — all levels, group and private.'
		);
		$classes = get_posts( [
			'post_type'      => 'dance_class',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		] );
		$list_items = [];
		$pos = 1;
		foreach ( $classes as $class ) {
			$course    = stardance_schema_course( $class );
			$graph[]   = $course;
			$list_items[] = [
				'@type'    => 'ListItem',
				'position' => $pos++,
				'item'     => [ '@id' => $course['@id'] ],
			];
		}
		if ( $list_items ) {
			$graph[] = [
				'@type'           => 'ItemList',
				'name'            => 'Dance Classes at Star Dance Studio',
				'itemListElement' => $list_items,
			];
		}

	} elseif ( is_page( 'schedule' ) ) {

		$graph[] = stardance_schema_breadcrumbs( [
			[ 'Schedule', get_permalink() ],
		] );
		$graph[] = stardance_schema_webpage(
			'WebPage',
			'Class Schedule | Star Dance Studio Limassol',
			'Weekly timetable for Latin & Ballroom dance classes at Star Dance Studio Limassol.'
		);
		foreach ( stardance_schema_schedule_events() as $evt ) {
			$graph[] = $evt;
		}

	} elseif ( is_page( 'gallery' ) ) {

		$graph[] = stardance_schema_breadcrumbs( [
			[ 'Gallery', get_permalink() ],
		] );
		$graph[] = stardance_schema_webpage(
			'CollectionPage',
			'Gallery | Star Dance Studio Limassol',
			'Photos from Star Dance Studio Limassol — competition performances, championship wins, and classes.'
		);
		$graph[] = stardance_schema_gallery();

	} elseif ( is_page( 'events' ) ) {

		$graph[] = stardance_schema_breadcrumbs( [
			[ 'Events', get_permalink() ],
		] );
		$graph[] = stardance_schema_webpage(
			'CollectionPage',
			'Events & Competitions | Star Dance Studio Limassol',
			'Upcoming dance competitions, showcases, and events from Star Dance Studio Limassol.'
		);
		$events = get_posts( [
			'post_type'      => 'sd_event',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order',
			'order'          => 'DESC',
		] );
		$list_items = [];
		$pos = 1;
		foreach ( $events as $evt ) {
			$event_schema = stardance_schema_event_post( $evt );
			$graph[]      = $event_schema;
			$list_items[] = [
				'@type'    => 'ListItem',
				'position' => $pos++,
				'item'     => [ '@id' => $event_schema['@id'] ],
			];
		}
		if ( $list_items ) {
			$graph[] = [
				'@type'           => 'ItemList',
				'name'            => 'Events at Star Dance Studio',
				'itemListElement' => $list_items,
			];
		}

	} elseif ( is_page( 'contact' ) ) {

		$graph[] = stardance_schema_breadcrumbs( [
			[ 'Contact', get_permalink() ],
		] );
		$graph[] = stardance_schema_webpage(
			'ContactPage',
			'Contact Star Dance Studio | Limassol Dance Classes',
			'Get in touch with Star Dance Studio in Limassol. Book a trial or ask about Latin & Ballroom classes.'
		);

	} elseif ( is_singular( 'dance_class' ) ) {

		global $post;
		$classes_url = get_post_type_archive_link( 'dance_class' ) ?: home_url( '/classes/' );
		$graph[] = stardance_schema_breadcrumbs( [
			[ 'Classes', $classes_url ],
			[ get_the_title(), get_permalink() ],
		] );
		$course  = stardance_schema_course( $post );
		$graph[] = stardance_schema_webpage(
			'WebPage',
			get_the_title() . ' Classes in Limassol | Star Dance Studio',
			$post->post_excerpt ?: ''
		);
		$graph[] = $course;

	} elseif ( is_singular( 'sd_event' ) ) {

		global $post;
		$events_url = get_post_type_archive_link( 'sd_event' ) ?: home_url( '/events/' );
		$graph[] = stardance_schema_breadcrumbs( [
			[ 'Events', $events_url ],
			[ get_the_title(), get_permalink() ],
		] );
		$graph[] = stardance_schema_webpage(
			'WebPage',
			get_the_title() . ' | Star Dance Studio Limassol',
			$post->post_excerpt ?: ''
		);
		$graph[] = stardance_schema_event_post( $post );

	}

	echo '<script type="application/ld+json">' . "\n";
	echo wp_json_encode(
		[ '@context' => 'https://schema.org', '@graph' => $graph ],
		JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
	);
	echo "\n" . '</script>' . "\n";
}

add_action( 'wp_head', 'stardance_render_schema', 5 );
