<?php
	class magazineController extends CController{
        
        function magazine(){
        	//trato las variables en el modelo
        	$mensaje = "Hola Mundo";
        	
        	//enlace el modelo con la vista
        	$this->layout->assign('mensaje', $mensaje);
        	
        	
            $this->display('/magazine/magazine.tpl');
        }
        
	}
?>