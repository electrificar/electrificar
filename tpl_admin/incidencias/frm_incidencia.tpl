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
            		Añadir incidencia
            		<a title="Volver atrás" style="width:40px;font-size:20px;" class="pull-right btn btn-rounded btn-sm btn-icon btn-default" href="/admin/incidencias/{$type_incidence}/">
            			<i class="fa fa-mail-reply"></i>
            		</a>
            	</h3>
            </div>
			<section class="panel panel-default">
                <header class="panel-heading font-bold">
                  Datos de la incidencia
                </header>
                <div class="panel-body">
                  <form enctype="multipart/form-data" method="post" action="/admin/guardar-incidencia/{$type_incidence}/" class="form-horizontal" data-validate="parsley">
                  	<input type="hidden" name="id_incidencia" value="{$incidencia->id_incidencia}" />
                    <div class="form-group">
	                      <label class="col-sm-2 control-label">Asunto</label>
	                      <div class="col-sm-10">
	                        <input type="text" value="{$incidencia->asunto}" data-required="true" name="asunto" class="form-control">
	                      </div>
                      </div>
                      <div class="form-group">
                      <label class="col-sm-2 control-label">Estado</label>
                      <div class="col-sm-10">
                        <select class="form-control m-b" data-required="true" name="estado">
                          <option value="">Seleccione</option>
                          {foreach from=$estados key=cid item=estado}
                          	<option {if $incidencia->estado == $cid }selected{/if} value="{$cid}">{$estado}</option>
                          {/foreach}
                        </select>
                      </div>
                    </div>
                      <div class="form-group">
	                      <label class="col-sm-2 control-label">Descripción</label>
	                      <div class="col-sm-10">	
	                        <textarea data-required="true" name="descripcion" class="form-control">{$incidencia->descripcion}</textarea>
	                      </div>
                      </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Vehiculo</label>
                      <div class="col-sm-10">
                        <select class="form-control m-b" name="id_vehiculo">
                          <option value="">Seleccione</option>
                          {foreach from=$vehiculos key=cid item=vehiculo}
                          	<option {if $vehiculo->id_vehiculo == $incidencia->id_vehiculo}selected{/if} value="{$vehiculo->id_vehiculo}"> {$vehiculo->marca} {$vehiculo->modelo} {$vehiculo->id_vehiculo}</option>
                          {/foreach}
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Colaborador</label>
                      <div class="col-sm-10">
                        <select class="form-control m-b" data-required="true" name="id_colaborador">
                          <option value="">Seleccione</option>
                          {foreach from=$colaboradores key=cid item=colaborador}
                          	<option {if $colaborador->id_colaborador == $incidencia->id_colaborador}selected{/if} value="{$colaborador->id_colaborador}"> {$colaborador->nombre} {$colaborador->apellido1}</option>
                          {/foreach}
                        </select>
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Usuario</label>
                      <div class="col-sm-10">
                        <select class="form-control m-b" name="id_usuario">
                          <option value="">Seleccione</option>
                          {foreach from=$usuarios key=cid item=usuario}
                          	<option {if $usuario->id_usuario == $incidencia->id_usuario}selected{/if} value="{$usuario->id_usuario}">{$usuario->nombre} {$usuario->apellido1}-{$usuario->nif}</option>
                          {/foreach}
                        </select>
                      </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Fecha Fin de Incidencia</label>
                      <div class="col-sm-3">
                        <input value="{$incidencia->fecha_fin_incidencia}" data-date-format="dd/mm/yyyy" name="fecha_fin_incidencia" class="input-sm input-s datepicker-input form-control" type="text"  >
                      </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
	                      <label class="col-sm-2 control-label">Comentarios</label>
	                      <div class="col-sm-10">	
	                        <textarea name="comentarios" class="form-control">{$incidencia->comentarios}</textarea>
	                      </div>
                      </div>
                    <div class="form-group">
                      <div class="col-sm-4 col-sm-offset-2">
                        <button type="button" onclick="document.location='/admin/incidencias/{$type_incidence}/'" class="btn btn-default">Cancelar</button>
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
<script src="/admin/js/usuarios.js"></script>