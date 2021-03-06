<?php

require_once locate_template('/inc/user_form/user_form_manager.php');

if (class_exists('WPBakeryShortCode')) {

	class WPBakeryShortCode_Dfd_User_Form extends WPBakeryShortCode {

		public function __construct($settings) {
			wp_enqueue_script("jquery-ui-datepicker");
			wp_enqueue_style("dfd_datepicker", get_template_directory_uri() . "/inc/user_form/assets/css/jquery-ui-1.11.4.custom/jquery-ui.min.css");
			if (is_admin()) {
				
			} else {
				wp_enqueue_script('Dfd_Contact_form', get_template_directory_uri() . "/inc/user_form/assets/js/contact_form.js", array ('jquery'), '1.0.0', true);
				$_dfdcf = array (
						'loaderUrl' => dfdcf_ajax_loader(),
						'sending' => __('Sending ...', 'contact-form-7'));
				wp_localize_script('Dfd_Contact_form', '_dfdcf', $_dfdcf);
				wp_register_script("reCaptcha", "https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit");
				wp_enqueue_script("reCaptcha");
			}
			parent::__construct($settings);
		}

		protected function content($atts, $content = null) {
			ob_start();
			$path = Dfd_User_Form_template_manager::instance()->getViewFile();
			if (file_exists($path)) {

				require($path);
			}
			return ob_get_clean();
		}
	}

}

class Dfd_Helper_GoogleFont {

	private static $_instance = null;

	/**
	 * 
	 * @return self
	 */
	public static function instance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function parse_google_font($font) {
		if (strlen($font) <= 0) {
			return false;
		}
		$google_fonts_obj = new Vc_Google_Fonts();
		$google_fonts_data = $google_fonts_obj->_vc_google_fonts_parse_attributes(array (), $font);

		return $google_fonts_data;
	}

	public function enqueueFont($data) {
		$settings = get_option('wpb_js_google_fonts_subsets');
		if (is_array($settings) && !empty($settings)) {
			$subsets = '&subset=' . implode(',', $settings);
		} else {
			$subsets = '';
		}
		if (!empty($data) && isset($data['values']['font_family'])) {
			wp_enqueue_style('vc_google_fonts_' . vc_build_safe_css_class($data['values']['font_family']), '//fonts.googleapis.com/css?family=' . $data['values']['font_family'] . $subsets);
		}
	}

	public function getFontName($data) {
		if (!isset($data['values']['font_family'])) {
			return "";
		}
		$google_fonts_family = explode(':', $data['values']['font_family']);
		return isset($google_fonts_family[0]) ? $google_fonts_family[0] : "";
	}

	public function getFontStyle($data) {
		if (!isset($data['values']['font_style'])) {
			return "";
		}
		$google_fonts_styles = explode(':', $data['values']['font_style']);
		return $google_fonts_styles[2] ? $google_fonts_styles[2] : "";
	}

	public function getFontWeight($data) {
		if (!isset($data['values']['font_style'])) {
			return "";
		}
		$google_fonts_styles = explode(':', $data['values']['font_style']);
		return $google_fonts_styles[1] ? $google_fonts_styles[1] : "";
	}

	public function getGoogleFontArray($data, $asstring = false) {
		$google_fonts_data = $this->parse_google_font($data);
		$this->enqueueFont($google_fonts_data);
		$label_font = $this->getFontName($google_fonts_data);
		$label_font_weight = $this->getFontWeight($google_fonts_data);
		$label_font_style = $this->getFontStyle($google_fonts_data);
		$result = array (
				"font-family" => $label_font,
				"font-weight" => $label_font_weight,
				"font-style" => $label_font_style
		);
		if ($asstring) {
			$font_inline = "";
			foreach ($result as $key => $value) {
				$font_inline.=$key . ":" . $value . ";";
			}
			return $font_inline;
		}
		return $result;
	}

}

if (function_exists('vc_map')) {
	vc_map(array (
			'name' => __('Dfd Contact Form', 'dfd'),
			'base' => 'dfd_user_form',
			'admin_enqueue_js' => get_template_directory_uri() . '/inc/user_form/assets/js/js.js',
			'front_enqueue_js' => get_template_directory_uri() . '/inc/user_form/assets/js/js.js',
			'category' => esc_attr__('Ronneby 2.0','dfd'),
			'icon' => 'ultimate_carousel',
			'params' => Dfd_User_Form_Manager::instance()->getParams()
	));
}