<?php
header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
 

require_once("../conexion.php");
require_once("../modelos/empleado.php");

$control = $_GET['control'];

$empleado = new Empleado($conexion);


    switch ($control) {
        case 'consulta':
            $vec = $empleado->consulta();
        break;
        case 'insertar':
            $json = file_get_contents('php://input');
            //$json = '{"id_empleado":"4", "nombre", "Pepe", "documento", "1079175665", "direccion", "cra 13b#14a10", "fo_ciudad", "1"}';
            $params = json_decode($json);
            $vec = $empleado->insertar( $params);
        break;    
        case 'eliminar':
            $id = $_GET['id'];
            $vec = $empleado->eliminar( $id );
        break;
        case 'editar':
             $json = file_get_contents('php://input');
              $params = json_decode($json, associative: true);
              $id = $_GET['id'];
              $vec = $empleado->editar( $id, $params);
        break;
        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $empleado->filtro( $dato);
        break;
}

$datosj = json_encode($vec);
echo $datosj;
header('Content-Type: application/json');

?>

