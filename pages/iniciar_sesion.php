<?php
session_start();
//if (isset($_SESSION['usuario'])) {
//    header('location:pages/redireccion.php');
//}
if(isset($_SESSION['correo']) && ($_SESSION['rol']=='admin' && $_SESSION['rol']=='root')){
    $nombre = $_SESSION['usuario'];
    $correo = $_SESSION['correo'];
    header('location:pages/admin/admin.php');
}
$error = 0;
if (isset($_GET['error'])) {
    $error = $_GET['error'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no ,initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Index</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css"/>
        <!--<link rel="stylesheet" href="css/bootstrap-theme.min.css">-->
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
                                <button type="button" class="btn btn-info">Iniciar sesión</button>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-0 col-sm-12 col-md-12 col-lg-12">
                        <div class="visible-lg visible-md visible-sm log">
                            <a href="iniciar_sesion.php">Iniciar Sesión</a>
                            |
                            <!--                            <a href="#">Login</a>
                                                        |-->
                            <a href="iniciar_sesion.php">Registrarse</a>
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
                        <h3>¡Inicia sesión con tu correo!</h3>
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Correo electrónico</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="correo" placeholder="Correo">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contraseña</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="passwd" placeholder="Contraseña">
                            </div>
                           
                            <button type="submit" class="btn btn-success">Ingresar</button>
                        </form>
                        <h3><font color="red"><?php if($error==10){echo '¡Solo los administradores pueden acceder!';}?></font></h3>
                        <h3><font color="red"><?php if($error==8){echo '¡El correo o la contraseña no coinciden!';}?></font></h3>
                        <h3><font color="red"><?php if($error==6){echo '¡Relleno los campos vacíos!';}?></font></h3>
                        <h1><font color="green"><?php if($error==2){echo '¡Usuario registrado con exito!';}?></font></h1>
                        
                        
                    </section>
                    <section class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        
                        <h3>¡Si no tienes una cuenta registrate!</h3>
                        <form action="../php/insertar.php?fuera=1" method="POST">
                            <h4><font color="red"><?php if($error==3){echo 'Rellene los campos vacíos';}?></font></h4>
                            <div class="form-group">
                                <label for="exampleInputNombre">Primer nombre</label>
                                <input disabled="disabled" type="text" name="nombre" class="form-control" id="exampleInputNombre" placeholder="Primer nombre">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputApellidop">Apellido paterno</label>
                                <input disabled="disabled" type="text" name="apPat" class="form-control" id="exampleInputApellidop" placeholder="Apellido paterno">
                            </div>
                             <div class="form-group">
                                <label for="exampleInputApellidom">Apellido paterno</label>
                                <input disabled="disabled" type="text" name="apMat" class="form-control" id="exampleInputApellidom" placeholder="Apellido materno">
                            </div>
                            <div class="form-group">
                                <label for="inputCorreo">Correo electrónico</label>
                                <input disabled="disabled" type="email" name="correo" class="form-control" id="InputCorreo" placeholder="Correo electrónico">
                            </div>
                            <div class="form-group">
                                <label><font color="red"><?php if($error==1){echo 'Las contraseñas no coinciden';}?></font></label>
                                <label for="passwd" >Contraseña</label>
                                <input disabled="disabled" type="password" name="passwd" class="form-control" id="passwd" placeholder="Contraseña">
                                
                            </div>
                            <div class="form-group">
                                <label for="repetirPasswd">Repetir contraseña</label>
                                <input disabled="disabled" type="password" name="rePass" class="form-control" id="repetirPasswd" placeholder="Repetir contraseña">
                            </div>
                             <div class="form-group">
                                <label for="exampleInputPassword2">Telefono</label>
                                <input disabled="disabled" type="text" name="tel" class="form-control" id="telefono" placeholder="Telefono">
                            </div>
                             
                            <button disabled="disabled" type="submit" class="btn btn-warning">Registrarse</button>
                        </form>
                    </section>

                </article>

                <article class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <section>
                        <h3>!Si entramos todos, ganamos todos!</h3>
                        <p>

                            Lorem ipsum dolor sit amet, consectetur adipisicing 
                            elit, sed do eiusmod tempor incididunt ut labore et 
                            dolore magna aliqua. Ut enim ad minim veniam, quis 
                            nostrud exercitation ullamco laboris nisi ut aliquip 
                            ex ea commodo consequat. Duis aute irure dolor in 
                            reprehenderit in voluptate velit esse cillum dolore eu 

                        </p>
                        <button disabled="disabled" class="btn btn-info">Quiero registrar una flor</button>
                    </section>
                    <hr>
                    <section>
                        <h3>!Si entramos todos, ganamos todos!</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing 
                            elit, sed do eiusmod tempor incididunt ut labore et 
                            dolore magna aliqua. Ut enim ad minim veniam, quis 
                            nostrud exercitation ullamco laboris nisi ut aliquip 
                            ex ea commodo consequat. Duis aute irure dolor in 
                            reprehenderit in voluptate velit esse cillum dolore eu 

                        </p>
                        <button disabled="disabled" class="btn btn-info">Quiero apoyar</button>
                    </section>
                </article>
            </div>
        </div>
        <hr noshade>
        <!--Empieza el footer-->
        <footer>
            <div class="container">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <h4>¡Contactanos!</h4>
                    <hr>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing 
                    </p>
                    <!--<h3>Llama ahora y cuentanos tus dudas</h3>-->
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
        </footer>
    </body>
</html>
