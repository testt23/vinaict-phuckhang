<script type="text/javascript">
    function validate() {
        
        document.news_categoryform.submit();
       
    }
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container" >
    <div class="portlet-header ui-widget-header">
    <?php echo ($news_category->id ? lang('txt_edit_news_category') : lang('txt_add_news_category')); ?>
    </div>
    <div class="portlet-content">
        <form action="" method="post" enctype="multipart/form-data" class="forms" name="news_categoryform" >
                <ul>
                       <li>
                                <label class="desc">
                                        <?php echo lang('txt_name'); ?>
                                </label>
                                <div>
                                        <div type="text-multilang" lang="en,vi" def-lang="vi" tabindex="1" maxlength="255" class="field text medium" id="name" name="name" value="<?php echo $news_category->name; ?>" ></div>
                                 </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_description'); ?>
                                </label>
                                <div>
                                        <div type="text-multilang" lang="en,vi" def-lang="vi" tabindex="1" maxlength="255" class="field text medium" id="description" name="description" value="<?php echo $news_category->description; ?>" ></div>
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_link'); ?>
                                </label>
                                <div>
                                        <input type="text"tabindex="1" maxlength="255" class="field text medium" id="link" name="link" value="<?php echo $news_category->link; ?>" />
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_keyword'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text medium" id="keywords" name="keywords" value="<?php echo $news_category->keyword; ?>" />
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_category'); ?>
                                </label>
                                <div>
                                    <select size="5" class="field select small" id="id_parent" name="id_parent">
                                        <option value=""><?php echo lang('txt_no_parent'); ?></option>
                                        <?php while ($newscategory->fetchNext()) { ?>
                                        <option <?php if ($newscategory->id == $news_category->id_parent) { echo "selected"; } ?> value="<?php echo $newscategory->id; ?>"><?php echo getI18n($newscategory->name); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </li>
                </ul>
            <input type="hidden" name="act" value="<?php echo ACT_SUBMIT; ?>" />
        </form>
    </div>
</div>
<div class="clearfix"></div>