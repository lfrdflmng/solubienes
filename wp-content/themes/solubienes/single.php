<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Solubienes
 * @since Solubienes 1.0
 */

if (isset($_GET['demo'])) goto demo;

$project_vars = get_post_custom( $post->ID );


$coordenates = get_property_coordenates( $project_vars );
$show_map = $coordenates != '';

get_header(); ?>

	<div class="vertical-space"></div>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- state / city -->
				<div class="crumbs">
					<?php print_property_location( $project_vars, ' / ' ); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<!-- left -->
			<div class="col-md-9">
				<article class="single">
					<!-- title -->
					<h1><?php echo $post->post_title; ?></h1>

					<!-- star bookmark -->
					<div class="star" data-id="<?php echo $post->ID; ?>">
						<i class="fa fa-star"></i>
					</div>

					<!-- main image -->
					<div class="gallery" style="display:none">
						<div class="slider-for">
							<!-- http://kenwheeler.github.io/slick/ -->

							<?php
								$args = array(
									'posts_per_page' => 50,
									'post_type' => 'attachment',
									'post_parent' => $post->ID
								);

								$images = get_posts( $args );

								foreach ($images as $image) :
							?>
							<div class="large">
								<figure style="background-image: url(<?php echo $image->guid; ?>)">
								<!--img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png" alt=""-->
							</div>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="gallery-previews">
						<div class="slider-nav">
							<?php
								foreach ($images as $image) :
									$image = reset(wp_get_attachment_image_src($image->ID, 'thumb', false, ''));
							?>
							<div class="thumb">
								<figure style="background-image: url(<?php echo $image; ?>)">
								<!--img src="<?php echo $image; ?>" alt=""-->
							</div>
							<?php endforeach; ?>
						</div>
					</div>

					<!-- location -->
					<div class="location">
						<strong>Ubicación</strong>
						<p><i class="fa fa-map-marker"></i> <?php print_property_address( $project_vars ); ?></p>
					</div>

					<div class="row features">
						<?php print_property_quantities( $project_vars, 2 ); ?>
					</div>

					<div class="benefits">
						<strong>Beneficios</strong>
						<?php print_property_benefits( $project_vars, true ); ?>
					</div>

					<!-- description -->
					<div class="content">
						<strong>Descripción:</strong>
						<p><?php print_property_description( $project_vars, false ); ?></p>
					</div>
				</article>
			</div>

			<!-- right -->
			<aside class="col-md-3">
				<!-- price -->
				<div class="single-price">
				<?php print_property_price( $project_vars, true ); ?>
				</div>

				<!-- contact form -->
				<?php
					include('templates/contact.php');
				?>

				<?php if ($show_map) : ?>
				<!-- map -->
				<div class="map">
					<div id="google_map"></div>
				</div>
				<?php endif; ?>

			</aside>
		</div>
	</div>

<?php
$theme_url = esc_url( get_template_directory_uri() );
$GLOBALS['script'] = <<<EOT
	<script type="text/javascript" src="{$theme_url}/js/slick.min.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('.slider-for').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				asNavFor: '.slider-nav'
			});
			$('.slider-nav').slick({
				slidesToShow: 3,
				slidesToScroll: 1,
				asNavFor: '.slider-for',
				dots: false,
				arrows: false,
				centerMode: true,
				focusOnSelect: true
			});

EOT;
//check if it's is a user's favorite
if (is_user_logged_in()) {
	$url = get_template_directory_uri() . '/ajax/bookmarks.php';
	$GLOBALS['script'] .= <<<EOT
			setTimeout(function() {
				$.ajax({
					method: 'GET',
					url: '{$url}',
					data: { property_id: {$post->ID} },
					dataType: 'json'
				})
				.done(function( data ) {
					if (data['ok'] == 1 && data['bookmarked'] == 1) {
						$('.star').addClass('favorited');
					}
				});
			}, 2000);
EOT;
	}

		$GLOBALS['script'] .= <<<EOT
		});
	</script>
EOT;

if ($show_map) {
	$title = str_replace('\'', '', $post->post_title);
	$GLOBALS['script'] .= <<<EOT
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

		  var myLatlng = new google.maps.LatLng({$coordenates});

		  // Create a new StyledMapType object, passing it the array of styles,
		  // as well as the name to be displayed on the map type control.
		  var styledMap = new google.maps.StyledMapType(styles,
		    {name: "Styled Map"});

		  // Create a map object, and include the MapTypeId to add
		  // to the map type control.
		  var mapOptions = {
		    zoom: 14,
		    center: myLatlng,
		    mapTypeControlOptions: {
		      mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
		    },
		    disableDefaultUI: true
		  };
		  var map = new google.maps.Map(document.getElementById('google_map'), mapOptions);

		  //Associate the styled map with the MapTypeId and set it to display.
		  map.mapTypes.set('map_style', styledMap);
		  map.setMapTypeId('map_style');

		  //var image = 'images/beachflag.png';

		  var marker = new google.maps.Marker({
		      position: myLatlng,
		      map: map,
		      title: '{$title}'//,
		      //icon: image
		  });
		}

		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
EOT;
}

get_footer(); die();
?>









<?php
demo:
get_header(); ?>

	<div class="vertical-space"></div>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- state / city -->
				<div class="crumbs">
					Propiedades / Bolívar / San Félix
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<!-- left -->
			<div class="col-md-9">
				<article class="single">
					<!-- title -->
					<h1>Residencia cualquiera</h1>

					<!-- star bookmark -->
					<div class="star">
						<i class="fa fa-star"></i>
					</div>

					<!-- main image -->
					<div class="gallery">
						<div class="slider-for">
							<!-- http://kenwheeler.github.io/slick/ -->
							<div class="large">
								<figure style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png)">
								<!--img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png" alt=""-->
							</div>
							<div class="large">
								<figure style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder.jpg)">
								<!--img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder.jpg" alt=""-->
							</div>
							<div class="large">
								<figure style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png)">
								<!--img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png" alt=""-->
							</div>
							<div class="large">
								<figure style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder.jpg)">
								<!--img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder.jpg" alt=""-->
							</div>
							<div class="large">
								<figure style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png)">
								<!--img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png" alt=""-->
							</div>
							<div class="large">
								<figure style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder.jpg)">
								<!--img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder.jpg" alt=""-->
							</div>
						</div>
					</div>
					<div class="gallery-previews">
						<div class="slider-nav">
							<div class="thumb">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png" alt="">
							</div>
							<div class="thumb">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder.jpg" alt="">
							</div>
							<div class="thumb">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png" alt="">
							</div>
							<div class="thumb">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder.jpg" alt="">
							</div>
							<div class="thumb">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder_house.png" alt="">
							</div>
							<div class="thumb">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder.jpg" alt="">
							</div>
						</div>
					</div>

					<!-- location -->
					<div class="location">
						<strong>Ubicación</strong>
						<p><i class="fa fa-map-marker"></i> Manoa, San Félix</p>
					</div>

					<div class="row features">
						<!-- size -->
						<div class="col-md-3 col-sm-3 col-xs-6">
							<strong>Medidas</strong>
							<p><i class="custom-icon icon-graph"></i> 210 mts</p>
						</div>
						<!-- rooms -->
						<div class="col-md-3 col-sm-3 col-xs-6">
							<strong>Habitaciones</strong>
							<p><i class="custom-icon icon-bed"></i> 2</p>
						</div>
						<!-- baths -->
						<div class="col-md-3 col-sm-3 col-xs-6">
							<strong>Baños</strong>
							<p><i class="custom-icon icon-tub"></i> 3</p>
						</div>
						<!-- parkings -->
						<div class="col-md-3 col-sm-3 col-xs-6">
							<strong>Estacionamiento</strong>
							<p><i class="custom-icon icon-cab"></i> 1</p>
						</div>
					</div>

					<div class="benefits">
						<strong>Beneficios</strong>
						<ul>
							<li><i class="custom-icon icon-wifi" data-toggle="tooltip" title="Wifi"></i></li>
							<li><i class="custom-icon icon-stethoscope" data-toggle="tooltip" title="Hospital"></i></li>
							<li><i class="custom-icon icon-bus" data-toggle="tooltip" title="Transporte"></i></li>
							<li><i class="custom-icon icon-basket" data-toggle="tooltip" title="Mercado"></i></li>
							<li><i class="custom-icon icon-pool" data-toggle="tooltip" title="Piscina"></i></li>
						</ul>
					</div>

					<!-- description -->
					<div class="content">
						<strong>Descripción:</strong>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non     t anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et</p>
					</div>
				</article>
			</div>

			<!-- right -->
			<aside class="col-md-3">
				<!-- price -->
				<div class="single-price">
				Bsf. 999.999,99
				</div>

				<!-- contact form -->
				<?php
					include('templates/contact.php');
				?>

				<!-- map -->
				<div class="map">
					<div id="google_map"></div>
				</div>

			</aside>
		</div>
	</div>

<?php
$theme_url = esc_url( get_template_directory_uri() );
$GLOBALS['script'] = <<<EOT
	<script type="text/javascript" src="{$theme_url}/js/slick.min.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('.slider-for').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				asNavFor: '.slider-nav'
			});
			$('.slider-nav').slick({
				slidesToShow: 3,
				slidesToScroll: 1,
				asNavFor: '.slider-for',
				dots: false,
				arrows: false,
				centerMode: true,
				focusOnSelect: true
			});
		});
	</script>

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

		  var myLatlng = new google.maps.LatLng(-25.363882,131.044922);

		  // Create a new StyledMapType object, passing it the array of styles,
		  // as well as the name to be displayed on the map type control.
		  var styledMap = new google.maps.StyledMapType(styles,
		    {name: "Styled Map"});

		  // Create a map object, and include the MapTypeId to add
		  // to the map type control.
		  var mapOptions = {
		    zoom: 11,
		    center: myLatlng,
		    mapTypeControlOptions: {
		      mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
		    }
		  };
		  var map = new google.maps.Map(document.getElementById('google_map'), mapOptions);

		  //Associate the styled map with the MapTypeId and set it to display.
		  map.mapTypes.set('map_style', styledMap);
		  map.setMapTypeId('map_style');

		  //var image = 'images/beachflag.png';

		  var marker = new google.maps.Marker({
		      position: myLatlng,
		      map: map,
		      title: 'Hello World!'//,
		      //icon: image
		  });
		}

		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
EOT;
get_footer();
?>