<?php
    class Compra{
        //atributo
        public $conexion;
        //metodo constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
           }
           

           //metodos
            public function consulta(){
            $con = "SELECT * FROM compras ORDER BY fecha DESC";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            // AQUI ESTA EL CAMBIO IMPORTANTE: MYSQLI_ASSOC
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                $vec[] = $row;    
            }

            return $vec;


        }

        public function eliminar($id){
            // El ID es id_compras
            $del = "DELETE FROM compras WHERE id_compras = $id";
            mysqli_query($this->conexion, $del);
            $vec   = [];
            $vec ['resultado'] = "OK";
            $vec ['mensaje'] = 'La compra ha sido eliminada';
            return $vec;
        }

        public function insertar($params){
            // Los campos son: fecha, fo_productos, total, subtotal, iva, cantidad
            // Asumimos que los valores en $params ya vienen formateados para la DB
            $ins = "INSERT INTO compras(fecha, fo_productos, total, subtotal, iva, cantidad) VALUES(
                '$params->fecha', 
                $params->fo_productos, 
                $params->total, 
                $params->subtotal, 
                $params->iva, 
                $params->cantidad
            )";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ['resultado'] = "OK";
            $vec ['mensaje'] = "La compra ha sido guardada";
            return $vec;    
        }


      public function editar($id, $params){
        // Los campos a editar son: fecha, fo_productos, total, subtotal, iva, cantidad
        // Usamos el ID correcto: id_compras
        $editar = "UPDATE compras SET 
            fecha = '$params->fecha', 
            fo_productos = $params->fo_productos, 
            total = $params->total, 
            subtotal = $params->subtotal, 
            iva = $params->iva, 
            cantidad = $params->cantidad 
            WHERE id_compras = $id";
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "La compra ha sido editada";
        return $vec;
        }
    

        public function filtro($valor){
            // El filtro para compras podría ser por fecha o por el ID de producto
            // Aquí buscaremos por fecha (texto) o por ID de producto (número)
            $filtro = "SELECT * FROM compras WHERE fecha LIKE '%$valor%' OR fo_productos = '$valor'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];
            
            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
        }

        return $vec;
    }
}

?>