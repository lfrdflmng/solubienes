<div class="recent-items">

	<h1>Inmuebles Recientes</h1>
	
	<div class="row">
		<?php
			$args = array(
				'posts_per_page' => 4,
				'post_type' => 'solubienes'
			);
			
			$items = get_posts( $args );
			
			foreach ($items as $item) :
				$project_vars = get_post_custom( $item->ID );
				$img = get_property_image( $project_vars, 'thumb' );
		?>
		<div class="thumb col-md-12 col-sm-6 col-xs-6">
			<div class="box-thumb">
				<a href="<?php echo $item->guid; ?>">
					<div class="content" style="background-image:url(<?php echo $img; ?>)">
						<ul>
							<?php print_property_quantities( $project_vars, 1 ); ?>
						</ul>
						<span class="area"><?php print_property_area( $project_vars ); ?></span>
					</div>
					<h2><?php print_property_title($item); ?></h2>
				</a>
			</div>
		</div>
		<?php endforeach; ?>
	</div>

</div>