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

       /* $config['protocol'] = 'smtp';
        $config['smtp_host'] =  'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_timeout']= '7';
        $config['smtp_user'] =  'thehalfheart@gmail.com'; // your gmail
        $config['smtp_pass'] =  'vancuong'; // pass gmail
        $config['charset'] =  'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not
        $config['wordwrap'] = FALSE;*/

        $config['protocol'] = defined('MAILER_PROTOCOL') ? MAILER_PROTOCOL : 'smtp';
        $config['smtp_host'] = defined('MAILER_SMTP_HOST') ? MAILER_SMTP_HOST : 'ssl://smtp.gmail.com';
        $config['smtp_port'] = defined('MAILER_SMTP_PORT') ? MAILER_SMTP_PORT : '465';
        $config['smtp_timeout'] = defined('MAILER_SMTP_TIME_OUT') ? MAILER_SMTP_TIME_OUT : '7';
        $config['smtp_user'] = defined('MAILER_SMTP_USER_EMAIL') ? MAILER_SMTP_USER_EMAIL : 'thehalfheart@gmail.com'; // your gmail
        $config['smtp_pass'] = defined('MAILER_SMTP_PASS_EMAIL') ? MAILER_SMTP_PASS_EMAIL : 'vancuong'; // pass gmail
        $config['charset'] = defined('MAILER_SMTP_CHARSET') ? MAILER_SMTP_CHARSET : 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not
        $config['wordwrap'] = FALSE;


