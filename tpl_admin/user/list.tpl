{include file="../common/header.tpl"}

{include file="../common/sidebar.tpl"}
<link rel="stylesheet" href="/admin/js/slider/slider.css" type="text/css" />
<section id="content">
	<section class="vbox">
    	<section class="scrollable padder">
        	<div class="m-b-md">
            	<h3 class="m-b-none">
            		{if $label_type_user=='administradores'}
							<i class="fa fa-user"></i>
					{elseif $label_type_user=='colaboradores'}
							<i class="fa fa-wrench"></i>
					{elseif $label_type_user=='electrificados'}
							<i class="fa fa-street-view"></i>
					{/if}
            		Usuarios {$label_type_user}
            		<a title="Añadir vehículo" style="width:40px;font-size:20px;" class="pull-right btn btn-rounded btn-sm btn-icon btn-default" href="/admin/añadir-vehiculo/">
            			<i class="fa fa-plus"></i>
            		</a>
            	</h3>
            </div>
            <div class="row">
				<div class="col-sm-12">
					<section class=""> 
					<header class="panel-heading header-busqueda"> 
						<h4><i class="fa fa-search"></i> Búsqueda</h4>
						<form id="usuarios-filter" role="form" class="form-inline" method="post" action="/admin/usuarios/{$type_user}/">
							<input type="hidden" name="filtrar" value="true" />
							<div class="form-group">
		                      <label for="exampleInputEmail2" class="sr-only">Nif</label>
		                      <input type="text" placeholder="Nif" value="{$filtros['nif']}" name="nif" class="form-control">
		                    </div>
		                    <div class="form-group">
		                      <label for="exampleInputEmail2" class="sr-only">Nombre</label>
		                      <input type="text" placeholder="Nombre" value="{$filtros['nombre']}" name="nombre" class="form-control">
		                    </div>
		                    <div class="form-group">
		                      <label for="exampleInputEmail2" class="sr-only">Email</label>
		                      <input type="text" placeholder="Email" value="{$filtros['email']}" name="email" class="form-control">
		                    </div>
		                    <div class="form-group sfb">
		                      <label class="col-sm-6 control-label lfb">Activo</label>
		                      <div class="col-sm-5">
		                        <label class="switch no-mb">
		                          <input {if $filtros['activacion'] == 'on'}checked{/if} name="activacion" type="checkbox">
		                          <span></span>
		                        </label>
		                      </div>
		                    </div>
		                    <a data-toggle="modal" class="btn btn-success bfb" href="javascript:$('#usuarios-filter').submit()"><i class="fa fa-refresh"></i> Buscar</a>
		                    {if $filtros['filtrar']!=null}
		                    	<a data-toggle="modal" class="btn btn-danger bfb" href="/admin/usuarios/{$type_user}/"><i class="fa fa-cross"></i> Borrar filtros</a>
		                    {/if}
		            	</form>
					</header>
					<section class="scrollable wrapper">              
              			<div class="row">
							{if $usuarios!=null}
								{foreach from=$usuarios key=cid item=usuario}
									<div class="col-sm-4">
				                      <section class="panel panel-default">
				                        <header class="panel-heading bg-light no-border">
				                          <div class="clearfix">
				                            <a class="pull-left thumb-md avatar b-3x m-r" href="#">
				                              <img src="/admin/images/a1.png">
				                            </a>
				                            <div class="clear">
				                              <div class="h3 m-t-xs m-b-xs">
				                                {$usuario->nombre} {$usuario->apellido1} 
				                                <i style="cursor:help;" title="{if $usuario->activacion}Usuario activo{else}Usuario no activo{/if}" class="fa fa-circle {if $usuario->activacion}text-success{else}text-danger{/if} pull-right text-xs m-t-sm"></i>
				                              </div>
				                              <small class="text-muted">Administrador</small>
				                            </div>
				                          </div>
				                        </header>
				                        <div class="list-group no-radius alt">
				                          <a href="mailto:{$usuario->email}" class="list-group-item">
				                            <i class="fa fa-info-circle icon-muted"></i>&nbsp;
				                            {$usuario->nif}
				                          </a>
				                          <a href="mailto:{$usuario->email}" class="list-group-item">
				                            <i class="fa fa-envelope icon-muted"></i>&nbsp;
				                            {$usuario->email}
				                          </a>
				                          <a href="tel:{$usuario->telefono}" class="list-group-item">
				                            <i class="fa fa-phone icon-muted"></i>&nbsp;
				                            {$usuario->telefono}
				                          </a>
				                          
				                            <div class="btn-group btn-group-justified">
							                  <a class="btn btn-primary" href="#">Editar</a>
											  {if $usuario->activacion}
							                  	<a class="btn btn-danger" href="#">Desactivar</a>
							                  {else}
							                  	<a class="btn btn-success" href="#">Activar</a>
							                  {/if}
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