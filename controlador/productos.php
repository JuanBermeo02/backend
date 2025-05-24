<?php
header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
 

require_once("../conexion.php");
require_once("../modelos/productos.php");

$control = $_GET['control'];

$productos = new Productos($conexion);


    switch ($control) {
        case 'consulta':
            $vec = $productos->consulta();
        break;
        case 'insertar':
            $json = file_get_contents('php://input');
            //$json = '{"codigo":"PROD001", "nombre":"Smart TV 55 Pulgadas", "fo_categoria":1, "valor_compra":1500000.00, "valor_venta":2000000.00, "fo_proveedor":1, "fo_marca":1}';
            $params = json_decode($json);
            $vec = $productos->insertar( $params);
        break;    
        case 'eliminar':
            $id = $_GET['id'];
            $vec = $productos->eliminar( $id );
        break;
        case 'editar':
             $json = file_get_contents('php://input');
              $params = json_decode($json, associative: true);
              $id = $_GET['id'];
              $vec = $productos->editar( $id, $params);
        break;
        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $productos->filtro( $dato);
        break;
}

$datosj = json_encode($vec);
echo $datosj;
header('Content-Type: application/json');

?>

