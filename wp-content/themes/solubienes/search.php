<?php
 /*
 * @subpackage Solubienes
 * @since Solubienes 1.0
 */

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

						$total = 0;

						/*if (!isset($_GET['post_type']) || $_GET['post_type'] != 'solubienes' ) {
							$args = array(
								'posts_per_page' => 50,
								'post_type' => 'solubienes'
							);

							if (!empty($_GET['tipo']) && strlen($_GET['tipo'])) {
								$args['tipo'] = $_GET['tipo'];
							}

							$projects = get_posts( $args );
						}
						else {*/
							//use the wordpress found items
							$projects = $posts;
						//}

						foreach ($projects as $project) :
							if ($project->post_type != 'solubienes') continue;
							$project_vars = get_post_custom( $project->ID );

							//filtering by zone, operation and price
							if (!empty($_GET['zona'])) {
								if ($project_vars['zona'][0] != $_GET['zona'] && get_city($project_vars) != $_GET['zona']) continue;
							}
							if (!empty($_GET['operacion'])) {
								if ($project_vars['operacion'][0] != $_GET['operacion']) continue;
							}
							if (!empty($_GET['precio_maximo'])) {
								if (floatval($project_vars['monto'][0]) > floatval($_GET['precio_maximo']) || empty($project_vars['monto'][0])) continue;
							}

							$total++;

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

				<?php
					if ($total == 0) :
						//nothing was found, so let's add a bookmark for the user (if logged in) to email him/her when available
						if (is_user_logged_in() && !current_user_can('manage_options')) {
							bookmark_search_for_user($_GET);
						}
				?>
				<div class="no-results">
					<h1><i class="fa fa-info-circle"></i>&nbsp; Lo sentimos, no tenemos resultados para su búsqueda.</h1>
				</div>
				<?php endif; ?>

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
<?php get_footer(); ?>