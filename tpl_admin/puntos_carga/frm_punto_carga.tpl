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
            		Añadir punto de carga a la Zona {$id_zona}
            		<a title="Volver atrás" style="width:40px;font-size:20px;" class="pull-right btn btn-rounded btn-sm btn-icon btn-default" href="/admin/zona/{$id_zona}/puntos-de-carga/">
            			<i class="fa fa-mail-reply"></i>
            		</a>
            	</h3>
            </div>
			<section class="panel panel-default">
                <header class="panel-heading font-bold">
                  Datos del punto de carga
                </header>
                <div class="panel-body">
                  <form enctype="multipart/form-data" method="post" action="/admin/guardar-punto-de-carga/" class="form-horizontal" data-validate="parsley">
                  	<input type="hidden" name="id_zona" value="{$id_zona}" />
                  	<input type="hidden" name="id_punto_carga" value="{$punto_carga->id_punto_carga}" />
                  	<input type="file" style="display:none;" name="imagen" id="imagen"/>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Nombre</label>
                      <div class="col-sm-10">
                        <input type="text" value="{$punto_carga->nombre}" data-required="true" placeholder="" name="nombre" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input-id-1" class="col-sm-2 control-label">Direccion</label>
                      <div class="col-sm-10">
                        <input type="text" value="{$punto_carga->direccion}" data-required="true" placeholder="" name="direccion" id="input-id-1" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input-id-1" class="col-sm-2 control-label">Latitud</label>
                      <div class="col-sm-10">
                        <input type="text" value="{$punto_carga->latitud}" data-required="true" name="latitud" id="input-id-1" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input-id-1" class="col-sm-2 control-label">Longitud</label>
                      <div class="col-sm-10">
                        <input type="text" value="{$punto_carga->longitud}" data-required="true" name="longitud" id="input-id-1" class="form-control">
                      </div>
                    </div>
                    <label class="col-sm-2 control-label">Ocupado</label>
                      <div class="col-sm-1">
                        <label class="switch">
                          <input name="ocupado" {if $punto_carga->ocupado}checked{/if} type="checkbox">
                          <span></span>
                        </label>
                      </div>
                      <label class="col-sm-1 control-label">Disponible</label>
                      <div class="col-sm-1">
                        <label class="switch">
                          <input name="disponible" {if $punto_carga->disponible}checked{/if} type="checkbox">
                          <span></span>
                        </label>
                      </div>
                    <div class="form-group">
                      <div class="col-sm-3">
                      	<button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" onclick="document.location='/admin/zona/{$id_zona}/puntos-de-carga/'" class="btn btn-default">Cancelar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </section>
		</section>
	</section>
</section>
{include file="../common/footer.tpl"}