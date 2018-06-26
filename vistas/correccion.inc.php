<?php

if(isset($_SESSION['ejercicios'])) { 
	$ejercicios = count($_SESSION['ejercicios']);
} else {
	$ejercicios = 0;
}

if($ejercicios > 0) {

foreach($_SESSION['ejercicios'] as $e) { 
    if(isset($_POST[$e -> obtener_nombre()])) {
	$_SESSION['ejercicio'] = $e;
    }
}

if(isset($_POST['carpeta'])) {
	$i = $_POST['i'];
	$path = $_POST['carpeta'];
	$x = $_POST['x'];
	$y = $_POST['y'];
	$w = $_POST['w'];
	$h = $_POST['h'];
	$total_carpetas = $_POST['total_carpetas'];
	$total_alumnos = $_POST['total_alumnos'];
	$array = $_SESSION['arrayAlumnos'];

	if($total_alumnos > 0) {
	    Conexiones::apertura();
	    $tn = Notas::insercion_path(Conexiones::obtencion(),$path,$_SESSION['ejercicio'] -> obtener_id(), $array[$i] -> obtener_id());
	    Conexiones::cierre();

	    unset($array[$i]);
	    $_SESSION['arrayAlumnos'] = array_values($array);
	}

} else if(isset($_POST['id_carpeta'])) {
	$i = 0;
	$x = $_POST['x'];
	$y = $_POST['y'];
	$w = $_POST['w'];
	$h = $_POST['h'];

	Conexiones::apertura();
	$_SESSION['arrayCarpetas'] = Carpetas::obtencion_subcarpetas(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), 0);
	$_SESSION['arrayAlumnos'] = RepositorioAlumno::obtener_todos(Conexiones::obtencion(), $_SESSION['id_examen']);
	$array = $_SESSION['arrayAlumnos'];
	$total_alumnos = count($_SESSION['arrayAlumnos']);
	for($alumno = 0; $alumno < $total_alumnos; $alumno++){
	    $tn = Notas::existe_nota(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), $array[$alumno] -> obtener_id());
	    $te = $array[$alumno] -> obtener_examen_cara_A();
	    if($tn > 0) unset($array[$alumno]);
	    if($te == "-" ) unset($array[$alumno]);
	}
	$_SESSION['arrayAlumnos'] = array_values($array);
	Conexiones::cierre();

} else if(isset($_POST['notas_finales'])) {
    	$i = $_POST['i'];
	$x = $_POST['x'];
	$y = $_POST['y'];
	$w = $_POST['w'];
	$h = $_POST['h'];
	$total_carpetas = $_POST['total_carpetas'];
	$total_alumnos = $_POST['total_alumnos'];
	$array = $_SESSION['arrayAlumnos'];

	Conexiones::apertura();
	$carpetas_ejercicio = Carpetas::seleccion_total(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id());

	for($ce = 0; $ce < count($carpetas_ejercicio); $ce++){
	    $valor = 0;	
	    $path_calculo = $carpetas_ejercicio[$ce] -> obtener_path();
	    while(strlen($path_calculo) > 0 ){
		$puntuacion = Carpetas::seleccion_valor(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), $path_calculo);
		$valor = $valor + $puntuacion;
		$path_calculo = substr($path_calculo, 0, -1);
	    }
	    $mv = Notas::actualizacion_valor(Conexiones::obtencion(), $valor, $_SESSION['ejercicio'] -> obtener_id(),
		   $carpetas_ejercicio[$ce] -> obtener_path());
	}
	Conexiones::cierre();

	echo "<div class='col-sm-12 col-md-12 alert alert-success' role='alert' style='text-align: center; font-size: 17px;'>Notes puntuades correctament</div>";


} else {
	Conexiones::apertura();
	$x = $_SESSION['ejercicio'] -> obtener_x();
	$y = $_SESSION['ejercicio'] -> obtener_y();
	$w = $_SESSION['ejercicio'] -> obtener_w();
	$h = $_SESSION['ejercicio'] -> obtener_h();

	$i = 0;
	$_SESSION['arrayCarpetas'] = Carpetas::obtencion_subcarpetas(Conexiones::obtencion(),$_SESSION['ejercicio'] -> obtener_id(), 0);
	$_SESSION['arrayAlumnos'] = RepositorioAlumno::obtener_todos(Conexiones::obtencion(), $_SESSION['id_examen']);
	$array = $_SESSION['arrayAlumnos'];
	$total_alumnos = count($_SESSION['arrayAlumnos']);
	for($alumno = 0; $alumno < $total_alumnos; $alumno++){
	    $tn = Notas::existe_nota(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), $array[$alumno] -> obtener_id());
	    $te = $array[$alumno] -> obtener_examen_cara_A();
	    if($tn > 0 ) unset($array[$alumno]);
	    if($te == "-" ) unset($array[$alumno]);
	}
	$_SESSION['arrayAlumnos'] = array_values($array);

	Conexiones::cierre();
}
	$arrayAlumno = $_SESSION['arrayAlumnos'];
	$arrayCarpeta = $_SESSION['arrayCarpetas'];
	$total_carpetas = count($_SESSION['arrayCarpetas']);
	$total_alumnos = count($_SESSION['arrayAlumnos']);
	$plana = $_SESSION['ejercicio'] -> obtener_plana();

	if( count( $arrayAlumno ) ) $image = $arrayAlumno[$i] -> obtener_examen_cara_A();
?>

<div class="container">
    <div class="row">
	<div class="col-sm-12 col-md-12" style="text-align: center;">
	    <h3 style="text-align:left; border-bottom:2px solid #000; left: 5px; margin-bottom:50px;"> Assignar a carpeta </h3>
	    <div>
		<form role="form" method="post" action="#" >
		    <?php for($c = 0; $c < $total_carpetas; $c++){ ?>
			<button class="carpeta" type="submit" name="carpeta" value="<?php echo $c ?>" > 
			    <?php echo $arrayCarpeta[$c] -> obtener_nombre() ?> 
			</button>
		    <?php } ?>
			<input type="hidden" value="<?php echo $i ?>" name="i" />
			<input type="hidden" value="<?php echo $total_alumnos ?>" name="total_alumnos" />
			<input type="hidden" value="<?php echo $total_carpetas ?>" name="total_carpetas" />
        	        <input type="hidden" value="<?php echo $x ?>" name="x" />
        	        <input type="hidden" value="<?php echo $y ?>" name="y" />
        	        <input type="hidden" value="<?php echo $w ?>" name="w" />
        	        <input type="hidden" value="<?php echo $h ?>" name="h" />
		</form>
	    </div>
	</div>
    </div>

    <?php if($total_alumnos > 0){ ?>
    <div class="row">
	<div class="col-sm-12 col-md-12" style="text-align: center;">
	    <div class="col-md-12 wrapper" style="height: inherit; margin-top: 50px;">
	   	<p style="font-size: 20px;"> 
		    <strong><?php echo $arrayAlumno[$i] -> obtener_nombre().' '. $arrayAlumno[$i] -> obtener_primer_apellido() ?> </strong>
	    	</p>
		<div style="width: <?php echo $w ?>px; height: <?php echo $h ?>px; display: inline-block; position: relative; overflow: hidden;">
		    <embed src="<?php echo $image ?>#page=<?php echo $plana ?>" style="pointer-events:none; width: 1174px; height: 1504px; 
			top: -<?php echo $y ?>px; position: relative; overflow: hidden; display: inline-block; left: -<?php echo $x ?>px;"/>
	        </div>
	    </div>
	</div>
    </div>
    <?php } ?>

    <div class="row">

		<ul class="col-md-12" style="height: inherit;">
		<div class="container">
		    <div class="row" style="margin-top: 75px;">
		<h3 style="text-align:left; border-bottom:2px solid #000; margin-bottom:50px;"> Accedir a subcarpeta </h3>
		<div class="container">
		    <div class="row">
		<?php
		for($bucle = 0; $bucle < $total_carpetas; $bucle++) {
		?>
			
					<div class="col-sm-4 col-md-4">
					<form role="form" method="post" action="<?php echo RUTA_SUBCARPETAS ?>">
						<button type="submit" name="id_carpeta" value="<?php echo $arrayCarpeta[$bucle] -> obtener_id(); ?>" 
						    class="btn btn-lg btn-primary btn-block" >  <?php echo $arrayCarpeta[$bucle]->obtener_nombre(); ?>
						</button>
						<input type="hidden" value="<?php echo $arrayCarpeta[$bucle] -> obtener_nombre(); ?>" name="nombre" />
						<input type="hidden" value="<?php echo $x ?>" name="x" />
						<input type="hidden" value="<?php echo $y ?>" name="y" />
						<input type="hidden" value="<?php echo $w ?>" name="w" />
						<input type="hidden" value="<?php echo $h ?>" name="h" />
					</form>
					</div>
		<?php
		}
		?>
				</div>
			</div>
</div>
</div>
		</ul>
	    <ul class="col-md-12" style="text-align: center; height: inherit;">
		<div class="container">
		    <div class="row" style="margin-top: 75px;">
			<h3 style="text-align:left; border-bottom:2px solid #000;margin-bottom: 20px; margin-bottom:50px;" > Calcular notes finals </h3>
			<form role="form" method="post" action="#" style="text-align:center;">
			    <button id="examenes" type="submit" name="notas_finales" class="btn btn-lg btn-primary btn-block" > 
				Calcular Notes
	 		    </button>
			    <input type="hidden" value="<?php echo $i ?>" name="i" />
   			    <input type="hidden" value="<?php echo $total_alumnos ?>" name="total_alumnos" />
			    <input type="hidden" value="<?php echo $total_carpetas ?>" name="total_carpetas" />
        	            <input type="hidden" value="<?php echo $x ?>" name="x" />
        	            <input type="hidden" value="<?php echo $y ?>" name="y" />
        	            <input type="hidden" value="<?php echo $w ?>" name="w" />
        	            <input type="hidden" value="<?php echo $h ?>" name="h" />
			</form>
		    </div>
		</div>
	    </ul>
    </div>
</div>

<?php

} else {
    include_once 'vistas/404.php';
}

?>
