{include file="../common/header.tpl"}

{include file="../common/sidebar.tpl"}

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
                  <form method="get" class="form-horizontal">
                  	<div class="row m-t-xl">
                              <div class="col-xs-12 text-center">
                                <div class="inline">
                                  <div class="easypiechart" data-percent="100" data-line-width="6" data-bar-color="#2796de" data-track-Color="#fff" data-scale-Color="false" data-size="140" data-line-cap='butt' data-animate="1000">
                                    <div class="thumb-lg avatar">
                                      <img src="/admin/images/default-car.png" style="width:80px;" class="dker">
                                    </div>
                                  </div>
                                  <div class="h4 m-t m-b-xs font-bold text-lt"><a href="#"><i class="fa fa-plus"></i> Añadir foto</a></div>
                                </div>
                              </div>
                            </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Marca</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input-id-1" class="col-sm-2 control-label">Modelo</label>
                      <div class="col-sm-10">
                        <input type="text" id="input-id-1" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input-id-1" class="col-sm-2 control-label">Matrícula</label>
                      <div class="col-sm-10">
                        <input type="text" id="input-id-1" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input-id-1" class="col-sm-2 control-label">Bastidor</label>
                      <div class="col-sm-10">
                        <input type="text" id="input-id-1" class="form-control">
                      </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Peso</label>
                      <div class="col-sm-10">
                        <div class="input-group m-b">
                          <input type="text" class="form-control">
                          <span class="input-group-addon">Kg</span>
                        </div>
                      </div>
                      <label class="col-sm-2 control-label">Ancho</label>
                      <div class="col-sm-10">
                        <div class="input-group m-b">
                          <input type="text" class="form-control">
                          <span class="input-group-addon">Cm</span>
                        </div>
                      </div>
                      <label class="col-sm-2 control-label">Largo</label>
                      <div class="col-sm-10">
                        <div class="input-group m-b">
                          <input type="text" class="form-control">
                          <span class="input-group-addon">Cm</span>
                        </div>
                      </div>
                      <label class="col-sm-2 control-label">Plazas</label>
                      <div class="col-sm-10">
                        <input class="slider slider-horizontal form-control" type="text" value="" data-slider-min="1" data-slider-max="5" data-slider-step="1" data-slider-value="2" data-slider-orientation="horizontal" >
                      </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Mantenimiento</label>
                      <div class="col-sm-10">
                        <label class="switch">
                          <input type="checkbox">
                          <span></span>
                        </label>
                      </div>
                      <label class="col-sm-2 control-label">Disponible</label>
                      <div class="col-sm-10">
                        <label class="switch">
                          <input type="checkbox">
                          <span></span>
                        </label>
                      </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
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