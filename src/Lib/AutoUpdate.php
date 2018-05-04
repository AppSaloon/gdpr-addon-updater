<?php

namespace BitbucketUpdater\Lib;

use BitbucketUpdater\Lib\Update\Classes\Bb\BitbucketPluginUpdater;
use BitbucketUpdater\Model\Bitbucket;
use BitbucketUpdater\Model\Edd;

/**
 * Auto updates the plugin if parameters are valid
 *
 * @since 1.0.0
 */
class AutoUpdate {

	/**
	 * @var \BitbucketUpdater\Model\Bitbucket
	 *
	 * @since 1.0.0
	 */
	protected $bitbucket;

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
	 * @since 1.0.0
	 */
	public function __construct( Bitbucket $bitbucket, Edd $edd ) {
		$this->bitbucket = $bitbucket;
		$this->edd = $edd;

		add_action( 'admin_init', array( $this, 'handle_updates' ) );
	}

	/**
	 * Checks if license and git repo is valid.
	 * If valid, then it will check version and will update the plugin.
	 *
	 * @since 1.0.0
	 */
	public function handle_updates() {
		if ( $this->licensekey_is_valid() ) {
			new BitbucketPluginUpdater( $this->bitbucket );
		}
	}

	/**
	 * Checks if the license key is valid
	 *
	 * @return bool returns true if it is valid
	 *              returns false if it is not valid
	 *
	 * @since 1.0.0
	 */
	private function licensekey_is_valid() {
		$license_key = get_option( $this->edd->license_option, false );

		if ( $license_key ) {
			return LicenseCheck::is_license_key_valid( $license_key, $this->edd );
		}

		return false;
	}

}