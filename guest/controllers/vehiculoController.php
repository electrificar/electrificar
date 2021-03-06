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
        		if($_REQUEST['marca']){
        			anade_filtrado($filtros, "marca", $_REQUEST['marca'], "like");
        		}
        		
        		//filtro por disponibilidad
        		if($_REQUEST['zona'] == 'on'){
        			anade_filtrado($filtros, "disponible", 1, "=");
        		}else{
        			anade_filtrado($filtros, "disponible", 0, "=");
        		}
        		
        		//por si hay que filtrar por zona
        		if($_REQUEST['zona']){
        			anade_filtrado($filtros, "zona", $_REQUEST['zona'], "like");
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
            $this->display('/vehicle/list.tpl');
        }
        function frm_rental(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Vehiculo.php");
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Zona.php");
        	
        	$Vehiculo 	= new Vehiculo($this->conn);
        	$Zona		= new Zona($this->conn);
        	
        	//si viene id_alquiler es que estoy editando
        	if(isset($_REQUEST['id_alquiler'])){
        		
        		//filtro el vehículo para encontrarlo
	        	$filtros = array();       
	        	anade_filtrado($filtros, "id_alquiler", $_REQUEST['id_alquiler'], "=");
	        	$ack_alquileres = $Vehiculo->get_alquileres($filtros);
	        	
	        	//si lo encuentro
	        	if($ack_alquileres->resultado){
	        		//me guardo el vehículo y parseo la fecha
	        		$alquiler = $ack_alquileres->datos[0];
	        		$alquiler->fecha_vigencia_seguro = convertir_fecha_espanol($alquiler->fecha_vigencia_seguro);
	        	}else{
	        		//si no lo encuentro, genero una notificacion
	        		$ack_alquileres = new ACK();
	        		$ack_alquileres->resultado = false;
	        		$ack_alquileres->mensaje	  = "El alquiler indicado no existe";
	        		
	        		//la añado
	        		$this->add_notification($ack_alquileres);
	        		
	        		//redirijo el listado
	        		header("location: /admin/alquileres/");
	        		die();
	        	}        	
	        	
	        	$this->layout->assign("alquiler", $alquiler);
        	}
        	
			$Zona = new Zona($this->conn);
	
			$filtros = array();
			
			//obtengo los vehículos
			$ack_zona = $Zona->get_zonas($filtros);
			 
			//si hay
			if($ack_zona->resultado){
				//me guardo esa parte
				$tarifas = $ack_tarifas->datos;
			}else{
				$tarifas = array();
			}
			 
			//asocio las variables a la vista
			$this->layout->assign("zonas", $zonas);
        	//si todo sale bien o es un nuevo vehículo
        	$this->layout->assign("rental", "active");//variable de activación de menú
        	$this->display('/rental/frm_rental.tpl');//cargo la vista
        }
	}
?>