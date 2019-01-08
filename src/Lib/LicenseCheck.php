<?php

namespace BitbucketUpdater\Lib;

use BitbucketUpdater\Model\Edd;

class LicenseCheck {

	/**
	 * Validate given key
	 *
	 * @param $license_key  string  License key
	 * @param \BitbucketUpdater\Model\Edd $edd object  Edd object
	 *
	 * @return bool
	 *
	 * @since 1.0.0
	 * @version 2.2.0
	 */
	public static function is_license_key_valid( $license_key, Edd $edd ) {
		if ( empty( $license_key ) ) {
			return false;
		}

		$store_url  = $edd->store_url;
		$item_name  = $edd->item_name;
		$item_id    = $edd->item_id;
		$license    = $license_key;
		$api_params = array(
			'edd_action' => 'check_license',
			'license'    => $license,
			'item_id'    => $item_id,
			'item_name'  => urlencode( $item_name ),
			'url'        => home_url()
		);
		$response   = wp_remote_post( $store_url, array(
			'body'      => $api_params,
			'timeout'   => 15,
			'sslverify' => false
		) );
		if ( is_wp_error( $response ) ) {
			return false;
		}

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		if ( $license_data->license == 'valid' ) {
			return true;
		} else {
			return false;
		}
	}
}