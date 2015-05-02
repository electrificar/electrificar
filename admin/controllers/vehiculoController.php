<?php
	class vehiculoController extends CController{
        
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
        	
        	//asocio las variables a la vista
        	$this->layout->assign("filtros", $_REQUEST);
        	$this->layout->assign("vehicles", $vehiculos);
        	$this->layout->assign("vehicle", "active");
        	
        	//cargo la vista
            $this->display('/vehicle/list.tpl');
        }
        
        /**
         * 
         * Formulario de adición/modificación de vehículo
         */
        function frm_vehicle(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Vehiculo.php");
        	$Vehiculo = new Vehiculo($this->conn);
        	
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
        	
        	//si todo sale bien o es un nuevo vehículo
        	$this->layout->assign("vehicle", "active");//variable de activación de menú
        	$this->display('/vehicle/frm_vehicle.tpl');//cargo la vista
        }
        
        function update_vehicle(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Vehiculo.php");
        	
        	$Vehiculo = new Vehiculo($this->conn);
        	
        	//parseo la fecha a ingles
        	$_REQUEST['fecha_vigencia_seguro'] = convertir_fecha_ingles($_REQUEST['fecha_vigencia_seguro']);
        	
        	//si no viene mantenimiento es que lo han desactivado
        	if(!isset($_REQUEST['mantenimiento'])){
        		$_REQUEST['mantenimiento'] = '\0';
        	}
        	
        	//si no viene la disponibilidad es que lo han desactivado
        	if(!isset($_REQUEST['disponible'])){
        		$_REQUEST['disponible'] = '\0';
        	}
        	
        	//si viene imagen, guardo
        	if(isset($_FILES['imagen']) && $_FILES['imagen']['name']!=null){
        		$_REQUEST['imagen'] = uploadFile($_FILES['imagen']);
        	}
        	
        	//inserto/actualizo en base de datos
        	$ackVehiculo = $Vehiculo->update_vehiculo($_REQUEST);
        	
        	//añado una notificacion
        	$this->add_notification($ackVehiculo);
        	
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