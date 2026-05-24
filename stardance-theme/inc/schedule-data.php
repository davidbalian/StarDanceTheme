<?php
/**
 * Weekly class schedule data — single source of truth.
 * Call sd_get_schedule_days() to get the localized schedule array.
 * Backward-compat: $schedule_days still defined when file is require'd directly.
 */

function sd_get_schedule_days(): array {
    return array(
        array(
            'label'    => t('Mon'),
            'sessions' => array(
                array(
                    'time'  => '16:30 - 17:45',
                    'title' => t('Classical Choreography'),
                ),
                array(
                    'time'  => '18:00 - 19:30',
                    'title' => t('Latin American Dances'),
                    'meta'  => t('Couples & Solo (Age 8+)'),
                ),
            ),
        ),
        array(
            'label'    => t('Tue'),
            'sessions' => array(
                array(
                    'time'  => '16:30 - 17:00',
                    'title' => t('Baby Dance'),
                    'meta'  => t('(Age 4-5)'),
                ),
                array(
                    'time'  => '17:00 - 17:45',
                    'title' => t('Kids Dance'),
                    'meta'  => t('(Age 6-7)'),
                ),
                array(
                    'time'  => '18:00 - 19:30',
                    'title' => t('Latin Fusion'),
                    'meta'  => t('Ladies Solo'),
                ),
            ),
        ),
        array(
            'label'    => t('Wed'),
            'sessions' => array(
                array(
                    'time'  => '16:30 - 17:45',
                    'title' => t('Ballet Conditioning'),
                ),
                array(
                    'time'  => '18:00 - 19:30',
                    'title' => t('European Ballroom'),
                    'meta'  => t('Couples & Solo (Age 8+)'),
                ),
            ),
        ),
        array(
            'label'    => t('Thu'),
            'sessions' => array(
                array(
                    'time'  => '16:30 - 17:00',
                    'title' => t('Baby Dance'),
                    'meta'  => t('(Age 4-5)'),
                ),
                array(
                    'time'  => '17:00 - 17:45',
                    'title' => t('Kids Dance'),
                    'meta'  => t('(Age 6-7)'),
                ),
                array(
                    'time'  => '18:00 - 19:30',
                    'title' => t('Latin Fusion'),
                    'meta'  => t('Ladies Solo'),
                ),
            ),
        ),
        array(
            'label'    => t('Fri'),
            'sessions' => array(
                array(
                    'time'  => '16:30 - 17:45',
                    'title' => t('Body Ballet'),
                    'meta'  => t('Stretching'),
                ),
                array(
                    'time'  => '18:00 - 19:30',
                    'title' => t('Competition Practice'),
                    'meta'  => t('Standard & Latin American'),
                ),
            ),
        ),
        array(
            'label'    => t('Sat'),
            'sessions' => array(
                array(
                    'time'  => '9:00 - 19:00',
                    'title' => t('Individual Lessons'),
                ),
            ),
        ),
        array(
            'label'  => t('Sun'),
            'closed' => true,
        ),
    );
}

// Backward-compat: callers that do `require` and use $schedule_days directly.
$schedule_days = sd_get_schedule_days();
