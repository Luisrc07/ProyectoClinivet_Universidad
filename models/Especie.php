<?php   
class Especie{

    private $id_especie;

    private $nombre_especie;

    private $connect;

    public function getIdEspecie() { return $this->id_especie; }
    public function setIdEspecie($id_especie) { $this->id_especie = $id_especie; }

    public function getNombreEspecie() { return $this->nombre_especie; }
    public function setNombreEspecie($nombre_especie) { $this->nombre_especie = $nombre_especie; }

    public function __construct() {
        try {
            $this->connect = conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function listar() {
        try {
            $query = "SELECT * FROM especie ORDER BY Nombre_Especie";
            $resultado = $this->connect->prepare($query);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function cargarID($id) {
        try {
            $query = "SELECT * FROM especie WHERE Id_Especie = ?";
            $resultado = $this->connect->prepare($query);
            $resultado->execute(array($id));
            $especie = $resultado->fetch(PDO::FETCH_OBJ);
            return $especie; // Asegúrate de que esto devuelva un objeto con el ID correcto
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function registrar($data) {
        // Validación de datos
        if (empty($data->getNombreEspecie())) {
            throw new Exception("Error: Todos los campos son obligatorios.");
        }
    
        // Intentar registrar el cliente
        try {
            $query = "INSERT INTO especie (Nombre_Especie) VALUES (?)";
            $this->connect->prepare($query)->execute(array($data->getNombreEspecie()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizarDatos($data) {
        try {
            $query = "UPDATE especie SET Nombre_Especie = ? WHERE Id_Especie = ?";
            $this->connect->prepare($query)->execute(array($data->getNombreEspecie(), $data->getIdEspecie()));
            echo "Datos actualizados: " . $data->getIdEspecie();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $query = "DELETE FROM especie WHERE Id_Especie  = ?";
            echo "Ejecutando query: " . $query; // Agrega esta línea para depuración
            $resultado = $this->connect->prepare($query);
            $resultado->execute(array($id));
            echo "Registro eliminado."; // Agrega esta línea para confirmar la eliminación
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
}
?>