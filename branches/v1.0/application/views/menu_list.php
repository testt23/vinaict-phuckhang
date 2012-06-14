<script type="text/javascript">
    function deleteMenu(id) {
        
        if (confirm("<?php echo lang('txt_delete_confirm'); ?>")) {
            window.location = "<?php echo base_url('menu/delete'); ?>/" + id;
        }
       
    }
</script>

<div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
        <li class="ui-corner-top <?php if ($filter['menu_type'] == FO) { ?>ui-tabs-selected ui-state-active<?php } else { ?>ui-state-default<?php } ?>">
            <a href="#tab-<?php echo FO; ?>" onclick="switchMenuType(<?php echo FO; ?>)"><?php echo lang('txt_front_office'); ?></a>
        </li>
        <li class="ui-corner-top <?php if ($filter['menu_type'] == BO) { ?>ui-tabs-selected ui-state-active<?php } else { ?>ui-state-default<?php } ?>">
            <a href="#tab-<?php echo BO; ?>" onclick="switchMenuType(<?php echo BO; ?>)"><?php echo lang('txt_back_office'); ?></a>
        </li>
    </ul>
        
    <div id="tab-<?php echo FO; ?>" class="ui-tabs-panel ui-widget-content ui-corner-bottom">
        <?php if ($filter['menu_type'] == FO) { ?>
        <div class="hastable">				
            <table> 
                <thead> 
                    <tr>
                        <th><?php echo lang('txt_name'); ?></th> 
                        <th><?php echo lang('txt_uri'); ?></th> 
                        <th><?php echo lang('txt_section'); ?></th> 
                        <th style="width:50px;"><?php echo lang('txt_position'); ?></th> 
                        <th><?php echo lang('txt_menu_upper_level'); ?></th> 
                        <th style="width:132px"><?php echo lang('txt_options'); ?></th> 
                    </tr> 
                </thead> 
                <tbody> 
                    <?php while($menu_item->fetchNext()) { ?>
                    <tr>
                        <td><?php echo getI18n($menu_item->name); ?></td>
                        <td><?php echo $menu_item->link; ?></td>
                        <td><?php echo $menu_item->section; ?></td>
                        <td class="center"><?php echo $menu_item->position; ?></td>
                        <td><?php echo getI18n($menu_item->parent_name); ?></td>
                        <td>
                            <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_edit'); ?>" href="<?php echo base_url('menu/edit/'.$menu_item->id); ?>">
                                    <span class="ui-icon ui-icon-wrench"></span>
                            </a>
                            <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_delete'); ?>" href="#" onclick="deleteMenu(<?php echo $menu_item->id; ?>)">
                                    <span class="ui-icon ui-icon-circle-close"></span>
                            </a>
                        </td>
                    </tr> 
                <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </div>
    <div id="tab-<?php echo BO; ?>" class="ui-tabs-panel ui-widget-content ui-corner-bottom">
        <?php if ($filter['menu_type'] == BO) { ?>
        <div class="hastable">				
            <table> 
                <thead> 
                    <tr>
                        <th><?php echo lang('txt_name'); ?></th> 
                        <th><?php echo lang('txt_uri'); ?></th> 
                        <th><?php echo lang('txt_section'); ?></th> 
                        <th style="width:50px;"><?php echo lang('txt_position'); ?></th> 
                        <th><?php echo lang('txt_menu_upper_level'); ?></th> 
                        <th style="width:132px"><?php echo lang('txt_options'); ?></th> 
                    </tr> 
                </thead> 
                <tbody> 
                    <?php while($menu_item->fetchNext()) { ?>
                    <tr>
                        <td><?php echo getI18n($menu_item->name); ?></td>
                        <td><?php echo $menu_item->link; ?></td>
                        <td><?php echo $menu_item->section; ?></td>
                        <td class="center"><?php echo $menu_item->position; ?></td>
                        <td><?php echo getI18n($menu_item->parent_name); ?></td>
                        <td>
                            <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_edit'); ?>" href="<?php echo base_url('menu/edit/'.$menu_item->id); ?>">
                                    <span class="ui-icon ui-icon-wrench"></span>
                            </a>
                            <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_delete'); ?>" href="#" onclick="deleteMenu(<?php echo $menu_item->id; ?>)">
                                    <span class="ui-icon ui-icon-circle-close"></span>
                            </a>
                        </td>
                    </tr> 
                <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </div>
</div>
