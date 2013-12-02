<?php
class TFuse_Widget_Feedback extends WP_Widget {

	function TFuse_Widget_Feedback() {
		$widget_ops = array('classname' => 'widget_feedback', 'description' => __('Send Feedback','tfuse'));
		$this->WP_Widget('feedback', __('TFuse Feedback','tfuse'), $widget_ops);
	}

	function widget( $args, $instance ) {
            wp_enqueue_script( 'contactform', tfuse_get_file_uri('js/contactform.js'), array('jquery'), '2.0', true );

            $params = array( 'contactform_uri' => tfuse_get_file_uri('theme_config/theme_includes/CONTACTFORM.php') );

            wp_localize_script( 'contactform', 'ContactFormParams', $params );

            add_action( 'wp_footer', create_function( '', 'wp_print_scripts( "contactform" );' ) );
                global $email;
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$tf_class = 'class="widget-container widget-send-feedback"';
		$before_widget = '<div '.$tf_class.'>';
		$after_widget = '</div>';
		$before_title = '<h3 class="widget-title">';
		$after_title = '</h3>';


		echo $before_widget;
		$title = tfuse_qtranslate($title);
		if ( !empty( $title ) ) { ?>
        <?php echo $before_title . $title . $after_title; } ?>
                <div class="contact-form">
                    <form id="contactForm" action="" method="post" class="ajax_form" name="contactForm">
                        <input type="hidden" name="temp_url" value="<?php bloginfo('template_directory'); ?>" />
                        <input type="hidden" id="tempcode" name="tempcode" value="<?php echo base64_encode(get_option('admin_email')); ?>" />
                        <input type="hidden" id="myblogname" name="myblogname" value="<?php bloginfo('name'); ?>" />
                        <input type="text" class="input required" id="name" name="name"  value="Name*" onfocus="if (this.value == 'Name*') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Name*';}">
                        <input type="text" class="input required" id="email" name="email"  value="Email*" onfocus="if (this.value == 'Email*') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Email*';}">
                        <textarea id="message" name="message" class="required"></textarea>
                        <a href="#" id="sending" class="button_link"><img src="<?php echo get_template_directory_uri()?>/images/ajax-loader.gif" alt="sending" /> <span><?php _e('sending ...','tfuse'); ?></span></a>
                        <input id="send" type="submit" value="SUBMIT">
                    </form>
                    <div id="reservation_send_ok" class="notice">
                        <h2><?php _e('Your message has been sent!', 'tfuse') ?></h2>
                        <?php _e('Thank you for contacting us,', 'tfuse') ?><br /><?php _e('We will get back to you within 2 business days.', 'tfuse') ?>
                    </div>

                    <div id="reservation_send_failure" class="notice">
                        <h2><?php _e('Oops!', 'tfuse') ?></h2>
                        <?php _e('Due to an unknown error, your form was not submitted, please resubmit it or try later.', 'tfuse') ?>
                    </div> 
                </div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
                
<?php
	}
}


register_widget('TFuse_Widget_Feedback');
