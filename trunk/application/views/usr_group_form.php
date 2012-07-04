<script type="text/javascript">
    function validate() {
       
        document.groupform.submit();
    } 
</script>
 <?php
            if(isset($group) && isset($edit_group)){
                $group->fetchNext();
            }
?>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container" >
    <div class="portlet-header ui-widget-header">
    <?php echo isset($edit_group) ? lang('txt_edit_group') : lang('txt_add_group'); ?>
    </div>
    <div class="portlet-content">
        <form action="" method="post" enctype="multipart/form-data" class="forms" name="groupform" >
                <ul>                        
                        <?php if (isset($group) && isset($edit_group)) { ?>
                        <li>
                                <label for="code" class="desc">
                                        <?php echo lang('txt_code_group'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text small" id="code" name="code" value="<?php echo $group->code; ?>" />
                                </div>
                        </li>
                        <li>
                                <label for="name" class="desc">
                                        <?php echo lang('txt_name_group'); ?>
                                </label>
                                <div>
                                    <div id="name" name="name" class="field text small" type="text-multilang" lang="en,vi" def-lang="vi" value="<?php echo $group->name; ?>"></div>
                                </div>
                        </li>
                        <?php 
                            }else { 
                       ?>
                        <li>
                                <label for="code" class="desc">
                                        <?php echo lang('txt_code_group'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text small" id="code" name="code" />
                                </div>
                        </li>
                        <li>
                                <label for="name" class="desc">
                                        <?php echo lang('txt_name_group'); ?>
                                </label>
                                <div>
                                        <div id="name" name="name" class="field text small" type="text-multilang" lang="en,vi" def-lang="vi" value=""></div>
                                </div>
                        </li>
                        <?php } ?>
                </ul>
            <input type="hidden" name="act" value="<?php echo ACT_SUBMIT; ?>" />
        </form>
    </div>
</div>
<div class="clearfix"></div>