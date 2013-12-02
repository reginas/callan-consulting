<?php
// =============================== Recent Reviews Widget ======================================

class TFuse_Login extends WP_Widget {

    function TFuse_Login() {
        $widget_ops = array('description' => '' );
        parent::WP_Widget(false, __('TFuse - Login', 'tfuse'),$widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $instance['title'] = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
        
    $return_html = '';
    if ( ! is_user_logged_in() )
    {
        $return_html = '<div class="widget-container widget_login">
            <h3>' . __($instance['title'], 'tfuse') . '</h3>';
            $return_html .= '<form action="'. home_url().'/wp-login.php" method="post" name="loginform" id="loginform"  class="loginform">
					<p><label>'. __('Username', 'tfuse').'</label><br />
						<input name="log" id="user_login" class="input" value="" size="20" tabindex="10" type="text"></p>
					<p><label>'. __('Password', 'tfuse').'</label><br />
						<input name="pwd" id="user_pass" class="input" value="" size="20" tabindex="20" type="password"></p>
							<div class="forgetmenot input_styled checklist">
								<input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90" />
								<label for="rememberme">'. __('Remember Me', 'tfuse').'</label>
							</div>
						<p class="forget_password"><a href="'. home_url().'/wp-login.php?action=lostpassword">'. __('Forgot Password?', 'tfuse').'</a></p>
					<p class="submit">
						<input type="submit" name="wp-submit" id="wp-submit" class="btn-submit" value="LOG IN" tabindex="100" />
						<input type="hidden" name="redirect_to" value="'. home_url().'/wp-admin/" />
						<input type="hidden" name="testcookie" value="1" />
					</p>
				</form>
            </div>';
	}
        echo $return_html;
    }

   function update($new_instance, $old_instance) {
	$instance = $old_instance;
        $instance = wp_parse_args( (array) $instance, array('title' => '') );
        $instance['title'] =  $new_instance['title'] ;
        
        return $instance;
   }

    function form($instance) {
        $title = isset( $instance['title'] ) ? $instance['title'] : '';
        $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
        ?>
       
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
        </p>
        <?php
}
    }
    function TFuse_Unregister_WP_Widget_Login() {
            unregister_widget('WP_Widget_Login');
    }
add_action('widgets_init','TFuse_Unregister_WP_Widget_Login');

register_widget('TFuse_Login');
