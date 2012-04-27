<script type="text/javascript">
    function validate() {
        
        <?php if (!isset($only_change_password)) { ?>
                
        var last_name = document.getElementById('last_name');
        var first_name = document.getElementById('first_name');
        var email = document.getElementById('email');
        
        if (isEmptyTextBox(last_name, '<?php echo lang('err_empty_last_name'); ?>')) {
            return false;
        }
        
        if (last_name.value.length > <?php echo MAX_LENGTH_NAME; ?>) {
            showErrorBubble(last_name, '<?php echo lang('err_last_name_too_long'); ?>');
            return false;
        }
        
        if (isEmptyTextBox(first_name, '<?php echo lang('err_empty_last_name'); ?>')) {
            return false;
        }
        
        if (first_name.value.length > <?php echo MAX_LENGTH_NAME; ?>) {
            showErrorBubble(first_name, '<?php echo lang('err_first_name_too_long'); ?>');
            return false;
        }
        
        if (isEmptyTextBox(email, '<?php echo lang('err_empty_email'); ?>')) {
            return false;
        }
        
        if (!isValidEmail(email, '<?php echo lang('err_invalid_email'); ?>')) {
            return false;
        }
        
        <?php } ?>
            
        <?php if (!$user->id || isset($only_change_password)) { ?>
            var password = document.getElementById('password');
            var confirm_password = document.getElementById('confirm_password');
            
            if (isEmptyTextBox(password, '<?php echo lang('err_empty_password'); ?>')) {
                return false;
            }
            
            if (password.value.length < <?php echo MIN_LENGTH_PASSWORD; ?>) {
                showErrorBubble(password, '<?php echo lang('err_password_too_short'); ?>');
                return false;
            }
            
            if (password.value.length > <?php echo MAX_LENGTH_PASSWORD; ?>) {
                showErrorBubble(password, '<?php echo lang('err_password_too_long'); ?>');
                return false;
            }
            
            if (isEmptyTextBox(confirm_password, '<?php echo lang('err_empty_confirm_password'); ?>')) {
                return false;
            }
            
            if (password.value != confirm_password.value) {
                showErrorBubble(first_name, '<?php echo lang('err_password_confirm_not_match'); ?>');
                return false;
            }
            
        <?php } ?>
        
        
        document.userform.submit();
       
    }
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container" >
    <div class="portlet-header ui-widget-header">
    <?php echo isset($only_change_password) ? lang('txt_change_password') : lang('txt_profile'); ?>
    </div>
    <div class="portlet-content">
        <form action="" method="post" enctype="multipart/form-data" class="forms" name="userform" >
                <ul>
                        <?php if (!isset($only_change_password)) { ?>
                        <li>
                                <label for="email" class="desc">
                                        <?php echo lang('txt_email'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text small" id="email" name="email" value="<?php echo $user->email; ?>" />
                                </div>
                        </li>
                        <?php } ?>
                        
                        <?php if (!$user->id || isset($only_change_password)) { ?>
                        <li>
                                <label for="password" class="desc">
                                        <?php echo isset($only_change_password) ? lang('txt_new_password') : lang('txt_password'); ?>
                                </label>
                                <div>
                                        <input type="password" tabindex="1" maxlength="255" class="field text small" id="password" name="password" />
                                </div>
                        </li>
                        <li>
                                <label for="confirm_password" class="desc">
                                        <?php echo lang('txt_confirm_password'); ?>
                                </label>
                                <div>
                                        <input type="password" tabindex="1" maxlength="255" class="field text small" id="confirm_password" name="confirm_password" />
                                </div>
                        </li>
                        <?php } ?>
                        
                        <?php if (!isset($only_change_password)) { ?>
                        <li>
                                <label for="last_name" class="desc">
                                        <?php echo lang('txt_lastname'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text small" id="last_name" name="last_name" value="<?php echo $user->last_name; ?>" />
                                </div>
                        </li>
                        <li>
                                <label for="first_name" class="desc">
                                        <?php echo lang('txt_firstname'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text small" id="first_name" name="first_name" value="<?php echo $user->first_name ?>" />
                                </div>
                        </li>
                        <li>
                                <label for="address" class="desc">
                                        <?php echo lang('txt_address'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text medium" id="address" name="address" value="<?php echo $user->address; ?>" />
                                </div>
                        </li>
                        <li>
                                <label for="home_phone" class="desc">
                                        <?php echo lang('txt_home_phone'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text small" id="home_phone" name="home_phone" value="<?php echo $user->home_phone; ?>" />
                                </div>
                        </li>
                        <li>
                                <label for="work_phone" class="desc">
                                        <?php echo lang('txt_work_phone'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text small" id="work_phone" name="work_phone" value="<?php echo $user->work_phone; ?>" />
                                </div>
                        </li>
                        <li>
                                <label for="mobile_phone" class="desc">
                                        <?php echo lang('txt_mobile_phone'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text small" id="mobile_phone" name="mobile_phone" value="<?php echo $user->mobile_phone; ?>" />
                                </div>
                        </li>
                        <li>
                                <label for="id_group" class="desc">
                                        <?php echo lang('txt_group'); ?>
                                </label>
                                <div>
                                        <select tabindex="3" class="field select small" id="id_group" name="id_group[]" multiple size="5" > 
                                            <?php while ($group->fetchNext()) { ?>
                                            <option value="<?php echo $group->id; ?>" <?php if (in_array($group->id, $sel_groups)) { ?>selected<?php } ?> >
                                                        <?php echo getI18n($group->name); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                </div>
                        </li>
                        <?php } ?>
                </ul>
            <input type="hidden" name="act" value="<?php echo ACT_SUBMIT; ?>" />
        </form>
    </div>
</div>
<div class="clearfix"></div>