<!DOCTYPE html>
<html lang="en" class="app" style="background-color:#126DA7;">
<head>  
  <meta charset="utf-8" />
  <title>Electrificar | Panel De Administracion</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="/admin/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="/admin/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="/admin/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="/admin/css/icon.css" type="text/css" />
  <link rel="stylesheet" href="/admin/css/font.css" type="text/css" />
  <link rel="stylesheet" href="/admin/css/app.css" type="text/css" />  
    <!--[if lt IE 9]>
    <script src="/admin/js/ie/html5shiv.js"></script>
    <script src="/admin/js/ie/respond.min.js"></script>
    <script src="/admin/js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body class="">
  <section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
    <div class="container aside-xl">
      <a class="navbar-brand block" href="/admin/" style="font-size:35px;color:#d7ecfa;" >E<i class="fa fa-flash"></i>ectrific<i class="fa fa-car"></i>r </a>
      <section class="m-b-lg">
        <header class="wrapper text-center">
          <strong style="color:white;">Panel de administración</strong>
        </header>
        <form action="/admin/login/" method="post" name="login_form" data-validate="parsley">
          <div class="list-group">
            <div class="list-group-item">
              <input type="email" name="email" data-required="true" placeholder="Email" class="form-control no-border">
            </div>
            <div class="list-group-item">
               <input type="password" name="pass" data-required="true" placeholder="Password" class="form-control no-border">
            </div>
          </div>
          <button type="submit" class="btn-lgn btn btn-lg btn-primary btn-block">Entrar</button>
        </form>
      </section>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder">
      <p>
        <small style="color:white;">Electrificar, todos los derechos reservados<br>&copy; 2015</small>
      </p>
    </div>
  </footer>
  <!-- / footer -->
  <script src="/admin/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="/admin/js/bootstrap.js"></script>
  <!-- App -->
  <script src="/admin/js/app.js"></script>  
  <script src="/admin/js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="js/parsley/parsley.min.js"></script>
  <script src="js/parsley/parsley.extend.js"></script>
  <script src="js/app.plugin.js"></script>
</body>
</html>