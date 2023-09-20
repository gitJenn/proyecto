<?php
if (strlen(session_id()) < 1) 
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SuperFacil | Inventario</title>

  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
 

  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css?v=3.2.0">



</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
  <img class="img-circle elevation-2" src="../files/usuarios/<?php echo $_SESSION["imagen"]; ?>" alt="User profile picture" width="10%" style="display: block; margin-left"> 
  <h1 style="color: grey; font-weight: bold; text-align: center; font-size: 50px"><?php echo $_SESSION["nousuario"]; ?>, Bienvenido!</h1>
  <img class="animation__shake img-circle elevation-2" src="SuperLogo.png" alt="AdminLTELogo" height="60%" width="30%">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
      
        
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      <li><a class="btn btn-primary" href="../ajax/usuario.php?opc=salir">Cerrar Sesión  <i class="fas fa-sign-out-alt"></i></a></li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="resumen.php" class="brand-link">
      <img src="SuperLogo.png" alt="SuperFacil Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><b>Super</b>Fácil</span>
     
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../files/usuarios/<?php echo $_SESSION["imagen"]; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="perfil.php" class="d-block"><?php echo $_SESSION["nousuario"]; ?>  </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
    

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-store"></i>
              <p>
                Control Almacén
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

<?php

    if ($_SESSION['controlcate']==1) {
     echo         '<li class="nav-item">
                <a href="categoria.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categoria</p>
                </a>
              </li>';
    }
            
       ?>     
            
            <?php

if ($_SESSION['controlprov']==1) {
 echo         '   
            <li class="nav-item">
                <a href="proveedor.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Proveedor</p>
                </a>
              </li>';
    }
            
       ?>     
            <?php

if ($_SESSION['proanular']==1 || $_SESSION['proeditar']==1 || $_SESSION['procrear']==1)   
{         
            echo ' <li class="nav-item">
                <a href="producto.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Producto</p>
                </a>
              </li>
            </ul>
          </li>';
  }

          ?>
         <!-- Segundo menu -->
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Control Venta
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            

              <?php
            if ($_SESSION['controventa']==1) {
              echo'  
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="venta.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Venta</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="historial.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Historial</p>
                </a>
              </li>
              </ul>
              ';
            }
              ?>
             
            
         

         <!-- fin del menu -->

<!-- menu de usuario -->
 <!-- Segundo menu -->
 <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          
               <li class="nav-item menu-open">
            <a href="usuario.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Control Usuario
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          
          
            <ul class="nav nav-treeview">
              
            <?php

if ($_SESSION['controusu']==1)   
{         
            echo '
            <li class="nav-item">
                <a href="usuario.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuario</p>
                </a>
              </li>
              ';
  }

          ?>
              
            </ul>
          </li>

         <!-- fin del menu -->

<!-- Fin de menu -->



        </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>