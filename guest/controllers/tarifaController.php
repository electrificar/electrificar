<?php
class tarifaController extends CController{

	/**
	 * Sección de listado de tarifas
	 */
	function list_tarifas(){
		require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Tarifa.php");
		$Tarifa = new Tarifa($this->conn);

		$filtros = array();

		if(isset($_REQUEST['nombre'])){
			anade_filtrado($filtros, "nombre", $_REQUEST['nombre'], "like");
		}
		
		//obtengo los vehículos
		$ack_tarifas = $Tarifa->get_tarifas($filtros);
		 
		//si hay
		if($ack_tarifas->resultado){
			//me guardo esa parte
			$tarifas = $ack_tarifas->datos;
		}else{
			$tarifas = array();
		}
		 
		//asocio las variables a la vista
		$this->layout->assign("filtros", $_REQUEST);
		$this->layout->assign("tarifas", $tarifas);
		$this->layout->assign("tarife", "active");
		 
		//cargo la vista
		$this->display('/tarife/list.tpl'); 
	}
	
}
?>