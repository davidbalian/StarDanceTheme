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
            'title'       => SD_Page_Content::get_text( $sd_page_id, 'contact', 'hero_title' ),
            'description' => SD_Page_Content::get_text( $sd_page_id, 'contact', 'hero_description' ),
            'modifier'    => 'contact',
            'bg_image_urls' => stardance_get_responsive_hero_images( $sd_page_id, 'contact' ),
        )
    );
    ?>

    <section class="sd-section sd-contact-page" id="contact-body">
        <div class="sd-container">
            <div class="sd-contact-page__layout">
                <div class="sd-contact-page__column sd-contact-page__column--details">
                    <h2 class="sd-heading sd-contact-page__heading fade-in fade-in-delay-0"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'contact', 'details_heading' ) ); ?></h2>

                    <div class="sd-contact-page__details-grid">
                        <div class="sd-contact-page__detail-item fade-in fade-in-delay-1">
                            <div class="sd-contact-page__detail-icon" aria-hidden="true">
                                <img src="https://stardance.com.cy/wp-content/uploads/2026/04/sd-pin-icon.png" alt="" width="32" height="32" loading="lazy">
                            </div>
                            <div class="sd-contact-page__detail-content">
                                <h3 class="sd-contact-page__detail-title"><?php te('Address'); ?></h3>
                                <p class="sd-contact-page__detail-text">Masterland/KIDDOM, Spyrou Kyprianou Ave 48, Limassol 4043, Cyprus</p>
                            </div>
                        </div>

                        <div class="sd-contact-page__detail-item fade-in fade-in-delay-2">
                            <div class="sd-contact-page__detail-icon" aria-hidden="true">
                                <img src="https://stardance.com.cy/wp-content/uploads/2026/04/sd-email-icon.png" alt="" width="32" height="32" loading="lazy">
                            </div>
                            <div class="sd-contact-page__detail-content">
                                <h3 class="sd-contact-page__detail-title"><?php te('Email'); ?></h3>
                                <p class="sd-contact-page__detail-text">
                                    <a href="mailto:svetlana@stardance.com.cy">svetlana@stardance.com.cy</a>
                                </p>
                            </div>
                        </div>

                        <div class="sd-contact-page__detail-item fade-in fade-in-delay-3">
                            <div class="sd-contact-page__detail-icon" aria-hidden="true">
                                <img src="https://stardance.com.cy/wp-content/uploads/2026/04/sd-phone-icon.png" alt="" width="32" height="32" loading="lazy">
                            </div>
                            <div class="sd-contact-page__detail-content">
                                <h3 class="sd-contact-page__detail-title"><?php te('Phone'); ?></h3>
                                <p class="sd-contact-page__detail-text">
                                    <a href="tel:+35799288918">+357 99 288 918</a><br>
                                    <a href="tel:+35799301181">+357 99 301 181</a>
                                </p>
                            </div>
                        </div>

                        <div class="sd-contact-page__detail-item fade-in fade-in-delay-4">
                            <div class="sd-contact-page__detail-icon" aria-hidden="true">
                                <img src="https://stardance.com.cy/wp-content/uploads/2026/04/sd-clock-icon.png" alt="" width="32" height="32" loading="lazy">
                            </div>
                            <div class="sd-contact-page__detail-content">
                                <h3 class="sd-contact-page__detail-title"><?php te('Operating Hours'); ?></h3>
                                <p class="sd-contact-page__detail-text">
                                    <?php te('Monday to Saturday: 9:00 - 20:00'); ?><br>
                                    <?php te('Sunday: Closed'); ?>
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
                    <h2 class="sd-heading sd-contact-page__heading fade-in fade-in-delay-1"><?php echo esc_html( SD_Page_Content::get_text( $sd_page_id, 'contact', 'form_heading' ) ); ?></h2>

                    <form class="sd-contact-page__form fade-in fade-in-delay-2" action="#" method="post">
                        <label class="screen-reader-text" for="sd-contact-first-name"><?php te('First Name'); ?></label>
                        <input id="sd-contact-first-name" class="sd-contact-page__input" type="text" name="first_name" placeholder="<?php echo esc_attr( t('First Name') ); ?>">

                        <label class="screen-reader-text" for="sd-contact-email"><?php te('Email'); ?></label>
                        <input id="sd-contact-email" class="sd-contact-page__input" type="email" name="email" placeholder="<?php echo esc_attr( t('Email') ); ?>">

                        <label class="screen-reader-text" for="sd-contact-phone"><?php te('Phone'); ?></label>
                        <input id="sd-contact-phone" class="sd-contact-page__input" type="tel" name="phone" placeholder="<?php echo esc_attr( t('Phone') ); ?>">

                        <div class="sd-contact-page__interest-dropdown">
                            <button class="sd-contact-page__interest-toggle" type="button" aria-expanded="false">
                                <?php echo esc_html( t("I'm interested in") ); ?>
                            </button>
                            <fieldset class="sd-contact-page__interest-options" hidden>
                                <legend class="screen-reader-text"><?php te('Select class interests'); ?></legend>
                                <label><input type="checkbox" name="interests[]" value="european-ballroom"> <?php te('European Ballroom'); ?></label>
                                <label><input type="checkbox" name="interests[]" value="latin-american"> <?php te('Latin American'); ?></label>
                                <label><input type="checkbox" name="interests[]" value="hip-hop"> <?php te('Hip Hop'); ?></label>
                                <label><input type="checkbox" name="interests[]" value="ballet-modern-choreography"> <?php te('Ballet & Modern Choreography'); ?></label>
                                <label><input type="checkbox" name="interests[]" value="latin-fusion-ladies"> <?php te('Latin Fusion Ladies'); ?></label>
                                <label><input type="checkbox" name="interests[]" value="kids-programs"> <?php te('Kids Programs'); ?></label>
                                <label><input type="checkbox" name="interests[]" value="wedding-choreography"> <?php te('Wedding Choreography'); ?></label>
                                <label><input type="checkbox" name="interests[]" value="individual-lessons"> <?php te('Individual Lessons'); ?></label>
                            </fieldset>
                        </div>

                        <label class="screen-reader-text" for="sd-contact-message"><?php te('Your Message'); ?></label>
                        <textarea id="sd-contact-message" class="sd-contact-page__input sd-contact-page__input--message" name="message" placeholder="<?php echo esc_attr( t('Your Message') ); ?>"></textarea>

                        <button class="sd-btn sd-contact-page__submit" type="submit"><?php te('Submit'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
