<?php

session_start();
include_once('../php/validaciones.php');
include_once('../php/Query.inc');


$correo = validarScripts($_POST['correo']);
$pass = validarScripts($_POST['passwd']);

if (strlen($correo) > 0 ) {

    $var = new Query();
//    $prefijo = substr($correo, 0, 3); // devuelve las primeras 3 letras
    echo $correo;
    echo $pass;
    $var->sql = 'select id_usuario,ap_paterno, ap_materno, correo, nombre, password, rol from usuario where correo="' . $correo . '" and password="' . $pass . '"';
    $usuarios = $var->Select('obj');
    if (!empty($usuarios)) {
        foreach ($usuarios as $u) {
            $passwd = $u->password;
            $correo2 = $u->correo;
            $id = $u->id_usuario;
            $nombre = $u->nombre;
            $apPat = $u->ap_paterno;
            $apMat = $u->ap_materno;
            $rol = $u->rol;
            if ($rol == 'admin' || $rol == 'root' ) {
                $_SESSION['id'] = $id;
                $_SESSION['usuario'] = $nombre . ' ' . $apPat . ' ' . $apMat;
                $_SESSION['correo'] = $correo;
                $_SESSION['rol'] = $rol;
                header('location:admin/admin.php');
                
            } else {
                header('location:iniciar_sesion.php?error=10');
            }
        }
    } else {
        header('location:iniciar_sesion.php?error=8');
    }
} else {

    header('location:iniciar_sesion.php?error=6');
}
?>
