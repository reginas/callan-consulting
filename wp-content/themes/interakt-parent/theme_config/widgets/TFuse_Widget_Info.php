<?php
class TFuse_Widget_Info extends WP_Widget {

	function TFuse_Widget_Info() {
		$widget_ops = array('classname' => 'widget_info', 'description' => __('Arbitrary text or HTML','tfuse'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('info', __('TFuse Info','tfuse'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
                $btn = apply_filters( 'widget_btn', empty($instance['btn']) ? '' : $instance['btn'], $instance, $this->id_base);
                $link = apply_filters( 'widget_link', empty($instance['link']) ? '' : $instance['link'], $instance, $this->id_base);
                $text = apply_filters( 'widget_text', $instance['text'], $instance );
		$tf_class = ' class="widget-post"';
		$before_widget = '<div '.$tf_class.'>';
		$after_widget = '</div>';
		$before_title = '<h2 class="text-bold text-darkgray">';
		$after_title = '</h2>';
		echo $before_widget;
		$title = tfuse_qtranslate($title);
		if ( !empty( $title ) ) { ?>
        <?php echo $before_title . $title . $after_title; } ?>
			<h2 class=" text-bold text-darkgray"><?php echo $instance['filter'] ? wpautop($text) : $text; ?></h2>
                        <div class="space"></div>
                        <a href="<?php echo $link;?>" class="btn button_styled_large color btn_pink big-text text-bold"><?php echo $btn;?></a>
                        <div class="space"></div>
                <?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
                $instance['link'] = $new_instance['link'];
                $instance['btn'] = $new_instance['btn'];
		if ( current_user_can('unfiltered_html') )
                    $instance['text'] =  $new_instance['text'];
		else
                    $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'link' => '','title' => '', 'text' => '','btn' => '', ) );
		$title = $instance['title'];
                $link = $instance['link'];
                $btn = $instance['btn'];
		$text = format_to_edit($instance['text']);
?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
                <p><label for="<?php echo $this->get_field_id('btn'); ?>"><?php _e('Button Title:','tfuse'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('btn'); ?>" name="<?php echo $this->get_field_name('btn'); ?>" type="text" value="<?php echo esc_attr($btn); ?>" /></p>
                <p><label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Button Link:','tfuse'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($link); ?>" /></p>
<?php
	}
}


function TFuse_Unregister_WP_Widget_Info() {
	unregister_widget('WP_Widget_Info');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Info');

register_widget('TFuse_Widget_Info');
