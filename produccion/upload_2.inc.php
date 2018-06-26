<?php
include_once 'Classes/PHPExcel/IOFactory.php';
include_once 'bbdd/RepositorioAlumno.inc.php';

$path = "media/";
opendir($path);
$path = $path . $_SESSION['id_examen'] . "/";
opendir($path);
$nombreArchivo = $path.$_FILES['excel']['name'];

copy($_FILES['excel']['tmp_name'], $nombreArchivo);

Conexion::abrir_conexion();

$objeto = PHPEXCEL_IOFactory::load($nombreArchivo);
$rows = $objeto->setActiveSheetIndex(0)->getHighestRow();

for($i=2; $i<=$rows; $i++){
	/*$nombre = $objeto->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
	$apellido1 = $objeto->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
	$apellido2 = $objeto->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
	$examen_cara_A = $objeto->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
	$examen_cara_B = $objeto->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
	$nota_final = $objeto->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();*/

	$apellido = $objeto->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
	$nombre = $objeto->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
	$dni = $objeto->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
	$passaporte = $objeto->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
	$examen = $objeto->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
	if(!isset($examen)) $examen = '-';
	else $examen = "media/".$_SESSION['id_examen']."/".$examen.".pdf";

	$alumno = new Alumno('', $nombre, $apellido, $dni, $examen, $passaporte, '0', $_SESSION['id_examen']);
	$alumnos = RepositorioAlumno::insertar_alumno(Conexion::obtener_conexion(), $alumno);
}
Conexion::cerrar_conexion();



?>
