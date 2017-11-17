<?
$ip = $_SERVER['REMOTE_ADDR']; //Esto da la ip del Servidor. 
$name=$_SERVER ['HTTP_HOST'];
/*
if($ip!='127.0.0.1'){//$ip='127.0.0.0'){
	$dbhost='sandbox2.ufps.edu.co';  // host del MySQL (generalmente localhost)
	$dbusuario='ufps_26'; // aqui debes ingresar el nombre de usuario para acceder a la base
	$dbpassword='ufps_11'; // password de acceso para el usuario de la linea anterior
	$db='ufps_25';        // Seleccionamos la base con la cual trabajar
}
else{*/
	$dbhost='localhost';  // host del MySQL (generalmente localhost)
	$dbusuario='webmaste'; // aqui debes ingresar el nombre de usuario para acceder a la base
	$dbpassword='gipisix'; // password de acceso para el usuario de la linea anterior
	$db='ufps_26';        // Seleccionamos la base con la cual trabajar
//}	
mysql_connect($dbhost, $dbusuario, $dbpassword)  or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db($db) or die ('Error al seleccionar la Base de Datos: '.mysql_error());
?>
