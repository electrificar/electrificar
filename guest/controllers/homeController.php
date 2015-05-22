<?php
	class homeController extends CController{
        
        function home(){
        	//trato las variables en el modelo
        	$mensaje = "Hola Mundo";
        	
        	//enlace el modelo con la vista
        	
        	
            $this->display('/home/index.tpl');
        }
        
        function home2(){
        	//trato las variables en el modelo
        	$mensaje = "Hola electrificar";
        	
        	//enlace el modelo con la vista
        	$this->layout->assign('mensaje', $mensaje);
        	
        	
            $this->display('/home/index.tpl');
        }
	}
?>