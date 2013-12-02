<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Interakt 1.0
 */
?>
<div class="post-item">
    <div class="post-image ful"><?php tfuse_media($return=false,$type = 'blog2');?></div>
     <div class="post-meta-bot">
        <span class="post-date"> 
            <?php if(!tfuse_options('date_time')): ?>
                <?php echo get_the_date(); ?>/
            <?php endif;?>
            <?php _e('by ','tfuse'); ?> <?php the_author_posts_link() ?>
        </span>
        <div class="post-date-corner"></div>
    </div>
    <div class="post_title">
        <h2><a href="<?php the_permalink(); ?>"><?php tfuse_custom_title();?></a></h2>
    </div>
    <div class="post-descr">
    <p><?php if ( tfuse_options('post_content') == 'content' ) the_content(''); else the_excerpt(); ?></p>
    </div>
    <div class="post-meta-links">
        <?php tfuse_share_post();?>
        <a href="<?php comments_link(); ?>" class="link-comments alignleft margin-top-15">
            <?php comments_number("0 ".__('Comments','tfuse'), "1 ".__('Comment','tfuse'), "% ".__('comments','tfuse')); ?>
        </a>
        <a href="<?php the_permalink(); ?>" class="btn button_link_small color btn_pink alignright"><?php _e('Read more','tfuse');?></a>
    </div>
</div>
<div class="divider"></div>