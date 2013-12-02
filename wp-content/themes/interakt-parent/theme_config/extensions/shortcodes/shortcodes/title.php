<?php

/**
 * H Titles
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * [title]Subtitle of the paragraph <span>(h2)</span>[/title]
 * [title h4=""]H4 header example[/title]
 * [title h3="title_blue"]Blue Title[/title]
 * [title h3="title_black"]Black Title[/title]
 */

function tfuse_shortcode_title($atts, $content = null)
{
    extract(shortcode_atts(array('type' => 'h2',  'class' => 'tfuse'), $atts));
    $class = (!empty($class)) ? ' class="' . $class . '"' : '';
    return '<' . $type . $class . '>' . do_shortcode($content) . '</' . $type . '>';
}

$atts = array(
    'name' => 'Title',
    'desc' => 'Here comes some lorem ipsum description for the box shortcode.',
    'category' => 9,
    'options' => array(
        array(
            'name' => 'Type',
            'desc' => 'Select the type of the title',
            'id' => 'tf_shc_title_type',
            'value' => 'h2',
            'options' => array(
                'h1' => 'h1',
                'h2' => 'h2',
                'h3' => 'h3',
                'h4' => 'h4',
                'h5' => 'h5',
                'h6' => 'h6'
            ),

            'type' => 'select'
        ),
        array(
            'name' => 'Class',
            'desc' => 'Specifies one or more class names for an shortcode:text-bold,text-red,text-blue,text-gray,<br/>text-green,text-white,text-orange,text-regular,<br/>text-extrabold,text-italic,text-semibold',
            'id' => 'tf_shc_title_class',
            'value' => '',
            'type' => 'text'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => 'Content',
            'desc' => 'Enter title and if want specify the class do this in one of these fiealds (h1...h6)',
            'id' => 'tf_shc_title_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('title', 'tfuse_shortcode_title', $atts);
