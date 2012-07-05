<script type="text/javascript">
    function search() {
        var id_news_category = document.getElementById("id_news_category");
        var searchform = document.getElementById("searchform");
        searchform.action = "?id_news_category="+id_news_category.value;
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
                                <label for="content"><?php echo lang('txt_keyword'); ?></label>
                                <div>
                                    <input type="text" id="keywords" name="keywords" value="<?php echo $filter['keywords']; ?>" />
                                </div>
                            </li>
                            <li>
                                <label for="id_news_category"><?php echo lang('txt_category'); ?></label>
                                <div>
                                    <select id="id_news_category" name="id_news_category">
                                        <option value=""><?php echo lang('txt_all'); ?></option>
                                        <?php while ($newscategory->fetchNext()) { ?>
                                        <option <?php if ($newscategory->id == $filter['id_news_category']) { echo "selected"; } ?> value="<?php echo $newscategory->id; ?>"><?php echo getI18n($newscategory->name); ?></option>
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
                            <a href="<?php echo base_url('article/add'); ?>"><?php echo lang('txt_add_article'); ?></a>
                        </li>
                </ul>
        </div>
</div>
