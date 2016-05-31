<?php

include_once('Query.inc');
include_once('config.php');
include_once('conexion2.php');

$con = conConexion();

if (isset($_REQUEST['petalos'])) {
    $idUsuario = $_REQUEST['id'];
    $idFU = $_REQUEST['idFU'];
    $nivel = $_REQUEST['nivel'];
    $idFlor = $_REQUEST['idFlor'];
    $petalos = $_REQUEST['petalos'];

    $sql = "INSERT INTO flor_usuario(id_usuario, id_flor, nivel) values ($idUsuario,$idFlor, $nivel)";
    $res = mysql_query($sql, $con);
    if ($res == 1) {
        if ($idFU != -1) {

            $sql2 = "INSERT INTO invitado( id_usuario, id_flor_usuario, tipo_invitado) values ($idUsuario,$idFU,'Persona')";
            $res2 = mysql_query($sql2, $con);
            if($res2==0){
                header("location:errores.php?error=320");
            }
        }
        
        header("location:../pages/admin/flor_info.php?id=$idFlor&niveles=$petalos");
    }else{
        header("location:errores.php?error=310");
    }
    echo '        ' . $idUsuario . ' en la flor_usuario: ' . $idFU . ' en el nivel: ' . $nivel;
//    $sql = "INSERT INTO grupos(nombre) values ('$grupoN')";
//    $res = mysql_query($sql, $con);
} else if (isset($_REQUEST['act'])) {
    $idFU = $_REQUEST['idFU'];
    $id = $_REQUEST['id'];
    $idFlor =$_REQUEST['idFlor'];
    $petalos= $_REQUEST['niveles'];
    $sql = "UPDATE flor_usuario set id_usuario=$id where id_flor_usuario=$idFU";
    $res = mysql_query($sql, $con);
    if($res){
        header("location:../pages/admin/flor_info.php?id=$idFlor&niveles=$petalos");
    }else{
         header("location:../errores.php?error=330");
    }
}else if(isset($_REQUEST['pagos'])) {
    $idFU = $_GET['idFU'];
    $petalos  =$_GET['petalos2'];
    $idFlor = $_GET['idFlor'];
    $pagos = $_GET['pagos'];
    $sql = "UPDATE flor_usuario set estatus=$pagos where id_flor_usuario=$idFU";
    $res = mysql_query($sql, $con);
    if($res){
         header("location:../pages/admin/flor_info.php?id=$idFlor&niveles=$petalos");
    }else{
        echo 'script  '. $sql;
        
        
    }
    
}else if(isset ($_GET['fin'])){
    $idFlor = $_GET['idFlor'];
    $petalos = $_GET['niv'];
    $sql = "UPDATE flor set estatus='Finalizada' where id_flor=$idFlor";
    $res = mysql_query($sql, $con);
    if($res){
         header("location:../pages/admin/flor_info.php?id=$idFlor&niveles=$petalos");
    }else{
        header("location:errores.php?error=350");
        
    }
}


