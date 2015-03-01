<?php
	$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);

	if(!$error) {
		$error = "¡Uy! Ocurrió un error desconocido.";
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>WebImage - Sistema de Gestión de Imágenes</title>
		<link rel="stylesheet" type="text/css" href="<?php echo 'css/'.Config::$mvc_vis_css ?>" />
	</head>
	<body>
		<h1>Hubo un problema.</h1>
		<p class="error"><?php echo $error; ?></p>
	</body>
</html>
