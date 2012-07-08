<script language="javascript" src="<?php echo base_url() . 'js/contact.js' ?>">
</script>
<script language="javascript">
    
(function($){
    check_mucdich = function(){
        var md = jQuery('select[name="mucdich"]').val();
        if (md == '1'){
            jQuery('input[name="ok-submit"]').val('Contact');
            jQuery('.canhan').hide();
            jQuery('.congty').hide();
            jQuery('.muahang').hide();
            
        }else{
            jQuery('input[name="ok-submit"]').val('Order');
            jQuery('.canhan').show();
            jQuery('.congty').show();
            jQuery('.muahang').show();
            check_muacho();
        }
        
    }
})(jQuery);
    (function($){
        check_submit = function(){
        
            var mdich = jQuery('select[name="mucdich"]').val();
            var mcho =  jQuery('select[name="muacho"]').val();
            var email = jQuery('input[name="email"]').val();
            if (email == ''){
                alert('Vui lòng nhập email');
                return false;
            }
        
            if (!KiemTra_Email(email)){
                alert('Email không đúng định dạng');
                return false;
            }
        
            if (mdich == '2'){
            
                var not_buy = jQuery('input[name="not-buy"]');
                var notb;
                for (var i = 0; i< not_buy.length; i++){
                    if(jQuery(not_buy[i]).attr('checked') == 'checked'){
                        notb = jQuery(not_buy[i]).val();
                        console.log(notb);
                    }
                }
            
            
                if (notb == '1'){
                
            
                    var billing = trim(jQuery('input[name="billing_address"]').val());
                    var shipping = trim(jQuery('input[name="shipping_address"]').val());
                    var phone = trim(jQuery('input[name="phone"]').val());
            
                    if ( phone == ''){
                        alert("Vui long nhap Phone");
                        return false;
                    }
            
                    if ( billing == ''){
                        alert("Vui long nhap billing");
                        return false;
                    }
            
                    if ( shipping == ''){
                        alert("Vui long nhap shipping");
                        return false;
                    }
            
            
            
                    if (mcho == '1'){
                        var company = trim(jQuery('input[name="company"]').val());
                        var contact_person = trim(jQuery('input[name="contact_person"]').val());
                        if (company == ''){
                            alert("Vui long nhap ten cong ty");
                            return false;
                        }
                
                        if (contact_person == ''){
                            alert("Vui long nhap nguoi dai dien cong ty");
                            return false;
                        }
                    }
            
                    if (mcho == 0){
                        var firstname = trim(jQuery('input[name="firstname"]').val());
                        var lastname = trim(jQuery('input[name="lastname"]').val());
                        
                        if (firstname == ''){
                            alert("Vui long nhap firstname");
                            return false;
                        }
                
                        if (lastname == ''){
                            alert("Vui long nhap last name");
                            return false;
                        }
                    }
                }
            }else{
                var message = trim(jQuery('textarea[name="message"]').val());
                if (message == ''){
                    alert("Vui long nhap message");
                    return false;
                }
            }
            
        return true;
        }
    })(jQuery);
</script>
<form method="post" action="" onsubmit="return check_submit()">
    <div class="contact-wrapper">

        <div class="contact-main">
            <h1>Please type your info below</h1>

            <div class="ul-main">
                <center style="font-style: italic; color: blue;">  <?php echo $mess; ?><br/></center> 
                <center style="font-style: italic;">   (Nếu bạn đã từng mua hàng thì bạn có thể nhập email và để trống các ô còn lại, nếu bạn muốn thay đổi thông tin nào thì nhập vào thông tin đó)<br/></center> 
                <ul class="ul-right">
                    <li>
                        Mục đích: 
                        <select name="mucdich" onchange="check_mucdich()">
                            <option value="1" <?php if ($filter['mucdich'] == '1') echo 'selected="true"'; ?>>Liên hệ</option>
                            <option value="2" <?php if ($filter['mucdich'] == '2') echo 'selected="true"'; ?>>Mua hàng</option>
                        </select>
                    </li>
                    <li class="muahang">
                        Mua cho:
                        <select name="muacho" onchange="check_muacho()" >
                            <option value="1" <?php if ($filter['is_business'] == '1') echo 'selected="true"'; ?>>Công ty</option>
                            <option value="0" <?php if ($filter['is_business'] == '0') echo 'selected="true"'; ?>>Cá nhân</option>
                        </select>
                    </li>
                    <li>
                        MR <input type="radio" name="gender" value="0" <?php if ($filter['gender'] == '0') echo 'checked="checked"'; ?>/>
                        MS <input type="radio" name="gender" value="1" <?php if ($filter['gender'] == '1') echo 'checked="checked"'; ?>/>
                    </li>
                    <li  class="muahang">
                        Chưa mua hàng <input type="radio" name="not-buy" value="1" <?php if ($filter['not_buy'] == '1') echo 'checked="checked"'; ?> />
                        Từng mua hàng <input type="radio" name="not-buy" value="2" <?php if ($filter['not_buy'] == '2') echo 'checked="checked"'; ?>/>
                    </li>
                    <li>
                        Email:   (*)
                        <input type="text" name="email" value="<?php echo $filter['email']; ?>" size="30" />
                    </li>
                    <li>
                        Phone:     (*)
                        <input type="text" name="phone" value="<?php echo $filter['phone']; ?>" size="30"/>
                    </li>
                    <li class="muahang">
                        Billing Address: (*)  
                        <input type="text" name="billing_address" value="<?php echo $filter['billing_address']; ?>" size="30"/>
                    </li>
                    <li  class="muahang">
                        Shipping Address:   (*)
                        <input type="text" name="shipping_address" value="<?php echo $filter['shipping_address']; ?>" size="30"/>
                    </li>

                    <li class="canhan">
                        First Name: (*)
                        <input type="text" name="firstname" value="<?php echo $filter['firstname']; ?>" size="30"/>
                    </li>

                    <li class="canhan">
                        Last Name:  (*)
                        <input type="text" name="lastname" value="<?php echo $filter['lastname']; ?>" size="30"/>
                    </li>
                    <li class="congty">
                        Company:    (*)
                        <input type="text" name="company" value="<?php echo $filter['company']; ?>" size="30"/>
                    </li>
                    <li  class="congty">
                        Contact Person:    (*)
                        <input type="text" name="contact_person" value="<?php echo $filter['contact_person']; ?>" size="30"/>
                    </li>

                    <li  class="congty">
                        Website: 
                        <input type="text" name="website" value="<?php echo $filter['website']; ?>" size="30"/>
                    </li>
                    <li  class="congty">
                        Tax code: 
                        <input type="text" name="tax_code" value="<?php echo $filter['tax_code']; ?>" size="30"/>
                    </li>
                    <li>
                        Address:  
                        <input type="text" name="address" value="<?php echo $filter['address']; ?>" size="30"/>
                    </li>

                    <li>
                        Yahoo:  
                        <input type="text" name="yahoo" value="<?php echo $filter['yahoo']; ?>" size="30"/>
                    </li>
                    <li>
                        Skype:  
                        <input type="text" name="skype" value="<?php echo $filter['skype']; ?>" size="30"/>
                    </li>

                    <li  class="canhan">
                        Career:  
                        <input type="text" name="career" value="<?php echo $filter['career']; ?>" size="30"/>
                    </li>

                    <li class="message">
                        <textarea name="message"><?php echo $filter['message']; ?></textarea>
                    </li>
                    <li class="orderbutton">
                        <input type="reset" name="" value ="Clear"/>
                        <input type="hidden" name="ok-click" value="ok-click"/>
                        <input type="submit" name="ok-submit" value ="Order"/>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</form>