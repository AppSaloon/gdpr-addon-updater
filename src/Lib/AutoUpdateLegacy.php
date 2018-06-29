<?php

namespace BitbucketUpdater\Lib;

/**
 * Old method
 */
use BitbucketUpdater\Lib\Update\Classes\Bb\BitbucketPluginUpdater;
use BitbucketUpdater\Model\Bitbucket;
use BitbucketUpdater\Model\Edd;

/**
 * Auto updates the plugin if parameters are valid
 *
 * @since 1.0.0
 */
class AutoUpdateLegacy {

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
	}

	/**
	 * Start EDD/Bitbucket plugin version check
	 *
	 * @since 1.0.0
	 */
	public function check_update() {
		new BitbucketPluginUpdater( $this->bitbucket, $this->edd );
	}
}