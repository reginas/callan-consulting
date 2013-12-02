<?php

// =============================== Newsletetr widget ======================================

class TFuse_newsletter extends WP_Widget {

    function TFuse_newsletter() {
        $widget_ops = array('description' => '');
        parent::WP_Widget(false, __('TFuse - Newsletter', 'tfuse'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $newsletter_title = empty($instance['newsletter_title']) ? 'Newsletter' : esc_attr($instance['newsletter_title']);
        $rss = empty($instance['rss']) ? '' : esc_attr($instance['rss']);
        ?>

        <div class="widget-container newsletter_subscription_box newsletterBox">
            <div class="inner">
                <?php if ($newsletter_title != '') { ?><h3><?php echo tfuse_qtranslate($newsletter_title); ?></h3><?php } ?>
                
                <div class="newsletter_subscription_messages before-text">
                    <div class="newsletter_subscription_message_initial">
                        <?php _e('','tfuse') ?>
                    </div>
                    <div class="newsletter_subscription_message_success">
                        <?php _e('Thank you for your subscribtion.','tfuse') ?>
                    </div>
                    <div class="newsletter_subscription_message_wrong_email">
                        <?php _e('Your email format is wrong!','tfuse') ?>
                    </div>
                    <div class="newsletter_subscription_message_failed">
                        <?php _e('Sad, but we couldn\'t add you to our mailing list ATM.','tfuse') ?>
                    </div>
                </div>

                <form action="#" method="post" class="newsletter_subscription_form">
                    <div class="newsletter_text"><?php _e('Stay in touch with the latest events & promos only by subscribing to our Newsletter.','tfuse');?></div>
                        <div class="row infieldlabel">
                            <label for="newsletter"><?php _e('Your Email','tfuse');?></label>
                            <input type="text" value="" name="newsletter" id="newsletter" class="newsletter_subscription_email inputField" />
                            <input type="submit" value="OK" class="btn-arrow newsletter_subscription_submit" />
                            <div class="newsletter_subscription_ajax"> <?php _e('Loading...','tfuse') ?></div>
                            <div class="newsletter_text"><?php if ($rss == 'on') { ?><br/><a href="<?php echo tfuse_options('feedburner_url', get_bloginfo_rss('rss2_url')); ?>" class="link-news-rss"><?php _e('Also subscribe to our ', 'tfuse'); ?> <span><?php _e('RSS feed', 'tfuse'); ?></span></a><?php } ?></div>
                            <div class="clear"></div>
                        </div>
                </form>
            </div>
        </div>
        <?php
    }

    function update($new_instance, $old_instance) {
	$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array('rss' => '') );
        return $new_instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('newsletter_title' => '', 'rss' => ''));
        $newsletter_title = esc_attr($instance['newsletter_title']);
        $rss = esc_attr($instance['rss']);
		
        ?>
		
        <p>
            <label for="<?php echo $this->get_field_id('newsletter_title'); ?>"><?php _e('Title:', 'tfuse'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('newsletter_title'); ?>" value="<?php echo $newsletter_title; ?>" class="widefat" id="<?php echo $this->get_field_id('newsletter_title'); ?>" />
        </p>
       <p>
            <label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('Activate RSS', 'tfuse'); ?>:</label>
            <?php if ($rss=='on') $checked = ' checked="checked" '; else $checked = ''; ?>
            <input <?php echo $checked; ?>  type="checkbox" name="<?php echo $this->get_field_name('rss'); ?>" class="checkbox" id="<?php echo $this->get_field_id('rss'); ?>" />
        </p>
        <?php
    }

}

register_widget('TFuse_newsletter');
