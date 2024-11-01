<?php
if (!defined('ABSPATH'))
  exit;

if (!class_exists('WPV_comman')) {

    class WPV_comman {

        protected static $instance;

        public static function instance() {
            if (!isset(self::$instance)) {
                self::$instance = new self();
                self::$instance->init();
            }
             return self::$instance;
        }
         function init() {
            global $wpv_comman;
            $optionget = array(
                'woo_pv_onn_off' => 'on',
                'wpv_gs_layout' => 'layout2',
                'wpv_gs_qol' => 'wpv_dropdown',
                'woopv_vc' => 'sincl',
                'woopv_dts_on_off' => '',
                'wooo_pv_table_serch' => '',
                'woo_pv_to' => 'on',
                'wpv_back_color_table' => '#000000',
                'wpv_color_text' => '#ffffff',
                'woo_pv_image_on_off' => 'on',
                'woo_pv_vname_on_off' => 'on',
                'woo_pv_price_on_off' => 'on',
                'woo_pv_qty_on_off' => 'on',
                'woo_pv_atc_on_off' => 'on',
                'woo_pv_inventory' => 'on',
                'woopv_tra_image_filed' => 'Image',
                'woopv_tra_vname_filed' => 'Variations Name',
                'woopv_tra_price_filed' => 'Price',
                'woopv_tra_inv_filed' => 'Inventory',
                'woopv_tra_qty_filed' => 'Quantity',
                'woopv_tra_atc_filed' => 'Add To Cart',
                'wpv_enable_disable_avi_vari_btn' => 'yes',
                'wpv_avi_vari_btn_text' => 'Available Variations',
                'wpv_atc_loader_gif' => 'loader-1',
                'wpv_view_cart_icon' => 'shop_icon_1',
                'wpv_ed_cart_icon' => 'yes',
                'woopv_tra_added' => 'Added',
            );
           
            foreach ($optionget as $key_optionget => $value_optionget) {
               $wpv_comman[$key_optionget] = get_option( $key_optionget,$value_optionget );
            }
        }
    }

    WPV_comman::instance();
}
?>