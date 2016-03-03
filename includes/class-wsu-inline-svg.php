<?php

class WSU_Inline_SVG {
	/**
	 * @var WSU_Inline_SVG
	 */
	private static $instance;

	/**
	 * @var array A list of inline SVGs registered with the plugin.
	 */
	public $registered_svgs = array();

	/**
	 * Maintain and return the one instance. Initiate hooks when
	 * called the first time.
	 *
	 * @since 0.0.1
	 *
	 * @return \WSU_Inline_SVG
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new WSU_Inline_SVG();
			self::$instance->setup_hooks();
		}
		return self::$instance;
	}

	/**
	 * Setup hooks to include.
	 *
	 * @since 0.0.1
	 */
	public function setup_hooks() {
		add_action( 'init', array( $this, 'add_shortcode' ), 10 );
		add_action( 'init', array( $this, 'register_svgs' ), 15 );
	}

	/**
	 * Add the `wsu_inline_svg` shortcode used to display an inline SVG.
	 *
	 * @since 0.0.1
	 */
	public function add_shortcode() {
		add_shortcode( 'wsu_inline_svg', array( $this, 'wsu_inline_svg_callback' ) );
	}

	/**
	 * Fire the `wsu_register_inline_svg` hook so that themes and plugins do not
	 * need to explicitly check for the existence of this plugin.
	 */
	public function register_svgs() {
		do_action( 'wsu_register_inline_svg' );
	}

	/**
	 * Process the `wsu_inline_svg` shortcode.
	 *
	 * @param $atts
	 *
	 * @return string
	 */
	public function wsu_inline_svg_callback( $atts ) {
		if ( ! isset( $atts['id'] ) || empty( $atts['id'] ) ) {
			return '';
		}

		if ( isset( $this->registered_svgs[ $atts['id'] ] ) ) {
			return $this->registered_svgs[ $atts['id'] ];
		}

		return '';
	}

	/**
	 * Handle the registration of inline SVG data.
	 *
	 * @param $svg_id
	 * @param $svg_data
	 *
	 * @return bool|WP_Error
	 */
	public function register_inline_svg( $svg_id, $svg_data ) {
		$svg_id = sanitize_key( $svg_id );

		if ( isset( $this->registered_svgs[ $svg_id ] ) ) {
			return new WP_Error( 'WSU Inline SVG Error', 'This SVG ID is already registered.' );
		}

		$this->registered_svgs[ $svg_id ] = $svg_data;

		return true;
	}
}
