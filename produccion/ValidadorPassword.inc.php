<?php


class ValidadorPassword {

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


	public function __construct($clave1, $clave2, $conexion) {
		$this -> aviso_inicio = "<br><div class='col-sm-12 col-md-12 alert alert-danger' role='alert'>";
		$this -> aviso_cierre = "</div>";

		$this -> clave = $clave1;
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

	public function obtener_clave() {
		return $this -> clave;
	}

	public function obtener_error_clave1() {
		return $this -> error_clave1;
	}

	public function obtener_error_clave2() {
		return $this -> error_clave2;
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
		if($this -> error_clave1 === "" && $this -> error_clave2 === "") {
			return true;
		} else {
			return false;
		}
	}
}


?>
