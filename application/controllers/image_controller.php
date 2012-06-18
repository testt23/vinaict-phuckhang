<?php

class Image_controller extends CI_Controller {
    
    function process() {
        
        //if (User::isAccessAble($this->session->userdata('userID'), 'image/process')) {
            
            $str_config = $this->input->get('config');

            $config = unserialize(urldecode($str_config));
            
            $config['upload_path'] = realpath(config_item('upload_path')).'/images/'.$config['group_code'].'/';
            $config['source_image'] = $config['upload_path'].$config['source_image'];
            $config['new_image'] = $config['upload_path'].$config['new_image'];

            $this->load->library('image_lib', $config);

            if ($this->image_lib->resize())
                echo '[1]';
            else
                echo '[0]'.$this->image_lib->display_errors();
            
        //}
        //else {
            //echo '[0]'.lang('msg_not_granted_this_page');
        //}
        
    }

    function uploadifive($group_code = '') {

        if (!empty($_FILES)) {
            
            $group_code = $group_code != '' ? $group_code.'/' : '';
            
            $config = array();
                    
            $upload_path = defined('UPLOAD_IMAGE_URL') ? UPLOAD_IMAGE_URL : config_item('upload_path').'images';

            $config['upload_path'] = realpath($upload_path).'/'.$group_code;

            if (!file_exists($config['upload_path'])) {
                mkdir($config['upload_path']);
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
                $targetFile = $uploadDir . $targetFile;

                // Save the file
                move_uploaded_file($tempFile,$targetFile);
                echo 1;

            } else {

                // The file type wasn't allowed
                echo lang('err_wrong_file_type');

            }
        }
        
    }
    
}