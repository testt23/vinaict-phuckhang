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
            var new_window = window.open($(this).attr('href').replace('#', ''), 'Login Openid', 'height=500, width=500, scrollbars=yes, screenX='+left+', screenY='+top+'');
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


<!--Shopping cart-->
<div class="box-sidebar">
    <div class="box-sidebar-content">
        <a class="shopping-cart" href="<?php echo base_url() . 'gio-hang.html'; ?>"><img src="<?php echo base_url() . 'images/site/shopping_cart.png'; ?>" /><?php echo lang('txt_shopping_cart'); ?></a>
    </div>
</div>

<!--Link-->
<div class="box-sidebar">
    <div class="box-sidebar-header"><?php echo lang('txt_link'); ?></div>
    <div class="box-sidebar-content">
        <ul class="ul-sidebar">
            <?php
            $filter = Array('is_social' => IS_NOT_SOCIAL);
            $social = SocialLink::getList($filter);
            while ($social->fetchNext()) {
                ?>
                <li><a href="<?php echo $social->url; ?>" target="_blank"><?php echo $social->getName(); ?></a></li>
            <?php } ?>
        </ul>
    </div>
</div>

<!--News-->
<div class="box-sidebar">
    <div class="box-sidebar-header"><?php echo lang('txt_hot_new'); ?></div>
    <div class="box-sidebar-content">
        <ul>
            <?php
            $filter = Array('limit' => '5');
            $article = Article::getList($filter);
            while ($article->fetchNext()) {
                ?>
                <li><a href="<?php echo base_url(); ?>news/detail/<?php echo $article->get_id(); ?>" title="<?php echo $article->get_title(); ?>">&raquo; &nbsp;<?php echo truncateString($article->get_title(), 100); ?></a></li>
            <?php } ?>
        </ul>
        <span><a href="<?php echo base_url(); ?>tin-tuc"><?php echo lang('view_more_other'); ?> &raquo;</a></span>

    </div>
</div>
<style type="text/css">
            .login h3{
                float:left;
                width: 20%;
            }
            .login div{
                float:right;
                width: 79%;
            }
        </style>
<!--News-->
<div class="box-sidebar">
    <div class="box-sidebar-header">Thành Viên</div>
    <div class="box-sidebar-content" style="padding: 10px;">
        <div class="login">
            <?php $login = Customer::getSessionLogin(); ?>
            <?php if ($login): ?>
                <h3>
                    <img src="<?php echo $login['image']; ?>" width="40px" height="40px" />
                </h3>
                <div>
                    <span><?php echo $login['email']; ?></span><br/>
                    <a href="#<?php echo base_url('login/google_logout'); ?>">LogOut</a>
                </div>
            <?php else: ?>
                <span>Bạn đã có tài khoảng ?</span> <a id="login" href="#<?php echo base_url('login/load_form'); ?>">Login</a>
            <?php endif; ?>
        </div>
        <div class="clear"></div>
        
        <h5 style="padding: 10px;">Dách sách thành viên:</h5>
        <ul>
            <?php $customer = Customer::selectAll(array('limit' => 10, 'start' => 0)); ?>
            <?php while ($customer->fetchNext()): ?>
                <?php if (!empty($customer->link_profile)): ?>
                    <li><a href="<?php echo $customer->link_profile; ?>"><img alt="" title="<?php if ($customer->username != '')
                echo $customer->username; else
                echo $customer->email; ?>" width="100%" height="100%" src="<?php echo $customer->image; ?>"/></a></li>        
                <?php else: ?>
                    <li><img alt="" title="<?php if ($customer->username != '')
                echo $customer->username; else
                echo $customer->email; ?>" width="50px" height="50px" src="<?php echo $customer->image; ?>"/></li>
    <?php endif; ?>
<?php endwhile; ?>
        </ul>
        <div style="text-align: right; padding: 10px;">
            <a href="#">>>See more</a>
        </div>
    </div>
</div>
<!--News-->
<div class="box-sidebar">
    <div class="box-sidebar-header">Lượt Truy Cập</div>
    <div class="box-sidebar-content" style="padding: 10px 0px 0px 0px;">
        <div align="center"><img border="0" src="http://cc.amazingcounters.com/counter.php?i=3094423&c=9283582" alt="Web Site Counters"></div>
    </div>
</div>
