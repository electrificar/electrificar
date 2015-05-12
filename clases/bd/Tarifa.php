<?php
class Tarifa {

	var $conn       = null;

	function Tarifa($conn){
		$this->conn = $conn;
	}

	function update_tarifa ($datos){
		$ack = new ACK();
		$ack->resultado = true;
		$tabla='tarifa';

		//COMPROBAR ARRAY DE DATOS, SI ESTA VACIO O NO.
		if($datos==null || sizeof($datos)==0){
			$ack->resultado = false;
			$ack->mensaje ="Los parametros enviados para la tabla ".$tabla." están vacíos";
		}
		 
		if(!$ack->resultado){
			print_r($ack->mensaje);
		}else{
			$res = $this->conn->stor($datos,$tabla);

			if(!$res){
				$ack->resultado = false;
				$ack->mensaje = "Ha ocurrido un problema al guardar el vehículo.";
			}else{
				$ack->mensaje = "Datos guardados correctamente.";
			}
		}

		return $ack;

	}

	// Obtengo los elementos de la tabla productos que cumplen el patron de filtros enviado
	function get_tarifas($arr_filtros, $limit=null){
		$ack = new ACK();
		$ack->resultado = true;
		// Primero añadiremos los filtros
		$filtros = componer_filtro ($arr_filtros);

		if(strpos($limit, "Limit -")) $limit="";
		$query = "SELECT * FROM tarifa ".$filtros." ".get_order ("id_tarifa","asc")." ".$limit; // + filtros
		// print $query;
		if( ($arr_reg = $this->conn->load($query)) != null ){
			$ack->datos = $arr_reg;
		} else {
			$ack->resultado = false;
			$ack->mensaje   = "Se ha producido un error al obtener productos, ponte en contacto con tu administrador";
		}
		return $ack;
	}

	function remove_tarifa ($id_tarifa){
		global $log;
		$ack = new ACK();
		$ack->resultado = true;

		$query = "select * from tarifa where id_tarifa='".$id_tarifa."'";
		$arr_res = $this->conn->load ($query);
		if(sizeof($arr_res)>0){

			// Primero elimino el objeto principal
			$query = "delete from tarifa where id_tarifa='".$id_tarifa."'";
			$res = $this->conn->remove ($query);

			if($res==true){
				unlink($_SERVER['DOCUMENT_ROOT']."/repositorio/".$arr_res->imagen);
				$ack->mensaje   = "Tarifa borrado correctamente.";
			}

			$ack->id = $arr_res[0]->$id_tarifa;
		} else {
			$ack->resultado = false;
			$ack->mensaje   = "No se ha localizado la tarifa, consulte a su administrador";
		}


		return $ack;
	}
}
?>