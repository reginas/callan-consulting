<?php

function tfuse_freebies($atts, $content = null) {
    extract(shortcode_atts(array( 'order' => '','title' => '','btncolor'=>'','colortitle'=>'',
        'item'=>''), $atts));

    $output = '';

    if (!empty($order) && ($order == 'ASC' || $order == 'DESC'))
        $order = $order;
    else
        $order = 'ASC';

    $posts = tfuse_extract_freebies($order);
    $taxonomy = tfuse_get_work_categories();
    if(!empty($taxonomy)) $link = get_bloginfo('url').'/?post_type=work&posts=freebie';
    else $link = '#';
    $k = 0;
    $sidebar_position = tfuse_sidebar_position();
    if(!empty($posts))
    {
        $output .='<div class="widget-more">';

        $output .='<div class="post-more">
                    <h2 class="text-bold text-darkgray">'.$title.'</h2>
                    <h4>'. do_shortcode($content).'</h4>
                    <div class="space"></div>
                    <a href="'.$link.'" class="btn button_styled_medium btn_'.$btncolor.'">
                        <span style="color:'.$colortitle.';">'.__('View the Library','tfuse').'</span>
                    </a>
                    <div class="space"></div>  
                </div>';
            $output .='<div class="freebiesCol">';

            foreach ($posts as $post) {
                    $k++; 
                    if($k == $item+1) break;

                    $img = tfuse_page_options('thumbnail_image','',$post->ID);
                    if(!empty($img)) $img = '<img src="'.$img.'" width="125" height="92" alt="">';
                    if(($sidebar_position == 'full'))
                    {
                        if($k%4 == 1)  $output .= '<div class="row" style="float:left;">';
                        $output .= '<div class="freebie col col_1_4">
                                        <div class="inner">
                                            <div class="work-item">
                                                <div class="work-img">'.$img.'</div>
                                                <div class="mini-work-title">
                                                    <a href="'.get_permalink( $post->ID ).'"><h4 class="text-black text-bold">'.$post->post_title.'</h4></a>
                                                    <p class="text-gray">'.strip_tags(tfuse_shorten_string(apply_filters('the_content',$post->post_content),10)).'</p>
                                                </div>
                                             </div>
                                        </div>
                                    </div>';
                        if($k % 4 == 0 || $k == count($posts))  $output .= '</div><div class="space"></div>';
                    }
                    else
                    {
                         if($k%4 == 1)  $output .= '<div class="row" style="float:left;">';
                        $output .= '<div class="freebie col col_1_4">
                                        <div class="inner">
                                            <div class="work-item">
                                                <div class="work-img">'.$img.'</div>
                                                <div class="mini-work-title">
                                                    <a href="'.get_permalink( $post->ID ).'"><h4 class="text-black text-bold">'.$post->post_title.'</h4></a>
                                                    <p class="text-gray">'.strip_tags(tfuse_shorten_string(apply_filters('the_content',$post->post_content),10)).'</p>
                                                </div>
                                             </div>
                                        </div>
                                    </div>';
                        if($k % 4 == 0 || $k == count($posts))  $output .= '</div><div class="space"></div>';
                    }

                } // End WHILE Loop
            $output .='</div>';
        $output .='</div>';
    } 
    
    return '[raw]'.$output.'[/raw]';
}

$atts = array(
    'name' => 'Freebies',
    'desc' => 'Here comes some lorem ipsum description for the box shortcode.',
    'category' => 20,
    'options' => array(
        array(
            'name' => 'Order',
            'desc' => 'Select display order',
            'id' => 'tf_shc_freebies_order',
            'value' => 'ASC',
            'options' => array(
                'ASC' => 'Ascending',
                'DESC' => 'Descending'
            ),
            'type' => 'select'
        ),
        array(
            'name' => 'Title',
            'desc' => 'Give a title',
            'id' => 'tf_shc_freebies_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => 'Description',
            'desc' => 'Provide a description',
            'id' => 'tf_shc_freebies_content',
            'value' => '',
            'type' => 'textarea'
        ),
        array(
            'name' => 'Items',
            'desc' => 'Number of items to display',
            'id' => 'tf_shc_freebies_item',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => 'Button Color',
            'desc' => 'Select button color',
            'id' => 'tf_shc_freebies_btncolor',
            'value' => 'gray',
            'options' => array(
                'red' => 'Red',
                'blue' => 'Blue',
                'turquoise' => 'Turquoise',
                'yellow' => 'Yellow',
                'orange' => 'Orange',
                'pink' => 'Pink',
                'purple' => 'Purple',
                'green' => 'Green ',
                'black' => 'Black',
                'gray' => 'Gray'
            ),
            'type' => 'select'
        ),
        array(
            'name' => 'Title Color',
            'desc' => 'Choose color for button title',
            'id' => 'tf_shc_freebies_colortitle',
            'value' => '',
            'type' => 'colorpicker'
        )
    )
);

tf_add_shortcode('freebies', 'tfuse_freebies', $atts);
