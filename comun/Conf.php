<?
    session_start();
    
    // Pasamos la codificacion a Latin para que funcionen los ajax
    header('Content-Type: text/html; charset=UTF-8');
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Pragma: no-cache");

    // Variables comunes utilizadas en sistemas no autenticados
    require_once ($_SERVER["DOCUMENT_ROOT"]."/comun/comun.php");

    // Incluimos las librerias comunes
    require_once ($_SERVER["DOCUMENT_ROOT"]."/comun/utiles.php");
    
    // Instanciamos el log
    $LOG_DIR = $_SERVER[DOCUMENT_ROOT]."/logs/";
    require_once ($_SERVER[DOCUMENT_ROOT]."/core/Log.php");
    $log = new Log($_SERVER["REMOTE_ADDR"], $_SESSION['SESION_USUARIO'], $_SESSION['SESION_TIPO_USUARIO'], $_SESSION['SESION_ID_USUARIO']);

//
//    /**************************************
//                SESION
//    ***************************************/
//    // Para la url de login no le pedimos la sesion
    if ($environment=="guest") {
        // No hay registro
    } else {
        if(!isset($_SESSION['SESION_USUARIO']) && ($_REQUEST['action'] != 'do_logout' && $_REQUEST['action'] != 'do_login' && $_REQUEST['action'] != 'frm_login')) {
            //print_r($_REQUEST);exit;
        	// print "Location: /".$environment."/do_logout";
            header("Location: /admin/do_logout");
            // print "Error de sesion";
            exit;
        }
    }
?>