<?php
    class Productos{ 
        //atributo
        public $conexion;
        //metodo constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
           }
           

           //metodos
           public function consulta(){
            $con = "SELECT * FROM productos ORDER BY nombre"; // Consulta la tabla 'productos'
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){ // Usamos MYSQLI_ASSOC para claves asociativas
                $vec[] = $row;    
            }

            return $vec;

        }

        public function eliminar($id){
            $del = "DELETE FROM productos WHERE id_productos = $id"; // Elimina por id_productos
            mysqli_query($this->conexion, $del);
            $vec   = [];
            $vec ['resultado'] = "OK";
            $vec ['mensaje'] = 'El producto ha sido eliminado';
            return $vec;
        }

        public function insertar($params){
            // Campos a insertar: codigo, nombre, fo_categoria, valor_compra, valor_venta, fo_proveedor, fo_marca
            // Asumimos que valor_compra y valor_venta son numéricos en la DB, por eso no llevan comillas simples
            $ins = "INSERT INTO productos(codigo, nombre, fo_categoria, valor_compra, valor_venta, fo_proveedor, fo_marca) VALUES(
                '$params->codigo', 
                '$params->nombre', 
                $params->fo_categoria, 
                $params->valor_compra, 
                $params->valor_venta, 
                $params->fo_proveedor, 
                $params->fo_marca
            )";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ['resultado'] = "OK";
            $vec ['mensaje'] = "El producto ha sido guardado";
            return $vec;    
        }


      public function editar($id, $params){
        // Campos a editar: codigo, nombre, fo_categoria, valor_compra, valor_venta, fo_proveedor, fo_marca
        $editar = "UPDATE productos SET 
            codigo = '$params->codigo', 
            nombre = '$params->nombre', 
            fo_categoria = $params->fo_categoria, 
            valor_compra = $params->valor_compra, 
            valor_venta = $params->valor_venta, 
            fo_proveedor = $params->fo_proveedor, 
            fo_marca = $params->fo_marca 
            WHERE id_productos = $id"; // Edita por id_productos
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "El producto ha sido editado";
        return $vec;
        }
    

        public function filtro($valor){
            // Filtra por codigo o nombre del producto
            $filtro = "SELECT * FROM productos WHERE codigo LIKE '%$valor%' OR nombre LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];
            
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){ // Usamos MYSQLI_ASSOC
                $vec[] = $row;
        }

        return $vec;
    }
}

?>