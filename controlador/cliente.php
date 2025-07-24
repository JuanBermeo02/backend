<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header('Content-Type: application/json');

require_once("../conexion.php");
require_once("../modelos/cliente.php");

$control = $_GET['control'] ?? '';
$cliente = new Cliente($conexion);

switch ($control) {
    case 'consulta':
        $vec = $cliente->consulta();
        break;

    case 'insertar':
        $json = file_get_contents('php://input');
        $params = json_decode($json); 
        $vec = $cliente->insertar($params);
        break;

    case 'eliminar':
        $id = $_GET['id'] ?? 0;
        $vec = $cliente->eliminar($id);
        break;

    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json); 
        $id = $_GET['id'] ?? 0;
        $vec = $cliente->editar($id, $params);
        break;

    case 'filtro':
        $dato = $_GET['dato'] ?? '';
        $vec = $cliente->filtro($dato);
        break;
      case 'ccliente':
        $dato = $_GET['dato'] ?? '';
        $vec = $cliente->consultar_cliente($dato);
        break;

    default:
        $vec = ['resultado' => 'Error', 'mensaje' => 'Control no válido'];
}

echo json_encode($vec);
