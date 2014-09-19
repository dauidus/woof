<?php
/**
 * Custom Customizer Controls for the Menu Customizer.
 */

/**
 * Menu Customize Control Class
 */
class WP_Menu_Customize_Control extends WP_Customize_Control {
	public $type = 'nav_menu';
	public $menu_id;

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @since Menu Customizer 0.0
	 */
	public function to_json() {
		parent::to_json();
		$exported_properties = array( 'menu_id' );
		foreach ( $exported_properties as $key ) {
			$this->json[ $key ] = $this->$key;
		}
	}

	/**
	 * Render the control's content.
	 *
	 * @since Menu Customizer 0.0
	 */
	public function render_content() {
		$id = absint( $this->menu_id );
		?>

		<span class="button-secondary add-new-menu-item" tabindex="0">
			<?php _e( 'Add Links' ); ?>
		</span>

		<span class="add-menu-item-loading spinner"></span>

		<span class="reorder-toggle" tabindex="0">
			<span class="reorder"><?php _ex( 'Reorder', 'Reorder menu items in Customizer' ); ?></span>
			<span class="reorder-done"><?php _ex( 'Done', 'Cancel reordering menu items in Customizer'  ); ?></span>
		</span>

		<span class="menu-delete" id="delete-menu-<?php echo $id; ?>" tabindex="0">
			<span class="screen-reader-text"><?php printf( __( "Delete menu: %s" ), wp_get_nav_menu_object( $id )->name ); ?> </span>
		</span>
	<?php
	}
}

/**
 * Menu Item Customize Control Class
 */
class WP_Menu_Item_Customize_Control extends WP_Customize_Control {
	public $type = 'menu_item';
	public $menu_id = 0;
	public $item;
	public $menu_item_id = 0;
	public $original_id = 0;
	public $depth = 0;
	public $menu_item_parent_id = 0;

	/**
	 * Constructor.
	 *
	 * @uses WP_Customize_Control::__construct()
	 *
	 * @param WP_Customize_Manager $manager
	 * @param string $id
	 * @param array $args
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );

		$this->menu_item_id = $this->item->ID;
		$this->original_id = $this->menu_item_id;
		$this->depth = $this->depth( $this->item->menu_item_parent, 0 );
		$this->menu_item_parent_id = $this->item->menu_item_parent;
	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @since Menu Customizer 0.0
	 */
	public function to_json() {
		parent::to_json();
		$exported_properties = array( 'menu_item_id', 'original_id', 'menu_id', 'depth', 'menu_item_parent_id' );
		foreach ( $exported_properties as $key ) {
			$this->json[ $key ] = $this->$key;
		}
	}

	/**
	 * Determine the depth of a menu item by recursion.
	 *
	 * @param int $parent_id The id of the parent menu item
	 * @param int $depth Inverse current item depth
	 *
	 * @returns int Depth of the original menu item.
	 */
	public function depth( $parent_id, $depth = 0 ) {
		if ( 0 == $parent_id ) {
			// This is a top-level item, so the current depth is the maximum.
			return $depth;
		} else {
			// Increase depth.
			$depth = $depth + 1;

			// Find menu item parent's parent menu item id (the grandparent id).
			$parent = get_post( $parent_id ); // WP_Post object.
			$parent = wp_setup_nav_menu_item( $parent ); // Adds menu item properties.
			$parent_parent_id = $parent->menu_item_parent;

			return $this->depth( $parent_parent_id, $depth );
		}
	}

	/**
	 * Renders the control wrapper and calls $this->render_content() for the internals.
	 *
	 * @since Menu Customizer 0.0
	 */
	protected function render() {
		$id    = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
		$class = 'customize-control customize-control-' . $this->type . ' nav-menu-item-wrap';

		?><li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
			<?php $this->render_content(); ?>
		</li><?php
	}

	/**
	 * Render the control's content.
	 *
	 * @since Menu Customizer 0.0
	 */
	public function render_content() {
		menu_customizer_render_item_control( $this->item, $this->menu_id, $this->depth );
	}
}

/**
 * Outputs the screen options controls from nav-menus.php.
 */
class WP_Menu_Options_Customize_Control extends WP_Customize_Control {
	public $type = 'menu_options';

	public function render_content() {
		// Essentially adds the screen options.
		add_filter( 'manage_nav-menus_columns', array( $this, 'wp_nav_menu_manage_columns' ) );
		
		// Display screen options.
		$screen = WP_Screen::get( 'nav-menus.php' );
		$screen->render_screen_options();
	}

	/**
	 * Copied from wp-admin/includes/nav-menu.php. Returns the advanced options for the nav menus page.
	 *
	 * Link title attribute added as it's a relatively advanced concept for new users.
	 *
	 * @since 0.0
	 *
	 * @return Array The advanced menu properties.
	 */
	function wp_nav_menu_manage_columns() {
		return array(
			'_title' => __('Show advanced menu properties'),
			'cb' => '<input type="checkbox" />',
			'link-target' => __('Link Target'),
			'attr-title' => __('Title Attribute'),
			'css-classes' => __('CSS Classes'),
			'xfn' => __('Link Relationship (XFN)'),
			'description' => __('Description'),
		);
	}
}


/**
 * New Menu Customize Control Class
 */
class WP_New_Menu_Customize_Control extends WP_Customize_Control {
	public $type = 'new_menu';

	/**
	 * Render the control's content.
	 *
	 * @since Menu Customizer 0.0
	 */
	public function render_content() {
		?>
		<span class="button button-primary" id="create-new-menu-submit" tabindex="0"><?php _e( 'Create Menu' ); ?></span>
		<span class="spinner"></span>
		<span class="button" id="toggle-menu-delete" tabindex="0"><?php _e( 'Delete an Existing Menu' ); ?></span>
		<?php
	}
}
