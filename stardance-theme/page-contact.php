<?php
/**
 * Template Name: Contact
 *
 * @package stardance
 */

get_header();
?>

<main class="sd-page sd-page--contact" id="main-content">

    <?php
    stardance_render_page_hero(
        array(
            'title'       => 'Get In Touch',
            'description' => 'Have questions about our classes or want to book a trial session? We\'d love to hear from you.',
            'modifier'    => 'contact',
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
                            src="https://www.google.com/maps?q=0,0&z=14&output=embed"
                            title="Star Dance location map"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            allowfullscreen
                        ></iframe>
                    </div>
                </div>

                <div class="sd-contact-page__column sd-contact-page__column--form">
                    <h2 class="sd-heading sd-contact-page__heading fade-in fade-in-delay-1">Get In Touch</h2>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
