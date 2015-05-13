{include file="../common/header.tpl"}

{include file="../common/sidebar.tpl"}
<link rel="stylesheet" href="/admin/js/slider/slider.css" type="text/css" />
<section id="content">
	<section class="vbox">
    	<section class="scrollable padder">
        	<div class="m-b-md">
            	<h3 class="m-b-none">
            		<i class="fa fa-euro"></i>
            		Tarifas
            		<a title="Añadir tarifa" style="width:40px;font-size:20px;" class="pull-right btn btn-rounded btn-sm btn-icon btn-default" href="/admin/añadir-tarifa/">
            			<i class="fa fa-plus"></i>
            		</a>
            	</h3>
            </div>
            <div class="row">
				<div class="col-sm-12">
					<section class="panel panel-default"> 
					<header class="panel-heading header-busqueda"> 
						<h4><i class="fa fa-search"></i> Búsqueda</h4>
						<form id="tarifas-filter" role="form" class="form-inline" method="post" action="/admin/tarifas/">
							<input type="hidden" name="filtrar" value="true" />
		                    <div class="form-group">
		                      <label for="exampleInputEmail2" class="sr-only">Nombre tarifa</label>
		                      <input type="text" placeholder="Nombre Tarifa" value="{$filtros['nombre']}" name="nombre" class="form-control">
		                    </div>
		                    <a data-toggle="modal" class="btn btn-success bfb" href="javascript:$('#tarifas-filter').submit()"><i class="fa fa-refresh"></i> Buscar</a>
		                    {if $filtros['filtrar']!=null}
		                    	<a data-toggle="modal" class="btn btn-danger bfb" href="/admin/tarifas/"><i class="fa fa-cross"></i> Borrar filtros</a>
		                    {/if}
		            	</form>
					</header>
					<table class="table table-striped m-b-none">
						<thead>
							<tr>
								<th>Nombre</th>
								<th width="350">Precio</th>
								<th>Precio de descuento</th>
								<th width="65">Duración</th>
								<th width="70">Acciones</th>
							</tr>
						</thead>
						<tbody>
							{if $tarifas!=null}
								{foreach from=$tarifas key=cid item=tarifa}
									<tr>
										<td>{$tarifa->nombre}</td>
										<td>{$tarifa->precio}</td>
										<td>{$tarifa->precio_descuento}</td>
										<td>{$tarifa->duracion}</td>
										</td>
										<td class="text-center">
											<div class="btn-group">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
													class="fa fa-gear"></i> </a>
												<ul class="dropdown-menu pull-right">
													<li><a href="/admin/editar-tarifa/{$tarifa->id_tarifa}/">Editar tarifa <i class="fa fa-edit"></i></a></li>
													<li><a href="/admin/borrar-tarifa/{$tarifa->id_tarifa}/">Borrar tarifa <i class="fa fa-trash"></i></a></li>
												</ul>
											</div>
										</td>
									</tr>
								{/foreach}
							{else}
								<tr>
									<td style="text-align:center;" colspan="7">No hay tarifas dadas de alta</td>
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