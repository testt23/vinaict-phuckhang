<link rel="stylesheet" href="<?php echo base_url('js/prettyPhoto/css/prettyPhoto.css'); ?>" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<script src="<?php echo base_url('js/prettyPhoto/js/jquery.prettyPhoto.js'); ?>" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url('js/zclip/jquery.zclip.min.js'); ?>"></script>
<script type="text/javascript">
    function deleteImage(id, id_product) {
        
        if (confirm("<?php echo lang('txt_delete_confirm'); ?>")) {
            window.location = "<?php echo base_url('product/deleteImage'); ?>/" + id + '/' + id_product;
        }
       
    }
    
    function recreateImage(id, id_product) {
        
        if (confirm("<?php echo lang('txt_action_confirm'); ?>")) {
            window.location = "<?php echo base_url('product/recreateImage'); ?>/" + id + '/' + id_product;
        }
        
    }
    
    $(document).ready(function(){
        $("a[rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'fast',
            social_tools: false
        });
        
        $("a[rel^='copy-link']").each(function(){
            
            var code = $(this).attr('id').toString().replace('copy_', '');
            
            $(this).zclip({
                path:'<?php echo base_url('js/zclip/ZeroClipboard.swf'); ?>',
                copy:$('#link_'+code).val(),
                afterCopy:function(){
                    showMessageBubble($('#img_'+code), '<?php echo lang('msg_picture_link_copied'); ?>');
                }
            });
            
        });
    });
    
</script>

<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container" >
    <div class="portlet-header ui-widget-header">
    <?php echo lang('txt_product_picture'); ?>
    </div>
    <div class="portlet-content">
        
        <form action="" method="post" enctype="multipart/form-data" class="forms" name="prodimageform" >
                <ul>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_select_file'); ?>
                                </label>
                                <div>
                                        <input type="file" id="image" name="image" />
                                        <input type="submit" value="<?php echo lang('txt_upload'); ?>" />
                                </div>
                        </li>
                </ul>
            <input type="hidden" name="act" value="<?php echo ACT_SUBMIT; ?>" />
        </form>
        
        <div class="hastable">				
        <?php if ($picture) { ?>
            <table> 
                <thead> 
                    <tr>
                        <th width="200px"><?php echo lang('txt_picture'); ?></th> 
                        <th><?php echo lang('txt_detail_information'); ?></th> 
                        <th width="100px"><?php echo lang('txt_options'); ?></th>
                    </tr> 
                </thead> 
                <tbody> 
                    <?php while($picture->fetchNext()) { ?>
                    <tr>
                        <td>
                            <a href="<?php $image_file = direct_url(base_url(UPLOAD_IMAGE_URL).$picture->image_path); echo $image_file; ?>" title="<?php $picture->code.'-'.$picture->name; ?>" rel="prettyPhoto[pp_gal]" >
                                <img id="img_<?php echo $picture->code; ?>" src="<?php echo base_url(UPLOAD_IMAGE_URL).str_replace(array('.jpg', '.JPG', '.png', '.PNG', '.gif', '.GIF'),array(BO_PROD_DETAIL_IMG_SUFFIX.'.jpg', BO_PROD_DETAIL_IMG_SUFFIX.'.JPG', BO_PROD_DETAIL_IMG_SUFFIX.'.png', BO_PROD_DETAIL_IMG_SUFFIX.'.PNG', BO_PROD_DETAIL_IMG_SUFFIX.'.gif', BO_PROD_DETAIL_IMG_SUFFIX.'.GIF'), $picture->image_path); ?>" alt="<?php echo $picture->description; ?>" />
                            </a>
                        </td>
                        <td>
                            <table class="blank-table">
                                <tr>
                                    <td><?php echo $picture->code; ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $picture->name; ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $picture->description; ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $picture->creation_date; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="hidden" id="<?php echo 'link_'.$picture->code; ?>" value="<?php echo $image_file; ?>" />
                                        <a id="<?php echo 'copy_'.$picture->code; ?>" rel="copy-link" class="btn ui-state-default ui-corner-all" href="#">
                                            <span class="ui-icon ui-icon-clipboard"></span>
                                            <?php echo lang('txt_copy_link_to_clipboard'); ?>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <?php if ($picture->id == $product->id_def_image) { ?>
                            <a class="btn_no_text btn ui-state-active ui-corner-all tooltip" title="<?php echo lang('txt_representative_picture'); ?>" href="#">
                                    <span class="ui-icon ui-icon-check"></span>
                            </a>
                            <?php } else { ?>
                            <a class="btn_no_text btn ui-state-<?php if (!$product->id_def_image) { echo 'alert'; } else { echo 'default'; } ?> ui-corner-all tooltip" title="<?php echo lang('txt_set_representative_picture'); ?>" href="<?php echo base_url('product/setDefaultImage/'.$picture->id.'/'.$product->id); ?>">
                                    <span class="ui-icon ui-icon-closethick"></span>
                            </a>
                            <?php } ?>
                            <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_recreate_images'); ?>" href="#" onclick="recreateImage(<?php echo $picture->id; ?>, <?php echo $product->id; ?>)">
                                    <span class="ui-icon ui-icon-refresh"></span>
                            </a>
                            <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_delete'); ?>" href="#" onclick="deleteImage(<?php echo $picture->id; ?>, <?php echo $product->id; ?>)">
                                    <span class="ui-icon ui-icon-trash"></span>
                            </a>
                        </td>
                    </tr> 
                <?php } ?>
                </tbody>
            </table>
        <?php } else {?>
            <table>
                <tr>
                    <td><?php echo lang('txt_there_is_no_image'); ?></td>
                </tr>
            </table>
        <?php } ?>
    </div>
    </div>
</div>
<div class="clearfix"></div>
