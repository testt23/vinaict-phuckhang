<link rel="stylesheet" href="<?php echo base_url('js/prettyPhoto/css/prettyPhoto.css'); ?>" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<script src="<?php echo base_url('js/prettyPhoto/js/jquery.prettyPhoto.js'); ?>" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    function deleteOrderDetail(id, id_order, order_status) {
        
        if (confirm("<?php echo lang('txt_delete_confirm'); ?>")) {
            window.location = "<?php echo base_url('order/deleteOrderDetail'); ?>/" + id_order + "/" + order_status + "/" + id;
        }
       
    }
    
    $(document).ready(function(){
        $("a[rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'fast',
            social_tools: false
        });
    });
</script>

<div class="hastable">				
    <table> 
        <thead> 
            <tr>
                <th width="100px"><?php echo lang('txt_product_pic'); ?></th>
                <th width="100px"><?php echo lang('txt_prod_code'); ?></th> 
                <th><?php echo lang('txt_product_name'); ?></th> 
                <th width="100px"><?php echo lang('txt_description'); ?></th> 
                <th><?php echo lang('txt_price'); ?></th> 
                <th><?php echo lang('txt_number'); ?></th> 
                <th style="width:60px"><?php echo lang('txt_options'); ?></th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php while($order_detail->fetchNext()) { ?>
            
            <tr>
                <td><img style="width: 100px; height: 100px" src="<?php echo $order_detail->image_product; ?>" /></td>
                <td><?php echo $order_detail->code_product ?></td>
                <td><?php echo $order_detail->name_product; ?></td>
                <td><?php echo $order_detail->desciption_product; ?></td>
                <td><?php echo $order_detail->price_product ? $order_detail->price_product .' '. $order_detail->currency_product : lang('txt_call') ; ?></td>
                <td><?php echo $order_detail->number; ?></td>
                <td>
                    <?php if($order_status == 1){ ?>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_delete'); ?>" href="#" onclick="deleteOrderDetail(<?php echo $order_detail->id .','. $order_detail->id_purchase_order .','. $order_status; ?>)">
                            <span class="ui-icon ui-icon-trash"></span>
                    </a> 
                    <?php } ?>
                </td>
            </tr> 
        <?php } ?>
        </tbody>
    </table>
    
</div>