<?php get_header(); global $wp_query; $q = $wp_query->posts; ?>
<?php get_template_part('header','navigation');?>
<div class="white-background">
    <div class="container">
        <?php get_template_part('header','services');$wp_query->posts = $q;?>
        <div id="middle" class="full_width box_white">
             <?php tfuse_category_ads(); ?>
            <!-- content --> 
            <div class="content" role="main">
                <?php  
                    tfuse_shortcode_content('before');
                    tfuse_hook();
                ?>
                <?php  while ( have_posts() ) : the_post();?>
                    <article class="post-detail">
                        <div class="entry">
                            <div class="row">
                                <?php include_once('content-single-members.php');?>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </article> <!--/ entry text -->
                <?php endwhile; // end of the loop. ?>                    
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