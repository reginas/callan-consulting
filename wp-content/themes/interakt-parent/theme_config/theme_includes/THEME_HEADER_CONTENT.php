<?php

if ( ! function_exists( 'tfuse_header_content' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override tfuse_slider_type() in a child theme, add your own tfuse_slider_type to your child theme's
 * functions.php file.
 */

    function tfuse_header_content($location = false)
    { 
        global $TFUSE, $post,$is_tf_blog_page,$header_map1,$header_image2,$header_map2,$header_title2,$header_image1,$is_tf_front_page,$header_image,$header_title1,$header_map;
        $posts = $header_element = $header_map1=$header_image2=$slider = $header_map2=$header_another_element=$header_image1 = $header_title2= $header_image = $header_title1 = $header_map = null;
        if (!$location) return;
        switch ($location)
        { 
            case 'header' :
                if(is_front_page())
                {
                    $page_id = $post->ID;
                    $header_element = tfuse_options('header_element');
                    if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page')
                    {  
                        $header_element = tfuse_page_options('header_element','',$page_id);
                        if($page_id != 0 && tfuse_page_options('header_element','',$page_id)=='slider')
                            $slider = tfuse_page_options('select_slider','',$page_id);
                        elseif ( $page_id != 0 && tfuse_page_options('header_element','',$page_id) == 'title1')
                        {
                            $header_another_element = tfuse_page_options('another_header','',$page_id);
                            if ( 'image' == $header_another_element )
                            {  
                                $header_image1['image2'] = tfuse_page_options('image','',$page_id);
                            }
                            elseif ( 'map' == $header_another_element )
                            {
                                $header_map1['map2'] = tfuse_page_options('page_map','',$page_id);
                            }
                        }
                        elseif ($page_id != 0 && tfuse_page_options('header_element','',$page_id)== 'title2')
                        {
                            $header_title2['title'] = tfuse_page_options('header_title2','',$page_id);
                        
                            $header_another_element = tfuse_page_options('another_header2','',$page_id);
                            if ( 'image' == $header_another_element )
                            {  
                                $header_image2['image3'] = tfuse_page_options('image2','',$page_id);
                            }
                            elseif ( 'map' == $header_another_element )
                            {
                                $header_map2['map3'] = tfuse_page_options('page_map2','',$page_id); 
                            }                          
                        }
                        elseif ( $page_id != 0 && tfuse_page_options('header_element','',$page_id)=='image' )
                        {  
                            $header_image1['image2'] = tfuse_page_options('image3','',$page_id);
                        }
                        elseif ($page_id != 0 && tfuse_page_options('header_element','',$page_id) == 'map')
                        {  
                            $header_map['map'] = tfuse_page_options('page_map3','',$page_id);
                        }
                    }
                    else
                    {
                        $header_element = tfuse_options('header_element');
                        if ( 'slider' == $header_element )
                        {
                            $slider = tfuse_options('select_slider');
                        }
                        elseif ( 'title1' == $header_element )
                        {
                        $header_another_element = tfuse_options('another_header');
                        if ( 'image' == $header_another_element )
                        {  
                            $header_image1['image2'] = tfuse_options('image');
                        }
                        elseif ( 'map' == $header_another_element )
                        {
                            $header_map1['map2'] = tfuse_options('page_map');
                        }
                        }
                        elseif ( 'title2' == $header_element )
                        {
                            $header_title2['title'] = tfuse_options('header_title2');

                            $header_another_element = tfuse_options('another_header2');
                            if ( 'image' == $header_another_element )
                            {  
                                $header_image2['image3'] = tfuse_options('image2');
                            }
                            elseif ( 'map' == $header_another_element )
                            {
                                $header_map2['map3'] = tfuse_options('page_map2');
                            }
                        }
                        elseif ( 'image' == $header_element )
                        {
                            $header_image['image'] = tfuse_options('image3');
                        }
                        elseif ( 'map' == $header_element )
                        {
                            $header_map['map'] = tfuse_options('page_map3');
                        }
                    }
                    
                }
                elseif($is_tf_blog_page)
                {
                    $header_element = tfuse_options('header_element_blog');
                        if ( 'slider' == $header_element )
                        {
                            $slider = tfuse_options('select_slider_blog');
                        }
                        elseif ( 'title1' == $header_element )
                        {
                        $header_another_element = tfuse_options('another_header_blog');
                        if ( 'image' == $header_another_element )
                        {  
                            $header_image1['image2'] = tfuse_options('image_blog');
                        }
                        elseif ( 'map' == $header_another_element )
                        {
                            $header_map1['map2'] = tfuse_options('page_map_blog');
                        }
                        }
                        elseif ( 'title2' == $header_element )
                        {
                            $header_title2['title'] = tfuse_options('header_title2_blog');

                            $header_another_element = tfuse_options('another_header2_blog');
                            if ( 'image' == $header_another_element )
                            {  
                                $header_image2['image3'] = tfuse_options('image2_blog');
                            }
                            elseif ( 'map' == $header_another_element )
                            {
                                $header_map2['map3'] = tfuse_options('page_map2_blog');
                            }
                        }
                        elseif ( 'image' == $header_element )
                        {
                            $header_image['image'] = tfuse_options('image3_blog');
                        }
                        elseif ( 'map' == $header_element )
                        {
                            $header_map['map'] = tfuse_options('page_map3_blog');
                        }
                    
                }
                elseif ( is_singular() )
                {  
                    $ID = $post->ID;
                    $header_element = tfuse_page_options('header_element');
                    if ( 'slider' == $header_element )
                    {
                        $slider = tfuse_page_options('select_slider');
                    }
                    elseif ( 'title1' == $header_element )
                    {
                        $header_another_element = tfuse_page_options('another_header');
                        if ( 'image' == $header_another_element )
                        {  
                            $header_image1['image2'] = tfuse_page_options('image');
                        }
                        elseif ( 'map' == $header_another_element )
                        {
                            $header_map1['map2'] = tfuse_page_options('page_map');
                        }
                    }
                    elseif ( 'title2' == $header_element )
                    {
                        $header_title2['title'] = tfuse_page_options('header_title2');
                        
                        $header_another_element = tfuse_page_options('another_header2');
                        if ( 'image' == $header_another_element )
                        {  
                            $header_image2['image3'] = tfuse_page_options('image2');
                        }
                        elseif ( 'map' == $header_another_element )
                        {
                            $header_map2['map3'] = tfuse_page_options('page_map2');
                        }
                    }
                    elseif ( 'image' == $header_element )
                    {
                        $header_image['image'] = tfuse_page_options('image3');
                    }
                    elseif ( 'map' == $header_element )
                    {
                        $header_map['map'] = tfuse_page_options('page_map3');
                    }
                }
                elseif ( is_category() )
                {
                    $ID = get_query_var('cat');
                    $header_element = tfuse_options('header_element', null, $ID);
                    if ( 'slider' == $header_element )
                    {
                        $slider = tfuse_options('select_slider', null, $ID);
                    }
                    elseif ( 'title1' == $header_element )
                    {
                        $header_another_element = tfuse_options('another_header', null, $ID);
                        if ( 'image' == $header_another_element )
                        {  
                            $header_image1['image2'] = tfuse_options('image', null, $ID);
                        }
                        elseif ( 'map' == $header_another_element )
                        {
                            $header_map1['map2'] = tfuse_options('page_map', null, $ID);
                        }
                    }
                    elseif ( 'title2' == $header_element )
                    {
                        $header_title2['title'] = tfuse_options('header_title2', null, $ID);
                        
                        $header_another_element = tfuse_options('another_header2', null, $ID);
                        if ( 'image' == $header_another_element )
                        {  
                            $header_image2['image3'] = tfuse_options('image2', null, $ID);
                        }
                        elseif ( 'map' == $header_another_element )
                        {
                            $header_map2['map3'] = tfuse_options('page_map2', null, $ID);
                        }
                    }
                    elseif ( 'image' == $header_element )
                    {
                        $header_image['image'] = tfuse_options('image3', null, $ID);
                    }
                    elseif ( 'map' == $header_element )
                    {
                        $header_map['map'] = tfuse_options('page_map3', null, $ID);
                    }
                }
                elseif ( is_tax() )
                { 
                    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    $ID = $term->term_id;
                    $header_element = tfuse_options('header_element', null, $ID);
                    if ( 'slider' == $header_element )
                    {
                        $slider = tfuse_options('select_slider', null, $ID);
                    }
                    elseif ( 'title1' == $header_element )
                    {
                        $header_another_element = tfuse_options('another_header', null, $ID);
                        if ( 'image' == $header_another_element )
                        {  
                            $header_image1['image2'] = tfuse_options('image', null, $ID);
                        }
                        elseif ( 'map' == $header_another_element )
                        {
                            $header_map1['map2'] = tfuse_options('page_map', null, $ID);
                        }
                    }
                    elseif ( 'title2' == $header_element )
                    {
                        $header_title2['title'] = tfuse_options('header_title2', null, $ID);
                        
                        $header_another_element = tfuse_options('another_header2', null, $ID);
                        if ( 'image' == $header_another_element )
                        {  
                            $header_image2['image3'] = tfuse_options('image2', null, $ID);
                        }
                        elseif ( 'map' == $header_another_element )
                        {
                            $header_map2['map3'] = tfuse_options('page_map2', null, $ID);
                        }
                    }
                    elseif ( 'image' == $header_element )
                    {
                        $header_image['image'] = tfuse_options('image3', null, $ID);
                    }
                    elseif ( 'map' == $header_element )
                    {
                        $header_map['map'] = tfuse_options('page_map3', null, $ID);
                    }

                }
            break;
            case 'content' : 
                if($is_tf_front_page)
                {
                    $page_id = $post->ID;
                    $ID = $post->ID;
                    $header_element = tfuse_options('content_element');
                    if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page')
                    {
                        if($page_id!=0 && tfuse_page_options('content_element','',$page_id)=='slider')
                        $slider = tfuse_page_options('select_content_slider','',$page_id);
                    }
                    else{
                        if ( 'slider' == $header_element )
                            $slider = tfuse_options('select_content_slider');
                    }
                }
                elseif($is_tf_blog_page)
                {
                    $ID = $post->ID;
                    $header_element = tfuse_options('content_element_blog');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_content_slider_blog');
                }
                elseif ( is_singular() )
                { 
                    $ID = $post->ID;
                    $header_element = tfuse_page_options('content_element');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_page_options('select_content_slider');

                }
                elseif ( is_category() )
                {
                    $ID = get_query_var('cat');
                    $header_element = tfuse_options('content_element', null, $ID);
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_content_slider', null, $ID);
                }
                elseif ( is_tax() )
                { 
                    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    $ID = $term->term_id;
                    $header_element = tfuse_options('content_element', null, $ID);
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_content_slider', null, $ID);
                }
            break;
        } 
        if ( $header_element == 'map' )
        { 
            get_template_part( 'header', 'map' );
            return;
        }
        elseif( $header_element == 'title1')
        {   
            if ( 'image' == $header_another_element )
            { 
                get_template_part( 'header', 'image');
            }
            elseif ( 'map' == $header_another_element )
            {
                get_template_part( 'header', 'map' );
            }
            return;
        }
        elseif( $header_element == 'title2')
        {   
            get_template_part( 'header', 'title2');
            if ( 'image' == $header_another_element )
            { 
                get_template_part( 'header', 'image');
            }
            elseif ( 'map' == $header_another_element )
            {
                get_template_part( 'header', 'map' );
            }
            return;
        }
        elseif( $header_element == 'image')
        {
            get_template_part( 'header', 'image');
            return;
        }
        elseif ( !$slider )
            return;

        $slider = $TFUSE->ext->slider->model->get_slider($slider);

        switch ($slider['type']):

            case 'custom':

                if ( is_array($slider['slides']) ) :
                    $slider_image_resize = ( isset($slider['general']['slider_image_resize']) && $slider['general']['slider_image_resize'] == 'true' ) ? true : false;
                    foreach ($slider['slides'] as $k => $slide) : 
                        $image = new TF_GET_IMAGE();
                        if($slider['design'] == 'flexslider')
                        { 
                            $slider['slides'][$k]['slide_src'] = $image->width(960)->height(401)->src($slide['slide_src'])->resize($slider_image_resize)->get_src();   
                        }
                        else{ 
                            $slider['slides'][$k]['slide_src'] = $image->height(68)->src($slide['slide_src'])->resize($slider_image_resize)->get_src();   
                        }
                    endforeach;
                endif;

                break;

            case 'posts':
                $args = array( 'post__in' => explode(',',$slider['general']['posts_select']) );
                $slides_posts = array();
                $slides_posts = explode(',',$slider['general']['posts_select']);
                foreach($slides_posts as $slide_posts):
                    $posts[] = get_post($slide_posts);
                endforeach;
                $posts = array_reverse($posts);
                $args = apply_filters('tfuse_slider_posts_args', $args, $slider);
                $args = apply_filters('tfuse_slider_posts_args_'.$ID, $args, $slider);
                break;

            case 'tags':
                $args = array( 'tag__in' => explode(',',$slider['general']['tags_select']) );

                $args = apply_filters('tfuse_slider_tags_args', $args, $slider);
                $args = apply_filters('tfuse_slider_tags_args_'.$ID, $args, $slider);
                $posts = get_posts($args);
                break;

            case 'categories':
                $args = 'cat='.$slider['general']['categories_select'].
                        '&posts_per_page='.$slider['general']['sliders_posts_number'];

                $args = apply_filters('tfuse_slider_categories_args', $args, $slider);
                $args = apply_filters('tfuse_slider_categories_args_'.$ID, $args, $slider);
                $posts = get_posts($args);
                break;

        endswitch;

        if ( is_array($posts) ) :
            $slider['slides'] = tfuse_get_slides_from_posts($posts,$slider);
        endif;

        if ( !is_array($slider['slides']) ) return;

        include_once(locate_template( '/theme_config/extensions/slider/designs/'.$slider['design'].'/template.php' ));
    }

endif;
add_action('tfuse_header_content', 'tfuse_get_header_content');


if ( ! function_exists( 'tfuse_get_slides_from_posts' ) ):
/**
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override tfuse_slider_type() in a child theme, add your own tfuse_slider_type to your child theme's
 * functions.php file.
 */
    function tfuse_get_slides_from_posts( $posts=array(), $slider = array() )
    {
        global $post;
        
        $slides = array();
        $slider_image_resize = ( isset($slider['general']['slider_image_resize']) && $slider['general']['slider_image_resize'] == 'true' ) ? $slider['general']['slider_image_resize'] : false;
        
        
        foreach ($posts as $k => $post) : setup_postdata( $post );
		    setup_postdata( $post );
            $post->post_type;
            if ($post->post_type == 'post'){
                    $single_image = tfuse_page_options('single_image');
                    
                    if ( empty($single_image) ) continue;
                        $image = new TF_GET_IMAGE();
                        $tfuse_image = $image->width(960)->height(401)->src($single_image)->resize($slider_image_resize)->get_src();

                        $title = get_the_title($post->ID);
                        
                    if (mb_strlen($title, 'UTF-8') > 100)  $title = substr($title, 0 ,100) . '...';
                        $slides[$k]['slide_title'] = $title;
                        $slides[$k]['slide_src'] = $tfuse_image;
                        $slides[$k]['slide_url'] = get_permalink();
                        $slides[$k]['slide_description'] = get_the_excerpt();
		}
        endforeach;
        wp_reset_postdata();
        return $slides;
    }
endif;
