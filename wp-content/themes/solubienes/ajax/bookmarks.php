<?php
require('wp_connect.php');

$u_id = get_current_user_id();
if ($u_id > 0) {

	//GETTING
	if (isset($_GET['property_id']) && (int)$_GET['property_id'] > 0) {
		$p_id = (int)$_GET['property_id'];
		$already_bookmarked = $wpdb->get_var("SELECT COUNT(*) FROM favoritos WHERE usuario_id = {$u_id} AND propiedad_id = {$p_id}");
		output(1, $already_bookmarked ? 1 : 0);
	}

	//SETTING
	$p_id = (int)$_POST['property_id'];
	if ($p_id > 0) {
		$already_bookmarked = $wpdb->get_var("SELECT COUNT(*) FROM favoritos WHERE usuario_id = {$u_id} AND propiedad_id = {$p_id}");
		if (!$already_bookmarked) {
			bookmark(1, $u_id, array('propiedad_id' => $p_id));
			output(1, 1);
		}
		else {
			undoBookmark($u_id, $p_id);
			output(1, 0);
		}
	}
	else {
		$zona = trim($_POST['zona']);
		$tipo = trim($_POST['tipo']);
		$operacion = trim($_POST['operacion']);
		if (!empty($zona) || !empty($tipo) || !empty($operacion)) {
			$vals = array();
			$already_bookmarked = checkIfAlreadyBookmarked($u_id, $zona, $tipo, $operacion, $vals);
			if (!$already_bookmarked) {
				bookmark(2, $u_id, $vals);
				output(1, 1);
			}
			else {
				output(1, 0);
			}
		}
	}
}
output(0);