<?php

/**
 * Fired during plugin activation
 *
 * @link       https://devapps.com.br
 * @since      1.0.0
 *
 * @package    Devapps_Certificate_Generator
 * @subpackage Devapps_Certificate_Generator/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Devapps_Certificate_Generator
 * @subpackage Devapps_Certificate_Generator/includes
 * @author     DevApps Consultoria e Desenvolvimento de Sistemas <contato@devapps.com.br>
 */
class Devapps_Certificate_Generator_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		if (version_compare(DEVAPPS_CERTIFICATE_GENERATOR_VERSION, "1.0.0", "==")) {
			self::create_tables_1_0_0();
		}
	}

	public static function create_tables_1_0_0()
	{
		global $wpdb;

		$sql = "
		CREATE TABLE `{$wpdb->prefix}devapps_certificate_models` (
			`id` INT NOT NULL AUTO_INCREMENT,
			`code` CHAR(36) NOT NULL DEFAULT (uuid()),
			`path` VARCHAR(255) NOT NULL,
			`url` VARCHAR(255) NULL,
			`created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`),
			UNIQUE INDEX `code_UNIQUE` (`code` ASC) VISIBLE)
		ENGINE = InnoDB
		DEFAULT CHARACTER SET = utf8mb4
		COLLATE = utf8mb4_unicode_ci ;";

		dbDelta($sql);

		$sql = "
		CREATE TABLE `{$wpdb->prefix}devapps_certificates` (
			`Id` INT NOT NULL AUTO_INCREMENT,
			`code` CHAR(36) NOT NULL DEFAULT (uuid()),
			`person` VARCHAR(255) NOT NULL,
			`document` VARCHAR(45) NOT NULL,
			`email` VARCHAR(255) NOT NULL,
			`certificate` VARCHAR(255) NOT NULL,
			`created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`Id`),
			UNIQUE INDEX `code_UNIQUE` (`code` ASC) VISIBLE)
		ENGINE = InnoDB
		DEFAULT CHARACTER SET = utf8mb4
		COLLATE = utf8mb4_unicode_ci;
		";
		dbDelta($sql);
	}
}