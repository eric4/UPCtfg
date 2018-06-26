
<div class="container navbar">
    <div>
	<ul class="nav navbar-nav navbar-left navegador">
	    <?php if(ControlSesion::sesion_iniciada()) { ?>

			<a href="<?php echo RUTA_HOME ?>" class="glyphicon glyphicon-home"> </a>
		   	<?php switch($partes_ruta[1]){
			    case 'password': ?>	
				<span><?php echo '/'; ?></span>
				<span> <?php echo 'CONTRASENYA' ?> </span><?php
			    	break;
			    case 'registre': ?>	
				<span><?php echo '/'; ?></span>
				<span> <?php echo 'REGISTRE' ?> </span><?php
			    	break;
			    case 'registro-correcto': ?>
				<span><?php echo '/'; ?></span>			
				<a href="<?php echo RUTA_REGISTRO_CORRECTO ?>"> <?php echo 'REGISTRE-CORRECTE' ?> </a><?php
				break;
			    case 'examens': ?>
				<span><?php echo '/'; ?></span>
				<span> <?php echo 'EXÀMENS' ?> </span><?php
				break;
			    case 'examen_nou': ?>
				<span><?php echo '/'; ?></span>
				<a href="<?php echo RUTA_EXAMENES ?>"> <?php echo 'EXÀMENS' ?> </a>
				<span><?php echo '/'; ?></span>
				<span> <?php echo 'PAS 1' ?> </span><?php
			    	break;
			    case 'examen_nou2': ?>
				<span><?php echo '/'; ?></span>
				<a href="<?php echo RUTA_EXAMENES ?>"> <?php echo 'EXÀMENS' ?> </a>
				<span><?php echo '/'; ?></span>
				<a href="<?php echo RUTA_INFORMACIO ?>"> <?php echo 'PAS 1' ?> </a>
				<span><?php echo '/'; ?></span>
				<span> <?php echo 'PAS 2' ?> </span><?php
			    	break;
			    case 'examen_nou3': ?>
				<span><?php echo '/'; ?></span>
				<a href="<?php echo RUTA_EXAMENES ?>"> <?php echo 'EXÀMENS' ?> </a>
				<span><?php echo '/'; ?></span>
				<a href="<?php echo RUTA_INFORMACIO ?>"> <?php echo 'PAS 1' ?> </a>
				<span><?php echo '/'; ?></span>
				<a href="<?php echo RUTA_INFORMACIO_2 ?>"> <?php echo 'PAS 2' ?> </a>
				<span><?php echo '/'; ?></span>
				<span> <?php echo 'PAS 3' ?> </span><?php
			    	break;
			    case 'examen_nou4': ?>
				<span><?php echo '/'; ?></span>
				<a href="<?php echo RUTA_EXAMENES ?>"> <?php echo 'EXÀMENS' ?> </a>
				<span><?php echo '/'; ?></span>
				<a href="<?php echo RUTA_INFORMACIO ?>"> <?php echo 'PAS 1' ?> </a>
				<span><?php echo '/'; ?></span>
				<a href="<?php echo RUTA_INFORMACIO_2 ?>"> <?php echo 'PAS 2' ?> </a>
				<span><?php echo '/'; ?></span>
			        <a href="<?php echo RUTA_INFORMACIO_3 ?>"> <?php echo 'PAS 3' ?> </a>
				<span><?php echo '/'; ?></span>
				<span> <?php echo 'PAS 4' ?> </span><?php
			    	break;
			    case 'exercicis':?>
				<span><?php echo '/'; ?></span>
				<a href="<?php echo RUTA_EXAMENES ?>"> <?php echo 'EXÀMENS' ?> </a>
				<span><?php echo '/'; ?></span>
				<span> <?php echo 'EXERCICIS' ?> </span><?php			
				break;
			    case 'exercici_nou':?>
				<span><?php echo '/'; ?></span>
				<a href="<?php echo RUTA_EXAMENES ?>"> <?php echo 'EXÀMENS' ?> </a>
				<span><?php echo '/'; ?></span>
				<a href="<?php echo RUTA_EXERCICIS ?>"> <?php echo 'EXERCICIS' ?> </a>
				<span><?php echo '/'; ?></span>
				<span><?php echo 'EXERCICI NOU'; ?></span><?php
			    	break;
			    case 'correccio':?>
				<span><?php echo '/'; ?></span>
				<a href="<?php echo RUTA_EXAMENES ?>"> <?php echo 'EXÀMENS' ?> </a>
				<span><?php echo '/'; ?></span>
				<a href="<?php echo RUTA_EXERCICIS ?>"> <?php echo 'EXERCICIS' ?> </a>
				<span><?php echo '/'; ?></span>
				<span><?php echo 'CARPETES'; ?></span><?php
				break;
			    case 'subcarpetes':?>
				<span><?php echo '/'; ?></span>
				<a href="<?php echo RUTA_EXAMENES ?>"> <?php echo 'EXÀMENS' ?> </a>
				<span><?php echo '/'; ?></span>
				<a href="<?php echo RUTA_EXERCICIS ?>"> <?php echo 'EXERCICIS' ?> </a>
				<span><?php echo '/'; ?></span>
				<a href="<?php echo RUTA_CORRECCIO ?>"> <?php echo 'CARPETES' ?> </a>
				<span><?php echo '/'; ?></span>
				<span><?php echo 'SUBCARPETES'; ?></span><?php
				break;
			    case 'alumnes':?>
				<span><?php echo '/'; ?></span>
				<a href="<?php echo RUTA_EXAMENES ?>"> <?php echo 'EXÀMENS' ?> </a>
				<span><?php echo '/'; ?></span>
				<a href="<?php echo RUTA_EXERCICIS ?>"> <?php echo 'EXERCICIS' ?> </a>
				<span><?php echo '/'; ?></span>
				<a href="<?php echo RUTA_ALUMNES ?>"> <?php echo 'ALUMNES' ?> </a><?php			
				break;

			    case 'upload':
				$navegador = $navegador.'/UPLOAD';
				break;
			} ?>

	    <?php } ?>
				
	</ul>
    </div>
</div>
