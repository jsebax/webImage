<?php
	include_once('functions.php');
	sec_session_start();

	// Desconfigura todos los valores de sesion
	$_SESSION = array();

	// Obtiene los parametros de sesion
	$params = session_get_cookie_params();

	// Borra el cookie actual
	setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

	// Destruye sesion
	session_destroy();

	/*echo '<script type="text/javascript">';
	echo '$(document).ready(function(){';
	echo '$(".misImgs").hide();';
	echo '$(".subir").hide();';
	echo '$(".login").show();';
	echo '$(".registro").show();';
	echo '$(".logout").hide();';
	echo '});';
	echo '</script>';*/

	header('Location: index.php');
?>
