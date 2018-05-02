<?php

namespace BitbucketUpdater\Controller;

use BitbucketUpdater\Lib\LicenseCheck;
use BitbucketUpdater\Model\Edd;

class LicenseController {

	/**
	 * EDD settings
	 *
	 * @var \BitbucketUpdater\Model\Edd
	 *
	 * @since 1.0.0
	 */
	protected $edd;

	/**
	 * Stores license key if it is valid
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	public $license_key;

	/**
	 * Stores the validation result of the license key
	 *
	 * @var boolean
	 *
	 * @since 1.0.2
	 */
	public $validated;

	/**
	 * LicenseController constructor.
	 *
	 * @param Edd $edd
	 *
	 * @since 1.0.0
	 */
	public function __construct( Edd $edd ) {
		$this->edd = $edd;
	}

	/**
	 * Save the license key if it is posted
	 * And display the form
	 *
	 * @since 1.0.0
	 */
	public function index() {
		if ( isset( $_POST[ $this->edd->license_option ] ) ) {
			$this->save( $_POST[ $this->edd->license_option ] );
		} else {
			$this->license_key = $this->edd->get_license_key();
			$this->validated = LicenseCheck::is_license_key_valid( $this->license_key, $this->edd );
		}

		include_once GDPR_UPDATER_DIR . 'View/Admin/LicenseKeyForm.php';
	}

	/**
	 * Save the license key if it is valid
	 * or delete it
	 *
	 * @param $license_key  string
	 *
	 * @since 1.0.0
	 */
	public function save( $license_key ) {
		if ( LicenseCheck::is_license_key_valid( $license_key, $this->edd ) ) {
			$this->edd->update_option( $license_key );
			$this->license_key = $license_key;
			$this->validated = true;
		} else {
			$this->edd->delete_option();
			$this->license_key = null;
			$this->validated = false;
		}
	}
}