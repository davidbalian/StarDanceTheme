<?php
$sd_home_page_id = get_queried_object_id();
$sd_home_cta_images = stardance_get_responsive_bottom_cta_images( $sd_home_page_id, 'home' );
$sd_home_cta_style = sprintf(
    '--sd-home-cta-bg-image-large: url(%1$s); --sd-home-cta-bg-image-tablet: url(%2$s); --sd-home-cta-bg-image-mobile: url(%3$s);',
    esc_url( $sd_home_cta_images['large'] ),
    esc_url( $sd_home_cta_images['tablet'] ),
    esc_url( $sd_home_cta_images['mobile'] )
);
?>
<section class="sd-section sd-contact" id="contact" style="<?php echo esc_attr( $sd_home_cta_style ); ?>">
    <img
        src="https://stardance.com.cy/wp-content/uploads/2026/04/bottom-cta-horizontal-lines.png"
        alt=""
        class="sd-contact__lines"
        aria-hidden="true"
    >
    <div class="sd-container">
        <?php $sd_cf_pid = get_queried_object_id(); ?>
        <h2 class="sd-heading sd-contact__title fade-in fade-in-delay-0"><?php echo esc_html( SD_Page_Content::get_text( $sd_cf_pid, 'home', 'contact_heading' ) ); ?></h2>

        <form class="sd-contact__form fade-in fade-in-delay-1" id="stardance-contact-form" novalidate>
            <input type="hidden" name="action" value="stardance_contact">
            <input type="hidden" name="nonce" value="">

            <div class="sd-contact__fields">
                <div class="sd-contact__field">
                    <input type="text" name="name" placeholder="<?php echo esc_attr( t('First Name') ); ?>" required>
                </div>
                <div class="sd-contact__field">
                    <input type="email" name="email" placeholder="<?php echo esc_attr( t('Email') ); ?>" required>
                </div>
                <div class="sd-contact__field">
                    <input type="tel" name="phone" placeholder="<?php echo esc_attr( t('Phone') ); ?>">
                </div>
                <div class="sd-contact__field">
                    <select name="interest">
                        <option value="" disabled selected><?php echo esc_html( t("I'm interested in") ); ?></option>
                        <option value="European Ballroom"><?php te('European Ballroom'); ?></option>
                        <option value="Latin American"><?php te('Latin American'); ?></option>
                        <option value="Latin Fusion Ladies"><?php te('Latin Fusion Ladies'); ?></option>
                        <option value="Kids Programs"><?php te('Kids Programs'); ?></option>
                        <option value="Wedding Choreography"><?php te('Wedding Choreography'); ?></option>
                        <option value="Individual Lessons"><?php te('Individual Lessons'); ?></option>
                    </select>
                </div>
                <div class="sd-contact__field sd-contact__field--full">
                    <textarea name="message" placeholder="<?php echo esc_attr( t('Your Message') ); ?>" rows="5" required></textarea>
                </div>
            </div>

            <div class="sd-contact__submit">
                <button type="submit" class="sd-btn"><?php te('Submit'); ?></button>
            </div>

            <div class="sd-contact__status" id="form-status" aria-live="polite"></div>
        </form>
    </div>
</section>
