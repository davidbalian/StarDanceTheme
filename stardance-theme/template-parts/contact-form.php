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
        <h2 class="sd-heading sd-contact__title fade-in fade-in-delay-0">Get In Touch</h2>

        <form class="sd-contact__form fade-in fade-in-delay-1" id="stardance-contact-form" novalidate>
            <input type="hidden" name="action" value="stardance_contact">
            <input type="hidden" name="nonce" value="">

            <div class="sd-contact__fields">
                <div class="sd-contact__field">
                    <input type="text" name="name" placeholder="First Name" required>
                </div>
                <div class="sd-contact__field">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="sd-contact__field">
                    <input type="tel" name="phone" placeholder="Phone">
                </div>
                <div class="sd-contact__field">
                    <select name="interest">
                        <option value="" disabled selected>I'm interested in</option>
                        <option value="European Ballroom">European Ballroom</option>
                        <option value="Latin American">Latin American</option>
                        <option value="Latin Fusion Ladies">Latin Fusion Ladies</option>
                        <option value="Kids Programs">Kids Programs</option>
                        <option value="Wedding Choreography">Wedding Choreography</option>
                        <option value="Individual Lessons">Individual Lessons</option>
                    </select>
                </div>
                <div class="sd-contact__field sd-contact__field--full">
                    <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
                </div>
            </div>

            <div class="sd-contact__submit">
                <button type="submit" class="sd-btn">Submit</button>
            </div>

            <div class="sd-contact__status" id="form-status" aria-live="polite"></div>
        </form>
    </div>
</section>
