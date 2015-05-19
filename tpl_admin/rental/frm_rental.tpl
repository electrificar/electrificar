{include file="../common/header.tpl"}

{include file="../common/sidebar.tpl"}

<link rel="stylesheet" href="/admin/css/jquery.range.css">
<link rel="stylesheet" href="/admin/js/datepicker/datepicker.css" type="text/css" />
<section id="content">
	<section class="vbox">
		<section class="scrollable padder">
			<div class="m-b-md">
                <h3 class="m-b-none">
            		<i class="fa fa-plus"></i >
            		Añadir alquiler
            		<a title="Volver atrás" style="width:40px;font-size:20px;" class="pull-right btn btn-rounded btn-sm btn-icon btn-default" href="/admin/alquileres/">
            			<i class="fa fa-mail-reply"></i>
            		</a>
            	</h3>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <form id="wizardform" method="post" action="/admin/alquilar-coche/">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <ul class="nav nav-tabs font-bold">
                          <li><a href="#step1" data-toggle="tab">Usuario</a></li>
                          <li><a href="#step2" data-toggle="tab">Vehículo</a></li>
                          <li><a href="#step3" data-toggle="tab">Tarifa</a></li>
                        </ul>
                      </div>
                      <div class="panel-body">
                        <p>This twitter bootstrap plugin builds a wizard out of a formatter tabbable structure. It allows to build a wizard functionality using buttons to go through the different wizard steps and using events allows to hook into each step individually.</p>
                        <div class="line line-lg"></div>
                        <h4>Progreso de alquiler</h4>
                        <div class="progress progress-xs m-t-md">
                          <div class="progress-bar bg-success"></div>
                        </div>
                        <div class="tab-content">
                          <div class="tab-pane" id="step1">                            
                            <p>Usuario:</p>
                            <section class="col-sm-6" style="display:none;float:none;margin:0 auto;" id="info_user">
		                        <header class="panel-heading bg-light no-border">
		                          <div class="clearfix">
		                            <a href="#" class="pull-left thumb-md avatar b-3x m-r">
		                              <img id="icono-usuario" src="images/a1.png">
		                            </a>
		                            <div class="clear">
		                              <div class="h3 m-t-xs m-b-xs">
		                                <label id="usuario_nombre"></label> 
		                              </div>
		                              <small class="text-muted">Electrificado</small>
		                            </div>
		                          </div>
		                        </header>
		                        <div class="list-group no-radius alt">
		                          <a class="list-group-item" href="javascript:;">
	                            	<i class="fa fa-info-circle icon-muted"></i>&nbsp;
	                            	<label id="usuario_nif"></label>
	                          	  </a>
	                          	  <a class="list-group-item" href="javascript:;" title="Fecha permiso conducir" style="cursor:help;">
	                            	<i class="fa fa-calendar icon-muted"></i>&nbsp;
	                            	<label id="usuario_fecha_permiso"></label>
	                          	  </a>
	                         	  <a class="list-group-item" href="javascript:;">
                            		<i class="fa fa-envelope icon-muted"></i>&nbsp;
                            		<label id="usuario_email"></label>
                          		  </a>
                          		  <a class="list-group-item" href="javascript:;">
                            		<i class="fa fa-phone icon-muted"></i>&nbsp;
                            		<label id="usuario_telefono"></label>
                          			</a>
		                        </div>
		                      </section>
                            <input id="usuario" type="text" class="form-control" data-trigger="change" data-required="true" placeholder="Nombre / Email / Dni">
							<input type="hidden" name="id_usuario" id="id_usuario">
                          </div>
                          <div class="tab-pane" id="step2">
                            <p>Vehículo:</p>
                            <section class="col-sm-6" style="display:none;float:none;margin:0 auto;" id="info_vehicle">
		                        <header class="panel-heading bg-light no-border">
		                          <div class="clearfix">
		                            <a href="#" class="pull-left thumb-md avatar b-3x m-r">
		                              <img style="height: 70px;" id="icono_vehiculo" src="images/a1.png">
		                            </a>
		                            <div class="clear">
		                              <div class="h3 m-t-xs m-b-xs">
		                                <label id="vehiculo_info"></label> 
		                              </div>
		                              <small class="text-muted">Eléctrico</small>
		                            </div>
		                          </div>
		                        </header>
		                        <div class="list-group no-radius alt">
	                          	  <a class="list-group-item" href="javascript:;">
                            		<i class="fa fa-plug icon-muted"></i>&nbsp;
                            		<div class="progress progress-xs active m-t-xs m-b-none" style="display: inline-block; width: 95%;">
										<div class="progress-bar" id="vehiculo_carga" data-toggle="tooltip" style="width: {$vehicle->porcentaje_carga}"></div>
									</div>
                          		  </a>
                          		  <a class="list-group-item" href="javascript:;">
	                            	<i class="fa fa-info-circle icon-muted"></i>&nbsp;
	                            	<label id="vehiculo_matricula"></label>
	                          	  </a>
                          		  <a class="list-group-item" href="javascript:;" title="Fecha vigencia seguro" style="cursor:help;">
	                            	<i class="fa fa-calendar icon-muted"></i>&nbsp;
	                            	<label id="vehiculo_seguro"></label>
	                          	  </a>
		                        </div>
		                      </section>
                            <input id="vehiculo" type="text" class="form-control" data-trigger="change" data-required="true" placeholder="Marca / Modelo / Matrícula">
							<input type="hidden" name="id_vehiculo" id="id_vehiculo">
                          </div>
                          <div class="tab-pane" id="step3">
                          	{foreach from=$tarifas key=cid item=tarifa}
	                          	<div class="col-lg-4">
				                  <section class="panel panel-default">
				                    <div class="panel-body">
				                      <div class="clearfix text-center m-t">
				                        <div class="inline">
				                        	{if $cid==0}
						                    	{$color = "#FCC633"}
						                    {else if $cid==1}
						                    	{$color = "#1CCACC"}
						                    {else}
						                    	{$color = "#1AAE88"}
						                    {/if}
				                          <div style="margin: 0 auto;" class="easypiechart" data-percent="100" data-line-width="5" data-bar-color="{$color}" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="134" data-line-cap='butt' data-animate="1000">
				                            <div class="thumb-lg">
				                              <img src="/admin/images/tarifa{$cid}.png" style="border-radius:0px;width:80px;height:80px;" class="img-circle">
				                            </div>
				                          </div>
				                          <div class="h4 m-t m-b-xs">{$tarifa->nombre}</div>
				                          <small class="text-muted m-b">{$tarifa->descripcion}</small>
				                        </div>                      
				                      </div>
				                    </div>
				                    {if $cid==0}
				                    	{$color = "bg-warning"}
				                    {else if $cid==1}
				                    	{$color = "bg-info"}
				                    {else}
				                    	{$color = "bg-success"}
				                    {/if}
				                    <footer class="panel-footer {$color} text-center">
				                      <div class="row pull-out">
				                        <div class="col-xs-4">
				                          <div class="padder-v">
				                            <span class="m-b-xs h4 block text-white">{$tarifa->precio}€</span>
				                            <small class="text-muted">Precio</small>
				                          </div>
				                        </div>
				                        <div class="col-xs-4 dk">
				                          <div class="padder-v">
				                            <span class="m-b-xs h4 block text-white">{$tarifa->precio_descuento}</span>
				                            <small class="text-muted">Precio Descuento</small>
				                          </div>
				                        </div>
				                        <div class="col-xs-4">
				                          <div class="padder-v">
				                            <span class="m-b-xs h4 block text-white">{$tarifa->duracion}</span>
				                            <small class="text-muted">Duración</small>
				                          </div>
				                        </div>
				                      </div>
				                      <div class="row pull-out" style="cursor:pointer;">
					                      <div class="col-xs-12">
					                            <span class="m-b-xs h4 block text-white">
					                            	<input type="radio" name="id_tarifa" id="tarifa_{$tarifa->id_tarifa}" value="{$tarifa->id_tarifa}"/>
					                            </span>
					                            <small class="text-muted" onclick="check_tarifa('{$tarifa->id_tarifa}')" >Seleccionar</small>
					                        </div>
					                  </div>
				                    </footer>
				                  </section>
				              	</div>
				              {/foreach}
                          </div>
                          <ul class="pager wizard m-b-sm">
                            <li class="previous first" style="display:none;"><a href="javascript:;">Primero</a></li>
                            <li class="previous"><a href="javascript:;">Anterior</a></li>
                            <li class="next"><a href="javascript:;">Siguiente</a></li>
                            <li class="next last" style="display:none;"><a style="cursor:default;background: none repeat scroll 0% 0% rgb(26, 174, 136); color: white;" onclick="$('#wizardform').submit()" href="javascript:;">Guardar</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
		</section>
	</section>
</section>
{include file="../common/footer.tpl"}
<script src="/admin/js/wizard/jquery.bootstrap.wizard.js"></script>
<script src="/admin/js/wizard/demo.js"></script>
<style>
  #project-label {
    display: block;
    font-weight: bold;
    margin-bottom: 1em;
  }
  #project-icon {
    float: left;
    height: 32px;
    width: 32px;
  }
  #project-description {
    margin: 0;
    padding: 0;
  }
  .ui-autocomplete {
    max-height: 100px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  </style>
<script>
  $(function() { 
    $( "#usuario" ).autocomplete({
      minLength: 3,
      source: function( request, response ) {
          $.ajax({
              url: "/admin/buscar-usuario/",
              dataType: "json",
              data: {
                q: request.term
              },
              success: function( data ) {
                response( data );
              }
          });
      },
      focus: function( event, ui ) {
        $( "#usuario" ).val( ui.item.nombre );
        return false;
      },
      select: function( event, ui ) {
        $("#info_user").show();
        $( "#id_usuario" ).val( ui.item.id_usuario );
        $( "#usuario" ).val( ui.item.nombre );
        $( "#usuario_nombre" ).text( ui.item.nombre );
        $( "#usuario_nif" ).text( ui.item.nif );
        $( "#usuario_fecha_permiso" ).text( ui.item.fecha_permiso );
        $( "#usuario_email" ).html( ui.item.email );
        $( "#usuario_telefono" ).html( ui.item.telefono );
        $( "#icono-usuario" ).attr( "src", ui.item.imagen );
 
        return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li style='height:90px;'>" )
        .append( "<a><img style='float: left; height: 85px; margin-right: 10px;' src='"+item.imagen+"' /><span style='float:left;'>" + item.nombre + "<br>" + item.nif + "<br>" + item.email + "<br>" + item.telefono + "</span></a>" )
        .appendTo( ul );
    };

    $( "#vehiculo" ).autocomplete({
        minLength: 3,
        source: function( request, response ) {
            $.ajax({
                url: "/admin/buscar-vehiculo/",
                dataType: "json",
                data: {
                  q: request.term
                },
                success: function( data ) {
                  response( data );
                }
            });
        },
        focus: function( event, ui ) {
          $( "#vehiculo" ).val( ui.item.nombre );
          return false;
        },
        select: function( event, ui ) {
          $("#info_vehicle").show();
          $( "#id_vehiculo" ).val( ui.item.id_vehiculo );
          $( "#vehiculo" ).val( ui.item.nombre );
          $( "#vehiculo_info" ).text( ui.item.nombre );
          $( "#vehiculo_matricula" ).text( ui.item.matricula);
          $( "#vehiculo_carga" ).removeClass();
          $( "#vehiculo_carga" ).addClass("progress-bar");
          $( "#vehiculo_carga" ).addClass( ui.item.carga );
          $( "#vehiculo_carga" ).css("width", ui.item.porcentaje_carga );
          $( "#porcentaje_carga").text( ui.item.porcentaje_carga );
          $( "#icono_vehiculo" ).attr( "src", ui.item.imagen );
          $( "#vehiculo_seguro" ).text( ui.item.fecha_permiso );
   
          return false;
        }
      })
      .autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li style='height:90px;'>" )
          .append( "<a><img style='float: left; height: 85px; margin-right: 10px;' src='"+item.imagen+"' /><span style='float:left;'>" + item.nombre + "<br>" + item.matricula + "<br><div class='progress progress-xs active m-t-xs m-b-none' style='display: inline-block; width: 95%;'><div class='progress-bar "+item.carga+"' id='vehiculo_carga' data-toggle='tooltip' style='width: "+item.porcentaje_carga+"'></div></div><br>" + item.fecha_permiso + "</span></a>" )
          .appendTo( ul );
      };
  });

  function check_tarifa(id_tarifa){
	  if(!$('#tarifa_'+id_tarifa).is(":checked")){
		  $('#tarifa_'+id_tarifa).click();
	  }
  }
  </script>