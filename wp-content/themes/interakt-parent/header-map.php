<?php
$template_directory = get_template_directory_uri();
wp_register_script('maps.google.com', 'http://maps.google.com/maps/api/js?sensor=false', array('jquery'), '', true);
wp_register_script('jquery.gmap', $template_directory . '/js/jquery.gmap.min.js', array('jquery', 'maps.google.com'), '', true);
wp_print_scripts('maps.google.com');
wp_print_scripts('jquery.gmap');

global $is_tf_blog_page,$header_map,$header_map1,$header_map2;

if ( $is_tf_blog_page )
{
    if(!empty($header_map1['map2']))
    {
        $map = $header_map1['map2'];
    }
    elseif(!empty($header_map2['map3']))
    { 
        $map = $header_map2['map3'];
    }
    elseif(!empty($header_map['map']))
    {
        $map = $header_map['map'];
    }
    else 
        return;
    $tmp_conf['post_id'] = $post->ID;
    $tmp_conf ['show_all_markers'] = false;
    $coords = explode(':', $map);
    if((!$coords[0]) || (!$coords[1]))
    {
        $tmp_conf ['show_all_markers'] = true;
    }
    else
    {
        $tmp_conf['post_coords']['lat']     = preg_replace('[^0-9\.]', '', $coords[0]);
        $tmp_conf['post_coords']['lng']     = preg_replace('[^0-9\.]', '', $coords[1]);

        $tmp_conf['post_coords']['html']    = '<strong>'.__('We','tfuse').'</strong><span>'.__('are','tfuse').'</span>'.__('here','tfuse');
    }
}
elseif (is_front_page())
{
    if(!empty($header_map1['map2']))
    {
        $map = $header_map1['map2'];
    }
    elseif(!empty($header_map2['map3']))
    { 
        $map = $header_map2['map3'];
    }
    elseif(!empty($header_map['map']))
    {
        $map = $header_map['map'];
    }
    else 
        return;

    $page_id = $post->ID;
    if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page')
    {   
        $tmp_conf['post_id'] = $page_id;
         $tmp_conf ['show_all_markers'] = false;
        $coords = explode(':', $map); 
    }
    else
    {   
        $tmp_conf['post_id'] = $post->ID;
         $tmp_conf ['show_all_markers'] = false;
        $coords = explode(':', $map);
    }
     if((!$coords[0]) || (!$coords[1]))
        {
            $tmp_conf ['show_all_markers'] = true;
        }
        else
        {
            $tmp_conf['post_coords']['lat']     = preg_replace('[^0-9\.]', '', $coords[0]);
            $tmp_conf['post_coords']['lng']     = preg_replace('[^0-9\.]', '', $coords[1]);

            $tmp_conf['post_coords']['html']    = '<strong>'.__('We','tfuse').'</strong><span>'.__('are','tfuse').'</span>'.__('here','tfuse');
        }
}
elseif (is_category())
{
    if(!empty($header_map1['map2']))
    {
        $map = $header_map1['map2'];
    }
    elseif(!empty($header_map2['map3']))
    { 
        $map = $header_map2['map3'];
    }
    elseif(!empty($header_map['map']))
    {
        $map = $header_map['map'];
    }
    else 
        return;
    $tmp_conf ['show_all_markers'] = false;
    $coords = explode(':', $map);
    if((!$coords[0]) || (!$coords[1]))
    {
        $tmp_conf ['show_all_markers'] = true;
    }
    else
    {
        $tmp_conf['post_coords']['lat']     = preg_replace('[^0-9\.]', '', $coords[0]);
        $tmp_conf['post_coords']['lng']     = preg_replace('[^0-9\.]', '', $coords[1]);

        $tmp_conf['post_coords']['html']    = '<strong>'.__('We','tfuse').'</strong><span>'.__('are','tfuse').'</span>'.__('here','tfuse');
    }
}
elseif (is_tax())
{
    if(!empty($header_map1['map2']))
    {
        $map = $header_map1['map2'];
    }
    elseif(!empty($header_map2['map3']))
    { 
        $map = $header_map2['map3'];
    }
    elseif(!empty($header_map['map']))
    {
        $map = $header_map['map'];
    }
    else 
        return;
    $tmp_conf ['show_all_markers'] = false;
    $coords = explode(':', $map);
    if((!$coords[0]) || (!$coords[1]))
    {
        $tmp_conf ['show_all_markers'] = true;
    }
    else
    {
        $tmp_conf['post_coords']['lat']     = preg_replace('[^0-9\.]', '', $coords[0]);
        $tmp_conf['post_coords']['lng']     = preg_replace('[^0-9\.]', '', $coords[1]);

        $tmp_conf['post_coords']['html']    = '<strong>'.__('We','tfuse').'</strong><span>'.__('are','tfuse').'</span>'.__('here','tfuse');
    }
}
elseif ((is_page() || is_single()))
{ 
    if(!empty($header_map1['map2']))
    {
        $map = $header_map1['map2'];
    }
    elseif(!empty($header_map2['map3']))
    { 
        $map = $header_map2['map3'];
    }
    elseif(!empty($header_map['map']))
    {
        $map = $header_map['map'];
    }
    else 
        return;
    //if is page
    $tmp_conf['post_id'] = $post->ID;
    $tmp_conf ['show_all_markers'] = false;
    $coords = explode(':',$map );
    if((!$coords[0]) || (!$coords[1]))
    {
        $tmp_conf ['show_all_markers'] = true;
    }
    else
    {
        $tmp_conf['post_coords']['lat']     = preg_replace('[^0-9\.]', '', $coords[0]);
        $tmp_conf['post_coords']['lng']     = preg_replace('[^0-9\.]', '', $coords[1]);

        $tmp_conf['post_coords']['html']    = '<strong>'.__('We','tfuse').'</strong><span>'.__('are','tfuse').'</span>'.__('here','tfuse');
    }
}

if(!empty($tmp_conf['post_coords']['lat']) || !empty($tmp_conf['post_coords']['lng'])):
?>

<div class="black-background">
    <div class="container">
    <!--header slider-->
    <div class="header-slider">
        <div id="map1" class="map" style="width: 100%; overflow: hidden;"> </div>
    </div>
    <!--/header slider-->
    </div>
</div>

<style type="text/css">
    #map1 img {
        max-width: none !important;
    }
        /* Bootstrap Css Map Fix*/
    #map1 label {
        width: auto; display:inline !important;
    }
    #map1 { height: 100% }
</style>
            <script>
				jQuery(window).ready(function () {
				jQuery("#map1").gMap({
							maptype: google.maps.MapTypeId.TERRAIN,
								scrollwheel: false,
					markers: [{
					latitude: <?php echo $tmp_conf['post_coords']['lat']; ?>,
					longitude: <?php echo  $tmp_conf['post_coords']['lng'];?>,
					html:"<?php echo $tmp_conf['post_coords']['html'];?>",
					popup: false}],
					zoom: 13
					});
				});
            </script> 

<?php endif;?>
