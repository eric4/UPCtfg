<!DOCTYPE html>

<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-type" content="text/html">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="keywords" content="img, png, imagenes, imagen, insertar, src, jpg, jpeg, gif, pdf">

		<?php
			if(!isset($titulo) || empty($titulo)){
				$titulo = 'TFG';
			}
			echo"<title>$titulo</title>";
		?>

		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="css/font-awesome.css">
		<link href="css/estilos.css" rel="stylesheet">

		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/mains.js"></script>

		<link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" />
		<script type="text/javascript" src="js/jquery.js"></script>
		<script src="js/jquery.Jcrop.min.js"></script>
	</head>

	<body>
    <script>

    function checkCoords(){
        if (parseInt(jQuery('#w').val())>0) return true;
        alert('Please select a crop region then press submit.');
        return false;
    };
    </script>
