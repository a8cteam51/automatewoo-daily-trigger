<?php
/**
 * Plugin Name: AutomateWoo Daily Trigger
 * Description: A custom AutomateWoo trigger that runs daily.
 * Version: 1.0
 * Author: WP Special Projects
 * Text Domain: automatewoo-daily-trigger
 */

defined( 'ABSPATH' ) || exit;

add_filter( 'automatewoo/triggers', 'register_automatewoo_daily_trigger' );

/**
 * Add custom triggers.
 *
 * @param array $triggers
 * @return array
 */
function register_automatewoo_daily_trigger( $triggers ) {

	include_once plugin_dir_path( __FILE__ ) . 'class-automatewoo-daily-trigger.php';

	$triggers['automatewoo_daily_trigger'] = 'AutomateWoo_Daily_Trigger';

	return $triggers;
}
