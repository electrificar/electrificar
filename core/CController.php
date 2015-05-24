<?
class CController {

	var $layout             = null;
	var $conn               = null;
    var $enable_pagination  = false;
    var $navigation         = null;
    var $total_lines        = null;
    var $actions            = null;
    var $other_actions      = null;
    var $uri                = null;
    var $form				= null;
    var $controller         = null;
    var $action             = null;

	function CController(){
        global $_REQUEST, $_SESSION, $languages;
        global $environment;

        // Para el multi-idioma
        if($_REQUEST["lang"]!=null){
            if(!array_key_exists($_REQUEST["lang"], $languages)){
                $this->throw_error ("El idioma seleccionado no está soportado");
            }
            $_SESSION["lang"] = $_REQUEST["lang"];
            unset($_REQUEST["lang"]);
        } else if($_SESSION["lang"]==null){
            if($_REQUEST["lang"]!=null && !array_key_exists($_REQUEST["lang"], $languages)){
                $this->throw_error ("El idioma seleccionado no está soportado");
            }
            $_SESSION["lang"] = "es";
        }


        $this->layout = new smartyML($_SESSION["lang"]); 
        
        $this->layout->template_dir = $_SERVER["DOCUMENT_ROOT"].'/tpl_'.$environment.'/';
		$this->layout->compile_dir  = $_SERVER["DOCUMENT_ROOT"].'/tmp/templates_c/'; 
		$this->layout->config_dir   = $_SERVER["DOCUMENT_ROOT"].'/tmp/configs/'; 
		$this->layout->cache_dir    = $_SERVER["DOCUMENT_ROOT"].'/tmp/cache/';

        // Acciones
        $this->actions       = array();
        $this->other_actions = array();
        // $this->add_other_action ("Seleccione una", "");

		//INICIO LA CONEXIÓN A LA BASE DE DATOS
		$this->conn = DbConnection::connect();

        // Instancio el objeto de navegacion
        $this->navigation = new CNavigation ($this->conn);
        
        // Instancio el objero Form
        $this->form = new CForm($this->conn);

        // Para el multi-idioma
        $this->layout->assign('languages', $languages);
        $this->layout->assign('language_selected', $_SESSION["lang"]);

        //para saber los alquileres activos
        require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Alquiler.php");
        $Alquiler = new Alquiler($this->conn);
        $filtros = array();
        anade_filtrado($filtros, "fecha_fin_alquiler", "null", "is");
         
        $ack_alquileres = $Alquiler->get_alquileres($filtros);
         
        //para saber los alquileres activos
        require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Incidencia.php");
        $Incidencia = new Incidencia($this->conn);
        $filtros = array();
        anade_filtrado($filtros, "estado", "3", "!=");
         
        $ack_incidencias = $Incidencia->get_incidencias($filtros); 
         
        //asocio las variables a la vista
        $this->layout->assign("alquilados", sizeof($ack_alquileres->datos));
        $this->layout->assign("incidencias_n", sizeof($ack_incidencias->datos));
        
        $this->layout->assign('id_usuario', $_SESSION['mi_usuario']->id_usuario);
       	$this->layout->assign('nombre', $_SESSION['mi_usuario']->nombre);
        
        $num_incidencias = array(1=>0,2=>0,3=>0,4=>0);
        if($ack_incidencias->resultado){
	        foreach($ack_incidencias->datos as $incidencia){
	        	$num_incidencias[$incidencia->tipo]++;
	        }
        }
        
        $this->layout->assign("incidencia_array", $num_incidencias);
        
        // 
        $this->uri = $this->navigation->get_url_fija();
        $this->layout->assign('uri', $this->uri);
        $this->layout->assign('tab', $_REQUEST["tab"]);

        // print_r(get_class_methods ( "CNavigation" ));

        //esto sirve para saber en que url estoy, porque guardo una variable en sesión que tengo que eliminar si no estoy en la url que necesito
        $query = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null;
        $url = !empty($query) ? "$host$self?$query" : "http://$host$self";
    }
    
    function display ($tmpl){
    	global $environment;
    	
        // Desconecto antes de pintar
    	$this->conn->disconnect();

        global $_SESSION;
        $this->layout->assign('USUARIO_SESION', $_SESSION["USUARIO"]);
            
        if(trim($_SESSION['EXPIRATION_TEXT'])!=""){
            $ack = new ACK();
            $ack->resultado = false;
            $ack->mensaje   = $_SESSION['EXPIRATION_TEXT']  ;

            $this->add_notification($ack);
        }
    	
    	// Proceso las notificaciones antes de terminar
    	$this->notifications ();

        // Si hay paginador se calculara
        if($this->enable_pagination==true){
            $this->navigation->total_lines = $this->total_lines;
            $this->layout->assign('paginator', __($this->navigation->paginator()) );
        }
		
        if($this->form->form_enabled == true ){
        	$this->layout->assign('form', __($this->form->display_form()) );
        }
        
        // Envio al template las acciones
        $this->layout->assign('actions', $this->actions);
        $this->layout->assign('other_actions', $this->other_actions);

        // Envio a la plantilla datos comunes
        global $environment;
        $this->layout->assign('environment', $environment);
        $this->layout->assign('controller', $this->controller);
        $this->layout->assign('action', $this->action);

        $this->layout->display($this->layout->template_dir[0].$tmpl);
    }
	
    function notifications (){
    	global $_SESSION;
    	
    	if ( isset ( $_SESSION['notificaciones'] ) ) {
			//creo un array para smarty
			$notificaciones = array();
			
		 	//recorro todas
		 	foreach( $_SESSION['notificaciones'] as $noticia){
		 		$notificacion = new stdClass();
		 		
		 		//si el resultado del ack es true no hay error
		 		if($noticia->resultado == true){
                    if($noticia->mensaje==""){
                        $noticia->mensaje = 'Datos actualizados correctamente';
                    }
		 			$notificacion->error = 0;
		 			$notificacion->mensaje = $noticia->mensaje;
		 		}else{
		 			$notificacion->error = 1;
		 			$notificacion->mensaje = $noticia->mensaje;
		 		}
		 		//meto la notificacion en el array de notificaciones
		 		array_push($notificaciones, $notificacion);
		 	}
            
            $html_text = '
                <script type="text/javascript">
                    $(document).ready(function(){';

                        foreach($notificaciones as $cid=>$notificacion){
                            $notificacion->mensaje = $notificacion->mensaje;
                            $html_text .= 'notificacion("'.__($notificacion->error).'","'.__($notificacion->mensaje).'");';
                        }
            $html_text .= '});
                </script>';

            //asigno la variable a smarty
		 	$this->layout->assign("notifications",__($html_text));
		 	
			//al terminar elimino la variable de sessión
			unset ( $_SESSION['notificaciones'] ); 
		}
    }

    function add_action ($cmd, $source, $javascript=false, $js_params="", $validators=""){
        if($javascript==true){
            $this->actions[$cmd] = new stdClass();
            $this->actions[$cmd]->javascript = true;
            $this->actions[$cmd]->source     = $source;
            $this->actions[$cmd]->js_params  = $js_params;
            $this->actions[$cmd]->validators = $validators;
        } else {
        	$this->actions[$cmd] = new stdClass();
            $this->actions[$cmd]->source     = $source;
            $this->actions[$cmd]->validators = $validators;
        }
    }

    function add_other_action ($cmd, $source){
        $this->other_actions[$source] = $cmd;
    }

    function add_notification($ack){
        // Comprovamos si existe la variable, si existe añadimos la nueva notificacion
        if ( isset ( $_SESSION['notificaciones'] ) ) {
            array_push($_SESSION['notificaciones'],$ack);
        } else {
        // Si no existe , creamos la variable (la cual borramos si no hay notifiaciones)
            $_SESSION['notificaciones'] = array ();
            //añadimos la notificacion
            array_push($_SESSION['notificaciones'],$ack);
        }
    }

    function mobile_detection (){
        global $_SERVER;
        
        $pattern = "/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i";

        $res = preg_match($pattern, $_SERVER["HTTP_USER_AGENT"]);
        return $res;
    }

    function throw_error ($message=null){
        $this->layout = new smartyML("es"); 

        $this->layout->template_dir = $_SERVER["DOCUMENT_ROOT"].'/tpl_guest/';
        $this->layout->compile_dir  = $_SERVER["DOCUMENT_ROOT"].'/tmp/templates_c/'; 
        $this->layout->config_dir   = $_SERVER["DOCUMENT_ROOT"].'/tmp/configs/'; 
        $this->layout->cache_dir    = $_SERVER["DOCUMENT_ROOT"].'/tmp/cache/';

        $ack = new ACK();
        $ack->resultado = false;
        if($message!=null){
            $ack->mensaje   = $message;
        } else {
            $ack->mensaje   = "Se ha producido un error en la aplicación, pruebe mas tarde";
        }

        $this->layout->assign('ack', $ack);
        $this->layout->display($this->layout->template_dir[0]."common/error.tpl");

        exit;
    }
}
?>