<?php
	include_once('db_connect.php');
	include_once('Config.php');

	$error_msg = "";

	if (isset($_POST['username'], $_POST['email'], $_POST['p']))
	{
		// Sanear y validar los datos provistos
		$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
		$email = filter_var($email, FILTER_VALIDATE_EMAIL);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			// No es un correo electronico valido
			$error_msg .= '<p class="error">El email ingresado no es valido</p>';
		}

		$password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
		if (strlen($password) != 128)
		{
			// La contraseña con hash debera ser de 128 caracteres
			// De lo contrario, algo muy raro habra sucedido
			$error_msg .= '<p class="error">Configuracion de contraseña invalida.</p>';
		}

		// La validez del nombre de usuario y de la contraseña ha sido verificada en el cliente
		// Esto sera suficiente, ya que nadie se beneficiara de
		// violar estas reglas

		$prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
		$stmt = $mysqli -> prepare($prep_stmt);

		// Verifica el correo electronico existente
		if ($stmt)
		{
			$stmt -> bind_param('s', $email);
			$stmt -> execute();
			$stmt -> store_result();

			if ($stmt -> num_rows == 1)
			{
				// Ya existe otro usuario con este correo electronico
				$error_msg .= '<p class="error">Y existe un usuario con este correo electronico.</p>';
				$stmt -> close();
			}
			$stmt -> close();
		}
		else
		{
			$error_msg .= '<p class="error">Error de Base de Datos Linea 39</p>';
			$stmt -> close();
		}

		// Verifica el nombre de usuario existente
		$prep_stmt = "SELECT id FROM members WHERE username = ? LIMIT 1";
		$stmt = $mysqli -> prepare($prep_stmt);

		if ($stmt)
		{
			$stmt -> bind_param('s', $username);
			$stmt -> execute();
			$stmt -> store_result();

			if ($stmt -> num_rows == 1)
			{
				// Ya existe otro usuario con este nombre de usuario
				$error_msg .= '<p class="error">Ya existe un usuario con este nombre de usuario.</p>';
				$stmt -> close();
			}
			$stmt -> close();
		}
		else
		{
			$error_msg .= '<p class="error">Error de Base de Datos Linea 55</p>';
			$stmt -> close();
		}

		// Pendiente:
		// También habrá que tener en cuenta la situación en la que el usuario no tenga
		// derechos para registrarse, al verificar que tipo de usuario intenta
		// realizar la operación.

		if (empty($error_msg))
		{
			// Crear una sal aleatoria
			// $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
			$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));

			// Crea una contraseña con sal
			$password = hash('sha512', $password . $random_salt);

			// Inserta el nuevo usuario en la base de datos
			if ($insert_stmt = $mysqli -> prepare("INSERT INTO members (username, email, password, salt) VALUES (?, ?, ?, ?)"))
			{
				$insert_stmt -> bind_param('ssss', $username, $email, $password, $random_salt);
				// Ejecuta la consulta preparada
				if (! $insert_stmt -> execute())
				{
					header('Location: error.php?err=Registration Failure: INSERT');
				}
			}
			
			/*echo '<script type="text/javascript">';
			echo '$(document).ready(function(){';
			echo '$(".misImgs").show();';
			echo '$(".subir").show();';
			echo '$(".login").hide();';
			echo '$(".registro").hide();';
			echo '$(".logout").show();';
			echo '});';
			echo '</script>';*/

			header('Location: index.php?ctl=exito');
		}
	}
?>
