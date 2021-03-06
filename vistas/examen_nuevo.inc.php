<?php
	
include_once 'bbdd/RepositorioAlumno.inc.php';
include_once 'produccion/ValidadorExamen.inc.php';
include_once 'produccion/FuncionesRedireccion.inc.php';


if(isset($_SESSION['id_directorio'])) { 
	$id_directorio = $_SESSION['id_directorio'];
} else {
	$id_directorio = '';
}

	$display = 'block';
	$display2 = 'none';

	if(isset($_POST['nombre'])) {
	    Conexion::abrir_conexion();

	    $validador = new ValidadorExamen($_POST['nom'], $_SESSION['id_directorio'], Conexiones::obtencion());

	    if($validador -> examen_valido()){

		    $examen = new Examen('', $_POST['nom'], '', $id_directorio);
		    $examenes = RepositorioExamen::insertar_examen(Conexion::obtener_conexion(), $examen);
		    $_SESSION['id_examen'] = RepositorioExamen::obtener_id_examen(Conexion::obtener_conexion(), $examen);

		    $path = "media/";
		    opendir($path);
		    mkdir($path.$_SESSION['id_examen']);
			
		    $display = 'none';
		    $display2 = 'block';

	    }
	    Conexion::cerrar_conexion();
	}

?>

<div class="panel panel-default">
	<div class="panel-heading text-center">
		<h4> Nou Examen </h4>
	</div>
	<div class="panel-body">
		<form role="form" name="nombre_examen" method="post" enctype="multipart/form-data" action="<?php echo RUTA_INFORMACIO ?>" >
			<?php if(isset($_POST['nombre']) && $validador -> examen_valido()) {
				$validador -> mostrar_exito_nombre();
			      } else { ?>
			      <h2> INTRODUEIX LES DADES </h2>
			<?php } ?>
			<br>
			<h3 style="display: <?php echo $display ?>;"> PAS 1: Nom Examen </h3>
			<a href="<?php echo RUTA_INFORMACIO_2 ?>" style="display: <?php echo $display2 ?>; width:100%; text-align:center;"> 
			    <h3 style="width:150px; height:auto; padding:5px; box-sizing: border-box; background:#000; 
				color:#FFF; float:right; font-size: 15px;"> Següent </h3> 
			</a>
			<br>
			<input type="nom" name="nom" id="nom" class="form-control" placeholder="Nom Examen" 
			style="width: 95%; display: <?php echo $display ?>;" required autofocus>
			<br>
			<button type="submit" name="nombre" class="btn btn-lg btn-primary btn-block" style="display: <?php echo $display ?>;">
				Introduir Dades
			</button>
			<?php if(isset($_POST['nombre'])) $validador -> mostrar_error_nombre(); ?>
		</form>
		<br>
		<br>
	</div>
</div>
