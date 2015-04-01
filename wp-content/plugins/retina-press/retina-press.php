<?php

/*
Plugin Name: Retina Press
Plugin URI: http://themeforest.net/item/retina-dashboard/4200548
Description: Add a little beauty to your Wordpress admin with this customised theme.
Author: Lee Grant
Version: 1.0
Author URI: http://themeforest.net/user/leegrant
*/

function xxxx() {
    $url = get_settings('siteurl');
    $dir = $url . '/wp-content/plugins/retina-press/css/';
    echo '
    <link rel="stylesheet" type="text/css" href="' . $dir . 'custom-admin.css" />
	<!--[if IE]><link rel="stylesheet" type="text/css" href="' . $dir . 'ie.css" /><![endif]-->
    ';
}

add_action('admin_print_styles', 'xxxx');

// Custom login CSS
function my_login_css() {
  echo '<link rel="stylesheet" type="text/css" href="' .plugins_url('css/login.css  ', __FILE__). '">';
}
add_action('login_head', 'my_login_css');

// Custom login logo
function my_login_logo_url() {
    return '#';
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Solubienes F&C - Agencia Plus Digital';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            /*background-image: url(wp-content/plugins/retina-press/images/logo.png);
            background-size: auto;
            height: 20px;
            background-position: 30px 0px;*/
			
			background: none;
			width: 100%;
			height: 20px;
			text-indent: 0 !important;
			color: #fff;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// Theme info widget
function wpc_dashboard_widget_function() {
	// Entering the text between the quotes
	echo "<ul>
	<li>Release Date: March 2013</li>
	<li>Author: <a href='http://www.plusdigital.com.ve'>Plus Digital</a></li>
	<li>Verison: 1.0</li>
	</ul>";
}
function wpc_add_dashboard_widgets() {
	wp_add_dashboard_widget('wp_dashboard_widget', 'Theme information', 'wpc_dashboard_widget_function');
}
add_action('wp_dashboard_setup', 'wpc_add_dashboard_widgets' );

// Load custom javascript
function pw_load_scripts() {
	wp_enqueue_script('custom-js', '/wp-content/plugins/retina-press/js/custom.js');
}

add_action('admin_enqueue_scripts', 'pw_load_scripts');
?>
