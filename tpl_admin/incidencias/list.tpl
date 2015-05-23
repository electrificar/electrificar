{include file="../common/header.tpl"}

{include file="../common/sidebar.tpl"}
<link rel="stylesheet" href="/admin/js/slider/slider.css" type="text/css" />
<section id="content">
	<section class="vbox">
    	<section class="scrollable padder">
        	<div class="m-b-md">
            	<h3 class="m-b-none">
            		{if $label_type_incidence=='coches'}
							<i class="fa fa-car"></i>
					{elseif $label_type_incidence=='puntos_de_carga'}
							<i class="fa fa-plug"></i>
					{elseif $label_type_incidence=='limpieza'}
							<i class="i i-trashcan"></i>
					{elseif $label_type_incidence=='accidentes'}
							<i class="fa fa-ambulance"></i>
					{/if}
            		Incidencias {$label_type_incidence}
            		<a title="Añadir incidencia" style="width:40px;font-size:20px;" class="pull-right btn btn-rounded btn-sm btn-icon btn-default" href="/admin/añadir-incidencia/{$type_incidence}/">
            			<i class="fa fa-plus"></i>
            		</a>
            	</h3>
            </div>
            <div class="row">
				<div class="col-sm-12">
					<section class=""> 
					<header class="panel-heading header-busqueda"> 
						<h4><i class="fa fa-search"></i> Búsqueda</h4>
						<form id="incidencia-filter" role="form" class="form-inline" method="post" action="/admin/incidencia/{$type_incidence}/">
							<input type="hidden" name="filtrar" value="true" />
		                    <div class="form-group">
		                      <label for="exampleInputEmail2" class="sr-only">Asunto</label>
		                      <input type="text" placeholder="Asunto" value="{$filtros['asunto']}" name="asunto" class="form-control">
		                    </div>
		                    <div class="form-group">
		                      <label for="exampleInputEmail2" class="sr-only">Descripcion</label>
		                      <input type="text" placeholder="Descripcion" value="{$filtros['descripcion']}" name="descripcion" class="form-control">
		                    </div>
		                    <a data-toggle="modal" class="btn btn-success bfb" href="javascript:$('#incidencias-filter').submit()"><i class="fa fa-refresh"></i> Buscar</a>
		                    {if $filtros['filtrar']!=null}
		                    	<a data-toggle="modal" class="btn btn-danger bfb" href="/admin/incidencias/{$type_incidence}/"><i class="fa fa-cross"></i> Borrar filtros</a>
		                    {/if}
		            	</form>
					</header>
					<section class="scrollable wrapper">              
              			<div class="row">
							{if $incidencias!=null}
								{foreach from=$incidencias key=cid item=incidencia}
									<div class="col-sm-4">
				                      <section class="panel panel-default">
				                        <header class="panel-heading bg-light no-border">
				                          <div class="clearfix">
				                          	{foreach from=$colaboradores key=cid item=colaborador}
					                          	{if $colaborador->id_colaborador == $incidencia->id_colaborador}{$colaborador->nombre} {$colaborador->apellido1}{/if}
					                         {/foreach}
				                            <div class="clear">
				                              </div>
				                              <small class="text-muted">{$type_incidence|@ucfirst}</small>
				                              <div class="h3 m-t-xs m-b-xs">
				                                {$incidencia->asunto}<br> 
				                              </div>
				                            </div>
				                        </header>
				                        <div class="list-group no-radius alt">
					                         {if $label_type_user=='colaboradores'}
					                          	<a href="#" class="list-group-item">
					                            	<i class="fa fa-info-circle icon-muted"></i>&nbsp;
					                            	{$usuario->empresa}
					                          	</a>
					                         {/if}
				                          <a href="mailto:{$colaborador->email}" class="list-group-item">
				                            <i class="i i-mail2 icon-muted"></i>&nbsp;
				                            {foreach from=$colaboradores key=cid item=colaborador}
					                          	{if $colaborador->id_colaborador == $incidencia->id_colaborador}{$colaborador->email}{/if}
					                         {/foreach}
				                          </a>
				                          <a href="tel:{$incidencia->fecha_inicio_incidencia}" class="list-group-item">
				                            <i class="fa fa-calendar icon-muted"></i>&nbsp;
				                            {$incidencia->fecha_inicio_incidencia}
				                          </a>
				                            <div class="btn-group btn-group-justified">
							                  <a class="btn btn-primary" href="/admin/editar-incidencia/{$type_incidence}/{$incidencia->id_incidencia}/">Editar</a>
							                  <a class="btn btn-danger" href="/admin/borrar-incidencia/{$type_incidence}/{$incidencia->id_incidencia}/">Borrar</a>
							                </div>
				                        </div>
				                      </section>
				                    </div>
				                {/foreach}
				            {/if}
		            	</div>
		           	</section>
				</section>
			</div>
		</section>
	</section>
</section>		        	
{include file="../common/footer.tpl"}