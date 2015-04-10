<?php
 /*
 * @subpackage Solubienes
 * @since Solubienes 1.0
 */

 if (isset($_GET['cat'])) goto blog_archive;

get_header(); ?>

	<!-- map -->
	<div class="map">
		<div id="google_map" class="top"></div>
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

						$coordenates = array();
						$titles = array();

						if ($_GET['tipo'] != 'misfavoritos') {
							$args = array(
								'posts_per_page' => 50,
								'post_type' => 'solubienes'
							);

							if (!empty($_GET['tipo'])) {
								$args['tipo'] = $_GET['tipo'];
							}

							$projects = get_posts( $args );
						}
						else {
							if (is_user_logged_in()) {
								$items = $wpdb->get_results('SELECT propiedad_id FROM favoritos WHERE usuario_id = ' . get_current_user_id() . ' AND propiedad_id > 0 LIMIT 50');
								$i = 0;
								foreach ($items as $item) {
									$projects[] = get_post($item->propiedad_id);
									$i++;
								}
							}
						}

						foreach ($projects as $project) :
							$project_vars = get_post_custom( $project->ID );

							$img = get_property_image( $project_vars );

							$coordenates[] = get_property_coordenates( $project_vars );
							$titles[] = str_replace('\'', '', $project->post_title);
					?>
					<a href="<?php echo $project->guid; ?>">
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
					</a>
					<?php endforeach; ?>

				</div>

			</div>
		</div>
	</div>
<?php
	foreach ($coordenates as $key => $loc) {
		if (!empty($loc)) {
			if ($first_coordenates == '') $first_coordenates = $loc;
		}
	}
	if (empty($first_coordenates)) {
		$first_coordenates = get_contacto_coordenates();
	}

	$GLOBALS['script'] = <<<EOT
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript">
	function initialize() {
	  // Create an array of styles.
	  var styles = [
	    {
	      stylers: [
	        { hue: "#00ffe6" },
	        { saturation: -20 }
	      ]
	    },{
	      featureType: "road",
	      elementType: "geometry",
	      stylers: [
	        { lightness: 100 },
	        { visibility: "simplified" }
	      ]
	    },{
	      featureType: "road",
	      elementType: "labels",
	      stylers: [
	        { visibility: "off" }
	      ]
	    }
	  ];

	  // Create a new StyledMapType object, passing it the array of styles,
	  // as well as the name to be displayed on the map type control.
	  var styledMap = new google.maps.StyledMapType(styles,
	    {name: "Styled Map"});

	  // Create a map object, and include the MapTypeId to add
	  // to the map type control.
	  var mapOptions = {
	    zoom: 11,
	    center: new google.maps.LatLng({$first_coordenates}),
	    mapTypeControlOptions: {
	      mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
	    }
	  };
	  var map = new google.maps.Map(document.getElementById('google_map'), mapOptions);

	  //Associate the styled map with the MapTypeId and set it to display.
	  map.mapTypes.set('map_style', styledMap);
	  map.setMapTypeId('map_style');
EOT;

	//creates markers for all the items
	$url = get_template_directory_uri();
	$i = 0;
	foreach ($coordenates as $key => $loc) {
		if (!empty($loc)) {
			if ($first_coordenates == '') $first_coordenates = $loc;
			$title = $titles[$key];
			$GLOBALS['script'] .= <<<EOT

	  var marker{$i} = new google.maps.Marker({
	      position: new google.maps.LatLng({$loc}),
	      map: map,
	      title: '{$title}',
	      icon: '{$url}/img/map_icon_casa.png'
	  });
EOT;
			$i++;
		}
	}

	$GLOBALS['script'] .= <<<EOT
	}
	google.maps.event.addDomListener(window, 'load', initialize);
</script>
EOT;
?>
<?php get_footer(); die() ?>



<?php
	blog_archive:

	$feat_image = wp_get_attachment_url( get_post_thumbnail_id( get_page_by_title('Blog')->ID ) );

get_header(); ?>
	<!-- header -->
	<?php if (empty($feat_image)) : ?>
	<div class="container-fluid header bg-default blogroll">
	<?php else : ?>
	<div class="container-fluid header blogroll" style="background-image:url(<?php echo $feat_image; ?>)">
	<?php endif; ?>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h1>Blog</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 desc">
				<p><?php echo get_post_meta($post->ID, 'subtitulo', true); ?></p>
			</div>
		</div>
	</div>

	<div class="vertical-space-small"></div>

	<div class="section container">
		
		<div class="row">
			<div class="col-md-9">
				
				<?php
					$args = array(
						'posts_per_page' => 10,
						'post_type' => 'post'
					);

					$items = get_posts( $args );

					foreach ($items as $item) :
						$img = get_blog_image($item, 'small');
				?>
				<article class="blog preview">
					<a href="<?php echo $item->guid; ?>">
						<div class="row">
							<div class="col-md-4">
								<figure class="thumb-img" style="background-image:url(<?php echo $img; ?>)"></figure>
							</div>

							<div class="col-md-8">
								<h1><?php echo $item->post_title; ?></h1>
								<p><?php print_blog_content($item, false); ?></p>
								<span class="more">Leer más</span>
							</div>
						</div>
					</a>
				</article>
				<?php endforeach; ?>

			</div>

			<!-- sidebar -->
			<div class="col-md-3">
				<?php
					$narrow_finder = true;
					include('templates/finder.php');
					include('templates/recents.php');
				?>
			</div>
		</div>

	</div>
<?php get_footer(); ?>