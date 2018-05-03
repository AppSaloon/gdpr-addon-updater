<?php

namespace BitbucketUpdater\Model;

/**
 * This class stores EDD plugin info
 *
 * @package BitbucketUpdater\Model
 */
class Edd {

	/**
	 * EDD download name - post title
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	public $item_name;

	/**
	 * The website where the EDD works
	 *
	 * @var string  website url
	 *
	 * @since 1.0.0
	 */
	public $store_url = 'https://wp-gdpr.eu/';

	/**
	 * License key - option key for options table
	 * @var string
	 *
	 * @since 1.0.0
	 */
	public $license_option;

	/**
	 * Plugins name
	 *
	 * @var
	 *
	 * @since 1.0.0
	 */
	public $plugin_name;

	/**
	 * Delete option in options table
	 *
	 * @since 1.0.0
	 */
	public function delete_option() {
		delete_option( $this->license_option );
	}

	/**
	 * Updates option in option table
	 *
	 * @param $value
	 *
	 * @since 1.0.0
	 */
	public function update_option( $value ) {
		update_option( $this->license_option, $value );
	}

	/**
	 * Returns option value
	 *
	 * @return string
	 *
	 * @since 1.0.3
	 */
	public function get_license_key() {
		return get_option( $this->license_option );
	}

}