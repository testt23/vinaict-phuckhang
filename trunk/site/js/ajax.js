   
    (function($){
        update_giohang = function(id_prod, obj, url){
            var  id = jQuery('input[name="' + id_prod + '"]').val();
            var  num = jQuery(obj).val();
            $.post(url + '/' + id + '/' + num,function(result){
            });
            
            
        }
    })(jQuery);
    
    (function($){
        delete_shop = function(div_id, id, url){
            if (confirm('Bạn có muốn xóa sản phẩm này ?')){
                $.post(url + '/' + id,function(result){
                    jQuery('#' + div_id).fadeOut(500, function(){
                        $(this).remove();
                    });
                });
            }
            return false;
        }
    })(jQuery);