<div class="form-group">
	<label>Nombre de Profesor</label>
	<input type="text" class="form-control" name="nombre" placeholder="Usuario" value="<?php echo $validador -> obtener_nombre() ?>" >
	<?php
		$validador -> mostrar_error_nombre();
	?>
</div>
<div class="form-group">
	<label>Email</label>
	<input type="email" class="form-control" name="email" placeholder="eric.cp4@gmail" value="<?php echo $validador -> obtener_email() ?>" >
	<?php
		$validador -> mostrar_error_email();
	?>
</div>
<div class="form-group">
	<label>Contrasena</label>
	<input type="password" class="form-control" name="clave1">
	<?php
		$validador -> mostrar_error_clave1();
	?>
</div>
<div class="form-group">
	<label>Repite la Contrasena</label>
	<input type="password" class="form-control" name="clave2">
	<?php
		$validador -> mostrar_error_clave2();
	?>
</div>
<br>
<button type="reset" class="btn btn-default btn-primary"> Limpiar formulario </button>
<button type="submit" class="btn btn-default btn-primary" name="enviar"> Enviar </button>
