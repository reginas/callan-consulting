<?php
/**
 * The template for displaying FlexSlider.
 * To override this template in a child theme, copy this file to your 
 * child theme's folder /theme_config/extensions/slider/designs/flexslider/
 * 
 * If you want to change style or javascript of this slider, copy files to your 
 * child theme's folder /theme_config/extensions/slider/designs/flexslider/static/
 * and change get_template_directory() with get_stylesheet_directory()
 */
?>
 <div class="black-background">
    <div class="container">
        <div class="tf-header-slider">
            <div class="flexslider">
              <ul class="slides">
                <?php foreach ($slider['slides'] as $slide):?>
                    <li>
                        <a href="<?php echo $slide['slide_url'];?>"> 
                            <img src="<?php echo $slide['slide_src']?>" width="960" height="401" alt="" />
                        </a>
                        <div class="details">
                            <div class="text-details">
                                <h2 class="text-bold text-white"><?php echo $slide['slide_title'];?></h2>
                            </div>
                        </div>
                    </li>
                <?php endforeach;?>
              </ul>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(window).load(function() {
        jQuery('.tf-header-slider').flexslider({
          animation: "fade"
        });
    });
</script>
   