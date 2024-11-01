<?php 
/**
* Plugin Name: Variation Table For Woocommerce
* Description: This plugin allows create Variation Table plugin.
* Version: 1.0
* Copyright: 2020
* Text Domain: variation-table-for-woocommerce
* Domain Path: /languages 
*/

if (!defined('ABSPATH')) {
    die('-1');
}
if (!defined('WOO_PV_PLUGIN_NAME')) {
    define('WOO_PV_PLUGIN_NAME', 'Variation Table For Woocommerce');
}
if (!defined('WOO_PV_PLUGIN_VERSION')) {
    define('WOO_PV_PLUGIN_VERSION', '1.0.0');
}
if (!defined('WOO_PV_PLUGIN_FILES')) {
    define('WOO_PV_PLUGIN_FILES', __FILE__);
}
if (!defined('WOO_PV_PLUGIN_DIRS')) {
    define('WOO_PV_PLUGIN_DIRS',plugins_url('', __FILE__));
}
if (!defined('WOO_PV_BASE_NAME')) {
    define('WOO_PV_BASE_NAME', plugin_basename(WOO_PV_PLUGIN_FILES));
}
if (!defined('WOO_PV_DOMAIN')) {
    define('WOO_PV_DOMAIN', 'variation-table-for-woocommerce');
}


if (!class_exists('woo_pv')) {

	class woo_pv {

		protected static $woopv;		

		function wpv_front_load_js_css(){
			wp_enqueue_style( 'woo_pv_data_tablelas', WOO_PV_PLUGIN_DIRS . '/include/DataTables/datatables.min.css', false, '1.0.0' );
			wp_enqueue_style( 'woo_pv_data_tablelasda', WOO_PV_PLUGIN_DIRS . '/include/DataTables/responsive.dataTables.min.css', false, '1.0.0' );
			wp_enqueue_style( 'woo_pv_data_tablel_res', WOO_PV_PLUGIN_DIRS . '/include/DataTables/jquery.dataTables.min.css', false, '1.0.0' );
			wp_enqueue_script( 'woo_pv_data_table_mjs', plugin_dir_url( __FILE__ ) . 'include/DataTables/datatables.min.js', array(), '1.0.0' );
			wp_enqueue_script( 'woo_pv_js_data', plugin_dir_url( __FILE__ ) . 'include/DataTables/dataTables.responsive.min.js', array(), '1.0.0' );
			wp_enqueue_style( 'woo_pv_data_tablelass', plugin_dir_url( __FILE__ ) . 'include/css/front_style.css', array(), '1.0.0' );
			wp_enqueue_script( 'woo_pv_js', plugin_dir_url( __FILE__ ) . 'include/js/front-script.js', array(), '1.0.0' );

			$wpv_gs_qol= get_option('wpv_gs_qol' , 'wpv_dropdown');
			$woopv_tra_added = get_option( 'woopv_tra_added' ,'Added');
			$woo_pv_qty_on_off = get_option( 'woo_pv_qty_on_off' ,'Added');
			$wpv_gs_layout= get_option('wpv_gs_layout' , 'wpv_dropdown');
			$woo_pv_data_array = WOO_PV_PLUGIN_DIRS;
			$data = [
                'wpv_gs_qol' => $wpv_gs_qol,
                'wpv_gs_layout' => $wpv_gs_layout,
             	'woo_pv_plugin_url' => $woo_pv_data_array,
             	'wpv_front_ajax_url' => admin_url( 'admin-ajax.php' ),
             	'woopv_tra_added' => $woopv_tra_added,
             	'woo_pv_qty_on_off' => $woo_pv_qty_on_off,
            ];
			wp_localize_script( 'woo_pv_js', 'WOOPVdata', $data );
		}

		function wpv_plugin_row_meta( $links, $file ) {
            if ( WOO_PV_BASE_NAME === $file ) {
                $row_meta = array(
                    'rating'    =>  '<a href="https://oceanwebguru.com/variation-table-for-woocommerce/" target="_blank">Documentation</a> | <a href="https://oceanwebguru.com/contact-us/" target="_blank">Support</a> | <a href="https://wordpress.org/support/plugin/variation-table-for-woocommerce/reviews/?filter=5" target="_blank"><img src="'.WOO_PV_PLUGIN_DIRS.'/include/images/star.png" class="woo_pv_rating_div"></a>',
                );

                return array_merge( $links, $row_meta );
            }
            return (array) $links;
        }

		function wpv_admin_load_js_css(){
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_style( 'woo_pv_admin_style', WOO_PV_PLUGIN_DIRS . '/include/css/style.css', false, '1.0.0' );
			wp_enqueue_script( 'woo_pv_admin_script', plugin_dir_url( __FILE__ ) . 'include/js/admin-script.js', array(), '1.0.0' );
			wp_localize_script( 'woo_pv_admin_script', 'wpv_ajax',array('wpv_ajax_url' => admin_url( 'admin-ajax.php' ) ) );
			wp_enqueue_style( 'wp-color-picker');
			wp_enqueue_script( 'wp-color-picker-alpha', WOO_PV_PLUGIN_DIRS . '/include/js/wp-color-picker-alpha.js', array( 'wp-color-picker' ), '1.0.0', true );
		}

		function includes() {
			include('admin/woo-pv-comman.php');
			include('admin/woo-pv-svg.php'); 
			include('admin/woo-pv-admin.php'); 
			include('admin/woo-pv-kit.php'); 
			include('admin/woo-pv-ajax.php'); 
			include('front/woo-pv-front.php'); 
		}


		function init() {
			add_action('admin_enqueue_scripts', array($this, 'wpv_admin_load_js_css'));
            add_action('wp_enqueue_scripts', array($this, 'wpv_front_load_js_css'));
            add_filter( 'plugin_row_meta', array( $this, 'wpv_plugin_row_meta' ), 10, 2 );

		}

		 public static function woopv() {
            if (!isset(self::$woopv)) 
            {
                self::$woopv = new self();
                self::$woopv->init();
                self::$woopv->includes();
            }
            return self::$woopv;
        }

	}
	add_action('plugins_loaded', array('woo_pv', 'woopv'));
}


add_action( 'plugins_loaded', 'wpv_load_textdomain' );
function wpv_load_textdomain() {
    load_plugin_textdomain( 'variation-table-for-woocommerce', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

add_filter( 'load_textdomain_mofile', 'wpv_plugin_load_own_textdomain', 10, 2 );
function wpv_plugin_load_own_textdomain( $mofile, $domain ) {
    if ( 'variation-table-for-woocommerce' === $domain && false !== strpos( $mofile, WP_LANG_DIR . '/plugins/' ) ) {
        $locale = apply_filters( 'plugin_locale', determine_locale(), $domain );
        $mofile = WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) . '/languages/' . $domain . '-' . $locale . '.mo';
    }
    return $mofile;
}