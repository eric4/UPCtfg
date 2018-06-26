<?php

if($_SESSION['administrador_profesor'] == 1) {
    $titulo = '¡Registre correcte!';
?>

<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Registre correcte
				</div>
				<div class="panel-body text-center">
					<p>El registre s'ha efectuat correctament</p>
					<br>
					<p> <a href="<?php echo RUTA_HOME ?>" > Retornar al directori </a> </p>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
} else {
	include_once 'vistas/404.php';
}
?>
