<?php

	class ImageSize extends Image_size_model {

		function __construct() {
			parent::__construct();
		}
                
                public static function getImageSizeByCode($code) {
                    
                    $img_size = new ImageSize();
                    $img_size->addWhere("code = '$code'");
                    $img_size->addSelect();
                    $img_size->addSelect('*');
                    $img_size->find();
                    $img_size->fetchNext();
                    
                    return $img_size->id ? $img_size : FALSE;
                }
	}
