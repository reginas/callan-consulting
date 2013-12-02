<?php
/**
 * The template for displaying content in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Interakt 1.0
 */
$template_directory = get_template_directory_uri();
$img = tfuse_page_options('img');
if(!empty($img)) $img = $img; else $img = $template_directory.'/images/avatar-member.jpg';
?>
<div class="col col_1_4 member">
    <div class="inner">
        <div class="team-box">
            <div class="team-description">
                <div class="team-image"><img src="<?php echo $img;?>" width="201" height="201" alt=""></div>
                <div class="team-text">
                    <h4><?php tfuse_custom_title();?></h4>
                    <h5><?php echo tfuse_page_options('job');?></h5>
                    <p><?php echo tfuse_page_options('desc');?></p>
                    <div class="team-contact"><?php echo tfuse_page_options('nickname');?></div>
                </div>
                <div class="clear"></div>
            </div>        
        </div>
    </div>
</div>
<?php the_content(); ?>
