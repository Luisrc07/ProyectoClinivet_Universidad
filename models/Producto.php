<?php
class Producto {
    private $idProducto;
    private $nombreProducto;
    private $descripcion;
    private $precio;
    private $cantidadStock;
    private $idProveedor; 
    private $connect;

    // Métodos para acceder y modificar los atributos
    public function getIdProducto() { return $this->idProducto; }
    public function setIdProducto($idProducto) { $this->idProducto = $idProducto; }

    public function getNombreProducto() { return $this->nombreProducto; }
    public function setNombreProducto($nombreProducto) { $this->nombreProducto = $nombreProducto; }

    public function getDescripcion() { return $this->descripcion; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }

    public function getPrecio() { return $this->precio; }
    public function setPrecio($precio) { $this->precio = $precio; }

    public function getCantidadStock() { return $this->cantidadStock; }
    public function setCantidadStock($cantidadStock) { $this->cantidadStock = $cantidadStock; }

    public function getIdProveedor() { return $this->idProveedor; }
    public function setIdProveedor($idProveedor) { $this->idProveedor = $idProveedor; }

    public function __construct() {
        try {
            $this->connect = conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para listar todos los productos
    public function listar(): array {
        try {
            // Modificamos la consulta para incluir el JOIN con la tabla 'proveedor'
            // y seleccionar el 'Nombre_Proveedor' de esa tabla.
            // Usamos un alias 'prov' para la tabla proveedor y 'p' para producto
            // Seleccionamos Nombre_Proveedor como Nombre_Proveedor_Producto_Lista para evitar conflictos
            $query = "
                SELECT 
                    p.Id_Producto,
                    p.Nombre_Producto,
                    p.Descripcion,
                    p.Precio,
                    p.Cantidad_Stock,
                    p.Id_Proveedor,
                    prov.Nombre_Proveedor AS Nombre_Proveedor_Producto_Lista 
                FROM 
                    producto p
                LEFT JOIN 
                    proveedor prov ON p.Id_Proveedor = prov.Id_Proveedor
                ORDER BY 
                    p.Id_Producto";
                    
            $resultado = $this->connect->prepare($query);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die("Error al listar productos con nombre de proveedor: " . $e->getMessage());
        }
    }

    // Método para obtener un producto por ID
    public function cargarID($id) {
        try {
            $query = "SELECT * FROM producto WHERE Id_Producto = ?";
            $resultado = $this->connect->prepare($query);
            $resultado->execute(array($id));
            return $resultado->fetch(PDO::FETCH_OBJ); // Asegúrate de que esto devuelva un objeto
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para registrar un nuevo producto
    public function registrar($data) {
        try {
            $query = "INSERT INTO producto (Nombre_Producto, Descripcion, Precio, Cantidad_Stock, Id_Proveedor) VALUES (?, ?, ?, ?, ?)";
            $this->connect->prepare($query)->execute(array($data->getNombreProducto(), $data->getDescripcion(), $data->getPrecio(), $data->getCantidadStock(), $data->getIdProveedor()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para actualizar datos de un producto
    public function actualizarDatos($data) {
        try {
            $query = "UPDATE producto SET Nombre_Producto = ?, Descripcion = ?, Precio = ?, Cantidad_Stock = ?, Id_Proveedor = ? WHERE Id_Producto = ?";
            $this->connect->prepare($query)->execute(array($data->getNombreProducto(), $data->getDescripcion(), $data->getPrecio(), $data->getCantidadStock(), $data->getIdProveedor(), $data->getIdProducto()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para eliminar un producto
    public function delete($id) {
        try {
            $query = "DELETE FROM producto WHERE Id_Producto = ?";
            $resultado = $this->connect->prepare($query);
            $resultado->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}

?>

