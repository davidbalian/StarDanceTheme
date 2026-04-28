<?php
/**
 * sd_event admin media crop integration.
 *
 * @package stardance
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds modal crop tools and upload endpoint for sd_event admin.
 */
final class Stardance_Event_Media_Crop_Admin {

	/**
	 * Attach hooks.
	 *
	 * @return void
	 */
	public static function init(): void {
		add_action( 'wp_ajax_stardance_upload_cropped_image', array( __CLASS__, 'ajax_upload_cropped_image' ) );
	}

	/**
	 * Enqueue crop assets for sd_event editor.
	 *
	 * @return void
	 */
	public static function enqueue_assets(): void {
		wp_enqueue_style(
			'stardance-admin-event-media-crop',
			get_template_directory_uri() . '/assets/css/admin-event-media-crop.css',
			array(),
			stardance_asset_version( 'assets/css/admin-event-media-crop.css' )
		);

		wp_enqueue_script(
			'stardance-admin-event-media-crop',
			get_template_directory_uri() . '/assets/js/admin-sd-event-media-crop.js',
			array( 'jquery', 'media-views' ),
			stardance_asset_version( 'assets/js/admin-sd-event-media-crop.js' ),
			true
		);

		wp_localize_script(
			'stardance-admin-event-media-crop',
			'stardanceMediaCropAdmin',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'stardance_media_crop_nonce' ),
				'ratios'  => array(
					array(
						'key'    => 'laptop-tablet',
						'label'  => __( 'Laptop & Tablet', 'stardance' ),
						'width'  => 1440,
						'height' => 600,
					),
					array(
						'key'    => 'mobile',
						'label'  => __( 'Mobile', 'stardance' ),
						'width'  => 9,
						'height' => 16,
					),
					array(
						'key'    => 'desktop-large',
						'label'  => __( 'Large Desktop', 'stardance' ),
						'width'  => 1920,
						'height' => 1080,
					),
				),
				'i18n'    => array(
					'openButton'      => __( 'Create responsive crops', 'stardance' ),
					'modalTitle'      => __( 'Create responsive image crops', 'stardance' ),
					'saveButton'      => __( 'Save as new upload', 'stardance' ),
					'insertButton'    => __( 'Insert into event gallery', 'stardance' ),
					'uploadedLabel'   => __( 'Uploaded', 'stardance' ),
					'invalidImage'    => __( 'Only images are supported.', 'stardance' ),
					'invalidRatio'    => __( 'Width and height must be greater than zero.', 'stardance' ),
					'uploadError'     => __( 'Could not upload cropped image. Please try again.', 'stardance' ),
					'processingLabel' => __( 'Processing...', 'stardance' ),
					'closeLabel'      => __( 'Close', 'stardance' ),
				),
			)
		);
	}

	/**
	 * AJAX: persist cropped image as a new attachment.
	 *
	 * @return void
	 */
	public static function ajax_upload_cropped_image(): void {
		check_ajax_referer( 'stardance_media_crop_nonce', 'nonce' );

		if ( ! current_user_can( 'upload_files' ) ) {
			wp_send_json_error(
				array( 'message' => __( 'You are not allowed to upload files.', 'stardance' ) ),
				403
			);
		}

		$data_url = isset( $_POST['dataUrl'] ) ? (string) wp_unslash( $_POST['dataUrl'] ) : '';
		$filename = isset( $_POST['filename'] ) ? sanitize_file_name( wp_unslash( $_POST['filename'] ) ) : '';
		$title    = isset( $_POST['title'] ) ? sanitize_text_field( wp_unslash( $_POST['title'] ) ) : '';

		if ( '' === $data_url || '' === $filename ) {
			wp_send_json_error(
				array( 'message' => __( 'Missing crop image payload.', 'stardance' ) ),
				400
			);
		}

		if ( 0 !== strpos( $data_url, 'data:image/' ) ) {
			wp_send_json_error(
				array( 'message' => __( 'Invalid image format.', 'stardance' ) ),
				400
			);
		}

		$parts = explode( ',', $data_url, 2 );
		if ( 2 !== count( $parts ) ) {
			wp_send_json_error(
				array( 'message' => __( 'Malformed image data.', 'stardance' ) ),
				400
			);
		}

		$binary = base64_decode( $parts[1], true );
		if ( false === $binary ) {
			wp_send_json_error(
				array( 'message' => __( 'Image decoding failed.', 'stardance' ) ),
				400
			);
		}

		$upload = wp_upload_bits( $filename, null, $binary );
		if ( ! empty( $upload['error'] ) ) {
			wp_send_json_error(
				array( 'message' => $upload['error'] ),
				500
			);
		}

		$filetype = wp_check_filetype( $upload['file'] );
		$attachment = array(
			'post_mime_type' => isset( $filetype['type'] ) ? $filetype['type'] : 'image/jpeg',
			'post_title'     => $title ? $title : pathinfo( $filename, PATHINFO_FILENAME ),
			'post_status'    => 'inherit',
		);

		$attachment_id = wp_insert_attachment( $attachment, $upload['file'] );
		if ( is_wp_error( $attachment_id ) || ! $attachment_id ) {
			wp_send_json_error(
				array( 'message' => __( 'Failed to create attachment.', 'stardance' ) ),
				500
			);
		}

		require_once ABSPATH . 'wp-admin/includes/image.php';
		$metadata = wp_generate_attachment_metadata( $attachment_id, $upload['file'] );
		wp_update_attachment_metadata( $attachment_id, $metadata );

		$thumb = wp_get_attachment_image_url( $attachment_id, 'thumbnail' );
		$edit  = get_edit_post_link( $attachment_id, 'raw' );

		wp_send_json_success(
			array(
				'id'        => (int) $attachment_id,
				'title'     => get_the_title( $attachment_id ),
				'thumb'     => $thumb ? esc_url_raw( $thumb ) : '',
				'editLink'  => $edit ? esc_url_raw( $edit ) : '',
				'fileUrl'   => esc_url_raw( wp_get_attachment_url( $attachment_id ) ),
				'fileName'  => basename( $upload['file'] ),
			)
		);
	}
}

Stardance_Event_Media_Crop_Admin::init();
