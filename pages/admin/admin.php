<?php
include_once '../../php/consultas.php';
session_start();
if(isset($_SESSION['correo']) && $_SESSION['rol']=='admin' || $_SESSION['rol']=='root'){
    $nombre = $_SESSION['usuario'];
    $correo = $_SESSION['correo'];
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

        <script src="../../js/jquery.js"></script>
        <script  src="../../js/bootstrap.min.js"></script>

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
                        <li role="presentation" class="active"><a href="#">Estadisticas <!--<span class="badge">42</span>--></a></li>
                        <li role="presentation"><a href="usuarios.php">Usuarios</a></li>
                        <li role="presentation"><a href="flores.php">Flores<!--<span class="badge">3</span>--></a></li>
                    </ul>
                </section>


            </article>
            <article class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                <section>
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <p>Usuarios </p>
                        </div>
                        <div class="panel-footer">
                            <h4>Actualmente hay <?php echo cantidadUsuarios(); ?> usuarios registrados.</h4>
                            <a href="../../forms/agregarUsuarios.php"><button class="btn btn-primary">Vamos a registrar usuarios</button></a>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <p>Flores </p>
                        </div>
                        <div class="panel-footer">
                            <h4>Actualmente hay <?php echo cantidadFlores(); ?> flores registradas y activas.</h4>
                            <a href="../../forms/agregarFlores.php"><button class="btn btn-primary">Dar de alta una flor</button></a>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <p>Actividad de usuarios </p>
                        </div>
                        <div class="panel-footer">
                            <h4>Actualmente hay <?php
                                $cant = cantidadInactivos();
                                echo $cant;
                                if ($cant == 1) {
                                    echo ' usuario inactivo';
                                } else {
                                    echo ' usuarios que estan inactivos';
                                }
                                ?>.</h4>
                            <a href="usuariosInactivos.php"><button class="btn btn-primary">Mirar quienes son</button></a>
                        </div>
                    </div>
                </section>



            </article>


        </div>
    </div>
    <!--Inicia el footer de la página-->
    <!--    <footer>
            <div class="container">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <h4>¡Contactanos!</h4>
                    <hr>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing 
                    </p>
                    <h3>Llama ahora y cuentanos tus dudas al 01-800-510-2424</h3>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <h4>¡Preguntas frecuentes!</h4>
                    <hr>
                    <ul>
                        <li><a href="#">Porque</a></li>
                        <li><a href="#">Como</a></li>
                        <li><a href="#">DOnde</a></li>
    
                    </ul>
    
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <h4>Informacion Legal</h4>
                    <hr>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing 
                        elit, sed do eiusmod tempor incididunt ut labore et 
                        dolore magna aliqua. Ut enim ad minim veniam, quis 
    
                    </p>
                </div>
            </div>
        </footer>-->
</body>
</html>



