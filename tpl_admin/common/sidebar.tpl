 	<aside class="bg-black aside-md hidden-print" id="nav">          
          <section class="vbox">
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
                <div class="clearfix wrapper dk nav-user hidden-xs">
                  <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="thumb avatar pull-left m-r">                        
                        <img src="/admin/images/a0.png" class="dker" alt="Miguel" style="background:none repeat scroll 0 0 rgba(190, 255, 225, 0.6);">
                        <i class="on md b-black"></i>
                      </span>
                      <span class="hidden-nav-xs clear">
                        <span class="block m-t-xs">
                          <strong class="font-bold text-lt">Javier</strong> 
                          <b class="caret"></b>
                        </span>
                        <span class="text-muted text-xs block">Administrador</span>
                      </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">                      
                      <li>
                        <a href="/administracion/logout/" data-toggle="ajaxModal" >Desconectar</a>
                      </li>
                    </ul>
                  </div>
                </div>                


                <!-- nav -->                 
                <nav class="nav-primary hidden-xs">
                  <div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Menú</div>
                  <ul class="nav nav-main" data-ride="collapse">
                    <!--    INICIO        -->
                    <li>
                      <a href="/administracion/" class="auto">
                        <i class="i i-home icon">
                        </i>
                        <span class="font-bold">Inicio</span>
                      </a>
                    </li>
                    <!--    CATEGORIAS        -->
                     <li>
                      <a href="/administracion/categorias/" class="auto">
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Categorías</span>
                      </a>
                    </li>
                  </ul>
                  <div class="line dk hidden-nav-xs"></div>
                  <div class="text-muted text-xs hidden-nav-xs padder m-t-sm m-b-sm">Secciones</div>
                  <ul class="nav">
	                    <li class="active">
	                      <a href="#">
	                        <i style="color:#<?=$seccion->color_principal?>" class="i i-circle-sm-o"></i>
	                        <span>Prueba</span>
	                      </a>
	                    </li>
	                     <li >
	                      <a href="#">
	                        <i class="i i-circle-sm-o"></i>
	                        <span>Prueba</span>
	                      </a>
	                    </li>
                  </ul>
                </nav>
                <!-- / nav -->
              </div>
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