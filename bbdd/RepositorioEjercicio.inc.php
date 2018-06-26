<?php

class RepositorioEjercicio {

	public static function insertar_ejercicio($conexion, $ejercicio) {
		$ejercicio_insertado = false;

		if(isset($conexion)) {
			try {
				$sql = "INSERT INTO Ejercicios(nombre, x, y, w, h, plana, examen_id)
					 VALUES(:nombre, :x, :y, :w, :h, :plana, :examen_id)";

				$sentencia = $conexion -> prepare($sql);
				
				$sentencia -> bindParam(':nombre', $ejercicio -> obtener_nombre(), PDO::PARAM_STR);
				$sentencia -> bindParam(':x', $ejercicio -> obtener_x(), PDO::PARAM_STR);
				$sentencia -> bindParam(':y', $ejercicio -> obtener_y(), PDO::PARAM_STR);
				$sentencia -> bindParam(':w', $ejercicio -> obtener_w(), PDO::PARAM_STR);
				$sentencia -> bindParam(':h', $ejercicio -> obtener_h(), PDO::PARAM_STR);
				$sentencia -> bindParam(':plana', $ejercicio -> obtener_plana(), PDO::PARAM_STR);
				$sentencia -> bindParam(':examen_id', $ejercicio -> obtener_examen_id(), PDO::PARAM_STR);

				$ejercicio_insertado = $sentencia -> execute();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $ejercicio_insertado;
	}

	public static function seleccionar_ejercicio($conexion, $nombre, $x, $y, $w, $h, $plana, $examen_id) {
		$ejercicio_seleccionado = '';

		if(isset($conexion)) {
			try {

				$sql = "SELECT id_ejercicio from Ejercicios
					 WHERE nombre = :nombre AND x = :x AND y = :y AND w = :w AND h = :h AND 
						plana = :plana AND examen_id = :examen_id";

				$sentencia = $conexion -> prepare($sql);
				
				$sentencia -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
				$sentencia -> bindParam(':x', $x, PDO::PARAM_STR);
				$sentencia -> bindParam(':y', $y, PDO::PARAM_STR);
				$sentencia -> bindParam(':w', $w, PDO::PARAM_STR);
				$sentencia -> bindParam(':h', $h, PDO::PARAM_STR);
				$sentencia -> bindParam(':plana', $plana, PDO::PARAM_STR);
				$sentencia -> bindParam(':examen_id', $examen_id, PDO::PARAM_STR);

				$ejercicio_seleccionado = $sentencia -> execute();
				$resultado = $sentencia -> fetchColumn();
			
			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $resultado;
	}

	public static function ejercicio_por_id($conexion, $id_ejercicio) {
		$ejercicio = '';

		if(isset($conexion)) {
			try {
				include_once 'Ejercicio.inc.php';

				$sql = "SELECT id_ejercicio, nombre, x, y, w, h, plana, examen_id from Ejercicios WHERE id_ejercicio = :id_ejercicio"; 

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':id_ejercicio', $id_ejercicio, PDO::PARAM_STR);

				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				if(count($resultado)) {
					foreach($resultado as $fila) {
						$ejercicios = new Ejercicio($fila['id_ejercicio'], $fila['nombre'], $fila['x'], $fila['y'], 
								$fila['w'], $fila['h'], $fila['plana'], $fila['examen_id']);
					}
				} else {
					// print "No hay profesores ";
				}

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $ejercicios;
	}

	public static function nombre_existe($conexion, $examen, $nombre) {
		$nombre_existe = true;

		if(isset($conexion)) {
			try {
				$sql = "SELECT * FROM Ejercicios WHERE examen_id = :examen AND nombre = :nombre";

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':examen', $examen, PDO::PARAM_STR);				
				$sentencia -> bindParam(':nombre', $nombre, PDO::PARAM_STR);

				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				if(count($resultado) > 0){
					$nombre_existe = true;
				} else {
					$nombre_existe = false;
				}
			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $nombre_existe;
	}

	public static function obtener_todos($conexion, $examen_id) {
		$ejercicios = array();

		if(isset($conexion)) {
			try {
				include_once 'Ejercicio.inc.php';

				$sql = "SELECT E1.id_ejercicio, E1.nombre, E1.x, E1.y, E1.w, E1.h, E1.plana, E1.examen_id FROM Ejercicios E1 INNER JOIN Examenes 						P1 WHERE E1.examen_id = P1.id_examen AND P1.id_examen = :examen_id";

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':examen_id', $examen_id, PDO::PARAM_STR);

				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				if(count($resultado)) {
					foreach($resultado as $fila) {
						$ejercicios[] = new Ejercicio($fila['id_ejercicio'], $fila['nombre'], $fila['x'], $fila['y'], 
								$fila['w'], $fila['h'], $fila['plana'], $fila['examen_id']);
					}
				} else {
					// print "No hay profesores ";
				}

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $ejercicios;
	}

}

?>
