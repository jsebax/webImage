<?php ob_start() ?>
<h1>Mis Imágenes</h1>

<?php
	
	include_once('db_connect.php');
	include_once('functions.php');
	include_once('gallery.php');

	sec_session_start();

	$logged = "false";

	$username = "";

	if(login_check($mysqli) == true) {
		$logged = "true";
		$myId = $_SESSION['user_id'];
		$username = $_SESSION['username'];
	}
?>

<?php echo $params['mensaje'] .' ' . $username ?><br/><br/>

<?php
	$gallery = new gallery();
	$gallery->loadFolder('img', $myId, true);
	$gallery->show(500, 100);

?>

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
