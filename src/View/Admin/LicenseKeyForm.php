<?php
/**
 * This documentation is used to link used class to the real path
 * So it shows documentation when you click on it
 *
 * @var $this \BitbucketUpdater\Controller\LicenseController
 *
 * @since 1.0.0
 */
?>
<div class="wrap">
    <h2><?php echo $this->edd->plugin_name . ' ' . __( 'License', 'wp_gdpr' ); ?></h2>
    <form method="post" action="" class="postbox">
        <label for="<?php echo $this->edd->license_option; ?>"><?php _e( 'Add your license', 'wp_gdpr' ); ?>:</label>
        <input type="text" id="<?php echo $this->edd->license_option ?>"
               name="<?php echo $this->edd->license_option; ?>"
               required value="<?php echo $this->license_key; ?>">
        <span class="dashicons <?php echo $this->license_key !== null ? 'dashicons-no invalid_license_v':'dashicons-yes valid_license_v'; ?>"></span></br>
        <input type="submit" class="button button-primary" value="<?php _e( 'submit', 'wp_gdpr' ); ?>">
    </form>
</div>