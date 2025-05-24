<?php
header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
 

require_once("../conexion.php");
require_once("../modelos/ventas.php");

$control = $_GET['control'];

$ventas = new Ventas($conexion);


    switch ($control) {
        case 'consulta':
            $vec = $ventas->consulta();
        break;
        case 'insertar':
            $json = file_get_contents('php://input');
            //$json = '{"fecha":"2025-05-23", "fo_cliente":1, "fo_producto":1, "total":120000.00, "subtotal":100000.00, "iva":20000.00, "fo_usuario":1}'; 
            $params = json_decode($json);
            $vec = $ventas->insertar( $params);
        break;    
        case 'eliminar':
            $id = $_GET['id'];
            $vec = $ventas->eliminar( $id );
        break;
        case 'editar':
             $json = file_get_contents('php://input');
              $params = json_decode($json, associative: true);
              $id = $_GET['id'];
              $vec = $ventas->editar( $id, $params);
        break;
        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $ventas->filtro( $dato);
        break;
}

$datosj = json_encode($vec);
echo $datosj;
header('Content-Type: application/json');

?>

