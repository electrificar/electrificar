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
            		Añadir tarifa
            		<a title="Volver atrás" style="width:40px;font-size:20px;" class="pull-right btn btn-rounded btn-sm btn-icon btn-default" href="/admin/vehiculos/">
            			<i class="fa fa-mail-reply"></i>
            		</a>
            	</h3>
            </div>
			<section class="panel panel-default">
                <header class="panel-heading font-bold">
                  Datos de tarifa
                </header>
                <div class="panel-body">
                  <form enctype="multipart/form-data" method="post" action="/admin/guardar-tarifa/" class="form-horizontal" data-validate="parsley">
                  	<input type="hidden" name="id_tarifa" value="{$tarifa->id_tarifa}" />
                  	<input type="file" style="display:none;" name="imagen" id="imagen"/>
                  	{if !$tarifa->imagen}
                  		<div class="row m-t-xl">
                              <div class="col-xs-12 text-center">
                                <div class="inline">
                                  <div class="easypiechart" data-percent="100" data-line-width="6" data-bar-color="#2796de" data-track-Color="#fff" data-scale-Color="false" data-size="140" data-line-cap='butt' data-animate="1000">
                                    <div class="thumb-lg avatar">
                                      <a onclick="$('#imagen').click();" href="javascript:;"><img src="/admin/images/default-car.png" style="width:80px;" class="dker"></a>
                                    </div>
                                  </div>
                                  <div class="imagen_tarifa h4 m-t m-b-xs font-bold text-lt"><a onclick="$('#imagen').click();$('#literal_foto').html('Cambiar');" href="javascript:;"><i class="fa fa-plus"></i> <span id="literal_foto">Añadir</span> foto</a></div>
                                </div>
                              </div>
                         </div>
                    {else}
                    	<div class="row m-t-xl">
                    		<div class="col-xs-12 text-center">
                                <div class="inline">
                                  <div class="easypiechart" data-percent="100" data-line-width="6" data-bar-color="#2796de" data-track-Color="#fff" data-scale-Color="false" data-size="140" data-line-cap='butt' data-animate="1000">
                                    <div class="thumb-lg avatar">
                                      <a onclick="$('#imagen').click();" href="javascript:;"><img src="/repositorio/{$tarifa->imagen}" style="width:170px;" class="dker"></a>
                                    </div>
                                  </div>
                                  <div class="imagen_tarifa h4 m-t m-b-xs font-bold text-lt"><a onclick="$('#imagen').click();$('#literal_foto').html('Cambiar');" href="javascript:;"><i class="fa fa-plus"></i> <span id="literal_foto">Cambiar</span> foto</a></div>
                                </div>
                              </div>
                            </div>
                    {/if}
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label for="input-id-1" class="col-sm-2 control-label">Nombre</label>
                      <div class="col-sm-10">
                        <input type="text" value="{$tarifa->nombre}" data-required="true" name="nombre" id="input-id-1" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input-id-1" class="col-sm-2 control-label">Precio</label>
                      <div class="col-sm-10">
                        <input type="text" value="{$tarifa->precio}" data-required="true" data-parsley-minlength="7" maxlength="7" name="precio" id="input-id-1" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input-id-1" class="col-sm-2 control-label">Precio de descuento</label>
                      <div class="col-sm-10">
                        <input type="text" value="{$tarifa->precio_descuento}" data-required="true" data-parsley-minlength="20" maxlength="20" name="precio_descuento" id="input-id-1" class="form-control">
                      </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label for="input-id-1" class="col-sm-2 control-label">Descripción</label>
                      <div class="col-sm-10">
                        <input type="text" value="{$tarifa->descripcion}" data-required="true" data-parsley-minlength="20" maxlength="20" name="descripcion" id="input-id-1" class="form-control">
                      </div>
                    </div>
                      <div class="form-group">
                      <label for="input-id-1" class="col-sm-2 control-label">Duración</label>
                      <div class="col-sm-10">
                        <input type="text" value="{$tarifa->duracion}" data-required="true" data-parsley-minlength="20" maxlength="20" name="duracion" id="input-id-1" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-4 col-sm-offset-2">
                        <button type="button" onclick="document.location='/admin/tarifas/'" class="btn btn-default">Cancelar</button>
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