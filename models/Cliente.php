<?php
class Cliente {
    private int $idCliente;
    private int $cedula; // Cambiado a int para que coincida con la base de datos
    private string $nombres;
    private string $apellidos;
    private string $correo;
    private string $direccion;
    private $connect;

    // Métodos para acceder y modificar los atributos
    public function getIdCliente() { return $this->idCliente; }
    public function setIdCliente($idCliente) { $this->idCliente = $idCliente; }

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

    public function __construct() {
        try {
            $this->connect = conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para listar todos los clientes
    public function listar() {
        try {
            $query = "SELECT * FROM cliente ORDER BY Id_Cliente"; // Cambiado a 'cliente' y 'Id_Cliente'
            $resultado = $this->connect->prepare($query);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


        // Método para obtener un cliente por ID
        public function cargarID($id) {
            try {
                $query = "SELECT * FROM cliente WHERE Id_Cliente = ?";
                $resultado = $this->connect->prepare($query);
                $resultado->execute(array($id));
                return $resultado->fetch(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
    
    
    

    // Método para registrar un nuevo cliente
    public function registrar($data) {
        // Validación de datos
        if (empty($data->getCedula()) || empty($data->getNombres()) || empty($data->getApellidos()) || empty($data->getCorreo()) || empty($data->getDireccion())) {
            throw new Exception("Error: Todos los campos son obligatorios.");
        }

        if (!filter_var($data->getCorreo(), FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Error: El correo no es válido.");
        }

        // Intentar registrar el cliente
        try {
            $query = "INSERT INTO cliente (Cédula, Nombres, Apellidos, Correo, Direccion) VALUES (?, ?, ?, ?, ?)";
            $this->connect->prepare($query)->execute(array($data->getCedula(), $data->getNombres(), $data->getApellidos(), $data->getCorreo(), $data->getDireccion()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para actualizar datos de un cliente
    public function actualizarDatos($data) {
        try {
            $query = "UPDATE cliente SET Cédula = ?, Nombres = ?, Apellidos = ?, Correo = ?, Direccion = ? WHERE Id_Cliente = ?"; // Cambiado a 'cliente' y nombres de columnas
            $this->connect->prepare($query)->execute(array($data->getCedula(), $data->getNombres(), $data->getApellidos(), $data->getCorreo(), $data->getDireccion(), $data->getIdCliente()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para eliminar un cliente
    public function delete($id) {
        try {
            $query = "DELETE FROM cliente WHERE Id_Cliente = ?"; // Cambiado a 'cliente' y 'Id_Cliente'
            $resultado = $this->connect->prepare($query);
            $resultado->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function existeCedula($cedula) {
        try {
            $query = "SELECT COUNT(*) as count FROM cliente WHERE Cédula = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->execute([$cedula]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function existeCorreo($correo) {
        try {
            $query = "SELECT COUNT(*) as count FROM cliente WHERE Correo = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->execute([$correo]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function eliminarMascotasPorCliente($idCliente) {
        try {
            $query = "DELETE FROM mascota WHERE Id_Cliente = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->execute([$idCliente]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
}
?>
