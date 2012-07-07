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
    <?php if (!empty($shopping)): ?>
        <?php
        $total = count($shopping);
        for ($i = 0; $i < $total; $i++):
            ?>
            <tr>
                <td><img src="<?php echo $shopping[$i]->get_image_product(); ?>" width="80" height="50" alt="" /></td>
                <td><?php echo $shopping[$i]->get_id_product(); ?></td>
                <td><?php echo $shopping[$i]->get_code_product(); ?></td>
                <td><b style="color:#F00"><?php echo $shopping[$i]->get_price_product(); ?></b></td>
                <td><b style="color:#F00"><?php echo $shopping[$i]->get_number(); ?></b></td>
            </tr>
        <?php endfor; ?>
    <?php endif; ?>
</table>

<div id="order_box">
    <?php if (!empty($shopping)): ?>
    <div class="button"><a href="products/interior">Tiếp tục mua</a></div>
    <div class="button"><a href="<?php echo base_url() . '/products/contact';  ?>">Đặt hàng</a></div>
    <?php endif; ?>
</div>