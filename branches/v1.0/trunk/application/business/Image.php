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
                    
                    $config = array();
                    $config['upload_path'] = realpath(config_item('upload_path')).'/images/'.$group_code.'/';
                    $img_size = ImageGroup::getImageSizeData($group_code);
                    
                    if (!file_exists($config['upload_path'])) {
                        mkdir($config['upload_path']);
                    }
                    
                    $config['allowed_types'] = config_item('allowed_types');
                    $config['max_size']	= config_item('max_size');
                    $config['max_width']  = config_item('max_width');
                    $config['max_height']  = config_item('max_height');
                    $config['encrypt_name'] = config_item('encrypt_name');
                    $config['create_thumb'] = config_item('create_thumb');
                    $config['image_library'] = config_item('image_library');
                    $config['maintain_ratio'] = config_item('maintain_ratio');
                    $config['group_code'] = $group_code;

                    $ci =& get_instance();
                    
                    $ci->load->library('upload', $config);

                    if ($ci->upload->do_upload($field)) {

                        $img = $ci->upload->data();
                        
                        $config['source_image'] = $img['file_name'];
                        unset($config['upload_path']);
                        
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
                
	}

        