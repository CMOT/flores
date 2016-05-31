<?php

session_start();
if (isset($_SESSION['usuario'])) {

    unset($_SESSION['usuario']);
    unset($_SESSION['rol']);
    unset($_SESSION['usuario']);
    unset($_SESSION['id']);
    session_unset();
    session_destroy();
}
header("location:../index.php");
?>