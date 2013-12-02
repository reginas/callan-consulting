<?php
/**
 * Widget
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * name:
 * instance:
 * args:
 * 
 * http://codex.wordpress.org/Function_Reference/the_widget
 */

function tfuse_text_styles($atts, $content = null) {
    extract(shortcode_atts(array( 'type' => '','link' => '','target' => ''), $atts));
	$before = '';
	$after = '';
	switch(strtolower($type))
    {
		case 'link':
            $before = '<a href="'.$link.'" target="'.$target.'">';
            $after = '</a>';
            break;
	   case 'strong':
            $before = '<strong>';
            $after = '</strong>';
            break;
        case 'italic':
            $before = '<em>';
            $after = '</em>';
            break;
        case 'strike':
            $before = '<s>';
            $after = '</s>';
            break;
        case 'mark':
            $before = '<mark>';
            $after = '</mark>';
            break;
        case 'insert':
            $before = '<ins>';
            $after = '</ins>';
            break;
        case 'subscript':
            $before = '<sub>';
            $after = '</sub>';
            break;
        case 'superscript':
            $before = '<sup>';
            $after = '</sup>';
            break;
    }

    $return_html = $before . do_shortcode($content) . $after;
    
    return $return_html;
}

$atts = array(
    'name' => 'Text Styles',
    'desc' => 'Here comes some lorem ipsum description for the box shortcode.',
    'category' => 9,
    'options' => array(
		array(
            'name' => 'Type',
            'desc' => 'Specify the type',
            'id' => 'tf_shc_text_styles_type',
            'value' => 'link',
            'options' => array(
				'link' => 'link',
                'strong' => 'strong',
                'italic' => 'italic',
                'strike' => 'strike',
                'mark' => 'mark',
                'insert' => 'insert',
                'subscript' => 'subscript',
                'superscript' => 'superscript'
            ),
            'type' => 'select'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => 'Link',
            'desc' => 'Specifies the URL of the page the link goes to',
            'id' => 'tf_shc_text_styles_link',
            'value' => 'http://themefuse.com/',
            'type' => 'text'
        ),
		array(
            'name' => 'Target',
            'desc' => 'Specifies the the of the site the link goes to,ex:_blank,_self,_parent,_top',
            'id' => 'tf_shc_text_styles_target',
            'value' => '_blank',
            'type' => 'text'
        ),
		array(
            'name' => 'Content',
            'desc' => 'Enter Quotes Content',
            'id' => 'tf_shc_text_styles_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('text_styles', 'tfuse_text_styles', $atts);