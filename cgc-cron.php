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
	
	}

	public function remove_cron_jobs() {

		global $blog_ID;

		if( is_main_site() ) {
			return; // Don't modify anything on CGC Hub
		}

		wp_clear_scheduled_hook( 'rcp_expired_users_check' );
		wp_clear_scheduled_hook( 'rcp_send_expiring_soon_notice' );
	}

}
new CGC_Cron;