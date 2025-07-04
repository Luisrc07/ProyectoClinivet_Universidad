<?php
class Cita {
    private $idCita;
    private $idTipoServicio;
    private $idMascota;
    private $idEmpleado;
    private $fechaCitaActual;
    private $fechaProximaCita;
    private $connect;

    // Métodos para acceder y modificar los atributos
    public function getIdCita() { return $this->idCita; }
    public function setIdCita($idCita) { $this->idCita = $idCita; }

    public function getIdTipoServicio() { return $this->idTipoServicio; }
    public function setIdTipoServicio($idTipoServicio) { $this->idTipoServicio = $idTipoServicio; }

    public function getIdMascota() { return $this->idMascota; }
    public function setIdMascota($idMascota) { $this->idMascota = $idMascota; }

    public function getIdEmpleado() { return $this->idEmpleado; }
    public function setIdEmpleado($idEmpleado) { $this->idEmpleado = $idEmpleado; }

    public function getFechaCitaActual() { return $this->fechaCitaActual; }
    public function setFechaCitaActual($fechaCitaActual) { $this->fechaCitaActual = $fechaCitaActual; }

    public function getFechaProximaCita() { return $this->fechaProximaCita; }
    public function setFechaProximaCita($fechaProximaCita) { $this->fechaProximaCita = $fechaProximaCita; }
    public function __construct() {
        try {
            $this->connect = conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para listar todas las citas
    public function listar(): array {
        try {
            $query = "
                SELECT 
                    c.Id_Cita,
                    c.Id_Tipo_Servicio,
                    c.Id_Mascota,
                    c.Id_Empleado,
                    c.Fecha_cita_actual,
                    c.Fecha_Proxima_cita,
                    mas.Nombre_Mascota AS Nombre_Mascota,
                    emp.Nombres AS Nombre_Empleado,
                    serv.Nombre_Servicio AS Nombre_Tipo_Servicio
                FROM 
                    cita c
                LEFT JOIN 
                    mascota mas ON c.Id_Mascota = mas.Id_Mascota
                LEFT JOIN 
                    empleado emp ON c.Id_Empleado = emp.Id_Empleado
                LEFT JOIN 
                    servicio serv ON c.Id_Tipo_Servicio = serv.Id_Tipo_Servicio
                ORDER BY 
                    c.Id_Cita";
                    
            $resultado = $this->connect->prepare($query);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die("Error al listar citas: " . $e->getMessage());
        }
    }

    // Método para obtener una cita por ID
    public function cargarID($id) {
        try {
            $query = "SELECT * FROM cita WHERE Id_Cita = ?";
            $resultado = $this->connect->prepare($query);
            $resultado->execute(array($id));
            return $resultado->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para registrar una nueva cita
    public function registrar($data) {
        try {
            $query = "INSERT INTO cita (Id_Tipo_Servicio, Id_Mascota, Id_Empleado, Fecha_cita_actual, Fecha_Proxima_Cita) VALUES (?, ?, ?, ?, ?)";
            $this->connect->prepare($query)->execute([
            $data->getIdTipoServicio(),
            $data->getIdMascota(),
            $data->getIdEmpleado(),
            $data->getFechaCitaActual(),
            $data->getFechaProximaCita()
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para actualizar datos de una cita
    public function actualizarDatos($data) {
        try {
            $query = "UPDATE cita SET Id_Tipo_Servicio = ?, Id_Mascota = ?, Id_Empleado = ?, Fecha_cita_actual = ?, Fecha_Proxima_Cita = ? WHERE Id_Cita = ?";
            $this->connect->prepare($query)->execute(array(
                $data->getIdTipoServicio(),
                $data->getIdMascota(),
                $data->getIdEmpleado(),
                $data->getFechaCitaActual(),
                $data->getFechaProximaCita(),
                $data->getIdCita()
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para eliminar una cita
    public function delete($id) {
        try {
            $query = "DELETE FROM cita WHERE Id_Cita = ?";
            $resultado = $this->connect->prepare($query);
            $resultado->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
?>
