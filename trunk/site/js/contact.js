(function($){
    KiemTra_Email = function(value){
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(value)) {
            return false;
        }
        return true;
    }
})(jQuery);
(function($){
    trim = function(str){
        var start = 0;
        var end = str.length;
        while (start < str.length && str.charAt(start) == ' ') start++;
        while (end > 0 && str.charAt(end-1) == ' ') end--;
        return str.substr(start, end-start);
    }
})(jQuery);

(function($){
    check_muacho = function(){
        
        var md = jQuery('input[name="muacho"]:radio:checked').val();
        if (md == '1'){
            jQuery('.congty').show();
            jQuery('.canhan').hide();
        }else{
            jQuery('.congty').hide();
            jQuery('.canhan').show();
        }
        
    }
})(jQuery);


jQuery(document).ready(function(){
        
        check_muacho();
        
        $('#message').focus(function(){
           
            $('#message_mask').hide();
           
        });
        
        $('#message_mask').click(function(){
           
            $('#message_mask').hide();
           
        });
        
        var message = $('#message').val();
        if(message.length > 0){
            $('#message_mask').hide();
        }
    
});