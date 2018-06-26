<?php
include_once 'bbdd/RepositorioAlumno.inc.php';
include_once 'bbdd/RepositorioNota.inc.php';

if(isset($_SESSION['id_examen'])) { 
	$id_examen = $_SESSION['id_examen'];
} else {
	$id_examen = '';
}

if($id_examen != '') {

$ejercicios = $_SESSION['ejercicios'];
	
		Conexion::abrir_conexion();
		$alumnos = RepositorioAlumno::obtener_todos(Conexion::obtener_conexion(), $_SESSION['id_examen']);
?>
	<div class="col-sm-12 col-md-12 wrapper" style="height: 785px;">
		<div class="table-responsive">
			<table class="table" style="text-align: center;">
				<tr>
					<th>Nom</th>
					<?php for($i=0; $i < count($_SESSION['ejercicios']); $i++) { ?>
						<th> <?php echo $ejercicios[$i] -> obtener_nombre(); ?> </th>
					<?php } ?>
					<th>Nota Final</th>
				</tr>
<?php
				foreach($alumnos as $a) {

				$nota_total = 0;
?>
				<tr>
					<th> <?php echo $a -> obtener_nombre(); ?> </th>

					<?php for($i=0; $i < count($_SESSION['ejercicios']); $i++) { 
						$nota = RepositorioNota::seleccionar_nota(Conexion::obtener_conexion(), 
							$ejercicios[$i] -> obtener_id(), $a -> obtener_id()); 

						$path = RepositorioNota::obtener_path(Conexion::obtener_conexion(), 
							$ejercicios[$i] -> obtener_id(), $a -> obtener_id());

						$nota_total = $nota_total + $nota;

					?>
						<th> <?php if( ($nota > -1000) & ($nota < 1000) ) { ?>

						    <form role="form" method="post" action="<?php echo RUTA_SUBCARPETAS ?>" >
							<button name="lugar" style="background: none; border: none;"> <?php echo $nota ?> </button>
							<input type="hidden" value="<?php echo $a -> obtener_id() ?>" name="alumno" />
							<input type="hidden" value="<?php echo $path ?>" name="path" />
							<input type="hidden" value="<?php echo $ejercicios[$i] -> obtener_id() ?>" name="ejercicio" />
						    </form>


					<?			//echo $nota; 
							   } else {
								echo '-';
							   } ?>
						</th>
						
					<?php } ?>
					<th> <?php echo $nota_total; ?> </th>
				</tr>
<?php
				}
?>
			</table>
		</div>
	</div>
<?php
		Conexion::cerrar_conexion();

?>
<?php
} else {
	include_once 'vistas/404.php';
}
?>

