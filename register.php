<?php ob_start() ?>
<h1>Formulario de Registro</h1>
<?php
	include_once('register.inc.php');
	include_once('functions.php');
?>

<?php
   	if (!empty($error_msg)) {
   		echo $error_msg;
   	}
?>

<ul>
	<li>Los nombres de usuario podrán contener sólo dígitos, letras mayúsculas, minúsculas y guiones bajos.</li>
	<li>Los correos electrónicos deberán tener un formato válido.</li>
	<li>Las contraseñas deberán tener al menos 6 caracteres.</li>
	<li>Las contraseñas deberán estar compuestas por:
		<ul>
			<li>Por lo menos una letra mayúscula (A-Z)</li>
			<li>Por lo menos una letra minúscula (a-z)</li>
			<li>Por lo menos un número (0-9)</li>
		</ul>
	</li>
	<li>La contraseña y la confirmación deberán coincidir exactamente.</li>
</ul>
<form action="register.inc.php" method="post" name="registration_form">
	Nombre de Usuario: <input type="text" name="username" id="username" /><br>
	Correo Electrónico: <input type="text" name="email" id="email" /><br>
	Contraseña: <input type="password" name="password" id="password" /><br>
	Confirmar contraseña: <input type="password" name="confirmpwd" id="confirmpwd" /><br>
	<input type="button" value="Register" onclick="return regformhash(this.form, this.form.username, this.form.email, this.form.password,this.form.confirmpwd);" />
</form>

<script type="text/javascript">
	$(document).ready(function(){
				
			$('.misImgs').hide();
			$('.subir').hide();
			$('.login').show();
			$('.registro').show();
			$('.logout').hide();
		
	});
</script>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
