<?php

/**
 * Divider Styles
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * type: space, space_thin, dots, dots_full, thin  
 */

function tfuse_text_box($atts,$content = null)
{
    extract( shortcode_atts(array('type' => '','title' => '','number' => '','bg' => ''), $atts) );
    $title = (!empty($title)) ? $title : '';
    $out = '';
    $bgr = '';
    if($type == 'type1')
    {
        $out .='<div class="text-box-1">
            <p>'.$title.'</p>
            <span>'.do_shortcode($content).'</span>
        </div>';
    }
    else
    {
        switch($bg)
        {
            case 'bg1': $bgr = 'bg-orange-1';break;
            case 'bg2': $bgr = 'bg-orange-2';break;
            case 'bg3': $bgr = 'bg-orange-3';break;
            case 'bg4': $bgr = 'bg-orange-4';break;
            case 'bg5': $bgr = 'bg-orange-5';break;
            case 'bg6': $bgr = 'bg-orange-6';break;
                   
        }
        
        $out .='<div class="text-box-2">
                    <p class="num-box '.$bgr.' text-white">'.$number.'</p>
                    <h2 class="text-bold">'.$title.'</h2>
                        <div class="clear"></div>
                    <p>'.do_shortcode($content).'</p>
                </div>';
    }
    
    return $out;
}

$atts = array(
    'name' => 'Text Boxes',
    'desc' => 'Here comes some lorem ipsum description for this shortcode.',
    'category' => 9,
    'options' => array(
        array(
            'name' => 'Type',
            'desc' => 'Select box type',
            'id' => 'tf_shc_text_box_type',
            'value' => 'type2',
            'options' => array(
                'type1' => 'Type 1',
                'type2' => 'Type 2'
            ),
            'type' => 'select'
        ),
        array(
            'name' => 'Background',
            'desc' => 'Select box background',
            'id' => 'tf_shc_text_box_bg',
            'value' => 'bg1',
            'options' => array(
                'bg1' => 'Bg-Orange 1',
                'bg2' => 'Bg-Orange 2',
                'bg3' => 'Bg-Orange 3',
                'bg4' => 'Bg-Orange 4',
                'bg5' => 'Bg-Orange 5',
                'bg6' => 'Bg-Orange 6'
            ),
            'type' => 'select'
        ),
        array(
            'name' => 'Title',
            'desc' => 'Specifies the title',
            'id' => 'tf_shc_text_box_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => 'Number',
            'desc' => 'Specifies the box number',
            'id' => 'tf_shc_text_box_number',
            'value' => '',
            'type' => 'text'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => 'Content',
            'desc' => 'Enter description',
            'id' => 'tf_shc_text_box_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('text_box', 'tfuse_text_box', $atts);