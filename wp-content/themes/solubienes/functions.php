<?php
/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Twenty Fifteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * Twenty Fifteen only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfifteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'twentyfifteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentyfifteen', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'twentyfifteen' ),
		'social'  => __( 'Social Links Menu', 'twentyfifteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	$color_scheme  = twentyfifteen_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'twentyfifteen_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url() ) );
}
endif; // twentyfifteen_setup
add_action( 'after_setup_theme', 'twentyfifteen_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Fifteen 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function twentyfifteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'twentyfifteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyfifteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyfifteen_widgets_init' );

if ( ! function_exists( 'twentyfifteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Fifteen.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentyfifteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Noto Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Sans:400italic,700italic,400,700';
	}

	/* translators: If there are characters in your language that are not supported by Noto Serif, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Serif:400italic,700italic,400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}

	/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'twentyfifteen' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyfifteen-fonts', twentyfifteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfifteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie7', 'conditional', 'lt IE 8' );

	wp_enqueue_script( 'twentyfifteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}

	wp_enqueue_script( 'twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20141212', true );
	wp_localize_script( 'twentyfifteen-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Twenty Fifteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentyfifteen_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	wp_add_inline_style( 'twentyfifteen-style', $css );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_post_nav_background' );

/**
 * Display descriptions in main navigation.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function twentyfifteen_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'twentyfifteen_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function twentyfifteen_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'twentyfifteen_search_form_modify' );

/**
 * Implement the Custom Header feature.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/customizer.php';



//solubienes

show_admin_bar(false);

if(!function_exists('saveImage')) {
	function saveImage($file_handler, $post_id, $setthumb = 'false') {
		// check to make sure its a successful upload
		if($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

		require_once(ABSPATH . 'wp-admin' . '/includes/image.php');
		require_once(ABSPATH . 'wp-admin' . '/includes/file.php');
		require_once(ABSPATH . 'wp-admin' . '/includes/media.php');

		/*$post_data = array(
			//'post_mime_type' => 'attachmentcustom',
			'post_content' => 'Imagen para ' . $post_id
		);*/
		$attach_id = media_handle_upload($file_handler, $post_id/*, $post_data*/);

		if($setthumb) update_post_meta($post_id, '_thumbnail_id', $attach_id);
		return $attach_id;
	}
}

// CUSTOM POST "Inmuebles"
function posts_solubienes() {
    register_post_type( 'solubienes', array(
        'labels' => array(
            'name' => 'Inmuebles',
            'singular_name' => 'Inmueble',
        ),
        'menu_icon' => 'dashicons-admin-home', //<-- https://developer.wordpress.org/resource/dashicons/
        'description' => 'Inmuebles',
        'public' => true,
        'menu_position' => 20,
        'supports' => array( 'title'/*, 'editor'*/, 'thumbnail', 'categories' ),

        'capability_type' => 'solubienes',
		'capabilities' => array(
			'publish_posts' => 'publish_solubienes',
			'edit_posts' => 'edit_solubienes',
			'edit_others_posts' => 'edit_others_solubienes',
			'delete_posts' => 'delete_solubienes',
			'delete_others_posts' => 'delete_others_solubienes',
			'read_private_posts' => 'read_private_solubienes',
			'edit_post' => 'edit_solubienes',
			'delete_post' => 'delete_solubienes',
			'read_post' => 'read_solubienes'
		)
    ));
}
add_action( 'init', 'posts_solubienes' );


function posts_solubienes_taxonomy() {
	register_taxonomy(
		'tipo',
		'solubienes',
		array(
			'label' => 'Tipo',
			'rewrite' => array( 'slug' => 'tipo' ),
			'hierarchical' => true,
		)
	);
}
add_action( 'init', 'posts_solubienes_taxonomy' );


function wp_custom_attachment() {
    wp_nonce_field(plugin_basename(__FILE__), 'wp_custom_attachment_nonce');

    $post_id = get_the_ID();
     
    $html = '<p class="description">';
        $html .= 'Seleccione las imágenes';
    $html .= '</p>';
    $html .= '<input type="file" id="wp_custom_attachment" name="wp_custom_attachment[]" multiple />';

	//image deleting
	if (isset($_GET['d_attachment_id'])) {
		$d_id = (int)$_GET['d_attachment_id'];
		if ($d_id > 0) {
			wp_delete_attachment( $d_id );
		}
	}

    $img = get_attached_media('image');
    /*$img = get_posts(array(
    	//'post_mime_type' => 'attachmentcustom',
    	'posts_per_page' => 10,
    	'post_type' => 'attachment',
    	'post_parent' => get_the_ID()
	));*/

    if (count($img)) {
    	//$url = get_template_directory_uri();
    	$url = admin_url();
    	$html .= '<table border="0" style="width:100%">';
	    foreach ($img as $i) {
	    	$link = wp_get_attachment_link($i->ID, 'thumbnail', false, false, false);
	    	//$link = wp_get_attachment_image_src($i->ID, 'thumbnail')['url'];
	    	$html .= '<tr>';
	    		$html .= '<td>';
	    			$html .= $link; //$html .= '<img src="' . $i->guid . '" alt="' . $i->post_title . '">';
	    		$html .= '</td>';
	    		$html .= '<td style="vertical-align:middle;text-align:center">';
	    			$html .= '<a href="' . ($url . '/post.php?post=' . $post_id . '&action=edit&d_attachment_id=' . $i->ID) . '" style="color:red" attachment-id="' . $i->ID . '">Eliminar</a>';
	    		$html .= '</td>';
	    	$html .= '</tr>';
	    }
	    $html .= '</table>';
	}
     
    echo $html;
}
function add_custom_meta_boxes() {
    add_meta_box(
        'wp_custom_attachment',
        'Galería',
        'wp_custom_attachment',
        'solubienes',
        'side'
    );
}
add_action('add_meta_boxes', 'add_custom_meta_boxes');


function save_custom_meta_data($id) {
    /* --- security verification --- */
    if(!wp_verify_nonce($_POST['wp_custom_attachment_nonce'], plugin_basename(__FILE__))) {
      return $id;
    } // end if
       
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return $id;
    } // end if
       
    /*if('page' == $_POST['post_type']) {
      if(!current_user_can('edit_page', $id)) {
        return $id;
      } // end if
    } else {
        if(!current_user_can('edit_page', $id)) {
            return $id;
        } // end if
    } // end if*/
    /* - end security verification - */

    if($_FILES) {
		$files = $_FILES['wp_custom_attachment'];
		foreach($files['name'] as $key => $value) {
			if($files['name'][$key]) {
				$file = array(
					'name' 		=> $files['name'][$key],
					'type' 		=> $files['type'][$key],
					'tmp_name' 	=> $files['tmp_name'][$key],
					'error' 	=> $files['error'][$key],
					'size' 		=> $files['size'][$key]
				);
				$_FILES = array('upload_attachment' => $file);

				foreach($_FILES as $file => $array) {
					$newupload = saveImage($file, $id);
				}
			}
		}
	}

	if ( !wp_is_post_revision( $id ) ) {
        send_notification_email_for_interested_users($id);
    }
}
add_action('save_post', 'save_custom_meta_data');


function send_notification_email_for_interested_users( $post_id ) {
	$post = get_post($post_id);
    $vars = get_post_custom( $post_id );
    $bookmars = getRelatedBookmarks( $vars['zona'][0], $vars['tipo'][0], $vars['operacion'][0] );

    if ($post->post_modified != $post->post_date) return false; // not new
    if ($post->post_type != 'solubienes') return false;

    $multiple_to_recipients = array();
    foreach ($bookmars as $bookmar) {
    	$asesor = get_post_meta($asesor_id, 'correo', true);
		if (!empty($asesor)) {
			$asesor = trim($asesor);
			if (filter_var($asesor, FILTER_VALIDATE_EMAIL)) {
				$multiple_to_recipients[] = $asesor;
			}
		}
    }
    if (count($multiple_to_recipients)) {
    	$logo_url = get_template_directory_uri() . '/img/logo.png';
    	$title = $post->post_title;
    	$url = $post->guid;
        $html = <<<EOT
			<img src="{$logo_url}" alt="Solubienes" style="margin:20px">
			<p><b>Hola, en Solubienes tenemos nuevos inmuebles que te pueden interesar</b></p>
			<br><br>
			<p>Haz clic en el enlace para ver el inmueble:</p>
			<br>
			<a href="{$url}">{$title}</a>
			<br><br>
			<small>Solubienes F&amp;C</small>
EOT;
		@add_filter( 'wp_mail_content_type', 'set_html_content_type' );

        $sent = wp_mail( $multiple_to_recipients, 'Nuevos Inmuebles en Solubienes', $html );

        // Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
        @remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
    }
}
//add_action( 'publish_post', 'send_notification_email_for_interested_users', 10, 2 );


function update_edit_form() {
    echo ' enctype="multipart/form-data"';
}
add_action('post_edit_form_tag', 'update_edit_form');


// CUSTOM POST "Inmuebles"
function posts_asesores() {
    register_post_type( 'asesores', array(
        'labels' => array(
            'name' => 'Asesores',
            'singular_name' => 'Asesor',
        ),
        'menu_icon' => 'dashicons-id', //<-- https://developer.wordpress.org/resource/dashicons/
        'description' => 'Asesores',
        'public' => true,
        'menu_position' => 20,
        'supports' => array( 'title'/*, 'editor'*/, 'thumbnail'/*, 'categories'*/ )
    ));
}
add_action( 'init', 'posts_asesores' );


//SINGLE TEMPLATE FOR "BLOG" AND "ASESORES"
function single_custom_post_template( $template ) {
	$post_id = get_the_ID();
	if ( is_single() &&  $post_id) {
        $post_type = get_post_type($post_id);
        if ($post_type == 'post' ) {
            $_template = locate_template( array( 'templates/page-blog_single.php' ) );
        }
        elseif ($post_type == 'asesores') {
            $_template = locate_template( array( 'templates/page-asesores.php' ) );
        }
		$template = ( $_template ) ? $_template : $template;
	}
	return $template;
}
add_filter( 'template_include', 'single_custom_post_template', 99 );


function currency() {
	return 'Bs.f ';
}


function get_property_image($vars, $size = null) {
	$img = (int)$vars['foto_principal'][0];
	if ($img > 0) {
		if ($size == null) {
			$img = get_post( $img );
			$img = $img->guid;
		}
		else {
			$img = wp_get_attachment_image_src($img, $size, false, '');
			if (is_array($img)) $img = reset($img);
		}
	}
	else {
		$img = esc_url( get_template_directory_uri() ) . '/img/img_placeholder_house.png';
	}
	return $img;
}


function print_property_quantities($vars, $type = 0) {
	$area = $vars['area'][0];
	$rooms = (int)$vars['cantidad_habitaciones'][0];
	$baths = (int)$vars['cantidad_banos'][0];
	$parkings = (int)$vars['cantidad_estacionamientos'][0];
	if ($type == 0) { //for box
		if ($area > 0) echo <<<EOT
		<span><i class="custom-icon icon-graph"></i> {$area} mts<sup>2</sup></span>
EOT;
		if ($rooms > 0) echo <<<EOT
		<span><i class="custom-icon icon-bed"></i> {$rooms}</span>
EOT;
		if ($baths > 0) echo <<<EOT
		<span><i class="custom-icon icon-tub"></i> {$baths}</span>
EOT;
		if ($parkings > 0) echo <<<EOT
		<span><i class="custom-icon icon-cab"></i> {$parkings}</span>
EOT;
	}
	elseif ($type == 1) { //for thumb
		if ($rooms > 0) echo <<<EOT
		<li><i class="custom-icon icon-bed"></i> {$rooms}</li>
EOT;
		if ($baths > 0) echo <<<EOT
		<li><i class="custom-icon icon-tub"></i> {$baths}</li>
EOT;
		if ($parkings > 0) echo <<<EOT
		<li><i class="custom-icon icon-cab"></i> {$parkings}</li>
EOT;
	}
	else { //for single
		if ($area > 0) echo <<<EOT
		<div class="col-md-3 col-sm-3 col-xs-6">
			<strong>Medidas</strong>
			<p><i class="custom-icon icon-graph"></i> {$area} mts<sup>2</sup></p>
		</div>
EOT;
		if ($rooms > 0) echo <<<EOT
		<div class="col-md-3 col-sm-3 col-xs-6">
			<strong>Habitaciones</strong>
			<p><i class="custom-icon icon-bed"></i> {$rooms}</p>
		</div>
EOT;
		if ($baths > 0) echo <<<EOT
		<div class="col-md-3 col-sm-3 col-xs-6">
			<strong>Baños</strong>
			<p><i class="custom-icon icon-tub"></i> {$baths}</p>
		</div>
EOT;
		if ($parkings > 0) echo <<<EOT
		<div class="col-md-3 col-sm-3 col-xs-6">
			<strong>Estacionamiento</strong>
			<p><i class="custom-icon icon-cab"></i> {$parkings}</p>
		</div>
EOT;
	}
}

function print_property_area($vars) {
	echo $vars['area'][0] . ' mts<sup>2</sup>';
}

function print_property_benefits($vars, $large = false) {
	$benefits = unserialize($vars['beneficios'][0]);
	if (!is_array($benefits)) return false;
	$icons = array(
		'wifi' => 'wifi',
		'hospital' => 'stethoscope',
		'transporte' => 'bus',
		'mercado' => 'basket',
		'piscina' => 'pool',
		'seguridad' => 'security-cam'
	);
	$descriptions = array(
		'wifi' => 'Conexión a Internet libre',
		'hospital' => 'Hospital Cercano',
		'transporte' => 'Transporte Público',
		'mercado' => 'Mercado / C.C. cercano',
		'piscina' => 'Piscina',
		'seguridad' => 'Sistema de Vigilancia'
	);
	
	if (!$large) {
		foreach ($benefits as $benefit) {
			echo '<span><i class="custom-icon icon-' . $icons[$benefit] . '" data-toggle="tooltip" title="' . $descriptions[$benefit] . '"></i></span>';
		}
	}
	else {
		echo '<ul>';
		foreach ($benefits as $benefit) {
			echo '<li><i class="custom-icon icon-' . $icons[$benefit] . '" data-toggle="tooltip" title="' . $descriptions[$benefit] . '"></i></li>';
		}
		echo '</ul>';
	}
}

function print_property_price($vars, $msg = false) {
	$price = str_replace('.', '', $vars['monto'][0]);
	$price = floatval( str_replace(',', '.', $price) );
	if ($price > 0) {
		echo currency() . str_replace(',', ',<small class="decimals">', number_format($price, 2, ',', '.' )) . '</small>';
		return true;
	}
	if ($msg) {
		echo 'Consultar precio';
	}
	return false;
}

function print_property_location($vars, $separator = ', ') {
	$has_state = !empty($vars['estado'][0]) && $vars['estado'][0] != 'null';
	$has_city = !empty($vars['ciudad'][0]) && $vars['ciudad'][0] != 'null';
	echo ($has_state ? $vars['estado'][0] : '') . ($has_state && $has_city ? $separator : '') . ($has_city ? get_city($vars) : '');
}

function print_property_description($vars, $trimmed = true) {
	if ($trimmed) {
		echo ucfirst(substr($vars['descripcion'][0], 0, 400)) . '...';
	}
	else {
		echo ucfirst(nl2br($vars['descripcion'][0]));
	}
}

function print_property_address($vars) {
	$comma = ($vars['zona'][0] != '' && $vars['direccion'][0] != '') ? ', ' : '';
	echo $vars['zona'][0] . $comma . $vars['direccion'][0];
}

function print_property_title($item) {
	echo ucfirst($item->post_title);
}

function get_property_coordenates($vars) {
	$loc = unserialize($vars['coordenadas'][0]);
	if ($loc === false) return '';
	return $loc['lat'] . ',' . $loc['lng'];
}

function get_city($vars) {
	$city = explode('_', $vars['ciudad'][0]);
	if (is_array($city)) {
		if (count($city) > 1) {
			return next($city);
		}
		else {
			return reset($city);
		}
	}
	return !empty($city) ? $city : '';
}

//blog
function get_blog_image($item, $size = null) {
	if ($size == null) {
		$img = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'large', false, '');
	}
	else {
		$img = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), $size, false, '');
	}
	if (is_array($img)) $img = reset($img);
	if (empty($img)) {
		$img = esc_url( get_template_directory_uri() ) . '/img/img_placeholder.jpg';
	}
	return $img;
}

function cleanContent($str) {
	return trim(strip_tags(str_replace('<p>', '<br>', $str), '<br>'));
}

function print_blog_content($item, $full = true) {
	if ($full) {
		echo cleanContent($item->post_content);
	}
	else {
		echo substr(cleanContent($item->post_content), 0, 100) . '...';
	}
}

//asesor
function get_asesor_image($item, $size = null) {
	if ($size == null) {
		$img = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'small', false, '');
	}
	else {
		$img = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), $size, false, '');
	}
	if (is_array($img)) $img = reset($img);
	if (empty($img)) {
		$img = esc_url( get_template_directory_uri() ) . '/img/img_placeholder_user.png';
	}
	return $img;
}

function print_asesor_name($item) {
	echo trim(ucwords(strtolower($item->post_title)));
}

function print_asesor_function($vars) {
	echo $vars['funcion'][0];
}

function print_asesor_phones($vars) {
	for ($i = 1; $i <=2; $i++ ) {
		$phone = $vars['telefono_' . $i][0];
		if (!empty($phone)) {
			echo '<li>' . $phone . '</li>';
		}
	}
}

function print_asesor_pin($vars) {
	echo $vars['pin'][0];
}

function print_asesor_social_links($vars) {
	$socials = array('facebook', 'instagram', 'twitter');
	$social_icons = array(
		'facebook' => 'fa-facebook-official',
		'instagram' => 'fa-instagram',
		'twitter' => 'fa-twitter'
	);
	foreach ($socials as $social) {
		$link = $vars[$social][0];
		if (!empty($link)) {
			echo '<li><a class="icon-' . $social . '" href="' . $link . '"><i class="fa ' . $social_icons[$social] . '"></i></a></li>';
		}
	}
}

//contacto
function print_contacto_description($vars) {
	echo $vars['descripcion'][0];
}

function print_contacto_address($vars) {
	echo $vars['direccion'][0];
}

function print_contacto_phones($vars) {
	echo $vars['telefonos'][0];
}

function print_contacto_emails($vars) {
	echo $vars['correos'][0];
}

function get_contacto_coordenates($vars = null) {
	$loc = $vars != null ? unserialize($vars['ubicacion'][0]) : false;
	if ($loc === false) return '8.315562492065828,-62.71965980529785'; //<-- default
	return $loc['lat'] . ',' . $loc['lng'];
}


/**
 * Class for adding a new field to the options-general.php page
 */
class Add_Settings_Field {

	/**
	 * Class constructor
	 */
	public function __construct() {
		add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
	}

	/**
	 * Add new fields to wp-admin/options-general.php page
	 */
	public function register_fields() {
		register_setting( 'general', 'address1', 'esc_attr' );
		register_setting( 'general', 'phone1', 'esc_attr' );
		register_setting( 'general', 'email1', 'esc_attr' );
		register_setting( 'general', 'copyrights1', 'esc_attr' );
		register_setting( 'general', 'facebook1', 'esc_attr' );
		register_setting( 'general', 'twitter1', 'esc_attr' );
		register_setting( 'general', 'instagram1', 'esc_attr' );
		
		add_settings_field(
			'address1',
			'<label for="address1">Dirección</label>',
			array( &$this, 'address1_html' ),
			'general'
		);

		add_settings_field(
			'phone1',
			'<label for="phone1">Teléfonos</label>',
			array( &$this, 'phone1_html' ),
			'general'
		);
		
		add_settings_field(
			'email1',
			'<label for="email1">Correo</label>',
			array( &$this, 'email1_html' ),
			'general'
		);
		
		add_settings_field(
			'copyrights1',
			'<label for="copyrights1">Nota de Pie de Página</label>',
			array( &$this, 'copyrights_html' ),
			'general'
		);
		
		add_settings_field(
			'facebook1',
			'<label for="facebook1">Facebook</label>',
			array( &$this, 'facebook1_html' ),
			'general'
		);
		
		add_settings_field(
			'twitter1',
			'<label for="twitter1">Twitter</label>',
			array( &$this, 'twitter1_html' ),
			'general'
		);
		
		add_settings_field(
			'instagram1',
			'<label for="instagram1">Instagram</label>',
			array( &$this, 'instagram1_html' ),
			'general'
		);
	}

	/**
	 * HTML for extra settings
	 */
	public function address1_html() {
		$value = get_option( 'address1', '' );
		echo '<textarea id="address1" name="address1" rows="4" style="width:300px;heigth:400px">' . esc_attr( $value ) . '</textarea>';
	}

	public function phone1_html() {
		$value = get_option( 'phone1', '' );
		echo '<input type="text" id="phone1" name="phone1" value="' . esc_attr( $value ) . '" style="width:300px" />';
	}
	
	public function email1_html() {
		$value = get_option( 'email1', '' );
		echo '<input type="email" id="email1" name="email1" value="' . esc_attr( $value ) . '" style="width:300px" />';
	}
	
	public function copyrights_html() {
		$value = get_option( 'copyrights1', '' );
		echo '<input type="text" id="copyrights1" name="copyrights1" value="' . esc_attr( $value ) . '" style="width:400px" />';
	}
	
	public function facebook1_html() {
		$value = get_option( 'facebook1', '' );
		echo '<input type="text" id="facebook1" name="facebook1" value="' . esc_attr( $value ) . '" style="width:400px" />';
	}
	
	public function twitter1_html() {
		$value = get_option( 'twitter1', '' );
		echo '<input type="text" id="twitter1" name="twitter1" value="' . esc_attr( $value ) . '" style="width:400px" />';
	}
	
	public function instagram1_html() {
		$value = get_option( 'instagram1', '' );
		echo '<input type="text" id="instagram1" name="instagram1" value="' . esc_attr( $value ) . '" style="width:400px" />';
	}

}
new Add_Settings_Field();

function load_custom_settings() {
	$GLOBALS['address1'] = get_option('address1', '');
	$GLOBALS['phone1'] = get_option('phone1', '');
	$GLOBALS['email1'] = get_option('email1', '');
	$GLOBALS['copyrights1'] = get_option('copyrights1', '');
	$GLOBALS['facebook1'] = get_option('facebook1', '');
	$GLOBALS['twitter1'] = get_option('twitter1', '');
	$GLOBALS['instagram1'] = get_option('instagram1', '');
}

function print_address() {
	echo nl2br($GLOBALS['address1']);
}

function print_phone() {
	echo $GLOBALS['phone1'];
}

function print_email() {
	echo $GLOBALS['email1'];
}

function print_copyrights() {
	echo $GLOBALS['copyrights1'];
}

function print_social($site) {
	$link = $GLOBALS[$site . '1'];
	if (!empty($link)) {
		echo <<<EOT
		<li>
			<a href="{$link}"><i class="fa fa-{$site}"></i></a>
		</li>
EOT;
	}
}


function print_zones_list() {
	global $wpdb;

	$results = $wpdb->get_results('SELECT DISTINCT meta_value AS "zone" FROM wp_postmeta WHERE meta_key = "zona"');

	$list = array();
	foreach ($results as $result) {
		if (!empty($result->zone)) {
			$list[] = "'" . str_replace('\'', '', $result->zone) . "'";
		}
	}

	$results = $wpdb->get_results('SELECT nombre AS "ciudad" FROM ciudad');

	foreach ($results as $result) {
		if (!empty($result->ciudad)) {
			$list[] = "'" . str_replace('\'', '', $result->ciudad) . "'";
		}
	}

	echo implode(',', $list);
}

function get_types_list($as_options, $selected = null) {
	//cannot find a function to return an array with the taxonomies, so...
	$args = array(
		'taxonomy' => 'tipo',
		'style' => 'none',
		'echo' => 0
	);
	$types = wp_list_categories($args);
	$types = explode('<br />', $types);
	$list = array();
	foreach ($types as $type) {
		$type = trim(strip_tags($type));
		if (strlen($type) > 0) {
			$type = get_term_by( 'name', $type, 'tipo' );
			if ($as_options) {
				if ($selected == $type->slug) {
					$list[] = '<option selected value="' . $type->slug . '">' . $type->name . '</option>';
				}
				else {
					$list[] = '<option value="' . $type->slug . '">' . $type->name . '</option>';
				}
			}
			else {
				$list[$type->slug] = $type->name;
			}
		}
	}

	if ($as_options) {
		return implode('', $list);
	}
	return $list;
}

function get_operations_list($as_options = false, $selected = null) {
	global $wpdb;

	$results = $wpdb->get_results('SELECT DISTINCT meta_value AS "operacion" FROM wp_postmeta WHERE meta_key = "operacion"');

	$list = array();
	foreach ($results as $result) {
		if (!empty($result->operacion)) {
			if ($as_options) {
				if ($selected == $result->operacion) {
					$list[] = '<option selected value="' . $result->operacion . '">' . $result->operacion . '</option>';
				}
				else {
					$list[] = '<option value="' . $result->operacion . '">' . $result->operacion . '</option>';
				}
			}
			else {
				$list[] = $result->operacion;
			}
		}
	}

	if ($as_options){
		return implode('', $list);
	}
	return $list;
}

//bookmarking

function output($state, $bookmarked = 0, $die = true) {
	echo json_encode(array('ok' => $state, 'bookmarked' => $bookmarked));
	if ($die) die();
}

function bookmark($type, $u_id, $vals) {
	global $wpdb;
	if ($type == 1) {
		$p_id = $vals['propiedad_id'];
		$wpdb->query("INSERT INTO favoritos (usuario_id, propiedad_id) VALUES ({$u_id}, {$p_id})");
	}
	else {
		$fields = implode(',', array_keys($vals));
		$values = '"' . implode('","', array_values($vals)) . '"';
		$wpdb->query("INSERT INTO favoritos (usuario_id, {$fields}) VALUES ({$u_id}, {$values})");
	}
}

function undoBookmark($u_id, $p_id) {
	global $wpdb;
	$wpdb->query("DELETE FROM favoritos WHERE usuario_id = {$u_id} AND propiedad_id = {$p_id}");
}

function checkIfAlreadyBookmarked($u_id, $zona, $tipo, $operacion, &$vals) {
	global $wpdb;

	$vals = array();
	$where = array();
	if ($zona != '') {
		$where[] = "zona='{$zona}'";
		$vals['zona'] = $zona;
	}
	if ($tipo != '') {
		$where[] = "tipo='{$tipo}'";
		$vals['tipo'] = $tipo;
	}
	if ($operacion != '') {
		$where[] = "operacion='{$operacion}'";
		$vals['operacion'] = $operacion;
	}
	$where = implode(' AND ', $where);
	return $wpdb->get_var("SELECT COUNT(*) FROM favoritos WHERE usuario_id = {$u_id} AND {$where}") > 0;
}

function getRelatedBookmarks($zona, $tipo, $operacion) {
	global $wpdb;

	$vals = array();
	$where = array();
	if (!empty($zona)) {
		$where[] = "zona='{$zona}'";
		$vals['zona'] = $zona;
	}
	if (!empty($tipo)) {
		$where[] = "tipo='{$tipo}'";
		$vals['tipo'] = $tipo;
	}
	if (!empty($operacion)) {
		$where[] = "operacion='{$operacion}'";
		$vals['operacion'] = $operacion;
	}
	if (count($where) > 0) {
		$where = implode(' AND ', $where);
		return $wpdb->get_results("SELECT usuario_id FROM favoritos WHERE {$where} ORDER BY id DESC LIMIT 10");
	}
	return array();
}

function bookmark_search_for_user($values) {
	$zona = trim($values['zona']);
	$tipo = trim($values['tipo']);
	$operacion = trim($values['operacion']);
	$u_id = get_current_user_id();
	
	if (!empty($zona) || !empty($tipo) || !empty($operacion)) {
		$vals = array();
		$already_bookmarked = checkIfAlreadyBookmarked($u_id, $zona, $tipo, $operacion, $vals);
		if (!$already_bookmarked) {
			bookmark(2, $u_id, $vals);
		}
	}
}


function my_enqueue( $hook ) {
    if ('post.php' != $hook && 'post-new.php' != $hook) {
        return;
    }
    wp_enqueue_script( 'my_custom_script', get_template_directory_uri() . '/js/custom_admin.js' );
}
add_action('admin_enqueue_scripts', 'my_enqueue');