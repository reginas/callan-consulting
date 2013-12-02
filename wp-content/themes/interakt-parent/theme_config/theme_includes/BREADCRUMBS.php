<?php

function tfuse_breadcrumbs( $args = array() ) {
    global $wp_query, $wp_rewrite;

    /* Get the textdomain. */
    $textdomain = 'tfusethemes';

    /* Create an empty variable for the breadcrumb. */
    $breadcrumb = '';

    /* Create an empty array for the trail. */
    $trail = array();
    $path = '';

    /* Set up the default arguments for the breadcrumb. */
    $defaults = array(
        'separator' => '<span class="separator">&nbsp;</span>',
        'after' => false,
        'front_page' => false,
        'show_home' => __( 'Home', $textdomain ),
        'echo' => true,
        'show_posts_page' => true
    );

    /* Allow singular post views to have a taxonomy's terms prefixing the trail. */
    if ( is_singular() )
        $defaults["singular_{$wp_query->post->post_type}_taxonomy"] = false;

    /* Apply filters to the arguments. */
    $args = apply_filters( 'tfuse_breadcrumbs_args', $args );

    /* Parse the arguments and extract them for easy variable naming. */
    extract( wp_parse_args( $args, $defaults ) );
    /* If viewing a singular post (page, attachment, etc.). */
    if ( is_singular() ) {

        /* Get singular post variables needed. */
        $post = $wp_query->get_queried_object();
        $post_id = absint( $wp_query->get_queried_object_id() );
        $post_type = $post->post_type;
        $parent = $post->post_parent;

        /* If a custom post type, check if there are any pages in its hierarchy based on the slug. */
        if ( 'page' !== $post_type && 'post' !== $post_type ) {

            $post_type_object = get_post_type_object( $post_type );

            /* If $front has been set, add it to the $path. */
            if ( 'post' == $post_type || 'attachment' == $post_type/* || ( $post_type_object->rewrite['with_front'] && $wp_rewrite->front ) */)
                $path .= trailingslashit( $wp_rewrite->front );

            /* If there's a slug, add it to the $path. */
            if ( !empty( $post_type_object->rewrite['slug'] ) )
                $path .= $post_type_object->rewrite['slug'];

            /* If there's an archive page, add it to the trail. */
       }
        if( is_single() )
        {
            $category = get_the_category();
            $terms = get_the_terms($post_id, 'group');
           ;

            if(empty($category[0]->cat_name)){

                if($terms){$terms = get_the_terms($post_id, 'group');
                if ( $terms && ! is_wp_error( $terms ) )
                    $draught_links = array();
                foreach ( $terms as $term ) {

                    if($term->parent ==  0){
                        $draught_links[0] = $term->name;}
                }

                $on_draught = join( ", ", $draught_links );

                $cr_name = $on_draught;
                $cr_link = get_term_link( $term, $term->taxonomy );
            }else {
                    $cr_name ="";
                    $cr_link="";

                }}
            else
            {
                $cr_name = $category[0]->cat_name;
                $cr_link = get_category_link( $category[0]->cat_ID);
            }



            $trail[] = '<a href="' . $cr_link . '">' . $cr_name . '</a>';


        }
        /* If the post type path returns nothing and there is a parent, get its parents. */
        if ( empty( $path ) && 0 !== $parent || 'attachment' == $post_type )
            $trail = array_merge( $trail, tfuse_breadcrumbs_get_parents( $parent, '' ) );

        /* Toggle the display of the posts page on single blog posts. */
        if ( 'post' == $post_type && $show_posts_page == true && 'page' == get_option( 'show_on_front' ) ) {
            $posts_page = get_option( 'page_for_posts' );
            if ( $posts_page != '' && is_numeric( $posts_page ) ) {
                $trail = array_merge( $trail, tfuse_breadcrumbs_get_parents( $posts_page, '' ) );
            }
        }

        /* Display terms for specific post type taxonomy if requested. */
        if ( isset( $args["singular_{$post_type}_taxonomy"] ) && $terms = get_the_term_list( $post_id, $args["singular_{$post_type}_taxonomy"], '', ', ', '' ) )
            $trail[] = $terms;

        /* End with the post title. */
        $post_title = get_the_title( $post_id ); // Force the post_id to make sure we get the correct page title.
        if ( !empty( $post_title ) )
            $trail['trail_end'] = $post_title;

    }

    /* If we're viewing any type of archive. */
    elseif ( is_archive() ) {

        /* If viewing a taxonomy term archive. */
        if ( is_tax() || is_category() || is_tag() ) {

            /* Get some taxonomy and term variables. */
            $term = $wp_query->get_queried_object();
            $taxonomy = get_taxonomy( $term->taxonomy );

            /* Get the path to the term archive. Use this to determine if a page is present with it. */
            if ( is_category() )
                $path = get_option( 'category_base' );
            elseif ( is_tag() )
                $path = get_option( 'tag_base' );

            /* Get parent pages by path if they exist. */
            if ( $path )
                $trail = array_merge( $trail, tfuse_breadcrumbs_get_parents( '', $path ) );

            /* If the taxonomy is hierarchical, list its parent terms. */
            if ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent )
                $trail = array_merge( $trail, tfuse_breadcrumbs_get_term_parents( $term->parent, $term->taxonomy ) );

            /* Add the term name to the trail end. */
            $trail['trail_end'] = $term->name;
        }

        /* If viewing a post type archive. */
        elseif ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() ) {

            /* Get the post type object. */
            $post_type_object = get_post_type_object( get_query_var( 'post_type' ) );

            /* If $front has been set, add it to the $path. */
            if ( $post_type_object->rewrite['with_front'] && $wp_rewrite->front )
                $path .= trailingslashit( $wp_rewrite->front );

            /* If there's a slug, add it to the $path. */
            if ( !empty( $post_type_object->rewrite['archive'] ) )
                $path .= $post_type_object->rewrite['archive'];

            /* If there's a path, check for parents. */
            if ( !empty( $path ) && '/' != $path )
                $trail = array_merge( $trail, tfuse_breadcrumbs_get_parents( '', $path ) );

            /* Add the post type [plural] name to the trail end. */
            $trail['trail_end'] = $post_type_object->labels->name;
        }

        /* If viewing an author archive. */
        elseif ( is_author() ) {

            /* If $front has been set, add it to $path. */
            if ( !empty( $wp_rewrite->front ) )
                $path .= trailingslashit( $wp_rewrite->front );

            /* If an $author_base exists, add it to $path. */
            if ( !empty( $wp_rewrite->author_base ) )
                $path .= $wp_rewrite->author_base;

            /* If $path exists, check for parent pages. */
            if ( !empty( $path ) )
                $trail = array_merge( $trail, tfuse_breadcrumbs_get_parents( '', $path ) );

            /* Add the author's display name to the trail end. */
            $trail['trail_end'] = get_the_author_meta( 'display_name', get_query_var( 'author' ) );
        }

        /* If viewing a time-based archive. */
        elseif ( is_time() ) {

            if ( get_query_var( 'minute' ) && get_query_var( 'hour' ) )
                $trail['trail_end'] = get_the_time( __( 'g:i a', $textdomain ) );

            elseif ( get_query_var( 'minute' ) )
                $trail['trail_end'] = sprintf( __( 'Minute %1$s', $textdomain ), get_the_time( __( 'i', $textdomain ) ) );

            elseif ( get_query_var( 'hour' ) )
                $trail['trail_end'] = get_the_time( __( 'g a', $textdomain ) );
        }

        /* If viewing a date-based archive. */
        elseif ( is_date() ) {

            /* If $front has been set, check for parent pages. */
            if ( $wp_rewrite->front )
                $trail = array_merge( $trail, tfuse_breadcrumbs_get_parents( '', $wp_rewrite->front ) );

            if ( is_day() ) {
                $trail[] = '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', $textdomain ) ) . '">' . get_the_time( __( 'Y', $textdomain ) ) . '</a>';
                $trail[] = '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title="' . get_the_time( esc_attr__( 'F', $textdomain ) ) . '">' . get_the_time( __( 'F', $textdomain ) ) . '</a>';
                $trail['trail_end'] = get_the_time( __( 'j', $textdomain ) );
            }

            elseif ( get_query_var( 'w' ) ) {
                $trail[] = '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', $textdomain ) ) . '">' . get_the_time( __( 'Y', $textdomain ) ) . '</a>';
                $trail['trail_end'] = sprintf( __( 'Week %1$s', $textdomain ), get_the_time( esc_attr__( 'W', $textdomain ) ) );
            }

            elseif ( is_month() ) {
                $trail[] = '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', $textdomain ) ) . '">' . get_the_time( __( 'Y', $textdomain ) ) . '</a>';
                $trail['trail_end'] = get_the_time( __( 'F', $textdomain ) );
            }

            elseif ( is_year() ) {
                $trail['trail_end'] = get_the_time( __( 'Y', $textdomain ) );
            }
        }
    }

    /* If viewing search results. */
    elseif ( is_search() ){
        $sear =  sprintf( __( 'Search results for &quot;%1$s&quot;', $textdomain ), esc_attr( get_search_query() ) );
 $trail['trail_end'] = sprintf( __( 'Search results for &quot;%1$s&quot;', $textdomain ), esc_attr( get_search_query() ) );
}
    /* If viewing a 404 error page. */
    elseif ( is_404() )
        $trail['trail_end'] = __( '404 Not Found', $textdomain );
        $err =__( '404 Not Found','tfuse');
        /* Allow child themes/plugins to filter the trail array. */
    $trail = apply_filters( 'tfuse_breadcrumbs_trail', $trail, $args );

    /* Connect the breadcrumb trail if there are items in the trail. */
    if ( is_array( $trail ) ) {

        /* Join the individual trail items into a single string. */
        $breadcrumb .= join( " {$separator} ", $trail );

        /* If $after was set, wrap it in a container. */

    }

    /* Allow developers to filter the breadcrumb trail HTML. */
    $breadcrumb = apply_filters( 'tfuse_breadcrumbs', $breadcrumb );

	/* Allow developers to filter the breadcrumb trail HTML. */
	$breadcrumb = apply_filters( 'tfuse_breadcrumbs', $breadcrumb );


    /*Added for Qlassik*/
	$search_brandcamps = '';
    $search_brandcamps_left ='';
    $search_brandcamps_right='';
    $sidebar_position = tfuse_sidebar_position();
    $category = get_the_category();
    $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy') );
    if(!empty($category[0]->cat_name)){
        $cat_name =  $category[0]->cat_name;}else{$cat_name='';}
    if(!empty($term->name)){
        $tax_name = $term->name;}else{$tax_name='';}

		if($sidebar_position=="left"){ $search_brandcamps_left = $search_brandcamps ;}
		elseif($sidebar_position=="right"){ $search_brandcamps_right = $search_brandcamps;}
			 $title_single =  get_the_title();
			if(is_single()||is_page()){$cat = $title_single;}elseif(is_404()){$cat = $err; $search_brandcamps_right = "";}elseif(is_search()){$cat = $sear ; $search_brandcamps_right = $search_brandcamps;}else{$cat = $cat_name;}
			echo $breadcrumb;
	
} // End tfuse_breadcrumbs

function tfuse_breadcrumbs_get_parents( $post_id = '', $path = '' ) {

	/* Set up an empty trail array. */
	$trail = array();

	/* If neither a post ID nor path set, return an empty array. */
	if ( empty( $post_id ) && empty( $path ) )
		return $trail;

	/* If the post ID is empty, use the path to get the ID. */
	if ( empty( $post_id ) ) {

		/* Get parent post by the path. */
		$parent_page = get_page_by_path( $path );

		/* If a parent post is found, set the $post_id variable to it. */
		if ( !empty( $parent_page ) )
			$post_id = $parent_page->ID;
	}

	/* If a post ID and path is set, search for a post by the given path. */
	if ( $post_id == 0 && !empty( $path ) ) {

		/* Separate post names into separate paths by '/'. */
		$path = trim( $path, '/' );
		preg_match_all( "/\/.*?\z/", $path, $matches );

		/* If matches are found for the path. */
		if ( isset( $matches ) ) {

			/* Reverse the array of matches to search for posts in the proper order. */
			$matches = array_reverse( $matches );

			/* Loop through each of the path matches. */
			foreach ( $matches as $match ) {

				/* If a match is found. */
				if ( isset( $match[0] ) ) {

					/* Get the parent post by the given path. */
					$path = str_replace( $match[0], '', $path );
					$parent_page = get_page_by_path( trim( $path, '/' ) );

					/* If a parent post is found, set the $post_id and break out of the loop. */
					if ( !empty( $parent_page ) && $parent_page->ID > 0 ) {
						$post_id = $parent_page->ID;
						break;
					}
				}
			}
		}
	}

	/* While there's a post ID, add the post link to the $parents array. */
	while ( $post_id ) {

		/* Get the post by ID. */
		$page = get_page( $post_id );

		/* Add the formatted post link to the array of parents. */
		$parents[]  = '<a href="' . get_permalink( $post_id ) . '">' . get_the_title( $post_id ) . '</a>';

		/* Set the parent post's parent to the post ID. */
		@$post_id = $page->post_parent;
	}

	/* If we have parent posts, reverse the array to put them in the proper order for the trail. */
	if ( isset( $parents ) )
		$trail = array_reverse( $parents );

	/* Return the trail of parent posts. */
	return $trail;

} // End tfuse_breadcrumbs_get_parents()

function tfuse_breadcrumbs_get_term_parents( $parent_id = '', $taxonomy = '' ) {

	/* Set up some default arrays. */
	$trail = array();
	$parents = array();

	/* If no term parent ID or taxonomy is given, return an empty array. */
	if ( empty( $parent_id ) || empty( $taxonomy ) )
		return $trail;

	/* While there is a parent ID, add the parent term link to the $parents array. */
	while ( $parent_id ) {

		/* Get the parent term. */
		$parent = get_term( $parent_id, $taxonomy );

		/* Add the formatted term link to the array of parent terms. */
		$parents[] = '<a href="' . get_term_link( $parent, $taxonomy ) . '">' . $parent->name . '</a>';

		/* Set the parent term's parent as the parent ID. */
		$parent_id = $parent->parent;
	}

	/* If we have parent terms, reverse the array to put them in the proper order for the trail. */
	if ( !empty( $parents ) )
		$trail = array_reverse( $parents );

	/* Return the trail of parent terms. */
	return $trail;

} // End tfuse_breadcrumbs_get_term_parents()
?>