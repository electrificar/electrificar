{include file="../common/header.tpl"}

<div id="content">
<div id="progress" class="section">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-md-3">
                <a class="progress-step done" href="rental-1.html">
                    <div class="circle"><i class="icon icon-normal-mark-tick"></i></div>
                    <div class="title">Usuario validado</div>
                </a>
            </div>

            <div class="col-sm-3 col-md-3">
                <a class="progress-step done" href="rental-2.html">
                    <div class="circle"><i class="icon icon-normal-mark-tick"></i></div>
                    <div class="title">Escoge tu coche</div>
                </a>
            </div>

            <div class="col-sm-3 col-md-3">
                <a class="progress-step active" href="rental-3.html">
                    <div class="active circle">3</div>
                    <div class="title">Checkout</div>
                </a>
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>
<div class="section gray-light">
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div id="main">

                    <div class="block checkout">
                        <div class="page-header">
                            <div class="page-header-inner">
                                <div class="heading">
                                    <h2>Checkout</h2>
                                </div>
                                <!-- /.heading -->

                                <div class="line">
                                    <hr/>
                                </div>
                                <!-- /.line -->
                            </div>
                            <!-- /.page-header-inner -->
                        </div>
                        <!-- /.page-header -->


                        <div class="row">
                            <div class="col-md-12">
                                <div class="block-inner white block-shadow">
                                    <form>
                                        <div class="form-section">
                                            <div class="block-title">
                                                <h3>Información Personal</h3>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="form-group">
                                                        <label>Nombre</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>E-mail</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="form-group">
                                                        <label>Apellidos</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Número de teléfono</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-section">
                                            <div class="block-title">
                                                <h3>Información de Pago</h3>
                                            </div>

                                            <div class="form-group">
                                                <ul class="credit-cards">
                                                    <li>
                                                        <img alt="#" src="tpl_guest/assets/img/icon-mastercard.png">
                                                    </li>
                                                    <li>
                                                        <img alt="#" src="tpl_guest/assets/img/icon-discover.png">
                                                    </li>
                                                    <li>
                                                        <img alt="#" src="tpl_guest/assets/img/icon-visa.png">
                                                    </li>
                                                    <li>
                                                        <img alt="#" src="tpl_guest/assets/img/icon-amex.png">
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="form-group">
                                                        <label>Número de Tarjeta</label>
                                                        <input class="form-control" size="20" type="text"
                                                               placeholder="XXXX-XXXX-XXXX-XXXX">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="form-group">
                                                        <label>Nombre de la Tarjeta</label>
                                                        <input class="form-control" size="28" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-md-3">
                                                    <div class="form-group">
                                                        <label>Caduca en:</label>
                                                        <input class="form-control" size="3" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-md-2">
                                                    <div class="form-group">
                                                        <label>CVV</label>
                                                        <input class="form-control" size="3" type="text">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-section">
                                            <div class="block-title">
                                                <h3>Dirección de Facturación</h3>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="form-group">
                                                        <label>Ciudad</label>
                                                        <input class="form-control" size="20" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-md-3">
                                                    <div class="form-group">
                                                        <label>País</label>
                                                        <select class="form-control">
                                                            <option>País</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-md-2">
                                                    <div class="form-group">
                                                        <label>Código Postal</label>
                                                        <input class="form-control" size="5" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label>Dirección (calle y número)</label>
                                                        <input class="form-control" size="28" type="text">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <input type="checkbox" name="terms"><label>Acepto términos y licencias</label>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <!-- /.content -->
                            </div>
                            <!-- /.col-md-12 -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.block -->
                </div>
                <!-- /#main -->
            </div>

            <div class="col-md-3 sidebar">
                <div class="summary block block-shadow white">
    <div class="block-inner">
        <div class="block-title">
            <h3>Resumen</h3>
        </div><!-- /.block-title -->

        <table>
            <tbody>
            <tr>
                <td class="title" colspan="2">Fecha de inicio de alquiler</td>
            </tr>
            <tr>
                <td>8.12.2013</td>
                <td>18:00</td>
            </tr>

            <tr>
                <td class="title" colspan="2">Fecha de fin de alquiler</td>
            </tr>
            <tr>
                <td>12.12.2013</td>
                <td>18:00</td>
            </tr>

            <tr>
                <td class="title" colspan="2">Modelo</td>
            </tr>
            <tr>
                <td colspan="2">Toyota, LandCruiser</td>
            </tr>
            </tbody>
        </table>

        <form>

            <div class="checkbox">
                <input type="checkbox"><label>Devolver coche al mismo punto de recogida</label>
            </div>
            <div class="checkbox">
                <input type="checkbox"><label>25+ años</label>
            </div>
        </form>

    </div><!-- /.block-inner -->
</div><!-- /.block -->                <div class="block block-shadow extras white">
    <div class="total">
        <div class="title">Total</div>
        <div class="value">$4,230</div>
    </div>
</div><!-- /.block -->            </div>
            <!-- /.sidebar -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-sm-12 col-md-9">
                <div class="row">
                    <div class="checkout-actions">
                        <div class="col-sm-4 col-md-3">
                            <div class="previous">
                                <a class="btn btn-primary" href="rental-3.html">
                                    <i class="icon icon-normal-left-arrow-small"></i>Seleccionar Coche
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-6"></div>
                        <div class="col-sm-4 col-md-3">
                            <div class="next">
                                <a class="btn btn-primary" href="index-2.html">
                                    Alquilar YA !<i class="icon icon-normal-right-arrow-small"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
</div>
<!-- /.section -->
</div>
<!-- /#content -->

{include file="../common/footer.tpl"}