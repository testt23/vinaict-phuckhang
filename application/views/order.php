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
        
        <?php
        $status_icon = array(
            'ui-icon-cancel',
            'ui-icon-clock',
            'ui-icon-transferthick-e-w',
            'ui-icon-check',
            'ui-icon-arrowreturnthick-1-w'
        );
        
        for ($i = 0; $i < count($status_icon); $i++) {
            
            $next_icon = $i < count($status_icon) - 2 ? $i + 1 : $i;
            $prev_icon = $i > 1 ? $i - 1 : $i;
            
            echo "$('.$status_icon[$i]').mouseover(function() {";
            echo "$(this).attr('class', 'ui-icon $status_icon[$next_icon]');";
            echo "});";
            
            echo "$('.$status_icon[$i]').mouseout(function() {";
            echo "$(this).attr('class', 'ui-icon $status_icon[$i]');";            
            echo "});";
            
            
        }
        
        $status_undo    = count($status_icon) - 1 ;
        $status_clock   = 1;
        
        echo "$('.$status_icon[$status_undo]').mouseover(function() {";
        echo "$(this).attr('class', 'ui-icon $status_icon[$status_clock]');";
        echo "$(this).parents('a').attr('class', 'btn_no_text btn ui-state-active ui-corner-all tooltip');";
        echo "});";
        
        echo "$('.$status_icon[$status_undo]').mouseout(function() {";
        echo "$(this).parents('a').attr('class', 'btn_no_text btn ui-state-default ui-corner-all tooltip');";
        echo "});";    
        ?>
               
        
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
                <th width="200px"><?php echo lang('txt_order_description'); ?></th> 
                <th width="100px"><?php echo lang('txt_order_date'); ?></th>
                <th width="100px"><?php echo lang('txt_order_shipping_date'); ?></th> 
                <th><?php echo lang('txt_order_amount'); ?></th> 
                <th width="100px"><?php echo lang('txt_order_status'); ?></th> 
                <th style="width:132px"><?php echo lang('txt_options'); ?></th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php while ($order->fetchNext()) { ?>

                <tr>
                    <td><?php echo $order->code; ?></td>
                    <td>
                        <?php
                            $order_name = $order->is_business == 1 ? clean_html(getI18n($order->company)) : $order_name = clean_html(getI18n($order->lastname . '' . $order->firstname));
                            echo $order_name;
                        ?>
                    </td>
                    <td><?php echo $order->description; ?></td>
                    <td style="text-align: center;"><?php  echo date_sql_to_local_date($order->order_date, $local_timezone, true, false); ?></td>
                    <td style="text-align: center;"><?php  echo date_sql_to_local_date($order->shipping_date, $local_timezone, true, false); ?></td>
                    <td style="text-align: right;"><?php echo $order->amount ? $order->amount : lang('txt_call'); ?></td>
                    <td style="text-align: center;">
                        <?php
                            $status = $order->status;
                            echo clean_html(getI18n($list_status[$status]));
                        ?>
                    </td>
                    <td>
                        <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_order_detail'); ?>" href="<?php echo base_url('order/detail/' . $order->id_order . '/' . $status); ?>">
                            <span class="ui-icon ui-icon-folder-open"></span>
                        </a>
                        <?php
                            $status_next = $status + 1;
                            $status_prev = $status - 1;
                            if ($status == ORD_STT_COMPLETED) {
                        ?>
                        <a class="btn_no_text btn ui-state-default  ui-corner-all tooltip" title="<?php echo lang('txt_status_completed'); ?>">
                            <span class="ui-icon ui-icon-check"></span>
                        </a>
                        <?php
                            }
                            else if ($status == ORD_STT_UNACCEPTED)
                            {
                        ?>
                        <a class="btn_no_text btn ui-state-active ui-corner-all tooltip" title="<?php echo lang('txt_next_to').': '.lang('txt_status_pending'); ?>" href="<?php echo base_url('order/status/' . $status_next . '/' . $order->id_order); ?>">
                            <span class="ui-icon ui-icon-cancel"></span>
                        </a>
                        <?php
                            }
                            else if( $status == ORD_STT_PENDING ) 
                            {
                        ?>
                        <a class="btn_no_text btn ui-state-active ui-corner-all tooltip" title="<?php echo lang('txt_next_to').': '.lang('txt_status_shipping'); ?>" href="<?php echo base_url('order/status/' . $status_next . '/' . $order->id_order); ?>">
                            <span class="ui-icon ui-icon-clock"></span>
                        </a>
                        <?php
                            }
                            else
                            {
                        ?>
                        <a class="btn_no_text btn ui-state-active ui-corner-all tooltip" title="<?php echo lang('txt_next_to').': '.lang('txt_status_completed'); ?>" href="<?php echo base_url('order/status/' . $status_next . '/' . $order->id_order); ?>">
                            <span class="ui-icon ui-icon-transferthick-e-w"></span>
                        </a>
                        <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_back_to').': '.lang('txt_status_pending');; ?>" href="<?php echo base_url('order/status/' . $status_prev . '/' . $order->id_order); ?>">
                            <span class="ui-icon ui-icon-arrowreturnthick-1-w"></span>
                        </a>
                        <?php
                            }
                        ?>
                        <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_delete'); ?>" href="#" onclick="deleteOrder(<?php echo $order->id_order; ?>)">
                            <span class="ui-icon ui-icon-trash"></span>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>