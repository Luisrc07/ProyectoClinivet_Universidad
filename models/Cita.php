<?php
class Cita {
    private $Id_Cita;
    private $Id_Tipo_Servicio;
    private $Id_Mascota;
    private $Id_Empleado;
    private $Fecha_cita_actual;
    private $Fecha_Proxima_cita;
    private $CNX;

    // Métodos para acceder y modificar los atributos
    public function getIdCita() { return $this->Id_Cita; }
    public function setIdCita($Id_Cita) { $this->Id_Cita = $Id_Cita; }

    public function getIdTipoServicio() { return $this->Id_Tipo_Servicio; }
    public function setIdTipoServicio($Id_Tipo_Servicio) { $this->Id_Tipo_Servicio = $Id_Tipo_Servicio; }

    public function getIdMascota() { return $this->Id_Mascota; }
    public function setIdMascota($Id_Mascota) { $this->Id_Mascota = $Id_Mascota; }

    public function getIdEmpleado() { return $this->Id_Empleado; }
    public function setIdEmpleado($Id_Empleado) { $this->Id_Empleado = $Id_Empleado; }

    public function getFechacitaActual() { return $this->Fecha_cita_actual; }
    public function setFechacitaActual($Fecha_cita_actual) { $this->Fecha_cita_actual = $Fecha_cita_actual; }

    public function getFechaProximacita() { return $this->Fecha_Proxima_cita; }
    public function setFechaProximacita($Fecha_Proxima_cita) { $this->Fecha_Proxima_cita = $Fecha_Proxima_cita; }

    public function __construct(){
        try {
            $this->CNX = conexion::conectar();
        } catch (Exception $e){
            die($e->getMessage());
        }
    }

    /**
     * Listar todas las citas.
     * @return array
     */
    public function listar(): array {
        try {
            $query = "SELECT * FROM cita";
            $resultado = $this->CNX->prepare($query);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Cargar una cita por su ID.
     * @param int $id
     * @return object
     */
    public function cargarID(int $id): object {
        try {
            $query = "SELECT * FROM cita WHERE Id_Cita = ?";
            $resultado = $this->CNX->prepare($query);
            $resultado->execute([$id]);
            return $resultado->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Registrar una nueva cita.
     * @param object $data
     */
    public function registrar(object $data): void {
        try {
            $query = "INSERT INTO cita (Id_Tipo_Servicio, Id_Mascota, Id_Empleado, Fecha_cita_actual, Fecha_Proxima_cita) VALUES (?, ?, ?, ?, ?)";
            $this->CNX->prepare($query)->execute([$data->Id_Tipo_Servicio, $data->Id_Mascota, $data->Id_Empleado, $data->Fecha_cita_actual, $data->Fecha_Proxima_cita]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Actualizar los datos de una cita.
     * @param object $data
     */
    public function actualizarDatos(object $data): void {
        try {
            $query = "UPDATE cita SET Id_Tipo_Servicio = ?, Id_Mascota = ?, Id_Empleado = ?, Fecha_cita_actual = ?, Fecha_Proxima_cita = ? WHERE Id_Cita = ?";
            $this->CNX->prepare($query)->execute([$data->Id_Tipo_Servicio, $data->Id_Mascota, $data->Id_Empleado, $data->Fecha_cita_actual, $data->Fecha_Proxima_cita, $data->Id_Cita]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Eliminar una cita por su ID.
     * @param int $id
     */
    public function delete(int $id): void {
        try {
            $query = "DELETE FROM cita WHERE Id_Cita = ?";
            $resultado = $this->CNX->prepare($query);
            $resultado->execute([$id]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
?>