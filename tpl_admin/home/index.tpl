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
								<span class="font-thin">Secciones</span>
							</div>
						</header>
	                	<section class="panel-body">
	                	<div class="row">  
	                		<?php foreach($secciones as $seccion){
	                			$param_filtro=array();
	                			anade_filtrado($param_filtro,"id_seccion",$seccion->id_seccion,"=");
								$ackExistFotoSeccion = $FotoSeccion->get_foto_seccion($param_filtro);
								$TotalCategorias = $FotoSeccion->getNumCatSeccion($seccion->id_seccion);
	                			?>
			                  	<div class="col-lg-6">
			                  		<section class="panel panel-default">
					                    <div class="panel-body">
					                      <div class="clearfix text-center m-t">
					                        <div class="inline">
					                          <div data-animate="1000" data-line-cap="butt" data-size="134" data-scale-color="false" data-track-color="#f5f5f5" data-bar-color="#<?=$seccion->color_principal?>" data-line-width="5" data-percent="100" class="easypiechart easyPieChart" style="width: 134px; height: 134px; line-height: 134px;">
					                            <div class="thumb-lg">
					                              <a href="/administracion/la-guinot-<?=url_amigable(strtolower($seccion->dc_seccion))?>/"><img style="max-width: 90%" src="/admin/images/laGuinot.png"></a>
					                            </div>
					                          <canvas height="134" width="134"></canvas></div>
					                          <div class="h4 m-t m-b-xs"><a style="font-weight:bold;color:#<?=$seccion->color_principal?>;" href="/administracion/la-guinot-<?=url_amigable(strtolower($seccion->dc_seccion))?>/"><?=$seccion->dc_seccion?></a></div>
					                        </div>                      
					                      </div>
					                    </div>
					                    <footer class="panel-footer bg-info text-center" style="background-color:#<?=$seccion->color_principal?>">
					                      <div class="row pull-out">
					                        <div class="col-xs-6">
					                          <div class="padder-v">
					                            <span class="m-b-xs h3 block text-white"><?=count($ackExistFotoSeccion->datos)?></span>
					                            <small class="text-lt">Imágenes</small>
					                          </div>
					                        </div>
					                        <div class="col-xs-6 dk" style="background-color:#<?=$seccion->color_secundario?>">
					                          <div class="padder-v">
					                            <span class="m-b-xs h3 block text-white"><?=$TotalCategorias?></span>
					                            <small class="text-lt">Categorías</small>
					                          </div>
					                        </div>
					                      </div>
					                    </footer>
				                	</section>
			                	</div>
			                <?php }?>
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

{include file="../common/footer.tpl"}