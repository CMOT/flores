<?php
include_once '../../php/consultas.php';
session_start();

if(isset($_SESSION['correo']) && $_SESSION['rol']=='admin' || $_SESSION['rol']=='root' && isset($_GET['id'])){
    $nombre = $_SESSION['usuario'];
    $correo = $_SESSION['correo'];
    $idUs = $_GET['id'];
}else{
    header('location:../index.php');
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no ,initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Index</title>
        <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
        <!--<link rel="stylesheet" href="css/bootstrap-theme.min.css">-->
        <link rel="stylesheet" href="../../css/estilos.css"/>
        <link rel="stylesheet" href="../../js/datatables/media/css/jquery.dataTables.css"/>

        <script src="../../js/jquery.js"></script>
        <script  src="../../js/bootstrap.min.js"></script>
        <!--<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>-->
        <script src="../../js/datatables/media/js/jquery.dataTables.js"></script>

    </head>
    <body>

        <header>
            <div class="container">
                <div class="row login">
                    <!--<div class="col-xs-12">-->
                    <div class="visible-xs log" >
                        <!-- Split button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-info"><?php echo 'Usuario:' . $nombre ?></button>
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="../../php/cerrarSesion.php">Cerrar sesión</a></li>
                            </ul>
                        </div>
                        <!--</div>-->
                    </div>
                    <!--<div class="col-xs-0 col-sm-12 col-md-12 col-lg-12">-->
                    <div class="visible-lg visible-md visible-sm log">
                        <a href="#"><?php echo 'Usuario:' . $nombre ?></a>
                        <!--|-->
                        <!--<a href="#">Login</a>-->
                        |
                        <a href="../../php/cerrarSesion.php">Cerrar Sesión</a>
                    </div>
                    <!--</div>-->
                </div>
                <!--</div>-->
                <!--Barra de navegación-->
                <nav class="navbar navbar-default">
                    <!--<div class="container">-->
                    <div class="row">
                        <div class="col-xs-0 col-sm-4 col-md-4 col-lg-4 visible-lg visible-md visible-sm">
                            <span class="glyphicon glyphicon-grain" style="margin-left: 30px;font-size: 60px"/>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <div class="visible-lg visible-md visible-sm"
                                 <br>
                                <br>
                                <ul class="lista_menu">
                                    <li class="item_menu"><a href="#">Inicio</a></li>
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
                    </div>
            </div>
        </nav>
    </header>
    <!--Inicio del cuerpo de la página-->
    <div class="container">
        <div class="row">
            <article class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <section>
                    <ul class="nav nav-pills nav-stacked">
                    <li role="presentation"><a href="admin.php">Estadisticas <!--<span class="badge">42</span>--></a></li>

                        <li role="presentation" class="active"><a href="usuarios.php">Usuarios</a></li>
                        <ul>
                            <li><a href="../../forms/agregarUsuarios.php">Agregar usuarios</a></li>
                        </ul>
                        <li role="presentation"><a href="flores.php">Flores<!--<span class="badge">3</span>--></a></li>
                    </ul>
                </section>
            </article>
            <article class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                <section>
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            Información del usuario
                        </div>
                        <div class="panel-body">
                            <h3>Datos del usuario</h3>
                        </div>

                        <!-- Table -->

                        <table class="table">
                            <thead>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            </thead>
                            <tbody>

                                <?php echo getUsuarioId($idUs) ?>

                            </tbody>

                        </table>
                        <div class="panel-body">
                            <h3>Flores en las que esta registrado</h3>
                        </div>
                        <table  class="table">
                            <thead>
                            <th>ID</th>
                            <th>Costo</th>
                            <th>Fecha de creación</th>
                            <th>TIpo</th>
                            <th>Nivel actual en la flor</th>
                            <th>Estatus de la flor</th>
                            <th>Operaciones</th>
                            </thead>
                            <tbody>

                                <?php echo getUsuarioInfo($idUs) ?>

                            </tbody>

                        </table>
                    </div>
                </section>
            </article>
        </div>
    </div>
</body>
<script>
    $(document).ready(function () {
        $('#tablaFlores').DataTable();
    });
</script>
</html>




