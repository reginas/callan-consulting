<?php 
    global $header_title2; 
    $menu = tfuse_show_corner();
    $main = tfuse_options('theme_color');
    if ( !empty($header_title2['title'])) :
?>
<div class="black-background">
    <div class="container">
         <!--header slider-->
           <div class="header-title box_orange">
                <div class="header-title-content text-left ">
                    <h1 class="color text-white"><?php echo $header_title2['title'];?></h1>
                </div>
               <?php if(!empty($main)){ ?>
                        <div class="arrow-down"></div>
                <?php }?>
                <!--top search-->
                <div class="topsearch">
                   <form id="searchform" action="<?php echo home_url( '/' ) ?>" method="get" >
                            <div class="header-search">
                                    <input type="text" name="s" class="s white"  autocomplete="off"/>
                            </div>
                    </form>                     
                </div>
                <?php if($menu == 0): ?>
                    <?php if(empty($main)){ ?>
                        <div class="title-corner-orange"></div>
                    <?php }?>
                <?php endif;?>
                <!--/top search-->
            </div>
        
            <!--/header slider-->
    </div>
</div>
<?php endif;?>