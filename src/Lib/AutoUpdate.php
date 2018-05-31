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

		add_action( 'admin_init', array( $this, 'check_update') );
	}

	/**
	 * Start bitbucket plugin version check
	 *
	 * @since 1.2.1
	 */
	public function check_update() {
		new BitbucketPluginUpdater( $this->bitbucket, $this->edd );
	}

}