<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

require_once("../conexion.php");
require_once("../modelos/proveedores.php");

$control = $_GET['control'] ?? '';

$proveedores = new Proveedores($conexion);

switch ($control) {
    case 'consulta':
        $vec = $proveedores->consulta();
        break;

    case 'insertar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $vec = $proveedores->insertar($params);
        break;

    case 'eliminar':
        $id = $_GET['id'];
        $vec = $proveedores->eliminar($id);
        break;

    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id'];
        $vec = $proveedores->editar($id, $params);
        break;

    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $proveedores->filtro($dato);
        break;

    default:
        $vec = ['resultado' => 'ERROR', 'mensaje' => 'Control inválido'];
}

echo json_encode($vec);
?>
