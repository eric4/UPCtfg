<?php

if(isset($_SESSION['ejercicio'])) { 
	$ejercicios = count($_SESSION['ejercicio']);
} else if(isset($_POST['lugar'])) {
	$ejercicios = 1;
} else {
	$ejercicios = 0;
}

if($ejercicios > 0) {

if(isset($_POST['subcarpeta'])) {
	$i = $_POST['i'];
	$nombre = $_POST['nombre'];
	$id_carpeta = $_POST['id'];
	$path = $_POST['path'];
	$path_subcarpeta = $_POST['subcarpeta'];
	$path_total = $path.$path_subcarpeta;
	$x = $_POST['x'];
	$y = $_POST['y'];
	$w = $_POST['w'];
	$h = $_POST['h'];
	$total_carpetas = $_POST['total_carpetas'];
	$total_alumnos = $_POST['total_alumnos'];
	$arrayAlumnos = $_SESSION['arrayAlumnos'];

	Conexiones::apertura();
	$carpetas = Carpetas::obtencion_subcarpetas(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), $id_carpeta);
	if( count( $arrayAlumnos ) ) {
	   $tn = Notas::actualizacion_path(Conexiones::obtencion(), $path_total, $_SESSION['ejercicio']->obtener_id(), $arrayAlumnos[$i]->obtener_id());
	}
	Conexiones::cierre();

	unset($arrayAlumnos[$i]);
	$_SESSION['arrayAlumnos'] = array_values($arrayAlumnos);
	$arrayAlumnos = $_SESSION['arrayAlumnos'];

} else if(isset($_POST['id_carpeta'])) {
	$_SESSION['id_carpeta'] = $_POST['id_carpeta'];
	$id_carpeta = $_SESSION['id_carpeta'];
	$_SESSION['nombre'] = $_POST['nombre'];
	$nombre = $_SESSION['nombre'];
	$x = $_POST['x'];
	$y = $_POST['y'];
	$w = $_POST['w'];
	$h = $_POST['h'];
	$i = 0;

	Conexiones::apertura();
	$path = Carpetas::seleccion_path(Conexiones::obtencion(), $id_carpeta);
	$carpetas = Carpetas::obtencion_subcarpetas(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), $id_carpeta);
	$arrayAlumnos = Notas::seleccion_total(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), $path);
	$total = count($arrayAlumnos);
	for($a = 0; $a < $total; $a++){
	   $arrayAlumnos[$a] = RepositorioAlumno::obtener_alumno(Conexiones::obtencion(), $arrayAlumnos[$a] -> obtener_alumno_id());
	}
	Conexiones::cierre();
	$total_carpetas = count($carpetas);
	$_SESSION['arrayAlumnos'] = $arrayAlumnos;

} else if(isset($_POST['up'])) {
	$id_carpeta = $_POST['id'];
	$nombre = $_POST['nombre'];
	$total_carpetas = $_POST['total_carpetas'];
	$arrayAlumnos = $_SESSION['arrayAlumnos'];
	$path = $_POST['path'];
	$i = $_POST['i'];
	$x = $_POST['x'];
	$y = $_POST['y'];
	$w = $_POST['w'];
	$h = $_POST['h'];

	Conexiones::apertura();
	$carpetas = Carpetas::obtencion_subcarpetas(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), $id_carpeta);
	$path_alumno = Notas::seleccion_path(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), $arrayAlumnos[$i] -> obtener_id());
	if( strlen($path_alumno) == 1 )  {
	    Notas::delete(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), $arrayAlumnos[$i] -> obtener_id());
	} else {
	    $path_alumno = substr($path_alumno, 0, -1);
	    $tn = Notas::actualizacion_path(Conexiones::obtencion(), $path_alumno,
			$_SESSION['ejercicio'] -> obtener_id(), $arrayAlumnos[$i] -> obtener_id());
	}
	Conexiones::cierre();

	unset($arrayAlumnos[$i]);
	$_SESSION['arrayAlumnos'] = array_values($arrayAlumnos);
	$arrayAlumnos = $_SESSION['arrayAlumnos'];


} else if(isset($_POST['subir_carpeta'])) {
	$id = $_POST['id'];
	$path = $_POST['path'];
	$path = substr($path, 0, -1);
	$x = $_POST['x'];
	$y = $_POST['y'];
	$w = $_POST['w'];
	$h = $_POST['h'];
	$i = 0;

	Conexiones::apertura();
	$id_carpeta = Carpetas::seleccion_id(Conexiones::obtencion(), $id);
	$nombre = Carpetas::seleccion_nombre(Conexiones::obtencion(), $id_carpeta);
	$carpetas = Carpetas::obtencion_subcarpetas(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), $id_carpeta);
	$arrayAlumnos = Notas::seleccion_total(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), $path);
	$total = count($arrayAlumnos);
	for($a = 0; $a < $total; $a++){
	   $arrayAlumnos[$a] = RepositorioAlumno::obtener_alumno(Conexiones::obtencion(), $arrayAlumnos[$a] -> obtener_alumno_id());
	}
	Conexiones::cierre();
	$total_carpetas = count($carpetas);
	$_SESSION['arrayAlumnos'] = $arrayAlumnos;


} else if(isset($_POST['insertar'])) {
	$id_carpeta = $_POST['id'];
	$nombre = $_POST['nombre'];
	$total_carpetas = $_POST['total_carpetas'];
	$arrayAlumnos = $_SESSION['arrayAlumnos'];
	$path = $_POST['path'];
	$i = $_POST['i'];
	$x = $_POST['x'];
	$y = $_POST['y'];
	$w = $_POST['w'];
	$h = $_POST['h'];
	
	Conexiones::apertura();
	if(isset($_POST['texto'])){
	    $array = $_POST['texto'];
	    $array_num = count($array);
	    for($p = 0; $p < $array_num; $p++){
		$suma_subcarpeta = $p + $total_carpetas;
		$path_subcarpeta = $path.$suma_subcarpeta;
		$carpeta = new Carpeta('', $array[$p], $_SESSION['ejercicio'] -> obtener_id(), $path_subcarpeta, $i, ' ', $id_carpeta);
		$insertar = Carpetas::insercion_carpeta(Conexiones::obtencion(), $carpeta);			
	    }
	}
	$carpetas = Carpetas::obtencion_subcarpetas(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), $id_carpeta);
	$total_carpetas = count($carpetas);
	Conexiones::cierre();

} else if(isset($_POST['puntuar'])) {
	$id_carpeta = $_POST['id'];
	$nombre = $_POST['nombre'];
	$total_carpetas = $_POST['total_carpetas'];
	$arrayAlumnos = $_SESSION['arrayAlumnos'];
	$path = $_POST['path'];
	$valor = $_POST['puntos'];
	$i = $_POST['i'];
	$x = $_POST['x'];
	$y = $_POST['y'];
	$w = $_POST['w'];
	$h = $_POST['h'];
	
	Conexiones::apertura();
	$carpetas = Carpetas::obtencion_subcarpetas(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), $id_carpeta);
	$puntos = Carpetas::actualizacion_puntuacion(Conexiones::obtencion(), $valor, $id_carpeta);
	Conexiones::cierre();

} else if(isset($_POST['comentario_submit'])) {
	$id_carpeta = $_POST['id'];
	$nombre = $_POST['nombre'];
	$total_carpetas = $_POST['total_carpetas'];
	$arrayAlumnos = $_SESSION['arrayAlumnos'];
	$path = $_POST['path'];
	$i = $_POST['i'];
	$x = $_POST['x'];
	$y = $_POST['y'];
	$w = $_POST['w'];
	$h = $_POST['h'];
	$comentario = $_POST['comentario_texto'];

	Conexiones::apertura();
	$tn = Carpetas::actualizacion_comentario(Conexiones::obtencion(), $comentario, $id_carpeta);
	$carpetas = Carpetas::obtencion_subcarpetas(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), $id_carpeta);
	Conexiones::cierre();

} else if(isset($_POST['adelante'])) {
	$id_carpeta = $_POST['id'];
	$nombre = $_POST['nombre'];
	$total_carpetas = $_POST['total_carpetas'];
	$arrayAlumnos = $_SESSION['arrayAlumnos'];
	$path = $_POST['path'];
	if( ($_POST['i'] + 1) == $_POST['total_alumnos']) {
	    $i = 0;
	} else {
	    $i = $_POST['i'] + 1;
	}
	$x = $_POST['x'];
	$y = $_POST['y'];
	$w = $_POST['w'];
	$h = $_POST['h'];

	Conexiones::apertura();
	$carpetas = Carpetas::obtencion_subcarpetas(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), $id_carpeta);
	Conexiones::cierre();

} else if(isset($_POST['atras'])) {
	$id_carpeta = $_POST['id'];
	$nombre = $_POST['nombre'];
	$total_carpetas = $_POST['total_carpetas'];
	$arrayAlumnos = $_SESSION['arrayAlumnos'];
	$path = $_POST['path'];
	if( $_POST['i'] == 0) {
	    $i = $_POST['total_alumnos'] - 1;
	} else {
	    $i = $_POST['i'] - 1;
	}
	$x = $_POST['x'];
	$y = $_POST['y'];
	$w = $_POST['w'];
	$h = $_POST['h'];

	Conexiones::apertura();
	$carpetas = Carpetas::obtencion_subcarpetas(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), $id_carpeta);
	Conexiones::cierre();

} else if(isset($_POST['lugar'])) {

	Conexiones::apertura();
	$_SESSION['ejercicio'] = Ejercicios::seleccion_ejercicio_por_id(Conexiones::obtencion(), $_POST['ejercicio']);
	$id_carpeta = Carpetas::seleccion_id_carpeta(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), $_POST['path']);
	$carpetas = Carpetas::obtencion_subcarpetas(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), $id_carpeta);
	$path = $_POST['path'];
	$arrayAlumnos = Notas::seleccion_total(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), $path);
	$total = count($arrayAlumnos);
	$nombre = Carpetas::seleccion_nombre(Conexiones::obtencion(), $id_carpeta);


	$i = 0;
	for($a = 0; $a < $total; $a++){
	   $id_alumno = $arrayAlumnos[$a] -> obtener_alumno_id();
	   $arrayAlumnos[$a] = RepositorioAlumno::obtener_alumno(Conexiones::obtencion(), $id_alumno);
	   if( ( $id_alumno ) == $_POST['alumno'] ) $i = $a;
	}
	Conexiones::cierre();
	$total_carpetas = count($carpetas);
	$_SESSION['arrayAlumnos'] = $arrayAlumnos;


	$x = $_SESSION['ejercicio'] -> obtener_x();
	$y = $_SESSION['ejercicio'] -> obtener_y();
	$w = $_SESSION['ejercicio'] -> obtener_w();
	$h = $_SESSION['ejercicio'] -> obtener_h();
	


} else {

	Conexiones::apertura();
	$i = 0;
	$id_carpeta = $_SESSION['id_carpeta'];
	$path = Carpetas::seleccion_path(Conexiones::obtencion(), $id_carpeta);
	$carpetas = Carpetas::obtencion_subcarpetas(Conexiones::obtencion(), $_SESSION['ejercicio'] -> obtener_id(), $id_carpeta);
	$nombre = $_SESSION['nombre'];
	$x = $_SESSION['ejercicio'] -> obtener_x();
	$y = $_SESSION['ejercicio'] -> obtener_y();
	$w = $_SESSION['ejercicio'] -> obtener_w();
	$h = $_SESSION['ejercicio'] -> obtener_h();
	$arrayAlumnos = $_SESSION['arrayAlumnos'];
	$total_carpetas = count($carpetas);
	Conexiones::cierre();
}

	Conexiones::apertura();
	$comentario = Carpetas::seleccion_comentario(Conexiones::obtencion(), $id_carpeta);
	$puntos = Carpetas::seleccion_puntuacion(Conexiones::obtencion(), $id_carpeta);
	Conexiones::cierre();


$plana = $_SESSION['ejercicio'] -> obtener_plana();
$total_alumnos = count($arrayAlumnos);	
if( count( $arrayAlumnos ) ) $image = $arrayAlumnos[$i] -> obtener_examen_cara_A();
?>

<div class="container">
    <div class="row">
	<div class="col-sm-12 col-md-12" style="text-align: center; background-color: rgb(190, 191, 192);">
	    <div class="col-sm-2 col-md-2" style="font-size: 20px; text-align:center; float:left;">
	    	<p><span class="glyphicon glyphicon-user" style="width:25px; height: 25px;"></span><p>
	    	<input type="text" disabled value="<?php echo $total_alumnos ?>" style="width:100%; text-align:center;" />
	    </div>
	    <div class="col-sm-8 col-md-8" >
	    	<p style="font-size: 45px; text-transform: uppercase; font-family: 'Times new Roman',Times,serif;"> <?php echo $nombre ?> 
	    	</p>
	    </div>
	    <div class="col-sm-2 col-md-2" style="font-size: 20px; text-align:center; float:left;">
	    	<p><i class="fa fa-clipboard" style="width:25px; height: 25px;"> </i><p>
	    	<input type="text" disabled value="<?php echo $puntos ?>" style="width:100%; text-align:center;" />
	    </div>
	</div>
	
	<div class="col-sm-12 col-md-12" style="text-align: center; display:inline-block; margin-top: 25px;">
	    <h3 style="text-align:left; border-bottom:2px solid #000; left: 5px; margin-bottom:50px;"> Assignar a carpeta </h3>
	    <div>
		<form role="form" method="post" action="#" >
		    <?php for($c = 0; $c < $total_carpetas; $c++){ ?>
			<button class="carpeta" type="submit" name="subcarpeta" value="<?php echo $c ?>" > 
			    <?php echo $carpetas[$c] -> obtener_nombre() ?> 
			</button>
			<input type="hidden" value="<?php echo $i ?>" name="i" />
			<input type="hidden" value="<?php echo $total_alumnos ?>" name="total_alumnos" />
			<input type="hidden" value="<?php echo $total_carpetas ?>" name="total_carpetas" />
        	        <input type="hidden" value="<?php echo $x ?>" name="x" />
        	        <input type="hidden" value="<?php echo $y ?>" name="y" />
        	        <input type="hidden" value="<?php echo $w ?>" name="w" />
        	        <input type="hidden" value="<?php echo $h ?>" name="h" />
        	        <input type="hidden" value="<?php echo $id_carpeta ?>" name="id" />
        	        <input type="hidden" value="<?php echo $path ?>" name="path" />
        	        <input type="hidden" value="<?php echo $carpetas[$c] -> obtener_nombre() ?>" name="nombre" />
        	        <input type="hidden" value="<?php echo $arrayAlumnos ?>" name="arrayAlumnos" />
		    <?php } ?>

			<button class="carpeta" type="submit" name="up" value="up" > 
			    <span class="glyphicon glyphicon-arrow-up"> Pujar </span>
			    <input type="hidden" value="<?php echo $i ?>" name="i" />
			    <input type="hidden" value="<?php echo $total_alumnos ?>" name="total_alumnos" />
			    <input type="hidden" value="<?php echo $total_carpetas ?>" name="total_carpetas" />
        	            <input type="hidden" value="<?php echo $x ?>" name="x" />
        	            <input type="hidden" value="<?php echo $y ?>" name="y" />
        	            <input type="hidden" value="<?php echo $w ?>" name="w" />
        	            <input type="hidden" value="<?php echo $h ?>" name="h" />
        	            <input type="hidden" value="<?php echo $id_carpeta ?>" name="id" />
        	            <input type="hidden" value="<?php echo $path ?>" name="path" />
        	            <input type="hidden" value="<?php echo $nombre ?>" name="nombre" />
        	            <input type="hidden" value="<?php echo $arrayAlumnos ?>" name="arrayAlumnos" />
			</button>
		</form>
	    </div>
	</div>
    </div>
    <?php if($total_alumnos > 0){ ?>
    <div class="row">
	<div class="col-sm-12 col-md-12" style="text-align: center;">
	    <div class="col-md-12" style="height: inherit; margin-top: 20px;">
		<p style="font-size: 20px; "> <strong><?php echo $arrayAlumnos[$i] -> obtener_nombre().' '.
		    $arrayAlumnos[$i] -> obtener_primer_apellido() ?> </strong>
	    	</p>
	    </div>
	    <div class="col-md-12 wrapper" style="height: inherit;">
		<div style="width: <?php echo $w ?>px; height: <?php echo $h ?>px; display: inline-block; position: relative; overflow: hidden;">
		    <embed src="<?php echo $image ?>#page=<?php echo $plana ?>" style="pointer-events:none; width: 1174px; height: 1504px; 
			top: -<?php echo $y ?>px; position: relative; overflow: hidden; display: inline-block; left: -<?php echo $x ?>px;"/>
	        </div>
	    </div>
	    <div class="col-sm-2 col-md-2" style="height: inherit; margin-top: 10px;" > </div>
	    <div class="col-sm-8 col-md-8" style="height: inherit; margin-top: 10px;">
	        <form role="form" method="post" action="#">
		    <button name="atras" class="btn btn-default">
			<i class="fa fa-chevron-circle-left" style="font-size: 30px;"></i>
		    </button>
		    <button name="adelante" class="btn btn-default">
			<i class="fa fa-chevron-circle-right" style="font-size: 30px;"></i>
		    </button>
		    <input type="hidden" value="<?php echo $i ?>" name="i" />
		    <input type="hidden" value="<?php echo $total_alumnos ?>" name="total_alumnos" />
		    <input type="hidden" value="<?php echo $total_carpetas ?>" name="total_carpetas" />
        	    <input type="hidden" value="<?php echo $x ?>" name="x" />
        	    <input type="hidden" value="<?php echo $y ?>" name="y" />
        	    <input type="hidden" value="<?php echo $w ?>" name="w" />
        	    <input type="hidden" value="<?php echo $h ?>" name="h" />
        	    <input type="hidden" value="<?php echo $id_carpeta ?>" name="id" />
        	    <input type="hidden" value="<?php echo $path ?>" name="path" />
        	    <input type="hidden" value="<?php echo $nombre ?>" name="nombre" />
        	    <input type="hidden" value="<?php echo $arrayAlumnos ?>" name="arrayAlumnos" />
	        </form>
	    </div>
	    <div class="col-sm-2 col-md-2" style="height: inherit; margin-top: 10px;" >
	        <form role="form" method="post" action="<?php echo $image; ?>" target="_blank">		
		    <button class="btn btn-secondary">
			<i class="fa fa-external-link"></i>
		    </button>
	        </form>
	    </div>
	</div>
    </div>
    <?php } ?>

    <div class="row">
	<div class="col-sm-12 col-md-12" style="text-align: center;">
	    <form role="form" method="post" action="#">
		<div>
		    <p style="font-size: 40px; line:height:20px; margin-top: 40px; margin-bottom: 50px;"> 
			<span class="fa fa-comments" style="margin-bottom: 5px;"></span> 
			<textarea name="comentario_texto" 
			style="width:60%; font-size: 15px; margin: 10px 45px 0 45px;"><?php echo $comentario ?></textarea>

		        <button type="submit" name="comentario_submit" class="btn btn-primary">
			    <span class="fa fa-floppy-o" style="font-size: 20px; margin-bottom: 5px;"> </span>
		        </button>
		        <input type="hidden" value="<?php echo $i ?>" name="i" />
		        <input type="hidden" value="<?php echo $total_alumnos ?>" name="total_alumnos" />
		        <input type="hidden" value="<?php echo $total_carpetas ?>" name="total_carpetas" />
        	        <input type="hidden" value="<?php echo $x ?>" name="x" />
        	        <input type="hidden" value="<?php echo $y ?>" name="y" />
        	        <input type="hidden" value="<?php echo $w ?>" name="w" />
        	        <input type="hidden" value="<?php echo $h ?>" name="h" />
        	        <input type="hidden" value="<?php echo $id_carpeta ?>" name="id" />
        	        <input type="hidden" value="<?php echo $path ?>" name="path" />
        	        <input type="hidden" value="<?php echo $nombre ?>" name="nombre" />
        	        <input type="hidden" value="<?php echo $arrayAlumnos ?>" name="arrayAlumnos" />
		    </p>
		</div>
		<?php if( isset($_POST['comentario_submit']) ) {
		    if($tn > 0){
			echo "<br><div class='alert alert-success' role='alert'>";
			echo "El comentari s'ha guardat correctament";
			echo "</div><br>";
		    } else{
			echo "<br><div class='alert alert-danger' role='alert'>";
			echo "L'usuari encara no té nota";
			echo "</div><br>";
		    }
		} ?>
	    </form>
	</div>
    </div>

    <div class="row">
	<div class="col-sm-12 col-md-12" style="text-align: center;">
	    <div class="col-sm-6 col-md-6">
	      <div class="col-md-12">
		<form role="form" method="post" action="#">
		    <div class="col-md-12">
		    	<h3 style="text-align:left; border-bottom:2px solid #000; margin-bottom:50px;"> Afegir subcarpetes </h3>
		    	<ul id="list">
		    	</ul>
		    </div>
		    <div class="col-md-12" style="text-align:left; clear:both;">
		    	<input type="text" id="texto" style="width: 100%; height:45px; text-align:left;" />
		    </div>
		    <div class="col-md-12" style="text-align:left;">
		    	<button type="button" id="insertar" style="width:auto; height:45px;">Inserta</button>
		    	<button type="button" id="netejar" style="width:auto; height:45px;">Neteja</button>
			<button class="btn btn-primary btn-lg" type="submit" name="insertar" value="insertar" 
				style="width:15%; height:45px; font-size: 14px; float:right;"> 
			    OK
			</button>
			<input type="hidden" value="<?php echo $i ?>" name="i" />
			<input type="hidden" value="<?php echo $total_alumnos ?>" name="total_alumnos" />
			<input type="hidden" value="<?php echo $total_carpetas ?>" name="total_carpetas" />
        	        <input type="hidden" value="<?php echo $x ?>" name="x" />
        	        <input type="hidden" value="<?php echo $y ?>" name="y" />
        	        <input type="hidden" value="<?php echo $w ?>" name="w" />
        	        <input type="hidden" value="<?php echo $h ?>" name="h" />
        	        <input type="hidden" value="<?php echo $path ?>" name="path" />
        	        <input type="hidden" value="<?php echo $id_carpeta ?>" name="id" />
        	        <input type="hidden" value="<?php echo $nombre ?>" name="nombre" />
        	        <input type="hidden" value="<?php echo $arrayAlumnos ?>" name="arrayAlumnos" />
		    </div>
		</form>
	      </div>
	    </div>
	    
	    <div class="col-sm-6 col-md-6">
		<div class="col-md-12">
		    <form role="form" method="post" action="#">
			<div class="col-md-12">
		    	    <h3 style="text-align:left; border-bottom:2px solid #000; left: 5px; margin-bottom:50px;"> Puntuar carpeta </h3>
			</div>
			<div class="col-md-12" style="text-align:left;">
			<input type="number" step="0.01" id="puntos" value="0" name="puntos" 
				style="width:75%; height:45px; text-align:center; font-size:18px;" />
			<button class="btn btn-primary btn-lg" type="submit" name="puntuar" value="puntuar" 
				style="width:15%; height:45px; font-size: 14px; float:right;"> 
			    OK
			</button>
			<input type="hidden" value="<?php echo $i ?>" name="i" />
			<input type="hidden" value="<?php echo $total_alumnos ?>" name="total_alumnos" />
			<input type="hidden" value="<?php echo $total_carpetas ?>" name="total_carpetas" />
        	        <input type="hidden" value="<?php echo $x ?>" name="x" />
        	        <input type="hidden" value="<?php echo $y ?>" name="y" />
        	        <input type="hidden" value="<?php echo $w ?>" name="w" />
        	        <input type="hidden" value="<?php echo $h ?>" name="h" />
        	        <input type="hidden" value="<?php echo $path ?>" name="path" />
        	        <input type="hidden" value="<?php echo $id_carpeta ?>" name="id" />
        	        <input type="hidden" value="<?php echo $nombre ?>" name="nombre" />
        	        <input type="hidden" value="<?php echo $arrayAlumnos ?>" name="arrayAlumnos" />
			</div>
		    </form>
		</div>
	    </div>
	  
	</div>
	<div class="col-sm-12 col-md-12" style="text-align: center; margin-top: 75px">
	    <h3 style="text-align:left; border-bottom:2px solid #000; left: 5px; margin-bottom:50px;"> Accedir a subcarpeta </h3>
	    <div class="row">		
	    	<?php for($bucle = 0; $bucle < $total_carpetas; $bucle++) { ?>
	    	<div class="col-sm-4 col-md-4">
		<form role="form" method="post" action="#">
			<button type="submit" name="id_carpeta" value="<?php echo $carpetas[$bucle] -> obtener_id(); ?>" 
			    class="btn btn-lg btn-primary btn-block"> <?php echo $carpetas[$bucle] -> obtener_nombre(); ?>
			</button>
        	        <input type="hidden" value="<?php echo $carpetas[$bucle] -> obtener_nombre(); ?>" name="nombre" />
			<input type="hidden" value="<?php echo $i ?>" name="i" />
			<input type="hidden" value="<?php echo $total_alumnos ?>" name="total_alumnos" />
			<input type="hidden" value="<?php echo $total_carpetas ?>" name="total_carpetas" />
        	        <input type="hidden" value="<?php echo $x ?>" name="x" />
        	        <input type="hidden" value="<?php echo $y ?>" name="y" />
        	        <input type="hidden" value="<?php echo $w ?>" name="w" />
        	        <input type="hidden" value="<?php echo $h ?>" name="h" />
        	        <input type="hidden" value="<?php echo $path ?>" name="path" />
        	        <input type="hidden" value="<?php echo $id_carpeta ?>" name="id" />
        	        <input type="hidden" value="<?php echo $arrayAlumnos ?>" name="arrayAlumnos" />
		</form>
		</div>
		<?php } ?>
	    

		<div class="col-sm-4 col-md-4">
		<?php if(strlen($path) == 1) { ?>
		<form role="form" method="post" action="<?php echo RUTA_CORRECCIO ?>">
		    <button type="submit" name="id_carpeta" value="<?php echo '' ?>" class="btn btn-lg btn-primary btn-block"> 
			<span class="glyphicon glyphicon-arrow-up"> Pujar </span>
		    </button>
		    <input type="hidden" value="<?php echo $x ?>" name="x" />
		    <input type="hidden" value="<?php echo $y ?>" name="y" />
		    <input type="hidden" value="<?php echo $w ?>" name="w" />
		    <input type="hidden" value="<?php echo $h ?>" name="h" />
		</form>
		<?php } else { ?>
		<form role="form" method="post" action="#">
		    <button type="submit" name="subir_carpeta" value="<?php echo "subir_carpeta" ?>" class="btn btn-lg btn-primary btn-block"> 
			<span class="glyphicon glyphicon-arrow-up"> Pujar </span>
		    </button>
        	        <input type="hidden" value="<?php echo $nombre ?>" name="nombre" />
			<input type="hidden" value="<?php echo $i ?>" name="i" />
			<input type="hidden" value="<?php echo $total_alumnos ?>" name="total_alumnos" />
			<input type="hidden" value="<?php echo $total_carpetas ?>" name="total_carpetas" />
        	        <input type="hidden" value="<?php echo $x ?>" name="x" />
        	        <input type="hidden" value="<?php echo $y ?>" name="y" />
        	        <input type="hidden" value="<?php echo $w ?>" name="w" />
        	        <input type="hidden" value="<?php echo $h ?>" name="h" />
        	        <input type="hidden" value="<?php echo $path ?>" name="path" />
        	        <input type="hidden" value="<?php echo $id_carpeta ?>" name="id" />
        	        <input type="hidden" value="<?php echo $arrayAlumnos ?>" name="arrayAlumnos" />
		</form>
		<?php } ?>
		</div>
	    </div>
	</div>
    </div>
</div>

<?php

} else {
    include_once 'vistas/404.php';
}

?>
