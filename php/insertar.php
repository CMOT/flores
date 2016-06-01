<?php

include_once('Query.inc');
include_once('config.php');
include_once('conexion2.php');


$con = conConexion();


if (isset($_GET['user'])) {
    $nombre = $_POST['nombre'];
    $apPat = $_POST['apPat'];
    $apMat = $_POST['apMat'];
    $correo = $_POST['correo'];
    $passwd = $_POST['passwd'];
    $tel = $_POST['telefono'];
    if (!empty($nombre) && !empty($tel)) {
        $sql = "INSERT INTO usuario(nombre, ap_paterno, ap_materno, correo, password, telefono, rol) values ('$nombre','$apPat','$apMat', '$correo', '$passwd', '$tel', 'usuario')";

        $res = mysql_query($sql, $con);
        if ($res) {
            header("location:../pages/admin/usuarios.php");
        } else {
            header("location:errores.php?error=10");
        }
    } else {
        header("location:../pages/admin/usuarios.php");
    }
} else if ($_GET['flor']) {
    
    $costo = $_POST['costo'];
    $nivel = $_POST['nivel'];
    if (!empty($costo)) {
        $sql = "INSERT INTO flor( costo, tipo) values ( $costo,$nivel)";

        $res = mysql_query($sql, $con);
        if ($res) {
            header("location:../pages/admin/flores.php");
        } else {
            header("location:errores.php?error=20");
        }
    }
} else if ($_GET['fuera']) {
    $nombre = $_POST['nombre'];
    $apPat = $_POST['apPat'];
    $apMat = $_POST['apMat'];
    $correo = $_POST['correo'];
    $passwd = $_POST['passwd'];
    $passwd2 = $_POST['rePass'];
    $tel = $_POST['tel'];
    $rol = 'usuario';

    if (!empty($nombre) && !empty($apPat) && !empty($apMat) && !empty($correo) && !empty($tel) && !empty($passwd) && !empty($passwd2)) {

        if ($passwd == $passwd2) {
            $sql = "INSERT INTO usuario(nombre, ap_paterno, ap_materno, correo, password, telefono, rol) values ('$nombre','$apPat','$apMat', '$correo', '$passwd', '$tel', '$rol')";
            $res = mysql_query($sql, $con);
            if ($res) {
                header("location:../pages/iniciar_sesion.php?error=2");
            } else {
                header("location:errores.php?error=100");
            }
        } else {
            header("location:../pages/iniciar_sesion.php?error=1");
        }
    } else {
        header("location:../pages/iniciar_sesion.php?error=3");
    }
}else if ($_GET['admon']) {
    $nombre = $_POST['nombre'];
    $apPat = $_POST['apPat'];
    $apMat = $_POST['apMat'];
    $correo = $_POST['correo'];
    $passwd = $_POST['passwd'];
    $tel = $_POST['tel'];
    $rol = 'admin';

    if (!empty($nombre) && !empty($tel) ) {

        
            $sql = "INSERT INTO usuario(nombre, ap_paterno, ap_materno, correo, password, telefono, rol) values ('$nombre','$apPat','$apMat', '$correo', '$passwd', '$tel', '$rol')";
            $res = mysql_query($sql, $con);
            if ($res) {
                header("location:../pages/admin/usuarios.php");
            } else {
                header("location:errores.php?error=410");
            }
        

    } else {
        header("location:../pages/admin/usuarios.php");
    }
}else{
    header("location:../pages/admin/usuarios.php");
    
}


