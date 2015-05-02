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
        
        /**
         * 
         * Formulario de adición/modificación de vehículo
         */
        function frm_zona(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/zona.php");
        	$zona = new zona($this->conn);
        	
        	//si viene id_zona es que estoy editando
        	if(isset($_REQUEST['id_zona'])){
        		
        		//filtro el vehículo para encontrarlo
	        	$filtros = array();       
	        	anade_filtrado($filtros, "id_zona", $_REQUEST['id_zona'], "=");
	        	$ack_zonas = $zona->get_zonas($filtros);
	        	
	        	//si lo encuentro
	        	if($ack_zonas->resultado){
	        		//me guardo el vehículo y parseo la fecha
	        		$zona 				= $ack_zonas->datos[0];
	        		$coordenadas 		= explode("|", $zona->coordenadas_poligono);
	        		$coordenadas_mapa 	= explode(",", $coordenadas[0]);
	        		$zona->longitud 	= $coordenadas_mapa[1];
	        		$zona->latitud  	= $coordenadas_mapa[0];
	        		$zona->coordenadas 	= $coordenadas[1];
	        		
	        		$coord_limpias = str_replace(array("[","]"), array("",""), $coordenadas[1]);
	        		
	        		$coord_limpias = explode(",", $coord_limpias);
	        		
	        		$zona->latitudes  = array();
	        		$zona->longitudes = array(); 
	        		foreach($coord_limpias as $key=>$coor){
	        			if($key%2==0){
	        				$zona->latitudes[]  = $coor;
	        			}else{
	        				$zona->longitudes[] = $coor;
	        			}
	        		}
	        		
	        	}else{
	        		//si no lo encuentro, genero una notificacion
	        		$ack_zonas = new ACK();
	        		$ack_zonas->resultado = false;
	        		$ack_zonas->mensaje	  = "La Zona indicada no existe";
	        		
	        		//la añado
	        		$this->add_notification($ack_zonas);
	        		
	        		//redirijo el listado
	        		header("location: /admin/zonas/");
	        		die();
	        	}        	
	        	
	        	$this->layout->assign("zona", $zona);
        	}
        	
        	//si todo sale bien o es un nuevo vehículo
        	$this->layout->assign("zone", "active");//variable de activación de menú
        	$this->display('/zonas/frm_zona.tpl');//cargo la vista
        }
        
        function update_zona(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/zona.php");
        	
        	$zona = new Zona($this->conn);
        	
        	$prepath = "";
        	
	        for($i = 0; $i<sizeof($_REQUEST['logintudes']); $i++){
	            $prepath .= "[".$_REQUEST['latitudes'][$i].", ".$_REQUEST['logintudes'][$i]."]";
	            if($i!=(sizeof($_REQUEST['logintudes'])-1)){
	          	  $prepath .= ",";
	            }
	        }
	
	        $_REQUEST['coordenadas_poligono'] = $_REQUEST['latitud'].", ".$_REQUEST['longitud']."|"."[".$prepath."]";
	        $_REQUEST['num_puntos_carga']	  = $zona->getTotalPuntosCarga($_REQUEST['id_zona']);
	        $_REQUEST['num_vehiculos_zona']   = $zona->getTotalVehiculos($_REQUEST['id_zona']);
	        
	        
        	//inserto/actualizo en base de datos
        	$ackzona = $zona->update_zona($_REQUEST);
        	
        	//añado una notificacion
        	$this->add_notification($ackzona);
        	
        	//redirijo
        	header("location: /admin/zonas/");
        	die();
        }
        
        function delete_zona(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/zona.php");
        	
        	$zona = new zona($this->conn);
        	
        	//borro el vehículo
        	$ack_borrado = $zona->remove_vehicle($_REQUEST['id_zona']);
        	
        	//añado notificación
        	$this->add_notification($ack_borrado);
        	
        	//redirijo
        	header("location: /admin/zonas/");
        	die();
        }
	}
?>