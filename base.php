<?php 

use \Elementor\Plugin as Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

final class Pawelements_Extension {
	
	const VERSION = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.6.0';
	const MINIMUM_PHP_VERSION = '5.6';


	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	

	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}

	public function i18n() {
		load_plugin_textdomain( 'pawelements' );
	}

	

	public function init() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}
		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		//add_action( 'elementor/editor/after_enqueue_styles', array ( $this, 'pawelements_editor_styles' ) );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/elements/categories_registered',[$this,'register_new_category']);
		add_action( 'wp_enqueue_scripts', array( $this, 'pawelements_register_frontend_styles' ), 10 );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'pawelements_frontend_before_scripts' ] );
		add_action( 'elementor/frontend/before_register_scripts', [ $this, 'pawelements_register_frontend_scripts' ] );
		
	}
	

	function pawelements_frontend_before_scripts(){
		wp_enqueue_script('pawelem-accordion',
			PAWELEMENTS_ASSETS_PUBLIC .'js/pawelem-accordion.js',
			array('jquery'), PAWELEMENTS_VERSION, true);
	}

	/**
	 * Load Frontend Script
	 *
	*/
	public function pawelements_register_frontend_scripts(){
		wp_enqueue_script('matchHeight',
			PAWELEMENTS_ASSETS_VENDOR .'matchHeight-js/matchHeights.js',
			array('jquery'), PAWELEMENTS_VERSION, true);

		wp_enqueue_script('bootstrap-bundel',
			PAWELEMENTS_ASSETS_VENDOR .'bootstrap/bootstrap.bundel.js',
			array('jquery'), PAWELEMENTS_VERSION, true);

		wp_enqueue_script('min-js',
			PAWELEMENTS_ASSETS_PUBLIC .'js/pawelem-min.js',
			array('jquery'), PAWELEMENTS_VERSION, true);


	}



	/**
	 * Load Frontend Styles
	 *
	*/
	public function pawelements_register_frontend_styles(){
		wp_enqueue_style(
			'pawelements-bootstrap-css',
			 PAWELEMENTS_ASSETS_VENDOR .'bootstrap/bootstrap.main.css',
			 null, PAWELEMENTS_VERSION
		);

		wp_enqueue_style(
			'pawelements-button',
			 PAWELEMENTS_ASSETS_PUBLIC .'css/widget/button.css',
			 null, PAWELEMENTS_VERSION
		);

		wp_enqueue_style(
			'pawelements-logo',
			 PAWELEMENTS_ASSETS_PUBLIC .'css/widget/logo.css',
			 null, PAWELEMENTS_VERSION
		);
		wp_enqueue_style(
			'pawelements-team',
			 PAWELEMENTS_ASSETS_PUBLIC .'css/widget/team.css',
			 null, PAWELEMENTS_VERSION
		);

		wp_enqueue_style(
			'pawelem-accordion',
			 PAWELEMENTS_ASSETS_PUBLIC .'css/widget/accordion.css',
			 null, PAWELEMENTS_VERSION
		);
	}

	/**
	 * Load Frontend Styles
	 *
	*/
	

	/**
	 * Widgets Catgory
	 *
	*/
	public function register_new_category($manager){
	   $manager->add_category('pawelements',
			[
				'title' => __( 'Pawelements Companion  Addons', 'pawelements-companion' ),
			]);
	}

	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'pawelements-companion' ),
			'<strong>' . esc_html__( 'Elementor Pawelements Extension', 'pawelements-companion' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'pawelements-companion' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'pawelements-companion' ),
			'<strong>' . esc_html__( 'Elementor Pawelements Extension', 'pawelements-companion' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'pawelements-companion' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'pawelements-companion' ),
			'<strong>' . esc_html__( 'Elementor Pawelements Extension', 'pawelements-companion' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'pawelements-companion' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function init_widgets() {

		$widgets_manager = \Elementor\Plugin::instance()->widgets_manager;
		//Include Widget files

		//Button Widget
		require_once( PAWELEMENTS_ADDONS_DIR . 'button/widgets.php' );
		$widgets_manager->register_widget_type( new \Pawelements\Widgets\Elementor\Pawelements_Button() );

		//Team Widget
		require_once( PAWELEMENTS_ADDONS_DIR . 'team/widgets.php' );
		$widgets_manager->register_widget_type( new \Pawelements\Widgets\Elementor\Pawelements_Team() );

		//Logo Widget
		require_once( PAWELEMENTS_ADDONS_DIR . 'logo/widgets.php' );
		$widgets_manager->register_widget_type( new \Pawelements\Widgets\Elementor\Pawelements_Logo() );

		//Accordion Widget
		require_once( PAWELEMENTS_ADDONS_DIR . 'accordion/widgets.php' );
		$widgets_manager->register_widget_type( new \Pawelements\Widgets\Elementor\Pawelements_accordion() );
		

	}


}

Pawelements_Extension::instance();
