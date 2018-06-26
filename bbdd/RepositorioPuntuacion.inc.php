<?php

class RepositorioPuntuacion {

	public static function insertar_puntuacion($conexion, $puntuacion) {
		$puntuacion_insertada = false;

		if(isset($conexion)) {
			try {
				$sql = "INSERT INTO Puntuacion(valor, ejercicio_id)
					 VALUES(:valor, :ejercicio_id)";

				$sentencia = $conexion -> prepare($sql);
				
				$sentencia -> bindParam(':valor', $puntuacion -> obtener_valor(), PDO::PARAM_STR);
				$sentencia -> bindParam(':ejercicio_id', $puntuacion -> obtener_ejercicio_id(), PDO::PARAM_STR);

				$puntuacion_insertada = $sentencia -> execute();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $puntuacion_insertada;
	}

	public static function obtener_todos($conexion, $ejercicio_id) {
		$puntuaciones = array();

		if(isset($conexion)) {
			try {
				include_once 'Puntuacion.inc.php';

				$sql = "SELECT E1.id_puntuacion, E1.valor, E1.ejercicio_id FROM Puntuacion E1 INNER JOIN Ejercicios 						P1 WHERE E1.ejercicio_id = P1.id_ejercicio AND P1.id_ejercicio = :ejercicio_id";

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':ejercicio_id', $ejercicio_id, PDO::PARAM_STR);

				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				if(count($resultado)) {
					foreach($resultado as $fila) {
						$puntuaciones[] = new Puntuacion($fila['id_puntuacion'], $fila['valor'], $fila['ejercicio_id']);
					}
				} else {
					// print "No hay profesores ";
				}

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $puntuaciones;
	}

}

?>
