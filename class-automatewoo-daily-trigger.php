<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Prevent direct access
}

/**
 * A trigger that is triggered daily at midnight.
 */
class AutomateWoo_Daily_Trigger extends AutomateWoo\Trigger {

	/** 
     * Define which data items are set by this trigger.
	 * 
	 * @var array 
	 */
	public $supplied_data_items = array();

	/**
	 * Set up the trigger details.
	 */
	public function init() {
		$this->title = __( 'Runs Daily', 'automatewoo-custom' );
		$this->group = __( 'Timed Triggers', 'automatewoo-custom' );
	}

	/**
	 * Add any fields to the trigger (optional).
	 */
	public function load_fields() {}

	/**
	 * Defines the hook when the trigger is run.
	 */
	public function register_hooks() {
		add_action( 'automatewoo_daily_worker', array( $this, 'catch_hooks' ) );
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
