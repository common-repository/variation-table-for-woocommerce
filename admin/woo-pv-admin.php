<?php

if (!defined('ABSPATH'))
   exit;
	
if (!class_exists('woo_pv_admin')){

	class woo_pv_admin
	{
		protected static $woopv;

		function WOOPV_admin_manu_setting() {
	    	add_menu_page(__( 'Woo-pv', 'variation-table-for-woocommerce' ),__( 'Woo Variations Table', 'variation-table-for-woocommerce' ),'manage_options','woopv',array($this,'WOOPV_General_setting'));
		}

		function WOOPV_General_setting(){
			global $wpv_comman,$woo_pv_svg;
			?>
			<div class="woo_pv_man_tab">
				<form method="post">
					<div class="wrap">
			        	<h2><?php echo __('Woocommerce Variations Table','variation-table-for-woocommerce');?></h2>    		
			    	</div>
					<ul class="wpv_tab">
						<li data-tab="wooo-pv-genral-setting" class="wpv_like wpv_tab_carrent"><?php echo __('General Settings','variation-table-for-woocommerce');?></li>
						<li data-tab="wooo-pv-table-columns" class="wpv_like"><?php echo __('Table Columns','variation-table-for-woocommerce');?></li>
						<li data-tab="wooo-pv-translations" class="wpv_like"><?php echo __('Translations','variation-table-for-woocommerce');?></li>
					</ul>
					<?php wp_nonce_field( 'wpv_nonce_action', 'wpv_nonce_field' ); ?>
					<div id="wooo-pv-genral-setting" class="wpv_tab_content wpv_tab_content_carrent">
						<div class="wpv_gs_tabelv">
							<div class="wpv_table_coovver_div">
								<h2><?php echo __('General','variation-table-for-woocommerce');?></h2>
								<table class="wpv_gst_data">
									<tr>
										<th><label><?php echo __('Variations','variation-table-for-woocommerce');?></label></th>
										<td>
											<input type="checkbox" name="wpv_comman[woo_pv_onn_off]" value="on" <?php if($wpv_comman['woo_pv_onn_off'] == 'on' ){ echo "checked"; } ?>>
										</td>
									</tr>
									<tr>
										<th><label><?php echo __('layout','variation-table-for-woocommerce');?></label></th>
										<td>
											<input type="radio" name="wpv_comman[wpv_gs_layout]" value="layout1" <?php if ($wpv_comman['wpv_gs_layout'] == 'layout1') {echo "checked";} ?>>layout1
											<input type="radio" name="wpv_comman[wpv_gs_layout]" value="layout2" <?php if ($wpv_comman['wpv_gs_layout'] == 'layout2') {echo "checked";} ?>>layout2
										</td>
									</tr>
									<tr>
										<th><label><?php echo __('Quantity option layout','variation-table-for-woocommerce');?></label></th>
										<td>
											<input type="radio" name="wpv_comman[wpv_gs_qol]" value="wpv_number" <?php if ($wpv_comman['wpv_gs_qol'] == 'wpv_number') {echo "checked";} ?>>Number
											<input type="radio" name="wpv_comman[wpv_gs_qol]" value="wpv_dropdown" <?php if ($wpv_comman['wpv_gs_qol'] == 'wpv_dropdown') {echo "checked";} ?>>Dropdown
										</td>
									</tr>
									<tr>
										<th><label><?php echo __('Variations Colums','variation-table-for-woocommerce');?></label></th>
										<td>
											<input type="radio" name="wpv_comman[woopv_vc]" value="sincl" <?php if ($wpv_comman['woopv_vc'] == 'sincl') {echo "checked";} ?>>Single Columns
											<input type="radio" name="wpv_comman[woopv_vc]" value="sepc2" <?php if ($wpv_comman['woopv_vc'] == 'sepc2') {echo "checked";} ?>>Separate Columns
										</td>
									</tr>
									<tr>
										<th><label><?php echo __('Data Table Search','variation-table-for-woocommerce');?></label></th>
										<td>
											<input type="checkbox" name="wpv_comman[woopv_dts_on_off]" value="on" <?php if ($wpv_comman['woopv_dts_on_off'] == 'on') {echo "checked";} ?>>
										</td>
									</tr>
									<tr>
										<th><label><?php echo __('Table Search','variation-table-for-woocommerce');?></label></th>
										<td><input type="checkbox" name="wpv_comman[wooo_pv_table_serch]" value="on" <?php if ($wpv_comman['wooo_pv_table_serch'] == 'on') {echo "checked";} ?>></td>
									</tr>
									<tr>
										<th><label><?php echo __('Table Ordering','variation-table-for-woocommerce');?></label></th>
										<td><input type="checkbox" name="wpv_comman[woo_pv_to]" value="on" <?php if ($wpv_comman['woo_pv_to'] == 'on') {echo "checked";} ?>></td>
									</tr>
									
									<tr>
										<th><label><?php echo __('Table Herder Background Color','variation-table-for-woocommerce');?></label></th>
										<td><input type="text" class="color-picker" data-alpha="true" data-default-color="<?php echo $wpv_comman['wpv_back_color_table']; ?>" name="wpv_comman[wpv_back_color_table]" value="<?php echo $wpv_comman['wpv_back_color_table']; ?>"/></td>
									</tr>
									<tr>
										<th><label><?php echo __('Table Herder Text Color','variation-table-for-woocommerce');?></label></th>
										<td><input type="text" class="color-picker" data-alpha="true" data-default-color="<?php echo $wpv_comman['wpv_color_text']; ?>" name="wpv_comman[wpv_color_text]" value="<?php echo $wpv_comman['wpv_color_text']; ?>"/></td>
									</tr>
									<tr>
										<th><label><?php echo __('Enable/Disable Avilable Variation Button','variation-table-for-woocommerce');?></label></th>
										<td><input type="checkbox" name="wpv_comman[wpv_enable_disable_avi_vari_btn]" value="yes" <?php if($wpv_comman['wpv_enable_disable_avi_vari_btn'] == 'yes'){echo "checked";}?>/></td>
									</tr>
									<tr>
										<th><label><?php echo __('Enable/Disable Cart Icon','variation-table-for-woocommerce');?></label></th>
										<td>
											<input type="checkbox" name="wpv_comman[wpv_ed_cart_icon]" value="yes" <?php if($wpv_comman['wpv_ed_cart_icon'] == 'yes'){echo "checked";}?>>
										</td>
									</tr>
									<tr>
										<th><label><?php echo __('View cart icon','variation-table-for-woocommerce');?></label></th>
										<td class="wpv_cart_icon">
											<input type="radio" name="wpv_comman[wpv_view_cart_icon]" id="shop_icon_1" value="shop_icon_1" <?php if($wpv_comman['wpv_view_cart_icon'] == 'shop_icon_1'){echo "checked";}?>>
											<label for="shop_icon_1"><?php echo $woo_pv_svg['shop_icon_1'];?></label>
											<input type="radio" name="wpv_comman[wpv_view_cart_icon]" id="shop_icon_2" value="shop_icon_2" <?php if($wpv_comman['wpv_view_cart_icon'] == 'shop_icon_2'){echo "checked";}?>>
											<label for="shop_icon_2"><?php echo $woo_pv_svg['shop_icon_2'];?></label>
											<input type="radio" name="wpv_comman[wpv_view_cart_icon]" id="shop_icon_3" value="shop_icon_3" <?php if($wpv_comman['wpv_view_cart_icon'] == 'shop_icon_3'){echo "checked";}?>>
											<label for="shop_icon_3"><?php echo $woo_pv_svg['shop_icon_3'];?></label>
											<input type="radio" name="wpv_comman[wpv_view_cart_icon]" id="shop_icon_4" value="shop_icon_4" <?php if($wpv_comman['wpv_view_cart_icon'] == 'shop_icon_4'){echo "checked";}?>>
											<label for="shop_icon_4"><?php echo $woo_pv_svg['shop_icon_4'];?></label>
											<input type="radio" name="wpv_comman[wpv_view_cart_icon]" id="shop_icon_5" value="shop_icon_5" <?php if($wpv_comman['wpv_view_cart_icon'] == 'shop_icon_5'){echo "checked";}?>>
											<label for="shop_icon_5"><?php echo $woo_pv_svg['shop_icon_5'];?></label>
											<input type="radio" name="wpv_comman[wpv_view_cart_icon]" id="shop_icon_6" value="shop_icon_6" <?php if($wpv_comman['wpv_view_cart_icon'] == 'shop_icon_6'){echo "checked";}?>>
											<label for="shop_icon_6"><?php echo $woo_pv_svg['shop_icon_6'];?></label>
										</td>
									</tr>
									<tr>
										<th><label><?php echo __('Add to cart loader gif','variation-table-for-woocommerce');?></label></th>
										<td class="wpv_loader_image">
											<input type="radio" name="wpv_comman[wpv_atc_loader_gif]" id="loader-1" value="loader-1" <?php if($wpv_comman['wpv_atc_loader_gif'] == 'loader-1'){echo "checked";}?>>
											<label for="loader-1"><img src="<?php echo WOO_PV_PLUGIN_DIRS.'/include/images/loader-1.gif';?>"></label>
											<input type="radio" name="wpv_comman[wpv_atc_loader_gif]" id="loader-2" value="loader-2" <?php if($wpv_comman['wpv_atc_loader_gif'] == 'loader-2'){echo "checked";}?>>
											<label for="loader-2"><img src="<?php echo WOO_PV_PLUGIN_DIRS.'/include/images/loader-2.gif';?>"></label>
											<input type="radio" name="wpv_comman[wpv_atc_loader_gif]" id="loader-3" value="loader-3" <?php if($wpv_comman['wpv_atc_loader_gif'] == 'loader-3'){echo "checked";}?>>
											<label for="loader-3"><img src="<?php echo WOO_PV_PLUGIN_DIRS.'/include/images/loader-3.gif';?>"></label>
											<input type="radio" name="wpv_comman[wpv_atc_loader_gif]" id="loader-4" value="loader-4" <?php if($wpv_comman['wpv_atc_loader_gif'] == 'loader-4'){echo "checked";}?>>
											<label for="loader-4"><img src="<?php echo WOO_PV_PLUGIN_DIRS.'/include/images/loader-4.gif';?>"></label>
											<input type="radio" name="wpv_comman[wpv_atc_loader_gif]" id="loader-5" value="loader-5" <?php if($wpv_comman['wpv_atc_loader_gif'] == 'loader-5'){echo "checked";}?>>
											<label for="loader-5"><img src="<?php echo WOO_PV_PLUGIN_DIRS.'/include/images/loader-5.gif';?>"></label>
											<input type="radio" name="wpv_comman[wpv_atc_loader_gif]" id="loader-6" value="loader-6" <?php if($wpv_comman['wpv_atc_loader_gif'] == 'loader-6'){echo "checked";}?>>
											<label for="loader-6"><img src="<?php echo WOO_PV_PLUGIN_DIRS.'/include/images/loader-6.gif';?>"></label>
										</td>
									</tr>
								</table>	
							</div>
						</div>
					</div>
					<div id="wooo-pv-table-columns" class="wpv_tab_content">
						<div class="wpv_gs_tabelv">
							<div class="wpv_table_coovver_div">
								<h2><?php echo __('Select Columns To Display Products','variation-table-for-woocommerce');?></h2>
								<table class="wpv_gst_data">
									<tr>
										<th><label><?php echo __('Images','variation-table-for-woocommerce');?></label></th>
										<td class="wpv_gst_filed_checkboox">
											<input type="checkbox" name="wpv_comman[woo_pv_image_on_off]" value="on" <?php if($wpv_comman['woo_pv_image_on_off'] == 'on' ){ echo "checked"; } ?> >
										</td>
									</tr>
									<tr>
										<th><label><?php echo __('Variations Name','variation-table-for-woocommerce');?></label></th>
										<td class="wpv_gst_filed_checkboox">
											<input type="checkbox" name="wpv_comman[woo_pv_vname_on_off]" value="on" <?php if($wpv_comman['woo_pv_vname_on_off'] == 'on' ){ echo "checked"; } ?> >
										</td>
									</tr>
									<tr>
										<th><label><?php echo __('Price','variation-table-for-woocommerce');?></label></th>
										<td>
											<input type="checkbox" name="wpv_comman[woo_pv_price_on_off]" value="on" <?php if($wpv_comman['woo_pv_price_on_off'] == 'on' ){ echo "checked"; } ?>>
										</td>
									</tr>
									<tr>
										<th><label><?php echo __('Quantity','variation-table-for-woocommerce');?></label></th>
										<td>
											<input type="checkbox" name="wpv_comman[woo_pv_qty_on_off]" value="on" <?php if($wpv_comman['woo_pv_qty_on_off'] == 'on' ){ echo "checked"; } ?>>
										</td>
									</tr>
									<tr>
										<th><label><?php echo __('Add To Cart','variation-table-for-woocommerce');?></label></th>
										<td>
											<input type="checkbox" name="wpv_comman[woo_pv_atc_on_off]" value="on" <?php if($wpv_comman['woo_pv_atc_on_off'] == 'on' ){ echo "checked"; } ?>>
										</td>
									</tr>
									<tr>
										<th><label><?php echo __('Inventory','variation-table-for-woocommerce');?></label></th>
										<td>
											<input type="checkbox" name="wpv_comman[woo_pv_inventory]" value="on" <?php if($wpv_comman['woo_pv_inventory'] == 'on' ){ echo "checked"; } ?>>
										</td>
									</tr>
									
								</table>	
							</div>
						</div>
						<div class="wpv_gs_tabelv">
							<div class="wpv_table_coovver_div">
								<h2>Field ordering</h2>
								<div class="wpv_fd">
									<span class="wpv_note">(If you want change field ordering then you can drag and drop field)</span>
									<ul class="wpv_dl_data">
											<?php $var_drag = get_option('woo_pv_colume_numbber' , array('0' => 'image','1' => 'vname','2'=>'Price','3'=>'Inventory','4'=>'qut','5'=>'atc' )); 

											
											if(!empty($var_drag)){

												foreach($var_drag as $drag_key => $drag_value){

													if($drag_value == "image"){ ?>
														<li><div class="wpv_dd_filed" value="1" id="image"><?php echo __('Image','variation-table-for-woocommerce');?></div></li>
													<?php } 

													if($drag_value == "vname"){ ?>

														<li><div class="wpv_dd_filed" value="2" id="vname"><?php echo __('Variations Name','variation-table-for-woocommerce');?></div></li>
													<?php } 

													if($drag_value == "Price"){ ?>

														  <li><div class="wpv_dd_filed" value="3" id="Price"><?php echo __('Price','variation-table-for-woocommerce');?></div></li>
													<?php }

													if($drag_value == "Inventory"){ ?>
														<li><div class="wpv_dd_filed" value="3" id="Inventory"><?php echo __('Inventory','variation-table-for-woocommerce');?></div></li>
													<?php }

													if($drag_value == "qut"){ ?>
														<li><div class="wpv_dd_filed" value="4" id="qut"><?php echo __('Quantity','variation-table-for-woocommerce');?></div></li>
													<?php }

													if($drag_value == "atc"){ ?>
														<li><div class="wpv_dd_filed" value="5" id="atc"><?php echo __('Add To Cart','variation-table-for-woocommerce');?></div></li>
													<?php }
												}
											}else{ ?>
												<li><div class="wpv_dd_filed" value="1" id="image"><?php echo __('Image','variation-table-for-woocommerce');?></div></li>
												<li><div class="wpv_dd_filed" value="2" id="vname"><?php echo __('Variations Name','variation-table-for-woocommerce');?></div></li>
												<li><div class="wpv_dd_filed" value="3" id="Price"><?php echo __('Price','variation-table-for-woocommerce');?></div></li>
												<li><div class="wpv_dd_filed" value="3" id="Inventory"><?php echo __('Inventory','variation-table-for-woocommerce');?></div></li>
												<li><div class="wpv_dd_filed" value="4" id="qut"><?php echo __('Quantity','variation-table-for-woocommerce');?></div></li>
												<li><div class="wpv_dd_filed" value="5" id="atc"><?php echo __('Add To Cart','variation-table-for-woocommerce');?></div></li>
											<?php } ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div id="wooo-pv-translations" class="wpv_tab_content"> 
						<div class="wpv_gs_tabelv">
							<div class="wpv_table_coovver_div">
								<h2><?php echo __('Translations','variation-table-for-woocommerce');?></h2>
								<table class="wpv_gst_data">
									<tr>
										<th><label><?php echo __('Image','variation-table-for-woocommerce');?> </label></th>
										<td><input type="text" class="regular-text" name="wpv_comman[woopv_tra_image_filed]" value="<?php echo $wpv_comman['woopv_tra_image_filed']; ?>"></td>
									</tr>
									<tr>
										<th><label><?php echo __('Variations Name','variation-table-for-woocommerce');?> </label></th>
										<td><input type="text" class="regular-text" name="wpv_comman[woopv_tra_vname_filed]" value="<?php echo $wpv_comman['woopv_tra_vname_filed']; ?>"></td>
									</tr>
									<tr>
										<th><label><?php echo __('Price','variation-table-for-woocommerce');?> </label></th>
										<td><input type="text" class="regular-text" name="wpv_comman[woopv_tra_price_filed]" value="<?php echo $wpv_comman['woopv_tra_price_filed']; ?>"></td>
									</tr>
									<tr>
										<th><label><?php echo __('Inventory','variation-table-for-woocommerce');?> </label></th>
										<td><input type="text" class="regular-text" name="wpv_comman[woopv_tra_inv_filed]" value="<?php echo $wpv_comman['woopv_tra_inv_filed']; ?>"></td>
									</tr>
									<tr>
										<th><label><?php echo __('Quantity','variation-table-for-woocommerce');?></label></th>
										<td><input type="text" class="regular-text" name="wpv_comman[woopv_tra_qty_filed]" value="<?php echo $wpv_comman['woopv_tra_qty_filed']; ?>"></td>
									</tr>
									<tr>
										<th><label><?php echo __('Add To Cart','variation-table-for-woocommerce');?> </label></th>
										<td><input type="text" class="regular-text" name="wpv_comman[woopv_tra_atc_filed]" value="<?php echo $wpv_comman['woopv_tra_atc_filed']; ?>"></td>
									</tr>
									<tr>
										<th><label><?php echo __('Added text','variation-table-for-woocommerce');?> </label></th>
										<td><input type="text" class="regular-text" name="wpv_comman[woopv_tra_added]" value="<?php echo $wpv_comman['woopv_tra_added']; ?>"></td>
									</tr>
									<tr>
										<th><label><?php echo __('Avilable Variation Button text','variation-table-for-woocommerce');?></label></th>
										<td><input type="text" class="regular-text" name="wpv_comman[wpv_avi_vari_btn_text]" value="<?php echo $wpv_comman['wpv_avi_vari_btn_text'];?>"/></td>
									</tr>
								</table>	
							</div>
						</div>
					</div> 
					<div class="woo_pv_save_options">
						<input type="hidden" name="action" value="wpv_data_ssave">
						<input type="submit" name="submit" value="Save changes" class="button-primary">
					</div>
				</form>
			</div>

			<?php
		}


		function WOOPV_admin_data_save(){

			if( current_user_can('administrator') ) { 
                global $wpdb;
                
                if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'wpv_data_ssave') {
                    if(!isset( $_REQUEST['wpv_nonce_field'] ) || !wp_verify_nonce( $_REQUEST['wpv_nonce_field'], 'wpv_nonce_action' )) {
                        echo 'Sorry, your nonce did not verify.';
                        exit;

                    } else {

                    	$isecheckbox = array(
                    		'woo_pv_onn_off',
                    		'woopv_dts_on_off',
                    		'wooo_pv_table_serch',
                    		'woo_pv_to',
                    		'woo_pv_image_on_off',
                    		'woo_pv_vname_on_off',
                    		'woo_pv_price_on_off',
                    		'woo_pv_qty_on_off',
                    		'woo_pv_atc_on_off',
                    		'woo_pv_inventory',
							'wpv_varen',
							'wpv_prien',
							'wpv_enable_disable_avi_vari_btn',
							'wpv_ed_cart_icon',
	                    );

	                    foreach ($isecheckbox as $key_isecheckbox => $value_isecheckbox) {
	                        if(!isset($_REQUEST['wpv_comman'][$value_isecheckbox])){
	                            $_REQUEST['wpv_comman'][$value_isecheckbox] ='no';
	                        }
	                    }                    	

	                   
	                    foreach ($_REQUEST['wpv_comman'] as $key_wpv_comman => $value_wpv_comman) {
	                        update_option($key_wpv_comman, sanitize_text_field($value_wpv_comman), 'yes');
	                    }
	                    
                		$woovt_sequns = array('0' => 'image','1' => 'vname','2'=>'Price','3'=>'Inventory','4'=>'qut','5'=>'atc' );
						add_option('woo_pv_colume_numbber',$woovt_sequns);
						add_option('woopv_tra_image_filed','Image');
						add_option('woopv_tra_vname_filed','Variations Name');
						add_option('woopv_tra_price_filed','Price');
						add_option('woopv_tra_qty_filed','Quantity');
						add_option('woopv_tra_atc_filed','Add To Cart');
						add_option('woopv_tra_inv_filed', 'Inventory' );
						$wpv_gs_layout = sanitize_text_field($_REQUEST['wpv_gs_layout']);
						update_option( 'woo_pv_gs_layout', $wpv_gs_layout );


		                wp_redirect( admin_url( '/admin.php?page=woopv' ) );
		                exit;
	
					}

				}

			}	

		}


		function WOOPV_support_and_rating_notice() {
            $screen = get_current_screen();
           
            if( 'woopv' == $screen->parent_base) {
                ?>
                <div class="woopv_ratess_open">
                    <div class="woopv_rateus_notice">
                        <div class="woopv_rtusnoti_left">
                            <h3>Rate Us</h3>
                            <label>If you like our plugin, </label>
                            <a target="_blank" href="https://wordpress.org/support/plugin/variation-table-for-woocommerce/reviews/?filter=5">
                                <label>Please vote us</label>
                            </a>
                            
                            <label>,so we can contribute more features for you.</label>
                        </div>
                        <div class="woopv_rtusnoti_right">
                            <img src="<?php echo WOO_PV_PLUGIN_DIRS;?>/include/images/review.png" class="woopv_review_icon">
                        </div>
                    </div>
                    <div class="woopv_support_notice">
                        <div class="woopv_rtusnoti_left">
                            <h3>Having Issues?</h3>
                            <label>You can contact us at</label>
                            <a target="_blank" href="https://oceanwebguru.com/contact-us/">
                                <label>Our Support Forum</label>
                            </a>
                        </div>
                        <div class="woopv_rtusnoti_right">
                            <img src="<?php echo WOO_PV_PLUGIN_DIRS;?>/include/images/support.png" class="woopv_review_icon">
                        </div>
                       
                    </div>
                </div>
                <div class="woopv_donate_main">
                   <img src="<?php echo WOO_PV_PLUGIN_DIRS;?>/include/images/coffee.svg">
                   <h3>Buy me a Coffee !</h3>
                   <p>If you like this plugin, buy me a coffee and help support this plugin !</p>
                   <div class="woopv_donate_form">
                        <a class="button button-primary ocwg_donate_btn" href="https://www.paypal.com/paypalme/shayona163/" data-link="https://www.paypal.com/paypalme/shayona163/" target="_blank">Buy me a coffee !</a>
                   </div>
                </div>
                <?php
            }
        }

        function WOOPV_product_data_tabs( $tabs ) {
        	$product = wc_get_product(sanitize_text_field($_REQUEST['post']));
		     // print_r($product);
		    if($product->is_type( 'variable' ) ){
	            $tabs['woopv'] = array(
	                'label'  => esc_html__( 'Variation Table', 'woo-product-variation' ),
	                'target' => 'woopv_options',
	                'class'  => array( 'show_if_woopv' ),
	            );
	        }
            return $tabs;
        }

 
        //product bundle data panels option and update
        function WOOPV_product_data_panels() {
        	global $woocommerce, $post;
		    $product = wc_get_product(sanitize_text_field($_REQUEST['post']));
		     // print_r($product);
		    if($product->is_type( 'variable' ) ){
		    	echo '<div id="woopv_options" class="panel woocommerce_options_panel">';
				   	echo '<div class="options_group">';
				    woocommerce_wp_checkbox(
				        array(
				            'id' => 'woovt_enable_disable',
				            'wrapper_class' => 'checkbox_class',
				            'label' => __('Woo Variations Table Disble', 'woocommerce' ),
				        )
				    );
				    echo '</div>';
			    echo '</div>';
			}
        }

        function WOOPV_woocommerce_vt_process_product_meta_fields_save( $post_id ){

			$woo_checkbox = isset( $_REQUEST['woovt_enable_disable'] ) ? 'yes' : 'no';

			update_post_meta( $post_id, 'woovt_enable_disable', $woo_checkbox );
			
		}


		function init(){
			add_action( 'admin_menu',array( $this, 'WOOPV_admin_manu_setting' ));
			add_action( 'init',array( $this, 'WOOPV_admin_data_save' ));
			add_filter( 'woocommerce_product_data_tabs', array( $this, 'WOOPV_product_data_tabs' ), 10, 1 );
            add_action( 'woocommerce_product_data_panels',array( $this, 'WOOPV_product_data_panels' ));
			add_action( 'woocommerce_process_product_meta',array( $this, 'WOOPV_woocommerce_vt_process_product_meta_fields_save' ));
			add_action( 'admin_notices', array($this, 'WOOPV_support_and_rating_notice' ));
		}

		public static function woopv() {
         	if (!isset(self::$woopv)) {
            	self::$woopv = new self();
            	self::$woopv->init();
         	}
         	return self::$woopv;
      	}

	}
	woo_pv_admin::woopv();
}

?>

