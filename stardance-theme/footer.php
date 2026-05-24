<footer class="sd-footer" id="footer">
    <div class="sd-footer__main sd-container">
        <div class="sd-footer__brand">
            <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php bloginfo('name'); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Logo-footer.svg" alt="<?php bloginfo('name'); ?>" class="sd-footer__logo" width="135" height="169">
            </a>
        </div>

        <div class="sd-footer__links">
            <h3 class="sd-footer__heading"><?php te('Quick Links'); ?></h3>
            <?php
            $sd_footer_lang = sd_get_current_lang();
            $sd_footer_loc  = ( $sd_footer_lang !== SD_DEFAULT_LANG && has_nav_menu( 'footer-' . $sd_footer_lang ) )
                                  ? 'footer-' . $sd_footer_lang
                                  : 'footer';
            wp_nav_menu(array(
                'theme_location' => $sd_footer_loc,
                'container'      => false,
                'menu_class'     => 'sd-footer__menu',
                'fallback_cb'    => 'stardance_fallback_footer_menu',
            ));
            ?>
        </div>

        <div class="sd-footer__contact">
            <h3 class="sd-footer__heading"><?php te('Contact & Location'); ?></h3>
            <div class="sd-footer__contact-item">
                <strong><?php te('Phone:'); ?></strong>
                <a href="tel:+35799288918">+ 357 99 288 918</a><br>
                <a href="tel:+35799301181">+357 99 301 181</a>
            </div>
            <div class="sd-footer__contact-item">
                <strong><?php te('Email:'); ?></strong>
                <a href="mailto:svetlana@stardance.com.cy">svetlana@stardance.com.cy</a>
            </div>
            <div class="sd-footer__contact-item">
                <strong><?php te('Address:'); ?></strong>
                <a href="https://maps.app.goo.gl/DMsuHSYPQcHSBjHA9" target="_blank" rel="noopener noreferrer">Masterland/KIDDOM, Spyrou Kyprianou Ave 48, Limassol 4043</a>
            </div>
            <div class="sd-footer__contact-item">
                <strong><?php te('Operating Hours:'); ?></strong>
                <span><?php te('Monday – Saturday: 9:00 - 20:00'); ?><br><?php te('Sunday: Closed'); ?></span>
            </div>
        </div>
    </div>

    <div class="sd-footer__legal">
        <div class="sd-container sd-footer__legal-inner">
            <a href="<?php echo esc_url( stardance_page_or_path_url( 'privacy-policy' ) ); ?>"><?php te( 'Privacy Policy' ); ?></a>
            <span class="sd-footer__legal-sep">|</span>
            <a href="<?php echo esc_url( stardance_page_or_path_url( 'cookie-policy' ) ); ?>"><?php te( 'Cookie Policy' ); ?></a>
            <span class="sd-footer__legal-sep">|</span>
            <a href="<?php echo esc_url( home_url( '/wp-sitemap.xml' ) ); ?>"><?php te( 'Sitemap' ); ?></a>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
