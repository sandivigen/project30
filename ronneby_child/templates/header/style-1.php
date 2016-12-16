<?php
global $post, $dfd_ronneby;
# For stylechanger - "Show header top panel" option
/*
$show_header_top_panel = !!(strcmp($dfd_ronneby['header_top_panel'], 'on') === 0);
 * Was added for stylechanger, deprecated
 * 
if (isset($_POST['show_header_top_panel'])) {
	$show_header_top_panel = !!intval($_POST['show_header_top_panel']);
}
*/

$show_header_top_panel = isset($dfd_ronneby['header_first_top_panel']) && strcmp($dfd_ronneby['header_first_top_panel'], 'on') === 0;

$header_logo_position = '';
if (!empty($post) && is_object($post)) {
	$page_id = $post->ID;

	$logo_position = get_post_meta($page_id, 'dfd_headers_logo_position', true);
	$header_logo_position = !empty($logo_position) ? $logo_position : 'left';
}
/*
 * Was added for stylechanger, deprecated
 * 
if (isset($_POST['header_logo_position'])) {
	$header_logo_position = $_POST['header_logo_position'];
}
*/
if(empty($header_logo_position)) {
	$header_logo_position = 'left';
}

if(isset($dfd_ronneby['header_first_soc_icons_hover_style']) && !empty($dfd_ronneby['header_first_soc_icons_hover_style'])) {
	$header_soc_icons_hover_style = 'dfd-soc-icons-hover-style-'.$dfd_ronneby['header_first_soc_icons_hover_style'];
} else {
	$header_soc_icons_hover_style = 'dfd-soc-icons-hover-style-1';
}
$header_container_class = 'dfd-enable-mega-menu';
if(!isset($dfd_ronneby['header_first_sticky']) || strcmp($dfd_ronneby['header_first_sticky'], 'off') !== 0) {
	$header_container_class .= ' dfd-enable-headroom';
}
$header_container_class .= ($show_header_top_panel) ? ' with-top-panel' : ' without-top-panel';
//$header_container_class .= (isset($dfd_ronneby['enable_sticky_header']) && strcmp($dfd_ronneby['enable_sticky_header'], 'off') === 0) ? ' sticky-header-disabled' : ' sticky-header-enabled';
$header_container_class .= (isset($dfd_ronneby['head_first_enable_buttons']) && strcmp($dfd_ronneby['head_first_enable_buttons'], '1') === 0) ? '' : ' dfd-header-buttons-disabled';

?>
<?php get_template_part('templates/header/block', 'search'); ?>
<div id="header-container" class="<?php echo dfd_get_header_style(); ?> <?php echo esc_attr($header_container_class); ?>">
	<section id="header">
		<?php if ($show_header_top_panel) : ?>
			<div class="header-top-panel">
				<div class="row">
					<div class="columns twelve header-info-panel">
						<?php get_template_part('templates/header/block', 'topinfo'); ?>
						
						<?php if(isset($dfd_ronneby['header_first_login']) && $dfd_ronneby['header_first_login']) { ?>
							<?php get_template_part('templates/header/block', 'login'); ?>
						<?php } ?>
						
						<?php if(isset($dfd_ronneby['head_first_show_header_soc_icons']) && $dfd_ronneby['head_first_show_header_soc_icons']) { ?>
							<div class="widget soc-icons <?php echo esc_attr($header_soc_icons_hover_style) ?>">
								<?php echo crum_social_networks(true); ?>
							</div>
						<?php } ?>
						<?php if(isset($dfd_ronneby['head_first_enable_top_panel_wishlist_link']) && $dfd_ronneby['head_first_enable_top_panel_wishlist_link']) {
							echo dfd_wishlist_button();
						} ?>
						<?php get_template_part('templates/header/block', 'additional_header_menu'); ?>
					</div>
					<?php get_template_part('templates/header/block', 'toppanel'); ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if (strcmp($header_logo_position, 'top-left') === 0 || strcmp($header_logo_position, 'top-center') === 0 || strcmp($header_logo_position, 'top-right') === 0) : ?>
			<div class="logo-wrap header-top-logo-panel">
				<div class="row">
					<div class="columns twelve">
						<?php get_template_part('templates/header/block', 'custom_logo'); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="header-wrap">
			<div class="row decorated">
				<div class="columns twelve header-main-panel">
					<div class="header-col-left">
						<?php if (strcmp($header_logo_position, 'right') !== 0) : ?>
							<div class="mobile-logo">
								<?php if(isset($dfd_ronneby['mobile_logo_image']['url']) && $dfd_ronneby['mobile_logo_image']['url']) : ?>
									<a href="<?php home_url() ?>" title="<?php _e('Home','dfd'); ?>"><img src="<?php echo esc_url($dfd_ronneby['mobile_logo_image']['url']); ?>" alt="logo"/></a>
								<?php else : ?>
									<?php get_template_part('templates/header/block', 'custom_logo'); ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<?php if (strcmp($header_logo_position, 'left') === 0) : ?>
							<?php get_template_part('templates/header/block', 'custom_logo'); ?>
						<?php endif; ?>
						<?php if (strcmp($header_logo_position, 'right') === 0) : ?>
							<div class="header-icons-wrapper">
								<?php get_template_part('templates/header/block', 'responsive-menu'); ?>
								<?php get_template_part('templates/header/block', 'side_area'); ?>
								<?php get_template_part('templates/header/block', 'lang_sel'); ?>
								<?php get_template_part('templates/header/search', 'button'); ?>
								<?php if (is_plugin_active('woocommerce/woocommerce.php')) echo dfd_woocommerce_total_cart(); ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="header-col-right text-center clearfix">
							
						<!-- custom right button -->
						<div id="dfd-button-579d6ff511b28" class="dfd-button-module-wrap">
							<div class="dfd-button-module style_2 text-left dfd-horizontal dfd-left-to-right dfd-button-icon-right dfd-button-icon-hover-simple">
								<a onclick="setTimeout(jQuery('button.overlay-show').trigger('click'), 500)" title="" target="" class="dfd-button-link top-modal-link">
									<span class="dfd-button-inner-cover">
										<span class="dfd-button-text-main">ЗАКАЗАТЬ<br>ЗАМЕР<br>БЕСПЛАТНО<i class="fa fa-chevron-right"></i></span>
									</span>
								</a>
							</div>
						</div>
						
						<!-- icon include -->
						<link rel="stylesheet" href="http://www.inhuk.ru/wp-content/plugins/js_composer/assets/lib/bower/font-awesome/css/font-awesome.min.css?ver=4.11.2.1">
						
						<!-- modal window -->
						<div class="modal-hide">
							<?php

								echo do_shortcode('[ultimate_modal 
														modal_title="Заказать" 
														btn_size="lg" 
														btn_txt_color="#ffffff" 
														btn_text="БЕСПЛАТНО" 
														modal_style="overlay-cornertopright" 
														overlay_bg_opacity="80"]

															<span class="description-modal">Для того, чтобы получить бесплатный замер вам необходмо заполнить следующую форму</span>

															[dfd_user_form preset="preset3" fake_check_layout="forms_01" input_background="#ffffff" content_spacing="" border_color="#c39f77" text_color="#565656" text_area_height="10" vert_margin_btw_inputs="10" horiz_margin_btw_inputs="10" font_size="13" button_border_width="1" button_border_color="#bc9b72" button_border_color_on_hover="#9f8465" button_border_radius="2" button_backgrond="#bc9b72" hover_button_backgrond="#9f8465" button_color_text="#ffffff" button_hover_color_text="#ffffff" btn_message="Отправить" btn_width="dfd-third-size" email_to="info@inhuk.ru" email_subject="Заявка INHUK" check_layout="forms_01.php" 
															check_layout_forms_01="{``1``:{``text_name``:{``name``:``Имя``}},``2``:{``email``:{``name``:``Email``}},``3``:{``text_name``:{``name``:``Телефон``}},``4``:{``textarea_name``:{``name``:``Текст сообщения``}}}"]Имя:{{text_name-1}}
																Email:{{email-2}}

																Телефон: {{text_name-3}}



																Текст сообщения:

																{{textarea_name-4}}
																 
																--
																This e-mail was sent from a contact form
															[/dfd_user_form]

														[/ultimate_modal]');
						 	?>
						</div>

							<?php if (strcmp($header_logo_position, 'right') !== 0) : ?>
								<div class="header-icons-wrapper">
									<?php get_template_part('templates/header/block', 'responsive-menu'); ?>
									<?php get_template_part('templates/header/block', 'side_area'); ?>
									<?php get_template_part('templates/header/block', 'lang_sel'); ?>
									<?php get_template_part('templates/header/search', 'button'); ?>
									<?php if (is_plugin_active('woocommerce/woocommerce.php')) echo dfd_woocommerce_total_cart(); ?>
								</div>
							<?php endif; ?>
							<?php if (strcmp($header_logo_position, 'right') === 0) : ?>
								<div class="mobile-logo">
									<?php if(isset($dfd_ronneby['mobile_logo_image']['url']) && $dfd_ronneby['mobile_logo_image']['url']) : ?>
										<a href="<?php home_url() ?>" title="<?php _e('Home','dfd'); ?>"><img src="<?php echo esc_url($dfd_ronneby['mobile_logo_image']['url']); ?>" alt="logo"/></a>
									<?php else : ?>
										<?php get_template_part('templates/header/block', 'custom_logo'); ?>
									<?php endif; ?>
								</div>
								<?php get_template_part('templates/header/block', 'custom_logo'); ?>
							<?php endif; ?>
					</div>
					<div class="header-col-fluid">
						<?php if(isset($dfd_ronneby['custom_logo_fixed_header']['url']) && $dfd_ronneby['custom_logo_fixed_header']['url']) : ?>
							<a href="<?php echo home_url(); ?>/" title="<?php _e('Home', 'dfd') ?>" class="fixed-header-logo">
								<img src="<?php echo esc_url($dfd_ronneby['custom_logo_fixed_header']['url']); ?>" alt="logo"/>
							</a>
						<?php endif; ?>
						<?php get_template_part('templates/header/block', 'main_menu'); ?>
					</div>
				</div>
			</div>
		</div>
		<?php if (strcmp($header_logo_position, 'bottom-left') === 0 || strcmp($header_logo_position, 'bottom-center') === 0 || strcmp($header_logo_position, 'bottom-right') === 0) : ?>
			<div class="logo-wrap header-top-logo-panel">
				<div class="row">
					<div class="columns twelve">
						<?php get_template_part('templates/header/block', 'custom_logo'); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</section>
	<?php if (strcmp($header_logo_position, 'middle') === 0) : ?>
		<div class="logo-wrap header-top-logo-panel">
			<div class="row">
				<div class="columns twelve">
					<?php get_template_part('templates/header/block', 'custom_logo'); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>