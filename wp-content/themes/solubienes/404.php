<?php
 /*
 * @subpackage Solubienes
 * @since Solubienes 1.0
 */

get_header(); ?>

	<!-- header -->
	<div class="container-fluid header bg-default not-found">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h1><?php echo $post->post_title; ?></h1>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<!-- empty left space -->
			<div class="col-md-1">&nbsp;
			</div>

			<!-- finder -->
			<div class="col-md-10 content">
				<?php
					$narrow_finder = false;
					include('templates/finder.php');
				?>
			</div>

			<!-- empty right space -->
			<div class="col-md-1">&nbsp;
			</div>
		</div>
	</div>

	<!-- new items -->
	<div class="section container">
		<div class="row">
			<div class="col-md-12">

				<div class="box-container">
				
					<?php
						$args = array(
							'posts_per_page' => 50,
							'post_type' => 'solubienes'
						);

						$projects = get_posts( $args );

						foreach ($projects as $project) :
							$project_vars = get_post_custom( $project->ID );

							$img = get_property_image( $project_vars );

							$coordenates[] = get_property_coordenates( $project_vars );
							$titles[] = str_replace('\'', '', $project->post_title);
					?>
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
					<?php endforeach; ?>

				</div>

			</div>
		</div>
	</div>
<?php get_footer(); ?>