<?php
/**
 * The template for displaying content in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Interakt 1.0
 */
global $post;
$attachments = tfuse_get_gallery_images($post->ID,TF_THEME_PREFIX . '_single_image');
$slider_images = array();
    if ($attachments) {
        foreach ($attachments as $attachment){
            $slider_images[] = array(
                'title'         => $attachment->post_title,
                'order'        =>$attachment->menu_order,
                'img_full'    => $attachment->guid,
				'desc' => $attachment->post_content
            );
        }
    }
$link_attach = tfuse_page_options('attach');
?>
 <?php if ( !tfuse_page_options('disable_image') ) : $slider_images = tfuse_aasort($slider_images,'order'); ?>    
    <div class="post-image">
        <div class="tf-post-slider">
            <ul class="slides">
                <?php 
                foreach($slider_images as $slider):?>
                    <li>
                        <img src="<?php echo $slider['img_full'];?>" alt="" height="462" />
                        <div class="post-meta-bot work">
                            <div class="post-date-corner"></div>
                            <h4 class="text-bold"><?php echo $slider['title'];?></h4>
                            <h5 class="text-gray"><?php echo $slider['desc'];?></h5>
                            <?php if ( tfuse_page_options('as_freebies') && !empty($link_attach) ) : ?>    
                            <a href="<?php echo $link_attach;?>" class="btn button_link_small color btn_orange alignright" hidefocus="true"><?php _e('Download','tfue');?></a>
                            <?php endif; ?>
							<div class="clear"></div>
                        </div>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
<?php endif; ?>
    <div class="post-descr work">
        <?php the_content(); ?>
    </div>

<script type="text/javascript">
    jQuery(window).load(function() {
      jQuery('.tf-post-slider').flexslider({
        animation: "slide"
      });
    });
</script>