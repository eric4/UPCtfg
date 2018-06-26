<?php

class RepositorioProfesor {
	
	public static function obtener_todos($conexion) {
		$profesores = array();

		if(isset($conexion)) {
			try {
				include_once 'Profesor.inc.php';

				$sql = "SELECT * FROM Profesores";
				$sentencia = $conexion -> prepare($sql);
				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				if(count($resultado)) {
					foreach($resultado as $fila) {
						$profesores[] = new Profesor($fila['id'], $fila['nombre'], $fila['email'], 
							$fila['password'], $fila['fecha'], $fila['administrador']);
					}
				} else {
					print "No hay profesores ";
				}

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $profesores;
	}

	public static function insertar_profesor($conexion, $profesor) {
		$profesor_insertado = false;

		if(isset($conexion)) {
			try {
				$sql = "INSERT INTO Profesores(nombre, email, password, fecha, administrador)
					 VALUES(:nombre, :email, :password, NOW(), :administrador)";

				$sentencia = $conexion -> prepare($sql);
				
				$sentencia -> bindParam(':nombre', $profesor -> obtener_nombre(), PDO::PARAM_STR);
				$sentencia -> bindParam(':email', $profesor -> obtener_email(), PDO::PARAM_STR);
				$sentencia -> bindParam(':password', $profesor -> obtener_password(), PDO::PARAM_STR);
				$sentencia -> bindParam(':administrador', $profesor -> obtener_administrador(), PDO::PARAM_STR);

				$profesor_insertado = $sentencia -> execute();
			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $profesor_insertado;
	}
	
	public static function nombre_existe($conexion, $nombre) {
		$nombre_existe = true;

		if(isset($conexion)) {
			try {
				$sql = "SELECT * FROM Profesores WHERE nombre = :nombre";

				$sentencia = $conexion -> prepare($sql);
				
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

	public static function email_existe($conexion, $email) {
		$email_existe = true;

		if(isset($conexion)) {
			try {
				$sql = "SELECT * FROM Profesores WHERE email = :email";

				$sentencia = $conexion -> prepare($sql);
				
				$sentencia -> bindParam(':email', $email, PDO::PARAM_STR);

				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				if(count($resultado) > 0){
					$email_existe = true;
				} else {
					$email_existe = false;
				}
			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $email_existe;
	}

	public static function obtener_profesor_por_email($conexion, $email) {
		$profesor = null;

		if(isset($conexion)) {
			try{
				include_once 'bbdd/Profesor.inc.php';

				$sql = "SELECT * FROM Profesores WHERE email = :email";
				
				$sentencia = $conexion -> prepare($sql);
				$sentencia -> bindParam(':email', $email, PDO::PARAM_STR);
				$sentencia -> execute();
				$resultado = $sentencia -> fetch();

				if(!empty($resultado)) {
					$profesor = new Profesor($resultado['id'], $resultado['nombre'], $resultado['email'],
								$resultado['password'], $resultado['fecha'], $resultado['administrador']);
				}
			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $profesor;
	}

	public static function modificar_password($conexion, $password, $id_profesor) {
		$modificar_profesor = true;

		if(isset($conexion)) {
			try{

				$sql = "UPDATE Profesores SET password = :password WHERE id = :id_profesor";
				
				$sentencia = $conexion -> prepare($sql);
				$sentencia -> bindParam(':password', $password, PDO::PARAM_STR);
				$sentencia -> bindParam(':id_profesor', $id_profesor, PDO::PARAM_STR);
				$sentencia -> execute();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $modificar_profesor;
	}

}



?>
