<?php
	include_once('Config.php');		// Ya que functions.php no esta incluido
	$mysqli = new mysqli(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
