<script type="text/javascript">
    function search() {
        var name = document.getElementById("name");
        var id_usr_group = document.getElementById("id_param_group");
        var searchform = document.getElementById("searchform");
        searchform.action = "?name="+name.value+"&id_param_group="+id_usr_group.value;
        searchform.submit();
    }
</script>

<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
        <div class="portlet-header ui-widget-header"><?php echo lang('txt_searchbox'); ?></div>
        <div class="portlet-content">
            <form id="searchform" name="searchform" action="" method="post">
                <ul>
                    <li>
                        <label for="id_param_group"><?php echo lang('txt_param_group'); ?></label>
                        <div>
                            <select id="id_param_group" name="id_param_group" >
                                <option>All</option>
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

