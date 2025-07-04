<?php
class ServicioRealizado {
    private $idServicioRealizado;
    private $idMascota;
    private $idEmpleado;
    private $informacionAdicional;
    private $citaPrevia;
    private $proximaCita;
    private $connect;

    // Constructor para inicializar la conexión a la base de datos
    public function __construct() {
        try {
            $this->connect = conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Métodos para acceder y modificar los atributos
    public function getIdServicioRealizado() { return $this->idServicioRealizado; }
    public function setIdServicioRealizado($idServicioRealizado) { $this->idServicioRealizado = $idServicioRealizado; }



    public function getIdMascota() { return $this->idMascota; }
    public function setIdMascota($idMascota) { $this->idMascota = $idMascota; }

    public function getIdEmpleado() { return $this->idEmpleado; }
    public function setIdEmpleado($idEmpleado) { $this->idEmpleado = $idEmpleado; }

    public function getInformacionAdicional() { return $this->informacionAdicional; }
    public function setInformacionAdicional($informacionAdicional) { $this->informacionAdicional = $informacionAdicional; }

    public function getCitaPrevia() { return $this->citaPrevia; }
    public function setCitaPrevia($citaPrevia) { $this->citaPrevia = $citaPrevia; }

    public function getProximaCita() { return $this->proximaCita; }
    public function setProximaCita($proximaCita) { $this->proximaCita = $proximaCita; }

    // Método para listar todos los servicios realizados
    public function listar() {
        try {
            $query = "SELECT sr.*, m.Nombre_Mascota, e.Nombres AS Nombre_Empleado 
                      FROM servicio_realizado sr
                      INNER JOIN mascota m ON sr.Id_Mascota = m.Id_Mascota
                      INNER JOIN empleado e ON sr.Id_Empleado = e.Id_Empleado
                      ORDER BY sr.Id_Servicio_Realizado";

            $resultado = $this->connect->prepare($query);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para obtener un servicio realizado por ID
    public function cargarID($id) {
        try {
            $query = "SELECT * FROM servicio_realizado WHERE Id_Servicio_Realizado = ?";
            $resultado = $this->connect->prepare($query);
            $resultado->execute(array($id));
            return $resultado->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para registrar un nuevo servicio realizado
    public function guardarConTransaccion($data) {
        $this->connect->beginTransaction();
        try {
            if (empty($data->getIdServicioRealizado())) {
                $query = "INSERT INTO servicio_realizado (Id_Mascota, Id_Empleado, Informacion_Adicional, Cita_Previa, Proxima_Cita) VALUES (?, ?, ?, ?, ?)";
                $this->connect->prepare($query)->execute(array( $data->getIdMascota(), $data->getIdEmpleado(), $data->getInformacionAdicional(), $data->getCitaPrevia(), $data->getProximaCita()));
            } else {
                $query = "UPDATE servicio_realizado SET Id_Mascota = ?, Id_Empleado = ?, Informacion_Adicional = ?, Cita_Previa = ?, Proxima_Cita = ? WHERE Id_Servicio_Realizado = ?";
                $this->connect->prepare($query)->execute(array($data->getIdMascota(), $data->getIdEmpleado(), $data->getInformacionAdicional(), $data->getCitaPrevia(), $data->getProximaCita(), $data->getIdServicioRealizado()));
            }
            $this->connect->commit();
        } catch (Exception $e) {
            $this->connect->rollBack();
            throw $e; // Rethrow the exception for handling in the controller
        }
    }

    // Método para actualizar datos de un servicio realizado
    public function actualizarDatos($data) {
        try {
            $query = "UPDATE servicio_realizado SET Id_Mascota = ?, Id_Empleado = ?, Informacion_Adicional = ?, Cita_Previa = ?, Proxima_Cita = ? WHERE Id_Servicio_Realizado = ?";
            $this->connect->prepare($query)->execute(array($data->getIdMascota(), $data->getIdEmpleado(), $data->getInformacionAdicional(), $data->getCitaPrevia(), $data->getProximaCita(), $data->getIdServicioRealizado()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para eliminar un servicio realizado
    public function delete($id) {
        try {
            $query = "DELETE FROM servicio_realizado WHERE Id_Servicio_Realizado = ?";
            $resultado = $this->connect->prepare($query);
            $resultado->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function listarMascotas() {
        try {
            $query = "SELECT 
                m.Id_Mascota, 
                c.Nombres, 
                c.Apellidos, 
                m.Nombre_Mascota
            FROM mascota m
            INNER JOIN cliente c ON m.Id_Cliente = c.Id_Cliente
            ORDER BY m.Id_Mascota";
            
            $resultado = $this->connect->prepare($query);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function listarEmpleados() {
        try {
            $query = "SELECT Id_Empleado, Nombres, Apellidos FROM empleado ORDER BY Id_Empleado";
            $resultado = $this->connect->prepare($query);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
?>
