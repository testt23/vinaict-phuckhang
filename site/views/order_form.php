<script language="javascript" src="<?php echo base_url() . 'js/contact.js' ?>">
</script>
<script language="javascript">
       
    (function($){
        check_submit = function(){
        
            var email = jQuery('input[name="email"]').val();
            var phone = trim(jQuery('input[name="phone"]').val());
            var firstname = trim(jQuery('input[name="firstname"]').val());
            var lastname = trim(jQuery('input[name="lastname"]').val());
            
            if (email == '' && phone =='' ){
                alert('<?php echo getI18n('<en>Type email or phone</en><vi>Bạn phải nhập email hoặc số điện thoại</vi>'); ?>');
                return false;
            }
            if (!KiemTra_Email(email) && phone == ''){
                alert('<?php echo lang('show_format_email'); ?>');
                return false;
            }
        
            if (firstname == ''){
                alert("<?php echo lang('show_empty_firstname'); ?>");
                return false;
            }
                
            if (lastname == ''){
                alert("<?php echo lang('show_empty_lastname'); ?>");
                return false;
            } 
            return true;
        }
    })(jQuery);
</script>
<form method="post" action="" onsubmit="return check_submit()">
    <div class="contact-wrapper">
        <div class="contact-main">
            <h1><?php echo lang('note_form'); ?></h1>

            <div class="ul-main">
                <center style="font-style: italic; color: blue;">  <?php echo $mess ?><br/></center> 
                <center style="font-style: italic; font-size: 14px;">   (<?php echo lang('note_content'); ?>)<br/><br/></center> 
                <ul class="ul-right">
                    <li class="muahang" style="display: none;">
                        <input type="hidden" name="mucdich" id="mucdich" value="2" />
                        <?php echo lang('cobx_for_company'); ?><input type="radio" name ="muacho"  value="1" id="muacho" onClick="check_muacho() "/>
                        <?php echo lang('cobx_for_personal'); ?><input type="radio" name ="muacho" value="0" id="muacho" onClick="check_muacho()" checked="checked" />
                    </li>
                    <li class="canhan">
                        <?php echo lang('rdb_gender_mr'); ?> <input type="radio" name="gender" value="M" <?php if ($filter['gender'] == '0')
                            echo 'checked="checked"'; ?>/>
                        <?php echo lang('rdb_gender_ms'); ?> <input type="radio" name="gender" value="F" <?php if ($filter['gender'] == '1')
                            echo 'checked="checked"'; ?>/>
                    </li>
                    <li>
                        <input type="hidden" name="not-buy" value="1" >                        
                        <?php echo lang('lbl_email_address'); ?>   (*)
                        <input maxlength="100" type="text" name="email" value="<?php echo $filter['email']; ?>" size="30" />
                    </li>
                    <li>
                        <?php echo lang('lbl_phone'); ?>  (*)
                        <input  maxlength="20" type="text" name="phone" value="<?php echo $filter['phone']; ?>" size="30"/>
                    </li>
                    <li class="muahang" style="display: none;">
                        <?php echo lang('lbl_billing_address'); ?> (*)  
                        <input  maxlength="255" type="text" name="billing_address" value="<?php echo $filter['billing_address']; ?>" size="30"/>
                    </li>
                    <li  class="muahang" style="display: none;">
                        <?php echo lang('lbl_shipping_address'); ?> (*)
                        <input  maxlength="255" type="text" name="shipping_address" value="<?php echo $filter['shipping_address']; ?>" size="30"/>
                    </li>

                    <li class="canhan">
                        <?php echo lang('lbl_firstname'); ?> (*)
                        <input  maxlength="100" type="text" name="firstname" value="<?php echo $filter['firstname']; ?>" size="30"/>
                    </li>

                    <li class="canhan">
                        <?php echo lang('lbl_lastname'); ?>  (*)
                        <input  maxlength="100" type="text" name="lastname" value="<?php echo $filter['lastname']; ?>" size="30"/>
                    </li>
                    <li class="congty" style="display: none;">
                        <?php echo lang('lbl_company'); ?>    (*)
                        <input  maxlength="200" type="text" name="company" value="<?php echo $filter['company']; ?>" size="30"/>
                    </li>
                    <li  class="congty" style="display: none;">
                        <?php echo lang('lbl_contact_with'); ?>    (*)
                        <input  maxlength="200" type="text" name="contact_person" value="<?php echo $filter['contact_person']; ?>" size="30"/>
                    </li>

                    <li  class="congty" style="display: none;">
                        <?php echo lang('lbl_website_address'); ?>
                        <input  maxlength="255" type="text" name="website" value="<?php echo $filter['website']; ?>" size="30"/>
                    </li>
                    <li  class="congty" style="display: none;">
                        <?php echo lang('lbl_tax_code'); ?>
                        <input  maxlength="20" type="text" name="tax_code" value="<?php echo $filter['tax_code']; ?>" size="30"/>
                    </li>
                    <li>
                        <?php echo lang('lbl_home_address'); ?>  
                        <input type="text" name="address" value="<?php echo $filter['address']; ?>" size="30"/>
                    </li>

                    <li style="display: none;">
                        <?php echo lang('lbl_yahoo_address'); ?>  
                        <input  maxlength="50" type="text" name="yahoo" value="<?php echo $filter['yahoo']; ?>" size="30"/>
                    </li>
                    <li style="display: none;">
                        <?php echo lang('lbl_skype_address'); ?>  
                        <input  maxlength="50" type="text" name="skype" value="<?php echo $filter['skype']; ?>" size="30"/>
                    </li>

                    <li  class="canhan" style="display: none;">
                        <?php echo lang('lbl_career'); ?>  
                        <input  maxlength="50" type="text" name="career" value="<?php echo $filter['career']; ?>" size="30"/>
                    </li>
                    <li class="message">
                        <div class="mask" id="message_mask"><?php echo lang('txt_message'); ?></div>
                        <textarea name="message" id="message" ><?php echo $filter['message']; ?></textarea>
                    </li>
                    <li class="orderbutton">
                        <input type="reset" name="" value ="<?php echo lang('btn_clear'); ?>"/>
                        <input type="hidden" name="ok-click" value="ok-click"/>
                        <input type="submit" name="" value ="<?php echo lang('btn_order'); ?>"/>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</form>