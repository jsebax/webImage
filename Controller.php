<?php

	class Controller
	{
		public function inicio()
		{
			$params = array(
				'mensaje' => 'Bienvenido'
			);

			require __DIR__ . '/inicio.php';
		}

		public function verMisImagenes()
		{
			$params = array(
				'mensaje' => 'Bienvenido'
			);
			
			require __DIR__ . '/misImagenes.php';
		}

		public function subirImagen()
		{
			require __DIR__ . '/subirImagenes.php';
		}

		public function login()
		{
			require __DIR__ . '/login.php';
		}

		public function registro()
		{
			require __DIR__ . '/register.php';
		}

		public function exito()
		{
			require __DIR__ . '/register_success.php';
		}
	}
