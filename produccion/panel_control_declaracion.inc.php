    <div class="container">
	<div class="ventana">
		<div class="form">
			<form role="form" method="post">
			    <?php include_once 'produccion/directorio_nuevo.inc.php'; ?>
			</form>
		</div>
	</div>
	<div class="row">
		<br>
		<div class="col-sm-3 col-md-3 contenedor-menu">
			<li id="prof"><strong> DIRECTORIS <strong></li>
			<ul class="nav nav-sidebar wrapper-list">
				<li><a id="directorio" href="#"> + Crear Nou Directori </a></li>

<?php				Conexiones::apertura();
				$directorios = Directorios::seleccion_total(Conexiones::obtencion(), $id_prof);
				Conexiones::cierre();

				foreach($directorios as $d) {
					if(isset($_POST[$d -> obtener_nombre()])) {
						$_SESSION['id_directorio'] = $d -> obtener_id();
						$nombre_directorio = $d -> obtener_nombre();
					}
?>					<form role="form" method="post" action="<?php echo RUTA_EXAMENES ?>">
						<button type="submit" name="<?php echo $d -> obtener_nombre(); ?>" 
							class="glyphicon glyphicon-folder-open btn-block"> 
							<?php echo $d -> obtener_nombre() ?>
							<?php echo substr($d -> obtener_inicio(), 2) . '-' . substr($d -> obtener_fin(), 2) ?>
							<?php echo substr($d -> obtener_cuatrimestre(), 0, 1) ?>
						</button>
					</form>
<?php
				}
?>
			</ul>

		</div>

		<div class="col-sm-9 col-md-9 main">

