<?php
/**
 * The template for displaying content in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Interakt 1.0
 */  $dimensions = tfuse_page_options('single_img_dimensions',tfuse_options('single_img_dimensions'));
     $position = tfuse_page_options('single_img_position',tfuse_options('single_img_position'));
     if($position == 'alignleft') $margin = 'margin-right: 10px;'; else $margin = '';

if(!is_attachment()) :   ?>
    <div class="post-image"> <?php tfuse_media($return=false,$type = 'blog');?></div>
    <div class="post-meta-bot <?php echo $position;?>" style="width:auto; <?php echo $margin;?>">
        <?php if ( !tfuse_page_options('disable_post_meta') && !tfuse_options('disable_post_meta')) : ?>
            <span class="post-date"> 
                <?php if ( !tfuse_page_options('disable_published_date') && !tfuse_options('disable_published_date') && !tfuse_options('date_time') ) : ?>
                <?php echo get_the_date(); ?>/<?php endif;?>
                <?php _e('by ','tfuse'); ?> <?php the_author_posts_link() ?>
            </span>
        <?php endif; ?>
       <div class="post-date-corner"></div>
    </div>
<?php endif;?>
<div class="post_title">
   <h2><?php tfuse_custom_title();?></h2>
</div>

<div class="post-descr">
    <?php the_content(); ?>
</div>
<?php if(!is_attachment()) :   ?>
    <?php if ( !tfuse_page_options('disable_post_meta') && !tfuse_options('disable_post_meta')) : ?>
        <div class="post-meta-links">
            <?php tfuse_share_post();?>
            <?php if ( !tfuse_page_options('disable_coments') && !tfuse_options('disable_posts_comments') ) : ?>
                <a href="<?php comments_link(); ?>" class="link-comments alignleft margin-top-15"><?php comments_number("0 ".__('comments','tfuse'), "1 ".__('comment','tfuse'), "% ".__('comments','tfuse')); ?></a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>

            