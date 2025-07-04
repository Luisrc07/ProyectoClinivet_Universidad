<?php
include_once 'models/Cita.php';
include_once 'models/Mascota.php'; // Necesario para MODEL_MASCOTA
include_once 'models/Empleado.php'; // Necesario para MODEL_EMPLEADO
include_once 'models/CatalogoServicio.php'; // Necesario para MODEL_TIPO_SERVICIO

class controlCita {
    public $MODEL; 
    public $MODEL_MASCOTA;
    public $MODEL_EMPLEADO;
    public $MODEL_TIPO_SERVICIO;

    public function __construct() {
        $this->MODEL = new Cita();
        $this->MODEL_MASCOTA = new Mascota();
        $this->MODEL_EMPLEADO = new Empleado();
        $this->MODEL_TIPO_SERVICIO = new CatalogoServicio();
    }

    public function home() {
        $citas = $this->MODEL->listar(); 
        include_once 'views/listaCita.php'; 
    }



    public function nuevo() {
        $mascotas = $this->MODEL_MASCOTA->listar(); 
        $empleados = $this->MODEL_EMPLEADO->listar(); 
        $servicios = $this->MODEL_TIPO_SERVICIO->listar(); 
        
        $cita = null; // Inicializamos $cita para el caso de nuevo registro
        if (isset($_REQUEST['id'])) {
            $cita = $this->MODEL->cargarID($_REQUEST['id']);
        }
        
        // Ahora, la vista registroCita.php tendrá acceso a $mascotas, $empleados y $servicios
        include_once 'views/registroCita.php'; 
    }

    public function guardar() {
        session_start();
        $cita = new Cita();
        

         // Asignar ID si está presente (para actualizaciones)
        if (isset($_POST['idCita']) && !empty($_POST['idCita'])) {
            $cita->setIdCita((int)$_POST['idCita']); // Convertir a int
        }

        // Validar campos obligatorios
        if (empty($_POST['Id_Tipo_Servicio']) || empty($_POST['Id_Mascota']) || empty($_POST['Id_Empleado']) || empty($_POST['Fecha_cita_actual'])) {
            echo json_encode(['error' => 'Todos los campos son obligatorios.']);
            return;
        }
    
        // Asignar valores
        $cita->setIdTipoServicio((int)$_POST['Id_Tipo_Servicio']); // Convertir a int
        $cita->setIdMascota((int)$_POST['Id_Mascota']); // Convertir a int
        $cita->setIdEmpleado((int)$_POST['Id_Empleado']); // Convertir a int
        $cita->setFechaCitaActual($_POST['Fecha_cita_actual']);
        $cita->setFechaProximaCita(isset($_POST['Fecha_Proxima_Cita']) ? $_POST['Fecha_Proxima_Cita'] : null);
    
       
    
        try {
            // Decidir si registrar o actualizar basado en si el ID de la cita está establecido en el objeto
            if (empty($cita->getIdCita())) {
                $this->MODEL->registrar($cita);
                echo "Cita registrada exitosamente.";
            } else {
                $this->MODEL->actualizarDatos($cita);
                echo "Cita actualizada exitosamente.";
            }
    
            header('Location: index.php?controller=controlCita&method=home');
            exit();
        } catch (Exception $e) {
            echo "Error al guardar la cita: " . $e->getMessage();
        }
    }

    public function eliminar() {
        if (isset($_REQUEST['id'])) {
            $this->MODEL->delete($_REQUEST['id']);
            header('Location: index.php?controller=controlCita&method=home');
            exit(); // Es buena práctica usar exit() después de un header Location
        } else {
            echo "Error: ID no proporcionado para eliminar.";
        }
    }
}
?>
