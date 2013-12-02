<?php  
get_header(); 
    global $wp_query,$TFUSE; $q = $wp_query->posts;
    $filter =  $TFUSE->request->isset_GET('posts') ? $TFUSE->request->GET('posts') : "";
?>
<?php get_template_part('header','navigation');?>
<div class="white-background">
    <div class="container">
        <?php get_template_part('header','services'); $wp_query->posts = $q;?>
        <div id="middle" class="full_width box_white">
             <?php tfuse_category_ads(); ?>
            <!-- content --> 
            <div class="content" role="main">
                <?php 
                    tfuse_shortcode_content('before');
                    tfuse_hook();
                ?>
                <!-- post list -->
                <article class="post-item">
                    <div class="entry">
                        <?php  get_template_part('work', 'navigation'); 
                        $item = tfuse_work_posts();
                        if (have_posts()) 
                        { $count = 0; 
                            if($filter  == 'freebie')
                            {
                                tfuse_show_freebies();
                            }
                            elseif($filter  == 'all')
                            {
                                tfuse_show_all();
                            }
                            else
                            {
                                while (have_posts()) : the_post(); $count++;
                                    if($count%3 == 1) echo '<div class="row">'; 
                                        get_template_part('listing', 'work');
                                    if($count%3 == 0 || $count == $item) echo '</div><div class="clear"></div>';
                                endwhile;
                            }
                        }
                        else 
                        { ?>
                            <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
                  <?php } ?>
                    </div>
                </article>
                <?php tfuse_pagination($args = array(), $query = '',$type = 'work'); ?>
            </div>
            <!--/ content --> 
            <div class="after">
                <?php tfuse_shortcode_content('after');?>
            </div>
          <div class="clear"></div>
        </div><!--/ .middle -->
        <div class="clear"></div>
    </div>
<?php tfuse_header_content('content');?>
<?php get_footer();?>