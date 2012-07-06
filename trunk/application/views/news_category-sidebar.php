<script type="text/javascript">
    function search() {
        var name = document.getElementById("name");
        var keyword = document.getElementById("keyword");
        var searchform = document.getElementById("searchform");
        searchform.action = "?name="+name.value+"&keyword="+keyword.value;
        searchform.submit();
    }
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
    <div class="portlet-header ui-widget-header"><?php echo lang('txt_searchbox'); ?></div>
    <div class="portlet-content">
        <form id="searchform" name="searchform" action="" method="post">
            <ul>
                <li>
                    <label for="title"><?php echo lang('txt_name'); ?></label>
                    <div>
                        <input type="text" id="name" name="name" value="<?php echo $filter['name']; ?>" />
                    </div>
                </li>
                <li>
                    <label for="keyword"><?php echo lang('txt_keyword'); ?></label>
                    <div>
                        <input type="text" id="content" name="keyword" value="<?php echo $filter['keyword']; ?>" />
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
                <a href="<?php echo base_url('news_category/add'); ?>"><?php echo lang('txt_add_news_category'); ?></a>
            </li>
        </ul>
    </div>
</div>
