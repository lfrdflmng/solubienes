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

load_custom_settings();

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
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/logo.svg" alt="Solubienes F&amp;C" title="Solubienes F&amp;C - Mi Solución Inmobiliaria">
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
						<?php
							print_social('facebook');
							print_social('twitter');
							print_social('instagram');
						?>
						</ul>
					</div>
				</div>

				<!-- phone number -->
				<div class="row color-bar hidden-sm">
					<div class="col-md-10 text-left">
						<!--i class="custom-icon icon-phone"></i-->
						<i class="fa fa-phone"></i>
						<span><?php print_phone(); ?></span>
					</div>
					<div class="col-md-2 text-right">
						<a href="#" class="login-btn" data-toggle="modal" data-target="#login_modal">
							<?php if (is_user_logged_in()) : ?>
							<i class="fa fa-unlock-alt"></i>
							<?php else : ?>
							<i class="custom-icon icon-key"></i>
							<?php endif; ?>
						</a>
					</div>
				</div>

			</div>
		</div>

		<!-- hover menu -->
		<?php
			$categories = array(
				'casa',
				'apartamento',
				'local',
				'terreno'
			);
			$first_cat = reset($categories);
		?>
		<div id="hover_menu" class="hover-menu hidden-xs hidden-sm">
			<div class="row">
				
				<div class="col-md-2">
					<ul class="categories">
						<?php foreach ($categories as $category) : ?>
						<li id="<?php echo $category ?>" class="<?php echo $category == $first_cat ? 'active' : ''; ?>">
							<?php echo ucfirst($category); ?>
						</li>
						<?php endforeach; ?>
						<?php if (is_user_logged_in()) : ?>
						<li id="misfavoritos"><i class="fa fa-star"></i> Mis favoritos</li>
						<?php endif; ?>
					</ul>
				</div>

				<?php
					$properties = array();

					foreach ($categories as $category) {
						$args = array(
							'posts_per_page' => 4,
							'post_type' => 'solubienes',
							'tipo' => $category
						);
						
						$items = get_posts( $args );

						$i = 0;
						foreach ($items as $item) {
							$properties[$category . '_' . $i] = $item;
							$i++;
						}
					}

					//get users favorites
					if (is_user_logged_in()) {
						$items = $wpdb->get_results('SELECT propiedad_id FROM favoritos WHERE usuario_id = ' . get_current_user_id() . ' AND propiedad_id > 0 LIMIT 4');
						$i = 0;
						foreach ($items as $item) {
							$properties['misfavoritos_' . $i] = get_post($item->propiedad_id);
							$i++;
						}
					}
					
					foreach ($properties as $key => $item) :
						$project_vars = get_post_custom( $item->ID );

						$img = get_property_image( $project_vars, 'thumb' );
				?>
				<div class="col-md-2 thumb <?php echo reset(explode('_', $key)); ?>">
					<div class="box-thumb">
						<a href="<?php echo $item->guid; ?>">
							<div class="content" style="background-image:url(<?php echo $img; ?>)">
								<ul>
									<?php print_property_quantities( $project_vars, 1 ); ?>
								</ul>
								<span class="area"><?php print_property_area( $project_vars ); ?></span>
							</div>
							<h2><?php print_property_title( $item ); ?></h2>
						</a>
					</div>
				</div>
				<?php endforeach; ?>

				<div class="col-md-2">
					<div class="table-center">
						<a id="hover_view_more" href="<?php echo home_url(); ?>" class="more table-cell-center">Ver más &gt;&gt;</a>
					</div>
				</div>

			</div>
		</div>
	</header>