<?php
//include_once '../../php/consultas.php';
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
        <link rel="stylesheet" href="../css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../css/estilos.css"/>
        <script src="../js/jquery.js"></script>
        <script  src="../js/bootstrap.min.js"></script>

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
                                <li><a href="../php/cerrarSesion.php">Cerrar sesión</a></li>
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
                        <a href="../php/cerrarSesion.php">Cerrar Sesión</a>
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
                        <li role="presentation"><a href="../pages/admin/admin.php">Estadisticas <!--<span class="badge">42</span>--></a></li>
                        <li role="presentation" class="active"><a href="../pages/admin/usuarios.php">Usuarios</a></li>
                        <ul >
                            <li role="presentation" ><a  href="../pages/admin/usuarios.php">ACTIVOS</a></li>
                            <li role="presentation"><a href="../pages/admin/usuariosInactivos.php">INACTIVOS</a></li>
                            <li role="presentation"><a href="#" >Agregar usuarios</a></li>
                            <?php if ($_SESSION['rol'] == 'root') { ?>
                                <li role="presentation"><a href="agregarAdmins.php">Agregar admins</a></li>
                            <?php } ?>
                        </ul>
                        <li role="presentation"><a href="../pages/admin/flores.php">Flores<!--<span class="badge">3</span>--></a></li>
                    </ul>
                </section>
            </article>
            <article class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                <section class="col-lg-6">
                    <form class="form-horizontal" action="../php/insertar.php?user=1" method="POST">
                        <div class="form-group">
                            <h2>Agrega un usuario nuevo</h2>
                            <label for="inputNombre" class="col-sm-3 control-label">Primer nombre:</label>*
                            <div class="col-sm-9">
                                <input type="text" name="nombre" class="form-control" id="inputNombre" placeholder="Primer nombre">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputApPat" class="col-sm-3 control-label">Apellido paterno:</label>
                            <div class="col-sm-9">
                                <input type="text" name="apPat" class="form-control" id="inputApPat" placeholder="Apellido paterno">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputApMat" class="col-sm-3 control-label">Apellido Materno:</label>
                            <div class="col-sm-9">
                                <input type="text" name="apMat" class="form-control" id="inputApMat" placeholder="Apellido materno">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputCorreo" class="col-sm-3 control-label">Correo:</label>
                            <div class="col-sm-9">
                                <input type="email" name="correo" class="form-control" id="inputCorreo" placeholder="Correo Electrónico">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPasswd" class="col-sm-3 control-label">Contraseña:</label>
                            <div class="col-sm-9">
                                <input type="password" name="passwd" class="form-control" id="inputPasswd" placeholder="Contraseña">
                            </div>
                        </div>
<!--                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Repetir contraseña</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="inputRePasswd" placeholder="Repetir contraseña" ng-blur="">
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label for="inputTelefono" class="col-sm-3 control-label">Telefono:</label>
                            <div class="col-sm-9">
                                <input type="tel" name="telefono" class="form-control" id="inputTelefono" placeholder="Telefono">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">Registrar</button>
                            </div>
                        </div>
                    </form>
                </section>
                <section class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            Agregar usando un archivo excel
                        </div>
                        <div class="panel-footer">
                            <form>
                                <div class="form-group">
                                    <label for="exampleInputFile">Elegir archivo</label>
                                    <input disabled="disabled" type="file" id="exampleInputFile">
                                    <p class="help-block">No disponible en esta versión</p>
                                </div>
                                <button disabled="disabled" type="submit" class="btn btn-success">Cargar</button>
                            </form>
                        </div>
                    </div>
                </section>
            </article>
        </div>
    </div>
    <br><br><br><br><br><br><br>
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




