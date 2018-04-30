<?php

namespace BitbucketUpdater\Model;

class Bitbucket {

	/**
	 * Bitbucket information
	 * @var
	 */
	public $plugin_file;
	public $plugin_slug;
	public $bb_host = 'https://api.bitbucket.org';
	public $bb_download_host = 'http://bitbucket.org';
	public $bb_owner;
	public $bb_password;
	public $bb_project_name;
	public $bb_repo_name;
}