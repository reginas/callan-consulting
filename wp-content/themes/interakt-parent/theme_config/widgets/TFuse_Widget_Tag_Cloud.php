<?php
class TFuse_Widget_Tag_Cloud extends WP_Widget {

	function TFuse_Widget_Tag_Cloud() {
		$widget_ops = array( 'description' => __( "Your most used tags in cloud format","tfuse") );
		$this->WP_Widget('tag_cloud', __('TFuse Tag Cloud','tfuse'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$current_taxonomy = $this->_get_current_taxonomy($instance);
                $b = $instance['b'] = empty( $instance['b'] ) ? '' : $instance['b'];
                 $instance['position'] = empty( $instance['position'] ) ? '' : $instance['position'];
		if ( !empty($instance['title']) ) {
			$title = $instance['title'];
		} else {
			if ( 'post_tag' == $current_taxonomy ) {
				$title = __('Tags','tfuse');
			} else {
				$tax = get_taxonomy($current_taxonomy);
				$title = $tax->labels->name;
			}
		}
                if(!$instance['b']) $b = 'widget-content'; else $b = 'widget-container';
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);
		$before_widget = '<div class=" '.$b.' widget_tag_cloud">';
		$after_widget = '</div>';
		$before_title = '<h3 class="widget-title">';
		$after_title = '</h3>';


		echo $before_widget;
		$title = tfuse_qtranslate($title);
		if ( $title ) ?>
    <?php
           echo $before_title . $title. $after_title;
           if( $instance['position'] == 'sidebar')
            {
                echo '<div class="tagcloud">';
                wp_tag_cloud( apply_filters('widget_tag_cloud_args', array('taxonomy' => $current_taxonomy) ) );
                echo "</div>\n";
            }
            elseif( $instance['position'] == 'footer') 
            {
                echo '<div class="tagcloud">';
                if($current_taxonomy == 'category')
                {
                    wp_tag_cloud( apply_filters('widget_tag_cloud_args', array('taxonomy' => 'group') ) );
                }
                else
                {
                    wp_tag_cloud( apply_filters('widget_tag_cloud_args', array('taxonomy' => 'tags') ) );
                }
                echo "</div>\n";
            }
            else
            {
                echo '<div class="tagcloud">';
                if($current_taxonomy == 'category')
                {
                    wp_tag_cloud( apply_filters('widget_tag_cloud_args', array('taxonomy' => 'services') ) );
                }
                else
                {
                    wp_tag_cloud( apply_filters('widget_tag_cloud_args', array('taxonomy' => 'metatag') ) );
                }
                echo "</div>\n";
            }
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['taxonomy'] = stripslashes($new_instance['taxonomy']);
                $instance['b'] = isset($new_instance['b']);
                if ( in_array( $new_instance['position'], array( 'sidebar', 'footer' , 'service') ) ) 
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
		$instance = wp_parse_args( (array) $instance, array( 'template' => '','b' => '','position' => '') );
		$current_taxonomy = $this->_get_current_taxonomy($instance);
                @$position = esc_attr( $instance['position'] );
?>
<p>
        <label for="<?php echo $this->get_field_id('position'); ?>"><?php _e( 'Select from:' ,'tfuse'); ?></label>
        <select name="<?php echo $this->get_field_name('position'); ?>" id="<?php echo $this->get_field_id('position'); ?>" class="widefat">
            <option  value="sidebar"<?php selected( @$instance['position'], 'sidebar' ); ?>><?php _e('Categories','tfuse'); ?></option>
            <option  value="footer"<?php selected( @$instance['position'], 'footer' ); ?>><?php _e('Works','tfuse'); ?></option>
            <option  value="service"<?php selected( @$instance['position'], 'service' ); ?>><?php _e('Services','tfuse'); ?></option>
        </select>
                </p>
        <p><input id="<?php echo $this->get_field_id('b'); ?>" name="<?php echo $this->get_field_name('b'); ?>" type="checkbox" <?php checked(isset($instance['b']) ? $instance['b'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('b'); ?>"><?php _e('Background','tfuse'); ?></label></p>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse') ?></label>
	<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>
	<p><label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Taxonomy:','tfuse') ?></label>
	<select class="widefat" id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>">
	<?php foreach ( get_object_taxonomies('post') as $taxonomy ) :
				$tax = get_taxonomy($taxonomy);
				if ( !$tax->show_tagcloud || empty($tax->labels->name) )
					continue;
	?>
		<option value="<?php echo esc_attr($taxonomy) ?>" <?php selected($taxonomy, $current_taxonomy) ?>><?php echo $tax->labels->name; ?></option>
	<?php endforeach; ?>
	</select></p>
    <?php
	}

	function _get_current_taxonomy($instance) {
		if ( !empty($instance['taxonomy']) && taxonomy_exists($instance['taxonomy']) )
			return $instance['taxonomy'];

		return 'post_tag';
	}
}



function TFuse_Unregister_WP_Widget_Tag_Cloud() {
	unregister_widget('WP_Widget_Tag_Cloud');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Tag_Cloud');

register_widget('TFuse_Widget_Tag_Cloud');
