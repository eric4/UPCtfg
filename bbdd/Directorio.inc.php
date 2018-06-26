<?php

class Directorio {
	private $id_directorio;
	private $nombre;
	private $inicio;
	private $fin;
	private $cuatrimestre;
	private $fecha;
	private $profesor_id;

	public function __construct($id, $nombre, $inicio, $fin, $cuatrimestre, $fecha, $profesor_id) {
		$this -> id_directorio = $id;
		$this -> nombre = $nombre;
		$this -> inicio = $inicio;
		$this -> fin = $fin;
		$this -> cuatrimestre = $cuatrimestre;
		$this -> fecha = $fecha;
		$this -> profesor_id = $profesor_id;
	}

	public function obtener_id() {
		return $this -> id_directorio;
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

	public function obtener_fecha() {
		return $this -> fecha;
	}

	public function obtener_profesor_id() {
		return $this -> profesor_id;
	}

	public function cambiar_nombre($nombre) {
		$this -> nombre = $nombre;
	}

	public function cambiar_inicio($inicio) {
		$this -> inicio = $inicio;
	}

	public function cambiar_fin($fin) {
		$this -> fin = $fin;
	}

	public function cambiar_cuatrimestre($cuatrimestre) {
		$this -> cuatrimestre = $cuatrimestre;
	}

	public function cambiar_fecha($fecha) {
		$this -> fecha = $fecha;
	}

	public function cambiar_profesor_id($profesor_id) {
		$this -> profesor_id = $profesor_id;
	}

}

?>
