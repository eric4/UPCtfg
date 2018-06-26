<?php

include_once 'bbdd/Conexion.inc.php';

class Conexiones {

	public static function apertura(){
	    return Conexion::abrir_conexion();
	}

	public static function cierre(){
	    return Conexion::cerrar_conexion();
	}

	public static function obtencion(){
	    return Conexion::obtener_conexion();
	}
	
	public static function inicio($id, $nombre, $email, $password, $admin){
	    return ControlSesion::iniciar_sesion($id, $nombre, $email, $password, $admin);
	}

}

?>
