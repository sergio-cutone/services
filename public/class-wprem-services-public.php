<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Wprem_Services
 * @subpackage Wprem_Services/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wprem_Services
 * @subpackage Wprem_Services/public
 * @author     Sergio Cutone <sergio.cutone@yp.ca>
 */
class Wprem_Services_Public
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
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
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

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wprem-services-public.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
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

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wprem-services-public-min.js', array('jquery'), $this->version, false);

    }

    public function single_service_content($content)
    {
        global $post;
        if (is_singular(WPREM_SERVICES_CUSTOM_POST_TYPE)) {

            // Save Service Post ID
            $service_id = $post->ID;

            $args = array('post_type' => WPREM_STAFF_MANAGER_CUSTOM_POST_TYPE);
            $staff = '';
            $staff_query = new WP_Query($args);
            if ($staff_query->have_posts()) {
                while ($staff_query->have_posts()) {
                    $staff_query->the_post();
                    $staff_members = get_post_custom(get_the_ID());
                    // - - - - - Services
                    if (isset($staff_members['_data_post_services'][0]) && $staff_members['_data_post_services'][0]) {
                        $allservices = maybe_unserialize($staff_members['_data_post_services'][0]);
                        foreach ($allservices as $key => $val) {
                            if ($val == $service_id) {
                                $staff .= do_shortcode('[wp_staff id=' . get_the_ID() . ']');
                            }
                        }
                    }
                    // - - - - - //
                }
            }
            wp_reset_postdata();
            if ($staff) {
                $content = $content . '<div class="wprem-staff-container"><div class="wprem-title wprem_h1">Staff Members for this Service</div></div>' . $staff;
            }

            $args = array('post_type' => WPREM_PROMOTIONS_CUSTOM_POST_TYPE);
            $promotion = '';
            $promo_query = new WP_Query($args);
            if ($promo_query->have_posts()) {
                while ($promo_query->have_posts()) {
                    $promo_query->the_post();
                    $promotions = get_post_custom(get_the_ID());
                    // - - - - - Services
                    if (isset($promotions['_data_post_services'][0]) && $promotions['_data_post_services'][0]) {
                        $allservices = maybe_unserialize($promotions['_data_post_services'][0]);
                        foreach ($allservices as $key => $val) {
                            if ($val == $service_id) {
                                $promotion .= do_shortcode('[wp_promos id=' . get_the_ID() . ']');
                            }
                        }
                    }
                    // - - - - - //
                }
            }
            wp_reset_postdata();
            if ($promotion) {
                $content = $content . '<div class="wprem-promotions-container"><div class="wprem-title wprem_h1">Service Promotions</div></div>' . $promotion;
            }
        } elseif (is_category()) {
            $content = "Category";
        }
        return $content;
    }

    public function services_shortcode()
    {

    }

}
