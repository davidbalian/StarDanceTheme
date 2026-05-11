<?php
/**
 * Weekly class schedule data — single source of truth.
 * Included by page-schedule.php, template-parts/timetable.php, and inc/schema.php.
 * Defines $schedule_days in the including scope.
 */

$schedule_days = array(
    array(
        'label'    => 'Mon',
        'sessions' => array(
            array(
                'time'  => '16:30 - 17:45',
                'title' => 'Classical Choreography',
            ),
            array(
                'time'  => '18:00 - 19:30',
                'title' => 'Latin American Dances',
                'meta'  => 'Couples & Solo (Age 8+)',
            ),
        ),
    ),
    array(
        'label'    => 'Tue',
        'sessions' => array(
            array(
                'time'  => '16:30 - 17:00',
                'title' => 'Baby Dance',
                'meta'  => '(Age 4-5)',
            ),
            array(
                'time'  => '17:00 - 17:45',
                'title' => 'Kids Dance',
                'meta'  => '(Age 6-7)',
            ),
            array(
                'time'  => '18:00 - 19:30',
                'title' => 'Latin Fusion',
                'meta'  => 'Ladies Solo',
            ),
        ),
    ),
    array(
        'label'    => 'Wed',
        'sessions' => array(
            array(
                'time'  => '16:30 - 17:45',
                'title' => 'Physical Conditioning',
            ),
            array(
                'time'  => '18:00 - 19:30',
                'title' => 'European Ballroom',
                'meta'  => 'Couples & Solo (Age 8+)',
            ),
        ),
    ),
    array(
        'label'    => 'Thu',
        'sessions' => array(
            array(
                'time'  => '16:30 - 17:00',
                'title' => 'Baby Dance',
                'meta'  => '(Age 4-5)',
            ),
            array(
                'time'  => '17:00 - 17:45',
                'title' => 'Kids Dance',
                'meta'  => '(Age 6-7)',
            ),
            array(
                'time'  => '18:00 - 19:30',
                'title' => 'Latin Fusion',
                'meta'  => 'Ladies Solo',
            ),
        ),
    ),
    array(
        'label'    => 'Fri',
        'sessions' => array(
            array(
                'time'  => '16:30 - 17:45',
                'title' => 'Body Ballet',
                'meta'  => 'Stretching',
            ),
            array(
                'time'  => '18:00 - 19:30',
                'title' => 'Competition Practice',
                'meta'  => 'Standard & Latin American',
            ),
        ),
    ),
    array(
        'label'    => 'Sat',
        'sessions' => array(
            array(
                'time'  => '9:00 - 19:00',
                'title' => 'Individual Lessons',
            ),
        ),
    ),
    array(
        'label'  => 'Sun',
        'closed' => true,
    ),
);
