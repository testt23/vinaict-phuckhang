<?php if (!empty($shopping)): ?>
<script language="javascript" src="<?php echo base_url() . 'js/ajax.js'; ?>"></script>
<h4 style="height: 30px; width: 1000px; "><?PHP echo lang('site_product_title_order'); ?></h4>

<table width="1000" id="list" style="border:  solid 1px gray;" cellspacing="0" cellpadding="0">
    <tr>
        <td class="title" width="5%">&nbsp;</td>
        <td class="title" width="20%"><?PHP echo lang('site_product_name'); ?></td>
        <td class="title" width="10%"><?PHP echo lang('site_product_code'); ?></td>
        <td class="title" width="15%"><?PHP echo lang('site_product_price'); ?></td>
        <td class="title" width="6%"><?PHP echo lang('site_product_number'); ?></td>
        <td class="title" width="5%"><?PHP echo lang('site_product_delete'); ?></td>
    </tr>
    
        <?php
        $total = count($shopping);
        for ($i = 0; $i < $total; $i++):
            ?>
            <tr id="tr_<?php echo $shopping[$i]->get_id_product(); ?>">
                <td><img src="<?php echo $shopping[$i]->get_image_product(); ?>" width="80" height="50" alt="" /></td>
                <td><?php echo $shopping[$i]->get_name_product(); ?></td>
                <td><?php echo $shopping[$i]->get_code_product(); ?></td>
                <td><b style="color:#F00"><?php echo $shopping[$i]->get_price_product(); ?></b></td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="id_prods<?php echo $shopping[$i]->get_id_product(); ?>" value="<?php echo $shopping[$i]->get_id_product(); ?>" onchange="update_giohang()"/>
                        <input class="updae_input" type="text" name="num_prod<?php echo $shopping[$i]->get_id_product(); ?>" value="<?php echo $shopping[$i]->get_number(); ?>" onchange="update_giohang('id_prods<?php echo $shopping[$i]->get_id_product(); ?>', this, '<?php echo base_url() . 'products/update_shop' ?>');"/>
                    </form>
                </td>
                <td class="del"><a onclick="return delete_shop('tr_<?php echo $shopping[$i]->get_id_product(); ?>',<?php echo $shopping[$i]->get_id_product(); ?>,'<?php echo base_url() . 'products/delete_shop'; ?>'  )" href="#" class="del-gio">Xóa</a></td>
            </tr>
        <?php endfor; ?>
    
</table>

<div id="order_box">
    <div class="button"><a href="<?php echo base_url() . 'index' ?>">Tiếp tục mua</a></div>
    <div class="button"><a href="<?php echo base_url() . 'products/contact';  ?>">Đặt hàng</a></div>
</div>
<?php else: ?>
<h1 style="text-align: center; color: gray; font-size: 20px;">Bạn chưa có sản phẩm nào</h1>


<?php endif; ?>

