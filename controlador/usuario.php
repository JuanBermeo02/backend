<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

require_once("../conexion.php");
require_once("../modelos/usuario.php");

$control = $_GET['control'] ?? '';
$usuario = new Usuario($conexion);
$vec = [];

switch ($control) {
    case 'consulta':
        $vec = $usuario->consulta();
        break;

    case 'insertar':
        $json = file_get_contents('php://input');
        $params = json_decode($json); 
        $vec = $usuario->insertar($params);
        break;

    case 'eliminar':
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $vec = $usuario->eliminar($id);
        break;

    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json); 
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $vec = $usuario->editar($id, params: $params);
        break;

    case 'filtro':
        $dato = $_GET['dato'] ?? '';
        $vec = $usuario->filtro($dato);
        break;

    default:
        $vec['resultado'] = 'ERROR';
        $vec['mensaje'] = 'Acción no válida';
}

echo json_encode($vec);
?>
