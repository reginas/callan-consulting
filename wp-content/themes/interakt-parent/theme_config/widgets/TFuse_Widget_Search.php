<?php

// =============================== Search widget ======================================

class TFuse_Widget_Search extends WP_Widget {

	function TFuse_Widget_Search() {
            $widget_ops = array('classname' => 'widget_search', 'description' => __( "A search form for your site","tfuse") );
            $this->WP_Widget('search', __('TFuse Search','tfuse'), $widget_ops);
	}

	function widget($args, $instance) { 
            extract($args);
            $title = apply_filters('widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base);
              $instance['position'] = empty( $instance['position'] ) ? '' : $instance['position'];
              $b = $instance['b'] = empty( $instance['b'] ) ? '' : $instance['b'];
            if(!$instance['b']) $b = 'widget-content'; else $b = 'widget-container';
            if($instance['position']=='footer') $p = '<label class="screen-reader-text" for="s">'.__('Search for:','tfuse').'</label>'; 
            else $p = '';
            ?>
			<div class="<?php echo $b;?> widget_search">
				<?php if($title) :?><h3><?php echo $title; ?></h3> <?php endif;?>
                                <div class="inner">
                                    <form method="get" id="searchform" action="<?php echo home_url( '/' ) ?>">
                                        <div>
                                            <?php if(!empty($p)) echo $p;?>
                                            <input type="text" value="<?php _e('Search this blog', 'tfuse'); ?>" onfocus="if (this.value == '<?php _e('Search this blog', 'tfuse'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search this blog', 'tfuse'); ?>';}" name="s" id="s" class="inputField" />
                                            <input type="submit" id="searchsubmit"  class="btn-submit" value="<?php _e('Search', 'tfuse'); ?>"/>
                                            <div class="clear"></div>
                                        </div>
                                    </form>
                                </div>
			</div>
			<?php
        }

	function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
            $instance['title'] = $new_instance['title'];
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
	}

	function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, array(  'template' => 'box_white','b' => '') );
            $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
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
            <p><input id="<?php echo $this->get_field_id('b'); ?>" name="<?php echo $this->get_field_name('b'); ?>" type="checkbox" <?php checked(isset($instance['b']) ? $instance['b'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('b'); ?>"><?php _e('Background','tfuse'); ?></label></p>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
<?php
	}
}

function TFuse_Unregister_WP_Widget_Search() {
	unregister_widget('WP_Widget_Search');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Search');

register_widget('TFuse_Widget_Search');
