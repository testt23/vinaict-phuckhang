<?php

class Product extends Product_model {

    var $if;
    var $lang;
    var $pre_fix_product = '';
    var $image_default;

    function __construct() {
        parent::__construct();
        $this->if = new dbinfo();
        $this->lang = get_system_language();
        $this->image_default = base_url() . $this->config->item('image_defailt_thum');
        $this->pre_fix_product = isset($_SERVER['PATH_INFO']) ? trim(str_replace(array('products', 'index'), array('products', 'products'), $_SERVER['PATH_INFO']), '/') : trim(get_raw_app_uri(), '/');
        if ($this->pre_fix_product == '') {
            $this->pre_fix_product = 'products';
        }
    }

    // this function use for get a list new product limited 20 products
    public function getNewProduct($page = 1) {

        // begin join image//
        // setting select field
        $filter = array(
            $this->if->_image_file => $this->if->_image_as_file,
            $this->if->_image_name => $this->if->_image_as_name,
            $this->if->_image_id => $this->if->_image_as_id,
            $this->if->_image_group_code => $this->if->_image_group_as_code,
            $this->if->_image_group_id_image_size => $this->if->_image_group_as_id_image_size,
        );
        $Image = Image::_join_image_group($filter);

        // begin find total record
        // find all total record
        $Product = new Product();
        $Product->addSelect();
        $Product->addSelect(' count(' . $this->if->_product_id . ') as ' . $this->if->_count);
        $Product->addWhere($this->if->_product_is_deleted . ' = 0');
        $Product->addWhere($this->if->_product_is_featured . ' = 1');
        $Product->addWhere($this->if->_product_is_disabled . ' = 0');
        $Product->addJoin($Image, 'LEFT', ' as p ', 'p.' . $this->if->_image_as_id . ' = ' . $this->if->_product_id_def_image);
        $Product->find();
        $Product->fetchFirst();
        $total_record = $Product->{$this->if->_count};

        // initial page
        $page = ($this->input->get(Variable::getPaginationQueryString())) ? $this->input->get(Variable::getPaginationQueryString()) : 1;
        $page = ($page * 1 == 0) ? 1 : $page;

        $limit = Variable::getLimitRecordPerPage();
        $total_page = ceil($total_record / $limit);
        $page = ($total_page < $page) ? $total_page : $page;
        $start = ($page - 1) * $limit;

        // continue buy link
        $link_continue = base_url() . Variable::getIndexPageString() . '?' . Variable::getPaginationQueryString() . '=' . $page;
        $this->session->set_userdata(Variable::getSessionLinkContinueBuy(), $link_continue);
        //end continue buy link

        // call paging class to get string pagation
        $Paging = new Paging();
        $string_paging = $Paging->paging_html(base_url() . Variable::getIndexPageString(), $total_page, $page, 7);
        
        // get list product
        $Product = new Product();
        $Product->addSelect();
        $Product->addSelect($this->if->_product_id . ' as ' . $this->if->_product_as_id);
        $Product->addSelect($this->if->_product_link . ' as ' . $this->if->_product_as_link);
        $Product->addSelect($this->if->_product_price . ' as ' . $this->if->_product_as_price);
        $Product->addSelect($this->if->_product_currency . ' as ' . $this->if->_product_as_currency);
        $Product->addSelect($this->if->_product_code . ' as ' . $this->if->_product_as_code);
        $Product->addSelect($this->if->_product_name . ' as ' . $this->if->_product_as_name);
        $Product->addSelect('p.' . $this->if->_image_as_name);
        $Product->addSelect('p.' . $this->if->_image_as_file);
        $Product->addSelect('p.' . $this->if->_image_group_as_code);
        $Product->addWhere($this->if->_product_is_deleted . ' = 0');
        $Product->addWhere($this->if->_product_is_featured . ' = 1');
        $Product->addWhere($this->if->_product_is_disabled . ' = 0');
        $Product->addJoin($Image, 'LEFT', ' as p ', 'p.' . $this->if->_image_as_id . ' = ' . $this->if->_product_id_def_image);
        $Product->limit($start . ', ' . $limit);
        $Product->find();
        $info['paging'] = $string_paging;
        $info['product'] = $Product;
        return $info;
    }

    public function getProductByname($name = '', $price_from = '', $price_to = '', $currency = '') {
        $filter = array(
            $this->if->_image_file => $this->if->_image_as_file,
            $this->if->_image_name => $this->if->_image_as_name,
            $this->if->_image_id => $this->if->_image_as_id,
            $this->if->_image_group_code => $this->if->_image_group_as_code,
            $this->if->_image_group_id_image_size => $this->if->_image_group_as_id_image_size,
        );
        $Image = Image::_join_image_group($filter);
        
        // count total
        $Product = new Product();
        $Product->addSelect();
        $Product->addSelect(' count(' . $this->if->_product_id . ') as ' . $this->if->_count);
        $Product->addWhere($this->if->_product_is_deleted . ' = 0');
        $Product->addWhere($this->if->_product_is_disabled . ' = 0');

        if (!empty($name)) {
            $Product->addWhere($this->if->_product_name . " like '%" . $name . "%'");
        }
        if (!empty($price_from)) {
            $Product->addWhere($this->if->_product_price . ' >= ' . $price_from);
        }
        if (!empty($price_to)) {
            $Product->addWhere($this->if->_product_price . ' <= ' . $price_to);
        }
        if (!empty($currency)) {
            $Product->addWhere($this->if->_product_currency . " = '" . $currency . "'");
        }

        $Product->addJoin($Image, 'LEFT', ' as p ', 'p.' . $this->if->_image_as_id . ' = ' . $this->if->_product_id_def_image);
        $Product->find();
        $Product->fetchFirst();
        $total_record = $Product->{$this->if->_count};
        if ($total_record == 0){
            $total_record = 1;
        }
        
        // init page
        $page = ($this->input->get(Variable::getPaginationQueryString())) ? $this->input->get(Variable::getPaginationQueryString()) : 1;
        $page = ($page * 1 == 0) ? 1 : $page;
        
        $limit = Variable::getLimitRecordPerPage();
        $total_page = ceil($total_record / $limit);
        $page = ($total_page < $page) ? $total_page : $page;
        $start = ($page - 1) * $limit;
        
        // call paging class to get string pagation
        $Paging = new Paging();
        $string_paging = $Paging->paging_html(base_url() . Variable::getProductPageString() . '/' .Variable::getProductPageSearchString(), $total_page, $page, 7);

        // link continue
        $link_continue = base_url() . Variable::getProductPageString() . '/' . Variable::getProductPageSearchString() . '?' . Variable::getPaginationQueryString() . '=' . $page;
        $this->session->set_userdata(Variable::getSessionLinkContinueBuy(), $link_continue);
        
        // list product
        $Product = new Product();
        $Product->addSelect();
        $Product->addSelect($this->if->_product_id . ' as ' . $this->if->_product_as_id);
        $Product->addSelect($this->if->_product_link . ' as ' . $this->if->_product_as_link);
        $Product->addSelect($this->if->_product_name . ' as ' . $this->if->_product_as_name);
        $Product->addSelect($this->if->_product_code . ' as ' . $this->if->_product_as_code);
        $Product->addSelect($this->if->_product_price . ' as ' . $this->if->_product_as_price);
        $Product->addSelect($this->if->_product_currency . ' as ' . $this->if->_product_as_currency);
        $Product->addSelect('p.' . $this->if->_image_as_name);
        $Product->addSelect('p.' . $this->if->_image_as_file);
        $Product->addSelect('p.' . $this->if->_image_group_as_code);
        $Product->addWhere($this->if->_product_is_deleted . ' = 0');
        $Product->addWhere($this->if->_product_name . " like '%" . $name . "%'");
        $Product->addWhere($this->if->_product_is_disabled . ' = 0');

        if (!empty($name)) {
            $Product->addWhere($this->if->_product_name . " like '%" . $name . "%'");
        }
        if (!empty($price_from)) {
            $Product->addWhere($this->if->_product_price . ' >= ' . $price_from);
        }
        if (!empty($price_to)) {
            $Product->addWhere($this->if->_product_price . ' <= ' . $price_to);
        }
        if (!empty($currency)) {
            $Product->addWhere($this->if->_product_currency . " = '" . $currency . "'");
        }

        $Product->addJoin($Image, 'LEFT', ' as p ', 'p.' . $this->if->_image_as_id . ' = ' . $this->if->_product_id_def_image);
        $Product->limit($start . ', ' . $limit);
        $Product->find();
        $info['paging'] = $string_paging;
        $info['product'] = $Product;

        return $info;
    }

    // function get a product by a link. return a product
    public function getProductByLink($url_link = null) {

        $filter = array(
            $this->if->_image_file => $this->if->_image_as_file,
            $this->if->_image_name => $this->if->_image_as_name,
            $this->if->_image_id => $this->if->_image_as_id,
            $this->if->_image_group_code => $this->if->_image_group_as_code,
            $this->if->_image_group_id_image_size => $this->if->_image_group_as_id_image_size,
        );

        $Image = Image::_join_image_group($filter);

        $Product = new Product();
        $Product->addSelect();
        $Product->addSelect($this->if->_product_id . ' as ' . $this->if->_product_as_id);
        $Product->addSelect($this->if->_product_link . ' as ' . $this->if->_product_as_link);
        $Product->addSelect($this->if->_product_name . ' as ' . $this->if->_product_as_name);
        $Product->addSelect($this->if->_product_code . ' as ' . $this->if->_product_as_code);
        $Product->addSelect($this->if->_product_price . ' as ' . $this->if->_product_as_price);
        $Product->addSelect($this->if->_product_currency . ' as ' . $this->if->_product_as_currency);
        $Product->addSelect($this->if->_product_description . ' as ' . $this->if->_product_as_description);
        $Product->addSelect($this->if->_product_id_def_image . ' as ' . $this->if->_product_as_id_def_image);
        $Product->addSelect($this->if->_product_id_prod_image . ' as ' . $this->if->_product_as_id_prod_image);
        $Product->addSelect('p.' . $this->if->_image_as_name);
        $Product->addSelect('p.' . $this->if->_image_as_file);
        $Product->addSelect('p.' . $this->if->_image_group_as_code);
        $Product->addWhere($this->if->_product_is_deleted . ' = 0');
        $Product->addWhere($this->if->_product_is_disabled . ' = 0');
        $Product->addWhere($this->if->_product_link . " = '" . $url_link . "'");

        $Product->addJoin($Image, 'LEFT', ' as p ', 'p.' . $this->if->_image_as_id . ' = ' . $this->if->_product_id_def_image);

        $Product->find();

        return $Product;
    }

    public function getProductByCategory($link = '') {

        $id = '';
        $link = trim($link);
        if ($link != '') {
            $Category = new ProductCategory();
            $Cat_tmp = $Category->get_category_id_by_link($link);
            if ($Cat_tmp->countRows() > 0) {
                $id = $Cat_tmp->the_prod_cate_id();
                if ($id) {
                    /**/
                    /* begin paging */
                    $filter = array(
                        $this->if->_image_file => $this->if->_image_as_file,
                        $this->if->_image_name => $this->if->_image_as_name,
                        $this->if->_image_id => $this->if->_image_as_id,
                        $this->if->_image_group_code => $this->if->_image_group_as_code,
                        $this->if->_image_group_id_image_size => $this->if->_image_group_as_id_image_size,
                    );
                    $Image = Image::_join_image_group($filter);
                    $Product_count = new Product();
                    $Product_count->addSelect();
                    $Product_count->addSelect(' count(' . $this->if->_product_id . ') as ' . $this->if->_count);
                    $Product_count->addSelect('p.' . $this->if->_image_group_as_code);

                    $Product_count->addJoin($Image, 'LEFT', ' as p ', 'p.' . $this->if->_image_as_id . ' = ' . $this->if->_product_id_def_image);

                    $Product_count->addWhere($this->if->_product_is_deleted . ' = 0');

                    $Product_count->addWhere("FIND_IN_SET('" . $id . "', " . $this->if->_product_id_prod_category . ")");
                    $Product_count->addWhere($this->if->_product_is_disabled . ' = 0');
                    $Product_count->find();

                    $Product_count->fetchFirst();

                    // initial page
                    $page = ($this->input->get(Variable::getPaginationQueryString())) ? $this->input->get(Variable::getPaginationQueryString()) : 1;
                    $page = ($page * 1 == 0) ? 1 : $page;

                    $total_record = $Product_count->{$this->if->_count};
                    $limit = Variable::getLimitRecordPerPage();
                    $total_page = ceil($total_record / $limit);

                    $page = ($total_page < $page) ? $total_page : $page;
                    $start = ($page - 1) * $limit;

                    $Paging = new Paging();

                    $string_paging = $Paging->paging_html(base_url() . Variable::getProductPageString() . '/' . $link . '', $total_page, $page, 7);

                    
                    // link continue buy
                    $link_continue = base_url() . Variable::getProductPageString() . '/' .$link . '?' . Variable::getPaginationQueryString() . '=' . $page;
                    $this->session->set_userdata(Variable::getSessionLinkContinueBuy(), $link_continue);
                    
                    /* begin list */
                    $Product = new Product();
                    $Product->addSelect();
                    $Product->addSelect($this->if->_product_id . ' as ' . $this->if->_product_as_id);
                    $Product->addSelect($this->if->_product_id_prod_category . ' as ' . $this->if->_product_as_id_prod_category);
                    $Product->addSelect($this->if->_product_link . ' as ' . $this->if->_product_as_link);
                    $Product->addSelect($this->if->_product_name . ' as ' . $this->if->_product_as_name);
                    $Product->addSelect($this->if->_product_code . ' as ' . $this->if->_product_as_code);
                    $Product->addSelect($this->if->_product_price . ' as ' . $this->if->_product_as_price);
                    $Product->addSelect($this->if->_product_currency . ' as ' . $this->if->_product_as_currency);
                    $Product->addSelect('p.' . $this->if->_image_as_name);
                    $Product->addSelect('p.' . $this->if->_image_as_file);
                    $Product->addSelect('p.' . $this->if->_image_group_as_code);

                    $Product->addJoin($Image, 'LEFT', ' as p ', 'p.' . $this->if->_image_as_id . ' = ' . $this->if->_product_id_def_image);

                    $Product->addWhere($this->if->_product_is_deleted . ' = 0');
                    $Product->addWhere($this->if->_product_is_disabled . ' = 0');
                    $Product->addWhere("FIND_IN_SET('" . $id . "', " . $this->if->_product_id_prod_category . ")");
                    $Product->limit(' ' . $start . ',' . $limit . ' ');

                    $Product->find();

                    $data['paging'] = $string_paging;
                    $data['product'] = $Product;

                    return $data;
                }
            }
        }
        $data['paging'] = '';
        $data['product'] = '';
        return $data;
    }

    
    
    public function getListThreeCateFooter(){
        $filter = array();
        $filter[0] = array('name' => 'SOUVENIRS', 'link' => base_url() . Variable::getProductPageString() .'/souvenirs' );
        $filter[1] = array('name' => 'INTERIOR', 'link' => base_url() . Variable::getProductPageString() .'/souvenirs' );
        $filter[2] = array('name' => 'SPA', 'link' => base_url() . Variable::getProductPageString() .'/souvenirs' );
        return $filter;
    }
    
    
    /* get data */

    public function the_product_id() {
        return $this->{$this->if->_product_as_id};
    }

    public function the_product_code() {
        return $this->{$this->if->_product_as_code};
    }

    public function the_product_currency() {
        return getI18n($this->{$this->if->_product_as_currency}, $this->lang);
    }

    public function the_product_price() {
        return $this->{$this->if->_product_as_price};
    }

    public function the_product_name($lang_true_false = false) {
        if ($lang_true_false == false) {
            return getI18n($this->{$this->if->_product_as_name}, $this->lang);
        }
        return $this->{$this->if->_product_as_name};
    }

    public function the_product_link() {
        return base_url() . $this->pre_fix_product . '/' . $this->{$this->if->_product_as_link} . '.html';
    }

    public function the_product_description($lang_true_false = false) {
        if ($lang_true_false == false) {
            return getI18n($this->{$this->if->_product_as_description}, $this->lang);
        }
        return $this->{$this->if->_product_as_description};
    }

    public function the_image_group_code() {
        return $this->{$this->if->_image_group_as_code};
    }

    public function the_image_link_thumb() {
        $url = base_url() . '../uploads/images/' . $this->the_image_group_code() . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_thumb.jpg', '_thumb.png', '_thumb.gif'), $this->{$this->if->_image_as_file});
        if (!file_exists($url)) {
            return $this->image_default;
        }
        return $url;
    }

    public function the_image_link_large() {
        $url = base_url() . '../uploads/images/' . $this->the_image_group_code() . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_large.jpg', '_large.png', '_large.gif'), $this->{$this->if->_image_as_file});
        if (!file_exists($url)) {
            return $this->image_default;
        }
        return $url;
    }

    public function the_image_link_small() {
        $url = base_url() . '../uploads/images/' . $this->the_image_group_code() . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_small.jpg', '_small.png', '_small.gif'), $this->{$this->if->_image_as_file});
        if (!file_exists($url)) {
            return $this->image_default;
        }
        return $url;
    }

    public function the_image_name($lang_true_false = false) {
        if ($lang_true_false == false) {
            return getI18n($this->{$this->if->_image_as_name}, $this->lang);
        }
        return $this->{$this->if->_image_as_name};
    }

    public function the_product_id_prod_image() {
        return $this->{$this->if->_product_as_id_prod_image};
    }

    public function the_product_id_def_image() {
        return $this->{$this->if->_product_as_id_def_image};
    }

}
