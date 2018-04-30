<?php

namespace BitbucketUpdater\Lib;

use BitbucketUpdater\Lib\Update\Classes\Bb\Bitbucket_Plugin_Updater;
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
		if ( $this->git_repository_is_live() && $this->licensekey_is_valid() ) {
			new Bitbucket_Plugin_Updater( $this->bitbucket );
		}
	}

	/**
	 * Checks if the bitbucket repo is live
	 *
	 * @return bool returns true if it is live
	 *              returns false if it is down
	 *
	 * @since 1.0.0
	 */
	public function git_repository_is_live() {
		$headers = array( 'Authorization' => 'Basic ' . base64_encode( $this->bitbucket->bb_owner . ":" . $this->bitbucket->bb_password ) );
		$new_url = $this->bitbucket->bb_host . "/2.0/repositories/" . $this->bitbucket->bb_project_name . "/" . $this->bitbucket->bb_repo_name;

		$request = wp_remote_get( $new_url, array( 'headers' => $headers ) );

		if ( ! is_wp_error( $request ) && $request['response']['code'] == 200 ) {
			return true;
		}

		return false;
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