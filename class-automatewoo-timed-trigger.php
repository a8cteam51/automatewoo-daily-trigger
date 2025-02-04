<?php

class AutomateWoo_Timed_Trigger extends AutomateWoo\Trigger {

	/** @var array */
	public $supplied_data_items = array();

	/**
	 * Set up the trigger details.
	 */
	public function load_admin_details() {
		$this->title = __( 'Timed Trigger', 'automatewoo-custom' );
		$this->group = __( 'Timed Triggers', 'automatewoo-custom' );
		
		$this->load_fields();
	}

	/**
	 * Register hooks for all timing options
	 */
	public function register_hooks() {
		$timing_hooks = array(
			'automatewoo_two_minute_worker',
			'automatewoo_five_minute_worker',
			'automatewoo_fifteen_minute_worker',
			'automatewoo_thirty_minute_worker',
			'automatewoo_hourly_worker',
			'automatewoo_four_hourly_worker',
			'automatewoo_daily_worker',
			'automatewoo_two_days_worker',
			'automatewoo_weekly_worker'
		);

		foreach ( $timing_hooks as $hook ) {
			add_action( $hook, array( $this, 'handle_timing_hook' ) );
		}
	}

	/**
	 * Handle timing hook execution
	 */
	public function handle_timing_hook() {
		$current_hook = current_filter();
		$this->maybe_run(
			array(),
			array(
				'timing' => $current_hook
			)
		);
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
		$field->set_name( 'timing' );
		$field->set_title( __( 'Run Frequency', 'automatewoo-custom' ) );
		$field->set_options( $timing_options );
		$field->set_required( true );
		$field->set_description( __( 'Select how often this trigger should run.', 'automatewoo-custom' ) );

		$this->add_field( $field );
	}

	/**
	 * Validate the workflow before running.
	 *
	 * @param \AutomateWoo\Workflow $workflow
	 * @return bool
	 */
	public function validate_workflow( $workflow ) {
		$timing = $workflow->get_trigger_option( 'timing' );
		$current_hook = current_filter();

		return $timing === $current_hook;
	}

	/**
	 * Get the name of this trigger.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'automatewoo_timed_trigger';
	}
}