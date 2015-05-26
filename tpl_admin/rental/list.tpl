{include file="../common/header.tpl"}

{include file="../common/sidebar.tpl"}
<section id="content">
	<section class="vbox">
    	<section class="scrollable padder">
        	<div class="m-b-md">
            	<h3 class="m-b-none">
            		<i class="fa fa-flash"></i>
            		Alquileres
            		<a title="Añadir alquiler" style="width:40px;font-size:20px;" class="pull-right btn btn-rounded btn-sm btn-icon btn-default" href="/admin/añadir-alquiler/">
            			<i class="fa fa-plus"></i>
            		</a>
            	</h3>
            </div>
            <div class="row">
				<div class="col-sm-12">
					<section class="panel panel-default"> 
					<header class="panel-heading header-busqueda"> 
						{if $num_alquileres>0}
							<span class="label bg-danger pull-right m-t-xs">{$num_alquileres} coche{if $num_alquileres>1}s{/if} en alquiler actualmente</span>
						{/if} 
						<h4><i class="fa fa-search"></i> Búsqueda</h4>
						<form id="vehicles-filter" role="form" class="form-inline" method="post" action="/admin/alquileres/">
							<input type="hidden" name="filtrar" value="true" />
		                    <div class="form-group">
		                      <label for="exampleInputEmail2" class="sr-only">Nif</label>
		                      <input type="text" placeholder="Nif" value="{$filtros['usuario_nif']}" name="usuario.nif" class="form-control">
		                    </div>
		                    <div class="form-group">
		                      <label for="exampleInputEmail2" class="sr-only">Nombre</label>
		                      <input type="text" placeholder="Nombre / apellido1" value="{$filtros['usuario_nombre']}" name="usuario.nombre" class="form-control">
		                    </div>
		                    <div class="form-group">
		                      <label for="exampleInputEmail2" class="sr-only">Email</label>
		                      <input type="text" placeholder="Email" value="{$filtros['usuario_email']}" name="usuario.email" class="form-control">
		                    </div>
		                    <div class="form-group">
		                      <label for="exampleInputEmail2" class="sr-only">Matrícula</label>
		                      <input type="text" placeholder="Matrícula" value="{$filtros['vehiculo_matricula']}" name="vehiculo.matricula" class="form-control">
		                    </div>
		                    <a data-toggle="modal" class="btn btn-success bfb" href="javascript:$('#vehicles-filter').submit()"><i class="fa fa-refresh"></i> Buscar</a>
		                    {if $filtros['filtrar']!=null}
		                    	<a data-toggle="modal" class="btn btn-danger bfb" href="/admin/alquileres/"><i class="fa fa-cross"></i> Borrar filtros</a>
		                    {/if}
		            	</form>
					</header>
					<section class="scrollable wrapper">
						<div class="timeline">
						{if $rentals!=null}
							{foreach from=$rentals key=cid item=rental}
			                    <article class="timeline-item {if $cid==0}active{else}{if $cid%2!=0}alt{/if}{/if} ">
			                        <div class="timeline-caption" style="width: 100%;">
			                          <div class="panel panel-default">
			                            <div class="panel-body">
			                            	{if $cid!=0}
			                            		{if $cid%2!=0}
			                              			<span class="arrow right"></span>
			                              		{else}
			                              			<span class="arrow left"></span>
			                              		{/if}
			                              	{/if}
			                              {if $cid!=0}
			                              	<span class="timeline-icon"><i class="fa fa-flash time-icon bg-primary"></i></span>
			                              	<span class="timeline-date">{$rental->fecha_inicio_alquiler}</span>
			                              {else}
			                              	<span style="margin: 5px auto; display: inline-block; width: 100%;" class="text-center">Último alquiler realizado ({$rental->fecha_inicio_alquiler})</span>
			                              {/if}
			                              <section class="col-sm-12" style="float:none;margin:0 auto;">
					                        <header class="panel-heading bg-light no-border">
					                          <div class="clearfix">
					                            <a href="#" class="pull-left thumb-md avatar b-3x m-r">
					                              <img style="height:60px;" id="icono-usuario" src="/repositorio/{$rental->imagen_usuario}">
					                            </a>
					                            <div class="clear">
					                              <div class="h3 m-t-xs m-b-xs">
					                                <a href="/admin/editar-usuario/electrificados/{$rental->id_usuario}/" id="usuario_nombre">{$rental->nombre_usuario}</a> 
					                              </div>
					                              <small class="text-muted">Electrificado</small>
					                            </div>
					                          </div>
					                        </header>
					                        <div class="no-radius alt">
					                          <a class="list-group-item" href="javascript:;">
				                            	<i class="fa fa-dollar icon-muted"></i>&nbsp;
				                            	<label id="usuario_nif">{$rental->nombre_tarifa}</label>
				                          	  </a>
				                          	  <a class="list-group-item" href="javascript:;">
				                            	<i class="fa fa-globe icon-muted"></i>&nbsp;
				                            	<label id="usuario_fecha_permiso">Zona {$rental->id_zona}</label>
				                          	  </a>
				                         	  <a class="list-group-item" href="mailto:{$rental->email}">
			                            		<i class="fa fa-envelope icon-muted"></i>&nbsp;
			                            		<label id="usuario_email">{$rental->email}</label>
			                          		  </a>
			                          		  <a class="list-group-item" href="tel:{$rental->telefono}">
			                            		<i class="fa fa-phone icon-muted"></i>&nbsp;
			                            		<label id="usuario_telefono">{$rental->telefono}</label>
			                          			</a>
					                        </div>
					                        <header onclick="document.location='/admin/editar-vehiculo/{$rental->id_vehiculo}/'" class="panel-heading bg-light no-border" style="cursor:pointer !important;">
					                          <div class="clearfix">
					                            <a href="#" class="pull-left thumb-md avatar b-3x m-r">
					                              <img style="height:60px;" id="icono-usuario" src="/repositorio/{$rental->imagen_vehiculo}">
					                            </a>
					                            <div class="clear">
					                              <div class="h3 m-t-xs m-b-xs">
					                                <a href="#" id="usuario_nombre">{$rental->marca} {$rental->modelo}</a> 
					                              </div>
					                              <small class="text-muted">{$rental->matricula}</small>
					                            </div>
					                          </div>
					                        </header>
					                        {if $rental->fecha_fin_alquiler==''}
								                <div class="btn-group btn-group-justified">
								                  	<a class="btn btn-success" href="/admin/finalizar-alquiler/{$rental->id_alquiler}/">Finalizar alquiler</a>
								                </div>
								            {else}
								            	<header class="panel-heading bg-success no-border">
						                          <div class="clearfix">
						                            <div class="clear">
						                              <div class="h3 m-t-xs m-b-xs">
						                                <label style="color:#179877;display: inline-block; text-align: center; width: 100%;" id="usuario_nombre">Devuelto el {$rental->fecha_fin_alquiler}</label> 
						                              </div>
						                            </div>
						                          </div>
						                        </header>
							                {/if}
					                      </section>
			                            </div>       
			                          </div>
			                        </div>
			                    </article>
			             	{/foreach}
			             	<div class="timeline-footer"><a href="#"><i class="fa fa-plus time-icon inline-block bg-dark"></i></a></div>
			             {else}
			             	<h4>No hay alquileres aún</h4>
			             {/if}
	                 	</div>
	                 </section>
					</section>
				</div>
		</section>
	</section>
</section>		 
{include file="../common/footer.tpl"}