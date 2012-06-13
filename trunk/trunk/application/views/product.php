<link rel="stylesheet" href="<?php echo base_url('js/prettyPhoto/css/prettyPhoto.css'); ?>" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<script src="<?php echo base_url('js/prettyPhoto/js/jquery.prettyPhoto.js'); ?>" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    function deleteProduct(id) {
        
        if (confirm("<?php echo lang('txt_delete_confirm'); ?>")) {
            window.location = "<?php echo base_url('product/delete'); ?>/" + id;
        }
       
    }
    
    $(document).ready(function(){
        $("a[rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'fast',
            social_tools: false
        });
    });
</script>

<div class="hastable">				
    <table> 
        <thead> 
            <tr>
                <th width="100px"><?php echo lang('txt_prod_code'); ?></th> 
                <th><?php echo lang('txt_prod_name'); ?></th> 
                <th width="100px"><?php echo lang('txt_product_pic'); ?></th> 
                <th><?php echo lang('txt_price'); ?></th> 
                <th width="100px"><?php echo lang('txt_product_link'); ?></th> 
                <th><?php echo lang('txt_keyword'); ?></th> 
                <th width="100px"><?php echo lang('txt_status'); ?></th> 
                <th style="width:132px"><?php echo lang('txt_options'); ?></th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php while($product->fetchNext()) { ?>
            
            <tr <?php if ($product->is_disabled == IS_DISABLED) { ?>class="row-disabled"<?php } ?> >
                <td><?php echo $product->code; ?></td>
                <td><?php $product_name = clean_html(getI18n($product->name)); echo $product_name; ?></td>
                <td><?php if ($product->picture) { ?><a href="<?php echo UPLOAD_IMAGE_URL.$image_group_code.'/'.$product->picture; ?>" title="<?php echo clean_html(getI18n($product->short_description)); ?>" rel="prettyPhoto" ><img src="<?php echo UPLOAD_IMAGE_URL.$image_group_code.'/'.str_replace(array('.jpg','.png','.gif','.JPG','.PNG','.GIF'), array(BO_PROD_IMG_SUFFIX.'.jpg',BO_PROD_IMG_SUFFIX.'.png',BO_PROD_IMG_SUFFIX.'.gif',BO_PROD_IMG_SUFFIX.'.JPG',BO_PROD_IMG_SUFFIX.'.PNG',BO_PROD_IMG_SUFFIX.'.GIF'), $product->picture); ?>" alt="<?php echo $product_name; ?>" /></a><?php } else { echo lang('txt_no_picture'); } ?></td>
                <td><?php echo $product->price ? $product->price.' '.$product->currency : lang('txt_call') ; ?></td>
                <td><?php echo clean_html(getI18n($product->link)); ?></td>
                <td><?php echo $product->keywords; ?></td>
                <td><?php echo $product->is_disabled == IS_DISABLED ? lang('txt_hidden') : lang('txt_publishing'); ?></td>
                <td>
                    <a class="btn_no_text btn ui-state-<?php if (!$product->id_prod_image || !$product->id_def_image) { echo 'alert'; } else { echo 'default'; } ?> ui-corner-all tooltip" title="<?php if (!$product->id_prod_image) { echo lang('msg_click_to_upload_picture'); } elseif (!$product->id_def_image) { echo lang('msg_click_to_set_presentative_picture'); } else { echo lang('txt_detail'); } ?>" href="<?php echo base_url('product/detail/'.$product->id); ?>">
                        <span class="ui-icon ui-icon-folder-open"></span>
                    </a>
                    <?php if ($product->is_disabled == IS_DISABLED) { ?>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_toggle_publishing'); ?>" href="<?php echo base_url('product/toggleStatus/'.$product->id); ?>">
                            <span class="ui-icon ui-icon-check"></span>
                    </a>
                    <?php } else { ?>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_toggle_hidden'); ?>" href="<?php echo base_url('product/toggleStatus/'.$product->id); ?>">
                            <span class="ui-icon ui-icon-closethick"></span>
                    </a>
                    <?php } ?>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_edit'); ?>" href="<?php echo base_url('product/edit/'.$product->id); ?>">
                            <span class="ui-icon ui-icon-wrench"></span>
                    </a>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_delete'); ?>" href="#" onclick="deleteProduct(<?php echo $product->id; ?>)">
                            <span class="ui-icon ui-icon-trash"></span>
                    </a>
                </td>
            </tr> 
        <?php } ?>
        </tbody>
    </table>
    
</div>