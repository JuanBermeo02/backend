<?php
class Productos {
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function consulta() {
        $con = "SELECT 
                    p.*,
                    c.nombre AS categoria,
                    pr.razon_social AS proveedor,
                    m.nombre AS marca
                FROM productos p
                LEFT JOIN categoria c ON p.fo_categoria = c.id_categoria
                LEFT JOIN proveedor pr ON p.fo_proveedor = pr.id_proveedor
                LEFT JOIN marca m ON p.fo_marca = m.id_marca
                ORDER BY p.nombre";

        $res = mysqli_query($this->conexion, $con);

        if (!$res) {
            return ['resultado' => 'ERROR', 'mensaje' => mysqli_error($this->conexion)];
        }

        $vec = [];
        while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $vec[] = $row;
        }

        return $vec;
    }

    public function eliminar($id) {
        $id = intval($id); // Sanitizar

        $del = "DELETE FROM productos WHERE id_productos = $id";
       if (mysqli_query($this->conexion, $del)) {
    return ['resultado' => 'OK', 'mensaje' => 'El producto ha sido eliminado'];
} else {
    $error = mysqli_error($this->conexion);

    // Detectar error de clave foránea (MySQL error 1451)
    if (strpos($error, 'foreign key constraint fails') !== false || strpos($error, 'a foreign key constraint fails') !== false) {
        return [
            'resultado' => 'ERROR',
            'mensaje' => 'No se puede eliminar este producto porque está en uso en otros módulos del sistema.'
        ];
    }

    return ['resultado' => 'ERROR', 'mensaje' => $error];
}

    }

    public function insertar($params) {
        // Sanitizar strings
        $codigo = mysqli_real_escape_string($this->conexion, $params->codigo);
        $nombre = mysqli_real_escape_string($this->conexion, $params->nombre);

        $ins = "INSERT INTO productos(codigo, nombre, fo_categoria, valor_compra, valor_venta, fo_proveedor, fo_marca, stock) VALUES(
            '$codigo', 
            '$nombre', 
            $params->fo_categoria, 
            $params->valor_compra, 
            $params->valor_venta, 
            $params->fo_proveedor, 
            $params->fo_marca,
            $params->stock
        )";

        if (mysqli_query($this->conexion, $ins)) {
            return ['resultado' => 'OK', 'mensaje' => 'El producto ha sido guardado'];
        } else {
            return ['resultado' => 'ERROR', 'mensaje' => mysqli_error($this->conexion)];
        }
    }

    public function editar($id, $params) {
        $id = intval($id);

        $codigo = mysqli_real_escape_string($this->conexion, $params->codigo);
        $nombre = mysqli_real_escape_string($this->conexion, $params->nombre);

        $editar = "UPDATE productos SET 
            codigo = '$codigo', 
            nombre = '$nombre', 
            fo_categoria = $params->fo_categoria, 
            valor_compra = $params->valor_compra, 
            valor_venta = $params->valor_venta, 
            fo_proveedor = $params->fo_proveedor, 
            fo_marca = $params->fo_marca,
            stock = $params->stock
            WHERE id_productos = $id";

        if (mysqli_query($this->conexion, $editar)) {
            return ['resultado' => 'OK', 'mensaje' => 'El producto ha sido editado'];
        } else {
            return ['resultado' => 'ERROR', 'mensaje' => mysqli_error($this->conexion)];
        }
    }

    public function filtro($valor) {
        $valor = mysqli_real_escape_string($this->conexion, $valor);

        $filtro = "SELECT * FROM productos WHERE codigo LIKE '%$valor%' OR nombre LIKE '%$valor%'";
        $res = mysqli_query($this->conexion, $filtro);

        if (!$res) {
            return ['resultado' => 'ERROR', 'mensaje' => mysqli_error($this->conexion)];
        }

        $vec = [];
        while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $vec[] = $row;
        }

        return $vec;
    }
}
?>
