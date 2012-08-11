<?php

class Pagination {

    var $current_page;
    var $total_record;
    var $limit;
    var $start;
    var $total_page;

    function __construct($CI, $total_record = 0, $limit = 10) {

        $current_page = $CI->input->get_post('page');
        $this->current_page = $current_page;
        if ($current_page * 1 == 0)
            $current_page = 1;

        if (!$limit)
            $this->limit = 10;
        else
            $this->limit = $limit;

        $this->total_record = $total_record;
        $this->total_page = ceil($this->total_record / $this->limit);
        $this->current_page = $current_page;

        if ($this->total_page < 0)
            $this->total_page = 1;

        if (empty($this->current_page))
            $this->current_page = 1;

        if ($this->current_page > $this->total_page)
            $this->current_page = $this->total_page;

        if ($this->current_page < 1)
            $this->current_page = 1;

        $this->start = ($this->current_page - 1) * $this->limit;
    }

    function get_html($range) {
        $s = ' 
            
            <script language="javascript">
                function search(href){
                    searchForm = document.getElementById("searchform");
                    searchForm.action = href;
                    searchForm.submit();
                    return false;
                }
                $(document).ready(function(){
                    jQuery("#bnt_search").click(function(){
                        search(getHref());
                    });
                    jQuery(".pagination a").click(function(){
                        if ($(this).hasClass("active-tmp"))
                            return false;
                        var href = getHref();
                        var page = $(this).attr("href");
                        page = page.replace("?", "&");
                        href += page;
                        search(href);
                        return false
                    }); 

                    jQuery("#bt_gotopage").click(function(){
                        var href = getHref();
                        var page = $("#num_goto_page").val();
                        page = parseInt(page);
                        href += "&page=" + page;
                        search(href);
                        return false;
                    });

                    jQuery("#limit option").click(function(){
                        jQuery("#num_goto_page").val("1");
                    });
                 });
             </script>    
            ';
        
        
        $min = 1;
        $max = $this->total_page;
        if ($this->total_page > ($range * 2 + 1)) {
            $min = $this->current_page - $range;
            $max = $this->current_page + $range;
            if ($this->current_page <= $range) {
                $min = 1;
                $max = ($range * 2) + 1;
            }

            if ($this->current_page >= ($this->total_page - $range)) {

                $max = $this->total_page;
                $min = $this->total_page - (2 * $range);
            }
        }


        // prev, first
        if ($this->total_page > ($range * 2) + 1) {
            if ($this->current_page != 1) {
                $s .= '<a href="?page=' . ($this->current_page - 1) . '" >Prev</a>';
                if ($this->current_page > $range + 1)
                    $s .= '<a href="?page=1">1</a>';
                if ($this->current_page > $range + 2 && ($this->total_page > ($range * 2 + 2)))
                    $s .= ' ... ';
            }
            else {
                $s .= '<a class="active-tmp" href="?page=1" >Prev</a>';
            }
        }


        // range page
        for ($i = $min; $i <= $max; $i++) {
            if ($i == $this->current_page)
                $s .= '<a href="#page' . $i . '" class="active-tmp">' . $i . '</a>';
            else
                $s .= '<a href="?page=' . $i . '">' . $i . '</a>';
        }

        // next, end
        if ($this->total_page > ($range * 2) + 1) {
            if ($this->current_page != $this->total_page) {
                if ($this->current_page < ($this->total_page - $range - 1) && ($this->total_page > ($range * 2 + 2)))
                    $s .= ' ... ';
                if ($this->current_page < ($this->total_page - $range))
                    $s .= '<a href="?page=' . $this->total_page . '">' . $this->total_page . '</a>';
                $s .= '<a href="?page=' . ($this->current_page + 1) . '">Next</a>';
            }else {
                $s .= '<a href="?page=' . $this->total_page . '" class="active-tmp">Next</a>';
            }
        }


        $s .= 'Display ';
        $s .= '<select id="limit">';
        $array = array(10, 20, 30, 40, 50, 60, 70, 80, 90, 100);
        foreach ($array as $item) {
            if ($item == $this->limit)
                $s .= '<option value="' . $item . '" selected>' . $item . '</option>';
            else
                $s .= '<option value="' . $item . '">' . $item . '</option>';
        }
        $s .= '</select>';
        $s .= '<input type="textbox" value="' . $this->current_page . '" id="num_goto_page" style="width: 25px; margin: 0px 10px 0px 20px;"/><input type="button" id="bt_gotopage" value="Go to page" />';
        return $s;
    }

}
