<?php
	class homeController extends CController{
        
        function home(){
        	//para saber los alquileres activos
	        require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Alquiler.php");
	        $Alquiler = new Alquiler($this->conn);
	        
	        $filtros = array();
	        $ack_alquileres = $Alquiler->get_alquileres($filtros);
	        
	        $this->layout->assign("historial_alquilados", sizeof($ack_alquileres->datos));
        	$this->layout->assign("home", "active");
            $this->display('/home/index.tpl');
        }
	}
?>