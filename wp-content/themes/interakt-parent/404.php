<?php get_header();?>
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
                        <article class="post-detail">  
                            <div class="entry">
                                <h1 class="notfound"><?php _e('Page not found', 'tfuse') ?></h1>
                                <p><?php _e('The page you were looking for doesn&rsquo;t seem to exist', 'tfuse') ?>.</p>
                            </div><!--/ .entry -->
                        </article>
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
<?php tfuse_header_content('content');?>
<?php get_footer();?>
