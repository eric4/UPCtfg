<?php


class ValidadorDirectorio {

	private $aviso_inicio;
	private $aviso_cierre;
	
	private $nombre;
	private $inicio;
	private $fin;
	private $cuatrimestre;

	private $error_nombre;


	public function __construct($nombre, $inicio, $fin, $cuatrimestre, $conexion) {
		$this -> aviso_inicio = "<br><div class='col-sm-12 col-md-12 alert alert-danger' role='alert'>";
		$this -> aviso_cierre = "</div>";

		$this -> nombre = $nombre;
		$this -> inicio = $inicio;
		$this -> fin = $fin;
		$this -> cuatrimestre = $cuatrimestre;
		$this -> error_nombre = $this -> validar_asignatura($conexion, $nombre, $inicio, $fin, $cuatrimestre);
	}

	private function validar_asignatura($conexion, $nombre, $inicio, $fin, $cuatrimestre) {

		if(RepositorioDirectorio::asignatura_existe($conexion, $nombre, $inicio, $fin, $cuatrimestre)) {
			return "Nom en ús.";
		}
		return $nombre;
	}
	
	public function obtener_nombre() {
		return $this -> nombre;
	}

	public function obtener_inicio() {
		return $this -> inicio;
	}

	public function obtener_fin() {
		return $this -> fin;
	}

	public function obtener_cuatrimestre() {
		return $this -> cuatrimestre;
	}

	public function mostrar_error_nombre() {
		if($this -> error_nombre !== "") {
			echo $this -> aviso_inicio . $this -> error_nombre . $this -> aviso_cierre;
		}
	}

	public function registro_valido() {
		if($this -> error_nombre === $this->nombre) {
			return true;
		} else {
			return false;
		}
	}
}


?>
