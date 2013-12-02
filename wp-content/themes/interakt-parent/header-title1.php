<?php 
    global $header_title1; 
    if ( !empty($header_title1['title'])) :
?>
<!--header title-->
<div class="header-title box_white">
    <div class="header-title-content text-left">
        <h1><?php echo $header_title1['title'];?></h1>
    </div>

    <!--top search-->
    <div class="topsearch">
        <form id="searchform" action="<?php echo home_url( '/' ) ?>" method="get" >
                <div class="header-search">
                        <input type="text" name="s" class="s"  autocomplete="off"/>
                </div>
        </form>
    </div>
    <div class="title-corner-white"></div>
    <!--/top search-->
</div>
<!--/header title-->
<?php endif;?>