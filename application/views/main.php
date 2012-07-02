<?php
    
    $theme_folders = $this->config->item('themes_folder').'/';
    $theme = $this->config->item('current_theme').'/';
    $skin = $this->config->item('current_skin');
    $skin = $skin ? $skin.'/':'';
    $app_name = SITE_NAME;
    $this->load->helper('url');
    $base_url = base_url();
    $theme_url = $base_url.$theme_folders.$theme.$skin;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $app_name; ?></title>
        <link href="<?php echo $theme_url; ?>css/style.css" rel="stylesheet" media="all" />
        <link href="<?php echo base_url(); ?>css/common.css" rel="stylesheet" media="all" />
        
        <script type="text/javascript">
            
            var site_url = "<?php echo base_url(); ?>";
            var lang_iso = new Array('en', 'vi');
            var lang_name = new Array('English', 'Tiếng Việt');
            var def_lang = "<?php echo get_system_language(); ?>";
            
        </script>
        
        <script type="text/javascript" src="<?php echo $theme_url; ?>js/jquery-1.3.2.js"></script>
        <script type="text/javascript" src="<?php echo $theme_url; ?>js/superfish.js"></script>
        <script type="text/javascript" src="<?php echo $theme_url; ?>js/jquery-ui-1.7.2.js"></script>
        <script type="text/javascript" src="<?php echo $theme_url; ?>js/tooltip.js"></script>
        <script type="text/javascript" src="<?php echo $theme_url; ?>js/tablesorter.js"></script>
        <script type="text/javascript" src="<?php echo $theme_url; ?>js/tablesorter-pager.js"></script>
        <script type="text/javascript" src="<?php echo $theme_url; ?>js/cookie.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.qtip-1.0.0.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_url; ?>js/custom.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/common.js"></script>
        
        <!--[if IE 6]>
        <link href="css/ie6.css" rel="stylesheet" media="all" />

        <script src="js/pngfix.js"></script>
        <script>
          /* EXAMPLE */
          DD_belatedPNG.fix('.logo, .other ul#dashboard-buttons li a');

        </script>
        <![endif]-->
        <!--[if IE 7]>
        <link href="css/ie7.css" rel="stylesheet" media="all" />
        <![endif]-->
    </head>

    <body>
        <?php 
        if ($section != 'login') {
            require_once 'header.php'; 
        }
        ?>
        <div id="page-wrapper">    
            <?php
            require_once 'content.php';
            if ($section != 'login') {
                require_once 'sidebar.php';
            }
            ?>
        </div>
        
        <?php if ($section != 'login') { ?>
        <div class="clearfix"></div>
        <?php require_once 'footer.php'; ?>
        <?php } ?>
    </body>

</html>