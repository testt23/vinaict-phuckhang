<script type="text/javascript">
    
    function validate() {
        document.customerform.submit();
    }
    
    $(document).ready(function() {
        $('#control-type input[type=radio]').click(function() {
            if ($(this).val() == '1') {
                $('#control-tax_code').attr('style','display:block');
                $('#control-contact_person').attr('style', 'display:block');
                $('#control-mobile_phone').attr('style','display:none');
                $('#control-last_name').attr('style','display:none');
                $('#control-first_name').attr('style','display:none');
                $('#control-gender').attr('style','display:none');
                $('#control-birthdate').attr('style','display:none');
                $('#control-home_phone').attr('style','display:none');
                $('#control-mobile_phone').attr('style','display:none');
                $('#control-career').attr('style','display:none');
            }
            else {
                $('#control-tax_code').attr('style','display:none');
                $('#control-contact_person').attr('style', 'display:none');
                $('#control-fax').attr('style','display:none');
                $('#control-last_name').attr('style','display:block');
                $('#control-first_name').attr('style','display:block');
                $('#control-gender').attr('style','display:block');
                $('#control-birthdate').attr('style','display:block');
                $('#control-home_phone').attr('style','display:block');
                $('#control-mobile_phone').attr('style','display:block');
                $('#control-career').attr('style','display:block');
            }
        });
        <?php if ($customer->is_business == '1') { ?>
            $('#organization').click();
        <?php } else { ?>
            $('#personal').click();
        <?php } ?>
            
        $('#same_address').click(function() {
            if ($(this).attr('checked') == true) {
                $('#control-shipping_address').attr('style', 'display:none');
            }
            else {
                $('#control-shipping_address').attr('style', 'display:block');
            }
        });
            
            
    });
    
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container" >
    <div class="portlet-header ui-widget-header">
    <?php echo lang('txt_customer_info'); ?>
    </div>
    <div class="portlet-content">
        <form action="" method="post" enctype="multipart/form-data" class="forms" name="customerform" >
                <ul>
                        <li>
                                <label for="is_business" class="desc">
                                        <?php echo lang('txt_type'); ?>
                                </label>
                                <div id="control-type" class="col">
                                        <input class="field radio" type="radio" id="personal" name="is_business" value="0" <?php if ($customer->is_business == '0') { echo "checked"; } ?> />
                                        <label for="personal" class="choice"><?php echo lang('txt_personal'); ?></label>
                                        <input class="field radio" type="radio" id="organization" name="is_business" value="1" <?php if ($customer->is_business == '1') { echo "checked"; } ?>  />
                                        <label for="organization" class="choice"><?php echo lang('txt_organization'); ?></label>
                                </div>
                        </li>
                        <li id="control-tax_code">
                                <label for="tax_code" class="desc">
                                        <?php echo lang('txt_tax_code'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text small" id="tax_code" name="tax_code" value="<?php echo $customer->tax_code; ?>" />
                                </div>
                        </li>
                        <li>
                                <label for="company" class="desc">
                                        <?php echo lang('txt_company_organization'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text small" id="company" name="company" value="<?php echo $customer->company; ?>" />
                                </div>
                        </li>
                        <li id="control-contact_person">
                                <label for="contact_person" class="desc">
                                        <?php echo lang('txt_contact_person'); ?>
                                </label>
                                <input type="text" tabindex="1" maxlength="255" class="field text small" id="contact_person" name="contact_person" value="<?php echo $customer->contact_person; ?>" />
                        </li>
                        <li id="control-last_name">
                                <label for="last_name" class="desc">
                                        <?php echo lang('txt_lastname'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text small" id="last_name" name="last_name" value="<?php echo $customer->lastname; ?>" />
                                </div>
                        </li>
                        <li id="control-first_name">
                                <label for="first_name" class="desc">
                                        <?php echo lang('txt_firstname'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text small" id="first_name" name="first_name" value="<?php echo $customer->firstname; ?>" />
                                </div>
                        </li>
                        <li id="control-gender">
                                <label for="gender" class="desc">
                                        <?php echo lang('txt_gender'); ?>
                                </label>
                                <div>
                                    <select id="gender" name="gender" class="field select small">
                                        <option value="<?php echo MALE; ?>" <?php if ($customer->gender == MALE) { echo 'selected'; } ?> ><?php echo lang('txt_male') ?></option>
                                        <option value="<?php echo FEMALE; ?>" <?php if ($customer->gender == FEMALE) { echo 'selected'; } ?> ><?php echo lang('txt_female') ?></option>
                                    </select>
                                </div>
                        </li>
                        <li id="control-birthdate">
                                <label for="birthdate" class="desc">
                                        <?php echo lang('txt_birthdate'); ?>
                                </label>
                                <div>
                                    <div id="birthdate" name="birthdate" class="datepicker" value="<?php echo $customer->birthdate; ?>" maxdate="<?php echo (date('Y') - ALLOWED_AGE).'-12-31'; ?>" ></div>
                                </div>
                        </li>
                        <li id="control-career">
                                <label for="career" class="desc">
                                        <?php echo lang('txt_career'); ?>
                                </label>
                                <div>
                                    <input type="text" tabindex="1" maxlength="255" class="field text small" id="career" name="career" value="<?php echo $customer->career; ?>" />
                                </div>
                        </li>
                        <li>
                                <label for="address" class="desc">
                                        <?php echo lang('txt_address'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text medium" id="address" name="address" value="<?php echo $customer->contact_address; ?>" />
                                </div>
                        </li>
                        <li>
                                <label for="billing_address" class="desc">
                                        <?php echo lang('txt_billing_address'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text medium" id="billing_address" name="billing_address" value="<?php echo $customer->billing_address; ?>" />
                                </div>
                        </li>
                        <li>
                                <div class="col">
                                    <input type="checkbox" class="field checkbox" id="same_address" name="same_address" value="1" <?php if ($same == 1) { echo 'checked'; } ?> />
                                    <label for="same_address" class="choice"><?php echo lang('txt_shipping_at_billing_address'); ?></label>
                                </div>
                        </li>
                        <li id="control-shipping_address" style="display:<?php echo $same == 1 ? 'none' : 'block'; ?>" >
                                <label for="shipping_address" class="desc">
                                        <?php echo lang('txt_shipping_address'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text medium" id="shipping_address" name="shipping_address" value="<?php echo $customer->shipping_address; ?>" />
                                </div>
                        </li>
                        
                        <li id="control-home_phone">
                                <label for="home_phone" class="desc">
                                        <?php echo lang('txt_home_phone'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text small" id="home_phone" name="home_phone" value="<?php echo $customer->home_phone; ?>" />
                                </div>
                        </li>
                        <li id="control-mobile_phone">
                                <label for="mobile_phone" class="desc">
                                        <?php echo lang('txt_mobile_phone'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text small" id="mobile_phone" name="mobile_phone" value="<?php echo $customer->mobile_phone; ?>" />
                                </div>
                        </li>
                        <li>
                                <label for="work_phone" class="desc">
                                        <?php echo lang('txt_work_phone'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text small" id="work_phone" name="work_phone" value="<?php echo $customer->work_phone; ?>" />
                                </div>
                        </li>
                        <li id="control-fax">
                                <label for="fax" class="desc">
                                        <?php echo lang('txt_fax'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text small" id="mobile_phone" name="fax" value="<?php echo $customer->fax; ?>" />
                                </div>
                        </li>
                        <li>
                                <label for="email" class="desc">
                                        <?php echo lang('txt_email'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text small" id="email" name="email" value="<?php echo $customer->email; ?>" />
                                </div>
                        </li>
                        <li>
                                <label for="website" class="desc">
                                        <?php echo lang('txt_website'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text small" id="website" name="website" value="<?php echo $customer->website; ?>" />
                                </div>
                        </li>
                        <li>
                                <label for="yahoo_id" class="desc">
                                        <?php echo lang('txt_ym'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text small" id="yahoo_id" name="yahoo_id" value="<?php echo $customer->yahoo_id; ?>" />
                                </div>
                        </li>
                        <li>
                                <label for="skype_id" class="desc">
                                        <?php echo lang('txt_skype'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text small" id="skype_id" name="skype_id" value="<?php echo $customer->skype_id; ?>" />
                                </div>
                        </li>
                </ul>
            <input type="hidden" name="act" value="<?php echo ACT_SUBMIT; ?>" />
        </form>
    </div>
</div>
<div class="clearfix"></div>