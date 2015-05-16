<?php
	class incidenciaController extends CController{
        
		/**
		 * Sección de listado de vehículos
		 */
        function list_incidencias(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Incidencia.php");
        	$incidencia = new Incidencia($this->conn);
        	
//         	global $tipo_colaboradores, $empresas; 
        	
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
        		
        		//filtro por disponibilidad
//         		if($_REQUEST['activacion'] == 'on'){
//         			anade_filtrado($filtros, "activacion", 1, "=");
//         		}else{
//         			anade_filtrado($filtros, "activacion", 0, "=");
//         		}
        		
        	}
        	
        	$ack_incidencias = $incidencia->get_incidencia($filtros);
        	
        	if($ack_incidencias->resultado){
        		$incidencias = $ack_incidencias->datos;
        		
        		foreach($incidencias as $incidencia){
        			$incidencia->fecha_inicio_incidencia = convertir_fecha_espanol($incidencia->fecha_inicio_incidencia);
        			
// 	        		if($_REQUEST['type_incidence'] == 2){
// 		        		$ack_colaborador = $Usuario->getColaborador($usuario->id_usuario);
// 		        		if($ack_colaborador->resultado){
// 		        			$colaborador = $ack_colaborador->datos[0];
// 		        			$usuario->id_colaborador 	= $colaborador->id_colaborador;
// 		        			$usuario->tipo_colaborador 	= $tipo_colaboradores[$colaborador->tipo_colaborador]['tipo'];
// 		        			$usuario->descripcion 		= $colaborador->descripcion;
// 		        			$usuario->empresa 			= $empresas[$colaborador->empresa]['empresa'];
// 		        		}
// 		        	}
        		}
        	}
        	
        	$this->layout->assign("filtros", $_REQUEST);
        	$this->layout->assign("incidencias", $incidencias);
//         	$this->layout->assign("users", "active");
        	$this->layout->assign($_REQUEST['label_incidence'], "bg-success");
        	$this->layout->assign("label_type_incidence", $_REQUEST['label_incidence']);
        	$this->layout->assign("type_incidence", $_REQUEST['type_incidence_label']);
        	//cargo la vista
//         	print_r($_REQUEST);
//         	exit();
            $this->display('/incidencias/list.tpl');
        }
        
        /**
         * 
         * Formulario de adición/modificación de vehículo
         */
        function frm_incidencia(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Incidencia.php");
        	$incidencia = new Incidencia($this->conn);
        	
//         	global $tipo_colaboradores, $empresas;
// 			print_r($_REQUEST);
// 			exit();
        	
        	//si viene id_vehiculo es que estoy editando
        	if(isset($_REQUEST['id_incidencia'])){
        		
        		//filtro el vehículo para encontrarlo
	        	$filtros = array();       
	        	anade_filtrado($filtros, "id_incidencia", $_REQUEST['id_incidencia'], "=");
	        	$ack_incidencia = $incidencia->get_incidencia($filtros);
	        	
	        	//si lo encuentro
	        	if($ack_incidencia->resultado){
	        		//me guardo el vehículo y parseo la fecha
	        		$incidencia = $ack_incidencia>datos;
	        		
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
	        	
// 	        	if($_REQUEST['type_incidence'] == 2){
// 	        		$ack_colaborador = $Usuario->getColaborador($usuario->id_usuario);
// 	        		if($ack_colaborador->resultado){
// 	        			$colaborador = $ack_colaborador->datos[0];
// 	        			$usuario->id_colaborador 	= $colaborador->id_colaborador;
// 	        			$usuario->tipo_colaborador 	= $colaborador->tipo_colaborador;
// 	        			$usuario->descripcion 		= $colaborador->descripcion;
// 	        			$usuario->empresa 			= $colaborador->empresa;
// 	        		}
// 	        	}
	        	
	        	$this->layout->assign("incidencia", $incidencia);
        	}
        	
        	$this->layout->assign("incidencias", "active");
        	$this->layout->assign($_REQUEST['label_incidence'], "bg-success");
        	$this->layout->assign("label_type_incidence", $_REQUEST['label_incidence']);
        	$this->layout->assign("type_incidence", $_REQUEST['type_incidence_label']);
        	$this->layout->assign("type_incidence_id", $_REQUEST['type_incidence']);
        	//cargo la vista
        	
        	switch($_REQUEST['type_incidence']){
        		case 1:
        			$this->display('/incidencias/frm_incidenciacoche.tpl');
        			break;
        		case 2:
//         			$this->layout->assign("tipo", $tipo_colaboradores);
//         			$this->layout->assign("empresas", $empresas);
        			$this->display('/incidencias/frm_incidenciapuntocarga.tpl');
        			break;
        		case 3:
        			$this->display('/incidencias/frm_incidencialimpieza.tpl');
        			break;
        		case 4:
        			$this->display('/incidencias/frm_incidenciaaccidentes.tpl');
        	}
        }
        
//         function check_mail(){
//         	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Usuario.php");
//         	$Usuario = new Usuario($this->conn);
        	
//         	$filtros = array();
//         	anade_filtrado($filtros, "tipo", $_REQUEST['type'], "=");
//         	anade_filtrado($filtros, "email", $_REQUEST['email'], "=");
        	
//         	$ack_usuario = $Usuario->get_usuario($filtros);

//         	if($ack_usuario->resultado){
//         		die("repetido");
//         	}else{
//         		die();
//         	}
//         }
        
        function update_incidencia(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Incidencia.php");
        	$incidencia = new Incidencia($this->conn);
        	
        	//fuerzo el tipo
        	$_REQUEST['tipo'] = $_REQUEST['type_incidence'];
        	
        	//si no viene la activacion es que lo han desactivado
//         	if(!isset($_REQUEST['activacion'])){
//         		$_REQUEST['activacion'] = '0';
//         	}else{
//         		$_REQUEST['activacion'] = '1';
//         	}
        	
        	//si no viene la activacion es que lo han desactivado
//         	if(!isset($_REQUEST['validado'])){
//         		$_REQUEST['validado'] = '0';
//         	}else{
//         		$_REQUEST['validado'] = '1';
//         	}
        	
        	//si viene imagen, guardo
//         	if(isset($_FILES['imagen']) && $_FILES['imagen']['name']!=null){
//         		$_REQUEST['imagen'] = uploadFile($_FILES['imagen']);
//         	}
        	
        	if($_REQUEST['id_incidencia'] == ''){
        		unset($_REQUEST['id_incidencia']);
        	}
        	
        	if(isset($_REQUEST['fecha_inicio_incidencia'])){
        		//parseo la fecha a ingles
        		$_REQUEST['fecha_inicio_incidencia'] = convertir_fecha_ingles($_REQUEST['fecha_inicio_incidencia']);
        	}
        	
        	if(isset($_REQUEST['fecha_fin_incidencia'])){
	        	//parseo la fecha a ingles
	        	$_REQUEST['fecha_fin_incidencia'] = convertir_fecha_ingles($_REQUEST['fecha_fin_incidencia']);
        	}
        	
        	//inserto/actualizo en base de datos
        	$ackIncidencia = $incidencia->update_incidencia($_REQUEST);
        	//añado una notificacion
        	$this->add_notification($ackIncidencia);
        	
        	if($ackIncidencia->resultado ){  //&& $_REQUEST['tipo'] == 2
        		if($_REQUEST['id_usuario']==null){
        			$_REQUEST['id_usuario'] = $this->conn->id;
        		}
        		
// 	        	if($_REQUEST['id_colaborador'] == ''){
// 	        		unset($_REQUEST['id_colaborador']);
// 	        	}
	        	
//         		$ackUsuario = $Usuario->update_colaborador($_REQUEST);
        	}
        	
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
	}
?>