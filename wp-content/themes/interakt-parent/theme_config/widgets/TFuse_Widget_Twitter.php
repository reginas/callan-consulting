<?php
class TFuse_Widget_Twitter extends WP_Widget {

    function TFuse_Widget_Twitter()
    {
        $widget_ops = array('classname' => '', 'description' => __("Display tweets","tfuse"));
        $this->WP_Widget('twitter', __('TFuse - Twitter','tfuse'), $widget_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters( 'widget_title',  empty($instance['title']) ? __('Twitter','tfuse') : $instance['title'], $instance, $this->id_base);
        $b = $instance['b'] = empty( $instance['b'] ) ? '' : $instance['b'];
        $username = apply_filters( 'widget_items', $instance['username'], $instance, $this->id_base);
        $items = apply_filters( 'widget_items', $instance['items'], $instance, $this->id_base);
        $instance['position'] = empty( $instance['position'] ) ? '' : $instance['position'];
        $return_html = '';
        if(!$instance['b']) $b = 'widget-content'; else $b = 'widget-container';
        
        if($instance['position']=='sidebar')
        {   
            if ( !empty($username) )
            {
                $tweets = tfuse_get_tweets($username,$items);

                $return_html .= '<div class="'.$b.' widget_twitter">';

                if (!empty($title))
                    $return_html .= '<h3 class="widget-title">' . $title . '</h3>';
                $return_html .= '<div class="tweet_list"> ';
                foreach ( $tweets as $tweet )
                {
                    $return_html .= '<div class="tweet_item">';
                    if( isset($tweet->text) )
                    {
                        $return_html .= '<div class="tweet_text">
                                                <div class="inner">'.$tweet->text.
                                        '</div></div>' ;
                    }
                    if ( !empty($tweet->created_at) )
                        $return_html .= '<span class="tweet_time">'.$tweet->created_at.'</span>';

                    $return_html .= '<div class="clear"></div></div>';
                }

                $return_html .= '</div></div>';
            }
        }
        else
        {
            if ( !empty($username) )
            {
                $tweets = tfuse_get_tweets($username,$items);
                if(!sizeof($tweets)) return;

                $return_html .= '<div class="widget-container widget_twitter">';
               
                if (!empty($title))
                    $return_html .= '<h3 class="widget-title">' . $title . '</h3>';
                 $return_html .= '<ul> ';
                 
                foreach ( $tweets as $tweet )
                {
                    $return_html .= '<li><div class="tweet_item">';
                    $return_html .= '<div class="tweet_image"><img src="'.$tweet->user->profile_image_url.'" width="32" height="32""></div>';
                    if( isset($tweet->text) )
                    {
                        $return_html .= '<div class="tweet_text">
                                                <div class="inner">'.$tweet->text;
                                                 if ( !empty($tweet->created_at) )
                        $return_html .= '<span class="tweet_time">'.$tweet->created_at.'</span>';
                       $return_html .='</div></div>' ;
                    }
                   

                    $return_html .= '<div class="clear"></div></div></li>';
                }

                $return_html .= '</ul></div>';
            }
        }
            echo $return_html;
    }
    function update($new_instance, $old_instance)
    { $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['username'] = $new_instance['username'];
        $instance['items'] = $new_instance['items'];
        $instance['b'] = isset($new_instance['b']);
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
        $instance = wp_parse_args( (array) $instance, array( 'title' => '','username' => '','items' => '','b' => '') );
        $title = $instance['title'];
        $username = $instance['username'];
        $items = $instance['items'];
        @$position = esc_attr( $instance['position'] );

        ?>
            <p>
                    <label for="<?php echo $this->get_field_id('position'); ?>"><?php _e( 'Position:' ,'tfuse'); ?></label>
                    <select name="<?php echo $this->get_field_name('position'); ?>" id="<?php echo $this->get_field_id('position'); ?>" class="widefat">
                        <option  value="sidebar"<?php selected( @$instance['position'], 'sidebar' ); ?>><?php _e('Sidebar','tfuse'); ?></option>
                        <option  value="footer"<?php selected( @$instance['position'], 'footer' ); ?>><?php _e('Footer','tfuse'); ?></option>
                    </select>
                </p>
<p><input id="<?php echo $this->get_field_id('b'); ?>" name="<?php echo $this->get_field_name('b'); ?>" type="checkbox" <?php checked(isset($instance['b']) ? $instance['b'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('b'); ?>"><?php _e('Background','tfuse'); ?></label></p>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
         <p><label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username:','tfuse'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo esc_attr($username); ?>" /></p>
         <p><label for="<?php echo $this->get_field_id('items'); ?>"><?php _e('Items:','tfuse'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></p>
        <?php
       }

}
register_widget('TFuse_Widget_Twitter'); ?>