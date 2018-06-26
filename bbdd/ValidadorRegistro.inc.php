<?php


class ValidadorRegistro {

	private $aviso_inicio;
	private $aviso_cierre;
	
	private $nombre;
	private $email;
	private $clave;
	private $administrador;

	private $error_nombre;
	private $error_email;
	private $error_clave1;
	private $error_clave2;


	public function __construct($nombre, $email, $clave1, $clave2, $administrador, $conexion) {
		$this -> aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
		$this -> aviso_cierre = "</div>";

		$this -> nombre = $nombre;
		$this -> email = $email;
		$this -> clave = $clave1;

		$this -> administrador = $this -> validar_administrador($administrador); 
		$this -> error_nombre = $this -> validar_nombre($conexion, $nombre);
		$this -> error_email = $this -> validar_email($conexion, $email);
		$this -> error_clave1 = $this -> validar_clave1($clave1);
		$this -> error_clave2 = $this -> validar_clave2($clave1, $clave2);

		if($this -> error_clave1 === "" && $this -> error_clave2 === "") {
			$this -> clave = $clave1;
		}
	}

	private function variable_iniciada($variable) {
		if(isset($variable) && !empty($variable)) {
			return true;
		} else {
			return false;
		}
	}

	private function validar_nombre($conexion, $nombre) {
		if(!$this -> variable_iniciada($nombre)) {
			return "Debes escribir un nombre de profesor" ;
		} else {
			$this -> nombre = $nombre;
		}
		if(strlen($nombre) < 6) {
			return "El nombre debe tener mas de 6 caracteres.";
		}
		if(strlen($nombre) > 24) {
			return "El nombre debe tener menos de 24 caracteres.";
		}
		if(RepositorioProfesor::nombre_existe($conexion, $nombre)) {
			return "Nombre en uso.";
		}
		return "";
	}

	private function validar_email($conexion, $email) {
		if(!$this -> variable_iniciada($email)) {
			return "Debes escribir un email" ;
		} else {
			$this -> email = $email;
		}
		if(RepositorioProfesor::email_existe($conexion, $email)) {
			return "Email en uso. <a href='#'>Recuperar Contraseña</a>";
		}
		return "";
	}

	private function validar_clave1($clave1) {
		if(!$this -> variable_iniciada($clave1)) {
			return "Debes escribir una contrasena" ;
		}
		return "";
	}

	private function validar_clave2($clave1, $clave2) {
		if(!$this -> variable_iniciada($clave2)) {
			return "Primero rellena la contrasena" ;
		}
		if(!$this -> variable_iniciada($clave2)) {
			return "Debes repetir el email" ;
		}
		if($clave1 !== $clave2) {
			return "Ambas contrasenas deben coincidir";
		}
		return "";
	}

	private function validar_administrador($administrador) {
		if($administrador) {
			return 1;
		} else {
			return 0;
		}
	}
	
	public function obtener_nombre() {
		return $this -> nombre;
	}

	public function obtener_email() {
		return $this -> email;
	}

	public function obtener_clave() {
		return $this -> clave;
	}

	public function obtener_administrador() {
		return $this -> administrador;
	}

	public function obtener_error_nombre() {
		return $this -> error_nombre;
	}

	public function obtener_error_email() {
		return $this -> error_email;
	}

	public function obtener_error_clave1() {
		return $this -> error_clave1;
	}

	public function obtener_error_clave2() {
		return $this -> error_clave2;
	}

	public function mostrar_error_nombre() {
		if($this -> error_nombre !== "") {
			echo $this -> aviso_inicio . $this -> error_nombre . $this -> aviso_cierre;
		}
	}

	public function mostrar_error_email() {
		if($this -> error_email !== "") {
			echo $this -> aviso_inicio . $this -> error_email . $this -> aviso_cierre;
		}
	}

	public function mostrar_error_clave1() {
		if($this -> error_clave1 !== "") {
			echo $this -> aviso_inicio . $this -> error_clave1 . $this -> aviso_cierre;
		}
	}

	public function mostrar_error_clave2() {
		if($this -> error_clave2 !== "") {
			echo $this -> aviso_inicio . $this -> error_clave2 . $this -> aviso_cierre;
		}
	}

	public function registro_valido() {
		if($this -> error_nombre === "" && $this -> error_email === "" && 
				$this -> error_clave1 === "" && $this -> error_clave2 === "") {
			return true;
		} else {
			return false;
		}
	}
}


?>
