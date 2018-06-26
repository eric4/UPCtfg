<div class="cerrar"> 
	<label><a href="#">X</a></label> 
</div>
	<h3>Crear Nou Directori</h3>
<hr>
<div class="form-group">
	<label>Nom del Directori</label>
	<input type="text" class="form-control" name="nombre" placeholder="Directori">
	<?php
		$validador2 -> mostrar_error_nombre();
	?>
</div>
<button type="submit" class="btn btn-default btn-primary" name="enviar"> OK </button>
