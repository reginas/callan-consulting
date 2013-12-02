<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for posts area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    /* ----------------------------------------------------------------------------------- */
    /* Sidebar */
    /* ----------------------------------------------------------------------------------- */

    /* Single Post */
    array('name' => 'Single Post',
        'id' => TF_THEME_PREFIX . '_side_media',
        'type' => 'metabox',
        'context' => 'side',
        'priority' => 'low' /* high/low */
    ),
    // Disable Single Post Image
    array('name' => 'Disable Image',
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_disable_image',
        'value' => tfuse_options('disable_image','false'),
        'type' => 'checkbox'
    ),
    // Disable Single Post Video
    array('name' => 'Disable Video',
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_disable_video',
        'value' => tfuse_options('disable_video','false'),
        'type' => 'checkbox',
        'divider' => true
    ),
     // Post Meta
    array('name' => 'Disable Meta',
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_disable_post_meta',
        'value' => tfuse_options('disable_post_meta','false'),
        'type' => 'checkbox'
    ),
    // Published Date
    array('name' => 'Disable Published Date',
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_disable_published_date',
        'value' => tfuse_options('disable_published_date','false'),
        'type' => 'checkbox'
    ),
    // Published Date
    array('name' => 'Disable Comments',
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_disable_coments',
        'value' => tfuse_options('disable_comments','false'),
        'type' => 'checkbox' 
    ),
    // Author Info
    array('name' => 'Disable Author Info',
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_disable_author_info',
        'value' => tfuse_options('disable_author_info','false'),
        'type' => 'checkbox',
        'divider' => true
    ),
    // Post Title
    array('name' => 'Post Title',
        'desc' => 'Select your preferred Post Title.',
        'id' => TF_THEME_PREFIX . '_page_title',
        'value' => 'default_title',
        'options' => array('hide_title' => 'Hide Post Title', 'default_title' => 'Default Title', 'custom_title' => 'Custom Title'),
        'type' => 'select'
    ),
    // Custom Title
    array('name' => 'Custom Title',
        'desc' => 'Enter your custom title for this post.',
        'id' => TF_THEME_PREFIX . '_custom_title',
        'value' => '',
        'type' => 'text'
    ),
    
    /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */

    /* Post Media */
    array('name' => 'Media',
        'id' => TF_THEME_PREFIX . '_media',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    // Single Image
    array('name' => 'Image',
        'desc' => 'This is the main image for your post. Upload one from your computer, or specify an online address for your image (Ex: http://yoursite.com/image.png).',
        'id' => TF_THEME_PREFIX . '_single_image',
        'value' => '',
        'type' => 'upload',
        'hidden_children' => array(
            TF_THEME_PREFIX . '_single_img_dimensions',
            TF_THEME_PREFIX . '_single_img_position'
        )
    ),
    // Single Image Dimensions
    array('name' => 'Image Resize (px)',
        'desc' => 'These are the default width and height values. If you want to resize the image change the values with your own. If you input only one, the image will get resized with constrained proportions based on the one you specified.',
        'id' => TF_THEME_PREFIX . '_single_img_dimensions',
        'value' => tfuse_options('single_image_dimensions'),
        'type' => 'textarray'
    ),
    // Single Image Position
    array('name' => 'Image Position',
        'desc' => 'Select your preferred image  alignment',
        'id' => TF_THEME_PREFIX . '_single_img_position',
        'value' => tfuse_options('single_image_position'),
        'options' => array(
            '' => array($url . 'full_width.png', 'Don\'t apply an alignment'),
            'alignleft' => array($url . 'left_off.png', 'Align to the left'),
            'alignright' => array($url . 'right_off.png', 'Align to the right')
            ),
        'type' => 'images',
        'divider' => true
    ),    
    // Thumbnail Image
    array('name' => 'Thumbnail',
        'desc' => 'This is the thumbnail for your post. Upload one from your computer, or specify an online address for your image (Ex: http://yoursite.com/image.png).',
        'id' => TF_THEME_PREFIX . '_thumbnail_image',
        'value' => '',
        'type' => 'upload',
        'divider' => true
        
    ),
    // Custom Post Video
    array('name' => 'Video',
        'desc' => 'Copy paste the video URL or embed code. The video URL works only for Vimeo and YouTube videos. Read <a target="_blank" href="http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/">prettyPhoto documentation</a>
                    for more info on how to add video or flash in this text area
                    ',
        'id' => TF_THEME_PREFIX . '_video_link',
        'value' => '',
        'type' => 'textarea',
        'hidden_children' => array(
            TF_THEME_PREFIX . '_video_dimensions',
            TF_THEME_PREFIX . '_video_position'
        )
    ),
    // Video Dimensions
    array('name' => 'Video Size (px)',
        'desc' => 'These are the default width and height values. If you want to resize the video change the values with your own. If you input only one, the video will get resized with constrained proportions based on the one you specified.',
        'id' => TF_THEME_PREFIX . '_video_dimensions',
        'value' => tfuse_options('video_dimensions'),
        'type' => 'textarray'
    ),
    // Video Position
    array('name' => 'Video Position',
        'desc' => 'Select your preferred video alignment',
        'id' => TF_THEME_PREFIX . '_video_position',
        'value' => tfuse_options('video_position'),
        'options' => array(
            '' => array($url . 'full_width.png', 'Don\'t apply an alignment'),
            'alignleft' => array($url . 'left_off.png', 'Align to the left'),
            'alignright' => array($url . 'right_off.png', 'Align to the right')
            ),
        'type' => 'images'
    ),   
    /* Header Options */
    array('name' => 'Header',
        'id' => TF_THEME_PREFIX . '_header_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    
      // Element of Hedear
    array('name' => 'Element of Hedear',
        'desc' => 'Select type of element on the header.',
        'id' => TF_THEME_PREFIX . '_header_element',
        'value' => 'without',
        'options' => array('without' => 'Without Header Element','slider' => 'Slider on Header','title1' => 'Header Title','title2' => 'Header Title','map' => 'Map on Header','image' => 'Image on Header'),
        'type' => 'select',
    ),
    
    // Select Header Slider
    $this->ext->slider->model->has_sliders() ?
            array(
        'name' => 'Slider',
        'desc' => 'Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.',
        'id' => TF_THEME_PREFIX . '_select_slider',
        'value' => '',
        'options' => $TFUSE->ext->slider->get_sliders_dropdown('flexslider'),
        'type' => 'select'
            ) :
            array(
        'name' => 'Slider',
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_select_slider',
        'value' => '',
        'html' => 'No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.',
        'type' => 'raw',
                'divider'=> true
            )
    ,
    //title in header
     array(
            'name'=>'Header Title',
            'desc'=>'Enter the title.',
            'id'=> TF_THEME_PREFIX . '_header_title1',
            'value' => '',
            'type' =>'text',
         'divider'=> true
    ),
    //title in header 2
     array(
            'name'=>'Header Title',
            'desc'=>'Enter the title.',
            'id'=> TF_THEME_PREFIX . '_header_title2',
            'value' => '',
            'type' =>'text',
         'divider'=> true
    ),
    // Element of Hedear
    array('name' => 'Another Hedear Element',
        'desc' => 'Select another type of element on the header.',
        'id' => TF_THEME_PREFIX . '_another_header',
        'value' => 'without',
        'options' => array('without' => 'Without Header Element','map' => 'Map on Header','image' => 'Image on Header'),
        'type' => 'select',
        'divider'=> true
    ),
    
    // Element of Hedear
    array('name' => 'Another Hedear Element',
        'desc' => 'Select another type of element on the header.',
        'id' => TF_THEME_PREFIX . '_another_header2',
        'value' => 'without',
        'options' => array('without' => 'Without Header Element','map' => 'Map on Header','image' => 'Image on Header'),
        'type' => 'select',
        'divider'=> true
    ),
    
    //title in header 2
     array(
            'name'=>'Title & Search',
            'desc'=>'Enter the title.',
            'id'=> TF_THEME_PREFIX . '_header_title_slider',
            'value' => '',
            'type' =>'text'
    ),
    //map on header
    array(
        'name' => 'Map position',
        'id' => TF_THEME_PREFIX . '_page_map',
        'value' => '',
        'type' => 'maps',
        'divider'=> true
    ),
    //map on header2
    array(
        'name' => 'Map position',
        'id' => TF_THEME_PREFIX . '_page_map2',
        'value' => '',
        'type' => 'maps',
        'divider'=> true
    ),
    //map on header3
    array(
        'name' => 'Map position',
        'id' => TF_THEME_PREFIX . '_page_map3',
        'value' => '',
        'type' => 'maps',
        'divider'=> true
    ),
    //image 
     array(
            'name'=>'Image on header',
            'desc'=>'Enter src.',
            'id'=> TF_THEME_PREFIX . '_image',
            'value' => '',
            'type' =>'upload',
         'divider'=> true
    ),
    
    //image 2
     array(
            'name'=>'Image on header',
            'desc'=>'Enter src.',
            'id'=> TF_THEME_PREFIX . '_image2',
            'value' => '',
            'type' =>'upload',
         'divider'=> true
    ),
    
    //image 3
     array(
            'name'=>'Image on header',
            'desc'=>'Enter src.',
            'id'=> TF_THEME_PREFIX . '_image3',
            'value' => '',
            'type' =>'upload',
         'divider'=> true
    ),
    //menu
     array(
            'name'=>'Custom Menu',
            'desc'=>'Choose menu.First 6 parent items will be displayed.',
            'id'=> TF_THEME_PREFIX . '_menu_header',
            'value' => '',
            'options' =>tfuse_list_menu(),
            'type' => 'select',
            'divider' => true
    ),
    //Services
     array(
            'name'=>'Element before Content',
            'desc'=>'Display Last 3 services posts.',
            'id'=> TF_THEME_PREFIX . '_last_services',
            'value' => '',
            'options' =>array('none' => 'None','services' => 'Latest 3 Services'),
            'type' => 'select',
            'divider' => true
    ),
     // Element of Content
    array('name' => 'Element of Content',
        'desc' => 'Select type of element in content.',
        'id' => TF_THEME_PREFIX . '_content_element',
        'value' => 'without',
        'options' => array('without' => 'Without Header Element','slider' => 'Slider in Content'),
        'type' => 'select',
    ),
    // Select Header Slider
    $this->ext->slider->model->has_sliders() ?
            array(
        'name' => 'Content Slider',
        'desc' => 'Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.',
        'id' => TF_THEME_PREFIX . '_select_content_slider',
        'value' => '',
        'options' => $TFUSE->ext->slider->get_sliders_dropdown('carousel'),
        'type' => 'select'
            ) :
            array(
        'name' => 'Slider',
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_select_content_slider',
        'value' => '',
        'html' => 'No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.',
        'type' => 'raw'
            )
    ,
    
    //Ads
    array('name' => 'Ads',
        'id' => TF_THEME_PREFIX . '_post_ads',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    //top ad
     array(
        'name'=>'Post Posts Ad the Same as Category',
        'desc'=>'The banners set in a specific category,will be displayed in all the article details from that category.',
        'id'=> TF_THEME_PREFIX . '_content_ads_post',
        'value' => 'true',
        'type' =>'checkbox',
         'divider' => true
    ),
    array('name' => 'Enable 728x90 banner ',
            'desc' => 'Enable the top banner space. Note: you can set a specific banner for all categories and posts in the <a href="' . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>',
            'id' => TF_THEME_PREFIX . '_top_ad_space',
            'value' => 'false',
            'options' => array('false' => 'No', 'true' => 'Yes'),
            'type' => 'select',
    ),
    array(
            'name'=>'Ad image(728px x 90px)',
            'desc'=>'Enter the URL to the ad image 728x90 location',
            'id'=> TF_THEME_PREFIX . '_top_ad_image',
            'value' => '',
            'type' =>'upload'
    ),
    array(
            'name'=>'Ad URL',
            'desc'=>'Enter the URL where this ad points to.',
            'id'=> TF_THEME_PREFIX . '_top_ad_url',
            'value' => '',
            'type' =>'text'
    ),
    array(
            'name'=>'Adsense code',
            'desc'=>'Enter your adsense code (or other ad network code) here.',
            'id'=> TF_THEME_PREFIX . '_top_ad_adsense',
            'value' => '',
            'type' =>'textarea',
            'divider' => true
    ),

    //125x125 ad
    array('name' => 'Enable 125x125 banners',
            'desc' => 'Enable before content banner space. Note: you can set specific banners for all categories and posts in the <a href="' . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>',
            'id' => TF_THEME_PREFIX . '_bfcontent_ads_space',
            'value' => 'false',
            'options' => array('false' => 'No', 'true' => 'Yes'),
            'type' => 'select'
    ),
    array('name' => 'Type of ads',
            'desc' => 'Choose the type of your adds.',
            'id' => TF_THEME_PREFIX . '_bfcontent_type',
            'value' => 'image',
            'options' => array('image' => 'Image Type', 'adsense' => 'Adsense Type'),
            'type' => 'select'
    ),
    array('name' => 'No of 125x125 ads',
            'desc' => 'Choose the numbers of ads to display before content.',
            'id' => TF_THEME_PREFIX . '_bfcontent_number',
            'value' => '7',
            'options' => array('one' => '1', 'two' => '2' , 'three' => '3', 'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7'),
            'type' => 'select'
    ),
    array(
            'name'=>'Ad image (125px x 125px)',
            'desc'=>'Enter the URL to the ad image 125x125 location',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image1',
            'value' => '',
            'type' =>'upload'
    ),
    array(
            'name'=>'Ad URL',
            'desc'=>'Enter the URL where this ad points to.',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url1',
            'value' => '',
            'type' =>'text'
    ),
    array(
            'name'=>'Adsense code for before content ads',
            'desc'=>'Enter your adsense code (or other ad network code) here.',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense1',
            'value' => '',
            'type' =>'textarea'
    ),
    array(
            'name'=>'Ad image (125px x 125px)',
            'desc'=>'Enter the URL to the ad image 125x125 location',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image2',
            'value' => '',
            'type' =>'upload'
    ),
    array(
            'name'=>'Ad URL',
            'desc'=>'Enter the URL where this ad points to.',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url2',
            'value' => '',
            'type' =>'text'
    ),
    array(
            'name'=>'Adsense code for before content ads',
            'desc'=>'Enter your adsense code (or other ad network code) here.',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense2',
            'value' => '',
            'type' =>'textarea'
    ),
    array(
            'name'=>'Ad image (125px x 125px)',
            'desc'=>'Enter the URL to the ad image 125x125 location',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image3',
            'value' => '',
            'type' =>'upload'
    ),
    array(
            'name'=>'Ad URL',
            'desc'=>'Enter the URL where this ad points to.',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url3',
            'value' => '',
            'type' =>'text'
    ),
    array(
            'name'=>'Adsense code for before content ads',
            'desc'=>'Enter your adsense code (or other ad network code) here.',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense3',
            'value' => '',
            'type' =>'textarea'
    ),
    array(
            'name'=>'Ad image (125px x 125px)',
            'desc'=>'Enter the URL to the ad image 125x125 location',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image4',
            'value' => '',
            'type' =>'upload'
    ),
    array(
            'name'=>'Ad URL',
            'desc'=>'Enter the URL where this ad points to.',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url4',
            'value' => '',
            'type' =>'text'
    ),
    array(
            'name'=>'Adsense code for before content ads',
            'desc'=>'Enter your adsense code (or other ad network code) here.',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense4',
            'value' => '',
            'type' =>'textarea'
    ),
    array(
            'name'=>'Ad image (125px x 125px)',
            'desc'=>'Enter the URL to the ad image 125x125 location',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image5',
            'value' => '',
            'type' =>'upload'
    ),
    array(
            'name'=>'Ad URL',
            'desc'=>'Enter the URL where this ad points to.',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url5',
            'value' => '',
            'type' =>'text'
    ),
    array(
            'name'=>'Adsense code for before content ads',
            'desc'=>'Enter your adsense code (or other ad network code) here.',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense5',
            'value' => '',
            'type' =>'textarea'
    ),
    array(
            'name'=>'Ad image (125px x 125px)',
            'desc'=>'Enter the URL to the ad image 125x125 location',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image6',
            'value' => '',
            'type' =>'upload'
    ),
    array(
            'name'=>'Ad URL',
            'desc'=>'Enter the URL where this ad points to.',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url6',
            'value' => '',
            'type' =>'text'
    ),
    array(
            'name'=>'Adsense code for before content ads',
            'desc'=>'Enter your adsense code (or other ad network code) here.',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense6',
            'value' => '',
            'type' =>'textarea'
    ),
    array(
            'name'=>'Ad image (125px x 125px)',
            'desc'=>'Enter the URL to the ad image 125x125 location',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image7',
            'value' => '',
            'type' =>'upload'
    ),
    array(
            'name'=>'Ad URL',
            'desc'=>'Enter the URL where this ad points to.',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url7',
            'value' => '',
            'type' =>'text'
    ),
    array(
            'name'=>'Adsense code for before content ads',
            'desc'=>'Enter your adsense code (or other ad network code) here.',
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense7',
            'value' => '',
            'type' =>'textarea',
            'divider' => true
    ),
    //468x60 ad
    array('name' => 'Enable 468x60 banner ',
            'desc' => 'Enable after content banner space. Note: you can set a specific banner for all categories and posts in the <a href="' . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>',
            'id' => TF_THEME_PREFIX . '_hook_space',
            'value' => 'false',
            'options' => array('false' => 'No', 'true' => 'Yes'),
            'type' => 'select',
    ),
    array(
            'name'=>'Ad image(468px x 60px)',
            'desc'=>'Enter the URL to the ad image 468x60 location',
            'id'=> TF_THEME_PREFIX . '_hook_image',
            'value' => '',
            'type' =>'upload'
    ),
    array(
            'name'=>'Ad URL',
            'desc'=>'Enter the URL where this ad points to.',
            'id'=> TF_THEME_PREFIX . '_hook_url',
            'value' => '',
            'type' =>'text'
    ),
    array(
            'name'=>'Adsense code',
            'desc'=>'Enter your adsense code (or other ad network code) here.',
            'id'=> TF_THEME_PREFIX . '_hook_adsense',
            'value' => '',
            'type' =>'textarea',
    ),
    /* Content Options */
    array('name' => 'Content Options',
        'id' => TF_THEME_PREFIX . '_content_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
     array(
            'name'=>'Custom Menu Icon',
            'desc'=>'Upload icon.',
            'id'=> TF_THEME_PREFIX . '_icon',
            'value' => '',
            'type' =>'upload',
         'divider'=> true
    ),
    // Top Shortcodes
    array('name' => 'Shortcodes before Content',
        'desc' => 'In this textarea you can input your prefered custom shotcodes.',
        'id' => TF_THEME_PREFIX . '_content_top',
        'value' => '',
        'type' => 'textarea'
    ),
    array('name' => 'Shortcodes after Content',
        'desc' => 'In this textarea you can input your prefered custom shotcodes.',
        'id' => TF_THEME_PREFIX . '_content_bottom',
        'value' => '',
        'type' => 'textarea'
    )
);

?>