<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Prevent direct access
}

class AutomateWoo_Timed_Trigger extends AutomateWoo\Trigger {

	/** @var array */
	public $supplied_data_items = array();

	/**
	 * The selected timing for the trigger
	 *
	 * @var string
	 */
	private $timing;

	/**
	 * Set up the trigger details.
	 */
	public function init() {
		$this->title = __( 'Timed Trigger', 'automatewoo-custom' );
		$this->group = __( 'Timed Triggers', 'automatewoo-custom' );
	}

	/**
	 * Add timing selection field to the trigger.
	 */
	public function load_fields() {
		$timing_options = array(
			'automatewoo_two_minute_worker'    => __( 'Every 2 minutes', 'automatewoo-custom' ),
			'automatewoo_five_minute_worker'   => __( 'Every 5 minutes', 'automatewoo-custom' ),
			'automatewoo_fifteen_minute_worker' => __( 'Every 15 minutes', 'automatewoo-custom' ),
			'automatewoo_thirty_minute_worker' => __( 'Every 30 minutes', 'automatewoo-custom' ),
			'automatewoo_hourly_worker'        => __( 'Every hour', 'automatewoo-custom' ),
			'automatewoo_four_hourly_worker'   => __( 'Every 4 hours', 'automatewoo-custom' ),
			'automatewoo_daily_worker'         => __( 'Daily', 'automatewoo-custom' ),
			'automatewoo_two_days_worker'      => __( 'Every 2 days', 'automatewoo-custom' ),
			'automatewoo_weekly_worker'        => __( 'Weekly', 'automatewoo-custom' ),
		);

		$field = new AutomateWoo\Fields\Select();
		$field->set_name('timing');
		$field->set_title( __( 'Run Frequency', 'automatewoo-custom' ) );
		$field->set_options( $timing_options );
		$field->set_required( true );
		$field->set_description( __( 'Select how often this trigger should run.', 'automatewoo-custom' ) );

		$this->add_field( $field );
	}

	/**
	 * Defines the hook when the trigger is run.
	 */
	public function register_hooks() {
		$this->timing = $this->get_option( 'timing' );
		
		if ( $this->timing ) {
			add_action( $this->timing, array( $this, 'catch_hooks' ) );
		}
	}

	/**
	 * Catches the action and triggers the workflow.
	 */
	public function catch_hooks() {
		$this->maybe_run();
	}

	/**
	 * Validates the workflow. Always returns true as this is a time-based trigger.
	 *
	 * @param $workflow AutomateWoo\Workflow
	 * @return bool
	 */
	public function validate_workflow( $workflow ) {
		return true;
	}
}
