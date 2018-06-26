<?php

class Ejercicio {
	private $id_exercici;
	private $nombre;
	private $x;
	private $y;
	private $w;
	private $h;
	private $plana;
	private $examen_id;

	public function __construct($id, $nombre, $x, $y, $w, $h, $plana, $examen_id) {
		$this -> id_exercici = $id;
		$this -> nombre = $nombre;
		$this -> x = $x;
		$this -> y = $y;
		$this -> w = $w;
		$this -> h = $h;
		$this -> plana = $plana;
		$this -> examen_id = $examen_id;
	}

	public function obtener_id() {
		return $this -> id_exercici;
	}

	public function obtener_nombre() {
		return $this -> nombre;
	}

	public function obtener_x() {
		return $this -> x;
	}

	public function obtener_y() {
		return $this -> y;
	}

	public function obtener_w() {
		return $this -> w;
	}

	public function obtener_plana() {
		return $this -> plana;
	}

	public function obtener_h() {
		return $this -> h;
	}

	public function obtener_examen_id() {
		return $this -> examen_id;
	}

	public function cambiar_nombre($nombre) {
		$this -> nombre = $nombre;
	}

	public function cambiar_x($x) {
		$this -> x = $x;
	}

	public function cambiar_y($y) {
		$this -> y = $y;
	}

	public function cambiar_w($w) {
		$this -> w = $w;
	}

	public function cambiar_h($h) {
		$this -> h = $h;
	}

	public function cambiar_plana($plana) {
		$this -> plana = $plana;
	}

	public function cambiar_examen_id($examen_id) {
		$this -> examen_id = $examen_id;
	}

}

?>
