<?php
	class homeController extends CController{
        
        function home(){
        	//para saber los alquileres activos
	        require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Alquiler.php");
	        require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Incidencia.php");
	        $Alquiler = new Alquiler($this->conn);
	        $Incidencia = new Incidencia($this->conn);
	        
	        $filtros = array();
	        $ack_alquileres = $Alquiler->get_alquileres($filtros);
	        anade_filtrado($filtros, "estado", "3", "=");
	        $ack_incidencias = $Incidencia->get_incidencias($filtros);
	        
	        $this->layout->assign("historial_alquilados", sizeof($ack_alquileres->datos));
	        $this->layout->assign("historial_incidencias", sizeof($ack_incidencias->datos));
        	$this->layout->assign("home", "active");
            $this->display('/home/index.tpl');
        }
	}
?>