<script type="text/javascript" src="<?php echo base_url('js/ckeditor/ckeditor.js'); ?>" ></script>
<?php if (isset($img_urls[BO_PROD_CATEGORY_IMG_SUFFIX]) && $img_urls[BO_PROD_CATEGORY_IMG_SUFFIX]) { ?>
<script type="text/javascript" src="<?php echo base_url('js/zclip/jquery.zclip.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('js/prettyPhoto/css/prettyPhoto.css'); ?>" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<script src="<?php echo base_url('js/prettyPhoto/js/jquery.prettyPhoto.js'); ?>" type="text/javascript" charset="utf-8"></script>
<?php } ?>
<script type="text/javascript">
    function validate() {
        
        document.prodcategoryform.submit();
       
    }
    
    function recreateImage(id, id_prod_category) {
        
        if (confirm("<?php echo lang('txt_action_confirm'); ?>")) {
            window.location = "<?php echo base_url('prod_category/recreateImage'); ?>/" + id + '/' + id_prod_category;
        }
        
    }
    
    function deleteImage(id, id_prod_category) {
        
        if (confirm("<?php echo lang('txt_delete_confirm'); ?>")) {
            window.location = "<?php echo base_url('prod_category/deleteImage'); ?>/" + id + '/' + id_prod_category;
        }
       
    }
    <?php if (isset($img_urls[BO_PROD_CATEGORY_IMG_SUFFIX]) && $img_urls[BO_PROD_CATEGORY_IMG_SUFFIX]) { ?>
        $(document).ready(function(){
            $("a#copy-link").zclip({
            path:'<?php echo base_url('js/zclip/ZeroClipboard.swf'); ?>',
            copy:'<?php echo $img_urls['origin']; ?>',
            beforeCopy:function(){
            },
            afterCopy:function(){
                showMessageBubble($('#picture'), '<?php echo lang('msg_picture_link_copied'); ?>');
            }
            });
            
            $(document).ready(function(){
                $("a[rel^='prettyPhoto']").prettyPhoto({
                    animation_speed: 'fast',
                    social_tools: false
                });
            });
        });
    <?php } ?>
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container" >
    <div class="portlet-header ui-widget-header">
    <?php echo ($prod_category->id ? lang('txt_edit_product_category') : lang('txt_add_product_category')); ?>
    </div>
    <div class="portlet-content">
        <form action="" method="post" enctype="multipart/form-data" class="forms" name="prodcategoryform" >
                <ul>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_code'); ?>
                                </label>
                                <div>
                                        <input type="text" id="code" name="code" value="<?php echo $prod_category->code; ?>" />
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_name'); ?>
                                </label>
                                <div>
                                        <div type="text-multilang" lang="en,vi" tabindex="1" maxlength="255" class="field text medium" id="name" name="name" value="<?php echo $prod_category->name; ?>" ></div>
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_description'); ?>&nbsp;(<?php echo lang('txt_about_50_words'); ?>)
                                </label>
                                <div>
                                        <div type="textarea-multilang" lang="en,vi" tabindex="1" maxlength="255" class="field textarea small" id="description" name="description" value="<?php echo $prod_category->description; ?>" ></div>
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_link'); ?>
                                </label>
                                <div>
                                        <div type="text-multilang" lang="en,vi" tabindex="1" maxlength="255" class="field text medium" id="link" name="link" value="<?php echo $prod_category->link; ?>" />
                                </div>
                        </li>
                        <li>
                            <label class="desc">
                                    <?php echo lang('txt_parent_product_category'); ?> (<?php echo lang('txt_hold_ctrl_to_select_many'); ?>)
                            </label>
                            <div>
                                <select id="id_parent" name="id_parent[]" class="field select medium" multiple size="10" >
                                    <?php foreach ($categories as $category) { ?>
                                    <option <?php if (in_array($category['id'], $arr_parent)) { echo 'selected'; } ?> value="<?php echo $category['id']; ?>">
                                        <?php
                                        for($i=0; $i < $category['level']; $i++) {
                                            echo '--';
                                        }
                                        
                                        echo ($category['level'] == 0 ? '' : '&nbsp;').getI18n($category['name']);
                                        ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_keyword'); ?>&nbsp;(<?php echo lang('txt_separated_by_comma'); ?>)
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text medium" id="keywords" name="keywords" value="<?php echo $prod_category->keywords; ?>" />
                                </div>
                        </li>
                        <?php if ($prod_category->id_image && isset($img_urls)) { ?>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_picture'); ?>
                                </label>
                                <div>
                                    <?php if (isset($img_urls[BO_PROD_CATEGORY_IMG_SUFFIX]) && $img_urls[BO_PROD_CATEGORY_IMG_SUFFIX]) { ?>
                                    <span>
                                        <a href="<?php echo $img_urls['origin']; ?>" rel="prettyPhoto" title="<?php echo getI18n($image->description); ?>">
                                            <img id="picture" src="<?php echo $img_urls[BO_PROD_CATEGORY_IMG_SUFFIX]; ?>" alt="<?php echo getI18n($image->name); ?>" />
                                        </a>
                                    </span>
                                    <a id="copy-link" class="btn ui-state-default ui-corner-all" href="#copy-link">
                                        <span class="ui-icon ui-icon-clipboard"></span>
                                        <?php echo lang('txt_copy_link_to_clipboard'); ?>
                                    </a>
                                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_recreate_images'); ?>" href="#" onclick="recreateImage(<?php echo $prod_category->id_image; ?>, <?php echo $prod_category->id; ?>)">
                                            <span class="ui-icon ui-icon-refresh"></span>
                                    </a>
                                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_delete_images'); ?>" href="#" onclick="deleteImage(<?php echo $prod_category->id_image; ?>, <?php echo $prod_category->id; ?>)">
                                            <span class="ui-icon ui-icon-trash"></span>
                                    </a>
                                    <?php } else { echo '<span style="padding:10px 5px;">'.lang('msg_image_file_not_found').'</span>'; ?>
                                    <a class="btn_no_text btn ui-state-alert ui-corner-all tooltip" title="<?php echo lang('txt_recreate_images'); ?>" href="#" onclick="recreateImage(<?php echo $prod_category->id_image; ?>, <?php echo $prod_category->id; ?>)">
                                            <span class="ui-icon ui-icon-refresh"></span>
                                    </a>
                                    <a class="btn_no_text btn ui-state-alert ui-corner-all tooltip" title="<?php echo lang('txt_delete_images'); ?>" href="#" onclick="deleteImage(<?php echo $prod_category->id_image; ?>, <?php echo $prod_category->id; ?>)">
                                            <span class="ui-icon ui-icon-trash"></span>
                                    </a>
                                    <?php } ?>
                                </div>
                        </li>
                        <?php } ?>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_select_file'); ?>
                                </label>
                                <div>
                                        <input type="file" id="image" name="image" />
                                </div>
                        </li>
                        
                </ul>
            <input type="hidden" name="act" value="<?php echo ACT_SUBMIT; ?>" />
        </form>
    </div>
</div>
<div class="clearfix"></div>