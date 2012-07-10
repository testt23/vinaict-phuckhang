
<div style="width: 400px; height: 100px; border: solid 1px gray; margin: 0px auto;">
    <h1 style="height: 30px; line-height: 30px; font-size: 1.0em; text-transform:uppercase; background: gray; padding-left: 20px; ">
        KÍCH HOẠT ĐƠN ĐẶT HÀNG
    </h1>
    <div style="text-align: center; padding: 20px ; color: blue;">
       <?php echo $mess; ?>
    </div>
</div>
<script language="javascript">
    setTimeout(redirect, 3000);
    function redirect(){
        window.location = "<?php echo base_url() . '/' . Variable::getDefaultPageString(); ?>";
    }
    
    </script>
