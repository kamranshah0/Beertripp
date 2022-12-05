jQuery(document).ready( function() {

    jQuery(".brewery_state").change( function(e) {
       e.preventDefault(); 
       post_id = jQuery(this).val();
       nonce = jQuery('input[name="brewery_nonce"]').val();
 
       jQuery.ajax({
          type : "post",
          dataType : "json",
          url : myAjax.ajaxurl,
          data : {action: "get_cites_by_state", post_id : post_id, nonce: nonce},
          success: function(response) {
            //  if(response.type == "success") {
            //     jQuery("#vote_counter").html(response.vote_count)
            //  }
            //  else {
            //     alert("Your vote could not be added")
            //  }
          }
       });    
    })
 
 })