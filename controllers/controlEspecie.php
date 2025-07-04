<?php 
include_once 'models/Especie.php';

class ControlEspecie    {
public $MODEL;


public function __construct() {
    $this->MODEL = new Especie();
}

public function home() {
    include_once 'views/listaEspecie.php'; // Vista para listar clientes
}

public function nuevo() {
    if (isset($_REQUEST['id'])) {
        $especie = $this->MODEL->cargarID($_REQUEST['id']);
        
        include_once 'views/registroEspecie.php'; // Vista para editar un examen
    } else {
        include_once 'views/registroEspecie.php'; // Vista para registrar un nuevo examen
    }
}




public function guardar() {
    session_start();
    $especie = new Especie();

    // Validar campos obligatorios
    if (empty($_POST['Nombre_Especie'])) {
        echo json_encode(['error' => 'Todos los campos son obligatorios.']);
        return;
    }

    // Asignar valores
    $especie->setNombreEspecie($_POST['Nombre_Especie']);

    // Asignar ID si está presente
    if (isset($_POST['Id_Tipo_especie']) && !empty($_POST['Id_Tipo_especie'])) {
        $especie->setIdEspecie($_POST['Id_Tipo_especie']);
        var_dump($especie->getIdEspecie()); // Verifica que el ID se esté estableciendo correctamente
    }

    // Depuración
    echo "ID del examen a modificar: " . $especie->getIdEspecie(); // Mensaje de depuración
    

    try {
        // Si Id_Tipo_examen está vacío, registrar; si no, actualizar
        if (empty($especie->getIdEspecie())) {
            $this->MODEL->registrar($especie);
            echo "Especie registrado exitosamente.";
        } else {
            $this->MODEL->actualizarDatos($especie);
            echo "Especie actualizado exitosamente.";
        }

        header('Location: index.php?controller=controlEspecie&method=home');
        exit();

    } catch (Exception $e) {
        echo "Error al registrar el examen: " . $e->getMessage();
    }
}



public function eliminar(){
    if (isset($_REQUEST['id'])) {
        echo "ID a eliminar: " . $_REQUEST['id']; // Agrega esta línea para verificar el ID
        $this->MODEL->delete($_REQUEST['id']);
        echo "Eliminación ejecutada."; // Agrega esta línea para confirmar la ejecución
        header('Location: index.php?controller=controlEspecie&method=home');
    } else {
        echo "Error: ID no proporcionado.";
    }
}
}

?>