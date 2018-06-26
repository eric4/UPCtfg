<?php

class Alumno {
	private $id_alumno;
	private $nombre;
	private $primer_apellido;
	private $segundo_apellido;
	private $examen_cara_A;
	private $examen_cara_B;
	private $nota_final;
	private $examen_id;

	public function __construct($id, $nombre, $apellido1, $apellido2, $caraA, $caraB, $notaFinal, $id_examen) {
		$this -> id_alumno = $id;
		$this -> nombre = $nombre;
		$this -> primer_apellido = $apellido1;
		$this -> segundo_apellido = $apellido2;
		$this -> examen_cara_A = $caraA;
		$this -> examen_cara_B = $caraB;
		$this -> nota_final = $notaFinal;
		$this -> examen_id = $id_examen;
	}

	public function obtener_id() {
		return $this -> id_alumno;
	}

	public function obtener_nombre() {
		return $this -> nombre;
	}

	public function obtener_primer_apellido() {
		return $this -> primer_apellido;
	}

	public function obtener_segundo_apellido() {
		return $this -> segundo_apellido;
	}

	public function obtener_examen_cara_A() {
		return $this -> examen_cara_A;
	}

	public function obtener_examen_cara_B() {
		return $this -> examen_cara_B;
	}

	public function obtener_nota_final() {
		return $this -> nota_final;
	}

	public function obtener_examen_id() {
		return $this -> examen_id;
	}



	public function cambiar_nombre($nombre) {
		$this -> nombre = $nombre;
	}

	public function cambiar_primer_apellido($apellido1) {
		$this -> primer_apellido = $apellido1;
	}

	public function cambiar_segundo_apellido($apellido2) {
		$this -> segundo_apellido = $apellido2;
	}

	public function cambiar_foto_examen($fotoEx) {
		$this -> foto_examen = $fotoEx;
	}

	public function cambiar_nota_final($notaFinal) {
		$this -> nota_final = $notaFinal;
	}

	public function cambiar_examen_id($id_examen) {
		$this -> examen_id = $id_examen;
	}

}

?>
