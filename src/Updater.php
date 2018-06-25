<?php

namespace BitbucketUpdater;

use BitbucketUpdater\Lib\AutoUpdate;
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

	/**
	 * Updater constructor.
	 *
	 * @param Edd $edd
	 *
	 * @since 2.0.0
	 */
	public function __construct(Edd $edd) {
		$this->edd = $edd;
	}

	/**
	 * Validate and update the plugin
	 *
	 * @since 1.0.0
	 */
	public function validate() {
		new AutoUpdate( $this->edd );
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