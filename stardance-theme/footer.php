<footer class="sd-footer" id="footer">
    <div class="sd-footer__main sd-container">
        <div class="sd-footer__brand">
            <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php bloginfo('name'); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Logo-footer.svg" alt="<?php bloginfo('name'); ?>" class="sd-footer__logo" width="135" height="169">
            </a>
        </div>

        <div class="sd-footer__links">
            <h3 class="sd-footer__heading">Quick Links</h3>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer',
                'container'      => false,
                'menu_class'     => 'sd-footer__menu',
                'fallback_cb'    => 'stardance_fallback_footer_menu',
            ));
            ?>
        </div>

        <div class="sd-footer__contact">
            <h3 class="sd-footer__heading">Contact & Location</h3>
            <div class="sd-footer__contact-item">
                <strong>Phone:</strong>
                <a href="tel:+35799288918">+ 357 99 288 918</a>
            </div>
            <div class="sd-footer__contact-item">
                <strong>Email:</strong>
                <a href="mailto:ssvetlana@cytanet.com.cy">ssvetlana@cytanet.com.cy</a>
            </div>
            <div class="sd-footer__contact-item">
                <strong>Address:</strong>
                <span>Masterland/KIDDOM, Spyrou Kyprianou Ave 48, Limassol 4043</span>
            </div>
            <div class="sd-footer__contact-item">
                <strong>Operating Hours:</strong>
                <span>Monday &ndash; Saturday: 9:00 - 20:00<br>Sunday: Closed</span>
            </div>
        </div>
    </div>

    <div class="sd-footer__legal">
        <div class="sd-container sd-footer__legal-inner">
            <a href="#">Privacy Policy</a>
            <span class="sd-footer__legal-sep">|</span>
            <a href="#">Cookie Policy</a>
            <span class="sd-footer__legal-sep">|</span>
            <a href="#">Sitemap</a>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
