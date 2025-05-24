<?php
header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
 

require_once("../conexion.php");
require_once("../modelos/marca.php");

$control = $_GET['control'];

$marca = new Marca($conexion);


    switch ($control) {
        case 'consulta':
            $vec = $marca->consulta();
        break;
        case 'insertar':
            //$json = file_get_contents('php://input');
            $json = '{"nombre":"Corsair"}';
            $params = json_decode($json);
            $vec = $marca->insertar( $params);
        break;    
        case 'eliminar':
            $id = $_GET['id'];
            $vec = $marca->eliminar( $id );
        break;
        case 'editar':
             $json = file_get_contents('php://input');
              $params = json_decode($json, associative: true);
              $id = $_GET['id'];
              $vec = $marca->editar( $id, $params);
        break;
        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $marca->filtro( $dato);
        break;
}

$datosj = json_encode($vec);
echo $datosj;
header('Content-Type: application/json');

?>

