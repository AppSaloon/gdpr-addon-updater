<?php

namespace BitbucketUpdater\Lib;

/**
 * Old method
 */
use BitbucketUpdater\Lib\Update\Classes\Bb\BitbucketPluginUpdater;
use BitbucketUpdater\Model\Bitbucket;

/**
 * New method
 */
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
	protected $bitbucket;

	/**
	 * AutoUpdate constructor.
	 *
	 * @param \BitbucketUpdater\Model\Bitbucket $bitbucket
	 * @param \BitbucketUpdater\Model\Edd $edd
	 *
	 * @version 2.0.0
	 * @since 1.0.0
	 */
	public function __construct( Bitbucket $bitbucket, Edd $edd ) {
		$this->bitbucket = $bitbucket;
		$this->edd = $edd;
		add_action( 'admin_init', array( $this, 'check_update') );
		add_action( 'admin_init', array( $this, 'handle_update' ) );
	}

	/**
	 * Start EDD/Bitbucket plugin version check
	 *
	 * @since 1.0.0
	 */
	public function check_update() {
		new BitbucketPluginUpdater( $this->bitbucket, $this->edd );
	}

	public function handle_update() {
		$license_key = get_option( $this->edd->license_option, false );

		if( $license_key ) {
			$api_data = array(
				'version' => $this->edd->plugin_version,
				'license' => $license_key,
				'item_name' => $this->edd->item_name,
				'item_id' => $this->edd->item_id,
				'author' => $this->edd->plugin_author
			);

			new EddPluginUpdater($this->edd->store_url, $this->edd->plugin_file, $api_data);
		}
	}
}