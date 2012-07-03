<script type="text/javascript">
    function validate() {
        
        document.menuform.submit();
       
    }
</script>
<form action="" method="post" enctype="multipart/form-data" class="forms" name="menuform" >
    <div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container" >
        <div class="portlet-header ui-widget-header">
        <?php echo lang('txt_menu_detail'); ?>
        </div>
        <div class="portlet-content">

                    <ul>
                            <li>
                                    <label for="name" class="desc">
                                            <?php echo lang('txt_menu_name'); ?>
                                    </label>
                                    <div>
                                        <div id="name" name="name" class="field text small" type="text-multilang" lang="en,vi" def-lang="vi" value="<?php echo $menu->name; ?>"></div>
                                    </div>
                            </li>

                            <li>
                                    <label for="link" class="desc">
                                            <?php echo lang('txt_uri'); ?>
                                    </label>
                                    <div>
                                            <input type="text" tabindex="1" maxlength="255" class="field text small" id="link" name="link" value="<?php echo $menu->link; ?>" />
                                    </div>
                            </li>

                            <li>
                                    <label for="section" class="desc">
                                            <?php echo lang('txt_section'); ?>
                                    </label>
                                    <div>
                                            <input type="text" tabindex="1" maxlength="255" class="field text small" id="section" name="section" value="<?php echo $menu->section; ?>" />
                                    </div>
                            </li>

                            <li>
                                    <label for="id_menu_parent" class="desc">
                                            <?php echo lang('txt_menu_upper_level'); ?>
                                    </label>
                                    <div>
                                            <select tabindex="3" class="field select small" id="id_menu_parent" name="id_menu_parent" > 
                                                <option value=""><?php echo lang('txt_none'); ?></option>
                                                <?php while ($menu_list->fetchNext()) { ?>
                                                <option value="<?php echo $menu_list->id; ?>" <?php if ($menu_list->id == $menu->id_parent) { ?>selected<?php } ?> >
                                                            <?php echo getI18n($menu_list->name); ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                    </div>
                            </li>

                            <li>
                                    <label for="position" class="desc">
                                            <?php echo lang('txt_position'); ?>
                                    </label>
                                    <div>
                                            <input type="text" tabindex="1" maxlength="255" class="field text small" id="position" name="position" value="<?php echo $menu->position; ?>" />
                                    </div>
                            </li>

                    </ul>
                <input type="hidden" name="act" value="<?php echo ACT_SUBMIT; ?>" />
        </div>
    </div>
    <div style="margin-bottom:10px;" class="clearfix"></div>
    <div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container" >
        <div class="portlet-header ui-widget-header"><?php echo lang('txt_object_relation'); ?></div>
        <div class="portlet-content">AAA</div>
    </div>
    <div class="clearfix"></div>
</form>
