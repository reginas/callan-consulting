<?php
class TFuse_Nav_Menu_Widget extends WP_Widget {

	function TFuse_Nav_Menu_Widget() {
		$widget_ops = array( 'description' => __('Add a custom menus as a widget.','tfuse') );
		parent::WP_Widget( 'nav_menu', __('TFuse Custom Menu','tfuse'), $widget_ops );
	}

	function widget($args, $instance) {
		// Get menu
		$nav_menu = wp_get_nav_menu_object( $instance['nav_menu'] );
                $type = '';
		if ( !$nav_menu )
			return;

		$instance['title'] = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
                $instance['position'] = empty( $instance['position'] ) ? '' : $instance['position'];
                if($instance['position'] == 'type2') $type = 'technology'; else $type = '';
		$args['before_widget'] = '<div class="widget-container widget_nav_menu '.$type.'">';
		$args['after_widget'] = '</div>';
		$args['before_title'] = '<h3 class="widget-title">';
		$args['after_title'] = '</h3>';

		echo $args['before_widget'];

		$instance['title'] = tfuse_qtranslate($instance['title']);
		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

			wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu, 'link_before'=> '<span>', 'link_after' => '</span>') );

			echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] =  $new_instance['title'] ;
		$instance['nav_menu'] = (int) $new_instance['nav_menu'];
                if ( in_array( $new_instance['position'], array( 'type1', 'type2' ) ) ) 
		{
            $instance['position'] = $new_instance['position'];
                } 
                        else 
                        {
                    $instance['position'] = 'type1';
                }

		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
                 @$position = esc_attr( $instance['position'] );

		// Get menus
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>

                 <p>
        <label for="<?php echo $this->get_field_id('position'); ?>"><?php _e( 'Widget Type:' ,'tfuse'); ?></label>
        <select name="<?php echo $this->get_field_name('position'); ?>" id="<?php echo $this->get_field_id('position'); ?>" class="widefat">
            <option  value="type1"<?php selected( @$instance['position'], 'type1' ); ?>><?php _e('Type 1','tfuse'); ?></option>
            <option  value="type2"<?php selected( @$instance['position'], 'type2' ); ?>><?php _e('Type 2','tfuse'); ?></option>
        </select>
    </p>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:','tfuse'); ?></label>
			<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
		<?php 
			foreach ( $menus as $menu ) {
				$selected = $nav_menu == $menu->term_id ? ' selected="selected"' : '';
				echo '<option'. $selected .' value="'. $menu->term_id .'">'. $menu->name .'</option>';
			}
		?>
			</select>
		</p>
		<?php
	}
}


function TFuse_Unregister_WP_Nav_Menu_Widget() {
	unregister_widget('WP_Nav_Menu_Widget');
}
add_action('widgets_init','TFuse_Unregister_WP_Nav_Menu_Widget');

register_widget('TFuse_Nav_Menu_Widget');