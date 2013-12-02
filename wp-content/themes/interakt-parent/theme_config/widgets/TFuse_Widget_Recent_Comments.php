<?php
class TFuse_Widget_Recent_Comments extends WP_Widget {

	function TFuse_Widget_Recent_Comments() {
		$widget_ops = array('classname' => 'widget_recent_comments', 'description' => __( 'The most recent comments','tfuse' ) );
		$this->WP_Widget('recent-comments', __('TFuse Recent Comments','tfuse'), $widget_ops);
		$this->alt_option_name = 'widget_recent_comments';

		if ( is_active_widget(false, false, $this->id_base) )
			add_action( 'wp_head', array(&$this, 'recent_comments_style') );

		add_action( 'comment_post', array(&$this, 'flush_widget_cache') );
		add_action( 'transition_comment_status', array(&$this, 'flush_widget_cache') );
	}

	function recent_comments_style() { ?>
	<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
<?php
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_comments', 'widget');
	}

	function widget( $args, $instance ) {
		global $comments, $comment;

		$cache = wp_cache_get('widget_recent_comments', 'widget');

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		extract($args, EXTR_SKIP);
		$output = '';
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Comments','tfuse') : $instance['title']);
                $instance['position'] = empty( $instance['position'] ) ? '' : $instance['position'];
		$before_widget = '<div class="widget-container widget_recent_comments">';
		$after_widget = '</div>';
		$before_title = ' <h3 class="widget-title">';
		$after_title = '</h3>';


		if ( ! $number = (int) $instance['number'] )
			$number = 5;
		else if ( $number < 1 )
			$number = 1;

		$comments = get_comments( array( 'number' => $number, 'status' => 'approve' ) );
		$output .= $before_widget;
		$title = tfuse_qtranslate($title);
		if ( $title )
			$output .= $before_title . $title . $after_title;

		$output .= '<ul id="recentcomments">';
                
		if ( $comments ) {
			foreach ( (array) $comments as $comment) {
                         if($instance['position']=='footer')
                        {
                            $avatar = get_avatar( $comment->comment_author_email, 40 );
                        }
                        else
                        {
                            $avatar = get_avatar( $comment->comment_author_email, 60 );
                        }       
				$output .=  '<li class="recentcomments">' . 
                                    /* translators: comments widget: 1: comment author, 2: post link */
                                       sprintf(_x('%1$s: on %2$s', 'widgets'),
                                       '<div class="thumbnail">'. $avatar .'</div>'.
                                       '<span class="recent_comment_text">'.$comment->comment_content.'</span>
                                       <span class="recent_comment">'.get_comment_author_link(), '<a href="' . 
                                        esc_url( get_comment_link($comment->comment_ID) ) . '">' . 
                                        get_the_title($comment->comment_post_ID) . '</a></span>') . 
                                       '</li>';
                                
			}
		}
		$output .= '</ul>';
		$output .= $after_widget;

		echo $output;
		$cache[$args['widget_id']] = $output;
		wp_cache_set('widget_recent_comments', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_comments']) )
			delete_option('widget_recent_comments');
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
		$instance = wp_parse_args( (array) $instance, array(  'title' => '','position' => '') );
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
                @$position = esc_attr( $instance['position'] );
?>
                <p>
                    <label for="<?php echo $this->get_field_id('position'); ?>"><?php _e( 'Position:' ,'tfuse'); ?></label>
                    <select name="<?php echo $this->get_field_name('position'); ?>" id="<?php echo $this->get_field_id('position'); ?>" class="widefat">
                        <option  value="sidebar"<?php selected( @$instance['position'], 'sidebar' ); ?>><?php _e('Sidebar','tfuse'); ?></option>
                        <option  value="footer"<?php selected( @$instance['position'], 'footer' ); ?>><?php _e('Footer','tfuse'); ?></option>
                    </select>
                </p>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of comments to show:','tfuse'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}

function TFuse_Unregister_WP_Widget_Recent_Comments() {
	unregister_widget('WP_Widget_Recent_Comments');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Recent_Comments');

register_widget('TFuse_Widget_Recent_Comments');
