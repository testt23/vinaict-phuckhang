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
                $('.company').removeClass('none');
                $('.company').addClass('block');
            }else{
                $('.company').removeClass('block');
                $('.company').addClass('none');
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
        <h2 class="main-title">Please type your infomation below then we will phone with you</h2>
        <div class="contact-logo">
        </div>
        <div class="contact-content">
            <div>
                <select id="option-contact" name="option_contact" onchange="order();">
                    <option value="0">Own's</option>
                    <option value="1">Company</option>
                </select>
                <div style="height: 30px; line-height: 30px;  padding: 10px 0px 0px 10px;">
                    Hi <input type="radio" name="gender" value="0"/> Mr
                    <input type="radio" name="gender" value="1"/>  Mrs
                    <input type="radio" name="gender" value="1"/> Ms
                </div>
            </div>
                
            <ul class="ul-contact">
                <li class="item">
                    <input type="text" value="Your first name" name="firstname" title="Your first name"/> (*)
                </li>
                <li class="item">
                    <input type="text" value="Your last name" name="lastname" title="Your last name"/>  (*)
                </li>
                
                <li class="item">
                    <input type="text" value="Your Email" name="email" title="Your Email"/>  (*)
                </li>
                <li class="item">
                    <input type="text" value="Home phone" name="home_phone" title="Home phone"/>  (*)
                </li>
                
                 <li class="item">
                    <input type="text" value="Mobile phone" name="mobile_phone" title="Mobile phone"/>  (*)
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
            </ul>
            <ul class="ul-contact">
                <li class="item company none" >
                    <input type="text" value="Your company" name="company" title="Your company"/>  (*)
                </li>
                <li class="item" >
                    <input type="text" value="Work phone" name="work_phone" title="Work phone"/>  (*)
                </li>
                <li class="item company none" >
                    <input type="text" value="Website" name="website" title="Website"/>  (*)
                </li>
                <li class="item company none" >
                    <input type="text" value="Career" name="career" title="Career"/>  (*)
                </li>
                <li class="item company none" >
                    <input type="text" value="Tax code" name="tax_code" title="Tax code"/>
                </li>
                <li class="item">
                    <input type="text" value="Fax" name="fax" title="Fax"/> 
                </li>
                <li class="item">
                    <input type="text" value="Shipping address" name="shipping_address" title="Shipping address"/>  (*)
                </li>
                <li class="item">
                    <input type="text" value="Billing address" name="billing_addres" title="Billing address"/>  (*)
                </li>
            </ul>
            <div style="clear:both;"></div>
            <div style=" text-align: right; margin-right: 50px;">
                    <input type="hidden" name="check" value="order-ok"/>
                    <input  type="submit" value="Order" id="bnt_contact"/>
            </div>
        </div>
    </div>

</form>
