<?php

include_once('Query.inc');


function validarVacios($cadena) {
    return strlen($cadena) > 0;
}

function validarTamanio($cadena, $tamanio = 45) {

    return strlen($cadena) <= $tamanio;

}

function validarExpresion($cadena, $tipo) {
    $patron = '';
    switch ($tipo) {
        case 'e-mail':
            #Expresion e-mail
            break;
        case 'sn':
            #Solo numeros
            break;
        case 'sl':
            #Solo letras
            break;
        default:
            break;
    }
    return ($patron != '') ? preg_match($patron, $cadena) : true;
}

function validarScripts($cadena) {

    $sinEspaciosExtra = trim($cadena);
    $sinDiagonales = stripslashes($sinEspaciosExtra);
    $sinCaracteresEspeciales = htmlspecialchars($sinDiagonales);
    return $sinCaracteresEspeciales;
    
}
function validarUsuario($nombre1, $pass1){
    $valor=false;
    $var = new Query();

        $var->sql = 'select nombre, pass from usuarios1';
        $usuarios = $var->Select('obj');
        
            foreach($usuarios as $u){

                $nombre2 = $u->nombre;
                $pass2 = $u->pass;
                echo 'nombre: ' . $nombre2;
                echo 'contrasena '. $pass2;
                if($nombre2==$nombre1 and $pass2==$pass1 ){
                    
                }
            }

            return $valor;
}



?>