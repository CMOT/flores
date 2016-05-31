<?php

include_once('Query.inc');
include_once('config.php');
include_once('conexion2.php');

//session_start();

function cantidadUsuarios() {

    $var = new Query();
//    $var->sql = 'select id_usuario, correo, nombre, password, rol from usuario';
    $var->sql = 'select count(id_usuario) as cuenta from usuario';
//    $con = conConexion();
    $usuarios = $var->Select('obj');
    $cantidad = 0;
    if (!empty($usuarios)) {
        $cantidad = $usuarios[0]->cuenta;
    }
    return $cantidad;
}

function cantidadFlores() {

    $var = new Query();
//    $var->sql = 'select id_usuario, correo, nombre, password, rol from usuario';
    $var->sql = 'select count(id_flor) as cuenta from flor where estatus="Activa"';
//    $con = conConexion();
    $flores = $var->Select('obj');
    $cantidad = 0;
    if (!empty($flores)) {
        $cantidad = $flores[0]->cuenta;
    }
    return $cantidad;
}

function cantidadInactivos() {

    $var = new Query();
//    $var->sql = 'select id_usuario, correo, nombre, password, rol from usuario';
    $var->sql = 'SELECT count(id_usuario) as cuenta from usuario where estatus="Inactivo"';
//    $con = conConexion();
    $inactivos = $var->Select('obj');
    $cantidad = 0;
    if (!empty($inactivos)) {
        $cantidad = $inactivos[0]->cuenta;
    }
    return $cantidad;
}

function getUsuarios() {
    $tabla = '';
    $var = new Query();
//    $var->sql = 'select id_usuario, correo, nombre, password, rol from usuario';
    $var->sql = 'select id_usuario, password,correo, nombre, ap_paterno, ap_materno, telefono, rol ,estatus from usuario where estatus="Activo"';
//    $con = conConexion();
    $usuarios = $var->Select('obj');
//    $result = mysql_query($sql, $con);
    if (!empty($usuarios)) {

        foreach ($usuarios as $usuario) {
            $id = $usuario->id_usuario;
            $nombre = $usuario->nombre;
            $apPat = $usuario->ap_paterno;
            $apMat = $usuario->ap_materno;
            $correo = $usuario->correo;
            $telefono = $usuario->telefono;
            $passwd = $usuario->password;
            $rol = $usuario->rol;
            $estatus = $usuario->estatus;
            $tabla.= '<tr><td>' . $id . '</td><td>' . $nombre . ' ' . $apPat . ' ' . $apMat . '</td><td>' . $correo . '</td><td>' . $telefono . '</td><td>' . $estatus . '</td><td><a href="usuario_info.php?id=' . $id . '"><button class="btn btn-info">Ver info</button></a>';
            if ($_SESSION['rol'] == 'root') {
                $tabla.='<a href="../../forms/editaUsuario.php?id=' . $id . '&nom=' . $nombre . '&apPat=' . $apPat . '&apMat=' . $apMat . '&correo=' . $correo . '&tel=' . $telefono . '&passwd=' . $passwd . '"><button class="btn btn-warning">Editar</button></a><a href="../../php/eliminar.php?id=' . $id . '&uss=1"><button class="btn btn-danger">Eliminar</button></a></td></tr>';
            } else if ($_SESSION['rol'] == 'admin' && ($rol != 'admin' && $rol != 'root') || $id == $_SESSION['id']) {
                $tabla.='<a href="../../forms/editaUsuario.php?id=' . $id . '&nom=' . $nombre . '&apPat=' . $apPat . '&apMat=' . $apMat . '&correo=' . $correo . '&tel=' . $telefono . '&passwd=' . $passwd . '"><button class="btn btn-warning">Editar</button></a>';
            }
        }
    } else {
        $tabla = 'No hay usuarios registrados!!';
    }
    return $tabla;
}

function getUsuariosInactivos() {
    $tabla = '';
    $var = new Query();
//    $var->sql = 'select id_usuario, correo, nombre, password, rol from usuario';
    $var->sql = 'select id_usuario, password,correo, nombre, ap_paterno, ap_materno, telefono,rol, estatus from usuario where estatus="Inactivo"';
//    $con = conConexion();
    $usuarios = $var->Select('obj');
//    $result = mysql_query($sql, $con);
    if (!empty($usuarios)) {

        foreach ($usuarios as $usuario) {
            $id = $usuario->id_usuario;
            $nombre = $usuario->nombre;
            $apPat = $usuario->ap_paterno;
            $apMat = $usuario->ap_materno;
            $correo = $usuario->correo;
            $telefono = $usuario->telefono;
            $passwd = $usuario->password;
            $rol = $usuario->rol;
            $estatus = $usuario->estatus;
            $tabla.= '<tr><td>' . $id . '</td><td>' . $nombre . ' ' . $apPat . ' ' . $apMat . '</td><td>' . $correo . '</td><td>' . $telefono . '</td><td>' . $estatus . '</td><td><a href="usuario_info.php?id=' . $id . '"><button class="btn btn-info">Ver info</button></a>';
            if ($_SESSION['rol'] == 'root') {
                $tabla.='<a href="../../forms/editaUsuario.php?id=' . $id . '&nom=' . $nombre . '&apPat=' . $apPat . '&apMat=' . $apMat . '&correo=' . $correo . '&tel=' . $telefono . '&passwd=' . $passwd . '"><button class="btn btn-warning">Editar</button></a><a href="../../php/eliminar.php?id=' . $id . '&uss=1"><button class="btn btn-danger">Eliminar</button></a></td></tr>';
            } else if ($_SESSION['rol'] == 'admin' && ($rol != 'admin' && $rol != 'root') || $id == $_SESSION['id']) {
                $tabla.='<a href="../../forms/editaUsuario.php?id=' . $id . '&nom=' . $nombre . '&apPat=' . $apPat . '&apMat=' . $apMat . '&correo=' . $correo . '&tel=' . $telefono . '&passwd=' . $passwd . '"><button class="btn btn-warning">Editar</button></a>';
            }
        }
    } else {
        $tabla = 'No hay usuarios registrados!!';
    }
    return $tabla;
}

function getUsuariosArbol($idFU, $nivel, $idFlor, $petalos) {
    $tabla = '';
    $var = new Query();
    $var5 = new Query();
//    $var->sql = 'select id_usuario, correo, nombre, password, rol from usuario';
    $var->sql = 'select id_usuario, correo, nombre, ap_paterno, ap_materno, telefono from usuario';
    $var5->sql = 'select u.id_usuario from usuario u join flor_usuario a on(a.id_usuario=u.id_usuario)
    where a.id_flor=' . $idFlor . '';
//    $con = conConexion();
    $usuarios = $var->Select('obj');
    $ya = $var5->Select('obj');
//    $result = mysql_query($sql, $con);
    foreach ($usuarios as $usuario) {
        $colocar = true;
        $id = $usuario->id_usuario;
        $nombre = $usuario->nombre;
        $apPat = $usuario->ap_paterno;
        $apMat = $usuario->ap_materno;
        $correo = $usuario->correo;
        $telefono = $usuario->telefono;
        if (!empty($ya)) {
            foreach ($ya as $y) {
                $usuarioYa = $y->id_usuario;
                if ($usuarioYa == $id) {
                    $colocar = false;
                    break;
                }
            }
        }
        if ($colocar) {
            $tabla.= '<tr><td>' . $id . '</td><td>' . $nombre . ' ' . $apPat . ' ' . $apMat . '</td><td>' . $correo . '</td><td>' . $telefono . '</td><td><a href="../../php/operaciones_nivel.php?id=' . $id . '&idFU=' . $idFU . '&nivel=' . $nivel . '&idFlor=' . $idFlor . '&petalos=' . $petalos . '"><button class="btn btn-info">Colocar</button></a></td></tr>';
        }
    }
    return $tabla;
}

function getUsuariosArbolActualizar($idFU, $nivel, $idFlor) {
    $tabla = '';
    $var = new Query();
    $var7 = new Query();
//    $var->sql = 'select id_usuario, correo, nombre, password, rol from usuario';
    $var->sql = 'select id_usuario, correo, nombre, ap_paterno, ap_materno, telefono from usuario';
    $var7->sql = 'select u.id_usuario from usuario u join flor_usuario a on(a.id_usuario=u.id_usuario)
    where a.id_flor=' . $idFlor . '';
//    $con = conConexion();
    $usuarios = $var->Select('obj');
    $ya2 = $var7->Select('obj');
//    $result = mysql_query($sql, $con);
    foreach ($usuarios as $usuario) {
        $colocar = true;
        $id = $usuario->id_usuario;
        $nombre = $usuario->nombre;
        $apPat = $usuario->ap_paterno;
        $apMat = $usuario->ap_materno;
        $correo = $usuario->correo;
        $telefono = $usuario->telefono;
        if (!empty($ya2)) {
            foreach ($ya2 as $y) {
                $usuarioYa = $y->id_usuario;
                if ($usuarioYa == $id) {
                    $colocar = false;
                    break;
                }
            }
        }
        if ($colocar) {
            $tabla.= '<tr><td>' . $id . '</td><td>' . $nombre . ' ' . $apPat . ' ' . $apMat . '</td><td>' . $correo . '</td><td>' . $telefono . '</td><td><a href="../../php/operaciones_nivel.php?id=' . $id . '&idFU=' . $idFU . '&act=1&niveles=' . $nivel . '&idFlor=' . $idFlor . '"><button class="btn btn-info">Actualizar</button></a></td></tr>';
        }
    }
    return $tabla;
}

function getFlores() {
    $tabla2 = '';
    $var2 = new Query();
//    $var->sql = 'select id_usuario, correo, nombre, password, rol from usuario';
    $var2->sql = 'select id_flor, costo, fecha, tipo, estatus from flor';
//    $con = conConexion();
    $flores = $var2->Select('obj');
//    $result = mysql_query($sql, $con);
    if (!empty($flores)) {

        foreach ($flores as $flor) {
            $id = $flor->id_flor;
            $costo = $flor->costo;
            $fecha = $flor->fecha;
            $tipo = $flor->tipo;
            $estatus = $flor->estatus;
            $tabla2.= '<tr><td>' . $id . '</td><td>' . $costo . '</td><td>' . $fecha . '</td><td>' . $tipo . ' niveles</td><td>' . $estatus . '</td><td><a href="flor_info.php?id=' . $id . '&niveles=' . $tipo . '"><button class="btn btn-info">Ver info</button></a>';
            if ($_SESSION['rol'] == 'root') {
                $tabla2.='<a href="../../php/eliminar.php?id=' . $id . '&all=1"><button class="btn btn-danger">Eliminar</button></a></td></tr>';
            }
        }
    } else {
        $tabla2 = 'No hay flores registradas!!';
    }
    return $tabla2;
}

function getFlorId($idFlor) {
    $tabla2 = '';
    $var2 = new Query();
//    $var->sql = 'select id_usuario, correo, nombre, password, rol from usuario';
    $var2->sql = 'select id_flor, costo, fecha, tipo, estatus from flor where id_flor=' . $idFlor . '';
//    $con = conConexion();
    $flores = $var2->Select('obj');
//    $result = mysql_query($sql, $con);
    foreach ($flores as $flor) {
        $id = $flor->id_flor;
        $costo = $flor->costo;
        $fecha = $flor->fecha;
        $tipo = $flor->tipo;
        $estatus = $flor->estatus;
        $tabla2.= '<tr><td>' . $id . '</td><td>' . $costo . '</td><td>' . $fecha . '</td><td>' . $tipo . '</td><td>' . $estatus . '</td></tr>';
    }
    return $tabla2;
}

//function getFlorInfo($idFlor) {
//    $tabla2 = '';
//    $var2 = new Query();
////    $var->sql = 'select id_usuario, correo, nombre, password, rol from usuario';
//    $var2->sql = 'select id_flor, costo, fecha, tipo, estatus from flor where id_flor='.$idFlor.'';
////    $con = conConexion();
//    $flores = $var2->Select('obj');
////    $result = mysql_query($sql, $con);
//    foreach ($flores as $flor) {
//        $id = $flor->id_flor;
//        $costo = $flor->costo;
//        $fecha = $flor->fecha;
//        $tipo = $flor->tipo;
//        $estatus = $flor->estatus;
//        $tabla2.= '<tr><td>' . $id . '</td><td>' . $costo . '</td><td>' . $fecha . '</td><td>' . $tipo . '</td><td>' . $estatus . '</td></tr>';
//    }
//    return $tabla2;
//}
function getUsuarioId($idUser) {
    $tabla = '';
    $var = new Query();
//    $var->sql = 'select id_usuario, correo, nombre, password, rol from usuario';
    $var->sql = 'select id_usuario,correo, nombre, ap_paterno, ap_materno, telefono from usuario where id_usuario=' . $idUser . '';
//    $con = conConexion();
    $usuarios = $var->Select('obj');
//    $result = mysql_query($sql, $con);
    foreach ($usuarios as $usuario) {
        $id = $usuario->id_usuario;
        $nombre = $usuario->nombre;
        $apPat = $usuario->ap_paterno;
        $apMat = $usuario->ap_materno;
        $correo = $usuario->correo;
        $telefono = $usuario->telefono;
        $tabla.= '<tr><td>' . $id . '</td><td>' . $nombre . ' ' . $apPat . ' ' . $apMat . '</td><td>' . $correo . '</td><td>' . $telefono . '</td></tr>';
    }
    return $tabla;
}

function getUsuarioInfo($idUser) {
    $tabla = '';
    $var = new Query();
    $var->sql = 'select u.id_usuario, f.id_flor, f.costo, f.fecha as fecha_flor, f.tipo, i.id_flor_usuario, i.nivel, i.fecha as fecha_nivel,
        f.estatus from usuario u join flor_usuario i on(u.id_usuario = i.id_usuario) 
        join flor f on(i.id_flor = f.id_flor) where u.id_usuario=' . $idUser . '';
    $usuarios = $var->Select('obj');
    if (!empty($usuarios)) {
        foreach ($usuarios as $usuario) {
            $idUsuario = $usuario->id_usuario;
            $id = $usuario->id_flor;
            $costo = $usuario->costo;
            $fechaFlor = $usuario->fecha_flor;
            $tipo = $usuario->tipo;
            $nivel = $usuario->nivel;
            $idFU = $usuario->id_flor_usuario;
            $estatus = $usuario->estatus;
            $tabla.= '<tr><td><a href="flor_info.php?id=' . $id . '&niveles=' . $tipo . '">' . $id . '</a></td><td>' . $costo . '</td><td>' . $fechaFlor . '</td><td>' . $tipo . ' niveles</td><td>' . $nivel . '</td><td>' . $estatus . '</td>
            <td><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#invitados' . $idFU . '" aria-expanded="false" aria-controls="invitados">
             Información adicional </button></td></tr>';
            $tabla.='<tr ><td colspan="5"><div class="collapse" id="invitados' . $idFU . '">
            <div class="well"><h4>Invitados</h4><br>' . consultaInvitados($idUsuario, $idFU) . '</div></div></td></tr>';
        }
    } else {
        $tabla.='<tr><td colspan="4"><h3><a href="">Actualmente no esta registrado en alguna flor activa</a></h3></td></tr>';
    }
    return $tabla;
}

function consultaInvitados($idUsuario, $idFU) {
    $invitados = '';
    $contador = 1;
    $var = new Query();
    $var->sql = 'select  o.id_usuario,o.nombre, o.ap_paterno, o.ap_materno, o.correo, o.telefono from usuario u join flor_usuario i on(u.id_usuario = i.id_usuario)
            join flor f on(i.id_flor = f.id_flor) join invitado n on(n.id_flor_usuario = i.id_flor_usuario)
            join usuario o on(o.id_usuario=n.id_usuario) where u.id_usuario =' . $idUsuario . ' and i.id_flor_usuario=' . $idFU . '';
    $resultado = $var->select('obj');
    if (!empty($resultado)) {
        foreach ($resultado as $invitado) {
            $id = $invitado->id_usuario;
            $nombre = $invitado->nombre;
            $apPat = $invitado->ap_paterno;
            $apMat = $invitado->ap_materno;
            $correo = $invitado->correo;
            $telefono = $invitado->telefono;
            $invitados.=$contador . '.- Nombre: <a href="usuario_info.php?id=' . $id . '">' . $nombre . ' ' . $apPat . ' ' . $apMat . '</a> Correo Electrónico: <font color="green">' . $correo . '</font> Telefono: <font color="green">' . $telefono . '</font> <br>';
            $contador++;
        }
    } else {
        $invitados.='Este usuario no tiene invitados en esta flor';
    }
    return $invitados;
}

//select u.id_usuario, u.correo, u.nombre, u.ap_paterno, u.ap_materno, u.telefono, i.id_flor_usuario,
// f.id_flor, f.costo, f.fecha as fecha_flor, f.tipo, i.nivel, i.fecha as fecha_nivel, n.id_invitado, n.id_usuario, n.tipo_invitado, o.nombre, o.correo, o.telefono
//from usuario u join flor_usuario i on(u.id_usuario = i.id_usuario)join flor f on(i.id_flor = f.id_flor)
//join invitado n on(n.id_flor_usuario = i.id_flor_usuario)
//join usuario o on(o.id_usuario=n.id_usuario) where u.id_usuario = 1

//SELECT count(i.id_flor_usuario) FROM usuario u join flor_usuario i on(u.id_usuario=i.id_usuario) where u.id_usuario=1