<?php
	include_once 'db_connect.php';
	include_once 'functions.php';

	sec_session_start();		// Nuestra manera personalizada segura de iniciar sesion PHP

	if (isset($_POST['email'], $_POST['p']))
	{
		$email = $_POST['email'];
		$password = $_POST['p'];		// La contraseña con hash

		if (login($email, $password, $mysqli) == true)
		{
			//Inicio de sesion exitosa
			header('Location: index.php?ctl=inicio');
		}
		else
		{
			// Inicio de sesion fallida
			header('Location: index.php?ctl=login&error=1');
		}
	}
	else
	{
		// La variables POST correctas no se enviaron a esta pagina
		echo 'Solicitud no valida';
	}
