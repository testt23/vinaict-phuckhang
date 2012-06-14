<?php

	class ProdCategory extends Prod_category_model {

		function __construct() {
			parent::__construct();
		}
                
                function getList($filter = array()) {
                    
                    $prod_category = new ProdCategory();
                    
                    if ($filter['id_prod_category_parent']) {
                        $prod_category->addWhere('prod_category');
                    }
                    
        
                    $sql = "SELECT menu.*, parent_menu.name parent_name, IF(parent_menu.position IS NULL, menu.position, CONCAT(parent_menu.position,'.',menu.position)) ordering
                                FROM menu
                                LEFT JOIN (SELECT * FROM menu) parent_menu
                                ON (menu.id_parent = parent_menu.id)
                                WHERE menu.disabled = ".IS_NOT_DISABLED;

                    if (isset($filter['name']) && $filter['name'])
                        $sql .= " AND menu.name LIKE '%".$filter['name']."%'";

                    if (isset($filter['id_menu_parent']) && $filter['id_menu_parent'])
                        $sql .= " AND menu.id_parent = ".$filter['id_menu_parent'];

                    if (isset($filter['menu_type']) && $filter['menu_type'] == BO)
                        $sql .= " AND menu.type = ".BO;
                    else
                        $sql .= " AND menu.type = ".FO;

                    $menu->query($sql);

                    return $menu;
                    
                }
                
	}
