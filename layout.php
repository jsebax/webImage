<!DOCTYPE html>
<html>
	<head>
		<title>WebImage - Sistema de Gestión de Imágenes</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="<?php echo 'css/'.Config::$mvc_vis_css ?>" />
		<link type="text/css" rel="stylesheet" href="css/jquery.lightbox-0.5.css" />
		<script type="text/javascript" src="js/jquery-1.3.2.js"></script>
		<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
		<script type="text/javascript" src="js/functions.js"></script>
		<script type="text/javascript" src="js/sha512.js"></script>
		<script type="text/javascript" src="js/forms.js"></script>
	</head>
	<body>
		<div id="cabecera">
			<h1>WebImage</h1>
		</div>

		<div id="menu">
			<hr/>
			<a href="index.php?ctl=inicio">Inicio</a> <span class="misImgs">|</span>
			<a class="misImgs" href="index.php?ctl=ver">Mis Imágenes</a> <span class="subir">|</span>
			<a class="subir" href="index.php?ctl=subirImg">Subir Imagen</a> <span class="login">|</span>
			<a class="login" href="index.php?ctl=login">Login</a> <span class="registro">|</span>
			<a class="registro" href="index.php?ctl=registro">Registrarse</a> <span class="logout">|</span>
			<a class="logout" href="logout.php">Cerrar Sesión</a>
			<hr/>
		</div>

		<div id="contenido" align="center">
			<?php echo $contenido ?>
		</div>
	</body>
</html>
