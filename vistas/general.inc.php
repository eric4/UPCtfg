<div>
	<h1><strong>DEPARTAMENT D'ASSIGNATURA</strong></h1>
	<h3>MEMBRES DEL DEPARTAMENT</h3>
</div>
<br><br><br>
<div>
    <div class="row">
	<div class="col-md-12 wrapper">
<?php
	    Conexiones::apertura();
	    $profesores = Profesores::seleccion_total();
	    Conexiones::cierre();

	    if($_SESSION['administrador_profesor']) {
?>
	    	<p class="text-left"><a id="directorio" href="<?php echo RUTA_REGISTRO ?>">+ Registrar Professor</a></p><br>
<?php
	    }
?>
	    <table class="table table-striped">
		<tbody>
<?php
		    foreach($profesores as $p) {
?>
			<tr>
			    <td><?php echo $p -> obtener_nombre(); ?></td>
			    <td><?php echo $p -> obtener_email(); ?></td>
			    <td><?php if($p -> obtener_administrador()) echo "Administrador" ?></td>
			</tr>
<?php
		    }
?>
		</tbody>

	    </table>
	</div>
    </div>
</div>
<br><br><br>
