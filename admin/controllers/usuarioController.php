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
        function frm_user(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Usuario.php");
        	$Usuario = new Usuario($this->conn);
        	
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
        			$this->display('/user/frm_colab.tpl');
        			break;
        		case 3:
        			$this->display('/user/frm_electr.tpl');
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
        	
        	//si viene imagen, guardo
        	if(isset($_FILES['imagen']) && $_FILES['imagen']['name']!=null){
        		$_REQUEST['imagen'] = uploadFile($_FILES['imagen']);
        	}
        	
        	if($_REQUEST['id_usuario'] == ''){
        		unset($_REQUEST['id_usuario']);
        	}
        	
        	//inserto/actualizo en base de datos
        	$ackUsuario = $Usuario->update_usuario($_REQUEST);
        	//añado una notificacion
        	$this->add_notification($ackUsuario);
        	
        	
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
	}
?>