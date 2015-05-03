{include file="../common/header.tpl"}

{include file="../common/sidebar.tpl"}
<link rel="stylesheet" href="/admin/js/slider/slider.css" type="text/css" />
<section id="content">
	<section class="vbox">
    	<section class="scrollable padder">
        	<div class="m-b-md">
            	<h3 class="m-b-none" style="font-size:20px">
            		<i class="fa fa-plug"></i>
            		Puntos de carga <a href="/admin/zonas/">Zona {$id_zona}</a>
            		<a title="Añadir punto de carga" style="width:40px;font-size:20px;" class="pull-right btn btn-rounded btn-sm btn-icon btn-default" href="/admin/zona/{$id_zona}/añadir-punto-de-carga/">
            			<i class="fa fa-plus"></i>
            		</a>
            	</h3>
            	<br>
            </div>
            <div class="row">
				<div class="col-sm-12">
					<section class="panel panel-default"> 
					<header class="panel-heading header-busqueda">
						<h4><i class="fa fa-search"></i> Búsqueda</h4>
						<form id="punto_cargas-filter" role="form" class="form-inline" method="post" action="/admin/zona/{$id_zona}/puntos-de-carga/">
							<input type="hidden" name="filtrar" value="true" />
		                    <div class="form-group">
		                      <label for="exampleInputEmail2" class="sr-only">Dirección</label>
		                      <input type="text" placeholder="Dirección" value="{$filtros['direccion']}" name="direccion" class="form-control">
		                    </div>
		                    <div class="form-group sfb">
		                      <label class="col-sm-6 control-label lfb">Disponible</label>
		                      <div class="col-sm-5">
		                        <label class="switch no-mb">
		                          <input {if $filtros['disponible'] == 'on'}checked{/if} name="disponible" type="checkbox">
		                          <span></span>
		                        </label>
		                      </div>
		                    </div>
		                    <div class="form-group sfb">
		                      <label class="col-sm-6 control-label lfb">Ocupado</label>
		                      <div class="col-sm-5">
		                        <label class="switch no-mb">
		                          <input {if $filtros['ocupado'] == 'on'}checked{/if} name="ocupado" type="checkbox">
		                          <span></span>
		                        </label>
		                      </div>
		                    </div>
		                    <a data-toggle="modal" class="btn btn-success bfb" href="javascript:$('#punto_cargas-filter').submit()"><i class="fa fa-refresh"></i> Buscar</a>
		                    {if $filtros['filtrar']!=null}
		                    	<a data-toggle="modal" class="btn btn-danger bfb" href="/admin/zona/{$id_zona}/puntos-de-carga/"><i class="fa fa-cross"></i> Borrar filtros</a>
		                    {/if}
		            	</form>
					</header>
					<table class="table table-striped m-b-none">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Direccion</th>
								<th>Ocupado</th>
								<th>Disponible</th>
								<th width="70">Acciones</th>
							</tr>
						</thead>
						<tbody>
							{if $puntos_carga!=null}
								{foreach from=$puntos_carga key=cid item=punto_carga}
									<tr>
										<td>{$punto_carga->nombre}</td>
										<td>{$punto_carga->direccion}</td>
										<td class="text-center">
											<a data-toggle="class" href="#">
												<i class="fa fa-check text-success text{if !$punto_carga->ocupado}-active{/if}"></i>
												<i class="fa fa-times text-danger text{if $punto_carga->ocupado}-active{/if}"></i>
											</a>
										</td>
										<td class="text-center">
											<a data-toggle="class" href="#">
												<i class="fa fa-check text-success text{if !$punto_carga->disponible}-active{/if}"></i>
												<i class="fa fa-times text-danger text{if $punto_carga->disponible}-active{/if}"></i>
											</a>
										</td>
										<td class="text-center">
											<div class="btn-group">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
													class="fa fa-gear"></i> </a>
												<ul class="dropdown-menu pull-right">
													<li><a href="/admin/editar-punto-de-carga/{$punto_carga->id_punto_carga}/">Editar punto carga <i class="fa fa-edit"></i></a></li>
													<li><a href="/admin/borrar-punto-de-carga/{$punto_carga->id_punto_carga}/">Borrar punto carga <i class="fa fa-trash"></i></a></li>
												</ul>
											</div>
										</td>
									</tr>
								{/foreach}
							{else}
								<tr>
									<td style="text-align:center;" colspan="5">No hay puntos de carga dados de alta</td>
								</tr>
							{/if}
						</tbody>
					</table>
					</section>
				</div>
		</section>
	</section>
</section>		        	
{include file="../common/footer.tpl"}