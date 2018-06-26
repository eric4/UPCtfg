<?php

include_once 'RepositorioProfesor.inc.php';

class ValidadorLogin {

	private $profesor;
	private $error;

	public function __construct($email, $clave, $conexion) {
		$this -> error = "";

		if(!$this -> variable_iniciada($email) || !$this -> variable_iniciada($clave)) {
			$this -> profesor = null;
			$this -> error = "Has d'introduir el teu e-mail i contrasenya.";
		} else {
			$this -> profesor = RepositorioProfesor::obtener_profesor_por_email($conexion, $email);
			if(is_null($this -> profesor) || !password_verify($clave, $this -> profesor -> obtener_password())) {
				$this -> error = "Dades incorrectes.";
			} else {	

			}
		}		
	}

	private function variable_iniciada($variable) {
		if(isset($variable) && !empty($variable)) {
			return true;
		} else {
			return false;
		}
	}

	public function obtener_profesor() {
		return $this -> profesor;
	}

	public function obtener_error() {
		return $this -> error;
	}

	public function mostrar_error() {
		if($this -> error !== '') {
			echo "<br><div class='col-sm-12 col-md-12 alert alert-danger' role='alert'>";
			echo $this -> error;
			echo "</div><br>";
		}
	}
}

?>
