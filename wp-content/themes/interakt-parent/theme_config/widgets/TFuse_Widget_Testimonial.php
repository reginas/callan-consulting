<?php
class TFuse_Widget_Testimonial extends WP_Widget {

    function TFuse_Widget_Testimonial()
    {
        $widget_ops = array('classname' => '', 'description' => __("Display and rotate your testimonials","tfuse"));
        $this->WP_Widget('testimonial', __('TFuse - Testimonial','tfuse'), $widget_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
		$testimonials_uniq = rand(1, 300);
                $testtitle = '';
        $title = apply_filters( 'widget_title',  empty($instance['title']) ? __('Testimonial','tfuse') : $instance['title'], $instance, $this->id_base);
        $instance['position'] = empty( $instance['position'] ) ? '' : $instance['position'];
        if (@$instance['random'])
            $order = '&order=ASC';
        else
            $order = '&orderby=rand';
        $slide = $nav = $single = '';
        query_posts('post_type=testimonials&posts_per_page=-1' . $order);
    if($instance['position']=='sidebar')
    {
        $k = 0;
       if (have_posts()) {
            while (have_posts()) {

                $k++;
                the_post();
                 $id = get_the_ID();
                 $img = tfuse_page_options('img');
                 $job = tfuse_page_options('employee');
                 $nick = tfuse_page_options('nickname');
                $positions = '';
                $terms = get_the_terms(get_the_ID(), 'testimonials');

                if (!is_wp_error($terms) && !empty($terms))
                    foreach ($terms as $term){ 
                        $positions .= ', ' . $term->name;
                    }
                if(!empty($img)) $img = '<img src="'.$img .'" width="32" height="32" alt="" class="alignleft">';
                $slide .= '
                    <div class="slide">
                        <div class="quote-author">'.$img.'
                       <p class="name-user">'.get_the_title().'</p><p class="post-user">'.$job.'</p>
                       <p class="email-user">'.$nick.'</p><div class="corner-bottom"></div></div>
                        <div class="quote-text">'.get_the_excerpt().'</div></div>
            ';
            } // End WHILE Loop
        } // End IF Statement
        wp_reset_query();

        if ($k > 1) {
            $nav = '<a href="#" class="prev" >' . __('Prev', 'tfuse') . '</a>
            <a href="#" class="next"  >' . __('Next', 'tfuse') . '</a>';
        }
        else
            $single = ' style="display: block"';

        $output = ' 
        <div id="testimonials'.$testimonials_uniq.'" class="widget-container slideshow slideQuotes">
           <div class="slides_container"' . $single . '>' . $slide . '</div>
            ' . $nav . '<div class="clear"></div></div>
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
        $title = tfuse_qtranslate($title);
		
        if (have_posts()) {
                the_post();
                 $id = get_the_ID();
                 $img = tfuse_page_options('img');
                 $job = tfuse_page_options('employee');
                 $nick = tfuse_page_options('nickname');
                $positions = '';
                $terms = get_the_terms(get_the_ID(), 'testimonials');

                if (!is_wp_error($terms) && !empty($terms))
                    foreach ($terms as $term){ 
                        $positions .= ', ' . $term->name;
                    }
                if(!empty($img)) $img = '<img src="'.$img .'" width="32" height="32" alt="" class="ava_white">';
                $slide .= '
                        <div class="testimonials-user">
                            '.$img.'
                            <p class="name-user">' . get_the_title() . '</p>
                            <p class="post-user">'.$job.'</p>
                            <p class="email-user">'.$nick.'</p>
                            <div class="widget-corner-bottom"></div>
                        </div>
                        <div class="widget-user-comment text-gray">
                        ' .get_the_excerpt() . '
                        </div>
            ';
        } // End IF Statement
        wp_reset_query();
        if ( $title )
            $testtitle .= '<h3 class="widget-title">'.$title.'</h3>';
        $output = '
        <div class="widget-container widget-testimonials ">'.$testtitle.'' . $slide . '
        </div>
        ';
    }
    echo $output;

    }
    function update($new_instance, $old_instance)
    { $instance = $old_instance;
        $instance['random'] = isset($new_instance['random']);
        $instance['title'] = $new_instance['title'];
         if ( in_array( $new_instance['position'], array( 'sidebar', 'footer' ) ) ) 
		{
                    $instance['position'] = $new_instance['position'];
                } 
                        else 
                        {
                    $instance['position'] = 'sidebar';
                }
        return $instance;

    } // End function update

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'random' => '') );
        $title = $instance['title'];
         @$position = esc_attr( $instance['position'] );

        ?>
        <p>
                    <label for="<?php echo $this->get_field_id('position'); ?>"><?php _e( 'Position:' ,'tfuse'); ?></label>
                    <select name="<?php echo $this->get_field_name('position'); ?>" id="<?php echo $this->get_field_id('position'); ?>" class="widefat">
                        <option  value="sidebar"<?php selected( @$instance['position'], 'sidebar' ); ?>><?php _e('Sidebar','tfuse'); ?></option>
                        <option  value="footer"<?php selected( @$instance['position'], 'footer' ); ?>><?php _e('Footer','tfuse'); ?></option>
                    </select>
                </p>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (just in footer):','tfuse'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
    <p><input id="<?php echo $this->get_field_id('random'); ?>" name="<?php echo $this->get_field_name('random'); ?>" type="checkbox" <?php checked(isset($instance['random']) ? $instance['random'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('random'); ?>"><?php _e('Disable Random','tfuse'); ?></label></p>
         <?php
       }

}
register_widget('TFuse_Widget_Testimonial'); ?>
