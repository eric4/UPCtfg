<?php

include_once 'bbdd/RepositorioNota.inc.php';

class Notas {

	public static function insercion_path($conexion, $path, $id_ejercicio, $id_alumno) { 
	    return RepositorioNota::insertar_path($conexion,$path,$id_ejercicio, $id_alumno);
	}

	public static function actualizacion_valor($conexion, $valor, $id_ejercicio, $path) {
	    return RepositorioNota::actualizar_valor($conexion, $valor, $id_ejercicio, $path);
	}

	public static function actualizacion_path($conexion, $path, $id_ejercicio, $id_alumno) {
	    return RepositorioNota::actualizar_path($conexion, $path, $id_ejercicio, $id_alumno);
	}

	public static function existe_nota($conexion, $id_ejercicio, $id_alumno) {
	    return RepositorioNota::tiene_nota($conexion, $id_ejercicio, $id_alumno);
	}

	public static function seleccion_total($conexion, $id_ejercicio, $path) {
	    return RepositorioNota::seleccion_alumnos_carpeta($conexion, $id_ejercicio, $path);
	}

	public static function seleccion_path($conexion, $id_ejercicio, $id_alumno) {
	    return RepositorioNota::obtener_path($conexion, $id_ejercicio, $id_alumno);
	}

	public static function delete($conexion, $id_ejercicio, $id_alumno) {
	    return RepositorioNota::borrar_nota($conexion, $id_ejercicio, $id_alumno);
	}

}

?>
