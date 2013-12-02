<?php

/**
 * Testimonials
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * title:
 * order: RAND, ASC, DESC
 */
function tfuse_testimonials($atts, $content = null) {
    global $testimonials_uniq;
    extract(shortcode_atts(array( 'type' => 'none','box' => '','order' => ''), $atts));
    
    $slide = $nav = $box_type = $single = '';
	$title = '';
    $testimonials_uniq = rand(1, 300);

    if (!empty($order) && ($order == 'ASC' || $order == 'DESC'))
        $order = '&order=' . $order;
    else
        $order = '&orderby=rand';

    $posts = get_posts('post_type=testimonials&posts_per_page=-1' . $order);
    $k = 0;
    if($type == 'js')
    {
    foreach ($posts as $post) {
                $k++;
                 $img = tfuse_page_options('img','',$post->ID);
                 $job = tfuse_page_options('employee','',$post->ID);
                 $nick = tfuse_page_options('nickname','',$post->ID);
                $positions = '';
                $terms = get_the_terms(get_the_ID(), 'testimonials');

                if (!is_wp_error($terms) && !empty($terms))
                    foreach ($terms as $term){ 
                        $positions .= ', ' . $term->name;
                    }
                if(!empty($img)) $img = '<img src="'.$img .'" width="32" height="32" alt="" class="alignleft">';
                $slide .= '
                    <div class="slide">
                        <div class="quote-author">
                            '.$img.'
                            <p class="name-user">' . $post->post_title . '</p>
                            <p class="post-user">'.$job.'</p>
                            <p class="email-user">'.$nick.'</p>
                            <div class="corner-bottom"></div>
                        </div><!--/ .quote-author -->
                        <div class="quote-text">
                        ' .strip_tags(apply_filters('the_content',$post->post_content)) . '
                        </div><!--/ .quote-text -->
                    </div><!--/ .slide -->
            ';
            } // End WHILE Loop

        if ($k > 1) {
            $nav = '<a href="#" class="prev" >' . __('Prev', 'tfuse') . '</a>
            <a href="#" class="next"  >' . __('Next', 'tfuse') . '</a>';
        }
        else
            $single = ' style="display: block"';

        $output = '
        <div id="testimonials'.$testimonials_uniq.'" class="slideshow slideQuotes">
            ' . $title . '
            <div class="slides_container"' . $single . '>
            ' . $slide . '
            </div><!--/ .slides_container -->
            ' . $nav . '
                     <div class="clear"></div>
        </div><!--/ .slideshow slideQuotes -->
        <script>
                jQuery(document).ready(function($) {
                        $("#testimonials'.$testimonials_uniq.'").slides({
                                hoverPause: true,
                                autoHeight: true,
                                pagination: true,
                                generatePagination: true,
                                effect: "fade",
                                fadeSpeed: 150});
                });		
        </script>  ';
    }
    else
    {
        if($box == 'white') $box_type = '';
        else $box_type = 'box_light_gray';
        foreach ($posts as $post) { $k++;
            if($k == 2) break;
                 $img = tfuse_page_options('img','',$post->ID);
                 $job = tfuse_page_options('employee','',$post->ID);
                 $nick = tfuse_page_options('nickname','',$post->ID);
                $positions = '';

                if(!empty($img)) $img = '<img src="'.$img .'" width="32" height="32" alt="" class="ava_white">';
                $slide .= '
                        <div class="testimonial-user">
                            '.$img.'
                            <p class="name-user">' . $post->post_title . '</p>
                            <p class="post-user">'.$job.'</p>
                            <p class="email-user">'.$nick.'</p>
                            <div class="corner-bottom"></div>
                        </div>
                        <div class="testimonial-text">
                        ' .strip_tags(apply_filters('the_content',$post->post_content)) . '
                        </div>
            ';
        } // End IF Statement

        $output = '
        <div class="widget-container widget-testimonials '.$box_type.'">
            ' . $slide . '
        </div>
        ';
    }
    return $output;
}

$atts = array(
    'name' => 'Testimonials',
    'desc' => 'Here comes some lorem ipsum description for the box shortcode.',
    'category' => 11,
    'options' => array(
        array(
            'name' => 'Testimonial Type',
            'desc' => 'Select testimonial type',
            'id' => 'tf_shc_testimonials_type',
            'value' => 'none',
            'options' => array(
                'js' => 'As Slider',
                'none' => 'Simple'
            ),
            'type' => 'select'
        ),
        array(
            'name' => 'Box Type',
            'desc' => 'Select box type',
            'id' => 'tf_shc_testimonials_box',
            'value' => '',
            'options' => array(
                'white' => 'White Box',
                'gray' => 'Light Gray Box'
            ),
            'type' => 'select'
        ),
        array(
            'name' => 'Order',
            'desc' => 'Select display order',
            'id' => 'tf_shc_testimonials_order',
            'value' => '',
            'options' => array(
                'RAND' => 'Random',
                'ASC' => 'Ascending',
                'DESC' => 'Descending'
            ),
            'type' => 'select'
        )
    )
);

tf_add_shortcode('testimonials', 'tfuse_testimonials', $atts);
