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
            $con = "SELECT * FROM empleado ORDER BY nombre"; // Consulta la tabla 'empleado'
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){ // Usamos MYSQLI_ASSOC para claves asociativas
                $vec[] = $row;    
            }

            return $vec;

        }

        public function eliminar($id){
            $del = "DELETE FROM empleado WHERE id_empleado = $id"; // Elimina por id_empleado
            mysqli_query($this->conexion, $del);
            $vec   = [];
            $vec ['resultado'] = "OK";
            $vec ['mensaje'] = 'El empleado ha sido eliminado';
            return $vec;
        }

        public function insertar($params){
            // Campos a insertar: nombre, documento, telefono, direccion, fo_ciudad
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
        // Campos a editar: nombre, documento, telefono, direccion, fo_ciudad
        $editar = "UPDATE empleado SET 
            nombre = '$params->nombre', 
            documento = '$params->documento', 
            telefono = '$params->telefono', 
            direccion = '$params->direccion', 
            fo_ciudad = $params->fo_ciudad 
            WHERE id_empleado = $id"; // Edita por id_empleado
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "El empleado ha sido editado";
        return $vec;
        }
    

        public function filtro($valor){
            // Filtra por nombre, documento o teléfono
            $filtro = "SELECT * FROM empleado WHERE nombre LIKE '%$valor%' OR documento LIKE '%$valor%' OR telefono LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];
            
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){ // Usamos MYSQLI_ASSOC
                $vec[] = $row;
        }

        return $vec;
    }
}

?>