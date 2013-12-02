<?php
if (!function_exists('tfuse_list_page_options')) :
    function tfuse_list_page_options() {
        $pages = get_pages();
        $result = array();
        $result[0] = 'Select a page';
        foreach ( $pages as $page ) {
            $result[ $page->ID ] = $page->post_title;
        }
        return $result;
    }
endif;


if (!function_exists('tfuse_list_menu')) :
    function tfuse_list_menu() {
        $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
        $result = array();
        $result[0] = 'Select a menu';
        foreach ( $menus as $menu ) {
            $result[ $menu->term_id ] = $menu->name;
        }
         return $result;
    }
endif;