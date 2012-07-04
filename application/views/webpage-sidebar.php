<script type="text/javascript">
    function search() {
        var name = document.getElementById("name");
        var id_usr_group = document.getElementById("id_usr_group");
        var searchform = document.getElementById("searchform");
        searchform.action = "?name="+name.value+"&id_usr_group="+id_usr_group.value;
        searchform.submit();
    }
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
                <div class="portlet-header ui-widget-header"><?php echo lang('txt_searchbox'); ?></div>
                <div class="portlet-content">
                    <form id="searchform" name="searchform" action="" method="post">
                        <ul>
                            <li>
                                <label for="title"><?php echo lang('txt_title'); ?></label>
                                <div>
                                    <input type="text" id="title" name="title" value="<?php echo $filter['title']; ?>" />
                                </div>
                            </li>
                            <li>
                                <label for="content"><?php echo lang('txt_content'); ?></label>
                                <div>
                                    <input type="text" id="content" name="content" value="<?php echo $filter['content']; ?>" />
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
                            <a href="<?php echo base_url('webpage/add'); ?>"><?php echo lang('txt_add_page'); ?></a>
                        </li>
                </ul>
        </div>
</div>
