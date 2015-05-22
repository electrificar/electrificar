<?php
	class perfilController extends CController{
        
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
                header("Location: /");
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
?>