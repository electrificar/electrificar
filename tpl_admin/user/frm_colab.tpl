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
            		Añadir colaborador
            		<a title="Volver atrás" style="width:40px;font-size:20px;" class="pull-right btn btn-rounded btn-sm btn-icon btn-default" href="/admin/usuarios/{$type_user}/">
            			<i class="fa fa-mail-reply"></i>
            		</a>
            	</h3>
            </div>
			<section class="panel panel-default">
                <header class="panel-heading font-bold">
                  Datos del usuario
                </header>
                <div class="panel-body">
                  <form enctype="multipart/form-data" method="post" action="/admin/guardar-usuario/{$type_user}/" class="form-horizontal" data-validate="parsley">
                  	<input type="hidden" name="id_usuario" value="{$usuario->id_usuario}" />
                  	<input type="hidden" name="id_colaborador" value="{$usuario->id_colaborador}" />
                  	<input type="hidden" id="user_type" value="{$type_user_id}" />
                  	<input type="file" style="display:none;" name="imagen" id="imagen"/>
                  	{if !$usuario->imagen}
                  		<div class="row m-t-xl">
                              <div class="col-xs-12 text-center">
                                <div class="inline">
                                  <div class="easypiechart" data-percent="100" data-line-width="6" data-bar-color="#2796de" data-track-Color="#fff" data-scale-Color="false" data-size="140" data-line-cap='butt' data-animate="1000">
                                    <div class="thumb-lg avatar">
                                      <a onclick="$('#imagen').click();" href="javascript:;"><img src="/admin/images/default-user.png" style="width:80px;height:80px;" class="dker"></a>
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
                                      <a onclick="$('#imagen').click();" href="javascript:;"><img src="/repositorio/{$usuario->imagen}" style="width:170px;height:130px;" class="dker"></a>
                                    </div>
                                  </div>
                                  <div class="imagen_vehiculo h4 m-t m-b-xs font-bold text-lt"><a onclick="$('#imagen').click();$('#literal_foto').html('Cambiar');" href="javascript:;"><i class="fa fa-plus"></i> <span id="literal_foto">Cambiar</span> foto</a></div>
                                </div>
                              </div>
                            </div>
                    {/if}
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-3" id="email_container">
                        <input value="{$usuario->email}" data-required="true" id="email" name="email" data-type="email" class="input-sm input-s form-control" size="16" type="text"  >
                      </div>
                      <label class="col-sm-1 control-label">Password</label>
                      <div class="col-sm-3">
                        <input value="{$usuario->password}" data-required="true" name="password" class="input-sm input-s form-control" size="16" type="text"  >
                      </div>
                      <label class="col-sm-1 control-label">Activo</label>
                      <div class="col-sm-1">
                        <label class="switch">
                          <input name="activacion" {if $usuario->activacion}checked{/if} type="checkbox">
                          <span></span>
                        </label>
                      </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                      <div class="form-group">
	                      <label class="col-sm-2 control-label">Nif</label>
	                      <div class="col-sm-10">
	                        <input type="text" value="{$usuario->nif}" data-required="true" name="nif" class="form-control">
	                      </div>
                      </div>
                      <div class="form-group">
	                      <label class="col-sm-2 control-label">Tipo</label>
	                      <div class="col-sm-10">
	                      	<select class="form-control m-b" data-required="true" name="tipo_colaborador">
	                          <option value="">Seleccione</option>
	                          {foreach from=$tipos key=cid item=tipo}
	                          	<option {if $tipo['id_tipo'] == $usuario->tipo_colaborador}selected{/if} value="{$tipo['id_tipo']}">{$tipo['tipo']}</option>
	                          {/foreach}
	                        </select>  
	                      </div>
                      </div>
                      <div class="form-group">
	                      <label class="col-sm-2 control-label">Empresa</label>
	                      <div class="col-sm-10">
	                        <select class="form-control m-b" data-required="true" name="empresa">
	                          <option value="">Seleccione</option>
	                          {foreach from=$empresas key=cid item=empresa}
	                          	<option {if $empresa['id_empresa'] == $usuario->empresa}selected{/if} value="{$empresa['id_empresa']}">{$empresa['empresa']}</option>
	                          {/foreach}
	                        </select>  
	                      </div>
                      </div>
                      <div class="form-group">
	                      <label class="col-sm-2 control-label">Descripción</label>
	                      <div class="col-sm-10">
	                        <textarea data-required="true" name="descripcion" class="form-control">{$usuario->descripcion}</textarea>
	                      </div>
                      </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Nombre</label>
                      <div class="col-sm-10">
                        <input type="text" value="{$usuario->nombre}" data-required="true" name="nombre" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input-id-1" class="col-sm-2 control-label">Primer apellido</label>
                      <div class="col-sm-10">
                        <input type="text" value="{$usuario->apellido1}" data-required="true" name="apellido1" id="input-id-1" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input-id-1" class="col-sm-2 control-label">Segundo apellido</label>
                      <div class="col-sm-10">
                        <input type="text" value="{$usuario->apellido2}" name="apellido2" id="input-id-1" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input-id-1" class="col-sm-2 control-label">Teléfono</label>
                      <div class="col-sm-10">
                        <input type="text" value="{$usuario->telefono}" data-required="true" data-parsley-minlength="9" maxlength="9" name="telefono" id="input-id-1" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-4 col-sm-offset-2">
                        <button type="button" onclick="document.location='/admin/usuarios/{$type_user}/'" class="btn btn-default">Cancelar</button>
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