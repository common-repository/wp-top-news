<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include_once WTN_PATH . 'core/api.php';
include_once WTN_PATH . 'core/core.php';
include_once WTN_PATH . 'core/general-settings.php';
include_once WTN_PATH . 'core/country.php';
include_once WTN_PATH . 'core/cache.php';
include_once WTN_PATH . 'core/int-general-settings.php';
include_once WTN_PATH . 'core/featured-settings.php';
include_once WTN_PATH . 'core/ticker-content.php';
include_once WTN_PATH . 'core/ticker-styles.php';

/**
 * Class: Master
*/
class WTN_Master 
{

	protected $wtn_loader;
	protected $wtn_version;
	
	public function __construct() {
		$this->wtn_version = WTN_VRSN;
		add_action( 'plugins_loaded', array($this, WTN_PRFX . 'load_plugin_textdomain') );
		$this->wtn_load_dependencies();
		$this->wtn_trigger_admin_hooks();
		$this->wtn_trigger_front_hooks();
		$this->wtn_trigger_widget_hooks();
	}
	
	function wtn_load_plugin_textdomain(){
		load_plugin_textdomain( 'wp-top-news', FALSE, 'wp-top-news' . '/languages/' );
	}

	private function wtn_load_dependencies(){
		require_once WTN_PATH . 'admin/' . WTN_CLS_PRFX . 'admin.php';
		require_once WTN_PATH . 'front/' . WTN_CLS_PRFX . 'front.php';
		require_once WTN_PATH . 'inc/' . WTN_CLS_PRFX . 'loader.php';
		require_once WTN_PATH . 'widget/' . WTN_CLS_PRFX . 'widget.php';
		$this->wtn_loader = new WTN_Loader();
	}

	private function wtn_trigger_admin_hooks(){
		$wtn_admin = new WTN_Admin( $this->wtn_version() );
		$this->wtn_loader->add_action('admin_enqueue_scripts', $wtn_admin, WTN_PRFX . 'enqueue_assets');
		$this->wtn_loader->add_action('init', $wtn_admin, WTN_PRFX . 'custom_post_type', 10, 1);
		$this->wtn_loader->add_action('admin_menu', $wtn_admin, WTN_PRFX . 'admin_menu', 10, 3);
		$this->wtn_loader->add_action('init', $wtn_admin, 'wtn_register_taxonomy', 10, 1);
		$this->wtn_loader->add_action('add_meta_boxes', $wtn_admin, 'wtn_news_metaboxes', 10, 2);
		$this->wtn_loader->add_action('save_post', $wtn_admin, 'wtn_save_news_meta', 1, 1);
	}

	private function wtn_trigger_front_hooks(){
		$wtn_front = new WTN_Front( $this->wtn_version() );
		$this->wtn_loader->add_action( 'wp_enqueue_scripts', $wtn_front, WTN_PRFX . 'front_assets' );
		$wtn_front->wtn_load_shortcode();
	}

	private function wtn_trigger_widget_hooks() {

		new Wtn_Rss_Widget();
		add_action('widgets_init', function(){ register_widget('Wtn_Rss_Widget'); });
	}

	public function wtn_run(){
		$this->wtn_loader->wtn_run();
	}
	
	public function wtn_version() {
		return $this->wtn_version;
	}

	function wtn_unregister_settings(){
		global $wpdb;
	
		$tbl = $wpdb->prefix . 'options';
		$search_string = WTN_PRFX . '%';
		
		$sql = $wpdb->prepare( "SELECT option_name FROM $tbl WHERE option_name LIKE %s", $search_string );
		$options = $wpdb->get_results( $sql , OBJECT );
	
		if(is_array($options) && count($options)) {
			foreach( $options as $option ) {
				delete_option( $option->option_name );
				delete_site_option( $option->option_name );
			}
		}
	}
}
