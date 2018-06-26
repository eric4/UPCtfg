<?php

class RepositorioNota {

	public static function tiene_nota($conexion, $ejercicio_id, $alumno_id){
		$existe = 0;

		if(isset($conexion)) {
			try {
				$sql = "SELECT * FROM Notas WHERE ejercicio_id = :ejercicio_id AND alumno_id = :alumno_id";

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':ejercicio_id', $ejercicio_id, PDO::PARAM_STR);
				$sentencia -> bindParam(':alumno_id', $alumno_id, PDO::PARAM_STR);

				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				foreach($resultado as $fila) {
					$existe = $existe + 1;
				}

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $existe;
	}

	public static function insertar_path($conexion, $path, $ejercicio_id, $alumno_id){
		$path_insertado = false;

		if(isset($conexion)) {
			try {
				$sql = "INSERT INTO Notas(ejercicio_id, path, alumno_id)
					 VALUES(:ejercicio_id, :path, :alumno_id)";

				$sentencia = $conexion -> prepare($sql);
				
				$sentencia -> bindParam(':ejercicio_id', $ejercicio_id, PDO::PARAM_STR);
				$sentencia -> bindParam(':path', $path, PDO::PARAM_STR);
				$sentencia -> bindParam(':alumno_id', $alumno_id, PDO::PARAM_STR);

				$path_insertado = $sentencia -> execute();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $path_insertado;
	}

	public static function obtener_path($conexion, $ejercicio_id, $alumno_id){
		$path_obtenido = false;

		if(isset($conexion)) {
			try {
				$sql = "SELECT path FROM Notas WHERE ejercicio_id = :ejercicio_id AND alumno_id = :alumno_id";

				$sentencia = $conexion -> prepare($sql);
				
				$sentencia -> bindParam(':ejercicio_id', $ejercicio_id, PDO::PARAM_STR);
				$sentencia -> bindParam(':alumno_id', $alumno_id, PDO::PARAM_STR);

				$path_obtenido = $sentencia -> execute();
				$resultado = $sentencia -> fetchColumn();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $resultado;
	}

	public static function seleccionar_nota($conexion, $ejercicio_id, $alumno_id){
		$path_obtenido = false;

		if(isset($conexion)) {
			try {
				$sql = "SELECT valor FROM Notas WHERE ejercicio_id = :ejercicio_id AND alumno_id = :alumno_id";

				$sentencia = $conexion -> prepare($sql);
				
				$sentencia -> bindParam(':ejercicio_id', $ejercicio_id, PDO::PARAM_STR);
				$sentencia -> bindParam(':alumno_id', $alumno_id, PDO::PARAM_STR);

				$path_obtenido = $sentencia -> execute();
				$resultado = $sentencia -> fetchColumn();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $resultado;
	}

	public static function actualizar_path($conexion, $path, $ejercicio_id, $alumno_id){
		$path_actualizado = false;

		if(isset($conexion)) {
			try {
				$sql = "UPDATE Notas SET path = :path WHERE ejercicio_id = :ejercicio_id AND alumno_id = :alumno_id";

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':path', $path, PDO::PARAM_STR);				
				$sentencia -> bindParam(':ejercicio_id', $ejercicio_id, PDO::PARAM_STR);
				$sentencia -> bindParam(':alumno_id', $alumno_id, PDO::PARAM_STR);

				$path_actualizado = $sentencia -> execute();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $path_actualizado;
	}

	public static function actualizar_valor($conexion, $valor, $ejercicio_id, $path){
		$valor_actualizado = false;

		if(isset($conexion)) {
			try {
				$sql = "UPDATE Notas SET valor = :valor WHERE ejercicio_id = :ejercicio_id AND path = :path";

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':valor', $valor, PDO::PARAM_STR);				
				$sentencia -> bindParam(':ejercicio_id', $ejercicio_id, PDO::PARAM_STR);
				$sentencia -> bindParam(':path', $path, PDO::PARAM_STR);

				$valor_actualizado = $sentencia -> execute();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $valor_actualizado;
	}

	public static function borrar_nota($conexion, $ejercicio_id, $alumno_id){
		$nota_borrada = false;

		if(isset($conexion)) {
			try {
				$sql = "DELETE FROM Notas WHERE ejercicio_id = :ejercicio_id AND alumno_id = :alumno_id";

				$sentencia = $conexion -> prepare($sql);
				
				$sentencia -> bindParam(':ejercicio_id', $ejercicio_id, PDO::PARAM_STR);
				$sentencia -> bindParam(':alumno_id', $alumno_id, PDO::PARAM_STR);

				$nota_borrada = $sentencia -> execute();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $nota_borrada;
	}

	public static function seleccion_alumnos_carpeta($conexion, $ejercicio_id, $path) {
		$alumnos = array();

		if(isset($conexion)) {
			try {
				include_once 'Nota.inc.php';

				$sql = "SELECT * FROM Notas WHERE ejercicio_id = :ejercicio_id AND path = :path";

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':ejercicio_id', $ejercicio_id, PDO::PARAM_STR);
				$sentencia -> bindParam(':path', $path, PDO::PARAM_STR);

				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				if(count($resultado)) {
					foreach($resultado as $fila) {
					    $alumnos[] = new Nota($fila['id_nota'], $fila['ejercicio_id'], $fila['valor'], 
							$fila['path'], $fila['alumno_id']);
					}
				} else {
					// print "No hay profesores ";
				}

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $alumnos;
	}

	/*public static function modificar_nota($conexion, $valor, $extra, $ejercicio_id, $alumno_id){
		$nota_actualizada = false;

		if(isset($conexion)) {
			try {
				$sql = "UPDATE Notas SET valor = :valor, extra = :extra WHERE alumno_id = :alumno_id 
					AND ejercicio_id = :ejercicio_id";

				$sentencia = $conexion -> prepare($sql);
				
				$sentencia -> bindParam(':valor', $valor, PDO::PARAM_STR);
				$sentencia -> bindParam(':extra', $extra, PDO::PARAM_STR);
				$sentencia -> bindParam(':ejercicio_id', $ejercicio_id, PDO::PARAM_STR);
				$sentencia -> bindParam(':alumno_id', $alumno_id, PDO::PARAM_STR);

				$nota_actualizada = $sentencia -> execute();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $nota_actualizada;
	}*/

	/*public static function obtener_nota($conexion, $ejercicio_id, $alumno_id){
		$nota = array();

		if(isset($conexion)) {
			try {
				include_once 'Nota.inc.php';

				$sql = "SELECT * FROM Notas WHERE ejercicio_id = :ejercicio_id AND alumno_id = :alumno_id";

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':ejercicio_id', $ejercicio_id, PDO::PARAM_STR);
				$sentencia -> bindParam(':alumno_id', $alumno_id, PDO::PARAM_STR);

				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				if(count($resultado)) {
					foreach($resultado as $fila) {
					    $nota[] = new Nota($fila['id_nota'], $fila['ejercicio_id'], $fila['valor'], 
							$fila['extra'], $fila['comentario'], $fila['alumno_id']);
					}
				} else {
					// print "No hay profesores ";
				}
			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $nota;
	}*/

}

?>
