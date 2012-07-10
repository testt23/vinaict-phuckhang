<?php

class Image extends Image_model {
    
    var $if;
    
    var $image_default;
    
    
    function __construct() {
        parent::__construct();
        $this->if = new dbinfo();
        $this->image_default = base_url() . $this->config->item('image_defailt_thum');
    }
    
    
    public function _join_image_group($filterSelect = array(), $join_type = 'INNER'){
        
        $dbinfo = new dbinfo();
        $Image = new Image();
        $Image_group = new ImageGroup();
        
        $Image->addSelect();
        
        foreach($filterSelect as $key => $value){
            if (!empty ($value)){
                $select = $key . ' as ' . $value;
            }else{
                $select = $key;
            }
            $Image->addSelect($select);
        }
        
        $Image->addJoin($Image_group, $join_type, 
                        $dbinfo->_table_image_group, 
                        $dbinfo->_image_id_image_group . ' = ' . $dbinfo->_image_group_id);
        
        $Image->find();
        return $Image;
        
    }
    
    
    
    public function getListImageByListId($list_id){
        $dbinfo = new dbinfo();
        if (!empty($list_id)){
            
            $Image = new Image();
        
            $Image->addSelect();
            $Image->addSelect($dbinfo->_image_id .' as '. $dbinfo->_image_as_id);
            $Image->addSelect($dbinfo->_image_name .' as '. $dbinfo->_image_as_name);
            $Image->addSelect($dbinfo->_image_file .' as '. $dbinfo->_image_as_file);
            $Image->addSelect($dbinfo->_image_group_code .' as '. $dbinfo->_image_group_as_code);

            $Image->addJoin(new ImageGroup(), 
                            'INNER', 
                            $dbinfo->_table_image_group, 
                            $dbinfo->_image_id_image_group.' = '.$dbinfo->_image_group_id);
            
            $Image->addWhere($dbinfo->_image_id.' in ('.$list_id.')');
            $Image->find();

            return $Image;
            
        }
            
        return '';
        
    }
    
    
    
    public function the_image_id(){
        return $this->{$this->if->_image_as_id};
    }
    public function the_image_name(){
        return $this->{$this->if->_image_as_name};
    }
    
    
    
    public function the_image_link_thumb(){
        $url = base_url() . '../uploads/images/'. $this->{$this->if->_image_group_as_code} . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_thumb.jpg', '_thumb.png', '_thumb.gif'), $this->{$this->if->_image_as_file});
        return $this->image_exists($url);
    }
    
    
    
    
    
    public function the_image_link_avata(){
        $url = base_url() . '../uploads/images/'. $this->{$this->if->_image_group_as_code} . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_avata.jpg', '_avata.png', '_avata.gif'), $this->{$this->if->_image_as_file});
        return $this->image_exists($url);
    }
    
    public function the_image_link_small(){
        $url = base_url() . '../uploads/images/'. $this{$this->if->_image_group_as_code} . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_small.jpg', '_small.png', '_small.gif'), $this->{$this->if->_image_as_file});
        return $this->image_exists($url);
    }
    
    public function the_image_link_medium(){
        $url = base_url() . '../uploads/images/'. $this->{$this->if->_image_group_as_code} . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_medium.jpg', '_medium.png', '_medium.gif'), $this->{$this->if->_image_as_file});
        return $this->image_exists($url);
    }
    
    public function the_image_link_large(){
        $url = base_url() . '../uploads/images/'. $this{$this->if->_image_group_as_code} . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_large.jpg', '_large.png', '_large.gif'), $this->{$this->if->_image_as_file});
        return $this->image_exists($url);
    }
    
    public function the_image_link_tiny(){
        $url = base_url() . '../uploads/images/'. $this->{$this->if->_image_group_as_code} . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_tiny.jpg', '_tiny.png', '_tiny.gif'), $this->{$this->if->_image_as_file});
        return $this->image_exists($url);
    }
    
    public function the_image_link(){
        $url = base_url() . '../uploads/images/'. $this->{$this->if->_image_group_as_code} . '/' . $this->{$this->if->_image_as_file};
        return $this->image_exists($url);
    }
    
    public function image_exists($url){
        if (!file_exists($url)) {
            return $this->image_default;
        }
        return $url;
    }
}   
