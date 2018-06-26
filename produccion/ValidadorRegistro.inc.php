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
		$this -> aviso_inicio = "<br><div class='col-sm-12 col-md-12 alert alert-danger' role='alert'>";
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
			return "Has d'escriure un nom de professor." ;
		} else {
			$this -> nombre = $nombre;
		}
		if(strlen($nombre) < 6) {
			return "El nom ha de tenir més de 6 caràcters.";
		}
		if(strlen($nombre) > 24) {
			return "El nom ha de tenir menys de 24 caràcters.";
		}
		if(RepositorioProfesor::nombre_existe($conexion, $nombre)) {
			return "Nom en ús.";
		}
		return "";
	}

	private function validar_email($conexion, $email) {
		if(!$this -> variable_iniciada($email)) {
			return "Has de repetir el e-mail." ;
		} else {
			$this -> email = $email;
		}
		if(RepositorioProfesor::email_existe($conexion, $email)) {
			return "E-mail en ús.";
		}
		return "";
	}

	private function validar_clave1($clave1) {
		if(!$this -> variable_iniciada($clave1)) {
			return "Has d'escriure una contrasenya." ;
		}
		return "";
	}

	private function validar_clave2($clave1, $clave2) {
		if(!$this -> variable_iniciada($clave2)) {
			return "Primer omple la contrasenya." ;
		}
		if(!$this -> variable_iniciada($clave2)) {
			return "Has de repetir el e-mail." ;
		}
		if($clave1 !== $clave2) {
			return "Totes dues contrasenyes han de coïncidir.";
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
