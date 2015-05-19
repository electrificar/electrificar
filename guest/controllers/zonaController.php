<?php
	class zonaController extends CController{
        
		/**
		 * Sección de listado de vehículos
		 */
        function list_zonas(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Zona.php");
        	$zona = new Zona($this->conn);
        	
        	$filtros = array();
        	
        	//obtengo los vehículos
        	$ack_zonas = $zona->get_zonas($filtros);
        	
        	//si hay
        	if($ack_zonas->resultado){
        		//me guardo esa parte
        		$zonas = $ack_zonas->datos;
        	}else{
        		$zonas = array();
        	}
        	
        	//recorro cada vehículo
        	foreach($zonas as $zona){
        		
        	}
        	
        	//asocio las variables a la vista
        	$this->layout->assign("zonas", $zonas);
        	$this->layout->assign("zone", "active");
        	
        	//cargo la vista
            $this->display('/zonas/list.tpl');
        }       
        
        function list_plug(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/zona.php");
        	
        	$zona = new zona($this->conn);
        	
        	$filtros = array();
        	anade_filtrado($filtros, "id_zona", $_REQUEST['id_zona'], "=");
        	
        	//si viene que apliquemos filtros
        	if(isset($_REQUEST['filtrar'])){

        		//por si hay que filtrar por matricula
        		if($_REQUEST['direccion']){
        			anade_filtrado($filtros, "direccion", $_REQUEST['direccion'], "like");
        		}
        		
        		//filtro por disponibilidad
        		if($_REQUEST['disponible'] == 'on'){
        			anade_filtrado($filtros, "disponible", 1, "=");
        		}
        		
        		//filtro por mantenimiento
        		if($_REQUEST['ocupado'] == 'on'){
        			anade_filtrado($filtros, "ocupado", 1, "=");
        		}
        	}
        	
        	$ack_pc = $zona->get_puntos_carga($filtros);
        	
        	if($ack_pc->resultado){
        		$puntos_carga = $ack_pc->datos;
        	}else{
        		$puntos_carga = array();
        	}
        	
        	
        	$this->layout->assign("filtros", $_REQUEST);
        	$this->layout->assign("id_zona", $_REQUEST['id_zona']);
        	$this->layout->assign("puntos_carga", $puntos_carga);
        	//si todo sale bien o es un nuevo vehículo
        	$this->layout->assign("zone", "active");//variable de activación de menú
        	$this->display('/puntos_carga/list.tpl');//cargo la vista
        }
        
	}
?>