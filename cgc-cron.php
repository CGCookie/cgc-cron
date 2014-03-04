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
		add_action( 'rcp_expired_users_check', array( $this, 'expired_cron_notice' ) );
		add_action( 'rcp_send_expiring_soon_notice', array( $this, 'expiring_soon_cron_notice' ) );
	
	}

	public function remove_cron_jobs() {

		global $blog_ID;

		if( is_main_site() ) {
			return; // Don't modify anything on CGC Hub
		}

		wp_clear_scheduled_hook( 'rcp_expired_users_check' );
		wp_clear_scheduled_hook( 'rcp_send_expiring_soon_notice' );
	}

	public function expired_cron_notice() {
		wp_mail( 'mordauk@gmail.com', 'CGC RCP Expired Check Ran', 'The cron job to check for expired users on CGCookie has just run. Time ' . date( 'Y-m-d H:i:s', current_time( 'timestamp' ) ) );
	}

	public function expiring_soon_cron_notice() {
		wp_mail( 'mordauk@gmail.com', 'CGC RCP Expiring Soon Check Ran', 'The cron job to check for expiring soon users on CGCookie has just run. Time ' . date( 'Y-m-d H:i:s', current_time( 'timestamp' ) ) );
	}

}
new CGC_Cron;