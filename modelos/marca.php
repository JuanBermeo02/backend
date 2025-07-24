<?php
    class Marca{ 
        public $conexion;
        public function __construct($conexion) {
            $this->conexion = $conexion;
           }
           public function consulta(){
            $con = "SELECT * FROM marca ORDER BY nombre"; 
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){ 
                $vec[] = $row;    
            }
            return $vec;
        }
        public function eliminar($id){
    $vec = [];
    try {
        $del = "DELETE FROM marca WHERE id_marca = $id"; 
        mysqli_query($this->conexion, $del);
        $vec['resultado'] = "OK";
        $vec['mensaje'] = 'La marca ha sido eliminada';
    } catch (mysqli_sql_exception $e) {
        $vec['resultado'] = "ERROR";
        $vec['mensaje'] = 'No se puede eliminar la marca porque está en uso por uno o más productos.';
    }
    return $vec;
}
        public function insertar($params){
            $ins = "INSERT INTO marca(nombre) VALUES('$params->nombre')"; 
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ['resultado'] = "OK";
            $vec ['mensaje'] = "La marca ha sido guardada";
            return $vec;    
        }
      public function editar($id, $params){
        $editar = "UPDATE marca SET nombre = '$params->nombre' WHERE id_marca = $id"; 
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "La marca ha sido editada";
        return $vec;
        }
        public function filtro($valor){
            $filtro = "SELECT * FROM marca WHERE nombre LIKE '%$valor%'"; 
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){ 
                $vec[] = $row;
        }
        return $vec;
    }
}
?>