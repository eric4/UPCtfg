<?php

include_once 'bbdd/RepositorioCarpeta.inc.php';

class Carpetas {

	public static function insercion_carpeta($conexion, $carpeta){
	    return RepositorioCarpeta::insertar_carpeta($conexion, $carpeta);
	}

	public static function obtencion_subcarpetas($conexion, $id_ejercicio, $carpeta_id){
	    return RepositorioCarpeta::obtener_subcarpetas($conexion, $id_ejercicio, $carpeta_id);
	}

	public static function seleccion_total($conexion, $id_ejercicio){
	    return RepositorioCarpeta::obtener_carpetas($conexion, $id_ejercicio);
	}

	public static function seleccion_valor($conexion, $id_ejercicio, $path_calculo) {
	    return RepositorioCarpeta::obtener_valor($conexion, $id_ejercicio, $path_calculo);
	}

	public static function seleccion_id($conexion, $id_carpeta) {
	    return RepositorioCarpeta::obtener_id_carpeta($conexion, $id_carpeta);
	}

	public static function seleccion_id_carpeta($conexion, $id_ejercicio, $path) {
	    return RepositorioCarpeta::seleccionar_id_carpeta($conexion, $id_ejercicio, $path);
	}

	public static function seleccion_nombre($conexion, $id_carpeta) {
	    return RepositorioCarpeta::obtener_nombre($conexion, $id_carpeta);
	}

	public static function seleccion_path($conexion, $id_carpeta) {
	    return RepositorioCarpeta::obtener_path($conexion, $id_carpeta);
	}

	public static function seleccion_comentario($conexion, $id_carpeta) {
	    return RepositorioCarpeta::obtener_comentario($conexion, $id_carpeta);
	}

	public static function seleccion_puntuacion($conexion, $id_carpeta) {
	    return RepositorioCarpeta::obtener_puntuacion($conexion, $id_carpeta);
	}

	public static function actualizacion_puntuacion($conexion, $valor, $id_carpeta) {
	    return RepositorioCarpeta::actualizar_puntuacion($conexion, $valor, $id_carpeta);
	}

	public static function actualizacion_comentario($conexion, $comentario, $id_carpeta) {
	    return RepositorioCarpeta::actualizar_comentario($conexion, $comentario, $id_carpeta);
	}

}

?>
