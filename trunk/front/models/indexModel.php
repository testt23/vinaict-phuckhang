<?php

class IndexModel extends Model{

    function __construct() {
        parent::__construct();
    }
    function list_new_product($page = false){
        echo $page;
      $sql = " select p.name, p.id,  p.id_prod_image, i.file, c.link as clink, p.link as plink";
        $sql .= " from product as p join image i on  p.id_def_image = i.id ";
        $sql .= " join product_category c on p.id_primary_prod_category = c.id where is_featured = 1 order by p.id DESC ";
        return $this->Db->getList($sql);
    }
}