<?php
    class Marca{ 
        //atributo
        public $conexion;
        //metodo constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
           }
           

           //metodos
           public function consulta(){
            $con = "SELECT * FROM marca ORDER BY nombre"; // Consulta la tabla 'marca'
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){ // Usamos MYSQLI_ASSOC para claves asociativas
                $vec[] = $row;    
            }

            return $vec;

        }

        public function eliminar($id){
            $del = "DELETE FROM marca WHERE id_marca = $id"; // Elimina por id_marca
            mysqli_query($this->conexion, $del);
            $vec   = [];
            $vec ['resultado'] = "OK";
            $vec ['mensaje'] = 'La marca ha sido eliminada';
            return $vec;
        }

        public function insertar($params){
            // Campos a insertar: nombre
            $ins = "INSERT INTO marca(nombre) VALUES('$params->nombre')"; // Inserta el nombre de la marca
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ['resultado'] = "OK";
            $vec ['mensaje'] = "La marca ha sido guardada";
            return $vec;    
        }


      public function editar($id, $params){
        $editar = "UPDATE marca SET nombre = '$params->nombre' WHERE id_marca = $id"; // Edita el nombre por id_marca
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "La marca ha sido editada";
        return $vec;
        }
    

        public function filtro($valor){
            $filtro = "SELECT * FROM marca WHERE nombre LIKE '%$valor%'"; // Filtra por nombre
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];
            
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){ // Usamos MYSQLI_ASSOC
                $vec[] = $row;
        }

        return $vec;
    }
}

?>