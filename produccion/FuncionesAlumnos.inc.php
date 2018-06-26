<?php

include_once 'bbdd/RepositorioAlumno.inc.php';

class Alumnos {

	public static function seleccion_total($conexion, $id_examen){
	    return RepositorioAlumno::obtener_todos($conexion, $id_examen);
	}

	public static function seleccion_no_asignados($conexion, $id_examen){
	    return RepositorioAlumno::obtener_no_assignados($conexion, $id_examen, '-');
	}

	public static function insercion_alumno($conexion, $alumno){
	    return RepositorioAlumno::insertar_alumno($conexion, $alumno);
	}

	public static function seleccion_alumno($conexion, $id_alumno){
	    return RepositorioAlumno::obtener_alumno($conexion, $id_alumno);
	}

	public static function seleccion_pdf($conexion, $id_examen, $pdf){
	    return RepositorioAlumno::obtener_pdf($conexion, $id_examen, $pdf);
	}

	public static function seleccion_primer_pdf($conexion, $id_examen){
	    return RepositorioAlumno::obtener_primer_pdf($conexion, $id_examen);
	}

	public static function reasignacion($conexion, $pdf, $id_examen){
	    return RepositorioAlumno::reasignar_alumno($conexion, $pdf, $id_examen);
	}

	public static function anonimo($conexion, $pdf, $id_examen){
	    return RepositorioAlumno::insertar_anonimo($conexion, $pdf, $id_examen);
	}

}
