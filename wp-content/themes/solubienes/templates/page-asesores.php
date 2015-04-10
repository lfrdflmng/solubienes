<?php
 /*
 * Template Name: Asesores
 * @subpackage Solubienes
 * @since Solubienes 1.0
 */

if (isset($_GET['demo'])) goto demo;

$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

if (is_page()) {
	$page = $post;
}
else {
	$page = get_page_by_title('Asesores');
}

get_header(); ?>

	<!-- header -->
	<?php if (empty($feat_image)) : ?>
	<div class="container-fluid header bg-default consultants">
	<?php else : ?>
	<div class="container-fluid header consultants" style="background-image:url(<?php echo $feat_image; ?>)">
	<?php endif; ?>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h1>Asesores</h1>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<!-- empty left space -->
			<div class="col-md-1">&nbsp;
			</div>

			<!-- descripction -->
			<div class="col-md-10 page-desc">
				<p><?php echo get_post_meta($page->ID, 'descripcion', true); ?></p>
			</div>

			<!-- empty right space -->
			<div class="col-md-1">&nbsp;
			</div>
		</div>
	</div>

	<div class="section container">
		
		<div class="row">
			<div class="col-md-9">
				
				<!-- cards -->
				<div id="cards_holder">
					
					<?php
						$args = array(
							'posts_per_page' => 50,
							'post_type' => 'asesores',
							'order' => 'ASC'
						);

						$items = get_posts( $args );

						foreach ($items as $item) :
							$img = get_asesor_image( $item );

							$asesor_vars = get_post_custom( $item->ID );
					?>
					<div class="card-placeholder">
						<div class="card business-card">
							<!-- card's front -->
							<div class="front">
								<div class="row">
									<div class="col-md-4 col-sm-4">
										<figure style="background-image:url(<?php echo $img; ?>)"></figure>
									</div>
									<div class="col-md-8 col-sm-8">
										<h1 class="name"><?php print_asesor_name( $item ); ?></h1>
										<span><?php print_asesor_function( $asesor_vars ); ?></span>
										<!-- phone -->
										<div class="row">
											<div class="col-sm-3 col-xs-3">
												<div class="large-icon">
													<i class="icon fa fa-phone"></i>
												</div>
											</div>
											<div class="col-sm-9 col-xs-9">
												<ul class="phones">
													<?php print_asesor_phones( $asesor_vars ); ?>
												</ul>
											</div>
										</div>
										<?php if (!empty($asesor_vars['pin'][0])) : ?>
										<!-- pin -->
										<div class="row">
											<div class="col-sm-3 col-xs-3">
												<div class="large-icon">
													<i class="icon fa fa-paper-plane"></i>
												</div>
											</div>
											<div class="col-sm-9 col-xs-9">
												<ul class="pin">
													<li>Pin: <?php print_asesor_pin( $asesor_vars ); ?></li>
												</ul>
											</div>
										</div>
										<?php endif; ?>
										<!-- social links -->
										<div class="row">
											<div class="col-sm-9 col-xs-9">
												<ul class="social-links">
													<?php print_asesor_social_links( $asesor_vars ); ?>
												</ul>
											</div>
											<div class="col-sm-3 col-xs-3">
												<!--a class="icon-mail" href="#"><i class="fa fa-envelope"></i></a-->
											</div>
										</div>
									</div>
								</div>
								<div class="icon-mail"><i class="fa fa-envelope"></i></div>
							</div>
							<!-- card's rear -->
							<div class="back">
								<div class="contact-form-alt">
									<div class="title">
										<h1><i class="fa fa-envelope"></i>&nbsp; Ponte en contacto</h1>
									</div>
									<div class="form-holder">
										<form method="post" action="<?php echo get_template_directory_uri() . '/ajax/process_contact.php'; ?>">
											<input type="text" name="nombre" class="repeat-value" placeholder="Nombre">
											<input type="tel" name="telefono" class="repeat-value" placeholder="Teléfono">
											<input type="hidden" name="from" value="asesores_page">
											<textarea name="mensaje" placeholder="Mensaje" rows="1"></textarea>
											<input type="hidden" name="asesor_id" value="<?php echo $item->ID; ?>">
											<div class="buttons">
												<button type="submit">Enviar</button>
											</div>
										</form>
									</div>
									<div class="sending hidden">
										<div class="svg-icon-wrapper letter">
											<div class="letter-cover"></div>
										</div>
										<h1>Enviando...</h1>
									</div>
									<div class="sent hidden">
										<div class="icon-wrapper">
											<i class="icon-ok fa fa-check"></i>
										</div>
										<h1>Mensaje enviado</h1>
									</div>
									<div class="not-sent hidden">
										<div class="icon-wrapper">
											<i class="icon-bad fa fa-times-circle"></i>
										</div>
										<h1>Ha ocurrido un error.<br>Por favor intente luego</h1>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>

				</div>

			</div>

			<!-- sidebar -->
			<div class="col-md-3">
				<?php
					$narrow_finder = true;
					include('finder.php');
					include('recents.php');
				?>
			</div>
		</div>

	</div>
<?php
	$GLOBALS['script'] = <<<EOT
<script type="text/javascript">
	jQuery(document).ready(function($) {
		if ($(window).width() > 360) {
			var container = $('#cards_holder');
		    container.find('.card-placeholder').css('width', '350px');
		    container.isotope({
				itemSelector: '.card-placeholder',
				masonry: {
					columnWidth: 400,
					isFitWidth: true
				}
			});
		}

		//flipping cards
		$('.card').find('.icon-mail').click(function(e) {
			$('.card.flipped').removeClass('flipped');
			$(this).closest('.card').addClass('flipped');
			return false;
		});

		$('body').click(function(e) {
			if ($(e.target).closest('.card').length == 0) { //if ( e.target == this ) { //<-- body on blank space
				$('.card.flipped').removeClass('flipped');
			}
		});
	});
</script>
EOT;
?>
<?php get_footer(); die(); ?>















<?php
demo:
//DEMO LAYOUT
get_header(); ?>

	<!-- header -->
	<div class="container-fluid header bg-default consultants">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h1>Asesores</h1>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<!-- empty left space -->
			<div class="col-md-1">&nbsp;
			</div>

			<!-- descripction -->
			<div class="col-md-10 page-desc">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in volup</p>
			</div>

			<!-- empty right space -->
			<div class="col-md-1">&nbsp;
			</div>
		</div>
	</div>

	<div class="section container">
		
		<div class="row">
			<div class="col-md-9">
				
				<!-- cards -->
				<div id="cards_holder">
					
					<!-- contact form -->
					<!--div class="card-placeholder">
						<div class="card">
							<div class="front">
								<div class="contact-form-alt">
									<div class="title">
										<h1><i class="fa fa-envelope"></i>&nbsp; Ponte en contacto</h1>
									</div>
									<div>
										<form method="post">
											<input type="text" placeholder="Nombre">
											<input type="tel" placeholder="Teléfono">
											<input type="hidden" name="from" value="asesores_page">
											<textarea placeholder="Mensaje" rows="2"></textarea>
											<div class="buttons">
												<button type="submit">Enviar</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="back">
								<p>hello world!</p>
							</div>
						</div>
					</div-->

					<!-- to be looped -->
					<div class="card-placeholder">
						<div class="card business-card">
							<!-- card's front -->
							<div class="front">
								<div class="row">
									<div class="col-md-4 col-sm-4">
										<figure style="background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/user_demo.jpg)"></figure>
									</div>
									<div class="col-md-8 col-sm-8">
										<h1 class="name">Maigualida Papasthapoulos</h1>
										<span>Asesor de bienes raices</span>
										<!-- phone -->
										<div class="row">
											<div class="col-sm-3 col-xs-3">
												<div class="large-icon">
													<i class="icon fa fa-phone"></i>
												</div>
											</div>
											<div class="col-sm-9 col-xs-9">
												<ul class="phones">
													<li>0426-1981865</li>
													<li>0414-8767810</li>
												</ul>
											</div>
										</div>
										<!-- pin -->
										<div class="row">
											<div class="col-sm-3 col-xs-3">
												<div class="large-icon">
													<i class="icon fa fa-paper-plane"></i>
												</div>
											</div>
											<div class="col-sm-9 col-xs-9">
												<ul class="pin">
													<li>Pin: 79cbe867</li>
												</ul>
											</div>
										</div>
										<!-- social links -->
										<div class="row">
											<div class="col-sm-9 col-xs-9">
												<ul class="social-links">
													<li><a class="icon-facebook" href="http://facebook.com"><i class="fa fa-facebook-official"></i></a></li>
													<li><a class="icon-instagram" href="http://instagram.com"><i class="fa fa-instagram"></i></a></li>
													<li><a class="icon-twitter" href="http://twitter.com"><i class="fa fa-twitter"></i></a></li>
												</ul>
											</div>
											<div class="col-sm-3 col-xs-3">
												<a class="icon-mail" href="#"><i class="fa fa-envelope"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- card's rear -->
							<div class="back">
								<div class="contact-form-alt">
									<div class="title">
										<h1><i class="fa fa-envelope"></i>&nbsp; Ponte en contacto</h1>
									</div>
									<div>
										<form method="post">
											<input type="text" placeholder="Nombre">
											<input type="tel" placeholder="Teléfono">
											<input type="hidden" name="from" value="asesores_page">
											<textarea placeholder="Mensaje" rows="1"></textarea>
											<div class="buttons">
												<button type="submit">Enviar</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-placeholder">
						<div class="card business-card">
							<div class="front">
								<!-- card's front -->
								<div class="row">
									<div class="col-md-4 col-sm-4">
										<figure style="background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/user_demo.jpg)"></figure>
									</div>
									<div class="col-md-8 col-sm-8">
										<h1 class="name">Maigualida Papasthapoulos</h1>
										<span>Asesor de bienes raices</span>
										<!-- phone -->
										<div class="row">
											<div class="col-sm-3 col-xs-3">
												<div class="large-icon">
													<i class="icon fa fa-phone"></i>
												</div>
											</div>
											<div class="col-sm-9 col-xs-9">
												<ul class="phones">
													<li>0426-1981865</li>
													<li>0414-8767810</li>
												</ul>
											</div>
										</div>
										<!-- pin -->
										<div class="row">
											<div class="col-sm-3 col-xs-3">
												<div class="large-icon">
													<i class="icon fa fa-paper-plane"></i>
												</div>
											</div>
											<div class="col-sm-9 col-xs-9">
												<ul class="pin">
													<li>Pin: 79cbe867</li>
												</ul>
											</div>
										</div>
										<!-- social links -->
										<div class="row">
											<div class="col-sm-9 col-xs-9">
												<ul class="social-links">
													<li><a class="icon-facebook" href="http://facebook.com"><i class="fa fa-facebook-official"></i></a></li>
													<li><a class="icon-instagram" href="http://instagram.com"><i class="fa fa-instagram"></i></a></li>
													<li><a class="icon-twitter" href="http://twitter.com"><i class="fa fa-twitter"></i></a></li>
												</ul>
											</div>
											<div class="col-sm-3 col-xs-3">
												<a class="icon-mail" href="mailto:my@email.com"><i class="fa fa-envelope"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="back">
								<div class="contact-form-alt">
									<div class="title">
										<h1><i class="fa fa-envelope"></i>&nbsp; Ponte en contacto</h1>
									</div>
									<div>
										<form method="post">
											<input type="text" placeholder="Nombre">
											<input type="tel" placeholder="Teléfono">
											<input type="hidden" name="from" value="asesores_page">
											<textarea placeholder="Mensaje" rows="1"></textarea>
											<div class="buttons">
												<button type="submit">Enviar</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-placeholder">
						<div class="card business-card">
							<div class="front">
								<!-- card's front -->
								<div class="row">
									<div class="col-md-4 col-sm-4">
										<figure style="background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/user_demo.jpg)"></figure>
									</div>
									<div class="col-md-8 col-sm-8">
										<h1 class="name">Maigualida Papasthapoulos</h1>
										<span>Asesor de bienes raices</span>
										<!-- phone -->
										<div class="row">
											<div class="col-sm-3 col-xs-3">
												<div class="large-icon">
													<i class="icon fa fa-phone"></i>
												</div>
											</div>
											<div class="col-sm-9 col-xs-9">
												<ul class="phones">
													<li>0426-1981865</li>
													<li>0414-8767810</li>
												</ul>
											</div>
										</div>
										<!-- pin -->
										<div class="row">
											<div class="col-sm-3 col-xs-3">
												<div class="large-icon">
													<i class="icon fa fa-paper-plane"></i>
												</div>
											</div>
											<div class="col-sm-9 col-xs-9">
												<ul class="pin">
													<li>Pin: 79cbe867</li>
												</ul>
											</div>
										</div>
										<!-- social links -->
										<div class="row">
											<div class="col-sm-9 col-xs-9">
												<ul class="social-links">
													<li><a class="icon-facebook" href="http://facebook.com"><i class="fa fa-facebook-official"></i></a></li>
													<li><a class="icon-instagram" href="http://instagram.com"><i class="fa fa-instagram"></i></a></li>
													<li><a class="icon-twitter" href="http://twitter.com"><i class="fa fa-twitter"></i></a></li>
												</ul>
											</div>
											<div class="col-sm-3 col-xs-3">
												<a class="icon-mail" href="mailto:my@email.com"><i class="fa fa-envelope"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="back">

							</div>
						</div>
					</div>
					<div class="card-placeholder">
						<div class="card business-card">
							<div class="front">
								<!-- card's front -->
								<div class="row">
									<div class="col-md-4 col-sm-4">
										<figure style="background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/user_demo.jpg)"></figure>
									</div>
									<div class="col-md-8 col-sm-8">
										<h1 class="name">Maigualida Papasthapoulos</h1>
										<span>Asesor de bienes raices</span>
										<!-- phone -->
										<div class="row">
											<div class="col-sm-3 col-xs-3">
												<div class="large-icon">
													<i class="icon fa fa-phone"></i>
												</div>
											</div>
											<div class="col-sm-9 col-xs-9">
												<ul class="phones">
													<li>0426-1981865</li>
													<li>0414-8767810</li>
												</ul>
											</div>
										</div>
										<!-- pin -->
										<div class="row">
											<div class="col-sm-3 col-xs-3">
												<div class="large-icon">
													<i class="icon fa fa-paper-plane"></i>
												</div>
											</div>
											<div class="col-sm-9 col-xs-9">
												<ul class="pin">
													<li>Pin: 79cbe867</li>
												</ul>
											</div>
										</div>
										<!-- social links -->
										<div class="row">
											<div class="col-sm-9 col-xs-9">
												<ul class="social-links">
													<li><a class="icon-facebook" href="http://facebook.com"><i class="fa fa-facebook-official"></i></a></li>
													<li><a class="icon-instagram" href="http://instagram.com"><i class="fa fa-instagram"></i></a></li>
													<li><a class="icon-twitter" href="http://twitter.com"><i class="fa fa-twitter"></i></a></li>
												</ul>
											</div>
											<div class="col-sm-3 col-xs-3">
												<a class="icon-mail" href="mailto:my@email.com"><i class="fa fa-envelope"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="back">

							</div>
						</div>
					</div>
					<div class="card-placeholder">
						<div class="card business-card">
							<div class="front">
								<!-- card's front -->
								<div class="row">
									<div class="col-md-4 col-sm-4">
										<figure style="background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/user_demo.jpg)"></figure>
									</div>
									<div class="col-md-8 col-sm-8">
										<h1 class="name">Maigualida Papasthapoulos</h1>
										<span>Asesor de bienes raices</span>
										<!-- phone -->
										<div class="row">
											<div class="col-sm-3 col-xs-3">
												<div class="large-icon">
													<i class="icon fa fa-phone"></i>
												</div>
											</div>
											<div class="col-sm-9 col-xs-9">
												<ul class="phones">
													<li>0426-1981865</li>
													<li>0414-8767810</li>
												</ul>
											</div>
										</div>
										<!-- pin -->
										<div class="row">
											<div class="col-sm-3 col-xs-3">
												<div class="large-icon">
													<i class="icon fa fa-paper-plane"></i>
												</div>
											</div>
											<div class="col-sm-9 col-xs-9">
												<ul class="pin">
													<li>Pin: 79cbe867</li>
												</ul>
											</div>
										</div>
										<!-- social links -->
										<div class="row">
											<div class="col-sm-9 col-xs-9">
												<ul class="social-links">
													<li><a class="icon-facebook" href="http://facebook.com"><i class="fa fa-facebook-official"></i></a></li>
													<li><a class="icon-instagram" href="http://instagram.com"><i class="fa fa-instagram"></i></a></li>
													<li><a class="icon-twitter" href="http://twitter.com"><i class="fa fa-twitter"></i></a></li>
												</ul>
											</div>
											<div class="col-sm-3 col-xs-3">
												<a class="icon-mail" href="mailto:my@email.com"><i class="fa fa-envelope"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="back">

							</div>
						</div>
					</div>
					<!-- /to be looped -->

				</div>

			</div>

			<!-- sidebar -->
			<div class="col-md-3">
				<?php
					$narrow_finder = true;
					include('finder.php');
				?>

				<div class="recent-items">

					<h1>Inmuebles Recientes</h1>
					
					<div class="row">
						<!-- to be looped -->
						<div class="thumb col-md-12 col-sm-6 col-xs-6">
							<div class="box-thumb">
								<a href="#">
									<div class="content" style="background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png)">
										<ul>
											<li><i class="custom-icon icon-bed"></i> 4</li>
											<li><i class="custom-icon icon-tub"></i> 2</li>
											<li><i class="custom-icon icon-pool"></i> 1</li>
										</ul>
										<span class="area">900mt2</span>
									</div>
									<h2>Res. villa cualquier $@#!</h2>
								</a>
							</div>
						</div>
						<div class="thumb col-md-12 col-sm-6 col-xs-6">
							<div class="box-thumb">
								<a href="#">
									<div class="content" style="background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png)">
										<ul>
											<li><i class="custom-icon icon-bed"></i> 4</li>
											<li><i class="custom-icon icon-tub"></i> 2</li>
											<li><i class="custom-icon icon-pool"></i> 1</li>
										</ul>
										<span class="area">900mt2</span>
									</div>
									<h2>Res. villa cualquier $@#!</h2>
								</a>
							</div>
						</div>
						<div class="thumb col-md-12 col-sm-6 col-xs-6">
							<div class="box-thumb">
								<a href="#">
									<div class="content" style="background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png)">
										<ul>
											<li><i class="custom-icon icon-bed"></i> 4</li>
											<li><i class="custom-icon icon-tub"></i> 2</li>
											<li><i class="custom-icon icon-pool"></i> 1</li>
										</ul>
										<span class="area">900mt2</span>
									</div>
									<h2>Res. villa cualquier $@#!</h2>
								</a>
							</div>
						</div>
						<div class="thumb col-md-12 col-sm-6 col-xs-6">
							<div class="box-thumb">
								<a href="#">
									<div class="content" style="background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png)">
										<ul>
											<li><i class="custom-icon icon-bed"></i> 4</li>
											<li><i class="custom-icon icon-tub"></i> 2</li>
											<li><i class="custom-icon icon-pool"></i> 1</li>
										</ul>
										<span class="area">900mt2</span>
									</div>
									<h2>Res. villa cualquier $@#!</h2>
								</a>
							</div>
						</div>
						<!-- /to be looped -->
					</div>

				</div>
			</div>
		</div>

	</div>
<?php
	$GLOBALS['script'] = <<<EOT
<script type="text/javascript">
	jQuery(document).ready(function($) {
		if ($(window).width() > 360) {
			var container = $('#cards_holder');
		    container.find('.card-placeholder').css('width', '350px');
		    container.isotope({
				itemSelector: '.card-placeholder',
				masonry: {
					columnWidth: 400,
					isFitWidth: true
				}
			});
		}

		//flipping cards
		$('.card').find('.icon-mail').click(function(e) {
			$('.card.flipped').removeClass('flipped');
			$(this).closest('.card').addClass('flipped');
			return false;
		});

		$('body').click(function(e) {
			if ($(e.target).closest('.card').length == 0) { //if ( e.target == this ) { //<-- body on blank space
				$('.card.flipped').removeClass('flipped');
			}
		});
	});
</script>
EOT;
?>
<?php get_footer(); ?>