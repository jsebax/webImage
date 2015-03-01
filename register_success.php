<?php ob_start() ?>
<h1>Registro Exitoso</h1>
<p>Ahora podrás iniciar sesión.</p>

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
