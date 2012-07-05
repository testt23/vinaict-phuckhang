<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	/**
	 * Return the real length of an UTF8 string
	 *
	 * @access public
	 * @param string $utf8_string
	 * @return int the number of utf8 characters in the string
	*/	
if ( ! function_exists('utf8_strlen'))
{
	function utf8_strlen($utf8_string)
	{
		return strlen(utf8_decode($utf8_string));
	}
}

	/**
	 * Checks if a string contains 7bit ASCII only
	 *
	 * @access public
	 * @param string $utf8_string
	 * @return bool 'true' if the string contains only ascii characters, 'false' otherwise
	 */
if ( ! function_exists('utf8_is_ascii'))
{
	function utf8_is_ascii($utf8_string)
	{
		$count = strlen($utf8_string);
		for($i=0; $i++<$count;)
		{
			if(ord($utf8_string[$i]) >127) return false;
		}
		return true;
	}
}
        
	/**
	 * Escape an UTF8 string for display in an HTML page
	 * Typically, will convert only the 'special fives'
	 *    which are <,>,&,',"
	 * Convert "\n" to "<br>"
	 *
	 * @access public
	 * @param string $utf8_string
	 * @return string the escaped string
	 * @see Smarty modifier named utf8_escape_html
	 */
if ( ! function_exists('utf8_escape_html'))
{
	function utf8_escape_html($utf8_string)
	{
		return nl2br(htmlspecialchars($utf8_string,ENT_QUOTES,"UTF-8"));
	}
}
        
	/**
	 * Escape an UTF8 string for display in an HTML textarea element
	 * Typically, will convert only the 'special fives'
	 *    which are <,>,&,',"
	 *
	 * @access public
	 * @param string $utf8_string
	 * @return string the escaped string
	 * @see Smarty modifier named utf8_escape_html
	 */
if ( ! function_exists('utf8_escape_textarea'))
{
	function utf8_escape_textarea($utf8_string)
	{
            $utf8_string = preg_replace("/\r?\n/", "", $utf8_string);
		return htmlspecialchars($utf8_string,ENT_QUOTES,"UTF-8");
	}
}

	/**
	 * Escape an UTF8 string for use as JS litteral in HTML page
	 * Typically, will convert only the 'special fives'
	 *    which are <,>,&,'," (html parser escape)
	 * after having added slashes in front of all ' and " and \
	 * (javascript parser escape)
	 *
	 * @access public
	 * @param string $utf8_string
	 * @return string the escaped string
	 * @see Smarty modifier named utf8_escape_jshtml
	 */
if ( ! function_exists('utf8_escape_jshtml'))
{
	function utf8_escape_jshtml($utf8_string)
	{
		return htmlspecialchars(preg_replace("/\r?\n/", "\\n", str_replace("<","\\x3C",addslashes($utf8_string))),ENT_QUOTES,"UTF-8");
	}
}

	/**
	 * Escape an UTF8 string for use as JS litteral in JS script section
	 * of an html page.
	 * Will add slashes in front of all ' and " and \, then will escape
	 * the opening tag characters '<' for avoiding problem with injected
	 * closing </SCRIPT> tag.
	 *
	 * @access public
	 * @param string $utf8_string
	 * @return string the escaped string
	 * @see Smarty modifier named utf8_escape_js
	 */
if ( ! function_exists('utf8_escape_js'))
{
	function utf8_escape_js($utf8_string)
	{
		return preg_replace("/\r?\n/", "\\n", str_replace("<","\\x3C",addslashes($utf8_string)));
	}
}

	/**
	 * Escape an UTF8 string for use as string in an XML document
	 * The escaping is compatible for both text node and attributes
	 * value.
	 *
	 * To fit with W3C recommandation on XML 1.0, we escape using UTF8 code
	 * of the entity (and not the html entity). Only the recommanded characters
	 * are escaped => &,",<,>,Carriage return and Line feed
	 *
	 * @param string $utf8_string
	 * @return string the escaped string
	 * @see Smarty modifier named utf8_escape_xml
	 * @link http://www.w3.org/TR/2006/REC-xml-20060816/
	 * @link http://www.w3.org/XML/Datamodel.html
	 */
if ( ! function_exists('utf8_escape_xml'))
{
	function utf8_escape_xml($utf8_string)
	{
		return str_replace(array('&','"',"'",'<','>',"\r","\n"),
			array('&#38;','&#34;','&#39;','&#60;','&#62;','&#12;','&#10;'),
			$utf8_string );
	}
}

	/**
	 * Working utf8 substr function with no risks of cutting a >1 byte utf8 character
	 * in half.
	 *
	 * To achieve that, regexp are used with curly brace repetition of an UTF8 char regexp,
	 * it allows to read $from character, then capture $len character (max) in the second capture
	 * group, then return the whole 2nd capture group.
	 *
	 * @param string $utf8_string
	 * @param int $from the returned string will start at the start 'th position in string ,
	 *   counting from zero. If $from is negative, the full string will be returned.
	 * @param int $len If $len  is given and is positive, the string returned will contain at most $len
	 *   characters beginning from start (depending on the length of string ). If string length is less than
	 *   or equal to $from characters long, empty string will be returned. If $len is negative, the full string
	 *   will be returned. If $len is 0 or false, it is considered infinite
	 * @return string the subbed string
	 * @see Smarty modifier named utf8_substr
	 * @link http://vn.php.net/substr
	 */
if ( ! function_exists('utf8_substr'))
{
	function utf8_substr($utf8_string,$from,$len = 0)
	{
		$from = intval($from); $len = intval($len);
		$str_len = utf8_strlen($utf8_string);

		// treat $from parameter
		if ($from < 0)
		{
			$from += $str_len;
			if ($from < 0)
			{
				return '';
			}
		}
		// speed up the process in case the $from is too big
		elseif ($from >= $str_len)
		{
			return '';
		}
		

		// treat negative $len parameter
		if ($len < 0)
		{
			//speedup the process a little
			if ($from - $len >= $str_len)
			{
				return '';
			}
			
			$len += $str_len - $from;
		}


		return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
			'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+)'.(1?'{0,'.$len.'}':'*').').*#s',
			'$1',$utf8_string);
	}
}
	
	/**
	 * check string satisfy multilanguage format(eg. <en>xxxx</en><fr>yyyyy</fr>)
	 *
	 * @param string $source_str string is checked
	 */
if ( ! function_exists('isI18nStringFormat'))
{
    function isI18nStringFormat($source_str, $language = 'en')
	{
        if ($language && $language != '[a-z]{2}(_[A-Z]{2})*?' && $language != 'en') {
            if (!preg_match('/^[a-z]{2}(_[A-Z]{2})*?$/', $language)) {
                return false;
            }
        }
    
        $pattern = '/<('.$language.')>(.*?)<\/('.$language.')>/s';
        
		preg_match($pattern, $source_str, $source_matches);
             
		if(count($source_matches) > 0) {
			if ((count($source_matches) == 4 && (!$source_matches[2] || $source_matches[1] != $source_matches[3]))
                    || (count($source_matches) > 4 && (!$source_matches[3] || $source_matches[1] != $source_matches[4]))) {
				return false; 
			}
			
			$source_str = trim(str_replace($source_matches[0], '', $source_str));
			
			if ($source_str) {
				return isI18nStringFormat($source_str, '[a-z]{2}(_[A-Z]{2})*?');
			}
		} 
        else {
			if ($source_str) {
				return false;
			}
		}
		
		return true;
	}
}
	
	/**
	 * append id to name of string satisfy multilanguage format(eg. <en>id_xxxx</en><fr>id_yyyyy</fr>)
	 *
	 * @param string $id
	 * @param string $name
	 * 
	 */
if ( ! function_exists('appendIdtoName'))
{
	function appendIdtoName($id, $name)
	{
		$id_name = '';
		if (isI18nStringFormat($name)) {
			$pattern = '/<([a-z]{2}(_[A-Z]{2})*?)>(.*?)<\/([a-z]{2}(_[A-Z]{2})*?)>/s';
			preg_match_all($pattern, $name, $source_matches);
            foreach	($source_matches[0] as $key => $value) {
                $str_name = $source_matches[2];
                if (count($source_matches) == 6) {
                    $str_name = $source_matches[3];
                }
				$id_name .= str_replace($str_name[$key], $id.'_'.$str_name[$key], $value);
			}
		} else {
			$id_name = $id.'_'.$name;	
		}
		return $id_name;
	}
}
	
if ( ! function_exists('isI18nSqlCheckStringUnique'))
{
	function isI18nSqlCheckStringUnique($source_str, $field)
	{
		$pattern = '/<([a-z]{2}(_[A-Z]{2})*?)>.*?<\/([a-z]{2}(_[A-Z]{2})*?)>/';
		preg_match_all($pattern, $source_str, $source_matches);
		$sql_arr = array();
		foreach($source_matches[0] as $key => $value) {
			$sql_arr[] = $field.' LIKE "%'.$value.'%"';
		}
		$sql = implode(' OR ',$sql_arr);
		return $sql; 
	}
}

if ( ! function_exists('getI18n'))
{
        function getI18n($string, $language_code = '')
	{
            if ($language_code == '') {
                $language_code = get_system_language();
            }

            if (strlen($language_code) == 2) {
                $language_code = strtolower($language_code);
            }
            
            $string = preg_replace("/\r?\n/", '', $string);
            
            // Try to find the chain in the string
            if (preg_match('/<'.$language_code.'>(.*?)<\/'.$language_code.'>/',$string,$matches) > 0)
            {
                return str_replace(array('&lt;','&gt;'),array('<','>'),$matches[1]);
            }
            else
            {
                $CI =& get_instance();
		$default_language = $CI->config->item('language');
                
                    if (strtolower($language_code) != strtolower($default_language)) {
                        return getI18n($string, strtolower($default_language));
                    } else {
                        $pattern = '/<([a-z]{2}(_[A-Z]{2})*?)>(.*?)<\/([a-z]{2}(_[A-Z]{2})*?)>/s';
                        preg_match($pattern, $string, $matches);

                        if(count($matches) == 4)
                        {
                            return str_replace(array('&lt;','&gt;'),array('<','>'),$matches[2]);
                        } else if(count($matches) == 5 || count($matches) == 6)
                        {
                            return str_replace(array('&lt;','&gt;'),array('<','>'),$matches[3]);
                        } else {
                            return str_replace(array('&lt;','&gt;'),array('<','>'),$string);
                        }
                            }
            }
  	}
}

if ( ! function_exists('getI18nRealValueSql'))
{
    function getI18nRealValueSql($field_name, $lang_input = '')
	{
        if (!$lang_input) {
            $lang_input = get_system_language();
        }
        if (strlen($lang_input) == 2) {
            $lang_input = strtolower($lang_input);
        }
        $len_lang_input = strlen($lang_input)+2;
        
        $CI =& get_instance();
	$lang_default = $CI->config->item('language');
        
        $len_lang_default = strlen($lang_default)+2;
        
        $str = "SUBSTR(".$field_name.",
		IF(POSITION('<".$lang_input.">' IN ".$field_name.")=0, 
			( IF(POSITION('<".$lang_default.">' IN ".$field_name.")=0, POSITION('>' IN ".$field_name.")+1, POSITION('<".$lang_default.">' IN ".$field_name.")+".$len_lang_default.") ), 
		POSITION('<".$lang_input.">' IN ".$field_name.")+".$len_lang_input."))";
        $str = "TRIM(SUBSTR($str, 1, POSITION('</' IN $str)-1))";
		return $str;
	}
}

if ( ! function_exists('getI18nRealStringSql'))
{
	function getI18nRealStringSql($field_name)
        {
            $CI =& get_instance();
            $lang_default = $CI->config->item('language') ? $CI->config->item('language') : 'en';
            $lang_input = get_system_language();
            
        /*
            return "i18nString($field_name,'" . get_system_language() . "','" . $lang_default . "')";
         * 
         */
            
            $lang_input_org = '';
            if (strlen($lang_input) == 2) {
                $lang_input = strtolower($lang_input);
            } else {
                preg_match('/^([a-z]{2})(_[A-Z]{2})*?$/', $lang_input, $matches);
                $lang_input_org = $matches[1];
            }
            $len_lang_input = strlen($lang_input)+2;
            $len_lang_default = strlen($lang_default)+2;

            $in_en = "POSITION('<".$lang_default.">' IN ".$field_name.")";
            $out_en = "POSITION('<".$lang_default.">' IN ".$field_name.")+".$len_lang_default."";
            $out_first = "POSITION('>' IN ".$field_name.")+1";
            $out_en_default = "IF($in_en = 0, $out_first, $out_en)";

            if ($lang_input_org) {
                $in_org = "POSITION('<".$lang_input_org.">' IN ".$field_name.")";
                $out_org = "POSITION('<".$lang_input_org.">' IN ".$field_name.")+".$len_lang_default."";
                $out_default = "IF($in_org = 0, $out_en_default, $out_org)";
            } else {
                $out_default = $out_en_default;
            }

            $input= "POSITION('<".$lang_input.">' IN ".$field_name.")";
            $output="POSITION('<".$lang_input.">' IN ".$field_name.")+".$len_lang_input;
            $position = "IF ($input= 0, $out_default, $output)";
            $str = "SUBSTR(".$field_name.",".$position.")";
                    $str = "TRIM(SUBSTR($str, 1, POSITION('</' IN $str)-1))";
            return $str;
            
            
        }
}

if ( ! function_exists('convertUTF8'))
{
	function convertUTF8($text){
	  if(is_array($text))
	    {
	      foreach($text as $k => $v)
	    {
	      $text[$k] = convertUTF8($v);
	    }
	      return $text;
	    }
	
	    $max = strlen($text);
	    $buf = "";
	    for($i = 0; $i < $max; $i++){
	        $c1 = $text{$i};
	        if($c1>="\xc0"){ //Should be converted to UTF8, if it's not UTF8 already
	          $c2 = $i+1 >= $max? "\x00" : $text{$i+1};
	          $c3 = $i+2 >= $max? "\x00" : $text{$i+2};
	          $c4 = $i+3 >= $max? "\x00" : $text{$i+3};
	            if($c1 >= "\xc0" & $c1 <= "\xdf"){ //looks like 2 bytes UTF8
	                if($c2 >= "\x80" && $c2 <= "\xbf"){ //yeah, almost sure it's UTF8 already
	                    $buf .= $c1 . $c2;
	                    $i++;
	                } else { //not valid UTF8.  Convert it.
	                    $cc1 = (chr(ord($c1) / 64) | "\xc0");
	                    $cc2 = ($c1 & "\x3f") | "\x80";
	                    $buf .= $cc1 . $cc2;
	                }
	            } elseif($c1 >= "\xe0" & $c1 <= "\xef"){ //looks like 3 bytes UTF8
	                if($c2 >= "\x80" && $c2 <= "\xbf" && $c3 >= "\x80" && $c3 <= "\xbf"){ //yeah, almost sure it's UTF8 already
	                    $buf .= $c1 . $c2 . $c3;
	                    $i = $i + 2;
	                } else { //not valid UTF8.  Convert it.
	                    $cc1 = (chr(ord($c1) / 64) | "\xc0");
	                    $cc2 = ($c1 & "\x3f") | "\x80";
	                    $buf .= $cc1 . $cc2;
	                }
	            } elseif($c1 >= "\xf0" & $c1 <= "\xf7"){ //looks like 4 bytes UTF8
	                if($c2 >= "\x80" && $c2 <= "\xbf" && $c3 >= "\x80" && $c3 <= "\xbf" && $c4 >= "\x80" && $c4 <= "\xbf"){ //yeah, almost sure it's UTF8 already
	                    $buf .= $c1 . $c2 . $c3;
	                    $i = $i + 2;
	                } else { //not valid UTF8.  Convert it.
	                    $cc1 = (chr(ord($c1) / 64) | "\xc0");
	                    $cc2 = ($c1 & "\x3f") | "\x80";
	                    $buf .= $cc1 . $cc2;
	                }
	            } else { //doesn't look like UTF8, but should be converted
	                    $cc1 = (chr(ord($c1) / 64) | "\xc0");
	                    $cc2 = (($c1 & "\x3f") | "\x80");
	                    $buf .= $cc1 . $cc2;				
	            }
	        } elseif(($c1 & "\xc0") == "\x80"){ // needs conversion
	                $cc1 = (chr(ord($c1) / 64) | "\xc0");
	                $cc2 = (($c1 & "\x3f") | "\x80");
	                $buf .= $cc1 . $cc2;				
	        } else { // it doesn't need convesion
	            $buf .= $c1;
	        }
	    }
	    return $buf;
	}
}
	
	
if ( ! function_exists('getBasicString'))
{
    function getBasicString($str="")
    {
        $unwanted_array = array('Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
			'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
			'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
			'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
			'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', '-'=>' ');

		return strtr($str, $unwanted_array);
    }
}

if ( ! function_exists('isValidDate'))
{
    function isValidDate($date, $french_type = true)
    {
        if (!$date || trim($date) == '') return false;
        $date = trim($date);
        
        if (!preg_match("/^(\d{2})[\/](\d{2})[\/](\d{4})([\ ]([01][0-9]|2[0-3])[\:]([0-5][0-9])([\:]([0-5][0-9]))?)?$/", $date)) return FALSE;
        
        if(strpos($date, ' ')) {
            list($date, $time) = preg_split('/[\ ]/', $date);
        }
        
        if ($french_type) {
            list($day, $month, $year) = preg_split('/[\/-]/', $date);
        }
        else {
            list($month, $day, $year) = preg_split('/[\/-]/', $date);
        }
        
        return checkdate(intval($month), intval($day), intval($year));
    }
}
    
if ( ! function_exists('isValidDBDate'))
{
    function isValidDBDate($date)
    {
        if (!$date || trim($date) == '') return false;
        $date = trim($date);
        
        if (!preg_match("/^(\d{4})[\-](\d{2})[\-](\d{2})([\ ]([01][0-9]|2[0-3])[\:]([0-5][0-9])([\:]([0-5][0-9]))?)?$/", $date)) return FALSE;
        
        list($year, $month, $day) = preg_split('/[\/-]/', $date);
        return checkdate(intval($month) , intval($day) , intval($year));

    }
}

if ( ! function_exists('dateToUnixTimeStamp'))
{
    function dateToUnixTimeStamp($date, $french_type = true)
    {
        if (!self::isValidDate($date, $french_type)) return FALSE;
        if ($french_type) list($day, $month, $year) = preg_split('/[\/-]/', $date);
        else list($month, $day, $year) = preg_split('/[\/-]/', $date);
        return mktime(0, 0, 0, $month, $day, $year);

    }
}
    
if ( ! function_exists('dateToUnixTimeStamp'))
{
    function convertDateToMySQLStyle($date, $french_type = true)
    {
        if (!self::isValidDate($date, $french_type)) return '';
        return date('Y-m-d', Utils::dateToUnixTimeStamp($date, $french_type));

    }
}

if ( ! function_exists('convertDateToDisplayStyle'))
{
    function convertDateToDisplayStyle($date, $french_type = true)
    {
        if( preg_match('/[\/-]/', $date) )
        {
        if ($date == '') return '';
        list($year, $month, $day) = preg_split('/[\/-]/', $date);
        //echo "$year, $month, $day";
        //exit();
        $tmp_date = mktime(0, 0, 0, intval($month) , intval($day) , intval($year));
        //echo "$tmp_date";
        //exit();
        }
        else
        {
        	$tmp_date = $date;
        }

        if ($french_type)
        {
            return date('d/m/Y', $tmp_date);

        }
        return date('m/d/Y', $tmp_date);

    }
}
    
if ( ! function_exists('date_to_date_sql'))
{
    function date_to_date_sql($date_convert, $french_type = true) {
        
        if (!isValidDate(trim($date_convert), $french_type)) {
            return false;
        }
        
        $date_seg = preg_split('/[\ ]/', trim($date_convert));
        
        if (count($date_seg) == 2)
            list($date, $time) = $date_seg;
        else
            $date = trim($date_convert);
        
        if ($french_type == true)
            list($day, $month, $year) = preg_split('/[\/]/', $date);
        else
            list($month, $day, $year) = preg_split('/[\/]/', $date);
        
        if (isset($time)) {
            $time_seg = preg_split('/[\:]/', $time);
            
            if (count($time_seg) == 3)
                list($hour, $minute, $second) = $time_seg;
            elseif (count($time_seg) == 2) {
                list($hour, $minute) = $time_seg;
                $second = '00';
            }
            else {
                $hour = '00';
                $minute = '00';
                $second = '00';
            }
            
            return "$year-$month-$day $hour:$minute:$second";
        }
        else {
            return "$year-$month-$day";
        }
    }
}

if ( ! function_exists('date_sql_to_date'))
{
    function date_sql_to_date($date_convert, $french_type = true) {
        
        if (!isValidDBDate(trim($date_convert), $french_type)) {
            return false;
        }
        
        $date_seg = preg_split('/[\ ]/', trim($date_convert));
        if (count($date_seg) == 2)
            list($date, $time) = $date_seg;
        else
            $date = trim($date_convert);
        
        list($year, $month, $day) = preg_split('/[\-]/', $date);
        
        if ($french_type == true)
            $date = "$day/$month/$year";
        else
            $date = "$month/$day/$year";
        
        if (isset($time)) {
            list($hour, $minute, $second) = preg_split('/[\:]/', $time);
            return "$date $hour:$minute:$second";
        }
        else {
            return $date;
        }
    }
}

if ( ! function_exists('extract_date_sql'))
{
    function extract_date_sql($sql_date_time) {
        if (!isValidDBDate($sql_date_time))
            return false;
        
        $date_obj = new stdClass();
        
        $date_seg = preg_split('/[\ ]/', trim($sql_date_time));
        if (count($date_seg) == 2)
            list($date, $time) = $date_seg;
        else
            $date = trim($sql_date_time);
        
        list($date_obj->year, $date_obj->month, $date_obj->day) = preg_split('/[\-]/', $date);
        
        if (isset($time))
            list($date_obj->hour, $date_obj->minute, $date_obj->second) = preg_split('/[\:]/', $time);
        
        $date_obj->hour = isset($date_obj->hour) ? $date_obj->hour : 0;
        $date_obj->minute = isset($date_obj->minute) ? $date_obj->minute : 0;
        $date_obj->second = isset($date_obj->second) ? $date_obj->second : 0;
        
        return $date_obj;
    }
}

if ( ! function_exists('date_sql_to_timestamp'))
{
    function date_sql_to_timestamp($sql_date_time) {
        
        if ($date_obj = extract_date_sql($sql_date_time))
            return mktime($date_obj->hour, $date_obj->minute, $date_obj->second, $date_obj->month, $date_obj->day, $date_obj->year);
        else
            return false;
    }
}

if ( ! function_exists('date_sql_to_local_date'))
{
    function date_sql_to_local_date($sql_date_time, $timezone = 'UTC', $french_type = true, $display_time = true) {
        
        if ($french_type)
            $format = $display_time ? 'd/m/Y H:i:s' : 'd/m/Y';
        else
            $format = $display_time ? 'm/d/Y H:i:s' : 'm/d/Y';
        
        return date($format, gmt_to_local(date_sql_to_timestamp($sql_date_time), $timezone));
        
    }
}

if ( ! function_exists('dateDiff'))
{
    function dateDiff($start, $end) {

        // Checks $start and $end format (SQL date format)
        if (!isValidDBDate($start) || !isValidDBDate($end))
            return false;
        
        $d_start    = new DateTime($start);
        $d_end      = new DateTime($end);
        
        $diff = $d_start->diff($d_end, true);
        // return all data
        $obj = new stdClass();
        $obj->year    = $diff->format('%y');
        $obj->month    = $diff->format('%m');
        $obj->day      = $diff->format('%d');
        $obj->hour     = $diff->format('%h');
        $obj->min      = $diff->format('%i');
        $obj->sec      = $diff->format('%s');
        return $obj;
    } 
}

if ( ! function_exists('is_access'))
{
    function is_access($id) {
        if (!$id) {
            return redirect(base_url("login/logout/"));
        }
    }
}

if ( ! function_exists('get_system_language'))
{
    function get_system_language() {
        $CI =& get_instance();
        return $CI->session->userdata('lang') ? $CI->session->userdata('lang') : $CI->config->item('language');
    }
}

if ( ! function_exists('isValidEmail'))
{
    function isValidEmail($email) {
        $patterns = '/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/ix';

        $FILTER = '"'."\'";
        $email = str_replace(str_split($FILTER), "", $email);

        if(preg_match($patterns,trim($email), $matches)==1)
                return true;
        return false;
    }
}

if ( ! function_exists('isValidPhoneNumber'))
{
    function isValidPhoneNumber($phone) {

        $pattern = '/[^\d]/';
        $phone = preg_replace($pattern, '', $phone);

        if (strlen($phone) < 7 || strlen($phone) > 15) {
            return false;
        }

        return true;

    }
}

if ( ! function_exists('getQuarter'))
{
    function getQuarter($month) {
        return ceil($month / 3);
    }
}

if ( ! function_exists('convert_vi_to_en')) {
    function convert_vi_to_en($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
        return $str;
    }
}

if ( ! function_exists('clean_html')) {
    function clean_html($str) {
        return str_replace(array('&amp;nbsp;',"&quot;"), array('&nbsp;','"'), $str);
    }
}

if ( ! function_exists('truncateString')) {
    function truncateString($str, $chars, $to_space = true, $replacement="...") {
       if($chars > strlen($str)) return $str;

       $str = substr($str, 0, $chars);

       $space_pos = strrpos($str, " ");
       if($to_space && $space_pos >= 0) {
           $str = substr($str, 0, strrpos($str, " "));
       }

       return($str . $replacement);
    }

}
