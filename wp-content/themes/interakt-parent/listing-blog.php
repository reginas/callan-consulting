<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Interakt 1.0
 */
?>
<div class="col col_1_2">
    <div class="inner">
        <div class="post-item-wide">
            <div class="post-image"><?php tfuse_media($return=false,$type = 'blog');?></div>
             <div class="post-meta-bot">
                <span class="post-date"> 
                    <?php if(!tfuse_options('date_time')): ?>
                    <?php echo get_the_date(); ?>/<?php endif;?>
                    <?php _e('by ','tfuse'); ?> <?php the_author_posts_link() ?>
                </span>
                <div class="post-date-corner"></div>
            </div>
            <div class="post_title">
                <h2><a href="<?php the_permalink(); ?>">
                        <?php tfuse_custom_title();?>
                    </a>
                </h2>
            </div>
            <div class="post-descr">
            <p><?php if ( tfuse_options('post_content') == 'content' ) the_content(''); else the_excerpt(); ?></p>

            </div>

       </div>
    </div>
</div>
     