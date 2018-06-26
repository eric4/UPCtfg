<?php

include_once 'bbdd/RepositorioProfesor.inc.php';

class Profesores {

	public static function seleccion_total(){
	    return RepositorioProfesor::obtener_todos(Conexion::obtener_conexion());
	}

	public static function insercion_profesor($conexion, $profesor){
	    return RepositorioProfesor::insertar_profesor($conexion, $profesor);
	}

	public static function modificacion_password($conexion, $password, $id_profesor){
	    return RepositorioProfesor::modificar_password($conexion, $password, $id_profesor);
	}	
	
}

?>
