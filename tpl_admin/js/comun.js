var selected_rows = [];

function select_row (obj){
	
    var id = obj.id;
    //si el checkbox está checkado y es diferente del genérico, meto en un array con la posición de su id
    //el valor que contiene
    if( $("#"+id).is(':checked') &&  id!='' && id!='general' ){
	    selected_rows[id] = $("#"+id).val();
	} else{
		//si no, borro lo que tiene en la posición con su id (presuponiendo que existía previamente)
		selected_rows[id] = null;
	}
}

function select_all (){
	//recorro todos los checkbox
	 $("input[type=checkbox]").each(function() {
		 //pongo todos a checked / unchecked en funcion del estado del checkbox generico
		 $(this).attr("checked",$("#general").is(":checked"));
		 //si el id es diferente de null llamo a select_row (con esto me aseguro de tener los checkbox que me interesan)
		 if(this.id!=''){
		 	select_row(this);
	 	}
	 }); 
}


function get_url (url, spected_rows, confirm_text){
    var params = "";
    var i = 0;
    for (key in selected_rows){
        if(selected_rows[key] != null){
            params += "check_"+i+"="+escape(selected_rows[key])+"&";
            i++;
        }
    }

    if(spected_rows!=null && spected_rows<i){
        alert("Solo se puede seleccionar "+spected_rows+" elemento");
    } else if (spected_rows==1 && i==0){
        alert("Debes seleccionar un elemento para continuar");
    } else if (spected_rows>0 && i==0){
	    alert("Debes seleccionar al menos un elemento para continuar");
	} else {
		// Si requiere texto de confirmacion lo pide ahora
		if(confirm_text!=undefined && confirm_text!=""){
			if( confirm(confirm_text) ){
				document.location = url+"&"+params;
			}
		} else {
			document.location = url+"&"+params;
		}
    }
}


function get_selected_rows (spected_rows){
	var params = "";
    var i = 0;
	var obj = {};
    for (key in selected_rows){
        if(selected_rows[key] != null){
            obj["check_"+i] = escape(selected_rows[key]);
			i++;
        }
    }

    if(spected_rows!=null && spected_rows<i){
        alert("Solo se puede seleccionar "+spected_rows+" elemento");
    } else if (spected_rows==1 && i==0){
        alert("Debes seleccionar un elemento para continuar");
    } else if (spected_rows>0 && i==0){
	    alert("Debes seleccionar al menos un elemento para continuar");
	} else {
		return obj;
	}
	return {};
}

function send_form (idForm, params){
    var empty_mandatory_field      = false;
    var empty_mandatory_field_name = "";
    $("#"+idForm+" input").each( function() {
        if($('#'+this.id).attr('mandatory')=='true' && 
           this.value=="" ){
            empty_mandatory_field      = true;
            empty_mandatory_field_name = $('#'+this.id).attr('name');
        }
    });
    $("#"+idForm+" textarea").each( function() {
        if($('#'+this.id).attr('mandatory')=='true' && 
           this.value=="" ){
            empty_mandatory_field      = true;
            empty_mandatory_field_name = $('#'+this.id).attr('name');
        }
    });
    $("#"+idForm+" select").each( function() {
        if($('#'+this.id).attr('mandatory')=='true' && 
           this.value=="" ){
            empty_mandatory_field      = true;
            empty_mandatory_field_name = $('#'+this.id).attr('name');
        }
    });

	if(params!=undefined){
		var action = $("#"+idForm+"").attr("action");
		if(action.indexOf("?", 0)>0){
		} else {
			action += "?";
		}
		for(var i in params){
		    // alert(names[i]);
			action += "&" + i + "=" + params[i];
		}
		$("#"+idForm+"").attr("action", action);
	}

    if(empty_mandatory_field==true){
        alert("Debes completar el campo '"+empty_mandatory_field_name+"'");
    } else {
        $('#'+idForm).submit();
    }
}

function get_params_object (parametros, idForm){
    $("#"+idForm+" input[type=text]").each( function() {
        parametros[this.id] = this.value;
    });
    $("#"+idForm+" input[type=hidden]").each( function() {
        parametros[this.id] = this.value;
    });
    $("#"+idForm+" textarea").each( function() {
        parametros[this.id] = this.value;
    });
    $("#"+idForm+" select").each( function() {
        parametros[this.id] = this.value;
    });
    $("#"+idForm+" input[type=radio]").each( function() {
        if(this.checked){
            parametros[this.id] = this.value;
        }
    });
    $("#"+idForm+" input[type=checkbox]").each( function() {
        if(this.checked){
            parametros[this.id] = this.value;
        }
    });
    return parametros;
}

function http_ajax_request (localizacion, parametros, cb, tipo){
    if(tipo==undefined){
        tipo='html';
    }
    if(cb==undefined){
        cb = function (){};
    }
    $.ajax({
        type: "POST",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
        url: localizacion,
        data: parametros,
        dataType: tipo,
        success: function(datos){
            cb(datos);
        },
        timeout: 0,
        error: function(objeto, quepaso, otroobj){
            alert("Error making request: "+quepaso);
            cb();
        }
    });
}

function clear_all_fields (idForm){
	$("#"+idForm+" input[type=text]").each( function() {
        this.value = "";
    });
	$("#"+idForm+" select").each( function() {
        this.value = "";
    });
	if($("#"+idForm+" limpiar_filtro")!=undefined){
		$("#"+idForm+" input[id=limpiar_filtro]").val("true");
	}
}

var notificador = 1;

function notificacion(error,msg){
	if(msg == null){
		if(error = 1){
			msg = "Ha ocurrido un error, inténtelo de nuevo o contácte con su administrador";
		}else{
			msg = "Datos actualizados correctamente";
		}
	}
	if(error == '1'){
		$("#centro_notificaciones").append('<div style="position: absolute; z-index: 20000; color: white; top: 0px; padding: 5px 20px; background: none repeat scroll 0px 0px rgba(255, 0, 0, 0.7);font-weight:bold;" id="div_error_'+notificador+'" class="error_container"><strong>Error</strong><p class="error_msg" id="mensaje_error_'+notificador+'"></p></div>');
  		$("#mensaje_error_"+notificador).html(msg);
  		self.setTimeout("$('#div_error_"+notificador+"').hide()", (7000+(1000*notificador)));
	}else{
		//si todo ha salido bien, relleno el id de la empresa, muestro el guardado correctamente y lo escondo a los 5 segundos
		$("#centro_notificaciones").append('<div style="position: absolute; z-index: 20000; color: white; top: 0px; padding: 5px 20px; background: none repeat scroll 0px 0px rgba(0, 255, 0, 0.4); font-weight: bold;" id="div_correcto_'+notificador+'" class="success"><span>OK!</span><p id="mensaje_'+notificador+'"></p></div>');
		$("#mensaje_"+notificador).empty();
		$("#mensaje_"+notificador).append(msg);
		self.setTimeout("$('#div_correcto_"+notificador+"').hide()", (5000+(1000*notificador)));
	}
	notificador++;
}
function anadir_categoria(id){
    var botones = [
        {
            text: "Guardar", class :"ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix", click: function() {
            	if($("#dc_categoria").val() == null || $("#dc_categoria").val() == ""){
            		alert("Debes rellenar algo en el nombre.");
            	}else{
            		$("#form_category").submit();
            	}
            }}];
    var datos = {
        parent_id : id
    }
    window_dialog (null, "index.php?controller=category&action=nueva_category", datos, "Nueva categoria", 575, "auto", null, "true", botones, "true");
    
}
function editar_categoria(id){
    var botones = [
        {
            text: "Enviar", click: function() {
                if($('#TYPE').val() == '-Sel-'){
                    alert('Debes seleccionar alguna categoria');
                }else{
                    $("#form_category").submit();
                }
            }},
        { text: "Cerrar", click: function() {
                $("#dialog-form").dialog("destroy");                       
              }
       
        }];
    var datos = {
        id : id
    }
    window_dialog (null, "index.php?controller=category&action=nueva_category", datos, "Editar categoria", 575, 500, null, "true", botones, "true");
    
}
function eliminar_categoria(id){
    if(confirm("¿Estas seguro de que quieres borrar la categoria, se borrara todo lo que contenga?")){
        document.location = 'index.php?controller=category&action=delete_category&id='+id;
    }
}
