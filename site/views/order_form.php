<script language="javascript">
    $(document).ready(function(){
    
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
            KiemTra_Email = function(value) {
                var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!filter.test(value)) {
                    return false;
                }
                return true;
            }
        })(jQuery);
    
        (function($){
            check_form = function(){
                
                var form_cus = jQuery('input[name="new-customer"]');
                var check_value = '';
                
                for(var i = 0; i < form_cus.length; i++){
                    if(jQuery(form_cus[i]).attr('checked') == 'checked'){
                        check_value = parseInt(jQuery(form_cus[i]).val());
                    }
                }
                var email = jQuery('input[name="email"]').val();
                if (trim(email) == ''){
                    alert("Vui lòng nhập email");
                    return false;
                }else if(!KiemTra_Email(email)){
                    alert('Email không đúng định dạng');
                    return false;
                }
                else{
                    if (check_value == 1){
                        
                        if (trim(jQuery('input[name="firstname"]').val()) == ''){
                            
                            alert("Vui lòng nhập tên");
                            return false;
                        }
                        else if (trim(jQuery('input[name="lastname"]').val()) == ''){
                            alert("Vui lòng nhập họ");
                            return false;
                        }
                        else if (trim(jQuery('input[name="shipping_address"]').val()) == ''){
                            alert("Vui lòng nhập địa chỉ nhập hàng");
                            return false;
                        }
                        else if (trim(jQuery('input[name="billing_address"]').val()) == ''){
                            alert("Vui lòng nhập giao tiền");
                            return false;
                        }
                        else if (trim(jQuery('input[name="mobile_phone"]').val()) == ''){
                            alert("Vui lòng nhập điện thoại");
                            return false;
                        }
                    
                        if(jQuery('select[name="option_contact"]').val() == '1'){
                            if (trim(jQuery('input[name="company"]').val()) == ''){
                                alert("Vui lòng nhập tên công ty");
                                return false;
                            }
                        }
                    
                    }
                }
                
                var val = $('#option-contact').val();
                if (val == '1'){
                    $('.company input').val('');
                }
                
                
                
                return true;
            }
        })(jQuery);
    
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
        (function($){
            test = function(){
                
            }
        })(jQuery);
        order();   
    });
   
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
<form method="post" action="" id="form_contact" onsubmit="return check_form();">
    <div id="contact-wrapper">
        <h2 class="main-title">Please type your infomation below then we will phone with you</h2>
        <div class="contact-logo">

        </div>
        <div class="contact-content">
            <div>
                <div><?php echo $mess; ?></div>
                <select id="option-contact" name="option_contact" onchange="order();">
                    <option value="1">Company</option>
                    <option value="0">Own's</option>
                </select>

            </div>
            <div style="margin-top: 20px;">
                <input type="radio" name="new-customer" value="1" checked="true"/> Chưa từng mua
                <input type="radio" name="new-customer" value="2"/> Đã từng mua
            </div>
            <div style="font-style: italic;"><br/>
                ( Nếu bạn là khách hàng của chúng tôi (đã từng mua hàng), bạn có thể điền email và không cần điền các mục còn lại,
                nếu bạn muôn thay đổi thông tin nào thì hãy điền vào mục đó )
            </div>    
            <div style="height: 30px; line-height: 30px;  padding: 10px 0px 0px 10px;">
                Hi <input type="radio" name="gender" value="0" checked="true"/> Mr
                <input type="radio" name="gender" value="1"/>  Mrs
                <input type="radio" name="gender" value="1"/> Ms
            </div>
            <ul class="ul-contact">
                <li class="item">
                    Your first name <br/><input type="text" value="<?php echo $filter['firstname']; ?>" name="firstname" title="Your first name"/> (*)
                </li>
                <li class="item">
                    Your last name <br/><input type="text" value="<?php echo $filter['lastname']; ?>" name="lastname" title="Your last name"/>  (*)
                </li>

                <li class="item">
                    Your Email <br/><input onblur="test();" type="text" value="<?php echo $filter['email']; ?>" name="email" title="Your Email"/>  (*)
                </li>
                <li class="item">
                    Home phone <br/><input type="text" value="<?php echo $filter['home_phone']; ?>" name="home_phone" title="Home phone"/>  (*)
                </li>

                <li class="item">
                    Mobile phone  <br/><input type="text" value="<?php echo $filter['mobile_phone']; ?>" name="mobile_phone" title="Mobile phone"/>  (*)
                </li>
                <li class="item">
                    YM! <br/> <input type="text" value="<?php echo $filter['yahoo']; ?>" name="yahoo" title="YM!"/>
                </li>
                <li class="item">
                    Skype <br/><input type="text" value="<?php echo $filter['skype']; ?>" name="skype" title="Skype"/>
                </li>
                <li class="it">
                    Message <br/> <textarea id="description" name="description" title="Message"><?php echo $filter['description']; ?></textarea>
                </li>
            </ul>
            <ul class="ul-contact">
                <li class="item company none" >
                    Your company <br/><input type="text" value="<?php echo $filter['company']; ?>" name="company" title="Your company"/>  (*)
                </li>
                <li class="item" >
                    Work phone<br/> <input type="text" value="<?php echo $filter['work_phone']; ?>" name="work_phone" title="Work phone"/>  (*)
                </li>
                <li class="item company none" >
                    Website <br/><input type="text" value="<?php echo $filter['website']; ?>" name="website" title="Website"/>  (*)
                </li>
                <li class="item company none" >
                    Career <br/> <input type="text" value="<?php echo $filter['career']; ?>" name="career" title="Career"/>  (*)
                </li>
                <li class="item company none" >
                    Tax code <br/> <input type="text" value="<?php echo $filter['tax_code']; ?>" name="tax_code" title="Tax code"/>
                </li>
                <li class="item">
                    Fax<br/> <input type="text" value="<?php echo $filter['fax']; ?>" name="fax" title="Fax"/> 
                </li>
                <li class="item">
                    Shipping address<br/> <input type="text" value="<?php echo $filter['shipping_address']; ?>" name="shipping_address" title="Shipping address"/>  (*)
                </li>
                <li class="item">
                    Billing address <br/><input type="text" value="<?php echo $filter['billing_address']; ?>" name="billing_address" title="Billing address"/>  (*)
                </li>
                <li class="">
                    <?php if ($shopping): ?>
                        <input type="hidden" name="check" value="order-ok"/>
                        <input  type="submit" value="Order" id="bnt_contact"/>
                    <?php endif; ?>
                </li>
            </ul>
            <div style="clear:both;"></div>
        </div>
    </div>

</form>