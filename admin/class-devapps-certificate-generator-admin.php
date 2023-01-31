<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://devapps.com.br
 * @since      1.0.0
 *
 * @package    Devapps_Certificate_Generator
 * @subpackage Devapps_Certificate_Generator/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Devapps_Certificate_Generator
 * @subpackage Devapps_Certificate_Generator/admin
 * @author     DevApps Consultoria e Desenvolvimento de Sistemas <contato@devapps.com.br>
 */
class Devapps_Certificate_Generator_Admin
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
		if (!isset($_GET['page']) || $_GET['page'] != "devapps-certificate-generator") {
			return;
		}

		wp_enqueue_style("bootstrap", plugin_dir_url(__FILE__) . "css/bootstrap.css", array(), "4.6.2", 'all');
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/devapps-certificate-generator-admin.css', array('bootstrap'), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{
		if (!isset($_GET['page']) || $_GET['page'] != "devapps-certificate-generator") {
			return;
		}

		wp_enqueue_script("bootstrap", plugin_dir_url(__FILE__) . "js/bootstrap-bundle.js", array(jquery), "4.6.2", false);
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/devapps-certificate-generator-admin.js', array('bootstrap'), time(), false);
		wp_localize_script(
			$this->plugin_name,
			'devapps_certificate_generator',
			array(
				'ajax' => admin_url('admin-ajax.php')
			)
		);
	}


	public function create_menu_item()
	{
		add_menu_page(
			__('Gerar Certificados', 'devapps-certificate-generator'),
			'Gerar Certificados',
			'manage_options',
			$this->plugin_name,
			array($this, 'create_main_page'),
			'dashicons-awards',
			6
		);
	}

	public function create_main_page()
	{
		devapps_get_view('main', true, array());
	}

	public function generate_certificate()
	{
		$data['model'] = DEVAPPS_CERTIFICATE_GENERATOR_PATH . "models/default.jpg";

		if (isset($_POST['model']) && !empty($_POST['model']) && $_POST['model'] != "default") {
			$model = $this->check_model_exists($_POST['model']);

			if ($model && file_exists($model->path)) {
				$data['model'] = $model->path;
			}
		}

		$data['person'] =addslashes($_POST['person']);
		$data['course'] = addslashes($_POST['course']);
		$data['preview'] =addslashes($_POST['preview']);

		if ($path = $this->create_certificate_image($data)) {

			$status = $path ? true : false;

			if (!$data['preview']) {
				$status = $this->save_certificate(
					array(
						'person' => $data['person']['fullname'],
						'document' => $data['person']['document'],
						'email' => $data['person']['email'],
						'certificate' => $path
					)
				);
			}

			wp_send_json(
				array(
					"status" => $status,
					"url" => $path,
					"filename" => devapps_slugify("Certificado {$data['person']['fullname']} {$data['course']['name']}")
				)
			);
		}

		wp_send_json(
			array(
				"status" => false,
			)
		);
	}

	private function save_certificate(array $data): bool
	{
		global $wpdb;
		try {
			$wpdb->insert("{$wpdb->prefix}devapps_certificates", $data);
			return true;
		} catch (Exception $ex) {
			return false;
		}
	}

	private function check_model_exists(string $model)
	{
		global $wpdb;

		$result = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}certificate_models WHERE code = '${$model}';");

		if (!empty($result)) {
			return $result;
		}
		return false;
	}

	private function create_certificate_image(array $data)
	{
		try {
			$image = imagecreatefromjpeg($data['model']);
			$image_width = imagesx($image);
			$image_height = imagesy($image);

			$font_bold = DEVAPPS_CERTIFICATE_GENERATOR_PATH . "fonts/Poppins-Bold.ttf";
			$font_regular = DEVAPPS_CERTIFICATE_GENERATOR_PATH . "fonts/Poppins-Regular.ttf";
			$color = imagecolorallocate($image, 31, 41, 53);

			$person = $data['person']['fullname'];
			$person_font_size = 30;
			$person_box = imagettfbbox($person_font_size, 0, $font_bold, $person);
			$person_width = abs($person_box[2]) - abs($person_box[0]);
			$person_height = abs($person_box[5]) - abs($person_box[3]);
			$person_x = (($image_width - $person_width) / 2) - 46;
			$person_y = (($image_height + $person_height) / 2) + $person_font_size;
			imagettftext($image, $person_font_size, 0, $person_x, $person_y, $color, $font_bold, mb_strtoupper($person));

			$line_1 = "por participar do {$data['course']['name']} ministrado por {$data['course']['instructor']},";
			$line_1_font_size = 20;
			$line_1_box = imagettfbbox($line_1_font_size, 0, $font_regular, $line_1);
			$line_1_width = abs($line_1_box[2]) - abs($line_1_box[0]);
			$line_1_height = abs($line_1_box[5]) - abs($line_1_box[3]);
			$line_1_x = (($image_width - $line_1_width) / 2) - 5;
			$line_1_y = (($image_height + $line_1_height) / 2) + 150;
			imagettftext($image, $line_1_font_size, 0, $line_1_x, $line_1_y, $color, $font_regular, $line_1);

			$line_2 = "{$data['course']['data']}, {$data['course']['locale']}.";
			$line_2_font_size = 20;
			$line_2_box = imagettfbbox($line_2_font_size, 0, $font_regular, $line_2);
			$line_2_width = abs($line_2_box[2]) - abs($line_2_box[0]);
			$line_2_height = abs($line_2_box[5]) - abs($line_2_box[3]);
			$line_2_x = (($image_width - $line_2_width) / 2) - 5;
			$line_2_y = (($image_height + $line_2_height) / 2) + 185;
			imagettftext($image, $line_2_font_size, 0, $line_2_x, $line_2_y, $color, $font_regular, $line_2);

			$time = $data['course']['time'];
			$time_font_size = 25;
			imagettftext($image, $time_font_size, 0, 1229, 980, $color, $font_regular, $time);

			if (!$data['preview']) {
				$upload_dir = trailingslashit(wp_upload_dir()['basedir']) . 'certificates';
				$upload_url = trailingslashit(wp_upload_dir()['baseurl']) . 'certificates';
				wp_mkdir_p($upload_dir);

				$file_name = md5(time() . "_" . $data['person']['fullname']) . ".jpg";
				$file_path = trailingslashit($upload_dir) . $file_name;
				$file_url = trailingslashit($upload_url) . $file_name;
			} else {
				$upload_dir = trailingslashit(wp_upload_dir()['basedir']) . 'certificates_temp';
				$upload_url = trailingslashit(wp_upload_dir()['baseurl']) . 'certificates_temp';
				wp_mkdir_p($upload_dir);

				$file_name = md5(time() . "_" . $data['person']['fullname']) . ".jpg";
				$file_path = trailingslashit($upload_dir) . $file_name;
				$file_url = trailingslashit($upload_url) . $file_name;
			}

			imagejpeg($image, $file_path, 200);

			imagedestroy($image);

			return $file_url;
		} catch (Exception $ex) {
			return false;
		}
	}
}