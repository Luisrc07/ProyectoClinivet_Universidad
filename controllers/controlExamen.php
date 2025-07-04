    <?php
include_once 'models/Examen.php';

class controlExamen {
    public $MODEL;

    public function __construct() {
        $this->MODEL = new Examen();
    }

    public function home() {
        include_once 'views/LaboratorioAdmin.php'; // Vista para listar clientes
    }

    public function nuevo() {
        if (isset($_REQUEST['id'])) {
            $Examen = $this->MODEL->cargarID($_REQUEST['id']);
            
            include_once 'views/registroExamen.php'; // Vista para editar un examen
        } else {
            include_once 'views/registroExamen.php'; // Vista para registrar un nuevo examen
        }
    }

    public function mostrarServicios() {
        try {
            $examenes = $this->MODEL->listar();
           
            include_once 'views/servicioLaboratorio.php';
        } catch (Exception $e) {
            echo "Error al cargar los servicios: " . $e->getMessage();
        }
    }



    public function guardar() {
        session_start();
        $examen = new Examen();
    
        // Validar campos obligatorios
        if (empty($_POST['Nombre_Examen']) || empty($_POST['Precio']) || empty($_POST['descripcion'])) {
            echo json_encode(['error' => 'Todos los campos son obligatorios.']);
            return;
        }
    
        // Asignar valores
        $examen->setNombre_Examen($_POST['Nombre_Examen']);
        $examen->setPrecio($_POST['Precio']);
        $examen->setDescripcion($_POST['descripcion']);
    
        // Asignar ID si está presente
        if (isset($_POST['Id_Tipo_examen']) && !empty($_POST['Id_Tipo_examen'])) {
            $examen->setId_Tipo_examen($_POST['Id_Tipo_examen']);
            var_dump($examen->getId_Tipo_examen()); // Verifica que el ID se esté estableciendo correctamente
        }
    
        // Depuración
        echo "ID del examen a modificar: " . $examen->getId_Tipo_examen(); // Mensaje de depuración
        
    
        try {
            // Si Id_Tipo_examen está vacío, registrar; si no, actualizar
            if (empty($examen->getId_Tipo_examen())) {
                $this->MODEL->registrar($examen);
                echo "Examen registrado exitosamente.";
            } else {
                $this->MODEL->actualizarDatos($examen);
                echo "Examen actualizado exitosamente.";
            }
    
            header('Location: index.php?controller=controlExamen&method=home');
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
            header('Location: index.php?controller=controlExamen&method=home');
        } else {
            echo "Error: ID no proporcionado.";
        }
    }
    
    
    
    
    

}
?>