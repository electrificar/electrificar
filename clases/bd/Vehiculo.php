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
            	$ack->mensaje = "Ha ocurrido un problema al guardar el vehículo.";
            }else{
            	$ack->mensaje = "Datos guardados correctamente.";
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
    
 	function remove_vehicle ($id_vehiculo){
        global $log;
        $ack = new ACK();
        $ack->resultado = true;
    
        $query = "select * from vehiculo where id_vehiculo='".$id_vehiculo."'";
        $arr_res = $this->conn->load ($query);
        if(sizeof($arr_res)>0){
        
            // Primero elimino el objeto principal
            $query = "delete from vehiculo where id_vehiculo='".$id_vehiculo."'";
            $res = $this->conn->remove ($query);
        
            if($res==true){
               unlink($_SERVER['DOCUMENT_ROOT']."/repositorio/".$arr_res->imagen);
               $ack->mensaje   = "Vehículo borrado correctamente.";
            }
        
            $ack->id = $arr_res[0]->$id_vehiculo;
        } else {
            $ack->resultado = false;
            $ack->mensaje   = "No se ha localizado el vehículo, consulte a su administrador";
            $ack->id        = $id_valoraciones;
        }
    
    
        return $ack;
    }
}
?>