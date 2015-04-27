{include file="../common/header.tpl"}

{include file="../common/sidebar.tpl"}

<section id="content">
	<section class="vbox">
    	<section class="scrollable padder">
        	<div class="m-b-md">
            	<h3 class="m-b-none">
            		<i class="fa fa-car"></i>
            		Vehículos
            	</h3>
            </div>
            <div class="row">
				<div class="col-sm-12">
					<section class="panel panel-default"> 
					<header class="panel-heading header-busqueda"> 
						<span class="label bg-danger pull-right m-t-xs">1 Alquilado</span> 
						<h4><i class="fa fa-search"></i> Búsqueda</h4>
						<form role="form" class="form-inline">
		                    <div class="form-group">
		                      <label for="exampleInputEmail2" class="sr-only">Matrícula</label>
		                      <input type="email" placeholder="Matrícula" id="exampleInputEmail2" class="form-control">
		                    </div>
		                    <div class="form-group sfb">
		                      <label class="col-sm-6 control-label lfb">Disponible</label>
		                      <div class="col-sm-5">
		                        <label class="switch no-mb">
		                          <input type="checkbox">
		                          <span></span>
		                        </label>
		                      </div>
		                    </div>
		                    <div class="form-group sfb">
		                      <label class="col-sm-6 control-label lfb">Mantenimiento</label>
		                      <div class="col-sm-5">
		                        <label class="switch no-mb">
		                          <input type="checkbox">
		                          <span></span>
		                        </label>
		                      </div>
		                    </div>
		                    <a data-toggle="modal" class="btn btn-success bfb" href="#modal-form"><i class="fa fa-refresh"></i> Buscar</a>
		            	</form>
					</header>
					<table class="table table-striped m-b-none">
						<thead>
							<tr>
								<th>Vehículo</th>
								<th width="70">Matrícula</th>
								<th>Carga</th>
								<th width="70">Seguro</th>
								<th width="65">Disponible</th>
								<th width="68">Mantenimiento</th>
								<th width="70">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Renault Twizzy001</td>
								<td>9355 GJS</td>
								<td>
									<div
										class="progress progress-xs active m-t-xs m-b-none">
										<div class="progress-bar bg-success" data-toggle="tooltip"
											data-original-title="80%" style="width: 80%"></div>
									</div>
								</td>
								<td>01/01/2016</td>
								<td class="text-center">
									<a data-toggle="class" href="#">
										<i class="fa fa-check text-success text-active"></i>
										<i class="fa fa-times text-danger text"></i>
									</a>
								</td>
								<td class="text-center">
									<a data-toggle="class" href="#">
										<i class="fa fa-check text-success text-active"></i>
										<i class="fa fa-times text-danger text"></i>
									</a>
								</td>
								<td class="text-center">
									<div class="btn-group">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
											class="fa fa-gear"></i> </a>
										<ul class="dropdown-menu pull-right">
											<li><a href="#">Editar vehículo <i class="fa fa-edit"></i></a></li>
											<li><a href="#">Borrar vehículo <i class="fa fa-trash"></i></a></li>
										</ul>
									</div>
								</td>
							</tr>
							<tr>
								<td>Renault Twizzy002</td>
								<td>8923 HZN</td>
								<td>
									<div
										class="progress progress-xs active m-t-xs m-b-none">
										<div class="progress-bar bg-info" data-toggle="tooltip"
											data-original-title="60%" style="width: 60%"></div>
									</div>
								</td>
								<td>23/11/2015</td>
								<td class="text-center">
									<a data-toggle="class" href="#">
										<i class="fa fa-check text-success text"></i>
										<i class="fa fa-times text-danger text-active"></i>
									</a>
								</td>
								<td class="text-center">
									<a data-toggle="class" href="#">
										<i class="fa fa-check text-success text-active"></i>
										<i class="fa fa-times text-danger text"></i>
									</a>
								</td>
								<td class="text-center">
									<div class="btn-group">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
											class="fa fa-gear"></i> </a>
										<ul class="dropdown-menu pull-right">
											<li><a href="#">Editar vehículo <i class="fa fa-edit"></i></a></li>
											<li><a href="#">Borrar vehículo <i class="fa fa-trash"></i></a></li>
										</ul>
									</div>
								</td>
							</tr>
							<tr>
								<td>Renault Twizzy003</td>
								<td>4781 FDW</td>
								<td>
									<div
										class="progress progress-xs active m-t-xs m-b-none">
										<div class="progress-bar bg-warning" data-toggle="tooltip"
											data-original-title="30%" style="width: 30%"></div>
									</div>
								</td>
								<td>12/12/2015</td>
								<td class="text-center">
									<a data-toggle="class" href="#">
										<i class="fa fa-check text-success text-active"></i>
										<i class="fa fa-times text-danger text"></i>
									</a>
								</td>
								<td class="text-center">
									<a data-toggle="class" href="#">
										<i class="fa fa-check text-success text"></i>
										<i class="fa fa-times text-danger text-active"></i>
									</a>
								</td>
								<td class="text-center">
									<div class="btn-group">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
											class="fa fa-gear"></i> </a>
										<ul class="dropdown-menu pull-right">
											<li><a href="#">Editar vehículo <i class="fa fa-edit"></i></a></li>
											<li><a href="#">Borrar vehículo <i class="fa fa-trash"></i></a></li>
										</ul>
									</div>
								</td>
							</tr>
							<tr>
								<td>Renault Twizzy004</td>
								<td>1257 HCD</td>
								<td>
									<div
										class="progress progress-xs active m-t-xs m-b-none">
										<div class="progress-bar bg-danger" data-toggle="tooltip"
											data-original-title="10%" style="width: 10%"></div>
									</div>
								</td>
								<td title="Seguro caducado" style="cursor:help;" class="bg-danger">23/04/2015</td>
								<td class="text-center">
									<a data-toggle="class" href="#">
										<i class="fa fa-check text-success text"></i>
										<i class="fa fa-times text-danger text-active"></i>
									</a>
								</td>
								<td class="text-center">
									<a data-toggle="class" href="#">
										<i class="fa fa-check text-success text-active"></i>
										<i class="fa fa-times text-danger text"></i>
									</a>
								</td>
								<td class="text-center">
									<div class="btn-group">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
											class="fa fa-gear"></i> </a>
										<ul class="dropdown-menu pull-right">
											<li><a href="#">Editar vehículo <i class="fa fa-edit"></i></a></li>
											<li><a href="#">Borrar vehículo <i class="fa fa-trash"></i></a></li>
										</ul>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					</section>
				</div>
		</section>
	</section>
</section>		        	
{include file="../common/footer.tpl"}