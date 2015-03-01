<?php

include_once('db_connect.php');
include_once('functions.php');

sec_session_start();

$id = 0;

if(login_check($mysqli) == true) {
		$id = $_SESSION['user_id'];
}

//comprobamos que sea una peticion ajax
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
	//obtenemos el archivo a subir
	$file = $_FILES['archivo']['name'];

	//comprobamos si existe un directorio para subir el archivo
	//si no es asi, lo creamos
	if (!is_dir("img/"))
	{
		mkdir("img/", 0777);
	}
	//comprobamos si el archivo ha subido 
	if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'], "img/".$file))
	{
		sleep(3); //retrasamos la peticion 3 segundos
		echo $file; //devolvemos el nombre del archivo para pintar la imagen

		//$id = $_SESSION['user_id'];

		$obj = new stdClass();
		$obj->nombre = $file;
		$obj->id = (int) $id;
		$obj->publico = true;

		$archivoJson = file_get_contents("imagenes.json");
		$datos = json_decode($archivoJson, true);
		$datos[] = $obj;

		$fh = fopen("imagenes.json", 'w');
		fwrite($fh, json_encode($datos, JSON_UNESCAPED_UNICODE));
		fclose($fh);
	}
}
else 
{
	throw new Exception("Error Processing Request", 1);
	
}
