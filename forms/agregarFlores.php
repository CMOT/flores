<?php
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
                        <li role="presentation" ><a href="../pages/admin/usuarios.php">Usuarios</a></li>
                        
                        <li role="presentation" class="active"><a href="../pages/admin/flores.php">Flores<!--<span class="badge">3</span>--></a></li>
                        <ul >
                            <li role="presentation"><a href="#" >Agregar Flores</a></li>
                        </ul>
                    </ul>
                </section>
            </article>
            <article class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                <section class="col-lg-6">
                    <form class="form-horizontal" action="../php/insertar.php?flor=1" method="POST">
                        <div class="form-group">
                            <label for="inputCosto" class="col-sm-3 control-label">Costo:</label>
                            <div class="col-sm-9">
                                <input type="text" name="costo" class="form-control" id="inputCosto" placeholder="Costo">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Niveles</label>
                            <div class="col-sm-9">
                                <select size="1" name="nivel" class="control" >
                                    <option value="3">3 niveles</option>
                                    <option value="4">4 niveles</option>
                                </select>
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

</body>

</html>


