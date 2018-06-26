<?php



class RepositorioDirectorio {
	
	public $username;
	var $directorio = "";
	
	public static function obtener_todos($conexion, $profesor_id) {
		$directorios = array();

		if(isset($conexion)) {
			try {
				include_once 'Directorio.inc.php';

				$sql = "SELECT E1.id_directorio, E1.nombre, E1.inicio, E1.fin, E1.cuatrimestre, E1.fecha, E1.profesor_id 
				FROM Directorios E1 INNER JOIN Profesores P1 WHERE E1.profesor_id = P1.id AND E1.profesor_id = :profesor_id";

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':profesor_id', $profesor_id, PDO::PARAM_STR);

				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				if(count($resultado)) {
					foreach($resultado as $fila) {
						$directorios[] = new Directorio($fila['id_directorio'], $fila['nombre'], $fila['inicio'], 
						$fila['fin'], $fila['cuatrimestre'], $fila['fecha'], $fila['profesor_id']);
					}
				}

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $directorios;
	}

	public static function obtener_directorio($conexion, $id_directorio) {

		$directorio = '';

		if(isset($conexion)) {
			try {
				include_once 'Directorio.inc.php';

				$sql = "SELECT * FROM Directorios WHERE id_directorio = :id_directorio";

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':id_directorio', $id_directorio, PDO::PARAM_STR);

				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				if(count($resultado)) {
					foreach($resultado as $fila) {
						$directorio = new Directorio($fila['id_directorio'], $fila['nombre'], $fila['inicio'], 
						$fila['fin'], $fila['cuatrimestre'], $fila['fecha'], $fila['profesor_id']);
					}
				}

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $directorio;
	}
	

	public static function insertar_directorio($conexion, $directorio) {
		$directorio_insertado = false;

		if(isset($conexion)) {
			try {
				$sql = "INSERT INTO Directorios(nombre, inicio, fin, cuatrimestre, fecha, profesor_id)
					 VALUES(:nombre, :inicio, :fin, :cuatrimestre, NOW(), :profesor_id)";

				$sentencia = $conexion -> prepare($sql);
				
				$sentencia -> bindParam(':nombre', $directorio -> obtener_nombre(), PDO::PARAM_STR);
				$sentencia -> bindParam(':inicio', $directorio -> obtener_inicio(), PDO::PARAM_STR);
				$sentencia -> bindParam(':fin', $directorio -> obtener_fin(), PDO::PARAM_STR);
				$sentencia -> bindParam(':cuatrimestre', $directorio -> obtener_cuatrimestre(), PDO::PARAM_STR);
				$sentencia -> bindParam(':profesor_id', $directorio -> obtener_profesor_id(), PDO::PARAM_STR);

				$directorio_insertado = $sentencia -> execute();
			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $directorio_insertado;
	}

	public static function asignatura_existe($conexion, $nombre, $inicio, $fin, $cuatrimestre) {
		$nombre_existe = true;

		if(isset($conexion)) {
			try {
				$sql = "SELECT * FROM Directorios WHERE nombre = :nombre AND inicio = :inicio
						AND fin = :fin AND cuatrimestre = :cuatrimestre";

				$sentencia = $conexion -> prepare($sql);
				
				$sentencia -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
				$sentencia -> bindParam(':inicio', $inicio, PDO::PARAM_STR);
				$sentencia -> bindParam(':fin', $fin, PDO::PARAM_STR);
				$sentencia -> bindParam(':cuatrimestre', $cuatrimestre, PDO::PARAM_STR);

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
}



?>
