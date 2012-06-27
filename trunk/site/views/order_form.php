<script language="javascript">
    $(document).ready(function(){
        function trim(str){
            var start = 0;
            var end = str.length;
            while (start < str.length && str.charAt(start) == ' ') start++;
            while (end > 0 && str.charAt(end-1) == ' ') end--;
            return str.substr(start, end-start);
        }
        function KiemTra_Email(value) {
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!filter.test(value)) {
                return false;
            }
            return true;
        }
        
        jQuery('.item input, #description').focus(function(){ // ra
            var title = $(this).attr('title');
            var value = $(this).val();
            if (value == title){
                $(this).val('');
                $(this).css('color','black');
            }
            
        });
        
        jQuery('.item input, #description').blur(function(){ // vao
            var title = $(this).attr('title');
            var value = $(this).val();
            if (trim(value) == ''){
                $(this).val(title);
                $(this).css('color','gray');
            }
            
        });
        
        order();
       
    });
    
    
    (function($){
        order = function(){
            var val = $('#option-contact').val();
            if (val == 1){
                $('.tem1').css('display', 'none');
                $('.tem2').css('display', 'block');
            }else{
                $('.tem2').css('display', 'none');
                $('.tem1').css('display', 'block');
            }
        }
    })(jQuery);
    
   
</script>

<style type="text/css">
    #option-contact{
        width: 150px;
        border: solid 1px gray;  
    }
    .none{
        display:none;
    }
    .block{
        display: block;
    }
</style>
<form method="post" action="" id="form_contact">
    <div id="contact-wrapper">
        <ul id="ul-contact">
            <li>
                <select id="option-contact" onchange="order();">
                    <option value="1">Cá nhân</option>
                    <option value="2">Công ty</option>
                </select>
            </li>
            <li class="item">
                <input type="text" value="Your name" name="name" id="name" title="Your name"/>
            </li>
            <li class="item tem2">
                <input type="text" value="Birthday" name="birthday" title="Birthday"/>
            </li>
            <li class="item tem1"  class="none">
                <input type="text" value="Your company" name="company" title="Your company"/>
            </li>
            <li class="item tem1" class="none">
                <input type="text" value="Tax code" name="tax_code" title="Tax code"/>
            </li>
            <li class="item tem1"  class="none">
                <input type="text" value="Fax" name="fax" title="Fax"/>
            <li class="item">
                <input type="text" value="Your Email" name="email" title="Your Email"/>
            </li>
            <li class="item">
                <input type="text" value="Shopping address" name="shopping_address" title="Shopping address"/>
            </li>
            <li class="item">
                <input type="text" value="Billing address" name="billing_addres" title="Billing address"/>
            </li>
            <li class="item">
                <input type="text" value="YM!" name="yahoo" title="YM!"/>
            </li>
            <li class="item">
                <input type="text" value="Skype" name="skype" title="Skype"/>
            </li>
            <li class="it">
                <textarea id="description" name="description" title="Message">Message</textarea>
            </li>
            <li style="text-align: right;">
                <input type="hidden" name="check" value="check"/>
                <input  type="submit" value="Order" id="bnt_contact"/>
            </li>
        </ul>
    </div>

</form>