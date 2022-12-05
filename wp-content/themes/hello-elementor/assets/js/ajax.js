
jQuery(document).ready(function() {

    // ==================================== Globle loader ==================================== //
    var $loading = $('#loadingDiv').hide();
    $(document)
    .ajaxStart(function () {
        $loading.show();
    })
    .ajaxStop(function () {
        $loading.hide();
    });
    // ============================================  ZIP CODE ============================================
   
    jQuery('.zip_code').keyup(function () { 
        var zip = $(this).val();
        var data = {'action': 'my_action',zip:zip};
        jQuery.post(ajax_object.ajaxurl, data, function(response) {
            $('#brewery_select').html(response.data);
        });
    });
    // ============================================ CITY ============================================
    $('#state_select').change(function(){
        var state = $(this).val();
        
        var data = {'action': 'get_cities_by_state_id',state:state};
        jQuery.post(ajax_object.ajaxurl, data, function(response) {
            if (response) {
                $('#city').html(response.data);
            }
        });
    });
// ============================================  BREWERIES ============================================
//     $('.profile_search').click(function(e){
//         e.preventDefault();
//         var brewery =  $('#brewery_select').val();
//         var date=   $('.time_slot_date').val();
//         var data = {'action': 'my_action_brewery',brewery:brewery,date:date};
//         jQuery.post(ajax_object.ajaxurl, data, function(response) {
   
//         // var title='Page';
//         // var url= '/profile/';
//         // var obj={Title:title,Url:url};
//         $('#filter_display_ajax').html(response.data);
//         // window.location = "/profile/";
//         // location.replace('profile');
//         // window. history. pushState('', '', 'profile');

//          // window.history.pushState(obj, obj.Title,obj.Url);
//         // window.location.href='/profle/';
//  });
//     });

// ============================================  FILTRATION SIDEBAR ============================================  
    $('.filter_users').on('submit',function(e){
        e.preventDefault();
        var form = $(this).serialize();
               var data = {'action': 'my_action_filter', form};
    
               $.ajax({
                url: ajax_object.ajaxurl,
                type: "POST",
                data: data,
                cache: false,
                success: function (response) {
                        $('#filter_display_ajax').html(response.data);  
                }
            });
           });
         // ============================================  RESET ALL FILTRATION  ============================================
        $('.reset_all').on('click',function(e){
            e.preventDefault();
          $('.filter_users').trigger('reset'); 
        });
});




