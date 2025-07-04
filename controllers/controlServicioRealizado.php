<?php
include_once 'models/ServicioRealizado.php';
include_once 'models/Mascota.php'; // Agregar inclusión del modelo Mascota
include_once 'models/Empleado.php'; // Agregar inclusión del modelo Empleado

class controlServicioRealizado {
    public $MODEL;

    public function __construct() {
        $this->MODEL = new ServicioRealizado();
    }

    public function home() {
        include_once 'views/listaServiciosRealizados.php'; // Vista para listar servicios realizados
    }

    public function nuevo() {
        // Cargar lista de mascotas y empleados
        $mascotas = (new Mascota())->listar();
        $empleados = (new Empleado())->listar();
    
        // Verificar si se está editando un servicio realizado existente
        if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
            $servicioRealizado = $this->MODEL->cargarID($_REQUEST['id']);
        } else {
            $servicioRealizado = new ServicioRealizado(); 
        }
    
        // Incluir la vista y pasar las variables
        include_once 'views/registroServicioRealizado.php';
    }
    

    public function guardar() {
        session_start();
        $servicioRealizado = new ServicioRealizado();
    
        // Validar campos obligatorios
        if (empty($_POST['idMascota']) || empty($_POST['idEmpleado']) || empty($_POST['informacionAdicional']) || empty($_POST['citaPrevia']) || empty($_POST['proximaCita'])) {
            $_SESSION['error_message'] = 'Todos los campos son obligatorios.';
            header('Location: index.php?controller=controlServicioRealizado&method=nuevo');
            exit();
        }
    
        // Validar la fecha de la próxima cita
        $fechaActual = date('Y-m-d');
        if ($_POST['proximaCita'] <= $fechaActual) {
            $_SESSION['error_message'] = 'La próxima cita debe ser una fecha futura.';
            header('Location: index.php?controller=controlServicioRealizado&method=nuevo');
            exit();
        }
    
        // Asignar valores
        $servicioRealizado->setIdMascota($_POST['idMascota']);
        $servicioRealizado->setIdEmpleado($_POST['idEmpleado']);
        $servicioRealizado->setInformacionAdicional($_POST['informacionAdicional']);
        $servicioRealizado->setCitaPrevia($_POST['citaPrevia']);
        $servicioRealizado->setProximaCita($_POST['proximaCita']);
    
        // Asignar ID si está presente
        if (isset($_POST['idServicioRealizado']) && !empty($_POST['idServicioRealizado'])) {
            $servicioRealizado->setIdServicioRealizado($_POST['idServicioRealizado']);
        }
    
        try {
            // Si idServicioRealizado está vacío, registrar; si no, actualizar
            if (empty($servicioRealizado->getIdServicioRealizado())) {
                $this->MODEL->guardarConTransaccion($servicioRealizado);
                $_SESSION['success_message'] = "Servicio realizado registrado exitosamente.";
            } else {
                $this->MODEL->guardarConTransaccion($servicioRealizado);
                $_SESSION['success_message'] = "Servicio realizado actualizado exitosamente.";
            }
    
            // No redirigir aquí, dejar que el JavaScript maneje la redirección
            header('Location: index.php?controller=controlServicioRealizado&method=nuevo');
            exit();
    
        } catch (Exception $e) {
            $_SESSION['error_message'] = "Error al registrar el servicio realizado: " . $e->getMessage();
            header('Location: index.php?controller=controlServicioRealizado&method=nuevo');
            exit();
        }
    }
    

    public function eliminar(){
        if (isset($_REQUEST['id'])) {
            $this->MODEL->delete($_REQUEST['id']);
            header('Location: index.php?controller=controlServicioRealizado&method=home');
        } else {
            echo "Error: ID no proporcionado.";
        }
    }
}
?>
