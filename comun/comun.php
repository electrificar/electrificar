<?
	date_default_timezone_set('Europe/Madrid');

    require($_SERVER[DOCUMENT_ROOT]."/comun/predefs.php");

    /**************************************
            BKP DIR
    ***************************************/
    // $bkp_dir = $_SERVER[DOCUMENT_ROOT]."/bkps/";
    $bkp_dir = $_SERVER["DOCUMENT_ROOT"]."/bkps";


    /*****************************************
            FILE REPOSITORY
    *****************************************/
    $repository = $_SERVER["DOCUMENT_ROOT"]."/repositorio";
    
    $repositorio_fotos = "/repositorio";

    /*****************************************
            LOGS DIR
    *****************************************/
    // $LOGS_DIR = $_SERVER[DOCUMENT_ROOT]."/logs";
    $LOGS_DIR = $_SERVER["DOCUMENT_ROOT"]."/logs";
    
    /**************************************
              DATOS UTILES
    ***************************************/
    $semana = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");
    $meses = array ("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $semana_breve = array ("Sun"=>"Do", "Mon"=>"Lu", "Tue"=>"Ma", "Wed"=>"Mi", "Thu"=>"Ju", "Fri"=>"Vi", "Sat"=>"Sa");
    $iva = 21;

    // Corregimos la desviación horaria ya que el servidor se encuentra
    // con una diferencia de 9 horas, a su vez mantendremos en todo momento 
    // definidas estas variables para su uso dentro de la herramienta
    // $_FECHA_HORA = mktime (date("H")+9);
    $_FECHA_HORA = mktime (date("H"));
    $_dia = date("d", $_FECHA_HORA);
    $_mes = date("m", $_FECHA_HORA);
    $_ano = date("Y", $_FECHA_HORA);
    $_hora = date("H", $_FECHA_HORA);
    $_min = date("i", $_FECHA_HORA);
    $_seg = date("s", $_FECHA_HORA);

    
    $dominio_absoluto   = "taller";
    $email_contacto     = "javier.djt@hotmail.es";
    
    //numero de registros por defecto que acata la aplicación
    $REGISTROS_LISTADO = 9;

    setlocale(LC_MONETARY, 'es_ES.UTF-8');

    // Path a unzip
    $UNZIP = "/usr/bin/unzip";
    
	$iva = "21";
	$iva_aplicable = "1.21";
	
	$gastos_envio = "10";
	$precio_min_envio_free = "30";
	
	$estados_pedido = array();
	$estados_pedido[1] = "En proceso";
	$estados_pedido[2] = "Hecho";
	$estados_pedido[3] = "En proceso de envío";
	$estados_pedido[4] = "Enviado";
	$estados_pedido[5] = "Cancelado";
	
	$formas_pago = array();
	$formas_pago[1] = "Tarjeta de crédito/débito";
	$formas_pago[2] = "Transferencia bancaria";
	$formas_pago[3] = "PayPal";

?>
