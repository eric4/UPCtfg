<?php

class RepositorioCarpeta {

	public static function insertar_carpeta($conexion, $carpeta) {
		$carpeta_insertada = false;

		if(isset($conexion)) {
			try {
				$sql = "INSERT INTO Carpetas(ejercicio_id, nombre, path, carpeta_id)
					 VALUES(:ejercicio_id, :nombre, :path, :carpeta_id)";

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':ejercicio_id', $carpeta -> obtener_ejercicio_id(), PDO::PARAM_STR);				
				$sentencia -> bindParam(':nombre', $carpeta -> obtener_nombre(), PDO::PARAM_STR);
				$sentencia -> bindParam(':path', $carpeta -> obtener_path(), PDO::PARAM_STR);
				$sentencia -> bindParam(':carpeta_id', $carpeta -> obtener_carpeta_id(), PDO::PARAM_STR);

				$carpeta_insertada = $sentencia -> execute();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $carpeta_insertada;
	}

	public static function actualizar_comentario($conexion, $comentario, $id_carpeta) {
		$comentario_insertado = false;

		if(isset($conexion)) {
			try {
				$sql = "UPDATE Carpetas SET comentario = :comentario WHERE id_carpeta = :id_carpeta";

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':comentario', $comentario, PDO::PARAM_STR);
				$sentencia -> bindParam(':id_carpeta', $id_carpeta, PDO::PARAM_STR);

				$comentario_insertado = $sentencia -> execute();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $comentario_insertado;
	}

	public static function obtener_path($conexion, $id_carpeta){
		$resultado = false;

		if(isset($conexion)) {
			try {
				$sql = "SELECT path FROM Carpetas WHERE id_carpeta = :id_carpeta";

				$sentencia = $conexion -> prepare($sql);
				
				$sentencia -> bindParam(':id_carpeta', $id_carpeta, PDO::PARAM_STR);

				$path_obtenido = $sentencia -> execute();
				$resultado = $sentencia -> fetchColumn();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $resultado;
	}

	public static function obtener_id_carpeta($conexion, $id_carpeta){
		$resultado = false;

		if(isset($conexion)) {
			try {
				$sql = "SELECT carpeta_id FROM Carpetas WHERE id_carpeta = :id_carpeta";

				$sentencia = $conexion -> prepare($sql);
				
				$sentencia -> bindParam(':id_carpeta', $id_carpeta, PDO::PARAM_STR);

				$path_obtenido = $sentencia -> execute();
				$resultado = $sentencia -> fetchColumn();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $resultado;
	}

	public static function seleccionar_id_carpeta($conexion, $id_ejercicio, $path){
		$resultado = false;

		if(isset($conexion)) {
			try {
				$sql = "SELECT id_carpeta FROM Carpetas WHERE ejercicio_id = :id_ejercicio AND path = :path";

				$sentencia = $conexion -> prepare($sql);
				
				$sentencia -> bindParam(':id_ejercicio', $id_ejercicio, PDO::PARAM_STR);
				$sentencia -> bindParam(':path', $path, PDO::PARAM_STR);

				$path_obtenido = $sentencia -> execute();
				$resultado = $sentencia -> fetchColumn();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $resultado;
	}

	public static function obtener_nombre($conexion, $id_carpeta){
		$resultado = false;

		if(isset($conexion)) {
			try {
				$sql = "SELECT nombre FROM Carpetas WHERE id_carpeta = :id_carpeta";

				$sentencia = $conexion -> prepare($sql);
				
				$sentencia -> bindParam(':id_carpeta', $id_carpeta, PDO::PARAM_STR);

				$path_obtenido = $sentencia -> execute();
				$resultado = $sentencia -> fetchColumn();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $resultado;
	}

	public static function obtener_carpetas($conexion, $ejercicio_id) {
		$carpetas = array();

		if(isset($conexion)) {
			try {
				include_once 'Carpeta.inc.php';

				$sql = "SELECT * FROM Carpetas WHERE ejercicio_id = :ejercicio_id";

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':ejercicio_id', $ejercicio_id, PDO::PARAM_STR);

				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				if(count($resultado)) {
					foreach($resultado as $fila) {
						$carpetas[] = new Carpeta($fila['id_carpeta'], $fila['nombre'], $fila['ejercicio_id'], 
								$fila['path'], $fila['valor'], $fila['comentario'], $fila['carpeta_id']);
					}
				} else {
					// print "No hay profesores ";
				}

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $carpetas;
	}

	public static function obtener_subcarpetas($conexion, $ejercicio_id, $carpeta_id) {
		$subcarpetas = array();

		if(isset($conexion)) {
			try {
				include_once 'Carpeta.inc.php';

				$sql = "SELECT * FROM Carpetas WHERE ejercicio_id = :ejercicio_id AND carpeta_id = :carpeta_id";

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':ejercicio_id', $ejercicio_id, PDO::PARAM_STR);
				$sentencia -> bindParam(':carpeta_id', $carpeta_id, PDO::PARAM_STR);

				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				if(count($resultado)) {
					foreach($resultado as $fila) {
						$subcarpetas[] = new Carpeta($fila['id_carpeta'], $fila['nombre'], $fila['ejercicio_id'], 
								$fila['path'], $fila['valor'], $fila['comentario'], $fila['carpeta_id']);
					}
				} else {
					// print "No hay profesores ";
				}

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $subcarpetas;
	}

	public static function obtener_puntuacion($conexion, $id_carpeta){
		$resultado = false;

		if(isset($conexion)) {
			try {
				$sql = "SELECT valor FROM Carpetas WHERE id_carpeta = :id_carpeta";

				$sentencia = $conexion -> prepare($sql);
				
				$sentencia -> bindParam(':id_carpeta', $id_carpeta, PDO::PARAM_STR);

				$path_obtenido = $sentencia -> execute();
				$resultado = $sentencia -> fetchColumn();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $resultado;
	}

	public static function obtener_valor($conexion, $ejercicio_id, $path){
		$resultado = false;

		if(isset($conexion)) {
			try {
				$sql = "SELECT valor FROM Carpetas WHERE ejercicio_id = :ejercicio_id AND path = :path";

				$sentencia = $conexion -> prepare($sql);
				
				$sentencia -> bindParam(':ejercicio_id', $ejercicio_id, PDO::PARAM_STR);
				$sentencia -> bindParam(':path', $path, PDO::PARAM_STR);

				$valor_obtenido = $sentencia -> execute();
				$resultado = $sentencia -> fetchColumn();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $resultado;
	}

	public static function obtener_comentario($conexion, $id_carpeta){
		$resultado = false;

		if(isset($conexion)) {
			try {
				$sql = "SELECT comentario FROM Carpetas WHERE id_carpeta = :id_carpeta";

				$sentencia = $conexion -> prepare($sql);
				
				$sentencia -> bindParam(':id_carpeta', $id_carpeta, PDO::PARAM_STR);

				$path_obtenido = $sentencia -> execute();
				$resultado = $sentencia -> fetchColumn();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $resultado;
	}

	public static function actualizar_puntuacion($conexion, $valor, $id_carpeta){
		$actualizacion = false;

		if(isset($conexion)) {
			try {
				$sql = "UPDATE Carpetas SET valor = :valor WHERE id_carpeta = :id_carpeta";

				$sentencia = $conexion -> prepare($sql);
				
				$sentencia -> bindParam(':valor', $valor, PDO::PARAM_STR);
				$sentencia -> bindParam(':id_carpeta', $id_carpeta, PDO::PARAM_STR);

				$actualizacion = $sentencia -> execute();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $actualizacion;
	}

}

?>
