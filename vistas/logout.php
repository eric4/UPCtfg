<?php

	include_once 'produccion/FuncionesSesion.inc.php';

	$titulo = '¡Logout correcto!';
	if(Sesion::sesion_iniciada()) {
		Sesion::cierre();
	}

	include_once 'produccion/header.inc.php';
	include_once 'produccion/navbar.inc.php';
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Logout correcte.
				</div>
				<div class="panel-body text-center">
					<p>¡Fins a la pròxima!</p>
					<br>
					<p><a href="<?php echo SERVIDOR ?>" > Inici </a> par accedir a la pàgina principal. </p>
				</div>
			</div>
		</div>
	</div>
</div>
