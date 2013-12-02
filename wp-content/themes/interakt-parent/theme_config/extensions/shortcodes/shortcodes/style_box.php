<?php
//Style Box
function tfuse_styled_box($atts, $content = null) {

    //extract short code attr
    extract(shortcode_atts(array(
        'title' => '',
        'class' => '',
    ), $atts));


    $return_html = '<div class="sb '.$class.'"><div class="box_title">'.$title.'</div>';
    $return_html.= '<div class="box_content">'.html_entity_decode(do_shortcode($content)).'<div class="clear"></div></div></div>';

    return $return_html;
}

$atts = array(
    'name' => 'Styled Box',
    'desc' => 'Here comes some lorem ipsum description for the box shortcode.',
    'category' => 7,
    'options' => array(
        array(
            'name' => 'Title',
            'desc' => 'Text to display above the box',
            'id' => 'tf_shc_styled_box_title',
            'value' => 'Styled box',
            'type' => 'text'
        ),
        array(
            'name' => 'Class',
            'desc' => 'Specify a class for an shortcode, ex: sb_pink,sb_yellow,sb_blue,sb_green,sb_dark,<br>sb_purple,sb_orange,',
            'id' => 'tf_shc_styled_box_class',
            'value' => '',
            'type' => 'text'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => 'Content',
            'desc' => 'Enter shortcode content',
            'id' => 'tf_shc_styled_box_content',
            'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('styled_box', 'tfuse_styled_box', $atts);

?>