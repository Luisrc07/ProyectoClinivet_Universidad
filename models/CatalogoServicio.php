<?php
// models/CatalogoServicio.php

class CatalogoServicio {
    private $idServicio;
    private $nombreServicio;
    private $descripcion;
    private $precioServicio;
    private $TipoServicio; // Esta propiedad guardará el ID del tipo de servicio (1, 2, 3)

    private $connect;

    // Getters y Setters para las propiedades del CATÁLOGO DE SERVICIOS
    public function getIdServicio() { return $this->idServicio; }
    public function setIdServicio($idServicio) { $this->idServicio = $idServicio; }

    public function getNombreServicio() { return $this->nombreServicio; }
    public function setNombreServicio($nombreServicio) { $this->nombreServicio = $nombreServicio; }

    public function getDescripcion() { return $this->descripcion; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }

    public function getPrecioServicio() { return $this->precioServicio; }
    public function setPrecioServicio($precioServicio) { $this->precioServicio = $precioServicio; }

    public function getTipoServicio() { return $this->TipoServicio; }
    public function setTipoServicio($TipoServicio) { $this->TipoServicio = $TipoServicio; }


    public function __construct() {
        try {
            // Asegúrate de que 'conexion.php' o donde esté tu clase 'conexion' esté correctamente incluido
            // o que 'conexion::conectar()' sea accesible globalmente.
            $this->connect = conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para listar todos los servicios del CATÁLOGO (tabla 'servicio')
    public function listar() {
        try {
            // *** CORRECCIÓN: Realizar JOIN con 'tipos_servicio' para obtener el 'nombre_tipo' ***
            $query = "SELECT s.Id_Tipo_Servicio, s.Nombre_Servicio, s.Precio_Servicio, s.Descripcion, ts.nombre_tipo as tipo_servicio_nombre
                      FROM servicio s
                      JOIN tipos_servicio ts ON s.tipo_servicio = ts.id
                      ORDER BY s.Id_Tipo_Servicio";
            $resultado = $this->connect->prepare($query);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para cargar un servicio del CATÁLOGO por ID (tabla 'servicio')
    public function cargarID($id) {
        try {
            $query = "SELECT * FROM servicio WHERE Id_Tipo_Servicio = ?";
            $resultado = $this->connect->prepare($query);
            $resultado->execute(array($id));
            return $resultado->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para registrar un nuevo servicio en el CATÁLOGO (tabla 'servicio')
    public function registrar($data) {
        try {
            $query = "INSERT INTO servicio (Nombre_Servicio, tipo_servicio, Descripcion, Precio_Servicio) VALUES (?, ?, ?, ?)";
            $this->connect->prepare($query)->execute(array(
                $data->getNombreServicio(),
                $data->getTipoServicio(), 
                $data->getDescripcion(),
                $data->getPrecioServicio()
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para actualizar datos de un servicio en el CATÁLOGO (tabla 'servicio')
    public function actualizarDatos($data) {
        try {
            $query = "UPDATE servicio SET Nombre_Servicio = ?, tipo_servicio = ?, Descripcion = ?, Precio_Servicio = ? WHERE Id_Tipo_Servicio = ?";
            $this->connect->prepare($query)->execute(array(
                $data->getNombreServicio(),
                $data->getTipoServicio(), // Este es el ID numérico del tipo de servicio
                $data->getDescripcion(),
                $data->getPrecioServicio(),
                $data->getIdServicio()
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para eliminar un servicio del CATÁLOGO (tabla 'servicio')
    public function eliminar($id) {
        try {
            $query = "DELETE FROM servicio WHERE Id_Tipo_Servicio = ?";
            $resultado = $this->connect->prepare($query);
            $resultado->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}