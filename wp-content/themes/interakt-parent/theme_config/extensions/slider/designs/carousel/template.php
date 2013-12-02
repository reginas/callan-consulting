<div class="footer-slider">
    <div class="container">
        <div class="slider-inner">
            <h2 class="text-bold">
                <?php if(!empty($slider['general']['slider_title'])) echo $slider['general']['slider_title'];
                      else echo '';
                ?>
            </h2>
                <div class="tf-footer-carousel carousel">
                    <ul class="slides ">
                        <?php foreach ($slider['slides'] as $slide) : ?>
                            <li>
                               <a href="<?php echo $slide['slide_url']; ?>"><img src="<?php echo $slide['slide_src']; ?>" height="68" alt="" /></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
<script>
    $(window).load(function() {
      $('.tf-footer-carousel').flexslider({
        animation: "slide",
        animationLoop: true,
        itemWidth: 140,
        itemMargin: 15,
        minItems: 1,
        maxItems: 6,
        move:1
      });
    });
</script>
<!--/ top Slider -->