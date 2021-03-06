<?php

include_once 'produccion/ValidadorEjercicio.inc.php';
include_once 'produccion/FuncionesRedireccion.inc.php';

if(isset($_SESSION['id_directorio'])) { 
	$id_directorio = $_SESSION['id_directorio'];
} else {
	$id_directorio = '';
}

if($id_directorio != '') {

	Conexiones::apertura();
	$directorio = Directorios::seleccionar_directorio(Conexiones::obtencion(), $id_directorio);
	$pdf = Alumnos::seleccion_primer_pdf(Conexiones::obtencion(), $_SESSION['id_examen']);
	Conexion::cerrar_conexion();

	$image = $pdf;
	$id_examen = $_SESSION['id_examen'];
	$total = Ejercicios::total_paginas($image);

	if(isset($_POST['atras'])) {
	    if($_POST['plana'] == 1) $plana = $_POST['total'];
	    else $plana = $_POST['plana'] - 1;
	} else if(isset($_POST['adelante'])) {
	    if($_POST['plana'] == $_POST['total']) $plana = 1;
	    else $plana = $_POST['plana'] + 1;
	} else {
	   $plana = 1;
	}

	if(isset($_POST[$directorio -> obtener_nombre()])) {

	    Conexiones::apertura();
	    $validador = new ValidadorEjercicio($_POST['nom'], $_SESSION['id_examen'], Conexiones::obtencion());

	    if($validador -> ejercicio_valido()){

	    	$ejercicio = new Ejercicio('', $_POST['nom'], $_POST['x'], $_POST['y'], $_POST['w'], $_POST['h'], $_POST['plana'], $id_examen);
	    	$insertar = Ejercicios::insercion_ejercicio(Conexiones::obtencion(), $ejercicio);
	    	$selecciona = Ejercicios::seleccion_ejercicio(Conexiones::obtencion(), $_POST['nom'], $_POST['x'], 
		    	    	$_POST['y'], $_POST['w'], $_POST['h'], $_POST['plana'], $id_examen);

	    	$array = $_POST['texto'];
	    	$array_num = count($array);
	    	for($i = 0; $i<$array_num; $i++){
		    $carpeta = new Carpeta('', $array[$i], $selecciona, $i, 0, ' ', 0);
		    $insertar = Carpetas::insercion_carpeta(Conexiones::obtencion(), $carpeta);
	    	}
	        Redirecciones::ejercicio_nuevo_correcto();
	    }
	    Conexion::cerrar_conexion();
	}
?>


<div class="container">
    <div class="row">
	<div class="col-sm-12 col-md-12">
	    <h1>
	    <strong>

	    <?php echo $directorio -> obtener_nombre() ?>
	    <?php echo 'CURS ' . $directorio -> obtener_inicio() . '-' . $directorio -> obtener_fin() ?>
	    <?php echo $directorio -> obtener_cuatrimestre() ?>

	    </strong>
	    <h2>NOU EXERCICI</h2>

	    <div>
		<form role="form" method="post" action="#" style="display:inline-block; width: 100%; margin: 30px 0; text-align: center;">
		    <button name="atras" class="btn btn-default" style="float: left;">
			<i class="fa fa-chevron-circle-left" style="font-size: 30px;"></i>
		    </button>
		    <p style="display: inline-block; font-size: 18px;">Pàgina <?php echo $plana; ?> / <?php echo $total; ?></p>
		    <button name="adelante" class="btn btn-default" style="float: right;">
			<i class="fa fa-chevron-circle-right" style="font-size: 30px;"></i>
		    </button>
		    <input type="hidden" name="plana" value="<?php echo $plana ?>" />
		    <input type="hidden" name="total" value="<?php echo $total ?>" />
		</form>
	    </div>
 
		        <form id="exercici_nou" role="form" method="post" action="#<?php /*echo RUTA_EXERCICIS*/ ?>" onsubmit="return checkCoords();">
			    <h3> Nom de l'exercici </h3>
			    <input type="nom" name="nom" id="nom" class="form-control" placeholder="Nom Exercici" required autofocus>
			    <?php if(isset($_POST[$directorio -> obtener_nombre()])) $validador -> mostrar_error_nombre(); ?>
			    <h3> Seleccionar l'exercici </h3>
                    	    <embed src="<?php echo $image ?>#page=<?php echo $plana ?>" id="cropbox" style="display: block; visibility: visible; 					border: medium none; margin: 0px; padding: 0px; top: 0px; left: 0px; width: 100%; height: 1500px;" />
                            <input type="hidden" id="x" name="x" />
                            <input type="hidden" id="y" name="y" />
                            <input type="hidden" id="w" name="w" />
                            <input type="hidden" id="h" name="h" />
			    <input type="hidden" name="plana" value="<?php echo $plana ?>" />
                            <input type="hidden" id="img" name="img" value="<?php echo $image ?>" />
		            <div class="container col-md-12">
			    	<ul id="list">
				    <input type='hidden' name='texto[]' value="Bé"> </input>
				    <input type='hidden' name='texto[]' value="Malament"> </input>
				    <input type='hidden' name='texto[]' value="Altres"> </input>
			    	</ul>
		            </div>
                            <p class="text-right">
                            	<input type="submit" name="<?php echo $directorio -> obtener_nombre(); ?>" value="OK" class="btn btn-primary btn-lg" />
                            </p>
                    	</form>
	</div>
    </div>
</div>

<?php
} else {
	include_once 'vistas/404.php';
}
?>
