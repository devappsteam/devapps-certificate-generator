<?php

if (!function_exists('devapps_get_view')) {
	function devapps_get_view($view, $is_admin = false, $args = array())
	{
		$path = devapps_get_path_public_or_admin($is_admin) . $view . '.php';

		extract($args);
		if (file_exists($path)) {
			include $path;
		}
	}
}

if (!function_exists('devapps_get_view_string')) {
	function devapps_get_view_string($view, $is_admin = false, $args = array())
	{
		$path = devapps_get_path_public_or_admin($is_admin) . $view . '.php';

		extract($args);
		if (file_exists($path)) {
			ob_start();
			include $path;
			return ob_get_clean();
		}
	}
}

if (!function_exists('devapps_get_path_public_or_admin')) {
	function devapps_get_path_public_or_admin($is_admin = false)
	{
		return $is_admin ? trailingslashit(DEVAPPS_CERTIFICATE_GENERATOR_ADMIN_VIEWS_PATH) : trailingslashit(DEVAPPS_CERTIFICATE_GENERATOR_PUBLIC_VIEWS_PATH);
	}
}

if (!function_exists('devapps_real_to_decimal')) {
	function devapps_real_to_decimal(string $real): float
	{
		return floatval(str_replace(',', '.', str_replace('.', '', $real)));
	}
}

if (!function_exists('devapps_slugify')) {
	function devapps_slugify($text, string $divider = '_')
	{
		// replace non letter or digits by divider
		$text = preg_replace('~[^\pL\d]+~u', $divider, $text);

		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		// trim
		$text = trim($text, $divider);

		// remove duplicate divider
		$text = preg_replace('~-+~', $divider, $text);

		// lowercase
		$text = strtolower($text);

		if (empty($text)) {
			return 'n-a';
		}

		return $text;
	}
}
