<?php
require('wp_connect.php');

function output_for_contact($state, $sent = 0) {
	echo json_encode(array('ok' => $state, 'sent' => $sent));
	die();
}

if (!function_exists('set_html_content_type')) {
	function set_html_content_type() {
		return 'text/html';
	}
}

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $mensaje = $_POST['mensaje'];
    
    if (!empty($nombre)) {
    	if (!empty($correo) || !empty($telefono)) {
	        $url = get_template_directory_uri() . '/img/logo.png';
	        $html = <<<EOT
<img src="{$url}" alt="" style="margin-bottom:20px">
<table border="0" style="padding:50px 0 0 50px; border:0">
    <tr>
        <th style="text-align:right">Nombre: </th>
        <td>{$nombre}</td>
    </tr>
    
    <tr>
        <th style="text-align:right">Correo: </th>
        <td>{$correo}</td>
    </tr>
    
    <tr>
        <th style="text-align:right">Teléfono: </th>
        <td>{$telefono}</td>
    </tr>
    
    <tr>
        <th style="text-align:right">Mensaje: </th>
        <td>{$mensaje}</td>
    </tr>
</table>
EOT;
        
	        if (!isset($_POST['agree'])) { //"agree" should not be checked; only a bot would check it.
		        $admin_email = get_option( 'admin_email', 'programacion@plusdigital.com.ve' );

		        /* SENDING MAIL */
		        $multiple_to_recipients = array(
		            $admin_email//,
		        );

		        @add_filter( 'wp_mail_content_type', 'set_html_content_type' );

		        $sent = wp_mail( $multiple_to_recipients, 'Nuevo Mensaje desde Solubienes', $html );

		        // Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
		        @remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
		    }
		    else $sent = true;

	        if ($sent) {
	        	output_for_contact(1,1);
	        }
	        else {
	        	output_for_contact(1,0);
	        }
	        die();
	    }
	}

output_for_contact(0);