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

        $social_link->find();
        return $social_link;

    }
            
}