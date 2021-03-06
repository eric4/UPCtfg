<?php

class RepositorioAlumno {

	public static function insertar_alumno($conexion, $alumno) {
		$alumno_insertado = false;

		if(isset($conexion)){
			try {

				$sql = "INSERT INTO Alumnos(nombre, primer_apellido, segundo_apellido, examen_cara_A, examen_cara_B, nota_final, 					examen_id) VALUE (:nombre, :primer_apellido, :segundo_apellido, :examen_cara_A, :examen_cara_B, 
														:nota_final, :examen_id)";			

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':nombre', $alumno -> obtener_nombre(), PDO::PARAM_STR);
				$sentencia -> bindParam(':primer_apellido', $alumno -> obtener_primer_apellido(), PDO::PARAM_STR);
				$sentencia -> bindParam(':segundo_apellido', $alumno -> obtener_segundo_apellido(), PDO::PARAM_STR);
				$sentencia -> bindParam(':examen_cara_A', $alumno -> obtener_examen_cara_A(), PDO::PARAM_STR);
				$sentencia -> bindParam(':examen_cara_B', $alumno -> obtener_examen_cara_B(), PDO::PARAM_STR);
				$sentencia -> bindParam(':nota_final', $alumno -> obtener_nota_final(), PDO::PARAM_STR);
				$sentencia -> bindParam(':examen_id', $alumno -> obtener_examen_id(), PDO::PARAM_STR);

				$alumno_insertado = $sentencia -> execute();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $alumno_insertado;
	}

	public static function obtener_todos($conexion, $examen_id) {
		$alumnos = array();

		if(isset($conexion)) {
			try {
				include_once 'Alumno.inc.php';

				$sql = "SELECT A1.id_alumno, A1.nombre, A1.primer_apellido, A1.segundo_apellido, A1.examen_cara_A, A1.examen_cara_B, 					A1.nota_final, A1.examen_id FROM Alumnos A1 INNER JOIN Examenes E1 
				WHERE A1.examen_id = E1.id_examen AND E1.id_examen = :examen_id";

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':examen_id', $examen_id, PDO::PARAM_STR);

				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				if(count($resultado)) {
					foreach($resultado as $fila) {
						$alumnos[] = new Alumno($fila['id_alumno'], $fila['nombre'], $fila['primer_apellido'], 
							$fila['segundo_apellido'], $fila['examen_cara_A'], $fila['examen_cara_B'], 
												$fila['nota_final'], $fila['examen_id']);
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

	public static function obtener_alumno($conexion, $id_alumno) {
		$alumno = '';

		if(isset($conexion)){
			try {
				include_once 'Alumno.inc.php';

				$sql = "SELECT * FROM Alumnos WHERE id_alumno = :id_alumno";			

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':id_alumno', $id_alumno, PDO::PARAM_STR);

				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				if(count($resultado)) {
					foreach($resultado as $fila) {
						$alumno = new Alumno($fila['id_alumno'], $fila['nombre'], $fila['primer_apellido'], 
							$fila['segundo_apellido'], $fila['examen_cara_A'], $fila['examen_cara_B'], 
												$fila['nota_final'], $fila['examen_id']);
					}
				} else {
					// print "No hay profesores ";
				}

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $alumno;
	}

	public static function obtener_no_assignados($conexion, $examen_id, $vacio) {
		$alumnos = array();

		if(isset($conexion)) {
			try {
				include_once 'Alumno.inc.php';

				$sql = " SELECT * FROM Alumnos WHERE examen_id = :examen_id AND examen_cara_A = :vacio ";

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':examen_id', $examen_id, PDO::PARAM_STR);
				$sentencia -> bindParam(':vacio', $vacio, PDO::PARAM_STR);

				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				if(count($resultado)) {
					foreach($resultado as $fila) {
						$alumnos[] = new Alumno($fila['id_alumno'], $fila['nombre'], $fila['primer_apellido'], 
							$fila['segundo_apellido'], $fila['examen_cara_A'], $fila['examen_cara_B'], 
												$fila['nota_final'], $fila['examen_id']);
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

	public static function obtener_pdf($conexion, $id_examen, $pdf) {
		$examen = false;

		if(isset($conexion)){
			try {

				$sql = "SELECT * FROM Alumnos WHERE examen_id = :examen_id AND examen_cara_A = :pdf";			

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':examen_id', $id_examen, PDO::PARAM_STR);
				$sentencia -> bindParam(':pdf', $pdf, PDO::PARAM_STR);

				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				if(count($resultado)) {
					$examen = true;
				} else {
					// print "No hay profesores ";
				}

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $examen;
	}

	public static function obtener_primer_pdf($conexion, $id_examen) {
		$examen = false;
		$null = '-';

		if(isset($conexion)){
			try {

				$sql = "SELECT examen_cara_A FROM Alumnos WHERE examen_id = :examen_id AND examen_cara_A != :pdf 
					LIMIT 1";			

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':examen_id', $id_examen, PDO::PARAM_STR);
				$sentencia -> bindParam(':pdf', $null, PDO::PARAM_STR);

				$sentencia -> execute();
				$resultado = $sentencia -> fetchColumn();


			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $resultado;
	}

	public static function reasignar_alumno($conexion, $pdf, $id_alumno){
		$alumno_reasignado = false;

		if(isset($conexion)) {
			try {
				$sql = "UPDATE Alumnos SET examen_cara_A = :pdf WHERE id_alumno = :id_alumno";

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':pdf', $pdf, PDO::PARAM_STR);			
				$sentencia -> bindParam(':id_alumno', $id_alumno, PDO::PARAM_STR);

				$alumno_reasignado = $sentencia -> execute();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $alumno_reasignado;
	}

	public static function insertar_anonimo($conexion, $pdf, $examen_id) {
		$alumno_insertado = false;
		$anonimo = "Anonimo";

		if(isset($conexion)){
			try {

				$sql = "INSERT INTO Alumnos(nombre, primer_apellido, examen_cara_A, examen_id) 
				VALUE (:nombre, :primer_apellido, :examen_cara_A, :examen_id)";			

				$sentencia = $conexion -> prepare($sql);

				$sentencia -> bindParam(':nombre', $anonimo, PDO::PARAM_STR);
				$sentencia -> bindParam(':primer_apellido', $anonimo, PDO::PARAM_STR);
				$sentencia -> bindParam(':examen_cara_A', $pdf, PDO::PARAM_STR);
				$sentencia -> bindParam(':examen_id', $examen_id, PDO::PARAM_STR);

				$alumno_insertado = $sentencia -> execute();

			} catch(PDOException $ex) {
				print "ERROR: " . $ex -> getMessage() . "<br>";
			}
		}
		return $alumno_insertado;
	}

}



?>
