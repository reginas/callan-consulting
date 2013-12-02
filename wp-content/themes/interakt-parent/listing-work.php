<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Interakt 1.0
 */
$main = tfuse_options('theme_color');
?>
<div class="col col_1_3">
    <div class="inner">
    <a href="<?php the_permalink(); ?>">
        <div class="work-item">
            <div class="work-img"><?php tfuse_media($return=false,$type = 'work');?></div>
            <a href="<?php the_permalink(); ?>">
            <div class="work-title">
                <?php if(empty($main)){ ?>
                    <div class="corner-orange-top"></div>
                <?php }?>
                <?php if(!empty($main)){ ?>
                     <div class="arrow-top"></div>
                <?php }?>
                    <h4 class="color text-white text-bold"><?php tfuse_custom_title(); ?></h4>
                    <p class="color text-white"><?php tfuse_get_tags();?></p>
            </div>
            </a>
        </div>
    </a>
    </div>
</div> 