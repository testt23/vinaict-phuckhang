<?php

	class Image extends Image_model {

		function __construct() {
			parent::__construct();
		}
                
                /* Do upload action
                 * $field: Field name sent by HTML form
                 * $group_code: Please choose a group_code in image_group table
                 * $data: Name and description of image. $data is array('name' => name, 'description' => description) 
                 * Return: If upload action is OK, return image file name, else return FALSE
                 */
                function upload($field, $group_code, $data) {

                    $ci =& get_instance();
                    $upload_path = defined('UPLOAD_IMAGE_URL') ? UPLOAD_IMAGE_URL : config_item('upload_path').'images';
                    
                    //$config['upload_path'] = realpath($upload_path).'/'.$group_code.'/';
                    $config['upload_path'] = $upload_path.$group_code.'/';
                    $img_size = ImageGroup::getImageSizeData($group_code);
                    
                    if (!file_exists($config['upload_path'])) {
                        $ci->load->helper('file');
                        mkdir($config['upload_path']);
                        chmod($config['upload_path'], 0755);
                        write_file($config['upload_path'].'index.html', '<html>
                                                                            <head>
                                                                                    <title>403 Forbidden</title>
                                                                            </head>
                                                                            <body>
                                                                                <p>Directory access is forbidden.</p>
                                                                            </body>
                                                                        </html>');
                    }
                    
                    //$config['allowed_types'] = config_item('allowed_types');
                    $config['allowed_types'] = '*';
                    $config['max_size']	= config_item('max_size');
                    $config['max_width']  = config_item('max_width');
                    $config['max_height']  = config_item('max_height');
                    $config['encrypt_name'] = config_item('encrypt_name');
                    $config['create_thumb'] = config_item('create_thumb');
                    $config['image_library'] = config_item('image_library');
                    $config['maintain_ratio'] = config_item('maintain_ratio');
                    $config['group_code'] = $group_code;
                    
                    $ci->load->library('upload', $config);
                    if ($ci->upload->do_upload($field)) {    
                        $img = $ci->upload->data();                        
                        $config['source_image'] = $img['file_name'];
                        unset($config['upload_path']);
                        $img_group = ImageGroup::getImageGroup($group_code);

                        if ($img_group && $img_group->use_wm) {
                            
                            Image::watermark($upload_path.'/'.$group_code.'/'.$config['source_image']);
                            
                        }
                        
                        foreach ($img_size as $code => $value) {
                            $config['new_image'] = str_replace(array('.jpg','.png','.gif'), array('_'.$code.'.jpg', '_'.$code.'.png', '_'.$code.'.gif'), strtolower($img['file_name']));
                            
                            if ($value && $value !="") {
                                $size = explode('x', $value['size']);
                                $config['width'] = trim($size[0]) != '' ? trim($size[0]) : config_item('width');
                                $config['height'] = trim($size[1]) != '' ? trim($size[1]) : config_item('height');
                            }
                            
                            
                            $str_config = urlencode(serialize($config));
                            
                            $img_processing_result = file_get_contents(base_url('image/process?config='.$str_config));
                            
                            if (strpos(trim($img_processing_result), '[0]') !== FALSE) {
                                
                                $message = str_replace('[0]', '', trim($img_processing_result));
                                if ($message != '')
                                    MessageHandler::add($message);
                            }
                            
                            
                        }
                        
                        if (MessageHandler::countError() > 0)
                            return false;
                        
                        if (!$data)
                            $data = array('name' => date('d-m-Y H:i:s', gmt_to_local(time(), config_item('timezone'))), 'description' => '');
                        
                        $this->code = $this->code && trim($this->code) != '' ? $this->code : preg_replace("/.jpg|.png|.gif/", '', strtolower($img['file_name']));
                        $this->name = $this->name && trim($this->name) != '' ? $this->name : $data['name'];
                        $this->description = $this->description && trim($this->description) != '' ? $this->description : $data['description'];
                        $this->file = strtolower($img['file_name']);
                        
                        $img_group = ImageGroup::getImageGroup($group_code);
                        $this->id_image_group = $img_group->id;
                        $this->insert();
                        
                        return true;

                    }
                    else { 
                        if (!$ci->upload->is_image()) {
                            MessageHandler::add(lang('err_invalid_picture'), MSG_ERROR, MESSAGE_ONLY);
                        }
                        else {
                            if (!$ci->upload->is_allowed_dimensions()) {
                                MessageHandler::add(lang('err_wrong_file_dimension'), MSG_ERROR, MESSAGE_ONLY);
                            }

                            if (!$ci->upload->is_allowed_filesize()) {
                                MessageHandler::add(lang('err_wrong_file_size'), MSG_ERROR, MESSAGE_ONLY);
                            }

                            if (!$ci->upload->is_allowed_filetype()) {
                                MessageHandler::add('err_wrong_file_type', MSG_ERROR, MESSAGE_ONLY);
                            }

                        }

                    }

                    return false;
                    
                }
                
                function recreate() {
                    
                    $img_group = new ImageGroup();
                    $img_group->get($this->id_image_group);
                    
                    $config['upload_path'] = config_item('upload_path').'images/'.$img_group->code.'/';
                    $config['group_code'] = $img_group->code;
                    $config['allowed_types'] = config_item('allowed_types');
                    $config['max_size']	= config_item('max_size');
                    $config['max_width']  = config_item('max_width');
                    $config['max_height']  = config_item('max_height');
                    $config['encrypt_name'] = config_item('encrypt_name');
                    $config['create_thumb'] = config_item('create_thumb');
                    $config['image_library'] = config_item('image_library');
                    $config['maintain_ratio'] = config_item('maintain_ratio');
                    $config['source_image'] = $this->file;
                    
                    if (file_exists($config['upload_path'].$this->file)) {
                        
                        unset($config['upload_path']);
                        
                        $img_size = ImageGroup::getImageSizeData($img_group->code);
                        
                        foreach ($img_size as $code => $value) {
                            
                            $config['new_image'] = str_replace(array('.jpg','.png','.gif'), array('_'.$code.'.jpg', '_'.$code.'.png', '_'.$code.'.gif'), strtolower($this->file));
                            
                            if ($value && $value !="") {
                                $size = explode('x', $value['size']);
                                $config['width'] = trim($size[0]) != '' ? trim($size[0]) : config_item('width');
                                $config['height'] = trim($size[1]) != '' ? trim($size[1]) : config_item('height');
                            }
                            
                            $str_config = urlencode(serialize($config));
                            
                            $img_processing_result = file_get_contents(base_url('image/process?config='.$str_config));
                            
                            if (strpos(trim($img_processing_result), '[0]') !== FALSE) {
                                $message = str_replace('[0]', '', trim($img_processing_result));
                                
                                if ($message != '')
                                    MessageHandler::add($message);
                            }
                            
                        }
                        
                        if (MessageHandler::countError() > 0)
                            return false;
                        
                        return true;
                        
                    }
                    
                    return false;
                    
                }
                
                function delete() {
                    $image_group = new ImageGroup();
                    $image_group->get($this->id_image_group);
                    $img_size = ImageGroup::getImageSizeData($image_group->code);
                    $img_path = config_item('upload_path').'images/'.$image_group->code;
                    
                    @unlink(realpath($img_path).'/'.$this->file);
                    
                    foreach ($img_size as $code => $value) {
                        @unlink(realpath(realpath($img_path)).'/'.str_replace(array('.jpg','.png','.gif','.JPG','.PNG','.GIF'), array('_'.$code.'.jpg', '_'.$code.'.png', '_'.$code.'.gif','_'.$code.'.JPG', '_'.$code.'.PNG', '_'.$code.'.GIF'), strtolower($this->file)));
                    }
                    
                    parent::delete();
                    
                }
                
                
                
                function getImageURLs() {
                    
                    $image_group = new ImageGroup();
                    $image_group->get($this->id_image_group);
                    
                    $upload_image_path = direct_url(base_url(UPLOAD_IMAGE_URL));
                    
                    $image_size = ImageGroup::getImageSizeData($image_group->code);
                    
                    if ($this->file && $this->file != '') {
                        
                        $image_url = array();
                        $image_url['origin'] = $upload_image_path.$image_group->code.'/'.$this->file;

                        foreach ($image_size as $code => $size) {
                            $image_url['_'.$code] = str_replace(array('.jpg', '.png', '.gif', '.JPG', '.PNG', '.GIF'), array("_$code.jpg", "_$code.png", "_$code.gif", "_$code.JPG", "_$code.PNG", "_$code.GIF"), $image_url['origin']);
                        }
                        
                        return $image_url;
                        
                    }
                    
                    return false;
                    
                }
                
                public static function getImageByCode($code) {
                    
                    $img = new Image();
                    $img->addWhere("code = '$code'");
                    $img->addSelect();
                    $img->addSelect('*');
                    $img->find();
                    $img->fetchNext();
                    
                    return $img->id ? $img : FALSE;
                    
                }


                function getImageSizes() {
                    
                    $image_group = new ImageGroup();
                    $image_group->get($this->id_image_group);
                    
                    $image_sizes = ImageGroup::getImageSizeData($image_group->code);
                    
                    if ($this->file && $this->file != '') {
                        
                        $image_size = array();

                        foreach ($image_sizes as $code => $size) {
                            $image_size[] = $code;
                        }
                        
                        return $image_size;
                        
                    }
                    
                    return false;
                    
                }
                
                public static function deleteImage($code, $path){
                    $image = new Image();
                    $image->addSelect();
                    $image->addSelect('image.*');
                    $image->addWhere("image.code = '".$code."'");
                    $image->find();
                    if ($image->countRows() > 0){
                        $image->fetchFirst();
                        $image->delete();
                        return 'yes';
                    }
                    else{
                        return 'no';
                    }
                }
                
                
                
                public static function getImageGalleryTree($folder_name = '') {
                    
                    $dir = defined('UPLOAD_IMAGE_URL') ? UPLOAD_IMAGE_URL : config_item('upload_path').'images';
                    $dir = realpath($dir).($folder_name == '' ? '' : '/'.$folder_name);
                    
                    $files = preg_grep('/^([^.])/', scandir($dir));
                    
                    $arr_files = array();
                    
                    $ci =& get_instance();
                    $ci->load->helper('string');
                    
                    foreach($files as $file) {
                        
                        if (is_dir($dir."/".$file)) {
                            
                            $image_group = ImageGroup::getImageGroup($file);
                            $name = !empty($image_group->name) ? $image_group->name : $file;
                            $childs = self::getImageGalleryTree($file);
                            
                            if (count($childs) > 0) {
                                foreach($childs as $key => $child) {
                                    $child['path'] = $file.'/'.$child['path'];
                                    $childs[$key] = $child;
                                }
                            }
                            
                            $arr_files[] = array('id' => random_string('unique'), 'code' => $file, 'name' => $name, 'folder' => $file, 'path' => $file, 'is_dir' => TRUE, 'childs' => count($childs) > 0 ? $childs : FALSE);
                            
                        }
                        else {
                            
                            $file_info = pathinfo($file);
                            $file_info['extension'] = pathinfo($file, PATHINFO_EXTENSION);
                            $extension = $file_info['extension'];
                            
                            $file_allowed = explode('|', config_item('allowed_types'));
                            
                            if (in_array($extension, $file_allowed)) {
                                
                                $segment = explode('.', $file);
                                $segment = $segment[0];
                                $segment = explode('_', $segment);

                                $code = $segment[0];

                                if ($image = Image::getImageByCode($code)) {
                                    $name = $image->name;
                                    $description = $image->description;
                                    $creation_date = $image->creation_date;
                                }
                                else {
                                    $name = $file;
                                    $description = '';
                                    $creation_date = '';
                                }

                                if (isset($segment[1]) && !empty($segment[1])) {
                                    $img_size = ImageSize::getImageSizeByCode($segment[1]);
                                    if ($img_size){
                                        $name .= $img_size->name;
                                    }
                                }

                                $arr_files[] = array('id' => random_string('unique'), 'code' => $code, 'name' => $name, 'file' => $file, 'path' => $file, 'description' => $description, 'creation_date' => $creation_date, 'is_dir' => FALSE);
                                
                            }
                            
                        }
                        
                    }
                    
                    return $arr_files;
                    
                }
                
                public static function renderFolderTrees($folder_name = '') {
                    
                    $files = self::getImageGalleryTree($folder_name);

                    $folder_tree = '';
        
                    foreach($files as $key => $file) {
                        $folder_tree .= Image::getFolderTreeString($file);
                    }
                    
                    return $folder_tree;
                    
                }
                
                public static function getFolderTreeString($folder) {
        
                    $str = '';
                    $class = $folder['is_dir'] ? 'folder' : 'file';
                    $aclass = $folder['is_dir'] ? 'folder-link' : 'file-link';
                    $f = $folder['is_dir'] ? 'foldername="'.$folder['folder'].'"' : 'filename="'.$folder['file'].'"';
                    $cdate = $folder['is_dir'] ? '' : 'cdate="'.$folder['creation_date'].'"';
                    $description = $folder['is_dir'] ? '' : 'description="'.$folder['description'].'"';

                    $str .= '<li id="'.$folder['id'].'"><span class="'.$class.'"><a href="#'.$folder['code'].'" class="'.$aclass.'" '.$f.' path="'.$folder['path'].'" '.$description.' '.$cdate.' >'.$folder['name'].'</a></span>';

                    if ($folder['is_dir'] === TRUE) {
                        if (is_array($folder['childs']) && count($folder['childs']) > 0) {
                            $str .= '<ul>';
                            
                            foreach ($folder['childs'] as $child) {
                                $str .= self::getFolderTreeString($child);
                            }
                            
                            $str .= '</ul>';
                        }
                    }

                    $str .= '</li>';


                    return $str;

                }
                
                public static function watermark($image_path = '') {
                    
                    if (!defined('WM_ENABLED') || !WM_ENABLED) {
                        MessageHandler::add(lang('err_watermark_disabled'), MSG_ERROR, MESSAGE_ONLY);
                        return false;
                    }
                    
                    if ($image_path == '') {
                        MessageHandler::add(lang('err_invalid_source_image'), MSG_ERROR, MESSAGE_ONLY);
                        return false;
                    }
                    
                    if (!file_exists(realpath($image_path))) {
                        MessageHandler::add(lang('err_image_source_not_found'), MSG_ERROR, MESSAGE_ONLY);
                        return false;
                    }
                    
                    $config = array();
                    $config['image_library'] = config_item('image_library');
                    $config['source_image'] = $image_path;
                    $config['wm_type'] = defined('WM_TYPE') ? WM_TYPE : config_item('wm_type');
                    $config['wm_vrt_alignment'] = defined('WM_VRT_ALIGNMENT') ? WM_VRT_ALIGNMENT : config_item('wm_vrt_alignment');
                    $config['wm_hor_alignment'] = defined('WM_HOR_ALIGNMENT') ? WM_HOR_ALIGNMENT : config_item('wm_hor_alignment');
                    
                    if ($config['wm_type'] == 'overlay') {
                        $config['wm_overlay_path'] = defined('WM_OVERLAY_PATH') ? WM_OVERLAY_PATH : config_item('wm_overlay_path');
                        $config['wm_opacity'] = defined('WM_OPACITY') ? WM_OPACITY : config_item('wm_opacity');
                        
                        if (!file_exists(realpath($config['wm_overlay_path']))) {
                            MessageHandler::add(lang('err_overlay_not_found'), MSG_ERROR, MESSAGE_ONLY);
                            return false;
                        }
                    }
                    else {
                        $config['wm_text'] = defined('WM_TEXT') ? WM_TEXT : config_item('wm_text');
                        $config['wm_font_path'] = defined('WM_FONT_PATH') ? WM_FONT_PATH : config_item('wm_font_path');
                        $config['wm_font_size'] = defined('WM_FONT_SIZE') ? WM_FONT_SIZE : config_item('wm_font_size');
                        $config['wm_font_color'] = defined('WM_FONT_COLOR') ? WM_TEXT : config_item('wm_font_color');
                        $config['wm_shadow_color'] = defined('WM_SHADOW_COLOR') ? WM_SHADOW_COLOR : config_item('wm_shadow_color');
                        $config['wm_shadow_distance'] = defined('WM_SHADOW_DISTANCE') ? WM_SHADOW_DISTANCE : config_item('wm_shadow_distance');
                        
                        if (!file_exists(realpath($config['wm_font_path']))) {
                            MessageHandler::add(lang('err_font_not_found'), MSG_ERROR, MESSAGE_ONLY);
                            return false;
                        }
                    }
                    
                    $ci =& get_instance();
                    $ci->load->library('image_lib');
                    $ci->image_lib->initialize($config);
                    $ci->image_lib->watermark();
                    return true;
                    
                }
                
	}

        