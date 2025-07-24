<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
header('Content-Type: application/json'); // ✅ Mueve este arriba

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
        $params = json_decode($json); 
        $vec = $productos->insertar($params);
        break;
        
    case 'eliminar':
        $id = $_GET['id'];
        $vec = $productos->eliminar($id);
        break;
        
    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json); 
        $id = $_GET['id'];
        $vec = $productos->editar($id, $params);
        break;
        
    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $productos->filtro($dato);
        break;
}

echo json_encode($vec); 
exit; 
