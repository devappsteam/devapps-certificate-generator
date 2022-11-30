<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://devapps.com.br
 * @since      1.0.0
 *
 * @package    Devapps_Certificate_Generator
 * @subpackage Devapps_Certificate_Generator/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Devapps_Certificate_Generator
 * @subpackage Devapps_Certificate_Generator/includes
 * @author     DevApps Consultoria e Desenvolvimento de Sistemas <contato@devapps.com.br>
 */
class Devapps_Certificate_Generator_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'devapps-certificate-generator',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
