<?php

function conConexion() {
    $servidor = "mysql.hostinger.mx";
    $usuario = "u529955960_cess";
    $clave = "nesskate123";

    $conexionServidor = mysql_connect($servidor, $usuario, $clave);
    mysql_select_db("u529955960_prod", $conexionServidor);
    return $conexionServidor;
}

function realizarConsulta($consultasql) {
    $conexion = $this->conConexion();
    $resultado = mysql_query($consultasql, $conexion);
    return $resultado;
}

?>