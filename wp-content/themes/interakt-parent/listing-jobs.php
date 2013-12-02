<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Interakt 1.0
 */ 
$location = tfuse_page_options('location');
$department = tfuse_page_options('depart');
$type = tfuse_page_options('type');
$experience = tfuse_page_options('experience');
?>
<div class="widget-content widget-toggle">
    <div class="showed">
        <h2 class="text-bold"><?php tfuse_custom_title();?></h2>
        <?php if(!empty($location)):?>
            <span><?php _e('Location: ','tfuse');?><span><?php echo $location;?></span> </span>
        <?php endif;?>
        <?php if(!empty($department)):?>
            <span><?php _e('Departament: ','tfuse');?><span><?php echo $department;?></span></span>
        <?php endif;?>
        <a href="#" class="btn btn_gray button_link_small toggle-close alignright margin-right-15"><?php _e('Close','tfuse');?></a>
        <a href="#" class="btn btn_gray button_link_small  toggle-details alignright margin-right-15"><?php _e('Details','tfuse');?></a>
    </div>
    <div class="clear"></div>

    <div class="hidde">
        <?php if(!empty($type)):?>
            <span><?php _e('Type: ','tfuse');?><span ><?php echo $type;?></span></span>
        <?php endif;?>
        <?php if(!empty($type)):?>
            <span><?php _e('Min Experience: ','tfuse');?><span><?php echo $experience;?></span></span>
        <?php endif;?>
        <div class="clear"></div>
            <?php the_content(); ?>
        <div class="clear"></div>
        <div class="row">
            <div class="col col_1">
                <div class="inner">
                    <a href="<?php echo get_page_link(tfuse_page_options('apply'));?>" class="btn color btn_pink button_link_small alignright margin-right-15 margin-top-15"><?php _e('Apply','tfuse');?></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

 