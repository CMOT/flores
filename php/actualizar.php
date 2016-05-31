<?php

include_once('Query.inc');
include_once('config.php');
include_once('conexion2.php');

$con = conConexion();

if (isset($_GET['userAc'])) {
    $idU= $_GET['userAc'];
    $nombre = $_POST['nom'];
    $apPat = $_POST['apPat'];
    $apMat = $_POST['apMat'];
    $correo = $_POST['correo'];
    $passwd = $_POST['passwd'];
    $tel = $_POST['telefono'];
    if (!empty($nombre) && !empty($apPat) && !empty($apMat) && !empty($correo) && !empty($tel) && !empty($passwd)) {

        $sql = 'UPDATE usuario set nombre="' . $nombre . '", ap_paterno="' . $apPat . '", ap_materno= "' . $apMat . '", correo="' . $correo . '", password="' . $passwd . '", telefono="' . $tel . '" where id_usuario='.$idU.'';
        $res = mysql_query($sql, $con);
        if ($res) {
            header("location:../pages/admin/usuarios.php");
        } else {
            header("location:errores.php?error=80");
        }
    } else {
        
        header("location:../pages/admin/usuarios.php");
    }
}else{
    header("location:../pages/admin/usuarios.php");
    
}

