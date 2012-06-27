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
        
        jQuery('.item input').focus(function(){
            var value = $(this).attr('title');
            alert(value);
            
        });
        
        jQuery('.item input').blur(function(){
            alert('eheh');
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
                <input type="text" value="Your company" name="name"/>
            </li>
            <li class="item tem1" class="none">
                <input type="text" value="Mã số thuế" name="address"/>
            </li>
            <li class="item tem1"  class="none">
                <input type="text" value="Fax" name="address"/>
            <li class="item">
                <input type="text" value="Your Email" name="email"/>
            </li>
            <li class="item">
                <input type="text" value="Shopping address" name="phone"/>
            </li>
            <li class="item">
                <input type="text" value="Billing address" name="address"/>
            </li>

            </li>
            <li class="item">
                <input type="text" value="YM!" name="yahoo"/>
            </li>
            <li class="item">
                <input type="text" value="Skype" name="skype"/>
            </li>
            <li>
                <textarea id="description" name="description">Tin nhắn</textarea>
            </li>
            <li style="text-align: right;">
                <input  type="submit" value="Contact" id="bnt_contact"/>
            </li>
        </ul>
    </div>

</form>