<?php
    class Ciudad{
        //atributo
        public $conexion;
        //metodo constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
           }
           

           //metodos
           public function consulta(){
            $con = "SELECT * FROM ciudad ORDER BY nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;    
            }

            return $vec;

        }

        public function eliminar($id){
            $del = "DELETE FROM ciudad WHERE id_ciudad = $id";
            mysqli_query($this->conexion, $del);
            $vec   = [];
            $vec ['resultado'] = "OK";
            $vec ['mensaje'] = 'La ciudad ha sido eliminada';
            return $vec;
        }

        public function insertar($params){
            $ins = "INSERT INTO ciudad(nombre, fo_dpto) VALUES('$params->nombre', '$params->fo_dpto')";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ['resultado'] = "OK";
            $vec ['mensaje'] = "La ciudad ha sido guardada";
            return $vec;    
        }


      public function editar($id, $params){
        $editar = "UPDATE ciudad SET nombre = '$params->nombre', fo_dpto = '$params->fo_dpto' WHERE id_ciudad = $id";
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "La ciudad ha sido editada";
        return $vec;
        }
    

        public function filtro($valor){
            $filtro = "SELECT * FROM ciudad WHERE nombre LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];
            
            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
        }

        return $vec;
    }
}

?>