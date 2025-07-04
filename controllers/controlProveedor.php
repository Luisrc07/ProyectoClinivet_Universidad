<?php
include_once 'models/Proveedor.php';

class controlProveedor {
    public $MODEL;

    public function __construct() {
        $this->MODEL = new Proveedor();
    }

    public function home() {
        include_once 'views/listaProveedores.php'; // Vista para listar proveedores
    }

    public function nuevo() {
        
        $proveedor = new Proveedor();
        if (isset($_REQUEST['id'])) {
            $proveedor = $this->MODEL->cargarID($_REQUEST['id']);
            include_once 'views/registroProveedor.php'; // Vista para editar un proveedor
        } else {
            include_once 'views/registroProveedor.php'; // Vista para registrar un nuevo proveedor
        }
    }

    public function guardar() {
        session_start();
        $proveedor = new Proveedor();

    
        // Asignar valores
        $proveedor->setNombreProveedor($_POST['Nombre_Proveedor']);
        $proveedor->setContacto($_POST['Contacto']);
        $proveedor->setTelefono($_POST['Telefono']);
        $proveedor->setCorreo($_POST['Correo']);
    
        // Asignar ID si está presente
        if (isset($_POST['idProveedor']) && !empty($_POST['idProveedor'])) {
            $proveedor->setIdProveedor($_POST['idProveedor']);
            var_dump($proveedor->getIdProveedor()); // Verifica que el ID se esté estableciendo correctamente
        }
    
        // Depuración
        echo "ID del proveedor a modificar: " . $proveedor->getIdProveedor(); // Mensaje de depuración
        
    
        try {
            // Si Id_Proveedor está vacío, registrar; si no, actualizar
            if (empty($proveedor->getIdProveedor())) {
                $this->MODEL->registrar($proveedor);
                echo "Proveedor registrado exitosamente.";
            } else {
                $this->MODEL->actualizarDatos($proveedor);
                echo "Proveedor actualizado exitosamente.";
            }
    
            header('Location: index.php?controller=controlProveedor&method=home');
            exit();
    
        } catch (Exception $e) {
            echo "Error al registrar el proveedor: " . $e->getMessage();
        }
    }

    public function eliminar(){
        if (isset($_REQUEST['id'])) {
            echo "ID a eliminar: " . $_REQUEST['id']; // Agrega esta línea para verificar el ID
            $this->MODEL->delete($_REQUEST['id']);
            echo "Eliminación ejecutada."; // Agrega esta línea para confirmar la ejecución
            header('Location: index.php?controller=controlProveedor&method=home');
        } else {
            echo "Error: ID no proporcionado.";
        }
    }
}
?>