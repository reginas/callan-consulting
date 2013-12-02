<?php
//Recent / Most Commented Widget

function tfuse_slide_works($atts) {
    extract(shortcode_atts(array('category' => '','items' => ''), $atts));
   
    $return_html = '';
	 $uniq = rand(1, 200);
    if(!empty($category))
    {
        $categories = explode(',',$category); 
        $main = tfuse_options('theme_color');
        foreach($categories as $category):
            $term[] = get_term_by('name', $category , 'group');
        endforeach;
        if(!empty($term[0]))
        {
            foreach($term as $terms): 
                $taxonomy[] = $terms->term_id;
            endforeach;

            $pop_posts =  tfuse_shortcode_custom_posts($taxonomy);
            $tags = '';
            $return_html .= '<div class="row">
                                <div class="col col_1_2">
                                     <div class="widget_categories">
                                        <div class="inner">
                                        <ul>';
                                            $return_html.='<li><a href="'.get_bloginfo('url').'/?post_type=work&posts=all">'.__('All','tfuse').'</a></li>';
                                            foreach($term as $terms):
                                                $link = get_term_link( $terms->slug, 'group' );
                                                $return_html .='<li><a href="'.$link.'">'.$terms->name.'</a></li>';
                                            endforeach;
                                            $the_query = tfuse_extract_freebie();
                                            if(!empty($the_query))
                                                $item = count($the_query->get_posts());
                                            else
                                                $item = '';
                                            if(!empty($item))
                                            {
                                                $return_html.='<li><a href="'.get_bloginfo('url').'/?post_type=work&posts=freebie">'.__('Freebies','tfuse').'</a></li>';
                                            }
                    $return_html .='</ul>
                                        </div>
                                    </div>
                                </div>
                           </div>
                           <div class="clear"></div>
                            <div class="row">
                                <div class="work-carousel">
                                     <div class="work-carousel-head">
                                        <a class="prev" id="work-carousel-prev'.$uniq.'" href="#"><span>prev</span></a>
                                        <a class="next" id="work-carousel-next'.$uniq.'" href="#"><span>next</span></a>
                                    </div>
                                <div class="carousel_content">
                                    <ul id="work-carousel'.$uniq.'"> ';
									$count = 0;
                foreach ($pop_posts as $posts) {
                    if($count == $items) break;
					$count++;
                    $tags = $posts['tags'];
                    $return_html .= '<li> 
                                        <a href="'.$posts['post_link'].'">
                                            <div class="work-item">
                                            <div class="work-img">'.$posts['post_img'].'</div>
                                            <div class="work-title">';
                                            if(empty($main)){ 
                                                $return_html .= '<div class="corner-orange-top"></div>';
                                            }
                                            if(!empty($main)){
                                                 $return_html .= '<div class="arrow-top"></div>';
                                            }
                            $return_html .= '<h4 class="color text-white text-bold">'.$posts['post_title'].'</h4>
                                            <p class="color text-white">';
                                                for($i=0;$i<count($tags);$i++)
                                                {
                                                    if ($i != 0) $return_html.=', ';
                                                     $return_html .= $tags[$i]->name;
                                                }
                            $return_html .= '</p>
                                            </div>
                                            </div>
                                         </a>';
                }
                    $return_html .= '</ul>
                                </div>
                           </div>
                       </div>';
        $return_html .= '<script type="text/javascript">
		 jQuery(document).ready(function($) {
				jQuery("#work-carousel'.$uniq.'").carouFredSel({
					next : "#work-carousel-next'.$uniq.'",
					prev : "#work-carousel-prev'.$uniq.'",
					auto: false,
					circular: false,
					infinite: true,	
					width: "100%",		
					scroll: {
						items : 1					
					}		
				});
			});
            </script>
            ';
        }
    }
    return $return_html;
}

$atts = array(
    'name' => 'Slide Works',
    'desc' => 'Here comes some lorem ipsum description for the box shortcode.',
    'category' => 2,
    'options' => array(
        array(
            'name' => 'Category',
            'desc' => 'Specifies the category from works to display some posts',
            'id' => 'tf_shc_slide_works_category',
            'value' => '',
            'type' => 'text'
            ),
		array(
            'name' => 'Items',
            'desc' => 'Specifies the number of posts in slide',
            'id' => 'tf_shc_slide_works_items',
            'value' => '6',
            'type' => 'text'
            )
    )
);

tf_add_shortcode('slide_works','tfuse_slide_works', $atts);
tf_add_shortcode('slide_works','tfuse_slide_works', $atts);