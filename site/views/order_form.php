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
                alert('<?php echo lang('show_empty_email');?>');
                return false;
            }
        
            if (!KiemTra_Email(email)){
                alert('<?php echo lang('show_format_email');?>');
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
                        alert("<?php echo lang('show_empty_phone');?>");
                        return false;
                    }
            
                    if ( billing == ''){
                        alert("<?php echo lang('show_empty_billing');?>");
                        return false;
                    }
            
                    if ( shipping == ''){
                        alert("<?php echo lang('show_empty_shipping');?>");
                        return false;
                    }
            
            
            
                    if (mcho == '1'){
                        var company = trim(jQuery('input[name="company"]').val());
                        var contact_person = trim(jQuery('input[name="contact_person"]').val());
                        if (company == ''){
                            alert("<?php echo lang('show_empty_company');?>");
                            return false;
                        }
                
                        if (contact_person == ''){
                            alert("<?php echo lang('show_empty_personal');?>");
                            return false;
                        }
                    }
            
                    if (mcho == 0){
                        var firstname = trim(jQuery('input[name="firstname"]').val());
                        var lastname = trim(jQuery('input[name="lastname"]').val());
                        
                        if (firstname == ''){
                            alert("<?php echo lang('show_empty_firstname');?>");
                            return false;
                        }
                
                        if (lastname == ''){
                            alert("<?php echo lang('show_empty_lastname');?>");
                            return false;
                        }
                    }
                }
            }else{
                var message = trim(jQuery('textarea[name="message"]').val());
                if (message == ''){
                    alert("<?php echo lang('show_empty_message');?>");
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
            <h1><?php echo lang('note_form');?></h1>
                
            <div class="ul-main">
                <center style="font-style: italic; color: blue;">  <?php echo $mess; ?><br/></center> 
                <center style="font-style: italic;">   (<?php echo lang('note_content');?>)<br/></center> 
                <ul class="ul-right">
                    <li>
                        <?php echo lang('lbl_purpose');?> 
                        <select name="mucdich" onchange="check_mucdich()">
                            <option value="1" <?php if ($filter['mucdich'] == '1') echo 'selected="true"'; ?>><?php echo lang('');?><?php echo lang('cobx_contact');?></option>
                            <option value="2" <?php if ($filter['mucdich'] == '2') echo 'selected="true"'; ?>><?php echo lang('');?><?php echo lang('cobx_buy');?></option>
                        </select>
                    </li>
                    <li class="muahang">
                        <?php echo lang('lbl_buy_by');?>
                        <select name="muacho" onchange="check_muacho()" >
                            <option value="1" <?php if ($filter['is_business'] == '1') echo 'selected="true"'; ?>><?php echo lang('');?><?php echo lang('cobx_for_company');?></option>
                            <option value="0" <?php if ($filter['is_business'] == '0') echo 'selected="true"'; ?>><?php echo lang('');?><?php echo lang('cobx_for_personal');?></option>
                        </select>
                    </li>
                    <li>
                        <?php echo lang('rdb_gender_mr');?> <input type="radio" name="gender" value="0" <?php if ($filter['gender'] == '0') echo 'checked="checked"'; ?>/>
                        <?php echo lang('rdb_gender_ms');?> <input type="radio" name="gender" value="1" <?php if ($filter['gender'] == '1') echo 'checked="checked"'; ?>/>
                    </li>
                    <li  class="muahang">
                        <?php echo lang('rdb_no_purchases');?> <input type="radio" name="not-buy" value="1" <?php if ($filter['not_buy'] == '1') echo 'checked="checked"'; ?> />
                        <?php echo lang('rdb_having_a_purchase');?> <input type="radio" name="not-buy" value="2" <?php if ($filter['not_buy'] == '2') echo 'checked="checked"'; ?>/>
                    </li>
                    <li>
                        <?php echo lang('lbl_email_address');?>   (*)
                        <input maxlength="100" type="text" name="email" value="<?php echo $filter['email']; ?>" size="30" />
                    </li>
                    <li>
                        <?php echo lang('lbl_phone');?>  (*)
                        <input  maxlength="20" type="text" name="phone" value="<?php echo $filter['phone']; ?>" size="30"/>
                    </li>
                    <li class="muahang">
                        <?php echo lang('lbl_billing_address');?> (*)  
                        <input  maxlength="255" type="text" name="billing_address" value="<?php echo $filter['billing_address']; ?>" size="30"/>
                    </li>
                    <li  class="muahang">
                        <?php echo lang('lbl_shipping_address');?> (*)
                        <input  maxlength="255" type="text" name="shipping_address" value="<?php echo $filter['shipping_address']; ?>" size="30"/>
                    </li>

                    <li class="canhan">
                        <?php echo lang('lbl_firstname');?> (*)
                        <input  maxlength="100" type="text" name="firstname" value="<?php echo $filter['firstname']; ?>" size="30"/>
                    </li>

                    <li class="canhan">
                        <?php  echo lang('lbl_lastname');?>  (*)
                        <input  maxlength="100" type="text" name="lastname" value="<?php echo $filter['lastname']; ?>" size="30"/>
                    </li>
                    <li class="congty">
                        <?php echo lang('lbl_company');?>    (*)
                        <input  maxlength="200" type="text" name="company" value="<?php echo $filter['company']; ?>" size="30"/>
                    </li>
                    <li  class="congty">
                        <?php echo lang('lbl_contact_with');?>    (*)
                        <input  maxlength="200" type="text" name="contact_person" value="<?php echo $filter['contact_person']; ?>" size="30"/>
                    </li>

                    <li  class="congty">
                        <?php echo lang('lbl_website_address');?>
                        <input  maxlength="255" type="text" name="website" value="<?php echo $filter['website']; ?>" size="30"/>
                    </li>
                    <li  class="congty">
                        <?php echo lang('lbl_tax_code');?>
                        <input  maxlength="20" type="text" name="tax_code" value="<?php echo $filter['tax_code']; ?>" size="30"/>
                    </li>
                    <li>
                        <?php echo lang('lbl_home_address');?>  
                        <input type="text" name="address" value="<?php echo $filter['address']; ?>" size="30"/>
                    </li>

                    <li>
                        <?php echo lang('lbl_yahoo_address');?>  
                        <input  maxlength="50" type="text" name="yahoo" value="<?php echo $filter['yahoo']; ?>" size="30"/>
                    </li>
                    <li>
                        <?php echo lang('lbl_skype_address');?>  
                        <input  maxlength="50" type="text" name="skype" value="<?php echo $filter['skype']; ?>" size="30"/>
                    </li>

                    <li  class="canhan">
                        <?php echo lang('lbl_career');?>  
                        <input  maxlength="50" type="text" name="career" value="<?php echo $filter['career']; ?>" size="30"/>
                    </li>

                    <li class="message">
                        <textarea name="message"><?php echo $filter['message']; ?></textarea>
                    </li>
                    <li class="orderbutton">
                        <input type="reset" name="" value ="<?php echo lang('btn_clear');?>"/>
                        <input type="hidden" name="ok-click" value="ok-click"/>
                        <input type="submit" name="" value ="<?php echo lang('btn_order');?>"/>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</form>