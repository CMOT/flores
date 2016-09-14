<?php

	#mostrar Errores MySQL
	define("ERRORTRACE",FALSE);
		if(ERRORTRACE)error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	define("ABSPATH", "http://".$_SERVER['SERVER_NAME']."/xxx/");
	#Mostrar resultados MySQL
	define("RESULTTRACE",FALSE);
	define("MYSQL_NAME","u529955960_prod");
	define("MYSQL_USER","u529955960_cess");
	define("MYSQL_PASS","nesskate123");
	define("MYSQL_HOST","mysql.hostinger.mx");
	define("ANALITYCS",FALSE);
?>			 