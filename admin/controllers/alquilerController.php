<?php
	class alquilerController extends CController{
		function stop_rental(){
			require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Alquiler.php");
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Vehiculo.php");
        	$Alquiler = new Alquiler($this->conn);
        	$Vehiculo = new Vehiculo($this->conn);
        	
			$_REQUEST['fecha_fin_alquiler'] = date("Y-m-d H:i:s");
        	$_REQUEST['id_alquiler']		= intval($_REQUEST['id_alquiler']);
			
        	$ack_alquiler = $Alquiler->update_alquiler($_REQUEST);
        	
        	$this->add_notification($ack_alquiler);
        	
        	//si puedo finalizar correctamente el alquiler
        	if($ack_alquiler->resultado){
        		//desbloqueo el coche
        		$filtros = array();
        		anade_filtrado($filtros, "id_alquiler", $_REQUEST['id_alquiler'], "=");
        		
        		$ack_alquiler = $Alquiler->get_alquileres($filtros);
        		
        		$alquiler = $ack_alquiler->datos[0];
        		
        		$datos_vehiculo = array();
        		$datos_vehiculo['id_vehiculo'] 	= $alquiler->id_vehiculo;
        		$datos_vehiculo['disponible'] 	= 1;
        		
        		$Vehiculo->update_vehiculo($datos_vehiculo);
        	}
        	
        	header("location: /admin/alquileres/");
        	die();
		}
		
        function rent_car(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Alquiler.php");
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Vehiculo.php");
        	$Alquiler = new Alquiler($this->conn);
        	$Vehiculo = new Vehiculo($this->conn);
        	
        	//bloqueo coche
        	$_REQUEST['disponible'] = 0;
       		
        	$Vehiculo->update_vehiculo($_REQUEST);
        	
        	if(!isset($_REQUEST['id_alquiler'])){
        		$_REQUEST['id_alquiler'] = null;
        	}
        	
        	
        	$ack_alquiler = $Alquiler->update_alquiler($_REQUEST);
        	
        	//si falla el alquiler, desbloqueo el coche
        	if(!$ack_alquiler->resultado){
	        	//bloqueo coche
	        	$_REQUEST['disponible'] = 1;
	       		
	        	$Vehiculo->update_vehiculo($_REQUEST);
        	}
        	
        	$this->add_notification($ack_alquiler);
        	
        	header("location: /admin/alquileres/");
        	die();
        }
        
		/**
		 * Sección de listado de vehículos
		 */
        function list_rentals(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Alquiler.php");
        	$Alquiler = new Alquiler($this->conn);
        	
        	//filtros a aplicar
        	$filtros = array();       
        	
        	//si viene que apliquemos filtros
        	if(isset($_REQUEST['filtrar'])){
        		//por si hay que filtrar por matricula
        		if($_REQUEST['usuario_nif']){
        			anade_filtrado($filtros, "usuario.nif", $_REQUEST['usuario_nif'], "like");
        		}        		
        		//por si hay que filtrar por matricula
        		if($_REQUEST['usuario_nombre']){
        			anade_filtrado($filtros, "CONCAT(usuario.nombre, ' ', usuario.apellido1)", $_REQUEST['usuario_nombre'], "like");
        		}
        		//por si hay que filtrar por email
        		if($_REQUEST['usuario_email']){
        			anade_filtrado($filtros, "usuario.email", $_REQUEST['usuario_email'], "like");
        		}
        		//por si hay que filtrar por matricula
        		if($_REQUEST['vehiculo_matricula']){
        			anade_filtrado($filtros, "vehiculo.matricula", $_REQUEST['vehiculo_matricula'], "like");
        		}
        	}
        	
        	//obtengo los vehículos
        	$ack_alquileres = $Alquiler->get_alquileres($filtros);
        	
        	//si hay
        	if($ack_alquileres->resultado){
        		//me guardo esa parte
        		$alquileres = $ack_alquileres->datos;
        	}else{
        		$alquileres = array();
        	}
        	
        	//recorro cada alquiler
        	$num_alquilados = 0;
        	foreach($alquileres as $rental){
        		if($rental->fecha_fin_alquiler == ""){
        			$num_alquilados++;
        		}
        		$rental->fecha_inicio_alquiler = convertir_fecha_espanol_completa($rental->fecha_inicio_alquiler);
        		$rental->fecha_fin_alquiler = convertir_fecha_espanol_completa($rental->fecha_fin_alquiler);
        		$rental->nombre_usuario 	= $rental->{8}." ".$rental->{9};
        		$rental->imagen_usuario 	= $rental->{16};
        		$rental->imagen_vehiculo 	= $rental->{39};
        		$rental->nombre_tarifa 		= $rental->{28};
        	}
        	
        	//asocio las variables a la vista
        	$this->layout->assign("num_alquileres", $num_alquilados);
        	$this->layout->assign("filtros", $_REQUEST);
        	$this->layout->assign("rentals", $alquileres);
        	$this->layout->assign("rental", "active");
        	
        	//cargo la vista
            $this->display('/rental/list.tpl');
        }
        
        /**
         * 
         * Formulario de adición/modificación de vehículo
         */
        function frm_rental(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Usuario.php");
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Vehiculo.php");
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Tarifa.php");
        	
        	$Vehiculo 	= new Vehiculo($this->conn);
        	$Usuario	= new Usuario($this->conn);
        	$Tarifa		= new Tarifa($this->conn);
        	
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
        	
			$Tarifa = new Tarifa($this->conn);
	
			$filtros = array();
			
			//obtengo los vehículos
			$ack_tarifas = $Tarifa->get_tarifas($filtros);
			 
			//si hay
			if($ack_tarifas->resultado){
				//me guardo esa parte
				$tarifas = $ack_tarifas->datos;
			}else{
				$tarifas = array();
			}
			 
			//asocio las variables a la vista
			$this->layout->assign("tarifas", $tarifas);
        	//si todo sale bien o es un nuevo vehículo
        	$this->layout->assign("rental", "active");//variable de activación de menú
        	$this->display('/rental/frm_rental.tpl');//cargo la vista
        }
	}
?>