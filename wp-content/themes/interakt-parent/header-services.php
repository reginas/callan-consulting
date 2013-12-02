<?php 
$element = tfuse_show_service_value();

if($element != 'none' && !empty($element) ):  
    
    $posts = get_posts('post_type=service');

if(!empty($posts)):
        $k = 0;
?>
        <div class="our-work">
            <div class="content">
                <div class="row">
                    <?php foreach ($posts as $post): 
                            if($k == 3) break;$k++; 
                            $img = tfuse_page_options('icon_serv','',$post->ID);
                    ?>
                        <div class="col col_1_3">
                            <div class="inner">
                                <?php if(!empty($img)):?>
                                    <img src="<?php echo $img;?>" alt="" height="33" width="33"/>
                                <?php endif;?>
                                <h2 class="text-bold text-white"><?php echo $post->post_title; ?></h2>
                                <p><?php echo strip_tags(tfuse_shorten_string(apply_filters('the_content',$post->post_content),15));?>
                                    <a href="<?php echo get_permalink($post->ID); ?>" class="text-silver"><?php _e('More..','tfuse');?></a>
                                </p>
                            </div>
                        </div>
                    <?php endforeach;wp_reset_postdata();?>
                </div>
            </div>
        </div>
<?php endif; endif; ?>