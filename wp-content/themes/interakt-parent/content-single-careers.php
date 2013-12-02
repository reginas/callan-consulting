<?php
/**
 * The template for displaying content in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Interakt 1.0
 */  
?>
<div class="post_title">
   <h2><?php tfuse_custom_title();?></h2>
</div>

<div class="post-descr">
    <?php the_content(); ?>
</div>
<div class="row">
    <div class="col col_1">
        <div class="inner">
            <a href="<?php echo get_page_link(tfuse_page_options('apply'));?>" class="btn btn_pink button_link_small alignright margin-right-15 margin-top-15"><?php _e('Apply','tfuse');?></a>
        </div>
    </div>
</div>

            