<?php

if (!defined('ABSPATH'))
   exit;

if (!class_exists('woo_pv_front')){

	class woo_pv_front{
		
		protected static $woopv;

		function wpcvt_combinations( $arrays ) {
		$result = array( array() );
		foreach ( $arrays as $property => $property_values ) {
			$tmp = array();
			foreach ( $result as $result_item ) {
				foreach ( $property_values as $property_value ) {
					$tmp[] = array_merge( $result_item, array( $property => $property_value ) );
				}
			}
			$result = $tmp;
		}

		return $result;
	}

		public function woo_pv_fornt_data(){
			global $product,$wpv_comman,$woo_pv_svg;
			$wooo_pv_data = $product->get_available_variations();
			foreach($wooo_pv_data as $variation){
	        	$variation_id = $variation['variation_id'];
	        	$variation_obj = new WC_Product_variation($variation_id);
	        	$stock_quantity = ($variation_obj->get_stock_quantity()); 
	        	if(!empty($stock_quantity)){
	         	$quantity=$stock_quantity;
	        	}else{
	         	$quantity=5;
	        	}
    		}
    		$woo_pv_colume_numbber = get_option( 'woo_pv_colume_numbber' );
			$wpv_image_on_off = $wpv_comman['woo_pv_image_on_off'];
			$wpv_vname_on_off = $wpv_comman['woo_pv_vname_on_off'];
			$wpv_price_on_off = $wpv_comman['woo_pv_price_on_off'];
			$wpv_qty_on_off = $wpv_comman['woo_pv_qty_on_off'];
			$wpv_gs_qol = $wpv_comman['wpv_gs_qol'];
			$woopv_aname = $product->get_attributes();
			$wpv_atc_on_off = $wpv_comman['woo_pv_atc_on_off'];
			?>
			<div class="wppvv_datatable_main">
				<div class="oc_filter">
					<?php
					if (isset($woo_pv_colume_numbber) && !empty($woo_pv_colume_numbber)) {
						$x=0;
						foreach ($woo_pv_colume_numbber as $key => $value) {
							if ($wpv_vname_on_off == "on") {
								if ($value == 'vname') {
									foreach ($woopv_aname as $keys => $values) {
										$koostis = wc_get_product_terms( get_the_ID(), $values['name'], array( 'fields' => 'names' ) );
										if (isset($woopv_aname[$values['name']])) {
											$attribute_name = $woopv_aname[$values['name']];
										}else {
											$attribute_name = $values['name'];
										}
										if ($wpv_comman['woopv_vc'] == 'sepc2') {
											echo '<select class="select_vname_type" id="select_type_of_variyantion_'.$keys.'" column="'.$x.'" data="'.$keys.'">';
										 	$name_remove_slug = str_replace("pa_","",$values['name']);
											echo '<option value="">'.$name_remove_slug.'</option>';
											if (isset($attribute_name['data'])) { 
												$attribute_nme = $attribute_name['data'];
											}else{ 
												$attribute_nme = $attribute_name;
											}
											if (isset($attribute_nme['options'])) {
												foreach($attribute_name->get_slugs() as $namem){
													echo '<option>'.$namem.'</option>';
												}
											}else{
												foreach($values['options'] as $namem){
													echo '<option>'.$namem.'</option>';
												}
											}
											echo '</select>';
											$x++;
										}else{
											echo '<select class="select_vname_type" id="select_type_of_variyantion_'.$keys.'" column="'.$key.'" data="'.$keys.'">';
												$name_remove_slug = str_replace("pa_","",$values['name']);
												echo '<option value="">'.$name_remove_slug.'</option>';
												if (!empty($koostis)) {
													foreach($attribute_name->get_slugs() as $namem){
														echo '<option>'.$namem.'</option>';
													}
												}else{
													foreach($values['options'] as $namem){
														echo '<option>'.$namem.'</option>';
													}
												}
											echo '</select>';
										}
									}
								}
							}
							if ( $wpv_price_on_off == 'on' ) {
								if ($value == 'Price') {
									if ($wpv_comman['woopv_vc'] == 'sepc2') {
										$column = $x;
									}else{
										$column = $key;
									}
									?>
									<select id="selecct_price" column='<?php echo $column;?>'>
										<option value="">Price</option>
										<?php
										foreach ($wooo_pv_data as $valu) {
											echo "<option>";
											print_r($valu['display_price']);
											echo "</option>";
										}
										?>
									</select>
									<?php
								}
							}
							if ($value != 'vname') {
								$x++;
							}
						}
					}
					?>				
				</div>
				<table id="wpv_table_data" class="display nowrap">
					<thead style="background-color:<?php echo $wpv_comman['wpv_back_color_table']; ?>;color:<?php echo $wpv_comman['wpv_color_text']; ?>;">
						<tr id="woovt_hed_filed">
							<?php
							if (isset($woo_pv_colume_numbber) && !empty($woo_pv_colume_numbber)) {
								foreach ($woo_pv_colume_numbber as $value) {

									if($value == 'image'){
										if ($wpv_image_on_off == 'on') {
											echo "<th id='image' class='woovt_bimage_hidden'>".$wpv_comman['woopv_tra_image_filed']."</th>";
										}
									}

									if($value == 'vname'){
										if ($wpv_vname_on_off == 'on') {
											if ($wpv_comman['woopv_vc'] == 'sincl'){
												echo "<th id='vname' class='woovt_bimage_hidden'>".$wpv_comman['woopv_tra_vname_filed']."</th>";	
											}
											if ($wpv_comman['woopv_vc'] == 'sepc2'){
												foreach ($woopv_aname as $woopvdata) {
													$name_remove_slug = str_replace("pa_","",$woopvdata['name']);
													echo "<th id='vname' class='woovt_bimage_hidden'>".$name_remove_slug."</th>";
												}
											}
										}
									}
									
									if($value == 'Price'){
										if ($wpv_price_on_off == 'on') {
											echo "<th id='price' class='woovt_bimage_hidden'>".$wpv_comman['woopv_tra_price_filed']."</th>";
										}
									}

									if ($value == 'Inventory') {
										if ($wpv_comman['woo_pv_inventory'] == 'on') {
											echo "<th>".$wpv_comman['woopv_tra_inv_filed']."</th>";
										}	
									}
									
									if($value == 'qut'){
										if ($wpv_qty_on_off == 'on') {
											echo "<th id='qty' class='woovt_bimage_hidden'>".$wpv_comman['woopv_tra_qty_filed']."</th>";
										}
									}
									
									if($value == 'atc'){
										if ($wpv_atc_on_off == 'on') {
											echo "<th id='atc' class='woovt_bimage_hidden'>".$wpv_comman['woopv_tra_atc_filed']."</th>";
										}
									}
								}						
							}?>
						</tr>
					</thead>
					<tbody>
					<?php
					$children = $product->get_children();
					if ( ! empty( $children ) ) {
						$children_data = [];
						foreach ( $children as $child ) {
							$child_product = wc_get_product( $child );
							$attrs         = [];
							$product_attrs = $product->get_attributes();
							$child_attrs   = $child_product->get_attributes();
							foreach ( $child_attrs as $k => $a ) {
								if ( empty( $a ) ) {
									if ( $product_attrs[ $k ]->get_id() ) {
										foreach ( $product_attrs[ $k ]->get_terms() as $term ) {
											$attrs[ 'attribute_' . $k ][] = $term->slug;
										}
									} else {
										foreach ( $product_attrs[ $k ]->get_options() as $option ) {
											$attrs[ 'attribute_' . $k ][] = $option;
										}
									}
								} else {
									$attrs[ 'attribute_' . $k ][] = $a;
								}
							}
							$attrs = $this->wpcvt_combinations( $attrs );
							foreach ( $attrs as $attr ) {
								$children_data[] = array(
									'id'      => $child,
									'product' => $child_product,
									'attrs'   => $attr
								);
							}
						}
						foreach ( $children_data as $child_data ) {
							$child_id      = $child_data['id'];
							$child_product = $child_data['product'];
							if ( ( $custom_name = get_post_meta( $child_id, 'wpcvt_name', true ) ) && ! empty( $custom_name ) ) {
								$child_name = $custom_name;
							} else {
								$child_name_arr = [];
								$variation_name = '';
								foreach ( $child_data['attrs'] as $k => $a ) {
									if ( $t = get_term_by( 'slug', $a, str_replace( 'attribute_', '', $k ) ) ) {
										$n = $t->name;
									} elseif ( $t = get_term_by( 'name', $a, str_replace( 'attribute_', '', $k ) ) ) {
										$n = $t->name;
									} else {
										$n = $a;
									}

									if ( $variation_name === 'formatted_label' ) {
										$child_name_arr[] = wc_attribute_label( str_replace( 'attribute_', '', $k ), $product ) . ': ' . $n;
									} else {
										$child_name_arr[] = $n;
									}
								}
								$child_name = implode( ' - ', $child_name_arr );
							}
							if ( $child_product->get_image_id() ) {
								$child_image     = wp_get_attachment_image_src( $child_product->get_image_id(), 'thumbnail' );
								$child_image_src = get_post_meta( $child_id, 'wpcvt_image', true ) ?: $child_image[0];
								$child_image_src = apply_filters( 'wpcvt_variation_image_src', $child_image_src, $child_product );
							} else {
								$child_image_src = apply_filters( 'wpcvt_variation_image_src', wc_placeholder_img_src(), $child_product );
							}?>
							<tr class="wpv_act_form"><?php
								$variation    = $child_data['product'];
								$variation_id = $child_data['id'];
								$product_id   = $variation->get_parent_id();
								if (isset($woo_pv_colume_numbber) && !empty($woo_pv_colume_numbber)) {
									foreach ($woo_pv_colume_numbber as $wpv_column_data) {
										if ($wpv_column_data == 'image') {
											if ($wpv_image_on_off == 'on') {
												if ($child_image_src) {
													echo '<td><img width="50" src="'.$child_image_src.'" ></td>';
												}else{
													echo '<td><img width="50" src="'.wc_placeholder_img_src('woocommerce_thumbnail').'" ></td>';
												}
											}
										}

										if ($wpv_column_data == 'vname') {
											if ($wpv_vname_on_off == 'on') {
												if ($wpv_comman['woopv_vc'] == 'sincl') {
													echo "<td>".$child_name."</td>";
												}
												if ($wpv_comman['woopv_vc'] == 'sepc2'){
													foreach ($child_name_arr as $keyy => $valuee) {
														echo "<td>".$valuee."</td>";
													}
												}
											}
										}

										if ($wpv_column_data == 'Price') {
											if ($wpv_price_on_off == 'on') {
												echo "<td>".$child_product->get_price()."</td>";
											}
										}

										if ($wpv_column_data == 'Inventory') {
											if ($wpv_comman['woo_pv_inventory'] == 'on') {
												$wpv_stock = new WC_Product_variation($variation_id);
												echo "<td>instock</td>";
											}
										}										

										if ($wpv_column_data == 'qut') {
											if ($wpv_qty_on_off == 'on') {
												if ($wpv_gs_qol == 'wpv_number') {
													echo '<td><input type="number" name="quantity" value="1" step="1" size="3" min="1" pattern="[0-9]*" class="input-text qty text wpv_cart_qty_'.$variation_id.'" max="'.$quantity.'" style="text-align: center;"></td>';
												}
												elseif ($wpv_gs_qol == 'wpv_dropdown') {?>
													<td>
														<select name="quantity" class="wpv_qon wpv_cart_qty_<?php echo $variation_id; ?>">
															<?php 
																for ($i=1; $i <= $quantity; $i++) { 
																	echo "<option value=".$i.">".$i."</option>";
																}
															?>
														</select>
														<input type="hidden" value="1" class="wpc_cart_qntyy">
													</td><?php
												}
											}
										}

										if ($wpv_column_data == 'atc') {
											if ($wpv_atc_on_off == 'on') {
												$wpv_atc_loader_gif = $wpv_comman['wpv_atc_loader_gif'];
												if ($wpv_comman['wpv_ed_cart_icon'] == 'yes') {
													$wpv_view_cart_icon = $wpv_comman['wpv_view_cart_icon'];
												}else{
													$wpv_view_cart_icon = '';
												}
												echo '<td><input type="submit" name="add_to_cart" id="wpv_add_to_cart" data="'.$variation_id.'" value="Add To Cart"><br>
													<span class="loader_main"><img src="'.WOO_PV_PLUGIN_DIRS.'/include/images/'.$wpv_atc_loader_gif.'.gif" class="loader_add_to_cart" ></span>
													<span class="view_cart">
													<a class="view_cart_inner" target="blank" href="'.wc_get_cart_url().'">View Cart'.$woo_pv_svg[$wpv_view_cart_icon].'</a>
												</td>';
											}
											
										}
									}
								}
								$attr_name = array();
								$attr_val = array();
								foreach ( $child_data['attrs'] as $k => $a ) {
									$attr_name[] = $k;
									$attr_val[] = $a;
								}
								?>
								<input type="hidden" name="attr_name" class="wpv_attr_name" value="<?php echo implode(',', $attr_name);?>"/>
								<input type="hidden" name="attr_val" class="wpv_attr_val" value="<?php echo implode(',', $attr_val);?>"/>
								<input type="hidden" name="add-to-cart" class="wpv_atc_<?php echo $variation_id; ?>" value="<?php echo get_the_ID(); ?>">
								<input type="hidden" name="product_id" class="wpv_product_id_<?php echo $variation_id; ?>" value="<?php echo get_the_ID(); ?>">
								<input type="hidden" name="variation_id" class="wpv_variation_id_<?php echo $variation_id; ?>" value="<?php echo $variation_id; ?>">
							</tr>
							<?php
						}
					}
					?>
					</tbody>
				</table>
			</div><?php
		}

		function WOOPVv_data_save(){
			global $product,$wpv_comman;
			$wpv_on_off_setting = $wpv_comman['woo_pv_onn_off'];
			$wpv_layout_setting = $wpv_comman['wpv_gs_layout'];
			$woo_vt_event = get_post_meta(get_the_ID(), 'woovt_enable_disable' );
			if (in_array('no',$woo_vt_event) || empty($woo_vt_event)) {
				if ( $product->is_type('variable') ) {
					if ($wpv_on_off_setting == 'on') {	
						remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
						if ($wpv_layout_setting == 'layout1') {
				 			add_action( 'woocommerce_single_product_summary',array( $this, 'woo_pv_fornt_data'),31);	
						}elseif ($wpv_layout_setting == 'layout2') {
							add_action( 'woocommerce_after_single_product_summary',array( $this, 'woo_pv_fornt_data'),8);	
						}
						if($wpv_comman['wpv_enable_disable_avi_vari_btn'] == 'yes'){
							add_action( 'woocommerce_single_product_summary',array( $this, 'WOOPVv_available_variation'),10);
						}
					}
				}
			}
		}

		function WOOPV_script(){
			global $wpv_comman;
			?>
			<script type="text/javascript">
				jQuery( document ).ready(function() {
	   				var table = jQuery('#wpv_table_data').DataTable( {
							fixedHeader: true,
					    	bPaginate: false,
				        	responsive: true,
				        	bInfo: false,
							<?php if ($wpv_comman['woo_pv_to'] == 'off') { ?>
						    	ordering: false,
							<?php  } ?>
							<?php if ($wpv_comman['woopv_dts_on_off'] == 'off') { ?>
						    	searching: false,
							<?php  } ?>			        
					});
				});
			</script>
			<?php

			if ($wpv_comman['wooo_pv_table_serch'] == 'on') {
				?>
				<script type="text/javascript">
					jQuery(document).ready(function(){
						jQuery('#wpv_table_data thead tr').clone(true).appendTo( '#wpv_table_data thead' );
						jQuery('#wpv_table_data thead tr:eq(1) th').each( function (i) {
							var title = jQuery(this).text();
							$data = jQuery(this).attr('id');
				        	if($data == 'qty' || $data == 'image' || $data == 'atc'){
					        	$id = '#'+$data;
					        	jQuery($id).css( "background-image",'none' );	
				        	}
							jQuery(this).css( "background-image",'none' );
				        		if ($data == 'qty' || $data == 'image' || $data == 'atc') {
					        		jQuery(this).html( '' );
					        	}else{
					        		jQuery(this).html( '<input type="text" placeholder="Search '+title+'" />' );
					        		jQuery('input',this).on('keyup change', function(){
					        		jQuery('#wpv_table_data').DataTable().column(i).search(this.value).draw();
					        	});
					        }
						} );
				    });
				</script>
				<?php
			}?>

			<script type="text/javascript">
				function datatableserchshow(data,wpv_data_column){
					var woopv_vc = "<?php echo $wpv_comman['woopv_vc'];?>";
					$vdata = '#select_type_of_variyantion_'+wpv_data_column;
					$fcolumn = jQuery($vdata).attr('column');
					if (woopv_vc == 'sincl') {
						jQuery('#wpv_table_data').DataTable().column( $fcolumn ).search(data).draw();
					} else if(woopv_vc == 'sepc2'){
						$fvalue = jQuery($vdata).val();
						jQuery('#wpv_table_data').DataTable().column( $fcolumn ).search($fvalue).draw();
					}
				}
				jQuery(document).ready(function(){
					jQuery('#selecct_filed').change(function(){
						$datataa = jQuery(this).val();
						$datss = jQuery(this).attr("column");
						jQuery('#wpv_table_data').DataTable().column( $datss ).search($datataa).draw();
					});
					jQuery('#selecct_price').change(function(){
						$wpvspp = jQuery(this).val();
						$wpvscc = jQuery(this).attr("column");
						jQuery('#wpv_table_data').DataTable().column( $wpvscc ).search($wpvspp).draw();
					});
					jQuery('#select_type_of_variyantion').change(function(){
						$wpvsp = jQuery(this).val();
						$wpvsc = jQuery(this).attr("column");
						jQuery('#wpv_table_data').DataTable().column( $wpvsc ).search($wpvsp).draw();
					});
					jQuery('.select_vname_type').change(function(){ 
						var woopv_vc = "<?php echo $wpv_comman['woopv_vc'];?>";
						if (woopv_vc == 'sincl') {
							var cusarray = [];
							jQuery('.select_vname_type').each(function(){
								if(jQuery(this).val()!=""){
									cusarray.push(jQuery(this).val());
								}
							});

							var wpv_data = cusarray.join(" - ");
							var wpv_data_column = jQuery(this).attr("data");
						} else if(woopv_vc == 'sepc2'){
							var wpv_data_column = jQuery(this).attr("data");
						}
						datatableserchshow(wpv_data,wpv_data_column);
					});
				});
			</script>
			<?php
		}

		function WOOPVv_available_variation(){
			global $wpv_comman;
			$product = wc_get_product(get_the_id());
			if ($product->get_type() == 'variable') {
				if ($wpv_comman['wpv_avi_vari_btn_text'] == '') {
					$button_label = 'Available Variations';
				}else{
					$button_label = $wpv_comman['wpv_avi_vari_btn_text'];
				}
				?>
				<button class="oc_available_variation"><?php echo $button_label;?></button>
				<?php
			}
		}

		function init(){
			add_action( 'woocommerce_before_single_product',array( $this, 'WOOPVv_data_save'));
			add_action( 'wp_footer',array( $this, 'WOOPV_script'));
		}

		public static function woopv() {
      	if (!isset(self::$woopv)) {
         	self::$woopv = new self();
         	self::$woopv->init();
      	}
      	return self::$woopv;
   	}
	}
	woo_pv_front::woopv();
}?>