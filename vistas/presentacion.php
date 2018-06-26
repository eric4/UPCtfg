<?php

    include_once 'produccion/header.inc.php';
    include_once 'produccion/FuncionesSesion.inc.php';
    include_once 'produccion/FuncionesConexion.inc.php';
    include_once 'produccion/FuncionesValidacionLogin.inc.php';
    include_once 'produccion/FuncionesRedireccion.inc.php';
    include_once 'produccion/FuncionesProfesores.inc.php';

    $titulo = "Presentacion";
    include_once 'produccion/navbar.inc.php';

    if(!Sesion::sesion_iniciada()){

	if(isset($_POST['login'])) {

	    Conexiones::apertura();
	    $validador = new ValidacionLogin($_POST['email'], $_POST['password'], Conexiones::obtencion());
	    if($validador -> obtener_error() === '' && !is_null($validador -> obtener_profesor())){
		$id = $validador -> obtener_profesor() -> obtener_id();
		$nombre = $validador -> obtener_profesor() -> obtener_nombre();
		$email = $validador -> obtener_profesor() -> obtener_email();
		$password = $validador -> obtener_profesor() -> obtener_password();
		$admin = $validador -> obtener_profesor() -> obtener_administrador();
		Conexiones::inicio($id, $nombre, $email, $password, $admin);
		Redirecciones::home();
	    }
	    Conexiones::cierre();
	}
?>

	<div class="container">
   	    <div class="jumbotron fons">
		<h1>CORRECCIÓ D'EXÀMENS</h1>
		<h2>FACULTAT D'INFORMÀTICA DE BARCELONA</h2>
	    </div>
	</div>
	<div class="container">
	    <div class="row">
		<div class="col-md-8">
		    <div class="row">
			<div class="col-md-12">
			    <div class="panel panel-default">
				<div class="panel-heading fons">
				    <h2 aria-hidden="true"> INICIAR SESSIÓ </h2>	
				</div>
				<div class="panel-body">
				    <form role="form" method="post" action="">
					<br>
					<div class="col-md-3"> EMAIL: </div>
					<div class="col-md-9">
					    <input type="email" name="email" id="email" class="form-control" placeholder="Email" 
					        <?php
						if(isset($_POST['login']) && isset($_POST['email']) && !empty($_POST['email'])) {
							echo 'value="' . $_POST['email'] . '"';
						}
					        ?>
					    required autofocus>
					</div>
					<br><br><br>
					<div class="col-md-3"> CONTRASENYA: </div>
					<div class="col-md-9">
					    <input type="password" name="password" id="password" class="form-control" 
						placeholder="Contrasenya" required>
					</div>
					<br><br><br>
					<?php
					    if(isset($_POST['login'])) {
						$validador -> mostrar_error();
					    }
					?>
					<button type="submit" name="login" class="btn btn-lg btn-primary btn-block"> ENTRAR </button>
				    </form>
				    <br>
				    <br>
				</div>
			    </div>
			</div>
		    </div>
		</div>
	    	<div class="col-md-4">
	 	    <p class="text-justify descripcio">Programa construït amb l'objectiu de facilitar la correcció d'exàmens i millorar-ne la seva
		    comoditat i el seu temps de dedicació</p>
    		</div>
	    </div>
	</div>	

<?php
    } else {
	Redirecciones::home();
    }

    include_once 'produccion/footer.inc.php';
?>

