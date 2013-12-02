<?php
if (!function_exists('tfuse_rewrite_worpress_reading_options')):

    /**
     *
     *
     * To override tfuse_rewrite_worpress_reading_options() in a child theme, add your own tfuse_rewrite_worpress_reading_options()
     * to your child theme's file.
     */

    add_action('tfuse_admin_save_options','tfuse_rewrite_worpress_reading_options', 10, 1);

    function tfuse_rewrite_worpress_reading_options ($options)
    {
        if($options[TF_THEME_PREFIX . '_homepage_category'] == 'page')
        {
            update_option('show_on_front', 'page');

            if(get_post_type(intval($options[TF_THEME_PREFIX . '_home_page'])) == 'page')
            {
                update_option('page_on_front', intval($options[TF_THEME_PREFIX . '_home_page']));
            }

            if(get_post_type(intval($options[TF_THEME_PREFIX . '_blog_page'])) == 'page')
            {
                update_option('page_for_posts', intval($options[TF_THEME_PREFIX . '_blog_page']));
            }
            else
            {
                update_option('page_for_posts', 0);
            }
        }
        else
        {
            update_option('show_on_front', 'posts');
            update_option('page_on_front', 0);
            update_option('page_for_posts', 0);
        }

    }
endif;


if (!function_exists('tfuse_ajax_get_comments')) :
    function tfuse_ajax_get_comments(){
        $disp = $_POST['displayed'];
        $displayed = (intval($disp));
        $per_page = (intval($_POST['per_page']));
        $post_id = (intval($_POST['post_id']));

        $args = array(
            'number' => $per_page,
            'orderby' => '',
            'order' => 'ASC',
            'offset' => $displayed,
            'parent' => 0,
            'post_id' => $post_id,
            'status' => 'approve'
        );

        $comments = get_comments($args);
        
        foreach($comments as $key=>$comment) :
        $replays = get_comments(array('parent' => $comment->comment_ID));
            if(!empty($replays))
            {
                $replays = array_reverse($replays);
                foreach ($replays as $replay) {
                    $replays1 = get_comments(array('parent' => $replay->comment_ID)); 
                        if(!empty($replays1))
                        {  
                            $replays1 = array_reverse($replays1);
                            $replays = array_merge($replays,$replays1); 
                            foreach ($replays1 as $replay) {
                                $replays2 = get_comments(array('parent' => $replay->comment_ID));
                                    if(!empty($replays2))
                                    {
                                        $replays2 = array_reverse($replays2);
                                        $replays = array_merge($replays,$replays2);
                                        foreach ($replays2 as $replay) {
                                            $replays3 = get_comments(array('parent' => $replay->comment_ID));
                                            if(!empty($replays3))
                                            {
                                                $replays3 = array_reverse($replays3);
                                                $replays = array_merge($replays,$replays3);
                                            }   
                                        }
                                    }
                            }
                        }
                }
            }
        if(sizeof($replays)) array_splice( $comments, $key+1, 0, $replays );
    endforeach;
        

        wp_list_comments( array( 'callback' => 'tfuse_comment' ), $comments );
        die();
    }
    add_action('wp_ajax_tfuse_ajax_get_comments','tfuse_ajax_get_comments');
    add_action('wp_ajax_nopriv_tfuse_ajax_get_comments','tfuse_ajax_get_comments');
endif;

if ( ! function_exists( 'tfuse_comment' ) ) :
    /**
     * Template for comments and pingbacks.
     *
     * To override this walker in a child theme without modifying the comments template
     * simply create your own tfuse_comment(), and that function will be used instead.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     *
     */
    function tfuse_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
                ?>
    <li class="post pingback">
       <a name="comment-<?php comment_ID() ?>"></a>
                <div id="li-comment-<?php comment_ID() ?>" class="comment-container comment-body">
                    <p><?php _e( 'Pingback:', 'tfuse' ); ?> <?php comment_author_link(); ?>
                        <span class="comment-date"><?php comment_date() ?></span>
                        <?php comment_text() ?>
                </div><?php
                break;
            default :
                ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                    <a name="comment-<?php comment_ID() ?>"></a>

                    <div id="li-comment-<?php comment_ID() ?>" class="comment-body">

                        <div class="comment-avatar"><?php echo get_avatar( $comment, 48 ); ?></div>

                        <div class="comment-text">

                            <div class="comment-author">
                                <a href="" class="link-author text-orange"><?php comment_author_link() ?></a>
                            </div>

                            <div class="comment-entry">
                                <?php echo get_comment_text() ?>
                            </div>
                            <span class="comment-date"><?php comment_date() ?></span> | <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
                            <?php if ( $comment->comment_approved == '0' ) : ?>
                            <p class='unapproved'><?php _e('Your comment is awaiting moderation.', 'tfuse'); ?></p>
                            <br />
                            <?php endif; ?>

                        </div>
                        <!-- /.comment-head -->

                        <div id="comment-<?php comment_ID(); ?>"></div>
                        <div class="clear"></div>

                    </div><!-- /.comment-container -->
                <?php
                break;
        endswitch;
    }
endif; // ends check for tfuse_comment()