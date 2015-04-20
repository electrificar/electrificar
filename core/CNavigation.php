<?
class CNavigation{

	var $conn               = null;
	var $enable_pagination  = null;
    var $total_lines        = null;
	var $lines_by_page      = null;
	var $start_page         = null;
    var $order_field        = null;
    var $order_stream       = null;
    var $filter_params      = null;

	function CNavigation ($conn){
		$this->conn = $conn;

		global $REGISTROS_LISTADO;
		if($_REQUEST['mostrar'] == null){
			$this->lines_by_page = $REGISTROS_LISTADO;
		}else{
			$this->lines_by_page = $_REQUEST['mostrar'];
		}

        // Si traigo parámetros de ordenacion en el request los recupero
        $this->get_order_params();

        // Si traigo parámetros de filtrado los cargo
        $this->get_filter_params();
	}

    /* Pagination functions */
    function paginator (){
        global $_SERVER, $_REQUEST;

        $output = "";

        // Url fija
        $pgndr_url_fija  = $this->get_url_fija ();

        // Pagina actual 
        $pgndr_pg_actual = $_REQUEST["pagina_actual"];
        if($pgndr_pg_actual==null) $pgndr_pg_actual = 1;

        // Registros por pagina
        if($this->lines_by_page != 'all'){
        	$pgndr_reg_por_pg = $this->lines_by_page;
        }else{
        	$pgndr_reg_por_pg = "100000000";
        }

        $pgndr_tot_reg    = $this->total_lines;

        // Paginas que dejaremos accesibles a cada lado
        $pg_contiguas = 1;
        // Numero de paginas a partir de las cuales activamos el modo comprimido
        $pgs_para_modo_comprimido = 13;
        
        $residuo = $pgndr_tot_reg % $pgndr_reg_por_pg;
        $num_paginas = intval($pgndr_tot_reg / $pgndr_reg_por_pg);
        
        if($residuo > 0) $num_paginas++;
        // Limite a partir del cual es recomendado el modo comprimido
        if($num_paginas >= $pgs_para_modo_comprimido) { $modo_comprimido = true; } else { $modo_comprimido = false; }
        
        $output .= '<div class="span6"><ul class="navigation rr">';
        
        if($pgndr_pg_actual==1){
            $output .= '<li><a href="javascript:void(0);" class="arrow prev ir">Previous</a></li>';
        } else {
            $output .= '<li><a href="'.$this->transformar_url_pag($pgndr_url_fija, $pgndr_pg_actual-1).'" class="arrow prev ir">Previous</a></li>';
        }
        
        $_SESSION['NUM_PAGINAS_BUSCADOR'] = $num_paginas;
        
        $ptos_izq = false; $ptos_dch = false;
        for($i=1; $i<=$num_paginas; $i++){
            if( $modo_comprimido == true &&
                $i < $pgndr_pg_actual && 
                $i > 1 &&
                ($pgndr_pg_actual-$pg_contiguas) > $i ){
                // Cumple el modo comprimido por la izquierda
                if(!$ptos_izq){
                    // Si no he puesto ya los ptos suspensivos
                    $ptos_izq = true;
                    $output .= '<li><a href="javascript:void(0)">...</a></li>';
                }
            } else if( $modo_comprimido == true &&
                $i > $pgndr_pg_actual && 
                $i < $num_paginas && 
                ($pgndr_pg_actual+$pg_contiguas) < $i ){
                // Cumple el modo comprimido por la derecha
                if(!$ptos_dch){
                    // Si no he puesto ya los ptos suspensivos
                    $ptos_dch = true;
                    $output .= '<li><a href="javascript:void(0)">...</a></li>';
                }
            } else {
                if($i==$pgndr_pg_actual) { 
	                $output .='<li class="current"><a href="javascript:void(0);">'.$i.'</a></li>';
                } else {
	                $output .='<li><a href="'.$this->transformar_url_pag($pgndr_url_fija, $i).'">'.$i.'</a></li>';
                }
            }
        }
        if($pgndr_pg_actual==$num_paginas || $pgndr_tot_reg==0){
            $output .= '<li><a href="javascript:void;" class="arrow next ir">Next</a></li>';
        } else {
            $output .= '<li><a href="'.$this->transformar_url_pag($pgndr_url_fija, $pgndr_pg_actual+1).'" class="arrow next ir">Next</a></li>';
        }
        $output .= "</ul></div>";

        return $output;
    }

    function transformar_url_pag ($url, $pag_actual) {
	
		$ret = str_replace ('__PAG_ACTUAL__', $pag_actual, $url, $count);
		if ($count==0) {
			//La url no se ha modificado
			$ret.="&pagina_actual=$pag_actual";
		}
		return $ret;
	}

    function get_url_fija ($other_script=null){
        global $_SERVER, $_REQUEST;
        // Url fija
        if($other_script!=null){
            $url_fija   = $other_script."?";
        } else {
            $url_fija   = $_SERVER["SCRIPT_NAME"]."?";
        }
        foreach ($_REQUEST as $key=>$val){
            if($key!="pagina_actual") $url_fija .= $key."=".$val."&";
        }
        return $url_fija;
    }

    function get_order ($default=null, $stream=null, $ignore_params=false){
        // Es posible que en los filtros no queramos que se ordene por los parametros de $_REQUEST
        // ya que su ordenacion debe ser la de por defecto, para ello tenemos esta variable que los deshabilita
        if($ignore_params==false){
            if($this->order_field!=null){
                $default = $this->order_field;
            }
            if($this->order_stream!=null){
                $stream = $this->order_stream;
            }
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

    function get_filter_object(){
        $filters = array();

        if(sizeof($this->filter_params)>0){
            foreach($this->filter_params as $obj){
                anade_filtrado ( $filters, $obj->field, $obj->value, $obj->operation);
            }
        }
        return $filters;
    }

    function get_order_link ($url, $campo, $orden){
        return $url."&srch_order_field=".$campo."&srch_order_srtream=".$orden;
    }

    function get_pager_limit (){
        global $_REQUEST;
        if($this->lines_by_page!='all'){
	        $pgndr_pg_actual = ($_REQUEST["pagina_actual"]!=null)?$_REQUEST["pagina_actual"]:1;
	        $limit_init = ($pgndr_pg_actual-1)*$this->lines_by_page;
	        $limit = " Limit ".$limit_init.", ".$this->lines_by_page;
        }else{
        	$limit = null;
        }
        return $limit;
    }
    
    function get_pager_limit_number (){
        global $_REQUEST;
        $pgndr_pg_actual = ($_REQUEST["pagina_actual"]!=null)?$_REQUEST["pagina_actual"]:1;
        $limit_init = ($pgndr_pg_actual-1)*$this->lines_by_page;
        $limit = new stdClass();
        $limit->START = $limit_init;
        $limit->END   = $this->lines_by_page;
        return $limit;
    }

    function get_order_params (){
        global $_REQUEST;
        if($_REQUEST["order_field"]!=null){
            $this->order_field = $_REQUEST["order_field"];
            unset ($_REQUEST["order_field"]);
        } 
        if($_REQUEST["order_stream"]!=null){
            $this->order_stream = $_REQUEST["order_stream"];
            unset ($_REQUEST["order_stream"]);
        }
    }

    function get_filter_params (){
        global $_REQUEST;

        $this->filter_params = array();

        foreach ($_REQUEST as $key=>$val){
            if(stripos($key, "srch;")!==false && trim($val)!=""){
                $obj = new stdClass();
                $arr = explode(";", $key);

                if($arr[1]=="equal"){
                    $obj->operation = "=";
                } else {
                    $obj->operation = "like";
                }
                $obj->field = $arr[2];
                $obj->value = $val;

                unset ($_REQUEST[$key]);
                array_push($this->filter_params, $obj);
            }
        }
    }
}
?>