<?php

class Image_controller extends CI_Controller {
    
    function process() {
        
        //if (User::isAccessAble($this->session->userdata('userID'), 'image/process')) {
            
            $str_config = $this->input->get('config');

            $config = unserialize(urldecode($str_config));
            
            $config['upload_path'] = realpath(config_item('upload_path')).'/images/'.$config['group_code'].'/';
            $config['source_image'] = $config['upload_path'].$config['source_image'];
            $config['new_image'] = $config['new_image'];
            $config['create_thumb'] = FALSE;
            
            $this->load->library('image_lib', $config);

            if ($this->image_lib->resize())
                echo '[1]';
            else
                echo '[0]'.$this->image_lib->display_errors();
            die;
        //}
        //else {
            //echo '[0]'.lang('msg_not_granted_this_page');
        //}
        
    }

    function uploadifive($group_code = '', $id_item = null) {

        if (!empty($_FILES)) {
            
            $group_code = $group_code != '' ? $group_code.'/' : '';
            
            $config = array();
                    
            $upload_path = config_item('source_image');
            $config['wm_type'] = defined('WM_TYPE') ? WM_TYPE : config_item('wm_type');

            $config['upload_path'] = realpath($upload_path).'/'.$group_code;

            if (!file_exists($config['upload_path'])) {
                mkdir($config['upload_path']);
                chmod($config['upload_path'], 0755);
                $this->load->helper('file');
                write_file($config['upload_path'].'index.html', '<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>');
            }

            $config['allowed_types'] = config_item('allowed_types');
            $config['encrypt_name'] = config_item('encrypt_name');

            $this->load->library('upload', $config);
            
            $tempFile   = $_FILES['Filedata']['tmp_name'][0];
            $uploadDir = $config['upload_path'];

            // Validate the file type
            $fileTypes = explode('|', $config['allowed_types']); // Allowed file extensions
            $fileParts = pathinfo($_FILES['Filedata']['name'][0]);

            // Validate the filetype
            if (in_array(strtolower($fileParts['extension']), $fileTypes)) {

                $this->upload->file_ext = '.'.$fileParts['extension'];
                $targetFile = $this->upload->set_filename($uploadDir, $tempFile);
                $target_file_name = $targetFile;
                $targetFile = $uploadDir . $targetFile;

                // Save the file
                move_uploaded_file($tempFile,$targetFile);
                
                $group_code = str_replace('/', '', $group_code);
                $img_group = ImageGroup::getImageGroup($group_code);
                
                if ($img_group && $img_group->use_wm) {
                    
                    if ($config['wm_type'] == 'overlay') {
                        $this->load->helper('image');
                        watermark($upload_path.$group_code.'/'.$target_file_name, $config);
                    }
                    else {
                        $this->load->library('image_lib');
                        $this->image_lib->initialize($config);
                        $this->image_lib->watermark();
                    }
                    
                    //Image::watermark($upload_path.$group_code.'/'.$target_file_name);
                    // Need a warning message when system cannot process watermark
                }
                
                $config['group_code'] = $group_code;
                $config['source_image'] = $target_file_name;
                
                $img_size = ImageGroup::getImageSizeData($group_code);
                
                foreach ($img_size as $code => $value) {
                   
                    $config['new_image'] = str_replace(array('.jpg','.png','.gif','.jpeg'), array('_'.$code.'.jpg', '_'.$code.'.png', '_'.$code.'.gif', '_'.$code.'.jpeg'), strtolower($target_file_name));
                            
                    if ($value && $value !="") {
                        $size = explode('x', $value['size']);
                        $config['width'] = trim($size[0]) != '' ? trim($size[0]) : config_item('width');
                        $config['height'] = trim($size[1]) != '' ? trim($size[1]) : config_item('height');
                    }

                    $str_config = urlencode(serialize($config));

                    $img_processing_result = file_get_contents(base_url('image/process?config='.$str_config));

                    if (strpos(trim($img_processing_result), '[0]') !== FALSE) {
                        $message = str_replace('[0]', '', trim($img_processing_result));

                        // Return warning message
                        if ($message != '')
                            $str_warning = '[WARNING]'.$message;
                        
                    }
                    
                }
                
                $data = array('name' => date('d-m-Y H:i:s', gmt_to_local(time(), config_item('timezone'))), 'description' => '');
                
                if ($group_code == IMG_PRODUCT_CODE) {
                    $product = new Product();
                    if ($id_item && $product->get($id_item))
                        $data = array('name' => $product->code, 'description' => getI18n($product->name));
                }
                elseif ($group_code == IMG_PRODUCT_CATEGORY_CODE) {
                    $prod_category = new ProductCategory();
                    if ($id_item && $prod_category->get($id_item))
                        $data = array('name' => $prod_category->code, 'description' => getI18n($prod_category->name));
                }

                $image = new Image();
                $image->code = $image->code && trim($image->code) != '' ? $image->code : preg_replace("/.jpg|.png|.gif|.jpeg/", '', strtolower($target_file_name));
                $image->name = $image->name && trim($image->name) != '' ? $image->name : $data['name'];
                $image->description = $image->description && trim($image->description) != '' ? $image->description : $data['description'];
                $image->file = strtolower($target_file_name);
                $image->id_image_group = $img_group->id;
                
                if ($image->insert()) {
                    if (isset($product) && $product->id) {
                        $product->addPictureById($image->id);
                    }
                    elseif (isset($prod_category) && $prod_category->id)
                        $prod_category->addPictureById($image->id);
                }   
                
                echo '1'.(isset($str_warning) ? $str_warning : '');

            } else {

                // The file type wasn't allowed
                echo lang('err_wrong_file_type');

            }
        }
        
    }
    
}