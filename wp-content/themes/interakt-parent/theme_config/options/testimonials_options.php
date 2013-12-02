<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for posts area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    /* ----------------------------------------------------------------------------------- */
    /* Sidebar */
    /* ----------------------------------------------------------------------------------- */


    /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */

    /* Post Media */
    array('name' => 'Media',
        'id' => TF_THEME_PREFIX . '_media',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    // Subtitle
    array('name' => 'Image',
        'desc' => 'Upload author\'s avatar. ',
        'id' => TF_THEME_PREFIX . '_img',
        'value' => '',
        'type' => 'upload',
        'divider' => true
    ),
    // Subtitle
    array('name' => 'Job Position',
        'desc' => 'Employee job ',
        'id' => TF_THEME_PREFIX . '_employee',
        'value' => '',
        'type' => 'text',
        'divider' => true
    ),
    // Subtitle
    array('name' => 'Nickname',
        'desc' => 'Employee nickname',
        'id' => TF_THEME_PREFIX . '_nickname',
        'value' => '',
        'type' => 'text'
    )
);

?>