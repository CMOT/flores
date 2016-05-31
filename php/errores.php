<?php
session_start();
$error = 0;
if (isset($_SESSION['correo']) && $_SESSION['rol'] = 'admin' && isset($_GET['error'])) {
    $nombre = $_SESSION['usuario'];
    $correo = $_SESSION['correo'];
    $error = $_GET['error'];
} else {
    header('location:../index.php');
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no ,initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Index</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../css/estilos.css"/>
        <script src="../js/jquery.js"></script>
        <script  src="../js/bootstrap.min.js"></script>

    </head>
    <body>
        <?php
        // put your code here
        ?>
        <header>
            <div class="container">
                <div class="row login">
                    <div class="col-xs-12">
                        <div class="visible-xs log" >
                            <div class="btn-group">
                                <button type="button" class="btn btn-info">Usuario:César Montes de Oca Torres</button>
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Mi cuenta</a></li>
                                    <li><a href="#">Configuración</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Cerrar sesión</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-0 col-sm-12 col-md-12 col-lg-12">
                        <div class="visible-lg visible-md visible-sm log">
                            <a href="#"><?php echo 'Usuario:' . $nombre ?></a>
                            |
                            <!--                            <a href="#">Login</a>
                                                        |-->
                            <a href="cerrarSesion.php">Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--            Barra de navegación-->
            <div class="container">
                <nav class="navbar navbar-default">

                    <!--<div class="row">-->
                    <div class="col-xs-0 col-sm-4 col-md-4 col-lg-4 visible-lg visible-md visible-sm">
                        <span class="glyphicon glyphicon-grain" style="margin-left: 30px;font-size: 60px"/>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <div class="visible-lg visible-md visible-sm"
                             <br>
                            <br>
                            <ul class="lista_menu">
                                <li class="item_menu"><a href="../">Inicio</a></li>
                                <li class="item_menu">|</li>
                                <li class="item_menu" ><a href="#">¿Quiénes somos?</a></li>
                                <li class="item_menu">|</li>
                                <li class="item_menu"><a href="#">Servicio</a></li>
                                <li class="item_menu">|</li>
                                <li class="item_menu" ><a href="#">Contacto</a></li>
                            </ul>
                        </div>
                        <div class="visible-xs">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-grain" style="color:black;margin-left: 30px;font-size: 30px"/></a>
                            </div>
                            <ul class="lista_menu">
                                <li class="item_menu_desplegable"><a href="#">Inicio</a></li>
                                <li class="item_menu_desplegable" ><a href="#">¿Quiénes somos?</a></li>
                                <li class="item_menu_desplegable"><a href="#">Servicio</a></li>
                                <li class="item_menu_desplegable" ><a href="#">Contacto</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--</div>-->
                    <!--</div>-->
                    <!--</div>-->
                </nav>
            </div>
        </header>
        <!--Inicio del cuerpo de la página-->
        <div class="container">
            <div class="row">
                <article class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <section class="col-lg-6  col-md-6 col-sm-6 col-xs-12">
                        <h2><font color="red">¡Ocurrió un error inesperado, contacta a los desarrolladores de la página e informa del error para que podamos corregirlo!</font></h2>
                        <hr><hr><hr>
                        <h3><font color="red"><?php
                            $tipo = $error + 100;
                            echo '¡error de tipo: !' . $tipo;
                            ?></font></h3>
                        <hr>
                        <a href="../pages/admin/admin.php"><button class="btn btn-warning">Volver al inicio</button></a>
                        <br><br><br><br><br><br><br>
                    </section>
            </div>  
        </div>
    </body>
</html>


