<?php
header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
 

require_once("../conexion.php");
require_once("../modelos/cliente.php");

$control = $_GET['control'];

$cliente = new Cliente($conexion);


    switch ($control) {
        case 'consulta':
            $vec = $cliente->consulta();
        break;
        case 'insertar':
            $json = file_get_contents('php://input');
            //$json = '{"identificacion":"1234567890", "nombre":"Juan Perez", "email":"juan.perez@example.com", "direccion":"Calle 10 # 20-30", "telefono":"3001234567", "fo_ciudad":1}'; 
            $params = json_decode($json);
            $vec = $cliente->insertar( $params);
        break;    
        case 'eliminar':
            $id = $_GET['id'];
            $vec = $cliente->eliminar( $id );
        break;
        case 'editar':
             $json = file_get_contents('php://input');
              $params = json_decode($json, associative: true);
              $id = $_GET['id'];
              $vec = $cliente->editar( $id, $params);
        break;
        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $cliente->filtro( $dato);
        break;
}

$datosj = json_encode($vec);
echo $datosj;
header('Content-Type: application/json');

?>

