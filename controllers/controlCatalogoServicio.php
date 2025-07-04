<?php
// controllers/controlCatalogoServicio.php

include_once 'models/CatalogoServicio.php';

class ControlCatalogoServicio {

    public $MODEL;

    public function __construct() {
        $this->MODEL = new CatalogoServicio();
    }

    public function home() {
        include_once 'views/listaServicios.php';
    }

    public function nuevo() {
        $servicio = null; // Inicializar $servicio a null para nuevos registros


        if (isset($_REQUEST['id'])) {
            $servicio = $this->MODEL->cargarID($_REQUEST['id']);
            // Aquí $servicio contendrá los datos del servicio a editar
        }

        // La vista registroServicio.php ahora tendrá acceso a $servicio
        include_once 'views/registroServicio.php';
    }

    public function guardar() {
        session_start();
        $servicio = new CatalogoServicio();

        // Validar campos obligatorios para el servicio del catálogo
        if (empty($_POST['nombreServicio']) || empty($_POST['precioServicio']) || empty($_POST['TipoServicio'])) {
            $_SESSION['error_message'] = "Todos los campos obligatorios (Nombre, Precio, Tipo de Servicio) son necesarios.";
            $redirect_id_param = (isset($_POST['IdServicio']) && !empty($_POST['IdServicio'])) ? "&id=" . $_POST['IdServicio'] : "";
            header("Location: index.php?controller=controlCatalogoServicio&method=nuevo" . $redirect_id_param);
            exit();
        }

        // Asignar el ID si existe (para operaciones de actualización)
        if (isset($_POST['IdServicio']) && !empty($_POST['IdServicio'])) {
            $servicio->setIdServicio($_POST['IdServicio']);
        }

        // Asignar valores del formulario a las propiedades del modelo CatalogoServicio
        $servicio->setNombreServicio($_POST['nombreServicio'] ?? null);
        $servicio->setDescripcion($_POST['descripcion'] ?? null);
        $servicio->setPrecioServicio($_POST['precioServicio'] ?? null);
        $servicio->setTipoServicio($_POST['TipoServicio'] ?? null); // Esto guardará el ID numérico (1, 2, 3)

        try {
            // Decidir si registrar o actualizar
            if (empty($servicio->getIdServicio())) {
                $this->MODEL->registrar($servicio);
                $_SESSION['success_message'] = "Servicio del catálogo registrado exitosamente.";
            } else {
                $this->MODEL->actualizarDatos($servicio);
                $_SESSION['success_message'] = "Servicio del catálogo actualizado exitosamente.";
            }

            // *** CORRECCIÓN: Unificar la redirección al final del try ***
            header('Location: index.php?controller=controlCatalogoServicio&method=home');
            exit();

        } catch (Exception $e) {
            $_SESSION['error_message'] = "Error al guardar el servicio del catálogo: " . $e->getMessage();
            $redirect_id_param = (isset($_POST['IdServicio']) && !empty($_POST['IdServicio'])) ? "&id=" . $_POST['IdServicio'] : "";
            header("Location: index.php?controller=controlCatalogoServicio&method=nuevo" . $redirect_id_param);
            exit();
        }
    }

    public function eliminar() {
        session_start();
        if (isset($_REQUEST['id'])) {
            try {
                $this->MODEL->eliminar($_REQUEST['id']);
                $_SESSION['success_message'] = "Servicio del catálogo eliminado correctamente.";
            } catch (Exception $e) {
                $_SESSION['error_message'] = "Error al eliminar el servicio del catálogo: " . $e->getMessage();
            }
            header("Location: ?controller=controlCatalogoServicio&method=home");
            exit();
        } else {
            $_SESSION['error_message'] = "ID de servicio del catálogo no especificado para eliminar.";
            header("Location: ?controller=controlCatalogoServicio&method=home");
            exit();
        }
    }
}