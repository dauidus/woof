<?php
/**
 * Ajax functions for the Menu Customizer.
 */

/**
 * Ajax handler for adding a new menu.
 *
 * @since Menu Customizer 0.0.
 */
function menu_customizer_new_menu_ajax() {
	check_ajax_referer( 'customize-menus', 'customize-nav-menu-nonce' );

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_die( -1 );
	}

	$menu_name = sanitize_text_field( $_POST['menu-name'] );

	// Create the menu.
	$menu_id = wp_create_nav_menu( $menu_name );

	if ( is_wp_error( $menu_id ) ) {
		// @todo error handling, ideally providing user feedback (most likely case here is a duplicate menu name).
		wp_die();
	}

	// Output the markup for this new menu.
	menu_customizer_render_new_menu( $menu_id, $menu_name );

	wp_die();
}
add_action( 'wp_ajax_add-nav-menu-customizer', 'menu_customizer_new_menu_ajax');

/**
 * Ajax handler for deleting a menu.
 *
 * @since Menu Customizer 0.0.
 */
function menu_customizer_delete_menu_ajax() {
	check_ajax_referer( 'customize-menus', 'customize-nav-menu-nonce' );

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_die( -1 );
	}

	$menu_id = absint( $_POST['menu_id'] );

	if ( is_nav_menu( $menu_id ) ) {
		$deletion = wp_delete_nav_menu( $menu_id );
		if ( is_wp_error( $deletion ) ) {
			echo $deletion->message();
		}
	} else {
		echo __( 'Error: invalid menu to delete.' );
	}

	wp_die();
}
add_action( 'wp_ajax_delete-menu-customizer', 'menu_customizer_delete_menu_ajax' );

/**
 * Ajax handler for updating a menu item.
 *
 * @since Menu Customizer 0.0.
 */
function menu_customizer_update_item_ajax() {
	check_ajax_referer( 'customize-menus', 'customize-menu-item-nonce' );

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_die( -1 );
	}

	$clone = $_POST['clone'];
	$item_id = $_POST['item_id'];
	$menu_item_data = (array) $_POST['menu-item'];

	$id = menu_customizer_update_menu_item( 0, $item_id, $menu_item_data, $clone );

	if ( ! is_wp_error( $id ) ) {
		echo $id;
	}

	wp_die();
}
add_action( 'wp_ajax_update-menu-item-customizer', 'menu_customizer_update_item_ajax');

/**
 * Ajax handler for adding a menu item. Based on wp_ajax_add_menu_item().
 *
 * @since Menu Customizer 0.0.
 */
function menu_customizer_add_item_ajax() {
	check_ajax_referer( 'customize-menus', 'customize-menu-item-nonce' );

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_die( -1 );
	}

	require_once ABSPATH . 'wp-admin/includes/nav-menu.php';

	$menu_item_data = (array) $_POST['menu-item'];
	$menu_id = absint( $_POST['menu'] ); // Used only for display, new item is created as an orphan - menu id of 0.
	$id = 0;

	// For performance reasons, we omit some object properties from the checklist.
	// The following is a hacky way to restore them when adding non-custom items.
	// @todo: do we really need this - do we need to populate the description field here?

	if ( ! empty( $menu_item_data['obj_type'] ) &&
		'custom' != $menu_item_data['obj_type'] &&
		! empty( $menu_item_data['id'] )
	) {
		switch( $menu_item_data['obj_type'] ) {
			case 'post_type' :
				$id = absint( str_replace( 'post-', '', $menu_item_data['id'] ) );
				$_object = get_post( $id );
			break;

			case 'taxonomy' :
				$id = absint( str_replace( 'term-', '', $menu_item_data['id'] ) );
				$_object = get_term( $id, $menu_item_data['type'] );
			break;
		}

		$_menu_items = array_map( 'wp_setup_nav_menu_item', array( $_object ) );
		$_menu_item = array_shift( $_menu_items );

		// Restore the missing menu item properties
		$menu_item_data['menu-item-description'] = $_menu_item->description;
	}

	// Make the "Home" item into the custom link that it actually is.
	if ( 'page' == $menu_item_data['type'] && 'custom' == $menu_item_data['obj_type'] ) {
		$menu_item_data['type'] = 'custom';
		$menu_item_data['url'] = home_url('/');
	}

	// Map data from menu customizer keys to nav-menus.php keys.
	$item_data = array(
		'menu-item-db-id' => 0,
		'menu-item-object-id' => $id,
		'menu-item-object' => ( isset( $menu_item_data['type'] ) ? $menu_item_data['type'] : '' ),
		'menu-item-type' => ( isset( $menu_item_data['obj_type'] ) ? $menu_item_data['obj_type'] : '' ),
		'menu-item-title' => ( isset( $menu_item_data['name'] ) ? $menu_item_data['name'] : '' ),
		'menu-item-url' => ( isset( $menu_item_data['url'] ) ? $menu_item_data['url'] : '' ),
		'menu-item-description' => ( isset( $menu_item_data['menu-item-description'] ) ? $menu_item_data['menu-item-description'] : '' ),
	);

	// `wp_save_nav_menu_items` requires `menu-item-db-id` to not be set for custom items.
	if ( 'custom' == $item_data['menu-item-type'] ) {
		unset( $item_data['menu-item-db-id'] );
	}

	$item_ids = wp_save_nav_menu_items( 0, array( 0 => $item_data ) );
	if ( is_wp_error( $item_ids ) || empty( $item_ids ) ) {
		wp_die( 0 );
	}

	$item = get_post( $item_ids[0] );
	if ( ! empty( $item->ID ) ) {
		$item = wp_setup_nav_menu_item( $item );
		$item->label = $item->title; // Don't show "(pending)" in ajax-added items.
	}

	// Output the markup for this item.
	menu_customizer_render_item_control( $item, $menu_id, 0 );

	wp_die();
}
add_action( 'wp_ajax_add-menu-item-customizer', 'menu_customizer_add_item_ajax' );
