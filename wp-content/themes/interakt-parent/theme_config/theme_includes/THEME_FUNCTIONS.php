<?php

if (!function_exists('tfuse_browser_body_class')):

/* This Function Add the classes of body_class()  Function
 * To override tfuse_browser_body_class() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
*/

    add_filter('body_class', 'tfuse_browser_body_class');

    function tfuse_browser_body_class() {

        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

        if ($is_lynx)
            $classes[] = 'lynx';
        elseif ($is_gecko)
            $classes[] = 'gecko';
        elseif ($is_opera)
            $classes[] = 'opera';
        elseif ($is_NS4)
            $classes[] = 'ns4';
        elseif ($is_safari)
            $classes[] = 'safari';
        elseif ($is_chrome)
            $classes[] = 'chrome';
        elseif ($is_IE) {
            $browser = $_SERVER['HTTP_USER_AGENT'];
            $browser = substr("$browser", 25, 8);
            if ($browser == "MSIE 7.0")
                $classes[] = 'ie7';
            elseif ($browser == "MSIE 6.0")
                $classes[] = 'ie6';
            elseif ($browser == "MSIE 8.0")
                $classes[] = 'ie8';
            else
                $classes[] = 'ie';
        }
        else
            $classes[] = 'unknown';

        if ($is_iphone)
            $classes[] = 'iphone';

        return $classes;
    } // End function tfuse_browser_body_class()
endif;


if (!function_exists('tfuse_class')) :
/* This Function Add the classes for middle container
 * To override tfuse_class() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
*/

    function tfuse_class($param, $return = false) {
        $tfuse_class = '';
        $sidebar_position = tfuse_sidebar_position();
        if ($param == 'middle') {
            if (is_page_template('template-contact.php')) {
                if ($sidebar_position == 'left')
                    $tfuse_class = ' class="middle sidebarLeft nobg"';
                elseif ($sidebar_position == 'right')
                    $tfuse_class = ' class="middle sidebarRight nobg"';
                else
                    $tfuse_class = ' class="middle"';
            }
            else {
                if ($sidebar_position == 'left')
                    $tfuse_class = ' class="middle sidebarLeft"';
                elseif ($sidebar_position == 'right')
                    $tfuse_class = ' class="middle sidebarRight"';
                else
                    $tfuse_class = ' class="middle"';
            }
        }
        elseif ($param == 'content') {
            $tfuse_class = ( isset($sidebar_position) && $sidebar_position != 'full' ) ? ' class="grid_8 content"' : ' class="content"';
        }

        if ($return)
            return $tfuse_class;
        else
            echo $tfuse_class;
    }
endif;


if (!function_exists('tfuse_sidebar_position')):
/* This Function Set sidebar position
 * To override tfuse_sidebar_position() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
*/
    function tfuse_sidebar_position() {
        global $TFUSE;

        $sidebar_position = $TFUSE->ext->sidebars->current_position;
        if ( empty($sidebar_position) ) $sidebar_position = 'full';

        return $sidebar_position;
    }

// End function tfuse_sidebar_position()
endif;


if (!function_exists('tfuse_count_post_visits')) :
/**
 * tfuse_count_post_visits.
 * 
 * To override tfuse_count_post_visits() in a child theme, add your own tfuse_count_post_visits() 
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_count_post_visits()
    {
        if ( !is_single() ) return;

        global $post;

        $tfuse_count =  get_post_meta($post->ID, TF_THEME_PREFIX . '_post_viewed', true);
        if ( empty($tfuse_count) ) $tfuse_count = 0;

        $popularArr = ( !empty( $_COOKIE['popular']) ) ? explode(',', $_COOKIE['popular']) : array();

        if ( !in_array($post->ID, $popularArr) )
        {
            update_post_meta($post->ID, TF_THEME_PREFIX . '_post_viewed', ++$tfuse_count);
            $popularArr[] = $post->ID;
            @setcookie('popular', implode(',', $popularArr),0,'/');
        }
    }
    add_action('wp_head', 'tfuse_count_post_visits');

// End function tfuse_count_post_visits()
endif;


if (!function_exists('tfuse_custom_title')):

    function tfuse_custom_title() {
        global $post;
            $tfuse_title_type = tfuse_page_options('page_title');

            if ($tfuse_title_type == 'hide_title')
                $title = '';
            elseif ($tfuse_title_type == 'custom_title')
                $title = tfuse_page_options('custom_title');
            else
                $title = get_the_title();

            echo ( $title ) ? $title  : '';
    }

endif;

if (!function_exists('tfuse_archive_custom_title')):
/**
 *  Set the name of post archive.
 *
 * To override tfuse_archive_custom_title() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_archive_custom_title()
    {
        $cat_ID = 0;
        if ( is_category() )
        {
            $cat_ID = get_query_var('cat');
            $title = single_term_title( '', false );
        }
        elseif ( is_tax() )
        {
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $cat_ID = $term->term_id;
            $title = single_term_title( $term->name , false );
        }
        elseif ( is_post_type_archive() )
        {
            $title = post_type_archive_title('',false);
        }

        $tfuse_title_type = tfuse_options('page_title',null,$cat_ID);

        if ($tfuse_title_type == 'hide_title')
            $title = '';
        elseif ($tfuse_title_type == 'custom_title')
            $title = tfuse_options('custom_title',null,$cat_ID);

        echo !empty($title) ? '<h1>' . $title . '</h1>' : '';
    }

endif;



if (!function_exists('tfuse_user_profile')) :
/**
 * Retrieve the requested data of the author of the current post.
 *  
 * @param array $fields first_name,last_name,email,url,aim,yim,jabber,facebook,twitter etc.
 * @return null|array The author's spefified fields from the current author's DB object.
 */
    function tfuse_user_profile( $fields = array() )
    {
        $tfuse_meta = null;

        // Get stnadard user contact info
        $standard_meta = array(
            'first_name' => get_the_author_meta('first_name'),
            'last_name' => get_the_author_meta('last_name'),
            'email'     => get_the_author_meta('email'),
            'url'       => get_the_author_meta('url'),
            'aim'       => get_the_author_meta('aim'),
            'yim'       => get_the_author_meta('yim'),
            'jabber'    => get_the_author_meta('jabber')
        );

        // Get extended user info if exists
        $custom_meta = (array) get_the_author_meta('theme_fuse_extends_user_options');

        $_meta = array_merge($standard_meta,$custom_meta);

        foreach ($_meta as $key => $item) {
            if ( !empty($item) && in_array($key, $fields) ) $tfuse_meta[$key] = $item;
        }

        return apply_filters('tfuse_user_profile', $tfuse_meta, $fields);
    }

endif;


if (!function_exists('tfuse_action_comments')) :
/**
 *  This function disable post commetns.
 *
 * To override tfuse_action_comments() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_action_comments() {
        global $post;
        if (!tfuse_page_options('disable_comments'))
            comments_template( '', true );
    }

    add_action('tfuse_comments', 'tfuse_action_comments');
endif;


if (!function_exists('tfuse_get_comments')):
/**
 *  Get post comments for a specific post.
 *
 * To override tfuse_get_comments() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_get_comments($return = TRUE, $post_ID) {
        $num_comments = get_comments_number($post_ID);

        if (comments_open($post_ID)) {
            if ($num_comments == 0) {
                $comments = __('No Comments','tfuse');
            } elseif ($num_comments > 1) {
                $comments = $num_comments . __(' Comments','tfuse');
            } else {
                $comments = __('1 Comment','tfuse');
            }
            $write_comments = '<a class="link-comments" href="' . get_comments_link() . '">' . $comments . '</a>';
        } else {
            $write_comments = __('Comments are off','tfuse');
        }
        if ($return)
            return $write_comments;
        else
            echo $write_comments;
    }

endif;


function tfuse_pagination( $args = array(), $query = '',$type ) {
    global $wp_rewrite, $wp_query;
    $template_directory = '';
        if ( $query ) {

            $wp_query = $query;

        } // End IF Statement
        /* If there's not more than one page, return nothing. */
        if ( 1 >= $wp_query->max_num_pages )
            return false;

        /* Get the current page. */
        $current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );
        
        /* Get the max number of pages. */
        $max_num_pages = intval( $wp_query->max_num_pages );

        /* Set up some default arguments for the paginate_links() function. */
        $defaults = array(
            'base' => add_query_arg( 'paged', '%#%' ),
            'format' => '',
            'total' => $max_num_pages,
            'current' => $current,
            'prev_next' => false,
            'show_all' => false,
            'end_size' => 2,
            'mid_size' => 1,
            'add_fragment' => '',
            'type' => 'plain',
            'before' => '',
            'after' => '',
            'echo' => true,
        );

        /* Add the $base argument to the array if the user is using permalinks. */
        if( $wp_rewrite->using_permalinks() )
            $defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . 'page/%#%' );

        /* If we're on a search results page, we need to change this up a bit. */
        if ( is_search() ) {
            $search_permastruct = $wp_rewrite->get_search_permastruct();
            if ( !empty( $search_permastruct ) )
                $defaults['base'] = user_trailingslashit( trailingslashit( get_search_link() ) . 'page/%#%' );
        }

        /* Merge the arguments input with the defaults. */
        $args = wp_parse_args( $args, $defaults ); 

        /* Don't allow the user to set this to an array. */
        if ( 'array' == $args['type'] )
            $args['type'] = 'plain';

        /* Get the paginated links. */
        $page_links = paginate_links( $args );

        /* Remove 'page/1' from the entire output since it's not needed. */
        $page_links = str_replace( array( '&#038;paged=1\'', '/page/1\'' ), '\'', $page_links );

        /* Wrap the paginated links with the $before and $after elements. */
        $page_links = $args['before'] . $page_links . $args['after'];

        /* Return the paginated links for use in themes. */
        if ( $args['echo'] )
        { $template_directory = get_template_directory_uri();
            
            if($type == 'blog'){ ?>
                <!-- pagination -->
                    <div class="widget-pagination alignright">
                        <ul>
                            <?php $prev_posts = get_previous_posts_link(__('<img src="'.$template_directory.'/images/arrow-nav-left.png" alt="" />', 'tfuse'));
                             if ($prev_posts) echo '' . $prev_posts . ''; 		 
                            echo $page_links; 
                            $next_posts = get_next_posts_link(__('<img src="'.$template_directory.'/images/arrow-nav-right.png" alt="" />', 'tfuse'));
                            if ($next_posts) echo '' . $next_posts . ''; 
                            ?>
                        </ul>
                    </div>
                    <?php
            }
            else
            { ?>
                <?php
                    $prev_posts = get_previous_posts_link(__('<span>⇐</span> Older ', 'tfuse'));
                    $next_posts = get_next_posts_link(__('Newer <span>⇒</span>', 'tfuse'));
                ?>
                <div class="row pagination">
                    <div class="col col_1_2">
                        <div class="inner">
                            <?php   
                                if ($prev_posts) echo '<div class="btn button_styled_medium btn_gray alignright">' . $prev_posts . '</div>';
                                else echo '<div class="btn button_pag alignright"></div>';
                            ?>
                        </div>
                    </div>

                    <div class="col col_1_2">
                        <div class="inner">
                            <?php 
                                if ($next_posts) echo ' <div class="btn button_styled_medium btn_gray alignleft">' . $next_posts . '</div>'; 
                                else echo '<div class="btn button_pag alignleft"></div>';
                            ?>
                        </div>
                    </div>
                </div>
      <?php }
        }
        else
            return $page_links;

}

if (!function_exists('tfuse_shortcode_content')) :
/**
 *  Get post comments for a specific post.
 *
 * To override tfuse_shortcode_content() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_shortcode_content($position = '', $return = false)
    {
        $page_shortcodes = '';
        global $is_tf_front_page,$is_tf_blog_page,$post;
        
        $position = ( $position == 'before' ) ? 'content_top' : 'content_bottom';

        if((is_front_page() || $is_tf_front_page) && !$is_tf_blog_page)
        {  
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page'){
                $page_id = $post->ID;
                $page_shortcodes = tfuse_page_options($position,'',$page_id);
            }
            else
            {
                $page_shortcodes = tfuse_options($position);
            }
        }
        elseif($is_tf_blog_page)
        { 
           $position ='blog_'.$position;
            $page_shortcodes = tfuse_options($position);
        }
        elseif (is_singular()) {
            global $post;
            $page_shortcodes = tfuse_page_options($position);
        } 
        elseif (is_category()) {
            $cat_ID = get_query_var('cat');
            $page_shortcodes = tfuse_options($position, '', $cat_ID);
        } 
        elseif (is_tax()) {
            $taxonomy = get_query_var('taxonomy');
            $term = get_term_by('slug', get_query_var('term'), $taxonomy);
            $cat_ID = $term->term_id;
            $page_shortcodes = tfuse_options($position, '', $cat_ID);
        }

        $page_shortcodes = tfuse_qtranslate($page_shortcodes);

        $page_shortcodes = apply_filters('themefuse_shortcodes', $page_shortcodes);

        if ($return)
            return $page_shortcodes;
        else
        {
            if((($position == 'content_bottom') && !empty($page_shortcodes)) || (($position == 'blog_content_bottom') && !empty($page_shortcodes)))
            { 
                echo '<div class="divider-space"></div>';
                echo $page_shortcodes;
            }
            elseif((($position == 'content_top') && !empty($page_shortcodes))|| (($position == 'blog_content_top') && !empty($page_shortcodes)) )
            {
                echo $page_shortcodes;
                echo '<div class="divider"></div>';
            }
            else
                echo $page_shortcodes;
        }
    }

// End function tfuse_shortcode_content()
endif;


if (!function_exists('tfuse_category_on_front_page')) :
/**
 * Dsiplay homepage category
 *
 * To override tfuse_category_on_front_page() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_category_on_front_page()
    {
        if ( !is_front_page() ) return;

        global $is_tf_front_page,$homepage_categ;
        $is_tf_front_page = false;

        $homepage_category = tfuse_options('homepage_category');
        $homepage_category = explode(",",$homepage_category);
        foreach($homepage_category as $homepage)
        {
            $homepage_categ = $homepage;
        }
        if($homepage_categ == 'specific')
        {
            $is_tf_front_page = true;
            $archive = 'archive-content.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;           
            
            $specific = tfuse_options('categories_select_categ');

            $ids = explode(",",$specific);
            $posts = array(); 
            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                        'cat' => $specific,
                        'orderby' => 'date',
                        'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
                        
            return;
        }
        elseif($homepage_categ == 'page')
        {
            global $front_page;
            $is_tf_front_page = true;
            $front_page = true;
            $archive = 'page.php';
            $page_id = tfuse_options('home_page');
            $args=array(
                'page_id' => $page_id,
                'post_type' => 'page',
                'post_status' => 'publish',
                'posts_per_page' => 1,
                'ignore_sticky_posts'=> 1
            );
            $posts = query_posts($args); 
            include_once(locate_template($archive));
            return;
        }
        elseif($homepage_categ == 'all')
        {
            $archive = 'archive-content.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
            $is_tf_front_page = true;
			$args = array(
                        'post_type' => 'post',
                        'paged' => $paged
            );
            query_posts($args);
            include_once(locate_template($archive));
            return;
        }
 
    }

// End function tfuse_category_on_front_page()
endif;

if (!function_exists('tfuse_category_on_blog_page')) :
    /**
     * Dsiplay blogpage category
     *
     * To override tfuse_category_on_blog_page() in a child theme, add your own tfuse_count_post_visits()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

    function tfuse_category_on_blog_page()
    {
        global $is_tf_blog_page;
        $blogpage_categ ='';
        if ( !$is_tf_blog_page ) return;
        $is_tf_blog_page = false;

        $blogpage_category = tfuse_options('blogpage_category');
        $blogpage_category = explode(",",$blogpage_category);
        foreach($blogpage_category as $blogpage)
        {
            $blogpage_categ = $blogpage;
        }
        if($blogpage_categ == 'specific')
        {
            $is_tf_blog_page = true;
            $archive = 'archive-content.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $specific = tfuse_options('categories_select_categ_blog');

            $ids = explode(",",$specific);
            $posts = array();
            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                'cat' => $specific,
                'orderby' => 'date',
                'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
            return;
        }
        else
        {  
           
            $is_tf_blog_page = true;
            $archive = 'archive-content.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $categories = get_categories();

            $ids = array();
            foreach($categories as $cats){
                $ids[] = $cats -> term_id;
            }
            $posts = array(); 

            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                'orderby' => 'date',
                'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
            return;
        }
    }
// End function tfuse_category_on_blog_page()
endif;

add_filter('get_archives_link','wid_link',99);
if (!function_exists('wid_link')) :
    function wid_link($url) {
        $url = str_replace( '</a>&nbsp;', '&nbsp;', $url );
        $url = str_replace( '</li>', '</a></li>', $url );
        return $url;
    }
endif;

add_filter('wp_list_bookmarks','wid_link1',99);
if (!function_exists('wid_link1')) :
    function wid_link1($url) {
        $url = str_replace( '</a>', '', $url );
        $url = str_replace( '</li>', '</a></li>', $url );
        return $url;
    }
endif;

    
if (!function_exists('tfuse_action_footer')) :

/**
 * Dsiplay footer content
 *
 * To override tfuse_category_on_front_page() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_action_footer() {
        if ( !tfuse_options('enable_footer_shortcodes') ) {
            ?>
            <div class="f_col f_col_1">
                <?php dynamic_sidebar('footer-1'); ?>
            </div>

            <div class="f_col f_col_2">
                <?php dynamic_sidebar('footer-2'); ?>
            </div>
            <div class="f_col f_col_3">
                <?php dynamic_sidebar('footer-3'); ?>
            </div>

            <div class="f_col f_col_4">
                <?php dynamic_sidebar('footer-4'); ?>
            </div>
        
            <div class="f_col f_col_5">
                <?php dynamic_sidebar('footer-5'); ?>
            </div>
            <?php
        } else {
            $footer_shortcodes = tfuse_options('footer_shortcodes');
            echo $page_shortcodes = apply_filters('themefuse_shortcodes', $footer_shortcodes);
        }
    }

    add_action('tfuse_footer', 'tfuse_action_footer');
endif;

//Excerpt

function new_excerpt_more( $more ) {
    return '.';
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

if (!function_exists('tfuse_group_title')) :
    function tfuse_group_title(){
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy') );
        $ID = $term->term_id;
        $title = tfuse_options('group_title',null,$ID);
        echo $title;
    }
endif;

//show cat_name
if (!function_exists('tfuse_show_cat_name')) :	
    function tfuse_show_cat_name() {
        global $is_tf_front_page,$is_tf_blog_page;
        $cat_name = get_the_category();
            if($is_tf_blog_page)
            {
                echo $cat_name[0]->cat_name;
            }
            elseif($is_tf_front_page)
            { 
                 echo $cat_name[0]->cat_name;
            }
            elseif (is_category()) 
            {
                echo $cat_name[0]->cat_name; 
            }
    }
endif;

//select the id of category
if (!function_exists('tfuse_data')) :
function tfuse_data() {
	$ID = get_query_var('cat');
	if(is_category())
	{
		$ID = $ID;
	}
    return $ID;
}
endif;

//get cat_slug
if (!function_exists('tfuse_get_cat_slug')) :
    function tfuse_get_cat_slug() {
            $categories = get_categories();
            foreach($categories as $cat){
                    $cat_slug[] = $cat->slug ;
            }		
            $string = implode (',', $cat_slug);
            return $string;
    }
endif;

if ( !function_exists('tfuse_img_content')):

    function tfuse_img_content(){ 
        $content = $link = '';
		$args = array(
			'numberposts'     => -1,
		); 
        $posts_array = get_posts( $args );
        $option_name = 'thumbnail_image';
		foreach($posts_array as $post):
			$featured = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID));  
			if(tfuse_page_options('thumbnail_image',false,$post->ID)) continue;
			
			if(!empty($featured))
			{
				$value = $featured[0];
				tfuse_set_page_option($option_name, $value, $post->ID);
				tfuse_set_page_option('disable_image', true , $post->ID); 
			}
			else
			{
				$args = array(
				 'post_type' => 'attachment',
				 'numberposts' => -1,
				 'post_parent' => $post->ID
				); 
				$attachments = get_posts($args);
				if ($attachments) {
				 foreach ($attachments as $attachment) { 
								$value = $attachment->guid; 
								tfuse_set_page_option($option_name, $value, $post->ID);
								tfuse_set_page_option('disable_image', true , $post->ID); 
							 }
				}
				else
				{
					$content = $post->post_content;
						if(!empty($content))
						{   
							preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $content,$matches);
							if(!empty($matches))
							{
								$link = $matches[1]; 
								tfuse_set_page_option($option_name, $link , $post->ID);
								tfuse_set_page_option('disable_image', true , $post->ID);
							}
						}
				}
			}
                        
		endforeach;
			tfuse_set_option('enable_content_img',false, $cat_id = NULL);
    }
endif;

if ( tfuse_options('enable_content_img'))
{ 
    add_action('tfuse_head','tfuse_img_content');
}

//after content
if (!function_exists('tfuse_after_content')) :
    function tfuse_after_content() { 
        $after = tfuse_options('after_content');
        $after = trim($after);
        if(!empty($after))  
        { ?>
            <!-- after content -->
            <div class="after_content">
                <div class="container">
                   <?php echo $page_shortcodes = apply_filters('themefuse_shortcodes', $after);?>
            	</div>
            </div>
            <!--/ after content -->
<?php  }
    }
endif;

//show taxonomies names
if (!function_exists('tfuse_tax_link')) :	
    function tfuse_tax_link() 
    {	
        global $post;
        $term_link = $terms_name = '';
        $post = get_post($post->ID);
        $post_type = $post->post_type;
        $taxonomies = get_object_taxonomies($post_type);
        if($taxonomies[0] == 'category') { 
            return;
        }
        else
        {
            $terms = wp_get_post_terms($post->ID,'group');
            if(!empty($terms))
            {
                $term_link = get_term_link( $terms[0]->slug ,'group');
            }
            else
            {
                $term_link = '';
            }
            echo $term_link;
        }
    }
endif;	

//get portfoliotags
if (!function_exists('tfuse_get_tags')) :
    /**
     * To override tfuse_shorten_string() in a child theme, add your own tfuse_shorten_string()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

function tfuse_get_tags()
{
    global $post;
    $post = get_post($post->ID);
    $post_type = $post->post_type;
    $taxonomies = get_object_taxonomies($post_type); 
    $tags = wp_get_post_terms($post->ID,$taxonomies[1]);
    for($i=0;$i<count($tags);$i++)
    {
        if ($i != 0) echo ', ';
                echo $tags[$i]->name;
    }
}

endif;

//Top Ad
if (!function_exists('tfuse_top_adds')) :
    function tfuse_top_adds() {
        global $post,$is_tf_blog_page;
        $ID = '';
        $post_type = get_post_type();
        if($is_tf_blog_page)
        {  
            if(tfuse_options('blog_top_ad_space') == 'true')
            { 
                if(tfuse_options('blog_top_ad_space')=='true'&&!tfuse_options('blog_top_ad_image')&&!tfuse_options('blog_top_ad_adsense')){
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('blog_top_ad_adsense')&&!tfuse_options('blog_top_ad_image')||tfuse_options('blog_top_ad_adsense')&&tfuse_options('blog_top_ad_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('blog_top_ad_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('blog_top_ad_image')&&!tfuse_options('blog_top_ad_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('blog_top_ad_url').'"  target="_blank"><img src="'.tfuse_options('blog_top_ad_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('blog_top_ad_space') && !tfuse_options('top_ads_space'))
            { 
                if(!tfuse_options('blog_top_ads_space')&&!tfuse_options('blog_top_ads_image')&&!tfuse_options('blog_top_ads_adsense'))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('blog_top_ads_adsense')&&!tfuse_options('blog_top_ads_image')||tfuse_options('blog_top_ads_adsense')&& tfuse_options('blog_top_ads_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('blog_top_ads_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('blog_top_ads_image')&&!tfuse_options('blog_top_ads_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('blog_top_ads_url').'"  target="_blank"><img src="'.tfuse_options('blog_top_ads_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_front_page())
        {  
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page'){
                $page_id = $post->ID;
                if(tfuse_page_options('top_ad_space','',$page_id) == 'true')
                {
                    if(tfuse_page_options('top_ad_space','',$page_id)=='true'&&!tfuse_page_options('top_ad_image','',$page_id)&&!tfuse_page_options('top_ad_adsense','',$page_id)){
                        echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                    }
                    elseif(tfuse_page_options('top_ad_adsense','',$page_id)&&!tfuse_page_options('top_ad_image','',$page_id)||tfuse_page_options('top_ad_adsense','',$page_id)&&tfuse_page_options('top_ad_image','',$page_id))
                    {
                        echo  '<!-- adv before head -->'.tfuse_page_options('top_ad_adsense').' <!-- adv before head -->';
                    }
                    elseif(tfuse_page_options('top_ad_image','',$page_id)&&!tfuse_page_options('top_ad_adsense','',$page_id))
                    {
                        echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_page_options('top_ad_url','',$page_id).'"  target="_blank"><img src="'.tfuse_page_options('top_ad_image','',$page_id).'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                    }
                    else
                    {
                        echo '';
                    }
                }
            }
            elseif(tfuse_options('home_top_ad_space') == 'true')
            {
                if(tfuse_options('home_top_ad_space')=='true'&&!tfuse_options('home_top_ad_image')&&!tfuse_options('home_top_ad_adsense')){
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('home_top_ad_adsense')&&!tfuse_options('home_top_ad_image')||tfuse_options('home_top_ad_adsense')&&tfuse_options('home_top_ad_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('home_top_ad_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('home_top_ad_image')&&!tfuse_options('home_top_ad_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('home_top_ad_url').'"  target="_blank"><img src="'.tfuse_options('home_top_ad_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('home_top_ad_space') && !tfuse_options('top_ads_space',true))
            { 
                if(!tfuse_options('top_ads_space')&&!tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_adsense')&&!tfuse_options('top_ads_image')||tfuse_options('top_ads_adsense')&&tfuse_options('top_ads_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ads_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ads_url').'"  target="_blank"><img src="'.tfuse_options('top_ads_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_page())
        {
            if(tfuse_page_options('top_ad_space') == 'true')
            {
                if(tfuse_page_options('top_ad_space')=='true'&&!tfuse_page_options('top_ad_image')&&!tfuse_page_options('top_ad_adsense')){
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_page_options('top_ad_adsense')&&!tfuse_page_options('top_ad_image')||tfuse_page_options('top_ad_adsense')&&tfuse_page_options('top_ad_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_page_options('top_ad_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_page_options('top_ad_image')&&!tfuse_page_options('top_ad_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_page_options('top_ad_url').'"  target="_blank"><img src="'.tfuse_page_options('top_ad_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_page_options('top_ad_space') && !tfuse_options('top_ads_space',true))
            {
                if(!tfuse_options('top_ads_space')&&!tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_adsense')&&!tfuse_options('top_ads_image')||tfuse_options('top_ads_adsense')&&tfuse_options('top_ads_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ads_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ads_url').'"  target="_blank"><img src="'.tfuse_options('top_ads_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_single() && $post_type == 'members')
        {
            if(tfuse_page_options('top_ad_space') == 'true')
            {
                if(tfuse_page_options('top_ad_space')=='true'&&!tfuse_page_options('top_ad_image')&&!tfuse_page_options('top_ad_adsense')){
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_page_options('top_ad_adsense')&&!tfuse_page_options('top_ad_image')||tfuse_page_options('top_ad_adsense')&&tfuse_page_options('top_ad_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_page_options('top_ad_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_page_options('top_ad_image')&&!tfuse_page_options('top_ad_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_page_options('top_ad_url').'"  target="_blank"><img src="'.tfuse_page_options('top_ad_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_page_options('top_ad_space') && !tfuse_options('top_ads_space',true))
            {
                if(!tfuse_options('top_ads_space')&&!tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_adsense')&&!tfuse_options('top_ads_image')||tfuse_options('top_ads_adsense')&&tfuse_options('top_ads_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ads_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ads_url').'"  target="_blank"><img src="'.tfuse_options('top_ads_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_single() && !is_page())
        { 
            $cat_name = get_the_category();
            $post = get_post($post->ID);
            $post_type = $post->post_type;
            $taxonomies = get_object_taxonomies($post_type); 
            if(!empty($taxonomies))
            { 
                if($taxonomies[0] == 'category') { 
                if(!empty($terms))
                        $cat_id = $terms[0]->term_id;
                    else
                        $cat_id = 0;
                }
                elseif($taxonomies[0] == 'group')
                {
                    $terms = wp_get_post_terms($post->ID,'group');
                    if(!empty($terms))
                        $cat_id = $terms[0]->term_id;
                    else
                        $cat_id = 0;
                }
                elseif($taxonomies[0] == 'services')
                {
                    $terms = wp_get_post_terms($post->ID,'services');
                    if(!empty($terms))
                        $cat_id = $terms[0]->term_id;
                    else
                        $cat_id = 0;
                }
                elseif($taxonomies[0] == 'jobs')
                {
                    $terms = wp_get_post_terms($post->ID,'jobs');
                    if(!empty($terms))
                        $cat_id = $terms[0]->term_id;
                    else
                        $cat_id = 0;
                }
            }
            if(!tfuse_page_options('content_ads_post'))
            {  
                if(tfuse_page_options('top_ad_space') == 'true')
                {
                    if(tfuse_page_options('top_ad_space')=='true'&&!tfuse_page_options('top_ad_image')&&!tfuse_page_options('top_ad_adsense')){
                      echo '
                            <!-- adv before head -->
                                <div class="adv_head">
                                    <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                                </div>
                            <!-- adv before head -->';
                    }
                    elseif(tfuse_page_options('top_ad_adsense')&&!tfuse_page_options('top_ad_image')||tfuse_page_options('top_ad_adsense')&&tfuse_page_options('top_ad_image'))
                    {
                        echo  '<!-- adv before head -->'.tfuse_page_options('top_ad_adsense').' <!-- adv before head -->';
                    }
                    elseif(tfuse_page_options('top_ad_image')&&!tfuse_page_options('top_ad_adsense'))
                    {
                        echo  '
                        <!-- adv before head -->
                        <div class="adv_head">
                            <div class="adv_728"><a href="'.tfuse_page_options('top_ad_url').'"  target="_blank"><img src="'.tfuse_page_options('top_ad_image').'" width="728" height="90" alt="advert"></a></div>
                        </div>
                        <!-- adv before head -->
                        ';
                    }
                    else
                    {
                        echo '';
                    }
                }
            }
            elseif(tfuse_page_options('content_ads_post') && tfuse_options('top_ad_space',null,$cat_id))
            { 
                if(tfuse_options('top_ad_space',null,$cat_id)=='true'&&!tfuse_options('top_ad_image',null,$cat_id)&&!tfuse_options('top_ad_adsense',null,$cat_id))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ad_adsense',null,$cat_id)&&!tfuse_options('top_ad_image',null,$cat_id)||tfuse_options('top_ad_adsense',null,$cat_id)&&tfuse_options('top_ad_image',null,$cat_id))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ad_adsense',null,$cat_id).' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ad_image',null,$cat_id)&&!tfuse_options('top_ad_adsense',null,$cat_id))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ad_url',null,$cat_id).'"  target="_blank"><img src="'.tfuse_options('top_ad_image',null,$cat_id).'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('top_ad_space',null,$cat_id) && !tfuse_options('top_ads_space',true))
            {  
                if(!tfuse_options('top_ads_space')&&!tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_adsense')&&!tfuse_options('top_ads_image')||tfuse_options('top_ads_adsense')&&tfuse_options('top_ads_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ads_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ads_url').'"  target="_blank"><img src="'.tfuse_options('top_ads_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_tax())
        {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy') );
            $cat_id = $term->term_id;
            if(tfuse_options('top_ad_space',null,$cat_id))
            {
                if(tfuse_options('top_ad_space',null,$cat_id)=='true'&&!tfuse_options('top_ad_image',null,$cat_id)&&!tfuse_options('top_ad_adsense',null,$cat_id))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ad_adsense',null,$cat_id)&&!tfuse_options('top_ad_image',null,$cat_id)||tfuse_options('top_ad_adsense',null,$cat_id)&&tfuse_options('top_ad_image',null,$cat_id))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ad_adsense',null,$cat_id).' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ad_image',null,$cat_id)&&!tfuse_options('top_ad_adsense',null,$cat_id))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ad_url',null,$cat_id).'"  target="_blank"><img src="'.tfuse_options('top_ad_image',null,$cat_id).'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('top_ad_space',null,$cat_id) && !tfuse_options('top_ads_space',true))
            {
                if(!tfuse_options('top_ads_space')&&!tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {  
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_adsense')&&!tfuse_options('top_ads_image')||tfuse_options('top_ads_adsense')&&tfuse_options('top_ads_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ads_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ads_url').'"  target="_blank"><img src="'.tfuse_options('top_ads_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_category())
        {
            $cat_id = get_query_var('cat');
            if(tfuse_options('top_ad_space',null,$cat_id))
            {
                if(tfuse_options('top_ad_space',null,$cat_id)=='true'&&!tfuse_options('top_ad_image',null,$cat_id)&&!tfuse_options('top_ad_adsense',null,$cat_id))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ad_adsense',null,$cat_id)&&!tfuse_options('top_ad_image',null,$cat_id)||tfuse_options('top_ad_adsense',null,$cat_id)&&tfuse_options('top_ad_image',null,$cat_id))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ad_adsense',null,$cat_id).' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ad_image',null,$cat_id)&&!tfuse_options('top_ad_adsense',null,$cat_id))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ad_url',null,$cat_id).'"  target="_blank"><img src="'.tfuse_options('top_ad_image',null,$cat_id).'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('top_ad_space',null,$cat_id) && !tfuse_options('top_ads_space',true))
            {
                if(!tfuse_options('top_ads_space')&&!tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {  
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_adsense')&&!tfuse_options('top_ads_image')||tfuse_options('top_ads_adsense')&&tfuse_options('top_ads_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ads_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ads_url').'"  target="_blank"><img src="'.tfuse_options('top_ads_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
    }
endif;

//ads for category
if (!function_exists('tfuse_category_ads')) :
    function tfuse_category_ads() {
        global $post,$is_tf_blog_page,$is_tf_front_page;
        $post_type = get_post_type();
        if($is_tf_blog_page)
        {
            if(tfuse_options('blog_bfcontent_ads_space'))
            {
                if(tfuse_options('blog_bfcontent_number') == 'one' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!tfuse_options('blog_bfcontent_ads_adsense1')){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif(tfuse_options('blog_bfcontent_ads_adsense1'))
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.tfuse_options('blog_bfcontent_ads_adsense1').'</div>
                        </div>';
                    }
                    elseif($adds1)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('blog_bfcontent_number') == 'two' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    $adds2 = tfuse_options('blog_bfcontent_ads_image2');
                    $adsense1 = tfuse_options('blog_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('blog_bfcontent_ads_adsense2');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('blog_bfcontent_number') == 'three' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    $adds2 = tfuse_options('blog_bfcontent_ads_image2');
                    $adds3 = tfuse_options('blog_bfcontent_ads_image3');
                    $adsense1 = tfuse_options('blog_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('blog_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('blog_bfcontent_ads_adsense3');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 )
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('blog_bfcontent_number') == 'four' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    $adds2 = tfuse_options('blog_bfcontent_ads_image2');
                    $adds3 = tfuse_options('blog_bfcontent_ads_image3');
                    $adds4 = tfuse_options('blog_bfcontent_ads_image4');
                    $adsense1 = tfuse_options('blog_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('blog_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('blog_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('blog_bfcontent_ads_adsense4');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4')&&!tfuse_page_options('bfcontent_ads_adsense4')){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('blog_bfcontent_number') == 'five' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    $adds2 = tfuse_options('blog_bfcontent_ads_image2');
                    $adds3 = tfuse_options('blog_bfcontent_ads_image3');
                    $adds4 = tfuse_options('blog_bfcontent_ads_image4');
                    $adds5 = tfuse_options('blog_bfcontent_ads_image5');
                    $adsense1 = tfuse_options('blog_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('blog_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('blog_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('blog_bfcontent_ads_adsense4');
                    $adsense5 = tfuse_options('blog_bfcontent_ads_adsense5');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('blog_bfcontent_number') == 'six' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    $adds2 = tfuse_options('blog_bfcontent_ads_image2');
                    $adds3 = tfuse_options('blog_bfcontent_ads_image3');
                    $adds4 = tfuse_options('blog_bfcontent_ads_image4');
                    $adds5 = tfuse_options('blog_bfcontent_ads_image5');
                    $adds6 = tfuse_options('blog_bfcontent_ads_image6');
                    $adsense1 = tfuse_options('blog_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('blog_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('blog_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('blog_bfcontent_ads_adsense4');
                    $adsense5 = tfuse_options('blog_bfcontent_ads_adsense5');
                    $adsense6 = tfuse_options('blog_bfcontent_ads_adsense6');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                        echo  '
                            <!-- adv before content -->
                                    <div class="adv_before_content">
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    </div>
                            <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        <div class="adv_125">'.$adsense6.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('blog_bfcontent_number') == 'seven' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    $adds2 = tfuse_options('blog_bfcontent_ads_image2');
                    $adds3 = tfuse_options('blog_bfcontent_ads_image3');
                    $adds4 = tfuse_options('blog_bfcontent_ads_image4');
                    $adds5 = tfuse_options('blog_bfcontent_ads_image5');
                    $adds6 = tfuse_options('blog_bfcontent_ads_image6');
                    $adds7 = tfuse_options('blog_bfcontent_ads_image7');
                    $adsense1 = tfuse_options('blog_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('blog_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('blog_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('blog_bfcontent_ads_adsense4');
                    $adsense5 = tfuse_options('blog_bfcontent_ads_adsense5');
                    $adsense6 = tfuse_options('blog_bfcontent_ads_adsense6');
                    $adsense7 = tfuse_options('blog_bfcontent_ads_adsense7');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                        echo  '
                            <!-- adv before content -->
                                    <div class="adv_before_content">
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    </div>
                            <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        <div class="adv_125">'.$adsense6.'</div>
                        <div class="adv_125">'.$adsense7.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url7').'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
            }
            elseif(!tfuse_options('blog_bfcontent_ads_space') && !tfuse_options('bfc_ads_space'))
            {
                tfuse_bfc_ads_admin();
            }
        }
        elseif($is_tf_front_page)
        {
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page'){
                $page_id = $post->ID;
                if(tfuse_page_options('bfcontent_ads_space','',$page_id))
                {
                    if(tfuse_page_options('bfcontent_number','',$page_id) == 'one' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!tfuse_page_options('bfcontent_ads_adsense1','',$page_id)){
                            echo  '
                                    <!-- adv before content -->
                                            <div class="adv_before_content">
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            </div>
                                    <!--/ adv before content -->';
                        }
                        elseif(tfuse_page_options('bfcontent_ads_adsense1'))
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.tfuse_page_options('bfcontent_ads_adsense1','',$page_id).'</div>
                            </div>';
                        }
                        elseif($adds1)
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                    elseif(tfuse_page_options('bfcontent_number','',$page_id) == 'two' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        $adds2 = tfuse_page_options('bfcontent_ads_image2','',$page_id);
                        $adsense1 = tfuse_page_options('bfcontent_ads_adsense1','',$page_id);
                        $adsense2 = tfuse_page_options('bfcontent_ads_adsense2','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                            echo  '
                                    <!-- adv before content -->
                                            <div class="adv_before_content">
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            </div>
                                    <!--/ adv before content -->';
                        }
                        elseif($adsense1 || $adsense2)
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.$adsense1.'</div>
                            <div class="adv_125">'.$adsense2.'</div>
                            </div>';
                        }
                        elseif($adds1 || $adds2 )
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2','',$page_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                    elseif(tfuse_page_options('bfcontent_number','',$page_id) == 'three' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        $adds2 = tfuse_page_options('bfcontent_ads_image2','',$page_id);
                        $adds3 = tfuse_page_options('bfcontent_ads_image3','',$page_id);
                        $adsense1 = tfuse_page_options('bfcontent_ads_adsense1','',$page_id);
                        $adsense2 = tfuse_page_options('bfcontent_ads_adsense2','',$page_id);
                        $adsense3 = tfuse_page_options('bfcontent_ads_adsense3','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                            echo  '
                                    <!-- adv before content -->
                                            <div class="adv_before_content">
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            </div>
                                    <!--/ adv before content -->';
                        }
                        elseif($adsense1 || $adsense2 || $adsense3 )
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.$adsense1.'</div>
                            <div class="adv_125">'.$adsense2.'</div>
                            <div class="adv_125">'.$adsense3.'</div>
                            </div>';
                        }
                        elseif($adds1 || $adds2 || $adds3 )
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2','',$page_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3','',$page_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                    elseif(tfuse_page_options('bfcontent_number','',$page_id) == 'four' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        $adds2 = tfuse_page_options('bfcontent_ads_image2','',$page_id);
                        $adds3 = tfuse_page_options('bfcontent_ads_image3','',$page_id);
                        $adds4 = tfuse_page_options('bfcontent_ads_image4','',$page_id);
                        $adsense1 = tfuse_page_options('bfcontent_ads_adsense1','',$page_id);
                        $adsense2 = tfuse_page_options('bfcontent_ads_adsense2','',$page_id);
                        $adsense3 = tfuse_page_options('bfcontent_ads_adsense3','',$page_id);
                        $adsense4 = tfuse_page_options('bfcontent_ads_adsense4','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4','',$page_id)&&!tfuse_page_options('bfcontent_ads_adsense4','',$page_id)){
                            echo  '
                                    <!-- adv before content -->
                                            <div class="adv_before_content">
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            </div>
                                    <!--/ adv before content -->';
                        }
                        elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.$adsense1.'</div>
                            <div class="adv_125">'.$adsense2.'</div>
                            <div class="adv_125">'.$adsense3.'</div>
                            <div class="adv_125">'.$adsense4.'</div>
                            </div>';
                        }
                        elseif($adds1 || $adds2 || $adds3 || $adds4)
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2','',$page_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3','',$page_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4','',$page_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                    elseif(tfuse_page_options('bfcontent_number','',$page_id) == 'five' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        $adds2 = tfuse_page_options('bfcontent_ads_image2','',$page_id);
                        $adds3 = tfuse_page_options('bfcontent_ads_image3','',$page_id);
                        $adds4 = tfuse_page_options('bfcontent_ads_image4','',$page_id);
                        $adds5 = tfuse_page_options('bfcontent_ads_image5','',$page_id);
                        $adsense1 = tfuse_page_options('bfcontent_ads_adsense1','',$page_id);
                        $adsense2 = tfuse_page_options('bfcontent_ads_adsense2','',$page_id);
                        $adsense3 = tfuse_page_options('bfcontent_ads_adsense3','',$page_id);
                        $adsense4 = tfuse_page_options('bfcontent_ads_adsense4','',$page_id);
                        $adsense5 = tfuse_page_options('bfcontent_ads_adsense5','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                            echo  '
                                    <!-- adv before content -->
                                            <div class="adv_before_content">
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            </div>
                                    <!--/ adv before content -->';
                        }
                        elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.$adsense1.'</div>
                            <div class="adv_125">'.$adsense2.'</div>
                            <div class="adv_125">'.$adsense3.'</div>
                            <div class="adv_125">'.$adsense4.'</div>
                            <div class="adv_125">'.$adsense5.'</div>
                            </div>';
                        }
                        elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2','',$page_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3','',$page_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4','',$page_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5','',$page_id).'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                    elseif(tfuse_page_options('bfcontent_number','',$page_id) == 'six' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        $adds2 = tfuse_page_options('bfcontent_ads_image2','',$page_id);
                        $adds3 = tfuse_page_options('bfcontent_ads_image3','',$page_id);
                        $adds4 = tfuse_page_options('bfcontent_ads_image4','',$page_id);
                        $adds5 = tfuse_page_options('bfcontent_ads_image5','',$page_id);
                        $adds6 = tfuse_page_options('bfcontent_ads_image6','',$page_id);
                        $adsense1 = tfuse_page_options('bfcontent_ads_adsense1','',$page_id);
                        $adsense2 = tfuse_page_options('bfcontent_ads_adsense2','',$page_id);
                        $adsense3 = tfuse_page_options('bfcontent_ads_adsense3','',$page_id);
                        $adsense4 = tfuse_page_options('bfcontent_ads_adsense4','',$page_id);
                        $adsense5 = tfuse_page_options('bfcontent_ads_adsense5','',$page_id);
                        $adsense6 = tfuse_page_options('bfcontent_ads_adsense6','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                            echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                        }
                        elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.$adsense1.'</div>
                            <div class="adv_125">'.$adsense2.'</div>
                            <div class="adv_125">'.$adsense3.'</div>
                            <div class="adv_125">'.$adsense4.'</div>
                            <div class="adv_125">'.$adsense5.'</div>
                            <div class="adv_125">'.$adsense6.'</div>
                            </div>';
                        }
                        elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2','',$page_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3','',$page_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4','',$page_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5','',$page_id).'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url6','',$page_id).'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                    elseif(tfuse_page_options('bfcontent_number','',$page_id) == 'seven' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        $adds2 = tfuse_page_options('bfcontent_ads_image2','',$page_id);
                        $adds3 = tfuse_page_options('bfcontent_ads_image3','',$page_id);
                        $adds4 = tfuse_page_options('bfcontent_ads_image4','',$page_id);
                        $adds5 = tfuse_page_options('bfcontent_ads_image5','',$page_id);
                        $adds6 = tfuse_page_options('bfcontent_ads_image6','',$page_id);
                        $adds7 = tfuse_page_options('bfcontent_ads_image7','',$page_id);
                        $adsense1 = tfuse_page_options('bfcontent_ads_adsense1','',$page_id);
                        $adsense2 = tfuse_page_options('bfcontent_ads_adsense2','',$page_id);
                        $adsense3 = tfuse_page_options('bfcontent_ads_adsense3','',$page_id);
                        $adsense4 = tfuse_page_options('bfcontent_ads_adsense4','',$page_id);
                        $adsense5 = tfuse_page_options('bfcontent_ads_adsense5','',$page_id);
                        $adsense6 = tfuse_page_options('bfcontent_ads_adsense6','',$page_id);
                        $adsense7 = tfuse_page_options('bfcontent_ads_adsense7','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                            echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                        }
                        elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.$adsense1.'</div>
                            <div class="adv_125">'.$adsense2.'</div>
                            <div class="adv_125">'.$adsense3.'</div>
                            <div class="adv_125">'.$adsense4.'</div>
                            <div class="adv_125">'.$adsense5.'</div>
                            <div class="adv_125">'.$adsense6.'</div>
                            <div class="adv_125">'.$adsense7.'</div>
                            </div>';
                        }
                        elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2','',$page_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3','',$page_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4','',$page_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5','',$page_id).'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url6','',$page_id).'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url7','',$page_id).'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                }
            }
            elseif(tfuse_options('home_bfcontent_ads_space'))
            { 
                if(tfuse_options('home_bfcontent_number') == 'one' )
                {
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!tfuse_options('home_bfcontent_ads_adsense1')){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif(tfuse_options('home_bfcontent_ads_adsense1'))
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.tfuse_options('home_bfcontent_ads_adsense1').'</div>
                        </div>';
                    }
                    elseif($adds1)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('home_bfcontent_number') == 'two' )
                {
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    $adds2 = tfuse_options('home_bfcontent_ads_image2');
                    $adsense1 = tfuse_options('home_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('home_bfcontent_ads_adsense2');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('home_bfcontent_number') == 'three' )
                {
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    $adds2 = tfuse_options('home_bfcontent_ads_image2');
                    $adds3 = tfuse_options('home_bfcontent_ads_image3');
                    $adsense1 = tfuse_options('home_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('home_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('home_bfcontent_ads_adsense3');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 )
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('home_bfcontent_number') == 'four' )
                {   
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    $adds2 = tfuse_options('home_bfcontent_ads_image2');
                    $adds3 = tfuse_options('home_bfcontent_ads_image3');
                    $adds4 = tfuse_options('home_bfcontent_ads_image4');
                    $adsense1 = tfuse_options('home_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('home_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('home_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('home_bfcontent_ads_adsense4');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4')&&!tfuse_page_options('bfcontent_ads_adsense4')){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('home_bfcontent_number') == 'five' )
                {
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    $adds2 = tfuse_options('home_bfcontent_ads_image2');
                    $adds3 = tfuse_options('home_bfcontent_ads_image3');
                    $adds4 = tfuse_options('home_bfcontent_ads_image4');
                    $adds5 = tfuse_options('home_bfcontent_ads_image5');
                    $adsense1 = tfuse_options('home_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('home_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('home_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('home_bfcontent_ads_adsense4');
                    $adsense5 = tfuse_options('home_bfcontent_ads_adsense5');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('home_bfcontent_number') == 'six' )
                {
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    $adds2 = tfuse_options('home_bfcontent_ads_image2');
                    $adds3 = tfuse_options('home_bfcontent_ads_image3');
                    $adds4 = tfuse_options('home_bfcontent_ads_image4');
                    $adds5 = tfuse_options('home_bfcontent_ads_image5');
                    $adds6 = tfuse_options('home_bfcontent_ads_image6');
                    $adsense1 = tfuse_options('home_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('home_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('home_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('home_bfcontent_ads_adsense4');
                    $adsense5 = tfuse_options('home_bfcontent_ads_adsense5');
                    $adsense6 = tfuse_options('home_bfcontent_ads_adsense6');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                        echo  '
                            <!-- adv before content -->
                                    <div class="adv_before_content">
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    </div>
                            <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        <div class="adv_125">'.$adsense6.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('home_bfcontent_number') == 'seven' )
                {
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    $adds2 = tfuse_options('home_bfcontent_ads_image2');
                    $adds3 = tfuse_options('home_bfcontent_ads_image3');
                    $adds4 = tfuse_options('home_bfcontent_ads_image4');
                    $adds5 = tfuse_options('home_bfcontent_ads_image5');
                    $adds6 = tfuse_options('home_bfcontent_ads_image6');
                    $adds7 = tfuse_options('home_bfcontent_ads_image7');
                    $adsense1 = tfuse_options('home_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('home_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('home_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('home_bfcontent_ads_adsense4');
                    $adsense5 = tfuse_options('home_bfcontent_ads_adsense5');
                    $adsense6 = tfuse_options('home_bfcontent_ads_adsense6');
                    $adsense7 = tfuse_options('home_bfcontent_ads_adsense7');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                        echo  '
                            <!-- adv before content -->
                                    <div class="adv_before_content">
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    </div>
                            <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        <div class="adv_125">'.$adsense6.'</div>
                        <div class="adv_125">'.$adsense7.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url7').'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
            }
            elseif(!tfuse_options('home_bfcontent_ads_space') && !tfuse_options('bfc_ads_space'))
            { 
                tfuse_bfc_ads_admin();
            }
        }
        elseif(is_page())
        {  
            if(tfuse_page_options('bfcontent_ads_space'))
            {
                if(tfuse_page_options('bfcontent_number') == 'one' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!tfuse_page_options('bfcontent_ads_adsense1')){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif(tfuse_page_options('bfcontent_ads_adsense1'))
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.tfuse_page_options('bfcontent_ads_adsense1').'</div>
                        </div>';
                    }
                    elseif($adds1)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'two' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'three' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adds3 = tfuse_page_options('bfcontent_ads_image3');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 )
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'four' )
                {   
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adds3 = tfuse_page_options('bfcontent_ads_image3');
                    $adds4 = tfuse_page_options('bfcontent_ads_image4');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                    $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4')&&!tfuse_page_options('bfcontent_ads_adsense4')){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'five' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adds3 = tfuse_page_options('bfcontent_ads_image3');
                    $adds4 = tfuse_page_options('bfcontent_ads_image4');
                    $adds5 = tfuse_page_options('bfcontent_ads_image5');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                    $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
                    $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'six' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adds3 = tfuse_page_options('bfcontent_ads_image3');
                    $adds4 = tfuse_page_options('bfcontent_ads_image4');
                    $adds5 = tfuse_page_options('bfcontent_ads_image5');
                    $adds6 = tfuse_page_options('bfcontent_ads_image6');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                    $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
                    $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
                    $adsense6 = tfuse_page_options('bfcontent_ads_adsense6');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                        echo  '
                            <!-- adv before content -->
                                    <div class="adv_before_content">
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    </div>
                            <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        <div class="adv_125">'.$adsense6.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'seven' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adds3 = tfuse_page_options('bfcontent_ads_image3');
                    $adds4 = tfuse_page_options('bfcontent_ads_image4');
                    $adds5 = tfuse_page_options('bfcontent_ads_image5');
                    $adds6 = tfuse_page_options('bfcontent_ads_image6');
                    $adds7 = tfuse_page_options('bfcontent_ads_image7');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                    $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
                    $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
                    $adsense6 = tfuse_page_options('bfcontent_ads_adsense6');
                    $adsense7 = tfuse_page_options('bfcontent_ads_adsense7');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                        echo  '
                            <!-- adv before content -->
                                    <div class="adv_before_content">
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    </div>
                            <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        <div class="adv_125">'.$adsense6.'</div>
                        <div class="adv_125">'.$adsense7.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url7').'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
            }
            elseif(!tfuse_page_options('bfcontent_ads_space') && !tfuse_options('bfc_ads_space'))
            {
                tfuse_bfc_ads_admin();
            }
        }
        elseif(is_single() && $post_type == 'members')
        {
            if(tfuse_page_options('bfcontent_ads_space'))
            {
                if(tfuse_page_options('bfcontent_number') == 'one' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!tfuse_page_options('bfcontent_ads_adsense1')){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif(tfuse_page_options('bfcontent_ads_adsense1'))
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.tfuse_page_options('bfcontent_ads_adsense1').'</div>
                        </div>';
                    }
                    elseif($adds1)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'two' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'three' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adds3 = tfuse_page_options('bfcontent_ads_image3');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 )
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'four' )
                {   
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adds3 = tfuse_page_options('bfcontent_ads_image3');
                    $adds4 = tfuse_page_options('bfcontent_ads_image4');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                    $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4')&&!tfuse_page_options('bfcontent_ads_adsense4')){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'five' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adds3 = tfuse_page_options('bfcontent_ads_image3');
                    $adds4 = tfuse_page_options('bfcontent_ads_image4');
                    $adds5 = tfuse_page_options('bfcontent_ads_image5');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                    $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
                    $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'six' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adds3 = tfuse_page_options('bfcontent_ads_image3');
                    $adds4 = tfuse_page_options('bfcontent_ads_image4');
                    $adds5 = tfuse_page_options('bfcontent_ads_image5');
                    $adds6 = tfuse_page_options('bfcontent_ads_image6');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                    $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
                    $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
                    $adsense6 = tfuse_page_options('bfcontent_ads_adsense6');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                        echo  '
                            <!-- adv before content -->
                                    <div class="adv_before_content">
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    </div>
                            <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        <div class="adv_125">'.$adsense6.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'seven' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adds3 = tfuse_page_options('bfcontent_ads_image3');
                    $adds4 = tfuse_page_options('bfcontent_ads_image4');
                    $adds5 = tfuse_page_options('bfcontent_ads_image5');
                    $adds6 = tfuse_page_options('bfcontent_ads_image6');
                    $adds7 = tfuse_page_options('bfcontent_ads_image7');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                    $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
                    $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
                    $adsense6 = tfuse_page_options('bfcontent_ads_adsense6');
                    $adsense7 = tfuse_page_options('bfcontent_ads_adsense7');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                        echo  '
                            <!-- adv before content -->
                                    <div class="adv_before_content">
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    </div>
                            <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        <div class="adv_125">'.$adsense6.'</div>
                        <div class="adv_125">'.$adsense7.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url7').'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
            }
            elseif(!tfuse_page_options('bfcontent_ads_space') && !tfuse_options('bfc_ads_space'))
            {
                tfuse_bfc_ads_admin();
            }
        }
        elseif(is_single() && !is_page())
        {
            $cat_name = get_the_category();
            $post = get_post($post->ID);
            $post_type = $post->post_type;
            $taxonomies = get_object_taxonomies($post_type);
            if(!empty($taxonomies))
            {
                if($taxonomies[0] == 'category') { 
                    if(!empty($terms))
                        $cat_id = $terms[0]->term_id;
                    else
                        $cat_id = 0;
                }
                elseif($taxonomies[0] == 'group')
                {
                    $terms = wp_get_post_terms($post->ID,'group');
                    if(!empty($terms))
                        $cat_id = $terms[0]->term_id;
                    else
                        $cat_id = 0;
                }
                elseif($taxonomies[0] == 'services')
                {
                    $terms = wp_get_post_terms($post->ID,'services');
                    if(!empty($terms))
                        $cat_id = $terms[0]->term_id;
                    else
                        $cat_id = 0;
                }
                elseif($taxonomies[0] == 'jobs')
                {
                    $terms = wp_get_post_terms($post->ID,'jobs');
                    if(!empty($terms))
                        $cat_id = $terms[0]->term_id;
                    else
                        $cat_id = 0;
                }
            }
            if(!tfuse_page_options('content_ads_post'))
            { 
                tfuse_bfc_ads_post();
            }
            elseif(tfuse_page_options('content_ads_post') && tfuse_options('bfcontent_ads_space',null,$cat_id))
            {
                tfuse_bfc_ads_cat($cat_id);
            }
            elseif(!tfuse_options('bfcontent_ads_space',null,$cat_id) && !tfuse_options('bfc_ads_space'))
            { 
                tfuse_bfc_ads_admin();
            }
        }
        elseif(is_category())
        {
            $cat_id = get_query_var('cat');
            if(tfuse_options('bfcontent_ads_space',null,$cat_id))
            {
                tfuse_bfc_ads_cat($cat_id);
            }
            elseif(!tfuse_options('bfcontent_ads_space',null,$cat_id) && !tfuse_options('bfc_ads_space'))
            { 
                tfuse_bfc_ads_admin();
            }
        }
        elseif(is_tax())
        {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy') );
            $cat_id = $term->term_id;
            if(tfuse_options('bfcontent_ads_space',null,$cat_id))
            {
                tfuse_bfc_ads_cat($cat_id);
            }
            elseif(!tfuse_options('bfcontent_ads_space',null,$cat_id) && !tfuse_options('bfc_ads_space'))
            { 
                tfuse_bfc_ads_admin();
            }
        }
    }
endif;

//468x60 ad
if (!function_exists('tfuse_hook')) :
    function tfuse_hook() {
        $id = 0;
        global $post,$is_tf_front_page,$is_tf_blog_page;
        $ID = '';
        $post_type = get_post_type();
        if($is_tf_blog_page)
        {
            if (tfuse_options('blog_hook_space')=='true')
            {
                if(tfuse_options('blog_hook_space')&&!tfuse_options('blog_hook_image')&&!tfuse_options('blog_hook_adsense')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('blog_hook_adsense')&&!tfuse_options('blog_hook_image')||tfuse_options('blog_hook_adsense')&&tfuse_options('blog_hook_image'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('blog_hook_adsense').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('blog_hook_image')&&!tfuse_options('blog_hook_adsense'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('blog_hook_url').'"  target="_blank"><img src="'.tfuse_options('blog_hook_image').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('blog_hook_space') && !tfuse_options('content_ads_space'))
            {
                if(!tfuse_options('content_ads_space')&&!tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense_admin')&&!tfuse_options('hook_image_admin')||tfuse_options('hook_adsense_admin')&&tfuse_options('hook_image_admin'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense_admin').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url_admin').'"  target="_blank"><img src="'.tfuse_options('hook_image_admin').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif($is_tf_front_page)
        {
             if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page'){
                $page_id = $post->ID;
                if(tfuse_page_options('hook_space','',$page_id)&&!tfuse_page_options('hook_image','',$page_id)&&!tfuse_page_options('hook_adsense','',$page_id)){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_page_options('hook_adsense','',$page_id)&&!tfuse_page_options('hook_image','',$page_id)||tfuse_page_options('hook_adsense','',$page_id)&&tfuse_page_options('hook_image','',$page_id))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_page_options('hook_adsense','',$page_id).'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_page_options('hook_image','',$page_id)&&!tfuse_page_options('hook_adsense','',$page_id))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_page_options('hook_url','',$page_id).'"  target="_blank"><img src="'.tfuse_page_options('hook_image','',$page_id).'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif (tfuse_options('home_hook_space')=='true')
            {
                if(tfuse_options('home_hook_space')&&!tfuse_options('home_hook_image')&&!tfuse_options('home_hook_adsense')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('home_hook_adsense')&&!tfuse_options('home_hook_image')||tfuse_options('home_hook_adsense')&&tfuse_options('home_hook_image'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('home_hook_adsense').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('home_hook_image')&&!tfuse_options('home_hook_adsense'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('home_hook_url').'"  target="_blank"><img src="'.tfuse_options('home_hook_image').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('home_hook_space') && !tfuse_options('content_ads_space'))
            {
                if(!tfuse_options('content_ads_space')&&!tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense_admin')&&!tfuse_options('hook_image_admin')||tfuse_options('hook_adsense_admin')&&tfuse_options('hook_image_admin'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense_admin').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url_admin').'"  target="_blank"><img src="'.tfuse_options('hook_image_admin').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_page())
        {
            if (tfuse_page_options('hook_space')=='true')
            {
                if(tfuse_page_options('hook_space')&&!tfuse_page_options('hook_image')&&!tfuse_page_options('hook_adsense')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_page_options('hook_adsense')&&!tfuse_page_options('hook_image')||tfuse_page_options('hook_adsense')&&tfuse_page_options('hook_image'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_page_options('hook_adsense').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_page_options('hook_image')&&!tfuse_page_options('hook_adsense'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_page_options('hook_url').'"  target="_blank"><img src="'.tfuse_page_options('hook_image').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_page_options('hook_space') && !tfuse_options('content_ads_space',true))
            {
                if(!tfuse_options('content_ads_space')&&!tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense_admin')&&!tfuse_options('hook_image_admin')||tfuse_options('hook_adsense_admin')&&tfuse_options('hook_image_admin'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense_admin').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url_admin').'"  target="_blank"><img src="'.tfuse_options('hook_image_admin').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_single() && $post_type == 'members')
        {
            if (tfuse_page_options('hook_space')=='true')
            {
                if(tfuse_page_options('hook_space')&&!tfuse_page_options('hook_image')&&!tfuse_page_options('hook_adsense')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_page_options('hook_adsense')&&!tfuse_page_options('hook_image')||tfuse_page_options('hook_adsense')&&tfuse_page_options('hook_image'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_page_options('hook_adsense').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_page_options('hook_image')&&!tfuse_page_options('hook_adsense'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_page_options('hook_url').'"  target="_blank"><img src="'.tfuse_page_options('hook_image').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_page_options('hook_space') && !tfuse_options('content_ads_space',true))
            {
                if(!tfuse_options('content_ads_space')&&!tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense_admin')&&!tfuse_options('hook_image_admin')||tfuse_options('hook_adsense_admin')&&tfuse_options('hook_image_admin'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense_admin').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url_admin').'"  target="_blank"><img src="'.tfuse_options('hook_image_admin').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_single() && !is_page())
        {
            $cat_name = get_the_category();
            $post = get_post($post->ID);
            $post_type = $post->post_type;
            $taxonomies = get_object_taxonomies($post_type);
            if(!empty($taxonomies))
            {
                if($taxonomies[0] == 'category') { 
                    if(!empty($terms))
                        $cat_id = $terms[0]->term_id;
                    else
                        $cat_id = 0;
                }
                elseif($taxonomies[0] == 'group')
                {
                    $terms = wp_get_post_terms($post->ID,'group');
                    if(!empty($terms))
                        $cat_id = $terms[0]->term_id;
                    else
                        $cat_id = 0;
                }
                elseif($taxonomies[0] == 'services')
                {
                    $terms = wp_get_post_terms($post->ID,'services');
                    if(!empty($terms))
                        $cat_id = $terms[0]->term_id;
                    else
                        $cat_id = 0;
                }
                elseif($taxonomies[0] == 'jobs')
                {
                    $terms = wp_get_post_terms($post->ID,'jobs');
                    if(!empty($terms))
                        $cat_id = $terms[0]->term_id;
                    else
                        $cat_id = 0;
                }
            }
            if(!tfuse_page_options('content_ads_post'))
            {  
                if (tfuse_page_options('hook_space')=='true')
                {
                    if(tfuse_page_options('hook_space')&&!tfuse_page_options('hook_image')&&!tfuse_page_options('hook_adsense')){
                        echo '
                            <!-- adv: 468x60 center -->
                            <div class="adv_content">
                                            <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                    </div>
                            <!--/ adv: 468x60 center -->';
                    }
                    elseif(tfuse_page_options('hook_adsense')&&!tfuse_page_options('hook_image')||tfuse_page_options('hook_adsense')&&tfuse_page_options('hook_image'))
                    {
                        echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_page_options('hook_adsense').'</div></div><!--/ adv: 468x60 center -->';
                    }
                    elseif(tfuse_page_options('hook_image')&&!tfuse_page_options('hook_adsense'))
                    {
                        echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                <div class="adv_468"><a href="'.tfuse_page_options('hook_url').'"  target="_blank"><img src="'.tfuse_page_options('hook_image').'" width="460" height="60" alt="advert"></a></div>
                        </div>
                        <!--/ adv: 468x60 center -->
                        ';
                    }
                    else
                    {
                        echo '';
                    }
                }
            }
            elseif(tfuse_page_options('content_ads_post') && tfuse_options('hook_space',null,$cat_id))
            {  
                if(tfuse_options('hook_space',null,$cat_id)&&!tfuse_options('hook_image',null,$cat_id)&&!tfuse_options('hook_adsense',null,$cat_id)){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense',null,$cat_id)&&!tfuse_options('hook_image',null,$cat_id)||tfuse_options('hook_adsense',null,$cat_id)&&tfuse_options('hook_image',null,$cat_id))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense',null,$cat_id).'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image',null,$cat_id)&&!tfuse_options('hook_adsense',null,$cat_id))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url',null,$cat_id).'"  target="_blank"><img src="'.tfuse_options('hook_image',null,$cat_id).'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('hook_space',null,$cat_id) && !tfuse_options('content_ads_space',true))
            {  
                if(!tfuse_options('content_ads_space')&&!tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense_admin')&&!tfuse_options('hook_image_admin')||tfuse_options('hook_adsense_admin')&&tfuse_options('hook_image_admin'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense_admin').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url_admin').'"  target="_blank"><img src="'.tfuse_options('hook_image_admin').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_category())
        {
            $id = get_query_var('cat');
            if (tfuse_options('hook_space',null,$id))
            {
                if(tfuse_options('hook_space',null,$id)&&!tfuse_options('hook_image',null,$id)&&!tfuse_options('hook_adsense',null,$id)){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense',null,$id)&&!tfuse_options('hook_image',null,$id)||tfuse_options('hook_adsense',null,$id)&&tfuse_options('hook_image',null,$id))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense',null,$id).'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image',null,$id)&&!tfuse_options('hook_adsense',null,$id))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url',null,$id).'"  target="_blank"><img src="'.tfuse_options('hook_image',null,$id).'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('hook_space',null,$id) && !tfuse_options('content_ads_space',true))
            {
                if(!tfuse_options('content_ads_space')&&!tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense_admin')&&!tfuse_options('hook_image_admin')||tfuse_options('hook_adsense_admin')&&tfuse_options('hook_image_admin'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense_admin').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url_admin').'"  target="_blank"><img src="'.tfuse_options('hook_image_admin').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_tax())
        {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy') );
            $id = $term->term_id;
            if (tfuse_options('hook_space',null,$id))
            {
                if(tfuse_options('hook_space',null,$id)&&!tfuse_options('hook_image',null,$id)&&!tfuse_options('hook_adsense',null,$id)){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense',null,$id)&&!tfuse_options('hook_image',null,$id)||tfuse_options('hook_adsense',null,$id)&&tfuse_options('hook_image',null,$id))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense',null,$id).'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image',null,$id)&&!tfuse_options('hook_adsense',null,$id))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url',null,$id).'"  target="_blank"><img src="'.tfuse_options('hook_image',null,$id).'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('hook_space',null,$id) && !tfuse_options('content_ads_space',true))
            {
                if(!tfuse_options('content_ads_space')&&!tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense_admin')&&!tfuse_options('hook_image_admin')||tfuse_options('hook_adsense_admin')&&tfuse_options('hook_image_admin'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense_admin').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url_admin').'"  target="_blank"><img src="'.tfuse_options('hook_image_admin').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
    }
endif;

//before content 125x125 ads from frame
if (!function_exists('tfuse_bfc_ads_admin')) :
function tfuse_bfc_ads_admin()
{
    if(!tfuse_options('bfc_ads_space'))
    {
        if(tfuse_options('bfcontent_number') == 'one' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1');
            if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!tfuse_options('bfcontent_ads_adsense1')){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif(tfuse_options('bfcontent_ads_adsense1'))
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.tfuse_options('bfcontent_ads_adsense1').'</div>
                </div>';
            }
            elseif($adds1)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number') == 'two' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1');
            $adds2 = tfuse_options('bfcontent_ads_image2');
            $adsense1 = tfuse_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_options('bfcontent_ads_adsense2');
            if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 )
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number') == 'three' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1');
            $adds2 = tfuse_options('bfcontent_ads_image2');
            $adds3 = tfuse_options('bfcontent_ads_image3');
            $adsense1 = tfuse_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_options('bfcontent_ads_adsense2');
            $adsense3 = tfuse_options('bfcontent_ads_adsense3');
            if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 )
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 )
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number') == 'four' )
        {   
            $adds1 = tfuse_options('bfcontent_ads_image1');
            $adds2 = tfuse_options('bfcontent_ads_image2');
            $adds3 = tfuse_options('bfcontent_ads_image3');
            $adds4 = tfuse_options('bfcontent_ads_image4');
            $adsense1 = tfuse_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_options('bfcontent_ads_adsense2');
            $adsense3 = tfuse_options('bfcontent_ads_adsense3');
            $adsense4 = tfuse_options('bfcontent_ads_adsense4');
            if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4')&&!tfuse_page_options('bfcontent_ads_adsense4')){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number') == 'five' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1');
            $adds2 = tfuse_options('bfcontent_ads_image2');
            $adds3 = tfuse_options('bfcontent_ads_image3');
            $adds4 = tfuse_options('bfcontent_ads_image4');
            $adds5 = tfuse_options('bfcontent_ads_image5');
            $adsense1 = tfuse_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_options('bfcontent_ads_adsense2');
            $adsense3 = tfuse_options('bfcontent_ads_adsense3');
            $adsense4 = tfuse_options('bfcontent_ads_adsense4');
            $adsense5 = tfuse_options('bfcontent_ads_adsense5');
            if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number') == 'six' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1');
            $adds2 = tfuse_options('bfcontent_ads_image2');
            $adds3 = tfuse_options('bfcontent_ads_image3');
            $adds4 = tfuse_options('bfcontent_ads_image4');
            $adds5 = tfuse_options('bfcontent_ads_image5');
            $adds6 = tfuse_options('bfcontent_ads_image6');
            $adsense1 = tfuse_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_options('bfcontent_ads_adsense2');
            $adsense3 = tfuse_options('bfcontent_ads_adsense3');
            $adsense4 = tfuse_options('bfcontent_ads_adsense4');
            $adsense5 = tfuse_options('bfcontent_ads_adsense5');
            $adsense6 = tfuse_options('bfcontent_ads_adsense6');
            if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                echo  '
                    <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                            </div>
                    <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                <div class="adv_125">'.$adsense6.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number') == 'seven' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1');
            $adds2 = tfuse_options('bfcontent_ads_image2');
            $adds3 = tfuse_options('bfcontent_ads_image3');
            $adds4 = tfuse_options('bfcontent_ads_image4');
            $adds5 = tfuse_options('bfcontent_ads_image5');
            $adds6 = tfuse_options('bfcontent_ads_image6');
            $adds7 = tfuse_options('bfcontent_ads_image7');
            $adsense1 = tfuse_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_options('bfcontent_ads_adsense2');
            $adsense3 = tfuse_options('bfcontent_ads_adsense3');
            $adsense4 = tfuse_options('bfcontent_ads_adsense4');
            $adsense5 = tfuse_options('bfcontent_ads_adsense5');
            $adsense6 = tfuse_options('bfcontent_ads_adsense6');
            $adsense7 = tfuse_options('bfcontent_ads_adsense7');
            if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                echo  '
                    <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                            </div>
                    <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                <div class="adv_125">'.$adsense6.'</div>
                <div class="adv_125">'.$adsense7.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url7').'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
    }
}
endif;

//before content 125x125 ads from category
if (!function_exists('tfuse_bfc_ads_cat')) :
function tfuse_bfc_ads_cat($cat_id)
{
    if(tfuse_options('bfcontent_ads_space',null,$cat_id))
    {
        if(tfuse_options('bfcontent_number',null,$cat_id) == 'one' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
            if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!tfuse_options('bfcontent_ads_adsense1',null,$cat_id)){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif(tfuse_options('bfcontent_ads_adsense1',null,$cat_id))
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.tfuse_options('bfcontent_ads_adsense1',null,$cat_id).'</div>
                </div>';
            }
            elseif($adds1)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number',null,$cat_id) == 'two' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
            $adds2 = tfuse_options('bfcontent_ads_image2',null,$cat_id);
            $adsense1 = tfuse_options('bfcontent_ads_adsense1',null,$cat_id);
            $adsense2 = tfuse_options('bfcontent_ads_adsense2',null,$cat_id);
            if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 )
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2',null,$cat_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number',null,$cat_id) == 'three' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
            $adds2 = tfuse_options('bfcontent_ads_image2',null,$cat_id);
            $adds3 = tfuse_options('bfcontent_ads_image3',null,$cat_id);
            $adsense1 = tfuse_options('bfcontent_ads_adsense1',null,$cat_id);
            $adsense2 = tfuse_options('bfcontent_ads_adsense2',null,$cat_id);
            $adsense3 = tfuse_options('bfcontent_ads_adsense3',null,$cat_id);
            if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 )
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 )
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2',null,$cat_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3',null,$cat_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number',null,$cat_id) == 'four' )
        {   
            $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
            $adds2 = tfuse_options('bfcontent_ads_image2',null,$cat_id);
            $adds3 = tfuse_options('bfcontent_ads_image3',null,$cat_id);
            $adds4 = tfuse_options('bfcontent_ads_image4',null,$cat_id);
            $adsense1 = tfuse_options('bfcontent_ads_adsense1',null,$cat_id);
            $adsense2 = tfuse_options('bfcontent_ads_adsense2',null,$cat_id);
            $adsense3 = tfuse_options('bfcontent_ads_adsense3',null,$cat_id);
            $adsense4 = tfuse_options('bfcontent_ads_adsense4',null,$cat_id);
            if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4')&&!tfuse_page_options('bfcontent_ads_adsense4')){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2',null,$cat_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3',null,$cat_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4',null,$cat_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number',null,$cat_id) == 'five' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
            $adds2 = tfuse_options('bfcontent_ads_image2',null,$cat_id);
            $adds3 = tfuse_options('bfcontent_ads_image3',null,$cat_id);
            $adds4 = tfuse_options('bfcontent_ads_image4',null,$cat_id);
            $adds5 = tfuse_options('bfcontent_ads_image5',null,$cat_id);
            $adsense1 = tfuse_options('bfcontent_ads_adsense1',null,$cat_id);
            $adsense2 = tfuse_options('bfcontent_ads_adsense2',null,$cat_id);
            $adsense3 = tfuse_options('bfcontent_ads_adsense3',null,$cat_id);
            $adsense4 = tfuse_options('bfcontent_ads_adsense4',null,$cat_id);
            $adsense5 = tfuse_options('bfcontent_ads_adsense5',null,$cat_id);
            if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2',null,$cat_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3',null,$cat_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4',null,$cat_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url5',null,$cat_id).'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number',null,$cat_id) == 'six' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
            $adds2 = tfuse_options('bfcontent_ads_image2',null,$cat_id);
            $adds3 = tfuse_options('bfcontent_ads_image3',null,$cat_id);
            $adds4 = tfuse_options('bfcontent_ads_image4',null,$cat_id);
            $adds5 = tfuse_options('bfcontent_ads_image5',null,$cat_id);
            $adds6 = tfuse_options('bfcontent_ads_image6',null,$cat_id);
            $adsense1 = tfuse_options('bfcontent_ads_adsense1',null,$cat_id);
            $adsense2 = tfuse_options('bfcontent_ads_adsense2',null,$cat_id);
            $adsense3 = tfuse_options('bfcontent_ads_adsense3',null,$cat_id);
            $adsense4 = tfuse_options('bfcontent_ads_adsense4',null,$cat_id);
            $adsense5 = tfuse_options('bfcontent_ads_adsense5',null,$cat_id);
            $adsense6 = tfuse_options('bfcontent_ads_adsense6',null,$cat_id);
            if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                echo  '
                    <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                            </div>
                    <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                <div class="adv_125">'.$adsense6.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2',null,$cat_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3',null,$cat_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4',null,$cat_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url5',null,$cat_id).'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url6',null,$cat_id).'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number',null,$cat_id) == 'seven' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
            $adds2 = tfuse_options('bfcontent_ads_image2',null,$cat_id);
            $adds3 = tfuse_options('bfcontent_ads_image3',null,$cat_id);
            $adds4 = tfuse_options('bfcontent_ads_image4',null,$cat_id);
            $adds5 = tfuse_options('bfcontent_ads_image5',null,$cat_id);
            $adds6 = tfuse_options('bfcontent_ads_image6',null,$cat_id);
            $adds7 = tfuse_options('bfcontent_ads_image7',null,$cat_id);
            $adsense1 = tfuse_options('bfcontent_ads_adsense1',null,$cat_id);
            $adsense2 = tfuse_options('bfcontent_ads_adsense2',null,$cat_id);
            $adsense3 = tfuse_options('bfcontent_ads_adsense3',null,$cat_id);
            $adsense4 = tfuse_options('bfcontent_ads_adsense4',null,$cat_id);
            $adsense5 = tfuse_options('bfcontent_ads_adsense5',null,$cat_id);
            $adsense6 = tfuse_options('bfcontent_ads_adsense6',null,$cat_id);
            $adsense7 = tfuse_options('bfcontent_ads_adsense7',null,$cat_id);
            if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                echo  '
                    <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                            </div>
                    <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                <div class="adv_125">'.$adsense6.'</div>
                <div class="adv_125">'.$adsense7.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2',null,$cat_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3',null,$cat_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4',null,$cat_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url5',null,$cat_id).'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url6',null,$cat_id).'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url7',null,$cat_id).'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
    }
}
endif;

//before content 125x125 ads in post
if (!function_exists('tfuse_bfc_ads_post')) :
function tfuse_bfc_ads_post()
{
    if(tfuse_page_options('bfcontent_ads_space'))
    {
        if(tfuse_page_options('bfcontent_number') == 'one' )
        {
            $adds1 = tfuse_page_options('bfcontent_ads_image1');
            if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!tfuse_page_options('bfcontent_ads_adsense1')){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif(tfuse_page_options('bfcontent_ads_adsense1'))
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.tfuse_page_options('bfcontent_ads_adsense1').'</div>
                </div>';
            }
            elseif($adds1)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_page_options('bfcontent_number') == 'two' )
        {
            $adds1 = tfuse_page_options('bfcontent_ads_image1');
            $adds2 = tfuse_page_options('bfcontent_ads_image2');
            $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
            if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 )
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_page_options('bfcontent_number') == 'three' )
        {
            $adds1 = tfuse_page_options('bfcontent_ads_image1');
            $adds2 = tfuse_page_options('bfcontent_ads_image2');
            $adds3 = tfuse_page_options('bfcontent_ads_image3');
            $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
            $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
            if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 )
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 )
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_page_options('bfcontent_number') == 'four' )
        {   
            $adds1 = tfuse_page_options('bfcontent_ads_image1');
            $adds2 = tfuse_page_options('bfcontent_ads_image2');
            $adds3 = tfuse_page_options('bfcontent_ads_image3');
            $adds4 = tfuse_page_options('bfcontent_ads_image4');
            $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
            $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
            $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
            if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4')&&!tfuse_page_options('bfcontent_ads_adsense4')){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_page_options('bfcontent_number') == 'five' )
        {
            $adds1 = tfuse_page_options('bfcontent_ads_image1');
            $adds2 = tfuse_page_options('bfcontent_ads_image2');
            $adds3 = tfuse_page_options('bfcontent_ads_image3');
            $adds4 = tfuse_page_options('bfcontent_ads_image4');
            $adds5 = tfuse_page_options('bfcontent_ads_image5');
            $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
            $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
            $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
            $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
            if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_page_options('bfcontent_number') == 'six' )
        {
            $adds1 = tfuse_page_options('bfcontent_ads_image1');
            $adds2 = tfuse_page_options('bfcontent_ads_image2');
            $adds3 = tfuse_page_options('bfcontent_ads_image3');
            $adds4 = tfuse_page_options('bfcontent_ads_image4');
            $adds5 = tfuse_page_options('bfcontent_ads_image5');
            $adds6 = tfuse_page_options('bfcontent_ads_image6');
            $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
            $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
            $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
            $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
            $adsense6 = tfuse_page_options('bfcontent_ads_adsense6');
            if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                echo  '
                    <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                            </div>
                    <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                <div class="adv_125">'.$adsense6.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_page_options('bfcontent_number') == 'seven' )
        {
            $adds1 = tfuse_page_options('bfcontent_ads_image1');
            $adds2 = tfuse_page_options('bfcontent_ads_image2');
            $adds3 = tfuse_page_options('bfcontent_ads_image3');
            $adds4 = tfuse_page_options('bfcontent_ads_image4');
            $adds5 = tfuse_page_options('bfcontent_ads_image5');
            $adds6 = tfuse_page_options('bfcontent_ads_image6');
            $adds7 = tfuse_page_options('bfcontent_ads_image7');
            $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
            $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
            $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
            $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
            $adsense6 = tfuse_page_options('bfcontent_ads_adsense6');
            $adsense7 = tfuse_page_options('bfcontent_ads_adsense7');
            if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                echo  '
                    <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                            </div>
                    <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                <div class="adv_125">'.$adsense6.'</div>
                <div class="adv_125">'.$adsense7.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url7').'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
    }
}
endif;

//header title for page 404 ,search ...
if (!function_exists('tfuse_header_title')) :	
    function tfuse_header_title() {
    
    $cond = (is_tag() || is_author() || is_search() || is_404() || (is_archive() and !is_category() and !is_tax() and !is_tag() and !is_author()));
    
    if($cond):?> 
    <!-- featured posts/projects -->
        <div class="top-featured">
            <div class="top-featured-inner">
                <?php
                    if (is_tag()) { echo '<h1>' .__( 'Tag Archives: ', 'tfuse' ),single_tag_title( '', true).'</h1>';}
                    if (is_author()) {echo '<h1>' .__('Archive by Author','tfuse');}
                    if (is_search()) {echo '<h1>' .__( 'Search results for: ', 'tfuse' ).'"',get_search_query().'"'.'</h1>';}
                    if (is_404()) {echo '<h1>' .__( '404 Error', 'tfuse' ).'</h1>';}
                    if (is_archive() and !is_category() and !is_tax() and !is_tag() and !is_author()) {echo '<h1>' .__( 'Archive | ', 'tfuse' ), the_time('F, Y').'</h1>';}
                ?>          
            </div>
        </div>
    <!--/ featured posts/projects -->
    <?php endif;
    }
endif;



function tfuse_curPageURL() {
 $pageURL = 'http';
  
 if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

//get number of posts
if (!function_exists('tfuse_number_of_posts')) :
    function tfuse_number_of_posts() {
        $id = get_query_var('cat');
        $current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );
        $query = new WP_Query( array('cat'=>$id,'paged' => $current));
        $posts  = $query->get_posts();
        return count($posts); 
    }
endif;


//get any type
if (!function_exists('tfuse_any_type')) :
    function tfuse_any_type() {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
        $query = new WP_Query( array('paged' =>$paged, 'post_type' =>  'any'));
        $posts  = $query->get_posts(); 
        return count($posts); 
    }
endif;
//get number of posts
if (!function_exists('tfuse_number_posts')) :
    function tfuse_number_posts() {
        $id = get_query_var('cat');
        $query = new WP_Query( array('cat'=>$id,'posts_per_page' =>'-1'));
        $posts  = $query->get_posts();
        echo count($posts); 
    }
endif;

if (!function_exists('tfuse_share_post')) :
    function tfuse_share_post() { ?>
        <a class="link-share alignleft margin-top-15 st_sharethis_custom" displayText="Your Text"><?php _e('Share','tfuse');?></a>
        
        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
        <script type="text/javascript">
            stLight.options({
                    publisher:'12345'
            });
        </script>
<?php }
endif;

//get work posts
if (!function_exists('tfuse_work_posts')) :
    function tfuse_work_posts() {
        $args = array(
                'paged' => get_query_var( 'paged' ),
                'post_type' => 'work'
              );
        $query = new WP_Query($args);
        $posts  = $query->get_posts(); 
        $count = count($posts);
        return $count;
    }
endif;


//get work posts
if (!function_exists('tfuse_work_all')) :
    function tfuse_work_all() {
        $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
        $args = array(
	'tax_query' => array(
		array(
			'taxonomy' => 'group',
			'field' => 'slug',
			'terms' => $term->slug
                        )
                )
        );
        $query = new WP_Query($args);
        $posts  = $query->get_posts(); 
        $count = count($posts);
        return $count;
    }
endif;

if ( !function_exists('tfuse_show_filter')):
function tfuse_show_filter(){
    global $TFUSE;
    $filter =  $TFUSE->request->isset_GET('posts') ? $TFUSE->request->GET('posts') : "";
    if($filter == 'all' || $filter == 'freebie')
    {
        $args = array( 'taxonomy' => 'group' );
        $terms = get_terms('group', $args);
    }
    else
    {
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy') );
        $group = $term->taxonomy;
        $term_id = $term->term_id;
        $template_slug= $term->slug;
        $template_parent= $term->parent;
        $args = array( 'taxonomy' => $group );
        $terms = get_terms($group, $args);
        if($template_parent==0) $template_parent = $term_id;
    }
        $count = count($terms);
        $i=0;
        if ($count > 0)
        {
            foreach ($terms as $term)
            { 
                $slug = $term->slug; break;
            }
            
            $term_freebie = $term_all =$all ='';$term_list_view_all ='';
            
            
            if($filter == 'all')
            { 
                $term_all .= '<li class="selected"><a  href="'.get_bloginfo('url').'/?post_type=work&posts=all">'.__('All','tfuse').'</a></li>';
            }
            elseif($filter != 'all')
            {
                $term_all .='<li><a href="'.get_bloginfo('url').'/?post_type=work&posts=all">'.__('All','tfuse').'</a></li>';
            }
            if($filter == 'all' || $filter == 'freebie')
            {
                foreach ($terms as $term)
                { 
                    $i++;


                    if($term->parent == 0)
                    {
                        $term_list_view_all .= '<li><a href="'.get_bloginfo('url').'/?group=' .$term->slug. '">'.$term->name.'</a></li>';
                    }
                }
            }
            else
            {
                foreach ($terms as $term)
                { 
                    $i++;


                    if($term->parent == 0)
                    {
                        if($term->slug==$template_slug && $filter != 'freebie' && $filter != 'all')
                        {
                            $term_list_view_all .= '<li class="selected"><a  href="'.get_bloginfo('url').'/?group=' .$term->slug.  '">'.$term->name.'</a></li>';
                        }
                        elseif($template_parent==$term->term_id && $filter == 'freebie'  && $filter == 'all')
                        {
                            $term_list_view_all .= '<li><a href="'.get_bloginfo('url').'/?group=' .$term->slug. '">'.$term->name.'</a></li>';
                        }
                        else 
                        {
                            $term_list_view_all .= '<li><a href="'.get_bloginfo('url').'/?group=' .$term->slug. '">'.$term->name.'</a></li>';
                        }
                    }
                }
            }
            $the_query = tfuse_extract_freebie();
            if(!empty($the_query))
                $item = count($the_query->get_posts());
            else
                $item = '';
            if(!empty($item))
            {
                if($filter  == 'freebie')
                { 
                    $term_freebie .= '<li class="selected"><a  href="'.get_bloginfo('url').'/?post_type=work&posts=freebie">'.__('Freebies','tfuse').'</a></li>';
                }
                elseif($filter != 'freebie')
                {
                    $term_freebie .='<li><a href="'.get_bloginfo('url').'/?post_type=work&posts=freebie">'.__('Freebies','tfuse').'</a></li>';
                }
            }
            else
            {
            }
           echo $term_all.$term_list_view_all.$term_freebie;
        }

}
endif;

//next prev pgination
if (!function_exists('tfuse_single_work_pagination')) :
    function tfuse_single_work_pagination() {
        $template_directory = get_template_directory_uri();?>
        <div class="widget-pagination space">
                <?php next_post_link('%link','<span class="border-nav"><img src="'.$template_directory.'/images/arrow-nav-left.png"></span>', false); ?>
				<a href="<?php tfuse_tax_link();?>"><span><img src="<?php echo $template_directory;?>/images/block.png" class="categ_link"></span></a>
                <?php previous_post_link('%link','<span class="border-nav"><img src="'.$template_directory.'/images/arrow-nav-right.png"></span>', false); ?>
            <div class="clear"></div>
        </div>
<?php }
endif;

//show career title
if (!function_exists('tfuse_career_title')) :	
    function tfuse_career_title() {
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy') );
        $title = tfuse_options('career_title',null,$term->term_id);
        if(empty($title))
        {
            return;
        }
        else
        { ?>
            <div class="title">
                <h1><?php echo $title;?></h1>	    
            </div>
            <div class="divider"></div>
 <?php  }
    }
endif;


//show title
if (!function_exists('tfuse_title_slide')) :	
    function tfuse_title_slide() {
        global $is_tf_blog_page,$header_title_slide,$header_title1,$post;
        if(is_front_page())
        {
            $page_id = $post->ID;
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page')
            {
                $header_element = tfuse_page_options('header_element','',$page_id);
                if($page_id != 0 && tfuse_page_options('header_element','',$page_id)=='slider')
                {
                     $header_title_slide['header_title_slider'] = tfuse_page_options('header_title_slider','',$page_id);
                        if(!empty($header_title_slide['header_title_slider']))
                        {
                            locate_template('header-title-slide.php', true, false);
                        }
                }
                elseif ( $page_id != 0 && tfuse_page_options('header_element','',$page_id)=='title1')
                { 
                    $header_title1['title'] = tfuse_page_options('header_title1','',$page_id);
                        if(!empty($header_title1['title']))
                        { 
                            locate_template('header-title1.php', true, false);
                        }
                }
            }
            else
            {
                $header_element = tfuse_options('header_element'); 
                if ( 'slider' == $header_element )
                {
                    $header_title_slide['header_title_slider'] = tfuse_options('header_title_slider');
                        if(!empty($header_title_slide['header_title_slider']))
                        {
                            locate_template('header-title-slide.php', true, false);
                        }
                }
                elseif ( 'title1' == $header_element )
                { 
                    $header_title1['title'] = tfuse_options('header_title1');
                        if(!empty($header_title1['title']))
                        { 
                            locate_template('header-title1.php', true, false);
                        }
                }
            }
        }
        elseif($is_tf_blog_page)
        {
            $header_element = tfuse_options('header_element_blog'); 
                if ( 'slider' == $header_element )
                {
                    $header_title_slide['header_title_slider'] = tfuse_options('header_title_slider_blog');
                        if(!empty($header_title_slide['header_title_slider']))
                        {
                            locate_template('header-title-slide.php', true, false);
                        }
                }
                elseif ( 'title1' == $header_element )
                { 
                    $header_title1['title'] = tfuse_options('header_title1_blog');
                        if(!empty($header_title1['title']))
                        { 
                            locate_template('header-title1.php', true, false);
                        }
                }
        }
        elseif ( is_singular() )
        { 
            $header_element = tfuse_page_options('header_element'); 
            if ( 'slider' == $header_element )
            {
                $header_title_slide['header_title_slider'] = tfuse_page_options('header_title_slider');
                    if(!empty($header_title_slide['header_title_slider']))
                    {
                        locate_template('header-title-slide.php', true, false);
                    }
            }
            elseif ( 'title1' == $header_element )
            { 
                $header_title1['title'] = tfuse_page_options('header_title1');
                    if(!empty($header_title1['title']))
                    { 
                        locate_template('header-title1.php', true, false);
                    }
            }
        }
        elseif ( is_category() )
        {
            $ID = get_query_var('cat');
            $header_element = tfuse_options('header_element', null, $ID);
            if ( 'slider' == $header_element )
            {
                $header_title_slide['header_title_slider'] = tfuse_options('header_title_slider', null, $ID);
                    if(!empty($header_title_slide['header_title_slider']))
                    {
                        locate_template('header-title-slide.php', true, false);
                    }
            }
            elseif ( 'title1' == $header_element )
            { 
                $header_title1['title'] = tfuse_options('header_title1', null, $ID);
                    if(!empty($header_title1['title']))
                    { 
                        locate_template('header-title1.php', true, false);
                    }
            }
        }
        elseif ( is_tax() )
        {
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    $ID = $term->term_id;
            $header_element = tfuse_options('header_element', null, $ID);
            if ( 'slider' == $header_element )
            {
                $header_title_slide['header_title_slider'] = tfuse_options('header_title_slider', null, $ID);
                    if(!empty($header_title_slide['header_title_slider']))
                    {
                        locate_template('header-title-slide.php', true, false);
                    }
            }
            elseif ( 'title1' == $header_element )
            { 
                $header_title1['title'] = tfuse_options('header_title1', null, $ID);
                    if(!empty($header_title1['title']))
                    { 
                        locate_template('header-title1.php', true, false);
                    }
            }
        }
    }
endif;

//show title
if (!function_exists('tfuse_exist_header')) :	
    function tfuse_exist_header() {
        global $is_tf_blog_page,$is_tf_front_page,$post;
        if($is_tf_front_page)
        {
            $page_id = $post->ID;
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page')
            {   
                $header_element = tfuse_page_options('header_element','',$page_id);
                if ( $page_id != 0 && tfuse_page_options('header_element','',$page_id) == 'without' )
                {
                    return true;
                }
            }
            else
            {
                $header_element = tfuse_options('header_element');
                if ( 'without' == $header_element )
                {
                    return true;
                }
            }
        }
        elseif($is_tf_blog_page)
        { 
            $header_element = tfuse_options('header_element_blog'); 
                if ( 'without' == $header_element )
                {
                    return true;
                }
        }
        elseif ( is_singular() )
        { 
            $header_element = tfuse_page_options('header_element');
            if ( 'without' == $header_element )
            {
                return true;
            }

        }
        elseif ( is_category() )
        { 
            $ID = get_query_var('cat');
            $header_element = tfuse_options('header_element', null, $ID);
            if ( 'without' == $header_element )
            {
                return true;
            }
        }
        elseif ( is_tax() )
        {
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    $ID = $term->term_id;
            $header_element = tfuse_options('header_element', null, $ID);
            if ( 'without' == $header_element )
            {
                return true;
            }
        }
        else
            return false;
    }
endif;

//show title corner
if (!function_exists('tfuse_show_corner')) :	
    function tfuse_show_corner() {
        global $is_tf_blog_page,$post;
        if(is_front_page())
        {
            $page_id = $post->ID;
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page')
            {   
                $header_element = tfuse_page_options('header_element','',$page_id);
                if ( $page_id != 0 && tfuse_page_options('header_element','',$page_id) == 'title2' )
                {
                     $menu = tfuse_page_options('menu_header','',$page_id);
                }
            }
            else
            {
                $header_element = tfuse_options('header_element');
                if ( 'title2' == $header_element )
                {
                     $menu = tfuse_options('menu_header');
                }
            }
        }
        elseif($is_tf_blog_page)
        {
            $header_element = tfuse_options('header_element_blog');
                if ( 'title2' == $header_element )
                {
                     $menu = tfuse_options('menu_header_blog');
                }
        }
        elseif ( is_singular() )
        {
            $header_element = tfuse_page_options('header_element');
            if ( 'title2' == $header_element )
            {
                 $menu = tfuse_page_options('menu_header');
            }

        }
        elseif ( is_category() )
        {
            $ID = get_query_var('cat');
            $header_element = tfuse_options('header_element', null, $ID);
            if ( 'title2' == $header_element )
            {
               $menu = tfuse_options('menu_header', null, $ID); 
            }
        }
        elseif ( is_tax() )
        {
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $ID = $term->term_id;
            $header_element = tfuse_options('header_element', null, $ID);
            if ( 'title2' == $header_element )
            {
                $menu = tfuse_options('menu_header', null, $ID); 
            }
        }
        
            return $menu;
    }
endif;


//show title corner
if (!function_exists('tfuse_header_box')) :	
    function tfuse_header_box() {
        
        $check1 = tfuse_options('header_box_frame');
        $title1 = tfuse_options('box_title_frame');
        $type1 = tfuse_options('box_type_frame');
        $url1 = tfuse_options('box_url_frame');
        if($type1 == 'white'){ $color_frame = 'box_white'; $color2_frame = 'text-gray'; }
        else {$color_frame = 'box_orange';$color2_frame = 'text-white';}
        
            if(!empty($title1) && !$check1)
            {
                echo '<a href="'.$url1.'">
                        <div class="header-box '.$color_frame.'">
                            <h2 class="'.$color2_frame.'  text-extrabold">'.$title1.'</h2>
                        </div>
                     </a>';
            }
            else echo '';
        
    }
endif;


//show breadcrumbs
if (!function_exists('tfuse_show_breadcrumb')) :	
    function tfuse_show_breadcrumb() { ?>
        <div class="black-background">
            <div class="container">
                <div class="header-title box_orange">
                     <div class="header-title-content text-left ">
                         <h1 class="text-white"><?php echo tfuse_breadcrumbs(); ?></h1>
                     </div>
                 </div>
            </div>
        </div>
  <?php }
endif;

if (!function_exists('tfuse_shorten_string')) :
    /**
     *
     *
     * To override tfuse_shorten_string() in a child theme, add your own tfuse_shorten_string()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

function tfuse_shorten_string($string, $wordsreturned)

{
    $retval = $string;

    $array = explode(" ", $string);
    if (count($array)<=$wordsreturned)

    {
        $retval = $string;
    }
    else

    {
        array_splice($array, $wordsreturned);
        $retval = implode(" ", $array)." ...";
    }
    return $retval;
}

endif;

//show element
if (!function_exists('tfuse_show_service_value')) :	
    function tfuse_show_service_value() { 
        global $is_tf_blog_page,$is_tf_front_page;
        if($is_tf_front_page)
        {
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page'){
                $element = tfuse_page_options('last_services');
            }
            else $element = tfuse_options('last_services');
        }
        elseif($is_tf_blog_page)
        {
            $element = tfuse_options('last_services_blog');
        }
        elseif(is_author() ||((is_archive() && !is_tax() && !is_category()) || is_tag() ))
        {
            $element = 'none';
        }
        elseif ( is_singular() )
        {
            $element = tfuse_page_options('last_services');
        }
        elseif ( is_category() )
        {
            $ID = get_query_var('cat');
            $element = tfuse_options('last_services', null, $ID);
        }
        elseif ( is_tax() )
        {
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $ID = $term->term_id;
            $element = tfuse_options('last_services', null, $ID);
        }
        else
            $element = 'none';
        
        return $element;
    }
endif;

if (!function_exists('tfuse_set_js_comment_data')) :
    function tfuse_set_js_comment_data() {
            if(!is_singular()) return null;
            global $TFUSE, $wp_query;
            $comments_data = array(
                'post_id'   => $wp_query->queried_object->ID,
                'per_page'  => get_option('comments_per_page'),
                'default_page'  => get_option('default_comments_page'),
                'order'  => get_option('comment_order'),
            );
            $TFUSE->include->js_enq('comments_data', $comments_data);
          }
    add_action('wp_head','tfuse_set_js_comment_data');
endif;


//show element
if (!function_exists('tfuse_show_item_search')) :	
    function tfuse_show_item_search() { 
        global $wp_query;
        $item = tfuse_any_type(); 

        $current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );
        $max_num_pages = intval( $wp_query->max_num_pages );
        if($current == $max_num_pages)
            $item = $item -1;
        
        return $item;
    }
endif;


if(!function_exists('tfuse_add_custom_post_types_in_feed')) :

        function tfuse_add_custom_post_types_in_feed($qv) {
                if (isset($qv['feed']))
                        $qv['post_type'] = array('post', 'work' , 'service');
                return $qv;
        }
        add_filter('request', 'tfuse_add_custom_post_types_in_feed');

endif;

if (!function_exists('tfuse_set_comment_page')) :
    function tfuse_set_comment_page() {
        global $wp_query;
                $wp_query->set( 'cpage', 0 );
          }
    add_action('wp_head','tfuse_set_comment_page');
endif;

//extract freebie's posts
if (!function_exists('tfuse_extract_freebies')) :
    function tfuse_extract_freebies($order = null) {
        $posts = get_posts('post_type=work&posts_per_page=-1');  
        if(!empty($posts))
        {
            foreach ( $posts as $post ):
                $freebies[] = tfuse_page_options('as_freebies','',$post->ID);
            endforeach; 
            $i=0; $freebie = array();
            foreach ( $posts as $post ):
                if($freebies[$i] == 1){
                    $freebie[] = $post->ID;
                }
                $i++;
            endforeach; 
            if(!empty($freebie))
            {
                $args = array(
                    'order' => $order,
                    'post_type' => 'work',
                    'post__in' => $freebie
                  );
                $posts = get_posts($args);
            }
            else
            {
                    $posts = '';
            }
            return $posts;							
        }
    }
endif;

//extract work's posts
if (!function_exists('tfuse_extract_all')) :
    function tfuse_extract_all() {
             $args = array(
                'paged' => get_query_var( 'paged' ),
                'post_type' => 'work'
              );
            $the_query = new WP_Query($args);  
            return $the_query;							
    }
endif;

//extract freebie's posts
if (!function_exists('tfuse_extract_freebie')) :
    function tfuse_extract_freebie() {
        $posts = get_posts(array( 'post_type' => 'work','posts_per_page' => -1 ));
        if(!empty($posts))
        {
            foreach ( $posts as $post ):
                $freebies[] = tfuse_page_options('as_freebies','',$post->ID);
            endforeach; 
            $i=0; $freebie = array();
            foreach ( $posts as $post ):
                if($freebies[$i] == 'yes'){
                    $freebie[] = $post->ID;
                }
                $i++;
            endforeach;
			
            if(!empty($freebie))
            {
                     $args = array(
                            'paged' => get_query_var( 'paged' ),
                            'post_type' => 'work',
                            'post__in' => $freebie
                      );
                    $the_query = new WP_Query($args);
            }
            else
            {
                    $the_query = '';
            }
            return $the_query;							
        }
    }
endif;

//editor's picks
if (!function_exists('tfuse_show_freebies')) :
    function tfuse_show_freebies() {
        global $wp_query;
        $count = 0;
        $the_query = tfuse_extract_freebie();
        if(!empty($the_query))
            $item = count($the_query->get_posts());
        else
            $item = '';
        if(!empty($the_query))
        {
            while ( $the_query->have_posts() ) : $the_query->the_post(); $count++;
                    if($count%3 == 1) echo '<div class="row">'; 
                            get_template_part('listing', 'work');
                    if($count%3 == 0 || $count == $item) echo '</div><div class="clear"></div>';
            endwhile;
            $wp_query = $the_query;
        }
        else
        {?>
            <h5><?php _e('Sorry, there are no freebies.', 'tfuse'); ?></h5>
  <?php }
    }
endif;


//editor's picks
if (!function_exists('tfuse_show_all')) :
    function tfuse_show_all() {
        global $wp_query;
        $count = 0;
        $item = tfuse_work_posts();
        $the_query = tfuse_extract_all(); 
        while ( $the_query->have_posts() ) : $the_query->the_post(); $count++;
            if($count%3 == 1) echo '<div class="row">'; 
                get_template_part('listing', 'work');
            if($count%3 == 0 || $count == $item) echo '</div><div class="clear"></div>';
        endwhile;
        $wp_query = $the_query;
    }
endif;

if (!function_exists('tfuse_get_work_categories')) :

function tfuse_get_work_categories()
{
    $taxonomy = '';
    $taxonomies = get_terms('group');
    if(!empty($taxonomies))
    {
        foreach ($taxonomies as $parent) {
            if($parent->parent == 0)
            {
                $taxonomy = $parent;break;
            }
        }
    }
    return $taxonomy;
}

endif;


//extract query
if (!function_exists('tfuse_extract_query')) :
    function tfuse_extract_query() {
        global $TFUSE;
        $filter =  $TFUSE->request->isset_GET('posts') ? $TFUSE->request->GET('posts') : "";
        if( $filter == 'all')
        {
            $the_query = tfuse_extract_all();
        }
        elseif($filter == 'freebie')
        { 
            $the_query = tfuse_extract_freebie();
        }
        return $the_query;
    }
endif;


//color theme
if (!function_exists('tfuse_change_style')) :
    function tfuse_change_style() {
        $main = tfuse_options('theme_color');
        $text = tfuse_options('text_color');
        $url = get_template_directory_uri();
        if(!empty($main))
        {
            echo '<style type="text/css">
                    .text-orange {
                        color: '.$main.' !important;
                      }
                      .color.btn_pink {
                        background-color: '.$main.';
                        background-image: -webkit-linear-gradient(bottom, '.$main.', '.$main.');
                        background-image: -linear-gradient(bottom, '.$main.', '.$main.');
                        background-image: -moz-linear-gradient(bottom, '.$main.', '.$main.');
                        background-image: -o-linear-gradient(bottom, '.$main.', '.$main.');
                        }
                        .box_orange {
                            background: '.$main.' !important;
                          }
                        #topmenu .dropdown li a:hover, #topmenu .dropdown li.current-menu-item a {
                            color: '.$main.';
                            border-bottom: 3px solid '.$main.';
                          }
                          #topmenu .dropdown li ul li.first {
                            border-top: 3px solid '.$main.';
                          }
                        .middle-menu a:hover img,
                        .middle-menu .active-menu img {
                          background: '.$main.';
                        }

                        * + html .middle-menu .active-menu img {
                          background: '.$main.';
                        }
                        .middle-menu li:hover .tf-bottom-menu,
                        .middle-menu .active-menu .tf-bottom-menu {
                          background: '.$main.';
                        }
                        .work-item .work-title,
                        .services-item .services-title {
                          background: '.$main.';
                        }
                        .team-text {
                        background: '.$main.';
                      }
                      #topmenu .dropdown li ul a:hover, #topmenu .dropdown li ul li.current-menu-item a {
                        background: '.$main.';
                        }
                        
                    .tf-header-slider .flex-control-paging li a.flex-active {
                        background: '.$main.' !important;
                        }
                    .tf-header-slider .flex-control-paging li a:hover {
                        background: '.$main.' !important;
                        }
                    a:hover, a:focus {
                    color: '.$main.';
                    }
                    footer .widget-container li:hover a {
                    color:  '.$main.' !important;
                    }
                    .widget-send-feedback input[type="submit"] {
                    background: '.$main.';
                    }
                    footer ul li a:hover, .copyright a:hover {
                    color: '.$main.';
                    }
                    .team-text {
                    background: '.$main.' !important;
                    }
                    .widget-sharing li span span {
                    color: '.$main.';
                    }
                    .content .widget-testimonials .testimonial-user .name-user, .sidebar .widget-testimonials .testimonial-user .name-user {
                    color: '.$main.';
                    }
                    .bg-orange-1,.bg-orange-2,.bg-orange-3,.bg-orange-4,.bg-orange-5,.bg-orange-6 {
                    background: '.$main.';
                    }
                    .services-text a, .services-text a:visited {
                    color: '.$main.';
                    }
                    .post-meta-links a.link-comments:hover, .post-meta-links a.link-share:hover {
                    color: '.$main.' !important;
                    }
                    .author-text h4, .entry .author-text h4 {
                    color:'.$main.';
                    }
                    .author-box:hover {
                    border: 1px dashed '.$main.';
                    }
                    .sidebar .widget-container li a:hover, .content .widget-container li a:hover, .sidebar .widget-content li a:hover, .content .widget-content li a:hover {
                    color: '.$main.' !important;
                    }
                    .tabs_framed .tabs .current a, .tabs_framed .tabs .current a:hover {
                    color: '.$main.' !important;
                    }
                    .tabs_framed .tabs .current a {
                        border-top: 1px solid '.$main.';
                        }
                    .tabs_framed .tabs li a:hover {
                    color: '.$main.';
                    }
                    .tabs_framed .tabs a:hover {
                        border-top: 1px solid '.$main.';
                        }
                    .widget_categories ul li.selected a {
                    color: '.$main.';
                    }
                    .widget_tag_cloud .tagcloud a:hover, .widget_tag_cloud .tagcloud a:focus {
                    color: '.$main.';
                    }
                    .color.btn_orange {
                    background-color: '.$main.';
                    background-image: -linear-gradient(bottom, '.$main.', '.$main.');
                    background-image: -webkit-linear-gradient(bottom, '.$main.', '.$main.');
                    background-image: -moz-linear-gradient(bottom, '.$main.', '.$main.');
                    background-image: -o-linear-gradient(bottom, '.$main.', '.$main.');
                    }
                    .widget_nav_menu .current-cat a, .widget_pages .current_page_item a, .widget_meta .current-menu-item a, .widget_archive .current-menu-item a, .widget_categories .current-cat a {
                    color: '.$main.' !important;
                    }
                    .faq_question.active {
                    color: '.$main.';
                    }
                    .widget_nav_menu .current-menu-item a, .widget_pages .current-menu-item a, .widget_meta .current-menu-item a, .widget_archive .current-menu-item a, .widget_categories .current-menu-item a {
                        color: '.$main.' !important;
                        }
                    .slideshow.slideQuotes .slides_container .quote-author .name-user {
                        color: '.$main.';
                        }
                    .post_list li a:hover {
                    color: '.$main.';
                    }
                    .footer-content .f_col .widget_twitter .tweet_item .tweet_text .inner a {
                    color: '.$main.';
                    }
                    .widget_twitter .tweet_list .tweet_item a:hover, .widget_twitter .tweet_list .tweet_item a:focus {
                    color: '.$main.';
                    }
                    .widget_twitter .tweet_list .tweet_item a {
                    color: '.$main.';
                    }
                    .widget_twitter .tweet_list .tweet_item a {
                    color: '.$main.';
                    }
                    .widget_twitter .tweet_list .tweet_item a:hover, .widget_twitter .tweet_list .tweet_item a:focus {
                    color: '.$main.';
                    }
                    .tweeter.widget-container.widget_twitter .toggle_content.boxed .tweet_item .tweet_text .inner a {
                    color: '.$main.';
                    }
                    .tweeter.widget-container.widget_twitter .toggle_content.boxed .tweet_item .tweet_text .inner a:hover {
                    color: '.$main.';
                    }
                    .widget_login .forget_password a {
                    color:  '.$main.';
                    }
                    .widget_calendar table a {
                    color: '.$main.';
                    }
                    .arrow-down {
                        width: 0px;
                        height: 0px;
                        border-style: solid;
                        border-width: 16px 16px 0 0;
                        border-color: '.$main.' transparent transparent transparent;
                        line-height: 0px;
                        position: absolute;
                        bottom: -16px;
                        margin-left: 30px;
                    }
                    .arrow-top {
                        width: 0px;
                        height: 0px;
                        border-style: solid;
                        border-width: 17px 0 0 17px;
                        border-color: transparent transparent transparent '.$main.';
                        line-height: 0px;
                        position: absolute;
                        top: -17px;
                        margin-left: 15px;
                    }
                    .work-item:hover  .arrow-top ,.services-item:hover .arrow-top{
                        width: 0px;
                        height: 0px;
                        border-style: solid;
                        border-width: 17px 0 0 17px;
                        border-color: transparent transparent transparent hsl(0, 0%, 20%);
                        line-height: 0px;
                        position: absolute;
                        top: -17px;
                        margin-left: 15px;
                    }
                    .middle-menu li:hover .tf-top-menu, .middle-menu .active-menu .tf-top-menu {
                        background: '.$main.';
                        height: 21px ;
                    }
                    .middle-menu .active-menu .tf-top-menu .tf-top-menu-corner {
                        width: 0px;
                        height: 0px;
                        border-style: solid;
                        border-width: 10px 10px 0 10px;
                        border-color: '.$main.' transparent transparent transparent;
                        line-height: 0px;
                        position: absolute;
                        top: 21px;
                        margin-left:52px;
                    }
                    .middle-menu li:hover .tf-top-menu .tf-top-menu-corner {
                      width: 0px;
                        height: 0px;
                        border-style: solid;
                        border-width: 10px 10px 0 10px;
                        border-color: '.$main.' transparent transparent transparent;
                        line-height: 0px;
                        position: absolute;
                        top: 21px;
                        margin-left:52px;
                      transition: height 0.3s;
                      -webkit-transition: height 0.3s;
                      -moz-transition: height 0.3s;
                      -o-transition: height 0.3s;
                    }
                    .header-box.box_white
                    {
                        background:'.$main.'!important ;
                    }
                    </style>';
        }
        if(!empty($text))
        {
            echo '<style type="text/css">
                    .tf-header-slider .flex-control-paging li a {
                        color: '.$text.' !important;
                            }
                    .color.btn_pink {
                        color: '.$text.' !important;
                    }
                    .color.text-white {
                    color: '.$text.' !important;
                    }
                    .widget-send-feedback input[type="submit"] {
                        color: '.$text.';
                        }
                    .team-text h4, .entry .team-text h4 {
                    color: '.$text.' !important;
                    }
                    .team-text .team-contact {
                    color: '.$text.' !important;
                    }
                    .team-text p {
                    color: '.$text.' !important;
                    }
                    .team-text h5, .entry .team-text h5 {
                        color: '.$text.' !important;
                    }
                    #topmenu .dropdown li ul a:hover{
                    color: '.$text.' !important;
                    }
                    .color.btn_orange {
                    color: '.$text.' !important;
                    }
                    .post-item .post-meta-bot.work a:hover {
                    color: '.$text.' !important;
                    }
                    .header-box.box_white .text-gray
                    {
                        color:'.$text.'!important ;
                    }
                    .header-search .s.white {
                    background: '.$text.' url('.$url.'/images/search_white.png) no-repeat top right !important;
                    }
            </style>';
        }
    }
endif;

if (!function_exists('tfuse_aasort')) :
    /**
     *
     *
     * To override tfuse_aasort() in a child theme, add your own tfuse_aasort()
     * to your child theme's file.
     */
    function tfuse_aasort ($array, $key) {
        $sorter=array();
        $ret=array();
        if (!$array){$array = array();}
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii]=$va[$key];
        }
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii]=$array[$ii];
        }
        return $ret;
    }
endif;


function tfuse_set_blog_page(){
    global $wp_query,$is_tf_blog_page;
    if(isset($wp_query->queried_object->ID)) $id_post = $wp_query->queried_object->ID;
    elseif(isset($wp_query->query['page_id'])) $id_post = $wp_query->query['page_id'];
    else $id_post = 0;
    if(tfuse_options('blog_page') != 0 && $id_post == tfuse_options('blog_page')) $is_tf_blog_page = true;
}
add_action('wp_head','tfuse_set_blog_page');