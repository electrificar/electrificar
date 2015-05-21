{include file="../common/header.tpl"}

<div id="content" class="rental">
    <div id="highlighted">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="teaser">
                        <div class="title">
                            <h1>Creaté tu<br/>propio usuario</h1>
                        </div><!-- /.title -->

                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam tempus tincidunt tellus.
                            Quisque urna elit, placerat at nisl sagittis, aliquam sollicitudin sem.
                        </p>
                    </div><!-- /.teaser -->
                </div>

                <div class="col-md-5">
                    <div id="reservation-form" class="block">
                        <div class="block-inner white block-shadow">
                            <div class="block-title">
                                <h3>Datos del usuario</h3>
                            </div>
                            <!-- /.block-title -->

                            <form method="post" action="/guardar_usuario/">
                                <div class="row">
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pickup-date">E-mail</label>
                                            <input value="{$usuario->email}" data-required="true" id="email" name="email" data-type="email" class="input-sm input-s form-control" size="16" type="text"  >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="return-date">Password</label>
                                            <input value="{$usuario->password}" data-required="true" name="password" class="input-sm input-s form-control" size="16" type="password">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                      					<div class="col-sm-10">
                      						<label for="return-date2">NIF</label>
                        					<input type="text" value="{$usuario->nif}" data-required="true" data-parsley-minlength="9" maxlength="9" name="nif" id="input-id-1" class="form-control">
                      					</div>
                    				</div>
                    				
                    				<div class="form-group">
                      					<div class="col-sm-10">
                      						<label for="return-date2">Nombre</label>
                        					<input type="text" value="{$usuario->nombre}" data-required="true" name="nombre" class="form-control">
                      					</div>
                    				</div>
                    				
                    				<div class="form-group">
                      					<div class="col-sm-10">
                      						<label for="return-date2">Primer apellido</label>
                        					<input type="text" value="{$usuario->apellido1}" data-required="true" name="apellido1" id="input-id-1" class="form-control">
                      					</div>
                    				</div>
                    				
                    				<div class="form-group">
                    					<div class="col-sm-10">
                      						<label for="return-date2">Segundo apellido</label>
                        					<input type="text" value="{$usuario->apellido2}" name="apellido2" id="input-id-1" class="form-control">
                      					</div>
                    				</div>
                    				
                    				<div class="form-group">
                    					<div class="col-sm-10">
                      						<label for="return-date2">Teléfono</label>
                        					<input type="text" value="{$usuario->telefono}" data-required="true" data-parsley-minlength="9" maxlength="9" name="telefono" id="input-id-1" class="form-control">
                      					</div>
                    				</div>
                    				
                    				<div class="form-group">
                    					<div class="col-sm-10">
                      						<label for="return-date2">Dirección</label>
                        					<input type="text" value="{$usuario->direccion}" data-required="true" name="direccion" id="input-id-1" class="form-control">
                      					</div>
                    				</div>
                    				
                    				<div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pickup-date">Fecha de nacimiento</label>
                                            <input value="{$usuario->fecha_nacimiento}" data-date-format="dd/mm/yyyy" data-required="true" name="fecha_nacimiento" class="input-sm input-s datepicker-input form-control" type="text"  >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="return-date">Fecha Carnet</label>
                                            <input value="{$usuario->fecha_permiso}" data-date-format="dd/mm/yyyy" data-required="true" name="fecha_permiso" class="input-sm input-s datepicker-input form-control" type="text"  >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pickup-date">Número de tarjeta</label>
                                            <input value="{$usuario->numero_tarjeta_credito}" style="width: 120px" data-required="true" name="numero_tarjeta_credito" data-parsley-minlength="16" maxlength="16" data-type="number" class="input-sm input-s form-control" size="16" type="text"  >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="return-date">Mes Tarjeta</label>
                                            <input value="{$usuario->mes_tarjeta}" data-required="true" style="width: 100px" data-parsley-minlength="2" maxlength="2" name="mes_tarjeta" class="input-sm input-s form-control" size="2" type="text"  >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="return-date">Año Tarjeta</label>
                                            <input value="{$usuario->anio_tarjeta}" data-required="true" style="width: 100px" data-parsley-minlength="2" maxlength="2" name="anio_tarjeta" class="input-sm input-s form-control" size="2" type="text"  >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="return-date">Código tarjeta</label>
                                            <input value="{$usuario->codigo_tarjeta}" data-required="true" data-parsley-minlength="3" maxlength="3" style="width: 100px" name="codigo_tarjeta" class="input-sm input-s form-control" size="3" type="password"  >
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group button-group">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>

    <div class="section gray-light">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div id="main">
                        <div class="features-block block">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <div class="page-header-inner">
                        <div class="heading">
                            <h2>¿Por qué escogernos a nosotros?</h2>
                        </div><!-- /.heading -->

                        <div class="line">
                            <hr/>
                        </div><!-- /.line -->
                    </div><!-- /.page-header-inner -->
                </div><!-- /.page-header -->
            </div>
        </div>
    <div class="row">
        <div class="feature">
            <div class="col-xs-12 col-md-4 col-sm-4">
                <div class="row">
                    <div class="col-xs-12 col-md-5">
                        <div class="feature-icon">
                            <div class="feature-icon-inverse">
                                <i class="icon-outline-car"></i>
                            </div><!-- /.feature-icon-inverse -->

                            <div class="feature-icon-normal">
                                <i class="icon-normal-car"></i>
                            </div><!-- /.feature-icon-normal -->
                        </div><!-- /.feature-icon -->
                    </div><!-- /.col-md-5 -->

                    <div class="col-xs-12 col-md-7">
                        <h3>Grandes precios</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ligula ipsum, ornare ac augue in, suscipit pretium purus. Vestibulum turpis felis, gravida ac justo</p>
                    </div><!-- /.col-md-7 -->
                </div><!-- /.row -->
            </div><!-- /.col-md-4 -->
        </div><!-- /.feature -->

        <div class="feature">
            <div class="col-xs-12 col-md-4 col-sm-4">
                <div class="row">
                    <div class="col-xs-12 col-md-5">
                        <div class="feature-icon">
                            <div class="feature-icon-inverse">
                                <i class="icon-outline-currency-dollar"></i>
                            </div><!-- /.feature-icon-inverse -->

                            <div class="feature-icon-normal">
                                <i class="icon-normal-currency-dollar"></i>
                            </div><!-- /.feature-icon-normal -->
                        </div><!-- /.feature-icon -->
                    </div><!-- /.col-md-5 -->

                    <div class="col-xs-12 col-md-7">
                        <h3>Amplia selección</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ligula ipsum, ornare ac augue in, suscipit pretium purus. Vestibulum turpis felis, gravida ac justo</p>
                    </div><!-- /.col-md-7 -->
                </div><!-- /.row -->
            </div><!-- /.col-md-4 -->
        </div><!-- /.feature -->

        <div class="feature">
            <div class="col-xs-12 col-md-4 col-sm-4">
                <div class="row">
                    <div class="col-xs-12 col-md-5">
                        <div class="feature-icon">
                            <div class="feature-icon-inverse">
                                <i class="icon-outline-car-door"></i>
                            </div><!-- /.feature-icon-inverse -->

                            <div class="feature-icon-normal">
                                <i class="icon-normal-car-door"></i>
                            </div><!-- /.feature-icon-normal -->
                        </div><!-- /.feature-icon -->
                    </div><!-- /.col-md-5 -->

                    <div class="col-xs-12 col-md-7">
                        <h3>24/7 Ayuda</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ligula ipsum, ornare ac augue in, suscipit pretium purus. Vestibulum turpis felis, gravida ac justo</p>
                    </div><!-- /.col-md-7 -->
                </div><!-- /.row -->
            </div><!-- /.col-md-4 -->
        </div><!-- /.feature -->
    </div><!-- /.row -->
</div><!-- /.block -->                        <div class="testimonials-block block">
	<div class="page-header center">
		<div class="page-header-inner">
			<div class="line">
				<hr/>
			</div>

			<div class="heading">
				<h2>Nuestros clientes satisfechos</h2>
			</div><!-- /.heading -->

			<div class="line">
				<hr/>
			</div><!-- /.line -->
		</div><!-- /.page-header-inner -->
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-sm-12 col-md-6">
			<div class="testimonial white">
				<div class="inner">
					<div class="row">
						<div class="col-sm-3 col-md-4">
							<div class="picture">
								<img src="/tpl_guest/assets/img/testimonials-1.png" alt="#">
							</div><!-- /.picture -->
						</div><!-- /.col-md-4 -->

						<div class="col-sm-9 col-md-8">
							<div class="description quote">
								<p>
									<i>
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ligula ipsum, ornare ac augue
										in, suscipit pretium purus. Vestibulum turpis felis, gravida ac justo.
									</i>
								</p>
							</div><!-- /.description -->

							<div class="star-rating">
								<input name="star0" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
								<input name="star0" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
								<input name="star0" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
								<input name="star0" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
								<input name="star0" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
							</div><!-- /.star-rating -->

							<div class="author">
								<strong>Fanny Harley</strong>
							</div><!-- /.author -->
						</div><!-- /.col-md-8 -->
					</div><!-- /.row -->
				</div><!-- /.inner -->
			</div><!-- /.testimonial -->
		</div><!-- /.col-md-6 -->


		<div class="col-sm-12 col-md-6">
			<div class="testimonial white">
				<div class="inner">
					<div class="row">
						<div class="col-sm-3 col-md-4">
							<div class="picture">
								<img src="/tpl_guest/assets/img/testimonials-2.png" alt="#">
							</div><!-- /.picture -->
						</div><!-- /.col-md-4 -->

						<div class="col-sm-9 col-md-8">
							<div class="description quote">
								<p>
									<i>
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ligula ipsum, ornare ac augue
										in, suscipit pretium purus. Vestibulum turpis felis, gravida ac justo.
									</i>
								</p>
							</div><!-- /.description -->

							<div class="star-rating">
								<input name="star1" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
								<input name="star1" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
								<input name="star1" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
								<input name="star1" type="radio" class="star icon-normal-star" disabled="disabled">
								<input name="star1" type="radio" class="star icon-normal-star" disabled="disabled">
							</div><!-- /.star-rating -->

							<div class="author">
								<strong>Chavi Ernanéz</strong>
							</div><!-- /.author -->
						</div><!-- /.col-md-8 -->
					</div><!-- /.row -->
				</div><!-- /.inner -->
			</div><!-- /.testimonial -->
		</div><!-- /.col-md-6 -->
	</div><!-- /.row -->
</div><!-- /.testimonials-block -->                        <div class="partners-block block">
        <div class="page-header">
            <div class="page-header-inner">


                <div class="heading">
                    <h2>Nuestros colaboradores</h2>
                </div><!-- /.heading -->

                <div class="line">
                    <hr/>
                </div><!-- /.line -->
            </div><!-- /.page-header-inner -->
        </div><!-- /.page-header -->

	<div class="inner-block white block-shadow">
		<div class="row">
			<div class="col-sm-2 col-md-2">
				<div class="partner">
					<a href="#">
						<img src="/tpl_guest/assets/img/partners/intel.jpg" alt="#">
					</a>
				</div><!-- /.partner -->
			</div><!-- /.col-md-2 -->

			<div class="col-sm-2 col-md-2">
				<div class="partner">
					<a href="#">
						<img src="/tpl_guest/assets/img/partners/tesla.png" alt="#">
					</a>
				</div><!-- /.partner -->
			</div><!-- /.col-md-2 -->

			<div class="col-sm-2 col-md-2">
				<div class="partner">
					<a href="#">
						<img src="/tpl_guest/assets/img/partners/honda.gif" alt="#">
					</a>
				</div><!-- /.partner -->
			</div><!-- /.col-md-2 -->

			<div class="col-sm-2 col-md-2">
				<div class="partner">
					<a href="#">
						<img src="/tpl_guest/assets/img/partners/logo-ucm.jpg" alt="#">
					</a>
				</div><!-- /.partner -->
			</div><!-- /.col-md-2 -->

			<div class="col-sm-2 col-md-2">
				<div class="partner">
					<a href="#">
						<img src="/tpl_guest/assets/img/partners/madrid.jpg" alt="#">
					</a>
				</div><!-- /.partner -->
			</div><!-- /.col-md-2 -->

			<div class="col-sm-2 col-md-2">
				<div class="partner">
					<a href="#">
						<img src="/tpl_guest/assets/img/partners/bmw.png" alt="#">
					</a>
				</div><!-- /.partner -->
			</div><!-- /.col-md-2 -->
		</div><!-- /.row -->
	</div><!-- /.inner-block -->
</div><!-- /.partners-block -->                    </div><!-- /#main -->
                </div>


            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.section -->

</div>
<!-- /#content -->  

{include file="../common/footer.tpl"}