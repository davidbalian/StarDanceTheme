<?php
$sd_uploads   = wp_get_upload_dir();
$sd_gallery_u = ( empty( $sd_uploads['error'] ) && ! empty( $sd_uploads['baseurl'] ) )
    ? trailingslashit( $sd_uploads['baseurl'] ) . '2026/02/'
    : '';
?>
<section class="sd-section sd-gallery" id="gallery">
    <div class="sd-container">
        <h2 class="sd-heading sd-gallery__title fade-in fade-in-delay-0">Gallery</h2>

        <div class="sd-gallery__portrait fade-in fade-in-delay-1" id="gallery-portrait" data-gallery-lightbox>
            <a href="<?php echo esc_url( $sd_gallery_u . 'img1.jpg' ); ?>">
                <img src="<?php echo esc_url( $sd_gallery_u . 'img1.jpg' ); ?>" alt="Dance performance" loading="lazy">
            </a>
            <a href="<?php echo esc_url( $sd_gallery_u . 'img2.jpg' ); ?>">
                <img src="<?php echo esc_url( $sd_gallery_u . 'img2.jpg' ); ?>" alt="Dance performance" loading="lazy">
            </a>
            <a href="<?php echo esc_url( $sd_gallery_u . 'img3.jpg' ); ?>">
                <img src="<?php echo esc_url( $sd_gallery_u . 'img3.jpg' ); ?>" alt="Dance performance" loading="lazy">
            </a>
            <a href="<?php echo esc_url( $sd_gallery_u . 'img4.jpg' ); ?>">
                <img src="<?php echo esc_url( $sd_gallery_u . 'img4.jpg' ); ?>" alt="Dance performance" loading="lazy">
            </a>
        </div>

        <div class="sd-gallery__landscape fade-in fade-in-delay-2" id="gallery-landscape" data-gallery-lightbox>
            <a href="<?php echo esc_url( $sd_gallery_u . 'img5.jpg' ); ?>">
                <img src="<?php echo esc_url( $sd_gallery_u . 'img5-768x328.jpg' ); ?>" alt="Dance performance" loading="lazy">
            </a>
            <a href="<?php echo esc_url( $sd_gallery_u . 'img6.jpg' ); ?>">
                <img src="<?php echo esc_url( $sd_gallery_u . 'img6-768x328.jpg' ); ?>" alt="Dance performance" loading="lazy">
            </a>
        </div>

        <div class="sd-section__cta fade-in fade-in-delay-3">
            <a href="<?php echo esc_url( stardance_page_or_path_url( 'gallery' ) ); ?>" class="sd-btn"><?php esc_html_e( 'View Full Gallery', 'stardance' ); ?></a>
        </div>
    </div>
</section>
