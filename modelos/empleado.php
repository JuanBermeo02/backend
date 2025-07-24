<?php
    class Empleado{
        //atributo
        public $conexion;
        //metodo constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
           }
           

           //metodos
           public function consulta(){
            $con = "SELECT * FROM empleado ORDER BY nombre"; 
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){ 
                $vec[] = $row;    
            }

            return $vec;

        }
        public function eliminar($id){
            $del = "DELETE FROM empleado WHERE id_empleado = $id"; 
            mysqli_query($this->conexion, $del);
            $vec   = [];
            $vec ['resultado'] = "OK";
            $vec ['mensaje'] = 'El empleado ha sido eliminado';
            return $vec;
        }

        public function insertar($params){
            $ins = "INSERT INTO empleado(nombre, documento, telefono, direccion, fo_ciudad) VALUES(
                '$params->nombre', 
                '$params->documento', 
                '$params->telefono', 
                '$params->direccion', 
                $params->fo_ciudad // Asumimos que fo_ciudad es INT
            )";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ['resultado'] = "OK";
            $vec ['mensaje'] = "El empleado ha sido guardado";
            return $vec;    
        }


      public function editar($id, $params){
        $editar = "UPDATE empleado SET 
            nombre = '$params->nombre', 
            documento = '$params->documento', 
            telefono = '$params->telefono', 
            direccion = '$params->direccion', 
            fo_ciudad = $params->fo_ciudad 
            WHERE id_empleado = $id"; 
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "El empleado ha sido editado";
        return $vec;
        }
    

        public function filtro($valor){
            $filtro = "SELECT * FROM empleado WHERE nombre LIKE '%$valor%' OR documento LIKE '%$valor%' OR telefono LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];
            
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){ 
                $vec[] = $row;
        }

        return $vec;
    }
}

?>