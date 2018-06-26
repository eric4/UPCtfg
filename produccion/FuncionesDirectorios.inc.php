<?php

include_once 'bbdd/RepositorioDirectorio.inc.php';

class Directorios {

	public static function seleccion_total($conexion, $id_profesor){
	    return RepositorioDirectorio::obtener_todos($conexion, $id_profesor);
	}

	public static function seleccionar_directorio($conexion, $id_directorio){
	    return RepositorioDirectorio::obtener_directorio($conexion, $id_directorio);
	}
}

?>
