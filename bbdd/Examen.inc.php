<?php

class Examen {
	private $id_examen;
	private $nombre;
	private $fecha;
	private $directorio_id;

	public function __construct($id, $nombre, $fecha, $directorio_id) {
		$this -> id_examen = $id;
		$this -> nombre = $nombre;
		$this -> fecha = $fecha;
		$this -> directorio_id = $directorio_id;
	}

	public function obtener_id() {
		return $this -> id_examen;
	}

	public function obtener_nombre() {
		return $this -> nombre;
	}

	public function obtener_fecha() {
		return $this -> fecha;
	}

	public function obtener_directorio_id() {
		return $this -> directorio_id;
	}

	public function cambiar_nombre($nombre) {
		$this -> nombre = $nombre;
	}

	public function cambiar_fecha($fecha) {
		$this -> fecha = $fecha;
	}

	public function cambiar_directorio_id($directorio_id) {
		$this -> directorio_id = $directorio_id;
	}

}

?>
