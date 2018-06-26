<?php

class Carpeta {
	private $id_carpeta;
	private $nombre;
	private $ejercicio_id;
	private $path;
	private $valor;
	private $comentario;
	private $carpeta_id;

	public function __construct($id_carpeta, $nombre, $ejercicio_id, $path, $valor, $comentario, $carpeta_id) {
		$this -> id_carpeta = $id_carpeta;
		$this -> nombre = $nombre;
		$this -> ejercicio_id = $ejercicio_id;
		$this -> path = $path;
		$this -> valor = $valor;
		$this -> comentario = $comentario;
		$this -> carpeta_id = $carpeta_id;
	}

	public function obtener_id() {
		return $this -> id_carpeta;
	}

	public function obtener_nombre() {
		return $this -> nombre;
	}

	public function obtener_ejercicio_id() {
		return $this -> ejercicio_id;
	}

	public function obtener_path() {
		return $this -> path;
	}

	public function obtener_valor() {
		return $this -> valor;
	}

	public function obtener_comentario() {
		return $this -> comentario;
	}

	public function obtener_carpeta_id() {
		return $this -> carpeta_id;
	}
}

?>
