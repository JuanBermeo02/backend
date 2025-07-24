<?php
class Ventas {
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // CONSULTAR
    public function consulta() {
        $con = "SELECT 
                    v.id_ventas,
                    v.fecha,
                    v.fo_cliente,
                    v.fo_usuario,
                    v.total,
                    v.subtotal,
                    v.iva,
                    c.nombre AS cliente,
                    u.nombre AS usuario
                FROM ventas v
                LEFT JOIN cliente c ON v.fo_cliente = c.id_cliente
                LEFT JOIN usuario u ON v.fo_usuario = u.id_usuario
                ORDER BY v.fecha DESC";

        $res = mysqli_query($this->conexion, $con);
        $vec = [];

        while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $vec[] = $row;
        }

        return $vec;
    }

    // ELIMINAR
    public function eliminar($id) {
        $id = intval($id); 
        $del = "DELETE FROM ventas WHERE id_ventas = $id"; 
        mysqli_query($this->conexion, $del);

        return [
            'resultado' => 'OK',
            'mensaje' => 'La venta ha sido eliminada'
        ];
    }

    // INSERTAR
    public function insertar($params) {
        $fecha = mysqli_real_escape_string($this->conexion, $params->fecha);
        $fo_cliente = intval($params->fo_cliente);
        $subtotal = floatval($params->subtotal);
        $iva = floatval($params->iva);
        $total = floatval($params->total);
        $fo_usuario = intval($params->fo_usuario);

        $ins = "INSERT INTO ventas (
            fecha, 
            fo_cliente, 
            subtotal, 
            iva, 
            total, 
            fo_usuario
        ) VALUES (
            '$fecha', 
            $fo_cliente, 
            $subtotal, 
            $iva, 
            $total, 
            $fo_usuario
        )";

        mysqli_query($this->conexion, $ins);

        return [
            'resultado' => 'OK',
            'mensaje' => 'La venta ha sido guardada'
        ];
    }

    // EDITAR
    public function editar($id, $params) {
        $id = intval($id);
        $fecha = mysqli_real_escape_string($this->conexion, $params->fecha);
        $fo_cliente = intval($params->fo_cliente);
        $subtotal = floatval($params->subtotal);
        $iva = floatval($params->iva);
        $total = floatval($params->total);
        $fo_usuario = intval($params->fo_usuario);

        $editar = "UPDATE ventas SET 
            fecha = '$fecha',
            fo_cliente = $fo_cliente,
            subtotal = $subtotal,
            iva = $iva,
            total = $total,
            fo_usuario = $fo_usuario
        WHERE id_ventas = $id";

        mysqli_query($this->conexion, $editar);

        return [
            'resultado' => 'OK',
            'mensaje' => 'La venta ha sido editada'
        ];
    }

    // FILTRO
    public function filtro($valor) {
        $valor = mysqli_real_escape_string($this->conexion, $valor);

        $filtro = "SELECT 
                        v.id_ventas,
                        v.fecha,
                        v.fo_cliente,
                        v.fo_usuario,
                        v.total,
                        v.subtotal,
                        v.iva,
                        c.nombre AS cliente,
                        u.nombre AS usuario
                    FROM ventas v
                    LEFT JOIN cliente c ON v.fo_cliente = c.id_cliente
                    LEFT JOIN usuario u ON v.fo_usuario = u.id_usuario
                    WHERE v.fecha LIKE '%$valor%' OR c.nombre LIKE '%$valor%'
                    ORDER BY v.fecha DESC";

        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $vec[] = $row;
        }

        return $vec;
    }
}
?>
