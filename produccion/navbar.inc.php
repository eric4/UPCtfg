<?php include_once 'FuncionesRedireccion.inc.php'; ?>
<?php include_once 'FuncionesSesion.inc.php'; ?>
<?php include_once 'FuncionesConexion.inc.php'; ?>

	<div class="container navbar">
		<div>
			<img class="text-center logo" src="https://www.fib.upc.edu/sites/fib/files/images/logo-fib.png" />
		</div>
		<div>
			<ul class="nav navbar-nav navbar-left">
				<?php
					if(Sesion::sesion_iniciada()) {
				?>
		
						<li>
							<a href="<?php echo RUTA_PASSWORD; ?>">
								<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
								<?php $id_prof = $_SESSION['id_profesor']; ?>
								<?php $nombre_prof = $_SESSION['nombre_profesor']; ?>
								<?php echo ' ' . $nombre_prof ?>
							</a>
						</li>
						<li>
							<a href="<?php echo RUTA_LOGOUT; ?>">
								<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
								Cerrar Sesión
							</a>								
						</li>
				<?php
					}
				?>
					
			</ul>
		</div>
	</div>
