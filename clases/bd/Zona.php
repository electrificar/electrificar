<?php
class Zona {

    var $conn       = null;

    function Zona($conn){
        $this->conn = $conn;
    }
    
	function update_zona ($datos){
        $ack = new ACK();
        $ack->resultado = true;
        $tabla='zona';
        
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
            	$ack->mensaje = "Ha ocurrido un problema al guardar la zona.";
            }else{
            	$ack->mensaje = "Datos guardados correctamente.";
            }
        }
        
        return $ack;
        
    }
	
	// Obtengo los elementos de la tabla productos que cumplen el patron de filtros enviado
    function get_zonas($arr_filtros, $limit=null){
        $ack = new ACK();
        $ack->resultado = true;
        // Primero añadiremos los filtros
        $filtros = componer_filtro ($arr_filtros);
    
        if(strpos($limit, "Limit -")) $limit="";
        $query = "SELECT * FROM zona ".$filtros." ".get_order ("id_zona","asc")." ".$limit; // + filtros
        // print $query;
        if( ($arr_reg = $this->conn->load($query)) != null ){
            $ack->datos = $arr_reg;
        } else {
            $ack->resultado = false;
        }
        return $ack;
    }
    
    
	// Obtengo los elementos de la tabla productos que cumplen el patron de filtros enviado
    function getTotalPuntosCarga($id_zona){
    	if($id_zona){
    		$ack = new ACK();
	        $ack->resultado = true;
	        // Primero añadiremos los filtros
	        $filtros = componer_filtro ($arr_filtros);
	    
	        if(strpos($limit, "Limit -")) $limit="";
	        $query = "SELECT count(*) as total FROM punto_carga where id_zona in (select id_zona from zona where id_zona = '".$id_zona."')";
	        // print $query;
	        if( ($arr_reg = $this->conn->load($query)) != null ){
	            $total = $arr_reg[0]->total;
	        } else {
	            $total = "\0";
	        }
	        
    	}else{
    		$total = "\0";
    	}
    	
    	return $total;
    }
    
	// Obtengo los elementos de la tabla productos que cumplen el patron de filtros enviado
    function getTotalVehiculos($id_zona){
    	if($id_zona){
    		$ack = new ACK();
	        $ack->resultado = true;
	        // Primero añadiremos los filtros
	        $filtros = componer_filtro ($arr_filtros);
	    
	        if(strpos($limit, "Limit -")) $limit="";
	        $query = "SELECT count(*) as total FROM vehiculo where id_zona in (select id_zona from zona where id_zona = '".$id_zona."')";
	        // print $query;
	        if( ($arr_reg = $this->conn->load($query)) != null ){
	            $total = $arr_reg[0]->total;
	        } else {
	            $total = "\0";
	        }
	        
    	}else{
    		$total = "\0";
    	}
    	
    	return $total;
    }
    
 	function delete_plug ($id_punto_carga, $id_zona){
        global $log;
        $ack = new ACK();
        $ack->resultado = true;
    
        $query = "select * from punto_carga where id_punto_carga='".$id_punto_carga."' and id_zona = '".$id_zona."'";
        $arr_res = $this->conn->load ($query);
        if(sizeof($arr_res)>0){
        
            // Primero elimino el objeto principal
            $query = "delete from punto_carga where id_punto_carga='".$id_punto_carga."'";
            $res = $this->conn->remove ($query);        
        
            $ack->id = $arr_res[0]->id_punto_carga;
        } else {
            $ack->resultado = false;
            $ack->mensaje   = "No se ha localizado el punto de carga, consulte a su administrador";
            $ack->id        = $id_valoraciones;
        }
    
    
        return $ack;
    }
    
    function get_puntos_carga($arr_filtros){
        $ack = new ACK();
        $ack->resultado = true;
        // Primero añadiremos los filtros
        $filtros = componer_filtro ($arr_filtros);
    
        if(strpos($limit, "Limit -")) $limit="";
        $query = "SELECT * FROM punto_carga ".$filtros." ".get_order ("id_zona","asc")." ".$limit; // + filtros
        // print $query;
        if( ($arr_reg = $this->conn->load($query)) != null ){
            $ack->datos = $arr_reg;
        } else {
            $ack->resultado = false;
        }
        return $ack;
    }
    
	function update_punto_de_carga ($datos){
        $ack = new ACK();
        $ack->resultado = true;
        $tabla='punto_carga';
        
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
            	$ack->mensaje = "Ha ocurrido un problema al guardar el punto de carga.";
            }else{
            	$ack->mensaje = "Datos guardados correctamente.";
            }
        }
        
        return $ack;
        
    }
}
?>