<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $data["titulo_pagina"]; ?></title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media();?>css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media();?>css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="<?= media();?>css/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="<?= media();?>css/morris.css">
    <link rel="stylesheet" type="text/css" href="<?= media();?>css/style.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="shortcut icon" href="<?= media();?>images/icon.png" type="image/x-icon">
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="<?=base_url();?>dashboard">Sistema Tienda</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <!-- Quité la configuración -->
            <li><a class="dropdown-item" href="<?=base_url();?>usuario/perfil"><i class="fa fa-user fa-lg"></i> Perfil</a></li>
            <li><a class="dropdown-item" href="<?=base_url();?>logout"><i class="fa fa-sign-out fa-lg"></i> Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul>
    </header>
<?php require_once('nav_admin.php'); ?> 