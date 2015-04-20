<?
	class Log {
		
		var $_USUARIO      = "";
		var $_TIPO_USUARIO = "";
		var $_ID_USUARIO   = "";
		var $_LOGFILE      = "trazas.log";
        var $_LOGPATH      = "";
		
		function Log ($ip, $usuario, $tipo_usuario, $id_usuario){
            global $LOG_DIR;
            
            $this->_LOGPATH = $LOG_DIR."./".$this->_LOGFILE;
			$this->_IP           = $ip;
			$this->_USUARIO      = $usuario;
			$this->_TIPO_USUARIO = $tipo_usuario;
			$this->_ID_USUARIO   = $id_usuario;
		}
		
		function output ($operacion, $id_elemento_asignado, $tipo_elemento_asignado, $id_relacionado, $tipo_id_relacionado, $observaciones){
			global $_SERVER;
			global $_dia, $_mes, $_ano, $_hora, $_min, $_seg;
			
			// operacion
			//     Cada operacion tiene un comando, este esta definido en el fichero de idioma
			//
			// id_elemento_asignado
			//     Cada operacion esta normalmente relacionado con un id, 
			//     lo normal es que sea de informe, pero puede ser cualquier id de la BBDD
			//
			// tipo_elemento_asignado
			// 	   es el nombre de la tabla a la que esta asignado el id anterior
			//
			// id_relacionado
			//     Cuando la accion se efectua sobre otro elemento de la BBDD debemos ponerlo
			//     en este posicion por ejemplo asociar un taller a un informe
			//
			// tipo_id_relacionado
			//     Nombre de la tabla al que pertenece el id anterior
			//
			// observaciones
			//     Texto libre asociado a la operacion
			$cadena = $this->_IP."|".
						$this->_USUARIO."|".
						$this->_TIPO_USUARIO."|".
						$this->_ID_USUARIO."|".
						$_hora.":".$_min." ".$_dia."/".$_mes."/".$_ano."|".
						$operacion."|".
						$id_elemento_asignado."|".
						$tipo_elemento_asignado."|".
						$id_relacionado."|".
						$tipo_id_relacionado."|".
						$observaciones."\n";

			// Este log sera procesado por la BBDD
	        $logFile = fopen($this->_LOGPATH, "a");
	        fwrite($logFile, $cadena);
	        fclose($logFile);
		}
	}
?>