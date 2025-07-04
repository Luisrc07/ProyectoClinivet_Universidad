<?php   
class Raza {

    private $id_raza;
    private $id_especie; // Relación con la tabla especie
    private $nombre_raza;

    private $connect;

    public function getIdRaza() { return $this->id_raza; }
    public function setIdRaza($id_raza) { $this->id_raza = $id_raza; }

    public function getIdEspecie() { return $this->id_especie; }
    public function setIdEspecie($id_especie) { $this->id_especie = $id_especie; }

    public function getNombreRaza() { return $this->nombre_raza; }
    public function setNombreRaza($nombre_raza) { $this->nombre_raza = $nombre_raza; }

    public function __construct() {
        try {
            $this->connect = conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function listar() {
        try {
            $query = "SELECT * FROM raza ORDER BY Id_Raza";
            $resultado = $this->connect->prepare($query);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function cargarID($id) {
        try {
            $query = "SELECT * FROM raza WHERE Id_Raza = ?";
            $resultado = $this->connect->prepare($query);
            $resultado->execute(array($id));
            $raza = $resultado->fetch(PDO::FETCH_OBJ);
            return $raza; // Asegúrate de que esto devuelva un objeto con el ID correcto
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function registrar($data) {
        // Validación de datos
        if (empty($data->getNombreRaza()) || empty($data->getIdEspecie())) {
            throw new Exception("Error: Todos los campos son obligatorios.");
        }
    
        // Intentar registrar la raza
        try {
            $query = "INSERT INTO raza (Id_Especie, Nombre_Raza) VALUES (?, ?)";
            $this->connect->prepare($query)->execute(array($data->getIdEspecie(), $data->getNombreRaza()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizarDatos($data) {
        try {
            $query = "UPDATE raza SET Id_Especie = ?, Nombre_Raza = ? WHERE Id_Raza = ?";
            $this->connect->prepare($query)->execute(array($data->getIdEspecie(), $data->getNombreRaza(), $data->getIdRaza()));
            echo "Datos actualizados: " . $data->getIdRaza(); // Mensaje de depuración
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $query = "DELETE FROM raza WHERE Id_Raza = ?";
            echo "Ejecutando query: " . $query; // Agrega esta línea para depuración
            $resultado = $this->connect->prepare($query);
            $resultado->execute(array($id));
            echo "Registro eliminado."; // Agrega esta línea para confirmar la eliminación
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function listarPorEspecie($idEspecie) {
        $query = $this->connect->prepare("SELECT * FROM raza WHERE Id_Especie = ?");
        $query->execute([$idEspecie]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    
    
}
?>