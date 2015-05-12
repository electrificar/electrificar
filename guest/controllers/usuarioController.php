<?php
	class usuarioController extends CController{
        
        function frm_user(){
        	//trato las variables en el modelo
        	$mensaje = "Hola Mundo";
        	
        	//enlace el modelo con la vista
        	$this->layout->assign('mensaje', $mensaje);
        	
        	
            $this->display('/user/frm_user.tpl');
        }
        
	}
?>