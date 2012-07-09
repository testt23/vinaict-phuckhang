<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/uploadifive/uploadifive.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('js/prettyPhoto/css/prettyPhoto.css'); ?>" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<script src="<?php echo base_url('js/prettyPhoto/js/jquery.prettyPhoto.js'); ?>" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url('js/zclip/jquery.zclip.min.js'); ?>"></script>
<script src="<?php echo base_url('js/uploadifive/jquery.uploadifive-v1.0.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    function validate() {
        
        document.newscategoryform.submit();
       
    }
    
    function deleteImage(id, id_news_category) {
        
        if (confirm("<?php echo lang('txt_delete_confirm'); ?>")) {
            window.location = "<?php echo base_url('news_categoy/deleteImage'); ?>/" + id + '/' + id_news_category;
        }
       
    }
    
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container" >
    <div class="portlet-header ui-widget-header">
    <?php echo ($news_category->id ? lang('txt_edit_news_category') : lang('txt_add_news_category')); ?>
    </div>
    <div class="portlet-content">
        <form action="" method="post" enctype="multipart/form-data" class="forms" name="newscategoryform" >
                <ul>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_name'); ?>
                                </label>
                                <div>
                                        <div type="text-multilang" lang="en,vi" tabindex="1" maxlength="255" class="field text medium" id="name" name="name" value="<?php echo $news_category->name; ?>" ></div>
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_description'); ?>&nbsp;(<?php echo lang('txt_about_50_words'); ?>)
                                </label>
                                <div>
                                        <div type="textarea-multilang" lang="en,vi" tabindex="1" maxlength="255" class="field textarea small" id="description" name="description" value="<?php echo $news_category->description; ?>" ></div>
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_parent_category'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text medium" id="parent" name="parent" value="<?php echo $news_category->id_parent; ?>" />
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_keyword'); ?>&nbsp;(<?php echo lang('txt_separated_by_comma'); ?>)
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text medium" id="keyword" name="keyword" value="<?php echo $news_category->keyword; ?>" />
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_link'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text medium" id="link" name="link" value="<?php echo $news_category->link; ?>" />
                                </div>
                        </li>
                        
                        
                        <?php if ($news_category->id && isset($img_urls)) { ?>
                        <li>
                                
                                <div>
                                    <?php if (isset($img_urls[BO_NEWS_CATEGORY_IMG_SUFFIX]) && $img_urls[BO_NEWS_CATEGORY_IMG_SUFFIX]) { ?>
                                    <span>
                                        <a href="<?php echo $img_urls['origin']; ?>" rel="prettyPhoto" title="<?php echo getI18n($image->description); ?>">
                                            <img id="picture" src="<?php echo $img_urls[BO_NEWS_CATEGORY_IMG_SUFFIX]; ?>" alt="<?php echo getI18n($image->name); ?>" />
                                        </a>
                                    </span>
                                    <a id="copy-link" class="btn ui-state-default ui-corner-all" href="#copy-link">
                                        <span class="ui-icon ui-icon-clipboard"></span>
                                        <?php echo lang('txt_copy_link_to_clipboard'); ?>
                                    </a>
                                    
                                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_delete_images'); ?>" href="#" onclick="deleteImage(<?php echo $news_category->id; ?>)">
                                            <span class="ui-icon ui-icon-trash"></span>
                                    </a>
                                    <?php } else { echo '<span style="padding:10px 5px;">'.lang('msg_image_file_not_found').'</span>'; ?>
                                    
                                    <a class="btn_no_text btn ui-state-alert ui-corner-all tooltip" title="<?php echo lang('txt_delete_images'); ?>" href="#" onclick="deleteImage(<?php echo $news->id; ?>, <?php echo $news->id; ?>)">
                                            <span class="ui-icon ui-icon-trash"></span>
                                    </a>
                                    <?php } ?>
                                </div>
                        </li>
                        <?php } ?>
                        
                        
                </ul>
            <input type="hidden" name="act" value="<?php echo ACT_SUBMIT; ?>" />
        </form>
    </div>
</div>
<div class="clearfix"></div>