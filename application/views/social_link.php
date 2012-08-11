<link rel="stylesheet" href="<?php echo base_url('js/prettyPhoto/css/prettyPhoto.css'); ?>" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<script src="<?php echo base_url('js/prettyPhoto/js/jquery.prettyPhoto.js'); ?>" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    function deleteProdCategory(id) {
        
        if (confirm("<?php echo lang('txt_delete_confirm'); ?>")) {
            window.location = "<?php echo base_url('social_link/delete'); ?>/" + id;
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
                <th width="120px"><?php echo lang('txt_name'); ?></th> 
                <th width="100px"><?php echo lang('txt_picture'); ?></th> 
                <th width="200px"><?php echo lang('txt_url'); ?></th> 
                <th width="120px"><?php echo lang('txt_link_social'); ?></th> 
                <th width="120px"><?php echo lang('txt_options'); ?></th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php foreach($arr_social_link as $id => $social_link) { ?>
            <tr>
                <td><?php echo $social_link['name']; ?></td>
                <td style="vertical-align: middle; text-align: center;">
                    <?php echo $social_link['picture'] ? 
                    '<a href="'.direct_url(base_url(UPLOAD_IMAGE_URL.$image_group_code.'/'.$social_link['picture'])).'" title="'.$social_link['name'].'" rel="prettyPhoto">
                        <img src="'.direct_url(base_url(UPLOAD_IMAGE_URL.$image_group_code.'/'.str_replace(array('.jpg','.png','.gif','.JPG','.PNG','.GIF'), array(BO_SOCIAL_LINK_IMG_SUFFIX.'.jpg',BO_SOCIAL_LINK_IMG_SUFFIX.'.png',BO_SOCIAL_LINK_IMG_SUFFIX.'.gif',BO_SOCIAL_LINK_IMG_SUFFIX.'.JPG',BO_SOCIAL_LINK_IMG_SUFFIX.'.PNG',BO_PROD_CATEGORY_IMG_SUFFIX.'.GIF'), $social_link['picture']))).'" alt="'.$social_link['name'].'" />
                    </a>' : lang('txt_no_picture'); ?>
                </td>
                <td><?php echo $social_link['url']; ?></td>
                <td><?php echo ($social_link['is_social'] == IS_SOCIAL ? lang('txt_is_social'):lang('txt_is_not_social') );  ?></td>
                <td>
                    <a class="btn_no_text btn ui-state-<?php if (!$social_link['picture']) { echo 'alert'; } else { echo 'default'; } ?> ui-corner-all tooltip" title="<?php echo lang('txt_edit'); ?>" href="<?php echo base_url('social_link/edit/'.$id); ?>">
                            <span class="ui-icon ui-icon-wrench"></span>
                    </a>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_delete'); ?>" href="#" onclick="deleteProdCategory(<?php echo $id; ?>)">
                            <span class="ui-icon ui-icon-trash"></span>
                    </a>
                </td>
            </tr> 
        <?php } ?>
        </tbody>
    </table>
    
</div>