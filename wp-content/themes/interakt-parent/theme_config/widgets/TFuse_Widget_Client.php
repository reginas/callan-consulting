<?php
class TFuse_Widget_Client extends WP_Widget {

    function TFuse_Widget_Client() {
        $widget_ops = array('classname' => 'widget_client', 'description' => __( "Image in sidebar","tfuse") );
        $this->WP_Widget('client', __('TFuse - Client','tfuse'), $widget_ops);
    }

   function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$src = apply_filters( 'widget_src', empty($instance['src']) ? '' : $instance['src'], $instance, $this->id_base);		
		$tf_class = 'class="widget-container widget_client"';
		$before_widget = '<div '.$tf_class.'>';
		$after_widget = '</div>';
		$before_title = '<h3 class="widget-title">';
		$after_title = '</h3>';


		echo $before_widget;
		$title = tfuse_qtranslate($title);
		if ( !empty( $title ) ) { ?>
        <?php echo $before_title . $title . $after_title; }
                if(!empty($src))?>
                    <img src="<?php echo $src;?>" class="aligncenter space">
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
                $instance['src'] = $new_instance['src'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'src' => '', 'nopadding' => '' ) );
		$title = $instance['title'];
		$src = $instance['src'];
?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('src'); ?>"><?php _e('Image Source:','tfuse'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('src'); ?>" name="<?php echo $this->get_field_name('src'); ?>" type="text" value="<?php echo esc_attr($src); ?>" /></p>

<?php
	}
}
register_widget('TFuse_Widget_Client');

