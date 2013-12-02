 <?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to tfuse_comment() which is
 * located in the functions.php file.
 *
 */
global $wp_query;
$tfuse_comments = null;
$per_page = get_option('comments_per_page');
$total = get_comments(array('parent' => 0, 'post_id' => $wp_query->query_vars['page_id'], 'status' => 'approve'));
$args = array(
    'post_id' => $wp_query->query_vars['page_id'],
    'parent' => 0,
    'order'  => 'ASC',
    'number' => $per_page,
    'status'  => 'approve'
);
if( get_option( 'page_comments' )) {
    $tfuse_comments = get_comments($args);
    foreach($tfuse_comments as $key=>$comment) :
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
        if(sizeof($replays)) array_splice( $tfuse_comments, $key+1, 0, $replays );
    endforeach;
}
?>
<div id="respond">
    <div class="divider"></div>
<div class="add-comment" id="addcomments">
    <h3 class="text-bold alignleft"><?php _e('Response to this project', 'tfuse') ?></h3>
	<h6 class="charactersleft"><?php _e(' characters left','tfuse');?></h6>
    <h6 class="character"></h6>
        <div class="clear"></div>
    
        <div class="cancel-comment-reply">
                <small><?php cancel_comment_reply_link(); ?></small>
        </div><!-- /.cancel-comment-reply -->

        <?php if ( get_option('comment_registration') && !$user_ID ) : //If registration required & not logged in. ?>

                <p><?php _e('You must be', 'tfuse') ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in', 'tfuse') ?></a> <?php _e('to post a comment.', 'tfuse') ?></p>

        <?php else : //No registration required ?>

    <div class="comment-form">
        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

            <?php if ( $user_ID ) : //If user is logged in ?>

                <p><?php _e('Logged in as', 'tfuse') ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(); ?>" title="<?php _e('Log out of this account', 'tfuse') ?>"><?php _e('Logout', 'tfuse') ?> &raquo;</a></p>

            <?php else : //If user is not logged in ?>

            <div class="input-row field_text alignleft infieldlabel">
                <input type="text" name="author" class="inputtext input_middle required" id="name" value="<?php _e('Name', 'tfuse') ?>" onblur="if (this.value == '') {this.value = '<?php _e('Name', 'tfuse') ?>';}" onfocus="if (this.value == '<?php _e('Name', 'tfuse') ?>') {this.value = '';}" tabindex="1" />
            </div>
                
            <div class="input-row field_text alignleft omega infieldlabel">
                <input type="text" name="email" class="inputtext input_middle required" id="email" value="<?php _e('Email ', 'tfuse') ?>" onblur="if (this.value == '') {this.value = '<?php _e('Email ', 'tfuse') ?>';}" onfocus="if (this.value == '<?php _e('Email ', 'tfuse') ?>') {this.value = '';}" tabindex="2" />
            </div>
                
            <div class="clear"></div> 
            <?php endif; // End if logged in ?>

        <!--<p><strong>XHTML:</strong> <?php _e('You can use these tags', 'tfuse'); ?>: <?php echo allowed_tags(); ?></p>-->
        
        <div class="input-row field_textarea infieldlabel">
            <textarea maxlength="800" name="comment" class="textarea textarea_middle required" id="message" rows="10" cols="30" tabindex="4"></textarea>
        </div>
        <div class="row rowSubmit">
            <input name="submit" type="submit" id="submit" class="btn button_link_large btn_black" tabindex="5" value="<?php _e('Post comment', 'tfuse') ?>" />
            <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
        </div>

        <?php comment_id_fields(); ?>
        <?php do_action('comment_form', $post->ID); ?>

        </form><!-- /#commentform -->
    </div>
            <?php endif; // If registration required ?>

</div><!-- /#respond -->
</div>

   <div id="comments" class="comment-list">
    <?php if ( post_password_required() ) : ?>
        <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'tfuse' ); ?></p>
    </div><!-- #comments -->
    <?php
            /* Stop the rest of comments.php from being processed,
             * but don't kill the script entirely -- we still have
             * to fully load the template.
             */
            return;
        endif;
    ?>

    <?php // You can start editing here -- including this comment! ?>

    <?php if ( have_comments() ) : ?>
       <h3><?php comments_number("0 ".__('Responses','tfuse'), "1 ".__('Response','tfuse'), "% ".__('Responses','tfuse')); ?></h3>
        <ol>
            <?php
                /* Loop through and list the comments. Tell wp_list_comments()
                 * to use tfuse_comment() to format the comments.
                 * If you want to overload this in a child theme then you can
                 * copy file comments-template.php to child theme or
                 * define your own tfuse_comment() and that will be used instead.
                 * See tfuse_comment() in comments-template.php for more.
                 */
                wp_list_comments( array( 'callback' => 'tfuse_comment' ), $tfuse_comments );
            ?>
        </ol>

        <?php if (get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <div class="button see-more btn_gray" data-rel="<?php echo $per_page; ?>" role="<?php echo sizeof($total); ?>"><span><?php _e('See More', 'tfuse'); ?></span></div>
        <?php endif; // check for comment navigation ?>

    <?php elseif ( comments_open() ) : // If comments are open, but there are no comments ?>

        <p class="nocomments"><?php _e('No comments yet.', 'tfuse') ?></p>

    <?php endif; ?>
</div><!-- #comments -->