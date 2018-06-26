<?php

if(isset($_SESSION['id_directorio'])) { 
	$id_directorio = $_SESSION['id_directorio'];
} else {
	$id_directorio = '';
}

if($id_directorio != '') {

	Conexiones::apertura();
	$directorio = Directorios::seleccionar_directorio(Conexiones::obtencion(), $id_directorio);

	foreach($_SESSION['examenes'] as $e) { 
	    if(isset($_POST[$e -> obtener_nombre()])) {
		$_SESSION['id_examen'] = $e -> obtener_id();
	    }
	}

	$id_examen = $_SESSION['id_examen'];
	$_SESSION['ejercicios'] = Ejercicios::seleccion_total(Conexiones::obtencion(), $id_examen);
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
	<h2>EXERCICIS</h2>
</div>

<div class="col-md-12">
    <ul class="nav nav-sidebar wrapper">

<?php
foreach($_SESSION['ejercicios'] as $e) {
?>
	<div class="container">
		<div class="row">
			<form role="form" method="post" action="<?php echo RUTA_CORRECCIO ?>">
				<button id="examenes" type="submit" name="<?php echo $e -> obtener_nombre(); ?>" 
					class="btn btn-lg btn-primary btn-block"> <?php echo $e -> obtener_nombre(); ?>
				</button>
			</form>
<?php
}
?>
			<form role="form" method="post" action="<?php echo RUTA_ALUMNES ?>">
				<button id="examenes" type="submit" name="<?php echo $directorio -> obtener_nombre() ?>" 
					class="btn btn-lg btn-primary btn-block"> Puntuacions Alumnes
				</button>
			</form>

			<form role="form" method="post" action="<?php echo RUTA_EXERCICI_NOU ?>">
			    <button id="examenes" type="submit" name="nouExercici" class="btn btn-lg btn-primary btn-block"> Nou Exercici </button>
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

