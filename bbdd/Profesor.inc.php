<?php

class Profesor {
	private $id;
	private $nombre;
	private $email;
	private $password;
	private $fecha;
	private $administrador;

	public function __construct($id, $nombre, $email, $password, $fecha, $administrador) {
		$this -> id = $id;
		$this -> nombre = $nombre;
		$this -> email = $email;
		$this -> password = $password;
		$this -> fecha = $fecha;
		$this -> administrador = $administrador;
		
	}

	public function obtener_id() {
		return $this -> id;
	}

	public function obtener_nombre() {
		return $this -> nombre;
	}

	public function obtener_email() {
		return $this -> email;
	}

	public function obtener_password() {
		return $this -> password;
	}

	public function obtener_fecha() {
		return $this -> fecha;
	}

	public function obtener_administrador() {
		return $this -> administrador;
	}

	public function cambiar_nombre($nombre) {
		$this -> nombre = $nombre;
	}

	public function cambiar_email($email) {
		$this -> email = $email;
	}

	public function cambiar_password($password) {
		$this -> password = $password;
	}

	public function cambiar_administrador($administrador) {
		$this -> administrador = $administrador;
	}
}

?>
