<?php  get_header(); global $wp_query; $q = $wp_query->posts; ?>
<?php get_template_part('header','navigation');?>
<div class="white-background">
    <div class="container ">
        <?php get_template_part('header','services'); $wp_query->posts = $q;?>
        <div id="middle" class="full_width box_white">
             <?php tfuse_category_ads(); ?>
            <!-- content -->
            <div class="content" role="main">
                <article class="post-detail">            
                    <div class="entry">  
                        <?php 
                        tfuse_shortcode_content('before');
                        tfuse_hook();
                        tfuse_career_title();
                        if (have_posts()) 
                        { $count = 0; ?>
						<div class="toggles">
						<?php
                            while (have_posts()) : the_post(); $count++;
                                    get_template_part('listing', 'jobs');
                            endwhile;?>
						</div>
                  <?php } 
                        else 
                        { ?>
                            <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
                  <?php }	
                          tfuse_pagination($args = array(), $query = '',$type = 'work');
                         //tfuse_shortcode_content('after'); ?>
                        <div class="clear"></div>
                    </div>
                </article>       
            </div>
            <!--/content-->
            <div class="after">
                <?php tfuse_shortcode_content('after');?>
            </div>
            <div class="clear"></div>
        </div>
         <div class="clear"></div>
    </div>  
<?php tfuse_header_content('content');?>   
<script type="text/javascript">
	jQuery(document).on('click','.toggle-details',function(){
        jQuery(this).hide();
        jQuery(this).siblings('.toggle-close').show();
        jQuery(this).closest('.widget-toggle').find('.hidde').stop(true,true).slideDown(1000);

        return false;
        });

        jQuery(document).on('click','.toggle-close',function(){
        jQuery(this).hide();
        jQuery(this).siblings('.toggle-details').show();                               
        jQuery(this).closest('.widget-toggle').find('.hidde').stop(true,true).slideUp(1000);
        return false;
        });
  </script>
<?php get_footer();?>