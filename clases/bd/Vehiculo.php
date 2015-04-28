<?php
class Vehiculo {

    var $conn       = null;

    function Vehiculo($conn){
        $this->conn = $conn;
    }
    
	function update_vehiculo ($datos){
        $ack = new ACK();
        $ack->resultado = true;
        $tabla='vehiculo';
        
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
            	$ack->mensaje = "Ha ocurrido un problema al guardar los datos en seccion, consulte a su administrador.";
            }
        }
        
        return $ack;
        
    }
	
	// Obtengo los elementos de la tabla productos que cumplen el patron de filtros enviado
    function get_vehiculos($arr_filtros, $limit=null){
        $ack = new ACK();
        $ack->resultado = true;
        // Primero añadiremos los filtros
        $filtros = componer_filtro ($arr_filtros);
    
        if(strpos($limit, "Limit -")) $limit="";
        $query = "SELECT * FROM vehiculo ".$filtros." ".get_order ("id_vehiculo","asc")." ".$limit; // + filtros
        // print $query;
        if( ($arr_reg = $this->conn->load($query)) != null ){
            $ack->datos = $arr_reg;
        } else {
            $ack->resultado = false;
            $ack->mensaje   = "Se ha producido un error al obtener productos, ponte en contacto con tu administrador";
        }
        return $ack;
    }
}
?>