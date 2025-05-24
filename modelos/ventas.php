<?php
    class Ventas{ 
        //atributo
        public $conexion;
        //metodo constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
           }
           

           //metodos
           public function consulta(){
            $con = "SELECT * FROM ventas ORDER BY fecha DESC"; // Consulta la tabla 'ventas'
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){ // Usamos MYSQLI_ASSOC para claves asociativas
                $vec[] = $row;    
            }

            return $vec;

        }

        public function eliminar($id){
            $del = "DELETE FROM ventas WHERE id_ventas = $id"; // Elimina por id_ventas
            mysqli_query($this->conexion, $del);
            $vec   = [];
            $vec ['resultado'] = "OK";
            $vec ['mensaje'] = 'La venta ha sido eliminada';
            return $vec;
        }

        public function insertar($params){
            // Campos a insertar: fecha, fo_cliente, fo_producto, total, subtotal, iva, fo_usuario
            // Asumimos que fecha, total, subtotal, iva son numéricos o formato de fecha correcto para la DB
            $ins = "INSERT INTO ventas(fecha, fo_cliente, fo_producto, total, subtotal, iva, fo_usuario) VALUES(
                '$params->fecha', 
                $params->fo_cliente, 
                $params->fo_producto, 
                $params->total, 
                $params->subtotal, 
                $params->iva, 
                $params->fo_usuario
            )";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ['resultado'] = "OK";
            $vec ['mensaje'] = "La venta ha sido guardada";
            return $vec;    
        }


      public function editar($id, $params){
        // Campos a editar: fecha, fo_cliente, fo_producto, total, subtotal, iva, fo_usuario
        $editar = "UPDATE ventas SET 
            fecha = '$params->fecha', 
            fo_cliente = $params->fo_cliente, 
            fo_producto = $params->fo_producto, 
            total = $params->total, 
            subtotal = $params->subtotal, 
            iva = $params->iva, 
            fo_usuario = $params->fo_usuario 
            WHERE id_ventas = $id"; // Edita por id_ventas
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "La venta ha sido editada";
        return $vec;
        }
    

        public function filtro($valor){
            // Filtra por fecha o ID de cliente (puedes ajustar los campos de filtro)
            $filtro = "SELECT * FROM ventas WHERE fecha LIKE '%$valor%' OR fo_cliente = '$valor'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];
            
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){ // Usamos MYSQLI_ASSOC
                $vec[] = $row;
        }

        return $vec;
    }
}

?>