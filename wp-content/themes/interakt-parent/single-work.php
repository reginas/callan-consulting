<?php get_header(); global $wp_query; $q = $wp_query->posts; ?>
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
                ?> 
                <div class="title">
                        <h2 class="text-bold"><?php tfuse_custom_title();?></h2>
                </div>
                <?php if (($sidebar_position == 'full')) : ?>
                <div class="full">
                    <?php tfuse_single_work_pagination();?>
                </div>
                <?php endif; ?>
                <?php 
                while ( have_posts() ) : the_post(); ?>
                        <div class="post-item"> 
                                <?php include_once('content-single-work.php');?>
                                <?php get_template_part('content','author');?>
                        </div>
                <?php endwhile; // end of the loop. ?>
                <?php if ( !tfuse_page_options('disable_coments') && !tfuse_options('disable_posts_comments') ) : ?>
                    <?php tfuse_comments(); ?>
                <?php endif; ?>
            </div>
            <!--/ content --> 
            <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
                <div class="sidebar">
                    <?php tfuse_single_work_pagination();?>
                </div>
            <?php endif; ?>
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