<?php 
    global $header_title_slide; 
    if ( !empty($header_title_slide['header_title_slider'])) :
?>
<!--header title-->
<div class="header-title box_white">
    <div class="header-title-content text-center">
        <h1><?php echo $header_title_slide['header_title_slider'];?></h1>
    </div>

    <!--top search-->
    <div class="topsearch">
        <form id="searchform" action="<?php echo home_url( '/' ) ?>" method="get" >
                <div class="header-search">
                        <input type="text" name="s" class="s"  autocomplete="off"/>
                </div>
        </form>
    </div>
    <!--/top search-->
</div>
<!--/header title-->
<?php endif;?>