{include file="../common/header.tpl"}
<div class="highlighted-wrapper gray">
    <div class="highlighted section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <div id="overviews">
                        <div class="overview active">
                            <div class="overview-table">
                                <div class="item title">
                                    <h3>BMW i8</h3>
                                    <div class="subtitle">Sport</div>
                                </div><!-- /.item -->


                                <div class="item tags">
                                    <div class="price">15€/Hora</div>
                                    <div class="type">Alquiler</div>
                                </div><!-- /.item -->


                                <div class="item line">
                                    <span class="property">Año</span>
                                    <span class="value">2015</span>
                                </div><!-- /.item -->


                                <div class="item line">
                                    <span class="property">Marca</span>
                                    <span class="value">BMW</span>
                                </div><!-- /.item -->


                                <div class="item line">
                                    <span class="property">Stock Number</span>
                                    <span class="value">7886</span>
                                </div><!-- /.item -->

                                <div class="item line">
                                    <span class="property">Numero de Plazas</span>
                                    <span class="value">Dos personas</span>
                                </div><!-- /.item -->

                                <div class="item line">
                                    <span class="property">Kilómetros Autonomia</span>
                                    <span class="value">120km</span>
                                </div><!-- /.item -->

                                <div class="item line">
                                    <span class="property">Tipo</span>
                                    <span class="value">Deportivo</span>
                                </div><!-- /.item -->
                            </div><!-- /.overview-table -->
                        </div><!-- /.overview -->

                        <div class="overview">
                            <div class="overview-table">
                                <div class="item title">
                                    <h3>Honda EVN</h3>
                                    <div class="subtitle">Compact</div>
                                </div><!-- /.item -->

                                <div class="item tags">
                                    <div class="price">7€/Hora</div>
                                    <div class="type">Alquiler</div>
                                </div><!-- /.item -->

                                <div class="item line">
                                    <span class="property">Stock Number</span>
                                    <span class="value">7911</span>
                                </div><!-- /.item -->

                                <div class="item line">
                                    <span class="property">Numero de plazas</span>
                                    <span class="value">Dos</span>
                                </div><!-- /.item -->

                                <div class="item line">
                                    <span class="property">Kilómetros Autonomia</span>
                                    <span class="value">200km</span>
                                </div><!-- /.item -->

                                <div class="item line">
                                    <span class="property">Tipo</span>
                                    <span class="value">Compacto</span>
                                </div><!-- /.item -->
                                
                            </div><!-- /.overview-table -->
                        </div><!-- /.overview -->

                        <div class="overview">
                            <div class="overview-table">
                                <div class="item title">
                                    <h3>Tesla S</h3>
                                    <div class="subtitle">Sedan</div>
                                </div><!-- /.item -->

                                <div class="item tags">
                                    <div class="price">10€/Hora</div>
                                    <div class="type">Alquiler</div>
                                </div><!-- /.item -->

                                <div class="item line">
                                    <span class="property">Stock Number</span>
                                    <span class="value">7904</span>
                                </div><!-- /.item -->

                                <div class="item line">
                                    <span class="property">Numero de Plazas</span>
                                    <span class="value">Cinco</span>
                                </div><!-- /.item -->

                                <div class="item line">
                                    <span class="property">Kilómetros de Autonomia</span>
                                    <span class="value">150km</span>
                                </div><!-- /.item -->

                                <div class="item line">
                                    <span class="property">Tipo</span>
                                    <span class="value">Sedan</span>
                                </div><!-- /.item -->
                            </div><!-- /.overview-table -->
                        </div><!-- /.overview -->

                        <div id="slider-navigation">
                            <div class="prev"></div><!-- /.prev -->
                            <div class="next"></div><!-- /.next -->
                        </div><!-- /.slider-navigation -->
                    </div><!-- /.overviews -->
                </div>


                <div class="col-md-7 col-sm-7">
                    <div id="slider">
                        <div class="slide active">
                            <a href="detail.html"><img src="/tpl_guest/assets/img/slides/BMW-Electric-Car-2.jpg" alt="#"></a>
                            <div class="color-overlay"></div><!-- /.color-overlay -->
                        </div><!-- /.slide -->

                        <div class="slide">
                            <a href="detail.html"><img src="/tpl_guest/assets/img/slides/honda-evn-ext-610.jpg" alt="#"></a>
                            <div class="color-overlay"></div><!-- /.color-overlay -->
                        </div><!-- /.slide -->

                        <div class="slide">
                            <a href="detail.html"><img src="/tpl_guest/assets/img/slides/tesla-model-s1.jpg" alt="#"></a>
                            <div class="color-overlay"></div><!-- /.color-overlay -->
                        </div><!-- /.slide -->
                    </div><!-- /#slider -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.highligted -->

    <div class="filter-wrapper">
        <div class="container">
            <div class="row">           
                <div class="col-md-3 col-xs-12 pull-right">
                    <div class="filter-block">
                        <div class="block">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#search-rent" data-toggle="tab">Buscar</a></li>
                            </ul><!-- /.nav -->
                                        <div class="tab-pane" id="search-rent">
                                            <form method="post" action="http://html.carat.pragmaticmates.com/filter.html">
                                                <div class="row">

                                                    <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-6">
                                                        <select name="maker" class="form-control">
                                                            <option>BMW</option>
                                                            <option>Honda</option>
                                                            <option>Tesla</option>
                                                        </select>
                                                    </div><!-- /.form-group -->

                                                    <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-6">
                                                        <select name="model" class="form-control">
                                                            <option>Zona 1</option>
                                                            <option>Zona 2</option>
                                                            <option>Zona 3</option>
                                                        </select>
                                                    </div><!-- /.form-group -->
                                                    
                                                    <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-6">
                                                        <select name="model" class="form-control">
                                                            <option>Carga > 75%</option>
                                                            <option>Carga > 50%</option>
                                                            <option>Carga > 26%</option>
                                                        </select>
                                                    </div><!-- /.form-group -->
                                                </div><!-- /.row -->

                                                <div class="form-group">
                                                    <button class="send btn btn-primary btn-primary-color">
                                                        Buscar <i class="icon icon-normal-right-arrow-small"></i>
                                                    </button>
                                                </div><!-- /.form-group -->
                                            </form>
                                        </div><!-- /.tab-pane -->
                                    </div><!-- /.tab-content -->
                                </div><!-- /.inner -->
                            </div><!-- /.content -->                                
                        </div><!-- /.block -->
                    </div><!-- /.filter-block -->
                </div><!-- /.col-md-3 -->
            </div><!-- /.row -->
        </div><!-- /.highlighted -->
    </div><!-- /.slider-filter -->
</div><!-- /.highlighted-wrapper -->

<div id="content" class="frontpage">
    <div class="section gray-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="recent-cars" class="grid-block block">
    <div class="page-header center">
        <div class="page-header-inner">
            <div class="line">
                <hr/>
            </div><!-- /.line -->

            <div class="heading">
                <h2>Coches destacados a tu disposición</h2>
            </div><!-- /.heading -->

            <div class="line">
                <hr/>
            </div><!-- /.line -->
        </div><!-- /.page-header-inner -->
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-md-12">
            <div class="inner-block white">
                <div class="grid-carousel">
                                        
                                            <div class="inner">
                            <div class="grid-item">
    <div class="inner">
        <div class="picture">
            <div class="image-slider">
                
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota6.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota7.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota4.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota5.jpg" alt="#">
                    </a><!-- /.slide -->
                
                <div class="cycle-pager"></div><!-- /.cycle-pager -->
            </div><!-- /.image-slider -->
        </div><!-- /.picture -->

        <div class="like">
            <a href="detail.html"><i class="icon icon-outline-thumb-up"></i></a>
        </div><!-- /.like -->

        <h3>
            <a href="detail.html">Toyota Landcruiser</a>
        </h3>

        <div class="subtitle">MX 234</div><!-- /.subtitle -->

        <div class="price">19,888$</div><!-- /.price -->

        <div class="meta">
            <ul class="clearfix ">
                <li>
                    <i class="icon icon-normal-dashboard"></i> 2011                </li>

                <li>
                    <i class="icon icon-normal-car-door"></i> Eléctrico                </li>

                <li>
                    <i class="icon icon-normal-cog-wheel"></i> 1500                </li>
            </ul>
        </div><!-- /.meta -->
    </div><!-- /.inner -->
</div><!-- /.grid-item -->                        </div><!-- /.inner -->
                                            <div class="inner">
                            <div class="grid-item">
    <div class="inner">
        <div class="picture">
            <div class="image-slider">
                
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota2.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota7.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota1.jpg" alt="#">
                    </a><!-- /.slide -->
                
                <div class="cycle-pager"></div><!-- /.cycle-pager -->
            </div><!-- /.image-slider -->
        </div><!-- /.picture -->

        <div class="like">
            <a href="detail.html"><i class="icon icon-outline-thumb-up"></i></a>
        </div><!-- /.like -->

        <h3>
            <a href="detail.html">Toyota Verso</a>
        </h3>

        <div class="subtitle">DPF Active</div><!-- /.subtitle -->

        <div class="price">20,888$</div><!-- /.price -->

        <div class="meta">
            <ul class="clearfix ">
                <li>
                    <i class="icon icon-normal-dashboard"></i> 2013                </li>

                <li>
                    <i class="icon icon-normal-car-door"></i> Eléctrico                </li>

                <li>
                    <i class="icon icon-normal-cog-wheel"></i> 1500                </li>
            </ul>
        </div><!-- /.meta -->
    </div><!-- /.inner -->
</div><!-- /.grid-item -->                        </div><!-- /.inner -->
                                            <div class="inner">
                            <div class="grid-item">
    <div class="inner">
        <div class="picture">
            <div class="image-slider">
                
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota5.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota6.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota4.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota3.jpg" alt="#">
                    </a><!-- /.slide -->
                
                <div class="cycle-pager"></div><!-- /.cycle-pager -->
            </div><!-- /.image-slider -->
        </div><!-- /.picture -->

        <div class="like">
            <a href="detail.html"><i class="icon icon-outline-thumb-up"></i></a>
        </div><!-- /.like -->

        <h3>
            <a href="detail.html">Toyota Yaris</a>
        </h3>

        <div class="subtitle">Active</div><!-- /.subtitle -->

        <div class="price">10,290$</div><!-- /.price -->

        <div class="meta">
            <ul class="clearfix ">
                <li>
                    <i class="icon icon-normal-dashboard"></i> 2010                </li>

                <li>
                    <i class="icon icon-normal-car-door"></i> Eléctrico                </li>

                <li>
                    <i class="icon icon-normal-cog-wheel"></i> 1500                </li>
            </ul>
        </div><!-- /.meta -->
    </div><!-- /.inner -->
</div><!-- /.grid-item -->                        </div><!-- /.inner -->
                                            <div class="inner">
                            <div class="grid-item">
    <div class="inner">
        <div class="picture">
            <div class="image-slider">
                
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota7.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota5.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota6.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota4.jpg" alt="#">
                    </a><!-- /.slide -->
                
                <div class="cycle-pager"></div><!-- /.cycle-pager -->
            </div><!-- /.image-slider -->
        </div><!-- /.picture -->

        <div class="like">
            <a href="detail.html"><i class="icon icon-outline-thumb-up"></i></a>
        </div><!-- /.like -->

        <h3>
            <a href="detail.html">Toyota Landcruiser</a>
        </h3>

        <div class="subtitle">MX 234</div><!-- /.subtitle -->

        <div class="price">19,888$</div><!-- /.price -->

        <div class="meta">
            <ul class="clearfix ">
                <li>
                    <i class="icon icon-normal-dashboard"></i> 2011                </li>

                <li>
                    <i class="icon icon-normal-car-door"></i> Eléctrico                </li>

                <li>
                    <i class="icon icon-normal-cog-wheel"></i> 1500                </li>
            </ul>
        </div><!-- /.meta -->
    </div><!-- /.inner -->
</div><!-- /.grid-item -->                        </div><!-- /.inner -->
                                            <div class="inner">
                            <div class="grid-item">
    <div class="inner">
        <div class="picture">
            <div class="image-slider">
                
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota4.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota5.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota3.jpg" alt="#">
                    </a><!-- /.slide -->
                
                <div class="cycle-pager"></div><!-- /.cycle-pager -->
            </div><!-- /.image-slider -->
        </div><!-- /.picture -->

        <div class="like">
            <a href="detail.html"><i class="icon icon-outline-thumb-up"></i></a>
        </div><!-- /.like -->

        <h3>
            <a href="detail.html">Toyota Verso</a>
        </h3>

        <div class="subtitle">Valvematic Active</div><!-- /.subtitle -->

        <div class="price">16,999</div><!-- /.price -->

        <div class="meta">
            <ul class="clearfix ">
                <li>
                    <i class="icon icon-normal-dashboard"></i> 2013                </li>

                <li>
                    <i class="icon icon-normal-car-door"></i> Eléctrico                </li>

                <li>
                    <i class="icon icon-normal-cog-wheel"></i> 1500                </li>
            </ul>
        </div><!-- /.meta -->
    </div><!-- /.inner -->
</div><!-- /.grid-item -->                        </div><!-- /.inner -->
                                            <div class="inner">
                            <div class="grid-item">
    <div class="inner">
        <div class="picture">
            <div class="image-slider">
                
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota7.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota1.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota2.jpg" alt="#">
                    </a><!-- /.slide -->
                
                <div class="cycle-pager"></div><!-- /.cycle-pager -->
            </div><!-- /.image-slider -->
        </div><!-- /.picture -->

        <div class="like">
            <a href="detail.html"><i class="icon icon-outline-thumb-up"></i></a>
        </div><!-- /.like -->

        <h3>
            <a href="detail.html">Toyota Verso</a>
        </h3>

        <div class="subtitle">DPF Active</div><!-- /.subtitle -->

        <div class="price">20,888$</div><!-- /.price -->

        <div class="meta">
            <ul class="clearfix ">
                <li>
                    <i class="icon icon-normal-dashboard"></i> 2013                </li>

                <li>
                    <i class="icon icon-normal-car-door"></i> Eléctrico                </li>

                <li>
                    <i class="icon icon-normal-cog-wheel"></i> 1500                </li>
            </ul>
        </div><!-- /.meta -->
    </div><!-- /.inner -->
</div><!-- /.grid-item -->                        </div><!-- /.inner -->
                                            <div class="inner">
                            <div class="grid-item">
    <div class="inner">
        <div class="picture">
            <div class="image-slider">
                
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota5.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota4.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota6.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota7.jpg" alt="#">
                    </a><!-- /.slide -->
                
                <div class="cycle-pager"></div><!-- /.cycle-pager -->
            </div><!-- /.image-slider -->
        </div><!-- /.picture -->

        <div class="like">
            <a href="detail.html"><i class="icon icon-outline-thumb-up"></i></a>
        </div><!-- /.like -->

        <h3>
            <a href="detail.html">Toyota Landcruiser</a>
        </h3>

        <div class="subtitle">MX 234</div><!-- /.subtitle -->

        <div class="price">19,888$</div><!-- /.price -->

        <div class="meta">
            <ul class="clearfix ">
                <li>
                    <i class="icon icon-normal-dashboard"></i> 2011                </li>

                <li>
                    <i class="icon icon-normal-car-door"></i> Eléctrico                </li>

                <li>
                    <i class="icon icon-normal-cog-wheel"></i> 1500                </li>
            </ul>
        </div><!-- /.meta -->
    </div><!-- /.inner -->
</div><!-- /.grid-item -->                        </div><!-- /.inner -->
                                            <div class="inner">
                            <div class="grid-item">
    <div class="inner">
        <div class="picture">
            <div class="image-slider">
                
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota5.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota3.jpg" alt="#">
                    </a><!-- /.slide -->
                                    <a href="detail.html" class="slide">
                        <img src="/tpl_guest/assets/img/content/toyota4.jpg" alt="#">
                    </a><!-- /.slide -->
                
                <div class="cycle-pager"></div><!-- /.cycle-pager -->
            </div><!-- /.image-slider -->
        </div><!-- /.picture -->

        <div class="like">
            <a href="detail.html"><i class="icon icon-outline-thumb-up"></i></a>
        </div><!-- /.like -->

        <h3>
            <a href="detail.html">Toyota Verso</a>
        </h3>

        <div class="subtitle">Valvematic Active</div><!-- /.subtitle -->

        <div class="price">16,999</div><!-- /.price -->

        <div class="meta">
            <ul class="clearfix ">
                <li>
                    <i class="icon icon-normal-dashboard"></i> 2013                </li>

                <li>
                    <i class="icon icon-normal-car-door"></i> Eléctrico                </li>

                <li>
                    <i class="icon icon-normal-cog-wheel"></i> 1500                </li>
            </ul>
        </div><!-- /.meta -->
    </div><!-- /.inner -->
</div><!-- /.grid-item -->                        </div><!-- /.inner -->
                                    </div><!-- /.grid-carousel -->
            </div><!-- /.inner-block -->
        </div><!-- /.col-md-12 -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div id="grid-carousel-pager">
                <div class="prev"></div><!-- /.prev -->
                <div class="next"></div><!-- /.next -->
            </div><!-- /.grid-carousel-pager -->
        </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
</div><!-- /.grid-block -->
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.section -->

    <div class="section white">
        <div class="container">
            <div class="category-boxes">
                <div class="row">
                    <div class="category-box col-lg-3 col-md-3 col-sm-6">
                        <div class="wrapper">
                            <div class="picture">
                                <a href="detail.html">
                                    <img src="/tpl_guest/assets/img/filter/sedan.png" class="cover-me" alt="#">
                                </a>
                            </div><!-- /.picture -->

                            <div class="meta">
                                <div class="title">
                                    <a href="detail.html">Sedans</a>
                                </div><!-- /.title -->

                                <div class="offers">133 offers</div><!-- /.offers -->
                            </div><!-- /.meta -->

                            <div class="options">
                                <ul>
                                    <li><a href="detail.html">Notchback</a></li>
                                    <li><a href="detail.html">Fastback</a></li>
                                    <li><a href="detail.html">Hardtop</a></li>
                                    <li><a href="detail.html">Hatchback</a></li>
                                    <li><a href="detail.html">Chauffeured</a></li>
                                </ul>
                            </div><!-- /.options -->
                        </div><!-- /.wrapper -->
                    </div><!-- /.category-box -->

                    <div class="category-box col-lg-3 col-md-3 col-sm-6">
                        <div class="wrapper">
                            <div class="picture">
                                <a href="detail.html">
                                    <img src="/tpl_guest/assets/img/filter/bike.png" class="cover-me" alt="#">
                                </a>
                            </div><!-- /.picture -->

                            <div class="meta">
                                <div class="title"><a href="filter.html">Motorcycles</a></div><!-- /.title -->
                                <div class="offers">55 offers</div><!-- /.offers -->
                            </div><!-- /.meta -->

                            <div class="options">
                                <ul>
                                    <li><a href="detail.html">Standard</a></li>
                                    <li><a href="detail.html">Cruiser</a></li>
                                    <li><a href="detail.html">Sport bike</a></li>
                                    <li><a href="detail.html">Touring</a></li>
                                    <li><a href="detail.html">Sport touring</a></li>
                                    <li><a href="detail.html">Dual-sport</a></li>
                                </ul>
                            </div><!-- /.options -->
                        </div><!-- /.wrapper -->
                    </div><!-- /.category-box -->

                    <div class="category-box col-lg-3 col-md-3 col-sm-6">
                        <div class="wrapper">
                            <div class="picture">
                                <a href="filter.html"><img src="/tpl_guest/assets/img/filter/suv.png" alt="#" class="cover-me"></a>
                            </div><!-- /.picture -->
                            
                            <div class="meta">
                                <div class="title">
                                    <a href="detail.html">Pickup &amp; SUVs</a>
                                </div><!-- /.title -->

                                <div class="offers">24 offers</div><!-- /.offers -->
                            </div><!-- /.meta -->

                            <div class="options">
                                <ul>
                                    <li><a href="detail.html">Mini SUV</a></li>
                                    <li><a href="detail.html">Compact SUV</a></li>
                                    <li><a href="detail.html">Mid-size SUV</a></li>
                                    <li><a href="detail.html">Full-size SUV</a></li>
                                    <li><a href="detail.html">Extended-length SUV</a></li>
                                </ul>
                            </div><!-- /.options -->
                        </div><!-- /.wrapper -->
                    </div><!-- /.col-md-3 -->

                    <div class="category-box col-lg-3 col-md-3 col-sm-6">
                        <div class="wrapper">
                            <div class="picture">
                                <a href="detail.html">
                                    <img src="/tpl_guest/assets/img/filter/sportcar.png" alt="#" class="cover-me">
                                </a>
                            </div>
                            <div class="meta">
                                <div class="title">
                                    <a href="detail.html">Sport cars</a>
                                </div><!-- /.title -->
                                <div class="offers">89 offers</div><!-- /.offers-->
                            </div><!-- /.meta -->

                            <div class="options">
                                <ul>
                                    <li><a href="detail.html">Sports car</a></li>
                                    <li><a href="detail.html">Grand tourer</a></li>
                                    <li><a href="detail.html">Supercar</a></li>
                                    <li><a href="detail.html">Muscle car</a></li>
                                    <li><a href="detail.html">Pony car</a></li>
                                </ul>
                            </div><!-- /.options -->


                        </div><!-- /.wrapper -->
                    </div><!-- /.category-box -->
                </div><!-- /.row -->
            </div><!-- /.category-boxes-->
        </div><!-- /.container -->
    </div><!-- /.section -->

    <div class="section gray-light">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <div id="main">
                        <div class="row-block block" id="best-deals">
	<div class="page-header">
		<div class="page-header-inner">
			<div class="heading">
				<h2>Mejores ofertas</h2>
			</div><!-- /.heading -->

			<div class="line">
				<hr/>
			</div><!-- /.line -->
		</div><!-- /.page-header-inner -->
	</div><!-- /.page-header -->


	<div class="row">
		<div class="col-md-12">
			<div class="content white">
				<div class="inner">
																<div class="row-item">
    <div class="inner">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-sm-5">
                <div class="picture">
                    <div class="image-slider">
                                                                            <a href="detail.html" class="slide">
                                <img src="/tpl_guest/assets/img/content/toyota.jpg" alt="#">
                            </a><!-- /.slide -->
                                                    <a href="detail.html" class="slide">
                                <img src="/tpl_guest/assets/img/content/toyota7.jpg" alt="#">
                            </a><!-- /.slide -->
                                                    <a href="detail.html" class="slide">
                                <img src="/tpl_guest/assets/img/content/toyota1.jpg" alt="#">
                            </a><!-- /.slide -->
                                                    <a href="detail.html" class="slide">
                                <img src="/tpl_guest/assets/img/content/toyota2.jpg" alt="#">
                            </a><!-- /.slide -->
                        
                        <div class="cycle-pager"></div><!-- /.cycle-pager -->
                    </div><!-- /.image-slider -->
                </div><!-- /.picture -->
            </div><!-- /.col-md-4 -->

            <div class="col-lg-8 col-md-7 col-sm-7">

                <div class="content-inner">
                    <h3>
                        <a href="detail.html">Toyota Verso</a>
                    </h3>
                    <div class="subtitle">DPF Active</div><!-- /.subtitle -->

                    <div class="price">$16,999</div><!-- /.price -->

                    <div class="description">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate neque. Fusce hendrerit fermentum elementum.</p>
                    </div><!-- /.description -->

                    <div class="meta">
                        <ul>
                            <li>
                                <i class="icon icon-normal-dashboard"></i> 2013                            </li>
                            <li>
                                <i class="icon icon-normal-car-door"></i> Eléctrico                            </li>
                            <li>
                                <i class="icon icon-normal-cog-wheel"></i> 1500                            </li>
                        </ul>
                    </div><!-- /.meta -->
                </div><!-- /.content-inner -->
            </div><!-- /.col-md-8 -->
        </div><!-- /.row -->
    </div><!-- /.inner -->
</div><!-- /.row-item -->											<div class="row-item">
    <div class="inner">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-sm-5">
                <div class="picture">
                    <div class="image-slider">
                                                                            <a href="detail.html" class="slide">
                                <img src="/tpl_guest/assets/img/content/toyota5.jpg" alt="#">
                            </a><!-- /.slide -->
                                                    <a href="detail.html" class="slide">
                                <img src="/tpl_guest/assets/img/content/toyota3.jpg" alt="#">
                            </a><!-- /.slide -->
                                                    <a href="detail.html" class="slide">
                                <img src="/tpl_guest/assets/img/content/toyota4.jpg" alt="#">
                            </a><!-- /.slide -->
                                                    <a href="detail.html" class="slide">
                                <img src="/tpl_guest/assets/img/content/toyota6.jpg" alt="#">
                            </a><!-- /.slide -->
                        
                        <div class="cycle-pager"></div><!-- /.cycle-pager -->
                    </div><!-- /.image-slider -->
                </div><!-- /.picture -->
            </div><!-- /.col-md-4 -->

            <div class="col-lg-8 col-md-7 col-sm-7">

                <div class="content-inner">
                    <h3>
                        <a href="detail.html">Toyota Yaris</a>
                    </h3>
                    <div class="subtitle">Active</div><!-- /.subtitle -->

                    <div class="price">$16,999</div><!-- /.price -->

                    <div class="description">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate neque. Fusce hendrerit fermentum elementum.</p>
                    </div><!-- /.description -->

                    <div class="meta">
                        <ul>
                            <li>
                                <i class="icon icon-normal-dashboard"></i> 2010                            </li>
                            <li>
                                <i class="icon icon-normal-car-door"></i> Eléctrico                            </li>
                            <li>
                                <i class="icon icon-normal-cog-wheel"></i> 1500                            </li>
                        </ul>
                    </div><!-- /.meta -->
                </div><!-- /.content-inner -->
            </div><!-- /.col-md-8 -->
        </div><!-- /.row -->
    </div><!-- /.inner -->
</div><!-- /.row-item -->											<div class="row-item">
    <div class="inner">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-sm-5">
                <div class="picture">
                    <div class="image-slider">
                                                                            <a href="detail.html" class="slide">
                                <img src="/tpl_guest/assets/img/content/toyota4.jpg" alt="#">
                            </a><!-- /.slide -->
                                                    <a href="detail.html" class="slide">
                                <img src="/tpl_guest/assets/img/content/toyota6.jpg" alt="#">
                            </a><!-- /.slide -->
                                                    <a href="detail.html" class="slide">
                                <img src="/tpl_guest/assets/img/content/toyota5.jpg" alt="#">
                            </a><!-- /.slide -->
                                                    <a href="detail.html" class="slide">
                                <img src="/tpl_guest/assets/img/content/toyota3.jpg" alt="#">
                            </a><!-- /.slide -->
                        
                        <div class="cycle-pager"></div><!-- /.cycle-pager -->
                    </div><!-- /.image-slider -->
                </div><!-- /.picture -->
            </div><!-- /.col-md-4 -->

            <div class="col-lg-8 col-md-7 col-sm-7">

                <div class="content-inner">
                    <h3>
                        <a href="detail.html">Toyota Yaris</a>
                    </h3>
                    <div class="subtitle">Active</div><!-- /.subtitle -->

                    <div class="price">$16,999</div><!-- /.price -->

                    <div class="description">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate neque. Fusce hendrerit fermentum elementum.</p>
                    </div><!-- /.description -->

                    <div class="meta">
                        <ul>
                            <li>
                                <i class="icon icon-normal-dashboard"></i> 2010                            </li>
                            <li>
                                <i class="icon icon-normal-car-door"></i> Eléctrico                            </li>
                            <li>
                                <i class="icon icon-normal-cog-wheel"></i> 1500                            </li>
                        </ul>
                    </div><!-- /.meta -->
                </div><!-- /.content-inner -->
            </div><!-- /.col-md-8 -->
        </div><!-- /.row -->
    </div><!-- /.inner -->
</div><!-- /.row-item -->											<div class="row-item">
    <div class="inner">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-sm-5">
                <div class="picture">
                    <div class="image-slider">
                                                                            <a href="detail.html" class="slide">
                                <img src="/tpl_guest/assets/img/content/toyota3.jpg" alt="#">
                            </a><!-- /.slide -->
                                                    <a href="detail.html" class="slide">
                                <img src="/tpl_guest/assets/img/content/toyota4.jpg" alt="#">
                            </a><!-- /.slide -->
                                                    <a href="detail.html" class="slide">
                                <img src="/tpl_guest/assets/img/content/toyota5.jpg" alt="#">
                            </a><!-- /.slide -->
                        
                        <div class="cycle-pager"></div><!-- /.cycle-pager -->
                    </div><!-- /.image-slider -->
                </div><!-- /.picture -->
            </div><!-- /.col-md-4 -->

            <div class="col-lg-8 col-md-7 col-sm-7">

                <div class="content-inner">
                    <h3>
                        <a href="detail.html">Toyota Verso</a>
                    </h3>
                    <div class="subtitle">Valvematic Active</div><!-- /.subtitle -->

                    <div class="price">$16,999</div><!-- /.price -->

                    <div class="description">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate neque. Fusce hendrerit fermentum elementum.</p>
                    </div><!-- /.description -->

                    <div class="meta">
                        <ul>
                            <li>
                                <i class="icon icon-normal-dashboard"></i> 2013                            </li>
                            <li>
                                <i class="icon icon-normal-car-door"></i> Eléctrico                            </li>
                            <li>
                                <i class="icon icon-normal-cog-wheel"></i> 1500                            </li>
                        </ul>
                    </div><!-- /.meta -->
                </div><!-- /.content-inner -->
            </div><!-- /.col-md-8 -->
        </div><!-- /.row -->
    </div><!-- /.inner -->
</div><!-- /.row-item -->											<div class="row-item">
    <div class="inner">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-sm-5">
                <div class="picture">
                    <div class="image-slider">
                                                                            <a href="detail.html" class="slide">
                                <img src="/tpl_guest/assets/img/content/toyota2.jpg" alt="#">
                            </a><!-- /.slide -->
                                                    <a href="detail.html" class="slide">
                                <img src="/tpl_guest/assets/img/content/toyota7.jpg" alt="#">
                            </a><!-- /.slide -->
                                                    <a href="detail.html" class="slide">
                                <img src="/tpl_guest/assets/img/content/toyota1.jpg" alt="#">
                            </a><!-- /.slide -->
                                                    <a href="detail.html" class="slide">
                                <img src="/tpl_guest/assets/img/content/toyota.jpg" alt="#">
                            </a><!-- /.slide -->
                        
                        <div class="cycle-pager"></div><!-- /.cycle-pager -->
                    </div><!-- /.image-slider -->
                </div><!-- /.picture -->
            </div><!-- /.col-md-4 -->

            <div class="col-lg-8 col-md-7 col-sm-7">

                <div class="content-inner">
                    <h3>
                        <a href="detail.html">Toyota Verso</a>
                    </h3>
                    <div class="subtitle">DPF Active</div><!-- /.subtitle -->

                    <div class="price">$16,999</div><!-- /.price -->

                    <div class="description">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate neque. Fusce hendrerit fermentum elementum.</p>
                    </div><!-- /.description -->

                    <div class="meta">
                        <ul>
                            <li>
                                <i class="icon icon-normal-dashboard"></i> 2013                            </li>
                            <li>
                                <i class="icon icon-normal-car-door"></i> Eléctrico                            </li>
                            <li>
                                <i class="icon icon-normal-cog-wheel"></i> 1500                            </li>
                        </ul>
                    </div><!-- /.meta -->
                </div><!-- /.content-inner -->
            </div><!-- /.col-md-8 -->
        </div><!-- /.row -->
    </div><!-- /.inner -->
</div><!-- /.row-item -->									</div><!-- /.inner -->
			</div><!-- /.content -->
		</div><!-- /.col-md-12 -->
	</div><!-- /.row -->
</div><!-- /.block -->                    </div><!-- /#main -->
                </div><!-- /.col-md-9 -->

                <div class="col-md-3 col-sm-12">
                    <div class="sidebar">
                        <div id="newsletter" class='block default'>
  <div class="block-inner">
    <div class="block-title">
      <h3>Newsletter</h3>
    </div>

    <form>
      <div class="form-group">
        <input placeholder="Tu e-mail" type="text" name="maker" class="form-control">
      </div>

      <div class="form-group">
        <button class="send btn btn-primary btn-primary-color">Subscribirse</button>
      </div>
    </form>
  </div>
</div>                        <div class="latest-reviews block block-shadow white">
	<div class="block-inner">
		<div class="block-title">
			<h3>Últimas críticas</h3>
		</div><!-- /.block-title -->

		<div class="inner">
			<div class="row">
				<div class="item-wrapper col-lg-12 col-md-12 col-sm-4">
					<div class="item">
						<div class="picture hidden-sm">
							<a href="detail.html">
								<img src="/tpl_guest/assets/img/review.png" alt="#">
							</a>
						</div><!-- /.picture -->

						<div class="title">
							<a href="detail.html">Toyota Landcruiser</a>
						</div><!-- /.title -->

						<div class="date">10/12/2013</div><!-- /.date -->

						<div class="description">
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate...
							</p>
						</div><!-- /.description -->
					</div><!-- /.item -->
				</div><!-- /.item-wrapper -->

				<div class="item-wrapper col-lg-12 col-md-12 col-sm-4">
					<div class="item">
						<div class="title">
							<a href="detail.html">Toyota RAV</a>
						</div><!-- /.title -->

						<div class="date">12/12/2013</div><!-- /.date -->

						<div class="description">
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate...
							</p>
						</div><!-- /.description -->
					</div><!-- /.item -->	
				</div><!-- /.item-wrapper -->

				<div class="item-wrapper col-lg-12 col-md-12 col-sm-4">
					<div class="item">
						<div class="title">
							<a href="detail.html">Toyota 4Runner</a>
						</div><!-- /.title -->

						<div class="date">20/12/2013</div><!-- /.date -->

						<div class="description">
					<p>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate...
					</p>
				</div><!-- /.description -->
					</div><!-- /.item -->			
				</div><!-- /.item-wrapper -->
			</div><!-- /.row -->
		</div><!-- /.inner -->
	</div><!-- /.block-inner -->
</div><!-- /.block -->                        <div id="random-cars" class="random-cars block block-shadow white">

	<div class="block-inner">
		<div class="block-title">
			<h3>Coches recientes</h3>
		</div><!-- /.block-title -->

		
		<div class="row">
							<div class="teaser-item-wrapper col-lg-12 col-md-12 col-sm-4">
					<div class="teaser-item">
    <div class="title">
        <a href="detail.html">Toyota Landcruiser</a>
    </div><!-- /.title -->

    <div class="subtitle">
        MX 234    </div><!-- /.subtitle -->

    <div class="row">
        <div class="col-sm-5 col-md-5 picture-wrapper">
            <div class="picture">
                                <a href="detail.html">
                    <span class="hover">
                        <span class="hover-inner">
                            <i class="icon icon-normal-link"></i>
                        </span><!-- /.hover-inner -->
                    </span><!-- /.hover -->

                    <img src="/tpl_guest/assets/img/content/toyota4.jpg" alt="#">
                </a>
            </div><!-- /.picture -->
        </div><!-- /.picture-wrapper -->

        <div class="col-sm-7 col-md-7 content-wrapper ">
            <div class="price">$9,799</div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div><!-- /.content-wrapper -->
    </div><!-- /.row -->
</div><!-- /.teaser-item -->				</div><!-- /.teaser-item-wrapper -->
							<div class="teaser-item-wrapper col-lg-12 col-md-12 col-sm-4">
					<div class="teaser-item">
    <div class="title">
        <a href="detail.html">Toyota Verso</a>
    </div><!-- /.title -->

    <div class="subtitle">
        DPF Active    </div><!-- /.subtitle -->

    <div class="row">
        <div class="col-sm-5 col-md-5 picture-wrapper">
            <div class="picture">
                                <a href="detail.html">
                    <span class="hover">
                        <span class="hover-inner">
                            <i class="icon icon-normal-link"></i>
                        </span><!-- /.hover-inner -->
                    </span><!-- /.hover -->

                    <img src="/tpl_guest/assets/img/content/toyota7.jpg" alt="#">
                </a>
            </div><!-- /.picture -->
        </div><!-- /.picture-wrapper -->

        <div class="col-sm-7 col-md-7 content-wrapper ">
            <div class="price">$9,799</div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div><!-- /.content-wrapper -->
    </div><!-- /.row -->
</div><!-- /.teaser-item -->				</div><!-- /.teaser-item-wrapper -->
							<div class="teaser-item-wrapper col-lg-12 col-md-12 col-sm-4">
					<div class="teaser-item">
    <div class="title">
        <a href="detail.html">Toyota Verso</a>
    </div><!-- /.title -->

    <div class="subtitle">
        Valvematic Active    </div><!-- /.subtitle -->

    <div class="row">
        <div class="col-sm-5 col-md-5 picture-wrapper">
            <div class="picture">
                                <a href="detail.html">
                    <span class="hover">
                        <span class="hover-inner">
                            <i class="icon icon-normal-link"></i>
                        </span><!-- /.hover-inner -->
                    </span><!-- /.hover -->

                    <img src="/tpl_guest/assets/img/content/toyota4.jpg" alt="#">
                </a>
            </div><!-- /.picture -->
        </div><!-- /.picture-wrapper -->

        <div class="col-sm-7 col-md-7 content-wrapper ">
            <div class="price">$9,799</div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div><!-- /.content-wrapper -->
    </div><!-- /.row -->
</div><!-- /.teaser-item -->				</div><!-- /.teaser-item-wrapper -->
					</div><!-- /.row -->
	</div><!-- /.block-inner -->
</div><!-- /.block -->                    </div><!-- /.sidebar -->
                </div><!-- /.col-md-3 -->
            </div><!-- /.row -->

            <div id="content-bottom">
                <div class="row">
                    <div class="col-md-12">
                        <div class="testimonials-block block">
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
</div><!-- /.testimonials-block -->                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="features-block block">
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
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed neque dolor, placerat mattis justo id, convallis porta nulla</p>
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
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed neque dolor, placerat mattis justo id, convallis porta nulla</p>
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
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed neque dolor, placerat mattis justo id, convallis porta nulla</p>
					</div><!-- /.col-md-7 -->
				</div><!-- /.row -->
			</div><!-- /.col-md-4 -->
		</div><!-- /.feature -->		
	</div><!-- /.row -->
</div><!-- /.block -->                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->
            </div><!-- /#content-bottom -->
        </div><!-- /.container -->
    </div><!-- /.section -->

    <div class="section gray-light ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="partners-block block">
        <div class="page-header">
            <div class="page-header-inner">


                <div class="heading">
                    <h2>Colaboradores</h2>
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
						<img src="/tpl_guest/assets/img/partners/volkswagen.png" alt="#">
					</a>
				</div><!-- /.partner -->
			</div><!-- /.col-md-2 -->

			<div class="col-sm-2 col-md-2">
				<div class="partner">
					<a href="#">
						<img src="/tpl_guest/assets/img/partners/ford.png" alt="#">
					</a>
				</div><!-- /.partner -->
			</div><!-- /.col-md-2 -->

			<div class="col-sm-2 col-md-2">
				<div class="partner">
					<a href="#">
						<img src="/tpl_guest/assets/img/partners/honda.png" alt="#">
					</a>
				</div><!-- /.partner -->
			</div><!-- /.col-md-2 -->

			<div class="col-sm-2 col-md-2">
				<div class="partner">
					<a href="#">
						<img src="/tpl_guest/assets/img/partners/mercedes.png" alt="#">
					</a>
				</div><!-- /.partner -->
			</div><!-- /.col-md-2 -->

			<div class="col-sm-2 col-md-2">
				<div class="partner">
					<a href="#">
						<img src="/tpl_guest/assets/img/partners/toyota.png" alt="#">
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
</div><!-- /.partners-block -->                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.section -->
</div><!-- /#content -->
{include file="../common/footer.tpl"}