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
    <?php
    $List = $this->list;
    if ($List != ''):
        $totalList = count($List);
        for ($i = 0; $i < $totalList; $i++):
            ?>
    
            <tr>
                <td><img src="<?php echo $List[$i]->getImage(); ?>" width="80" height="50" alt="" /></td>
                <td><?php echo $List[$i]->getTensanpham(); ?></td>
                <td><?php echo $List[$i]->getMasanpham(); ?></td>
                <td><b style="color:#F00"><?php echo $List[$i]->getGiasanpham(); ?></b></td>
                <td><b style="color:#F00"><?php echo $List[$i]->getSoluong(); ?></b></td>
                <td><a href="<?php echo URL; ?>order/delete/<?php echo $List[$i]->getMasanpham() .''; ?>">Delete</a></td>
            </tr>
            
            <?php
        endfor;
    else:
        ?>
        <h2>Bạn chưa có sản phẩm nào. </h2>
    <?php endif; ?>

</table>
<div id="order_box">
    <div class="button"><a href="<?php echo URL; ?>products/interior">Tiếp tục mua</a></div>
    <div class="button"><a href="<?php echo URL; ?>contact">Đặt hàng</a></div>
</div>