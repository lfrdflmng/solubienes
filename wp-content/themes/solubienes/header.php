<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Solubienes
 * @since Solubienes 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/swiper.min.css">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/magic.min.css">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/animate.min.css">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/slick.css">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/bootstrap-slider.min.css">
	
	<!-- fonts -->
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Advent+Pro:300,400,600">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500">

	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<script>(function(){document.documentElement.className='js'})();</script>
	<?php wp_head(); ?>
</head>

<body>

	<header class="container-fluid navbar-fixed-top">
		<div class="row">
			<div class="col-md-3 col-sm-4 col-xs-10 text-center">
				
				<figure class="logo">
					<a href="<?php echo home_url(); ?>">
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/logo.svg" alt="Solubienes F&amp;C">
					</a>
				</figure>

			</div>

			<div class="col-md-6 col-sm-8 col-xs-2">
				<div class="hidden-xs top-menu">
					<?php wp_nav_menu( array( 'menu' => 'Superior' ) ); ?>
				</div>
				<div class="visible-xs">
					<a href="#" class="mobile-menu-btn">
						<i class="fa fa-bars"></i>
					</a>
				</div>
			</div>

			<div class="col-xs-12 mobile-menu hidden">
				<?php wp_nav_menu( array( 'menu' => 'Superior' ) ); ?>
			</div>

			<div class="col-md-3 col-sm-12 hidden-xs text-right left-inf">

				<!-- social icons -->
				<div class="row">
					<div class="col-md-12">
						<ul class="social-icons">
							<li>
								<i class="fa fa-facebook"></i>
							</li>
							<li>
								<i class="fa fa-twitter"></i>
							</li>
							<li>
								<i class="fa fa-instagram"></i>
							</li>
						</ul>
					</div>
				</div>

				<!-- phone number -->
				<div class="row color-bar hidden-sm">
					<div class="col-md-10 text-left">
						<!--i class="custom-icon icon-phone"></i-->
						<i class="fa fa-phone"></i>
						<span>(0286)555.55.55</span>
					</div>
					<div class="col-md-2 text-right">
						<a href="#" class="login-btn">
							<i class="custom-icon icon-key"></i>
						</a>
					</div>
				</div>

			</div>
		</div>

		<!-- hover menu -->
		<div id="hover_menu" class="hover-menu hidden-xs hidden-sm">
			<div class="row">
				
				<div class="col-md-2">
					<ul class="categories">
						<li id="alquiler" class="active">Alquiler</li>
						<li id="venta">Venta</li>
						<li id="locales">Locales</li>
						<li id="terrenos">Terrenos</li>
					</ul>
				</div>

				<!-- to be looped 4 times for each category -->
				<div class="col-md-2 thumb alquiler">
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
				<div class="col-md-2 thumb alquiler">
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
				<div class="col-md-2 thumb alquiler">
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
							<h2>Residence villa cualquier whatever</h2>
						</a>
					</div>
				</div>
				<div class="col-md-2 thumb alquiler">
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

				<div class="col-md-2 thumb venta" style="display:none !important">
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
				<div class="col-md-2 thumb venta" style="display:none !important">
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
				<div class="col-md-2 thumb venta" style="display:none !important">
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
				<div class="col-md-2 thumb venta" style="display:none !important">
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

				<div class="col-md-2 thumb locales" style="display:none !important">
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
							<h2>local 1</h2>
						</a>
					</div>
				</div>
				<div class="col-md-2 thumb locales" style="display:none !important">
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
							<h2>local 2 has a very long name to test if this can fit it all</h2>
						</a>
					</div>
				</div>
				<div class="col-md-2 thumb locales" style="display:none !important">
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
							<h2>local 3</h2>
						</a>
					</div>
				</div>

				<div class="col-md-2 thumb terrenos" style="display:none !important">
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
							<h2>terreno uno</h2>
						</a>
					</div>
				</div>
				<div class="col-md-2 thumb terrenos" style="display:none !important">
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
							<h2>terreno dos</h2>
						</a>
					</div>
				</div>

				<div class="col-md-2">
					<div class="table-center">
						<a href="#" class="more table-cell-center">Ver más &gt;&gt;</a>
					</div>
				</div>

			</div>
		</div>
	</header>