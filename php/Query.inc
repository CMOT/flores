<?php

#http://www.php.net/manual/es/function.mysql-create-db.php
/**
 *
 * @author e-israel from TERACOM.mx
 * Copyrigth 2010
 *
 */
//if (!file_exists("Conexion.inc"))
//die("<p>El archivo <code><b>Conexion.inc</b></code> no existe en el directorio ra&iacute;z.<br />
//			Contacta a <code><b>soporte@teracom.mx</b></code> para corregir este problema.</p>");
//echo "<script languaje='javascript' type='text/javascript'>function r(){if( i == 1)




include_once("Conexion.inc");
include_once 'Error.inc';

class Query {

    private $conexion;
    private $idConexion;
    private $idQuery;
    private $arregloObj;
    private $arregloArr;
    public $sql;

    function __construct() {
        $this->conexion = new Conexion();

        $this->idConexion = $this->conexion->id;
        $this->idQuery = 0x00;
        $this->sql = NULL;
        #mysqli_set_charset($this->idConexion, "utf8");
        if (RESULTTRACE)
            print("<p>Objeto instanciado en &quot;Query&quot;.</p>");
        return;
    }

    function __destruct() {
        mysqli_close($this->idConexion);
        if (RESULTTRACE)
            print("<p>Objeto instanciado en &quot;Query&quot;. Destruido</p>");
        return;
    }
    function realizarConsulta($consultasql){
        $resultado=mysql_query($consultasql, $conexion);
        return $resultado;

    }
    function select($tipo = "obj") {
        if (!empty($this->sql)) {
            unset($this->idQuery, $this->arregloObj, $this->arregloArr);
            #$this->sql = mysqli_real_escape_string($this->idConexion, $this->sql);
            #echo $this->sql;
            
                $this->logQuery($this->sql);
            $this->idQuery = mysqli_query($this->idConexion, $this->sql) or die(E::error_mysql(mysqli_errno(), mysqli_error(), __FILE__, __LINE__, __CLASS__, __FUNCTION__, __METHOD__, $_SERVER['PHP_SELF'], $this->sql));
            if ($this->numRegistros() > 0) {
                if (strcmp($tipo, "obj") == 0) {
                    $this->arregloObj = array();
                    while ($row = mysqli_fetch_object($this->idQuery)) {
                        $this->arregloObj[] = $row;
                    }
                    return $this->arregloObj;
                } else if (strcmp($tipo, "arr") == 0) {
                    #Se pueden obtener los valos por posicion arr[0] o por nombre arr["nomber"]
                    $this->arregloArr = array();
                    $this->arregloArr = mysqli_fetch_array($this->idQuery, MYSQLI_BOTH);
                    return $this->arregloArr;
                } else {
                    die("<h3>ERROR: No me has dicho como quieres los registros?.</h3>");
                }
            } else {
                return NULL;
            }
        } else {
            die("<h3>ERROR: No has especificado un query &quot;SELECT&quot; v&oacute;lido.</h3>");
        }
    }

    function update($sql = NULL) {
        if (!empty($sql)) {
            unset($this->sql, $this->idQuery);
            if (SAVEQUERIES)
                $this->logQuery($sql);
            $this->idQuery = mysqli_query($this->idConexion, $sql) or die(E::error_mysql(mysqli_errno(), mysqli_error(), __FILE__, __LINE__, __CLASS__, __FUNCTION__, __METHOD__, $_SERVER['PHP_SELF'], $sql));
            return TRUE;
        }
        else {
            exit("<p>ERROR: No has especificado un query &quot;UPDATE&quot; v&aacute;lido.</p>");
        }
    }

    function insert($tabla = NULL, $campos = NULL, $values = NULL) {
        if (!empty($tabla) || !empty($campos) || !empty($values)) {
            unset($this->sql, $this->idQuery);
            $this->sql = "INSERT INTO $tabla ($campos) VALUES ($values) ";
           
                $this->logQuery($this->sql);
            $this->idQuery = mysqli_query($this->idConexion, $this->sql) ;
            return TRUE;
        }
        else {
            exit("<p>ERROR: No has especificado un query &quot;INSERT&quot; v&aacute;lido.</p>");
        }
    }

    function delete($tabla = NULL, $where = NULL) {
        if (!empty($tabla) || !empty($where)) {
            unset($this->sql, $this->idQuery);
            $this->sql = "DELETE FROM $tabla WHERE $where";
            if (SAVEQUERIES)
                $this->logQuery($this->sql);
            $this->idQuery = mysqli_query($this->idConexion, $this->sql) or die(E::error_mysql(mysqli_errno(), mysqli_error(), __FILE__, __LINE__, __CLASS__, __FUNCTION__, __METHOD__, $_SERVER['PHP_SELF'], $sql));
            $this->optimiza($tabla);
            return TRUE;
        }
        else {
            exit("<p>ERROR: No has especificado un query &quot;DELETE&quot; v&aacute;lido.</p>");
        }
    }

    function cuentaCampos($campo = '*', $tabla = NULL, $where = '1') {
        if (!empty($tabla) && !empty($tabla)) {
            unset($this->sql, $this->idQuery, $this->arregloObj, $this->arregloArr);
            $this->sql = "SELECT COUNT($campo) AS total FROM $tabla WHERE $where";
            if (SAVEQUERIES)
                $this->logQuery($this->sql);
            $this->idQuery = mysqli_query($this->idConexion, $this->sql) or die(E::error_mysql(mysqli_errno(), mysqli_error(), __FILE__, __LINE__, __CLASS__, __FUNCTION__, __METHOD__, $_SERVER['PHP_SELF'], $sql));
            $this->arregloArr = mysqli_fetch_array($this->idQuery, MYSQLI_BOTH);
            return $this->arregloArr["total"];
        }
        else {
            exit("<p>ERROR. No has especificado una tabla para contar campos.</p>");
        }
    }

    #Devuielve numero de campos obtenidos de un select

    function numCampos() {
        return ($this->idQuery) ? mysqli_num_fields($this->idQuery) : 0;
    }

    #Falta numero de registros aafetctados

    function camposAfectados() {
        return ($this->idQuery) ? mysqli_affected_rows($this->idConexion) : 0;
    }

    #Devuelve el numero de registros obtenidos de un SELECT

    function numRegistros() {
        return ($this->idQuery) ? mysqli_num_rows($this->idQuery) : 0;
    }

    #devuelve el primary key del ultimo elemento insertado

    function dameUltimo() {
        return ($this->idQuery) ? mysqli_insert_id($this->idConexion) : 0;
    }

    function optimiza($tabla = NULL) {
        if (!empty($tabla)) {
            unset($this->sql, $this->idQuery);
            $this->sql = "OPTIMIZE TABLE $tabla";
            if (SAVEQUERIES)
                $this->logQuery($this->sql);
            $this->idQuery = mysqli_query($this->idConexion, $this->sql) or die(E::error_mysql(mysqli_errno(), mysqli_error(), __FILE__, __LINE__, __CLASS__, __FUNCTION__, __METHOD__, $_SERVER['PHP_SELF'], $sql));
            $this->flush();
            return TRUE;
        }
        else {
            exit("<P>ERROR: No has especificado una tabla para optimizar.</p>");
        }
    }

    /* function query($sql = NULL)
      {
      if(!empty($sql) && $this->idConexion)
      {
      if(SAVEQUERIES)$this->logQuery($sql);
      $this->idQuery = mysqli_query($this->idConexion,$sql)
      or die(E::error_mysql(mysqli_errno(),mysqli_error(),__FILE__,__LINE__,__CLASS__,__FUNCTION__,__METHOD__,$_SERVER['PHP_SELF'],$sql));
      return TRUE;
      }
      else
      {
      exit("<p>ERROR. No has especificado una consulta QUERY</p>");
      }
      }
     */

    function flush() {
        if ($this->idQuery) {
            mysqli_free_result($this->idQuery);
            return;
        }
    }

    function info() {
        //mysqli_escape_string()
        echo "<p><b>Ver MySQL:</b> <code>" . mysqli_get_client_info() . "</code></p>";
        echo "<p><b>Version MySQL:</b> <code>" . mysqli_get_client_version() . "</code></p>";
        echo "<p><b>Host / Protocol:</b> <code>" . mysqli_get_host_info($this->idConexion) . "</code></p>";
        #checarecho "<p><b>Version:</b> <code>". mysqli_get_metadata()."</code></p>";
        echo "<p><b>Proto:</b> <code>" . mysqli_get_proto_info($this->idConexion) . "</code></p>";
        echo "<p><b>Server Info:</b> <code>" . mysqli_get_server_info($this->idConexion) . "</code></p>";
        echo "<p><b>Version Server:</b> <code>" . mysqli_get_server_version($this->idConexion) . "</code></p>";
        echo "<p><b>General:</b> <code> " . mysqli_stat($this->idConexion) . "</code></p>";
    }

    private function logQuery($query) {
        /* $fp = fopen(ABSPATH."querys.log","a+");
          $date = date("d-m-Y H:i:s");
          fwrite($fp, "\n[".$date."] ".$_SERVER['REMOTE_ADDR']." \"".$_SERVER["REQUEST_METHOD"]." ".$_SERVER['SCRIPT_FILENAME']."\" [".$query."] ".$_SERVER['HTTP_USER_AGENT']."\n\r");
          fclose($fp);*/
          return TRUE; 
    }

}

?>
