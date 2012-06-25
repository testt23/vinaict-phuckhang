

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
        
            jQuery('#form_contact').submit(function(){
            <?php 
                
                /*$flag = 'no';
                Session::init();
                if (Session::isHave('giohang')){
                    if (Session::get('giohang') != '' && Session::get('giohang') != null){
                        $flag = 'yes';
                    }
                }*/
            ?>
            var flag = "<?php echo $flag; ?>";
            if (trim(jQuery('#name').val()) == ''){
                alert('<?php //echo getI18n(JS_TYPE_NAME, $_SESSION['language']); ?>');
                return false;
            }else if(trim(jQuery('#email').val()) == ''){
                alert('<?php //echo getI18n(JS_TYPE_EMAIL, $_SESSION['language']); ?>');
                return false;
            }else if(!KiemTra_Email(jQuery('#email').val())){
                alert('<?php //echo getI18n(JS_TYPE_EMAIL_FORTMAT, $_SESSION['language']); ?>');
                return false;
            }else{
                if (flag == 'yes'){
                    if (trim(jQuery('#address').val()) == ''){  
                        alert('<?php //echo getI18n(JS_TYPE_ADDRESS, $_SESSION['language']); ?>');
                        return false;
                    }else if(trim(jQuery('#phone').val()) == ''){
                        alert('<?php //echo getI18n(JS_TYPE_PHONE, $_SESSION['language']); ?>');
                        return false;
                    }
                }
            }
            return true;
        });
    });
</script>


<form method="post" action="<?php //echo URL; ?>/contact/send" id="form_contact">
    <table width="400" cellspacing="30" id="form">
        <tr>
            <td><?php echo lang('txt_contact_hello'); ?></td>
            <td id="contact-table">
                <input type="radio" value="mr" name="general" checked="true"/> 
                Mr
                <input type="radio" value="mrs" name="general" /> 
                Mrs
                <input type="radio" value="miss" name="general" /> 
                Miss</td>
        </tr>
        <tr>
            <td colspan="2"><?php echo lang('txt_contact_message'); ?>.</td>
        </tr>

        <tr>
            <td><?php echo lang('txt_contact_name'); ?></td>
            <td><input type="text" name="name" value="" id="name" /></td>
        </tr>
        <tr>
            <td><?php echo lang('txt_contact_address'); ?></td>
            <td><input type="text" name="address" value="" id="address"/></td>
        </tr>
        <tr>
            <td><?php echo lang('txt_contact_email');?></td>
            <td><input type="text" name="email" value="" id="email" /></td>
        </tr>
        <tr>
            <td><?php echo lang('txt_contact_phone');?></td>
            <td><input type="text" name="phone" value="" id="phone"/></td>
        </tr>
        <tr>
            <td><?php echo lang('txt_contact_description'); ?></td>
            <td>
                <textarea name="noidung" style="border: solid 1px;" id="noidung"></textarea>
            </td>
        </tr>
        <tr >
            <td colspan="2" align="center" style="text-align: center;" >
                <input class="button-s" type="reset" value="<?php echo lang('txt_contact_re_enter'); ?>" name="reset-form" />
                <input id="submit-form" class="button-s" type="submit" value="<?php echo lang('txt_contact_send'); ?>" name="submit-form" style="margin-left: 20px;" />
            </td>
        </tr>
    </table>
</form>