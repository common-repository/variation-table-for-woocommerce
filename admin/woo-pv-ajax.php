<?php

if (!defined('ABSPATH'))
   exit;

if (!class_exists('woo_pv_ajax')){

	class woo_pv_ajax
	{
		protected static $woopv;


		function wpv_filed_sortable(){

			//$data = sanitize_text_field($_POST['data']);
			$data = isset( $_POST['data'] ) ? (array) $_POST['data'] : array();
			update_option( 'woo_pv_colume_numbber', $data );
			exit();
		}

		function wpv_pro_add_to_cart(){
			global $woocommerce;
		
			$pro_id = sanitize_text_field($_POST['pro_id']);
			$pro_var_id = sanitize_text_field($_POST['pro_var_id']);
			$pro_qty_id = sanitize_text_field($_POST['pro_qty']);
			$var_name = sanitize_text_field($_POST['var_name']);
			$var_val = sanitize_text_field($_POST['var_val']);
			$attr_name = explode(',', $var_name);
			$attr_val = explode(',', $var_val);
			$array = array();
			foreach ($attr_name as $key => $value) {
				$array[$value] = $attr_val[$key];
			}
			WC()->cart->add_to_cart( $pro_id, $pro_qty_id, $pro_var_id, $array );
			do_action('woocommerce_ajax_added_to_cart', $pro_id);
			WC_AJAX::get_refreshed_fragments();
			exit();

		}

		function init(){

			add_action( 'wp_ajax_wpv_filed_sortable',array($this, 'wpv_filed_sortable' ));
    		add_action( 'wp_ajax_nopriv_wpv_filed_sortable',array($this, 'wpv_filed_sortable' ));
    		add_action( 'wp_ajax_wpv_pro_add_to_cart',array($this, 'wpv_pro_add_to_cart' ));
    		add_action( 'wp_ajax_nopriv_wpv_pro_add_to_cart',array($this, 'wpv_pro_add_to_cart' ));

		}

		public static function woopv() {
         	if (!isset(self::$woopv)) {
            	self::$woopv = new self();
            	self::$woopv->init();
         	}
         	return self::$woopv;
      	}
	}
	woo_pv_ajax::woopv();
}
?>