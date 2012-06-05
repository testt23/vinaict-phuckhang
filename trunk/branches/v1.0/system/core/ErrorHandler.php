<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Exceptions Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Exceptions
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/exceptions.html
 */
class CI_ErrorHandler {
	private static $errors = array();
	
	public static function add($message) {
		self::$errors[] = $message;
	}
	
	public static function clear() {
		foreach (self::$errors as $k => $err) {
			unset(self::$errors[$k]);
		}
	}
	
	public static function getErrors() {
		return self::$errors;
	}
	
	public static function count() {
		return count(self::$errors);
	}

}
// END ErrorHandler Class

/* End of file ErrorHandler.php */
/* Location: ./system/core/ErrorHandler.php */