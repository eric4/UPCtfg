<?php
	include_once 'bbdd/RepositorioAlumno.inc.php';

if(isset($_SESSION['id_directorio'])) { 
	$id_directorio = $_SESSION['id_directorio'];
} else {
	$id_directorio = '';
}

	if(isset($_POST['upload'])) {
		Conexion::abrir_conexion();
		if((substr($_FILES['excel']['name'], -3) == "csv") or (substr($_FILES['excel']['name'], -3) == "ods") or 
			(substr($_FILES['excel']['name'], -3) == "xls") or (substr($_FILES['excel']['name'], -4) == "xlsx") ) {
			include_once 'produccion/upload_2.inc.php';
		}
		Conexion::cerrar_conexion();
	}
?>

<div class="panel panel-default">
	<div class="panel-heading text-center">
		<h4> Nou Examen </h4>
	</div>
	<div class="panel-body">
		<form role="form" name="frmSubirArchivo" method="post" enctype="multipart/form-data" action="<?php echo RUTA_INFORMACIO_4 ?>" >
			<h2> INTRODUEIX LES DADES </h2>
			<br>
			<h3> PAS 3: Pujar Alumnes </h3>
			<br>
			<input type="file" name="excel" required/>
			<br>
<?php
			if(isset($_POST['upload'])) {
			    if(substr($_FILES['excel']['name'], -3) == "pdf") {
				echo "<br><div class='alert alert-danger' role='alert'>";
				echo "pdf pujat correctament";
				echo "</div><br>";
			    } else {
				echo "<br><div class='alert alert-danger' role='alert'>";
				echo "Cal introduir un arxiu excel";
				echo "</div><br>";
			    }
			}
?>
			<button type="submit" name="upload" class="btn btn-lg btn-primary btn-block">Introduir Dades</button>
		</form>
		<br>
		<br>
	</div>
</div>
