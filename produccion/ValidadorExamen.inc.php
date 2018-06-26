<?php


class ValidadorExamen {

	private $aviso_inicio;
	private $aviso_cierre;
	
	private $nombre;
	private $directorio;

	private $error_nombre;


	public function __construct($nombre, $directorio, $conexion) {
		$this -> aviso_inicio = "<br><div class='col-sm-12 col-md-12 alert alert-danger' role='alert'>";
		$this -> aviso_cierre = "</div>";

		$this -> nombre = $nombre;
		$this -> directorio = $directorio;
		$this -> error_nombre = $this -> validar_nombre($conexion, $directorio, $nombre);
	}

	private function variable_iniciada($variable) {
		if(isset($variable) && !empty($variable)) {
			return true;
		} else {
			return false;
		}
	}

	private function validar_nombre($conexion, $directorio, $nombre) {
		if(!$this -> variable_iniciada($nombre)) {
			return "Has d'escriure un nom d'examen" ;
		} else {
			$this -> nombre = $nombre;
		}
		if(RepositorioExamen::nombre_existe($conexion, $directorio, $nombre)) {
			return "El nom de l'examen ja existeix";
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

	public function mostrar_exito_nombre() {
		if($this -> error_nombre === "") {
		    echo "<br><div class='col-sm-12 col-md-12 alert alert-success' role='alert' style='text-align: center'>Nom emmagatzemat correctament</div>";
		}
	}

	public function examen_valido() {
		if($this -> error_nombre === "") {
			return true;
		} else {
			return false;
		}
	}
}


?>
