<?php

class Puntuacion {
	private $id_puntuacion;
	private $valor;
	private $ejercicio_id;

	public function __construct($id_puntuacion, $valor, $ejercicio_id) {
		$this -> id_puntuacion = $id_puntuacion;
		$this -> valor = $valor;
		$this -> ejercicio_id = $ejercicio_id;
	}

	public function obtener_id() {
		return $this -> id_ejercicio;
	}

	public function obtener_valor() {
		return $this -> valor;
	}

	public function obtener_ejercicio_id() {
		return $this -> ejercicio_id;
	}

	public function cambiar_valor($valor) {
		$this -> valor = $valor;
	}

	public function cambiar_ejercicio_id($ejercicio_id) {
		$this -> ejercicio_id = $ejercicio_id;
	}
}

?>
