<?
	function dias_transcurridos($fecha_i,$fecha_f){
		if($fecha_i != "0000-00-00"){
			$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
			$dias 	= abs($dias); $dias = floor($dias);
		}else{
			$dias = 0; 
		}		
		return $dias;
	}

	function url_amigable($string) {
		$string = trim($string);
	
	    $string = str_replace(
	        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
	        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
	        $string
	    );
	
	    $string = str_replace(
	        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
	        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
	        $string
	    );
	
	    $string = str_replace(
	        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
	        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
	        $string
	    );
	
	    $string = str_replace(
	        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
	        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
	        $string
	    );
	
	    $string = str_replace(
	        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
	        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
	        $string
	    );
	
	    $string = str_replace(
	        array('ñ', 'Ñ', 'ç', 'Ç'),
	        array('n', 'N', 'c', 'C',),
	        $string
	    );
	
	    //Esta parte se encarga de eliminar cualquier caracter extraño
	    $string = str_replace(
	        array("\\", "¨", "º", "~",
	             "#", "@", "|", "!", "\"",
	             "·", "$", "%", "&", "/",
	             "(", ")", "?", "'", "¡",
	             "¿", "[", "^", "`", "]",
	             "+", "}", "{", "¨", "´",
	             ">", "< ", ";", ",", ":",
	             ".", " "),
	        '',
	        $string
	    );
	
	    return $string;
	}

    function urlUploadFile ($urlImagen){
        global $repository,$TMP_DIR;
        
        $ruta_archivo = null;
        
        //hago el curl y me traigo la imagen en binario
        $imagen = get_url($urlImagen);
        
        if($imagen!=null && strpos($imagen, 'html') === false){
            
            //creo el nombre de la imagen temportal
            $nombre_archivo = getmypid().'.'.file_extension($urlImagen);
            
            //creo un fichero y en el tmp para la imagen
            $archivo = fopen($TMP_DIR."/".$nombre_archivo, 'wb');
            
            //si se ha abierto bien entonces escribo
            if($archivo){
                //escribo el binario en el fichero
                fwrite($archivo, $imagen);
                fclose($archivo);
                
                //guardo el nombre del archivo subido
                $archivo_subido = $TMP_DIR."/".$nombre_archivo;
            
                //necesito saber el nombre que va desde el ultimo / hasta el ultimo . (el de la extensión)
                $pos_inicio = strripos($urlImagen, "/");
                $pos_fin    = strripos($urlImagen, ".");
                
                //corto la url
                $nombre_real_archivo = substr($urlImagen, ($pos_inicio+1), $pos_fin);
                $nombre_archivo_curl = $nombre_archivo;
                
                //creo el array de la imagen
                $imagen = array();
                $imagen['name'] = $nombre_real_archivo;
                $imagen['tmp_name'] = $archivo_subido;
                
                //se lo envio a uploadFile que me devuelve la ruta que es la que luego retorno
                $ruta_archivo = uploadFile($imagen);
            }
        }
        return $ruta_archivo;
    }
    
    function get_url ($url){
        global $SERVER_HOME;

        ini_set("memory_limit","20M");
        set_time_limit (120);

        $cmd = "/usr/bin/curl \"".$url."\" ";
        $res = `$cmd`;
        
        return $res;
    }
    
    function uploadFile ($arr_file_desc){
        global $repository;
        //require_once ($_SERVER["DOCUMENT_ROOT"].'/lib/wideimage/lib/WideImage.php');
        
        $dia = date("j");
        $mes = date("n");
        $ano = date("Y");
        $hora = date("H");
        $min = date("i");
        $seg = date("s");

        // $REPOSITORY
        $arr_file = array();
        $file_extension = file_extension ($arr_file_desc['name']);

        $new_relative_path = $ano."/".$mes."/".$dia;
        $new_file_name = $dia.$mes.$ano.$hora.$min.$seg;
        
        // Creamos la estructura de carpetas
        createPath ($new_relative_path);        
        
        // Si existe el archivo creo un secuencial hasta encontrar uno libre
        $secuencial = 0;
        while ( file_exists($repository."/".$new_relative_path."/".$new_file_name.".".$file_extension) ){
            $secuencial++;
            $new_file_name .= $secuencial;
        }

        //if ($extension=="jpg"||$extension=="jpeg"||$extension=="gif"||$extension=="png") {
            // Cargo la marca de agua
          //  $watermark = WideImage::load($_SERVER["DOCUMENT_ROOT"].'/tpl_guest/images/logo_wm.png');

//            WideImage::load($arr_file_desc['tmp_name'])
  //              ->resize(800, 600)
    //            ->merge($watermark, 'right', 'top + 10', 100)
      //          ->saveToFile($repository."/".$new_relative_path."/".$new_file_name.".".$file_extension);
        //}else{
            if (file_exists($arr_file_desc['tmp_name'])) {
                if( !copy($arr_file_desc['tmp_name'], $repository."/".$new_relative_path."/".$new_file_name.".".$file_extension) ){
                     //  print "Error, no puedo copiar";
                } else {
                    unlink ($arr_file_desc['tmp_name']);
                    // print "Copiado ".$new_file_name.".".$file_extension; exit;
                }
            } else {
               echo "Error en el envio. Fichero: " . $arr_file_desc['name'];
            }
       // }
        //@@
        $new_file_path        = $new_relative_path."/".$new_file_name.".".$file_extension;
        $origen_dir           = $repository."/".substr( $new_file_path, 0, strrpos($new_file_path, "/") )."/";
        $nombre_archivo       = substr( $new_file_path, (strrpos($new_file_path, "/")+1) );
        $nombre_sin_extension = substr( $nombre_archivo, 0, strrpos($nombre_archivo, ".") );
        $extension            = substr( $new_file_path, strrpos($new_file_path, ".")+1 );

        /*//Si es una imagen, hago un thumbnail
        if ($extension=="jpg"||$extension=="jpeg"||$extension=="gif"||$extension=="png") {
            WideImage::load($origen_dir.$nombre_archivo)
                ->resize(288, 240)
                ->saveToFile($repository."/".$new_relative_path.'/'.$new_file_name.'_z.png');
        }*/

        // Devuelvo [a?o]/[mes]/[dia]/[nombre].[ext]
        return $new_file_path;
    }

    function convertir_fecha_espanol ($fecha){
        // Viene tal que 
        // 2005-12-20 00:00:00
        if($fecha!=null){
            $ano = substr($fecha, 0, 4);
            $mes = substr($fecha, 5, 2);
            $dia = substr($fecha, 8, 2);
            return $dia."/".$mes."/".$ano;
        } else {
            return "";
        }
    }
    function convertir_fecha_espanol_completa ($fecha){
        // Viene tal que 
        // 2005-12-20 00:00:00
        if(trim($fecha)=="" || $fecha=="0000-00-00 00:00:00" || $fecha=="0000-00-00"){
            return "";
        } else {
            $timestamp = strtotime($fecha);
            return date('d/m/Y H:i', $timestamp);
        }
    }
    function convertir_fecha_ingles ($fecha){
        // Viene tal que 
        // 20/12/2006
//        if($fecha!=null){
            $dia = substr($fecha, 0, 2);
            $mes = substr($fecha, 3, 2);
            $ano = substr($fecha, 6, 4);
            return $ano."-".$mes."-".$dia; // ." 00:00:00"
//        } else {
//            return "";
//        }
    }
	function objectToArray($d) {
		if (is_object($d)) {
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}
 
		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(__FUNCTION__, $d);
		}
		else {
			// Return array
			return $d;
		}
	}

	function arrayToObject($d) {
		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return (object) array_map(__FUNCTION__, $d);
		}
		else {
			// Return object
			return $d;
		}
	}

    function array_to_string($array) {
	   $retval = '';
	   $null_value = "^^^";
	   foreach ($array as $index => $val) {
	       if(gettype($val)=='array') $value='^^array^'.array_to_string($val);    else $value=$val;
	       if (!$value)
	           $value = $null_value;
	       $retval .= urlencode(base64_encode($index)) . '|' . urlencode(base64_encode($value)) . '||';
	   }
	   return urlencode(substr($retval, 0, -2));
	}
	 
	function string_to_array($string) {
	   $retval = array();
	   $string = urldecode($string);
	   $tmp_array = explode('||', $string);
	   $null_value = urlencode(base64_encode("^^^"));
	   foreach ($tmp_array as $tmp_val) {
	       list($index, $value) = explode('|', $tmp_val);
	       $decoded_index = base64_decode(urldecode($index));
	       if($value != $null_value){
	           $val= base64_decode(urldecode($value));
	           if(substr($val,0,8)=='^^array^') $val=string_to_array(substr($val,8));
	           $retval[$decoded_index]=$val;
	         }
	       else
	           $retval[$decoded_index] = NULL;
	   }
	   return $retval;
	} 

	function file_extension ($source){
	    return strtolower(substr(strrchr($source,"."),1));
	}
	
	function anade_filtrado ( &$parametros_filtrado, $nombre_campo, $valor, $comparativa, $concatenado="and", $tipo_comparativa="normal" ){
		$fila = array("campo"=>$nombre_campo, "valor"=>$valor, "comparativa"=>$comparativa, "concatenado"=>$concatenado, "tipo_comparativa"=>$tipo_comparativa);
		array_push($parametros_filtrado, $fila);
        return $parametros_filtrado;
	}
	
    function componer_filtro ($parametros_filtrado){
        if ($parametros_filtrado==null) return "";
       if($parametros_filtrado!=null){$filters = "WHERE ( ";}
        
       $c1=0;
       $contar_or=0;
       // primero cuento los or que hay para que no me printe un "or (" al llegar al último or que haya.
        foreach($parametros_filtrado as $key=>$value ){
            if(strtolower($value['concatenado'])=="or"){
            	$contar_or++;
            }
        }
        foreach($parametros_filtrado as $key=>$value ){
            if(strtolower($value['concatenado'])=="and"){
            	$contar_and++;
            }
        }
        if($contar_or==0){
             foreach($parametros_filtrado as $key1=>$value1 ){
        		if(strtolower($value1['concatenado'])=="and"){
        			//si es distinto de 0 ponemos un and despues de cada filtro para que el primero no lleve and
        			if($c1!=0){$filters .= " and ";}
        			$c1++;
        			if($value1['comparativa'] == "like" || $value1['comparativa'] == "not like") {
                        $filters .= " LOWER(".$value1['campo'].") ".$value1['comparativa']." LOWER('%".trim($value1['valor'])."%') ";
                    } else if($value1['comparativa'] == "is" || $value1['comparativa'] == "is not") {
                        $filters .= " ".$value1['campo']." ".$value1['comparativa']." ".trim($value1['valor'])." ";
                    } else if($value1['comparativa'] == "IN"){
                      	$filters .= " ".$value1['campo']." ".$value1['comparativa']." ".trim($value1['valor'])." ";
                    } else if($value1['comparativa'] == "literal") {
                        $filters .= " ".$value1['campo']." = ".trim($value1['valor'])." ";
                    } else {
                        if($value1['tipo_comparativa']=="normal"){
                            $filters .= " ".$value1['campo']." ".$value1['comparativa']." '".trim($value1['valor'])."' ";
                        } else if($value1['tipo_comparativa']=="float"){
                            $filters .= " cast(".$value1['campo']." as DECIMAL(9,2)) ".$value1['comparativa']." cast('".trim($value1['valor'])."' as DECIMAL(9,2) ) ";
                        }
                    }
    				            
                }	
            }
        }
        
        //primero recorro los or porque la estructura es ( and )or( ... and ...and ... )
        foreach($parametros_filtrado as $key=>$value ){
            if(strtolower($value['concatenado'])=="or"){
            	//seguidamente recorro los and que van dentro de cada or
            	foreach($parametros_filtrado as $key1=>$value1 ){
            		if(strtolower($value1['concatenado'])=="and"){
            			//si es distinto de 0 ponemos un and despues de cada filtro para que el primero no lleve and
            			if($c1!=0){$filters .= " and ";}
            			$c1++;
            			if($value1['comparativa'] == "like" || $value1['comparativa'] == "not like") {
		                    $filters .= " LOWER(".$value1['campo'].") ".$value1['comparativa']." LOWER('%".trim($value1['valor'])."%') ";
		                } else if($value1['comparativa'] == "is" || $value1['comparativa'] == "is not") {
		                    $filters .= " ".$value1['campo']." ".$value1['comparativa']." ".trim($value1['valor'])." ";
		                } else if($value1['comparativa'] == "literal") {
		                    $filters .= " ".$value1['campo']." = ".trim($value1['valor'])." ";
		                } else if($value1['comparativa'] == "in"){
                      		$filters .= " ".$value1['campo']." ".$value1['comparativa']." ".trim($value1['valor'])." ";
                        } else {
		                    if($value1['tipo_comparativa']=="normal"){
		                        $filters .= " ".$value1['campo']." ".$value1['comparativa']." '".trim($value1['valor'])."' ";
		                    } else if($value1['tipo_comparativa']=="float"){
		                        $filters .= " cast(".$value1['campo']." as DECIMAL(9,2)) ".$value1['comparativa']." cast('".trim($value1['valor'])."' as DECIMAL(9,2) ) ";
		                    }
		                }
						            
            		}				
            	}
            	
    			$c1=0;
                if($contar_and!=0){$filters .= " and ";}
				if($value['comparativa'] == "like" || $value['comparativa'] == "not like") {
                    $filters .= " LOWER(".$value['campo'].") ".$value['comparativa']." LOWER('%".trim($value['valor'])."%') ";
                } else if($value['comparativa'] == "is" || $value['comparativa'] == "is not") {
                    $filters .= " ".$value['campo']." ".$value['comparativa']." ".trim($value['valor'])." ";
                } else if($value['comparativa'] == "literal") {
                    $filters .= " ".$value['campo']." = ".trim($value['valor'])." ";
                } else {
                    if($value['tipo_comparativa']=="normal"){
                        $filters .= " ".$value['campo']." ".$value['comparativa']." '".trim($value['valor'])."' ";
                    } else if($value['tipo_comparativa']=="float"){
                        $filters .= " cast(".$value['campo']." as DECIMAL(9,2)) ".$value['comparativa']." cast('".trim($value['valor'])."' as DECIMAL(9,2) ) ";
                    }
                }
        		//aqui solo pinto or si no es el último
        		$contar_or--;
        		if($contar_or>0){$filters .= " ) or ( ";}
            }
        }
        
        //cierro todo
      	if(sizeof($parametros_filtrado)>0) $filters .= " ) ";
      	// print $filters;
       
        return $filters;
    }
	
	function zip_file ($origen, $destino){
		$cmd = "zip -j \"".$destino."\" ".
				"\"".$origen."\"";
		// print $cmd;
		$res = `$cmd`;
	}
	
	function to_float ($valor){
		if($valor==""){
			$valor = 0.00;
		} else {
		    // Obtengo las posiciones de los signos de puntuacion
		    $coma  = strpos($valor,",");
		    $punto = strpos($valor,".");
		    
		    // si tiene punto y está a la izquierda de la coma, eliminamos el punto porque es de miles
		    if($punto>-1){
		        // 22.000,00
		        if($punto < $coma){
		            $valor = str_replace(".", "", $valor); // replace '.' with ''
		        }
		    }
		    
			$valor = str_replace(",", ".", $valor); // replace ',' with '.'
		}
		return sprintf ('%.2f', $valor);
	}
	
	function to_display_float ($valor){
		$valor = str_replace(",", ".", $valor); // replace ',' with '.'
		
		$formato_americano = sprintf ('%.2f', $valor);
		return str_replace(".", ",", $formato_americano);
	}

	function encrypt($text){
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$key = "Javier de Juan";
		$enc = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv));
		$enc = str_replace("+", "234Z2", $enc);
		$enc = str_replace("=", "89yhg", $enc);
		$enc = str_replace("?", "98bh5", $enc);
		$enc = str_replace("%", "kjh76", $enc);
		$enc = str_replace("/", "bjk67", $enc);
		return $enc;
	}
	
	function decrypt($text){
	    $text = str_replace("234Z2", "+", $text);
	    $text = str_replace("89yhg", "=", $text);
	    $text = str_replace("98bh5", "?", $text);
	    $text = str_replace("kjh76", "%", $text);
	    $text = str_replace("bjk67", "/", $text);
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$key = "Javier de Juan";
		//I used trim to remove trailing spaces
		return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($text), MCRYPT_MODE_ECB, $iv));
	}

    function utf2iso ($input){
        if(is_array  ($input)){
            $array_temp = array ();
            foreach($input as $name => $value) {
                if(is_array($value)) {
                    $array_temp[(mb_detect_encoding($name." ",'UTF-8,ISO-8859-1') == 'UTF-8' ? utf8_decode($name) : $name )] = utf2iso($value);
                } else {
                    $array_temp[(mb_detect_encoding($name." ",'UTF-8,ISO-8859-1') == 'UTF-8' ? utf8_decode($name) : $name )] = (mb_detect_encoding($value." ",'UTF-8,ISO-8859-1') == 'UTF-8' ? utf8_decode($value) : $value );
                }
            }
            return $array_temp;
        } else {
            if(mb_detect_encoding($input." ",'UTF-8,ISO-8859-1') == 'UTF-8'){
                return utf8_decode($input);
            } else {
                return $input;
            }
        }
    }

    function to_utf8($in){
        if (is_array($in)) {
            foreach ($in as $key => $value) {
                $out[to_utf8($key)] = to_utf8($value);
            }
        } elseif(is_string($in)) {
            if(mb_detect_encoding($in) != "UTF-8")
                return utf8_encode($in);
            else
                return $in;
        } else {
            return $in;
        }
        return $out;
    } 

    function calcula_iva ($cantidad){
        return (to_float($cantidad)*0.16);
    }

    function ordenar_array_de_objetos ($array, $campo, $sentido="asc"){
        $arr_temp = array ();
        // Compongo un nuevo array con indice campo buscado mas la key inicial por si no hay datos
        foreach ($array as $key => $val){
            $arr_temp[$val->{$campo}."_".$key] = $val;
        }
        // Ordeno el nuevo array por indices
        if( ksort($arr_temp, SORT_REGULAR) ){
            if(strtolower($sentido)=="asc"){
                return $arr_temp;
            } else {
                return array_reverse($arr_temp, true);
            }
        } else {
            return $array;
        }
    }
    
    function detect_mobile ($no1, $no2){
        $no1 = clean_mobile ($no1);
        $no2 = clean_mobile ($no2);
        if( trim($no1)!="" && 
            substr($no1, 0, 1)=="6" ){
            return $no1;
        } else if( trim($no2)!="" && 
                substr($no2, 0, 1)=="6" ) {
            return $no2;
        } else {
            return "";
        }
    }
    
    function clean_mobile ($no){
        $no = str_replace(" ", "", $no);
        $no = str_replace("-", "", $no);
        $no = str_replace("/", "", $no);
        $no = str_replace(".", "", $no);
        $no = str_replace("+34", "", $no);
        $no = str_replace("0034", "", $no);
        return $no;
    }

    // ///////////////////////////////////////
    // Excel Functions
    // //////////////////////////////////////
    function xls_leer ($archivo, $primera_fila_cabeceras=true){

        set_include_path($_SERVER["DOCUMENT_ROOT"] . '/lib/PHPExcel/');
        require_once 'PHPExcel.php';
        include 'PHPExcel/IOFactory.php';
        $objPHPExcel = new PHPExcel();
        $objReader = PHPExcel_IOFactory::createReader('Excel5');

        // Hoja 1
        $objPHPExcel = $objReader->load($archivo);
        $objWorksheet = $objPHPExcel->getActiveSheet();

        return xls_leer_hoja ($objWorksheet, $primera_fila_cabeceras);
    }

    function xls_leer_hoja ($objWorksheet, $primera_fila_cabeceras=true){
        // print "Filas: ". $objWorksheet->getHighestRow();
        // print "Columnas: ". $objWorksheet->getHighestColumn();
        // print "Orden:". PHPExcel_Cell::columnIndexFromString($objWorksheet->getHighestColumn());

        $highestRow = $objWorksheet->getHighestRow();
        $highestCol = PHPExcel_Cell::columnIndexFromString($objWorksheet->getHighestColumn());

        $hoja = array ();
        if($primera_fila_cabeceras){
            for ($row = 2; $row <= $highestRow; ++$row) {

                    $fila = array ();
                    for ($col = 0; $col < $highestCol; ++$col) {
                        $val = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                        // $val = iconv('iso-8859-1', 'utf-8', $val);
                        // Reemplazaremos las comillas simples por apostrofes
                        $val = str_replace ("'", "`", $val);
                        $val = str_replace ("\"", "`", $val);
                        $fila[trim($objWorksheet->getCellByColumnAndRow($col, 1)->getValue())] = $val;
                    }
                    array_push($hoja, $fila);
            }
        } else {
            for ($row = 1; $row <= $highestRow; ++$row) {
                $fila = array ();
                for ($col = 0; $col < $highestCol; ++$col) {
                    $val = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                    // $val = iconv('iso-8859-1', 'utf-8', $val);
                    // Reemplazaremos las comillas simples por apostrofes
                    $val = str_replace ("'", "`", $val);
                    $val = str_replace ("\"", "`", $val);
                    $fila[$col] = $val;
                }
                array_push($hoja, $fila);
            }
        }
        return $hoja;
    }
    
    function xls_date($serial){
        // Excel/Lotus 123 have a bug with 29-02-1900. 1900 is not a
        // leap year, but Excel/Lotus 123 think it is...
        if ($serial == 60) {
            $day = 29;
            $month = 2;
            $year = 1900;
            return sprintf('%04d/%02d/%02d', $year, $month, $day);
        }
        else if ($serial < 60) {
            // Because of the 29-02-1900 bug, any serial date
            // under 60 is one off... Compensate.
            $serial++;
        }
        // Modified Julian to YYYYMMDD calculation with an addition of 2415019
        $l = $serial + 68569 + 2415019;
        $n = floor(( 4 * $l ) / 146097);
        $l = $l - floor(( 146097 * $n + 3 ) / 4);
        $i = floor(( 4000 * ( $l + 1 ) ) / 1461001);
        $l = $l - floor(( 1461 * $i ) / 4) + 31;
        $j = floor(( 80 * $l ) / 2447);
        $day = $l - floor(( 2447 * $j ) / 80);
        $l = floor($j / 11);
        $month = $j + 2 - ( 12 * $l );
        $year = 100 * ( $n - 49 ) + $i + $l;
        return sprintf('%04d/%02d/%02d', $year, $month, $day);
    }
    
    
    function text2url($string) {
        $string = unacent($string);
        $spacer = "-";
        $string = trim($string);
        $string = strtolower($string);
        $string = trim(preg_replace("/[^ A-Za-z0-9_]/i", " ", $string)); 
        $string = preg_replace("/[ \t\n\r]+/i", "-", $string);
        $string = str_replace(" ", $spacer, $string);             
        $string = str_replace(",", $spacer, $string);
        $string = preg_replace("/[ -]+/i", $spacer, $string);
        return $string; 
    }
    
    function unacent($text){
        static $test = array();
        if (empty($test)){
            $html = // Obtenemos la tabla
            get_html_translation_table(HTML_ENTITIES);

            foreach ($html as $char => $ord){
                if (ord($char) >= 192){
                    $test[$char] = $ord[1];
                }
            }
        } // Cambios de acentos...
        $text = strtr($text, $test);
        return $text;
    }

    // CUIDADO CON ESTE METODO
    function remove_dir($dir) {
        if($dir=="" || $dir=="/"){
            // Esto no lo vamos a permitir
        } else {
            $files = glob( $dir . '*', GLOB_MARK );
            foreach( $files as $file ){
                if( substr( $file, -1 ) == '/' )
                    remove_dir( $file );
                else
                    unlink( $file );
            }
            if(is_dir($dir)){
                rmdir( $dir );
            }
        }
    }
	
	function get_order ($default=null, $stream=null){
        global $_REQUEST;
        
        if($_REQUEST["srch_orden"]!=null){
            $default = $_REQUEST["srch_orden"];
        }
        
        if($_REQUEST["srch_orden_sentido"]!=null){
            $stream = $_REQUEST["srch_orden_sentido"];
        }
        
        if($stream==null){
            $stream = "desc";
        }
        
        if($default==null){
            return "";
        } else {
            return " order by ".$default." ".$stream." ";
        }
    }

	function lower($string) {
        return utf8_encode(strtolower(utf8_decode($string)));
    }
    function long_title($title, $max){
        $done   = false;
        $cutted = false;
        while ($done==false){
            if(strlen($title)>$max){
                $espacios = explode(" ", $title);
                if(sizeof($espacios)>1){ // Todavia podemos quitar palabras
                    $title  = substr($title, 0, strrpos($title, " ") );
                    $cutted = true;
                } else { // Corto la cadena por donde sea porque ya solo queda una palabra
                    $title  = substr($title, 0, $max);
                    $cutted = true;
                    $done   = true;
                }
            } else {
                $done = true;
            }
        }
        if($cutted) $title.="...";
        return $title;
    }
    
    function createPath ($new_path){
		global $repository;
		
		$arrFolders = explode ("/", $new_path);
		for( $i=0; $i<(sizeof($arrFolders)); $i++ ){
			$path = "";
			for( $j=0; $j<=$i; $j++ ){
				$path .= $arrFolders[$j]."/";
			}
			if( !is_dir($repository."/".$path) ){
				mkdir ( $repository."/".$path, 0755 );
				// print "No existe el directorio: ".$path_en_servidor.$path."<br>\n";
			}
		}
	}
    
    function simple_copy_to_repository ($file_path){
        $arr_ = array ();
        $arr_["name"] = $file_path;
        $arr_["tmp_name"] = $file_path;
        return copy_to_repository ($arr_);
    }
    
    function copy_to_repository ($arr_file_desc){
        global $repository;
        
        $dia = date("j");
        $mes = date("n");
        $ano = date("Y");
        $hora = date("H");
        $min = date("i");
        $seg = date("s");
        
        // $repository
        $arr_file = array();
        $file_extension = strtolower( substr($arr_file_desc['name'], (strrpos($arr_file_desc['name'],".")+1)) );

        // Genero un aleatorio valido para evitar solapes
        list($usec, $sec) = explode(" ", microtime());
        srand((int)($usec*10));
        $aleatorio = rand(0, 9999);
        
        $new_relative_path = $ano."/".$mes."/".$dia;
        $new_file_name = $dia.$mes.$ano.$hora.$min.$seg."_".$aleatorio;
        $destino = $new_relative_path."/".$new_file_name.".".$file_extension;

        $max = 1000; $i=0;
        while ($i<1000){
            if(!file_exists($repository."/".$destino)){
                break;
            } else {
                $destino = $new_relative_path."/".$new_file_name."_".$i.".".$file_extension;
            }
        }
        // print "DESTINO [".$destino."]";
        // Creamos la estructura de carpetas
        createPath ($new_relative_path);
        
        if( !copy($arr_file_desc['tmp_name'], $repository."/".$destino) ){
            print "Error, no puedo copiar";
        } else {
            unlink ($arr_file_desc['tmp_name']);
            // print "Copiado";
        }
        
        // Devuelvo [año]/[mes]/[dia]/[nombre].[ext]
        return $destino;
    }
    
    function simple_copy_to_error_repository ($file_path){
        $arr_ = array ();
        $arr_["name"] = $file_path;
        $arr_["tmp_name"] = $file_path;
        return copy_to_error_repository ($arr_);
    }
    
    function copy_to_error_repository ($arr_file_desc){
        global $error_repository;
        
        $repository = $error_repository;
        
        $dia = date("j");
        $mes = date("n");
        $ano = date("Y");
        $hora = date("H");
        $min = date("i");
        $seg = date("s");
        
        // $repository
        $arr_file = array();
        $file_extension = strtolower( substr($arr_file_desc['name'], (strrpos($arr_file_desc['name'],".")+1)) );

        // Genero un aleatorio valido para evitar solapes
        list($usec, $sec) = explode(" ", microtime());
        srand((int)($usec*10));
        $aleatorio = rand(0, 9999);
        
        $new_relative_path = $ano."/".$mes."/".$dia;
        $new_file_name = $dia.$mes.$ano.$hora.$min.$seg."_".$aleatorio;
        $destino = $new_relative_path."/".$new_file_name.".".$file_extension;

        $max = 1000; $i=0;
        while ($i<1000){
            if(!file_exists($repository."/".$destino)){
                break;
            } else {
                $destino = $new_relative_path."/".$new_file_name."_".$i.".".$file_extension;
            }
        }
        // print "DESTINO [".$destino."]";
        // Creamos la estructura de carpetas
        createPath ($new_relative_path);
        
        if( !copy($arr_file_desc['tmp_name'], $repository."/".$destino) ){
            print "Error, no puedo copiar";
        } else {
            unlink ($arr_file_desc['tmp_name']);
            // print "Copiado";
        }
        
        // Devuelvo [año]/[mes]/[dia]/[nombre].[ext]
        return $destino;
    }
    
    function enviar_mail ($emailaddress, $fromaddress, $emailsubject, $body, $attachments=false){
        global $dominio_absoluto;
        require_once (dirname(__FILE__)."/../clases/CCorreo.php");
        
        if($fromaddress==null){
            $fromaddress="TusAdhesivos";
        }
        if($emailsubject==null){
            $emailsubject="Mensaje generado desde TusAdhesivos";
        }
        
        $filename = dirname(__FILE__)."/../tpl_guest/common/mail.html";
        $handle   = fopen($filename, "r");
        $contents = fread($handle, filesize($filename));
        fclose($handle);
        $contents = str_replace("[[TITLE]]", $emailsubject, $contents);
        $contents = str_replace("[[CONTENT]]", $body, $contents);
        $contents = str_replace("[[DOMAIN]]", $dominio_absoluto, $contents);

        // Decodifico a iso-8859-1 para los clientes de correo
        $contents =  $contents;

        $correo         = new stdClass ();
        $correo->para   = $emailaddress;
        $correo->asunto = utf8_encode($emailsubject);
        $correo->cuerpo = $contents;
        /*if($attachments!=false){
            $correo->attach = $attachments;
        } else {
            $correo->attach = array ();
        }
        
        $pMail = new CCorreo();
        
        return $pMail->enviar ($correo);*/

        $cabeceras     = "From: contacto@tusadhesivos.com \n";
        $cabeceras .= "Reply-To: contacto@tusadhesivos.com \n";
        $cabeceras .= "MIME-version: 1.0\n";
        $cabeceras .= "Content-type: multipart/mixed; ";
        $cabeceras .= "boundary=\"Message-Boundary\"\n";
        $cabeceras .= "Content-transfer-encoding: 7BIT\n";
        $cabeceras .= "X-attachments: $nombref";
               
        $body_top  = "--Message-Boundary\n";
        $body_top .= "Content-type: text/html; charset=US-ASCII\n";
        $body_top .= "Content-transfer-encoding: 7BIT\n";
        $body_top .= "Content-description: Mail message body\n\n";
               
        $cuerpo = $body_top.$contents;

        //Envío el correo
        mail($emailaddress, iconv("utf-8", "iso-8859-1", $emailsubject), $cuerpo, $cabeceras); 
    }

    function can_show_more ($text, $long){
        if(trim($text)!=""){
            $new_text = long_title($text, $long);
            if(substr($new_text, strlen($new_text)-3)=="..."){
                return true;
            } else{
                return false;
            }
        } else {
            return false;
        }

    }

    // Esta funcion es usada para iteerar columnas en excel
    function next_letter ($word, $pos=1){
        $letters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ');
        $key = array_search($word, $letters);
        
        if($key<sizeof($letters)){
            return $letters[($key+$pos)];
        } else {
            // Fallo no controlado por falta de uso
            return "A";
        }
    }

    // Las visitas virtuales se crearan en el repositorio en una carpeta llamada vv, la 
    // primera vez se descomprimira el zip, pero a partir de ahi ya no lo haremos, la clave sera ITEM_TYPE_ID_TYPE
    // los parametros vienen:
    // $params{
    //      ID_TYPE:...
    //      ITEM_TYPE:...
    //      URI:...
    // }
    function visitas_virtuales ($params){
        global $VV,$VV_GUEST,$UNZIP,$repository;
        // Creo el repositorio si no existe
        if(!is_dir($VV)){
            mkdir($VV);
        }
        // Fichero zip de origen
        $source = $repository."/".$params["uri"];
        $dest   = $params["item_type"]."_".$params["id_type"].'/inicio.html';
        
        // Si ya existe el dir temportal de esta visita devuelvo el codigo
        $tmp_dir = $VV."/".$params["item_type"]."_".$params["id_type"];
        if(!is_dir($tmp_dir)){
            // Creo el directorio
            mkdir($tmp_dir);
            
            // Extraigo el contenido del paquete
            if(file_exists($source)){
                $cmd = $UNZIP." -j \"".$source."\" -d \"".$tmp_dir."/.\" ";
                // print $cmd;
                $res = `$cmd`;

                $head = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Kutxabank - Inmobiliaria</title>
<link type="text/css" href="/tpl/css/style.css" rel="stylesheet">
</head>
<body>';
                $footer = '</body></html>';

                $handle = fopen($VV."/".$dest, "r");
                $data = fread($handle, filesize($VV."/".$dest));
                fclose($handle);

                $handle = fopen($VV."/".$dest, 'w');
                fwrite($handle, $head.$data.$footer);
                fclose($handle);
            } else {
                return "Visita virtual no localizada";
            }
        }
        return '<iframe frameborder="0" scrolling="no" style="height: 518px; margin-left: 20px;width: 743px;" src="'.$VV_GUEST."/".$dest.'"></iframe>';
    }

    function allow($action){
        global $_SESSION;
        // echo serialize($_SESSION["ACL"]¡);
        return $_SESSION["ACL"]->isAllowed($_SESSION["SESION_USUARIO"], $action);
    }
    function s($session_key){
        global $_SESSION;
        if(trim($_SESSION[$session_key])!=""){
            return $_SESSION[$session_key];
        } else {
            return false;
        }
    }

   function mark_icon ($icon_name){
        global $_SERVER;
        $icon_name = str_replace(" ", "", $icon_name);
        $icon_name = str_replace("ë", "e", $icon_name);
        
        $icon_name = strtolower($icon_name).".png";
        if (file_exists($_SERVER["DOCUMENT_ROOT"]."/tpl_guest/images/marcas/".$icon_name)){
            return "/tpl/images/marcas/".$icon_name;
        } else {
            return "/tpl/images/marcas/default.png";
        }
   }
   
   function generar_clave($longitud){ 
       $cadena="[^A-Z0-9]"; 
       return substr(preg_replace($cadena, "", md5(rand())) . 
       preg_replace($cadena, "", md5(rand())) . 
       preg_replace($cadena, "", md5(rand())), 
       0, $longitud); 
    }  
    function thumb($uri, $source_name=null){
        return current(explode(".", $uri))."_z.png";
    }
    
?>