<?php
	include_once 'bbdd/config.inc.php';
	include_once 'bbdd/Conexion.inc.php';
	include_once 'bbdd/RepositorioProfesor.inc.php';
	include_once 'bbdd/RepositorioDirectorio.inc.php';
	include_once 'bbdd/RepositorioExamen.inc.php';
	include_once 'bbdd/RepositorioEjercicio.inc.php';
	include_once 'bbdd/RepositorioPuntuacion.inc.php';
	include_once 'bbdd/RepositorioNota.inc.php';
	include_once 'bbdd/RepositorioAlumno.inc.php';
	include_once 'bbdd/RepositorioCarpeta.inc.php';
	include_once 'bbdd/Directorio.inc.php';
	include_once 'bbdd/Examen.inc.php';
	include_once 'bbdd/Profesor.inc.php';
	include_once 'bbdd/Ejercicio.inc.php';
	include_once 'bbdd/Puntuacion.inc.php';
	include_once 'bbdd/Carpeta.inc.php';
	include_once 'bbdd/Nota.inc.php';
	include_once 'bbdd/Alumno.inc.php';
	include_once 'bbdd/ValidadorDirectorio.inc.php';
	include_once 'bbdd/Redireccion.inc.php';

    	include_once 'produccion/FuncionesSesion.inc.php';
    	include_once 'produccion/FuncionesConexion.inc.php';
    	include_once 'produccion/FuncionesRedireccion.inc.php';
	include_once 'produccion/FuncionesProfesores.inc.php';
	include_once 'produccion/FuncionesDirectorios.inc.php';
	include_once 'produccion/FuncionesExamen.inc.php';
	include_once 'produccion/FuncionesEjercicio.inc.php';
	include_once 'produccion/FuncionesCarpeta.inc.php';
	include_once 'produccion/FuncionesNota.inc.php';
	include_once 'produccion/FuncionesAlumnos.inc.php';

    	if(!Sesion::sesion_iniciada()) {
		Redirecciones::presentacion();
	}

	include_once 'produccion/header.inc.php';
	include_once 'produccion/navbar.inc.php';

	if(isset($_POST['enviar'])) {
		Conexion::abrir_conexion();
		$validador2 = new ValidadorDirectorio
		(
			$_POST['nombre'], $_POST['inicio'], $_POST['fin'], $_POST['cuatrimestre'], Conexion::obtener_conexion()
		);


		if($validador2 -> registro_valido())
	 	{
			$directorio = new Directorio(
				'', 
				$validador2 -> obtener_nombre(), 
				$validador2 -> obtener_inicio(), 
				$validador2 -> obtener_fin(), 
				$validador2 -> obtener_cuatrimestre(), 
				'', 
				$id_prof
			);
			$examen_insertado = RepositorioDirectorio::insertar_directorio(Conexion::obtener_conexion(), $directorio);
		}
		Conexion::cerrar_conexion();
	}

	include_once 'produccion/navegador.inc.php';

	switch($partes_ruta[1]){
		case 'home':
			include_once 'produccion/panel_control_declaracion.inc.php';
			include_once 'vistas/general.inc.php';			
			break;

		case 'registre':
			include_once 'vistas/registro.php';			
			break;

		case 'password':
			include_once 'vistas/password.php';			
			break;

		case 'registre-correcte':
			include_once 'produccion/panel_control_declaracion.inc.php';
			include_once 'vistas/registro-correcto.php';			
			break;

		case 'password-correcte':
			include_once 'produccion/panel_control_declaracion.inc.php';
			include_once 'vistas/password-correcto.php';			
			break;

		case 'examens':	
			include_once 'produccion/panel_control_declaracion.inc.php';
			include_once 'vistas/examenes.inc.php';
			break;

		case 'examen_nou':
			include_once 'produccion/panel_control_declaracion.inc.php';
			include_once 'vistas/examen_nuevo.inc.php';
			break;

		case 'examen_nou2':
			include_once 'produccion/panel_control_declaracion.inc.php';
			include_once 'vistas/examen_nuevo_2.inc.php';
			break;

		case 'examen_nou3':
			include_once 'produccion/panel_control_declaracion.inc.php';
			include_once 'vistas/examen_nuevo_3.inc.php';
			break;

		case 'examen_nou4':
			include_once 'produccion/panel_control_declaracion.inc.php';
			include_once 'vistas/examen_nuevo_4.inc.php';
			break;

		case 'exercicis':
			include_once 'produccion/panel_control_declaracion.inc.php';
			include_once 'vistas/ejercicios.inc.php';
			break;

		case 'exercici_nou':
			include_once 'vistas/ejercicio_nuevo.inc.php';
			break;

		case 'correccio':
			include_once 'vistas/correccion.inc.php';
			break;

		case 'subcarpetes':
			include_once 'vistas/subcarpetas.php';
			break;

		case 'alumnes':
			include_once 'produccion/panel_control_declaracion.inc.php';
			include_once 'vistas/alumnos.inc.php';
			break;

		case 'upload':
			include_once 'produccion/panel_control_declaracion.inc.php';
			include_once 'produccion/upload.inc.php';
			break;
	}
	include_once 'produccion/panel_control_cierre.inc.php';
	include_once 'produccion/footer.inc.php';
?>

