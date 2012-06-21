<?php

class IndexModel extends Model{

    function __construct() {
        parent::__construct();
    }
    function list_new_product($page = false){
        $sql1 = " select count(p.id) as tong";
        $sql1 .= " from product as p join image i on  p.id_def_image = i.id ";
        $sql1 .= " join product_category c on p.id_primary_prod_category = c.id where is_featured = 1 order by p.id DESC ";
        
        $tongO = $this->Db->getObject($sql1);
        $current_page = $page;
        if (($page * 1) == 0) {
            $current_page = 1;
        }
        
        $limit = PAGING_LIMIT;
        $start = ( $current_page - 1 ) * $limit;
        $total_page = ceil($tongO->tong / $limit);
        $sql = " select p.name, p.id,  p.id_prod_image, i.file, c.link as clink, p.link as plink";
        $sql .= " from product as p join image i on  p.id_def_image = i.id ";
        $sql .= " join product_category c on p.id_primary_prod_category = c.id where is_featured = 1 order by p.id DESC limit " . $start . "," . $limit;
        
        $arr['paging'] = paging_html($total_page, $current_page, PAGING_RANGE);
        $arr['list'] = $this->Db->getList($sql);
        return $arr;
    }
}