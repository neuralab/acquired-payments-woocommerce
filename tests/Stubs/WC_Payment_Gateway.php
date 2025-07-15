<?php
declare( strict_types = 1 );

class WC_Payment_Gateway {
		/**
		 * Gateway ID
		 *
		 * @var string
		 */
	public $id;

	/**
	 * Gateway method title
	 *
	 * @var string
	 */
	public $method_title;

	/**
	 * Gateway method description
	 *
	 * @var string
	 */
	public $method_description;

	/**
	 * Gateway has fields
	 *
	 * @var bool
	 */
	public $has_fields;

	/**
	 * Gateway supports
	 *
	 * @var array
	 */
	public $supports;

	/**
	 * Gateway form fields
	 *
	 * @var array
	 */
	public $form_fields;

	/**
	 * Gateway title
	 *
	 * @var string
	 */
	public $title;

	/**
	 * Gateway description
	 *
	 * @var string
	 */
	public $description;

	/**
	 * Init settings.
	 *
	 * @return void
	 */
	public function init_settings() : void {}
}
