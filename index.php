<?php

	require_once __DIR__ . '/Config.php';
	require_once __DIR__ . '/Controller.php';

	// enrutamiento
	$map = array(
		'inicio' => array('controller' => 'Controller', 'action' => 'inicio'),
		'ver' => array('controller' => 'Controller', 'action' => 'verMisImagenes'),
		'subirImg' => array('controller' => 'Controller', 'action' => 'subirImagen'),
		'login' => array('controller' => 'Controller', 'action' => 'login'),
		'registro' => array('controller' => 'Controller', 'action' => 'registro'),
		'exito' => array('controller' => 'Controller', 'action' => 'exito')
	);

	// Parseo de la ruta
	if (isset($_GET['ctl'])) {
		if (isset($map[$_GET['ctl']])) {
			$ruta = $_GET['ctl'];
		} else {
			header('Status: 404 Not Found');
			echo '<html><body><h1>Error 404: No existe la ruta <i>' . 
					$_GET['ctl'] .
					'</i></h1></body></html>';
			exit;
		}
	} else {
		$ruta = 'inicio';
	}

	$controlador = $map[$ruta];
	// Ejecucion del controlador asociado a la ruta

	if (method_exists($controlador['controller'], $controlador['action'])) {
		call_user_func(array(new $controlador['controller'], $controlador['action']));
	} else {
		header('Status: 404 Not Found');
		echo '<html><body><h1>Error 404: El controlador <i>' .
				$controlador['controller'] .
				'->' .
				$controlador['action'] .
				'</i> no existe</h1></body></html>';
	}
