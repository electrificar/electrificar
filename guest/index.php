<?php
	/*if( $_SERVER['REMOTE_ADDR'] != '83.35.222.142' && $_SERVER['REMOTE_ADDR'] != '85.52.6.21' && $_SERVER['REMOTE_ADDR'] != '46.25.51.170' && $_SERVER['REMOTE_ADDR'] != '88.10.250.84'){
        print("Web en construccion, en pocos dias estaremos contigo");
        exit;
    }*/
	//Primero algunas variables de configuracion

	// Esta variable nos dara el entorno de trabajo 
	$environment = "guest";
	
	// Incluimos el kernel
	require_once($_SERVER["DOCUMENT_ROOT"]."/core/bootstrap.php");

	// La parte de cliente estará libre de caracteres raros en sus entradas de datos
	prevent_sqlinjection ();

	// Recuperamos el controlador
	$ack = load_controller($_REQUEST["controller"],"guest");
	if($ack->resultado == false){
		?>
			<script>
				document.location = "/404.html";
			</script>
		<?php 
	} 

	// Invocamos la accion del controlador
	$action = load_action($_REQUEST['action']);
	$controller = $ack->datos;
	$methodVariable = array($controller, $_REQUEST["action"]);
	if(is_callable($methodVariable)){
		$controller->$action();
	} else {
		?>
		<script>
			document.location = "/404.html";
		</script>
		<?php 
	}
?>