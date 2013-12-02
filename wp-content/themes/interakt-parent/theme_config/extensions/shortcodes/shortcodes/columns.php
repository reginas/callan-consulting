<?php

/**
 * Columns
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * type: 1, 1_2, 1_3, 1_4, 2_3 etc.
 * class:

 */

function tfuse_col($atts, $content = null)
{
    extract(shortcode_atts(array('type' => '1', 'class' => ''), $atts));
    return '<div class="col col_' . $type . ' ' . $class . '"><div class="inner">' . do_shortcode($content) . '</div></div>';
}

$atts = array(
    'name' => 'Columns',
    'desc' => 'Here comes some lorem ipsum description for the button shortcode.',
    'category' => 4,
    'options' => array(
        array(
            'name' => 'Type',
            'desc' => 'Select column type',
            'id' => 'tf_shc_col_type',
            'value' => '_self',
            'options' => array(
                '1' => 'One column',
                '1_2' => 'One half column (1/2)',
                '1_3' => 'One third column (1/3)',
                '1_4' => 'A fourth column (1/4)',
                '1_6' => 'One-sixth column (1/6)',
                '2_3' => 'Two thirds column (2/3)',
                '3_4' => 'Three fourths column (3/4)',
            ),
            'type' => 'select'
        ),
        array(
            'name' => 'Class',
            'desc' => 'Specifies one or more class names for an shortcode:box box_border box_green,box box_border box_yellow,box box_border box_pink,box box_border box_blue...',
            'id' => 'tf_shc_col_class',
            'value' => '',
            'type' => 'text'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => 'Content',
            'desc' => 'Enter shortcode content',
            'id' => 'tf_shc_col_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('col', 'tfuse_col', $atts);
