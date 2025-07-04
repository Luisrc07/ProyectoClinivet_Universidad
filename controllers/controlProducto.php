<?php
include_once 'models/Producto.php';
include_once 'models/Proveedor.php'; // Necesario para MODEL_PROVEEDOR

class controlProducto {
    public $MODEL; 
    public $MODEL_PROVEEDOR;

    public function __construct() {
        
        $this->MODEL = new Producto();
        $this->MODEL_PROVEEDOR = new Proveedor();
    }

    public function home() {
      
        $productos = $this->MODEL->listar(); 
        include_once 'views/listaProductos.php'; 
    }

    public function nuevo() {
        // *** CAMBIO CLAVE AQUÍ: Asegúrate de que se llame $proveedores ***
        $proveedores = $this->MODEL_PROVEEDOR->listar(); 
        
        $producto = null; // Inicializamos $producto para el caso de nuevo registro
        if (isset($_REQUEST['id'])) {
            $producto = $this->MODEL->cargarID($_REQUEST['id']);
        }
        
        // Ahora, la vista registroProducto.php tendrá acceso a $proveedores y $producto
        include_once 'views/registroProducto.php'; 
    }

    public function guardar() {
        session_start();
        $producto = new Producto();
    
        // Validar campos obligatorios
        if (empty($_POST['Nombre_Producto']) || empty($_POST['Descripcion']) || empty($_POST['Precio']) || empty($_POST['Cantidad_Stock']) || empty($_POST['Id_Proveedor'])) {
            echo json_encode(['error' => 'Todos los campos son obligatorios.']);
            return;
        }
    
        // Asignar valores y castear a tipos correctos
        $producto->setNombreProducto($_POST['Nombre_Producto']);
        $producto->setDescripcion($_POST['Descripcion']);
        $producto->setPrecio((float)$_POST['Precio']); // Convertir a float
        $producto->setCantidadStock((int)$_POST['Cantidad_Stock']); // Convertir a int
        $producto->setIdProveedor((int)$_POST['Id_Proveedor']); // Convertir a int
    
        // Asignar ID si está presente (para actualizaciones)
        if (isset($_POST['idProducto']) && !empty($_POST['idProducto'])) {
            $producto->setIdProducto((int)$_POST['idProducto']); // Convertir a int
        }
    
        try {
            // Decidir si registrar o actualizar basado en si el ID del producto está establecido en el objeto
            if (empty($producto->getIdProducto())) {
                $this->MODEL->registrar($producto);
                echo "Producto registrado exitosamente.";
            } else {
                $this->MODEL->actualizarDatos($producto);
                echo "Producto actualizado exitosamente.";
            }
    
          
            header('Location: index.php?controller=controlProducto&method=home');
            exit();
          
            
        } catch (Exception $e) {
            echo "Error al guardar el producto: " . $e->getMessage();
        }
    }

    public function eliminar(){
        if (isset($_REQUEST['id'])) {
            $this->MODEL->delete($_REQUEST['id']);
            header('Location: index.php?controller=controlProducto&method=home');
            exit(); // Es buena práctica usar exit() después de un header Location
        } else {
            echo "Error: ID no proporcionado para eliminar.";
        }
    }
}
?>