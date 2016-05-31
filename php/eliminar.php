<?php

include_once('conexion2.php');
include_once('config.php');

$con = conConexion();


if(isset($_GET['all'])){
    $id = $_GET['id'];
    $sql = 'DELETE FROM flor  WHERE id_flor='.$id.'';
    $res = mysql_query($sql, $con);
    if($res){
        header("location:../pages/admin/flores.php");
    }else{
        header("location:errores.php?error=50");
    }
}else if(isset($_GET['uss'])){
    $id= $_GET['id'];
    $sql = 'DELETE FROM usuario  WHERE id_usuario='.$id.'';
    $res = mysql_query($sql, $con);
    if($res){
        header("location:../pages/admin/usuarios.php");
    }else{
        header("location:errores.php?error=60");
    }
    
}else{
    header("location:../pages/admin/usuarios.php");
    
}

