<?php
	class aboutUsController extends CController{
        
        function aboutUs(){
        	//trato las variables en el modelo
        	$mensaje = "Hola Mundo";
        	
        	//enlace el modelo con la vista
        	$this->layout->assign('mensaje', $mensaje);
        	
        	
            $this->display('/info_contact/about.tpl');
        }
        
	}
?>