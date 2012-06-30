<link rel="stylesheet" href="<?php echo base_url('js/prettyPhoto/css/prettyPhoto.css'); ?>" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<script src="<?php echo base_url('js/prettyPhoto/js/jquery.prettyPhoto.js'); ?>" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    function deleteOrder(id) {
        
        if (confirm("<?php echo lang('txt_delete_confirm'); ?>")) {
            window.location = "<?php echo base_url('order/delete'); ?>/" + id;
        }
       
    }
    
    $(document).ready(function(){
    
        $("a[rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'fast',
            social_tools: false
        });
        
        var status_icon = new Array(
            'ui-icon-cancel',
            'ui-icon-clock',
            'ui-icon-transferthick-e-w',
            'ui-icon-check',
            'ui-icon-arrowreturnthick-1-w'
        );
        
        for (var i = 0; i < status_icon.length - 1; i++) {
            
            var next_icon = i < status_icon.length - 2 ? i + 1 : i;
            var prev_icon = i > 1 ? i - 1 : i;
            
            $(status_icon[i]).mouseover(function() {
                alert($(this).html());
                $(this).attr('class', 'ui-icon '+status_icon[next_icon]);
            });
        }
        
        $('.' + status_icon[status]).mouseover(function() {
                    
            $(this).attr('class', 'ui-icon '+status_icon[next_icon]);
                
        });
           
            
        /*
        
        $('.ui-icon-transferthick-e-w').hover( 
            function(){
                $(this).addClass('ui-icon-check');
                $(this).parent('a.ui-state-default').addClass('ui-state-active');
            },function(){
                $(this).removeClass('ui-icon-check');
                $(this).parent('a.ui-state-default').removeClass('ui-state-active');
        });
        
        $('.ui-icon-arrowreturnthick-1-w').hover( 
            function(){
                $(this).addClass('ui-icon-clock');
                $(this).parent('a.ui-state-default').addClass('ui-state-active');
            },function(){
                $(this).removeClass('ui-icon-clock');
                $(this).parent('a.ui-state-default').removeClass('ui-state-active');
        });
        
        $('.ui-icon-cancel').hover( 
            function(){
                $(this).addClass('ui-icon-clock');
                $(this).parent('a.ui-state-default').addClass('ui-state-active');
            },function(){
                $(this).removeClass('ui-icon-clock');
                $(this).parent('a.ui-state-default').removeClass('ui-state-active');
        });
        
        $('.ui-icon-clock').mouseover( 
            function(){
                $(this).attr('class', '.ui-icon ui-icon-transferthick-e-w')
            }
        );
        
        $('.ui-icon-clock').mouseout(
            function(){
                $(this).removeClass('ui-icon-transferthick-e-w');
            }
        );
        
        $('.ui-state-default').hover( 
            function(){
                $(this).addClass('ui-state-active');
            },function(){
                $(this).removeClass('ui-state-active');
        });
         */
        
    });
</script>

<?php
while ($order_status->fetchNext()) {
    $list_status[$order_status->id] = $order_status->name;
}
?>

<div class="hastable">				
    <table> 
        <thead> 
            <tr>
                <th width="100px"><?php echo lang('txt_prod_code'); ?></th> 
                <th><?php echo lang('txt_customer'); ?></th> 
                <th width="100px"><?php echo lang('txt_order_description'); ?></th> 
                <th><?php echo lang('txt_order_date'); ?></th> 
                <th><?php echo lang('txt_order_amount'); ?></th> 
                <th width="100px"><?php echo lang('txt_status'); ?></th> 
                <th><?php echo lang('txt_order_shipping_date'); ?></th> 
                <th style="width:132px"><?php echo lang('txt_options'); ?></th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php while ($order->fetchNext()) { ?>

                <tr>
                    <td><?php echo $order->code; ?></td>
                    <td><?php $order_name = $order->is_business == 1 ? clean_html(getI18n($order->company)) : $order_name = clean_html(getI18n($order->lastname . '' . $order->firstname));
            echo $order_name; ?></td>                
                    <td><?php echo $order->description; ?></td>
                    <td><?php if ($order->order_date == NULL)
                echo "Null"; else
                echo date('d-m-Y', strtotime($order->order_date)); ?></td>
                    <td><?php echo $order->amount ? $order->amount : lang('txt_call'); ?></td>
                    <td><?php $status = $order->status;
            echo clean_html(getI18n($list_status[$status])); ?></td>
                    <td><?php if ($order->shipping_date == Null)
                echo "Null"; else
                echo date('d-m-Y', strtotime($order->shipping_date)); ?></td>
                    <td>

                        <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_order_detail'); ?>" href="<?php echo base_url('order/detail/' . $order->id_order . '/' . $status); ?>">
                            <span class="ui-icon ui-icon-folder-open"></span>
                        </a>
    <?php $status_next = $status + 1;
    $status_prev = $status - 1;
    if ($status == 4) { ?>
                            <a class="btn_no_text btn ui-state-default  ui-corner-all tooltip" title="<?php echo lang('txt_order_done'); ?>">
                                <span class="ui-icon ui-icon-check"></span>
                            </a>
    <?php } else if ($status == 1 || $status == 2) { ?>
                            <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo clean_html(getI18n($list_status[$status_next])); ?>" href="<?php echo base_url('order/setStatus/' . $status_next . '/' . $order->id_order); ?>">
                                <span class="ui-icon <?php if ($status == 1) {
            echo "ui-icon-cancel";
        } else {
            echo "ui-icon-clock";
        } ?>"></span>
                            </a>
                <?php } else { ?>
                            <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo clean_html(getI18n($list_status[$status_next])); ?>" href="<?php echo base_url('order/setStatus/' . $status_next . '/' . $order->id_order); ?>">
                                <span class="ui-icon ui-icon-transferthick-e-w"></span>
                            </a>
                            <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo clean_html(getI18n($list_status[$status_prev])); ?>" href="<?php echo base_url('order/setStatus/' . $status_prev . '/' . $order->id_order); ?>">
                                <span class="ui-icon ui-icon-arrowreturnthick-1-w"></span>
                            </a>
    <?php } ?>
                        <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_delete'); ?>" href="#" onclick="deleteOrder(<?php echo $order->id_order; ?>)">
                            <span class="ui-icon ui-icon-trash"></span>
                        </a>
                    </td>
                </tr> 
<?php } ?>
        </tbody>
    </table>

</div>