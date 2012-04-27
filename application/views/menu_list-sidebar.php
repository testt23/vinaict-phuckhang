<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
                <div class="portlet-header ui-widget-header"><?php echo lang('txt_searchbox'); ?></div>
                <div class="portlet-content">
                    <form action="" method="post">
                        <ul>
                            <li>
                                <label for="name"><?php echo lang('txt_menu_name'); ?></label>
                                <div>
                                    <input type="text" id="name" name="name" value="<?php echo $filter['name']; ?>" />
                                </div>
                            </li>
                            <li>
                                <label for="id_menu_parent"><?php echo lang('txt_menu_upper_level'); ?></label>
                                <div>
                                    <select id="id_menu_parent" name="id_menu_parent">
                                        <option value=""><?php echo lang('txt_all'); ?></option>
                                        <?php while ($menu_list->fetchNext()) { ?>
                                        <option <?php if ($menu_list->id == $filter['id_menu_parent']) { echo "selected"; } ?> value="<?php echo $menu_list->id; ?>"><?php echo getI18n($menu_list->name); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <input type="submit" value="<?php echo lang('txt_search'); ?>" />
                            </li>
                        </ul>
                    </form>
                </div>
        </div>

<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
        <div class="portlet-header ui-widget-header"><?php echo lang('txt_toolbox'); ?></div>
        <div class="portlet-content">
                <ul class="side-menu">
                        <li>
                            <span class="ui-icon ui-icon-triangle-1-e small-icon"></span>
                            <a href="<?php echo base_url('menu/add'); ?>"><?php echo lang('txt_add_menu'); ?></a>
                        </li>
                </ul>
        </div>
</div>
