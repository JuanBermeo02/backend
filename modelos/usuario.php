<?php
    class Usuario{ 
        //atributo
        public $conexion;
        //metodo constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
           }
           

           //metodos
           public function consulta(){
            $con = "SELECT * FROM usuario ORDER BY nombre"; // Consulta la tabla 'usuario'
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){ // Usamos MYSQLI_ASSOC para claves asociativas
                $vec[] = $row;    
            }

            return $vec;

        }

        public function eliminar($id){
            $del = "DELETE FROM usuario WHERE id_usuario = $id"; // Elimina por id_usuario
            mysqli_query($this->conexion, $del);
            $vec   = [];
            $vec ['resultado'] = "OK";
            $vec ['mensaje'] = 'El usuario ha sido eliminado';
            return $vec;
        }

        public function insertar($params){
            // Campos a insertar: clave, nombre, correo, tipo_usuario
            $ins = "INSERT INTO usuario(clave, nombre, correo, tipo_usuario) VALUES(
                '$params->clave', 
                '$params->nombre', 
                '$params->correo', 
                '$params->tipo_usuario'
            )";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ['resultado'] = "OK";
            $vec ['mensaje'] = "El usuario ha sido guardado";
            return $vec;    
        }


      public function editar($id, $params){
        // Campos a editar: clave, nombre, correo, tipo_usuario
        $editar = "UPDATE usuario SET 
            clave = '$params->clave', 
            nombre = '$params->nombre', 
            correo = '$params->correo', 
            tipo_usuario = '$params->tipo_usuario' 
            WHERE id_usuario = $id"; // Edita por id_usuario
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "El usuario ha sido editado";
        return $vec;
        }
    

        public function filtro($valor){
            // Filtra por nombre o correo
            $filtro = "SELECT * FROM usuario WHERE nombre LIKE '%$valor%' OR correo LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];
            
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){ // Usamos MYSQLI_ASSOC
                $vec[] = $row;
        }

        return $vec;
    }
}

?>