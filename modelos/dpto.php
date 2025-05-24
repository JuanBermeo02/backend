<?php
    class Dpto{
        //atributo
        public $conexion;
        //metodo constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
           }
           

           //metodos
           public function consulta(){
            $con = "SELECT * FROM dpto ORDER BY nombre"; // Consulta la tabla 'dpto'
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){ // Usamos MYSQLI_ASSOC para claves asociativas
                $vec[] = $row;    
            }

            return $vec;

        }

        public function eliminar($id){
            $del = "DELETE FROM dpto WHERE id_dpto = $id"; // Elimina por id_dpto
            mysqli_query($this->conexion, $del);
            $vec   = [];
            $vec ['resultado'] = "OK";
            $vec ['mensaje'] = 'El departamento ha sido eliminado';
            return $vec;
        }

        public function insertar($params){
            $ins = "INSERT INTO dpto(nombre) VALUES('$params->nombre')"; // Inserta el nombre del departamento
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ['resultado'] = "OK";
            $vec ['mensaje'] = "El departamento ha sido guardado";
            return $vec;    
        }


      public function editar($id, $params){
        $editar = "UPDATE dpto SET nombre = '$params->nombre' WHERE id_dpto = $id"; // Edita el nombre por id_dpto
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "El departamento ha sido editado";
        return $vec;
        }
    

        public function filtro($valor){
            $filtro = "SELECT * FROM dpto WHERE nombre LIKE '%$valor%'"; // Filtra por nombre
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];
            
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){ // Usamos MYSQLI_ASSOC
                $vec[] = $row;
        }

        return $vec;
    }
}

?>