<?php
// Description product cart and price in portfolio single page
// update 15.09.16
?>
<?php
global $dfd_ronneby, $description_position;
$custom_fields = $acf_columns = $columns = '';

if (function_exists('get_field_objects')) {
	$fields = get_field_objects();
} else {
	$fields = false;
}
?>

<?php if((!isset($dfd_ronneby['entry_meta_display']) || $dfd_ronneby['entry_meta_display']) && (strcmp($description_position, 'left') !== 0 && strcmp($description_position, 'right') !== 0)) : ?>
	<div class="dfd-folio-add-fields-wrap">
		<?php get_template_part('templates/portfolio/additional','fields'); ?>
	</div>
<?php endif; ?>

<!-- <div class="columns twelve">
	<div class="folio-info-field folio-info-field-inner">
		<?php if(isset($dfd_ronneby['portfolio_inner_description_title']) && !empty($dfd_ronneby['portfolio_inner_description_title'])) : ?>
			<div class="folio-field-name box-name"><?php echo $dfd_ronneby['portfolio_inner_description_title']; ?></div>
		<?php endif; ?>
		<?php 
			while (have_posts()) {
				the_post();
				echo get_the_content();
			}
		?>
	</div>
</div> -->


<?php $price = get_post_custom(); ?>


	<div class="wpb_wrapper">
		<div id="dfd-pricing-block-57c57987c4a6a-9487" class="dfd-pricing-block style-02 " solid="">
			<div class="block-head  ">
				<div class="icon-wrap">
					<div class="feature-title" style=""><?php the_title(); ?></div>
					<div class="subtitle" style=""><?php get_template_part('templates/folio', 'term'); ?></div>
					<div class="delimiter-wrap"><span class="price-sep"></span></div>
					<div class="price-wrap">
						<span class="currency-symbol">&#8381;</span>
						<span class="payment-amount">
							<?php
								if(!empty($fields)) {
									// echo substr($fields['Tasks']['value'], 3, 6)+0;
									// intval($fields['Tasks']['value']);
									echo substr($price['price'][0], 0, 2);
								}
							?>
						</span>
						<span class="time-interval"><?php echo substr($price['price'][0], -3); ?></span>
					</div>
					<span class="dicription-price">минимальная цена за погонный метр</span>
				</div>

				<div class="block-desc">
					<div class="desc-text subtitle" style="">
						<?php 
							while (have_posts()) {
								the_post();
								echo get_the_content();
							}
						?>
					</div>
					
					<a onclick="setTimeout(jQuery('button.overlay-show').trigger('click'), 500)" title="" target="" class="dfd-button-link pricing-button button">Заказать</a>
				</div>

			
			</div>

				<script type="text/javascript">
					(function($) {
						$("head").append("<style>#dfd-pricing-block-57c57987c4a6a-9487.dfd-pricing-block {border-style: solid; border-width: 1px; }</style>");
					})(jQuery);
				</script>
				
			</div>
		</div>

<?php
$post_id = get_the_ID();

// echo "<pre style='font-size: 12px'>";
// print_r($fields['Tasks']['value']);

// echo "</pre>";

if(!empty($_fields)) {
	foreach ($fields as $field_name => $field) {
		if (!empty($field['label']) && !empty($field['value'])) { ?>
			<div class="twelve columns">
				<div class="<?php echo strtolower($field['label']) ?> folio-info-field">
					<div class="folio-field-name box-name"><?php 
						// echo $field['label'] 
						// custom code
						if ($field['label'] == 'Tasks') {
							echo 'Цена';
						}
						if ($field['label'] == 'Quote') {
							echo 'Заказать';
						}
					?></div>
					<?php echo do_shortcode($field['value']) ?>
				</div>
			</div>
		<?php }
	}
}
?>

<?php if(strcmp($_description_position, 'left') === 0 || strcmp($description_position, 'right') === 0) : ?>
	<?php get_template_part('templates/portfolio/additional','fields'); ?>
	<div class="columns twelve">
		<div class="folio-info-field folio-add-info">
			<?php get_template_part('templates/entry-meta/mini', 'add-info'); ?>
		</div>
	</div>
<?php endif;