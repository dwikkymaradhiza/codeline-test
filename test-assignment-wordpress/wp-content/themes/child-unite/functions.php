<?php 
		require_once get_stylesheet_directory() . '/shortcodes.php';

		add_action('wp_enqueue_scripts', 'child_unite_enqueue_styles');
		add_action('init', 'custom_post_type_films');
		add_action('init', 'custom_taxonomy_countries', 0);
		add_action('init', 'custom_taxonomy_genres', 0);
		add_action('init', 'custom_taxonomy_actors', 0);
		add_action( 'manage_films_posts_custom_column' , 'custom_films_column', 10, 2 );
		add_filter( 'manage_films_posts_columns', 'set_custom_edit_films_columns' );

		function child_unite_enqueue_styles() {
 			  wp_enqueue_style( 'hashone-parent-style', get_template_directory_uri() . '/style.css' ); 
		} 
		
		// Register Custom Post Type
		function custom_post_type_films() {
			$labels = array(
				'name'                  => _x( 'Films', 'Post Type General Name', 'text_domain' ),
				'singular_name'         => _x( 'Film', 'Post Type Singular Name', 'text_domain' ),
				'menu_name'             => __( 'Films', 'text_domain' ),
				'name_admin_bar'        => __( 'Films', 'text_domain' ),
				'archives'              => __( 'Item Archives', 'text_domain' ),
				'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
				'all_items'             => __( 'All Items', 'text_domain' ),
				'add_new_item'          => __( 'Add New Item', 'text_domain' ),
				'add_new'               => __( 'Add New', 'text_domain' ),
				'new_item'              => __( 'New Item', 'text_domain' ),
				'edit_item'             => __( 'Edit Item', 'text_domain' ),
				'update_item'           => __( 'Update Item', 'text_domain' ),
				'view_item'             => __( 'View Item', 'text_domain' ),
				'search_items'          => __( 'Search Item', 'text_domain' ),
				'not_found'             => __( 'Not found', 'text_domain' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
				'featured_image'        => __( 'Featured Image', 'text_domain' ),
				'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
				'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
				'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
				'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
				'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
				'items_list'            => __( 'Items list', 'text_domain' ),
				'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
				'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
			);
			
			$args = array(
				'label'                 => __( 'Films', 'text_domain' ),
				'labels'                => $labels,
				'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'menu_position'         => 5,
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive'           => true,
				'exclude_from_search'   => false,
				'publicly_queryable'    => true,
				'capability_type'       => 'page',
				'menu_icon' 						=> 'dashicons-video-alt3'
			);
			
			register_post_type('films', $args);

		}
		
		// Add the custom columns to the film post type
		function set_custom_edit_films_columns($columns) {
				$columns['release_date'] = __( 'Release Date', 'release_date' );
				$columns['ticket_price'] = __( 'Ticket Price', 'ticket_price' );

				return $columns;
		}

		// Add the data to the custom columns for the film post type
		function custom_films_column( $column, $post_id ) {
				switch ( $column ) {
						case 'release_date' :
								$meta = get_post_meta($post_id, 'Release Date', true);
								if (is_string($meta)) {
									echo $meta;
								}
								else {
									_e( 'Unable to get release date', 'ti' );
								}
								break;
						case 'ticket_price' :
								$meta = get_post_meta($post_id, 'Ticket Price', true);
								if (is_string($meta)) {
									echo $meta;
								}
								else {
									_e( 'Unable to get ticket price', 'ti' );
								}
								break;
								break;

				}
		}

		// Register Custom Taxonomy
		function custom_taxonomy_countries() {
			$labels = array(
				'name'                       => _x( 'Countries', 'Taxonomy General Name', 'text_domain' ),
				'singular_name'              => _x( 'Country', 'Taxonomy Singular Name', 'text_domain' ),
				'menu_name'                  => __( 'Countries', 'text_domain' ),
				'all_items'                  => __( 'All Items', 'text_domain' ),
				'parent_item'                => __( 'Parent Item', 'text_domain' ),
				'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
				'new_item_name'              => __( 'New Item Name', 'text_domain' ),
				'add_new_item'               => __( 'Add New Item', 'text_domain' ),
				'edit_item'                  => __( 'Edit Item', 'text_domain' ),
				'update_item'                => __( 'Update Item', 'text_domain' ),
				'view_item'                  => __( 'View Item', 'text_domain' ),
				'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
				'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
				'popular_items'              => __( 'Popular Items', 'text_domain' ),
				'search_items'               => __( 'Search Items', 'text_domain' ),
				'not_found'                  => __( 'Not Found', 'text_domain' ),
				'no_terms'                   => __( 'No items', 'text_domain' ),
				'items_list'                 => __( 'Items list', 'text_domain' ),
				'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
			);

			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => false,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => true,
			);

			register_taxonomy('countries', array( 'films' ), $args);
		}

		function custom_taxonomy_genres() {
			$labels = array(
				'name'                       => _x( 'Genres', 'Taxonomy General Name', 'text_domain' ),
				'singular_name'              => _x( 'Genre', 'Taxonomy Singular Name', 'text_domain' ),
				'menu_name'                  => __( 'Genres', 'text_domain' ),
				'all_items'                  => __( 'All Items', 'text_domain' ),
				'parent_item'                => __( 'Parent Item', 'text_domain' ),
				'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
				'new_item_name'              => __( 'New Item Name', 'text_domain' ),
				'add_new_item'               => __( 'Add New Item', 'text_domain' ),
				'edit_item'                  => __( 'Edit Item', 'text_domain' ),
				'update_item'                => __( 'Update Item', 'text_domain' ),
				'view_item'                  => __( 'View Item', 'text_domain' ),
				'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
				'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
				'popular_items'              => __( 'Popular Items', 'text_domain' ),
				'search_items'               => __( 'Search Items', 'text_domain' ),
				'not_found'                  => __( 'Not Found', 'text_domain' ),
				'no_terms'                   => __( 'No items', 'text_domain' ),
				'items_list'                 => __( 'Items list', 'text_domain' ),
				'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
			);

			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => false,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => true,
			);

			register_taxonomy('genres', array( 'films' ), $args);
		}

		function custom_taxonomy_actors() {
			$labels = array(
				'name'                       => _x( 'Actors', 'Taxonomy General Name', 'text_domain' ),
				'singular_name'              => _x( 'Actor', 'Taxonomy Singular Name', 'text_domain' ),
				'menu_name'                  => __( 'Actors', 'text_domain' ),
				'all_items'                  => __( 'All Items', 'text_domain' ),
				'parent_item'                => __( 'Parent Item', 'text_domain' ),
				'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
				'new_item_name'              => __( 'New Item Name', 'text_domain' ),
				'add_new_item'               => __( 'Add New Item', 'text_domain' ),
				'edit_item'                  => __( 'Edit Item', 'text_domain' ),
				'update_item'                => __( 'Update Item', 'text_domain' ),
				'view_item'                  => __( 'View Item', 'text_domain' ),
				'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
				'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
				'popular_items'              => __( 'Popular Items', 'text_domain' ),
				'search_items'               => __( 'Search Items', 'text_domain' ),
				'not_found'                  => __( 'Not Found', 'text_domain' ),
				'no_terms'                   => __( 'No items', 'text_domain' ),
				'items_list'                 => __( 'Items list', 'text_domain' ),
				'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
			);

			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => false,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => true,
			);

			register_taxonomy('actors', array( 'films' ), $args);
		}
 ?>