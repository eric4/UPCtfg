<?php

class ControlSesion {
	
	public static function iniciar_sesion($id, $nombre, $email, $password, $administrador) {
		if(session_id() == '') {
			session_start();
		}

		$_SESSION['id_profesor'] = $id;
		$_SESSION['nombre_profesor'] = $nombre;
		$_SESSION['email_profesor'] = $email;
		$_SESSION['password_profesor'] = $password;
		$_SESSION['administrador_profesor'] = $administrador;
	}

	public static function cerrar_sesion() {
		if(session_id() == '') {
			session_start();
		}
		
		if(isset($_SESSION['id_profesor'])) {
			unset($_SESSION['id_profesor']);
		}
		if(isset($_SESSION['nombre_profesor'])) {
			unset($_SESSION['nombre_profesor']);
		}
		session_destroy();
	}

	public static function sesion_iniciada() {
		if(session_id() == '') {
			session_start();
		}
		if(isset($_SESSION['id_profesor']) && isset($_SESSION['nombre_profesor'])) {
			return true;
		} else {
			return false;
		}
	}
	
}

?>
