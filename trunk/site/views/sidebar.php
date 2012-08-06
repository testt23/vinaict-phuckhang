<script language="javascript">
    $(document).ready(function(){
        jQuery('#login' ).click(function(){
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
<!--<style>
    .box-sidebar .box-title{
        height: 30px;
        line-height: 30px;
        margin-top: 10px;
        text-align: center;
    }
    .box-sidebar-content{
    }
    ul.list-customer li{
        width: 80px; height: 80px;
        float:left;
    }
</style>

<div class="box-sidebar">
    <h3 class="box-title">
        HỘP NGƯỜI THEO DÕI
    </h3>
    <hr/>
    <div class="box-sidebar-content">
        <span>Bạn có tài khoản rồi? <a id="login" href="#<?php echo base_url('login/load_form'); ?>">�?ăng Nhập</a></span>
            <ul class="list-customer">
                <li>
                    
                </li>
            </ul>
    </div>
    <div class="clear"></div>
</div>-->

<div class="box-sidebar">
    <div class="box-sidebar-header">Liên kết</div>
    <div class="box-sidebar-content">
        <ul>
            <?php 
                $filter = Array('is_social' => IS_NOT_SOCIAL);
                $social = SocialLink::getList($filter);
                while($social->fetchNext()){
            ?>
            <li><a href="<?php echo $social->url; ?>"><?php echo $social->getName(); ?></a></li>
            <?php } ?>
        </ul>
    </div>
</div>