<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              #
 * @since             1.0.0
 * @package           Wprem_Services
 *
 * @wordpress-plugin
 * Plugin Name:       WPREM Services
 * Plugin URI:        #
 * Description:       Web Premium - Business Services
 * Version:           1.1.0
 * Author:            Sergio Cutone
 * Author URI:        #
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wprem-services
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('WPREM_SERVICES_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wprem-services-activator.php
 */
function activate_wprem_services()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-wprem-services-activator.php';
    Wprem_Services_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wprem-services-deactivator.php
 */
function deactivate_wprem_services()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-wprem-services-deactivator.php';
    Wprem_Services_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_wprem_services');
register_deactivation_hook(__FILE__, 'deactivate_wprem_services');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-wprem-services.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wprem_services()
{

    $plugin = new Wprem_Services();
    $plugin->run();

}
run_wprem_services();

define('WPREM_SERVICES_CUSTOM_POST_TYPE', 'wprem_services');

require get_stylesheet_directory() . '/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://webprem@bitbucket.org/webprem/wprem-services',
    __FILE__,
    'wprem-services'
);

$myUpdateChecker->setAuthentication(array(
    'consumer_key' => 'CvNncrGZUyHnxqPXau',
    'consumer_secret' => 'Y5AC8ZKrkPjdskRLaVnRZxCdGkbJzdkL',
));

$myUpdateChecker->setBranch('master');
