<?php

function paging_html($total_page,$current_page, $max ) {
    $s = '';
    if ($total_page > 1) {
        $min = 1;
        $max = PAGING_RANGE;
        $chia = $max / 2;
        if ($total_page <= $max) {
            $max = $total_page;
        } else if ($current_page <= $chia) {
            $min = $min;
            $max = $max;
        } else if ($current_page >= $total_page - $chia) {
            $min = $total_page - ($max - 1);
            $max = $total_page;
        } else {
            $min = $current_page - ($chia);
            $max = $current_page + ($chia) - 1;
        }

        if ($current_page > 1) {
            $s .='<a href="(*)/' . ($current_page - 1) . '">'.getI18n(PREV, $_SESSION['language']).'</a>';
        }elseif($current_page ==1) {
            $s .= '<a class="page-active" href="#">'.  getI18n(PREV, $_SESSION['language']).'</a>';
        }
        for ($i = $min; $i <= $max; $i++) {
            $s .='<a ';
            if ($i == $current_page) {
                $s .= ' class = "page-active" ';
                $s .= ' href="#">' . $i . '</a>';
            } else {
                $s .= ' href="(*)/' . $i . '">' . $i . '</a>';
            }
        }
        if ($current_page < $total_page) {
            $s .= '<a href="(*)/' . ($current_page + 1) . '">'.  getI18n(NEXT, $_SESSION['language']).'</a>';
        }elseif($current_page == $total_page) {
            $s .= '<a class="page-active" href="#">'.  getI18n(NEXT, $_SESSION['language']).'</a>';
        }
        
    }
    return $s;
}
