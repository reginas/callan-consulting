<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for admin area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    'tabs' => array(
        array(
            'name' => 'General',
            'type' => 'tab',
            'id' => TF_THEME_PREFIX . '_general',
            'headings' => array(
                array(
                    'name' => 'General Settings',
                    'options' => array(/* 1 */
                        // Custom Logo Option
                        array(
                            'name' => 'Custom Logo',
                            'desc' => 'Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)',
                            'id' => TF_THEME_PREFIX . '_logo',
                            'value' => '',
                            'type' => 'upload'
                        ),
                        
                        // Custom Favicon Option
                        array(
                            'name' => 'Custom Favicon <br /> (16px x 16px)',
                            'desc' => 'Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon.',
                            'id' => TF_THEME_PREFIX . '_favicon',
                            'value' => '',
                            'type' => 'upload',
                            'divider' => true
                        ),
                        // 
                        array('name' => 'Theme Color',
                            'desc' => 'This will change the color of certain elements and links in order to give your theme a different flavor',
                            'id' => TF_THEME_PREFIX . '_theme_color',
                            'value' => '',
                            'type' => 'colorpicker'
                        ),
                        array('name' => 'Overlay Text Color',
                            'desc' => 'This controls the text color that appears over the theme color',
                            'id' => TF_THEME_PREFIX . '_text_color',
                            'value' => '',
                            'type' => 'colorpicker',
                            'divider' => true
                        ),
                        array(
                            'name' => 'Disable Header Box',
                            'desc' => 'Disable header box',
                            'id' => TF_THEME_PREFIX . '_header_box_frame',
                            'value' => 'false',
                            'type' => 'checkbox'
                        ),
                        array(
                            'name' => 'Header Box Title',
                            'desc' => 'Give a title',
                            'id' => TF_THEME_PREFIX . '_box_title_frame',
                            'value' => 'LET\'S DO IT',
                            'type' => 'text'
                        ),
                        array('name' => 'Header Box Type',
                            'desc' => ' Select header box type',
                            'id' => TF_THEME_PREFIX . '_box_type_frame',
                            'value' => 'white',
                            'options' => array('white' => 'White', 'orange' => 'Orange'),
                            'type' => 'select'
                        ),
                         array(
                            'name' => 'Header Box URL',
                            'desc' => 'Enter the URL where this box points to',
                            'id' => TF_THEME_PREFIX . '_box_url_frame',
                            'value' => '',
                            'type' => 'text',
                             'divider' => true
                        ),
                        array(
                            'name' => 'Disable Date',
                            'desc' => 'Disable date across the site.',
                            'id' => TF_THEME_PREFIX . '_date_time',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        
                        // Tracking Code Option
                        array(
                            'name' => 'Tracking Code',
                            'desc' => 'Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.',
                            'id' => TF_THEME_PREFIX . '_google_analytics',
                            'value' => '',
                            'type' => 'textarea',
                            'divider' => true
                        ),
                        // Custom CSS Option
                        array(
                            'name' => 'Custom CSS',
                            'desc' => 'Quickly add some CSS to your theme by adding it to this block.',
                            'id' => TF_THEME_PREFIX . '_custom_css',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    ) /* E1 */
                ),
                array(
                    'name' => 'RSS',
                    'options' => array(
                        // RSS URL Option
                        array('name' => 'RSS URL',
                            'desc' => 'Enter your preferred RSS URL. (Feedburner or other)',
                            'id' => TF_THEME_PREFIX . '_feedburner_url',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true
                        ),
                        // E-Mail URL Option
                        array('name' => 'E-Mail URL',
                            'desc' => 'Enter your preferred E-mail subscription URL. (Feedburner or other)',
                            'id' => TF_THEME_PREFIX . '_feedburner_id',
                            'value' => '',
                            'type' => 'text'
                        )
                    )
                ),
                array(
                    'name' => 'Twitter',
                    'options' => array(
                        array(
                            'name' => 'Consumer Key',
                            'desc' => 'Set your <a href="http://screencast.com/t/zHu17C7nXy1">twitter</a> application <a href="http://screencast.com/t/yb44HiF2NZ">consumer key</a>.',
                            'id' => TF_THEME_PREFIX . '_twitter_consumer_key',
                            'value' => 'XW7t8bECoR6ogYtUDNdjiQ',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => 'Consumer Secret',
                            'desc' => 'Set your <a href="http://screencast.com/t/zHu17C7nXy1">twitter</a> application <a href="http://screencast.com/t/eaKJHG1omN">consumer secret key</a>.',
                            'id' => TF_THEME_PREFIX . '_twitter_consumer_secret',
                            'value' => 'Z7UzuWU8a4obyOOlIguuI4a5JV4ryTIPKZ3POIAcJ9M',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => 'User Token',
                            'desc' => 'Set your <a href="http://screencast.com/t/zHu17C7nXy1">twitter</a> application <a href="http://screencast.com/t/QEEG2O4H">access token key</a>.',
                            'id' => TF_THEME_PREFIX . '_twitter_user_token',
                            'value' => '1510587853-ugw6uUuNdNMdGGDn7DR4ZY4IcarhstIbq8wdDud',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => 'User Secret',
                            'desc' => 'Set your <a href="http://screencast.com/t/zHu17C7nXy1">twitter</a>  application <a href="http://screencast.com/t/Yv7nwRGsz">access token secret key</a>.',
                            'id' => TF_THEME_PREFIX . '_twitter_user_secret',
                            'value' => '7aNcpOUGtdKKeT1L72i3tfdHJWeKsBVODv26l9C0Cc',
                            'type' => 'text'
                        )
                    )
                ),
                array(
                    'name' => 'Disable Theme settings',
                    'options' => array(
                        // Disable Image for All Single Posts
                        array('name' => 'Image on Single Post',
                            'desc' => 'Disable Image on All Single Posts? These settings may be overridden for individual articles.',
                            'id' => TF_THEME_PREFIX . '_disable_image',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable Video for All Single Posts
                        array('name' => 'Video on Single Post',
                            'desc' => 'Disable Video on All Single Posts? These settings may be overridden for individual articles.',
                            'id' => TF_THEME_PREFIX . '_disable_video',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable Comments for All Posts
                        array('name' => 'Post Comments',
                            'desc' => 'Disable Comments for All Posts? These settings may be overridden for individual articles.',
                            'id' => TF_THEME_PREFIX . '_disable_posts_comments',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable Comments for All Pages
                        array('name' => 'Page Comments',
                            'desc' => 'Disable Comments for All Pages? These settings may be overridden for individual articles.',
                            'id' => TF_THEME_PREFIX . '_disable_pages_comments',
                            'value' => 'true',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable Author Info
                        array('name' => 'Author Info',
                            'desc' => 'Disable Author Info? These settings may be overridden for individual articles.',
                            'id' => TF_THEME_PREFIX . '_disable_author_info',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable Post Meta
                        array('name' => 'Post meta',
                            'desc' => 'Disable Post meta? These settings may be overridden for individual articles.',
                            'id' => TF_THEME_PREFIX . '_disable_post_meta',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable Post Published Date
                        array('name' => 'Post Published Date',
                            'desc' => 'Disable Post Published Date? These settings may be overridden for individual articles.',
                            'id' => TF_THEME_PREFIX . '_disable_published_date',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable posts lightbox (prettyPhoto) Option
                        array('name' => 'prettyPhoto on Categories',
                            'desc' => 'Disable opening image and attachemnts in prettyPhoto on Categories listings? If YES, image link go to post.',
                            'id' => TF_THEME_PREFIX . '_disable_listing_lightbox',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable posts lightbox (prettyPhoto) Option
                        array('name' => 'prettyPhoto on Single Post',
                            'desc' => 'Disable opening image and attachemnts in prettyPhoto on Single Post?',
                            'id' => TF_THEME_PREFIX . '_disable_single_lightbox',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable preloadCssImages plugin
                        array('name' => 'preloadCssImages',
                            'desc' => 'Disable jQuery-Plugin "preloadCssImages"? This plugin loads automatic all images from css.If you prefer performance(less requests) deactivate this plugin.',
                            'id' => TF_THEME_PREFIX . '_disable_preload_css',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'on_update' => 'reload_page',
                            'divider' => true
                        ),
                        // Disable SEO
                        array('name' => 'SEO Tab',
                            'desc' => 'Disable SEO option?',
                            'id' => TF_THEME_PREFIX . '_disable_tfuse_seo_tab',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'on_update' => 'reload_page',
                            'divider' => true
                        ),
                        // Enable Dynamic Image Resizer Option
                        array('name' => 'Dynamic Image Resizer',
                            'desc' => 'This will Disable the thumb.php script that dynamicaly resizes images on your site. We recommend you keep this enabled, however note that for this to work you need to have "GD Library" installed on your server. This should be done by your hosting server administrator.',
                            'id' => TF_THEME_PREFIX . '_disable_resize',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        array('name' => 'Image from content',
                            'desc' => 'If no thumbnail is specified then the first uploaded image in the post is used.',
                            'id' => TF_THEME_PREFIX . '_enable_content_img',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Remove wordpress versions for security reasons
                        array(
                            'name' => 'Remove Wordpress Versions',
                            'desc' => 'Remove Wordpress versions from the source code, for security reasons.',
                            'id' => TF_THEME_PREFIX . '_remove_wp_versions',
                            'value' => FALSE,
                            'type' => 'checkbox'
                        )
                    )
                ),
                array(
                    'name' => 'WordPress Admin Style',
                    'options' => array(
                        // Disable Themefuse Style
                        array('name' => 'Disable Themefuse Style',
                            'desc' => 'Disable Themefuse Style',
                            'id' => TF_THEME_PREFIX . '_deactivate_tfuse_style',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'on_update' => 'reload_page'
                        )
                    )
                )
            )
        ),
        array(
            'name' => 'Homepage',
            'id' => TF_THEME_PREFIX . '_homepage',
            'headings' => array(
                array(
                    'name' => 'Homepage Population',
                    'options' => array(
                        array('name' => 'Homepage Population',
                            'desc' => ' Select which categories to display on homepage. More over you can choose to load a specific page or change the number of posts on the homepage from <a target="_blank" href="' . network_admin_url('options-reading.php') . '">here</a>',
                            'id' => TF_THEME_PREFIX . '_homepage_category',
                            'value' => '',
                            'options' => array('all' => 'From All Categories', 'specific' => 'From Specific Categories','page' =>'From Specific Page'),
                            'type' => 'select',
                            'install' => 'cat'
                        ),
                        array(
                            'name' => 'Select specific categories to display on homepage',
                            'desc' => 'Pick one or more 
                            categories by starting to type the category name.',
                            'id' => TF_THEME_PREFIX . '_categories_select_categ',
                            'type' => 'multi',
                            'subtype' => 'category',
                        ),
                        // page on homepage
                        array('name' => 'Select Page',
                            'desc' => 'Select the page',
                            'id' => TF_THEME_PREFIX . '_home_page',
                            'value' => 'image',
                            'options' =>tfuse_list_page_options(),
                            'type' => 'select',
                        ),
                        array('name' => 'Use page options',
                            'desc' => 'Use page options',
                            'id' => TF_THEME_PREFIX . '_use_page_options',
                            'value' => 'false',
                            'type' => 'checkbox'
                        )
                    )
                ),
                array(
                    'name' => 'Homepage Header',
                    'options' => array(
                        

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
                            'desc' => '',
                            'id' => TF_THEME_PREFIX . '_page_map',
                            'value' => '',
                            'type' => 'maps',
                            'divider'=> true
                        ),
                        //map on header2
                        array(
                            'name' => 'Map position',
                            'desc' => '',
                            'id' => TF_THEME_PREFIX . '_page_map2',
                            'value' => '',
                            'type' => 'maps',
                            'divider'=> true
                        ),
                        //map on header3
                        array(
                            'name' => 'Map position',
                            'desc' => '',
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
                    )
                ),
                array(
                    'name' => 'Homepage Banners',
                    'options' => array(
                        //top ad
                        array('name' => 'Enable 728x90 Banner ',
                            'desc' => 'Enable the top banner ad space. Note: you can set a specific banner for all categories and posts in the <a href="' . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>',
                            'id' => TF_THEME_PREFIX . '_home_top_ad_space',
                            'value' => 'false',
                            'options' => array('false' => 'No', 'true' => 'Yes'),
                            'type' => 'select',
                        ),
                        array(
                            'name'=>'Ad Image(728px x 90px)',
                            'desc'=>'Enter the URL to the ad image 728x90 location',
                            'id'=> TF_THEME_PREFIX . '_home_top_ad_image',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>'Ad URL',
                            'desc'=>'Enter the URL where this ad points to.',
                            'id'=> TF_THEME_PREFIX . '_home_top_ad_url',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>'Adsense Code',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_home_top_ad_adsense',
                            'value' => '',
                            'type' =>'textarea',
                        ),
                        //Advertising
                        array('name' => 'Enable 125x125 Banners',
                            'desc' => 'Enable before content banner space. Note: you can set specific banners for all categories and posts in the <a href="' . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>',
                            'id' => TF_THEME_PREFIX . '_home_bfcontent_ads_space',
                            'value' => 'false',
                            'options' => array('false' => 'No', 'true' => 'Yes'),
                            'type' => 'select'
                        ),
                        array('name' => 'Type of Ads',
                            'desc' => 'Choose the type of your adds.',
                            'id' => TF_THEME_PREFIX . '_home_bfcontent_type',
                            'value' => 'image',
                            'options' => array('image' => 'Image Type', 'adsense' => 'Adsense Type'),
                            'type' => 'select'
                        ),
                        array('name' => 'No of 125x125 Ads',
                            'desc' => 'Choose the numbers of ads to display before content.',
                            'id' => TF_THEME_PREFIX . '_home_bfcontent_number',
                            'value' => '7',
                            'options' => array('one' => '1', 'two' => '2' , 'three' => '3', 'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7'),
                            'type' => 'select'
                        ),
                        array(
                            'name'=>'Ad Image (125px x 125px)',
                            'desc'=>'Enter the URL to the ad image 125x125 location',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image1',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>'Ad URL',
                            'desc'=>'Enter the URL where this ad points to.',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url1',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>'Adsense Code for Before Content Ads',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense1',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>'Ad Image (125px x 125px)',
                            'desc'=>'Enter the URL to the ad image 125x125 location',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image2',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>'Ad URL',
                            'desc'=>'Enter the URL where this ad points to.',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url2',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>'Adsense Code for Before Content Ads',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense2',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>'Ad Image (125px x 125px)',
                            'desc'=>'Enter the URL to the ad image 125x125 location',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image3',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>'Ad URL',
                            'desc'=>'Enter the URL where this ad points to.',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url3',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>'Adsense Code for Before Content Ads',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense3',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>'Ad Image (125px x 125px)',
                            'desc'=>'Enter the URL to the ad image 125x125 location',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image4',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>'Ad URL',
                            'desc'=>'Enter the URL where this ad points to.',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url4',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>'Adsense Code for Before Content Ads',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense4',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>'Ad Image (125px x 125px)',
                            'desc'=>'Enter the URL to the ad image 125x125 location',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image5',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>'Ad URL',
                            'desc'=>'Enter the URL where this ad points to.',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url5',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>'Adsense Code for Before Content Ads',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense5',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>'Ad Image (125px x 125px)',
                            'desc'=>'Enter the URL to the ad image 125x125 location',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image6',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>'Ad URL',
                            'desc'=>'Enter the URL where this ad points to.',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url6',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>'Adsense Code for Before Content Ads',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense6',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>'Ad Image (125px x 125px)',
                            'desc'=>'Enter the URL to the ad image 125x125 location',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image7',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>'Ad URL',
                            'desc'=>'Enter the URL where this ad points to.',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url7',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>'Adsense Code for Before Content Ads',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense7',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        //hook manager
                        array('name' => 'Enable 468x60 Banner ',
                            'desc' => 'Enable after content banner space. Note: you can set a specific banner for all categories and posts in the <a href="' . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>',
                            'id' => TF_THEME_PREFIX . '_home_hook_space',
                            'value' => 'false',
                            'options' => array('false' => 'No', 'true' => 'Yes'),
                            'type' => 'select',
                        ),
                        array(
                            'name'=>'Ad Image(468px x 60px)',
                            'desc'=>'Enter the URL to the ad image 468x60 location',
                            'id'=> TF_THEME_PREFIX . '_home_hook_image',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>'Ad URL',
                            'desc'=>'Enter the URL where this ad points to.',
                            'id'=> TF_THEME_PREFIX . '_home_hook_url',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>'Adsense Code',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_home_hook_adsense',
                            'value' => '',
                            'type' =>'textarea',
                        )
                    )
                ),
                array(
                    'name' => 'Homepage Shortcodes',
                    'options' => array(
                        // Top Shortcodes
                        array('name' => 'Shortcodes before Content',
                            'desc' => 'In this textarea you can input your prefered custom shotcodes.',
                            'id' => TF_THEME_PREFIX . '_content_top',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Bottom Shortcodes
                        array('name' => 'Shortcodes after Content',
                            'desc' => 'In this textarea you can input your prefered custom shotcodes.',
                            'id' => TF_THEME_PREFIX . '_content_bottom',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    )
                )
            )
        ),
        array(
            'name' => 'Blog',
            'id' => TF_THEME_PREFIX . '_blogpage',
            'headings' => array(
                array(
                    'name' => 'Blog Page Population',
                    'options' => array(
                        // Select the Blog Page
                        array('name' => 'Select Blog Page',
                            'desc' => 'Select the blog page',
                            'id' => TF_THEME_PREFIX . '_blog_page',
                            'value' => 'image',
                            'options' => tfuse_list_page_options(),
                            'type' => 'select',
                            'divider' => true
                        ),
                        array('name' => 'Blog Page Population',
                            'desc' => ' Select which categories to display on blogpage. More over you can choose to load a specific page or change the number of posts on the blogpage from <a target="_blank" href="' . network_admin_url('options-reading.php') . '">here</a>',
                            'id' => TF_THEME_PREFIX . '_blogpage_category',
                            'value' => '',
                            'options' => array('all' => 'From All Categories', 'specific' => 'From Specific Categories'),
                            'type' => 'select',
                            'install' => 'cat'
                        ),
                        array(
                            'name' => 'Select specific categories to display on blogpage',
                            'desc' => 'Pick one or more
                            categories by starting to type the category name.',
                            'id' => TF_THEME_PREFIX . '_categories_select_categ_blog',
                            'type' => 'multi',
                            'subtype' => 'category',
                        )
                    )
                ),
                array(
                    'name' => 'Blog Page Header',
                    'options' => array(
                        
                        // Element of Hedear
                        array('name' => 'Element of Hedear',
                            'desc' => 'Select type of element on the header.',
                            'id' => TF_THEME_PREFIX . '_header_element_blog',
                            'value' => 'without',
                            'options' => array('without' => 'Without Header Element','slider' => 'Slider on Header','title1' => 'Header Title','title2' => 'Header Title','map' => 'Map on Header','image' => 'Image on Header'),
                            'type' => 'select',
                        ),

                        // Select Header Slider
                        $this->ext->slider->model->has_sliders() ?
                                array(
                            'name' => 'Slider',
                            'desc' => 'Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.',
                            'id' => TF_THEME_PREFIX . '_select_slider_blog',
                            'value' => '',
                            'options' => $TFUSE->ext->slider->get_sliders_dropdown('flexslider'),
                            'type' => 'select'
                                ) :
                                array(
                            'name' => 'Slider',
                            'desc' => '',
                            'id' => TF_THEME_PREFIX . '_select_slider_blog',
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
                                'id'=> TF_THEME_PREFIX . '_header_title1_blog',
                                'value' => '',
                                'type' =>'text',
                             'divider'=> true
                        ),
                        //title in header 2
                         array(
                                'name'=>'Header Title',
                                'desc'=>'Enter the title.',
                                'id'=> TF_THEME_PREFIX . '_header_title2_blog',
                                'value' => '',
                                'type' =>'text',
                             'divider'=> true
                        ),
                        // Element of Hedear
                        array('name' => 'Another Hedear Element',
                            'desc' => 'Select another type of element on the header.',
                            'id' => TF_THEME_PREFIX . '_another_header_blog',
                            'value' => 'without',
                            'options' => array('without' => 'Without Header Element','map' => 'Map on Header','image' => 'Image on Header'),
                            'type' => 'select',
                            'divider'=> true
                        ),

                        // Element of Hedear
                        array('name' => 'Another Hedear Element',
                            'desc' => 'Select another type of element on the header.',
                            'id' => TF_THEME_PREFIX . '_another_header2_blog',
                            'value' => 'without',
                            'options' => array('without' => 'Without Header Element','map' => 'Map on Header','image' => 'Image on Header'),
                            'type' => 'select',
                            'divider'=> true
                        ),

                        //title in header 2
                         array(
                                'name'=>'Title & Search',
                                'desc'=>'Enter the title.',
                                'id'=> TF_THEME_PREFIX . '_header_title_slider_blog',
                                'value' => '',
                                'type' =>'text'
                        ),
                        //map on header
                        array(
                            'name' => 'Map position',
                            'desc' => '',
                            'id' => TF_THEME_PREFIX . '_page_map_blog',
                            'value' => '',
                            'type' => 'maps',
                            'divider'=> true
                        ),
                        //map on header2
                        array(
                            'name' => 'Map position',
                            'desc' => '',
                            'id' => TF_THEME_PREFIX . '_page_map2_blog',
                            'value' => '',
                            'type' => 'maps',
                            'divider'=> true
                        ),
                        //map on header3
                        array(
                            'name' => 'Map position',
                            'desc' => '',
                            'id' => TF_THEME_PREFIX . '_page_map3_blog',
                            'value' => '',
                            'type' => 'maps',
                            'divider'=> true
                        ),
                        //image 
                         array(
                                'name'=>'Image on header',
                                'desc'=>'Enter src.',
                                'id'=> TF_THEME_PREFIX . '_image_blog',
                                'value' => '',
                                'type' =>'upload',
                             'divider'=> true
                        ),

                        //image 2
                         array(
                                'name'=>'Image on header',
                                'desc'=>'Enter src.',
                                'id'=> TF_THEME_PREFIX . '_image2_blog',
                                'value' => '',
                                'type' =>'upload',
                             'divider'=> true
                        ),

                        //image 3
                         array(
                                'name'=>'Image on header',
                                'desc'=>'Enter src.',
                                'id'=> TF_THEME_PREFIX . '_image3_blog',
                                'value' => '',
                                'type' =>'upload',
                             'divider'=> true
                        ),
                        //menu
                         array(
                                'name'=>'Custom Menu',
                                'desc'=>'Choose menu.First 6 parent items will be displayed.',
                                'id'=> TF_THEME_PREFIX . '_menu_header_blog',
                                'value' => '',
                                'options' =>tfuse_list_menu(),
                                'type' => 'select',
                                'divider' => true
                        ),
                        //Services
                        array(
                               'name'=>'Element before Content',
                               'desc'=>'Display Last 3 services posts.',
                               'id'=> TF_THEME_PREFIX . '_last_services_blog',
                               'value' => '',
                               'options' =>array('none' => 'None','services' => 'Latest 3 Services'),
                               'type' => 'select',
                               'divider' => true
                       ),
                         // Element of Content
                        array('name' => 'Element of Content',
                            'desc' => 'Select type of element in content.',
                            'id' => TF_THEME_PREFIX . '_content_element_blog',
                            'value' => 'without',
                            'options' => array('without' => 'Without Header Element','slider' => 'Slider in Content'),
                            'type' => 'select',
                        ),
                        // Select Header Slider
                        $this->ext->slider->model->has_sliders() ?
                                array(
                            'name' => 'Content Slider',
                            'desc' => 'Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.',
                            'id' => TF_THEME_PREFIX . '_select_content_slider_blog',
                            'value' => '',
                            'options' => $TFUSE->ext->slider->get_sliders_dropdown('carousel'),
                            'type' => 'select'
                                ) :
                                array(
                            'name' => 'Slider',
                            'desc' => '',
                            'id' => TF_THEME_PREFIX . '_select_content_slider_blog',
                            'value' => '',
                            'html' => 'No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.',
                            'type' => 'raw'
                                )
                    )
                ),
                array(
                    'name' => 'Blog Page Banners',
                    'options' => array(
                        //top ad
                        array('name' => 'Enable 728x90 banner ',
                            'desc' => 'Enable the top banner ad space. Note: you can set a specific banner for all categories and posts in the <a href="' . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>',
                            'id' => TF_THEME_PREFIX . '_blog_top_ad_space',
                            'value' => 'false',
                            'options' => array('false' => 'No', 'true' => 'Yes'),
                            'type' => 'select',
                        ),
                        array(
                            'name'=>'Ad image(728px x 90px)',
                            'desc'=>'Enter the URL to the ad image 728x90 location',
                            'id'=> TF_THEME_PREFIX . '_blog_top_ad_image',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>'Ad URL',
                            'desc'=>'Enter the URL where this ad points to.',
                            'id'=> TF_THEME_PREFIX . '_blog_top_ad_url',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>'Adsense code',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_blog_top_ad_adsense',
                            'value' => '',
                            'type' =>'textarea',
                        ),
                        //Advertising
                        array('name' => 'Enable 125x125 banners',
                            'desc' => 'Enable before content banner space. Note: you can set specific banners for all categories and posts in the <a href="' . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>',
                            'id' => TF_THEME_PREFIX . '_blog_bfcontent_ads_space',
                            'value' => 'false',
                            'options' => array('false' => 'No', 'true' => 'Yes'),
                            'type' => 'select'
                        ),
                        array('name' => 'Type of ads',
                            'desc' => 'Choose the type of your adds.',
                            'id' => TF_THEME_PREFIX . '_blog_bfcontent_type',
                            'value' => 'image',
                            'options' => array('image' => 'Image Type', 'adsense' => 'Adsense Type'),
                            'type' => 'select'
                        ),
                        array('name' => 'No of 125x125 ads',
                            'desc' => 'Choose the numbers of ads to display before content.',
                            'id' => TF_THEME_PREFIX . '_blog_bfcontent_number',
                            'value' => '7',
                            'options' => array('one' => '1', 'two' => '2' , 'three' => '3', 'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7'),
                            'type' => 'select'
                        ),
                        array(
                            'name'=>'Ad image (125px x 125px)',
                            'desc'=>'Enter the URL to the ad image 125x125 location',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image1',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>'Ad URL',
                            'desc'=>'Enter the URL where this ad points to.',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url1',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>'Adsense code for before content ads',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense1',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>'Ad image (125px x 125px)',
                            'desc'=>'Enter the URL to the ad image 125x125 location',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image2',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>'Ad URL',
                            'desc'=>'Enter the URL where this ad points to.',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url2',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>'Adsense code for before content ads',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense2',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>'Ad image (125px x 125px)',
                            'desc'=>'Enter the URL to the ad image 125x125 location',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image3',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>'Ad URL',
                            'desc'=>'Enter the URL where this ad points to.',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url3',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>'Adsense code for before content ads',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense3',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>'Ad image (125px x 125px)',
                            'desc'=>'Enter the URL to the ad image 125x125 location',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image4',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>'Ad URL',
                            'desc'=>'Enter the URL where this ad points to.',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url4',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>'Adsense code for before content ads',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense4',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>'Ad image (125px x 125px)',
                            'desc'=>'Enter the URL to the ad image 125x125 location',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image5',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>'Ad URL',
                            'desc'=>'Enter the URL where this ad points to.',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url5',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>'Adsense code for before content ads',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense5',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>'Ad image (125px x 125px)',
                            'desc'=>'Enter the URL to the ad image 125x125 location',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image6',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>'Ad URL',
                            'desc'=>'Enter the URL where this ad points to.',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url6',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>'Adsense code for before content ads',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense6',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>'Ad image (125px x 125px)',
                            'desc'=>'Enter the URL to the ad image 125x125 location',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image7',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>'Ad URL',
                            'desc'=>'Enter the URL where this ad points to.',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url7',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>'Adsense code for before content ads',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense7',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        //hook manager
                        array('name' => 'Enable 468x60 banner ',
                            'desc' => 'Enable after content banner space. Note: you can set a specific banner for all categories and posts in the <a href="' . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>',
                            'id' => TF_THEME_PREFIX . '_blog_hook_space',
                            'value' => 'false',
                            'options' => array('false' => 'No', 'true' => 'Yes'),
                            'type' => 'select',
                        ),
                        array(
                            'name'=>'Ad image(468px x 60px)',
                            'desc'=>'Enter the URL to the ad image 468x60 location',
                            'id'=> TF_THEME_PREFIX . '_blog_hook_image',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>'Ad URL',
                            'desc'=>'Enter the URL where this ad points to.',
                            'id'=> TF_THEME_PREFIX . '_blog_hook_url',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>'Adsense code',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_blog_hook_adsense',
                            'value' => '',
                            'type' =>'textarea',
                        )
                    )
                ),
                array(
                    'name' => 'Blog Page Shortcodes',
                    'options' => array(
                        array('name' => 'Shortcodes before Content',
                            'desc' => 'In this textarea you can input your prefered custom shotcodes.',
                            'id' => TF_THEME_PREFIX . '_blog_content_top',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Bottom Shortcodes
                        array('name' => 'Shortcodes after Content',
                            'desc' => 'In this textarea you can input your prefered custom shotcodes.',
                            'id' => TF_THEME_PREFIX . '_blog_content_bottom',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    )
                ),
            )
        ),
        array(
            'name' => 'Posts',
            'id' => TF_THEME_PREFIX . '_posts',
            'headings' => array(
                array(
                    'name' => 'Default Post Options',
                    'options' => array(
                        // Post Content
                        array('name' => 'Post Content',
                            'desc' => 'Select if you want to show the full content (use <em>more</em> tag) or the excerpt on posts listings (categories).',
                            'id' => TF_THEME_PREFIX . '_post_content',
                            'value' => 'excerpt',
                            'options' => array('excerpt' => 'The Excerpt', 'content' => 'Full Content'),
                            'type' => 'select',
                            'divider' => true
                        ),
                        // Single Image Position
                        array('name' => 'Image Position',
                            'desc' => 'Select your preferred image alignment',
                            'id' => TF_THEME_PREFIX . '_single_image_position',
                            'value' => 'alignleft',
                            'type' => 'images',
                            'options' => array('alignleft' => array($url . 'left_off.png', 'Align to the left'), 'alignright' => array($url . 'right_off.png', 'Align to the right'))
                        ),
                        // Single Image Dimensions
                        array('name' => 'Image Resize (px)',
                            'desc' => 'These are the default width and height values. If you want to resize the image change the values with your own. If you input only one, the image will get resized with constrained proportions based on the one you specified.',
                            'id' => TF_THEME_PREFIX . '_single_image_dimensions',
                            'value' => array(590, 300),
                            'type' => 'textarray',
                            'divider' => true
                        ),
                        // Video Position
                        array('name' => 'Video Position',
                            'desc' => 'Select your preferred video alignment',
                            'id' => TF_THEME_PREFIX . '_video_position',
                            'value' => 'alignleft',
                            'type' => 'images',
                            'options' => array('alignleft' => array($url . 'left_off.png', 'Align to the left'), 'alignright' => array($url . 'right_off.png', 'Align to the right'))
                        ),
                        // Video Dimensions
                        array('name' => 'Video Resize (px)',
                            'desc' => 'These are the default width and height values. If you want to resize the video change the values with your own. If you input only one, the video will get resized with constrained proportions based on the one you specified.',
                            'id' => TF_THEME_PREFIX . '_video_dimensions',
                            'value' => array(590, 300),
                            'type' => 'textarray'
                        )
                    )
                )
            )
        ),
        array(
            'name' => 'Footer',
            'id' => TF_THEME_PREFIX . '_footer',
            'headings' => array(
                array(
                    'name' => 'Footer Content',
                    'options' => array(
                        array('name' => 'Left Copyright',
                            'desc' => 'Change  Footer Left Copyright',
                            'id' => TF_THEME_PREFIX . '_footer_left_copyright',
                            'value' => '',
                            'type' => 'text'
                        ),
                        array('name' => 'Right Copyright',
                            'desc' => 'Change  Footer Right Copyright',
                            'id' => TF_THEME_PREFIX . '_footer_right_copyright',
                            'value' => '',
                            'type' => 'text'
                        )
                    )
                )
            )
        ),
        array(
            'name' => 'Ads',
            'id' => TF_THEME_PREFIX . '_adds',
            'headings' => array(
                array(
                    'name' => '728 x 90 General Ad Options',
                    'options' => array(

                        array('name' => 'Disable the ad',
                            'desc' => 'Disable the 728x90 ad across the website.',
                            'id' => TF_THEME_PREFIX . '_top_ads_space',
                            'value' => 'true',
                            'type' => 'checkbox',
                        ),
                        array(
                            'name'=>'Ad Image (728px x 90px)',
                            'desc'=>'This banner will appear across the website if you don\'t specify otherwise from the posts categories.',
                            'id'=> TF_THEME_PREFIX . '_top_ads_image',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>'Ad URL',
                            'desc'=>'Enter the URL where this ad points to.',
                            'id'=> TF_THEME_PREFIX . '_top_ads_url',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>'Adsense Code',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_top_ads_adsense',
                            'value' => '',
                            'type' =>'textarea'
                        )
                    ),

                ),
                array(
                    'name' => '125 x 125 General Ad Options',
                    'options' => array(

                        array('name' => 'Disable the ad',
                            'desc' => 'Disable the 125x125 ad across the website.',
                            'id' => TF_THEME_PREFIX . '_bfc_ads_space',
                            'value' => 'true',
                            'type' => 'checkbox',
                        ),
                      
                    array('name' => 'Type of ads',
                            'desc' => 'Choose the type of your adds.',
                            'id' => TF_THEME_PREFIX . '_bfcontent_type1',
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
                            'name'=>'Adsense Code',
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
                            'name'=>'Adsense Code',
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
                            'name'=>'Adsense Code',
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
                            'name'=>'Adsense Code',
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
                            'name'=>'Adsense Code',
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
                            'name'=>'Adsense Code',
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
                            'name'=>'Adsense Code',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense7',
                            'value' => '',
                            'type' =>'textarea'
                    ),

                    )
                ),
                array(
                    'name' => '468 x 60 General Ad Options',
                    'options' => array(

                        array('name' => 'Disable the ad',
                            'desc' => 'Disable the 468x60 ad across the website.',
                            'id' => TF_THEME_PREFIX . '_content_ads_space',
                            'value' => 'true',
                            'type' => 'checkbox',
                        ),
                        array(
                            'name'=>'Ad Image (468px x 60px)',
                            'desc'=>'This banner will appear across the website if you don\'t specify otherwise from the posts categories.',
                            'id'=> TF_THEME_PREFIX . '_hook_image_admin',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>'Ad URL',
                            'desc'=>'Enter the URL where this ad points to.',
                            'id'=> TF_THEME_PREFIX . '_hook_url_admin',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>'Adsense Code',
                            'desc'=>'Enter your adsense code (or other ad network code) here.',
                            'id'=> TF_THEME_PREFIX . '_hook_adsense_admin',
                            'value' => '',
                            'type' =>'textarea'
                        )
						
                    )
                )
            )
        )
    )
);

?>