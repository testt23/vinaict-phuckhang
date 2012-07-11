<script type="text/javascript">
    function search() {
        var name = document.getElementById("name");
        var id_parent = document.getElementById("id_parent");
        var keywords = document.getElementById("keywords");
        var searchform = document.getElementById("searchform");
        searchform.action = "?name="+name.value+"&keywords="+keywords.value+"&id_parent="+id_parent.value;
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
                        <input type="text" id="keywords" name="keywords" value="<?php echo $filter['keywords']; ?>" />
                    </div>
                </li>
                <li>
                    <label for="parent"><?php echo lang('txt_keyword'); ?></label>
                    <div>
                        <select name ="id_parent" id ="id_parent">
                            <option value=""><?php echo lang('txt_all'); ?></option>   
                            <?php $news_category->fetchFirst();?>
                                <option value="<?php echo $news_category->id; ?>" <?php if($news_category->id == $filter['id_parent']) echo 'selected'; ?> ><?php echo clean_html(getI18n($news_category->name)); ?></option>
                            <?php?>
                            <?php while($news_category->fetchNext()){ ?>
                                <option value="<?php echo $news_category->id; ?>" <?php if($news_category->id == $filter['id_parent']) echo 'selected'; ?>><?php echo clean_html(getI18n($news_category->name)); ?></option>
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
                <a href="<?php echo base_url('news_category/add'); ?>"><?php echo lang('txt_add_news_category'); ?></a>
            </li>
        </ul>
    </div>
</div>
