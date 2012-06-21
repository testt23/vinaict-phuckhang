<?php

	class ImageGroup extends Image_group_model {

		function __construct() {
			parent::__construct();
		}
                
                public static function getImageSize($code) {
                    
                    $img_group = new ImageGroup();
                    $img_group->addJoin(new ImageSize(), 'INNER', 'image_size', 'FIND_IN_SET(image_size.id,image_group.id_image_size)');
                    $img_group->addWhere("image_group.code = '$code'");
                    $img_group->addSelect();
                    $img_group->addSelect('image_size.code, image_size.name, image_size.value');
                    $img_group->find();
                    
                    return $img_group;
                    
                }
                
                public static function getImageSizeData($code) {
                    
                    $img_group = ImageGroup::getImageSize($code);
                    
                    $arr_size = array();
                    
                    while($img_group->fetchNext()) {
                        
                        $arr_size[$img_group->code] = array('name' => $img_group->name, 'size' => $img_group->value);
                        
                    }
                    
                    return $arr_size;
                    
                }
                
                public static function getImageGroup($code) {
                    
                    $img_group = new ImageGroup();
                    $img_group->addWhere("code = '$code'");
                    $img_group->find();
                    $img_group->fetchNext();
                    
                    return $img_group;
                    
                }
                
	}
