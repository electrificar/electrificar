<?php
    //Primero algunas variables de configuracion

    // Esta variable nos dara el entorno de trabajo 
    $environment            = "guest";
    $_REQUEST["action"]     = "home";
    $_REQUEST["controller"] = "home";

    
    // Incluimos el kernel
    require_once($_SERVER["DOCUMENT_ROOT"]."/core/bootstrap.php");
    
    // Recuperamos el controlador
    $ack = load_controller($_REQUEST["controller"],"guest");
    if($ack->resultado == false){
        die('El controlador no existe - 404 not found');
    } 

    // Invocamos la accion del controlador
    $action = load_action($_REQUEST['action']);
    $controller = $ack->datos;
    $methodVariable = array($controller, $_REQUEST["action"]);
    if(is_callable($methodVariable)){
        $controller->$action();
    } else {
        die('No se ha encontrado el método solicitado. Revíselo y, si aun así persiste el problema, contacte con su administrador');
    }
?>
