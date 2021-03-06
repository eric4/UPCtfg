<?php

include_once 'bbdd/RepositorioEjercicio.inc.php';

class Ejercicios {

	public static function seleccion_total($conexion, $id_examen){
	    return RepositorioEjercicio::obtener_todos($conexion, $id_examen);
	}

	public static function insercion_ejercicio($conexion, $ejercicio){
	    return RepositorioEjercicio::insertar_ejercicio($conexion, $ejercicio);
	}

	public static function seleccion_ejercicio($conexion, $nombre, $x, $y, $w, $h, $plana, $id_examen){
	    return RepositorioEjercicio::seleccionar_ejercicio($conexion, $nombre, $x, $y, $w, $h, $plana, $id_examen);
	}

	public static function seleccion_ejercicio_por_id($conexion, $id_ejercicio){
	    return RepositorioEjercicio::ejercicio_por_id($conexion, $id_ejercicio);
	}

	public static function total_paginas($filename, $dir = false){
	    require_once("pdf/fpdf/fpdf.php");
	    require_once("pdf/fpdi/src/autoload.php");
	    require_once("pdf/fpdi/src/Fpdi.php");

	    $pdfi = new setasign\Fpdi\Fpdi();

	    $dir = $dir ? $dir : './';
	    $pagecount = $pdfi -> setSourceFile($filename);
	    return $pagecount;
	}

}

?>
