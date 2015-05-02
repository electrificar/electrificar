{include file="../common/header.tpl"}

{include file="../common/sidebar.tpl"}
<link rel="stylesheet" href="/admin/js/slider/slider.css" type="text/css" />
<section id="content">
	<section class="vbox">
    	<section class="scrollable padder">
        	<div class="m-b-md">
            	<h3 class="m-b-none">
            		<i class="fa fa-globe"></i>
            		Zonas
            		<a title="Añadir zona" style="width:40px;font-size:20px;" class="pull-right btn btn-rounded btn-sm btn-icon btn-default" href="/admin/añadir-zona/">
            			<i class="fa fa-plus"></i>
            		</a>
            	</h3>
            </div>
            <div class="row">
				<div class="col-sm-12">
					<section class="panel panel-default"> 
					<table class="table table-striped m-b-none">
						<thead>
							<tr>
								<th>Zona</th>
								<th>Puntos Carga</th>
								<th>Vehiculos zona</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							{if $zonas!=null}
								{foreach from=$zonas key=cid item=zona}
									<tr>
										<td>Zona {$zona->id_zona}</td>
										<td>{$zona->num_puntos_carga}</td>
										<td>{$zona->num_vehiculos_zona}</td>
										<td class="text-center">
											<div class="btn-group">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
													class="fa fa-gear"></i> </a>
												<ul class="dropdown-menu pull-right" style="text-align:right;">
													<li><a href="/admin/editar-zona/{$zona->id_zona}/">Editar zona <i class="fa fa-edit"></i></a></li>
													<li><a href="/admin/zona/{$zona->id_zona}/puntos-de-carga/">Editar puntos de carga <i class="fa fa-plug"></i></a></li>
												</ul>
											</div>
										</td>
									</tr>
								{/foreach}
							{else}
								<tr>
									<td style="text-align:center;" colspan="4">No hay zonas dadas de alta</td>
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