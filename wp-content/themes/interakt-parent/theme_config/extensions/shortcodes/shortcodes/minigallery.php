<?php

/**
 * Minigallery
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * id: post/page id
 * order: ASC, DESC
 * orderby:
 * include:
 * exclude:
 * pretty: true/false use or not prettyPhoto
 * icon_plus:
 * class: css class e.g. boxed
 * carousel: jCarousel Configuration. http://sorgalla.com/projects/jcarousel/
 */
function tfuse_minigallery($attr, $content = null)
{
    extract(shortcode_atts(array('title' => ''), $attr));
global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
            'order'      => 'ASC',
            'orderby'    => 'menu_order ID',
            'id' => isset($post->ID) ? $post->ID : $attr['id'],
            'include'    => '',
            'exclude'    => '',
            'pretty'     => true,
            'carousel'   => 'easing: "easeInOutQuint",animation: 600',
            'class'      => 'boxed',
			'prettyphoto' => '',
    ), $attr));

    if ( !empty($include) ) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace('/[^0-9,]+/', '', $exclude);
        $attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
    } else {
        $attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
    }

    if ( empty($attachments) )
        return '';

    $uniq = rand(1, 200);

    $out = '';
    $out .= '
    <div class="minigallery_carousel">';
    $out .= '<div class="minigallery_head">
            <h3>'.$title.'</h3>
            <a class="prev" id="minigallery'.$uniq.'_prev" href="#"><span>'.__('prev','tfuse').'</span></a>
            <a class="next" id="minigallery'.$uniq.'_next" href="#"><span>'.__('next','tfuse').'</span></a>
    </div>
    <div class="carousel_content">
        <ul id="minigallery'.$uniq.'">';

        foreach ($attachments as $id => $attachment)
        {

            $link = wp_get_attachment_image_src($id, 'full', true);
            $image_link_attach = $link[0];
            $imgsrc = wp_get_attachment_image_src($id, array(139, 90), false);
            $image_src = $imgsrc[0];

            $image = new TF_GET_IMAGE();
            $img = $image->width(139)->height(90)->properties(array('alt' => $attachment->post_title))->src($image_src)->get_img();

            if ($prettyphoto == 'true' )
                $out .= '<li >'. $img . '<a href="' . $image_link_attach . '" data-rel="prettyPhoto[mg' . $uniq . ']" class="mg_pretty zoom" rel="prettyPhoto[mg' . $uniq . ']">
                      </a></li>';
            else
                $out .= '<li>' . $img . '</li>';
        }

        $out .= '
            </ul>
        </div>
    </div>';
    $out .= ' <script>
            jQuery(document).ready(function($) {
                $("#minigallery'.$uniq.'").carouFredSel({
                    next : "#minigallery'.$uniq.'_next",
                    prev : "#minigallery'.$uniq.'_prev",
                    auto: false,
                    circular: false,
                    infinite: true,	
                    width: "100%",		
                    scroll: {
                            items : 1					
                    }		
                });
            });
        </script>';
    return $out;
}

$atts = array(
    'name' => 'Minigallery',
    'desc' => 'Here comes some lorem ipsum description for the box shortcode.',
    'category' => 6,
    'options' => array(
        array(
            'name' => 'ID',
            'desc' => 'Specifies the post or page ID. For more detail about this shortcode follow the <a href="http://codex.wordpress.org/Template_Tags/get_posts" target="_blank">link</a>',
            'id' => 'tf_shc_minigallery_id',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => 'Title',
            'desc' => 'Specifies the title for minigallery.',
            'id' => 'tf_shc_minigallery_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
        'name' => 'prettyPhoto',
        'desc' => 'Open images with prettyphoto',
        'id' => 'tf_shc_minigallery_prettyphoto',
        'value' => 'false',
        'type' => 'checkbox'
        )

    )
);

tf_add_shortcode('minigallery', 'tfuse_minigallery', $atts);
