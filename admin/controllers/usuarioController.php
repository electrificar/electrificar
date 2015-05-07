<?php
	class usuarioController extends CController{
        
		/**
		 * Sección de listado de vehículos
		 */
        function list_users(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Usuario.php");
        	$Usuario = new Usuario($this->conn);
        	
        	$filtros = array();
        	anade_filtrado($filtros, "tipo", $_REQUEST['type_user'], "=");
        	
        	//si viene que apliquemos filtros
        	if(isset($_REQUEST['filtrar'])){

        		//por si hay que filtrar por matricula
        		if($_REQUEST['nif']){
        			anade_filtrado($filtros, "nif", $_REQUEST['nif'], "like");
        		}
        		
        		//por si hay que filtrar por matricula
        		if($_REQUEST['nombre']){
        			anade_filtrado($filtros, "CONCAT(`nombre`, ' ', `apellido1`)", $_REQUEST['nombre'], "like");
        		}
        		
        		//por si hay que filtrar por matricula
        		if($_REQUEST['email']){
        			anade_filtrado($filtros, "email", $_REQUEST['email'], "like");
        		}
        		
        		//filtro por disponibilidad
        		if($_REQUEST['activacion'] == 'on'){
        			anade_filtrado($filtros, "activacion", 1, "=");
        		}else{
        			anade_filtrado($filtros, "activacion", 0, "=");
        		}
        		
        	}
        	
        	$ack_usuarios = $Usuario->get_usuario($filtros);
        	
        	if($ack_usuarios->resultado){
        		$usuarios = $ack_usuarios->datos;
        	}
        	
        	$this->layout->assign("filtros", $_REQUEST);
        	$this->layout->assign("usuarios", $usuarios);
        	$this->layout->assign("users", "active");
        	$this->layout->assign($_REQUEST['label_user'], "bg-success");
        	$this->layout->assign("label_type_user", $_REQUEST['label_user']);
        	$this->layout->assign("type_user", $_REQUEST['type_user_label']);
        	//cargo la vista
            $this->display('/user/list.tpl');
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