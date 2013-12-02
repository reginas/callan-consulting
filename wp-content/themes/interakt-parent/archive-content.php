<?php $items = tfuse_number_of_posts(); global $wp_query; $q = $wp_query->posts; ?>
<?php get_template_part('header','navigation');?>
<div class="white-background">
    <div class="container">
        <?php get_template_part('header','services'); $wp_query->posts = $q;?>
        <?php $sidebar_position = tfuse_sidebar_position(); ?>
        <?php if ($sidebar_position == 'right') : ?>
                 <div id="middle" class="cols2 box_white">
        <?php endif;
            if ($sidebar_position == 'left') : ?>
                 <div id="middle" class="cols2 sidebar_left box_white">
        <?php endif;
             if ($sidebar_position == 'full') : ?>
                  <div id="middle" class="full_width box_white">
        <?php endif; ?>
             <?php tfuse_category_ads(); ?>
            <!-- content --> 
            <div class="content" role="main">
                <?php  
                   tfuse_shortcode_content('before');  
                    tfuse_hook();
                if (have_posts()) 
                { $count = 0; 
                        while (have_posts()) : the_post(); $count++; 
                            if($count == 1)
                                get_template_part('listing', 'blogfirst');
                            else
                            {
                                if($count%2 == 0) echo '<div class="row">';
                                    get_template_part('listing', 'blog');
                                if($count%2 != 0 || $count == $items) echo '</div><div class="clear"></div>';
                            }
                        endwhile;?>
                        <div class="divider"></div>
                <span class="text-browsing alignleft">
                    <?php _e('Browsing ','tfuse'); ?><b class="text-semibold"><?php echo $count; ?>
                    </b>/ <?php tfuse_number_posts();  _e(' articles','tfuse'); ?>
                </span>
          <?php } 
                else 
                { ?>
                    <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
          <?php }
                tfuse_pagination($args = array(), $query = '',$type = 'blog');?>
            </div>
            <!--/ content --> 
            <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
                <div class="sidebar">
                    <?php get_sidebar(); ?>
                </div><!--/ .sidebar -->
            <?php endif; ?>
            <div class="after">
                <?php tfuse_shortcode_content('after');?>
            </div>
          <div class="clear"></div>
        </div><!--/ .middle -->
        <div class="clear"></div>
    </div>
<?php tfuse_header_content('content');?>
<?php get_footer();?>