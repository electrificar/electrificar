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
            		Añadir vehículo
            		<a title="Volver atrás" style="width:40px;font-size:20px;" class="pull-right btn btn-rounded btn-sm btn-icon btn-default" href="/admin/vehiculos/">
            			<i class="fa fa-mail-reply"></i>
            		</a>
            	</h3>
            </div>
			<section class="panel panel-default">
                <header class="panel-heading font-bold">
                  Datos de vehículo
                </header>
                <div class="panel-body">
                  <form enctype="multipart/form-data" method="post" action="/admin/guardar-vehiculo/" class="form-horizontal" data-validate="parsley">
                  	<input type="hidden" name="id_vehiculo" value="{$vehiculo->id_vehiculo}" />
                  	<input type="file" style="display:none;" name="imagen" id="imagen"/>
                  	{if !$vehiculo->imagen}
                  		<div class="row m-t-xl">
                              <div class="col-xs-12 text-center">
                                <div class="inline">
                                  <div class="easypiechart" data-percent="100" data-line-width="6" data-bar-color="#2796de" data-track-Color="#fff" data-scale-Color="false" data-size="140" data-line-cap='butt' data-animate="1000">
                                    <div class="thumb-lg avatar">
                                      <a onclick="$('#imagen').click();" href="javascript:;"><img src="/admin/images/default-car.png" style="width:80px;" class="dker"></a>
                                    </div>
                                  </div>
                                  <div class="imagen_vehiculo h4 m-t m-b-xs font-bold text-lt"><a onclick="$('#imagen').click();$('#literal_foto').html('Cambiar');" href="javascript:;"><i class="fa fa-plus"></i> <span id="literal_foto">Añadir</span> foto</a></div>
                                </div>
                              </div>
                         </div>
                    {else}
                    	<div class="row m-t-xl">
                    		<div class="col-xs-12 text-center">
                                <div class="inline">
                                  <div class="easypiechart" data-percent="100" data-line-width="6" data-bar-color="#2796de" data-track-Color="#fff" data-scale-Color="false" data-size="140" data-line-cap='butt' data-animate="1000">
                                    <div class="thumb-lg avatar">
                                      <a onclick="$('#imagen').click();" href="javascript:;"><img src="/repositorio/{$vehiculo->imagen}" style="width:170px;height: 130px;" class="dker"></a>
                                    </div>
                                  </div>
                                  <div class="imagen_vehiculo h4 m-t m-b-xs font-bold text-lt"><a onclick="$('#imagen').click();$('#literal_foto').html('Cambiar');" href="javascript:;"><i class="fa fa-plus"></i> <span id="literal_foto">Cambiar</span> foto</a></div>
                                </div>
                              </div>
                            </div>
                    {/if}
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Fecha vigencia seguro</label>
                      <div class="col-sm-3">
                        <input value="{$vehiculo->fecha_vigencia_seguro}" name="fecha_vigencia_seguro" class="input-sm input-s datepicker-input form-control" size="16" type="text" value="" data-date-format="dd/mm/yyyy" >
                      </div>
                      <label class="col-sm-2 control-label">Mantenimiento</label>
                      <div class="col-sm-1">
                        <label class="switch">
                          <input name="mantenimiento" {if $vehiculo->mantenimiento}checked{/if} type="checkbox">
                          <span></span>
                        </label>
                      </div>
                      <label class="col-sm-1 control-label">Disponible</label>
                      <div class="col-sm-1">
                        <label class="switch">
                          <input name="disponible" {if $vehiculo->disponible}checked{/if} type="checkbox">
                          <span></span>
                        </label>
                      </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Zona</label>
                      <div class="col-sm-10">
                        <select class="form-control m-b" data-required="true" name="id_zona">
                          <option value="">Seleccione</option>
                          {foreach from=$zonas key=cid item=zona}
                          	<option {if $zona->id_zona == $vehiculo->id_zona}selected{/if} value="{$zona->id_zona}">Zona {$zona->id_zona}</option>
                          {/foreach}
                        </select>
                      </div>
                      <label class="col-sm-2 control-label">Marca</label>
                      <div class="col-sm-10">
                        <input type="text" value="{$vehiculo->marca}" data-required="true" placeholder="Renault" name="marca" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input-id-1" class="col-sm-2 control-label">Modelo</label>
                      <div class="col-sm-10">
                        <input type="text" value="{$vehiculo->modelo}" data-required="true" placeholder="Twizy" name="modelo" id="input-id-1" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input-id-1" class="col-sm-2 control-label">Matrícula</label>
                      <div class="col-sm-10">
                        <input type="text" value="{$vehiculo->matricula}" data-required="true" data-parsley-minlength="7" maxlength="7" name="matricula" id="input-id-1" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input-id-1" class="col-sm-2 control-label">Bastidor</label>
                      <div class="col-sm-10">
                        <input type="text" value="{$vehiculo->bastidor}" data-required="true" data-parsley-minlength="20" maxlength="20" name="bastidor" id="input-id-1" class="form-control">
                      </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Peso</label>
                      <div class="col-sm-10">
                        <div class="input-group m-b">
                          <input type="text" value="{$vehiculo->peso}" maxlength="4" name="peso" class="form-control">
                          <span class="input-group-addon">Kg</span>
                        </div>
                      </div>
                      <label class="col-sm-2 control-label">Ancho</label>
                      <div class="col-sm-10">
                        <div class="input-group m-b">
                          <input type="text" value="{$vehiculo->ancho}" maxlength="4" name="ancho" class="form-control">
                          <span class="input-group-addon">Cm</span>
                        </div>
                      </div>
                      <label class="col-sm-2 control-label">Largo</label>
                      <div class="col-sm-10">
                        <div class="input-group m-b">
                          <input type="text" value="{$vehiculo->largo}" maxlength="4" name="largo" class="form-control">
                          <span class="input-group-addon">Cm</span>
                        </div>
                      </div>
                      <label class="col-sm-2 control-label">Plazas</label>
                      <div class="col-sm-10">
                        <input type="hidden" value="{$vehiculo->numero_plazas}" data-required="true" name="numero_plazas" id="plazas" class="slider-input" />
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-4 col-sm-offset-2">
                        <button type="button" onclick="document.location='/admin/vehiculos/'" class="btn btn-default">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </section>
		</section>
	</section>
</section>
{include file="../common/footer.tpl"}