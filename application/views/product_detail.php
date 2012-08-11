<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/uploadifive/uploadifive.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('js/prettyPhoto/css/prettyPhoto.css'); ?>" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<script src="<?php echo base_url('js/prettyPhoto/js/jquery.prettyPhoto.js'); ?>" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url('js/zclip/jquery.zclip.min.js'); ?>"></script>
<script src="<?php echo base_url('js/uploadifive/jquery.uploadifive-v1.0.js'); ?>" type="text/javascript"></script>
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
        $('#file_upload').uploadifive({
            'auto'         : false,
            'queueID'      : 'queue',
            'buttonClass'   : 'btn ui-state-default ui-corner-all',
            'uploadScript' : '<?php echo base_url("image/uploadifive/") . IMG_PRODUCT_CODE . "/$product->id"; ?>',
            'buttonText'   : '<?php echo lang('txt_select_files'); ?>',
            'onUploadComplete' : function(file, data) {
                if (data == 1) {
                    //console.log(image_group_code);
                }

            }
        });
        
        $("a[rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'fast',
            social_tools: false
        });
        
        $('#upload-box').dialog({
            autoOpen: false,
            width: 600,
            bgiframe: false,
            modal: true,
            close: function() {
                document.location.href = '<?php echo selfURL(); ?>';
            }
        });

        $('#openUploadBox').click(function() {
            $('#upload-box').dialog("open");
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
<!-- Begin code of An -->
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container" >
    <div class="portlet-header ui-widget-header">
        <?php echo lang('txt_product_detail'); ?>
    </div>
    <div class="portlet-content">
        <div class="hastable">
            <table> 
                <tr>
                    <th width="120px"><?php echo lang('txt_prod_code'); ?></th>
                    <td><?php echo $pro_det->id; ?></td>

                </tr>
                <tr>
                    <th><?php echo lang('txt_product_name'); ?></th>
                    <td><?php echo clean_html(getI18n($pro_det->name)); ?></td>
                </tr>
                <tr>
                    <th><?php echo lang('txt_short_description'); ?></th>
                    <td><?php echo clean_html(getI18n($pro_det->short_description)); ?></td>
                </tr>
                <tr>
                    <th><?php echo lang('txt_description'); ?></th>
                    <td><?php echo clean_html(getI18n($pro_det->description)); ?></td>
                </tr>
                <tr>
                    <th><?php echo lang('txt_price'); ?></th>
                    <td>
                        <?php
                        if ($pro_det->price == 0 || $pro_det->price == NULL) {
                            echo lang('txt_call');
                        }
                        else {
                            echo clean_html(getI18n($pro_det->price)) . ' ' . $pro_det->currency;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th><?php echo lang('txt_product_link'); ?></th>
                    <td><?php echo $pro_det->link; ?></td>
                </tr>
            </table>                         
        </div>
    </div>
    <!-- End code of An -->
    <br/>

    <div class="portlet-header ui-widget-header">
<?php echo lang('txt_product_picture'); ?>
    </div>
    <div class="portlet-content">
        <div id="upload-box" title="<?php echo lang('txt_upload_image'); ?>">
            <form>
                <div id="queue"></div>
                <input id="file_upload" name="file_upload" type="file" multiple="true" />
                <a class="btn ui-state-default ui-corner-all" style="position: relative; top: 8px;" href="javascript:$('#file_upload').uploadifive('upload')"><?php echo lang('txt_upload'); ?></a>
            </form>
        </div>
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
    <?php while ($picture->fetchNext()) { ?>
                            <tr>
                                <td>
                                    <a href="<?php $image_file = direct_url(base_url(UPLOAD_IMAGE_URL) . $picture->image_path);
        echo $image_file; ?>" title="<?php $picture->code . '-' . $picture->name; ?>" rel="prettyPhoto[pp_gal]" >
                                        <img id="img_<?php echo $picture->code; ?>" src="<?php echo base_url(UPLOAD_IMAGE_URL) . str_replace(array('.jpg', '.JPG', '.png', '.PNG', '.gif', '.GIF'), array(BO_PROD_DETAIL_IMG_SUFFIX . '.jpg', BO_PROD_DETAIL_IMG_SUFFIX . '.JPG', BO_PROD_DETAIL_IMG_SUFFIX . '.png', BO_PROD_DETAIL_IMG_SUFFIX . '.PNG', BO_PROD_DETAIL_IMG_SUFFIX . '.gif', BO_PROD_DETAIL_IMG_SUFFIX . '.GIF'), $picture->image_path); ?>" alt="<?php echo $picture->description; ?>" />
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
                                                <input type="hidden" id="<?php echo 'link_' . $picture->code; ?>" value="<?php echo $image_file; ?>" />
                                                <a id="<?php echo 'copy_' . $picture->code; ?>" rel="copy-link" class="btn ui-state-default ui-corner-all" href="#">
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
        <?php }
        else { ?>
                                        <a class="btn_no_text btn ui-state-<?php
            if (!$product->id_def_image) {
                echo 'alert';
            }
            else {
                echo 'default';
            }
            ?> ui-corner-all tooltip" title="<?php echo lang('txt_set_representative_picture'); ?>" href="<?php echo base_url('product/setDefaultImage/' . $picture->id . '/' . $product->id); ?>">
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
<?php }
else { ?>
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
