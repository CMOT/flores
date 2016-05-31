<?php

include_once('Query.inc');
include_once('config.php');
include_once('conexion2.php');
include_once('consultas.php');

//session_start();

class Flor {

    public $idFlor;
    public $petalos;
    private $query;
    private $t1, $t2, $t3, $t4;
    private $contador2;
    private $idFUAnterior;
    private $contadorPagos;
    private $terminada;
    private $conta;

//    $var->sql = 'select id_usuario, correo, nombre, password, rol from usuario';
//    $var->sql = 'select id_usuario, correo, nombre, ap_paterno, ap_materno, telefono from usuario';
//    $con = conConexion();
//    $tabla = '';
//    $var = new Query();
//    $var->sql = 'select id_usuario, correo, nombre, ap_paterno, ap_materno, telefono from usuario';
//    $usuarios = $var->Select('obj');
    public function __construct($idFlor, $petalos) {

        $this->idFlor = $idFlor;
        $this->petalos = $petalos;
        $this->query = new Query();
        $this->contador2 = 0;
        $this->idFUAnterior = -1;
        $this->contadorPagos = 0;
        $this->conta=2;
//        $this->resultado= $this->query->Select('obj');
    }

    function hacerPago($estatus, $nivel, $idFU) {
        $pagos = '';
        if (($this->petalos == 3 && $nivel == 3) || ($this->petalos == 4 && $nivel == 4)) {
            if ($estatus == 0) {
                $pagos = '<a href="../../php/operaciones_nivel.php?idFU=' . $idFU . '&idFlor=' . $this->idFlor . '&petalos2=' . $this->petalos . '&pagos=1"><button class="btn btn-success"><span class="glyphicon glyphicon-usd"></span></button></a>';
            } else {
                $pagos = '<a href="../../php/operaciones_nivel.php?idFU=' . $idFU . '&idFlor=' . $this->idFlor . '&petalos2=' . $this->petalos . '&pagos=0"><button class="btn btn-danger"><span class="glyphicon glyphicon-usd"></span></button></a>';
            }
        }
        return $pagos;
    }

    function terminarFlor() {
        $footer = '';
        if ($this->terminada != 'Finalizada') {


            if (($this->contadorPagos == 4 && $this->petalos == 3 ) || ($this->contadorPagos == 8 && $this->petalos == 4)) {

                $footer.='<a href="../../php/operaciones_nivel.php?fin=1&idFlor=' . $this->idFlor . '&niv=' . $this->petalos . '"><button class="btn btn-success">Terminar flor <span class="glyphicon glyphicon-saved"></span></button></a>';
                $footer.='Una ves finalizada la flor no podrás hacer cambios, pero aun podrás ver el registro en la sección de flores';
            } else {

                $footer.='<a href="#"><button disabled="disabled" class="btn btn-success">Terminar flor <span class="glyphicon glyphicon-saved"></span></button></a>';
            }
        }
        $footer.='<hr><hr><hr>';
        return $footer;
    }

    function obtenerModal($idFU, $nivel) {
        $this->conta++;
//        if($idFU==-1){
        $modal = '<div class="modal fade" id="myModal' . $idFU . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Elegir usuario</h4>
                        </div>
                        <div class="modal-body">
                          <table id="example'.$this->conta.''.$idFU.'" class="table display">
                            <thead>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            <th>Opciones</th>
                            </thead>
                            <tbody>
                                ' . getUsuariosArbol($idFU, $nivel, $this->idFlor, $this->petalos) . '
                            </tbody>
                        </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <script>
                    $(document).ready(function () {
                        $("#example'.$this->conta.''.$idFU.'").DataTable();
                    });
                    </script>';
//        }
        return $modal;
    }

    function obtenerModalActualizar($idFU) {
//        if($idFU==-1){
        $modal = '<div class="modal fade" id="myModal' . $this->petalos . '' . $idFU . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Elegir usuario</h4>
                        </div>
                        <div class="modal-body">
                          <table id="example2'.$idFU.'" class="table display">
                            <thead>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            <th>Opciones</th>
                            </thead>
                            <tbody>
                                ' . getUsuariosArbolActualizar($idFU, $this->petalos, $this->idFlor) . '
                            </tbody>
                        </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <script>
                    $(document).ready(function () {
                        $("#example2'.$idFU.'").DataTable();
                    });
                    </script>';
//        }
        return $modal;
    }

    function primerNivel() {

        $this->t1 = '<table class="table">
                    <thead><th><center>Nivel 1</center></th></thead><tbody>';
        $this->query->sql = 'select u.id_usuario, u.telefono ,u.correo, u.nombre,u.ap_paterno, u.ap_materno, n.id_flor_usuario, p.estatus from usuario u join flor_usuario n on(u.id_usuario=n.id_usuario) join flor p on(n.id_flor=p.id_flor) where n.id_flor=' . $this->idFlor . ' and n.nivel=1';
        $resultado = $this->query->select('obj');
        if (!empty($resultado)) {
            $id = $resultado[0]->id_usuario;
            $idFU = $resultado[0]->id_flor_usuario;
            $nombre = $resultado[0]->nombre;
            $apPat = $resultado[0]->ap_paterno;
            $apMat = $resultado[0]->ap_materno;
            $correo = $resultado[0]->correo;
            $tel = $resultado[0]->telefono;
            $this->terminada = $resultado[0]->estatus;


            $this->idFUAnterior = $idFU;
            $this->t1.='<tr><td><center>Nombre <a href="usuario_info.php?id=' . $id . '">' . $nombre . ' ' . $apPat . ' ' . $apMat . '</center></a></td></tr>';
//                    . '<tr><td><center><button class="btn btn-info">Ver datos</button></center></td></tr>';
            if ($this->terminada != 'Finalizada') {
                $this->t1 .= '<tr><td><center><button class="btn btn-info" type="button" data-toggle="collapse" data-target="#datos' . $id . '" aria-expanded="false" aria-controls="datos">
             <span class="glyphicon glyphicon-search"></span></button><button class="btn btn-warning" type="button" data-toggle="modal" data-target="#myModal' . $this->petalos . '' . $idFU . '"><a href="#"><span class="glyphicon glyphicon-pencil"></span></a></button>
             </center></td></tr>';
            }
            $this->t1.='<tr ><td><div class="collapse" id="datos' . $id . '">
            <div class="well"><h4>Datos del usuario</h4>Correo electrónico: ' . $correo . '<br>Telefono: ' . $tel . '</div></div></td></tr>';
            $this->t1.='</tbody></table>';
            $this->t1.=$this->obtenerModalActualizar($idFU);
            $this->consultaInvitados($id, $idFU, 2);
        } else {
            $this->t1.='<tr><td><center><span class="glyphicon glyphicon-ban-circle"></span></center></td></tr>'
                    . '<tr><td><center><button class="btn btn-info" data-toggle="modal" data-target="#myModal-1">Agregar</button></center></td></tr>';
            $this->t1.='</tbody></table>';
            $this->t1.=$this->obtenerModal(-1, 1);
//            $tabla1.= $this->consultaInvitados(-1, -1, 2);
            $this->consultaInvitados(-1, -1, 2);
        }
        $tabla1 = '<div class="row">' . $this->t1 . '</div>' . '<div class="row">' . $this->t2 . '</div>' . '<div class="row">' . $this->t3 . '</div>' . '<div class="row">' . $this->t4 . '</div>';
        $tabla1 .= '<div class="row">' . $this->terminarFlor() . '</div>';
        return $tabla1;
    }

    function consultaInvitados($idUsuario, $idFU, $nivel) {
//        $tabla2 = '';
//        $tabla2='<table class="table table-striped">
//                    <thead><th><center>Nivel '.$nivel.'</center></th></thead><tbody>';
        if ($nivel <= $this->petalos) {
            if ($idUsuario != -1) {
                $this->query->sql = 'select n.id_usuario as invitado, n.id_flor_usuario from usuario u join flor_usuario i on(u.id_usuario = i.id_usuario)
            join flor f on(i.id_flor = f.id_flor) join invitado n on(n.id_flor_usuario = i.id_flor_usuario)
            join usuario o on(o.id_usuario=n.id_usuario) where u.id_usuario =' . $idUsuario . ' and i.id_flor_usuario=' . $idFU . '';
                $resultado = $this->query->select('obj');
                $cantidad = count($resultado);
            } else {
                $cantidad = 0;
            }
            switch ($cantidad) {
                case 0:
                    $this->elegirNivel(-1, $nivel, $idFU);
                    $this->elegirNivel(-1, $nivel, $idFU);
                    break;
                case 1;
                    $id = $resultado[0]->invitado;
                    $this->elegirNivel($id, $nivel, $idFU);
                    $this->elegirNivel(-1, $nivel, $idFU);
                    break;
                case 2:
                    $id = $resultado[0]->invitado;
                    $id2 = $resultado[1]->invitado;
                    $this->elegirNivel($id, $nivel, $idFU);
                    $this->elegirNivel($id2, $nivel, $idFU);
                    break;
            }
        }
    }

    function elegirNivel($idUsuario, $nivel, $idFU2) {

        switch ($nivel) {
            case 2:
                $this->nivelDos($idUsuario, $nivel, $idFU2);
                break;
            case 3:
                $this->nivelTres($idUsuario, $nivel, $idFU2);
                break;
            case 4:
                if ($this->petalos == 4) {
                    $this->nivelCuatro($idUsuario, $nivel, $idFU2);
                }
                break;
        }
    }

    function nivelDos($idUsuario, $nivel, $idFU2) {
//        $t2 = '';
        $idFU = -1;

        if ($idUsuario != -1) {
            $this->t2.='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">';
            $this->t2 .= '<table class="table">
                    <thead><th><center>Nivel 2</center></th></thead><tbody>';
            $this->query->sql = 'select u.id_usuario, u.correo, u.telefono,u.nombre,u.ap_paterno, u.ap_materno, n.id_flor_usuario from usuario u'
                    . ' join flor_usuario n on(u.id_usuario=n.id_usuario) where n.id_flor=' . $this->idFlor . ' and n.id_usuario=' . $idUsuario . ' and n.nivel=2';
            $resultado = $this->query->select('obj');
            $id = $resultado[0]->id_usuario;
            $idFU = $resultado[0]->id_flor_usuario;
            $nombre = $resultado[0]->nombre;
            $apPat = $resultado[0]->ap_paterno;
            $apMat = $resultado[0]->ap_materno;
            $correo = $resultado[0]->correo;
            $tel = $resultado[0]->telefono;
            $this->t2.='<tr><td ><center><a href="usuario_info.php?id=' . $id . '">' . $nombre . ' ' . $apPat . ' ' . $apMat . '</center></a></td></tr>';
            if ($this->terminada != 'Finalizada') {
                $this->t2.= '<tr><td><center><button class="btn btn-info" type="button" data-toggle="collapse" data-target="#datos' . $id . '" aria-expanded="false" aria-controls="datos">
             <span class="glyphicon glyphicon-search"></span></button><button class="btn btn-warning" type="button" data-toggle="modal" data-target="#myModal' . $this->petalos . '' . $idFU . '"><a href="#"><span class="glyphicon glyphicon-pencil"></span></a></button></td></tr>';
            }
            $this->t2.='<tr><td><div class="collapse" id="datos' . $id . '">
            <div class="well"><h4>Datos del usuario</h4>Correo electrónico: ' . $correo . '<br>Telefono: ' . $tel . '</div></div></td></tr>';
            $this->t2.='</tbody></table></div>';
            $this->t2.=$this->obtenerModalActualizar($idFU);
            $this->consultaInvitados($idUsuario, $idFU, 3);
        } else {
            $this->t2.='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">';
            $this->t2 .= '<table class="table">
                    <thead><th><center>Nivel 2</center></th></thead><tbody>';
            $this->t2.='<tr><td ><center><span class="glyphicon glyphicon-ban-circle"></span></center></td></tr>'
                    . '<tr><td><center><button class="btn btn-info" data-toggle="modal" data-target="#myModal' . $idFU2 . '"';
            if ($idFU2 == -1) {
                $this->t2.=' disabled="disabled">Agregar</button></center></td></tr>';
            } else {
                $this->t2.='>Agregar</button></center></td></tr>';
            }
//            $this->t2.='</tbody></table>';
            $this->t2.='</tbody></table></div>';
            $this->t2.=$this->obtenerModal($idFU2, 2);
            $this->consultaInvitados(-1, -1, 3);
        }
    }

    function nivelTres($idUsuario, $nivel, $idFU2) {

        if ($idUsuario != -1) {
            $this->t3.='<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">';
            $this->t3 .= '<table class="table">
                    <thead><th><center>Nivel 3</center></th></thead><tbody>';
            $this->query->sql = 'select u.id_usuario,u.telefono, u.correo, u.nombre,u.ap_paterno, u.ap_materno, n.id_flor_usuario, n.estatus from usuario u'
                    . ' join flor_usuario n on(u.id_usuario=n.id_usuario) where n.id_flor=' . $this->idFlor . ' and n.id_usuario=' . $idUsuario . ' and n.nivel=3';
            $resultado = $this->query->select('obj');
            $id = $resultado[0]->id_usuario;
            $idFU = $resultado[0]->id_flor_usuario;
            $nombre = $resultado[0]->nombre;
            $apPat = $resultado[0]->ap_paterno;
            $apMat = $resultado[0]->ap_materno;
            $correo = $resultado[0]->correo;
            $tel = $resultado[0]->telefono;
            $estatus = $resultado[0]->estatus;
            $this->t3.='<tr><td';
            if ($estatus == 1 && $this->petalos == 3) {
                $this->t3.=' style="background-color:#a6eda1;"';
                $this->contadorPagos++;
            } else if ($estatus == 0 && $this->petalos == 3) {
                $this->t3.=' style="background-color:#d19898;"';
            }
            $this->t3.='><center><a href="usuario_info.php?id=' . $id . '">' . $nombre . ' ' . $apPat . ' ' . $apMat . '</center></a></td></tr>';
            if ($this->terminada != 'Finalizada') {
                $this->t3 .= '<tr><td><center><button class="btn btn-info" type="button" data-toggle="collapse" data-target="#datos' . $id . '" aria-expanded="false" aria-controls="datos">
             <span class="glyphicon glyphicon-search"></span></button><button class="btn btn-warning" type="button" data-toggle="modal" data-target="#myModal' . $this->petalos . '' . $idFU . '"><a href="#"><span class="glyphicon glyphicon-pencil"></span></a></button>' . $this->hacerPago($estatus, 3, $idFU) . '</td></tr>';
            }
            $this->t3.='<tr><td><div class="collapse" id="datos' . $id . '">
            <div class="well"><h4>Datos del usuario</h4>Correo electrónico: ' . $correo . '<br>Telefono: ' . $tel . '</div></div></td></tr>';
            $this->t3.='</tbody></table></div>';
            $this->t3.=$this->obtenerModalActualizar($idFU);
            $this->consultaInvitados($idUsuario, $idFU, 4);
        } else {
            $this->t3.='<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">';
            $this->t3 .= '<table class="table">
                    <thead><th><center>Nivel 3</center></th></thead><tbody>';
            $this->t3.='<tr><td><center><span class="glyphicon glyphicon-ban-circle"></span></center></td></tr>'
                    . '<tr><td><center><button class="btn btn-info" data-toggle="modal" data-target="#myModal' . $idFU2 . '"';
            if ($idFU2 == -1) {
                $this->t3.=' disabled="disabled">Agregar</button></center></td></tr>';
            } else {
                $this->t3.='>Agregar</button></center></td></tr>';
            }
            $this->t3.='</tbody></table></div>';
            $this->t3.=$this->obtenerModal($idFU2, 3);
            $this->consultaInvitados(-1, -1, 4);
        }
    }

    function nivelCuatro($idUsuario, $nivel, $idFU2) {
//        $idFU = -1;
        if ($this->contador2 % 2 != 0) {
            $this->t4.='<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">';
        } else {
            $this->t4.='<div class="col-lg-1 col-md-1 col-sm-1 col-xs-6">';
        }
        $this->t4 .= '<table class="table">
                    <thead><th><center>Nivel 4</center></th></thead><tbody>';
        if ($idUsuario != -1) {
            $this->query->sql = 'select u.id_usuario,u.telefono, u.correo, u.nombre,u.ap_paterno, u.ap_materno, n.id_flor_usuario, n.estatus from usuario u'
                    . ' join flor_usuario n on(u.id_usuario=n.id_usuario) where n.id_flor=' . $this->idFlor . ' and n.id_usuario=' . $idUsuario . ' and n.nivel=4';
            $resultado = $this->query->select('obj');
            $id = $resultado[0]->id_usuario;
            $idFU = $resultado[0]->id_flor_usuario;
            $nombre = $resultado[0]->nombre;
            $apPat = $resultado[0]->ap_paterno;
            $apMat = $resultado[0]->ap_materno;
            $correo = $resultado[0]->correo;
            $tel = $resultado[0]->telefono;
            $estatus = $resultado[0]->estatus;
            $this->t4.='<tr><td';
            if ($estatus == 1 && $this->petalos == 4) {
                $this->t4.=' style="background-color:#a6eda1;"';
                $this->contadorPagos++;
            } else if ($estatus == 0 && $this->petalos == 4) {
                $this->t4.=' style="background-color:#d19898;"';
            }
            $this->t4.='><center>Nombre <a href="usuario_info.php?id=' . $id . '">' . $nombre . ' ' . $apPat . ' ' . $apMat . '</center></a></td></tr>';
            if ($this->terminada != 'Finalizada') {
                $this->t4 .= '<tr><td><center><button class="btn btn-info" type="button" data-toggle="collapse" data-target="#datos' . $id . '" aria-expanded="false" aria-controls="datos">
             <span class="glyphicon glyphicon-search"></span></button><button class="btn btn-warning" type="button" data-toggle="modal" data-target="#myModal' . $this->petalos . '' . $idFU . '"><a href="#"><span class="glyphicon glyphicon-pencil"></span></a></button>' . $this->hacerPago($estatus, 4, $idFU) . '</td></tr>';
            }
            $this->t4.='<tr><td><div class="collapse" id="datos' . $id . '">
            <div class="well"><h4>Datos del usuario</h4>Correo electrónico: ' . $correo . '<br>Telefono: ' . $tel . '</div></div></td></tr>';
            $this->t4.='</tbody></table></div>';
            $this->t3.=$this->obtenerModalActualizar($idFU);
            $this->con4dor2++;
//            $this->consultaInvitados($idUsuario, $idFU, 5);
        } else {
            $this->t4.='<tr><td><center><span class="glyphicon glyphicon-ban-circle"></span></center></td></tr>'
                    . '<tr><td><center><button class="btn btn-info" data-toggle="modal" data-target="#myModal' . $idFU2 . '"';
            if ($idFU2 == -1) {
                $this->t4.=' disabled="disabled">Agregar</button></center></td></tr>';
            } else {
                $this->t4.='>Agregar</button></center></td></tr>';
            }

            $this->t4.='</tbody></table></div>';
            $this->t4.=$this->obtenerModal($idFU2, 4);
            $this->contador2++;
//            $this->consultaInvitados(-1, -1, 5);
        }
    }

}
