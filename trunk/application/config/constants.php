<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

// Campaign statuses
define('CREATED', 1);
define('STARTED', 2);
define('PAUSED', 3);
define('CANCELED', 4);
define('COMPLETED', 5);

// Form action
define('ACT_SUBMIT', 10);

define('IS_DELETED', 1);
define('IS_NOT_DELETED', 0);
define('IS_DISABLED', 1);
define('IS_NOT_DISABLED', 0);

// Setting categories
define('UNKNOWN', 0);
define('SYSTEM', 1);
define('BUSINESS', 2);

// Notification message type
define('MSG_ERROR', 1);
define('MSG_WARNING', 2);
define('MSG_INFO', 3);
define('MSG_HAPPY', 4);
define('MESSAGE_ONLY', 0);
define('LOG_ONLY', 1);
define('MESSAGE_AND_LOG', 2);

// Date type definition
define('TEXT', 1);
define('TEXTAREA', 2);
define('NUMBER', 3);
define('DATE', 4);
define('DATETIME', 5);
define('BOOLEAN', 6);
define('LIST', 8);
define('LIST_MULTI', 9);
define('EDITOR', 10);
define('TEXT_MULTILANG', 11);
define('TEXTAREA_MULTILANG', 12);
define('EDITOR_MULTILANG', 13);
define('PICTURE', 14);

// Load from database

@include(APPPATH.'config/database.php');
    $db_conf = $db['default'];
    
    $link = mysql_connect($db_conf['hostname'], $db_conf['username'], $db_conf['password']);
    
    mysql_set_charset('utf8', $link);
    
    mysql_select_db($db_conf['database']);
    
    $query = 'SELECT code, value FROM parameter WHERE always_load = 1';
    $setting = mysql_query($query, $link);
    
    while ($row = mysql_fetch_array($setting)) {
        define ($row['code'], $row['value']);
    }
    
    mysql_free_result($setting);
    mysql_close($link);
unset($db);

/* End of file constants.php */
/* Location: ./application/config/constants.php */