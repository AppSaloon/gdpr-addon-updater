<?php

namespace BitbucketUpdater;

use BitbucketUpdater\Lib\AutoUpdate;
use BitbucketUpdater\Lib\AutoUpdateLegacy;
use BitbucketUpdater\Model\Bitbucket;
use BitbucketUpdater\Model\Edd;
use BitbucketUpdater\Controller\LicenseController;

define('GDPR_UPDATER_DIR', trailingslashit( dirname( __FILE__ ) ));

class Updater {

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
	protected $version = 1;

	/**
	 * Updater constructor.
	 *
	 * @param Edd $edd
	 *
	 * @since 2.0.0
	 */
	public function __construct( $edd = '') {
		if ( ! empty( $edd ) ){
			$this->edd = $edd;
			$this->version = 2;
		}
	}

	/**
	 * Sets bitbucket settings
	 *
	 * @param Bitbucket $bitbucket
	 *
	 * @since 1.0.0
	 */
	public function set_bitbucket( Bitbucket $bitbucket ) {
		$this->bitbucket = $bitbucket;
	}
	/**
	 * Sets gdpr settings
	 *
	 * @param Edd $edd
	 *
	 * @since 1.0.0
	 */
	public function set_edd( Edd $edd ) {
		$this->edd = $edd;
	}

	/**
	 * Validate and update the plugin
	 *
	 * @since 1.0.0
	 */
	public function validate() {
		if ($this->version == 1){
			new AutoUpdateLegacy( $this->bitbucket, $this->edd );
		} else {
			new AutoUpdate( $this->edd );
		}
	}

	/**
	 * Outputs and save license key in GDPR settings
	 *
	 * @since 1.0.0
	 */
	public function display_license_form() {
		add_action( 'add_on_settings_menu_page', array( new LicenseController( $this->edd ), 'index' ), 11 );
	}
}