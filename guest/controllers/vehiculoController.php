<?php
	class vehiculoController extends CController{
        
		function search_vehicle(){
			require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Vehiculo.php");
        	$Vehiculo = new Vehiculo($this->conn);
        	
        	$filtros=array();
        	anade_filtrado($filtros, "CONCAT(`modelo`, ' ', `marca`, ' ', `matricula`)", $_REQUEST['q'], "like");
        	anade_filtrado($filtros, "disponible", 1, "="); //coches disponibles
        	anade_filtrado($filtros, "mantenimiento", 0, "="); //que no estén en mantenimiento
        	
			$ack_vehiculos = $Vehiculo->get_vehiculos($filtros);
			
        	if($ack_vehiculos->resultado){
        		$res_vehiculos = $ack_vehiculos->datos;
        		
        		$vehiculos = array();
        		foreach($res_vehiculos as $key=>$vehiculo){
        			$vehiculos[$key] 	 	 = array();
        			$vehiculos[$key]['id_vehiculo'] 	= $vehiculo->id_vehiculo;
        			$vehiculos[$key]['imagen'] 	 		= "/repositorio/".$vehiculo->imagen;
        			$vehiculos[$key]['nombre'] 	 		= $vehiculo->marca." ".$vehiculo->modelo;
        			$vehiculos[$key]['matricula'] 	 	= $vehiculo->matricula;
        			$vehiculos[$key]['fecha_permiso']	= convertir_fecha_espanol($vehiculo->fecha_vigencia_seguro);
	        		
        			//carga simulada
	        		$vehiculos[$key]['porcentaje_carga'] = rand(0, 100)."%";
	        		if($vehiculos[$key]['porcentaje_carga'] < 100 and $vehiculos[$key]['porcentaje_carga'] >75){
	        			$vehiculos[$key]['carga'] = "bg-success";
	        		}else if($vehiculos[$key]['porcentaje_carga'] < 75 and $vehiculos[$key]['porcentaje_carga'] >50){
	        			$vehiculos[$key]['carga'] = "bg-info";
	        		}else if($vehiculos[$key]['porcentaje_carga'] < 50 and $vehiculos[$key]['porcentaje_carga'] >25){
	        			$vehiculos[$key]['carga'] = "bg-warning";
	        		}else if($vehiculos[$key]['porcentaje_carga'] < 25 and $vehiculos[$key]['porcentaje_carga'] >0){
	        			$vehiculos[$key]['carga'] = "bg-danger";
	        		}
        		}
        	}else{
        		$vehiculos = array();
        	}
        	
        	print_r(json_encode($vehiculos));
		}
		
		/**
		 * Sección de listado de vehículos
		 */
        function list_vehicles(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Vehiculo.php");
        	$Vehiculo = new Vehiculo($this->conn);
        	
        	//filtros a aplicar
        	$filtros = array();       
        	
        	//si viene que apliquemos filtros
        	if(isset($_REQUEST['filtrar'])){

        		//por si hay que filtrar por matricula
        		if($_REQUEST['matricula']){
        			anade_filtrado($filtros, "matricula", $_REQUEST['matricula'], "like");
        		}
        		
        		//filtro por disponibilidad
        		if($_REQUEST['disponible'] == 'on'){
        			anade_filtrado($filtros, "disponible", 1, "=");
        		}else{
        			anade_filtrado($filtros, "disponible", 0, "=");
        		}
        		
        		//filtro por mantenimiento
        		if($_REQUEST['mantenimiento'] == 'on'){
        			anade_filtrado($filtros, "mantenimiento", 1, "=");
        		}else{
        			anade_filtrado($filtros, "mantenimiento", 0, "=");
        		}
        	}
        	
        	//obtengo los vehículos
        	$ack_vehiculos = $Vehiculo->get_vehiculos($filtros);
        	
        	//si hay
        	if($ack_vehiculos->resultado){
        		//me guardo esa parte
        		$vehiculos = $ack_vehiculos->datos;
        	}else{
        		$vehiculos = array();
        	}
        	
        	//recorro cada vehículo
        	foreach($vehiculos as $vehicle){
        		$date1 = new DateTime("now");
        		$date2 = new DateTime($vehicle->fecha_vigencia_seguro);
        		
        		//calculo si el seguro está en vigor
        		$vehicle->seguro_pasado 		= ($date1 > $date2)?true:false; 
        		$vehicle->fecha_vigencia_seguro = convertir_fecha_espanol($vehicle->fecha_vigencia_seguro);
        		
        		//carga simulada
        		$vehicle->porcentaje_carga = rand(0, 100)."%";
        		if($vehicle->porcentaje_carga < 100 and $vehicle->porcentaje_carga >75){
        			$vehicle->carga = "success";
        		}else if($vehicle->porcentaje_carga < 75 and $vehicle->porcentaje_carga >50){
        			$vehicle->carga = "info";
        		}else if($vehicle->porcentaje_carga < 50 and $vehicle->porcentaje_carga >25){
        			$vehicle->carga = "warning";
        		}else if($vehicle->porcentaje_carga < 25 and $vehicle->porcentaje_carga >0){
        			$vehicle->carga = "danger";
        		}
        	}
        	
        	$this->layout->assign("filtros", $_REQUEST);
        	$this->layout->assign("vehicles", $vehiculos);
        	$this->layout->assign("vehicle", "active");
        	
        	//cargo la vista
            $this->display('/rent/frm_select_car.tpl');
        }
        
        /**
         * 
         * Formulario de adición/modificación de vehículo
         */
        function frm_vehicle(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Vehiculo.php");
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Zona.php");
        	$Vehiculo = new Vehiculo($this->conn);
        	$Zona	  = new Zona($this->conn);
        	
        	//si viene id_vehiculo es que estoy editando
        	if(isset($_REQUEST['id_vehiculo'])){
        		
        		//filtro el vehículo para encontrarlo
	        	$filtros = array();       
	        	anade_filtrado($filtros, "id_vehiculo", $_REQUEST['id_vehiculo'], "=");
	        	$ack_vehiculos = $Vehiculo->get_vehiculos($filtros);
	        	
	        	//si lo encuentro
	        	if($ack_vehiculos->resultado){
	        		//me guardo el vehículo y parseo la fecha
	        		$vehiculo = $ack_vehiculos->datos[0];
	        		$vehiculo->fecha_vigencia_seguro = convertir_fecha_espanol($vehiculo->fecha_vigencia_seguro);
	        	}else{
	        		//si no lo encuentro, genero una notificacion
	        		$ack_vehiculos = new ACK();
	        		$ack_vehiculos->resultado = false;
	        		$ack_vehiculos->mensaje	  = "El vehículo indicado no existe";
	        		
	        		//la añado
	        		$this->add_notification($ack_vehiculos);
	        		
	        		//redirijo el listado
	        		header("location: /admin/vehiculos/");
	        		die();
	        	}        	
	        	
	        	$this->layout->assign("vehiculo", $vehiculo);
        	}
        	
        	$ack_zonas = $Zona->get_zonas(array());
        	
        	if($ack_zonas->resultado){
        		$this->layout->assign("zonas", $ack_zonas->datos);//variable de activación de menú	
        	}else{
        		$this->layout->assign("zonas", array());//variable de activación de menú
        	}
        	
        	//si todo sale bien o es un nuevo vehículo
        	$this->layout->assign("vehicle", "active");//variable de activación de menú
        	$this->display('/vehicle/frm_vehicle.tpl');//cargo la vista
        }
        
        function update_vehicle(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Vehiculo.php");
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Zona.php");
        	$Vehiculo = new Vehiculo($this->conn);
        	$zona	  = new Zona($this->conn);
        	
        	//parseo la fecha a ingles
        	$_REQUEST['fecha_vigencia_seguro'] = convertir_fecha_ingles($_REQUEST['fecha_vigencia_seguro']);
        	
        	//si no viene mantenimiento es que lo han desactivado
        	if(!isset($_REQUEST['mantenimiento'])){
        		$_REQUEST['mantenimiento'] = '0';
        	}else{
        		$_REQUEST['mantenimiento'] = '1';
        	}
        	
        	//si no viene la disponibilidad es que lo han desactivado
        	if(!isset($_REQUEST['disponible'])){
        		$_REQUEST['disponible'] = '0';
        	}else{
        		$_REQUEST['disponible'] = '1';
        	}
        	
        	//si viene imagen, guardo
        	if(isset($_FILES['imagen']) && $_FILES['imagen']['name']!=null){
        		$_REQUEST['imagen'] = uploadFile($_FILES['imagen']);
        	}
        	
        	if($_REQUEST['id_vehiculo'] == ''){
        		unset($_REQUEST['id_vehiculo']);
        	}
        	
        	//inserto/actualizo en base de datos
        	$ackVehiculo = $Vehiculo->update_vehiculo($_REQUEST);
        	
        	//añado una notificacion
        	$this->add_notification($ackVehiculo);
        	
        	//actualizo la zona
        	$datosZona = array();
        	$datosZona['id_zona'] 			   = $_REQUEST['id_zona'];
        	$datosZona['num_vehiculos_zona']   = $zona->getTotalVehiculos($_REQUEST['id_zona']);
        	
        	$ack_zona = $zona->update_zona($datosZona);
        	
        	//redirijo
        	header("location: /admin/vehiculos/");
        	die();
        }
        
        function delete_vehicle(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Vehiculo.php");
        	
        	$Vehiculo = new Vehiculo($this->conn);
        	
        	//borro el vehículo
        	$ack_borrado = $Vehiculo->remove_vehicle($_REQUEST['id_vehiculo']);
        	
        	//añado notificación
        	$this->add_notification($ack_borrado);
        	
        	//redirijo
        	header("location: /admin/vehiculos/");
        	die();
        }
	}
?>