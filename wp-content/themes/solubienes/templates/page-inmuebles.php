<?php
 /*
 * Template Name: Inmuebles
 * @subpackage Solubienes
 * @since Solubienes 1.0
 */

if (isset($_GET['demo'])) goto demo;

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
					include('finder.php');
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
<?php get_footer(); die(); ?>















<?php
demo:
//DEMO LAYOUT
function randtext() {
	$str = <<<EOT
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
EOT;
	$len = round(rand(20, strlen($str)));
	echo $len . ' ' . substr($str, 0, $len);
}
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
					include('finder.php');
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
				
					<!-- to be looped -->
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
							<p><?php randtext() ?></p>
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
							<p><?php randtext() ?></p>
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
							<p><?php randtext() ?></p>
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
							<p><?php randtext() ?></p>
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
							<p><?php randtext() ?></p>
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
<?php
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
	    center: new google.maps.LatLng(55.6468, 37.581),
	    mapTypeControlOptions: {
	      mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
	    }
	  };
	  var map = new google.maps.Map(document.getElementById('google_map'),
	    mapOptions);

	  //Associate the styled map with the MapTypeId and set it to display.
	  map.mapTypes.set('map_style', styledMap);
	  map.setMapTypeId('map_style');
	}

	google.maps.event.addDomListener(window, 'load', initialize);
</script>
EOT;
?>
<?php get_footer(); ?>