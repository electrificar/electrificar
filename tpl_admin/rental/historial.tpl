{include file="../common/header.tpl"}

{include file="../common/sidebar.tpl"}
<link rel="stylesheet" href="/admin/js/slider/slider.css" type="text/css" />
<section id="content">
	<section class="vbox">
    	<section class="scrollable padder">
        	<div class="m-b-md">
            	<h3 class="m-b-none">
            		<i class="fa fa-flash"></i>
            		Historial de alquileres de {$historial}
            		<a title="Volver atrás" style="width:40px;font-size:20px;" class="pull-right btn btn-rounded btn-sm btn-icon btn-default" href="/admin/{$back}/">
            			<i class="fa fa-mail-reply"></i>
            		</a>
            	</h3>
            </div>
            <div class="row">
				<div class="col-sm-12">
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
								                <header class="panel-heading bg-success no-border">
						                          <div class="clearfix">
						                            <div class="clear">
						                              <div class="h3 m-t-xs m-b-xs">
						                                <label style="color:#179877;display: inline-block; text-align: center; width: 100%;" id="usuario_nombre">En alquiler actualmente</label> 
						                              </div>
						                            </div>
						                          </div>
						                        </header>
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
			             {else}
			             	<h4>No hay alquileres aún</h4>
			             {/if}
	                 	</div>
					</section>
				</div>
		</section>
	</section>
</section>		        	
{include file="../common/footer.tpl"}