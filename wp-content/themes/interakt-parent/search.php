<?php get_header(); ?>
<?php  $item = tfuse_show_item_search();  ?>
<div class="white-background">
    <div class="container">
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
            <!-- content --> 
            <div class="content" role="main">
                <?php 
                if (have_posts()) 
                { $count = 0; 
                        while (have_posts()) : the_post(); $count++;
                            if($count == 1)
                                get_template_part('listing', 'blogfirst');
                            else
                            { 
                                if($count%2 == 0) echo '<div class="row">';
                                    get_template_part('listing', 'blog');
                                if($count%2 != 0 || $count == $item) echo '</div><div class="clear"></div>';
                            }
                        endwhile;?>
                        <div class="divider"></div>
          <?php } 
                else 
                { ?>
                   <h1 class="notfound"><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h1>
          <?php }
                tfuse_pagination($args = array(), $query = '',$type = 'blog');?>
            </div>
            <!--/ content --> 
            <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
                <div class="sidebar">
                    <?php get_sidebar(); ?>
                </div><!--/ .sidebar -->
            <?php endif; ?>
          <div class="clear"></div>
        </div><!--/ .middle -->
        <div class="clear"></div>
    </div>
<?php get_footer();?>
