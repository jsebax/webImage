<?php ob_start() ?>
<h1>Subir Imagen</h1>

<?php
	
	include_once('db_connect.php');
	include_once('functions.php');
	include_once('gallery.php');

	sec_session_start();

	$logged = "false";

	if(login_check($mysqli) == true) {
		$logged = "true";
	}
?>

<div align="center">
	<form enctype="multipart/form-data" class="formulario">
		<label>Subir un archivo</label><br/>
		<input type="file" name="archivo" id="imagen" /><br/><br/>
		<input type="button" value="Subir Imagen" id="boton" /><br/>
	</form>
</div><br/>
<div class="messages"></div><br/><br/>

<script type="text/javascript">
	$(document).ready(function(){
		var valor = <?php echo $logged ?>;
		if (valor == false) {
			$('.misImgs').hide();
			$('.subir').hide();
			$('.login').show();
			$('.registro').show();
			$('.logout').hide();
		} else {
			$('.misImgs').show();
			$('.subir').show();
			$('.login').hide();
			$('.registro').hide();
			$('.logout').show();
		}
	});
</script>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
