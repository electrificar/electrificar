{include file="../common/header.tpl"}

{include file="../common/sidebar.tpl"}

<section id="content">
    	<section class="hbox stretch">
        	<section>
            	<section class="vbox">
            		<section class="scrollable wrapper">
            			<section class="panel panel-default">
		            		<header class="panel-heading font-bold">
								<div class="h2">
									<i class="i i-home icon"> </i>
									<span class="font-thin">Inicio</span>
								</div>
							</header>
		                	<section class="panel-body">
			                	<div class="row">  
				                  	<div class="col-lg-6">
				                  		<section class="panel panel-default">
						                    <div class="panel-body" style="background-color:#d7ecfa;">
						                      <div class="clearfix text-center m-t">
						                        <div class="inline">
						                          <div data-animate="1000" data-line-cap="butt" data-size="134" data-scale-color="false" data-track-color="#f5f5f5" data-bar-color="#177BBB" data-line-width="5" data-percent="100" class="easypiechart easyPieChart" style="width: 134px; height: 134px; line-height: 134px;">
						                            <div class="thumb-lg">
						                              <a style="font-size:54px" href="/administracion/la-guinot-<?=url_amigable(strtolower($seccion->dc_seccion))?>/"><i class="fa fa-flash"></i></a>
						                            </div>
						                          <canvas height="134" width="134"></canvas></div>
						                          <div class="h4 m-t m-b-xs"><a style="font-weight:bold;color:#000;" href="/administracion/la-guinot-<?=url_amigable(strtolower($seccion->dc_seccion))?>/">Alquileres</a></div>
						                        </div>                      
						                      </div>
						                    </div>
						                    <footer class="panel-footer bg-info text-center" style="background-color: rgb(23, 123, 187);">
						                      <div class="row pull-out">
						                        <div class="col-xs-6">
						                          <div class="padder-v">
						                            <span class="m-b-xs h3 block text-white">{$alquilados}</span>
						                            <small class="text-lt">Activo{if $alquilados>1}s{/if}</small>
						                          </div>
						                        </div>
						                        <div class="col-xs-6 dk" style="background-color:#126DA7">
						                          <div class="padder-v">
						                            <span class="m-b-xs h3 block text-white">{$historial_alquilados}</span>
						                            <small class="text-lt">Historial</small>
						                          </div>
						                        </div>
						                      </div>
						                    </footer>
					                	</section>
				                	</div>
				                	<div class="col-lg-6">
				                  		<section class="panel panel-default">
						                    <div class="panel-body" style="background-color: rgb(255, 138, 125);">
						                      <div class="clearfix text-center m-t">
						                        <div class="inline">
						                          <div data-animate="1000" data-line-cap="butt" data-size="134" data-scale-color="false" data-track-color="#f5f5f5" data-bar-color="#F95446" data-line-width="5" data-percent="100" class="easypiechart easyPieChart" style="width: 134px; height: 134px; line-height: 134px;">
						                            <div class="thumb-lg">
						                              <a style="font-size:54px" href="/administracion/la-guinot-<?=url_amigable(strtolower($seccion->dc_seccion))?>/"><i class="fa fa-exclamation-triangle"> </i></a>
						                            </div>
						                          <canvas height="134" width="134"></canvas></div>
						                          <div class="h4 m-t m-b-xs"><a style="font-weight:bold;color:#000;" href="/administracion/la-guinot-<?=url_amigable(strtolower($seccion->dc_seccion))?>/">Incidencias</a></div>
						                        </div>                      
						                      </div>
						                    </div>
						                    <footer class="panel-footer bg-info text-center" style="background-color:#F95446">
						                      <div class="row pull-out">
						                        <div class="col-xs-6">
						                          <div class="padder-v">
						                            <span class="m-b-xs h3 block text-white">{$incidencias}</span>
						                            <small class="text-lt">Abiertas</small>
						                          </div>
						                        </div>
						                        <div class="col-xs-6 dk" style="background-color:#bf4436">
						                          <div class="padder-v">
						                            <span class="m-b-xs h3 block text-white">{$historial_incidencias}</span>
						                            <small class="text-lt">Cerradas</small>
						                          </div>
						                        </div>
						                      </div>
						                    </footer>
					                	</section>
				                	</div>
				                </div>
			                </section>
		        		</section>
                	</section>
              	</section>              
          	</aside>
            <!-- / side content -->
		</section>
        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
	</section>
</section>
{include file="../common/footer.tpl"}