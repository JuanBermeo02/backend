<?php
class Proveedores {
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function consulta() {
        $sql = "SELECT 
                    p.id_proveedor,
                    p.nit,
                    p.razon_social,
                    p.direccion,
                    p.celular,
                    p.email,
                    p.contacto,
                    c.nombre AS ciudad,
                    p.fo_ciudad
                FROM proveedor p
                LEFT JOIN ciudad c ON p.fo_ciudad = c.id_ciudad
                ORDER BY p.razon_social";

        $res = mysqli_query($this->conexion, $sql);

        if (!$res) {
            die('Error en la consulta: ' . mysqli_error($this->conexion));
        }

        $proveedores = [];
        while ($fila = mysqli_fetch_assoc($res)) {
            $proveedores[] = $fila;
        }

        return $proveedores;
    }

    public function insertar($params) {
        $ins = "INSERT INTO proveedor (nit, razon_social, direccion, celular, email, contacto, fo_ciudad) VALUES (
            '$params->nit',
            '$params->razon_social',
            '$params->direccion',
            '$params->celular',
            '$params->email',
            '$params->contacto',
            '$params->fo_ciudad'
        )";

        mysqli_query($this->conexion, $ins);
        return ['resultado' => 'OK', 'mensaje' => 'Proveedor guardado'];
    }

    public function editar($id, $params) {
        $editar = "UPDATE proveedor SET 
            nit = '$params->nit',
            razon_social = '$params->razon_social',
            direccion = '$params->direccion',
            celular = '$params->celular',
            email = '$params->email',
            contacto = '$params->contacto',
            fo_ciudad = '$params->fo_ciudad'
            WHERE id_proveedor = $id";

        mysqli_query($this->conexion, $editar);
        return ['resultado' => 'OK', 'mensaje' => 'Proveedor actualizado'];
    }

    public function eliminar($id) {
        $del = "DELETE FROM proveedor WHERE id_proveedor = $id";
        mysqli_query($this->conexion, $del);
        return ['resultado' => 'OK', 'mensaje' => 'Proveedor eliminado'];
    }

    public function filtro($valor) {
        $filtro = "SELECT * FROM proveedor WHERE nit LIKE '%$valor%' OR razon_social LIKE '%$valor%'";
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $vec[] = $row;
        }

        return $vec;
    }
}
?>
