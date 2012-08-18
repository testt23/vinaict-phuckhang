<?php

class Image extends Image_model {

    var $if;
    var $image_default;

    function __construct() {
        parent::__construct();
        $this->if = new DbInfo();
        $this->image_default = base_url() . $this->config->item('image_defailt_thum');
    }

    public function _join_image_group($filterSelect = array(), $join_type = 'INNER') {

        $DbInfo = new DbInfo();
        $Image = new Image();
        $Image_group = new ImageGroup();

        $Image->addSelect();

        foreach ($filterSelect as $key => $value) {
            if (!empty($value)) {
                $select = $key . ' as ' . $value;
            } else {
                $select = $key;
            }
            $Image->addSelect($select);
        }

        $Image->addJoin($Image_group, $join_type, $DbInfo->_table_image_group, $DbInfo->_image_id_image_group . ' = ' . $DbInfo->_image_group_id);

        $Image->find();
        return $Image;
    }

    public function getListImageFrontEnd() {
        
        $Image = new Image();
        $Image->addSelect();
        $Image->addSelect('count(image.id) as total_record');
        $Image->addJoin(new ImageGroup(), 'INNER', $this->if->_table_image_group, $this->if->_image_id_image_group . ' = ' . $this->if->_image_group_id);
        $Image->addWhere($this->if->_image_is_display_front_end . ' = 0');
        $Image->find();
        
        $Image->fetchFirst();
        $total_record = $Image->total_record;
        // initial page
        $page = ($this->input->get(Variable::getPaginationQueryString())) ? $this->input->get(Variable::getPaginationQueryString()) : 1;
        
        if ($page * 1 == 0){
            $page = 1;
        }
        
        $limit = (defined('LIMIT_PICTURE')) ? LIMIT_PICTURE : 21;
        $total_page = ceil($total_record / $limit);
        if ($total_page <= 0){
            $total_page = 1;
        }
        
        if ($total_page < $page){
            $page = $total_page;
        }
        $start = ($page - 1) * $limit;
        
        $Paging = new Paging();
        $string_paging = $Paging->paging_html(base_url('image') , $total_page, $page, 7);
        
        $Image = new Image();
        $Image->addSelect();
        $Image->addSelect($this->if->_image_id . ' as ' . $this->if->_image_as_id);
        $Image->addSelect($this->if->_image_name . ' as ' . $this->if->_image_as_name);
        $Image->addSelect($this->if->_image_file . ' as ' . $this->if->_image_as_file);
        $Image->addSelect($this->if->_image_description . ' as ' . $this->if->_image_as_description);
        $Image->addSelect($this->if->_image_group_code . ' as ' . $this->if->_image_group_as_code);
        $Image->addJoin(new ImageGroup(), 'INNER', $this->if->_table_image_group, $this->if->_image_id_image_group . ' = ' . $this->if->_image_group_id);
        $Image->addWhere($this->if->_image_is_display_front_end . ' = 0');
        $Image->limit($start. ','.$limit);
        $Image->find();
        $data['image'] = $Image;
        $data['pagination'] = $string_paging;
        return $data;
    }

    public function getListImageByListId($list_id) {
        $DbInfo = new DbInfo();
        if (!empty($list_id)) {

            $Image = new Image();

            $Image->addSelect();
            $Image->addSelect($DbInfo->_image_id . ' as ' . $DbInfo->_image_as_id);
            $Image->addSelect($DbInfo->_image_name . ' as ' . $DbInfo->_image_as_name);
            $Image->addSelect($DbInfo->_image_file . ' as ' . $DbInfo->_image_as_file);
            $Image->addSelect($DbInfo->_image_group_code . ' as ' . $DbInfo->_image_group_as_code);

            $Image->addJoin(new ImageGroup(), 'INNER', $DbInfo->_table_image_group, $DbInfo->_image_id_image_group . ' = ' . $DbInfo->_image_group_id);

            $Image->addWhere($DbInfo->_image_id . ' in (' . $list_id . ')');
            $Image->find();
            if ($Image->countRows() > 0) {
                $return = '';
                while ($Image->fetchNext()) {
                    $file = $Image->{$this->if->_image_group_as_code} . '/' . $Image->{$this->if->_image_as_file};
                    $tmp = array();
                    $tmp['id'] = $Image->{$this->if->_image_as_id};
                    $tmp['name'] = $Image->{$this->if->_image_as_name};
                    $tmp['link'] = $Image->the_image_link();
                    $tmp['link_avata'] = $Image->the_image_link_avata();
                    $tmp['link_medium'] = $Image->the_image_link_medium();
                    $return[] = $tmp;
                }
                return $return;
            }
            return '';
        }

        return '';
    }

    public function the_image_id() {
        return $this->{$this->if->_image_as_id};
    }

    public function the_image_name() {
        return $this->{$this->if->_image_as_name};
    }
    
    public function the_image_description() {
        return getI18n($this->{$this->if->_image_as_description}, get_system_language());
    }

    public function the_image_link_thumb() {
        $url = $this->{$this->if->_image_group_as_code} . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_thumb.jpg', '_thumb.png', '_thumb.gif'), $this->{$this->if->_image_as_file});
        return $this->image_exists($url);
    }

    public function the_image_link_avata() {
        $url = $this->{$this->if->_image_group_as_code} . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_avatar.jpg', '_avatar.png', '_avatar.gif'), $this->{$this->if->_image_as_file});
        return $this->image_exists($url);
    }

    public function the_image_link_small() {
        $url = $this->{$this->if->_image_group_as_code} . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_small.jpg', '_small.png', '_small.gif'), $this->{$this->if->_image_as_file});
        return $this->image_exists($url);
    }

    public function the_image_link_medium() {
        $url = $this->{$this->if->_image_group_as_code} . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_medium.jpg', '_medium.png', '_medium.gif'), $this->{$this->if->_image_as_file});
        return $this->image_exists($url);
    }

    public function the_image_link_large() {
        $url = $this{$this->if->_image_group_as_code} . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_large.jpg', '_large.png', '_large.gif'), $this->{$this->if->_image_as_file});
        return $this->image_exists($url);
    }

    public function the_image_link_tiny() {
        $url = $this->{$this->if->_image_group_as_code} . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_tiny.jpg', '_tiny.png', '_tiny.gif'), $this->{$this->if->_image_as_file});
        return $this->image_exists($url);
    }

    public function the_image_link() {
        $url = $this->{$this->if->_image_group_as_code} . '/' . $this->{$this->if->_image_as_file};
        return $this->image_exists($url);
    }

    public function image_exists($url) {
        $url = trim($url, '/');
        if (empty($url)) {
            return $this->image_default;
        }
        return file_exists(direct_url(config_item('source_image').$url)) ? base_url(config_item('source_image').$url) : $this->image_default;
    }

}

