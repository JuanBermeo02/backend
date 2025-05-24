<?php
header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
 

require_once("../conexion.php");
require_once("../modelos/compras.php");

$control = $_GET['control'];

$compras = new Compra($conexion);


    switch ($control) {
        case 'consulta':
            $vec = $compras->consulta();
        break;
        case 'insertar':
            $json = file_get_contents('php://input');
            //$json = '{"fecha":"2024-05-21", "fo_productos":1, "total":150000.00, "subtotal":126050.42, "iva":23949.58, "cantidad":5}';            
            $params = json_decode($json);
            $vec = $compras->insertar( $params);
        break;    
        case 'eliminar':
            $id = $_GET['id'];
            $vec = $compras->eliminar( $id );
        break;
        case 'editar':
             $json = file_get_contents('php://input');
              $params = json_decode($json, associative: true);
              $id = $_GET['id'];
              $vec = $compras->editar( $id, $params);
        break;
        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $compras->filtro( $dato);
        break;
}

$datosj = json_encode($vec);
echo $datosj;
header('Content-Type: application/json');

?>

