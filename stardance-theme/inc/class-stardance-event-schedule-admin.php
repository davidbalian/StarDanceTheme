<?php
/**
 * Admin UI for structured sd_event schedule rows.
 *
 * @package stardance
 */

/**
 * Renders the schedule repeater inside the event content meta box.
 */
class Stardance_Event_Schedule_Admin {

    /**
     * @param WP_Post $post Post object.
     * @return void
     */
    public static function render_fields( WP_Post $post ): void {
        $entries = Stardance_Event_Schedule::get_entries( (int) $post->ID );
        if ( array() === $entries ) {
            $entries = array(
                array(
                    'day'      => '',
                    'title'    => '',
                    'time'     => '',
                    'location' => '',
                ),
            );
        }
        ?>
        <p>
            <strong><?php esc_html_e( 'Event schedule (by day)', 'stardance' ); ?></strong>
        </p>
        <p class="description"><?php esc_html_e( 'Add one row per block in the schedule. The day label appears in the card header (e.g. Wed).', 'stardance' ); ?></p>
        <div class="stardance-schedule-rows" id="stardance-schedule-rows">
            <?php foreach ( $entries as $idx => $row ) : ?>
                <div class="stardance-schedule-row">
                    <p class="stardance-schedule-row__field">
                        <label for="stardance-schedule-day-<?php echo esc_attr( (string) $idx ); ?>"><?php esc_html_e( 'Day', 'stardance' ); ?></label>
                        <input
                            id="stardance-schedule-day-<?php echo esc_attr( (string) $idx ); ?>"
                            type="text"
                            name="stardance_schedule_entries[<?php echo esc_attr( (string) $idx ); ?>][day]"
                            value="<?php echo esc_attr( $row['day'] ); ?>"
                            placeholder="<?php esc_attr_e( 'Wed', 'stardance' ); ?>"
                            autocomplete="off"
                        />
                    </p>
                    <p class="stardance-schedule-row__field">
                        <label for="stardance-schedule-title-<?php echo esc_attr( (string) $idx ); ?>"><?php esc_html_e( 'Session title', 'stardance' ); ?></label>
                        <input
                            id="stardance-schedule-title-<?php echo esc_attr( (string) $idx ); ?>"
                            type="text"
                            name="stardance_schedule_entries[<?php echo esc_attr( (string) $idx ); ?>][title]"
                            value="<?php echo esc_attr( $row['title'] ); ?>"
                            placeholder="<?php esc_attr_e( 'Day No. 1 - Event name', 'stardance' ); ?>"
                            autocomplete="off"
                        />
                    </p>
                    <p class="stardance-schedule-row__field">
                        <label for="stardance-schedule-time-<?php echo esc_attr( (string) $idx ); ?>"><?php esc_html_e( 'Time', 'stardance' ); ?></label>
                        <input
                            id="stardance-schedule-time-<?php echo esc_attr( (string) $idx ); ?>"
                            type="text"
                            name="stardance_schedule_entries[<?php echo esc_attr( (string) $idx ); ?>][time]"
                            value="<?php echo esc_attr( $row['time'] ); ?>"
                            placeholder="<?php esc_attr_e( '10:00 - 18:00', 'stardance' ); ?>"
                            autocomplete="off"
                        />
                    </p>
                    <p class="stardance-schedule-row__field">
                        <label for="stardance-schedule-location-<?php echo esc_attr( (string) $idx ); ?>"><?php esc_html_e( 'Location', 'stardance' ); ?></label>
                        <input
                            id="stardance-schedule-location-<?php echo esc_attr( (string) $idx ); ?>"
                            type="text"
                            name="stardance_schedule_entries[<?php echo esc_attr( (string) $idx ); ?>][location]"
                            value="<?php echo esc_attr( $row['location'] ); ?>"
                            placeholder="<?php esc_attr_e( 'Venue name', 'stardance' ); ?>"
                            autocomplete="off"
                        />
                    </p>
                    <p class="stardance-schedule-row__actions">
                        <button type="button" class="button-link stardance-schedule-remove" aria-label="<?php esc_attr_e( 'Remove this row', 'stardance' ); ?>"><?php esc_html_e( 'Remove', 'stardance' ); ?></button>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
        <p>
            <button type="button" class="button" id="stardance-schedule-add-row"><?php esc_html_e( 'Add schedule row', 'stardance' ); ?></button>
        </p>
        <template id="stardance-schedule-row-template">
            <div class="stardance-schedule-row">
                <p class="stardance-schedule-row__field">
                    <label class="stardance-schedule-js-label-day"></label>
                    <input type="text" class="stardance-schedule-js-day" name="" value="" placeholder="<?php echo esc_attr__( 'Wed', 'stardance' ); ?>" autocomplete="off" />
                </p>
                <p class="stardance-schedule-row__field">
                    <label class="stardance-schedule-js-label-title"></label>
                    <input type="text" class="stardance-schedule-js-title" name="" value="" placeholder="<?php echo esc_attr__( 'Day No. 1 - Event name', 'stardance' ); ?>" autocomplete="off" />
                </p>
                <p class="stardance-schedule-row__field">
                    <label class="stardance-schedule-js-label-time"></label>
                    <input type="text" class="stardance-schedule-js-time" name="" value="" placeholder="<?php echo esc_attr__( '10:00 - 18:00', 'stardance' ); ?>" autocomplete="off" />
                </p>
                <p class="stardance-schedule-row__field">
                    <label class="stardance-schedule-js-label-location"></label>
                    <input type="text" class="stardance-schedule-js-location" name="" value="" placeholder="<?php echo esc_attr__( 'Venue name', 'stardance' ); ?>" autocomplete="off" />
                </p>
                <p class="stardance-schedule-row__actions">
                    <button type="button" class="button-link stardance-schedule-remove"><?php echo esc_html__( 'Remove', 'stardance' ); ?></button>
                </p>
            </div>
        </template>
        <?php
    }
}
