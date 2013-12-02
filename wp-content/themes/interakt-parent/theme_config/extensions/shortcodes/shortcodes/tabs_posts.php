<?php
//Recent / Most Commented Widget

function tfuse_tabs_posts($atts) {
    extract(shortcode_atts(array('items' => ''), $atts));
   
    
    $popular_posts  = tfuse_shortcode_posts(array(
                                'sort' => 'popular',
                                'items' => $items,
                                'image_post' => true,
                                'image_width' => 58,
                                'image_height' => 58,
                                'image_class' => 'thumbnail',
                                'date_format' => 'M j, Y',
                                'date_post' => true
                                ));
    
    $latest_posts = tfuse_shortcode_posts(array(
                                'sort' => 'commented',
                                'items' => $items,
                                'image_post' => true,
                                'image_width' => 58,
                                'image_height' => 58,
                                'image_class' => 'thumbnail',
                                'date_format' => 'M j, Y',
                                'date_post' => true,
                            ));
    $return_html = '';
    $numb = 1;
    $return_html .='<div class="tf_sidebar_tabs tabs_framed">
        <ul class="tabs">
            <li><a href="#tf_tabs_1">Recent Posts</a></li>
            <li><a href="#tf_tabs_2">Most Commented</a></li>
        </ul>';

    $return_html .= '<div id="tf_tabs_1" class="tabcontent">
                    <ul class="post_list recent_posts">';
                        foreach ($popular_posts as $post_val) {
                            $return_html .= '<li>';
                            $return_html .= '
                                        ' . ' <a href="' . $post_val['post_link'] . '" >' . $post_val['post_img'] . '</a>'. ' <a href="' . $post_val['post_link'] . '" >' . $post_val['post_title'] . '</a>
                                        ';
							if(!tfuse_options('date_time')):
								$return_html .=' <div class="date">' . $post_val['post_date_post'] . '</div>';
								endif;
                            $return_html .= '</li>';
                        }
    $return_html .='</ul>

        </div>

        <div id="tf_tabs_2" class="tabcontent">
                    <ul class="post_list popular_posts">';
                        foreach ($latest_posts as $post_val) {
                            $return_html .= '<li>';
                            $return_html .= '
                                        ' . ' <a href="' . $post_val['post_link'] . '" >' . $post_val['post_img'] . '</a> ';
                                            if ($numb < 10)
                                                $return_html .='<span class="post-nr">0'.$numb .'</span>';
                                            else
                                                $return_html .='<span class="post-nr">'.$numb .'</span>';
                            $return_html .= '<a href="' . $post_val['post_link'] . '" >&nbsp;' . $post_val['post_title'] . '</a>
                                        ';
							if(!tfuse_options('date_time')):
								$return_html .=' <div class="date">' . $post_val['post_date_post'] . '</div>';
								endif;
                            $return_html .= '</li>';
                            $numb++;
                        }
     $return_html .= '</ul>

        </div>

    </div>';

    return $return_html;
}

$atts = array(
    'name' => 'Tab Posts',
    'desc' => 'Here comes some lorem ipsum description for the box shortcode.',
    'category' => 2,
    'options' => array(
        array(
            'name' => 'Items',
            'desc' => 'Specifies the number of the post to show',
            'id' => 'tf_shc_tabs_posts_items',
            'value' => '5',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('tabs_posts','tfuse_tabs_posts', $atts);