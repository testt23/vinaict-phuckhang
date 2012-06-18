<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Phúc Khang</title>
        <link href="<?php echo CSS_PATH; ?>style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" language="javascript" src="<?php echo JS_PATH; ?>jquery.js"></script>
    </head>

    <body>
        <div id="header">
            <div id="logo">
                <a href="#"><img src="<?php echo IMAGE_PATH; ?>together/Logo.png" alt="" /></a>
            </div>
            <div id="menu">
                <ul>
                    
                    <?php
                    require 'libs/clsaccess.php';
                    $clsaccess = new clsaccess();
                    $Menu = $clsaccess->list_menu();
                    $totalMenu = count($Menu);
                    ?>
                    <?php for ($i = 0; $i < $totalMenu; $i++): ?>
                    <li><a href="<?php echo URL .$Menu[$i]->link; ?>"><?php echo getI18n($Menu[$i]->name,'en'); ?></a></li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
        <div id="container">
      
