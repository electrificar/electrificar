<?php
class Incidencia {

    var $conn       = null;

    function Incidencia($conn){
        $this->conn = $conn;
    }
	
    // Obtengo los elementos de la tabla usuario que cumplen el patron de filtros enviado
    function get_incidencias ($arr_filtros, $limit=null){
        $ack = new ACK();
        $ack->resultado = true;
        // Primero aÃ±adiremos los filtros
        $filtros = componer_filtro ($arr_filtros);
    
        if(strpos($limit, "Limit -")) $limit="";
        $query = "SELECT * FROM incidencia ".$filtros." ".get_order ("asunto,descripcion","asc")." ".$limit; // + filtros
        // print $query;
        if( ($arr_reg = $this->conn->load($query)) != null ){
            $ack->datos = $arr_reg;
        } else {
            $ack->resultado = false;
            $ack->mensaje   = "Se ha producido un error al obtener usuario, ponte en contacto con tu administrador";
        }
        return $ack;
    }
    
	// Obtengo los elementos de la tabla usuario que cumplen el patron de filtros enviado
    function get_incidencia ($id_incidencia){
        $ack = new ACK();
        $ack->resultado = true;
    
        $query = "SELECT asunto FROM incidencia ";
        // print $query;
        if( ($arr_reg = $this->conn->load($query)) != null ){
            $ack->datos = $arr_reg[0]->asunto;
        } else {
            $ack->resultado = false;
            $ack->mensaje   = "Se ha producido un error al obtener usuario, ponte en contacto con tu administrador";
        }
        return $ack->datos;
    }

    // Devuelvo el total de elemntos de la tabla usuario que cumplen el filtro enviado
    function get_total_incidencias ($arr_filtros){
        $ack = new ACK();
        $ack->resultado = true;
        // Primero aÃ±adiremos los filtros
        $filtros = componer_filtro ($arr_filtros);
    
        $query = "SELECT COUNT(*) AS TANTOS FROM incidencia ".$filtros; 
        // print $query;
        if( ($arr_reg = $this->conn->load($query)) != null ){
            $ack->datos = $arr_reg[0]->TANTOS;
        } else {
            $ack->resultado = true;
            $ack->mensaje   = "Se ha producido un error al obtener el total, ponte en contacto con tu administrador";
        }
        return $ack->datos[0]->TANTOS;
    }

    // Realizamos la insercion de la tabla usuario y su modificacion si el indice es distinto de null
    function update_incidencia2 ($id_incidencia, $asunto, $descripcion, $fecha_inicio_incidencia, $estado, $id_colaborador, $fecha_fin_incidencia, $id_vehculo, $comentarios, $id_usuario){
        $ack = new ACK();
        $ack->resultado = true;

        $update = false;
        $query = "select * from incidencia where id_incidencia='".$id_incidencia."'";
        $res = $this->conn->load($query);
        if(sizeof($res)>0){
            $update = true;
        }

        if($update==true){
            // update
            $query = "update incidencia set asunto='".$asunto."', descripcion='".$descripcion."', fecha_inicio_incidencia='".$fecha_inicio_incidencia."', estado='".$estado."', id_colaborador='".$id_colaborador."', fecha_fin_incidencia='".$fecha_fin_incidencia."', id_vehiculo='".$id_vehiculo."', comentarios='".$comentarios."', id_usuario='".$id_usuario."' ";
            // print $query;
            if($this->conn->update($query)==false){
                $ack->resultado = false;
                $ack->mensaje   = "No se ha podido actualizar la incidencia, contacte con su administrador";
            } else {
                $ack->id = $id_incidencia;
            }
        } else {
            // insert
            $query = "insert into incidencia (id_incidencia, asunto, descripcion, fecha_inicio_incidencia, estado, id_colaborador, fecha_fin_incidencia, vehiculo, comentarios, id_usuario) values ('".$id_incidencia."', '".$asunto."', '".$descripcion."', '".$fecha_inicio_incidencia."', '".$estado."', '".$id_colaborador."', '".$fecha_fin_incidencia."', '".$id_vehiculo."', '".$comentarios."', '".$id_usuario."');";
            // print $query;
            $res = $this->conn->insert($query);
            if($res==null){
                $ack->resultado = false;
                $ack->mensaje   = "No se ha podido insertar la incidencia, contacte con su administrador";
            } else {
                $ack->id = $res;
            }
        }

        return $ack;
    }

    // Eliminamos de la tabla usuario y si hay dependencias caerian en cascada
    function remove_incidencia($id_incidencia){
        global $log;
        $ack = new ACK();
        $ack->resultado = true;
    
        $query = "select * from incidencia where ID_incidencia='".$id_incidencia."'";
        $arr_res = $this->conn->load ($query);
        if(sizeof($arr_res)>0){
        
            // Primero elimino el objeto principal
            $query = "delete from incidencia where ID_incidencia='".$id_incidencia."'";
            $res = $this->conn->remove ($query);
        
            if($res==true){
                // Aqui pondriamos las dependencias
            }
        
            $ack->id = $arr_res[0]->ID_incidencia;
        } else {
            $ack->resultado = false;
            $ack->mensaje   = "No se ha localizado la incidencia, consulte a su administrador";
            $ack->id        = $id_incidencia;
        }
    
        // Escribo las trazas
        if($ack->resultado==true){
            $log->output ("ELIMINAR_incidencia", $ack->id, "incidencia", "", "", "");
        } else {
            $log->output ("ELIMINAR_incidencia", $ack->id, "incidencia", "", "", "Error: ".$ack->mensaje);
        }
    
        return $ack;
    }
    // Realizamos la insercion de la tabla usuario y su modificacion si el indice es distinto de null
    function update_incidencia ($datos){
        $ack = new ACK();
        $ack->resultado = true;
        $tabla='incidencia';
        
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
            	$ack->mensaje = "Ha ocurrido un problema al guardar la incidencia.";
            }else{
            	$ack->mensaje = "Datos guardados correctamente.";
            }
        }
        
        return $ack;
	}
	
// 	function update_colaborador ($datos){
//         $ack = new ACK();
//         $ack->resultado = true;
//         $tabla='colaborador';
        
//         //COMPROBAR ARRAY DE DATOS, SI ESTA VACIO O NO.
//         if($datos==null || sizeof($datos)==0){
//         	$ack->resultado = false;
//             $ack->mensaje ="Los parametros enviados para la tabla ".$tabla." están vacíos";
//         }
       
//         if(!$ack->resultado){
//             print_r($ack->mensaje);
//         }else{
//             $res = $this->conn->stor($datos,$tabla);
//             //exit;
//             if(!$res){
//             	$ack->resultado = false;
//             	$ack->mensaje = "Ha ocurrido un problema al guardar el usuario.";
//             }else{
//             	$ack->mensaje = "Datos guardados correctamente.";
//             }
//         }
        
//         return $ack;
// 	}	
	
	function activate_incidencia($id_incidencia){
 		$ack = new ACK();
        $ack->resultado = true;
        $ack->mensaje = "Tu usuario ha sido activado correctamente, ya puedes iniciar sesiÃ³n.";
        
		// update
		$query = "update usuario set activado='S' where id_usuario='".$id_usuario."' ";
		// print $query;
		if($this->conn->update($query)==false){
			$ack->resultado = false;
			$ack->mensaje   = "No se ha podido activar tu usuario, intÃ©ntalo de nuevo o contacta con nosotros!";
		} else {
			$ack->id = $id_usuario;
		}

        return $ack;
	}
}
?>