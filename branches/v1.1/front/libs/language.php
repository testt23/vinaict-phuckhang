<?php
if ( ! function_exists('getI18n'))
{
        function getI18n($string, $language_code = '') //en vi
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
               // $CI =& get_instance();
  $default_language = 'vi';
                
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