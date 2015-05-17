<?php
	class alquilerController extends CController{
        
        function frm_select_car(){
        	//trato las variables en el modelo
        	$mensaje = "Hola Mundo";
        	
        	//enlace el modelo con la vista
        	$this->layout->assign('mensaje', $mensaje);
        	
        	
            $this->display('/rent/frm_select_car.tpl');
        }
        
	}
?>