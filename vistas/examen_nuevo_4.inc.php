<?php

if(isset($_SESSION['id_examen'])) {

if(isset($_POST['upload'])) {
	Conexion::abrir_conexion();
	if((substr($_FILES['excel']['name'], -3) == "csv") or (substr($_FILES['excel']['name'], -3) == "ods") or 
		(substr($_FILES['excel']['name'], -3) == "xls") or (substr($_FILES['excel']['name'], -4) == "xlsx") ) {
		include_once 'produccion/upload_2.inc.php';
	}
	Conexion::cerrar_conexion();

} else if(isset($_POST['nombre'])) {
	Conexion::abrir_conexion();
	Alumnos::reasignacion(Conexion::obtener_conexion(), $_POST['pdf'], $_POST['id']);
	Conexion::cerrar_conexion();


} else if(isset($_POST['anonimo'])) {
	Conexion::abrir_conexion();
	Alumnos::anonimo(Conexion::obtener_conexion(), $_POST['anonimo'], $_SESSION['id_examen']);
	Conexion::cerrar_conexion();

}

$arr1 = [];
$arr2 = [];
$int1 = "";
$id = $_SESSION['id_examen'];
exec("cd media/".$id."; ls",$arr1,$int1);

Conexion::abrir_conexion();
$alumnos = Alumnos::seleccion_no_asignados(Conexion::obtener_conexion(), $_SESSION['id_examen']);


$total_pdf = count($arr1);
$total_alumnos = count($alumnos);
for($i = 0; $i < $total_pdf; $i++) {
    $pdf = "media/".$id."/".$arr1[$i];

    if( !Alumnos::seleccion_pdf(Conexion::obtener_conexion(), $_SESSION['id_examen'], $pdf) ) {
	array_push($arr2, $pdf);
    }
}

$total_final = count($arr2);


Conexion::cerrar_conexion();

$existe = true;
$i=0;
while($i < $total_final && substr($arr2[$i], -3) != "pdf") $i++; 
if($i == $total_final) $existe = false;
if($existe) $image = $arr2[$i];

?>


<div class="container">
    <div class="row">
        <div class="col-sm-10 col-md-10" style="text-align: center;">
	
	    <h3 style="text-align:left; border-bottom:2px solid #000; left: 5px; margin-bottom:50px;"> Assignar a alumne </h3>
	    <div>
		<?php if($existe){ ?>
		<?php for($c = 0; $c < $total_alumnos; $c++){ ?>
		    <form role="form" method="post" action="#" class="col-sm-3 col-md-3" >
			<button class="carpeta" type="submit" name="nombre" value="<?php echo $c ?>" style="width: 100%;"> 
			    <?php echo $alumnos[$c] -> obtener_nombre().' '.$alumnos[$c]->obtener_primer_apellido() ?> 
			    <input type="hidden" value="<?php echo $alumnos[$c] -> obtener_id() ?>" name="id" />
			    <input type="hidden" value="<?php echo $arr2[$i] ?>" name="pdf" />
			</button>
		    </form>
		    <?php } ?>
		    <form role="form" method="post" action="#" class="col-sm-3 col-md-3" >
			<button class="carpeta" type="submit" name="anonimo" value="<?php echo $arr2[$i] ?>" style="width: 100%;"> 
			    ANÒNIM
			</button>
		    </form>
		<?php } else { 
			    echo "<p style='font-size: 25px;'> Tots els exàmens han estat assignats </p>";
		} ?>
	    </div>
	</div>
    </div>
    
    <?php if($total_alumnos > 0 && $existe){ ?>
    <div class="row">
	<div class="col-sm-10 col-md-10" style="text-align: center;">
	    <div class="col-md-12 wrapper" style="height: inherit; margin-top: 50px;">
		<div style="width: 926px; height: 129px; display: inline-block; position: relative; overflow: hidden;">
		    <embed src="<?php echo $image ?>" style="pointer-events:none; width: 1174px; height: 1504px; 
			top: -100px; position: relative; overflow: hidden; display: inline-block; left: -96px;"/>
	        </div>
	    </div>
	</div>
    </div>
    <?php } ?>

</div>


<?php

} else {
    include_once 'vistas/404.php';
}

?>
