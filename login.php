<?php ob_start() ?>
<h1>Log In</h1>
<?php
	include_once 'db_connect.php';
	include_once 'functions.php';

	sec_session_start();

	$logged = "false";

	if(login_check($mysqli) == true) {
		$logged = "true";
	} 

	if (isset($_GET['error']))
	{
		echo '<p class="error">Error Logging In!</p>';	
	}
?>

<form action="process_login.php" method="post" name="login_form">
	Correo Electronico: <input type="text" name="email" />
	Contraseña: <input type="password" name="password" id="password" />
	<input type="button" value="Login" onclick="formhash(this.form, this.form.password);" />
</form>
<p>Si no tiene una cuenta, por favor <a href="index.php?ctl=registro">registrese.</a></p>

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
