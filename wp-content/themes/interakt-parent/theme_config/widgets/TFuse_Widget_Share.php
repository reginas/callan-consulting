<?php
class TFuse_Widget_Share extends WP_Widget {

	function TFuse_Widget_Share() {
		$widget_ops = array('classname' => 'widget_share', 'description' => __('Share','tfuse'));
		$this->WP_Widget('share', __('TFuse Share','tfuse'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$tf_class = 'class="widget-container widget_share"';
		$before_widget = '<div '.$tf_class.'>';
		$after_widget = '</div>';
		$before_title = '<h3 class="widget-title">';
		$after_title = '</h3>';


		echo $before_widget;
		$title = tfuse_qtranslate($title);
		if ( !empty( $title ) ) { ?>
        <?php echo $before_title . $title . $after_title; } 
            $url = tfuse_curPageURL();
        ?>
                
                    <ul>
			<li>
                            <?php if($instance['fb']) :?> 
                                <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $url ?>&amp;send=false&amp;layout=button_count&amp;width=50&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=15&amp;appId=162185353866069" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:20px;" allowTransparency="true"></iframe>
                            <?php endif;?>
                        </li>
						<li>
                            <?php if($instance['pin']): ?>
                            <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
                            <script type="IN/Share" data-counter="right"></script>
                            <?php endif;?>
                        </li>
                        <li>
                            <?php if($instance['tweet']):  ?>
                            <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $url ?>"  data-via="<?php 'Valeriu'; ?>" data-lang="en"><?php _e('Tweet','tfuse'); ?></a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                            <?php endif;?>
                        </li>
                        <li>
                            <?php if($instance['goog']) :?>
                                <g:plusone size="medium"></g:plusone>

                                <script type="text/javascript">
                                    (function() {
                                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                        po.src = 'https://apis.google.com/js/plusone.js';
                                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                                    })();
                                </script>
                            <?php endif;?>
                        </li>
                    </ul>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['fb'] = isset($new_instance['fb']);
		$instance['tweet'] = isset($new_instance['tweet']);
                $instance['goog'] = isset($new_instance['goog']);
		$instance['pin'] = isset($new_instance['pin']);

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'fb' => '', 'tweet' => '','goog' => '','pin' => '' ) );
		$title = $instance['title'];
		
?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><input id="<?php echo $this->get_field_id('fb'); ?>" name="<?php echo $this->get_field_name('fb'); ?>" type="checkbox" <?php checked(isset($instance['fb']) ? $instance['fb'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('fb'); ?>"><?php _e('Facebook','tfuse'); ?></label></p>
		<p><input id="<?php echo $this->get_field_id('tweet'); ?>" name="<?php echo $this->get_field_name('tweet'); ?>" type="checkbox" <?php checked(isset($instance['tweet']) ? $instance['tweet'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('tweet'); ?>"><?php _e('Twitter','tfuse'); ?></label></p>
                <p><input id="<?php echo $this->get_field_id('goog'); ?>" name="<?php echo $this->get_field_name('goog'); ?>" type="checkbox" <?php checked(isset($instance['goog']) ? $instance['goog'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('goog'); ?>"><?php _e('Google +','tfuse'); ?></label></p>
		<p><input id="<?php echo $this->get_field_id('pin'); ?>" name="<?php echo $this->get_field_name('pin'); ?>" type="checkbox" <?php checked(isset($instance['pin']) ? $instance['pin'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('pin'); ?>"><?php _e('Likedin','tfuse'); ?></label></p>
<?php
	}
}


register_widget('TFuse_Widget_Share');
