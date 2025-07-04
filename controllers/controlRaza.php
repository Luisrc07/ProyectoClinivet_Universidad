<?php 
include_once 'models/Raza.php';
include_once 'models/Especie.php'; // Incluir el modelo de Especie

class ControlRaza {
    public $MODEL;
    public $ESPECIE_MODEL; // Agregar una propiedad para el modelo de Especie

    public function __construct() {
        $this->MODEL = new Raza();
        $this->ESPECIE_MODEL = new Especie(); // Inicializar el modelo de Especie
    }

    public function home() {
        include_once 'views/listaRazas.php'; // Vista para listar razas
    }

    public function nuevo() {
        $especies = $this->ESPECIE_MODEL->listar(); // Cargar las especies
        if (isset($_REQUEST['id'])) {
            $raza = $this->MODEL->cargarID($_REQUEST['id']);
            include_once 'views/registroRazas.php'; // Vista para editar una raza
        } else {
            $raza = null; // Inicializar la variable raza
            include_once 'views/registroRazas.php'; // Vista para registrar una nueva raza
        }
    }

    public function guardar() {
        session_start();
        $raza = new Raza();

        // Validar campos obligatorios
        if (empty($_POST['Nombre_Raza']) || empty($_POST['Id_Especie'])) {
            echo json_encode(['error' => 'Todos los campos son obligatorios.']);
            return;
        }

        // Asignar valores
        $raza->setNombreRaza($_POST['Nombre_Raza']);
        $raza->setIdEspecie($_POST['Id_Especie']);

        // Asignar ID si está presente
        if (isset($_POST['Id_Raza']) && !empty($_POST['Id_Raza'])) {
            $raza->setIdRaza($_POST['Id_Raza']);
        }

        try {
            // Si Id_Raza está vacío, registrar; si no, actualizar
            if (empty($raza->getIdRaza())) {
                $this->MODEL->registrar($raza);
                echo "Raza registrada exitosamente.";
            } else {
                $this->MODEL->actualizarDatos($raza);
                echo "Raza actualizada exitosamente.";
            }

            header('Location: index.php?controller=controlRaza&method=home');
            exit();

        } catch (Exception $e) {
            echo "Error al registrar la raza: " . $e->getMessage();
        }
    }

    public function eliminar() {
        if (isset($_REQUEST['id'])) {
            $this->MODEL->delete($_REQUEST['id']);
            header('Location: index.php?controller=controlRaza&method=home');
        } else {
            echo "Error: ID no proporcionado.";
        }
    }
}
?>