<?php
/**
 * Plugin Name: TR jQuery $ Fix
 * Description: Fixes broken `$ = $ || jQuery` inline script that throws ReferenceError and freezes mobile Pre-Rolls.
 * Version: 1.0.0
 * Author: Twisted Roots Fix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Declare $ early so any bad `$ = $ || jQuery` inline after jquery-core cannot throw.
 */
add_action( 'wp_head', function () {
	echo "<script>var \$;</script>\n";
}, 0 );

/**
 * Replace known bad inline scripts attached to jquery-core with a safe assignment.
 */
add_action( 'wp_enqueue_scripts', function () {
	global $wp_scripts;
	if ( ! $wp_scripts instanceof WP_Scripts ) {
		return;
	}
	foreach ( array( 'before', 'after' ) as $position ) {
		$data = $wp_scripts->get_data( 'jquery-core', $position );
		if ( empty( $data ) || ! is_array( $data ) ) {
			continue;
		}
		$changed = false;
		foreach ( $data as $i => $code ) {
			if ( ! is_string( $code ) ) {
				continue;
			}
			if ( false !== strpos( $code, '$ = $ || jQuery' ) || false !== strpos( $code, '$=$||jQuery' ) ) {
				$data[ $i ] = 'window.$ = window.jQuery;';
				$changed      = true;
			}
		}
		if ( $changed ) {
			$wp_scripts->add_data( 'jquery-core', $position, $data );
		}
	}
	// Also ensure a correct alias exists after jquery-core.
	wp_add_inline_script( 'jquery-core', 'window.$ = window.jQuery;', 'after' );
}, 9999 );
