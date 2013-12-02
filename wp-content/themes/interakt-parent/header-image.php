<?php
global $header_image1,$header_image,$header_image2;
if ( !empty($header_image1['image2']))
{
    $header_img = $header_image1['image2'];
}
elseif ( !empty($header_image['image']))
{
    $header_img = $header_image['image'];
}
elseif ( !empty($header_image2['image3']))
{
    $header_img = $header_image2['image3'];
}
if(!empty($header_img)):
?>
<div class="black-background">
    <div class="container">
        <!--header slider-->
            <div class="header-slider">
                <img src="<?php echo $header_img;?>" height="401" width="960">
            </div>
        <!--/header slider-->
    </div>
</div>
<?php endif;?>