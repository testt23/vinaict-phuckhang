<?php
define('PROTOCOL', isset($_SERVER['HTTPS']) ? 'https' : 'http');
define('URL', PROTOCOL.'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
define('VIEW_PATH', URL . 'views/');
define('PUBLIC_PATH', URL . 'public/');
define('IMAGE_PATH', PUBLIC_PATH . 'images/');
define('CSS_PATH', PUBLIC_PATH . 'css/');
define('JS_PATH', PUBLIC_PATH . 'js/');
