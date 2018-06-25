<?php

namespace BitbucketUpdater\Lib;

use BitbucketUpdater\Lib\Update\Classes\Edd\EddPluginUpdater;
use BitbucketUpdater\Model\Edd;

/**
 * Auto updates the plugin if parameters are valid
 *
 * @since 1.0.0
 */
class AutoUpdate {

	/**
	 * @var \BitbucketUpdater\Model\Edd
	 *
	 * @since 1.0.0
	 */
	protected $edd;

	/**
	 * AutoUpdate constructor.
	 *
	 * @param \BitbucketUpdater\Model\Bitbucket $bitbucket
	 * @param \BitbucketUpdater\Model\Edd $edd
	 *
	 * @version 1.0.2
	 * @since 1.0.0
	 */
	public function __construct( Edd $edd ) {
		$this->edd = $edd;

		add_action( 'admin_init', array( $this, 'handle_update' ) );
	}

	/**
	 * Checks if license and git repo is valid.
	 * If valid, then it will check version and will update the plugin.
	 *
	 * @since 1.0.0
	 */
	public function handle_update() {
		$license_key = get_option( $this->edd->license_option, false );

		if( $license_key ) {
			$api_data = array(
				'version' => $this->edd->plugin_version,
				'license' => $license_key,
				'item_name' => $this->edd->item_name,
				'item_id' => $this->edd->item_id
			);

			new EddPluginUpdater($this->edd->store_url, $this->edd->plugin_file, $api_data);
		}
	}
}