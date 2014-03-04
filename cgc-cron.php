<?php
/*
 * Plugin Name: CGC Cron
 * Description: Custom cron events and control for CGC
 * Author: Pippin Williamson
 * Version: 1.0
 */

class CGC_Cron {
	
	public function __construct() {


		add_action( 'wp', array( $this, 'remove_cron_jobs' ), 20 );
		add_action( 'rcp_expired_users_check', array( $this, 'cron_test' ) );
	
	}

	public function remove_cron_jobs() {

		global $blog_ID;

		if( is_main_site() ) {
			return; // Don't modify anything on CGC Hub
		}

		wp_clear_scheduled_hook( 'rcp_expired_users_check' );
		wp_clear_scheduled_hook( 'rcp_send_expiring_soon_notice' );
	}

	public function cron_test() {
		wp_mail( 'mordauk@gmail.com', 'Cron Test', 'This is a test of the cron' );
	}

}
new CGC_Cron;