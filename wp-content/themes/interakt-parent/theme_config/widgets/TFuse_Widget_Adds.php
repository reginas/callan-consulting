<?php
class TFuse_Widget_Adds extends WP_Widget {

    function TFuse_Widget_Adds() {
        $widget_ops = array('classname' => 'widget_adds', 'description' => __( "Adds manager for sidebar","tfuse") );
        $control_ops = array('width' => 500, 'height' => 360);
        $this->WP_Widget('adds', __('TFuse - Ads','tfuse'), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $ads = apply_filters('widget_ads', empty($instance['ads']) ? isset($instance['ads']) : $instance['ads'], $instance, $this->id_base);

            echo $ads;
    }

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance['ads'] = $new_instance['ads'];


        return $instance;
    }

    function form( $instance ) {

        $instance = wp_parse_args( (array) $instance,
            array(
                'ads' => '',

            ) );

        $ads = $instance['ads'];

        ?>

    <!--Ads-->
        <p>
            <label for="<?php echo $this->get_field_id('ads'); ?>"><h3><?php _e('Ad :', 'tfuse'); ?></h3>
                <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('ads'); ?>" name="<?php echo $this->get_field_name('ads'); ?>"><?php echo $ads;?></textarea>
            </label>
        </p>
            <br>
            <label><h3><?php _e('Exemples :', 'tfuse'); ?></h3><?php _e('Copy paste one of the examples below in the Ad area upstairs. Don\'t forget to modify the URL and path for the banners.', 'tfuse'); ?></label>
            <div class="divider"></div>
            <br>
        <p>
        <label><h3><?php _e('Ad 300x250 :', 'tfuse'); ?></h3>
            <textarea class="widefat" rows="4" cols="1"><div class="adv_boxed"><div class="adv adv_300"><a href="http://themefuse.com/"><img width="300" height="250" src="wp-content/themes/agency-parent/images/adv_300x250.jpg"></a></div></div></textarea>
        </label>
        </p>
        <p>
        <label><h3><?php _e('Ad 250x250 :', 'tfuse'); ?></h3>
            <textarea class="widefat" rows="4" cols="1"><div class="adv_250"><a href="<?php bloginfo('url'); ?>"><img width="250" height="250" src="wp-content/themes/agency-parent/images/adv_250x250.png"></a></div></textarea>
        </label>
        </p>
        <p>
            <label><h3><?php _e('Ad 125x125 :', 'tfuse'); ?></h3>
                <textarea class="widefat" rows="4" cols="1"><div class="adv_125"><a href="<?php bloginfo('url'); ?>"><img width="125" height="125" src="wp-content/themes/agency-parent/images/adv_125x125.png"></a></div></textarea>
            </label>
        </p>
        <p>
            <label><h3><?php _e('4 or more ads 125x125 :', 'tfuse'); ?></h3>
                <textarea class="widefat" rows="4" cols="1">
                    <div class="adv_125_box">
                        <a href="<?php bloginfo('url'); ?>"><div class="adv_125"><img width="125" height="125" src="wp-content/themes/agency-parent/images/adv_125x125.png"></a></div>
                        <a href="<?php bloginfo('url'); ?>"><div class="adv_125"><img width="125" height="125" src="wp-content/themes/agency-parent/images/adv_125x125.png"></a></div>
                        <a href="<?php bloginfo('url'); ?>"><div class="adv_125"><img width="125" height="125" src="wp-content/themes/agency-parent/images/adv_125x125.png"></a></div>
                        <a href="<?php bloginfo('url'); ?>"><div class="adv_125"><img width="125" height="125" src="wp-content/themes/agency-parent/images/adv_125x125.png"></a></div>
                        <div class="clear"></div>
                    </div>
                </textarea>
            </label>
        </p>
        <p>
        <label><h3><?php _e('Ad 160x600 :', 'tfuse'); ?></h3>
            <textarea class="widefat" rows="4" cols="1"><div class="adv_160"><a href="<?php bloginfo('url'); ?>"><img width="160" height="600" src="wp-content/themes/agency-parent/images/adv_160x600.png"></a></div></textarea>
        </label>
        <p>

    </p>
    <?php _e("Or you can get Google AdSense frome","tfuse");?> (<a href="https://www.google.com/adsense">www.google.com/adsense</a>).
    <?php
    }
}
register_widget('TFuse_Widget_Adds');

