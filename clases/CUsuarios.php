<?php
class CUsuarios {

    var $conn       = null;

    function CUsuarios($conn){
        $this->conn = $conn;
    }
	
    function login ($usuario, $clave){
        $ack = new ACK();
        $ack->resultado = true;

        $clave      = strtoupper($clave);
        $clave_orig = $clave;

        //COMPROBAMOS QUE LA CLAVE NO LLEGA CON MAS DE 16 CARACTERES(15 SON LOS MAXIMOS QUE PUEDE TENER UNA CLAVE)
        //SI LLEGA CON MAS LA CLAVE ESTA ENCRIPTADA Y NO HARIA FALTA VOLVER A ENCRIPTARLA
        if(strlen($clave)<16){
            $clave      = encrypt($clave);
        }
        //print_r(md5("lubina"));exit;
		$query = "SELECT * FROM usuarios WHERE LOWER(nif)='".strtolower($usuario)."' AND contrasena='".$clave."' and backend='1'";
		//print_r($query);exit;
        if( ($arr_reg = $this->conn->load($query)) != null ){

			if(sizeof($arr_reg)>0){
                $ack->datos = $arr_reg[0];
            } else {
				$ack->resultado = false;
                $ack->mensaje   = "Los datos introducidos no son correctos";
			}
			
		} else {
            $ack->resultado = false;
            $ack->mensaje   = "Los datos introducidos no son correctos";
		}
        return $ack;
	}
	
	function loginClient ($usuario, $clave){
        $ack = new ACK();
        $ack->resultado = true;

        $clave      = strtoupper($clave);
        $clave_orig = $clave;

        
        //COMPROBAMOS QUE LA CLAVE NO LLEGA CON MAS DE 16 CARACTERES(15 SON LOS MAXIMOS QUE PUEDE TENER UNA CLAVE)
        //SI LLEGA CON MAS LA CLAVE ESTA ENCRIPTADA Y NO HARIA FALTA VOLVER A ENCRIPTARLA
        if(strlen($clave)<16){
            $clave      = encrypt($clave);
        }
        //print_r(md5("lubina"));exit;
		$query = "SELECT * FROM usuarios WHERE LOWER(email)='".strtolower($usuario)."' AND contrasena='".$clave."' and activado='S'";
		//print_r($query);exit;
        if( ($arr_reg = $this->conn->load($query)) != null ){

			if(sizeof($arr_reg)>0){
                $ack->datos = $arr_reg[0];
            } else {
				$ack->resultado = false;
                $ack->mensaje   = "Los datos introducidos no son correctos";
			}
			
		} else {
			$query = "SELECT * FROM usuarios WHERE LOWER(email)='".strtolower($usuario)."' AND contrasena='".$clave."'";
			//print_r($query);exit;
	        if( ($arr_reg = $this->conn->load($query)) != null ){
	
				if($arr_reg[0]->activado == 'N'){
	                $ack->resultado = false;
	                $ack->mensaje   = "Tu usuario no ha sido activado, si deseas activarlo revisa tu email.<br>(Si no lo encuentras revisa tu carpeta de Spam)";
	            }
				
			} else {
	            $ack->resultado = false;
	            $ack->mensaje   = "Usuario/Password incorrectos";
			}
		}
        return $ack;
	}
	
    // Obtengo los elementos de la tabla usuarios que cumplen el patron de filtros enviado
    function get_usuarios ($arr_filtros, $limit=null){
        $ack = new ACK();
        $ack->resultado = true;
        // Primero añadiremos los filtros
        $filtros = componer_filtro ($arr_filtros);
    
        if(strpos($limit, "Limit -")) $limit="";
        $query = "SELECT * FROM usuarios ".$filtros." ".get_order ("nombre,apellido1","asc")." ".$limit; // + filtros
        // print $query;
        if( ($arr_reg = $this->conn->load($query)) != null ){
            $ack->datos = $arr_reg;
        } else {
            $ack->resultado = false;
            $ack->mensaje   = "Se ha producido un error al obtener usuarios, ponte en contacto con tu administrador";
        }
        return $ack;
    }
    
	// Obtengo los elementos de la tabla usuarios que cumplen el patron de filtros enviado
    function get_nombre_usuario ($id_usuario){
        $ack = new ACK();
        $ack->resultado = true;
    
        $query = "SELECT nombre FROM usuarios ";
        // print $query;
        if( ($arr_reg = $this->conn->load($query)) != null ){
            $ack->datos = $arr_reg[0]->nombre;
        } else {
            $ack->resultado = false;
            $ack->mensaje   = "Se ha producido un error al obtener usuarios, ponte en contacto con tu administrador";
        }
        return $ack->datos;
    }

    // Devuelvo el total de elemntos de la tabla usuarios que cumplen el filtro enviado
    function get_total_usuarios ($arr_filtros){
        $ack = new ACK();
        $ack->resultado = true;
        // Primero añadiremos los filtros
        $filtros = componer_filtro ($arr_filtros);
    
        $query = "SELECT COUNT(*) AS TANTOS FROM usuarios ".$filtros; 
        // print $query;
        if( ($arr_reg = $this->conn->load($query)) != null ){
            $ack->datos = $arr_reg[0]->TANTOS;
        } else {
            $ack->resultado = true;
            $ack->mensaje   = "Se ha producido un error al obtener el total, ponte en contacto con tu administrador";
        }
        return $ack->datos[0]->TANTOS;
    }

    // Realizamos la insercion de la tabla usuarios y su modificacion si el indice es distinto de null
    function update_usuarios2 ($id_usuarios, $nombre, $apellido1, $apellido2, $telefono, $direccion, $poblacion, $pais, $dc_provincia, $codigo_postal, $email, $contrasena, $activado, $fh_alta, $fh_actualizacion, $nif){
        $ack = new ACK();
        $ack->resultado = true;

        $update = false;
        $query = "select * from usuarios where id_usuarios='".$id_usuarios."'";
        $res = $this->conn->load($query);
        if(sizeof($res)>0){
            $update = true;
        }

        if($update==true){
            // update
            $query = "update usuarios set nombre='".$nombre."', apellido1='".$apellido1."', apellido2='".$apellido2."', telefono='".$telefono."', direccion='".$direccion."', poblacion='".$poblacion."', pais='".$pais."', dc_provincia='".$dc_provincia."', codigo_postal='".$codigo_postal."', email='".$email."', contrasena='".$contrasena."', activado='".$activado."', fh_alta='".$fh_alta."', fh_actualizacion='".$fh_actualizacion."', nif='".$nif."' where id_usuarios='".$id_usuarios."' ";
            // print $query;
            if($this->conn->update($query)==false){
                $ack->resultado = false;
                $ack->mensaje   = "No se ha podido actualizar el objeto, contacte con su administrador";
            } else {
                $ack->id = $id_usuarios;
            }
        } else {
            // insert
            $query = "insert into usuarios (id_usuarios, nombre, apellido1, apellido2, telefono, direccion, poblacion, pais, dc_provincia, codigo_postal, email, contrasena, activado, fh_alta, fh_actualizacion, nif) values ('".$id_usuarios."', '".$nombre."', '".$apellido1."', '".$apellido2."', '".$telefono."', '".$direccion."', '".$poblacion."', '".$pais."', '".$dc_provincia."', '".$codigo_postal."', '".$email."', '".$contrasena."', '".$activado."', '".$fh_alta."', '".$fh_actualizacion."', '".$nif."');";
            // print $query;
            $res = $this->conn->insert($query);
            if($res==null){
                $ack->resultado = false;
                $ack->mensaje   = "No se ha podido insertar el objeto, contacte con su administrador";
            } else {
                $ack->id = $res;
            }
        }

        return $ack;
    }

    // Eliminamos de la tabla usuarios y si hay dependencias caerian en cascada
    function remove_usuarios ($id_usuarios){
        global $log;
        $ack = new ACK();
        $ack->resultado = true;
    
        $query = "select * from usuarios where ID_usuarios='".$id_usuarios."'";
        $arr_res = $this->conn->load ($query);
        if(sizeof($arr_res)>0){
        
            // Primero elimino el objeto principal
            $query = "delete from usuarios where ID_usuarios='".$id_usuarios."'";
            $res = $this->conn->remove ($query);
        
            if($res==true){
                // Aqui pondriamos las dependencias
            }
        
            $ack->id = $arr_res[0]->ID_usuarios;
        } else {
            $ack->resultado = false;
            $ack->mensaje   = "No se ha localizado la usuarios, consulte a su administrador";
            $ack->id        = $id_usuarios;
        }
    
        // Escribo las trazas
        if($ack->resultado==true){
            $log->output ("ELIMINAR_usuarios", $ack->id, "usuarios", "", "", "");
        } else {
            $log->output ("ELIMINAR_usuarios", $ack->id, "usuarios", "", "", "Error: ".$ack->mensaje);
        }
    
        return $ack;
    }
    // Realizamos la insercion de la tabla usuarios y su modificacion si el indice es distinto de null
    function update_usuarios ($datos){
        $ack = new ACK();
        $ack->resultado = true;
        $tabla='usuarios';
        
        $query = "select * from usuarios where email='".$datos['email']."'";
        $arr_res = $this->conn->load ($query);
        if(sizeof($arr_res)>0 && $datos['id_usuarios']==null){
        	$ack->resultado = false;
        	$ack->mensaje = "Email ya registrado, si desea recordar la contraseña pulse <a href='/recordar-password/'>aqui</a>";
        }else{
	        //COMPROBAR ARRAY DE DATOS, SI ESTA VACIO O NO.
	        if($datos==null || sizeof($datos)==0){
	            $ack->mensaje ="Los parametros enviados para la tabla ".$tabla." están vacíos";
	            print_r($ack->mensaje);
	        }
	        //COGER CAMPOS DE LA TABLA
	        $campos = $this->conn->get_table_info($tabla);
	        
	        if($ack->resultado==false){
	            print_r($ack->mensaje);
	        }else{
	            $res = $this->conn->stor($datos,$tabla);
	            $ack->id =  $this->conn->id;
	        }
        }
        
	    return $ack;
	}
	
	function activate_user($id_usuario){
 		$ack = new ACK();
        $ack->resultado = true;
        $ack->mensaje = "Tu usuario ha sido activado correctamente, ya puedes iniciar sesión.";
        
		// update
		$query = "update usuarios set activado='S' where id_usuarios='".$id_usuario."' ";
		// print $query;
		if($this->conn->update($query)==false){
			$ack->resultado = false;
			$ack->mensaje   = "No se ha podido activar tu usuario, inténtalo de nuevo o contacta con nosotros!";
		} else {
			$ack->id = $id_usuario;
		}

        return $ack;
	}
}
?>