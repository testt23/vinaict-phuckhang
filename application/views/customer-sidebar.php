<script type="text/javascript">
    function getHref() {
        var name = jQuery('#name').val();
        var code = jQuery('#code').val();
        var email = jQuery('#email').val();
        var phone = jQuery('#phone').val();
        var yahoo = jQuery('#yahoo').val();
        var skype = jQuery('#skype').val();
        var address = jQuery('#address').val();
        var gender = jQuery('#gender').val();
        
        var href = "?name="+name+"&code="+code+"&email="+email+"&phone="+phone+"&yahoo="+yahoo+"&skype="+skype+"&address="+address+"&gender="+gender;
        return href;
    }
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
                <div class="portlet-header ui-widget-header"><?php echo lang('txt_searchbox'); ?></div>
                <div class="portlet-content">
                    <form id="searchform" name="searchform" action="" method="post">
                        <ul>
                            <li>
                                <label for="name"><?php // echo lang('txt_name'); ?>Mã</label>
                                <div>
                                    <input type="text" id="code" name="code" value="<?php echo $filter['code']; ?>" />
                                </div>
                            </li>
                            <li>
                                <label for="name"><?php echo lang('txt_name'); ?></label>
                                <div>
                                    <input type="text" id="name" name="name" value="<?php echo $filter['name']; ?>" />
                                </div>
                            </li>
                            <li>
                                <label for="name"><?php //echo lang('txt_name'); ?>Giới tính</label>
                                <div>
                                    <select id="gender">
                                        <option value="">-Chọn-</option>
                                        <option value="F" <?php if ($filter['gender'] == 'F') echo 'seelcted'; ?>>Nữ</option>
                                        <option value="M" <?php if ($filter['gender'] == 'M') echo 'seelcted'; ?>>Nam</option>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <label for="name"><?php //echo lang('txt_name'); ?>Email</label>
                                <div>
                                    <input type="text" id="email" name="email" value="<?php echo $filter['email']; ?>" />
                                </div>
                            </li>
                            <li>
                                <label for="name"><?php //echo lang('txt_name'); ?>Điện thoại</label>
                                <div>
                                    <input type="text" id="phone" name="phone" value="<?php echo $filter['phone']; ?>" />
                                </div>
                            </li>
                            <li>
                                <label for="name"><?php //echo lang('txt_name'); ?>Địa chỉ</label>
                                <div>
                                    <input type="text" id="address" name="address" value="<?php echo $filter['address']; ?>" />
                                </div>
                            </li>
                            <li>
                                <label for="name"><?php echo lang('txt_name'); ?>Yahoo</label>
                                <div>
                                    <input type="text" id="yahoo" name="yahoo" value="<?php echo $filter['yahoo']; ?>" />
                                </div>
                            </li>
                            <li>
                                <label for="name"><?php echo lang('txt_name'); ?>Skype</label>
                                <div>
                                    <input type="text" id="skype" name="skype" value="<?php echo $filter['skype']; ?>" />
                                </div>
                            </li>
                            <li>
                                <input type="button" id="bnt_search" value="<?php echo lang('txt_search'); ?>" />
                                <input type="reset" name="" value="Xóa hết"/>
                            </li>
                        </ul>
                    </form>
                </div>
        </div>

<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
        <div class="portlet-header ui-widget-header"><?php echo lang('txt_toolbox'); ?></div>
        <div class="portlet-content">
                <ul class="side-menu">
                        <li>
                            <span class="ui-icon ui-icon-triangle-1-e small-icon"></span>
                            <a href="<?php echo base_url('customer/add'); ?>"><?php echo lang('txt_add_customer'); ?></a>
                        </li>
                </ul>
        </div>
</div>
