<?php

include_once 'bbdd/config.inc.php';
include_once 'bbdd/Redireccion.inc.php';

class Redirecciones {

	public static function home(){
	    return Redireccion::redirigir(RUTA_HOME);
	}	

	public static function presentacion(){
	    return Redireccion::redirigir(SERVIDOR);
	}

	public static function registro_correcto(){
	    return Redireccion::redirigir(RUTA_REGISTRO_CORRECTO);
	}

	public static function cambio_password_correcto(){
	    return Redireccion::redirigir(RUTA_PASSWORD_CORRECTO);
	}

	public static function ejercicio_nuevo_correcto(){
	    return Redireccion::redirigir(RUTA_EXERCICIS);
	}

}

?>
