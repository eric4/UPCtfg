<?php

if(isset($_SESSION['id_directorio'])) { 
	$id_directorio = $_SESSION['id_directorio'];
} else {
	$id_directorio = '';
}

if($id_directorio != '') {

	Conexiones::apertura();
	$directorio = Directorios::seleccionar_directorio(Conexiones::obtencion(), $id_directorio);
	$_SESSION['examenes'] = Examenes::seleccion_total(Conexiones::obtencion(), $id_directorio);
	Conexiones::cierre();
?>

<div class="col-md-12">
	<h1>
	<strong>

	<?php echo $directorio -> obtener_nombre() ?>
	<?php echo 'CURS ' . $directorio -> obtener_inicio() . '-' . $directorio -> obtener_fin() ?>
	<?php echo $directorio -> obtener_cuatrimestre() ?>

	</strong>
	</h1>
	<h2>EXÀMENS</h2>
</div>

<br><br><br>

<div class="col-md-12">
<ul class="nav nav-sidebar wrapper">
<?php
foreach($_SESSION['examenes'] as $e) {
?>
	<div class="container">
		<div class="row">
			<form role="form" method="post" action="<?php echo RUTA_EXERCICIS ?>">
				<button id="examenes" type="submit" name="<?php echo $e -> obtener_nombre(); ?>" 
					class="btn btn-lg btn-primary btn-block"> <?php echo $e -> obtener_nombre(); ?>
				</button>
			</form>
<?php
}
?>
			<form role="form" method="post" action="<?php echo RUTA_INFORMACIO ?>">
				<button id="examenes" type="submit" name="Nou_Examen" class="btn btn-lg btn-primary btn-block"> Nou Examen </button>
			</form>
		</div>
	</div>
</ul>
</div>
<?php
} else {
	include_once 'vistas/404.php';
}
?>

