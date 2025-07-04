<?php
include_once 'models/Cita.php'; 
include_once 'models/CatalogoServicio.php';
include_once 'models/Mascota.php';
include_once 'models/Empleado.php';
include_once 'models/Cliente.php'; // Incluir modelo Cliente para obtener nombres de clientes en la lista de Citas

class ControlCita {

    public $MODEL;
    public $Servicio_MODEL;
    public $Mascota_MODEL;
    public $Empleado_MODEL;
    public $Cliente_MODEL; // Agregado modelo Cliente

    public function __construct() {
        $this->MODEL = new Cita();
        $this->Servicio_MODEL = new CatalogoServicio();
        $this->Mascota_MODEL = new Mascota();
        $this->Empleado_MODEL = new Empleado();
        $this->Cliente_MODEL = new Cliente(); // Inicializar modelo Cliente
    }

    public function home() {
        // Obtener todas las citas para mostrar en la lista
        $citas = $this->MODEL->listar();
        include_once 'views/listaCita.php';
    }

    public function nuevo() {
        $cita = new Cita(); // Crear un nuevo objeto Cita para el formulario
        $tiposServicio = $this->Servicio_MODEL->listar(); // Obtener todos los tipos de servicio
        $mascotas = $this->Mascota_MODEL->listar(); // Obtener todas las mascotas
        $empleados = $this->Empleado_MODEL->listar(); // Obtener todos los empleados

        // Si se pasa un ID, significa que estamos editando una cita existente
        if (isset($_REQUEST['id'])) {
            $cita = $this->MODEL->cargarID($_REQUEST['id']);
        }
        include_once 'views/registroCita.php'; // Esta vista debe ser creada
    }

    public function guardar() {
        session_start();
        $cita = new Cita();
        $response = array();

        // Validar campos obligatorios
        if (empty($_POST['idTipoServicio']) || empty($_POST['idMascota']) || empty($_POST['idEmpleado']) || empty($_POST['fechaCitaActual'])) {
            $response['error'] = "Todos los campos obligatorios deben ser completados.";
            echo json_encode($response);
            return;
        }

        // Asignar valores desde los datos POST
        $cita->setIdTipoServicio($_POST['idTipoServicio']);
        $cita->setIdMascota($_POST['idMascota']);
        $cita->setIdEmpleado($_POST['idEmpleado']);
        $cita->setFechaCitaActual($_POST['fechaCitaActual']);
        $cita->setFechaProximaCita(isset($_POST['fechaProximaCita']) && !empty($_POST['fechaProximaCita']) ? $_POST['fechaProximaCita'] : null);

        // Guardar o actualizar
        if (isset($_POST['idCita']) && !empty($_POST['idCita'])) {
            $cita->setIdCita($_POST['idCita']);
            $this->MODEL->actualizarDatos($cita);
            $response['success'] = "Cita modificada correctamente.";
        } else {
            $this->MODEL->registrar($cita);
            $response['success'] = "Cita registrada correctamente.";
        }

        $response['redirect'] = "index.php?controller=controlCita&method=home";
        echo json_encode($response);
        exit;
    }

    public function editar() {
        if (isset($_REQUEST['id'])) {
            $cita = $this->MODEL->cargarID($_REQUEST['id']);
            $tiposServicio = $this->Servicio_MODEL->listar();
            $mascotas = $this->Mascota_MODEL->listar();
            $empleados = $this->Empleado_MODEL->listar();
            include_once 'views/registroCita.php';
        } else {
            header("Location: ?controller=controlCita&method=home");
        }
    }

    public function eliminar() {
        if (isset($_REQUEST['id'])) {
            $this->MODEL->delete($_REQUEST['id']);
            header("Location: ?controller=controlCita&method=home");
        } else {
            header("Location: ?controller=controlCita&method=home");
        }
    }
}
?>











}






?>