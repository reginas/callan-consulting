<?php

/**
 * Newsletter
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * title: e.g. Newsletter signup
 * text: e.g. Thank you for your subscribtion.
 * action: URL where to send the form data.
 * rss_feed:
 */

function tfuse_newsletter($atts, $content = null)
{
    extract(shortcode_atts(array('title' => '', 'text' => '', 'rss_feed' => ''), $atts));

    if (empty($title))
        $title = __('Newsletter', 'tfuse');
    if (empty($text))
        $text = __('', 'tfuse');

    $out = '
    <div class="widget-container newsletter_subscription_box newsletterBox">
            <div class="inner">
        
        <h3>' . $title . '</h3> 
<div class="newsletter_subscription_messages before-text">
                    <div class="newsletter_subscription_message_initial">
                        '. __('','tfuse').' 
                    </div>
                    <div class="newsletter_subscription_message_success">
                        '.__('Thank you for your subscribtion.','tfuse').'
                    </div>
                    <div class="newsletter_subscription_message_wrong_email">
                        '.__('Your email format is wrong!','tfuse') .'
                    </div>
                    <div class="newsletter_subscription_message_failed">
                        '. __('Sad, but we couldn\'t add you to our mailing list ATM.','tfuse') .'
                    </div>
                </div>

        <form action="#" method="post" class="newsletter_subscription_form">
                    <div class="newsletter_text">'.$text.'</div>
                        <div class="row infieldlabel">
                        <label for="newsletter">'.__('Your Email','tfuse').'</label>
                            <input type="text" value="" name="newsletter" id="newsletter" class="newsletter_subscription_email inputField" />
                            <input type="submit" value="Ok" class="btn-arrow newsletter_subscription_submit" />
		<div class="newsletter_subscription_ajax">'. __('Loading...','tfuse') .'</div>
                            <div class="newsletter_text">';
    if ($rss_feed != 'false') {  
        $out .= '<br/><a href="'.tfuse_options('feedburner_url', get_bloginfo_rss('rss2_url')).'" class="link-news-rss">'. __('Also subscribe to our ', 'tfuse').'<span>'. __('RSS feed', 'tfuse').'</span></a>';
                        } 
                        $out .= '</div>
                            <div class="clear"></div>
                        </div>
                </form>
            </div>
        </div>';
        

    return $out;
}

$atts = array(
    'name' => 'Newsletter',
    'desc' => 'Here comes some lorem ipsum description for the box shortcode.',
    'category' => 11,
    'options' => array(
        array(
            'name' => 'Title',
            'desc' => 'Enter the title of the Newsletter form',
            'id' => 'tf_shc_newsletter_title',
            'value' => 'Newsletter',
            'type' => 'text'
        ),
        array(
            'name' => 'Text',
            'desc' => 'Specify the newsletter message',
            'id' => 'tf_shc_newsletter_text',
            'value' => 'Sign up for our weekly newsletter to receive updates, news, and promos:',
            'type' => 'textarea'
        ),
        array(
            'name' => 'RSS Feed',
            'desc' => 'Show RSS Feed link?',
            'id' => 'tf_shc_newsletter_rss_feed',
            'value' => 'false',
            'type' => 'checkbox'
        )
    )
);

tf_add_shortcode('newsletter', 'tfuse_newsletter', $atts);
