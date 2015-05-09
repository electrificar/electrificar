 	<aside class="bg-light lt b-r b-light aside-md hidden-print" id="nav">          
          <section class="vbox">
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
                <div class="clearfix wrapper dk nav-user hidden-xs">
                  <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="thumb avatar pull-left m-r">        
                      {if $mi_usuario->imagen!=null}                
                      	<img src="/repositorio/{$mi_usuario->imagen}" class="dker" alt="Miguel" style="background:none repeat scroll 0 0 rgba(10, 133, 193, 0.6);">
                      {else}
                      	<img src="/admin/images/a0.png" class="dker" alt="Miguel" style="background:none repeat scroll 0 0 rgba(10, 133, 193, 0.6);">
                      {/if}
                        <i class="on md b-black"></i>
                      </span>
                      <span class="hidden-nav-xs clear">
                        <span class="block m-t-xs">
                          <strong class="font-bold text-lt">{$mi_usuario->nombre}</strong> 
                          <b class="caret"></b>
                        </span>
                        <span class="text-muted text-xs block">Administrador</span>
                      </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                    	<li>
	                        <a href="/admin/editar-usuario/administracion/{$mi_usuario->id_usuario}/"><i class="fa fa-gear"></i> Mi perfil</a>
	                      </li>                      
                     	 <li>
                        	<a href="/admin/logout/" data-toggle="ajaxModal" ><i class="fa fa-sign-out"></i> Desconectar</a>
                      	</li>
                    </ul>
                  </div>
                </div>                

				<!-- nav -->
                <nav class="nav-primary hidden-xs">
                  <div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Menú</div>
                  <ul data-ride="collapse" class="nav nav-main">
                    <li class="{$home}">
                      <a class="auto" href="/admin/home/">
                        <i class="i i-home icon">
                        </i>
                        <span class="font-bold">Inicio</span>
                      </a>
                    </li>
                    <li>
                      <a class="auto" href="#">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="fa fa-flash"></i>
                        <span class="font-bold">Alquileres</span>
                      </a>
                    </li>
                    <li class="{$vehicle}">
                      <a class="auto" href="/admin/vehiculos/">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="fa fa-car">
                        </i>
                        <span class="font-bold">Vehículos</span>
                      </a>
                    </li>
                    <li class="{$users}">
                      <a class="auto" href="javascipt:;">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="fa fa-group">
                        </i>
                        <span class="font-bold">Usuarios</span>
                      </a>
                      <ul class="nav dk" style="{if $users!='active'}display: none;{else}display: block;{/if}">
                        <li class="{$administradores}">
                          <a class="auto" href="/admin/usuarios/administracion/">                                                        
                            <i class="fa fa-user"></i>
                            <span>Administración</span>
                          </a>
                        </li>
                        <li class="{$colaboradores}">
                          <a class="auto" href="/admin/usuarios/colaborador/">
							<i class="fa fa-wrench"></i>
                            <span>Colaborador</span>
                          </a>
                        </li>
                        <li class="{$electrificados}">
                          <a class="auto" href="/admin/usuarios/electrificados/">                                                        
                            <i class="fa fa-street-view"></i>
                            <span>Electrificados</span>
                          </a>
                        </li>
                    	</ul>
                    </li>
                    <li class="{$zone}">
                      <a class="auto" href="/admin/zonas/">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="fa fa-globe">
                        </i>
                        <span class="font-bold">Zonas</span>
                      </a>
                    </li>
                    <li>
                      <a class="auto" href="#">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="fa fa-euro">
                        </i>
                        <span class="font-bold">Tarifas</span>
                      </a>
                    </li>
                    <li class="">
                      <a class="auto" href="#">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <b class="badge bg-danger pull-right">4</b>
                        <i class="fa fa-exclamation-triangle">
                        </i>
                        <span class="font-bold">Incidencias</span>
                      </a>
                      <ul class="nav dk" style="display: none;">
                        <li>
                          <a class="auto" href="layout-color.html"> 
                          <b class="badge bg-primary pull-right">1</b>                                                       
                            <i class="fa fa-car"></i>
                            <span>Coches</span>
                          </a>
                        </li>
                        <li>
                          <a class="auto" href="layout-hbox.html">      
                          <b class="badge bg-info pull-right">1</b>                                                  
                            <i class="fa fa-plug"></i>
                            <span>Puntos Carga</span>
                          </a>
                        </li>
                        <li>
                          <a class="auto" href="layout-boxed.html">   
                          <b class="badge bg-success pull-right">1</b>                                                     
                            <i class="i i-trashcan"></i>

                            <span>Limpieza</span>
                          </a>
                        </li>
                        <li>
                          <a class="auto" href="layout-fluid.html">   
                          <b class="badge bg-danger pull-right">1</b>                                                     
                            <i class="fa fa-ambulance"></i>
                            <span>Accidentes</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  <div class="line dk hidden-nav-xs"></div>
                  
            </section>
            
            <footer class="footer hidden-xs no-padder text-center-nav-xs">
              <a href="modal.lockme.html" data-toggle="ajaxModal" class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs">
                <i class="i i-logout"></i>
              </a>
              <a href="#nav" data-toggle="class:nav-xs" class="btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs">
                <i class="i i-circleleft text"></i>
                <i class="i i-circleright text-active"></i>
              </a>
            </footer>
          </section>
        </aside>