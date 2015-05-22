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
        
         function frm_login(){
            $this->display('/register/login_form.tpl');
        }
        
        function do_login(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Usuario.php");
        	
            $user  = trim($_POST['email']);
            $pwd   = trim($_POST['pass']);

            unset($_POST["email"]);
            unset($_POST["pass"]);

            $pPerfil = new Usuario ($this->conn);
            $ack = $pPerfil->login ($user, $pwd);
            
            if($ack->resultado==true){
            	$_SESSION['SESION_ID_USUARIO']     = $ack->datos->id_usuario;
            	$_SESSION['SESION_USUARIO']        = $ack->datos->nombre." ".$ack->datos->apellido1." ".$ack->datos->apellido2;
            	$_SESSION['mi_usuario'] 		   = new stdClass();
            	$_SESSION['mi_usuario']->id_usuario     = $ack->datos->id_usuario;
            	$_SESSION['mi_usuario']->nombre     	= $ack->datos->nombre;
            	$_SESSION['mi_usuario']->imagen		    = $ack->datos->imagen;
            	
                header("Location: /");
                die();
            } else {
                header("Location: /?error=TRUE");
                die();
            }
        }
        
        function do_logout(){            
            unset($_SESSION["SESION_ID_USUARIO"]);
            unset($_SESSION["SESION_USUARIO"]);
            
            session_start();
            session_unset();
            session_destroy();

            header("Location: /");
                die();
        }
	}
		function update_user(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Usuario.php");
        	$Usuario = new Usuario($this->conn);
        	
        	//fuerzo el tipo
        	$_REQUEST['tipo'] = 3;
        	
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
        	header("location: /crear_usuario/");
        	die();
        }       
?>