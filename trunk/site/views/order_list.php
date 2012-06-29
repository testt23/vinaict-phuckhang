<script language="javascript">
    $(document).ready(function(){
        jQuery('#list tr td a').click(function(){
            if (confirm('Bạn có muốn xóa sản phẩm này ?')){
                return true;
            }
            return false;
        });
    });
</script>
<pre>

<?php print_r($shopping); ?>
</pre>
<h4> Bạn đã chọn mua</h4>
<table width="1000" id="list">
    <tr>
        <td>&nbsp;</td>
        <td>Tên sản phẩm</td>
        <td>Mã sản phẩm</td>
        <td>Giá sản phẩm</td>
        <td>Số lượng</td>
        <td>Xóa</td>
    </tr>
    <?php

    if (isset($shopping) && !empty($shopping)):
        $totalList = count($shopping);
        for ($i = 0; $i < $totalList; $i++):
            ?>
    
            <tr>
                <td><img src="<?php echo $shopping[$i]->get_image(); ?>" width="80" height="50" alt="" /></td>
                <td><?php echo $shopping[$i]->get_name_product(); ?></td>
                <td><?php echo $shopping[$i]->get_id_product(); ?></td>
                <td><b style="color:#F00"><?php echo $shopping[$i]->get_price_product(); ?> <?php if ($shopping[$i]->get_price_product() * 1 > 0){ echo $shopping[$i]->get_currency();} ?></b></td>
                <td><b style="color:#F00"><?php echo $shopping[$i]->get_number(); ?></b></td>
                <td><a href="">Delete</a></td>
            </tr>

            <?php endfor; ?>
    <?php else: ?>
            <h2>Bạn chưa có sản phẩm nào. </h2>
    <?php endif; ?>

</table>
<div id="order_box">
    <div class="button"><a href="<?php // echo URL; ?>products/interior">Tiếp tục mua</a></div>
    <div class="button"><a href="<?php echo base_url(); ?>/order-contact">Đặt hàng</a></div>
</div>