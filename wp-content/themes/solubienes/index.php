<?php
 /*
 * @package WordPress
 * @subpackage Solubienes
 * @since Solubienes 1.0
 */

if (isset($_GET['demo'])) goto demo;

$inicio_vars = get_post_custom( get_page_by_title('Inicio')->ID );

$title = $inicio_vars['titulo'][0];
$subtitle = $inicio_vars['subtitulo'][0];
$description = $inicio_vars['descripcion'][0];

if (is_home()) {
	$feat_image = wp_get_attachment_url( get_post_thumbnail_id( get_page_by_title('Inicio')->ID ) );
}
else {
	$feat_image = false;
}

get_header(); ?>

	<?php if (!empty($feat_image)) : ?>
	<div class="main container-fluid" style="background-image:url(<?php echo $feat_image; ?>)">
	<?php else : ?>
	<div class="main container-fluid">
	<?php endif; ?>
		<div class="row">
			<!-- empty left space -->
			<div class="col-md-1">&nbsp;
			</div>

			<!-- search box -->
			<div class="col-md-4">

				<?php
					$narrow_finder = true;
					include('templates/finder.php');
				?>

			</div>

			<!-- title & desc -->
			<div class="col-md-6 main-desc">
				<h1><?php echo $title; ?></h1>
				<h2><?php echo $subtitle; ?></h2>
			</div>

			<!-- empty right space -->
			<div class="col-md-1">&nbsp;
			</div>

		</div>

		<!-- blue box -->
		<div class="row boxed-desc">
			<!-- empty left space -->
			<div class="col-md-3">&nbsp;
			</div>

			<!-- content -->
			<div class="col-md-6 content">
				<p><?php echo $description; ?></p>
			</div>

			<!-- empty right space -->
			<div class="col-md-3">&nbsp;
			</div>
		</div>
	</div>

	<!-- new items -->
	<div class="section container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h2>Proyectos Nuevos</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 with-arrows">
				<div class="arrow left hidden-xs"></div>
				<div class="arrow right hidden-xs"></div>

				<!-- coverflow -->
				<div class="swiper-container">
					<div class="swiper-wrapper">

						<?php
							$new_projects_fixed = array();
							$new_projects_fixed_ids = array();

							for ($i = 1; $i <= 3; $i++) {
								if ($inicio_vars['nuevo_proyecto_' . $i][0] > 0) {
									$new_projects_fixed[] = get_post( $inicio_vars['nuevo_proyecto_' . $i][0] );
									$new_projects_fixed_ids[] = $inicio_vars['nuevo_proyecto_' . $i][0];
								}
							}

							$args = array(
								'post_type' => 'solubienes',
								'tipo' => 'conjunto-residencial',
								'post__not_in' => $new_projects_fixed_ids
							);

							$new_projects = get_posts( $args );

							foreach ($new_projects as $project) {
								//if (!in_array($project->ID, $new_projects_fixed_ids)) { // irrelevant due to: 'post__not_in' => $new_projects_fixed_ids
									$new_projects_fixed[] = $new_projects;
								//}
							}

							foreach ($new_projects_fixed as $project) :
								$project_vars = get_post_custom( $project->ID );

								$img = get_property_image( $project_vars );
						?>
						<div class="swiper-slide">
							
							<a class="no-decoration" href="<?php echo $project->guid; ?>">
								<div class="box new">
									<div class="title" style="background-image:url(<?php echo $img; ?>)">
										<h2><?php echo $project->post_title ?></h2>
										<div class="star" data-id="<?php echo $project->ID; ?>">
											<i class="fa fa-star"></i>
										</div>
									</div>
									<div class="icons">
										<?php print_property_quantities( $project_vars ); ?>
									</div>
									<div class="icons_more">
										<span>Beneficios</span>
										<?php print_property_benefits( $project_vars ); ?>
									</div>
									<div class="price">
										<span><?php print_property_price( $project_vars ); ?></span>
									</div>
								</div>
							</a>

						</div>
						<?php endforeach; ?>

					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- highlighted items -->
	<div class="section container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="with-margin-top">Propiedades Destacadas</h2>
			</div>
		</div>
		<div class="row highlight-container">
			
			<?php
				$highligted_projects = array();

				for ($i = 1; $i <= 3; $i++) {
					$post_id = (int)$inicio_vars['propiedad_destacada_' . $i][0];
					if ($post_id > 0) {
						$highligted_projects[] = get_post( $post_id );
					}
				}

				foreach ($highligted_projects as $project) :
					$project_vars = get_post_custom( $project->ID );

					$img = get_property_image( $project_vars );
			?>
			<a href="<?php echo $project->guid; ?>">
				<div class="col-md-4">
					<div class="box highlight">
						<div class="title" style="background-image:url(<?php echo $img; ?>)">
							<h2><?php echo $project->post_title; ?></h2>
							<div class="star" data-id="<?php echo $project->ID; ?>">
								<i class="fa fa-star"></i>
							</div>
						</div>
						<div class="icons">
							<?php print_property_quantities( $project_vars ); ?>
						</div>
						<div class="location">
							<i class="fa fa-map-marker"></i>
							<?php print_property_location( $project_vars ); ?>
						</div>
						<div class="desc">
							<p><?php print_property_description( $project_vars ); ?></p>
						</div>
						<div class="icons_more">
							<span>Beneficios</span>
							<?php print_property_benefits( $project_vars ); ?>
						</div>
						<div class="price">
							<span><?php print_property_price( $project_vars ); ?></span>
						</div>
					</div>
				</div>
			</a>
			<?php endforeach; ?>

		</div>
	</div>

	<!-- testimonials -->
	<?php
		$video = $inicio_vars['youtube_testimonio_1'][0];
		if (strlen($video)) :
	?>
	<div class="testimonials container">
		<!-- title -->
		<div class="row">
			<div class="col-md-12">
				<h1>Testimonios</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-sm-6 video">
				<div class="video-container">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $video; ?>?rel=0&amp;controls=0&amp;showinfo=0" allowfullscreen></iframe>
				</div>
			</div>

			<div class="col-md-6 col-sm-6 content">
				<div class="content-holder">
					<h2><?php echo $inicio_vars['titulo_testimonio_1'][0]; ?></h2>
					<p><?php echo $inicio_vars['descripcion_testimonio_1'][0]; ?></p>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<!-- blog -->
	<div class="blog container">
		<div class="row">
			<div class="col-md-12">
				<h1><i class="fa fa-quote-right"></i>&nbsp;En el Blog</h1>
			</div>
		</div>

		<!-- items -->
		<div class="row">

			<?php
				$args = array(
					'posts_per_page' => 2,
					'post_type' => 'post'
				);

				$items = get_posts( $args );

				foreach ($items as $item) :
					$img = get_blog_image($item);
			?>
			<div class="col-md-6 col-sm-6 blog-thumb">
				
				<div class="row">
					<!-- image -->
					<div class="col-md-6">
						<div class="image" style="background-image:url(<?php echo $img; ?>)">
							<a href="<?php echo $item->guid; ?>">&nbsp;</a>
						</div>
					</div>

					<!-- content -->
					<div class="col-md-6 content">
						<h2><a href="<?php echo $item->guid; ?>"><?php echo $item->post_title; ?></a></h2>
						<p><?php print_blog_content($item, false); ?></p>
						<a class="more" href="<?php echo $item->guid; ?>">Leer más...</a>
					</div>
				</div>

			</div>
			<?php endforeach; ?>

		</div>
	</div>

<?php get_footer(); die(); ?>












<?php
demo:
//DEMO LAYOUT
get_header(); ?>

	<div class="main container-fluid">
		<div class="row">
			<!-- empty left space -->
			<div class="col-md-1">&nbsp;
			</div>

			<!-- search box -->
			<div class="col-md-4">

				<?php
					$narrow_finder = true;
					include('templates/finder.php');
				?>

			</div>

			<!-- title & desc -->
			<div class="col-md-6 main-desc">
				<h1>Lorem ipsum dolor sit amet</h1>
				<h2>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua, ut enim ad minim veniam.</h2>
			</div>

			<!-- empty right space -->
			<div class="col-md-1">&nbsp;
			</div>

		</div>

		<!-- blue box -->
		<div class="row boxed-desc">
			<!-- empty left space -->
			<div class="col-md-3">&nbsp;
			</div>

			<!-- content -->
			<div class="col-md-6 content">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>
			</div>

			<!-- empty right space -->
			<div class="col-md-3">&nbsp;
			</div>
		</div>
	</div>

	<!-- new items -->
	<div class="section container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h2>Proyectos Nuevos</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 with-arrows">
				<div class="arrow left hidden-xs"></div>
				<div class="arrow right hidden-xs"></div>

				<!-- coverflow -->
				<div class="swiper-container">
					<div class="swiper-wrapper">

						<div class="swiper-slide">
							
							<div class="box new">
								<div class="title" style="background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png)">
									<h2>Casa en 25 de marzo</h2>
									<div class="star">
										<i class="fa fa-star"></i>
									</div>
								</div>
								<div class="icons">
									<span><i class="custom-icon icon-graph"></i> 210 mts2</span>
									<span><i class="custom-icon icon-bed"></i> 2</span>
									<span><i class="custom-icon icon-tub"></i> 3</span>
									<span><i class="custom-icon icon-cab"></i> 1</span>
								</div>
								<div class="icons_more">
									<span>Beneficios</span>
									<span><i class="custom-icon icon-wifi"></i></span>
									<span><i class="custom-icon icon-stethoscope"></i></span>
									<span><i class="custom-icon icon-bus"></i></span>
									<span><i class="custom-icon icon-basket"></i></span>
									<span><i class="custom-icon icon-pool"></i></span>
								</div>
								<div class="price">
									<span>999.999.999 Bsf.</span>
								</div>
							</div>

						</div>


						<div class="swiper-slide">
							
							<div class="box new">
								<div class="title" style="background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png)">
									<h2>Casa en 25 de marzo</h2>
									<div class="star"> <!-- TODO: this is for bookmarking -->
										<i class="fa fa-star"></i>
									</div>
								</div>
								<div class="icons">
									<span><i class="custom-icon icon-graph"></i> 210 mts2</span>
									<span><i class="custom-icon icon-bed"></i> 2</span>
									<span><i class="custom-icon icon-tub"></i> 3</span>
									<span><i class="custom-icon icon-cab"></i> 1</span>
								</div>
								<div class="icons_more">
									<span>Beneficios</span>
									<span><i class="custom-icon icon-wifi"></i></span>
									<span><i class="custom-icon icon-stethoscope"></i></span>
									<span><i class="custom-icon icon-bus"></i></span>
									<span><i class="custom-icon icon-basket"></i></span>
									<span><i class="custom-icon icon-pool"></i></span>
								</div>
								<div class="price">
									<span>999.999.999 Bsf.</span>
								</div>
							</div>

						</div>

						<div class="swiper-slide">
							
							<div class="box new">
								<div class="title" style="background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png)">
									<h2>Casa en 25 de marzo</h2>
									<div class="star">
										<i class="fa fa-star"></i>
									</div>
								</div>
								<div class="icons">
									<span><i class="custom-icon icon-graph"></i> 210 mts2</span>
									<span><i class="custom-icon icon-bed"></i> 2</span>
									<span><i class="custom-icon icon-tub"></i> 3</span>
									<span><i class="custom-icon icon-cab"></i> 1</span>
								</div>
								<div class="icons_more">
									<span>Beneficios</span>
									<span><i class="custom-icon icon-wifi"></i></span>
									<span><i class="custom-icon icon-stethoscope"></i></span>
									<span><i class="custom-icon icon-bus"></i></span>
									<span><i class="custom-icon icon-basket"></i></span>
									<span><i class="custom-icon icon-pool"></i></span>
								</div>
								<div class="price">
									<span>999.999.999 Bsf.</span>
								</div>
							</div>

						</div>

						<div class="swiper-slide">
							
							<div class="box new">
								<div class="title" style="background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png)">
									<h2>Casa en 25 de marzo</h2>
									<div class="star">
										<i class="fa fa-star"></i>
									</div>
								</div>
								<div class="icons">
									<span><i class="custom-icon icon-graph"></i> 210 mts2</span>
									<span><i class="custom-icon icon-bed"></i> 2</span>
									<span><i class="custom-icon icon-tub"></i> 3</span>
									<span><i class="custom-icon icon-cab"></i> 1</span>
								</div>
								<div class="icons_more">
									<span>Beneficios</span>
									<span><i class="custom-icon icon-wifi"></i></span>
									<span><i class="custom-icon icon-stethoscope"></i></span>
									<span><i class="custom-icon icon-bus"></i></span>
									<span><i class="custom-icon icon-basket"></i></span>
									<span><i class="custom-icon icon-pool"></i></span>
								</div>
								<div class="price">
									<span>999.999.999 Bsf.</span>
								</div>
							</div>

						</div>

					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- highlighted items -->
	<div class="section container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="with-margin-top">Propiedades Destacadas</h2>
			</div>
		</div>
		<div class="row highlight-container">
			
			<div class="col-md-4">
				<div class="box highlight">
					<div class="title" style="background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png)">
						<h2>Casa en 25 de marzo</h2>
						<div class="star">
							<i class="fa fa-star"></i>
						</div>
					</div>
					<div class="icons">
						<span><i class="custom-icon icon-graph"></i> 210 mts2</span>
						<span><i class="custom-icon icon-bed"></i> 2</span>
						<span><i class="custom-icon icon-tub"></i> 3</span>
						<span><i class="custom-icon icon-cab"></i> 1</span>
					</div>
					<div class="location">
						<i class="fa fa-map-marker"></i>
						Manoa, San Félix
					</div>
					<div class="desc">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>
					<div class="icons_more">
						<span>Beneficios</span>
						<span><i class="custom-icon icon-wifi"></i></span>
						<span><i class="custom-icon icon-stethoscope"></i></span>
						<span><i class="custom-icon icon-bus"></i></span>
						<span><i class="custom-icon icon-basket"></i></span>
						<span><i class="custom-icon icon-pool"></i></span>
					</div>
					<div class="price">
						<span>999.999.999 Bsf.</span>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="box highlight">
					<div class="title" style="background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png)">
						<h2>Casa en 25 de marzo</h2>
						<div class="star">
							<i class="fa fa-star"></i>
						</div>
					</div>
					<div class="icons">
						<span><i class="custom-icon icon-graph"></i> 210 mts2</span>
						<span><i class="custom-icon icon-bed"></i> 2</span>
						<span><i class="custom-icon icon-tub"></i> 3</span>
						<span><i class="custom-icon icon-cab"></i> 1</span>
					</div>
					<div class="location">
						<i class="fa fa-map-marker"></i>
						Manoa, San Félix
					</div>
					<div class="desc">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>
					<div class="icons_more">
						<span>Beneficios</span>
						<span><i class="custom-icon icon-wifi"></i></span>
						<span><i class="custom-icon icon-stethoscope"></i></span>
						<span><i class="custom-icon icon-bus"></i></span>
						<span><i class="custom-icon icon-basket"></i></span>
						<span><i class="custom-icon icon-pool"></i></span>
					</div>
					<div class="price">
						<span>999.999.999 Bsf.</span>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="box highlight">
					<div class="title" style="background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png)">
						<h2>Casa en 25 de marzo</h2>
						<div class="star">
							<i class="fa fa-star"></i>
						</div>
					</div>
					<div class="icons">
						<span><i class="custom-icon icon-graph"></i> 210 mts2</span>
						<span><i class="custom-icon icon-bed"></i> 2</span>
						<span><i class="custom-icon icon-tub"></i> 3</span>
						<span><i class="custom-icon icon-cab"></i> 1</span>
					</div>
					<div class="location">
						<i class="fa fa-map-marker"></i>
						Manoa, San Félix
					</div>
					<div class="desc">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>
					<div class="icons_more">
						<span>Beneficios</span>
						<span><i class="custom-icon icon-wifi"></i></span>
						<span><i class="custom-icon icon-stethoscope"></i></span>
						<span><i class="custom-icon icon-bus"></i></span>
						<span><i class="custom-icon icon-basket"></i></span>
						<span><i class="custom-icon icon-pool"></i></span>
					</div>
					<div class="price">
						<span>999.999.999 Bsf.</span>
					</div>
				</div>
			</div>

		</div>
	</div>

	<!-- testimonials -->
	<div class="testimonials container">
		<!-- title -->
		<div class="row">
			<div class="col-md-12">
				<h1>Testimonios</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-sm-6 video">
				<div class="video-container">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/LFYNP40vfmE?rel=0&amp;controls=0&amp;showinfo=0" allowfullscreen></iframe>
				</div>
			</div>

			<div class="col-md-6 col-sm-6 content">
				<div class="content-holder">
					<h2>Lorem ipsum dolor sit amet</h2>
					<p>consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
				</div>
			</div>
		</div>
	</div>

	<!-- blog -->
	<div class="blog container">
		<div class="row">
			<div class="col-md-12">
				<h1><i class="fa fa-quote-right"></i>&nbsp;En el Blog</h1>
			</div>
		</div>

		<!-- items -->
		<div class="row">

			<!-- to be looped -->
			<div class="col-md-6 col-sm-6 blog-thumb">
				
				<div class="row">
					<!-- image -->
					<div class="col-md-6">
						<div class="image" style="background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder.jpg)">
							<a href="#">&nbsp;</a>
						</div>
					</div>

					<!-- content -->
					<div class="col-md-6 content">
						<h2><a href="#">Lorem ipsum dolor</a></h2>
						<p>sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad</p>
						<a class="more" href="#">Leer más...</a>
					</div>
				</div>

			</div>

			<div class="col-md-6 col-sm-6 blog-thumb">
				
				<div class="row">
					<!-- image -->
					<div class="col-md-6">
						<div class="image" style="background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder.jpg)">
							<a href="#">&nbsp;</a>
						</div>
					</div>

					<!-- content -->
					<div class="col-md-6 content">
						<h2><a href="#">Lorem ipsum dolor</a></h2>
						<p>sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad</p>
						<a class="more" href="#">Leer más...</a>
					</div>
				</div>

			</div>

		</div>
	</div>

<?php get_footer(); ?>