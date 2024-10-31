<?php
/*
Plugin Name: Oktopost Tracking Code
Version: 1.1
Description: Automatically append the Oktopost tracking code to your WordPress template.
Author: Liad Guez
Author URI: http://www.oktopost.com
*/

class Oktopost_Tracking_Code {

	const OPT_ACCOUNT_ID 	= 'oktopost_account_id';
	const SETTINGS_GROUP 	= 'oktopost-settings-group';


	public function __construct() {
		if (is_admin()) {
			add_action('admin_menu', array($this, 'plugin_setup_menu'));
			add_action('admin_init', array($this, 'register_settings'));


		} else {
			add_action('wp_head', array($this, 'print_tracking_code'));
		}	
	}
	

	/**
	 * Print the tracking code if account Id is valid.
	 */
	public function print_tracking_code() {
		if (($accountId = $this->get_account_id()) && $this->is_valid_account_id()) {
			require_once 'includes/tracking-code.php';	
		}
	}

	/**
	 * Add admin page to Settings in menu.
	 */
	public function plugin_setup_menu() {
		add_options_page(
			'Oktopost Tracking Code Setup', 
			'Oktopost', 
			'manage_options', 
			'oktopost-plugin', 
			array($this, 'display_setup_page'));
	}

	/**
	 * Display admin template.
	 */
	public function display_setup_page() {
		require_once 'includes/admin-page.php';
	}

	/**
	 * Register settings.
	 */
	public function register_settings() {
		register_setting(self::SETTINGS_GROUP, self::OPT_ACCOUNT_ID);
	}

	/**
	 * Validate account Id format.
	 * @return bool
	 */
	public function is_valid_account_id() {
		$accountId = $this->get_account_id();

		if (strlen($accountId) != 15) {
			return false;
		}

		if (substr($accountId, 0, 3) != '001') {
			return false;
		}

		if (!ctype_alnum($accountId)) {
			return false;
		}

		return true;
	}


	/**
	 * @return string
	 */
	private function get_account_id() {
		return get_option(self::OPT_ACCOUNT_ID, '');
	}
}

new Oktopost_Tracking_Code();