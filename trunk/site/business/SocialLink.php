<?php

class SocialLink extends Social_link_model {

    function __construct() {
            parent::__construct();
    }

    function getList($filter = array()) {

        $social_link = new SocialLink();
        $social_link->addJoin(new Image(), 'LEFT');
        $social_link->addSelect();
        $social_link->addSelect('social_link.*, image.file picture');

        if (isset($filter['name']) && $filter['name'])
            $social_link->addWhere("social_link.name LIKE '%".$filter['name']."%'");
        
        if (isset($filter['is_social']) && $filter['is_social'])
            $social_link->addWhere("social_link.is_social = ".$filter['is_social']);
        
        if (isset($filter['type_show']) && $filter['type_show'])
            $social_link->addWhere("social_link.type_show = ".$filter['type_show']);
        
        if (isset($filter['limit']) && $filter['limit']){}
        else{
            $filter['limit'] = '5';
        }
        $social_link->limit ($filter['limit']);
        $social_link->orderBy('id DESC');
        
        $social_link->find();
        return $social_link;

    }
    
    public function getName(){
        return clean_html(getI18n($this->name));
    }
    
}