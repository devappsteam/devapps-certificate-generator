<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://devapps.com.br
 * @since             1.0.0
 * @package           Devapps_Certificate_Generator
 *
 * @wordpress-plugin
 * Plugin Name:       Gerador de Certificados - DevApps
 * Plugin URI:        https://devapps.com.br/plugins/devapps-certificate-generator
 * Description:       Gerador de certificados para cursos e eventos.
 * Version:           1.0.0
 * Author:            DevApps Consultoria e Desenvolvimento de Sistemas
 * Author URI:        https://devapps.com.br
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       devapps-certificate-generator
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
define('DEVAPPS_CERTIFICATE_GENERATOR_VERSION', '1.0.0');


/**
 * Admin Path.
 */
define('DEVAPPS_CERTIFICATE_GENERATOR_ADMIN_VIEWS_PATH', plugin_dir_path(__FILE__) . 'admin/views/');

/**
 * Public Path.
 */
define('DEVAPPS_CERTIFICATE_GENERATOR_PUBLIC_VIEWS_PATH', plugin_dir_path(__FILE__) . 'public/views/');

/**
 * Text Domain
 */
define('DEVAPPS_CERTIFICATE_GENERATOR_TEXT_DOMAIN', 'devapps-certificate-generator');

/**
 * URL by plugin
 */
define('DEVAPPS_CERTIFICATE_GENERATOR_URL', plugin_dir_url(__FILE__));


/**
 * PATH by plugin
 */
define('DEVAPPS_CERTIFICATE_GENERATOR_PATH', plugin_dir_path(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-devapps-certificate-generator-activator.php
 */
function activate_devapps_certificate_generator()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-devapps-certificate-generator-activator.php';
	Devapps_Certificate_Generator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-devapps-certificate-generator-deactivator.php
 */
function deactivate_devapps_certificate_generator()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-devapps-certificate-generator-deactivator.php';
	Devapps_Certificate_Generator_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_devapps_certificate_generator');
register_deactivation_hook(__FILE__, 'deactivate_devapps_certificate_generator');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-devapps-certificate-generator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_devapps_certificate_generator()
{

	$plugin = new Devapps_Certificate_Generator();
	$plugin->run();
}
run_devapps_certificate_generator();
