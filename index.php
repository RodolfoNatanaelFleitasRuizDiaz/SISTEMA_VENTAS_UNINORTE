
<?php
session_start();

// Si no hay sesión, redirigir al login
if(!isset($_SESSION["usu_id"])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - Sistema Ventas UniNorte</title>

    <!-- CSS del template -->
    <link href="public/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="public/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="public/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="public/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/bracket.css">

    <style>
 :root {
  --cyan: #00f0ff;
  --blue: #0077ff;
  --purple: #8b2bff;
  --pink: #ff00aa;
}

.planet-container {
  isolation: isolate;
  width: 380px;
  height: 320px;
  margin: 40px auto 30px;
  position: relative;
  overflow: visible;
}

/* Halo */
.planet-container::before {
  content: "";
  position: absolute;
  top: 50%; left: 50%;
  width: 300px; height: 300px;
  margin: -150px 0 0 -150px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(0,240,255,.18), rgba(139,43,255,.08) 50%, transparent 72%);
  filter: blur(12px);
  animation: halo-pulse 4s ease-in-out infinite;
  z-index: 0;
}

/* ===== PLANETA (esfera fija, solo gira la superficie) ===== */
.planet {
  position: absolute;
  top: 50%; left: 50%;
  width: 240px; height: 240px;
  margin: -120px 0 0 -120px;
  border-radius: 50%;
  overflow: hidden;
  z-index: 2;
  background: radial-gradient(circle at 35% 30%, #00f0ff 0%, #0077ff 25%, #31206f 55%, #0a001a 80%, #03020b 100%);
  box-shadow:
    0 0 24px rgba(0,240,255,.45),
    0 0 58px rgba(139,43,255,.3);
}

/* Superficie: textura ancha que se desplaza = rotación del planeta */
.planet::before {
  content: "";
  position: absolute;
  inset: 0;
  border-radius: 50%;
  background:
    radial-gradient(ellipse 22px 30px at 20% 38%, rgba(0,255,200,.55), transparent 70%),
    radial-gradient(ellipse 28px 20px at 55% 62%, rgba(255,0,170,.45), transparent 70%),
    radial-gradient(ellipse 18px 26px at 80% 30%, rgba(0,200,255,.55), transparent 70%),
    repeating-linear-gradient(155deg, transparent 0 17px, rgba(0,240,255,.14) 18px 20px, transparent 22px 37px);
  background-size: 240px 240px;
  background-repeat: repeat-x;
  mix-blend-mode: screen;
  opacity: .85;
  animation: surface-spin 14s linear infinite;
}

/* Sombreado esférico: da volumen (luz arriba-izquierda, borde oscuro) */
.planet::after {
  content: "";
  position: absolute;
  inset: 0;
  border-radius: 50%;
  background:
    radial-gradient(circle at 30% 25%, rgba(255,255,255,.35) 0, transparent 22%),
    radial-gradient(circle at 36% 32%, transparent 38%, rgba(0,0,0,.55) 78%, rgba(0,0,0,.9) 100%);
  box-shadow: inset 4px 3px 14px rgba(0,240,255,.35);
  pointer-events: none;
}

/* ===== ANILLO (dos mitades: trasera y delantera) ===== */
.ring-tilt {
  position: absolute;
  top: 50%; left: 50%;
  width: 340px; height: 340px;
  margin: -170px 0 0 -170px;
  transform: rotateZ(-18deg);          /* inclinación del anillo */
  pointer-events: none;
}

.ring {
  position: absolute;
  inset: 0;
  transform: perspective(900px) rotateX(72deg);
}

.ring-back  { z-index: 1; clip-path: inset(0 0 50% 0); }  /* mitad lejana: detrás del planeta */
.ring-front { z-index: 3; clip-path: inset(50% 0 0 0); }  /* mitad cercana: delante del planeta */

.ring-spin {
  position: absolute;
  inset: 0;
  border-radius: 50%;
  background: conic-gradient(var(--cyan), var(--purple), var(--pink), var(--purple), var(--cyan));
  -webkit-mask: radial-gradient(farthest-side, transparent calc(100% - 6px), #000 calc(100% - 5px));
          mask: radial-gradient(farthest-side, transparent calc(100% - 6px), #000 calc(100% - 5px));
  filter: drop-shadow(0 0 6px rgba(0,240,255,.9)) drop-shadow(0 0 14px rgba(139,43,255,.6));
  animation: ring-flow 8s linear infinite, ring-flicker 5s steps(1, end) infinite;
}

/* ===== SCANLINES Y GLITCH (sobre todo el conjunto) ===== */
.scanlines {
  position: absolute;
  top: 50%; left: 50%;
  width: 340px; height: 340px;
  margin: -170px 0 0 -170px;
  z-index: 5;
  border-radius: 50%;
  pointer-events: none;
  background: repeating-linear-gradient(to bottom, transparent 0, transparent 3px, rgba(0,0,0,.25) 4px, rgba(0,0,0,.25) 5px);
  -webkit-mask: radial-gradient(circle, #000 55%, transparent 72%);
          mask: radial-gradient(circle, #000 55%, transparent 72%);
  opacity: .6;
  animation: scanline-shift 8s linear infinite;
}

.glitch {
  position: absolute;
  top: 50%; left: 50%;
  width: 340px; height: 340px;
  margin: -170px 0 0 -170px;
  z-index: 6;
  overflow: hidden;
  border-radius: 50%;
  pointer-events: none;
  opacity: 0;
  mix-blend-mode: screen;
  animation: glitch-flash 6s steps(1, end) infinite;
}
.glitch::before, .glitch::after {
  content: "";
  position: absolute;
  left: -10%; width: 120%; height: 8%;
}
.glitch::before { top: 38%; background: rgba(0,240,255,.35); animation: glitch-slice-a 6s steps(1, end) infinite; }
.glitch::after  { top: 62%; background: rgba(255,0,170,.3);  animation: glitch-slice-b 6s steps(1, end) infinite; }

/* ===== ANIMACIONES ===== */
@keyframes surface-spin   { from { background-position-x: 0; } to { background-position-x: 240px; } }
@keyframes ring-flow      { to { transform: rotate(360deg); } }
@keyframes ring-flicker   { 0%,93%,96%,100% { opacity: 1; } 94% { opacity: .6; } 95% { opacity: .9; } }
@keyframes halo-pulse     { 0%,100% { opacity: .65; transform: scale(.96); } 50% { opacity: 1; transform: scale(1.05); } }
@keyframes scanline-shift { from { background-position-y: 0; } to { background-position-y: 40px; } }
@keyframes glitch-flash   { 0%,12%,13%,48%,49%,82%,83%,100% { opacity: 0; } 12.5%,48.5%,82.5% { opacity: .8; } }
@keyframes glitch-slice-a { 0%,12%,13%,48%,49%,82%,83%,100% { transform: translateX(0); } 12.5% { transform: translateX(12px); } 48.5% { transform: translateX(-9px); } 82.5% { transform: translateX(6px); } }
@keyframes glitch-slice-b { 0%,12%,13%,48%,49%,82%,83%,100% { transform: translateX(0); } 12.5% { transform: translateX(-10px); } 48.5% { transform: translateX(8px); } 82.5% { transform: translateX(-5px); } }

@media (prefers-reduced-motion: reduce) {
  .planet::before, .ring-spin, .planet-container::before,
  .scanlines, .glitch, .glitch::before, .glitch::after { animation: none !important; }
}

@media (max-width: 420px) {
  .planet-container { transform: scale(.82); transform-origin: top center; margin-bottom: -30px; }
}
    </style>
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <div class="br-logo"><a href=""><span>[</span>VENTAS<span>]</span></a></div>
    <div class="br-sideleft overflow-y-auto">
      <label class="sidebar-label pd-x-15 mg-t-20">Navegación</label>
      <div class="br-sideleft-menu">

        <a href="index.php" class="br-menu-link active">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Dashboard</span>
          </div>
        </a>

        <a href="#" class="br-menu-link">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
            <span class="menu-item-label">Mantenimiento</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
        </a>
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item">
            <a href="view/MntProducto/index.php" class="nav-link">Productos</a>
          </li>
          <li class="nav-item">
            <a href="view/MntUsuario/index.php" class="nav-link">Usuarios</a>
          </li>
        </ul>

      </div>

      <label class="sidebar-label pd-x-15 mg-t-25 mg-b-20 tx-info op-9">SISTEMA VENTAS UNINORTE</label>

      <div class="info-list">
        <div class="d-flex align-items-center justify-content-between pd-x-15">
          <div>
            <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2">Memory Usage</p>
            <h5 class="tx-lato tx-white tx-normal mg-b-0">32.3%</h5>
          </div>
          <span class="peity-bar" data-peity='{ "fill": ["#336490"], "height": 35, "width": 60 }'>8,6,5,9,8,4,9,3,5,9</span>
        </div>

        <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
          <div>
            <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2">CPU Usage</p>
            <h5 class="tx-lato tx-white tx-normal mg-b-0">140.05</h5>
          </div>
          <span class="peity-bar" data-peity='{ "fill": ["#1C7973"], "height": 35, "width": 60 }'>4,3,5,7,12,10,4,5,11,7</span>
        </div>

        <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
          <div>
            <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2">Disk Usage</p>
            <h5 class="tx-lato tx-white tx-normal mg-b-0">82.02%</h5>
          </div>
          <span class="peity-bar" data-peity='{ "fill": ["#8E4246"], "height": 35, "width": 60 }'>1,2,1,3,2,10,4,12,7</span>
        </div>

        <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
          <div>
            <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2">Daily Traffic</p>
            <h5 class="tx-lato tx-white tx-normal mg-b-0">62,201</h5>
          </div>
          <span class="peity-bar" data-peity='{ "fill": ["#9C7846"], "height": 35, "width": 60 }'>3,12,7,9,2,3,4,5,2</span>
        </div>
      </div>
      <br>
    </div>
    <!-- ########## END: LEFT PANEL ########## -->

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
      </div>

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
                <li><a href="logout.php"><i class="icon ion-power"></i> Cerrar Sesión</a></li>
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
      </div>
    </div>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <span class="breadcrumb-item active">Dashboard</span>
        </nav>
      </div>

      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Dashboard</h4>
        <p class="mg-b-0">Bienvenido al Sistema de Ventas - UniNorte</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper text-center">

           <!-- Planeta Cyberpunk -->
<div class="planet-container" aria-label="Planeta holográfico con anillo, glitch y scanlines">
  <div class="ring-tilt">
    <div class="ring ring-back"><div class="ring-spin"></div></div>
  </div>

  <div class="planet"></div>

  <div class="ring-tilt">
    <div class="ring ring-front"><div class="ring-spin"></div></div>
  </div>

  <div class="scanlines"></div>
  <div class="glitch"></div>
</div>

          <h5 class="tx-gray-800 mg-b-5">Sistema de Ventas UniNorte</h5>
          <p class="tx-gray-600 mg-b-30">Panel de control principal</p>

          <div class="row justify-content-center">
            <div class="col-sm-6 col-xl-3">
              <div class="bg-info rounded overflow-hidden">
                <div class="pd-25 d-flex align-items-center">
                  <i class="fa fa-box tx-60 lh-0 tx-white opacity-7"></i>
                  <div class="mg-l-20">
                    <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Productos</p>
                    <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">Gestión</p>
                    <a href="view/MntProducto/index.php" class="tx-11 tx-white-6">Ir a Productos →</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
              <div class="bg-purple rounded overflow-hidden">
                <div class="pd-25 d-flex align-items-center">
                  <i class="fa fa-users tx-60 lh-0 tx-white opacity-7"></i>
                  <div class="mg-l-20">
                    <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Usuarios</p>
                    <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">Gestión</p>
                    <a href="view/MntUsuario/index.php" class="tx-11 tx-white-6">Ir a Usuarios →</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <!-- ########## END: MAIN PANEL ########## -->

    <script src="public/lib/jquery/jquery.js"></script>
    <script src="public/lib/popper.js/popper.js"></script>
    <script src="public/lib/bootstrap/bootstrap.js"></script>
    <script src="public/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="public/lib/moment/moment.js"></script>
    <script src="public/lib/jquery-ui/jquery-ui.js"></script>
    <script src="public/lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="public/lib/peity/jquery.peity.js"></script>
    <script src="public/js/bracket.js"></script>
  </body>
</html>
