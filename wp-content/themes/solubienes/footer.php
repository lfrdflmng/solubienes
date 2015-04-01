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
					<li><a href="#">zona</a></li>
					<li><a href="#">tipo</a></li>
					<li><a href="#">alquiler</a></li>
					<li><a href="#">venta</a></li>
					<li><a href="#">terrenos</a></li>
					<li><a href="#">locales</a></li>
				</ul>
			</div>

			<!-- consultant -->
			<div class="col-md-3 col-sm-6 col-xs-12">
				<h3>Asesor</h3>
				<ul>
					<li><a href="#">ubicación</a></li>
				</ul>
			</div>

			<div class="clearfix visible-sm">&nbsp;</div>

			<!-- blog -->
			<div class="col-md-3 col-sm-6 col-xs-12">
				<h3>Blog</h3>
				<ul>
					<li><a href="#">mudanza</a></li>
					<li><a href="#">decoración</a></li>
					<li><a href="#">reparaciones</a></li>
					<li><a href="#">comprar</a></li>
					<li><a href="#">vender</a></li>
				</ul>
			</div>

			<!-- contact -->
			<div class="col-md-3 col-sm-6 col-xs-12">
				<h3>Contacto</h3>
				<ul>
					<li>Av. Falsa calle 123</li>
					<li>Edif. Torre de David</li>
					<li>Puerto Ordaz</li>
					<li>Venezuela</li>
					<li>Telf.: 555.55.55</li>
					<li>info@solubienes.com</li>
				</ul>
			</div>

		</div>

		<div class="row">
			<div class="col-md-10 copyright">
				<p>Solubienes 2014 &copy; todos los derechos reservados. <a href="#">Legal</a></p>
			</div>

			<div class="col-md-2 plus-logo">
				<a href="http://plusdigital.com.ve" target="_blank">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/plus_digital_logo.png" alt="Agencia Plus Digital">
				</a>
			</div>
		</div>
	</div>

	<footer>
		<figure></figure>
	</footer><!-- .site-footer -->

<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/swiper.min.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.matchheight.min.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.hoverintent.min.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/bootstrap-slider.min.js"></script>
<?php
	if (isset($GLOBALS['script'])) {
		echo $GLOBALS['script'];
	}
?>
<?php wp_footer(); ?>

</body>
</html>