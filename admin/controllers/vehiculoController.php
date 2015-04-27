<?php
	class vehiculoController extends CController{
        
        function list_vehicles(){
        	
        	$this->layout->assign("vehicle", "active");
            $this->display('/vehicle/list.tpl');
        }
	}
?>