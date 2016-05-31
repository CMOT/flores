<?php
include 'config.php';
/**
 *
 * @author e-israel from TERACOM.mx
 * Copyrigth 2010
 *
 */
class Conexion
{
	public $id;
    function __construct()
	{
        $this->id = @mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PASS,MYSQL_NAME)
            or die(E::error_mysql(mysqli_connect_errno(),mysqli_connect_error(),__FILE__,__LINE__,__CLASS__,__FUNCTION__,__METHOD__,$_SERVER['PHP_SELF'],"Seleccionar BD"));
		if(RESULTTRACE) print("<p>Conexi&oacute;n exitosa a MySQL.</p>");
		if(RESULTTRACE) print("<p>BD &quot;".MYSQL_NAME."&quot; seleccionada.</p>");
		return $this->id;
	}

	function __destruct()
	{
		if($this->id)
		{
			@mysqli_close($this->id);
			if(RESULTTRACE) print("<p>Conexi&oacute;n a MySQL cerrada.</p>");
            return TRUE;
		}
	}

	/*function crearBD($nombre_bd, $host_bd, $usuario_bd, $password_bd)
	{
		if ($this->idConexion)
		{
			if(@mysql_create_db($nombre_bd))
			{
    			if(RESULTTRACE) print("<p>La base de datos \"".$nombre_bd."\", ha sido creada exitosamente.</p>");
    			return TRUE;
			}
			else
			{
    			$this->error_mysql("al crear la BD", mysql_errno(),mysql_error(),__FILE__,__LINE__,__CLASS__,__FUNCTION__,__METHOD__,$_SERVER['PHP_SELF']);
			}
		}

 	return $link;
	}*/
}
?>
