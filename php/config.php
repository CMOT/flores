<?php

	#mostrar Errores MySQL
	define("ERRORTRACE",FALSE);
		if(ERRORTRACE)error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	define("ABSPATH", "http://".$_SERVER['SERVER_NAME']."/xxx/");
	#Mostrar resultados MySQL
	define("RESULTTRACE",FALSE);
	define("MYSQL_NAME","baseprovicional");
	define("MYSQL_USER","root");
	define("MYSQL_PASS","");
	define("MYSQL_HOST","localhost");
	define("ANALITYCS",FALSE);
?>			 