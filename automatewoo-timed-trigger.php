<?php
/**
 * Plugin Name: AutomateWoo Timed Trigger
 * Description: A custom AutomateWoo trigger that can run at configurable intervals.
 * Version: 1.1
 * Author: WP Special Projects
 * Text Domain: automatewoo-timed-trigger
 */

defined( 'ABSPATH' ) || exit;

add_filter( 'automatewoo/triggers', 'register_automatewoo_timed_trigger' );

/**
 * Add custom triggers.
 *
 * @param array $triggers
 * @return array
 */
function register_automatewoo_timed_trigger( $triggers ) {
	include_once plugin_dir_path( __FILE__ ) . 'class-automatewoo-timed-trigger.php';
	$triggers['automatewoo_timed_trigger'] = 'AutomateWoo_Timed_Trigger';
	return $triggers;
}