<?php
/**
 * The template for displaying the footer
 *
 *
 * @package WordPress
 * @subpackage Solubienes
 * @since Solubienes 1.0
 */
?>

	<div class="container">
		<div class="row footer-links">
			
			<!-- types -->
			<div class="col-md-3 col-sm-6 col-xs-12">
				<h3>Propiedades</h3>
				<ul>
					<?php 
					    $args = array(
							'exclude'            => '',
							'title_li'           => '',
							'show_option_none'   => 'No hay categorías',
							'taxonomy'           => 'tipo',
							'number'			 => 7
					    );
					    wp_list_categories( $args ); 
					?>
				</ul>
			</div>

			<!-- consultant -->
			<div class="col-md-3 col-sm-6 col-xs-12">
				<h3>Asesor</h3>
				<ul>
					<li><a href="<?php echo get_page_by_title('Asesores')->guid; ?>">Ver asesores</a></li>
				</ul>
			</div>

			<div class="clearfix visible-sm">&nbsp;</div>

			<!-- blog -->
			<div class="col-md-3 col-sm-6 col-xs-12">
				<h3>Blog</h3>
				<ul>
					<?php 
					    $args = array(
							'exclude'            => '1', // 1 = Sin categoria
							'title_li'           => '',
							'show_option_none'   => 'No hay categorías',
							'number'			 => 7
					    );
					    wp_list_categories( $args ); 
					?>
				</ul>
			</div>

			<!-- contact -->
			<div class="col-md-3 col-sm-6 col-xs-12">
				<h3>Contacto</h3>
				<ul>
					<li><?php print_address(); ?></li>
					<li>Telf.: <?php echo print_phone(); ?></li>
					<li><?php print_email(); ?></li>
				</ul>
			</div>

		</div>

		<div class="row">
			<div class="col-md-10 copyright">
				<p><?php print_copyrights(); ?> <a href="<?php echo get_page_by_title('Legal')->guid; ?>">Legal</a></p>
			</div>

			<div class="col-md-2 plus-logo">
				<a href="http://plusdigital.com.ve" target="_blank">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/plus_digital_logo.png" alt="Agencia Plus Digital">
				</a>
			</div>
		</div>
	</div>

	<input type="hidden" id="property_id" value="0">

	<?php include('templates/login.php'); ?>

	<footer>
		<figure></figure>
	</footer><!-- .site-footer -->

<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/swiper.min.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.matchheight.min.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.hoverintent.min.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/bootstrap-slider.min.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/typeahead.min.js"></script>
<?php
	if (isset($GLOBALS['script'])) {
		echo $GLOBALS['script'];
	}
?>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		//for typeahead
		var zones = [<?php print_zones_list(); ?>];
		 
		$('.typeahead-zones').typeahead({
		  hint: true,
		  highlight: true,
		  minLength: 2
		},
		{
		  name: 'zones',
		  displayKey: 'value',
		  source: substringMatcher(zones)
		});

		//cookies for searches
		if(typeof(Storage) !== 'undefined') {
			<?php if (isset($_GET['zona'], $_GET['tipo'], $_GET['operacion'])) : ?>
				<?php if (!empty($_GET['zona'])) : ?>
			    localStorage.setItem('zona', '<?php echo $_GET['zona']; ?>');
			    <?php endif; ?>

			    <?php if (!empty($_GET['tipo'])) : ?>
			    localStorage.setItem('tipo', '<?php echo $_GET['tipo']; ?>');
			    <?php endif; ?>

			    <?php if (!empty($_GET['operacion'])) : ?>
			    localStorage.setItem('operacion', '<?php echo $_GET['operacion']; ?>');
			    <?php endif; ?>
			<?php else : ?>
				$('input[name=zona]').val( localStorage.getItem('zona') );
				$('select[name=tipo]').val( localStorage.getItem('tipo') );
				$('select[name=operacion]').val( localStorage.getItem('operacion') );
			<?php endif; ?>
		}
	});

	function bookmarkPage($star) {
		<?php if (is_user_logged_in()) : ?>
		if (jQuery('#property_id').val() > 0) {
			jQuery.ajax({
				method: 'POST',
				url: '<?php echo get_template_directory_uri() . '/ajax/bookmarks.php'; ?>',
				data: { property_id: jQuery('#property_id').val() },
				dataType: 'json'
			})
			.done(function( data ) {
				if (data['ok'] == 1) {
					if (data['bookmarked'] == 1) {
						$star.addClass('favorited');
					}
					else {
						$star.removeClass('favorited');
						<?php if (isset($_GET['tipo']) && $_GET['tipo'] == 'misfavoritos') : ?>
						$star.closest('.box').fadeOut('slow', function() {
							jQuery(this).parent().remove();
						});
						<?php endif; ?>
					}
				}
			});
		}
		<?php else : ?>
		alert('Regístrate para poder guardar tus favoritos');
		var $a = jQuery('.login-btn').find('.icon-key').eq(0);
		$a.addClass('animated bounce');
		setTimeout(function() {
			$a.removeClass('animated bounce');
		}, 2000);
		<?php endif; ?>
	}
</script>
<?php wp_footer(); ?>

</body>
</html>