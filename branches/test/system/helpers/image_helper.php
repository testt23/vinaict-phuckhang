<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('watermark'))
{
    function watermark($source_image, $config = array()) {
      
       #
       # $sourcefile = Filename of the picture to be watermarked.
       # $watermarkfile = Filename of the 24-bit PNG watermark file.
       #
        
        if (count($config) == 0)
            return false;
        
        if (!defined('WM_ENABLED') || !WM_ENABLED) {
            MessageHandler::add(lang('err_watermark_disabled'), MSG_ERROR, MESSAGE_ONLY);
            return false;
        }
        
        if ($config['wm_type'] != 'overlay')
            return false;

        if ($source_image == '') {
            MessageHandler::add(lang('err_invalid_source_image'), MSG_ERROR, MESSAGE_ONLY);
            return false;
        }

        if (!file_exists(realpath($source_image))) {
            MessageHandler::add(lang('err_image_source_not_found'), MSG_ERROR, MESSAGE_ONLY);
            return false;
        }

        $config = array();
        $config['image_library'] = config_item('image_library');
        $config['source_image'] = $source_image;
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
       
       //Get the resource ids of the pictures
       $watermarkfile_id = imagecreatefrompng($config['wm_overlay_path']);
       
       imageAlphaBlending($watermarkfile_id, false);
       imageSaveAlpha($watermarkfile_id, true);
    
       $fileType = strtolower(substr($source_image, strlen($source_image)-3));
    
       switch($fileType) {
           case('gif'):
               $sourcefile_id = imagecreatefromgif($source_image);
               break;
               
           case('png'):
               $sourcefile_id = imagecreatefrompng($source_image);
               break;
               
           default:
               $sourcefile_id = imagecreatefromjpeg($source_image);
       }
    
       //Get the sizes of both pix  
      $sourcefile_width=imageSX($sourcefile_id);
      $sourcefile_height=imageSY($sourcefile_id);
      $watermarkfile_width=imageSX($watermarkfile_id);
      $watermarkfile_height=imageSY($watermarkfile_id);
      
      switch($config['wm_vrt_alignment']) {
          case 'top':
              $dest_y = 5;
              break;
          case 'middle':
              $dest_y = ($sourcefile_height - $watermarkfile_height) / 2;
              break;
          case 'bottom':
              $dest_y = $sourcefile_height - $watermarkfile_height - 5;
              break;
          default:
              $dest_y = $sourcefile_height - $watermarkfile_height - 5;
              
      }
      
      switch($config['wm_hor_alignment']) {
          case 'left':
              $dest_x = 5;
              break;
          case 'center':
              $dest_x = ($sourcefile_width - $watermarkfile_width) / 2;
              break;
          case 'right':
              $dest_x = $sourcefile_width - $watermarkfile_width - 5;
              break;
          default:
              $dest_x = $sourcefile_width - $watermarkfile_width - 5;
      }
       
       
       // if a gif, we have to upsample it to a truecolor image
       if($fileType == 'gif') {
           // create an empty truecolor container
           $tempimage = imagecreatetruecolor($sourcefile_width, $sourcefile_height);
           
           // copy the 8-bit gif into the truecolor image
           imagecopy($tempimage, $sourcefile_id, 0, 0, 0, 0,
                               $sourcefile_width, $sourcefile_height);
           
           // copy the source_id int
           $sourcefile_id = $tempimage;
       }
    
       imagecopy($sourcefile_id, $watermarkfile_id, $dest_x, $dest_y, 0, 0,
                           $watermarkfile_width, $watermarkfile_height);
    
       //Create a jpeg out of the modified picture
       switch($fileType) {
       
           // remember we don't need gif any more, so we use only png or jpeg.
           // See the upsaple code immediately above to see how we handle gifs
           case('png'):
               imagepng ($sourcefile_id, $source_image);
               break;
               
           default:
               imagejpeg ($sourcefile_id, $source_image);
       }          
      
       imagedestroy($sourcefile_id);
       imagedestroy($watermarkfile_id);
       
       
    }

}

