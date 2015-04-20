<?php
	/****************Ejemplo de field tipo select ó radio button*******************
	*
	*	$arr_opciones = array();
	*	$opcion = new StdClass();
	*
	*	$opcion->value = "Mi valor de select";
	*	$opcion->texto = "Mi opcion de select";
	*	
	*	array_push($arr_opciones, $opcion);
	*	... -> todas las opciones del option que quieras poner OJO!!! la de - SELECCIONA NO -
	*
	*	add_field('select','mi select','mi_name','seleccionado',$arr_opciones,$mandatory,$css_class...);
	*
	* 
	*******************************************************************************/
	
	class CForm{

		var $conn   		= null;
		var $form			= null;
		var $fields 		= null;	
		var $buttons		= null;
		var $form_enabled	= false;
	
		function CForm ($conn){
			$this->conn    = $conn;
			// $this->form    = array();
			$this->form    = new stdClass();
			$this->fields  = array();
			$this->buttons = array();
		}
		
		function add_form($action,$name="form",$method="POST",$multipart=false){
			// Recojo el indice del ultimo form que es el activo
			// $i = $this->get_index();

			//creo y relleno el form
			$this->form->action		= $action;
			$this->form->name		= $name;
			$this->form->method 	= $method;
			$this->form->multipart 	= $multipart;
			
			//inicio el form como creado
			$this->form_enabled = true;
		}
		function add_field($type, $label, $name, $value="", $arr_opciones=null, $mandatory=false, $css_class="normal_form",$style=null,$action=null,$readonly=false,$disabled=false, $checked=""){
			if($type == "file" && $this->form->multipart == false){
				$ack = new ACK();
				$ack->resultado = false;
				$ack->mensaje 	= "Hay un error en el formulario al que intenta acceder, contácte con su administrador en referencia a que el formulario no acepta subida de archivos.";
				
				add_notification($ack);
				
				header("location: index.php?controlador=home&accion=home");
				exit;
			} else {
				//creo y relleno el campo
				$field = new stdClass();
				$field->type		= $type;
				$field->label		= $label; 
				$field->name		= $name;
				$field->value		= $value;
				$field->opciones	= $arr_opciones;
				$field->mandatory	= $mandatory;
				$field->style		= $style;
				$field->css_class	= $css_class;
				$field->checked 	= $checked;
				//el action se tiene en cuenta que es con OnChange
				$field->action		= $action;
				if($readonly==true){
					$field->readonly= " readonly=readonly ";
				}
				if($disabled==true){
					$field->disabled= " disabled=true ";
				} else {
					$field->disabled= "";
				}
				//añado el campo al array de campos
				array_push($this->fields, $field);
				
				//inicio el form como creado
				$this->form_enabled = true;
				
			}
		}
		function add_button($type,$value,$action=null, $class="freshbutton"){
			//creo y relleno el boton
			$button = new stdClass();
			$button->type 	= $type;
			$button->value	= $value;
			$button->action	= $action;
			$button->class	= $class;
			//por ultimo meto el boton en el array de botones
			array_push($this->buttons, $button);
		}
		function display_form(){
			$output = "";

			if($this->form->action!=null){
				//si es multipart preparo el encype
				($this->form->multipart == true)?$enctype="enctype='multipart/form-data'":$enctype="";
				
				//abro el form
				$output .= "<form name='".$this->form->name."' id='".$this->form->name."' action='".$this->form->action."' method='".$this->form->method."' ".$enctype." >";
				$output .= "<div class='div_form' >";
				//meto los campos
				$cont_editor=0;
				if(sizeof($this->fields)>0){
					foreach($this->fields as $field){
						if($field->type=="title"){
							$output .="<h1>{lang text=\"".$field->label."\"}</h1>";
						} else if($field->type=="fieldset"){
							$output .= "<fieldset class='fieldset'><legend class='legend_fieldset'>{lang text=\"".$field->label."\"}</legend>";
						} else if($field->type=="/fieldset"){
							$output .= "</fieldset>";
						} else {
							if($field->type!="editor" && $field->type!="plupload" && $field->type!="textarea"){ 
								$output .= "<div class='frm_row' id='row_".$field->name."' style='display:".(($field->type!="hidden")?"block":"none")."'>";
							} else {
								$output .= "<div class='frm_row_editor' id='row_".$field->name."' style='display:".(($field->type!="hidden")?"block":"none")."'>";
							}
							//Compruebo si es hidden porque no quiero label en los hidden
							if($field->type!="hidden" && $field->type!="checkbox" && $field->type!="plupload" && $field->type!="fieldset" && $field->type!="/fieldset" && $field->type!="editor" && $field->type!="title"){
								if($field->mandatory == true){
									$output .= "<div class='div_label_normal_form'><label class='label_normal_form' >* &nbsp;{lang text=\"".$field->label."\"}:</label></div>";
								}else{
									$output .= "<div class='div_label_normal_form'><label class='label_normal_form' >{lang text=\"".$field->label."\"}:</label></div>";
								}
								
							
								switch ($field->type){
									case "textarea":
										$output .= "<div class='div_normal_form' ><textarea id='".$field->name."' name='".$field->name."' ".$field->disabled." ".$field->readonly." class='".$field->css_class."' style='width:300px !important;height:150px !important;".$field->style."' onChange='".$action."' >".$field->value."</textarea></div>";
										break;
									/* case "checkbox":
										$output .= "<div class='div_normal_form'><input type='".$field->type."' id='".$field->name."'  ".$field->disabled." ".$field->readonly."  name='".$field->name."' class='".$field->css_class."' style='".$field->style."' value='".$field->value."' onClick='".$field->action."' /></div>";
										break; */
									case "file":
										if($field->value!=null){ 
											$output .= "<div class='div_normal_form' id='img_".$field->name."' onClick='$(\"#div_".$field->name."\").show(); $(\"#img_".$field->name."\").hide();'><img src='/tpl_admin/images/media.png' style='cursor:pointer;width:36px;'></div>";
											$output .= "<div class='div_normal_form' id='div_".$field->name."' style='display:none;'><input type='".$field->type."' id='".$field->name."'  ".$field->disabled." ".$field->readonly."  name='".$field->name."' class='".$field->css_class."' style='".$field->style."' value='".$field->value."' onChange='".$field->action."' /></div>";
										} else {
											$output .= "<div class='div_normal_form'><input type='".$field->type."' id='".$field->name."'  ".$field->disabled." ".$field->readonly."  name='".$field->name."' class='".$field->css_class."' style='".$field->style."' value='".$field->value."' onChange='".$field->action."' /></div>";
										}
										break;
									case "text":
										$output .= "<div class='div_normal_form'><input type='".$field->type."' id='".$field->name."'  ";
											if(sizeof($field->opciones)>0){
												foreach($field->opciones as $opcion=>$value){
													$output .= $opcion.'="'.$value.'"';
												}
											}
											
										$output .= $field->disabled." ".$field->readonly."  name='".$field->name."' class='".$field->css_class."' style='".$field->style."' value='".$field->value."' onChange='".$field->action."' /></div>";
										break;
									case "password":
										$output .= "<div class='div_normal_form'><input type='".$field->type."' id='".$field->name."'  ".$field->disabled." ".$field->readonly."  name='".$field->name."' class='".$field->css_class."' style='".$field->style."' value='".$field->value."' onChange='".$field->action."' /></div>";
										break;
									case "label":
										$output .= "<div class='div_normal_form'><label class='".$field->css_class."' style='".$field->style."'>".$field->value."</label></div>";
										break;
									case "select":
										$output .= "<div class='div_normal_form'><select id='".$field->name."'  ".$field->disabled." ".$field->readonly."  name='".$field->name."' class='style_combo ".$field->css_class."' style='".$field->style."' onChange='".$field->action."'>";
										$output .= "<option value=''>{lang text=\"-Sel-\"}</option>";
										//recorro todas las opciones
										if(sizeof($field->opciones)>0){
											foreach($field->opciones as $opcion){
												//compruebo si trae seleccionado por defecto
												if($opcion->value == $field->value){
													$selected = "selected";
												}else{
													$selected = "";
												}
												$output .= "<option value='".$opcion->value."' ".$selected." >{lang text=\"".$opcion->texto."\"}</option>";		
											}
										}
										$output .= "</select></div>";
										break;
									case "radiobutton":
										if(sizeof($field->opciones)>0){
											$output .= "<div class='div_normal_form'>";
											foreach($field->opciones as $opcion){
												//compruebo si trae seleccionado por defecto
												if($opcion->value == $field->value){
													$selected = "checked";
												}else{
													$selected = "";
												}
												$output .= "<input type='radio' id='".$field->name."'  ".$field->readonly." name='".$field->name."' ".$selected." class='".$field->css_class."' style='".$field->style."' value='".$opcion->value."' onClick='".$field->action."' /><label>{lang text=\"".$opcion->texto."\"}</label>";		
											}
										}
										$output .= "</div>";
										break;
									case "datepicker":
										$output .= "<div class='div_normal_form'><input type='text' id='".$field->name."'  ";
											if(sizeof($field->opciones)>0){
												foreach($field->opciones as $opcion=>$value){
													$output .= $opcion.'="'.$value.'"';
												}
											}
											
										$output .= $field->disabled." ".$field->readonly."  name='".$field->name."' class='".$field->css_class." date' style='".$field->style."' value='".$field->value."' onChange='".$field->action."' /></div>";
										break;
									
								}
								
								$output .= "</div><div>\n";
							} else { 
								switch ($field->type){
									case "hidden":
										$output .= "<input type='".$field->type."' id='".$field->name."' name='".$field->name."' class='".$field->css_class."' style='".$field->style."' value='".$field->value."' onChange='".$field->action."' />";
										break;
									case "checkbox":
										$output .= "<div class='div_normal_form'><input type='".$field->type."' id='".$field->name."' ";
										
											if(sizeof($field->opciones)>0){
												foreach($field->opciones as $opcion=>$value){
													$output .= $opcion.'="'.$value.'"';
												}
											}
										
										$output .= " name='".$field->name."' class='".$field->css_class."' style='".$field->style.";width:20px;' value='".$field->value."' onClick='".$field->action." '".$field->checked." /> <label for='".$field->name."'>{lang text=\"".$field->label."\"}</label></div>";
										break;
									case "plupload":

										$imagenes=$field->value;
										
										if($imagenes){
											$cont=2;
											foreach($imagenes as $row){
												if($cont==2){
													$img .="<div style='height:225px'></div>";
													$cont=-1;
												}
												$uri = "/repositorio/".$row->URI;
												if(strtolower(file_extension($row->URI))=="pdf"){
													$uri = "/tpl_admin/images/pdf.png";
												}

												$img .= "<div class='imagen_tab' style='margin-top:-207px' id='imagen_".encrypt($row->ID_FILES)."'>
						    						    	<div style='max.width:15px;'>
						    						    		<a href=\"javascript: eliminar_imagen('imagen_".encrypt($row->ID_FILES)."','".encrypt($row->ID_FILES)."');\"><img src='/tpl_admin/images/x_red.png' style='max-width:15px;max-height:15px;float:right'></a>
						    						    		<div class='img_pos'>Orden:</div><input type='text' class='caja_order' id='".encrypt($row->ID_FILES)."' name='ORDER'  value='".$row->ORDER."' onChange=\"actualizar_order('".encrypt($row->ID_FILES)."');\">
						    						    		<div class='img_pos'>Vis.:</div>
						    						    		<select id='visible_".encrypt($row->ID_FILES)."' style='height: 28px;padding-top: 4px;width: 55px;' onChange=\"actualizar_order('".encrypt($row->ID_FILES)."');\">
						    						    			<option value='1' ".(($row->VISIBLE==1)?"selected":"").">SI</option>
						    						    			<option value='0' ".(($row->VISIBLE!=1)?"selected":"").">NO</option>
						    						    		</select>
						    						    	</div>
						    						    	<div class='imagen_dentro_tab'><img src='".$uri."' style='max-height:177px; max-width:180px'></div>
						    					    	</div>";
						    					$cont++;
											};
										}else{
											$img="";
										}
										
										$plupload = fopen($_SERVER[DOCUMENT_ROOT]."/core/plupload.tpl", "r");
										$datos= fread($plupload,filesize($_SERVER[DOCUMENT_ROOT]."/core/plupload.tpl"));	
										$output .= str_replace("remplazar", $img, $datos);
										fclose($plupload);
										break;
									case "editor":
										if($cont_editor == 0){
											$tinymce = fopen($_SERVER[DOCUMENT_ROOT]."/core/tinymce.php", "r");
											$datos= fread($tinymce,filesize($_SERVER[DOCUMENT_ROOT]."/core/tinymce.php"));
											$output .=$datos;
											fclose($tinymce);
										}
										$output .= "<br><div class='editor' >".$field->label."<textarea id='".$field->name."' name='".$field->name."' ".$field->disabled." ".$field->readonly." style='".$field->style."' onChange='".$action."' cols='93' rows='10'>".$field->value."</textarea></div>";
										$cont_editor++;
										break;
									
								}
							}
							$output .= "</div>\n";
						}

					}
				}
				if(sizeof($this->buttons)){
					$cont_button = 1;
					$output .= "<div class='button_normal_form'>";
					foreach($this->buttons as $button){
						if($cont_button==1){
							$margin = "margin-left:230px;";
						}else{
							$margin = "margin-left:15px;margin-bottom:20px;";
						}
						
		                	$output .= "<input type='".$button->type."' id='registerButton' class='".$button->class."' onclick='".$button->action."' value='{lang text=\"".$button->value."\"}'>";
		                $cont_button++;
					}
					// Cierro el apartado de botones
					$output .= "</div>";
				}
				//cierro el form
				$output .= "</div></div></form>";
			}
			return $output;
		}

		private function get_index (){
			$num = sizeof($this->form);
			if( $num==0 ){
				return 0;
			} else {
				return $num-1; 
			}
		}
		function add_fieldset($title){
			$this->add_field("fieldset",__($title),$title);
		}
		function add_title($title){
			$this->add_field("title",__($title),$title);
		}
		function close_fieldset(){
			$this->add_field("/fieldset",__("fieldset"),"fieldset");
		}
	}
?>