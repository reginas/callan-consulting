<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for posts area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    /* ----------------------------------------------------------------------------------- */
    /* Sidebar */
    /* ----------------------------------------------------------------------------------- */


    /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */

    /* Post Media */
    array('name' => 'Career Info',
        'id' => TF_THEME_PREFIX . '_media',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => 'Location',
        'desc' => 'Enter Location ',
        'id' => TF_THEME_PREFIX . '_location',
        'value' => '',
        'type' => 'text',
        'divider' => true
    ),
    array('name' => 'Departament',
        'desc' => 'Enter Departament',
        'id' => TF_THEME_PREFIX . '_depart',
        'value' => '',
        'type' => 'text',
        'divider' => true
    ),
    array('name' => 'Type',
        'desc' => 'Enter Type',
        'id' => TF_THEME_PREFIX . '_type',
        'value' => '',
        'type' => 'text',
        'divider' => true
    ),
    array('name' => 'Experience',
        'desc' => 'Enter min experience',
        'id' => TF_THEME_PREFIX . '_experience',
        'value' => '',
        'type' => 'text',
        'divider' => true
    ),
    array('name' => 'Apply To',
        'desc' => 'Specifies the Page the link goes to',
        'id' => TF_THEME_PREFIX . '_apply',
        'value' => '',
        'options' =>tfuse_list_page_options(),
        'type' => 'select'
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