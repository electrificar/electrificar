<?php
	class incidenciaController extends CController{
        
		/**
		 * Sección de listado de vehículos
		 */
        function list_incidencias(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Incidencia.php");
			require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Usuario.php");
			$Usuario = new Usuario($this->conn);
        	$incidencia = new Incidencia($this->conn);
			
			$filtros = array();
				anade_filtrado($filtros, "tipo", 2, "=");//colaborador es tipo usuario 2
				 
				$ack_usuarios = $Usuario->get_usuario($filtros);
				
				if($ack_usuarios->resultado){
					$usuarios = $ack_usuarios->datos;
					 
					foreach($usuarios as $usuario){
						$ack_colaborador = $Usuario->getColaborador ( $usuario->id_usuario );
						if ($ack_colaborador->resultado) {
							$colaborador = $ack_colaborador->datos [0];
							$usuario->id_colaborador = $colaborador->id_colaborador;
							$usuario->tipo_colaborador = $tipo_colaboradores [$colaborador->tipo_colaborador] ['tipo'];
							$usuario->descripcion = $colaborador->descripcion;
							$usuario->empresa = $empresas [$colaborador->empresa] ['empresa'];
						}
					}
				}
				 
			$this->layout->assign("colaboradores", $usuarios);
			
        	$filtros = array();
        	anade_filtrado($filtros, "tipo", $_REQUEST['type_incidence'], "=");
        	
        	//si viene que apliquemos filtros
        	if(isset($_REQUEST['filtrar'])){

        		//por si hay que filtrar por matricula
        		if($_REQUEST['asunto']){
        			anade_filtrado($filtros, "asunto", $_REQUEST['asunto'], "like");
        		}
        		
        		//por si hay que filtrar por matricula
        		if($_REQUEST['descripcion']){
        			anade_filtrado($filtros, "descripcion", $_REQUEST['descripcion'], "like");
        		}
        		
        		//por si hay que filtrar por matricula
        		if($_REQUEST['estado']){
        			anade_filtrado($filtros, "estado", $_REQUEST['estado'], "like");
        		}
	
        	}
        	
        	$ack_incidencias = $incidencia->get_incidencias($filtros);
        	
        	if($ack_incidencias->resultado){
        		$incidencias = $ack_incidencias->datos;
        		
        		foreach($incidencias as $incidencia){
        			$incidencia->fecha_inicio_incidencia = convertir_fecha_espanol($incidencia->fecha_inicio_incidencia);
        		}
        	}
        	
        	$this->layout->assign("filtros", $_REQUEST);
        	$this->layout->assign("incidencias", $incidencias);
        	$this->layout->assign($_REQUEST['label_incidence'], "bg-success");
        	$this->layout->assign("label_type_incidence", $_REQUEST['label_incidence']);
        	$this->layout->assign("type_incidence", $_REQUEST['type_incidence_label']);
			$this->layout->assign("incidences", "active");
        	//cargo la vista
            $this->display('/incidencias/list.tpl');
        }
        
        /**
         * 
         * Formulario de adición/modificación de vehículo
         */
        function frm_incidencia(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Incidencia.php");
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Usuario.php");
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Vehiculo.php");
        	$Vehiculo = new Vehiculo($this->conn);
        	$Usuario = new Usuario($this->conn);
        	$incidencia = new Incidencia($this->conn);
        	
        	global $estados;
			
        	//busco los colaboradores
        	$filtros = array();
        	anade_filtrado($filtros, "tipo", 2, "=");//colaborador es tipo usuario 2
        	
        	$ack_usuarios = $Usuario->get_usuario($filtros);
        	 
        	if($ack_usuarios->resultado){
        		$usuarios = $ack_usuarios->datos;
        	
        		foreach($usuarios as $usuario){
        			$ack_colaborador = $Usuario->getColaborador ( $usuario->id_usuario );
					if ($ack_colaborador->resultado) {
						$colaborador = $ack_colaborador->datos [0];
						$usuario->id_colaborador = $colaborador->id_colaborador;
						$usuario->tipo_colaborador = $tipo_colaboradores [$colaborador->tipo_colaborador] ['tipo'];
						$usuario->descripcion = $colaborador->descripcion;
						$usuario->empresa = $empresas [$colaborador->empresa] ['empresa'];
					}
        		}
        	}
        	
        	$this->layout->assign("colaboradores", $usuarios);
        	
        	$filtros = array();
        	anade_filtrado($filtros, "tipo", 3, "=");//colaborador es tipo usuario 2	
        	
        	$ack_usuarios = $Usuario->get_usuario($filtros);
        	
        	if($ack_usuarios->resultado){
        		$usuarios = $ack_usuarios->datos;
        	}	 

        	$this->layout->assign("usuarios", $usuarios);
        	
        	$filtros = array();
        	anade_filtrado($filtros, "disponible", 1, "=");
        	
        	$ack_vehiculos = $Vehiculo->get_vehiculos($filtros);
        	 
        	if($ack_vehiculos->resultado){
        		$vehiculos = $ack_vehiculos->datos;
        	}
        	
        	$this->layout->assign("vehiculos", $vehiculos);
        	
        	//si viene id_incidencia es que estoy editando
        	if(isset($_REQUEST['id_incidencia'])){
        		
        		//filtro el vehículo para encontrarlo
	        	$filtros = array();       
	        	anade_filtrado($filtros, "id_incidencia", intval($_REQUEST['id_incidencia']), "=");
	        	$ack_incidencia = $incidencia->get_incidencias($filtros);
	        	
// 	        	print_r($_REQUEST['id_incidencia']);
// 	        	exit();
	        	
	        	//si lo encuentro
	        	if($ack_incidencia->resultado){
	        		//me guardo el vehículo y parseo la fecha
	        		$incidencia = $ack_incidencia->datos[0];
	        		
	        		$incidencia->fecha_inicio_incidencia = convertir_fecha_espanol($incidencia->fecha_inicio_incidencia);
	        		$incidencia->fecha_fin_incidencia = convertir_fecha_espanol($incidencia->fecha_fin_incidencia);
	        	}else{

	        		//si no lo encuentro, genero una notificacion
	        		$ack_incidencia = new ACK();
	        		$ack_incidencia->resultado = false;
	        		$ack_incidencia->mensaje	  = "La incidencia indicada no existe";
	        		
	        		//la añado
	        		$this->add_notification($ack_incidencia);
	        		
	        		//redirijo el listado
	        		header("location: /admin/incidencias/".$_REQUEST['type_incidence_label']."/");
	        		die();
	        	}        	
	        	
	        	$this->layout->assign("incidencia", $incidencia);
        	}
        	
        	$this->layout->assign("incidences", "active");
        	$this->layout->assign($_REQUEST['label_incidence'], "bg-success");
        	$this->layout->assign("label_type_incidence", $_REQUEST['label_incidence']);
        	$this->layout->assign("type_incidence", $_REQUEST['type_incidence_label']);
        	$this->layout->assign("type_incidence_id", $_REQUEST['type_incidence']);
        	$this->layout->assign("estados", $estados);
        	//cargo la vista
        	
        	$this->display('/incidencias/frm_incidencia.tpl');
        }
        
        function update_incidencia(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Incidencia.php");
        	$incidencia = new Incidencia($this->conn);
        	
        	//fuerzo el tipo
        	$_REQUEST['tipo'] = $_REQUEST['type_incidence'];
        	
        	if($_REQUEST['id_incidencia'] == ''){
        		unset($_REQUEST['id_incidencia']);
        	}
        	
        	if(isset($_REQUEST['fecha_inicio_incidencia'])){
        		//parseo la fecha a ingles
        		$_REQUEST['fecha_inicio_incidencia'] = convertir_fecha_ingles($_REQUEST['fecha_inicio_incidencia']);
        	}
        	
        	if(isset($_REQUEST['fecha_fin_incidencia']) && $_REQUEST['fecha_fin_incidencia']!=''){
	        	//parseo la fecha a ingles
	        	$_REQUEST['fecha_fin_incidencia'] = convertir_fecha_ingles($_REQUEST['fecha_fin_incidencia']);
        	}else{
        		unset($_REQUEST['fecha_fin_incidencia']);
        	}
        	
        	if($_REQUEST['id_vehiculo'] == ''){
        		unset($_REQUEST['id_vehiculo']);
        	}
        	
        	if($_REQUEST['id_usuario'] == ''){
        		unset($_REQUEST['id_usuario']);
        	}
        	
        	//inserto/actualizo en base de datos
        	$ackIncidencia = $incidencia->update_incidencia($_REQUEST);
        	//añado una notificacion
        	$this->add_notification($ackIncidencia);
        	
        	//redirijo
        	header("location: /admin/incidencias/".$_REQUEST['type_incidence_label']);
        	die();
        }
        
        function change_status(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Incidencia.php");
        	$incidencia = new Incidencia($this->conn);
        	
        	//fuerzo el tipo
        	$_REQUEST['tipo'] = $_REQUEST['type_incidence'];
        	
        	//inserto/actualizo en base de datos
        	$ackIncidencia = $incidencia->update_incidencia($_REQUEST);
        	//añado una notificacion
        	$this->add_notification($ackIncidencia);
        	
        	
        	//redirijo
        	header("location: /admin/incidencias/".$_REQUEST['type_incidence_label']);
        	die();
        }
        
		function validate_incidencia(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Incidencia.php");
        	$incidencia = new Incidencia($this->conn);
        	
        	//fuerzo el tipo
        	$_REQUEST['tipo'] = $_REQUEST['type_incidence'];
        	
        	//inserto/actualizo en base de datos
        	$ackIncidencia = $incidencia->update_incidencia($_REQUEST);
        	//añado una notificacion
        	$this->add_notification($ackIncidencia);
        	
        	
        	//redirijo
        	header("location: /admin/incidencias/".$_REQUEST['type_incidence_label']);
        	die();
        }
        
        function delete_incidencia(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Incidencia.php");
        	 
        	$incidencia = new Incidencia($this->conn);
        	 
        	//borro el vehículo
        	$ack_borrado = $incidencia->remove_incidencia($_REQUEST['id_incidencia']);
        	 
        	//añado notificación
        	$this->add_notification($ack_borrado);
        	 
        	//redirijo
        	header("location: /admin/incidencias/".$_REQUEST['type_incidence_label']."/");
        	die();
        }
        
	}
?>