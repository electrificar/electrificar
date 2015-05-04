<?
// Esta es la clase estandar de mensajes de respuesta
class ACK {
	// Constructor
	function ACK (){
	}
	// Este atributo contiene el resultado de la operacion
	// sera booleano [true/false]
	var $resultado = null;
	// En el caso de que venga un mensaje de error o una aclaracion si 
	// la necesita un resultado correcto va aqui
	var $mensaje = "";
	// En el caso en que se necesite devolver informacion referente a
	// algun documento, el nombre de este iria aqui
	var $archivo_afectado = "";
	// Este es el codigo que vendra asociado al resultado, es un campo
	// numerico el cual nos permite tratar las respuestas desde un
	// archivo de idioma
	var $codigo = "";
	// En este campo viajaran principalmente los datos solicitados a 
	// cada metodo, habitualmente objetos de datos de la BBDD
	var $datos = null;
    // En esta variable retornaremos el identificador del objeto tratado
    var $id = null;
}
?>