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
            if ($Image->countRows() > 0){
                $return = '';
                while($Image->fetchNext()){
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
    
    
    
    public function the_image_id(){
        return $this->{$this->if->_image_as_id};
    }
    public function the_image_name(){
        return $this->{$this->if->_image_as_name};
    }
    
    
    
    public function the_image_link_thumb(){
        $url = $this->{$this->if->_image_group_as_code} . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_thumb.jpg', '_thumb.png', '_thumb.gif'), $this->{$this->if->_image_as_file});
        return $this->image_exists($url);
    }
    public function the_image_link_avata(){
        $url = $this->{$this->if->_image_group_as_code} . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_avatar.jpg', '_avatar.png', '_avatar.gif'), $this->{$this->if->_image_as_file});
        return $this->image_exists($url);
    }
    
    public function the_image_link_small(){
        $url =  $this->{$this->if->_image_group_as_code} . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_small.jpg', '_small.png', '_small.gif'), $this->{$this->if->_image_as_file});
        return $this->image_exists($url);
    }
    
    public function the_image_link_medium(){
        $url = $this->{$this->if->_image_group_as_code} . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_medium.jpg', '_medium.png', '_medium.gif'), $this->{$this->if->_image_as_file});
        return $this->image_exists($url);
    }
    
    public function the_image_link_large(){
        $url = $this{$this->if->_image_group_as_code} . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_large.jpg', '_large.png', '_large.gif'), $this->{$this->if->_image_as_file});
        return $this->image_exists($url);
    }
    
    public function the_image_link_tiny(){
        $url = $this->{$this->if->_image_group_as_code} . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_tiny.jpg', '_tiny.png', '_tiny.gif'), $this->{$this->if->_image_as_file});
        return $this->image_exists($url);
    }
    
    public function the_image_link(){
        $url = $this->{$this->if->_image_group_as_code} . '/' . $this->{$this->if->_image_as_file};
        return $this->image_exists($url);
    }
    
    public function image_exists($url){
        $url = trim($url, '/');
        if (empty($url)){
            return $this->image_default;
        }
        return file_exists(direct_url(APPLICATION_PATH.'/'.config_item('upload_path').'images/'.$url)) ? direct_url(base_url(config_item('upload_path').'images/'.$url)) : $this->image_default;
    }
    public function have_image($url){
        if ($url == '' || $url == '/'){
            return false;
        }
        return file_exists(direct_url(APPLICATION_PATH.'/'.config_item('upload_path').'images/'.$url));
    }
}   
