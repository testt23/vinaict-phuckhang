<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*$config['useragent']        = "VinaICT";
$config['smpt_host']        = "ssl://smtp.googlemail.com";
$config['smpt_user']        = "thehalfheart@gmail.com";
$config['smpt_pass']        = "vancuong";
$config['smpt_port']        = 465;
$config['protocol']         = 'sendmail';
$config['wordwrap']         = TRUE;
$config['wrapchars']        = 76;
$config['mailtype']         = 'html';
$config['charset']          = 'utf-8';
$config['validate']         = TRUE;
$config['priority']         = 3;*/

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.gmail.com';
$config['smtp_port'] = '465';
$config['smtp_timeout'] = '7';
$config['smtp_user'] = 'thehalfheart@gmail.com'; // your gmail
$config['smtp_pass'] = 'vancuong'; // pass gmail
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
$config['mailtype'] = 'html'; // or html
$config['validation'] = TRUE; // bool whether to validate email or not


