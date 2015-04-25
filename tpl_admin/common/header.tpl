<!DOCTYPE html>
<html lang="es" class="app">
<head>  
  <meta charset="utf-8" />
  <meta name="robots" content="noindex,nofollow">
  <title>Electrificar | Panel de Administración</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="shortcut icon" href="/admin/images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/admin/images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="/admin/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="/admin/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="/admin/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="/admin/css/icon.css" type="text/css" />
  <link rel="stylesheet" href="/admin/css/font.css" type="text/css" />
  <link rel="stylesheet" href="/admin/css/app.css" type="text/css" />  
  <link rel="stylesheet" href="/admin/js/calendar/bootstrap_calendar.css" type="text/css" />
  <link rel="stylesheet" href="/admin/js/datepicker/datepicker.css" type="text/css" />
  <link rel="stylesheet" href="/admin/js/slider/slider.css" type="text/css" />
  <link rel="stylesheet" href="/admin/js/chosen/chosen.css" type="text/css" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <!--[if lt IE 9]>
    <script src="/admin/js/ie/html5shiv.js"></script>
    <script src="/admin/js/ie/respond.min.js"></script>
    <script src="/admin/js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body class="">
  <section class="vbox">
    <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
      <div class="navbar-header aside-md dk">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav">
          <i class="fa fa-bars"></i>
        </a>
        <a href="/administracion/" class="navbar-brand">
          E<i class="fa fa-flash"></i>ectrific<i class="fa fa-car"></i>r 
        </a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
          <i class="fa fa-cog"></i>
        </a>
      </div>
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
              <img src="/img/g.png" alt="Miguel">
            </span>
            <?=$_SESSION['usuario']['nombre']?> <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">            
            <li>
              <a href="/administracion/logout/" data-toggle="ajaxModal" >Desconectar</a>
            </li>
          </ul>
        </li>
      </ul>      
    </header>
    <section>
    	<section class="hbox stretch">
    	<?php require_once $_SERVER["DOCUMENT_ROOT"].'/admin/comun/sidebar.php'; ?>