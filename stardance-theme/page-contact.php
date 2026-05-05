<?php
/**
 * Template Name: Contact
 *
 * @package stardance
 */

get_header();
$sd_page_id = get_queried_object_id();
?>

<main class="sd-page sd-page--contact" id="main-content">

    <?php
    stardance_render_page_hero(
        array(
            'title'       => 'Get In Touch',
            'description' => 'Have questions about our classes or want to book a trial session? We\'d love to hear from you.',
            'modifier'    => 'contact',
            'bg_image_urls' => stardance_get_responsive_hero_images( $sd_page_id, 'contact' ),
        )
    );
    ?>

    <section class="sd-section sd-contact-page" id="contact-body">
        <div class="sd-container">
            <div class="sd-contact-page__layout">
                <div class="sd-contact-page__column sd-contact-page__column--details">
                    <h2 class="sd-heading sd-contact-page__heading fade-in fade-in-delay-0">Contact Details</h2>

                    <div class="sd-contact-page__details-grid">
                        <div class="sd-contact-page__detail-item fade-in fade-in-delay-1">
                            <div class="sd-contact-page__detail-icon" aria-hidden="true">
                                <img src="https://stardance.com.cy/wp-content/uploads/2026/04/sd-pin-icon.png" alt="" width="32" height="32" loading="lazy">
                            </div>
                            <div class="sd-contact-page__detail-content">
                                <h3 class="sd-contact-page__detail-title">Address</h3>
                                <p class="sd-contact-page__detail-text">Masterland/KIDDOM, Spyrou Kyprianou Ave 48, Limassol 4043, Cyprus</p>
                            </div>
                        </div>

                        <div class="sd-contact-page__detail-item fade-in fade-in-delay-2">
                            <div class="sd-contact-page__detail-icon" aria-hidden="true">
                                <img src="https://stardance.com.cy/wp-content/uploads/2026/04/sd-email-icon.png" alt="" width="32" height="32" loading="lazy">
                            </div>
                            <div class="sd-contact-page__detail-content">
                                <h3 class="sd-contact-page__detail-title">Email</h3>
                                <p class="sd-contact-page__detail-text">
                                    <a href="mailto:ssvetlana@cytanet.com.cy">ssvetlana@cytanet.com.cy</a>
                                </p>
                            </div>
                        </div>

                        <div class="sd-contact-page__detail-item fade-in fade-in-delay-3">
                            <div class="sd-contact-page__detail-icon" aria-hidden="true">
                                <img src="https://stardance.com.cy/wp-content/uploads/2026/04/sd-phone-icon.png" alt="" width="32" height="32" loading="lazy">
                            </div>
                            <div class="sd-contact-page__detail-content">
                                <h3 class="sd-contact-page__detail-title">Phone</h3>
                                <p class="sd-contact-page__detail-text">
                                    <a href="tel:+35799301181">+357 99 301 181</a><br>
                                    <a href="tel:+35799204802">+357 99 204 802</a>
                                </p>
                            </div>
                        </div>

                        <div class="sd-contact-page__detail-item fade-in fade-in-delay-4">
                            <div class="sd-contact-page__detail-icon" aria-hidden="true">
                                <img src="https://stardance.com.cy/wp-content/uploads/2026/04/sd-clock-icon.png" alt="" width="32" height="32" loading="lazy">
                            </div>
                            <div class="sd-contact-page__detail-content">
                                <h3 class="sd-contact-page__detail-title">Operating Hours</h3>
                                <p class="sd-contact-page__detail-text">
                                    Monday to Saturday: 9:00 - 20:00<br>
                                    Sunday: Closed
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="sd-contact-page__map fade-in fade-in-delay-5">
                        <iframe
                            src="<?php echo esc_url( 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26245.587423114608!2d33.025638825775694!3d34.68755996711985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14e0cb3ad3a891a1%3A0x772cc912d46fb451!2sSTAR%20DANCE%20CYPRUS!5e0!3m2!1sen!2s!4v1778005293348!5m2!1sen!2s' ); ?>"
                            title="<?php echo esc_attr__( 'Star Dance Cyprus location map', 'stardance' ); ?>"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            allowfullscreen
                        ></iframe>
                    </div>
                </div>

                <div class="sd-contact-page__column sd-contact-page__column--form">
                    <h2 class="sd-heading sd-contact-page__heading fade-in fade-in-delay-1">Get In Touch</h2>

                    <form class="sd-contact-page__form fade-in fade-in-delay-2" action="#" method="post">
                        <label class="screen-reader-text" for="sd-contact-first-name">First Name</label>
                        <input id="sd-contact-first-name" class="sd-contact-page__input" type="text" name="first_name" placeholder="First Name">

                        <label class="screen-reader-text" for="sd-contact-email">Email</label>
                        <input id="sd-contact-email" class="sd-contact-page__input" type="email" name="email" placeholder="Email">

                        <label class="screen-reader-text" for="sd-contact-phone">Phone</label>
                        <input id="sd-contact-phone" class="sd-contact-page__input" type="tel" name="phone" placeholder="Phone">

                        <div class="sd-contact-page__interest-dropdown">
                            <button class="sd-contact-page__interest-toggle" type="button" aria-expanded="false">
                                I&rsquo;m interested in
                            </button>
                            <fieldset class="sd-contact-page__interest-options" hidden>
                                <legend class="screen-reader-text">Select class interests</legend>
                                <label><input type="checkbox" name="interests[]" value="european-ballroom"> European Ballroom</label>
                                <label><input type="checkbox" name="interests[]" value="latin-american"> Latin American</label>
                                <label><input type="checkbox" name="interests[]" value="hip-hop"> Hip Hop</label>
                                <label><input type="checkbox" name="interests[]" value="ballet-modern-choreography"> Ballet &amp; Modern Choreography</label>
                                <label><input type="checkbox" name="interests[]" value="latin-fusion-ladies"> Latin Fusion Ladies</label>
                                <label><input type="checkbox" name="interests[]" value="kids-programs"> Kids Programs</label>
                                <label><input type="checkbox" name="interests[]" value="wedding-choreography"> Wedding Choreography</label>
                                <label><input type="checkbox" name="interests[]" value="individual-lessons"> Individual Lessons</label>
                            </fieldset>
                        </div>

                        <label class="screen-reader-text" for="sd-contact-message">Your Message</label>
                        <textarea id="sd-contact-message" class="sd-contact-page__input sd-contact-page__input--message" name="message" placeholder="Your Message"></textarea>

                        <button class="sd-btn sd-contact-page__submit" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
