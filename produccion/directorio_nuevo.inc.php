<div class="cerrar"> 
	<label><a href="#">X</a></label> 
</div>
	<strong><h3>Crear Nou Directori</h3></strong>
<hr>
<div class="form-group">
    <div class="col-md-12">
	<label class="input" >NOM DE L'ASSIGNATURA</label>
	<input type="text" class="form-control" name="nombre" placeholder="Directori" required>
    </div>
    <div class="col-md-12">
	<label class="input">CURS</label>
	<br>
	<div class="row">
	    <div class="col-md-5">
		<input type="number" class="form-control" name="inicio" min="2000" max="4000" value="2017" required>
	    </div>
	    <div class="col-md-1">
		<?php echo ' - '; ?>
	    </div>
	    <div class="col-md-5">
		<input type="number" class="form-control" name="fin" min="2000" max="4000" value="2018" required>
	    </div>
	</div>
    </div>
    <div class="col-md-12">
	<label class="input">QUATRIMESTRE</label>
	<br>
	<select name="cuatrimestre" required>
		<option>PRIMAVERA</option>
		<option>TARDOR</option>
	</select>
    </div>
    <div class="col-md-12">
	<button type="submit" class="btn btn-default btn-primary" name="enviar"> OK </button>
    </div>
</div>

