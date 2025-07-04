<?php

class Mascota {
    private $idMascota;
    private $idCliente; // Este ID se relaciona con la clase Cliente
    private $nombreMascota;
    private $idEspecie; // Cambio de nombre para mayor claridad
    private $idRaza; // Cambio de nombre para mayor claridad
    private $sexo;
    private $fechaNacimiento;
    private $descripcion;
    private $tieneCita;
    private $connect;

    public function __construct() {
        try {
            $this->connect = conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Métodos para acceder y modificar los atributos
    public function getIdMascota() { return $this->idMascota; }
    public function setIdMascota($idMascota) { $this->idMascota = $idMascota; }

    public function getIdCliente() { return $this->idCliente; }
    public function setIdCliente($idCliente) { $this->idCliente = $idCliente; }

    public function getNombreMascota() { return $this->nombreMascota; }
    public function setNombreMascota($nombreMascota) { $this->nombreMascota = $nombreMascota; }

    public function getIdEspecie() { return $this->idEspecie; } // Agrega este método
    public function setIdEspecie($idEspecie) { $this->idEspecie = $idEspecie; }

    public function getIdRaza() { return $this->idRaza; } // Agrega este método
    public function setIdRaza($idRaza) { $this->idRaza = $idRaza; }

    public function getSexo() { return $this->sexo; }
    public function setSexo($sexo) { $this->sexo = $sexo; }

    public function getFechaNacimiento() { return $this->fechaNacimiento; }
    public function setFechaNacimiento($fechaNacimiento) { $this->fechaNacimiento = $fechaNacimiento; }

    public function getDescripcion() { return $this->descripcion; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }

    public function getTieneCita() { return $this->tieneCita; }
    public function setTieneCita($tieneCita) { $this->tieneCita = $tieneCita; }

    // Método para contar machos y hembras
    public function contarMachosYHembras() {
        try {
            $query = "SELECT Sexo, COUNT(*) as Total FROM mascota GROUP BY Sexo";
            $resultado = $this->connect->prepare($query);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para listar todas las mascotas

    public function listarPorLetra($letra) {
        try {
            $letra = strtoupper($letra); // Convertir a mayúscula
            $query = "SELECT 
                        m.Id_Mascota, 
                        c.Id_Cliente,
                        c.Nombres, 
                        c.Apellidos, 
                        m.Nombre_Mascota, 
                        e.Nombre_Especie,  
                        r.Nombre_Raza,     
                        m.Sexo, 
                        m.Fecha_Nacimiento 
                      FROM mascota m
                      INNER JOIN cliente c ON m.Id_Cliente = c.Id_Cliente
                      INNER JOIN especie e ON m.Id_Especie = e.Id_Especie
                      INNER JOIN raza r ON m.Id_Raza = r.Id_Raza
                      WHERE UPPER(m.Nombre_Mascota) LIKE ? 
                      ORDER BY m.Id_Mascota";
    
            $resultado = $this->connect->prepare($query);
            $resultado->execute([$letra . '%']);
            return $resultado->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw new Exception("Error al buscar mascotas.");
        }
    }
    

    public function listar() {
        try {
            $query = "SELECT 
                m.Id_Mascota, 
                c.Id_Cliente,
                c.Nombres, 
                c.Apellidos, 
                m.Nombre_Mascota, 
                e.Nombre_Especie,  
                r.Nombre_Raza,     
                m.Sexo, 
                m.Fecha_Nacimiento 
              FROM mascota m
              INNER JOIN cliente c ON m.Id_Cliente = c.Id_Cliente
              INNER JOIN especie e ON m.Id_Especie = e.Id_Especie
              INNER JOIN raza r ON m.Id_Raza = r.Id_Raza
              ORDER BY m.Id_Mascota";
            
            $resultado = $this->connect->prepare($query);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para cargar una mascota por ID
    public function cargarID($id) {
        try {
            $query = "SELECT * FROM mascota WHERE Id_Mascota = ?";
            $resultado = $this->connect->prepare($query);
            $resultado->execute(array($id));
            return $resultado->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para registrar una nueva mascota
    public function registrar($data) {
        try {
            $query = "INSERT INTO mascota (Id_Cliente, Nombre_Mascota, Id_Especie, Id_Raza, Sexo, Fecha_Nacimiento, Descripcion, Tiene_Cita) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $this->connect->prepare($query)->execute([
                $data->getIdCliente(),
                $data->getNombreMascota(),
                $data->getIdEspecie(),
                $data->getIdRaza(),
                $data->getSexo(),
                $data->getFechaNacimiento(),
                $data->getDescripcion(),
                $data->getTieneCita()
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para actualizar datos de una mascota
    public function actualizarDatos($data) {
        try {
            $query = "UPDATE mascota SET Id_Cliente = ?, Nombre_Mascota = ?, Id_Especie = ?, Id_Raza = ?, Sexo = ?, Fecha_Nacimiento = ?, Descripcion = ?, Tiene_Cita = ? WHERE Id_Mascota = ?";
            $this->connect->prepare($query)->execute(array(
                $data->getIdCliente(),
                $data->getNombreMascota(),
                $data->getIdEspecie(),
                $data->getIdRaza(),
                $data->getSexo(),
                $data->getFechaNacimiento(),
                $data->getDescripcion(),
                $data->getTieneCita(),
                $data->getIdMascota() // ID de la mascota que se va a actualizar
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para eliminar una mascota
    public function delete($id) {
        try {
            $query = "DELETE FROM mascota WHERE Id_Mascota = ?";
            $resultado = $this->connect->prepare($query);
            $resultado->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerRazas($idEspecie) {
        $query = "SELECT idRaza, nombreRaza FROM raza WHERE idEspecie = ?";
        $stmt = $this->connect->prepare($query);
        $stmt->execute([$idEspecie]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
