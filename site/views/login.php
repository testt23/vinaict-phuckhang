<style type="text/css" rel="stylesheet">
    *{list-style:none;}
    
</style>

<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>/js/jquery.js"></script>        
<script language="javascript">
    $(document).ready(function(){
        jQuery('#dangnhap' ).click(function(){
            var winW = 630, winH = 460;
            if (document.body && document.body.offsetWidth) {
                winW = document.body.offsetWidth;
                winH = document.body.offsetHeight;
            }
            if (document.compatMode=='CSS1Compat' &&
                document.documentElement &&
                document.documentElement.offsetWidth ) {
                winW = document.documentElement.offsetWidth;
                winH = document.documentElement.offsetHeight;
            }
            if (window.innerWidth && window.innerHeight) {
                winW = window.innerWidth;
                winH = window.innerHeight;
            }
            
            var left = (winW - 500)/2;
            var top = (winH - 500)/2;
            var new_window = window.open($(this).attr('href'), 'Login Openid', 'height=500, width=500, scrollbars=yes, screenX='+left+', screenY='+top+'');
            return false;
        });
    });
    
</script>


<?php //$customer = Customer::selectAll(); ?>
<div class="wrapper-list-user">
    <h1>NGƯỜI THEO DÕI</h1>
    <div>
        <h2><a id="dangnhap" href="<?php echo base_url('login/load_form'); ?>">Đăng Nhập</a></h2>
        
    </div>
    
</div>