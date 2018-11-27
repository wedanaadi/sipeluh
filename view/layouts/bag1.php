<!DOCTYPE html>
<html lang="en">
<?php
  include('view/layouts/css.php');
?>
<body class="hold-transition skin-green-light sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>LH</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SIPE</b>LUH</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav nav-bar">
          <li>
            <a href="view/logout.php" style="padding: 15px"><i class="fa fa-fw fa-power-off"></i> <span> Log Out</span></a>

          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="assets/ega.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>CV. Budi Luhur Abadi </p>
          <!-- Status -->
          <a href="#"><i class="fa fa-child text-success"></i>
            <?php
              if($_SESSION['login_hk'] == 1)
              {
                echo 'Administrator';
              }
              else if($_SESSION['login_hk'] == 2)
              {
                  echo 'Teknisi';
              }
              else {
                echo "Pelanggan";
              }
            ?>
          </a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form> -->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- <li class="header">HEADER</li> -->
        <!-- Optionally, you can add icons to the links -->
        <!-- <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li> -->
        <?php if($_SESSION['login_hk'] == 1) { ?>
        <li class="treeview">
          <a href="#"><i class="fa fa-list"></i> <span>Master Data</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?m=pelanggan"><i class="fa fa-users"></i> <span>Pelanggan</span></a></li>
            <li><a href="index.php?m=teknisi"><i class="fa fa-users"></i> <span>Teknisi</span></a></li>
            <li><a href="index.php?m=kategorikeluhan"><i class="fa fa-tag"></i> <span>Kategori Keluhan</span></a></li>
            <li><a href="index.php?m=user"><i class="fa fa-users"></i> <span>User</span></a></li>
          </ul>
        </li>
      <?php } ?>

        <?php if ($_SESSION['login_hk'] == 1 or $_SESSION['login_hk'] == 2 or $_SESSION['login_hk'] == 3) { ?>
        <li class="treeview">
          <a href="#"><i class="fa fa-exclamation-triangle"></i> <span>Keluhan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <?php if ($_SESSION['login_hk'] == 1 or $_SESSION['login_hk'] == 3) { ?>
            <li><a href="index.php?m=keluhan"><i class="fa fa-refresh"></i> <span>Keluhan</span></a></li>
          <?php } if ($_SESSION['login_hk'] == 2) { ?>
            <li><a href="index.php?m=keluhan&p=list"><i class="fa fa-check-square-o"></i> <span>Aksi Keluhan</span></a></li>
          <?php } ?>
          </ul>
        </li>
        <?php } ?>

        <?php if ($_SESSION['login_hk'] == 4) { ?>
        <li class="treeview">
          <a href="#"><i class="fa fa-book"></i> <span>Laporan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?m=pelanggan&p=laporan" target="_blank"><i class="fa fa-users"></i> <span>Data Pelanggan</span></a></li>
            <li><a href="index.php?m=keluhan&p=laporan" target="_blank"><i class="fa fa-exclamation-circle"></i> <span>Data Keluhan</span></a></li>
          </ul>
        </li>
      <?php } ?>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
