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

    $email_contacto     = "javier.djt@hotmail.es";
    
    //numero de registros por defecto que acata la aplicación
    $REGISTROS_LISTADO = 9;

    setlocale(LC_MONETARY, 'es_ES.UTF-8');

    // Path a unzip
    $UNZIP = "/usr/bin/unzip";
    
	$iva = "21";
	$iva_aplicable = "1.21";
	
	$tipo_colaboradores = array(
		 '1' =>array("id_tipo"=>"1","tipo"=>"Limpieza")
		,'2' =>array("id_tipo"=>"2","tipo"=>"Mecánica")
		,'3' =>array("id_tipo"=>"3","tipo"=>"Puntos de carga")
	);
	
	$empresas = array(
		 '1'=>array("id_empresa"=>"1","empresa"=>"Limpiezas Paqui")
		,'2'=>array("id_empresa"=>"2","empresa"=>"Fast and loud")
		,'3'=>array("id_empresa"=>"3","empresa"=>"Samsung")
	);
	
	$estados = array(
			'1'=>'pendiente',
			'2'=>'abierto',
			'3'=>'cerrado',
			'4'=>'en revision'
	);


?>
