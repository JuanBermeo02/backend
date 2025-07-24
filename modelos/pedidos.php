<?php
class Pedidos {
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // CONSULTAR TODOS LOS PEDIDOS
    public function consulta() {
    $sql = "SELECT 
                v.id_ventas,
                v.fecha,
                c.nombre AS cliente,
                v.total,
                u.nombre AS vendedor,
                v.estado                          -- AÑADIR ESTE CAMPO
            FROM ventas v
            LEFT JOIN cliente c ON v.fo_cliente = c.id_cliente
            LEFT JOIN usuario u ON v.fo_usuario = u.id_usuario
            ORDER BY v.fecha DESC";

    $res = mysqli_query($this->conexion, $sql);

    if (!$res) {
        return ['resultado' => 'ERROR', 'mensaje' => mysqli_error($this->conexion)];
    }

    $vec = [];
    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $vec[] = $row;
    }

    return $vec;
}

 

    // INSERTAR UNA NUEVA VENTA
    public function insertar($params) {
    $ins = "INSERT INTO ventas(fecha, fo_cliente, productos, subtotal, total, fo_usuario, estado)
            VALUES(
                '$params->fecha',
                $params->fo_cliente,
                '$params->productos',
                $params->subtotal,
                $params->total,
                $params->fo_vendedor,
                'activo'
            )";

    mysqli_query($this->conexion, $ins);

    $vec = [];
    $vec['resultado'] = "OK";
    $vec['mensaje'] = "La venta ha sido guardada";

    return $vec;
}


    public function consultap($id){
        $con = "SELECT productos from ventas WHERE id_ventas = $id";
        $res = mysqli_query($this->conexion, $con);
        $row = mysqli_fetch_array($res);
        $vec = unserialize($row[0]);

        return $vec;
    }

   public function cambiar_estado($id, $estado) {
    $sql = "UPDATE ventas SET estado = '$estado' WHERE id_ventas = $id";
    $res = mysqli_query($this->conexion, $sql);

    if (!$res) {
        return ['resultado' => 'ERROR', 'mensaje' => mysqli_error($this->conexion)];
    }

    return ['resultado' => 'OK', 'mensaje' => 'Estado actualizado'];
}


    
  
 
}
?>
