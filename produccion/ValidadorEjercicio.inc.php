<?php


class ValidadorEjercicio {

	private $aviso_inicio;
	private $aviso_cierre;
	
	private $nombre;
	private $examen;

	private $error_nombre;


	public function __construct($nombre, $examen, $conexion) {
		$this -> aviso_inicio = "<br><div class='col-sm-12 col-md-12 alert alert-danger' role='alert'>";
		$this -> aviso_cierre = "</div>";

		$this -> nombre = $nombre;
		$this -> examen = $examen;
		$this -> error_nombre = $this -> validar_nombre($conexion, $examen, $nombre);
	}

	private function variable_iniciada($variable) {
		if(isset($variable) && !empty($variable)) {
			return true;
		} else {
			return false;
		}
	}

	private function validar_nombre($conexion, $examen, $nombre) {
		if(!$this -> variable_iniciada($nombre)) {
			return "Has d'escriure un nom d'exercici" ;
		} else {
			$this -> nombre = $nombre;
		}
		if(RepositorioEjercicio::nombre_existe($conexion, $examen, $nombre)) {
			return "El nom de l'exercici ja existeix";
		}
		return "";
	}
	
	public function obtener_nombre() {
		return $this -> nombre;
	}

	public function obtener_error_nombre() {
		return $this -> error_nombre;
	}

	public function mostrar_error_nombre() {
		if($this -> error_nombre !== "") {
			echo $this -> aviso_inicio . $this -> error_nombre . $this -> aviso_cierre;
		}
	}

	public function ejercicio_valido() {
		if($this -> error_nombre === "") {
			return true;
		} else {
			return false;
		}
	}
}


?>
