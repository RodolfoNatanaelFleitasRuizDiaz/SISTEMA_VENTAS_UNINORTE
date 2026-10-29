<?php
session_start();

// Si ya está logueado, redirigir al dashboard
if(isset($_SESSION["usu_id"])){
    header("Location: index.php");
    exit();
}

require_once("config/conexion.php");
require_once("model/Usuario.php");

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $usu_sesion = trim($_POST["usu_sesion"]);
    $usu_clave  = trim($_POST["usu_clave"]);

    if(empty($usu_sesion) || empty($usu_clave)){
        $error = "Debe completar todos los campos";
    }else{
        $usuario = new Usuario();
        $datos = $usuario->login($usu_sesion, $usu_clave);

        if(is_array($datos) && count($datos) > 0){
            $_SESSION["usu_id"]     = $datos["usu_id"];
            $_SESSION["usu_nom"]    = $datos["usu_nom"];
            $_SESSION["usu_sesion"] = $datos["usu_sesion"];

            header("Location: index.php");
            exit();
        }else{
            $error = "Usuario o contraseña incorrectos";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Iniciar Sesión - Sistema Ventas UniNorte</title>
    <link href="public/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="public/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/bracket.css">
</head>
<body>

    <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">
        <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
            <div class="signin-logo tx-center tx-28 tx-bold tx-inverse">
                <span class="tx-normal">[</span> VENTAS <span class="tx-normal">]</span>
            </div>
            <div class="tx-center mg-b-40">Sistema de Ventas - UniNorte</div>

            <?php if(!empty($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <input type="text" name="usu_sesion" class="form-control" 
                           placeholder="Usuario" required autofocus
                           value="<?php echo isset($_POST['usu_sesion']) ? htmlspecialchars($_POST['usu_sesion']) : ''; ?>">
                </div>

                <div class="form-group">
                    <input type="password" name="usu_clave" class="form-control" 
                           placeholder="Contraseña" required>
                </div>

                <button type="submit" class="btn btn-info btn-block">Iniciar Sesión</button>
            </form>

            <div class="mg-t-20 tx-center">Programación IV - UniNorte</div>
        </div>
    </div>

    <script src="public/lib/jquery/jquery.js"></script>
    <script src="public/lib/bootstrap/bootstrap.js"></script>
</body>
</html>