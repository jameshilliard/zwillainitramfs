<?php
function edd_sample_license_menu() {
	add_plugins_page( 'Plugin License', 'Plugin License', 'manage_options', 'pluginname-license', 'edd_sample_license_page' );
}
add_action('admin_menu', 'edd_sample_license_menu');
function edd_sample_license_page() {
	$license 	= get_option( 'edd_sample_license_key' );
	$status 	= get_option( 'edd_sample_license_status' );
	?>
	<div class="wrap">
		<h2><?php _e('Plugin License Options'); ?></h2>
		<form method="post" action="options.php">
		
			<?php settings_fields('edd_sample_license'); ?>
			
			<table class="form-table">
				<tbody>
					<tr valign="top">	
						<th scope="row" valign="top">
							<?php _e('License Key'); ?>
						</th>
						<td>
							<input id="edd_sample_license_key" name="edd_sample_license_key" type="text" class="regular-text" value="<?php esc_attr_e( $license ); ?>" />
							<label class="description" for="edd_sample_license_key"><?php _e('Enter your license key'); ?></label>
						</td>
					</tr>
					<?php if( false !== $license ) { ?>
						<tr valign="top">	
							<th scope="row" valign="top">
								<?php _e('Activate License'); ?>
							</th>
							<td>
								<?php if( $status !== false && $status == 'valid' ) { ?>
									<span style="color:green;"><?php _e('active'); ?></span>
								<?php} else {
									wp_nonce_field( 'edd_sample_nonce', 'edd_sample_nonce' ); ?>
									<input type="submit" class="button-secondary" name="edd_license_activate" value="<?php _e('Activate License'); ?>"/>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>	
			<?phpsubmit_button(); ?>
		
		</form>
	<?php
}
function edd_sample_register_option() {
	// creates our settings in the options table
	register_setting('edd_sample_license', 'edd_sample_license_key', 'edd_sanitize_license' );
}
add_action('admin_init', 'edd_sample_register_option');
function edd_sanitize_license( $new ) {
	$old = get_option( 'edd_sample_license_key' );
	if( $old && $old != $new ) {
		delete_option( 'edd_sample_license_status' ); // new license has been entered, so must reactivate
	}
	return $new;
}