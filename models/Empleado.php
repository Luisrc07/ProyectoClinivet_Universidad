<?php

class Empleado {

    public $idEmpleado;
    public $cedula;
    public $nombres;
    public $apellidos;
    public $correo;
    public $direccion;
    public $fechaNacimiento;
    public $especializacion;
    public $desempeño;
    public $connect;

    public function __construct() {
        try {
            $this->connect = conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Métodos para acceder y modificar los atributos
    public function getIdEmpleado() { return $this->idEmpleado; }
    public function setIdEmpleado($idEmpleado) { $this->idEmpleado = $idEmpleado; }

    public function getCedula() { return $this->cedula; }
    public function setCedula($cedula) { $this->cedula = $cedula; }

    public function getNombres() { return $this->nombres; }
    public function setNombres($nombres) { $this->nombres = $nombres; }

    public function getApellidos() { return $this->apellidos; }
    public function setApellidos($apellidos) { $this->apellidos = $apellidos; }

    public function getCorreo() { return $this->correo; }
    public function setCorreo($correo) { $this->correo = $correo; }

    public function getDireccion() { return $this->direccion; }
    public function setDireccion($direccion) { $this->direccion = $direccion; }

    public function getFechaNacimiento() { return $this->fechaNacimiento; }
    public function setFechaNacimiento($fechaNacimiento) { $this->fechaNacimiento = $fechaNacimiento; }

    public function getEspecializacion() { return $this->especializacion; }
    public function setEspecializacion($especializacion) { $this->especializacion = $especializacion; }

    public function getDesempeño() { return $this->desempeño; }
    public function setDesempeño($desempeño) { $this->desempeño = $desempeño; }

    // Método para listar todos los empleados
    public function listar() {
        try {
            $query = "SELECT Id_Empleado, Cedula, Nombres, Apellidos, Correo, Direccion, Fecha_Nacimiento, Especializacion, Desempeño FROM empleado ORDER BY Id_Empleado"; // Cambiar tbempleado a empleado



            $resultado = $this->connect->prepare($query);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para cargar un empleado por ID
    public function cargarID($id) {
        try {
            $query = "SELECT * FROM empleado WHERE Id_Empleado = ?";
            $resultado = $this->connect->prepare($query);
            $resultado->execute(array($id));
            return $resultado->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para registrar un nuevo empleado
    // Método para registrar un nuevo empleado
    public function registrar($data) {
        // Validación básica
        if (empty($data->cedula) || empty($data->nombres) || empty($data->apellidos)) {
            throw new Exception("Los campos cédula, nombres y apellidos son obligatorios.");
        }
    
        try {
            $query = "INSERT INTO empleado (Cedula, Nombres, Apellidos, Correo, Direccion, Fecha_Nacimiento, Especializacion, Desempeño) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect->prepare($query);
            $stmt->execute(array(
                $data->cedula,
                $data->nombres,
                $data->apellidos,
                $data->correo,
                $data->direccion,
                $data->fechaNacimiento,
                $data->especializacion,
                $data->desempeño
            ));
        } catch (Exception $e) {
            error_log("Error in registrar: " . $e->getMessage()); // Registrar información detallada del error en el log
            throw new Exception("Error al registrar el empleado: " . $e->getMessage()); // Mensaje detallado para el usuario
        }
    }
    


    // Método para actualizar datos de un empleado
    public function actualizarDatos($data) {
        try {
            $query = "UPDATE empleado SET Cedula = ?, Nombres = ?, Apellidos = ?, Correo = ?, Direccion = ?, Fecha_Nacimiento = ?, Especializacion  = ?, Desempeño = ? WHERE Id_Empleado = ?";
            $this->connect->prepare($query)->execute(array(
                $data->cedula,
                $data->nombres,
                $data->apellidos,
                $data->correo,
                $data->direccion,
                $data->fechaNacimiento,
                $data->especializacion,
                $data->desempeño,
                $data->idEmpleado // ID del empleado que se va a actualizar
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para eliminar un empleado
    public function delete($id) {
        try {
            $query = "DELETE FROM empleado WHERE Id_Empleado = ?";
            $resultado = $this->connect->prepare($query);
            $resultado->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    
        // ... otros métodos y atributos ...
        
        public function buscarPorCedula($cedula) {
            $query = $this->connect->prepare("SELECT * FROM empleado WHERE Cedula = :cedula");
            $query->bindParam(':cedula', $cedula);
            $query->execute();
            return $query->fetch();
        }
    
        public function buscarPorCorreo($correo) {
            $query = $this->connect->prepare("SELECT * FROM empleado WHERE Correo = :correo");
            $query->bindParam(':correo', $correo);
            $query->execute();
            return $query->fetch();
        }
        
        
    
    
    
}

?>
