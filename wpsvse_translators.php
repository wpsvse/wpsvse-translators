<?php
/*
Plugin Name: WPSV Översättare
Description: Anpassade posttyper för översättningsprojekt och översättare.
Version: 0.1
License: GPL
Author: WordPress Sverige
Author URI: http://wpsv.se
*/


/**
 * Register custom post type for translation projects
 * separated from WPs regular posts.
 */
add_action( 'init', 'wpsvse_cpt_projects', 0 );

function wpsvse_cpt_projects() {

	$labels = array(
		'name'                => _x( 'Översättningsprojekt', 'Post Type General Name', 'wpsvse' ),
		'singular_name'       => _x( 'Översättningsprojekt', 'Post Type Singular Name', 'wpsvse' ),
		'menu_name'           => __( 'Översättningar', 'wpsvse' ),
		'name_admin_bar'      => __( 'Översättningar', 'wpsvse' ),
		'parent_item_colon'   => __( 'Överordnat:', 'wpsvse' ),
		'all_items'           => __( 'Alla projekt', 'wpsvse' ),
		'add_new_item'        => __( 'Lägg till nytt översättningsprojekt', 'wpsvse' ),
		'add_new'             => __( 'Nytt projekt', 'wpsvse' ),
		'new_item'            => __( 'Lägg till nytt översättningsprojekt', 'wpsvse' ),
		'edit_item'           => __( 'Redigera översättningsprojekt', 'wpsvse' ),
		'update_item'         => __( 'Uppdatera översättningsprojekt', 'wpsvse' ),
		'view_item'           => __( 'Visa översättningsprojekt', 'wpsvse' ),
		'search_items'        => __( 'Sök översättningsprojekt', 'wpsvse' ),
		'not_found'           => __( 'Inga översättningsprojekt kunde hittas', 'wpsvse' ),
		'not_found_in_trash'  => __( 'Inga översättningsprojekt kunde hittas i papperskorgen', 'wpsvse' ),
	);
	$rewrite = array(
		'slug'                => 'oversattningsprojekt',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'Översättningsprojekt', 'wpsvse' ),
		'description'         => __( 'Anpassad posttyp för översättningsprojekt', 'wpsvse' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'custom-fields', ),
		'taxonomies'          => array( 'wpsvse_project_type' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => 'edit.php?post_type=wpsvse_translators',
		'menu_position'       => 25,
		'menu_icon'           => 'dashicons-clipboard',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'wpsvse_projects', $args );

}

/**
 * Set admin sub menu for projects.
 */
add_action('admin_menu', 'wpsvse_translations_menu'); 
function wpsvse_translations_menu() { 
    add_submenu_page('edit.php?post_type=wpsvse_translators', 'Lägg till nytt projekt', 'Nytt Projekt', 'manage_options', 'post-new.php?post_type=wpsvse_projects');
		add_submenu_page('edit.php?post_type=wpsvse_translators', 'Projekttyper', 'Projekttyper', 'manage_options', 'edit-tags.php?taxonomy=wpsvse_project_type&post_type=wpsvse_projects');
}

/**
 * Register custom taxonomy for project types.
 */
 
add_action( 'init', 'wpsvse_tax_projecttype', 0 );

function wpsvse_tax_projecttype() {

	$labels = array(
		'name'                       => _x( 'Projekttyper', 'Taxonomy General Name', 'wpsvse' ),
		'singular_name'              => _x( 'Projekttyp', 'Taxonomy Singular Name', 'wpsvse' ),
		'menu_name'                  => __( 'Projekttyp', 'wpsvse' ),
		'all_items'                  => __( 'Alla projekttyper', 'wpsvse' ),
		'parent_item'                => __( 'Överordnad projekttyp', 'wpsvse' ),
		'parent_item_colon'          => __( 'Överordnad projekttyp:', 'wpsvse' ),
		'new_item_name'              => __( 'Nytt projektnamn', 'wpsvse' ),
		'add_new_item'               => __( 'Lägg till projekttyp', 'wpsvse' ),
		'edit_item'                  => __( 'Redigera projekttyp', 'wpsvse' ),
		'update_item'                => __( 'Uppdatera projekttyp', 'wpsvse' ),
		'view_item'                  => __( 'Visa projekttyp', 'wpsvse' ),
		'separate_items_with_commas' => __( 'Separera flera projekttyper med kommatecken', 'wpsvse' ),
		'add_or_remove_items'        => __( 'Lägg till eller ta bort typer', 'wpsvse' ),
		'choose_from_most_used'      => __( 'Välj bland dom mest använda', 'wpsvse' ),
		'popular_items'              => __( 'Populära projekttyper', 'wpsvse' ),
		'search_items'               => __( 'Sök projekttyper', 'wpsvse' ),
		'not_found'                  => __( 'Kunde inte hittas', 'wpsvse' ),
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
	register_taxonomy( 'wpsvse_project_type', array( 'wpsvse_projects' ), $args );

}

/**
 * Register custom post type for translation projects
 * separated from WPs regular posts.
 */
add_action( 'init', 'wpsvse_cpt_translators', 0 );

function wpsvse_cpt_translators() {

	$labels = array(
		'name'                => _x( 'Översättare', 'Post Type General Name', 'wpsvse' ),
		'singular_name'       => _x( 'Översättare', 'Post Type Singular Name', 'wpsvse' ),
		'menu_name'           => __( 'Översättare', 'wpsvse' ),
		'name_admin_bar'      => __( 'Översättare', 'wpsvse' ),
		'parent_item_colon'   => __( 'Parent Item:', 'wpsvse' ),
		'all_items'           => __( 'Alla översättare', 'wpsvse' ),
		'add_new_item'        => __( 'Lägg till ny översättare', 'wpsvse' ),
		'add_new'             => __( 'Ny översättare', 'wpsvse' ),
		'new_item'            => __( 'Ny översättare', 'wpsvse' ),
		'edit_item'           => __( 'Redigera översättare', 'wpsvse' ),
		'update_item'         => __( 'Uppdatera översättare', 'wpsvse' ),
		'view_item'           => __( 'Visa översättare', 'wpsvse' ),
		'search_items'        => __( 'Sök översättare', 'wpsvse' ),
		'not_found'           => __( 'Inga översättare kunde hittas', 'wpsvse' ),
		'not_found_in_trash'  => __( 'Inga översättare kunde hittas i papperskorgen', 'wpsvse' ),
	);
	$rewrite = array(
		'slug'                => 'oversattare',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'Översättare', 'wpsvse' ),
		'description'         => __( 'Anpassad posttyp för översättare och tillhörande information', 'wpsvse' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'revisions', 'custom-fields', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 25,
		'menu_icon'           => 'dashicons-translation',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'wpsvse_translators', $args );

}

/**
 * Show appropiate title placeholder for translators
 */
function wpsvse_change_title_text_translators( $title ){
     $screen = get_current_screen();
 
     if  ( 'wpsvse_translators' == $screen->post_type ) {
          $title = 'Ange översättarens namn i form av användarnamn på wordpress.org ';
     }
 
     return $title;
}
 
add_filter( 'enter_title_here', 'wpsvse_change_title_text_translators' );

/**
 * Show appropiate title placeholder for project
 */
function wpsvse_change_title_text_projects( $title ){
     $screen = get_current_screen();
 
     if  ( 'wpsvse_projects' == $screen->post_type ) {
          $title = 'Ange projektnamn som det visas på wordpress.org';
     }
 
     return $title;
}
 
add_filter( 'enter_title_here', 'wpsvse_change_title_text_projects' );

/**
 * Get the bootstrap for CMB2!
 */
if ( file_exists(  get_stylesheet_directory_uri() .'/inc/cmb2/init.php' ) ) {
	require_once  get_stylesheet_directory_uri() .'/inc/cmb2/init.php';
} elseif ( file_exists(  __DIR__ .'/cmb2/init.php' ) ) {
	require_once  __DIR__ .'/cmb2/init.php';
}

/**
 * Add metaboxes for easy editing in admin (translators)
 */
add_action( 'cmb2_admin_init', 'wpsvse_translator_meta' );
function wpsvse_translator_meta() {

	$prefix = '_wpsvse_translator_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'translator_metabox',
		'title'        => __( 'Uppgifter för översättare', 'wpsvse' ),
		'object_types' => array( 'wpsvse_translators' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb->add_field( array(
		'name' => __( 'Användarnamn på wpsv.se', 'wpsvse' ),
		'id' => $prefix . 'user_se',
		'type' => 'text_medium',
		'desc' => __( 'Användarnamn på WordPress Sverige. Används för erkännande och kontaktväg för andra översättare.', 'wpsvse' ),
	) );

	$cmb->add_field( array(
		'name' => __( 'Namn', 'wpsvse' ),
		'id' => $prefix . 'validator_name',
		'type' => 'text_medium',
		'desc' => __( 'Ange namnet på den som skickat förfrågan om valideringsroll. (Visas inte offentligt).', 'wpsvse' ),
	) );

	$cmb->add_field( array(
		'name' => __( 'E-post', 'wpsvse' ),
		'id' => $prefix . 'validator_email',
		'type' => 'text_email',
		'desc' => __( 'Ange e-postadress för den som skickat in förfrågan om valideringsroll. (Visas inte offentligt).', 'wpsvse' ),
	) );

}

/**
 * Add metaboxes for easy editing in admin (projects)
 */
add_action( 'cmb2_admin_init', 'wpsvse_project_meta' );
function wpsvse_project_meta() {

	$prefix = '_wpsvse_project_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'project_metabox',
		'title'        => __( 'Meta för översättningsprojekt', 'wpsvse' ),
		'object_types' => array( 'wpsvse_projects' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb->add_field( array(
		'name' => __( 'Projekttyp', 'wpsvse' ),
		'id' => $prefix . 'type',
		'type'     => 'taxonomy_radio',
		'taxonomy' => 'wpsvse_project_type',
		'inline'  => true,
		'desc' => __( 'Typ av översättningsproject på wordpress.org.', 'wpsvse' ),
	) );
	
	$cmb->add_field( array(
		'name' => __( 'ID för project', 'wpsvse' ),
		'id' => $prefix . 'project-id',
		'type' => 'text_medium',
		'desc' => __( 'Ange den unika delen av urlen för projektet. Ex. <code>https://translate.wordpress.org/locale/sv/default/wp-plugins/<strong style="color:#F00;">bbpress</strong>/</code> eller <code>https://wordpress.org/plugins/<strong style="color:#F00;">bbpress</strong>/</code> här är <code>bbpress</code> projektets unika ID.', 'wpsvse' ),
	) );

}

/**
 * Set dynamic select options for projects
 */
add_filter('frm_setup_new_fields_vars', 'wpsvse_set_projects_select', 20, 2);
add_filter('frm_setup_edit_fields_vars', 'wpsvse_set_projects_select', 20, 2); // use this function on edit too

function wpsvse_set_projects_select($values, $field){

if( $field->id == 180 ){ // ID of the field to populate
		$posts = get_posts( array('post_type' => 'wpsvse_projects', 'post_status' => array('publish'),  'numberposts' => 999, 'orderby' => 'title', 'order' => 'ASC'));
		unset($values['options']);
		$values['options'][''] = 'Välj projekt&hellip;';
		foreach($posts as $p){
			$values['options'][$p->ID] = $p->post_title;
		}
		$values['use_key'] = true; // save the post ID instead of post title
}

return $values;
}

/**
 * Set dynamic select options for translators
 */
add_filter('frm_setup_new_fields_vars', 'wpsvse_set_translators_select', 20, 2);
add_filter('frm_setup_edit_fields_vars', 'wpsvse_set_translators_select', 20, 2); // use this function on edit too

function wpsvse_set_translators_select($values, $field){

if( $field->id == 187 ){ // ID of the field to populate
		$posts = get_posts( array('post_type' => 'wpsvse_translators', 'post_status' => array('publish'),  'numberposts' => 999, 'orderby' => 'title', 'order' => 'ASC'));
		unset($values['options']);
		$values['options'][''] = 'Välj validerare&hellip;';
		foreach($posts as $p){
			$values['options'][$p->ID] = $p->post_title;
		}
		$values['use_key'] = true; // save the post ID instead of post title
}

return $values;
}

/**
 * Get both title and ID of project in form
 */
add_filter('frm_validate_field_entry', 'wpsvse_get_project_title', 10, 3);
function wpsvse_get_project_title($errors, $posted_field, $posted_value){
  if ( $posted_field->id == 198 ) { // field to change
		$titleid = $_POST['item_meta'][180]; // field to copy
		$projecttitle = get_the_title( $titleid );
    $_POST['item_meta'][$posted_field->id] = $projecttitle; 
  }
	if ( $posted_field->id == 206) { // field to change
		$titleid = $_POST['item_meta'][187]; // field to copy
		$translatortitle = get_the_title( $titleid );
    $_POST['item_meta'][$posted_field->id] = $translatortitle; 
  }
  return $errors;
}

/**
 * Create dynamic connection between translator and project
 */
function create_dynamic_post_connection($entry_id, $form_id){
	if ($form_id == 10){
    if (!empty( $_POST['item_meta'][195] )){
    	// get project ID
    	$project_id = $_POST['item_meta'][195];
		} else {
			// get project ID
    	$project_id = $_POST['item_meta'][197];
		} 
		if (!empty( $_POST['item_meta'][107] )){   	
			// get ID of post to be created
			global $frmdb;
    	$translator_id = $frmdb->get_var( $frmdb->entries, array('id' => $entry_id), 'post_id' );
		} else {
			// get translator ID
			$translator_id = $_POST['item_meta'][187];
		}
		// Create connection
		p2p_create_connection( 'translator_to_projects', array(
					'from' => $translator_id,
					'to' => $project_id,
					'meta' => array(
							'date' => current_time('mysql')
					)
		) );
  }
}
add_filter('frm_after_create_entry', 'create_dynamic_post_connection', 50, 2);

/**
 * Create a connection between post types
 */
function wpsvse_connection_types() {
		if ( !function_exists( 'p2p_register_connection_type' ) )
    	return;
 
    p2p_register_connection_type( array(
        'name' => 'translator_to_projects',
        'from' => 'wpsvse_translators',
        'to' => 'wpsvse_projects',
				'title' => array(
					'from' => __( 'Associera projekt', 'wpsvse' ),
					'to' => __( 'Associera översättare', 'wpsvse' )
				),
				'admin_box' => array(
					'context' => 'advanced',
				),
				'from_labels' => array(
						'singular_name' => __( 'Associera projekt', 'wpsvse' ),
						'create' => __( 'Skapa association', 'wpsvse' ),
				),
				'to_labels' => array(
						'singular_name' => __( 'Associera översättare', 'wpsvse' ),
						'create' => __( 'Skapa association', 'wpsvse' ),
				),
    ) );
		
}
add_action( 'p2p_init', 'wpsvse_connection_types' );
