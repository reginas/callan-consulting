jQuery(document).ready(function($) {

        

    jQuery('.over_thumb ').bind('click', function(){
 
       window.setTimeout(function(){
           var sel = jQuery('#slider_design_type').val(); 
           if(sel == 'carousel'){
               jQuery('#slider_type').html('<option value="">Choose your slider type</option><option value="custom">Manually, I\'ll upload the images myself</option>');
            }
           else
            {
                jQuery('#slider_type').html('<option value="">Choose your slider type</option><option value="custom">Manually, I\'ll upload the images myself</option><option value="categories">Automatically, fetch images from categories</option><option value="tags">Automatically, fetch images by tags</option><option value="posts">Automatically, fetch images from posts</option>');
             }
               
       },12);
    });

//hide header options if homepage_category  is different from tfuse_blog_posts or  tfuse_blog_cases
    if(jQuery('#interakt_as_freebies').not(':checked')) jQuery('.interakt_attach').hide();
     if(jQuery('#interakt_as_freebies').is(':checked')) jQuery('.interakt_attach').show();
 	jQuery('#interakt_as_freebies').live('change',function () {
	if(jQuery(this).is(':checked'))
		jQuery('.interakt_attach').show();
	else
		jQuery('.interakt_attach').hide();
    });

    if(jQuery('#interakt_top_ads_space').is(':checked')) jQuery('.interakt_top_ads_image,.interakt_top_ads_url,.interakt_top_ads_adsense').hide();
 	jQuery('#interakt_top_ads_space').live('change',function () {
	if(jQuery(this).is(':checked'))
		jQuery('.interakt_top_ads_image,.interakt_top_ads_url,.interakt_top_ads_adsense').hide();
	else
		jQuery('.interakt_top_ads_image,.interakt_top_ads_url,.interakt_top_ads_adsense').show();
    });
	
	if(jQuery('#interakt_bfc_ads_space').is(':checked')) jQuery('.interakt_bfcontent_type1,.interakt_bfcontent_number,.interakt_bfcontent_ads_image1,.interakt_bfcontent_ads_url1,.interakt_bfcontent_ads_image2,.interakt_bfcontent_ads_url2,.interakt_bfcontent_ads_image3,.interakt_bfcontent_ads_url3,.interakt_bfcontent_ads_image4,.interakt_bfcontent_ads_url4,.interakt_bfcontent_ads_image5,.interakt_bfcontent_ads_url5,.interakt_bfcontent_ads_image6,.interakt_bfcontent_ads_url6,.interakt_bfcontent_ads_image7,.interakt_bfcontent_ads_url7,.interakt_bfcontent_ads_adsense1,.interakt_bfcontent_ads_adsense2,.interakt_bfcontent_ads_adsense3,.interakt_bfcontent_ads_adsense4,.interakt_bfcontent_ads_adsense5,.interakt_bfcontent_ads_adsense6,.interakt_bfcontent_ads_adsense7').hide();
 	jQuery('#interakt_bfc_ads_space').live('change',function () {
	if(jQuery(this).is(':checked'))
		jQuery('.interakt_bfcontent_type1,.interakt_bfcontent_number,.interakt_bfcontent_ads_image1,.interakt_bfcontent_ads_url1,.interakt_bfcontent_ads_image2,.interakt_bfcontent_ads_url2,.interakt_bfcontent_ads_image3,.interakt_bfcontent_ads_url3,.interakt_bfcontent_ads_image4,.interakt_bfcontent_ads_url4,.interakt_bfcontent_ads_image5,.interakt_bfcontent_ads_url5,.interakt_bfcontent_ads_image6,.interakt_bfcontent_ads_url6,.interakt_bfcontent_ads_image7,.interakt_bfcontent_ads_url7,.interakt_bfcontent_ads_adsense1,.interakt_bfcontent_ads_adsense2,.interakt_bfcontent_ads_adsense3,.interakt_bfcontent_ads_adsense4,.interakt_bfcontent_ads_adsense5,.interakt_bfcontent_ads_adsense6,.interakt_bfcontent_ads_adsense7').hide();
	else
		jQuery('.interakt_bfcontent_type1,.interakt_bfcontent_number,.interakt_bfcontent_ads_image1,.interakt_bfcontent_ads_url1,.interakt_bfcontent_ads_url1,.interakt_bfcontent_ads_image2,.interakt_bfcontent_ads_url2,.interakt_bfcontent_ads_image3,.interakt_bfcontent_ads_url3,.interakt_bfcontent_ads_image4,.interakt_bfcontent_ads_url4,.interakt_bfcontent_ads_image5,.interakt_bfcontent_ads_url5,.interakt_bfcontent_ads_image6,.interakt_bfcontent_ads_url6,.interakt_bfcontent_ads_image7,.interakt_bfcontent_ads_url7,.interakt_bfcontent_ads_adsense1,.interakt_bfcontent_ads_adsense2,.interakt_bfcontent_ads_adsense3,.interakt_bfcontent_ads_adsense4,.interakt_bfcontent_ads_adsense5,.interakt_bfcontent_ads_adsense6,.interakt_bfcontent_ads_adsense7').show();
    });
		
	if(jQuery('#interakt_content_ads_space').is(':checked')) jQuery('.interakt_hook_image_admin,.interakt_hook_url_admin,.interakt_hook_adsense_admin').hide();
 	jQuery('#interakt_content_ads_space').live('change',function () {
	if(jQuery(this).is(':checked'))
		jQuery('.interakt_hook_image_admin,.interakt_hook_url_admin,.interakt_hook_adsense_admin').hide();
	else
		jQuery('.interakt_hook_image_admin,.interakt_hook_url_admin,.interakt_hook_adsense_admin').show();
    });
    
    //from posts
    if(jQuery('#interakt_content_ads_post').is(':checked')) 
	{
		jQuery('.interakt_top_ad_space,.interakt_bfcontent_ads_space,.interakt_hook_space,.interakt_top_ad_image,.interakt_top_ad_url,.interakt_top_ad_adsense,.interakt_hook_image,.interakt_hook_url,.interakt_hook_adsense,.interakt_bfcontent_ads_image1,.interakt_bfcontent_ads_url1,.interakt_bfcontent_ads_adsense1,.interakt_bfcontent_ads_image2,.interakt_bfcontent_ads_url2,.interakt_bfcontent_ads_adsense2,.interakt_bfcontent_ads_image3,.interakt_bfcontent_ads_url3,.interakt_bfcontent_ads_adsense3,.interakt_bfcontent_ads_image4,.interakt_bfcontent_ads_url4,.interakt_bfcontent_ads_adsense4,.interakt_bfcontent_ads_image5,.interakt_bfcontent_ads_url5,.interakt_bfcontent_ads_adsense5,.interakt_bfcontent_ads_image6,.interakt_bfcontent_ads_url6,.interakt_bfcontent_ads_adsense6,.interakt_bfcontent_ads_image7,.interakt_bfcontent_ads_url7,.interakt_bfcontent_ads_adsense7,.interakt_bfcontent_type,.interakt_bfcontent_number').hide();
		jQuery('.interakt_content_ads_post,.interakt_bfcontent_ads_adsense7,.interakt_top_ad_adsense').next().removeClass('divider');
	}
	jQuery('#interakt_content_ads_post').live('change',function () {
		if(jQuery(this).is(':checked')){
			jQuery('.interakt_top_ad_space,.interakt_bfcontent_ads_space,.interakt_hook_space,.interakt_top_ad_image,.interakt_top_ad_url,.interakt_top_ad_adsense,.interakt_hook_image,.interakt_hook_url,.interakt_hook_adsense,.interakt_bfcontent_ads_image1,.interakt_bfcontent_ads_url1,.interakt_bfcontent_ads_adsense1,.interakt_bfcontent_ads_image2,.interakt_bfcontent_ads_url2,.interakt_bfcontent_ads_adsense2,.interakt_bfcontent_ads_image3,.interakt_bfcontent_ads_url3,.interakt_bfcontent_ads_adsense3,.interakt_bfcontent_ads_image4,.interakt_bfcontent_ads_url4,.interakt_bfcontent_ads_adsense4,.interakt_bfcontent_ads_image5,.interakt_bfcontent_ads_url5,.interakt_bfcontent_ads_adsense5,.interakt_bfcontent_ads_image6,.interakt_bfcontent_ads_url6,.interakt_bfcontent_ads_adsense6,.interakt_bfcontent_ads_image7,.interakt_bfcontent_ads_url7,.interakt_bfcontent_ads_adsense7,.interakt_bfcontent_type,.interakt_bfcontent_number').hide();
			jQuery('.interakt_content_ads_post,.interakt_bfcontent_ads_adsense7,.interakt_top_ad_adsense').next().removeClass('divider');
		}
		else
		{
			jQuery('.interakt_top_ad_space,.interakt_bfcontent_ads_space,.interakt_hook_space,.interakt_top_ad_adsense,.interakt_top_ad_image,.interakt_top_ad_url,.interakt_top_ad_adsense,.interakt_hook_image,.interakt_hook_url,.interakt_hook_adsense,.interakt_bfcontent_ads_image1,.interakt_bfcontent_ads_url1,.interakt_bfcontent_ads_adsense1,.interakt_bfcontent_ads_image2,.interakt_bfcontent_ads_url2,.interakt_bfcontent_ads_adsense2,.interakt_bfcontent_ads_image3,.interakt_bfcontent_ads_url3,.interakt_bfcontent_ads_adsense3,.interakt_bfcontent_ads_image4,.interakt_bfcontent_ads_url4,.interakt_bfcontent_ads_adsense4,.interakt_bfcontent_ads_image5,.interakt_bfcontent_ads_url5,.interakt_bfcontent_ads_adsense5,.interakt_bfcontent_ads_image6,.interakt_bfcontent_ads_url6,.interakt_bfcontent_ads_adsense6,.interakt_bfcontent_ads_image7,.interakt_bfcontent_ads_url7,.interakt_bfcontent_ads_adsense7,.interakt_bfcontent_type,.interakt_bfcontent_number').show();
			jQuery('.interakt_content_ads_post,.interakt_bfcontent_ads_adsense7,.interakt_top_ad_adsense').next().addClass('divider');
		}
	});
        
        
        if(jQuery('#interakt_header_box').is(':checked')) jQuery('.interakt_box_title,.interakt_box_type,.interakt_box_url').hide();
 	jQuery('#interakt_header_box').live('change',function () {
	if(jQuery(this).is(':checked'))
		jQuery('.interakt_box_title,.interakt_box_type,.interakt_box_url').hide();
	else
		jQuery('.interakt_box_title,.interakt_box_type,.interakt_box_url').show();
         });
         
         if(jQuery('#interakt_header_box_frame').is(':checked')) jQuery('.interakt_box_title_frame,.interakt_box_type_frame,.interakt_box_url_frame').hide();
 	jQuery('#interakt_header_box_frame').live('change',function () {
	if(jQuery(this).is(':checked'))
		jQuery('.interakt_box_title_frame,.interakt_box_type_frame,.interakt_box_url_frame').hide();
	else
		jQuery('.interakt_box_title_frame,.interakt_box_type_frame,.interakt_box_url_frame').show();
         });
         
         if(jQuery('#interakt_header_box_blog').is(':checked')) jQuery('.interakt_box_title_blog,.interakt_box_type_blog,.interakt_box_url_blog').hide();
 	jQuery('#interakt_header_box_blog').live('change',function () {
	if(jQuery(this).is(':checked'))
		jQuery('.interakt_box_title_blog,.interakt_box_type_blog,.interakt_box_url_blog').hide();
	else
		jQuery('.interakt_box_title_blog,.interakt_box_type_blog,.interakt_box_url_blog').show();
         });

 jQuery('.tfuse_selectable_code').live('click', function () {
        var r = document.createRange();
        var w = jQuery(this).get(0);
        r.selectNodeContents(w);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(r);
    });
    jQuery(document).bind({
        contact_form_preview_open:function(){
        var params = {
            changedEl: ".select_styled",
            visRows: 5,
            scrollArrows: true
        }
        cuSel(params);
        jQuery(".input_styled input").customInput();
    },
        reservationform_preview:function(){
            var params = {
                changedEl: ".select_styled",
                visRows: 5,
                scrollArrows: true
            }
            cuSel(params);
            jQuery(".input_styled input").customInput();
        }
    });
    jQuery('#tf_rf_form_name_select').change(function(){
        jQuery_get=getUrlVars();
        if(jQuery(this).val()==-1 && 'formid' in jQuery_get){
            delete jQuery_get.formid;
        } else if(jQuery(this).val()!=-1){
            jQuery_get.formid=jQuery(this).val();
        }
        jQuery_url_str='?';
        jQuery.each(jQuery_get,function(key,val){
            jQuery_url_str +=key+'='+val+'&';
        })
        jQuery_url_str = jQuery_url_str.substring(0,jQuery_url_str.length-1);
        window.location.href=jQuery_url_str;
    });


    function getUrlVars() {
        urlParams = {};
        var e,
            a = /\+/g,
            r = /([^&=]+)=?([^&]*)/g,
            d = function (s) {
                return decodeURIComponent(s.replace(a, " "));
            },
            q = window.location.search.substring(1);
        while (e = r.exec(q))
            urlParams[d(e[1])] = d(e[2]);
        return urlParams;
    }
	 jQuery("#slider_slideSpeed,#slider_play,#slider_pause,#interakt_map_zoom").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
            // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
            // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    });
    //custom post types
    jQuery(".tf_images .tfuse-meta-radio-img-box:nth-child(1)").append('<div class="hover1">')
	jQuery(".tf_images .tfuse-meta-radio-img-box:nth-child(1)").hover(function() {
		  jQuery('.hover1').css({'background':'url(../wp-content/themes/interakt-parent/images/tip_post1.jpg) no-repeat 0 0 ','position':'relative','z-index':'2','cursor':'pointer','width':'400px','height':'230px'});
		}, function() {
		  jQuery('.hover1').removeAttr( 'style' );
	});
	jQuery(".tf_images .tfuse-meta-radio-img-box:nth-child(2)").append('<div class="hover2">')
	jQuery(".tf_images .tfuse-meta-radio-img-box:nth-child(2)").hover(function() {
		  jQuery('.hover2').css({'background':'url(../wp-content/themes/interakt-parent/images/tip_post2.jpg) no-repeat 0 0 ','position':'relative','z-index':'2','cursor':'pointer','width':'400px','height':'230px'});
		}, function() {
		  jQuery('.hover2').removeAttr( 'style' );
	});

    jQuery('#interakt_map_lat,#interakt_map_long').keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 190 || event.keyCode == 110|| event.keyCode == 189 || event.keyCode == 109 || event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
            // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
            // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    });

    jQuery('#interakt_framework_options_metabox .handlediv, #interakt_framework_options_metabox .hndle').hide();
    jQuery('#interakt_framework_options_metabox .handlediv, #interakt_framework_options_metabox .hndle').hide();

    var options = new Array();
    
    options['interakt_homepage_category'] = jQuery('#interakt_homepage_category').val();
    jQuery('#interakt_homepage_category').bind('change', function() {
        options['interakt_homepage_category'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });

    options['interakt_header_element'] = jQuery('#interakt_header_element').val();
    jQuery('#interakt_header_element').bind('change', function() {
        options['interakt_header_element'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
   
   options['interakt_choose_logo'] = jQuery('#interakt_choose_logo').val();
    jQuery('#interakt_choose_logo').bind('change', function() {
        options['interakt_choose_logo'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['interakt_theme_stylesheet'] = jQuery('#interakt_theme_stylesheet').val();
    jQuery('#interakt_theme_stylesheet').bind('change', function() {
        options['interakt_theme_stylesheet'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['interakt_navibar_color'] = jQuery('#interakt_navibar_color').val();
    jQuery('#interakt_navibar_color').bind('change', function() {
        options['interakt_navibar_color'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['interakt_navibar_color_cat'] = jQuery('#interakt_navibar_color_cat').val();
    jQuery('#interakt_navibar_color_cat').bind('change', function() {
        options['interakt_navibar_color_cat'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['interakt_page_title'] = jQuery('#interakt_page_title').val();
    jQuery('#interakt_page_title').bind('change', function() {
        options['interakt_page_title'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });

    options['slider_hoverPause'] = jQuery('#slider_hoverPause').val();
    jQuery('#slider_hoverPause').bind('change', function() {
       if (jQuery(this).next('.tf_checkbox_switch').hasClass('on'))  options['slider_hoverPause']= true;
        else  options['slider_hoverPause'] = false;
        tfuse_toggle_options(options);
    });

    options['map_type'] = jQuery('#interakt_map_type').val();
    jQuery(' #interakt_map_type').bind('change', function() {
        options['map_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    //advertising
    options['interakt_top_ad_space'] = jQuery('#interakt_top_ad_space').val();
    jQuery('#interakt_top_ad_space').bind('change', function() {
        options['interakt_top_ad_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['interakt_hook_space'] = jQuery('#interakt_hook_space').val();
    jQuery('#interakt_hook_space').bind('change', function() {
        options['interakt_hook_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['interakt_home_top_ad_space'] = jQuery('#interakt_home_top_ad_space').val();
    jQuery('#interakt_home_top_ad_space').bind('change', function() {
        options['interakt_home_top_ad_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['interakt_bfcontent_ads_space'] = jQuery('#interakt_bfcontent_ads_space').val();
    jQuery('#interakt_bfcontent_ads_space').bind('change', function() {
        options['interakt_bfcontent_ads_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['interakt_bfcontent_type'] = jQuery('#interakt_bfcontent_type').val();
    jQuery('#interakt_bfcontent_type').bind('change', function() {
        options['interakt_bfcontent_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['interakt_bfcontent_type1'] = jQuery('#interakt_bfcontent_type1').val();
    jQuery('#interakt_bfcontent_type1').bind('change', function() {
        options['interakt_bfcontent_type1'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['interakt_bfcontent_number'] = jQuery('#interakt_bfcontent_number').val();
    jQuery('#interakt_bfcontent_number').bind('change', function() {
        options['interakt_bfcontent_number'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['interakt_home_bfcontent_type'] = jQuery('#interakt_home_bfcontent_type').val();
    jQuery('#interakt_home_bfcontent_type').bind('change', function() {
        options['interakt_home_bfcontent_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['interakt_home_hook_space'] = jQuery('#interakt_home_hook_space').val();
    jQuery('#interakt_home_hook_space').bind('change', function() {
        options['interakt_home_hook_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['interakt_home_bfcontent_ads_space'] = jQuery('#interakt_home_bfcontent_ads_space').val();
    jQuery('#interakt_home_bfcontent_ads_space').bind('change', function() {
        options['interakt_home_bfcontent_ads_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['interakt_home_bfcontent_number'] = jQuery('#interakt_home_bfcontent_ads_space').val();
    jQuery('#interakt_home_bfcontent_number').bind('change', function() {
        options['interakt_home_bfcontent_number'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    //blog page
    options['interakt_blogpage_category'] = jQuery('#interakt_blogpage_category').val();
     jQuery('#interakt_blogpage_category').bind('change', function() {
         options['interakt_blogpage_category'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });

     options['interakt_header_element_blog'] = jQuery('#interakt_header_element_blog').val();
     jQuery('#interakt_header_element_blog').bind('change', function() {
         options['interakt_header_element_blog'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     options['interakt_before_content_element_blog'] = jQuery('#interakt_before_content_element_blog').val();
     jQuery('#interakt_before_content_element_blog').bind('change', function() {
         options['interakt_before_content_element_blog'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
    
     options['interakt_blog_top_ad_space'] = jQuery('#interakt_blog_top_ad_space').val();
     jQuery('#interakt_blog_top_ad_space').bind('change', function() {
         options['interakt_blog_top_ad_space'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
     options['interakt_home_bfcontent_number'] = jQuery('#interakt_home_bfcontent_number option:selected').val();
    jQuery('#interakt_home_bfcontent_number').bind('change', function() {
        options['interakt_home_bfcontent_number'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
	 options['interakt_blog_bfcontent_ads_space'] = jQuery('#interakt_blog_bfcontent_ads_space').val();
     jQuery('#interakt_blog_bfcontent_ads_space').bind('change', function() {
         options['interakt_blog_bfcontent_ads_space'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
	 options['interakt_blog_hook_space'] = jQuery('#interakt_blog_hook_space').val();
     jQuery('#interakt_blog_hook_space').bind('change', function() {
         options['interakt_blog_hook_space'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
	 options['interakt_blog_bfcontent_number'] = jQuery('#interakt_blog_bfcontent_number').val();
     jQuery('#interakt_blog_bfcontent_number').bind('change', function() {
         options['interakt_blog_bfcontent_number'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
	 options['interakt_blog_bfcontent_type'] = jQuery('#interakt_blog_bfcontent_type').val();
     jQuery('#interakt_blog_bfcontent_type').bind('change', function() {
         options['interakt_blog_bfcontent_type'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
      options['interakt_content_element'] = jQuery('#interakt_content_element').val();
     jQuery('#interakt_content_element').bind('change', function() {
         options['interakt_content_element'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
     options['posts_select_type'] = jQuery('#posts_select_type').val();
     jQuery('#posts_select_type').bind('change', function() {
         options['posts_select_type'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
     options['interakt_content_element_blog'] = jQuery('#interakt_content_element_blog').val();
     jQuery('#interakt_content_element_blog').bind('change', function() {
         options['interakt_content_element_blog'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
     
     //interakt elements
     options['interakt_another_header'] = jQuery('#interakt_another_header').val();
    jQuery('#interakt_another_header').bind('change', function() {
        options['interakt_another_header'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['interakt_another_header2'] = jQuery('#interakt_another_header2').val();
    jQuery('#interakt_another_header2').bind('change', function() {
        options['interakt_another_header2'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
     //interakt elements
     options['interakt_another_header_blog'] = jQuery('#interakt_another_header_blog').val();
    jQuery('#interakt_another_header_blog').bind('change', function() {
        options['interakt_another_header_blog'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['interakt_another_header2_blog'] = jQuery('#interakt_another_header2_blog').val();
    jQuery('#interakt_another_header2_blog').bind('change', function() {
        options['interakt_another_header2_blog'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['interakt_header_element_blog'] = jQuery('#interakt_header_element_blog').val();
    jQuery('#interakt_header_element_blog').bind('change', function() {
        options['interakt_header_element_blog'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });

    tfuse_toggle_options(options);

    function tfuse_toggle_options(options)
    {

        jQuery('#interakt_image3_blog,#interakt_page_map3_blog,#interakt_page_map2_blog,#interakt_image2_blog,#interakt_another_header2_blog,#interakt_image_blog,#interakt_header_title2_blog,#interakt_page_map_blog,#interakt_menu_header_blog,#interakt_header_title1_blog,#interakt_another_header_blog,#interakt_select_slider_blog,#interakt_header_title_slider_blog,#interakt_image3,#interakt_page_map3,#interakt_page_map2,#interakt_image2,#interakt_another_header2,#interakt_image,#interakt_header_title2,#interakt_page_map,#interakt_menu_header,#interakt_header_title1,#interakt_another_header,#interakt_select_slider,#interakt_header_title_slider,#interakt_another_header2_blog,#interakt_another_header_blog,#interakt_image3,#interakt_page_map3,#interakt_page_map2,#interakt_image2,#interakt_another_header2,#interakt_image,#interakt_header_title2,#interakt_page_map,#interakt_menu_header,#interakt_header_title1,#interakt_another_header,#interakt_select_slider,#interakt_header_title_slider,#interakt_select_content_slider_blog,#interakt_use_page_options,#interakt_home_page,#interakt_categories_select_categ,#interakt_select_content_slider,#interakt_home_top_ad_adsense,#interakt_title_blog,#interakt_latitude_blog,#interakt_longitude_blog,#interakt_adresss_blog,#interakt_zoom_blog,#interakt_select_slider_blog,#interakt_home_hook_adsense,#interakt_home_hook_url,#interakt_home_hook_image,#interakt_home_top_ad_url,\n\
        #interakt_home_top_ad_image,#interakt_top_ad_adsense,#interakt_top_ad_url,#interakt_top_ad_image,#interakt_footer_bg,#interakt_footer_image_repeat,#interakt_footer_image,#interakt_hook_adsense,#interakt_hook_url,#interakt_hook_image,#interakt_bfcontent_type,#interakt_bfcontent_number,\n\
        #interakt_bfcontent_ads_adsense7,#interakt_bfcontent_ads_url7,#interakt_bfcontent_ads_image7,#interakt_bfcontent_ads_adsense6,#interakt_bfcontent_ads_url6,#interakt_bfcontent_ads_image6,#interakt_bfcontent_ads_adsense5,#interakt_bfcontent_ads_url5,#interakt_bfcontent_ads_image5,#interakt_bfcontent_ads_adsense4,#interakt_bfcontent_ads_url4,\n\
        #interakt_bfcontent_ads_image4,#interakt_bfcontent_ads_adsense3,#interakt_bfcontent_ads_url3,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image1,#interakt_items,\n\
        #interakt_logo,#interakt_logo_text,#interakt_title,\n\
        #interakt_title_header,#interakt_select_slider,.homepage_category_header_element').parents('.option-inner').hide();
        jQuery('#interakt_image3_blog,#interakt_page_map3_blog,#interakt_page_map2_blog,#interakt_image2_blog,#interakt_another_header2_blog,#interakt_image_blog,#interakt_header_title2_blog,#interakt_page_map_blog,#interakt_menu_header_blog,#interakt_header_title1_blog,#interakt_another_header_blog,#interakt_select_slider_blog,#interakt_header_title_slider_blog,#interakt_another_header2_blog,#interakt_another_header_blog,#interakt_image3,#interakt_page_map3,#interakt_page_map2,#interakt_image2,#interakt_another_header2,#interakt_image,#interakt_header_title2,#interakt_page_map,#interakt_menu_header,#interakt_header_title1,#interakt_another_header,#interakt_select_slider,#interakt_header_title_slider,#interakt_select_content_slider_blog,#interakt_use_page_options,#interakt_home_page,#interakt_categories_select_categ,#interakt_select_content_slider,#interakt_home_top_ad_adsense,#interakt_title_blog,#interakt_latitude_blog,#interakt_longitude_blog,#interakt_adresss_blog,#interakt_zoom_blog,#interakt_select_slider_blog,#interakt_home_hook_adsense,#interakt_home_hook_url,#interakt_home_hook_image,\n\
        #interakt_home_top_ad_adsense,#interakt_home_top_ad_url,\n\
        #interakt_home_top_ad_image,#interakt_top_ad_adsense,#interakt_top_ad_url,#interakt_top_ad_image,#interakt_footer_bg,#interakt_footer_image_repeat,#interakt_footer_image,#interakt_hook_adsense,#interakt_hook_url,#interakt_hook_image,#interakt_bfcontent_type,#interakt_bfcontent_number,\n\
        #interakt_bfcontent_ads_adsense7,#interakt_bfcontent_ads_url7,#interakt_bfcontent_ads_image7,#interakt_bfcontent_ads_adsense6,#interakt_bfcontent_ads_url6,#interakt_bfcontent_ads_image6,#interakt_bfcontent_ads_adsense5,#interakt_bfcontent_ads_url5,#interakt_bfcontent_ads_image5,#interakt_bfcontent_ads_adsense4,#interakt_bfcontent_ads_url4,\n\
        #interakt_bfcontent_ads_image4,#interakt_bfcontent_ads_adsense3,#interakt_bfcontent_ads_url3,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image1,#interakt_items,\n\
        #interakt_logo,#interakt_logo_text,\n\
        #interakt_title,#interakt_title_header,#interakt_select_slider,.homepage_category_header_element').parents('.form-field').hide();

        jQuery('.interakt_image3_blog,.interakt_page_map3_blog,.interakt_page_map2_blog,.interakt_image2_blog,.interakt_another_header_blog,.interakt_another_header2_blog,.interakt_header_title1_blog,.interakt_header_title2_blog,.interakt_select_slider_blog,.interakt_image_blog,.interakt_page_map_blog').next().hide();
        
        //page options
        if(options['interakt_header_element_blog']=='slider'){
            jQuery('#interakt_select_slider_blog,#interakt_header_title_slider_blog').parents('.option-inner').show();
            jQuery('#interakt_select_slider_blog,#interakt_header_title_slider_blog').parents('.form-field').show();
            jQuery('.interakt_select_slider_blog ').next().show();
        } 
        else if(options['interakt_header_element_blog']=='title1'){
            jQuery('#interakt_header_title1_blog,#interakt_another_header_blog').parents('.option-inner').show();
            jQuery('#interakt_header_title1_blog,#interakt_another_header_blog').parents('.form-field').show();
            jQuery('.interakt_header_title1_blog').next().show();
            if(options['interakt_another_header_blog']=='image'){
                jQuery('#interakt_menu_header_blog,#interakt_image_blog').parents('.option-inner').show();
                jQuery('#interakt_menu_header_blog,#interakt_image_blog').parents('.form-field').show();
                jQuery('.interakt_image_blog').next().show();
            } 
            else if(options['interakt_another_header_blog']=='map'){
                jQuery('#interakt_menu_header_blog,#interakt_page_map_blog').parents('.option-inner').show();
                jQuery('#interakt_menu_header_blog,#interakt_page_map_blog').parents('.form-field').show();
                jQuery('.interakt_page_map_blog').next().show();
            } 
        } 
        else if(options['interakt_header_element_blog']=='title2'){
            
            jQuery('#interakt_header_title2_blog,#interakt_another_header2_blog,#interakt_menu_header_blog').parents('.option-inner').show();
            jQuery('#interakt_header_title2_blog,#interakt_another_header2_blog,#interakt_menu_header_blog').parents('.form-field').show();
            jQuery('.interakt_header_title2_blog,.interakt_another_header2_blog ').next().show();
            if(options['interakt_another_header2_blog']=='image'){
                jQuery('#interakt_image2_blog').parents('.option-inner').show();
                jQuery('#interakt_image2_blog').parents('.form-field').show();
                jQuery('.interakt_image2_blog').next().show();
                jQuery('.interakt_another_header2_blog ').next().hide();
            } 
            else if(options['interakt_another_header2_blog']=='map'){
                jQuery('#interakt_page_map2_blog').parents('.option-inner').show();
                jQuery('#interakt_page_map2_blog').parents('.form-field').show();
                jQuery('.interakt_page_map2_blog').next().show();
                jQuery('.interakt_another_header2_blog ').next().hide();
            } 
        } 
        else if(options['interakt_header_element_blog']=='image'){
            jQuery('#interakt_image3_blog,#interakt_menu_header_blog').parents('.option-inner').show();
            jQuery('#interakt_image3_blog,#interakt_menu_header_blog').parents('.form-field').show();
            jQuery('.interakt_image3_blog').next().show();
        } 
        else if(options['interakt_header_element_blog']=='map'){
            jQuery('#interakt_page_map3_blog,#interakt_menu_header_blog').parents('.option-inner').show();
            jQuery('#interakt_page_map3_blog,#interakt_menu_header_blog').parents('.form-field').show();
            jQuery('.interakt_page_map3_blog').next().show();
        } 
        else{
            jQuery('#interakt_menu_header_blog').parents('.option-inner').show();
            jQuery('#interakt_menu_header_blog').parents('.form-field').show();
            jQuery('.interakt_page_map3_blog').next().show();
        } 
        
        
        //homepage
        jQuery('.interakt_image3,.interakt_page_map3,.interakt_page_map2,.interakt_image2,.interakt_another_header,.interakt_another_header2,.interakt_header_title1,.interakt_header_title2,.interakt_select_slider,.interakt_image,.interakt_page_map').next().hide();
        
        //header 
        var homepage = true;
        if (jQuery('.homepage_category_header_element').length == 1) homepage = false;
        if ( options['interakt_homepage_category'] == 'tfuse_blog_posts' || options['interakt_homepage_category'] == 'tfuse_blog_cases')
        {
            homepage = true;
            jQuery('.homepage_category_header_element').parents('.option-inner').show();
            jQuery('.homepage_category_header_element').parents('.form-field').show();
        }
        //page options
        if(options['interakt_header_element']=='slider'){
            jQuery('#interakt_select_slider,#interakt_header_title_slider').parents('.option-inner').show();
            jQuery('#interakt_select_slider,#interakt_header_title_slider').parents('.form-field').show();
            jQuery('.interakt_select_slider ').next().show();
        } 
        else if(options['interakt_header_element']=='title1'){
            jQuery('#interakt_header_title1,#interakt_another_header').parents('.option-inner').show();
            jQuery('#interakt_header_title1,#interakt_another_header').parents('.form-field').show();
            jQuery('.interakt_header_title1 ').next().show();
            if(options['interakt_another_header']=='image'){
                jQuery('#interakt_menu_header,#interakt_image').parents('.option-inner').show();
                jQuery('#interakt_menu_header,#interakt_image').parents('.form-field').show();
                jQuery('.interakt_image').next().show();
            } 
            else if(options['interakt_another_header']=='map'){
                jQuery('#interakt_menu_header,#interakt_page_map').parents('.option-inner').show();
                jQuery('#interakt_menu_header,#interakt_page_map').parents('.form-field').show();
                jQuery('.interakt_page_map').next().show();
            } 
        } 
        else if(options['interakt_header_element']=='title2'){
            
            jQuery('#interakt_header_title2,#interakt_another_header2,#interakt_menu_header').parents('.option-inner').show();
            jQuery('#interakt_header_title2,#interakt_another_header2,#interakt_menu_header').parents('.form-field').show();
            jQuery('.interakt_header_title2,.interakt_another_header2 ').next().show();
            if(options['interakt_another_header2']=='image'){
                jQuery('#interakt_image2').parents('.option-inner').show();
                jQuery('#interakt_image2').parents('.form-field').show();
                jQuery('.interakt_image2').next().show();
                jQuery('.interakt_another_header2 ').next().hide();
            } 
            else if(options['interakt_another_header2']=='map'){
                jQuery('#interakt_page_map2').parents('.option-inner').show();
                jQuery('#interakt_page_map2').parents('.form-field').show();
                jQuery('.interakt_page_map2').next().show();
                jQuery('.interakt_another_header2 ').next().hide();
            } 
        } 
        else if(options['interakt_header_element']=='image'){
            jQuery('#interakt_image3,#interakt_menu_header').parents('.option-inner').show();
            jQuery('#interakt_image3,#interakt_menu_header').parents('.form-field').show();
            jQuery('.interakt_image3').next().show();
        } 
        else if(options['interakt_header_element']=='map'){
            jQuery('#interakt_page_map3,#interakt_menu_header').parents('.option-inner').show();
            jQuery('#interakt_page_map3,#interakt_menu_header').parents('.form-field').show();
            jQuery('.interakt_page_map3').next().show();
        } 
        else{
            jQuery('#interakt_menu_header').parents('.option-inner').show();
            jQuery('#interakt_menu_header').parents('.form-field').show();
            jQuery('.interakt_page_map3').next().show();
        } 
        
        //homepage
       if(options['interakt_homepage_category']=='specific'){
            jQuery('#interakt_categories_select_categ').parents('.option-inner').show();
            jQuery('#interakt_categories_select_categ').parents('.form-field').show();
            if(jQuery('#interakt_use_page_options').is(':checked')) 
                jQuery('#homepage-header,#homepage-banners,#homepage-shortcodes').removeAttr('style');
        }
        else if (options['interakt_homepage_category']=='all')
        {
            if(jQuery('#interakt_use_page_options').is(':checked')) 
                jQuery('#homepage-header,#homepage-banners,#homepage-shortcodes').removeAttr('style');
        }
        else if(options['interakt_homepage_category']=='page'){
            jQuery('#interakt_home_page,#interakt_use_page_options').parents('.option-inner').show();
            jQuery('#interakt_home_page,#interakt_use_page_options').parents('.form-field').show();
            //use page options
            if(jQuery('#interakt_use_page_options').is(':checked')) jQuery('#homepage-header,#homepage-banners,#homepage-shortcodes').hide();
            jQuery('#interakt_use_page_options').live('change',function () {
            if(jQuery(this).is(':checked'))
                    jQuery('#homepage-header,#homepage-banners,#homepage-shortcodes').hide();
            else
                    jQuery('#homepage-header,#homepage-banners,#homepage-shortcodes').show();
            });
        } 
        
        //content slider
        if(options['interakt_content_element']=='slider'){
            jQuery('#interakt_select_content_slider').parents('.option-inner').show();
            jQuery('#interakt_select_content_slider').parents('.form-field').show();
        } 
        
        //blog content slider
        if(options['interakt_content_element_blog']=='slider'){
            jQuery('#interakt_select_content_slider_blog').parents('.option-inner').show();
            jQuery('#interakt_select_content_slider_blog').parents('.form-field').show();
        } 

       //blog page
        if(options['interakt_blogpage_category']=='all'){
            jQuery('.interakt_categories_select_categ_blog').hide();
        }
        else if(options['interakt_blogpage_category']=='specific'){
            jQuery('.interakt_categories_select_categ_blog').show();
        } 

 
        //logo type
        if(options['interakt_choose_logo'] == 'text' && homepage)
        {

            jQuery('#interakt_logo_text').parents('.option-inner').show();
            jQuery('#interakt_logo_text').parents('.form-field').show();
        }
        else
        {
            jQuery('#interakt_logo').parents('.option-inner').show();
            jQuery('#interakt_logo').parents('.form-field').show();
        }
        //hide page title
        if(options['interakt_page_title'] == 'custom_title')
        { 
            jQuery('#interakt_custom_title').parents('.option-inner').show();
            jQuery('#interakt_custom_title').parents('.form-field').show();
        }
		else
        { 
            jQuery('#interakt_custom_title').parents('.option-inner').hide();
            jQuery('#interakt_custom_title').parents('.form-field').hide();
        }
        
        //advertising
        if(options['interakt_blog_top_ad_space']=='true'){
            jQuery('.interakt_blog_top_ad_image,.interakt_blog_top_ad_url,.interakt_blog_top_ad_adsense').show();
        }
        else{
            jQuery('.interakt_blog_top_ad_image,.interakt_blog_top_ad_url,.interakt_blog_top_ad_adsense').hide();
        }
		
        jQuery('.interakt_blog_bfcontent_type,.interakt_blog_bfcontent_number,.interakt_blog_bfcontent_ads_image1,.interakt_blog_bfcontent_ads_url1,.interakt_blog_bfcontent_ads_adsense1,.interakt_blog_bfcontent_ads_image2,.interakt_blog_bfcontent_ads_url2,.interakt_blog_bfcontent_ads_adsense2,.interakt_blog_bfcontent_ads_image3,.interakt_blog_bfcontent_ads_url3,.interakt_blog_bfcontent_ads_adsense3,.interakt_blog_bfcontent_ads_image4,.interakt_blog_bfcontent_ads_url4,.interakt_blog_bfcontent_ads_adsense4,.interakt_blog_bfcontent_ads_image5,.interakt_blog_bfcontent_ads_url5,.interakt_blog_bfcontent_ads_adsense5,.interakt_blog_bfcontent_ads_image6,.interakt_blog_bfcontent_ads_url6,.interakt_blog_bfcontent_ads_adsense6,.interakt_blog_bfcontent_ads_image7,.interakt_blog_bfcontent_ads_url7,.interakt_blog_bfcontent_ads_adsense7').hide();
        if(options['interakt_blog_bfcontent_ads_space']=='true'){
                jQuery('.interakt_blog_bfcontent_type,.interakt_blog_bfcontent_number').show();
                if(options['interakt_blog_bfcontent_type']=='image'){
                    if(options['interakt_blog_bfcontent_number']=='one'){
                            jQuery('.interakt_blog_bfcontent_ads_image1,.interakt_blog_bfcontent_ads_url1').show();
                    }
                    else if(options['interakt_blog_bfcontent_number']=='two'){
                            jQuery('.interakt_blog_bfcontent_ads_image1,.interakt_blog_bfcontent_ads_url1,.interakt_blog_bfcontent_ads_image2,.interakt_blog_bfcontent_ads_url2').show();
                    }
                    else if(options['interakt_blog_bfcontent_number']=='three'){
                            jQuery('.interakt_blog_bfcontent_ads_image1,.interakt_blog_bfcontent_ads_url1,.interakt_blog_bfcontent_ads_image2,.interakt_blog_bfcontent_ads_url2,.interakt_blog_bfcontent_ads_image3,.interakt_blog_bfcontent_ads_url3').show();
                    }
                    else if(options['interakt_blog_bfcontent_number']=='four'){
                            jQuery('.interakt_blog_bfcontent_ads_image1,.interakt_blog_bfcontent_ads_url1,.interakt_blog_bfcontent_ads_image2,.interakt_blog_bfcontent_ads_url2,.interakt_blog_bfcontent_ads_image3,.interakt_blog_bfcontent_ads_url3,.interakt_blog_bfcontent_ads_image4,.interakt_blog_bfcontent_ads_url4').show();
                    }
                    else if(options['interakt_blog_bfcontent_number']=='five'){
                            jQuery('.interakt_blog_bfcontent_ads_image1,.interakt_blog_bfcontent_ads_url1,.interakt_blog_bfcontent_ads_image2,.interakt_blog_bfcontent_ads_url2,.interakt_blog_bfcontent_ads_image3,.interakt_blog_bfcontent_ads_url3,.interakt_blog_bfcontent_ads_image4,.interakt_blog_bfcontent_ads_url4,.interakt_blog_bfcontent_ads_image5,.interakt_blog_bfcontent_ads_url5').show();
                    }
                    else if(options['interakt_blog_bfcontent_number']=='six'){
                            jQuery('.interakt_blog_bfcontent_ads_image1,.interakt_blog_bfcontent_ads_url1,.interakt_blog_bfcontent_ads_image2,.interakt_blog_bfcontent_ads_url2,.interakt_blog_bfcontent_ads_image3,.interakt_blog_bfcontent_ads_url3,.interakt_blog_bfcontent_ads_image4,.interakt_blog_bfcontent_ads_url4,.interakt_blog_bfcontent_ads_image5,.interakt_blog_bfcontent_ads_url5,.interakt_blog_bfcontent_ads_image6,.interakt_blog_bfcontent_ads_url6').show();
                    }
                    else if(options['interakt_blog_bfcontent_number']=='seven'){
                            jQuery('.interakt_blog_bfcontent_ads_image1,.interakt_blog_bfcontent_ads_url1,.interakt_blog_bfcontent_ads_image2,.interakt_blog_bfcontent_ads_url2,.interakt_blog_bfcontent_ads_image3,.interakt_blog_bfcontent_ads_url3,.interakt_blog_bfcontent_ads_image4,.interakt_blog_bfcontent_ads_url4,.interakt_blog_bfcontent_ads_image5,.interakt_blog_bfcontent_ads_url5,.interakt_blog_bfcontent_ads_image6,.interakt_blog_bfcontent_ads_url6,.interakt_blog_bfcontent_ads_image7,.interakt_blog_bfcontent_ads_url7').show();
                    }
                }
                else{
                    if(options['interakt_blog_bfcontent_number']=='one'){
                            jQuery('.interakt_blog_bfcontent_ads_adsense1').show();
                    }
                    else if(options['interakt_blog_bfcontent_number']=='two'){
                            jQuery('.interakt_blog_bfcontent_ads_adsense1,.interakt_blog_bfcontent_ads_adsense2').show();
                    }
                    else if(options['interakt_blog_bfcontent_number']=='three'){
                            jQuery('.interakt_blog_bfcontent_ads_adsense1,.interakt_blog_bfcontent_ads_adsense2,.interakt_blog_bfcontent_ads_adsense3').show();
                    }
                    else if(options['interakt_blog_bfcontent_number']=='four'){
                            jQuery('.interakt_blog_bfcontent_ads_adsense1,.interakt_blog_bfcontent_ads_adsense2,.interakt_blog_bfcontent_ads_adsense3,.interakt_blog_bfcontent_ads_adsense4').show();
                    }
                    else if(options['interakt_blog_bfcontent_number']=='five'){
                            jQuery('.interakt_blog_bfcontent_ads_adsense1,.interakt_blog_bfcontent_ads_adsense2,.interakt_blog_bfcontent_ads_adsense3,.interakt_blog_bfcontent_ads_adsense4,.interakt_blog_bfcontent_ads_adsense5').show();
                    }
                    else if(options['interakt_blog_bfcontent_number']=='six'){
                            jQuery('.interakt_blog_bfcontent_ads_adsense1,.interakt_blog_bfcontent_ads_adsense2,.interakt_blog_bfcontent_ads_adsense3,.interakt_blog_bfcontent_ads_adsense4,.interakt_blog_bfcontent_ads_adsense5,.interakt_blog_bfcontent_ads_adsense6').show();
                    }
                    else if(options['interakt_blog_bfcontent_number']=='seven'){
                            jQuery('.interakt_blog_bfcontent_ads_adsense1,.interakt_blog_bfcontent_ads_adsense2,.interakt_blog_bfcontent_ads_adsense3,.interakt_blog_bfcontent_ads_adsense4,.interakt_blog_bfcontent_ads_adsense5,.interakt_blog_bfcontent_ads_adsense6,.interakt_blog_bfcontent_ads_adsense7').show();
                    }
                }	
        }

        if(options['interakt_blog_hook_space']=='true'){
            jQuery('.interakt_blog_hook_url,.interakt_blog_hook_adsense,.interakt_blog_hook_image').show();
        }
        else{
            jQuery('.interakt_blog_hook_url,.interakt_blog_hook_adsense,.interakt_blog_hook_image').hide();
        }
        
        if(options['interakt_hook_space'] == 'true' && homepage)
        {
            jQuery('#interakt_hook_image,#interakt_hook_url,#interakt_hook_adsense').parents('.option-inner').show();
            jQuery('#interakt_hook_image,#interakt_hook_url,#interakt_hook_adsense').parents('.form-field').show();
        }
        
        if(options['interakt_home_hook_space'] == 'true' && homepage)
        {
            jQuery('#interakt_home_hook_image,#interakt_home_hook_url,#interakt_home_hook_adsense').parents('.option-inner').show();
            jQuery('#interakt_home_hook_image,#interakt_home_hook_url,#interakt_home_hook_adsense').parents('.form-field').show();
        }
        
        if(options['interakt_top_ad_space'] == 'true' && homepage)
        {
            jQuery('#interakt_top_ad_image,#interakt_top_ad_url,#interakt_top_ad_adsense').parents('.option-inner').show();
            jQuery('#interakt_top_ad_image,#interakt_top_ad_url,#interakt_top_ad_adsense').parents('.form-field').show();
        }
        
        if(options['interakt_home_top_ad_space'] == 'true' && homepage)
        {
            jQuery('#interakt_home_top_ad_image,#interakt_home_top_ad_url,#interakt_home_top_ad_adsense').parents('.option-inner').show();
            jQuery('#interakt_home_top_ad_image,#interakt_home_top_ad_url,#interakt_home_top_ad_adsense').parents('.form-field').show();
        }
        /////////////////////////////////////////
        jQuery('.interakt_home_bfcontent_type,.interakt_home_bfcontent_number,.interakt_home_bfcontent_ads_image1,.interakt_home_bfcontent_ads_url1,.interakt_home_bfcontent_ads_adsense1,.interakt_home_bfcontent_ads_image2,.interakt_home_bfcontent_ads_url2,.interakt_home_bfcontent_ads_adsense2,.interakt_home_bfcontent_ads_image3,.interakt_home_bfcontent_ads_url3,.interakt_home_bfcontent_ads_adsense3,.interakt_home_bfcontent_ads_image4,.interakt_home_bfcontent_ads_url4,.interakt_home_bfcontent_ads_adsense4,.interakt_home_bfcontent_ads_image5,.interakt_home_bfcontent_ads_url5,.interakt_home_bfcontent_ads_adsense5,.interakt_home_bfcontent_ads_image6,.interakt_home_bfcontent_ads_url6,.interakt_home_bfcontent_ads_adsense6,.interakt_home_bfcontent_ads_image7,.interakt_home_bfcontent_ads_url7,.interakt_home_bfcontent_ads_adsense7').hide();
        if(options['interakt_home_bfcontent_ads_space']=='true'){ 
                jQuery('.interakt_home_bfcontent_type,.interakt_home_bfcontent_number').show();
                if(options['interakt_home_bfcontent_type']=='image'){ 
                    if(options['interakt_home_bfcontent_number']=='one'){
                            jQuery('.interakt_home_bfcontent_ads_image1,.interakt_home_bfcontent_ads_url1').show();
                    }
                    else if(options['interakt_home_bfcontent_number']=='two'){
                            jQuery('.interakt_home_bfcontent_ads_image1,.interakt_home_bfcontent_ads_url1,.interakt_home_bfcontent_ads_image2,.interakt_home_bfcontent_ads_url2').show();
                    }
                    else if(options['interakt_home_bfcontent_number']=='three'){
                            jQuery('.interakt_home_bfcontent_ads_image1,.interakt_home_bfcontent_ads_url1,.interakt_home_bfcontent_ads_image2,.interakt_home_bfcontent_ads_url2,.interakt_home_bfcontent_ads_image3,.interakt_home_bfcontent_ads_url3').show();
                    }
                    else if(options['interakt_home_bfcontent_number']=='four'){
                            jQuery('.interakt_home_bfcontent_ads_image1,.interakt_home_bfcontent_ads_url1,.interakt_home_bfcontent_ads_image2,.interakt_home_bfcontent_ads_url2,.interakt_home_bfcontent_ads_image3,.interakt_home_bfcontent_ads_url3,.interakt_home_bfcontent_ads_image4,.interakt_home_bfcontent_ads_url4').show();
                    }
                    else if(options['interakt_home_bfcontent_number']=='five'){
                            jQuery('.interakt_home_bfcontent_ads_image1,.interakt_home_bfcontent_ads_url1,.interakt_home_bfcontent_ads_image2,.interakt_home_bfcontent_ads_url2,.interakt_home_bfcontent_ads_image3,.interakt_home_bfcontent_ads_url3,.interakt_home_bfcontent_ads_image4,.interakt_home_bfcontent_ads_url4,.interakt_home_bfcontent_ads_image5,.interakt_home_bfcontent_ads_url5').show();
                    }
                    else if(options['interakt_home_bfcontent_number']=='six'){
                            jQuery('.interakt_home_bfcontent_ads_image1,.interakt_home_bfcontent_ads_url1,.interakt_home_bfcontent_ads_image2,.interakt_home_bfcontent_ads_url2,.interakt_home_bfcontent_ads_image3,.interakt_home_bfcontent_ads_url3,.interakt_home_bfcontent_ads_image4,.interakt_home_bfcontent_ads_url4,.interakt_home_bfcontent_ads_image5,.interakt_home_bfcontent_ads_url5,.interakt_home_bfcontent_ads_image6,.interakt_home_bfcontent_ads_url6').show();
                    }
                    else if(options['interakt_home_bfcontent_number']=='seven'){
                            jQuery('.interakt_home_bfcontent_ads_image1,.interakt_home_bfcontent_ads_url1,.interakt_home_bfcontent_ads_image2,.interakt_home_bfcontent_ads_url2,.interakt_home_bfcontent_ads_image3,.interakt_home_bfcontent_ads_url3,.interakt_home_bfcontent_ads_image4,.interakt_home_bfcontent_ads_url4,.interakt_home_bfcontent_ads_image5,.interakt_home_bfcontent_ads_url5,.interakt_home_bfcontent_ads_image6,.interakt_home_bfcontent_ads_url6,.interakt_home_bfcontent_ads_image7,.interakt_home_bfcontent_ads_url7').show();
                    }
                }
                else{
                    if(options['interakt_home_bfcontent_number']=='one'){
                            jQuery('.interakt_home_bfcontent_ads_adsense1').show();
                    }
                    else if(options['interakt_home_bfcontent_number']=='two'){
                            jQuery('.interakt_home_bfcontent_ads_adsense1,.interakt_home_bfcontent_ads_adsense2').show();
                    }
                    else if(options['interakt_home_bfcontent_number']=='three'){
                            jQuery('.interakt_home_bfcontent_ads_adsense1,.interakt_home_bfcontent_ads_adsense2,.interakt_home_bfcontent_ads_adsense3').show();
                    }
                    else if(options['interakt_home_bfcontent_number']=='four'){
                            jQuery('.interakt_home_bfcontent_ads_adsense1,.interakt_home_bfcontent_ads_adsense2,.interakt_home_bfcontent_ads_adsense3,.interakt_home_bfcontent_ads_adsense4').show();
                    }
                    else if(options['interakt_home_bfcontent_number']=='five'){
                            jQuery('.interakt_home_bfcontent_ads_adsense1,.interakt_home_bfcontent_ads_adsense2,.interakt_home_bfcontent_ads_adsense3,.interakt_home_bfcontent_ads_adsense4,.interakt_home_bfcontent_ads_adsense5').show();
                    }
                    else if(options['interakt_home_bfcontent_number']=='six'){
                            jQuery('.interakt_home_bfcontent_ads_adsense1,.interakt_home_bfcontent_ads_adsense2,.interakt_home_bfcontent_ads_adsense3,.interakt_home_bfcontent_ads_adsense4,.interakt_home_bfcontent_ads_adsense5,.interakt_home_bfcontent_ads_adsense6').show();
                    }
                    else if(options['interakt_home_bfcontent_number']=='seven'){
                            jQuery('.interakt_home_bfcontent_ads_adsense1,.interakt_home_bfcontent_ads_adsense2,.interakt_home_bfcontent_ads_adsense3,.interakt_home_bfcontent_ads_adsense4,.interakt_home_bfcontent_ads_adsense5,.interakt_home_bfcontent_ads_adsense6,.interakt_home_bfcontent_ads_adsense7').show();
                    }
                }	
        }

        if(options['interakt_bfcontent_ads_space'] == 'true' && homepage)
        { 
            jQuery('#interakt_bfcontent_type').parents('.option-inner').show();
            jQuery('#interakt_bfcontent_type').parents('.form-field').show();

            if(options['interakt_bfcontent_type'] == 'image' && homepage)
            {
                jQuery('#interakt_bfcontent_number').parents('.option-inner').show();
                jQuery('#interakt_bfcontent_number').parents('.form-field').show();
                switch (options['interakt_bfcontent_number'])
                {
                    case 'one' :
                        jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1').parents('.option-inner').show();
                        jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1').parents('.form-field').show();
                    break;
                    case 'two' :
                        jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2').parents('.option-inner').show();
                        jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2').parents('.form-field').show();
                    break;
                    case 'three' :
                        jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_url3').parents('.option-inner').show();
                        jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_url3').parents('.form-field').show();
                    break;
                    case 'four' :
                        jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_url3,#interakt_bfcontent_ads_image4,#interakt_bfcontent_ads_url4').parents('.option-inner').show();
                        jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_url3,#interakt_bfcontent_ads_image4,#interakt_bfcontent_ads_url4').parents('.form-field').show();
                    break;
                    case 'five' :
                        jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_url3,#interakt_bfcontent_ads_image4,#interakt_bfcontent_ads_url4,#interakt_bfcontent_ads_image5,#interakt_bfcontent_ads_url5').parents('.option-inner').show();
                        jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_url3,#interakt_bfcontent_ads_image4,#interakt_bfcontent_ads_url4,#interakt_bfcontent_ads_image5,#interakt_bfcontent_ads_url5').parents('.form-field').show();
                    break;
                    case 'six' :
                        jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_url3,#interakt_bfcontent_ads_image4,#interakt_bfcontent_ads_url4,#interakt_bfcontent_ads_image5,#interakt_bfcontent_ads_url5,#interakt_bfcontent_ads_image6,#interakt_bfcontent_ads_url6').parents('.option-inner').show();
                        jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_url3,#interakt_bfcontent_ads_image4,#interakt_bfcontent_ads_url4,#interakt_bfcontent_ads_image5,#interakt_bfcontent_ads_url5,#interakt_bfcontent_ads_image6,#interakt_bfcontent_ads_url6').parents('.form-field').show();
                    break;
                    default :
                        jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_url3,#interakt_bfcontent_ads_image4,#interakt_bfcontent_ads_url4,#interakt_bfcontent_ads_image5,#interakt_bfcontent_ads_url5,#interakt_bfcontent_ads_image6,#interakt_bfcontent_ads_url6,#interakt_bfcontent_ads_image7,#interakt_bfcontent_ads_url7').parents('.option-inner').show();
                        jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_url3,#interakt_bfcontent_ads_image4,#interakt_bfcontent_ads_url4,#interakt_bfcontent_ads_image5,#interakt_bfcontent_ads_url5,#interakt_bfcontent_ads_image6,#interakt_bfcontent_ads_url6,#interakt_bfcontent_ads_image7,#interakt_bfcontent_ads_url7').parents('.form-field').show();
                }
            }
            else if(options['interakt_bfcontent_type'] == 'adsense' && homepage)
            {
                jQuery('#interakt_bfcontent_number').parents('.option-inner').show();
                jQuery('#interakt_bfcontent_number').parents('.form-field').show();
                switch (options['interakt_bfcontent_number'])
                {
                    case 'one' :
                        jQuery('#interakt_bfcontent_ads_adsense1').parents('.option-inner').show();
                        jQuery('#interakt_bfcontent_ads_adsense1').parents('.form-field').show();
                    break;
                    case 'two' :
                        jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2').parents('.option-inner').show();
                        jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2').parents('.form-field').show();
                    break;
                    case 'three' :
                        jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_adsense3').parents('.option-inner').show();
                        jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_adsense3').parents('.form-field').show();
                    break;
                    case 'four' :
                        jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_adsense3,#interakt_bfcontent_ads_adsense4').parents('.option-inner').show();
                        jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_adsense3,#interakt_bfcontent_ads_adsense4').parents('.form-field').show();
                    break;
                    case 'five' :
                        jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_adsense3,#interakt_bfcontent_ads_adsense4,#interakt_bfcontent_ads_adsense5').parents('.option-inner').show();
                        jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_adsense3,#interakt_bfcontent_ads_adsense4,#interakt_bfcontent_ads_adsense5').parents('.form-field').show();
                    break;
                    case 'six' :
                        jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_adsense3,#interakt_bfcontent_ads_adsense4,#interakt_bfcontent_ads_adsense5,#interakt_bfcontent_ads_adsense6').parents('.option-inner').show();
                        jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_adsense3,#interakt_bfcontent_ads_adsense4,#interakt_bfcontent_ads_adsense5,#interakt_bfcontent_ads_adsense6').parents('.form-field').show();
                    break;
                    default :
                        jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_adsense3,#interakt_bfcontent_ads_adsense4,#interakt_bfcontent_ads_adsense5,#interakt_bfcontent_ads_adsense6,#interakt_bfcontent_ads_adsense7').parents('.option-inner').show();
                        jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_adsense3,#interakt_bfcontent_ads_adsense4,#interakt_bfcontent_ads_adsense5,#interakt_bfcontent_ads_adsense6,#interakt_bfcontent_ads_adsense7').parents('.form-field').show();
                }
            }
        }
        if(options['interakt_bfcontent_type1'] == 'image' && homepage)
        {
            jQuery('#interakt_bfcontent_number').parents('.option-inner').show();
            jQuery('#interakt_bfcontent_number').parents('.form-field').show();
            switch (options['interakt_bfcontent_number'])
            {
                case 'one' :
                    jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1').parents('.option-inner').show();
                    jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1').parents('.form-field').show();
                break;
                case 'two' :
                    jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2').parents('.option-inner').show();
                    jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2').parents('.form-field').show();
                break;
                case 'three' :
                    jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_url3').parents('.option-inner').show();
                    jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_url3').parents('.form-field').show();
                break;
                case 'four' :
                    jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_url3,#interakt_bfcontent_ads_image4,#interakt_bfcontent_ads_url4').parents('.option-inner').show();
                    jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_url3,#interakt_bfcontent_ads_image4,#interakt_bfcontent_ads_url4').parents('.form-field').show();
                break;
                case 'five' :
                    jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_url3,#interakt_bfcontent_ads_image4,#interakt_bfcontent_ads_url4,#interakt_bfcontent_ads_image5,#interakt_bfcontent_ads_url5').parents('.option-inner').show();
                    jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_url3,#interakt_bfcontent_ads_image4,#interakt_bfcontent_ads_url4,#interakt_bfcontent_ads_image5,#interakt_bfcontent_ads_url5').parents('.form-field').show();
                break;
                case 'six' :
                    jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_url3,#interakt_bfcontent_ads_image4,#interakt_bfcontent_ads_url4,#interakt_bfcontent_ads_image5,#interakt_bfcontent_ads_url5,#interakt_bfcontent_ads_image6,#interakt_bfcontent_ads_url6').parents('.option-inner').show();
                    jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_url3,#interakt_bfcontent_ads_image4,#interakt_bfcontent_ads_url4,#interakt_bfcontent_ads_image5,#interakt_bfcontent_ads_url5,#interakt_bfcontent_ads_image6,#interakt_bfcontent_ads_url6').parents('.form-field').show();
                break;
                default :
                    jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_url3,#interakt_bfcontent_ads_image4,#interakt_bfcontent_ads_url4,#interakt_bfcontent_ads_image5,#interakt_bfcontent_ads_url5,#interakt_bfcontent_ads_image6,#interakt_bfcontent_ads_url6,#interakt_bfcontent_ads_image7,#interakt_bfcontent_ads_url7').parents('.option-inner').show();
                    jQuery('#interakt_bfcontent_ads_image1,#interakt_bfcontent_ads_url1,#interakt_bfcontent_ads_image2,#interakt_bfcontent_ads_url2,#interakt_bfcontent_ads_image3,#interakt_bfcontent_ads_url3,#interakt_bfcontent_ads_image4,#interakt_bfcontent_ads_url4,#interakt_bfcontent_ads_image5,#interakt_bfcontent_ads_url5,#interakt_bfcontent_ads_image6,#interakt_bfcontent_ads_url6,#interakt_bfcontent_ads_image7,#interakt_bfcontent_ads_url7').parents('.form-field').show();
            }
        }
        else if(options['interakt_bfcontent_type1'] == 'adsense' && homepage)
        {
            jQuery('#interakt_bfcontent_number').parents('.option-inner').show();
            jQuery('#interakt_bfcontent_number').parents('.form-field').show();
            switch (options['interakt_bfcontent_number'])
            {
                case 'one' :
                    jQuery('#interakt_bfcontent_ads_adsense1').parents('.option-inner').show();
                    jQuery('#interakt_bfcontent_ads_adsense1').parents('.form-field').show();
                break;
                case 'two' :
                    jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2').parents('.option-inner').show();
                    jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2').parents('.form-field').show();
                break;
                case 'three' :
                    jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_adsense3').parents('.option-inner').show();
                    jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_adsense3').parents('.form-field').show();
                break;
                case 'four' :
                    jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_adsense3,#interakt_bfcontent_ads_adsense4').parents('.option-inner').show();
                    jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_adsense3,#interakt_bfcontent_ads_adsense4').parents('.form-field').show();
                break;
                case 'five' :
                    jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_adsense3,#interakt_bfcontent_ads_adsense4,#interakt_bfcontent_ads_adsense5').parents('.option-inner').show();
                    jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_adsense3,#interakt_bfcontent_ads_adsense4,#interakt_bfcontent_ads_adsense5').parents('.form-field').show();
                break;
                case 'six' :
                    jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_adsense3,#interakt_bfcontent_ads_adsense4,#interakt_bfcontent_ads_adsense5,#interakt_bfcontent_ads_adsense6').parents('.option-inner').show();
                    jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_adsense3,#interakt_bfcontent_ads_adsense4,#interakt_bfcontent_ads_adsense5,#interakt_bfcontent_ads_adsense6').parents('.form-field').show();
                break;
                default :
                    jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_adsense3,#interakt_bfcontent_ads_adsense4,#interakt_bfcontent_ads_adsense5,#interakt_bfcontent_ads_adsense6,#interakt_bfcontent_ads_adsense7').parents('.option-inner').show();
                    jQuery('#interakt_bfcontent_ads_adsense1,#interakt_bfcontent_ads_adsense2,#interakt_bfcontent_ads_adsense3,#interakt_bfcontent_ads_adsense4,#interakt_bfcontent_ads_adsense5,#interakt_bfcontent_ads_adsense6,#interakt_bfcontent_ads_adsense7').parents('.form-field').show();
            }
        }
        
        //slider
        if (options['slider_hoverPause'])
        {
            jQuery('.slider_pause').show();
            jQuery('.slider_pause').next('.tfclear').show();
        }
        else
        {
            jQuery('.slider_pause').hide();
            jQuery('.slider_pause').next('.tfclear').hide();
        }

        if ( (options['map_type'] == 'map3') && (options['interakt_header_element'] == 'map') && homepage)
        {
            jQuery('#interakt_map_address').parents('.option-inner').show();
            jQuery('#interakt_map_address').parents('.form-field').show();
        }
    }
});