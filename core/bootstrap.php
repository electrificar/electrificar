<?
	require_once($_SERVER["DOCUMENT_ROOT"]."/core/CController.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/core/CNavigation.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/core/CForm.php");
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/smarty/Smarty.class.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/core/DbConnection.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/core/ACK.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/core/smartyML.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/clases/CUsuarios.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/Zend/Acl.php');

	// Si no hay controlador ni accion predefinido pongo los de por defecto
	if($_REQUEST["controller"] == null){
		$_REQUEST["controller"] = "perfil";
	}
	if($_REQUEST["action"] == null){
		$_REQUEST["action"] = "frm_login";
	}

	// Lo ponemos aqui para que coja la informacion de controladores
	require_once($_SERVER["DOCUMENT_ROOT"]."/comun/Conf.php");


	function load_controller ($controlador, $environment="admin"){
	    //La carpeta donde buscaremos los controladores
    	$carpetaAdminControladores = $_SERVER["DOCUMENT_ROOT"]."/admin/controllers/";
    	$carpetaGuestControladores = $_SERVER["DOCUMENT_ROOT"]."/guest/controllers/";

		$ack = new ACK();
		$ack->resultado = true;

		//Formamos el nombre del fichero que contiene nuestro controlador
		if($environment=="admin"){
			$controller_path = $carpetaAdminControladores . $_REQUEST["controller"] . 'Controller.php';
		} else if ($environment=="guest"){
			$controller_path = $carpetaGuestControladores . $_REQUEST["controller"] . 'Controller.php';
		}
		
		//Incluimos el controlador o detenemos todo si no existe
		if(is_file($controller_path)){
			require_once $controller_path;
			
			$myclass = $controlador.'Controller';
			$obj = new $myclass();

			$obj->controller = $_REQUEST["controller"];
			$obj->action     = $_REQUEST["action"];

			$ack->datos = $obj;
		} else {		
			header("location: /404.html");
		}
		
		return $ack;
	}
	
	function load_action($accion){
		global $_REQUEST;
		
		return $_REQUEST["action"];
	}
	function prevent_sqlinjection (){
		global $_REQUEST;
		foreach ($_REQUEST as $k=>$v){
			$_REQUEST[$k] = addslashes(limpiarCadena(preg_replace('/[^áéíóúÁÉÍÓÚñÑa-zA-Z0-9-_;@.\s\n\r]/i', '', $v)));
		}
	}
	function limpiarCadena($valor){
		$valor = str_ireplace("SELECT","",$valor);
		$valor = str_ireplace("COPY","",$valor);
		$valor = str_ireplace("DELETE","",$valor);
		$valor = str_ireplace("DROP","",$valor);
		$valor = str_ireplace("DUMP","",$valor);
		$valor = str_ireplace(" OR ","",$valor);
		$valor = str_ireplace("%","",$valor);
		$valor = str_ireplace("LIKE","",$valor);
		$valor = str_ireplace("--","",$valor);
		$valor = str_ireplace("^","",$valor);
		$valor = str_ireplace("[","",$valor);
		$valor = str_ireplace("]","",$valor);
		$valor = str_ireplace("\\","",$valor);
		$valor = str_ireplace("!","",$valor);
		$valor = str_ireplace("¡","",$valor);
		$valor = str_ireplace("?","",$valor);
		$valor = str_ireplace("=","",$valor);
		$valor = str_ireplace("&","",$valor);
		return $valor;
	}
?>