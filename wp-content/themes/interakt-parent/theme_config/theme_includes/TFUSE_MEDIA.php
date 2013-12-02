<?php
if (!function_exists('tfuse_media')) :
/**
 * Display post media.
 * 
 * To override tfuse_media() in a child theme, add your own tfuse_media() 
 * to your child theme's file.
 */
function tfuse_media($return=false,$type)
{
    global $post;
    $template_directory = get_template_directory_uri();
    $sidebar_position = tfuse_sidebar_position();
    $tfuse_media['img_position'] = $tfuse_media['image'] = $tfuse_image = $tf_media_add_space = $output = '';
    $tfuse_media['img_dimensions'] = array();
    $tfuse_media['disable_listing_lightbox'] = tfuse_options('disable_listing_lightbox');
    $tfuse_media['disable_single_lightbox'] = tfuse_options('disable_single_lightbox');

    if (is_singular() )
    {
        $tfuse_media['video_link']              = tfuse_page_options('video_link');
        $tfuse_media['disable_video']           = tfuse_page_options('disable_video',tfuse_options('disable_video'));
        $tfuse_media['disable_image']           = tfuse_page_options('disable_image',tfuse_options('disable_image'));   

        if ( !$tfuse_media['disable_image'] )
        {
            $tfuse_media['image']               = tfuse_page_options('single_image',tfuse_page_options('thumbnail_image'));
            $tfuse_media['img_dimensions']      = tfuse_page_options('single_img_dimensions',tfuse_options('single_img_dimensions'));
            $tfuse_media['img_position']        = tfuse_page_options('single_img_position',tfuse_options('single_img_position'));
        }

        if ( !empty($tfuse_media['video_link'] ) && !$tfuse_media['disable_video'] )
        {
            $tfuse_media['video_dimensions']    = tfuse_page_options('video_dimensions',tfuse_options('video_dimensions'));
            $tfuse_media['video_position']      = tfuse_page_options('video_position',tfuse_options('video_position'));    

            if ( !empty($tfuse_media['image']) ) $tf_media_add_space = ' tf_media_add_space';

            $output .= '<div class="video_embed '.$tfuse_media['video_position'].'" style="width:'.$tfuse_media['video_dimensions'][0].'px">';
            $video = new TF_GET_EMBED();
            $output .= $video->width($tfuse_media['video_dimensions'][0])->height($tfuse_media['video_dimensions'][1])->source('video_link')->get();        //$output .= tfuse_get_embed($tfuse_media['media_width'], $tfuse_media['media_height'], PREFIX . "_post_video");
            $output .= '</div><!--/.video_embed  -->';
        }
    }
    elseif ( !is_singular() )
    {
            $tfuse_media['image']               = tfuse_page_options('thumbnail_image');
            $tfuse_media['img_dimensions']      = tfuse_page_options('thumbnail_dimensions',tfuse_options('thumbnail_dimensions'));
            $tfuse_media['img_position']        = tfuse_page_options('thumbnail_position',tfuse_options('thumbnail_position'));             
    }

    if ( !empty($tfuse_media['image']) )
    {           
        if(is_singular())
        { 
            
            if($type == 'blog')
            { 
                $image = new TF_GET_IMAGE();
                $tfuse_image = $image->width($tfuse_media['img_dimensions'][0])->height($tfuse_media['img_dimensions'][1])->
                properties(array('class'=>' '.$tfuse_media['img_position'].$tf_media_add_space))->src($tfuse_media['image'])->get_img();   
            }
        }
        elseif($type == 'blog')
        {  
            if($sidebar_position == 'full')
            {
                $image = new TF_GET_IMAGE();
                $tfuse_image = $image->width(433)->height(262)->
                properties(array('class'=>' '.$tf_media_add_space))->src($tfuse_media['image'])->get_img(); 
            }
            else
            { 
                $image = new TF_GET_IMAGE();
                $tfuse_image = $image->width(281)->height(170)->
                properties(array('class'=>' '.$tf_media_add_space))->src($tfuse_media['image'])->get_img(); 
            }
        }
        elseif($type == 'blog2')
        {  
            if($sidebar_position == 'full')
            {
                $image = new TF_GET_IMAGE();
                $tfuse_image = $image->width(898)->
                properties(array('class'=>' '.$tf_media_add_space))->src($tfuse_media['image'])->get_img(); 
            }
            else
            {
                $image = new TF_GET_IMAGE();
                $tfuse_image = $image->width(592)->height(301)->
                properties(array('class'=>' '.$tf_media_add_space))->src($tfuse_media['image'])->get_img(); 
            }
        }
        elseif($type == 'work')
        {  
            $image = new TF_GET_IMAGE();
            $tfuse_image = $image->width(281)->height(170)->
            properties(array('class'=>' '.$tf_media_add_space))->src($tfuse_media['image'])->get_img(); 
        }
             
    }
    elseif ( empty($tfuse_media['image']))
    {    
        $img = tfuse_page_options('single_image');
        $imgthumb =  tfuse_page_options('thumbnail_image');
        
        if($type == 'blog2')
        {  
            if(empty($imgthumb) && !empty($img))
            {
                if($sidebar_position == 'full')
                {
                    $image = new TF_GET_IMAGE();
                    $tfuse_image = $image->width(898)->
                    properties(array('class'=>' '.$tf_media_add_space))->src($img)->get_img(); 
                }
                else
                {
                    $image = new TF_GET_IMAGE();
                    $tfuse_image = $image->width(592)->height(301)->
                    properties(array('class'=>' '.$tf_media_add_space))->src($img)->get_img(); 
                }
            }
            elseif(empty($imgthumb) && empty($img))
            {
                if($sidebar_position == 'full')
                {
                    $tfuse_image = '<img src="'.$template_directory.'/images/dafault_image.jpg"  width="898">'; 
                }
                else
                {
                    $tfuse_image = '<img src="'.$template_directory.'/images/dafault_image.jpg" height="301" width="592">';
                }
            }
        }
        elseif($type == 'blog')
        {  
            $img = tfuse_page_options('single_image');
            $imgthumb =  tfuse_page_options('thumbnail_image');
            if(!is_singular())
            {
                if(empty($imgthumb) && !empty($img))
                {
                    if($sidebar_position == 'full')
                    {
                        $image = new TF_GET_IMAGE();
                        $tfuse_image = $image->width(433)->height(262)->
                        properties(array('class'=>' '.$tf_media_add_space))->src($img)->get_img(); 
                    }
                    else
                    {
                        $image = new TF_GET_IMAGE();
                        $tfuse_image = $image->width(281)->height(170)->
                        properties(array('class'=>' '.$tf_media_add_space))->src($img)->get_img(); 
                    }
                }
                elseif(empty($imgthumb) && empty($img))
                {
                    if($sidebar_position == 'full')
                    {
                        $tfuse_image = '<img src="'.$template_directory.'/images/dafault_image.jpg" width="433" height="262">'; 
                    }
                    else
                    {
                        $tfuse_image = '<img src="'.$template_directory.'/images/dafault_image.jpg" height="170" width="281">';
                    }
                }
            }
            else
            {
                return;
            }
        }
        elseif($type == 'work')
        {  
            $imgthumb =  tfuse_page_options('thumbnail_image');
            if(!is_singular())
            {
                if(empty($imgthumb))
                {
                    $tfuse_image = '<img src="'.$template_directory.'/images/dafault_image.jpg" height="170" width="281">';
                }
            }
            
            else
            {
                return;
            }
        }
    }
    
 if ( ( (!is_singular() && !$tfuse_media['disable_listing_lightbox']) || (is_singular() && !$tfuse_media['disable_single_lightbox']) ) && !empty($tfuse_image) )
    { 
        $attachments = get_children( array('post_parent' => $post->ID, 'numberposts' => -1, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
        $output .= '<span style="display:none">';
        if( !empty($attachments) )
        { 
            foreach ($attachments as $att_id => $attachment)
            {
                $tfuse_src = wp_get_attachment_image_src($att_id, 'full', true);
                $tfuse_image_link_attach = $tfuse_src[0];
                $output .= '<a href="'. $tfuse_image_link_attach.'" rel="prettyPhoto[gallery'.$post->ID.']" style="display:none">'.$tfuse_media['image'].'</a>';
            }
        }
        if ( !empty($tfuse_media['post_video']) ) $output .= '<a href="'. $tfuse_media['post_video'].'" rel="prettyPhoto[gallery'.$post->ID.']" >'.$tfuse_image.'</a>';
        $output .= '</span>';
        $output .= '<a href="'.$tfuse_media['image'].'" rel="prettyPhoto[gallery'.$post->ID.']">'.$tfuse_image.'</a>';
    }
    else
        $output .= '<a href="'.get_permalink($post->ID).'">'.$tfuse_image.'</a>';

    if( $return )
        return $output;
    else 
        echo $output;
}
endif; // tfuse_media

    