<script type="text/javascript" src="<?php echo base_url().'js/ckeditor/ckeditor.js'; ?>" ></script>
<script type="text/javascript">
    function validate() {
        
        document.articleform.submit();
       
    }
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container" >
    <div class="portlet-header ui-widget-header">
    <?php echo ($article->id ? lang('txt_edit_article') : lang('txt_add_article')); ?>
    </div>
    <div class="portlet-content">
        <form action="" method="post" enctype="multipart/form-data" class="forms" name="articleform" >
                <ul>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_title'); ?>
                                </label>
                                <div>
                                        <div type="text-multilang" lang="en,vi" def-lang="vi" tabindex="1" maxlength="255" class="field text medium" id="title" name="title" value="<?php echo $article->title; ?>" ></div>
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_link'); ?>
                                </label>
                                <div>
                                        <input type="text"tabindex="1" maxlength="255" class="field text medium" id="link" name="link" value="<?php echo $article->link; ?>" />
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_content'); ?>
                                </label>
                                <div>
                                        <div type="texteditor-multilang" lang="en,vi" id="content" def-lang="vi" name="content" value="<?php echo $article->content; ?>" ></div>
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_keyword'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text medium" id="keywords" name="keywords" value="<?php echo $article->keywords; ?>" />
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_category'); ?>
                                </label>
                                <div>
                                    <select id="id_news_category" name="id_news_category">
                                        <?php while ($newscategory->fetchNext()) { ?>
                                        <option <?php if ($newscategory->id == $article->id_news_category) { echo "selected"; } ?> value="<?php echo $newscategory->id; ?>"><?php echo getI18n($newscategory->name); ?></option>
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