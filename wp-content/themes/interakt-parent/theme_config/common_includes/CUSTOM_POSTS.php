<?php
/**
 * Create custom posts types
 *
 * @since  Interakt 1.0
 */

if ( !function_exists('tfuse_create_custom_post_types') ) :
/**
 * Retrieve the requested data of the author of the current post.
 *  
 * @param array $fields first_name,last_name,email,url,aim,yim,jabber,facebook,twitter etc.
 * @return null|array The author's spefified fields from the current author's DB object.
 */
    function tfuse_create_custom_post_types()
    {
		//Reservation_form
		        $labels = array(
                        'name' => _x('Reservation', 'post type general name', 'tfuse'),
                        'singular_name' => _x('Reservation', 'post type singular name', 'tfuse'),
                        'add_new' => __('Add New', 'tfuse'),
                        'add_new_item' => __('Add New Reservation', 'tfuse'),
                        'edit_item' => __('Edit Reservation info', 'tfuse'),
                        'new_item' => __('New Reservation', 'tfuse'),
                        'all_items' => __('All Reservations', 'tfuse'),
                        'view_item' => __('View Reservation info', 'tfuse'),
                        'parent_item_colon' => ''
                );
                $reservationform_rewrite=apply_filters('tfuse_reservationform_rewrite','reservationform_list');
                $res_args = array(
                                'labels' => $labels,
                                'public' => true,
                                'publicly_queryable' => false,
                                'show_ui' => false,
                                'query_var' => true,
                                'exclude_from_search'=>true,
                                //'menu_icon' => get_template_directory_uri() . '/images/icons/doctors.png',
                                'has_archive' => true,
                                'rewrite' => array('slug'=> $reservationform_rewrite),
                                'menu_position' => 6,
                                'supports' => array(null)
                        );
               register_taxonomy('reservations', array('reservations'), array(
                            'hierarchical' => true,
                            'labels' => array(
                                'name' => _x('Reservation Forms', 'post type general name', 'tfuse'),
                                'singular_name' => _x('Reservation Form', 'post type singular name', 'tfuse'),
                                'add_new_item' => __('Add New Reservation Form', 'tfuse'),
                            ),
                            'show_ui' => false,
                            'query_var' => true,
                            'rewrite' => array('slug' => $reservationform_rewrite)
                        ));
                        register_post_type( 'reservations' , $res_args );
          // Services
        $labels = array(
                'name' => _x('Services', 'post type general name', 'tfuse'),
                'singular_name' => _x('Service', 'post type singular name', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New', 'tfuse'),
                'edit_item' => __('Edit Service info', 'tfuse'),
                'new_item' => __('New Service', 'tfuse'),
                'all_items' => __('All Services', 'tfuse'),
                'view_item' => __('View Service info', 'tfuse'),
                'search_items' => __('Search Service', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $servicelist_rewrite = apply_filters('tfuse_servicelist_rewrite','all-service-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $servicelist_rewrite),
                'menu_position' => 5,
                'supports' => array('title','editor','excerpt','comments')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => _x('Categories', 'taxonomy general name'),
            'singular_name' => _x('Category', 'taxonomy singular name'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse'),
        );

        $servicelist_taxonomy_rewrite = apply_filters('tfuse_servicelist_taxonomy_rewrite','services-list');
		
		 register_taxonomy('services', array('service'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $servicelist_taxonomy_rewrite)
        ));
		
		//Tags
            $labels = array(
            'name' => _x('Tags', 'taxonomy general name' ),
            'singular_name' => _x('Tag', 'taxonomy singular name'),
            'search_items' => __('Search Tags','tfuse'),
            'popular_items' => __( 'Popular Tags','tfuse' ),
            'all_items' => __('All Tags','tfuse'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Tagv','tfuse'),
            'update_item' => __('Update Tag','tfuse'),
            'add_new_item' => __('Add New Tag','tfuse'),
            'new_item_name' => __('New Tag Name','tfuse'),
            'separate_items_with_commas' => __( 'Separate tags with commas','tfuse' ),
            'add_or_remove_items' => __( 'Add or remove tags','tfuse' ),
            'choose_from_most_used' => __( 'Choose from the most used tags','tfuse' ),
        );
		
		
            register_taxonomy('metatag', 'service', array(
            'hierarchical' => false,
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array('slug' => 'metatags')
        ));    

        register_post_type( 'service' , $args ); 
         // Works
        $labels = array(
                'name' => _x('Works', 'post type general name', 'tfuse'),
                'singular_name' => _x('Work', 'post type singular name', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New', 'tfuse'),
                'edit_item' => __('Edit Work info', 'tfuse'),
                'new_item' => __('New Work', 'tfuse'),
                'all_items' => __('All Works', 'tfuse'),
                'view_item' => __('View Work info', 'tfuse'),
                'search_items' => __('Search Work', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $worklist_rewrite = apply_filters('tfuse_worklist_rewrite','all-work-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $worklist_rewrite,'feeds'=>true),
                'menu_position' => 5,
                'supports' => array('title','editor','excerpt','comments')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => _x('Categories', 'taxonomy general name'),
            'singular_name' => _x('Category', 'taxonomy singular name'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse'),
        );

        $worklist_taxonomy_rewrite = apply_filters('tfuse_worklist_taxonomy_rewrite','group-list');
		
            register_taxonomy('group', array('work'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
                'has_archive' => true,
            'rewrite' => array('slug' => $worklist_taxonomy_rewrite)
        ));
		
		//Tags
            $labels = array(
            'name' => _x('Tags', 'taxonomy general name' ),
            'singular_name' => _x('Tag', 'taxonomy singular name'),
            'search_items' => __('Search Tags','tfuse'),
            'popular_items' => __( 'Popular Tags','tfuse' ),
            'all_items' => __('All Tags','tfuse'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Tagv','tfuse'),
            'update_item' => __('Update Tag','tfuse'),
            'add_new_item' => __('Add New Tag','tfuse'),
            'new_item_name' => __('New Tag Name','tfuse'),
            'separate_items_with_commas' => __( 'Separate tags with commas','tfuse' ),
            'add_or_remove_items' => __( 'Add or remove tags','tfuse' ),
            'choose_from_most_used' => __( 'Choose from the most used tags','tfuse' ),
        );
		
		
            register_taxonomy('tags', 'work', array(
            'hierarchical' => false,
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array('slug' => 'tags')
        ));    

        register_post_type( 'work' , $args );
        
        
        
        // Careers
        $labels = array(
                'name' => _x('Careers', 'post type general name', 'tfuse'),
                'singular_name' => _x('Career', 'post type singular name', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New', 'tfuse'),
                'edit_item' => __('Edit Career info', 'tfuse'),
                'new_item' => __('New Career', 'tfuse'),
                'all_items' => __('All Careers', 'tfuse'),
                'view_item' => __('View Career info', 'tfuse'),
                'search_items' => __('Search Career', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $careerlist_rewrite = apply_filters('tfuse_careerlist_rewrite','all-career-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $careerlist_rewrite),
                'menu_position' => 5,
                'supports' => array('title','editor','excerpt','comments')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => _x('Categories', 'taxonomy general name'),
            'singular_name' => _x('Category', 'taxonomy singular name'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse'),
        );

        $careerlist_taxonomy_rewrite = apply_filters('tfuse_careerlist_taxonomy_rewrite','career-list');
		
		 register_taxonomy('jobs', array('careers'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $careerlist_taxonomy_rewrite)
        ));


        register_post_type( 'careers' , $args );
        
        // Members
        $labels = array(
                'name' => _x('Members', 'post type general name', 'tfuse'),
                'singular_name' => _x('Member', 'post type singular name', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Member', 'tfuse'),
                'edit_item' => __('Edit Member', 'tfuse'),
                'new_item' => __('New Member', 'tfuse'),
                'all_items' => __('All Members', 'tfuse'),
                'view_item' => __('View Member', 'tfuse'),
                'search_items' => __('Search Members', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $args = array(
                'labels' => $labels,
                'public' => true,
                'exclude_from_search'=> true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => true,
                'menu_position' => 5,
                'supports' => array('title','editor')
        ); 

        register_post_type( 'members' , $args );
        
        // TESTIMONIALS
        $labels = array(
                'name' => _x('Testimonials', 'post type general name', 'tfuse'),
                'singular_name' => _x('Testimonial', 'post type singular name', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Testimonial', 'tfuse'),
                'edit_item' => __('Edit Testimonial', 'tfuse'),
                'new_item' => __('New Testimonial', 'tfuse'),
                'all_items' => __('All Testimonials', 'tfuse'),
                'view_item' => __('View Testimonial', 'tfuse'),
                'search_items' => __('Search Testimonials', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $args = array(
                'labels' => $labels,
                'public' => false,
                'publicly_queryable' => false,
                'show_ui' => true,
                'query_var' => true,
                //'menu_icon' => get_template_directory_uri() . '/images/icons/testimonials.png',
                'rewrite' => true,
                'menu_position' => 5,
                'supports' => array('title','editor')
        ); 

        register_post_type( 'testimonials' , $args );

    }
    tfuse_create_custom_post_types();

endif;

add_action('category_add_form', 'taxonomy_redirect_note');
add_action('specialties_add_form', 'taxonomy_redirect_note');
function taxonomy_redirect_note($taxonomy){
    echo '<p><strong>Note:</strong> More options are available after you add the '.$taxonomy.'. <br />
        Click on the Edit button under the '.$taxonomy.' name.</p>';
}
