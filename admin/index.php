<?php
	// Esta variable nos dara el entorno de trabajo 
	$environment = "admin";
	
	// Incluimos el kernel
	require_once($_SERVER["DOCUMENT_ROOT"]."/core/bootstrap.php");
	
	// Recuperamos el controlador
	$ack = load_controller($_REQUEST["controller"]);
	if($ack->resultado == false){
		die('El controlador no existe - 404 not found');
	} 

	set_time_limit(0);
    ini_set("max_input_time","200");
    ini_set("upload_max_filesize","50M");
    ini_set("post_max_size","50M");
	
	//recuperamos la accion del controlador
	$accion = load_action($_REQUEST['accion']);
	$controller = $ack->datos;	
	
	$controller->layout->assign('SESION_USUARIO', $_SESSION['SESION_USUARIO']);
	$controller->layout->assign('ID_USUARIO_SESION', encrypt($_SESSION['SESION_ID_USUARIO']));
	
	$methodVariable = array($controller, $accion);
	if(is_callable($methodVariable)){
		$controller->$accion();
	} else {
		die('No se ha encontrado el método solicitado. Revíselo y, si aun así persiste el problema, contacte con su administrador');
	}
?>