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
        
        var md = jQuery('select[name="muacho"]').val();
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
    
    var md = jQuery('select[name="mucdich"]').val();
    check_mucdich();
    if (md != '1'){
        check_muacho();
    }
    
    
});