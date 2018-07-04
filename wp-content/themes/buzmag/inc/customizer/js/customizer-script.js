jQuery(document).ready(function($) {	

    /** Script for switch option **/
    $('.switch_button').each(function() {
        //This object
        var obj = $(this);
    
        var switchPart = obj.children('.switch_part').attr('data-switch');
        var input = obj.children('input'); //cache the element where we must set the value
        var input_val = obj.children('input').val(); //cache the element where we must set the value
    
        obj.children('.switch_part.'+input_val).addClass('selected');
        obj.children('.switch_part').on('click', function(){
            var switchVal = $(this).attr('data-switch');
            obj.children('.switch_part').removeClass('selected');
            $(this).addClass('selected');
            $(input).val(switchVal).change(); //Finally change the value to 1
        });

    });
    
    /** Radio Image **/
    $( '[id="input_buzmag_header_banner_layout"]' ).buttonset(); 
});