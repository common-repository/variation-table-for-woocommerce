jQuery(document).ready(function(){

  	jQuery('ul.wpv_tab li').click(function(){
	    var tab_id = jQuery(this).attr('data-tab');
	    jQuery('.wpv_tab li').removeClass('wpv_tab_carrent');
	    jQuery('.wpv_tab_content').removeClass('wpv_tab_content_carrent');  
	    jQuery(this).addClass('wpv_tab_carrent');
	    jQuery("#"+tab_id).addClass('wpv_tab_content_carrent');
	});

  	jQuery('.wpv_dl_data').sortable({
  		update: function( event, ui ) {
  			$data = jQuery(this).find(".wpv_dd_filed").attr('value');

  			var or_drop_index = new Array();
      		jQuery('.wpv_dl_data li').each(function() {
				    or_drop_index.push(jQuery(this).find('.wpv_dd_filed').attr("id"));
			     });

      		//console.log(or_drop_index);

      		jQuery.ajax({
      			type :'POST',		
    				url :wpv_ajax.wpv_ajax_url,
    				data :{
    					'action'			: 'wpv_filed_sortable',
    					'data'				: or_drop_index,
    				},
    				success: function(result){
    				}
          	});
  		}
  	});
});

