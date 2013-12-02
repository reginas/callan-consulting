<?php

function tfuse_members($atts, $content = null) {
    extract(shortcode_atts(array( 'order' => ''), $atts));

    $template_directory = get_template_directory_uri();
    $output = '';  

    if (!empty($order) && ($order == 'ASC' || $order == 'DESC'))
        $order = '&order=' . $order;
    else
        $order = '&orderby=rand';

    $posts = get_posts('post_type=members&posts_per_page=-1' . $order);
    $k = 0;
    $sidebar_position = tfuse_sidebar_position();
    foreach ($posts as $post ) { 
                $k++;
                $img = tfuse_page_options('img','',$post->ID);
                $job = tfuse_page_options('job','',$post->ID);
                $desc = tfuse_page_options('desc','',$post->ID);
                $nick = tfuse_page_options('nickname','',$post->ID);
                $terms = get_the_terms(get_the_ID(), 'members','',$post->ID);

                if (!is_wp_error($terms) && !empty($terms))
                    foreach ($terms as $term){ 
                        $positions .= ', ' . $term->name;
                    }
                if(!empty($img)) $img = '<img src="'.$img.'" width="201" height="201" alt="">';
                else $img = '<img src="'.$template_directory.'/images/avatar-member.jpg" width="201" height="201" alt="">';
                if(($sidebar_position == 'full'))
                {
                    if($k%4 == 1)  $output .= '<div class="row">';
                    $output .= '
                         <div class="col col_1_4 ">
                            <div class="inner">
                                <a href="'.get_permalink($post->ID).'">
                                    <div class="team-box-hover">
                                        <div class="team-description">
                                            <div class="team-image">'.$img.'</div>
                                            <div class="team-text">
                                                <h4>'.tfuse_qtranslate($post->post_title).'</h4>
                                                <h5>'.$job.'</h5>
                                                '.$desc.'
                                                <div class="team-contact">'.$nick.'</div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>        
                                    </div>
                                </a>
                            </div>
                        </div>';
                    if($k % 4 == 0 || $k == count($posts))  $output .= '</div>';
                }
                else
                {
                     if($k%3 == 1)  $output .= '<div class="row">';
                    $output .= '
                         <div class="col col_1_3 ">
                            <div class="inner">
                                <a href="'.get_permalink($post->ID).'">
                                    <div class="team-box-hover">
                                        <div class="team-description">
                                            <div class="team-image">'.$img.'</div>
                                            <div class="team-text">
                                                <h4>'.tfuse_qtranslate($post->post_title).'</h4>
                                                <h5>'.$job.'</h5>
                                                '.$desc.'
                                                <div class="team-contact">'.$nick.'</div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>        
                                    </div>
                                </a>
                            </div>
                        </div>';
                    if($k % 3 == 0 || $k == count($posts))  $output .= '</div>';
                }
 
            } // End WHILE Loop
    
    return $output;
}

$atts = array(
    'name' => 'Members',
    'desc' => 'Here comes some lorem ipsum description for the box shortcode.',
    'category' => 20,
    'options' => array(
        array(
            'name' => 'Order',
            'desc' => 'Select display order',
            'id' => 'tf_shc_members_order',
            'value' => 'ASC',
            'options' => array(
                'RAND' => 'Random',
                'ASC' => 'Ascending',
                'DESC' => 'Descending'
            ),
            'type' => 'select'
        )
    )
);

tf_add_shortcode('members', 'tfuse_members', $atts);
