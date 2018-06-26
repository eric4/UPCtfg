<?php

class Nota {

	private $id_nota;
	private $ejercicio_id;
	private $valor;
	private $path;
	private $alumno_id;

	public function __construct($id_nota, $ejercicio_id, $valor, $path, $alumno_id) {
		$this -> id_nota = $id_nota;
		$this -> ejercicio_id = $ejercicio_id;
		$this -> valor = $valor;
		$this -> path = $path;
		$this -> alumno_id = $alumno_id;
	}

	public function obtener_id() {
		return $this -> id_nota;
	}

	public function obtener_ejercicio_id() {
		return $this -> ejercicio_id;
	}

	public function obtener_valor() {
		return $this -> valor;
	}

	public function obtener_path() {
		return $this -> path;
	}

	public function obtener_alumno_id() {
		return $this -> alumno_id;
	}

	public function cambiar_ejercicio_id($ejercicio_id) {
		$this -> ejercicio_id = $ejercicio_id;
	}

	public function cambiar_valor($valor) {
		$this -> valor = $valor;
	}

	public function cambiar_path($path) {
		$this -> path = $path;
	}
}

?>
