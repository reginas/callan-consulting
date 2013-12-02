<?php
global $is_tf_front_page,$is_tf_blog_page,$post;

$exist = tfuse_exist_header();
$main = tfuse_options('theme_color');
if($is_tf_front_page)
{  
    $page_id = $post->ID;
    if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page')
    {
        $menu = tfuse_page_options('menu_header','',$page_id);
        $header_element = tfuse_page_options('header_element','',$page_id);
    }
    else
    {
        $menu = tfuse_options('menu_header');
        $header_element = tfuse_options('header_element');
    }
}
elseif($is_tf_blog_page)
{
    $header_element = tfuse_options('header_element_blog');
    $menu = tfuse_options('menu_header_blog');
}
elseif(is_author() ||((is_archive() && !is_tax() && !is_category()) || is_tag() ))
{
    $menu = 0;
}
elseif ( is_singular() )
{
    $header_element = tfuse_page_options('header_element');
    $menu = tfuse_page_options('menu_header');
    $id = $post->ID;
}
elseif ( is_category() )
{
    $ID = get_query_var('cat');
    $id = $ID;
    $menu = tfuse_options('menu_header', null, $ID);
    $header_element = tfuse_options('header_element', null, $ID);
}
elseif ( is_tax() )
{
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    $id = $term->term_id;
    $ID = $term->term_id;
    $menu = tfuse_options('menu_header', null, $ID);
     $header_element = tfuse_options('header_element', null, $ID);
}
else
{
    $menu = 0;
}

if($menu != 0 && $header_element != 'slider'):  
    $template_directory = get_template_directory_uri();
    $items = wp_get_nav_menu_items( $menu ); //object_id;
    $k = 0;

    
if($exist) $ex = 'style="padding-top:10px"';else $ex = '';
?>
<div class="white-background" <?php echo $ex;?>>
    <ul class="middle-menu">
		<?php if(!empty($items)):?>
        <?php foreach($items as $item):  
                $icon1 = tfuse_page_options('icon',null,$item->object_id);

                $icon2 = tfuse_options('icon',null,$item->object_id);

                if($item->menu_item_parent != 0) continue;

                $k++;
                if($k == 7) break;
        
         if($item->object_id == $id){?>
            <li class="active-menu">
        <?php } else
        { ?>
            <li>
        <?php }?>
                <a href="<?php echo $item->url;?>">
                    <div class="tf-top-menu">
                        <?php if(!empty($main)){ ?>
                             <div class="tf-top-menu-corner"></div>
                        <?php }?>  
                    </div>
                    <?php if(!empty($icon1)) {?>
                            <img src="<?php echo $icon1;?>" alt=""/>
                     <?php } 
                     elseif(!empty($icon2))
                     { ?>
                            <img src="<?php echo $icon2;?>" alt=""/>
                   <?php  }
                    else { ?>
                        <img src="<?php echo $template_directory.'/images/icons/menu1.png';?>" alt=""/>
                    <?php }?>
                    <h4 class="text-white "><?php echo $item->title;?></h4>
                    <div class="tf-bottom-menu"></div>
                </a>
            </li>
        <?php endforeach;?>
	<?php endif;?>
    </ul>
</div>
<?php endif;?>
