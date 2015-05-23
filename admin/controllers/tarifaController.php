<?php
class tarifaController extends CController{

	/**
	 * Sección de listado de vehículos
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

	/**
	 *
	 * Formulario de adición/modificación de vehículo
	 */
	function frm_tarifa(){
		require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Tarifa.php");
		$Tarifa = new Tarifa($this->conn);
		
		//si viene id_tarifa es que estoy editando
		if(isset($_REQUEST['id_tarifa'])){

			//filtro la tarifa para encontrarlo
			$filtros = array();
			anade_filtrado($filtros, "id_tarifa", intval($_REQUEST['id_tarifa']), "=");
			$ack_tarifas = $Tarifa->get_tarifas($filtros);
			
			//si lo encuentro
			if($ack_tarifas->resultado){
				//me guardo la tarifa
				$tarifa = $ack_tarifas->datos[0];
			}else{
				//si no lo encuentro, genero una notificacion
				$ack_tarifas = new ACK();
				$ack_tarifas->resultado = false;
				$ack_tarifas->mensaje	  = "La tarifa indicada no existe";
				 
				//la añado
				$this->add_notification($ack_tarifas);
				 
				//redirijo el listado
				header("location: /admin/tarifas/");
				die();
			}
			
			$this->layout->assign("tarifa", $tarifa);
		}
		
		//si todo sale bien o es una nueva tarifa
		$this->layout->assign("tarife", "active");//variable de activación de menú
		$this->display('/tarife/frm_tarife.tpl');//cargo la vista
	}

	function update_tarifa(){
		require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/tarifa.php");
		 
		$tarifa = new Tarifa($this->conn);

		if($_REQUEST['id_tarifa']== ""){
			
			unset($_REQUEST['id_tarifa']);
		}
		
		if($_REQUEST['precio_descuento'] == ""){
			$_REQUEST['precio_descuento'] = 0.00;
		}
		
		$ackTarifa = $tarifa->update_tarifa($_REQUEST);
		 
		//añado una notificacion
		$this->add_notification($ackTarifa);
		 
		//redirijo
		header("location: /admin/tarifas/");
		die();
	}

	function delete_tarifa(){
		require_once($_SERVER["DOCUMENT_ROOT"]."/clases/bd/Tarifa.php");
		 
		$tarifa = new Tarifa($this->conn);
		
		//borro el vehículo
		$ack_borrado = $tarifa->remove_tarifa($_REQUEST['id_tarifa']);
		 
		//añado notificación
		$this->add_notification($ack_borrado);
		 
		//redirijo
		header("location: /admin/tarifas/");
		die();
	}
}
?>