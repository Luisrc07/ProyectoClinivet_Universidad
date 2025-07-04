<?php           
class Examen{
    private $id_Tipo_examen;
    private $nombre_Examen;
    private $precio;
    private $descripcion;

    private $connect;

    public function getId_Tipo_examen() { return $this->id_Tipo_examen; }
    public function setId_Tipo_examen($id_Tipo_examen) { $this->id_Tipo_examen = $id_Tipo_examen; }

    public function getNombre_Examen() { return $this->nombre_Examen; }
    public function setNombre_Examen($nombre_Examen) { $this->nombre_Examen = $nombre_Examen; }

    public function getPrecio() { return $this->precio; }
    public function setPrecio($precio) { $this->precio = $precio; }

    public function getDescripcion() { return $this->descripcion; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }


    public function __construct() {
        try {
            $this->connect = conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function listar() {
        try {
            $query = "SELECT * FROM tipo_examen ORDER BY id_Tipo_Examen"; 
            $resultado = $this->connect->prepare($query);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    

    public function cargarID($id) {
        try {
            $query = "SELECT * FROM tipo_examen WHERE id_Tipo_Examen = ?";
            $resultado = $this->connect->prepare($query);
            $resultado->execute(array($id));
            $examen = $resultado->fetch(PDO::FETCH_OBJ);
            return $examen; // Asegúrate de que esto devuelva un objeto con el ID correcto
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }





    // Método para registrar un nuevo cliente
    // Método para registrar un nuevo cliente
public function registrar($data) {
    // Validación de datos
    if (empty($data->getNombre_Examen()) || empty($data->getPrecio()) || empty($data->getDescripcion())) {
        throw new Exception("Error: Todos los campos son obligatorios.");
    }

    // Intentar registrar el cliente
    try {
        $query = "INSERT INTO tipo_examen (Nombre_Examen, Precio, descripcion) VALUES (?, ?, ?)";
        $this->connect->prepare($query)->execute(array($data->getNombre_Examen(), $data->getPrecio(), $data->getDescripcion()));
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

// Método para actualizar datos de un cliente
public function actualizarDatos($data) {
    try {
        $query = "UPDATE tipo_examen SET Nombre_Examen = ?, Precio = ?, descripcion = ? WHERE id_Tipo_Examen = ?";
        $this->connect->prepare($query)->execute(array($data->getNombre_Examen(), $data->getPrecio(), $data->getDescripcion(), $data->getId_Tipo_examen()));
        echo "Datos actualizados: " . $data->getId_Tipo_examen(); // Mensaje de depuración
    } catch (Exception $e) {
        die($e->getMessage());
    }
}




    // Método para eliminar un cliente
    public function delete($id) {
        try {
            $query = "DELETE FROM tipo_examen WHERE id_Tipo_Examen = ?";
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