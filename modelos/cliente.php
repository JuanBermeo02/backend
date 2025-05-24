<?php
    class Cliente{
        //atributo
        public $conexion;
        //metodo constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
           }
           

           //metodos
           public function consulta(){
            $con = "SELECT * FROM cliente ORDER BY nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;    
            }

            return $vec;

        }

        public function eliminar($id){
            $del = "DELETE FROM cliente WHERE id_cliente = $id";
            mysqli_query($this->conexion, $del);
            $vec   = [];
            $vec ['resultado'] = "OK";
            $vec ['mensaje'] = 'El cliente ha sido eliminado';
            return $vec;
        }

        public function insertar($params){
            $ins = "INSERT INTO cliente(identificacion, nombre, email, direccion, telefono, fo_ciudad) VALUES('$params->identificacion', '$params->nombre', '$params->email', '$params->direccion', '$params->telefono', '$params->fo_ciudad')";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ['resultado'] = "OK";
            $vec ['mensaje'] = "El cliente ha sido guardado";
            return $vec;    
        }


      public function editar($id, $params){
        $editar = "UPDATE cliente SET identificacion = '$params->identificacion', nombre = '$params->nombre', email = '$params->email', direccion = '$params->direccion', telefono = '$params->telefono', fo_ciudad = '$params->fo_ciudad' WHERE id_cliente = $id";
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "El cliente ha sido editado";
        return $vec;
        }
    

        public function filtro($valor){
            $filtro = "SELECT * FROM cliente WHERE nombre LIKE '%$valor%' OR identificacion LIKE '%$valor%' OR email LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];
            
            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
        }

        return $vec;
    }
}

?>