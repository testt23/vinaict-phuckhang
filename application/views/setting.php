<script type="text/javascript">
    $(document).ready(function(){
        $('.items-list li.param').mouseover(function(){
            $(this).attr('class', 'param hover');
        });
        $('.items-list li.param').mouseout(function(){
            $(this).attr('class', 'param');
        });
    });
    function editParam(id) {
        var agr = new Array();
        agr.push(id);
        var data = ajaxCallFunction('Parameter::renderInput',agr,'json');
        
        if(data) {
            $('#param_'+id+' .float-right .value').html(data);
            var button = '<a href="javascript:saveParam('+id+')"><span class="ui-icon ui-icon-check"></span></a>';
            $('#param_'+id+' .float-right .button').html(button);
            initDocument();
        }
    }
    function saveParam(id) {
    
        var agr = new Array();
        agr.push(id);
        
        if ($('#param_data_'+id).attr('type') == 'checkbox') {
            agr.push($('#param_data_'+id).attr('checked') ? '1' : '0');
        }            
        else {
            <?php
                echo 'var str_val = \'{\';'."\n";
                $lang = Language::getArrayLangIso();
                foreach ($lang as $l) {
                    echo 'if ($("#param_data_"+id+"_'.$l.'").val()) {'."\n";
                    echo 'str_val += "\"'.$l.'\" : \""+$("#param_data_"+id+"_'.$l.'").val()+"\", ";'."\n";
                    echo '}'."\n";
                }
                echo 'str_val = str_val.substring(0, str_val.length - 2);'."\n";
                echo 'str_val += \'}\';'."\n";
            ?>
            
            if (str_val == '}')
                agr.push($('#param_data_'+id).val());
            else
                agr.push(str_val);
        }
            
        
        var data = ajaxCallFunction('Parameter::saveValue',agr,'json');
        
        if(data) {
            var object = eval('('+data+')');
            
            if (object.data_type == <?php echo BOOLEAN; ?>) {
                object.value = '<span class="ui-icon ui-icon-'+(object.value == '1' ? 'check' : 'closethick')+'"></span>';
            }
            
            $('#param_'+id+' .float-right .value').html(object.value);
            var button = '<a href="javascript:editParam('+id+')"><span class="ui-icon ui-icon-wrench"></span></a>';
            $('#param_'+id+' .float-right .button').html(button);
        }
    }
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container" >
    <div class="portlet-header ui-widget-header">
    <?php echo lang('txt_system_configuration'); ?>
    </div>
    <div class="portlet-content">
        <form action="" method="post" enctype="multipart/form-data" class="forms" name="prodform" >
                <ul class="items-list">
                    <?php $param_group_name = '';  ?>
                    <?php while ($parameter->fetchNext()) { ?>
                        <?php $parameter->param_group_name = $parameter->param_group_name ? getI18n($parameter->param_group_name) : lang('txt_ungrouped') ?>
                        <?php if ($parameter->param_group_name != $param_group_name) { ?>
                        <li class="param_group"><?php echo $parameter->param_group_name; ?></li>
                        <?php } ?>
                        <li id="param_<?php echo $parameter->id; ?>" class="param">
                            <div class="float-left">
                                <span class="value"><?php echo getI18n($parameter->name); ?></span>
                            </div>
                            <div class="float-right">
                                <span class="value"><?php if ($parameter->data_type == BOOLEAN) { echo '<span class="ui-icon ui-icon-'.($parameter->value == '1' ? 'check' : 'closethick').'"></span>'; } else { echo getI18n($parameter->value); } ?></span>
                                <span class="button">
                                    <a href="javascript:editParam(<?php echo $parameter->id; ?>)">
                                        <span class="ui-icon ui-icon-wrench"></span>
                                    </a>
                                </span>
                            </div>
                        </li>
                        <?php $param_group_name = $parameter->param_group_name; ?>
                     <?php } ?>
                </ul>
            <input type="hidden" name="act" value="<?php echo ACT_SUBMIT; ?>" />
        </form>
    </div>
</div>
<div class="clearfix"></div>