<section class="sd-section sd-classes sd-classes-page" id="classes">
    <div class="sd-container">
        <h2 class="sd-heading sd-classes-page__title fade-in fade-in-delay-0"><?php te('Our Classes'); ?></h2>

        <div class="sd-classes-page__grid sd-grid sd-grid--3">
            <?php stardance_render_dance_class_overlay_cards(); ?>
        </div>

        <div class="sd-section__cta fade-in fade-in-delay-7">
            <a href="<?php echo esc_url( sd_localized_url( '/classes/' ) ); ?>" class="sd-btn"><?php te('View All Classes'); ?></a>
        </div>
    </div>
</section>
