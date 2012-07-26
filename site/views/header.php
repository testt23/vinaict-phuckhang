<!DOCTYPE html>
<html>
    <head>
        <?php
            
//            if(!$this->session->userdata('currency')){
//                $id_currency = 1;
//                $curr = new Currency();
//                $curr->get($id_currency);
//                
//                $curr_array = Array(
//                    'code' => $curr->code,
//                    'rate' => $curr->rate,
//                    'id'   => $curr->id
//                );
//                $this->session->set_userdata('currency',$curr_array);
//                $currency = $this->session->userdata('currency');
//            }else {
//                $currency = $this->session->userdata('currency');
//            }
            
            $image_path = base_url() . $this->config->item('image_temp');
        ?>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
        
        <meta http-equiv="content-language" content="<?php echo get_system_language(); ?>" />
        <title><?php echo getI18n(SITE_NAME) . ' - '. $title_page ; ?></title>
                        
        <meta name="description" content="<?php echo $description; ?>" />
        <meta name="keywords" content="<?php echo $keywords; ?>"/>
        
        <meta name="robots" content="noodp,index,follow" />
        <meta name='revisit-after' content='1 days' />
        
        <link href="<?php echo base_url(); ?>/css/style.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo base_url(); ?>/css/lightbox.css" rel="stylesheet" type="text/css" media="all" />
        <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>/js/jquery.js"></script>        
        <script language="javascript">
            function switchCurrency(id_currency){
                window.location.href=window.location.href + '?currency=' + id_currency;
            }
            
            $(document).ready(function(){
                jQuery('#advance').click(function(){
                    if (jQuery('.search-popup').hasClass('hide')){
                        jQuery('.search-popup').removeClass('hide').addClass('show');
                    }else{
                        jQuery('.search-popup').removeClass('show').addClass('hide');
                    }
                });
                jQuery('.close-search-pop').click(function(){
                    jQuery('.search-popup').removeClass('show').addClass('hide');
                });
             
            
        </script>
        
        <!--[if IE]> 
        <style typte="text/css">
        #box-search, .search-popup, .wrapper-popup, #showimage{
           
        }
        #order input{margin-top:  0px;}
        </style>
        <![endif]-->
        
            
        
    </head>
    
    <?php
    $this->session->set_userdata('lang_url', curPageURL());
    ?>
    <body>
        <?php 
            $social = SocialLink::getlist();
            if($social){
        ?>
        <div class="social-link-right">
            <?php while($social->fetchNext()){ ?>
            <span id="social_link">
                <a href="<?php echo $social->url; ?>" target="_blank">
                    <img src="<?php echo direct_url(base_url(UPLOAD_IMAGE_URL.'social/'.str_replace(array('.jpg','.png','.gif','.JPG','.PNG','.GIF'), array(BO_SOCIAL_LINK_IMG_SUFFIX.'.jpg',BO_SOCIAL_LINK_IMG_SUFFIX.'.png',BO_SOCIAL_LINK_IMG_SUFFIX.'.gif',BO_SOCIAL_LINK_IMG_SUFFIX.'.JPG',BO_SOCIAL_LINK_IMG_SUFFIX.'.PNG',BO_PROD_CATEGORY_IMG_SUFFIX.'.GIF'), $social->picture))).'" alt="'.clean_html(getI18n($social->name)); ?>" />
                </a>
            </span>
            <?php } ?>
        </div>
        <?php }  ?>
        
        <div id="header">
            <div id="header-container">
                <div id="header-right"> 
                    
                    <div id="language-wrapper">
                        <?php 
                           if($lang = Language::getArraylangIso()){
                                   foreach($lang as $k => $l){
                        ?>
                        <a id="<?php echo $l; ?>" href="<?php echo base_url(); ?>language/index/?lang=<?php echo $l; ?>" class="float-right <?php if($this->session->userdata('lang')) { echo (($this->session->userdata('lang') == $l )?"language-wrapper-active":"language-wrapper-unactive"); } elseif($l == 'vi') echo "language-wrapper-active"; else echo "language-wrapper-unactive"; ?>"><span><?php echo $k; ?></span> <img style="width: 24px; height: 24px;" src="<?php echo base_url(); ?>/images/icons/<?php echo $l; ?>.png" /></a>
                         <?php 
                                    } 
                              }
                          ?>

                    </div>
                    
<!--                    <div id="language-wrapper">
                        <?php 
//                           if($curren = Currency::getArrayCurrencyIso()){
//                                   foreach($curren as $k => $l){
                        ?>
                        <a id="<?php // echo $l; ?>" href="<?php //echo base_url().'index/switch_currency/'.$l; ?>" class="float-right <?php //if(isset($currency['code'])) { echo ( $currency['code'] == $l ?"language-wrapper-active":"language-wrapper-unactive"); } elseif($l == 'VND') echo "language-wrapper-active"; else echo "language-wrapper-unactive"; ?>"><span><?php //echo (clean_html(getI18n($k))); ?></span></a>
                         <?php 
//                                    } 
//                              }
                          ?>
                    </div>-->
                    
                    
                    <br/>
                    <div id="hot-line-wrapper">                    
                        <?php echo lang('site_hot_line'); ?>
                        <span><?php echo Variable::getCompanyHotline(); ?></span>
                    </div>
                    <br/><br />
                    <div id="support-online-wrapper">                    
                            <a href="ymsgr:sendIM?<?php echo YAHOO_SUPPORT_ONLINE; ?>"><br /><img border=0 src="http://opi.yahoo.com/online?u=<?php echo YAHOO_SUPPORT_ONLINE; ?>&m=g&t=1" /> </a>
                            <!--
                            Skype 'Skype Me™!' button
                            http://www.skype.com/go/skypebuttons
                            -->
                            <script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script>
                            <a href="skype:<?php echo SKYPE_SUPPORT; ?>?call"><img src="http://download.skype.com/share/skypebuttons/buttons/call_green_transparent_70x23.png" style="border: none;" width="70" height="23" alt="Skype Me™!" /></a>

                    </div>
                
                <!--
                <div id="searchbox">
                    <form method="post" action="<?php echo Variable::getLinkSearch(); ?>">
                        <input class="name-search" type="text" name="search-name" value=''/>
                        <input class="button-search" type="submit" name="button-search" value='<?php echo lang('show_form_search_1');?>'/>
                        <a href="#" id="advance"><?php echo lang('show_form_search_2');?></a>
                        <div class="search-popup hide">
                            <div class="close-search-pop">X</div>
                            <div class="clear"> </div>
                            <div style="margin-right: 15px;">
                                <?php echo lang('show_form_search_3');?> <input type="text" name="price-from-search" value=""/> <br/>
                                <?php echo lang('show_form_search_4');?> <input type="text" name="price-to-search" value=""/><br/>
                                <select name="currency-search">
                                    <option value=""><?php echo lang('show_form_search_5');?></option>
                                <?php $currency = new Currency();
                                    $list_currence = $currency->get_list();
                                    while($list_currence->fetchNext()):
                                ?>
                                <option value="<?php echo $list_currence->code; ?>"><?php echo $list_currence->code; ?></option>
                                <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                    </form>

                </div>
                -->
                </div>
                <div id="logo">
                    <a href="#"><img src="<?php echo $image_path; ?>/Logo.png" alt="" /></a>
                </div>
                
                <div class="clear"></div>
            </div>
            <div id="menu">
                <ul>
                    <?php Menu::drawMenu($array_menus, $selected); ?>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div id="page-container">
        <div id="container">
    </body>
</html>
    