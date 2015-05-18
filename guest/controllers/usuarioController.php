<?php
	class usuarioController extends CController{
        
        function frm_user(){
        	//trato las variables en el modelo
        	$mensaje = "Hola Mundo";
        	
        	//enlace el modelo con la vista
        	$this->layout->assign('mensaje', $mensaje);
        	
        	
            $this->display('/user/frm_user.tpl');
        }
        
		function frm_edit_user(){
        	//trato las variables en el modelo
        	$mensaje = "Hola Mundo";
        	
        	//enlace el modelo con la vista
        	$this->layout->assign('mensaje', $mensaje);
        	
        	
            $this->display('/user/frm_edit_user.tpl');
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
        	header("location: /guest/usuarios/".$_REQUEST['type_user_label']);
        	die();
        }       
        
        
	}
?>