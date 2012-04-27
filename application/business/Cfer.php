<?php

class Cfer
{
	var $cfer;
	var $cferArray;
	function Cfer($args = null)
	{
            
            if ($args == null)
                return;
                
		$included_files = get_included_files();

		if (!in_array(SYSTEM_PATH.'/helpers/utils_helper.php', $included_files))
			include SYSTEM_PATH.'/helpers/utils_helper.php';
		
		$this->cferArray = $args;
		$this->cfer = "";
		if (is_array($args))
		{
			$size = sizeof($args);
			for ($i = 0;$i < $size;$i++)
			{
				$label = key($args);
				$link = $args[$label];
				$glink = ($link != '') ? utf8_escape_html($link) : '#';
				$this->cfer.= "<a href='$glink'".(($i == $size-1)?" class=\"last\"":"").">$label</a>";
				if ($i+1 < $size) $this->cfer.= (($i == $size-2)?"<span class=\"last\">":"")."&nbsp;&gt;&nbsp;".(($i == $size-2)?"</span>":"");
				next($args);
			}
		}
	}

	function display()
	{
		return $this->cfer;
	}
	function getCferArray()
	{
		return $this->cferArray;
	}
        function setLink($url, $title)
        {
            $link = array('url' => $url, 'title' => $title);
            $this->session->set_userdata('back_link', $this->session->userdata('current_link') ? $this->session->userdata('current_link') : false);
            $this->session->set_userdata('current_link', $link);
        }
}
