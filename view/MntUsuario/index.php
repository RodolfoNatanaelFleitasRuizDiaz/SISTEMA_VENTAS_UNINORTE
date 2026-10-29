<?php
session_start();

// Si no hay sesión, redirigir al login
if(!isset($_SESSION["usu_id"])){
    header("Location: /SISTEMA_VENTAS_UNINORTE/login.php");
    exit();
}
?>

<?php require_once("modalmantenimiento.php"); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Usuarios - Sistema Ventas</title>

    <link href="../../public/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../public/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../public/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../public/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../public/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/bracket.css">
  </head>

  <body>
    <!-- ########## START: LEFT PANEL ########## -->
<div class="br-logo"><a href=""><span>[</span>VENTAS<span>]</span></a></div>
<div class="br-sideleft overflow-y-auto">
  <label class="sidebar-label pd-x-15 mg-t-20">Navegación</label>
  <div class="br-sideleft-menu">

    <a href="../../index.php" class="br-menu-link">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
        <span class="menu-item-label">Dashboard</span>
      </div>
    </a>

    <a href="#" class="br-menu-link active">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
        <span class="menu-item-label">Mantenimiento</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>

    <ul class="br-menu-sub nav flex-column show">
      <li class="nav-item"><a href="../MntProducto/index.php" class="nav-link">Productos</a></li>
      <li class="nav-item"><a href="../MntUsuario/index.php" class="nav-link active">Usuarios</a></li>
    </ul>

  </div><!-- br-sideleft-menu -->

  <label class="sidebar-label pd-x-15 mg-t-25 mg-b-20 tx-info op-9">SISTEMA VENTAS UNINORTE</label>

  <div class="info-list">
    <div class="d-flex align-items-center justify-content-between pd-x-15">
      <div>
        <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">Memory Usage</p>
        <h5 class="tx-lato tx-white tx-normal mg-b-0">32.3%</h5>
      </div>
      <span class="peity-bar" data-peity='{ "fill": ["#336490"], "height": 35, "width": 60 }'>8,6,5,9,8,4,9,3,5,9</span>
    </div>

    <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
      <div>
        <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">CPU Usage</p>
        <h5 class="tx-lato tx-white tx-normal mg-b-0">140.05</h5>
      </div>
      <span class="peity-bar" data-peity='{ "fill": ["#1C7973"], "height": 35, "width": 60 }'>4,3,5,7,12,10,4,5,11,7</span>
    </div>

    <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
      <div>
        <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">Disk Usage</p>
        <h5 class="tx-lato tx-white tx-normal mg-b-0">82.02%</h5>
      </div>
      <span class="peity-bar" data-peity='{ "fill": ["#8E4246"], "height": 35, "width": 60 }'>1,2,1,3,2,10,4,12,7</span>
    </div>

    <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
      <div>
        <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">Daily Traffic</p>
        <h5 class="tx-lato tx-white tx-normal mg-b-0">62,201</h5>
      </div>
      <span class="peity-bar" data-peity='{ "fill": ["#9C7846"], "height": 35, "width": 60 }'>3,12,7,9,2,3,4,5,2</span>
    </div>
  </div><!-- info-list -->

  <br>
</div><!-- br-sideleft -->
<!-- ########## END: LEFT PANEL ########## -->

        <a href="#" class="br-menu-link active">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
            <span class="menu-item-label">Mantenimiento</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
        </a>
        <ul class="br-menu-sub nav flex-column show">
          <li class="nav-item"><a href="../MntProducto/index.php" class="nav-link">Productos</a></li>
          <li class="nav-item"><a href="index.php" class="nav-link active">Usuarios</a></li>
        </ul>
      </div>
    </div>

   <!-- ########## START: HEAD PANEL ########## -->
<div class="br-header">
  <div class="br-header-left">
    <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
    <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
    <div class="input-group hidden-xs-down wd-170 transition">
      <input id="searchbox" type="text" class="form-control" placeholder="Buscar">
      <span class="input-group-btn">
        <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
      </span>
    </div>
  </div><!-- br-header-left -->

  <div class="br-header-right">
    <nav class="nav">
      <!-- Mensajes -->
      <div class="dropdown">
        <a href="" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown">
          <i class="icon ion-ios-email-outline tx-24"></i>
          <span class="square-8 bg-danger pos-absolute t-15 r-0 rounded-circle"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-header wd-300 pd-0-force">
          <div class="d-flex align-items-center justify-content-between pd-y-10 pd-x-20 bd-b bd-gray-200">
            <label class="tx-12 tx-info tx-uppercase tx-semibold tx-spacing-2 mg-b-0">Messages</label>
            <a href="" class="tx-11">+ Add New Message</a>
          </div>
          <div class="media-list">
            <div class="pd-y-10 tx-center bd-t">
              <a href="" class="tx-12"><i class="fa fa-angle-down mg-r-5"></i> Show All Messages</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Notificaciones -->
      <div class="dropdown">
        <a href="" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown">
          <i class="icon ion-ios-bell-outline tx-24"></i>
          <span class="square-8 bg-danger pos-absolute t-15 r-5 rounded-circle"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-header wd-300 pd-0-force">
          <div class="d-flex align-items-center justify-content-between pd-y-10 pd-x-20 bd-b bd-gray-200">
            <label class="tx-12 tx-info tx-uppercase tx-semibold tx-spacing-2 mg-b-0">Notifications</label>
            <a href="" class="tx-11">Mark All as Read</a>
          </div>
          <div class="media-list">
            <div class="pd-y-10 tx-center bd-t">
              <a href="" class="tx-12"><i class="fa fa-angle-down mg-r-5"></i> Show All Notifications</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Perfil de usuario -->
      <div class="dropdown">
        <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
         <span class="logged-name hidden-md-down"><?php echo $_SESSION["usu_nom"]; ?></span>
          <img src="http://via.placeholder.com/64x64" class="wd-32 rounded-circle" alt="">
          <span class="square-10 bg-success"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-header wd-200">
          <ul class="list-unstyled user-profile-nav">
            <li><a href=""><i class="icon ion-ios-person"></i> Edit Profile</a></li>
            <li><a href=""><i class="icon ion-ios-gear"></i> Settings</a></li>
            <li><a href=""><i class="icon ion-power"></i> Sign Out</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="navicon-right">
      <a id="btnRightMenu" href="" class="pos-relative">
        <i class="icon ion-ios-chatboxes-outline"></i>
        <span class="square-8 bg-danger pos-absolute t-10 r--5 rounded-circle"></span>
      </a>
    </div>
  </div><!-- br-header-right -->
</div><!-- br-header -->
<!-- ########## END: HEAD PANEL ########## -->

    <!-- MAIN PANEL -->
    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="#">Mantenimiento</a>
          <span class="breadcrumb-item active">Usuarios</span>
        </nav>
      </div>

      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">USUARIOS</h4>
        <p class="mg-b-0">Módulo de Mantenimiento de Usuarios</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">MANTENIMIENTO DE USUARIOS</h6>

          <button id="btnNuevo" class="btn btn-outline-primary btn-block mg-b-10">
            <i class="fa fa-plus mg-r-5"></i> Nuevo Registro
          </button>

          <div class="table-wrapper">
            <table id="usuario_data" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-20p">Nombre</th>
                  <th class="wd-20p">Usuario (Sesión)</th>
                  <th class="wd-15p">Fecha Creación</th>
                  <th class="wd-15p">Fecha Modificación</th>
                  <th class="wd-15p">Acciones</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <script src="../../public/lib/jquery/jquery.js"></script>
    <script src="../../public/lib/popper.js/popper.js"></script>
    <script src="../../public/lib/bootstrap/bootstrap.js"></script>
    <script src="../../public/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../public/lib/moment/moment.js"></script>
    <script src="../../public/lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../public/lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../public/lib/peity/jquery.peity.js"></script>
    <script src="../../public/lib/datatables/jquery.dataTables.js"></script>
    <script src="../../public/lib/datatables-responsive/dataTables.responsive.js"></script>
    <script src="../../public/js/bracket.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../../public/js/sweetalert2.all.min.js"></script>
    <script src="mntUsuario.js"></script>
  </body>
</html>