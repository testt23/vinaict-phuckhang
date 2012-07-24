<script type="text/javascript" src="<?php echo base_url('js/ckeditor/ckeditor.js'); ?>" ></script>
<?php if (isset($img_urls[BO_SOCIAL_LINK_IMG_SUFFIX]) && $img_urls[BO_SOCIAL_LINK_IMG_SUFFIX]) { ?>
<script type="text/javascript" src="<?php echo base_url('js/zclip/jquery.zclip.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('js/prettyPhoto/css/prettyPhoto.css'); ?>" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<script src="<?php echo base_url('js/prettyPhoto/js/jquery.prettyPhoto.js'); ?>" type="text/javascript" charset="utf-8"></script>
<?php } ?>
<script type="text/javascript">
    function validate() {
        
        document.sociallinkform.submit();
       
    }
    
    function recreateImage(id, id_social_link) {
        
        if (confirm("<?php echo lang('txt_action_confirm'); ?>")) {
            window.location = "<?php echo base_url('social_link/recreateImage'); ?>/" + id + '/' + id_social_link;
        }
        
    }
    
    function deleteImage(id, id_social_link) {
        
        if (confirm("<?php echo lang('txt_delete_confirm'); ?>")) {
            window.location = "<?php echo base_url('social_link/deleteImage'); ?>/" + id + '/' + id_social_link;
        }
       
    }
    <?php if (isset($img_urls[BO_SOCIAL_LINK_IMG_SUFFIX]) && $img_urls[BO_SOCIAL_LINK_IMG_SUFFIX]) { ?>
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
    <?php echo ($social_link->id ? lang('txt_edit_social_link') : lang('txt_add_social_link')); ?>
    </div>
    <div class="portlet-content">
        <form action="" method="post" enctype="multipart/form-data" class="forms" name="sociallinkform" >
                <ul>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_name'); ?>
                                </label>
                                <div>
                                        <div type="text-multilang" lang="en,vi" tabindex="1" maxlength="255" class="field text medium" id="name" name="name" value="<?php echo $social_link->name; ?>" ></div>
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_link'); ?>
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text medium" id="url" name="url" value="<?php echo $social_link->url; ?>" />
                                </div>
                        </li>
                        <?php if ($social_link->id_image && isset($img_urls)) { ?>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_picture'); ?>
                                </label>
                                <div>
                                    <?php if (isset($img_urls[BO_SOCIAL_LINK_IMG_SUFFIX]) && $img_urls[BO_SOCIAL_LINK_IMG_SUFFIX]) { ?>
                                    <span>
                                        <a href="<?php echo $img_urls['origin']; ?>" rel="prettyPhoto" title="<?php echo getI18n($image->description); ?>">
                                            <img id="picture" src="<?php echo $img_urls[BO_SOCIAL_LINK_IMG_SUFFIX]; ?>" alt="<?php echo getI18n($image->name); ?>" />
                                        </a>
                                    </span>
                                    <a id="copy-link" class="btn ui-state-default ui-corner-all" href="#copy-link">
                                        <span class="ui-icon ui-icon-clipboard"></span>
                                        <?php echo lang('txt_copy_link_to_clipboard'); ?>
                                    </a>
                                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_recreate_images'); ?>" href="#" onclick="recreateImage(<?php echo $social_link->id_image; ?>, <?php echo $social_link->id; ?>)">
                                            <span class="ui-icon ui-icon-refresh"></span>
                                    </a>
                                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_delete_images'); ?>" href="#" onclick="deleteImage(<?php echo $social_link->id_image; ?>, <?php echo $social_link->id; ?>)">
                                            <span class="ui-icon ui-icon-trash"></span>
                                    </a>
                                    <?php } else { echo '<span style="padding:10px 5px;">'.lang('msg_image_file_not_found').'</span>'; ?>
                                    <a class="btn_no_text btn ui-state-alert ui-corner-all tooltip" title="<?php echo lang('txt_recreate_images'); ?>" href="#" onclick="recreateImage(<?php echo $social_link->id_image; ?>, <?php echo $social_link->id; ?>)">
                                            <span class="ui-icon ui-icon-refresh"></span>
                                    </a>
                                    <a class="btn_no_text btn ui-state-alert ui-corner-all tooltip" title="<?php echo lang('txt_delete_images'); ?>" href="#" onclick="deleteImage(<?php echo $social_link->id_image; ?>, <?php echo $social_link->id; ?>)">
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