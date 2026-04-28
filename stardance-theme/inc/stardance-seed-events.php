<?php
/**
 * Sample sd_event posts for local / template development.
 *
 * @package stardance
 */

/**
 * Reuse or sideload a remote image; stores URL in attachment meta for deduplication.
 *
 * @param int    $parent_post_id Parent post ID.
 * @param string $image_url      Remote URL.
 * @param string $title          Attachment title.
 * @return int Attachment ID or 0.
 */
function stardance_get_or_sideload_attachment_id( int $parent_post_id, string $image_url, string $title = '' ): int {
    if ( $parent_post_id < 1 || '' === $image_url ) {
        return 0;
    }

    $url_key = esc_url_raw( $image_url );
    $existing = get_posts(
        array(
            'post_type'      => 'attachment',
            'post_status'    => 'inherit',
            'posts_per_page' => 1,
            'fields'         => 'ids',
            'meta_query'     => array(
                array(
                    'key'   => '_stardance_source_url',
                    'value' => $url_key,
                ),
            ),
        )
    );

    if ( ! empty( $existing ) ) {
        return (int) $existing[0];
    }

    if ( ! function_exists( 'media_sideload_image' ) ) {
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
    }

    $attachment_id = media_sideload_image(
        $image_url,
        $parent_post_id,
        $title ? $title : get_the_title( $parent_post_id ),
        'id'
    );

    if ( is_wp_error( $attachment_id ) ) {
        return 0;
    }

    $attachment_id = (int) $attachment_id;
    update_post_meta( $attachment_id, '_stardance_source_url', $url_key );

    return $attachment_id;
}

/**
 * Create or update seeded competition events with full meta, schedule rows, and gallery IDs.
 *
 * @return void
 */
function stardance_seed_sample_events(): void {
    $base_img = 'https://stardance.com.cy/wp-content/uploads/2026/03/';
    $contact  = function_exists( 'stardance_page_or_path_url' )
        ? stardance_page_or_path_url( 'contact' )
        : home_url( '/contact/' );

    $seed_events = array(
        array(
            'title'            => 'Cyprus National Dance Championship - Spring',
            'slug'             => 'cyprus-national-dance-championship-1',
            'excerpt'          => 'National championship weekend: qualifications, finals, and awards. Open age categories from Juvenile to Senior.',
            'content'          => '<p>Join competitors from across Cyprus for our flagship national event. The weekend includes scrutineering, warm-up floors, and live music for standard and Latin rounds.</p><p>Registration closes one week before the event. Spectator tickets are available at the door.</p>',
            'image_url'        => $base_img . 'seed-events-1.webp',
            'event_date'       => 'March 14-15, 2026',
            'event_location'   => 'Nicosia Municipal Theatre, Cyprus',
            'event_link'       => $contact,
            'event_schedule_notes' => '<p><em>Dummy note:</em> Parking is limited - arrive early or use shuttle from city centre.</p>',
            'year'             => array( '2026' ),
            'category'         => array( 'Cyprus National Competitions' ),
            'type'             => array( 'Championships' ),
            'style'            => array( 'Couples', 'Solo' ),
            'menu_order'       => 1,
            'schedule_entries' => array(
                array(
                    'day'      => 'Fri',
                    'title'    => 'Day No. 1 - Registration & scrutineering',
                    'time'     => '16:00 - 20:00',
                    'location' => 'Main hall - Desk A',
                ),
                array(
                    'day'      => 'Sat',
                    'title'    => 'Day No. 2 - Latin rounds',
                    'time'     => '09:00 - 19:00',
                    'location' => 'Competition floor',
                ),
                array(
                    'day'      => 'Sun',
                    'title'    => 'Day No. 3 - Standard & finals',
                    'time'     => '10:00 - 22:00',
                    'location' => 'Main arena',
                ),
            ),
            'gallery_indices'  => array( 1, 2, 3 ),
        ),
        array(
            'title'            => 'WDSF Open - Limassol',
            'slug'             => 'cyprus-national-dance-championship-2',
            'excerpt'          => 'International ranking event with WDSF adjudication. Ideal for couples chasing world ranking points.',
            'content'          => '<p>This open championship follows WDSF rules and dress code. Events include Rising Stars and Professional categories.</p><p>Official hotel blocks and practice slots are published two months in advance.</p>',
            'image_url'        => $base_img . 'seed-events-2.webp',
            'event_date'       => 'April 5-6, 2026',
            'event_location'   => 'Limassol Sports Arena',
            'event_link'       => 'https://www.worlddancesport.org/',
            'event_schedule_notes' => '',
            'year'             => array( '2026' ),
            'category'         => array( 'WDSF International Competitions' ),
            'type'             => array( 'Championships' ),
            'style'            => array( 'Couples' ),
            'menu_order'       => 2,
            'schedule_entries' => array(
                array(
                    'day'      => 'Sat',
                    'title'    => 'Day No. 1 - WDSF Youth & Adult prelims',
                    'time'     => '08:30 - 18:00',
                    'location' => 'Hall B',
                ),
                array(
                    'day'      => 'Sun',
                    'title'    => 'Day No. 2 - Semis & finals',
                    'time'     => '09:00 - 21:30',
                    'location' => 'Main floor',
                ),
            ),
            'gallery_indices'  => array( 4, 5, 6 ),
        ),
        array(
            'title'            => 'Cyprus Cup - Classification',
            'slug'             => 'cyprus-national-dance-championship-3',
            'excerpt'          => 'Classification tournament for school and amateur couples. Medals per level and age group.',
            'content'          => '<p>The Cyprus Cup is designed for couples working through national classification levels. Coaches may accompany athletes in the warm-up area.</p><p>Music and tempo follow CDSF guidelines.</p>',
            'image_url'        => $base_img . 'seed-events-3.webp',
            'event_date'       => 'May 10, 2026',
            'event_location'   => 'Larnaca Event Centre',
            'event_link'       => $contact,
            'event_schedule_notes' => '',
            'year'             => array( '2026' ),
            'category'         => array( 'Cyprus Cup' ),
            'type'             => array( 'Cyprus Cup' ),
            'style'            => array( 'Solo', 'Couples' ),
            'menu_order'       => 3,
            'schedule_entries' => array(
                array(
                    'day'      => 'Sun',
                    'title'    => 'Full day - All levels',
                    'time'     => '08:00 - 20:00',
                    'location' => 'Halls 1-3',
                ),
            ),
            'gallery_indices'  => array( 7, 8, 9 ),
        ),
        array(
            'title'            => 'Star Dance Winter Showcase',
            'slug'             => 'cyprus-national-dance-championship-4',
            'excerpt'          => 'Gala evening: show dances, pro exhibitions, and student highlights from our studio programmes.',
            'content'          => '<p>Our annual showcase celebrates students and professionals in a theatre setting. Acts include formation teams, solo showcases, and invited guest artists.</p><p>Reserved seating; programme includes one interval.</p>',
            'image_url'        => $base_img . 'seed-events-4.webp',
            'event_date'       => 'February 21, 2026',
            'event_location'   => 'Limassol Patichion Theatre',
            'event_link'       => $contact,
            'event_schedule_notes' => '<p>Doors open 18:30. Show starts 19:30.</p>',
            'year'             => array( '2026' ),
            'category'         => array( 'Performances' ),
            'type'             => array( 'Championships' ),
            'style'            => array( 'Show Dances', 'Couples' ),
            'menu_order'       => 4,
            'schedule_entries' => array(
                array(
                    'day'      => 'Fri',
                    'title'    => 'Tech rehearsal - invited acts',
                    'time'     => '17:00 - 22:00',
                    'location' => 'Stage & wings',
                ),
                array(
                    'day'      => 'Sat',
                    'title'    => 'Gala performance',
                    'time'     => '19:30 - 22:00',
                    'location' => 'Main auditorium',
                ),
            ),
            'gallery_indices'  => array( 10, 11, 12 ),
        ),
        array(
            'title'            => 'Junior Classification - Paphos',
            'slug'             => 'cyprus-national-dance-championship-5',
            'excerpt'          => 'Single-day classification for juvenile and junior couples. Coaching zone and live results screen.',
            'content'          => '<p>Focused schedule for younger athletes with shortened rounds and clear rotation times. Parents receive a printed timetable at check-in.</p>',
            'image_url'        => $base_img . 'seed-events-5.webp',
            'event_date'       => 'June 7, 2026',
            'event_location'   => 'Paphos Sports Hall',
            'event_link'       => '',
            'event_schedule_notes' => '',
            'year'             => array( '2026' ),
            'category'         => array( 'Cyprus National Competitions' ),
            'type'             => array( 'Classification Tournaments' ),
            'style'            => array( 'Couples' ),
            'menu_order'       => 5,
            'schedule_entries' => array(
                array(
                    'day'      => 'Sat',
                    'title'    => 'Juvenile & Junior - all dances',
                    'time'     => '09:00 - 17:00',
                    'location' => 'Court 1',
                ),
            ),
            'gallery_indices'  => array( 13, 14, 15 ),
        ),
        array(
            'title'            => 'Summer Dance Festival - Mixed Programme',
            'slug'             => 'cyprus-national-dance-championship-6',
            'excerpt'          => 'Workshops in the morning, amateur cup in the afternoon, open-floor social in the evening.',
            'content'          => '<p>A packed day for hobby dancers and competitors alike. Morning sessions cover technique and styling; afternoon blocks run quickstep-to-jive medleys.</p><p>Evening social is open to all ticket holders - no partner required.</p>',
            'image_url'        => $base_img . 'seed-events-6.webp',
            'event_date'       => 'July 18-19, 2026',
            'event_location'   => 'Ayia Napa Conference Resort',
            'event_link'       => $contact,
            'event_schedule_notes' => '',
            'year'             => array( '2026' ),
            'category'         => array( 'Performances' ),
            'type'             => array( 'Cyprus Cup' ),
            'style'            => array( 'Solo', 'Couples', 'Show Dances' ),
            'menu_order'       => 6,
            'schedule_entries' => array(
                array(
                    'day'      => 'Sat',
                    'title'    => 'Workshops & amateur cup',
                    'time'     => '10:00 - 18:00',
                    'location' => 'Ballroom A',
                ),
                array(
                    'day'      => 'Sat',
                    'title'    => 'Evening - social & demos',
                    'time'     => '20:00 - 01:00',
                    'location' => 'Terrace floor',
                ),
                array(
                    'day'      => 'Sun',
                    'title'    => 'Brunch & farewell session',
                    'time'     => '11:00 - 14:00',
                    'location' => 'Pool deck',
                ),
            ),
            'gallery_indices'  => array( 1, 8, 16 ),
        ),
    );

    foreach ( $seed_events as $event_data ) {
        $existing = get_page_by_path( $event_data['slug'], OBJECT, 'sd_event' );
        $post_args = array(
            'post_title'   => $event_data['title'],
            'post_name'    => $event_data['slug'],
            'post_excerpt' => $event_data['excerpt'],
            'post_content' => $event_data['content'],
            'post_status'  => 'publish',
            'post_type'    => 'sd_event',
            'post_author'  => 1,
            'menu_order'   => $event_data['menu_order'],
        );

        if ( $existing ) {
            $post_args['ID'] = $existing->ID;
            $post_id         = wp_update_post( $post_args, true );
        } else {
            $post_id = wp_insert_post( $post_args, true );
        }

        if ( ! $post_id || is_wp_error( $post_id ) ) {
            continue;
        }

        update_post_meta( $post_id, 'event_date', $event_data['event_date'] );
        update_post_meta( $post_id, 'event_location', $event_data['event_location'] );
        update_post_meta( $post_id, 'event_link', esc_url_raw( $event_data['event_link'] ) );
        update_post_meta( $post_id, 'event_schedule', wp_kses_post( $event_data['event_schedule_notes'] ) );

        $schedule_rows = array();
        foreach ( $event_data['schedule_entries'] as $row ) {
            $schedule_rows[] = array(
                'day'      => isset( $row['day'] ) ? (string) $row['day'] : '',
                'title'    => isset( $row['title'] ) ? (string) $row['title'] : '',
                'time'     => isset( $row['time'] ) ? (string) $row['time'] : '',
                'location' => isset( $row['location'] ) ? (string) $row['location'] : '',
            );
        }
        if ( array() === $schedule_rows ) {
            delete_post_meta( $post_id, Stardance_Event_Schedule::META_KEY );
        } else {
            update_post_meta( $post_id, Stardance_Event_Schedule::META_KEY, wp_json_encode( $schedule_rows ) );
        }

        wp_set_object_terms( $post_id, $event_data['year'], 'event_year', false );
        wp_set_object_terms( $post_id, $event_data['category'], 'event_category', false );
        wp_set_object_terms( $post_id, $event_data['type'], 'event_type', false );
        wp_set_object_terms( $post_id, $event_data['style'], 'event_style', false );

        stardance_sync_remote_featured_image( $post_id, $event_data['image_url'] );

        $gallery_ids = array();
        foreach ( $event_data['gallery_indices'] as $gi ) {
            $gi = absint( $gi );
            if ( $gi < 1 ) {
                continue;
            }
            $url = sprintf( '%sgallery-%d.png', $base_img, $gi );
            $aid = stardance_get_or_sideload_attachment_id( $post_id, $url, $event_data['title'] . ' gallery' );
            if ( $aid ) {
                $gallery_ids[] = $aid;
            }
        }
        $gallery_ids = array_values( array_unique( $gallery_ids ) );
        if ( array() === $gallery_ids ) {
            delete_post_meta( $post_id, 'event_gallery_ids' );
        } else {
            update_post_meta( $post_id, 'event_gallery_ids', implode( ',', $gallery_ids ) );
        }
    }
}
