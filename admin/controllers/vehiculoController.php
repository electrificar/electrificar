<?php
	class vehiculoController extends CController{
        
		/**
		 * Sección de listado de vehículos
		 */
        function list_vehicles(){
        	
        	$this->layout->assign("vehicle", "active");
            $this->display('/vehicle/list.tpl');
        }
        
        /**
         * 
         * Formulario de adición/modificación de vehículo
         */
        function frm_vehicle(){
        	
        	$this->layout->assign("vehicle", "active");
        	$this->display('/vehicle/frm_vehicle.tpl');
        }
        
        function update_vehicle(){
        	require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Vehiculo.php");
        	
        	$Vehiculo = new Vehiculo($this->conn);
        	
        	$ackVehiculo = $Vehiculo->update_vehiculo($_REQUEST);
        	
        	print_R($ackVehiculo);
        }
	}
?>