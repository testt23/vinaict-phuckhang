<script type="text/javascript">
    function login() {
        
        document.loginform.submit();
       
    }
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container" >
    <div class="portlet-header ui-widget-header">
    <?php echo SITE_NAME; ?>
    </div>
    <div class="portlet-content">
        
            <form action="" method="post" enctype="multipart/form-data" class="forms" name="loginform" >
                <input type="hidden" name="act" value="<?php echo ACT_SUBMIT; ?>" />
                    <ul>
                            <li>
                                    <label for="email" class="desc">
                                            <?php echo lang('txt_email') ?>:
                                    </label>
                                    <div>
                                            <input type="text" tabindex="1" maxlength="255" value="<?php echo $login_email; ?>" class="field text full" name="email" id="email" />
                                    </div>
                            </li>
                            <li>
                                    <label for="password" class="desc">
                                            <?php echo lang('txt_password') ?>:
                                    </label>
                                    <div>
                                            <input type="password" tabindex="1" maxlength="255" value="" class="field text full" name="password" id="password" />
                                    </div>
                            </li>
                            <li>
                                <button class="ui-state-default ui-corner-all" type="submit" onclick="login()"><?php echo lang('txt_login'); ?></button>
                            </li>
                    </ul>
            </form>
    
    </div>
</div>

<p class="copy" style="text-align: center;" >Copyright &COPY; 2012 - VinaICT.com</p>

<div class="clearfix"></div>