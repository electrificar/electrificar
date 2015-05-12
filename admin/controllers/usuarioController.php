<?php
	class usuarioController extends CController{
        
		/**
		 * Sección de listado de vehículos
		 */
        function list_users(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Usuario.php");
        	$Usuario = new Usuario($this->conn);
        	
        	global $tipo_colaboradores, $empresas; 
        	
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
        		
        		foreach($usuarios as $usuario){
        			$usuario->fecha_permiso = convertir_fecha_espanol($usuario->fecha_permiso);
        			
	        		if($_REQUEST['type_user'] == 2){
		        		$ack_colaborador = $Usuario->getColaborador($usuario->id_usuario);
		        		if($ack_colaborador->resultado){
		        			$colaborador = $ack_colaborador->datos[0];
		        			$usuario->id_colaborador 	= $colaborador->id_colaborador;
		        			$usuario->tipo_colaborador 	= $tipo_colaboradores[$colaborador->tipo_colaborador]['tipo'];
		        			$usuario->descripcion 		= $colaborador->descripcion;
		        			$usuario->empresa 			= $empresas[$colaborador->empresa]['empresa'];
		        		}
		        	}
        		}
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
        function frm_user(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Usuario.php");
        	$Usuario = new Usuario($this->conn);
        	
        	global $tipo_colaboradores, $empresas;
        	
        	//si viene id_vehiculo es que estoy editando
        	if(isset($_REQUEST['id_usuario'])){
        		
        		//filtro el vehículo para encontrarlo
	        	$filtros = array();       
	        	anade_filtrado($filtros, "id_usuario", $_REQUEST['id_usuario'], "=");
	        	$ack_usuario = $Usuario->get_usuario($filtros);
	        	
	        	//si lo encuentro
	        	if($ack_usuario->resultado){
	        		//me guardo el vehículo y parseo la fecha
	        		$usuario = $ack_usuario->datos[0];
	        		
	        		$usuario->fecha_nacimiento = convertir_fecha_espanol($usuario->fecha_nacimiento);
	        		$usuario->fecha_permiso = convertir_fecha_espanol($usuario->fecha_permiso);
	        	}else{
	        		//si no lo encuentro, genero una notificacion
	        		$ack_usuario = new ACK();
	        		$ack_usuario->resultado = false;
	        		$ack_usuario->mensaje	  = "El usuario indicado no existe";
	        		
	        		//la añado
	        		$this->add_notification($ack_usuario);
	        		
	        		//redirijo el listado
	        		header("location: /admin/usuarios/".$_REQUEST['type_user_label']."/");
	        		die();
	        	}        	
	        	
	        	if($_REQUEST['type_user'] == 2){
	        		$ack_colaborador = $Usuario->getColaborador($usuario->id_usuario);
	        		if($ack_colaborador->resultado){
	        			$colaborador = $ack_colaborador->datos[0];
	        			$usuario->id_colaborador 	= $colaborador->id_colaborador;
	        			$usuario->tipo_colaborador 	= $colaborador->tipo_colaborador;
	        			$usuario->descripcion 		= $colaborador->descripcion;
	        			$usuario->empresa 			= $colaborador->empresa;
	        		}
	        	}
	        	
	        	$this->layout->assign("usuario", $usuario);
        	}
        	
        	$this->layout->assign("users", "active");
        	$this->layout->assign($_REQUEST['label_user'], "bg-success");
        	$this->layout->assign("label_type_user", $_REQUEST['label_user']);
        	$this->layout->assign("type_user", $_REQUEST['type_user_label']);
        	$this->layout->assign("type_user_id", $_REQUEST['type_user']);
        	//cargo la vista
        	
        	switch($_REQUEST['type_user']){
        		case 1:
        			$this->display('/user/frm_admin.tpl');
        			break;
        		case 2:
        			$this->layout->assign("tipos", $tipo_colaboradores);
        			$this->layout->assign("empresas", $empresas);
        			$this->display('/user/frm_colab.tpl');
        			break;
        		case 3:
        			$this->display('/user/frm_elect.tpl');
        			break;
        	}
        }
        
        function check_mail(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Usuario.php");
        	$Usuario = new Usuario($this->conn);
        	
        	$filtros = array();
        	anade_filtrado($filtros, "tipo", $_REQUEST['type'], "=");
        	anade_filtrado($filtros, "email", $_REQUEST['email'], "=");
        	
        	$ack_usuario = $Usuario->get_usuario($filtros);

        	if($ack_usuario->resultado){
        		die("repetido");
        	}else{
        		die();
        	}
        }
        
        function update_user(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Usuario.php");
        	$Usuario = new Usuario($this->conn);
        	
        	//fuerzo el tipo
        	$_REQUEST['tipo'] = $_REQUEST['type_user'];
        	
        	//si no viene la activacion es que lo han desactivado
        	if(!isset($_REQUEST['activacion'])){
        		$_REQUEST['activacion'] = '0';
        	}else{
        		$_REQUEST['activacion'] = '1';
        	}
        	
        	//si no viene la activacion es que lo han desactivado
        	if(!isset($_REQUEST['validado'])){
        		$_REQUEST['validado'] = '0';
        	}else{
        		$_REQUEST['validado'] = '1';
        	}
        	
        	//si viene imagen, guardo
        	if(isset($_FILES['imagen']) && $_FILES['imagen']['name']!=null){
        		$_REQUEST['imagen'] = uploadFile($_FILES['imagen']);
        	}
        	
        	if($_REQUEST['id_usuario'] == ''){
        		unset($_REQUEST['id_usuario']);
        	}
        	
        	if(isset($_REQUEST['fecha_nacimiento'])){
        		//parseo la fecha a ingles
        		$_REQUEST['fecha_nacimiento'] = convertir_fecha_ingles($_REQUEST['fecha_nacimiento']);
        	}
        	
        	if(isset($_REQUEST['fecha_permiso'])){
	        	//parseo la fecha a ingles
	        	$_REQUEST['fecha_permiso'] = convertir_fecha_ingles($_REQUEST['fecha_permiso']);
        	}
        	
        	//inserto/actualizo en base de datos
        	$ackUsuario = $Usuario->update_usuario($_REQUEST);
        	//añado una notificacion
        	$this->add_notification($ackUsuario);
        	
        	if($ackUsuario->resultado && $_REQUEST['tipo'] == 2){
        		if($_REQUEST['id_usuario']==null){
        			$_REQUEST['id_usuario'] = $this->conn->id;
        		}
        		
	        	if($_REQUEST['id_colaborador'] == ''){
	        		unset($_REQUEST['id_colaborador']);
	        	}
	        	
        		$ackUsuario = $Usuario->update_colaborador($_REQUEST);
        	}
        	
        	//redirijo
        	header("location: /admin/usuarios/".$_REQUEST['type_user_label']);
        	die();
        }
        
        function change_status(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Usuario.php");
        	$Usuario = new Usuario($this->conn);
        	
        	//fuerzo el tipo
        	$_REQUEST['tipo'] = $_REQUEST['type_user'];
        	
        	//inserto/actualizo en base de datos
        	$ackUsuario = $Usuario->update_usuario($_REQUEST);
        	//añado una notificacion
        	$this->add_notification($ackUsuario);
        	
        	
        	//redirijo
        	header("location: /admin/usuarios/".$_REQUEST['type_user_label']);
        	die();
        }
        
		function validate_user(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Usuario.php");
        	$Usuario = new Usuario($this->conn);
        	
        	//fuerzo el tipo
        	$_REQUEST['tipo'] = $_REQUEST['type_user'];
        	
        	//inserto/actualizo en base de datos
        	$ackUsuario = $Usuario->update_usuario($_REQUEST);
        	//añado una notificacion
        	$this->add_notification($ackUsuario);
        	
        	
        	//redirijo
        	header("location: /admin/usuarios/".$_REQUEST['type_user_label']);
        	die();
        }
	}
?>