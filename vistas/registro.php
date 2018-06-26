<?php
	
include_once 'produccion/FuncionesProfesores.inc.php';
include_once 'produccion/FuncionesRedireccion.inc.php';
include_once 'produccion/ValidadorRegistro.inc.php';

if($_SESSION['administrador_profesor'] == 1) {
    if(isset($_POST['registrar'])) {
        Conexiones::apertura();

	if(isset($_POST['admin'])) $checked = '1';
	else $checked = '0';
        $validador = new ValidadorRegistro
        (
	    $_POST['nombre'], $_POST['email'], $_POST['password'], $_POST['password2'], $checked, Conexiones::obtencion()
        );
		
        if($validador -> registro_valido()){
	    $profesor = new Profesor
	    (
	        '', $validador->obtener_nombre(),  $validador->obtener_email(), password_hash($validador->obtener_clave(), PASSWORD_DEFAULT), 
	        '', $validador->obtener_administrador()
	    );
			
            $profesor -> obtener_nombre();
            $profesor_insertado = Profesores::insercion_profesor(Conexiones::obtencion(), $profesor);

	    if($profesor_insertado) {
	        Redirecciones::registro_correcto();
	    }
        }

        Conexiones::cierre();
    }

?>

<div class="container">
    <div class="row">
	<div class="col-sm-1 col-md-1">
        </div>
        <div class="col-sm-10 col-md-10 main">
	    <div class="col-sm-12 col-md-12">
	        <h1><strong>REGISTRAR PROFESSOR</strong></h1>
	        <h3>INTRODUCCIÓ DE DADES</h3>
            <div class="panel-body">
	    <form role="form" method="post" action="<?php echo RUTA_REGISTRO ?>">
		<div class="col-sm-12 col-md-12">
	            <div class="col-sm-4 col-md-4"> NOM DEL PROFESSOR: </div>
	            <div class="col-sm-8 col-md-8">
		        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nom del professor" required autofocus>
	            </div>
	    	</div>
	        <?php if(isset($_POST['registrar'])) $validador -> mostrar_error_nombre(); ?>
		<div class="col-sm-12 col-md-12">
	            <div class="col-sm-4 col-md-4"> EMAIL: </div>
	    	    <div class="col-sm-8 col-md-8">
			<input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
	    	    </div>
		</div>
	    	<?php if(isset($_POST['registrar'])) $validador -> mostrar_error_email(); ?>
		<div class="col-sm-12 col-md-12">
	    	    <div class="col-sm-4 col-md-4"> CONTRASENYA: </div>
	    	    <div class="col-sm-8 col-md-8">
			<input type="password" name="password" id="password" class="form-control" placeholder="Contrasenya" required>
	    	    </div>
		</div>
	    	<?php if(isset($_POST['registrar'])) $validador -> mostrar_error_clave1(); ?>
		<div class="col-sm-12 col-md-12">
	    	    <div class="col-sm-4 col-md-4"> REPETEIX LA CONTRASENYA: </div>
	    	    <div class="col-sm-8 col-md-8">
			<input type="password" name="password2" id="password2" class="form-control" placeholder="Contrasenya" required>
	    	    </div>
		</div>
	    	<?php if(isset($_POST['registrar'])) $validador -> mostrar_error_clave2(); ?>
		<div class="col-sm-12 col-md-12">
	    	    <div class="col-sm-4 col-md-4"> ÉS ADMINISTRADOR? </div>
	    	    <div class="col-sm-1 col-md-1">
			<input type="checkbox" name="admin" id="admin" >
	    	    </div>
		</div>
		<div class="col-sm-12 col-md-12">
	    	    <button type="submit" name="registrar" class="btn btn-lg btn-primary btn-block"> REGISTRAR </button>
		</div>
	    </form>
	    <br><br>
    	</div>
    	<div class="col-sm-1 col-md-1">
    	</div>
    </div>
</div>

<?php
} else {
	include_once 'vistas/404.php';
}
?>
