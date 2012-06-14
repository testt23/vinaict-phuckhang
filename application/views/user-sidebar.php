<script type="text/javascript">
    function search() {
        var name = document.getElementById("name");
        var id_group = document.getElementById("id_group");
        var searchform = document.getElementById("searchform");
        searchform.action = "?name="+name.value+"&id_group="+id_group.value;
        searchform.submit();
    }
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
                <div class="portlet-header ui-widget-header"><?php echo lang('txt_searchbox'); ?></div>
                <div class="portlet-content">
                    <form id="searchform" name="searchform" action="" method="post">
                        <ul>
                            <li>
                                <label for="name"><?php echo lang('txt_fullname'); ?></label>
                                <div>
                                    <input type="text" id="name" name="name" value="<?php echo $filter['name']; ?>" />
                                </div>
                            </li>
                            <li>
                                <label for="id_group"><?php echo lang('txt_user_group'); ?></label>
                                <div>
                                    <select id="id_group" name="id_group">
                                        <option value=""><?php echo lang('txt_all'); ?></option>
                                        <?php while ($group->fetchNext()) { ?>
                                        <option <?php if ($group->id == $filter['id_group']) { echo "selected"; } ?> value="<?php echo $group->id; ?>"><?php echo getI18n($group->name); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <input type="button" onclick="search()" value="<?php echo lang('txt_search'); ?>" />
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
                            <a href="<?php echo base_url('user/add'); ?>"><?php echo lang('txt_add_user'); ?></a>
                        </li>
                </ul>
        </div>
</div>
