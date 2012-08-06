<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>/js/jquery.js"></script>        
<script language="javascript">
    $(document).ready(function(){
        jQuery('.openid' ).click(function(){
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
            
            window.open($(this).attr('href'), 'Login Openid', 'height=500, width=500, scrollbars=yes, screenX='+left+', screenY='+top+'');
            return false;
        });
    });
    
</script>

<h1>Lựa chọn phương thức đăng nhập</h1>
<h5>datvangnghethuat.com</h5>
<div>
    <a href="<?php echo $url_login_google; ?>"><img src="<?php echo base_url('images/google_connect_button.png'); ?>"/></a><br/>
    <a href="<?php echo $url_login_tweet; ?>"><img src="<?php echo base_url('images/twitter_login_button.gif'); ?>"/></a><br/>
    <a href="<?php echo $url_login_yahoo; ?>"><img src="<?php echo base_url('images/yahoo_openid_connect.png'); ?>"/></a><br/>
    <a href="<?php echo $url_login_facebook; ?>"><img src="<?php echo base_url('images/facebook.jpg'); ?>"/></a><br/>
</div>