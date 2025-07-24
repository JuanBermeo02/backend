<?php
header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
 

require_once("../conexion.php");
require_once("../modelos/login.php");


$correo = $_GET['correo'];
$clave = $_GET['clave'];

$login = new Login($conexion);

$vec = $login->consulta($correo, $clave);
   

$datosj = json_encode($vec);
echo $datosj;
header('Content-Type: application/json');

?>

