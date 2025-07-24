<?php
// Habilita excepciones para errores de MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

class Usuario {
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function consulta() {
        $sql = "SELECT id_usuario, clave, nombre, correo, tipo_usuario FROM usuario ORDER BY nombre";
        $res = mysqli_query($this->conexion, $sql);

        if (!$res) {
            die('Error en la consulta: ' . mysqli_error($this->conexion));
        }

        $vec = [];
        while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $vec[] = $row;
        }

        return $vec;
    }

    public function eliminar($id) {
        $vec = [];

        try {
            $sql = "DELETE FROM usuario WHERE id_usuario = $id";
            mysqli_query($this->conexion, $sql);
            $vec['resultado'] = "OK";
            $vec['mensaje'] = "Usuario eliminado correctamente";
        } catch (mysqli_sql_exception $e) {
            $vec['resultado'] = "ERROR";
            // Puedes capturar el error exacto si quieres: $e->getMessage()
            $vec['mensaje'] = "No se puede eliminar: el usuario tiene registros asociados (por ejemplo, ventas)";
        }

        return $vec;
    }

   public function insertar($params) {
    // Encriptar la clave con SHA1
    $clave_encriptada = sha1($params->clave);

    $ins = "INSERT INTO usuario(clave, nombre, correo, tipo_usuario) VALUES(
        '$clave_encriptada', 
        '$params->nombre', 
        '$params->correo', 
        '$params->tipo_usuario'
    )";

    mysqli_query($this->conexion, $ins);

    $vec = [];
    $vec['resultado'] = "OK";
    $vec['mensaje'] = "El usuario ha sido guardado";
    return $vec;
}


    public function editar($id, $params) {
        $editar = "UPDATE usuario SET 
            clave = '$params->clave', 
            nombre = '$params->nombre', 
            correo = '$params->correo', 
            tipo_usuario = '$params->tipo_usuario' 
            WHERE id_usuario = $id";
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "El usuario ha sido editado";
        return $vec;
    }

    public function filtro($valor) {
        $filtro = "SELECT * FROM usuario WHERE nombre LIKE '%$valor%' OR correo LIKE '%$valor%'";
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){ 
            $vec[] = $row;
        }

        return $vec;
    }
}
?>
