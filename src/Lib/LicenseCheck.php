<?php

namespace BitbucketUpdater\Lib;

use BitbucketUpdater\Model\Edd;

class LicenseCheck {

	public static function is_license_key_valid( $license_key, Edd $edd ) {
		$store_url  = $edd->store_url;
		$item_name  = $edd->item_name;
		$license    = $license_key;
		$api_params = array(
			'edd_action' => 'activate_license',
			'license'    => $license,
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