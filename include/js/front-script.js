jQuery(document).ready(function(){
    jQuery('body').on('change', '.wpv_qon', function () {
        var  Quntity = jQuery(this).val();
        jQuery(this).next('input').val(Quntity);
    });

    jQuery('body').on('click','#wpv_add_to_cart',function(){
        var $this = jQuery(this);
        var find_show = $this.closest('td').find('.view_cart');
        var loader = $this.closest('td').find('.loader_main');
        jQuery(loader).css("display","flex");
        $wpv_vid = $this.attr('data');
        $wpv_proid = jQuery('.wpv_product_id_'+$wpv_vid).val();
        if (WOOPVdata.wpv_gs_layout == 'layout1') {
            var layouts = $this.closest('tr').prev('tr.wpv_act_form.parent');
        }else if(WOOPVdata.wpv_gs_layout == 'layout2') {
            var layouts = $this.closest('tr');
        }
        if (WOOPVdata.woo_pv_qty_on_off == 'on') {
            if(WOOPVdata.wpv_gs_qol == "wpv_dropdown"){
                $wpv_pro_qty_id = layouts.find('.wpc_cart_qntyy').val();
            }else{
                $wpv_pro_qty_id = layouts.find('.wpv_cart_qty_'+$wpv_vid).val();
            }
        }else{
            $wpv_pro_qty_id = 1;
        }

        $var_name = layouts.find('.wpv_attr_name').val();
        $var_val = layouts.find('.wpv_attr_val').val();

        jQuery.ajax({
            type :'POST', 
            url  :WOOPVdata.wpv_front_ajax_url,
            data :{
                'action'      : 'wpv_pro_add_to_cart',
                'pro_id'      : $wpv_proid,
                'pro_qty'     : $wpv_pro_qty_id,
                'pro_var_id'  : $wpv_vid,
                'var_name'    : $var_name,
                'var_val'     : $var_val,
            },
            success: function(result){
                $this.val(WOOPVdata.woopv_tra_added);
                loader.fadeOut(200);
                jQuery( find_show ).show( "slow", function() {
                    jQuery(this).animate({"display": "block"}, 500);
                });
            }
        });
    });

    jQuery('body').on('click','.oc_available_variation',function(){
        jQuery('html,body').animate({scrollTop: jQuery("div.wppvv_datatable_main").offset().top},'slow');
        return false;
    });
});