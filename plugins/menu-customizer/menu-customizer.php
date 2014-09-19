<?php
/**
 * Plugin Name: Menu Customizer
 * Plugin URI: http://wordpress.org/plugins/menu-customizer
 * Description: Manage your Menus in the Customizer. GSoC Project & WordPress core feature-plugin.
 * Version: 0.1
 * Author: Nick Halsey
 * Author URI: http://nick.halsey.co/
 * Tags: menus, custom menus, customizer, theme customizer, gsoc
 * License: GPL

=====================================================================================
Copyright (C) 2014 Nick Halsey

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with WordPress; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
=====================================================================================
*/

if ( is_admin() && defined( 'DOING_AJAX' ) && DOING_AJAX ) {
	require_once( plugin_dir_path( __FILE__ ) . '/menu-customize-ajax.php' );
}

/**
 * Enqueue sripts and styles.
 *
 * @since Menu Customizer 0.0
 */
function menu_customizer_enqueue() {
	wp_enqueue_style( 'menu-customizer', plugin_dir_url( __FILE__ ) . 'menu-customizer.css' );
	wp_enqueue_script( 'menu-customizer-options', plugin_dir_url( __FILE__ ) . 'menu-customizer-options.js', array( 'jquery' ) );
	wp_enqueue_script( 'menu-customizer', plugin_dir_url( __FILE__ ) . 'menu-customizer.js', array( 'jquery', 'wp-backbone', 'customize-controls' ) );

	global $wp_scripts;

	// Pass data to JS.
	$settings = array(
		'nonce'              => wp_create_nonce( 'customize-menus' ),
		'allMenus'           => wp_get_nav_menus(),
		'availableMenuItems' => menu_customizer_available_items(),
		'itemTypes'          => menu_customizer_available_item_types(),
		'l10n'               => array(
			'untitled'     => _x( '(no label)', 'Missing menu item navigation label.' ),
			'custom_label' => _x( 'Custom', 'Custom menu item type label.' ),
			'deleteWarn'   => __( 'You are about to permanently delete this menu. "Cancel" to stop, "OK" to delete. ' ),
		),
	);

	$data = sprintf( 'var _wpCustomizeMenusSettings = %s;', json_encode( $settings ) );
	$wp_scripts->add_data( 'menu-customizer', 'data', $data );
}
add_action( 'customize_controls_enqueue_scripts', 'menu_customizer_enqueue' );

/**
 * Add the customizer settings and controls.
 *
 * @since Menu Customizer 0.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function menu_customizer_customize_register( $wp_customize ) {
	require_once( plugin_dir_path( __FILE__ ) . '/menu-customize-controls.php' );

	// Create a panel for Menus.
	$wp_customize->add_panel( 'menus', array(
		'title'       => __( 'Menus' ),
		'description' => __( '<p>This panel is used for managing your custom navigation menus. You can add pages, posts, categories, tags, and custom links to your menus.</p><p>Menus can be displayed in locations defined by your theme, and also used in sidebars by adding a "Custom Menu" widget in the Widgets panel.</p>' ),
		'priority'    => 30,
	) );

	// Rebrand the existing "Navigation" section to the global theme locations section.
	$locations = get_registered_nav_menus();
	$num_locations = count( array_keys( $locations ) );
	$description = sprintf( _n( 'Your theme contains %s menu location. Select which menu you would like to use.', 'Your theme contains %s menu locations. Select which menu appears in each location.', $num_locations ), number_format_i18n( $num_locations ) );
	$description .= '<br>' . __( 'You can also place menus in widget areas with the Custom Menu widget.' );

	$wp_customize->get_section( 'nav' )->title = __( 'Theme Locations' );
	$wp_customize->get_section( 'nav' )->description = $description;
	$wp_customize->get_section( 'nav' )->priority = 5;
	$wp_customize->get_section( 'nav' )->panel = 'menus';

	// Add the screen options control to the existing "Navigation" section (it gets moved around in the JS).
	$wp_customize->add_setting( 'menu_customizer_options', array(
		'type' => 'menu_options',
	) );
	$wp_customize->add_control( new WP_Menu_Options_Customize_Control( $wp_customize, 'menu_customizer_options', array(
		'section'  => 'nav',
		'priority' => 20,
	) ) );

	// Register each custom menu as a Customizer section, and add each menu item to each menu.
	$menus = wp_get_nav_menus();

	foreach ( $menus as $menu ) {
		$menu_id = $menu->term_id;

		// Create a section for each menu.
		$section_id = 'nav_menus[' . $menu_id . ']';
		$wp_customize->add_section( $section_id , array(
			'title'    => $menu->name,
			'priority' => 10,
			'panel'     => 'menus',
		) );

		// Add a setting & control for the menu name.
		$menu_name_setting_id = $section_id . '[name]';
		$wp_customize->add_setting( $menu_name_setting_id, array(
			'default'           => $menu->name,
			'type'              => 'menu_name',
		) );

		$wp_customize->add_control( $menu_name_setting_id, array(
			'label'    => '',
			'section'  => $section_id,
			'type'     => 'text',
			'priority' => 0,
			'input_attrs' => array(
				'class' => 'menu-name-field live-update-section-title',
			),
		) );

		// Add the menu contents.
		$menu_items = wp_get_nav_menu_items( $menu_id );
		$item_ids = array();
		foreach( $menu_items as $i => $item ) {
			$item_ids[] = $item->ID;

			// Create a setting for each menu item (which doesn't actually manage data, currently).
			$menu_item_setting_id = $section_id . '[' . $item->ID . ']';
			$wp_customize->add_setting( $menu_item_setting_id, array(
				'type' => 'option',
				'default' => array(),
			) );

			// Create a control for each menu item.
			$wp_customize->add_control( new WP_Menu_Item_Customize_Control( $wp_customize, $menu_item_setting_id, array(
				'label'       => $item->title,
				'section'     => $section_id,
				'priority'    => 10 + $i,
				'menu_id'     => $menu_id,
				'item'        => $item,
				'type'        => 'menu_item',
			) ) );
		}

		// Add the menu control, which handles adding and ordering.
		$nav_menu_setting_id = 'nav_menu_' . $menu_id;
		$wp_customize->add_setting( $nav_menu_setting_id, array(
			'type'    => 'nav_menu',
			'default' => $item_ids,
		) );

		$wp_customize->add_control( new WP_Menu_Customize_Control( $wp_customize, $nav_menu_setting_id, array(
			'section'  => $section_id,
			'menu_id'  => $menu_id,
			'priority' => 998,
		) ) );

		// Add the auto-add new pages option.
		$auto_add = get_option( 'nav_menu_options' );
		if ( ! isset( $auto_add['auto_add'] ) ) {
			$auto_add = false;
		}
		elseif ( false !== array_search( $menu_id, $auto_add['auto_add'] ) ) {
			$auto_add = true;
		}
		else {
			$auto_add = false;
		}

		$menu_autoadd_setting_id = $section_id . '[auto_add]';
		$wp_customize->add_setting( $menu_autoadd_setting_id, array(
			'type'    => 'menu_autoadd',
			'default' => $auto_add,
		) );

		$wp_customize->add_control( $menu_autoadd_setting_id, array(
			'label'    => __( 'Automatically add new top-level pages to this menu.' ),
			'section'  => $section_id,
			'type'     => 'checkbox',
			'priority' => 999,
		) );
	}

	// Add the add-new-menu section and controls.
	$wp_customize->add_section( 'add_menu', array(
		'title'    => __( 'New Menu' ),
		'panel'    => 'menus',
		'priority' => 99,
	) );

	$wp_customize->add_setting( 'new_menu_name', array(
		'type' => 'new_menu', // Prevent this from being saved anywhere.
		'default' => '',
	) );
	$wp_customize->add_control( 'new_menu_name', array(
		'label'    => '',
		'section'  => 'add_menu',
		'type'     => 'text',
		'input_attrs' => array(
			'class' => 'menu-name-field',
			'placeholder' => __( 'New menu name' ),
		),
	) );

	$wp_customize->add_setting( 'create_new_menu', array(
		'type' => 'new_menu',
	) );
	$wp_customize->add_control( new WP_New_Menu_Customize_Control( $wp_customize, 'create_new_menu', array(
		'section' => 'add_menu',
	) ) );
}
add_action( 'customize_register', 'menu_customizer_customize_register', 11 ); // Needs to run after core Navigation section is set up.

/**
 * Save the Menu Name when it's changed.
 *
 * Menu Name is not previewed because it's designed primarily for admin uses.
 *
 * @since Menu Customizer 0.0
 *
 * @param mixed                $value   Value of the setting.
 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
 */
function menu_customizer_update_menu_name( $value, $setting ) {
	if ( ! $value || ! $setting ) {
		return;
	}

	// Get the menu id from the setting id.
	$id = str_replace( 'nav_menus[', '', $setting->id );
	$id = str_replace( '][name]', '', $id );

	if ( 0 == $id ) {
		return; // Avoid creating a new, empty menu.
	}

	// Update the menu name with the new $value.
	wp_update_nav_menu_object( $id, array( 'menu-name' => trim( esc_html( $value ) ) ) );
}
add_action( 'customize_update_menu_name', 'menu_customizer_update_menu_name', 10, 2 );

/**
 * Update the `auto_add` nav menus option.
 *
 * Auto-add is not previewed because it is administration-specific.
 *
 * @since Menu Customizer 0.0
 *
 * @param mixed                $value   Value of the setting.
 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
 */
function menu_customizer_update_menu_autoadd( $value, $setting ) {
	if ( ! $setting ) {
		return;
	}

	// Get the menu id from the setting id.
	$id = str_replace( 'nav_menus[', '', $setting->id );
	$id = absint( str_replace( '][auto_add]', '', $id ) );

	if ( ! $id ) {
		return;
	}

	$nav_menu_option = (array) get_option( 'nav_menu_options' );
	if ( ! isset( $nav_menu_option['auto_add'] ) ) {
		$nav_menu_option['auto_add'] = array();
	}
	if ( $value ) {
		if ( ! in_array( $id, $nav_menu_option['auto_add'] ) )
			$nav_menu_option['auto_add'][] = $id;
	} else {
		if ( false !== ( $key = array_search( $id, $nav_menu_option['auto_add'] ) ) ) {
			unset( $nav_menu_option['auto_add'][$key] );
		}
	}

	// Remove nonexistent/deleted menus.
	$nav_menu_option['auto_add'] = array_intersect( $nav_menu_option['auto_add'], wp_get_nav_menus( array( 'fields' => 'ids' ) ) );
	update_option( 'nav_menu_options', $nav_menu_option );
}
add_action( 'customize_update_menu_autoadd', 'menu_customizer_update_menu_autoadd', 10, 2 );

/**
 * Preview changes made to a nav menu.
 *
 * Filters nav menu display to show customized items in the customized order.
 *
 * @since Menu Customizer 0.0
 *
 * @param array                $value   Array of the menu items to preview, in order.
 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
 */
function menu_customizer_preview_nav_menu( $setting ) {

	$menu_id = str_replace( 'nav_menu_', '', $setting->id );

	// Ensure that $menu_id is valid.
	$menu_id = (int) $menu_id;
	$menu = wp_get_nav_menu_object( $menu_id );
	if ( ! $menu || ! $menu_id ) {
		return new WP_Error( 'invalid_menu_id', __( 'Invalid menu ID.' ) );
	}
	if ( is_wp_error( $menu ) ) {
		return $menu;
	}

	$menu_id = $menu->term_id;

	// @todo don't use a closure for PHP 5.2
	add_filter( 'wp_get_nav_menu_items', function( $items, $menu, $args ) use ( $menu_id, $setting ) {
		$preview_menu_id = $menu->term_id;
		if ( $menu_id == $preview_menu_id ) {
			$new_ids = $setting->post_value();
			$new_items = array();
			$i = 0;

			// For each item, get object and update menu order property.
			foreach ( $new_ids as $item_id ) {
				$item = get_post( $item_id );
				$item = wp_setup_nav_menu_item( $item );
				$item->menu_order = $i;
				$new_items[] = $item;
				$i++;
			}

			return $new_items;
		} else {
			return $items;
		}
	}, 10, 3 );
}

/**
 * Adds hooks for previewing each menu.
 *
 * Necessary because of a poorly thought-out hook in core.
 *
 * @link https://core.trac.wordpress.org/ticket/29165
 * Function can be replaced with //	add_action( 'customize_preview_nav_menu', 'menu_customizer_preview_nav_menu', 10, 1 );
 */
function menu_customizer_setup_menu_previewing() {
	$menus = wp_get_nav_menus();

	foreach ( $menus as $menu ) {
		$menu_id = $menu->term_id;

		$setting_id = 'nav_menu_' . $menu_id;
		add_action( 'customize_preview_' . $setting_id, 'menu_customizer_preview_nav_menu', 10, 1 );
	}
}
add_action( 'customize_register', 'menu_customizer_setup_menu_previewing' );

/**
 * Save changes made to a nav menu.
 *
 * Assigns cloned & modified items to this menu, publishing them.
 * Updates the order of all items in the menu.
 *
 * @since Menu Customizer 0.0
 *
 * @param array                $value   Ordered array of the new menu item ids.
 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
 */
function menu_customizer_update_nav_menu( $value, $setting ) {
	$menu_id = str_replace( 'nav_menu_', '', $setting->id );

	// Ensure that $menu_id is valid.
	$menu_id = (int) $menu_id;
	$menu = wp_get_nav_menu_object( $menu_id );
	if ( ! $menu || ! $menu_id ) {
		return new WP_Error( 'invalid_menu_id', __( 'Invalid menu ID.' ) );
	}
	if ( is_wp_error( $menu ) ) {
		return $menu;
	}

	// Get original items in this menu. Any that aren't there anymore need to be deleted.
	$originals = wp_get_nav_menu_items( $menu_id );
	// Convert to just an array of ids.
	$original_ids = array();
	foreach ( $originals as $item ) {
		$original_ids[] = $item->ID;
	}

	$items = $value; // Ordered array of item ids.

	if ( $original_ids === $items ) {
		// This menu is completely unchanged - don't need to do anything else.
		return $value;
	}

	// Are there removed items that need to be deleted?
	// This will also include any items that have been cloned.
	$old_items = array_diff( $original_ids, $items );

	$i = 1;
	foreach( $items as $item_id ) {
		// Assign the existing item to this menu, in case it's orphaned. Update the order, regardless.
		menu_customizer_update_menu_item_order( $menu_id, $item_id, $i );
		$i++;
	}

	foreach( $old_items as $item_id ) {
		if( is_nav_menu_item( $item_id ) ) {
			wp_delete_post( $item_id, true );
		}
	}
}
add_action( 'customize_update_nav_menu', 'menu_customizer_update_nav_menu', 10, 2 );

/**
 * Updates the order for and publishes an existing menu item.
 *
 * Skips the mess that is wp_update_nav_menu_item() and avoids
 * handling menu item fields that are not changed.
 *
 * Based on the parts of wp_update_nav_menu_item() that are needed here.
 * $menu_id must already be validated before running this function (to avoid re-validating for each item in the menu).
 *
 * @param int $menu_id The valid ID of the menu.
 * @param int $item_id The ID of the (existing) menu item.
 * @param int $order   The menu item's new order/position.
 * @return int|WP_Error The menu item's database ID or WP_Error object on failure.
 */
function menu_customizer_update_menu_item_order( $menu_id, $item_id, $order ) {
	$item_id = (int) $item_id;

	// Make sure that we don't convert non-nav_menu_item objects into nav_menu_item objects.
	if ( ! is_nav_menu_item( $item_id ) ) {
		return new WP_Error( 'update_nav_menu_item_failed', __( 'The given object ID is not that of a menu item.' ) );
	}

	// Associate the menu item with the menu term.
	// Only set the menu term if it isn't set to avoid unnecessary wp_get_object_terms().
	 if ( $menu_id && ! is_object_in_term( $item_id, 'nav_menu', (int) $menu_id ) ) {
		wp_set_object_terms( $item_id, array( $menu_id ), 'nav_menu' );
	}

	// Populate the potentially-changing fields of the menu item object.
	$post = array(
		'ID'          => $item_id,
		'menu_order'  => $order,
		'post_status' => 'publish'
	);

	// Update the menu item object.
	wp_update_post( $post );

	return $item_id;
}

/**
 * Update properties of a nav menu item, with the option to create a clone of the item.
 *
 * Wrapper for wp_update_nav_menu_item() that only requires passing changed properties.
 *
 * @link https://core.trac.wordpress.org/ticket/28138
 *
 * @since Menu Customizer 0.0
 *
 * @param int   $menu_id The ID of the menu. If "0", makes the menu item a draft orphan.
 * @param int   $item_id The ID of the menu item. If "0", creates a new menu item.
 * @param array $data    The new data for the menu item.
 * @param bool  $clone   If true, creates a copy of the item and only changes the copy.
 * @return int|WP_Error The menu item's database ID or WP_Error object on failure.
 */
function menu_customizer_update_menu_item( $menu_id, $item_id, $data, $clone = false ) {
	$item = get_post( $item_id );
	$item = wp_setup_nav_menu_item( $item );
    $defaults = array(
		'menu-item-db-id' => $item_id,
		'menu-item-object-id' => $item->object_id,
		'menu-item-object' => $item->object,
		'menu-item-parent-id' => $item->menu_item_parent,
		'menu-item-position' => $item->menu_order,
		'menu-item-type' => $item->type,
		'menu-item-title' => $item->title,
		'menu-item-url' => $item->url,
		'menu-item-description' => $item->description,
		'menu-item-attr-title' => $item->attr_title,
		'menu-item-target' => $item->target,
		'menu-item-classes' => implode( ' ', $item->classes ),
		'menu-item-xfn' => $item->xfn,
		'menu-item-status' => $item->publish,
	);

	$args = wp_parse_args( $data, $defaults );

	if ( $clone ) {
		$item_id = 0;
	}

	return wp_update_nav_menu_item( $menu_id, $item_id, $args );
}

/**
 * Return all potential menu items.
 *
 * @todo: pagination and lazy-load, rather than loading everything at once.
 *
 * @since Menu Customizer 0.0
 *
 * @return array All potential menu items' names, object ids, and types.
 */
function menu_customizer_available_items() {
	$items = array();

	$post_types = get_post_types( array( 'show_in_nav_menus' => true ), 'object' );

	if ( ! $post_types ) {
		return;
	}

	foreach ( $post_types as $post_type ) {
		if ( $post_type ) {
			$args = array(
				'posts_per_page'   => -1,
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'post_type'        => $post_type->name,
			);
			$allposts = get_posts( $args );
			foreach ( $allposts as $post ) {
				$items[] = array(
					'id'         => 'post-' . $post->ID,
					'name'       => $post->post_title,
					'type'       => $post_type->name,
					'type_label' => $post_type->labels->singular_name,
					'obj_type'   => 'post_type',
					'order'      => strtotime( $post->post_modified ), // Posts are orderd by time updated.
				);
			}
		}
	}

	$taxonomies = get_taxonomies( array( 'show_in_nav_menus' => true ), 'object' );

	if ( $taxonomies ) {
		foreach ( $taxonomies as $tax ) {
			if ( $tax ) {
				$name = $tax->name;
				$args = array(
					'child_of' => 0,
					'exclude' => '',
					'hide_empty' => false,
					'hierarchical' => 1,
					'include' => '',
					'number' => 0,
					'offset' => 0,
					'order' => 'ASC',
					'orderby' => 'name',
					'pad_counts' => false,
				);
				$terms = get_terms( $name, $args );

				foreach ( $terms as $term ) {
					$items[] = array(
						'id'         => 'term-' . $term->term_id,
						'name'       => $term->name,
						'type'       => $name,
						'type_label' => $tax->labels->singular_name,
						'obj_type'   => 'taxonomy',
						'order'       => $term->count, // Terms are ordered by count; will always be after all posts when combined.
					);
				}
			}
		}
	}

	// Add "Home" link. Treat as a page, but switch to custom on add.
	$home = array(
		'id'         => 0,
		'name'       => _x( 'Home', 'nav menu home label' ),
		'type'       => 'page',
		'type_label' => __( 'Page' ),
		'obj_type'   => 'custom',
		'order'      => time(), // Will be the first item.
	);
	$items[] = $home;

	return $items;
}

function menu_customizer_available_item_types() {
	$types = get_post_types( array( 'show_in_nav_menus' => true ), 'names' );
	$taxes = get_taxonomies( array( 'show_in_nav_menus' => true ), 'names' );
	return array_merge( $types, $taxes );
}

/**
 * Print the JavaScript templates used to render Menu Customizer components.
 *
 * Templates are imported into the JS using wp.template.
 *
 * @since Menu Customizer 0.0
 */
function menu_customizer_print_templates() {
	?>
	<script type="text/html" id="tmpl-available-menu-item">
		<div id="menu-item-tpl-{{ data.id }}" class="menu-item-tpl" data-menu-item-id="{{ data.id }}">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
					<span class="item-type">{{ data.type_label }}</span>
					<span class="item-title">{{ data.name }}</span>
					<a class="item-add" href="#">Add Menu Item</a>
				</dt>
			</dl>
		</div>
	</script>

	<script type="text/html" id="tmpl-available-menu-item-type">
		<div id="available-menu-items-{{ data.type }}" class="accordion-section">
			<h4 class="accordion-section-title">{{ data.type_label }}</h4>
			<div class="accordion-section-content">
			</div>
		</div>
	</script>

	<script type="text/html" id="tmpl-loading-menu-item">
		<li class="nav-menu-inserted-item-loading added-menu-item added-dbid-{{ data.id }} customize-control customize-control-menu_item nav-menu-item-wrap">
			<div class="menu-item menu-item-depth-0 menu-item-edit-inactive">
				<dl class="menu-item-bar">
					<dt class="menu-item-handle">
						<span class="spinner" style="display: block;"></span>
						<span class="item-type">{{ data.type_label }}</span>
						<span class="item-title menu-item-title">{{ data.name }}</span>
					</dt>
				</dl>
			</div>
		</li>
	</script>

	<script type="text/html" id="tmpl-menu-item-reorder-nav">
		<div class="menu-item-reorder-nav">
			<?php printf(
				'<span class="menus-move-up" tabindex="0">%1$s</span><span class="menus-move-down" tabindex="0">%2$s</span><span class="menus-move-left" tabindex="0">%3$s</span><span class="menus-move-right" tabindex="0">%4$s</span>',
				__( 'Move up' ),
				__( 'Move down' ),
				__( 'Move one level up' ),
				__( 'Move one level down' )
			); ?>
		</div>
	</script>
<?php
}
add_action( 'customize_controls_print_footer_scripts', 'menu_customizer_print_templates' );

/**
 * Print the html template used to render the add-menu-item frame.
 *
 * @since Menu Customizer 0.0
 */
function menu_customizer_available_items_template() {
?>
	<div id="available-menu-items" class="accordion-container">
		<div id="new-custom-menu-item" class="accordion-section">
			<h4 class="accordion-section-title"><?php _e( 'Links' ); ?></h4>
			<div class="accordion-section-content">
				<input type="hidden" value="custom" id="custom-menu-item-type" name="menu-item[-1][menu-item-type]" />
				<p id="menu-item-url-wrap">
					<label class="howto" for="custom-menu-item-url">
						<span>URL</span>
						<input id="custom-menu-item-url" name="menu-item[-1][menu-item-url]" type="text" class="code menu-item-textbox" value="http://">
					</label>
				</p>
				<p id="menu-item-name-wrap">
					<label class="howto" for="custom-menu-item-name">
						<span>Link Text</span>
						<input id="custom-menu-item-name" name="menu-item[-1][menu-item-title]" type="text" class="regular-text menu-item-textbox">
					</label>
				</p>
				<p class="button-controls">
					<span class="add-to-menu">
						<input type="submit" class="button-secondary submit-add-to-menu right" value="Add to Menu" name="add-custom-menu-item" id="custom-menu-item-submit">
						<span class="spinner"></span>
					</span>
				</p>
			</div>
		</div>
		<div id="available-menu-items-search" class="accordion-section">
			<div class="accordion-section-title">
				<label class="screen-reader-text" for="menu-items-search"><?php _e( 'Search Menu Items' ); ?></label>
				<input type="search" id="menu-items-search" placeholder="<?php esc_attr_e( 'Search menu items&hellip;' ) ?>" />
			</div>
			<div class="accordion-section-content">
			</div>
		</div>
		<?php

		// @todo: consider using add_meta_box/do_accordion_section and making screen-optional?

		// Containers for per-post-type item browsing; items added with JS.
		// @todo render these (and their contents) with JS, rather than here.
		$post_types = get_post_types( array( 'show_in_nav_menus' => true ), 'object' );
		if ( $post_types ) {
			foreach ( $post_types as $type ) {
				?>
				<div id="available-menu-items-<?php echo $type->name; ?>" class="accordion-section">
					<h4 class="accordion-section-title"><?php echo $type->label; ?></h4>
					<div class="accordion-section-content">
					</div>
				</div>
				<?php
			}
		}

		$taxonomies = get_taxonomies( array( 'show_in_nav_menus' => true ), 'object' );
		if ( $taxonomies ) {
			foreach ( $taxonomies as $tax ) {
				?>
				<div id="available-menu-items-<?php echo $tax->name; ?>" class="accordion-section">
					<h4 class="accordion-section-title"><?php echo $tax->label; ?></h4>
					<div class="accordion-section-content">
					</div>
				</div>
				<?php
			}
		}
		?>
	</div><!-- #available-menu-items -->
<?php
}
add_action( 'customize_controls_print_footer_scripts', 'menu_customizer_available_items_template' );

/**
 * Render a single menu item control.
 *
 * @param Object $item    The nav menu item to render.
 * @param int    $menu_id The item's menu id.
 * @param int    $depth   The depth of the menu item.
 */
function menu_customizer_render_item_control( $item, $menu_id, $depth ) {
	$item_id = $item->ID;

	$original_title = '';
	if ( 'taxonomy' == $item->type ) {
		$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
		if ( is_wp_error( $original_title ) ) {
			$original_title = false;
		}
	} elseif ( 'post_type' == $item->type ) {
		$original_object = get_post( $item->object_id );
		$original_title = get_the_title( $original_object->ID );
	}

	$classes = array(
		'menu-item menu-item-depth-' . $depth,
		'menu-item-' . esc_attr( $item->object ),
		'menu-item-edit-inactive',
	);

	$title = $item->title;
	if ( ! empty( $item->_invalid ) ) {
		$classes[] = 'menu-item-invalid';
		/* translators: %s: title of menu item which is invalid */
		$title = sprintf( __( '%s (Invalid)' ), $item->title );
	} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
		$classes[] = 'pending';
		/* translators: %s: title of menu item in draft status */
		$title = sprintf( __('%s (Pending)'), $item->title );
	}
	$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;
	?>
	<div id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>" data-item-depth="<?php echo $depth; ?>">
		<dl class="menu-item-bar">
			<dt class="menu-item-handle">
				<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
				<span class="item-title">
					<span class="spinner"></span>
					<span class="menu-item-title"><?php echo esc_html( $title ); ?></span>
					<span class="is-submenu"><?php _e( 'sub item' ); ?></span>
				</span>
				<span class="item-controls">
					<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e( 'Edit Menu Item' ); ?>" href="#"><?php _e( 'Edit Menu Item' ); ?></a>
				</span>
			</dt>
		</dl>

		<div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
			<?php if( 'custom' == $item->type ) : ?>
				<p class="field-url description description-thin">
					<label for="edit-menu-item-url-<?php echo $item_id; ?>">
						<?php _e( 'URL' ); ?><br />
						<input class="widefat code edit-menu-item-url" type="text" value="<?php echo esc_attr( $item->url ); ?>" id="edit-menu-item-url-<?php echo $item_id; ?>" name="menu-item-url"  />
					</label>
				</p>
			<?php endif; ?>
			<p class="description description-thin">
				<label for="edit-menu-item-title-<?php echo $item_id; ?>">
					<?php _e( 'Navigation Label' ); ?><br />
					<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title" value="<?php echo esc_attr( $item->title ); ?>" />
				</label>
			</p>
			<p class="field-link-target description description-thin">
				<label for="edit-menu-item-target-<?php echo $item_id; ?>">
					<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target"<?php checked( $item->target, '_blank' ); ?> />
					<?php _e( 'Open link in a new tab' ); ?>
				</label>
			</p>
			<p class="field-attr-title description description-thin">
				<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
					<?php _e( 'Title Attribute' ); ?><br />
					<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title" value="<?php echo esc_attr( $item->attr_title ); ?>" />
				</label>
			</p>
			<p class="field-css-classes description description-thin">
				<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
					<?php _e( 'CSS Classes' ); ?><br />
					<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
				</label>
			</p>
			<p class="field-xfn description description-thin">
				<label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
					<?php _e( 'Link Relationship (XFN)' ); ?><br />
					<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn" value="<?php echo esc_attr( $item->xfn ); ?>" />
				</label>
			</p>
			<p class="field-description description description-thin">
				<label for="edit-menu-item-description-<?php echo $item_id; ?>">
					<?php _e( 'Description' ); ?><br />
					<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
					<span class="description"><?php _e( 'The description will be displayed in the menu if the current theme supports it.' ); ?></span>
				</label>
			</p>

			<div class="menu-item-actions description-thin submitbox">
				<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
					<p class="link-to-original">
						<?php printf( __( 'Original: %s' ), '<a href="' . esc_attr( $item->url ) . '" target="_blank">' . esc_html( $original_title ) . '</a>' ); ?>
					</p>
				<?php endif; ?>
				<a class="item-delete submitdelete deletion" id="delete-menu-item-<?php echo $item_id; ?>" href="#"><?php _e( 'Remove' ); ?></a>
			</div>
			<input type="hidden" name="menu-item-parent-id" class="menu-item-parent-id" id="edit-menu-item-parent-id-<?php echo $item_id; ?>" value="<?php echo esc_attr( $item->parent ); ?>" />
		</div><!-- .menu-item-settings-->
		<ul class="menu-item-transport"></ul>
	</div>
	<?php
}

/**
 * Render a new menu section and all of its default controls.
 *
 * Required for adding new menus becuase there isn't a JS API for this in the Customizer (yet).
 *
 * @link https://core.trac.wordpress.org/ticket/28709
 *
 * @param int $menu_id The menu's id.
 * @param int $depth The depth of the menu item.
 */
function menu_customizer_render_new_menu( $menu_id, $menu_name ) {
	?>
	<li id="accordion-section-nav_menus[<?php echo $menu_id; ?>]" class="control-section accordion-section control-subsection">
		<h3 class="accordion-section-title" tabindex="0"><?php echo $menu_name; ?></h3>
		<ul class="accordion-section-content">
			<li id="customize-control-nav_menus-<?php echo $menu_id; ?>-name" class="customize-control customize-control-text">
				<label>
					<input type="text" value="<?php echo $menu_name; ?>" data-customize-setting-link="nav_menus[<?php echo $menu_id; ?>][name]">
				</label>
			</li>
			<li id="customize-control-nav_menu_<?php echo $menu_id; ?>" class="customize-control customize-control-nav_menu">
				<span class="button-secondary add-new-menu-item" tabindex="0"><?php _e( 'Add Links' ); ?></span>
				<span class="add-menu-item-loading spinner" style="display: none;"></span>
				<span class="reorder-toggle" tabindex="0">
					<span class="reorder"><?php _e( 'Reorder' ); ?></span>
					<span class="reorder-done"><?php _e( 'Done' ); ?></span>
				</span>
			</li>
			<li id="customize-control-nav_menus-<?php echo $menu_id; ?>-auto_add" class="customize-control customize-control-checkbox">
				<label>
					<input type="checkbox" value="" data-customize-setting-link="nav_menus[<?php echo $menu_id; ?>][auto_add]"><?php _e( 'Automatically add new top-level pages to this menu.' ); ?>
				</label>
			</li>
		</ul>
	</li>
	<?php
}