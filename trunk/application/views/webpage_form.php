<script type="text/javascript" src="<?php echo base_url().'js/ckeditor/ckeditor.js'; ?>" ></script>
<script type="text/javascript">
    function validate() {
        
        document.pageform.submit();
       
    }
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container" >
    <div class="portlet-header ui-widget-header">
    <?php echo ($page->id ? lang('txt_edit_page') : lang('txt_add_page')); ?>
    </div>
    <div class="portlet-content">
        <form action="" method="post" enctype="multipart/form-data" class="forms" name="pageform" >
                <ul>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_title'); ?>
                                </label>
                                <div>
                                        <div type="text-multilang" lang="en,vi" tabindex="1" maxlength="255" class="field text medium" id="title" name="title" value="<?php echo $page->title; ?>" ></div>
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_link'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text medium" id="link" name="link" value="<?php echo $page->link; ?>" />
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_content'); ?>
                                </label>
                                <div>
                                        <div type="texteditor-multilang" lang="en,vi" id="content" name="content" value="<?php echo $page->content; ?>" ></div>
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_keyword'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text medium" id="keywords" name="keywords" value="<?php echo $page->keywords; ?>" />
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                    <?php echo lang('txt_status'); ?>
                                </label>
                                <div>
                                    <input type="radio" class="field radio" id="is_disabled_1" name="is_disabled" value="<?php echo IS_NOT_DISABLED; ?>" <?php if ($page->is_disabled == IS_NOT_DISABLED) { echo "checked"; } ?> />
                                    <label for="is_disabled_1" class="choice desc"><?php echo lang('txt_publishing'); ?></label>
                                    <input type="radio" class="field radio" id="is_disabled_2" name="is_disabled" value="<?php echo IS_DISABLED; ?>" <?php if ($page->is_disabled == IS_DISABLED) { echo "checked"; } ?> />
                                    <label for="is_disabled_2" class="choice desc"><?php echo lang('txt_hidden'); ?></label>
                                </div>
                        </li>
                </ul>
            <input type="hidden" name="act" value="<?php echo ACT_SUBMIT; ?>" />
        </form>
    </div>
</div>
<div class="clearfix"></div>