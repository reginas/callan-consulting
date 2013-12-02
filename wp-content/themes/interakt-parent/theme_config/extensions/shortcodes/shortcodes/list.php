<?php

/**
 * List Styles
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 */

function tfuse_check_list($atts, $content = null)
{
    return '<div class="list_check">' . do_shortcode($content) . '</div>';
}

$atts = array(
    'name' => 'Check List',
    'desc' => 'Here comes some lorem ipsum description for the box shortcode.',
    'category' => 2,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => 'Content',
            'desc' => 'Use the &lt;ul&gt; tag together with the &lt;li&gt; tag to create check lists',
            'id' => 'tf_shc_check_list_content',
            'value' => '
<ul>
    <li>item 1</li>
    <li>item 2</li>
    <li>item 3</li>
</ul>
            ',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('check_list', 'tfuse_check_list', $atts);

function tfuse_delete_list($atts, $content = null) {
    return '<div class="list_delete">' . do_shortcode($content) . '</div>';
}

$atts = array(
    'name' => 'Delete List',
    'desc' => 'Here comes some lorem ipsum description for the box shortcode.',
    'category' => 2,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => 'Content',
            'desc' => 'Use the &lt;ul&gt; tag together with the &lt;li&gt; tag to create delete lists',
            'id' => 'tf_shc_delete_list_content',
            'value' => '
<ul>
    <li>item 1</li>
    <li>item 2</li>
    <li>item 3</li>
</ul>
            ',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('delete_list', 'tfuse_delete_list', $atts);

function tfuse_default_list($atts, $content = null) {
    return   '<div class="list_dots"> '.do_shortcode($content).'</div>';
}

$atts = array(
    'name' => 'Default List',
    'desc' => 'Here comes some lorem ipsum description for the box shortcode.',
    'category' => 2,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => 'Content',
            'desc' => 'Use the &lt;ul&gt; tag together with the &lt;li&gt; tag to create delete lists',
            'id' => 'tf_shc_default_list_content',
            'value' => '
<ul>
    <li>item 1</li>
    <li>item 2</li>
    <li>item 3</li>
</ul>
            ',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('default_list', 'tfuse_default_list', $atts);