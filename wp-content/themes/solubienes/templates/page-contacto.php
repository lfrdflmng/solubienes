<?php
 /*
 * Template Name: Contacto
 * @subpackage Solubienes
 * @since Solubienes 1.0
 */
function randtext() {
	$str = <<<EOT
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
EOT;
	$len = round(rand(50, strlen($str)));
	echo $len . ' ' . substr($str, 0, $len);
}
get_header(); ?>

	<!-- header -->
	<div class="container-fluid header bg-default contact">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h1>Contacto</h1>
			</div>
		</div>
	</div>

	<div class="vertical-space-small"></div>

	<div class="section container contact">

		<div class="row">
			<div class="col-md-12">
				<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
		</div>
		
		<div class="row">
			<!-- main -->
			<div class="col-md-6">
				<div class="map">
					<div id="google_map"></div>
				</div>

				<div class="row info">
					<div class="col-md-7">
						<h2><i class="fa fa-map-marker"></i>&nbsp;Dirección</h2>
						<p>Paseo Meneses, Edif. Sabina, Local<br>
							Nº 1, Arriba del Banco Bicentenario,<br>
							Ciudad Bolívar. Sucursal: C.C. Trebol I,<br>
							Local 8, Planta Baja. Puerto Ordaz.
						</p>
					</div>
					<div class="col-md-5">
						<h2><i class="fa fa-phone"></i>&nbsp;Teléfonos</h2>
						<p>1900-CO-WORKER</p>
						<p>1800-3322-4453</p>

						<h2><i class="fa fa-envelope"></i>&nbsp;Email</h2>
						<p>contact1@solubienes.com</p>
						<p>contact2@solubienes.com</p>
					</div>
				</div>
			</div>

			<!-- sidebar -->
			<div class="col-md-6">
				<?php
					include('contact.php');
				?>
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