<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

require_once("../conexion.php");
require_once("../modelos/pedidos.php");

$control = $_GET['control'];
$pedido = new Pedidos($conexion);

switch ($control) {
    case 'consulta':
        $vec = $pedido->consulta();
        break;
    case 'insertar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $texto_arreglo = serialize($params->productos);
        $params->productos = $texto_arreglo;
        $vec = $pedido->insertar($params);
        break;
    case 'productos':
        $id = $_GET['id'];
        $vec = $pedido->consultap($id);
    break;
    case 'cambiar_estado':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $vec = $pedido->cambiar_estado($params->id, $params->estado);
        break;



}

echo json_encode($vec);
