{include file="../common/header.tpl"}
<link rel="stylesheet" href="/admin/js/slider/slider.css" type="text/css" />
<section id="content">
	<section class="vbox">
    	<section class="scrollable padder">
        	<div class="m-b-md">
            	<h3 class="m-b-none">
            		<i class="fa fa-car"></i>
            		Vehículos
            		<a title="Añadir vehículo" style="width:40px;font-size:20px;" class="pull-right btn btn-rounded btn-sm btn-icon btn-default" href="/admin/añadir-vehiculo/">
            			<i class="fa fa-plus"></i>
            		</a>
            	</h3>
            </div>
            <div class="row">
				<div class="col-sm-12">
					<section class="panel panel-default"> 
					<header class="panel-heading header-busqueda"> 
						{if $alquilados>0}
							<span class="label bg-danger pull-right m-t-xs">{$alquilados} Alquilado{if $alquilados>1}s{/if}</span>
						{/if} 
						<h4><i class="fa fa-search"></i> Búsqueda</h4>
						<form id="vehicles-filter" role="form" class="form-inline" method="post" action="/admin/vehiculos/">
							<input type="hidden" name="filtrar" value="true" />
		                    <div class="form-group">
		                      <label for="exampleInputEmail2" class="sr-only">Matrícula</label>
		                      <input type="text" placeholder="Matrícula" value="{$filtros['matricula']}" name="matricula" class="form-control">
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
		                    <a data-toggle="modal" class="btn btn-success bfb" href="javascript:$('#vehicles-filter').submit()"><i class="fa fa-refresh"></i> Buscar</a>
		                    {if $filtros['filtrar']!=null}
		                    	<a data-toggle="modal" class="btn btn-danger bfb" href="/admin/vehiculos/"><i class="fa fa-cross"></i> Borrar filtros</a>
		                    {/if}
		            	</form>
					</header>
					<table class="table table-striped m-b-none">
						<thead>
							<tr>
								<th>Vehículo</th>
								<th width="70">Matrícula</th>
								<th>Carga</th>
								<th width="70">Seguro</th>
								<th width="65">Disponible</th>
								<th width="68">Mantenimiento</th>
								<th width="70">Acciones</th>
							</tr>
						</thead>
						<tbody>
							{if $vehicles!=null}
								{foreach from=$vehicles key=cid item=vehicle}
									<tr>
										<td><img style="height:30px;width: 30px; border: 2px solid rgb(238, 238, 238); border-radius: 40px;" src="/repositorio/{$vehicle->imagen}" />{$vehicle->marca} {$vehicle->modelo} {$vehicle->id_vehiculo}</td>
										<td>{$vehicle->matricula}</td>
										<td>
											<div class="progress progress-xs active m-t-xs m-b-none">
												<div class="progress-bar bg-{$vehicle->carga}" data-toggle="tooltip" data-original-title="{$vehicle->porcentaje_carga}" style="width: {$vehicle->porcentaje_carga}"></div>
											</div>
										</td>
										<td {if $vehicle->seguro_pasado}title="Seguro caducado" style="cursor:help;" style="color:red;" class="bg-danger"{/if}>{$vehicle->fecha_vigencia_seguro}</td>
										<td class="text-center">
											<a data-toggle="class" href="#">
												<i class="fa fa-check text-success text{if !$vehicle->disponible}-active{/if}"></i>
												<i class="fa fa-times text-danger text{if $vehicle->disponible}-active{/if}"></i>
											</a>
										</td>
										<td class="text-center">
											<a data-toggle="class" href="#">
												<i class="fa fa-check text-success text{if !$vehicle->mantenimiento}-active{/if}"></i>
												<i class="fa fa-times text-danger text{if $vehicle->mantenimiento}-active{/if}"></i>
											</a>
										</td>
										<td class="text-center">
											<div class="btn-group">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
													class="fa fa-gear"></i> </a>
												<ul class="dropdown-menu pull-right">
													<li><a href="/admin/editar-vehiculo/{$vehicle->id_vehiculo}/">Editar vehículo <i class="fa fa-edit"></i></a></li>
													<li><a href="/admin/borrar-vehiculo/{$vehicle->id_vehiculo}/">Borrar vehículo <i class="fa fa-trash"></i></a></li>
												</ul>
											</div>
										</td>
									</tr>
								{/foreach}
							{else}
								<tr>
									<td style="text-align:center;" colspan="7">No hay vehículos dados de alta</td>
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