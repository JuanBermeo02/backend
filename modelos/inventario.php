<?php
class Inventario {
  private $conexion;

  public function __construct($conexion) {
    $this->conexion = $conexion;
  }

  public function consulta() {
  $sql = "SELECT 
            i.id_inventario,
            i.cantidad,
            i.fecha_actualizacion,
            p.id_productos AS fo_productos,
            p.nombre AS nombre_producto
          FROM inventario i
          JOIN productos p ON i.fo_productos = p.id_productos";

  $res = mysqli_query($this->conexion, $sql);
  $vec = [];
  while ($reg = mysqli_fetch_assoc($res)) {
    $vec[] = $reg;
  }
  return $vec;
}


  public function insertar($params) {
    $fo_productos = (int) $params->fo_productos;
    $cantidad = (int) $params->cantidad;
    $fecha = mysqli_real_escape_string($this->conexion, $params->fecha_actualizacion);

    $sql = "INSERT INTO inventario (fo_productos, cantidad, fecha_actualizacion)
            VALUES ($fo_productos, $cantidad, '$fecha')";
    mysqli_query($this->conexion, $sql);
    return ['resultado' => 'OK'];
  }

  public function editar($id, $params) {
  $id = (int) $id;
  $fo_productos = (int) $params->fo_productos;
  $cantidad = (int) $params->cantidad;
  $fecha = mysqli_real_escape_string($this->conexion, $params->fecha_actualizacion);

  $sql = "UPDATE inventario SET 
            fo_productos = $fo_productos,
            cantidad = $cantidad,
            fecha_actualizacion = '$fecha'
          WHERE id_inventario = $id";  
  mysqli_query($this->conexion, $sql);

  return ['resultado' => 'OK'];
}
  public function eliminar($id) {
  $id = (int) $id;
  $sql = "DELETE FROM inventario WHERE id_inventario = $id";  
  mysqli_query($this->conexion, $sql);

  return ['resultado' => 'OK'];
}
}
?>
