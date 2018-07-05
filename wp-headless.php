<?php
/***
Plugin Name:  WP Headless
Plugin URI:
Description:  A lightweight plugin to disable the WP frontend experience.
Version:      0.0.1
Author:       Joe Bailey-Roberts
Author URI:   http://joebr.io
License:      GPL3
License URI:  https://www.gnu.org/licenses/gpl-3.0.html
Text Domain:  wp-headless
Domain Path:  /languages

@package wp-headless
 */

add_action( 'wp_head', 'wph_frontend_redirect' );

/**Function to check user status and redirect as appropriately */
function wph_frontend_redirect() {

	if ( is_front_page() ) {

		wp_safe_redirect( get_admin_url() );
		exit;

	} else {

		$post_ID        = get_the_id();
		$post_permalink = get_permalink( $post_ID );

		if ( is_user_logged_in() ) {
			wp_safe_redirect( $post_permalink );
			exit;
		} else {
			wp_safe_redirect( wp_login_url( $post_permalink ) );
			exit;
		}
	}

}
