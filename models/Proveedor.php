<?php
class Proveedor {
    private $idProveedor;
    private $nombreProveedor;
    private $contacto;
    private $telefono;
    private $correo;
    private $connect;

    // Métodos para acceder y modificar los atributos
    public function getIdProveedor() { return $this->idProveedor; }
    public function setIdProveedor($idProveedor) { $this->idProveedor = $idProveedor; }

    public function getNombreProveedor() { return $this->nombreProveedor; }
    public function setNombreProveedor($nombreProveedor) { $this->nombreProveedor = $nombreProveedor; }

    public function getContacto() { return $this->contacto; }
    public function setContacto($contacto) { $this->contacto = $contacto; }

    public function getTelefono() { return $this->telefono; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }

    public function getCorreo() { return $this->correo; }
    public function setCorreo($correo) { $this->correo = $correo; }

    public function __construct() {
        try {
            $this->connect = conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para listar todos los proveedores
    public function listar() {
        try {
            $query = "SELECT * FROM proveedor ORDER BY Id_Proveedor";
            $resultado = $this->connect->prepare($query);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para obtener un proveedor por ID
    public function cargarID($id) {
        try {
            $query = "SELECT * FROM proveedor WHERE Id_Proveedor = ?";
            $resultado = $this->connect->prepare($query);
            $resultado->execute(array($id));
            return $resultado->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para registrar un nuevo proveedor
    public function registrar($data) {
        try {
            $query = "INSERT INTO proveedor (Nombre_Proveedor, Contacto, Telefono, Correo) VALUES (?, ?, ?, ?)";
            $this->connect->prepare($query)->execute(array($data->getNombreProveedor(), $data->getContacto(), $data->getTelefono(), $data->getCorreo()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para actualizar datos de un proveedor
    public function actualizarDatos($data) {
        try {
            $query = "UPDATE proveedor SET Nombre_Proveedor = ?, Contacto = ?, Telefono = ?, Correo = ? WHERE Id_Proveedor = ?";
            $this->connect->prepare($query)->execute(array($data->getNombreProveedor(), $data->getContacto(), $data->getTelefono(), $data->getCorreo(), $data->getIdProveedor()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para eliminar un proveedor
    public function delete($id) {
        try {
            $query = "DELETE FROM proveedor WHERE Id_Proveedor = ?";
            $resultado = $this->connect->prepare($query);
            $resultado->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
?>
