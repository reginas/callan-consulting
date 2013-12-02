<?php

add_action( 'wp_print_styles', 'tfuse_add_css' );
add_action( 'wp_print_scripts', 'tfuse_add_js' );

if ( ! function_exists( 'tfuse_add_css' ) ) :
/**
 * This function include files of css.
 */
    function tfuse_add_css()
    {
         tfuse_change_style(); 
        wp_register_style( 'screen_css', tfuse_get_file_uri('/screen.css'));
        wp_enqueue_style( 'screen_css' );

        wp_register_style( 'cusel', tfuse_get_file_uri('/css/cusel.css'), false, '' );
        wp_enqueue_style( 'cusel' );
        
        wp_register_style( 'flexslider', tfuse_get_file_uri('/css/flexslider.css'), false, '' );
        wp_enqueue_style( 'flexslider' );
        
        wp_register_style( 'prettyPhoto', TFUSE_ADMIN_CSS . '/prettyPhoto.css', false, '' );
        wp_enqueue_style( 'prettyPhoto' );
        
        wp_register_style( 'shCore', tfuse_get_file_uri('/css/shCore.css'), true, '' );
        wp_enqueue_style( 'shCore' );
        
        wp_register_style( 'shThemeDefault', tfuse_get_file_uri('/css/shThemeDefault.css'), true, '' );
        wp_enqueue_style( 'shThemeDefault' );

    }
endif;


if ( ! function_exists( 'tfuse_add_js' ) ) :
/**
 * This function include files of javascript.
 */
    function tfuse_add_js()
    {

        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'jquery-ui-core' );
        
        wp_register_script( 'modernizr', tfuse_get_file_uri('/js/libs/modernizr.min.js'), array('jquery'), '', false );
        wp_enqueue_script( 'modernizr' );	
		
        wp_register_script( 'respond', tfuse_get_file_uri('/js/libs/respond.min.js'), array('jquery'), '', false );
        wp_enqueue_script( 'respond' );	

        wp_register_script( 'jquery.easing', tfuse_get_file_uri('/js/jquery.easing.1.3.min.js'), array('jquery'), '', false );
        wp_enqueue_script( 'jquery.easing' );
		
        wp_register_script( 'hoverIntent', tfuse_get_file_uri('/js/hoverIntent.js'), array('jquery'), '', false );
        wp_enqueue_script( 'hoverIntent' );

        wp_register_script( 'general', tfuse_get_file_uri('/js/general.js'), array('jquery'), '', false );
        wp_enqueue_script( 'general' );
		
        wp_register_script( 'carouFredSel', tfuse_get_file_uri('/js/jquery.carouFredSel.packed.js'), array('jquery'), '', false );
        wp_enqueue_script( 'carouFredSel' );
		
        wp_register_script( 'touchSwipe', tfuse_get_file_uri('/js/jquery.touchSwipe.min.js'), array('jquery'), '', false );
        wp_enqueue_script( 'touchSwipe' );
        
        wp_register_script( 'cusel-min', tfuse_get_file_uri('/js/cusel-min.js'), array('jquery'), '', false );
        wp_enqueue_script( 'cusel-min' );
        
        wp_register_script( 'jquery.tools', tfuse_get_file_uri('/js/jquery.tools.min.js'), array('jquery'), '', false );
        wp_enqueue_script( 'jquery.tools' );
        
        wp_register_script( 'slides.min.jquery', tfuse_get_file_uri('/js/slides.min.jquery.js'), array('jquery'), '', false );
        wp_enqueue_script( 'slides.min.jquery' );
        
        wp_register_script( 'search-input', tfuse_get_file_uri('/js/search-input.js'), array('jquery'), '', false );
        wp_enqueue_script( 'search-input' );
        
        wp_register_script( 'mousewheel', tfuse_get_file_uri('/js/jquery.mousewheel.min.js'), array('jquery'), '', false );
        wp_enqueue_script( 'mousewheel' );
        
        wp_register_script( 'customInput', tfuse_get_file_uri('/js/jquery.customInput.js'), array('jquery'), '', false );
        wp_enqueue_script( 'customInput' );
        
        wp_register_script( 'infieldlabel', tfuse_get_file_uri('/js/jquery.infieldlabel.min.js'), array('jquery'), '', false );
        wp_enqueue_script( 'infieldlabel' );
        
        wp_register_script( 'flexslider', tfuse_get_file_uri('/js/jquery.flexslider-min.js'), array('jquery'), '', false );
        wp_enqueue_script( 'flexslider' );
        
        wp_register_script( 'prettyPhoto', TFUSE_ADMIN_JS . '/jquery.prettyPhoto.js', array('jquery'), '3.1.4', false );
        wp_enqueue_script( 'prettyPhoto' );
        
        wp_register_script( 'jquery.gmap', tfuse_get_file_uri('/js/jquery.gmap.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.gmap' );
        
        // JS is include on the footer
        wp_register_script( 'shCore', tfuse_get_file_uri('/js/shCore.js'), array('jquery'), '', true );
        wp_enqueue_script( 'shCore' );
        
        wp_register_script( 'shBrushPlain', tfuse_get_file_uri('/js/shBrushPlain.js'), array('jquery'), '', true );
        wp_enqueue_script( 'shBrushPlain' );      
        
        wp_register_script( 'SyntaxHighlighter', tfuse_get_file_uri('/js/SyntaxHighlighter.js'), array('jquery'), '', true );
        wp_enqueue_script( 'SyntaxHighlighter' );

    }
endif;
