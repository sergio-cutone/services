<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Wprem_Services
 * @subpackage Wprem_Services/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wprem_Services
 * @subpackage Wprem_Services/admin
 * @author     Sergio Cutone <sergio.cutone@yp.ca>
 */
class Wprem_Services_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wprem_Services_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wprem_Services_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wprem-services-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wprem_Services_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wprem_Services_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wprem-services-admin.js', array('jquery'), $this->version, false);

    }

    public function content_types()
    {

        $labels = array(
            'name' => _x('Services', 'Post type general name', 'textdomain'),
            'singular_name' => _x('Service', 'Post type singular name', 'textdomain'),
            'menu_name' => _x('Services', 'Admin Menu text', 'textdomain'),
            'name_admin_bar' => _x('Service', 'Add New on Toolbar', 'textdomain'),
            'add_new' => __('Add New', 'textdomain'),
            'add_new_item' => __('Add New Service', 'textdomain'),
            'new_item' => __('New Service', 'textdomain'),
            'edit_item' => __('Edit Service', 'textdomain'),
            'view_item' => __('View Service', 'textdomain'),
            'all_items' => __('All Services', 'textdomain'),
            'search_items' => __('Search Services', 'textdomain'),
            'parent_item_colon' => __('Parent Services:', 'textdomain'),
            'not_found' => __('No Services found.', 'textdomain'),
            'not_found_in_trash' => __('No Services found in Trash.', 'textdomain'),
            'featured_image' => _x('Service Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain'),
            'set_featured_image' => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain'),
            'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain'),
            'use_featured_image' => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain'),
            'archives' => _x('Service archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain'),
            'insert_into_item' => _x('Insert into Service', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain'),
            'uploaded_to_this_item' => _x('Uploaded to this Service', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain'),
            'filter_items_list' => _x('Filter Services list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain'),
            'items_list_navigation' => _x('Services list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain'),
            'items_list' => _x('Services list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain'),
        );

        $exludefromsearch = (esc_attr(get_option('wprem_searchable_wprem-services')) === "1") ? false : true;
        $rewrite = array('slug' => 'services', 'with_front' => false);

        $args = array('exclude_from_search' => $exludefromsearch, 'rewrite' => $rewrite, 'labels' => $labels, "menu_icon" => "dashicons-hammer", "has_archive" => false, 'supports' => array('title', 'editor', 'thumbnail'));
        $service = register_cuztom_post_type(WPREM_SERVICES_CUSTOM_POST_TYPE, $args);

        if (defined('WPREM_LOCATIONS_CUSTOM_POST_TYPE')) {
            $box = register_cuztom_meta_box('data', WPREM_SERVICES_CUSTOM_POST_TYPE, array(
                'title' => 'Business Service Settings',
                'fields' => array(
                    array(
                        'id' => '_data_tabs',
                        'type' => 'tabs',
                        'panels' => array(
                            array(
                                'id' => '_data_tabs_panel_3',
                                'title' => 'Extra',
                                'fields' => array(
                                    array(
                                        'id' => '_data_post_locations',
                                        'type' => 'post_checkboxes',
                                        'label' => 'Locations that offer this service',
                                        'args' => array(
                                            'post_type' => WPREM_LOCATIONS_CUSTOM_POST_TYPE,
                                            'orderby' => 'title',
                                            'order' => 'ASC',
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            )
            );
        }
        register_taxonomy(
            'department',
            WPREM_SERVICES_CUSTOM_POST_TYPE,
            array(
                'label' => __('Departments'),
                'rewrite' => array('slug' => 'departments'),
                'hierarchical' => true,
            )
        );
    }

    public function add_action_links($links)
    {
        $settings_link = array(
            '<a href="' . admin_url('edit.php?post_type=' . WPREM_SERVICES_CUSTOM_POST_TYPE) . '&page=' . $this->plugin_name . '">' . __('Settings', $this->plugin_name) . '</a>',
        );
        return array_merge($settings_link, $links);
    }

    public function menu_settings()
    {
        add_submenu_page(
            'edit.php?post_type=' . WPREM_SERVICES_CUSTOM_POST_TYPE,
            'Settings', // The title to be displayed in the browser window for this page.
            'Settings', // The text to be displayed for this menu item
            'manage_options', // Which type of users can see this menu item
            $this->plugin_name, // The unique ID - that is, the slug - for this menu item
            array($this, 'settings_page') // The name of the function to call when rendering this menu's page
        );
    }

    public function settings_page()
    {
        include_once 'partials/wprem-services-admin-display.php';
    }

    public function options_update()
    {
        register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
    }

}
