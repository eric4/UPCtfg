<?php	


	$componentes_url = parse_url($_SERVER["REQUEST_URI"]);
	$ruta = $componentes_url['path'];
	$partes_ruta = explode("/", $ruta);
	$partes_ruta = array_filter($partes_ruta);
	$partes_ruta = array_slice($partes_ruta, 0);		// Con esto hago que mi primer array sea TFG

	$ruta_elegida = 'vistas/404.php';
	$examen_actual = '';

	if($partes_ruta[0] == 'TFG') {
		if(count($partes_ruta) == 1) {	
			$ruta_elegida = 'vistas/presentacion.php';
		} else if(count($partes_ruta) == 2) {
			switch($partes_ruta[1]) {
				case 'home':
					$ruta_elegida = 'vistas/home.php';
					include("./vistas/home.php");
					break;

				case 'logout':
					$ruta_elegida = 'vistas/logout.php';
					break;

				case 'password':
					$ruta_elegida = 'vistas/home.php';
					break;

				case 'password-correcte':
					$ruta_elegida = 'vistas/home.php';
					break;

				case 'registre':
					$ruta_elegida = 'vistas/home.php';
					break;

				case 'registre-correcte':
					$ruta_elegida = 'vistas/home.php';
					break;

				case 'examens':
					$examen_actual = 'examens';
					$ruta_elegida = 'vistas/home.php';
					break;

				case 'examen_nou':
					$examen_actual = 'examen_nou';
					$ruta_elegida = 'vistas/home.php';
					break;

				case 'examen_nou2':
					$examen_actual = 'examen_nou2';
					$ruta_elegida = 'vistas/home.php';
					break;

				case 'examen_nou3':
					$examen_actual = 'examen_nou3';
					$ruta_elegida = 'vistas/home.php';
					break;

				case 'examen_nou4':
					$examen_actual = 'examen_nou4';
					$ruta_elegida = 'vistas/home.php';
					break;

				case 'exercicis':
					$examen_actual = 'exercicis';
					$ruta_elegida = 'vistas/home.php';
					break;

				case 'exercici_nou':
					$examen_actual = 'exercici_nou';
					$ruta_elegida = 'vistas/home.php';
					break;

				case 'correccio':
					$examen_actual = 'correccio';
					$ruta_elegida = 'vistas/home.php';
					break;

				case 'subcarpetes':
					$examen_actual = 'subcarpetas';
					$ruta_elegida = 'vistas/home.php';
					break;

				case 'alumnes':
					$examen_actual = 'alumnes';
					$ruta_elegida = 'vistas/home.php';
					break;

				case 'upload':
					$examen_actual = 'upload';
					$ruta_elegida = 'vistas/home.php';
					break;

				case 'comentarios':
					$examen_actual = 'comentarios';
					$ruta_elegida = 'vistas/home.php';
					break;

				case 'favoritos':
					$examen_actual = 'favoritos';
					$ruta_elegida = 'vistas/home.php';
					break;
			}
		} 
	}

	include_once $ruta_elegida;
?>
